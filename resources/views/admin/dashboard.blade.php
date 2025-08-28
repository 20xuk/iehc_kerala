@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-br from-blue-600 via-blue-700 to-purple-600 rounded-xl p-8 text-white shadow-xl">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-blue-100 text-lg">Here's what's happening with your organization today.</p>
            </div>
            <div class="hidden md:block">
                <div class="text-right">
                    <p class="text-blue-100 text-sm">Today's Date</p>
                    <p class="text-white font-semibold">{{ now()->format('l, F j, Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="stat-card bg-white rounded-xl shadow-md p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-blue-50 text-blue-600 shadow-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Donors</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_donors']) }}</p>
                    <p class="text-xs text-green-600 font-medium">+12% from last month</p>
                </div>
            </div>
        </div>

        <div class="stat-card bg-white rounded-xl shadow-md p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-green-50 text-green-600 shadow-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Collections</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_collections']) }}</p>
                    <p class="text-xs text-green-600 font-medium">+8% from last month</p>
                </div>
            </div>
        </div>

        <div class="stat-card bg-white rounded-xl shadow-md p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-yellow-50 text-yellow-600 shadow-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Amount</p>
                    <p class="text-3xl font-bold text-gray-900">₹{{ number_format($stats['total_amount'], 2) }}</p>
                    <p class="text-xs text-green-600 font-medium">+15% from last month</p>
                </div>
            </div>
        </div>

        <div class="stat-card bg-white rounded-xl shadow-md p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-3 rounded-xl bg-purple-50 text-purple-600 shadow-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Users</p>
                    <p class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_users']) }}</p>
                    <p class="text-xs text-blue-600 font-medium">Active system users</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Collections -->
    <div class="bg-white rounded-xl shadow-md border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-xl">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Recent Collections</h3>
                <a href="{{ route('collections.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All</a>
            </div>
        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">
                            <div class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="hidden md:inline">Donor</span>
                            </div>
                        </th>
                        <th class="text-center">
                            <div class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <span class="hidden md:inline">Amount</span>
                            </div>
                        </th>
                        <th class="text-center">
                            <div class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="hidden md:inline">Date</span>
                            </div>
                        </th>
                        <th class="text-center">
                            <div class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="hidden md:inline">Status</span>
                            </div>
                        </th>
                        <th class="text-center">
                            <div class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                </svg>
                                <span class="hidden md:inline">Actions</span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stats['recent_collections'] as $collection)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mb-2">
                                    <span class="text-blue-600 font-semibold text-sm">{{ substr($collection->donor->name, 0, 1) }}</span>
                                </div>
                                <div class="text-center">
                                    <div class="font-medium text-gray-900 text-sm">{{ $collection->donor->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $collection->donor->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="font-semibold text-gray-900 text-lg">₹{{ number_format($collection->total_amount, 2) }}</div>
                            <div class="text-xs text-gray-500 uppercase tracking-wide">{{ $collection->donation_type }}</div>
                        </td>
                        <td class="text-center">
                            <div class="text-sm text-gray-900 font-medium">{{ $collection->collection_date->format('M d, Y') }}</div>
                            <div class="text-xs text-gray-500">{{ $collection->collection_date->format('g:i A') }}</div>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-success">Active</span>
                        </td>
                        <td class="text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('collections.show', $collection) }}" class="btn btn-icon btn-sm btn-primary" title="View Details">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('collections.receipt', $collection) }}" class="btn btn-icon btn-sm btn-success" title="Download Receipt">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-8">
                            <div class="text-gray-500">
                                <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-lg font-medium">No recent collections</p>
                                <p class="text-sm">Collections will appear here once they are recorded.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('donors.create') }}" class="btn-action bg-white rounded-xl shadow-md p-8 border border-gray-100 hover:shadow-lg transition-all duration-200 text-center group">
            <div class="flex flex-col items-center">
                <div class="p-4 rounded-xl bg-blue-50 text-blue-600 shadow-sm group-hover:bg-blue-100 transition-colors mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Add New Donor</h3>
                <p class="text-sm text-gray-600">Register a new donor to the system</p>
            </div>
        </a>

        <a href="{{ route('collections.create') }}" class="btn-action bg-white rounded-xl shadow-md p-8 border border-gray-100 hover:shadow-lg transition-all duration-200 text-center group">
            <div class="flex flex-col items-center">
                <div class="p-4 rounded-xl bg-green-50 text-green-600 shadow-sm group-hover:bg-green-100 transition-colors mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">New Collection</h3>
                <p class="text-sm text-gray-600">Record a new donation collection</p>
            </div>
        </a>

        <a href="{{ route('reports.donor-collections') }}" class="btn-action bg-white rounded-xl shadow-md p-8 border border-gray-100 hover:shadow-lg transition-all duration-200 text-center group">
            <div class="flex flex-col items-center">
                <div class="p-4 rounded-xl bg-purple-50 text-purple-600 shadow-sm group-hover:bg-purple-100 transition-colors mb-4">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">View Reports</h3>
                <p class="text-sm text-gray-600">Generate and view detailed reports</p>
            </div>
        </a>
    </div>
</div>
@endsection
