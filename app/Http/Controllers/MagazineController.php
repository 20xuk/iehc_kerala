<?php

namespace App\Http\Controllers;

use App\Models\MagazineSubscription;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MagazineController extends Controller
{
    public function index()
    {
        $subscriptions = MagazineSubscription::with('donor')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('magazines.index', compact('subscriptions'));
    }

    public function create()
    {
        $donors = Donor::active()->named()->orderBy('name')->get();
        $magazines = $this->getAvailableMagazines();

        return view('magazines.create', compact('donors', 'magazines'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'donor_id' => 'required|exists:donors,id',
            'magazine_name' => 'required|string|max:255',
            'subscription_type' => ['required', Rule::in(['subscription', 'non_subscription'])],
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'delivery_address' => 'nullable|string',
        ]);

        MagazineSubscription::create($validated);

        return redirect()->route('magazines.index')
                        ->with('success', 'Magazine subscription created successfully.');
    }

    public function show(MagazineSubscription $magazine)
    {
        $magazine->load('donor');
        
        return view('magazines.show', compact('magazine'));
    }

    public function edit(MagazineSubscription $magazine)
    {
        $donors = Donor::active()->named()->orderBy('name')->get();
        $magazines = $this->getAvailableMagazines();

        return view('magazines.edit', compact('magazine', 'donors', 'magazines'));
    }

    public function update(Request $request, MagazineSubscription $magazine)
    {
        $validated = $request->validate([
            'donor_id' => 'required|exists:donors,id',
            'magazine_name' => 'required|string|max:255',
            'subscription_type' => ['required', Rule::in(['subscription', 'non_subscription'])],
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'status' => ['required', Rule::in(['active', 'inactive', 'expired'])],
            'delivery_address' => 'nullable|string',
        ]);

        $magazine->update($validated);

        return redirect()->route('magazines.show', $magazine)
                        ->with('success', 'Magazine subscription updated successfully.');
    }

    public function destroy(MagazineSubscription $magazine)
    {
        $magazine->delete();

        return redirect()->route('magazines.index')
                        ->with('success', 'Magazine subscription deleted successfully.');
    }

    public function addressRegister(Request $request)
    {
        $query = MagazineSubscription::with('donor')
            ->where('status', 'active');

        // Filter by magazine
        if ($request->filled('magazine_name')) {
            $query->where('magazine_name', $request->magazine_name);
        }

        // Filter by subscription type
        if ($request->filled('subscription_type')) {
            $query->where('subscription_type', $request->subscription_type);
        }

        // Sort by pincode
        if ($request->filled('sort_by') && $request->sort_by === 'pincode') {
            $query->join('donors', 'magazine_subscriptions.donor_id', '=', 'donors.id')
                  ->orderBy('donors.pincode', $request->get('sort_order', 'asc'))
                  ->select('magazine_subscriptions.*');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $subscriptions = $query->paginate(50);

        $magazines = $this->getAvailableMagazines();

        return view('magazines.address-register', compact('subscriptions', 'magazines'));
    }

    public function subscriptionRegister(Request $request)
    {
        $query = MagazineSubscription::with('donor');

        // Filter by magazine
        if ($request->filled('magazine_name')) {
            $query->where('magazine_name', $request->magazine_name);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by subscription type
        if ($request->filled('subscription_type')) {
            $query->where('subscription_type', $request->subscription_type);
        }

        // Date range filter
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('start_date', [$request->start_date, $request->end_date]);
        }

        $subscriptions = $query->orderBy('start_date', 'desc')->paginate(50);

        $magazines = $this->getAvailableMagazines();

        return view('magazines.subscription-register', compact('subscriptions', 'magazines'));
    }

    private function getAvailableMagazines(): array
    {
        // This could be moved to a configuration file or database table
        return [
            'ICC Magazine' => 'ICC Magazine',
            'Prayer Bulletin' => 'Prayer Bulletin',
            'Youth Magazine' => 'Youth Magazine',
            'Children Magazine' => 'Children Magazine',
            'Newsletter' => 'Newsletter',
        ];
    }
}
