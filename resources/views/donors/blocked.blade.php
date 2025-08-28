@extends('layouts.app')

@section('title', 'Blocked/Inactive Donors')

@section('content')
<div class="space-y-6">
    <!-- Professional Header -->
    <div class="bg-white border-b border-gray-200 pb-8 pt-6 px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Blocked/Inactive Donors</h1>
                <p class="text-gray-600 text-lg">Manage and view all non-active donors in your organization</p>
            </div>
            <div class="flex justify-end space-x-4">
                <a href="{{ route('donors.index') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg font-semibold text-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Active Donors
                </a>
            </div>
        </div>
    </div>

    <!-- Professional Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-red-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-semibold text-gray-700 truncate">Total Non-Active</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $donors->total() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-semibold text-gray-700 truncate">Inactive Donors</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $donors->where('status', 'inactive')->count() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-red-600 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-semibold text-gray-700 truncate">Blocked Donors</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $donors->where('status', 'blocked')->count() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-gray-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-semibold text-gray-700 truncate">Deceased Donors</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $donors->where('status', 'deceased')->count() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Professional Search and View Controls -->
    <div class="bg-white shadow-lg rounded-xl border border-gray-100">
        <div class="px-8 py-6 border-b border-gray-100">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-6 lg:space-y-0">
                <!-- Enhanced Search Form - Single Line -->
                <form method="GET" action="{{ route('donors.blocked') }}" class="flex flex-col lg:flex-row space-y-4 lg:space-y-0 lg:space-x-4 flex-1">
                    <!-- Search Input -->
                    <div class="flex-1 min-w-0">
                        <label for="search" class="block text-sm font-semibold text-gray-800 mb-2">Search Donors</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                   placeholder="Search by name, email, phone, or address..."
                                   class="block w-full pl-12 pr-4 py-3 border border-gray-200 rounded-lg leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm shadow-sm transition-all duration-200">
                        </div>
                    </div>
                    
                    <!-- Donor Type Filter -->
                    <div class="w-full lg:w-40">
                        <label for="donor_type" class="block text-sm font-semibold text-gray-800 mb-2">Donor Type</label>
                        <div class="relative">
                            <select name="donor_type" id="donor_type" class="block w-full pl-4 pr-10 py-3 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white shadow-sm appearance-none cursor-pointer transition-all duration-200">
                                <option value="">All Types</option>
                                <option value="individual" {{ request('donor_type') == 'individual' ? 'selected' : '' }}>Individual</option>
                                <option value="corporate" {{ request('donor_type') == 'corporate' ? 'selected' : '' }}>Corporate</option>
                                <option value="foundation" {{ request('donor_type') == 'foundation' ? 'selected' : '' }}>Foundation</option>
                                <option value="church" {{ request('donor_type') == 'church' ? 'selected' : '' }}>Church</option>
                                <option value="anonymous" {{ request('donor_type') == 'anonymous' ? 'selected' : '' }}>Anonymous</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Status Filter -->
                    <div class="w-full lg:w-40">
                        <label for="status" class="block text-sm font-semibold text-gray-800 mb-2">Status</label>
                        <div class="relative">
                            <select name="status" id="status" class="block w-full pl-4 pr-10 py-3 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white shadow-sm appearance-none cursor-pointer transition-all duration-200">
                                <option value="">All Non-Active</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="blocked" {{ request('status') == 'blocked' ? 'selected' : '' }}>Blocked</option>
                                <option value="deceased" {{ request('status') == 'deceased' ? 'selected' : '' }}>Deceased</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Search Button -->
                    <div class="w-full lg:w-auto flex items-end">
                        <button type="submit" class="w-full lg:w-auto inline-flex justify-center items-center px-6 py-3 border border-transparent text-sm font-semibold rounded-lg text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-sm transition-all duration-200 transform hover:scale-105">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search
                        </button>
                    </div>
                </form>

                <!-- View Toggle Buttons on Right -->
                <div class="flex items-center space-x-3">
                    <span class="text-sm font-semibold text-gray-800">View Mode:</span>
                    <div class="bg-gray-50 rounded-lg p-1 border border-gray-200">
                        <button id="card-view-btn" class="view-toggle px-4 py-2 text-sm font-medium rounded-lg bg-white text-red-600 shadow-sm border border-gray-200 transition-all duration-200 hover:shadow-md">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            Cards
                        </button>
                        <button id="table-view-btn" class="view-toggle px-4 py-2 text-sm font-medium rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition-all duration-200">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            Table
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Professional Card View -->
        <div id="card-view" class="p-8">
            @if($donors->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($donors as $donor)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                    <!-- Card Header -->
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                                    @if($donor->profile_picture)
                                        <img src="{{ asset('storage/' . $donor->profile_picture) }}" alt="{{ $donor->name }}" class="w-12 h-12 rounded-full object-cover">
                                    @else
                                        <span class="text-lg font-semibold text-gray-600">{{ strtoupper(substr($donor->name, 0, 2)) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $donor->name }}</h3>
                                    <p class="text-sm text-gray-500">ID: {{ $donor->encrypted_donor_id }}</p>
                                </div>
                            </div>
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                @if($donor->status === 'inactive') bg-yellow-100 text-yellow-800
                                @elseif($donor->status === 'blocked') bg-red-100 text-red-800
                                @elseif($donor->status === 'deceased') bg-gray-100 text-gray-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($donor->status) }}
                            </span>
                        </div>
                        
                        <!-- Contact Info -->
                        <div class="space-y-2">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                {{ $donor->phone ?? 'No phone' }}
                            </div>
                            @if($donor->email)
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                {{ $donor->email }}
                            </div>
                            @endif
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $donor->city }}, {{ $donor->state }}
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer - Actions -->
                    <div class="flex items-center justify-between pt-4 px-4 pb-4 border-t border-gray-200">
                        <div class="flex space-x-2">
                            <button onclick="viewDonor({{ $donor->id }})" class="p-2 text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded-lg transition-colors" title="View Donor">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                            <button onclick="editDonor({{ $donor->id }})" class="p-2 text-indigo-600 hover:text-indigo-900 hover:bg-indigo-50 rounded-lg transition-colors" title="Edit Donor">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button onclick="showAuditLogs({{ $donor->id }})" class="p-2 text-purple-600 hover:text-purple-900 hover:bg-purple-50 rounded-lg transition-colors" title="View Audit Logs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="activateDonor({{ $donor->id }})" class="p-2 text-green-600 hover:text-green-900 hover:bg-green-50 rounded-lg transition-colors" title="Activate Donor">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </button>
                            <button onclick="deleteDonor({{ $donor->id }}, '{{ $donor->name }}')" class="p-2 text-red-600 hover:text-red-900 hover:bg-red-50 rounded-lg transition-colors" title="Delete Donor">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No non-active donors found</h3>
                <p class="mt-1 text-sm text-gray-500">All donors are currently active.</p>
            </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($donors->hasPages())
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $donors->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Include the same modals and scripts as the main donors page -->
@include('donors.partials.add-donor-modal')
@include('donors.partials.audit-logs-modal')

