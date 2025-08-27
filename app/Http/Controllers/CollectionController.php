<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\CollectionPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
        $query = Collection::with(['donor', 'payments', 'createdBy']);

        // Search by receipt number
        if ($request->filled('receipt_number')) {
            $query->where('receipt_number', 'like', "%{$request->receipt_number}%");
        }

        // Filter by payment mode
        if ($request->filled('payment_mode')) {
            $query->whereHas('payments', function ($q) use ($request) {
                $q->where('payment_mode', $request->payment_mode);
            });
        }

        // Filter by donation type
        if ($request->filled('donation_type')) {
            $query->where('donation_type', $request->donation_type);
        }

        // Date range filter
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('collection_date', [$request->start_date, $request->end_date]);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $collections = $query->orderBy('collection_date', 'desc')->paginate(20);

        return view('collections.index', compact('collections'));
    }

    public function create()
    {
        $donors = User::donors()->active()->where('is_anonymous', false)->orderBy('name')->get();
        $receiptNumber = Collection::generateReceiptNumber();

        return view('collections.create', compact('donors', 'receiptNumber'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'donor_id' => 'required|exists:users,id',
            'receipt_number' => 'required|string|unique:collections,receipt_number',
            'total_amount' => 'required|numeric|min:0.01',
            'donation_type' => ['required', Rule::in(['prayer_hall', 'magazine', 'general', 'subscription'])],
            'collection_date' => 'required|date',
            'notes' => 'nullable|string',
            'payments' => 'required|array|min:1',
            'payments.*.payment_mode' => ['required', Rule::in(['cash', 'cheque', 'online', 'card', 'upi'])],
            'payments.*.amount' => 'required|numeric|min:0.01',
            'payments.*.transaction_id' => 'nullable|string',
            'payments.*.cheque_number' => 'nullable|string',
            'payments.*.bank_name' => 'nullable|string',
            'payments.*.cheque_date' => 'nullable|date',
            'payments.*.payment_notes' => 'nullable|string',
        ]);

        // Validate total amount matches sum of payments
        $paymentTotal = collect($validated['payments'])->sum('amount');
        if (abs($paymentTotal - $validated['total_amount']) > 0.01) {
            return back()->withErrors(['total_amount' => 'Total amount must match the sum of payment amounts.'])
                        ->withInput();
        }

        try {
            DB::beginTransaction();

            $collection = Collection::create([
                'donor_id' => $validated['donor_id'],
                'receipt_number' => $validated['receipt_number'],
                'total_amount' => $validated['total_amount'],
                'donation_type' => $validated['donation_type'],
                'collection_date' => $validated['collection_date'],
                'notes' => $validated['notes'],
                'created_by' => auth()->id(),
            ]);

            // Create payment records
            foreach ($validated['payments'] as $payment) {
                CollectionPayment::create([
                    'collection_id' => $collection->id,
                    'payment_mode' => $payment['payment_mode'],
                    'amount' => $payment['amount'],
                    'transaction_id' => $payment['transaction_id'] ?? null,
                    'cheque_number' => $payment['cheque_number'] ?? null,
                    'bank_name' => $payment['bank_name'] ?? null,
                    'cheque_date' => $payment['cheque_date'] ?? null,
                    'payment_notes' => $payment['payment_notes'] ?? null,
                ]);
            }

            DB::commit();

            return redirect()->route('collections.show', $collection)
                            ->with('success', 'Collection recorded successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to record collection. Please try again.'])
                        ->withInput();
        }
    }

    public function show(Collection $collection)
    {
        $collection->load(['donor', 'payments', 'createdBy', 'cancelledBy']);
        
        return view('collections.show', compact('collection'));
    }

    public function edit(Collection $collection)
    {
        if ($collection->isCancelled()) {
            return back()->withErrors(['error' => 'Cannot edit cancelled collection.']);
        }

        $donors = User::donors()->active()->where('is_anonymous', false)->orderBy('name')->get();
        $collection->load('payments');

        return view('collections.edit', compact('collection', 'donors'));
    }

    public function update(Request $request, Collection $collection)
    {
        if ($collection->isCancelled()) {
            return back()->withErrors(['error' => 'Cannot edit cancelled collection.']);
        }

        $validated = $request->validate([
            'donor_id' => 'required|exists:donors,id',
            'total_amount' => 'required|numeric|min:0.01',
            'donation_type' => ['required', Rule::in(['prayer_hall', 'magazine', 'general', 'subscription'])],
            'collection_date' => 'required|date',
            'notes' => 'nullable|string',
            'payments' => 'required|array|min:1',
            'payments.*.payment_mode' => ['required', Rule::in(['cash', 'cheque', 'online', 'card', 'upi'])],
            'payments.*.amount' => 'required|numeric|min:0.01',
            'payments.*.transaction_id' => 'nullable|string',
            'payments.*.cheque_number' => 'nullable|string',
            'payments.*.bank_name' => 'nullable|string',
            'payments.*.cheque_date' => 'nullable|date',
            'payments.*.payment_notes' => 'nullable|string',
        ]);

        // Validate total amount matches sum of payments
        $paymentTotal = collect($validated['payments'])->sum('amount');
        if (abs($paymentTotal - $validated['total_amount']) > 0.01) {
            return back()->withErrors(['total_amount' => 'Total amount must match the sum of payment amounts.'])
                        ->withInput();
        }

        try {
            DB::beginTransaction();

            $collection->update([
                'donor_id' => $validated['donor_id'],
                'total_amount' => $validated['total_amount'],
                'donation_type' => $validated['donation_type'],
                'collection_date' => $validated['collection_date'],
                'notes' => $validated['notes'],
            ]);

            // Delete existing payments and create new ones
            $collection->payments()->delete();

            foreach ($validated['payments'] as $payment) {
                CollectionPayment::create([
                    'collection_id' => $collection->id,
                    'payment_mode' => $payment['payment_mode'],
                    'amount' => $payment['amount'],
                    'transaction_id' => $payment['transaction_id'] ?? null,
                    'cheque_number' => $payment['cheque_number'] ?? null,
                    'bank_name' => $payment['bank_name'] ?? null,
                    'cheque_date' => $payment['cheque_date'] ?? null,
                    'payment_notes' => $payment['payment_notes'] ?? null,
                ]);
            }

            DB::commit();

            return redirect()->route('collections.show', $collection)
                            ->with('success', 'Collection updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to update collection. Please try again.'])
                        ->withInput();
        }
    }

    public function cancel(Request $request, Collection $collection)
    {
        if ($collection->isCancelled()) {
            return back()->withErrors(['error' => 'Collection is already cancelled.']);
        }

        $collection->cancel(auth()->id());

        return back()->with('success', 'Collection cancelled successfully.');
    }

    public function getDonorInfo(Request $request)
    {
        $donor = User::donors()->find($request->donor_id);
        
        if (!$donor) {
            return response()->json(['error' => 'Donor not found'], 404);
        }

        $lastDonation = $donor->lastDonation;
        $totalDonations = $donor->totalDonations;

        return response()->json([
            'donor' => $donor,
            'last_donation' => $lastDonation,
            'total_donations' => $totalDonations,
        ]);
    }

    public function groupedByPaymentMode(Request $request)
    {
        $query = Collection::with(['donor', 'payments'])
            ->where('status', 'active');

        // Date range filter
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('collection_date', [$request->start_date, $request->end_date]);
        }

        $collections = $query->orderBy('collection_date', 'desc')->get();

        // Group by payment mode
        $grouped = $collections->groupBy(function ($collection) {
            return $collection->payments->first()->payment_mode ?? 'unknown';
        });

        return view('collections.grouped', compact('grouped'));
    }

    public function receipt(Collection $collection)
    {
        $collection->load(['donor', 'payments', 'createdBy']);
        
        return view('collections.receipt', compact('collection'));
    }
}
