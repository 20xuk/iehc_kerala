<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Collection;
use Illuminate\Http\Request;

class StaffDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:office_staff');
    }

    public function index()
    {
        // Get statistics for staff dashboard
        $stats = [
            'total_donors' => User::donors()->count(),
            'active_donors' => User::donors()->where('status', 'active')->count(),
            'total_collections' => Collection::where('status', 'active')->count(),
            'total_amount' => Collection::where('status', 'active')->sum('total_amount'),
            'recent_collections' => Collection::with('donor')
                ->where('status', 'active')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get(),
        ];

        return view('staff.dashboard', compact('stats'));
    }
}
