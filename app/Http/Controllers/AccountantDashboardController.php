<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\CollectionPayment;
use Illuminate\Http\Request;

class AccountantDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:accountant');
    }

    public function index()
    {
        // Get financial statistics for accountant dashboard
        $stats = [
            'total_amount' => Collection::where('status', 'active')->sum('total_amount'),
            'total_collections' => Collection::where('status', 'active')->count(),
            'monthly_amount' => Collection::where('status', 'active')
                ->whereMonth('collection_date', now()->month)
                ->sum('total_amount'),
            'monthly_collections' => Collection::where('status', 'active')
                ->whereMonth('collection_date', now()->month)
                ->count(),
            'recent_payments' => CollectionPayment::with(['collection.donor'])
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get(),
        ];

        return view('accountant.dashboard', compact('stats'));
    }
}
