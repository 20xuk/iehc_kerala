<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Collection;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:system_admin');
    }

    public function index()
    {
        // Get statistics for admin dashboard
        $stats = [
            'total_donors' => User::donors()->count(),
            'active_donors' => User::donors()->where('status', 'active')->count(),
            'total_collections' => Collection::where('status', 'active')->count(),
            'total_amount' => Collection::where('status', 'active')->sum('total_amount'),
            'total_users' => User::count(),
            'recent_collections' => Collection::with('donor')
                ->where('status', 'active')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
