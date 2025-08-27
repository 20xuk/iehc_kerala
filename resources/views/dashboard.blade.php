@extends('layouts.app')

@section('title', 'Dashboard - IEHCKerala')

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Welcome to IEHCKerala</h1>
                <p class="text-blue-100 mt-2">India Every Home Crusade - Spreading Gospel to Every Home</p>
            </div>
            <div class="hidden md:block">
                <svg class="w-24 h-24 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Donors</p>
                    <p class="text-2xl font-semibold text-gray-900" id="total-donors">-</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">This Month Collections</p>
                    <p class="text-2xl font-semibold text-gray-900" id="monthly-collections">-</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Amount</p>
                    <p class="text-2xl font-semibold text-gray-900" id="total-amount">-</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Active Subscriptions</p>
                    <p class="text-2xl font-semibold text-gray-900" id="active-subscriptions">-</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('donors.create') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="p-2 rounded-full bg-blue-100 text-blue-600 mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-900">Add Donor</p>
                    <p class="text-sm text-gray-600">Register new donor</p>
                </div>
            </a>

            <a href="{{ route('collections.create') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="p-2 rounded-full bg-green-100 text-green-600 mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-900">New Collection</p>
                    <p class="text-sm text-gray-600">Record donation</p>
                </div>
            </a>

            <a href="{{ route('magazines.create') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="p-2 rounded-full bg-purple-100 text-purple-600 mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-900">Add Subscription</p>
                    <p class="text-sm text-gray-600">Magazine subscription</p>
                </div>
            </a>

            <a href="{{ route('reports.donor-collections') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="p-2 rounded-full bg-yellow-100 text-yellow-600 mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-900">View Reports</p>
                    <p class="text-sm text-gray-600">Generate reports</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Collections -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Recent Collections</h2>
                <a href="{{ route('collections.index') }}" class="text-sm text-blue-600 hover:text-blue-800">View all</a>
            </div>
            <div class="space-y-4">
                @forelse($recentCollections as $collection)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-medium text-gray-900">{{ $collection->donor->name }}</p>
                        <p class="text-sm text-gray-600">{{ $collection->receipt_number }} • {{ $collection->collection_date->format('d/m/Y') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900">₹{{ number_format($collection->total_amount, 2) }}</p>
                        <p class="text-xs text-gray-500">{{ ucfirst(str_replace('_', ' ', $collection->donation_type)) }}</p>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">No recent collections</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Donors -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Recent Donors</h2>
                <a href="{{ route('donors.index') }}" class="text-sm text-blue-600 hover:text-blue-800">View all</a>
            </div>
            <div class="space-y-4">
                @forelse($recentDonors as $donor)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-medium text-gray-900">{{ $donor->name }}</p>
                        <p class="text-sm text-gray-600">{{ $donor->city }}, {{ $donor->state }}</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $donor->donor_type === 'named' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($donor->donor_type) }}
                        </span>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">No recent donors</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Today's Bible Verse -->
    @if($todaysVerse)
    <div class="bg-gradient-to-r from-purple-600 to-purple-800 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <h3 class="text-lg font-semibold mb-2">Today's Bible Verse</h3>
                <p class="text-purple-100 mb-3">{{ $todaysVerse->reference }}</p>
                <p class="text-white leading-relaxed">{{ $todaysVerse->display_text }}</p>
            </div>
            <div class="ml-6">
                <a href="{{ route('bible-verses.today') }}" class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 rounded-lg hover:bg-opacity-30 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    View Details
                </a>
            </div>
        </div>
    </div>
    @endif
</div>

<script>
// Load dashboard statistics
document.addEventListener('DOMContentLoaded', function() {
    fetch('/dashboard/stats')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total-donors').textContent = data.donors.total;
            document.getElementById('monthly-collections').textContent = data.collections.total;
            document.getElementById('total-amount').textContent = '₹' + parseFloat(data.collections.amount).toLocaleString('en-IN');
            document.getElementById('active-subscriptions').textContent = '-'; // Will be updated when magazine model is implemented
        })
        .catch(error => {
            console.error('Error loading dashboard stats:', error);
        });
});
</script>
@endsection
