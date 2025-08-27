<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonorDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:donor');
    }

    public function index()
    {
        $user = Auth::user();
        
        // Get donor's donation history
        $donations = Collection::where('donor_id', $user->id)
            ->where('status', 'active')
            ->orderBy('collection_date', 'desc')
            ->limit(10)
            ->get();

        $stats = [
            'total_donations' => Collection::where('donor_id', $user->id)
                ->where('status', 'active')
                ->count(),
            'total_amount' => Collection::where('donor_id', $user->id)
                ->where('status', 'active')
                ->sum('total_amount'),
            'last_donation' => Collection::where('donor_id', $user->id)
                ->where('status', 'active')
                ->orderBy('collection_date', 'desc')
                ->first(),
        ];

        return view('donor.dashboard', compact('stats', 'donations'));
    }
}
