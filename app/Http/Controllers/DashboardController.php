<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\User;
use App\Models\BibleVerse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get today's Bible verse
        $todaysVerse = BibleVerse::getTodaysVerse();
        
        // Get recent collections
        $recentCollections = Collection::with(['donor', 'payments'])
            ->where('status', 'active')
            ->orderBy('collection_date', 'desc')
            ->limit(10)
            ->get();

        // Get recent donors
        $recentDonors = User::donors()->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact('todaysVerse', 'recentCollections', 'recentDonors'));
    }

    public function stats(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfMonth());
        $endDate = $request->get('end_date', now()->endOfMonth());

        // Total donors
        $totalDonors = User::donors()->where('status', 'active')->count();
        $anonymousDonors = User::donors()->where('status', 'active')->where('donor_type', 'anonymous')->count();
        $namedDonors = User::donors()->where('status', 'active')->where('donor_type', 'individual')->count();

        // Collections statistics
        $totalCollections = Collection::where('status', 'active')
            ->whereBetween('collection_date', [$startDate, $endDate])
            ->count();

        $totalAmount = Collection::where('status', 'active')
            ->whereBetween('collection_date', [$startDate, $endDate])
            ->sum('total_amount');

        // Payment mode breakdown
        $paymentBreakdown = Collection::where('status', 'active')
            ->whereBetween('collection_date', [$startDate, $endDate])
            ->with('payments')
            ->get()
            ->flatMap(function ($collection) {
                return $collection->payments;
            })
            ->groupBy('payment_mode')
            ->map(function ($payments) {
                return $payments->sum('amount');
            });

        // Donation type breakdown
        $donationTypeBreakdown = Collection::where('status', 'active')
            ->whereBetween('collection_date', [$startDate, $endDate])
            ->selectRaw('donation_type, COUNT(*) as count, SUM(total_amount) as total')
            ->groupBy('donation_type')
            ->get()
            ->keyBy('donation_type');

        // Monthly trend (last 12 months)
        $monthlyTrend = Collection::where('status', 'active')
            ->where('collection_date', '>=', now()->subMonths(12))
            ->selectRaw('YEAR(collection_date) as year, MONTH(collection_date) as month, SUM(total_amount) as total')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        return response()->json([
            'donors' => [
                'total' => $totalDonors,
                'anonymous' => $anonymousDonors,
                'named' => $namedDonors,
            ],
            'collections' => [
                'total' => $totalCollections,
                'amount' => $totalAmount,
            ],
            'payment_breakdown' => $paymentBreakdown,
            'donation_type_breakdown' => $donationTypeBreakdown,
            'monthly_trend' => $monthlyTrend,
            'period' => [
                'start_date' => $startDate,
                'end_date' => $endDate,
            ],
        ]);
    }
}
