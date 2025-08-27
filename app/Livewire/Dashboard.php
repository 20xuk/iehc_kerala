<?php

namespace App\Livewire;

use App\Models\Collection;
use App\Models\Donor;
use App\Models\BibleVerse;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalDonors = 0;
    public $monthlyCollections = 0;
    public $totalAmount = 0;
    public $activeSubscriptions = 0;
    public $recentCollections = [];
    public $recentDonors = [];
    public $todaysVerse = null;

    public function mount()
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        // Get today's Bible verse
        $this->todaysVerse = BibleVerse::getTodaysVerse();
        
        // Get recent collections
        $this->recentCollections = Collection::with(['donor', 'payments'])
            ->where('status', 'active')
            ->orderBy('collection_date', 'desc')
            ->limit(10)
            ->get();

        // Get recent donors
        $this->recentDonors = Donor::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Load statistics
        $this->loadStatistics();
    }

    public function loadStatistics()
    {
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();

        // Total donors
        $this->totalDonors = Donor::where('status', 'active')->count();

        // Collections statistics
        $this->monthlyCollections = Collection::where('status', 'active')
            ->whereBetween('collection_date', [$startDate, $endDate])
            ->count();

        $this->totalAmount = Collection::where('status', 'active')
            ->whereBetween('collection_date', [$startDate, $endDate])
            ->sum('total_amount');

        // Active subscriptions (placeholder for now)
        $this->activeSubscriptions = 0; // Will be updated when magazine model is implemented
    }

    public function refreshStats()
    {
        $this->loadStatistics();
        $this->dispatch('stats-updated');
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