<script>
// View toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const cardViewBtn = document.getElementById('card-view-btn');
    const tableViewBtn = document.getElementById('table-view-btn');
    const cardView = document.getElementById('card-view');
    const tableView = document.getElementById('table-view');

    cardViewBtn.addEventListener('click', function() {
        cardView.classList.remove('hidden');
        tableView.classList.add('hidden');
        cardViewBtn.classList.add('bg-white', 'text-red-600', 'shadow-sm');
        cardViewBtn.classList.remove('text-gray-500');
        tableViewBtn.classList.remove('bg-white', 'text-red-600', 'shadow-sm');
        tableViewBtn.classList.add('text-gray-500');
    });

    tableViewBtn.addEventListener('click', function() {
        tableView.classList.remove('hidden');
        cardView.classList.add('hidden');
        tableViewBtn.classList.add('bg-white', 'text-red-600', 'shadow-sm');
        tableViewBtn.classList.remove('text-gray-500');
        cardViewBtn.classList.remove('bg-white', 'text-red-600', 'shadow-sm');
        cardViewBtn.classList.add('text-gray-500');
    });
});

// Donor action functions
function viewDonor(id) {
    window.location.href = `/donors/${id}`;
}

function editDonor(id) {
    window.location.href = `/donors/${id}/edit`;
}

function activateDonor(id) {
    if (confirm('Are you sure you want to activate this donor?')) {
        fetch(`/donors/${id}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ status: 'active' })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error activating donor');
            }
        });
    }
}

function deleteDonor(id, name) {
    if (confirm(`Are you sure you want to delete donor "${name}"? This action cannot be undone.`)) {
        fetch(`/donors/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error deleting donor');
            }
        });
    }
}

function showAuditLogs(id) {
    fetch(`/donors/${id}/audit-logs`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Populate audit logs modal
                const modal = document.getElementById('audit-logs-modal');
                const logsContainer = document.getElementById('audit-logs-container');
                logsContainer.innerHTML = '';
                
                data.logs.forEach(log => {
                    const logItem = document.createElement('div');
                    logItem.className = 'p-4 border-b border-gray-200 last:border-b-0';
                    logItem.innerHTML = `
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">${log.description}</p>
                                <p class="text-xs text-gray-500">${new Date(log.created_at).toLocaleString()}</p>
                            </div>
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                ${log.action}
                            </span>
                        </div>
                    `;
                    logsContainer.appendChild(logItem);
                });
                
                modal.classList.remove('hidden');
            }
        });
}

// Close audit logs modal
function closeAuditLogsModal() {
    document.getElementById('audit-logs-modal').classList.add('hidden');
}
</script>
@endsection
