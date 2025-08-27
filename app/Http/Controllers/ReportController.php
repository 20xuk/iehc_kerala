<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Donor;
use App\Models\CollectionPayment;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function donorCollections(Request $request)
    {
        $query = Donor::with(['collections' => function ($query) use ($request) {
            $query->where('status', 'active');
            
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $query->whereBetween('collection_date', [$request->start_date, $request->end_date]);
            }
        }]);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('mobile_main', 'like', "%{$search}%")
                  ->orWhere('pincode', 'like', "%{$search}%");
            });
        }

        // Filter by donor type
        if ($request->filled('donor_type')) {
            $query->where('donor_type', $request->donor_type);
        }

        // Filter by minimum donation amount
        if ($request->filled('min_amount')) {
            $query->whereHas('collections', function ($q) use ($request) {
                $q->where('status', 'active')
                  ->havingRaw('SUM(total_amount) >= ?', [$request->min_amount]);
            });
        }

        $donors = $query->orderBy('name')->paginate(20);

        return view('reports.donor-collections', compact('donors'));
    }

    public function collectionRegister(Request $request)
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

        $collections = $query->orderBy('collection_date', 'desc')->paginate(50);

        return view('reports.collection-register', compact('collections'));
    }

    public function groupedCollections(Request $request)
    {
        $query = Collection::with(['donor', 'payments', 'createdBy'])
            ->where('status', 'active');

        // Date range filter
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('collection_date', [$request->start_date, $request->end_date]);
        }

        // Filter by donation type
        if ($request->filled('donation_type')) {
            $query->where('donation_type', $request->donation_type);
        }

        $collections = $query->orderBy('collection_date', 'desc')->get();

        // Group by payment mode
        $groupedByPaymentMode = $collections->groupBy(function ($collection) {
            return $collection->payments->first()->payment_mode ?? 'unknown';
        });

        // Group by donation type
        $groupedByDonationType = $collections->groupBy('donation_type');

        // Group by user (sponsorship-wise)
        $groupedByUser = $collections->groupBy('created_by');

        return view('reports.grouped-collections', compact(
            'groupedByPaymentMode',
            'groupedByDonationType',
            'groupedByUser'
        ));
    }

    public function promotionalSecretary(Request $request)
    {
        $query = Collection::with(['donor', 'payments', 'createdBy'])
            ->where('status', 'active');

        // Date range filter
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('collection_date', [$request->start_date, $request->end_date]);
        }

        // Filter by user (promotional secretary)
        if ($request->filled('user_id')) {
            $query->where('created_by', $request->user_id);
        }

        $collections = $query->orderBy('collection_date', 'desc')->get();

        // Group by user
        $groupedByUser = $collections->groupBy('created_by');

        // Include cancelled receipts
        $cancelledCollections = Collection::with(['donor', 'cancelledBy'])
            ->where('status', 'cancelled')
            ->when($request->filled('start_date') && $request->filled('end_date'), function ($query) use ($request) {
                return $query->whereBetween('cancelled_at', [$request->start_date, $request->end_date]);
            })
            ->when($request->filled('user_id'), function ($query) use ($request) {
                return $query->where('cancelled_by', $request->user_id);
            })
            ->orderBy('cancelled_at', 'desc')
            ->get();

        return view('reports.promotional-secretary', compact('groupedByUser', 'cancelledCollections'));
    }

    public function dateWise(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfMonth());
        $endDate = $request->get('end_date', now()->endOfMonth());

        $query = Collection::with(['donor', 'payments'])
            ->where('status', 'active')
            ->whereBetween('collection_date', [$startDate, $endDate]);

        // Filter by donation type
        if ($request->filled('donation_type')) {
            $query->where('donation_type', $request->donation_type);
        }

        $collections = $query->orderBy('collection_date', 'desc')->get();

        // Group by date
        $groupedByDate = $collections->groupBy(function ($collection) {
            return $collection->collection_date->format('Y-m-d');
        });

        // Calculate daily totals
        $dailyTotals = $groupedByDate->map(function ($dayCollections) {
            return [
                'count' => $dayCollections->count(),
                'total_amount' => $dayCollections->sum('total_amount'),
                'collections' => $dayCollections,
            ];
        });

        // Payment mode breakdown by date
        $paymentModeByDate = $collections->groupBy(function ($collection) {
            return $collection->collection_date->format('Y-m-d');
        })->map(function ($dayCollections) {
            return $dayCollections->flatMap(function ($collection) {
                return $collection->payments;
            })->groupBy('payment_mode')->map(function ($payments) {
                return $payments->sum('amount');
            });
        });

        return view('reports.date-wise', compact('dailyTotals', 'paymentModeByDate', 'startDate', 'endDate'));
    }

    public function export(Request $request)
    {
        $type = $request->get('type', 'collections');
        $format = $request->get('format', 'pdf');

        switch ($type) {
            case 'donor-collections':
                return $this->exportDonorCollections($request, $format);
            case 'collection-register':
                return $this->exportCollectionRegister($request, $format);
            case 'grouped-collections':
                return $this->exportGroupedCollections($request, $format);
            default:
                return back()->withErrors(['error' => 'Invalid export type.']);
        }
    }

    private function exportDonorCollections(Request $request, $format)
    {
        // Implementation for exporting donor collections
        // This would generate PDF or Excel based on the format
        return response()->json(['message' => 'Export functionality to be implemented']);
    }

    private function exportCollectionRegister(Request $request, $format)
    {
        // Implementation for exporting collection register
        return response()->json(['message' => 'Export functionality to be implemented']);
    }

    private function exportGroupedCollections(Request $request, $format)
    {
        // Implementation for exporting grouped collections
        return response()->json(['message' => 'Export functionality to be implemented']);
    }
}
