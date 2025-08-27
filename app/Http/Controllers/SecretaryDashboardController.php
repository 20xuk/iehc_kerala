<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Collection;
use Illuminate\Http\Request;

class SecretaryDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:secretary');
    }

    public function index()
    {
        // Get statistics for secretary dashboard
        $stats = [
            'total_donors' => User::donors()->where('status', 'active')->count(),
            'total_collections' => Collection::where('status', 'active')->count(),
            'total_amount' => Collection::where('status', 'active')->sum('total_amount'),
            'monthly_collections' => Collection::where('status', 'active')
                ->whereMonth('collection_date', now()->month)
                ->count(),
            'recent_collections' => Collection::with('donor')
                ->where('status', 'active')
                ->orderBy('collection_date', 'desc')
                ->limit(10)
                ->get(),
        ];

        return view('secretary.dashboard', compact('stats'));
    }
}
