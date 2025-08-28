@extends('layouts.app')


@section('title', 'Donor Management')

@section('content')
<div class="space-y-6">
    <!-- Professional Header with Add Donor Button -->
    <div class="bg-white border-b border-gray-200 pb-8 pt-6 px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Donor Management</h1>
                <p class="text-gray-600 text-lg">Manage and view all donors in your organization</p>
            </div>
            <div class="flex justify-end space-x-4">
                <a href="{{ route('donors.blocked') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg font-semibold text-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                    </svg>
                    Blocked/Inactive Donors
                </a>
                <button type="button" onclick="openDonorModal()" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 border border-transparent rounded-full font-semibold text-sm text-white shadow-lg hover:shadow-xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Donor
                </button>
            </div>
        </div>
    </div>

    <!-- Professional Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-semibold text-gray-700 truncate">Total Donors</dt>
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
                        <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-semibold text-gray-700 truncate">Active Donors</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $donors->where('status', 'active')->count() }}</dd>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-semibold text-gray-700 truncate">Named Donors</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $donors->where('donor_type', 'named')->count() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-semibold text-gray-700 truncate">Regions</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $donors->unique('state')->count() }}</dd>
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
                <form method="GET" action="{{ route('donors.index') }}" class="flex flex-col lg:flex-row space-y-4 lg:space-y-0 lg:space-x-4 flex-1">
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
                                <option value="">Active Only</option>
                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Donors</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
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
                        <button type="submit" class="w-full lg:w-auto inline-flex justify-center items-center px-6 py-3 border border-transparent text-sm font-semibold rounded-lg text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-all duration-200 transform hover:scale-105">
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
                        <button id="card-view-btn" class="view-toggle px-4 py-2 text-sm font-medium rounded-lg bg-white text-blue-600 shadow-sm border border-gray-200 transition-all duration-200 hover:shadow-md">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            Cards
                        </button>
                        <button id="table-view-btn" class="view-toggle px-4 py-2 text-sm font-medium rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition-all duration-200">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Table
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Results Count -->
        <div class="px-8 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-700 font-medium">
                    Showing {{ $donors->firstItem() ?? 0 }} to {{ $donors->lastItem() ?? 0 }} of {{ $donors->total() }} donors
                </div>
                <div class="text-sm text-gray-500">
                    {{ $donors->count() }} donors per page
                </div>
            </div>
        </div>

        <!-- Professional Card View -->
        <div id="card-view" class="p-8">
            @if($donors->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($donors as $donor)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="p-6">
                        <!-- Donor Header -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-semibold text-gray-700">{{ strtoupper(substr($donor->name, 0, 2)) }}</span>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $donor->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $donor->donor_type == 'named' ? 'Named Donor' : 'Anonymous' }}</p>
                                </div>
                            </div>
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                @if($donor->status === 'active') bg-green-100 text-green-800
                                @elseif($donor->status === 'blocked') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($donor->status) }}
                            </span>
                        </div>

                        <!-- Contact Information -->
                        <div class="space-y-2 mb-4">
                            @if($donor->mobile_main)
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                {{ $donor->mobile_main }}
                            </div>
                            @endif
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

                        <!-- Actions -->
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
                                <button onclick="showEmailModal({{ $donor->id }})" class="p-2 text-green-600 hover:text-green-900 hover:bg-green-50 rounded-lg transition-colors" title="Send Email">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
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
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No donors found</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by creating a new donor.</p>
                <div class="mt-6">
                    <a href="{{ route('donors.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Donor
                    </a>
                </div>
            </div>
            @endif
        </div>

        <!-- Professional Table View -->
        <div id="table-view" class="hidden">
            @if($donors->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Donor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($donors as $donor)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                            <span class="text-sm font-medium text-gray-700">{{ strtoupper(substr($donor->name, 0, 2)) }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $donor->name }}</div>
                                        <div class="text-sm text-gray-500">ID: {{ $donor->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $donor->mobile_main ?? 'N/A' }}</div>
                                <div class="text-sm text-gray-500">{{ $donor->email ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $donor->city }}, {{ $donor->state }}</div>
                                <div class="text-sm text-gray-500">{{ $donor->pincode }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($donor->donor_type === 'named') bg-blue-100 text-blue-800 @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($donor->donor_type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($donor->status === 'active') bg-green-100 text-green-800
                                    @elseif($donor->status === 'blocked') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($donor->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button onclick="viewDonor({{ $donor->id }})" class="p-1.5 text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded transition-colors" title="View Donor">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="editDonor({{ $donor->id }})" class="p-1.5 text-indigo-600 hover:text-indigo-900 hover:bg-indigo-50 rounded transition-colors" title="Edit Donor">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="showAuditLogs({{ $donor->id }})" class="p-1.5 text-purple-600 hover:text-purple-900 hover:bg-purple-50 rounded transition-colors" title="View Audit Logs">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="showEmailModal({{ $donor->id }})" class="p-1.5 text-green-600 hover:text-green-900 hover:bg-green-50 rounded transition-colors" title="Send Email">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </button>
                                    <button onclick="deleteDonor({{ $donor->id }}, '{{ $donor->name }}')" class="p-1.5 text-red-600 hover:text-red-900 hover:bg-red-50 rounded transition-colors" title="Delete Donor">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No donors found</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by creating a new donor.</p>
                <div class="mt-6">
                    <a href="{{ route('donors.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Donor
                    </a>
                </div>
            </div>
            @endif
        </div>

        <!-- Professional Pagination -->
        @if($donors->hasPages())
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $donors->links() }}
        </div>
        @endif
    </div>
</div>

@include('donors.partials.add-donor-modal')

<!-- Simple Test Modal -->
<div id="test-modal" class="fixed inset-0 z-[9999] hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-xl max-w-md w-full mx-4">
        <h3 class="text-lg font-semibold mb-4">Test Modal</h3>
        <p class="mb-4">This is a simple test modal to verify modal functionality.</p>
        <button onclick="closeTestModal()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Close</button>
    </div>
</div>

<!-- Professional Email Modal -->
<div id="email-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Send Email to Donor</h3>
                <button onclick="closeEmailModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="email-form" method="POST" action="#" class="space-y-4">
                @csrf
                <div>
                    <label for="email-subject" class="block text-sm font-medium text-gray-700">Subject</label>
                    <input type="text" name="subject" id="email-subject" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="email-message" class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea name="message" id="email-message" rows="4" required
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeEmailModal()" 
                            class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Send Email
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Professional Audit Logs Modal -->
<div id="audit-logs-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-4xl max-w-4xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Audit Logs</h3>
                <button onclick="closeAuditLogsModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="audit-logs-content" class="max-h-96 overflow-y-auto">
                <!-- Audit logs will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
// Test function to debug modal
function testModal() {
    console.log('Test modal function called');
    const modal = document.getElementById('donor-modal');
    console.log('Modal element:', modal);
    if (modal) {
        console.log('Modal classes:', modal.className);
        console.log('Modal style display:', modal.style.display);
        console.log('Modal hidden class:', modal.classList.contains('hidden'));
    }
    openDonorModal();
}

// Simple test modal functions
function openTestModal() {
    console.log('Opening test modal...');
    const testModal = document.getElementById('test-modal');
    console.log('Test modal element:', testModal);
    if (testModal) {
        testModal.classList.remove('hidden');
        console.log('Test modal opened');
    } else {
        console.error('Test modal not found');
    }
}

function closeTestModal() {
    console.log('Closing test modal...');
    const testModal = document.getElementById('test-modal');
    if (testModal) {
        testModal.classList.add('hidden');
        console.log('Test modal closed');
    }
}

// Modal functions - defined here to ensure they're accessible
function openDonorModal() {
    console.log('Opening donor modal...');
    const modal = document.getElementById('donor-modal');
    if (!modal) {
        console.error('Modal not found!');
        return;
    }
    console.log('Modal found, removing hidden class...');
    modal.classList.remove('hidden');
    modal.style.display = 'block';
    modal.style.opacity = '0';
    modal.style.transform = 'scale(0.95)';
    setTimeout(() => {
        modal.style.opacity = '1';
        modal.style.transform = 'scale(1)';
        const first = document.getElementById('first_name');
        if (first) first.focus();
    }, 10);
    console.log('Modal opened successfully');
}

function closeDonorModal() {
    console.log('Closing donor modal...');
    const modal = document.getElementById('donor-modal');
    if (!modal) {
        console.error('Modal not found!');
        return;
    }
    modal.style.opacity = '0';
    modal.style.transform = 'scale(0.95)';
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.style.display = 'none';
    }, 200);
    console.log('Modal closed successfully');
}

document.addEventListener('DOMContentLoaded', function() {
    // Check if modal exists on page load
    const modal = document.getElementById('donor-modal');
    console.log('Page loaded. Modal element:', modal);
    if (modal) {
        console.log('Modal found on page load');
        console.log('Modal classes:', modal.className);
    } else {
        console.error('Modal not found on page load!');
    }
    
    // Professional view toggle functionality
    const cardViewBtn = document.getElementById('card-view-btn');
    const tableViewBtn = document.getElementById('table-view-btn');
    const cardView = document.getElementById('card-view');
    const tableView = document.getElementById('table-view');

    cardViewBtn.addEventListener('click', function() {
        cardView.classList.remove('hidden');
        tableView.classList.add('hidden');
        cardViewBtn.classList.add('bg-white', 'text-blue-600', 'shadow-sm', 'border', 'border-gray-200');
        cardViewBtn.classList.remove('text-gray-500');
        tableViewBtn.classList.remove('bg-white', 'text-blue-600', 'shadow-sm', 'border', 'border-gray-200');
        tableViewBtn.classList.add('text-gray-500');
    });

    tableViewBtn.addEventListener('click', function() {
        tableView.classList.remove('hidden');
        cardView.classList.add('hidden');
        tableViewBtn.classList.add('bg-white', 'text-blue-600', 'shadow-sm', 'border', 'border-gray-200');
        tableViewBtn.classList.remove('text-gray-500');
        cardViewBtn.classList.remove('bg-white', 'text-blue-600', 'shadow-sm', 'border', 'border-gray-200');
        cardViewBtn.classList.add('text-gray-500');
    });
});

function showEmailModal(donorId) {
    const modal = document.getElementById('email-modal');
    const form = document.getElementById('email-form');
    form.action = `/donors/${donorId}/email`;
    modal.classList.remove('hidden');
}

function closeEmailModal() {
    const modal = document.getElementById('email-modal');
    modal.classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('email-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEmailModal();
    }
});

// Donor action functions
function viewDonor(donorId) {
    window.location.href = `/donors/${donorId}`;
}

function editDonor(donorId) {
    window.location.href = `/donors/${donorId}/edit`;
}

function deleteDonor(donorId, donorName) {
    if (confirm(`Are you sure you want to delete donor "${donorName}"?`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/donors/${donorId}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}

function showAuditLogs(donorId) {
    const modal = document.getElementById('audit-logs-modal');
    const content = document.getElementById('audit-logs-content');
    
    // Show loading
    content.innerHTML = '<div class="text-center py-8"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto"></div><p class="mt-2 text-gray-600">Loading audit logs...</p></div>';
    modal.classList.remove('hidden');
    
    // Fetch audit logs
    fetch(`/donors/${donorId}/audit-logs`)
        .then(response => response.json())
        .then(data => {
            if (data.logs && data.logs.length > 0) {
                let html = '<div class="space-y-4">';
                data.logs.forEach(log => {
                    const actionColor = {
                        'donor.created': 'bg-green-100 text-green-800',
                        'donor.updated': 'bg-blue-100 text-blue-800',
                        'donor.deleted': 'bg-red-100 text-red-800'
                    }[log.action] || 'bg-gray-100 text-gray-800';
                    
                    html += `
                        <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-blue-500">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center space-x-2">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full ${actionColor}">
                                        ${log.action.replace('donor.', '').toUpperCase()}
                                    </span>
                                    <span class="text-sm text-gray-600">by ${log.user ? log.user.name : 'System'}</span>
                                </div>
                                <span class="text-xs text-gray-500">${new Date(log.created_at).toLocaleString()}</span>
                            </div>
                            <div class="text-sm text-gray-700">
                                ${log.description || 'No description available'}
                            </div>
                        </div>
                    `;
                });
                html += '</div>';
                content.innerHTML = html;
            } else {
                content.innerHTML = '<div class="text-center py-8 text-gray-600">No audit logs found for this donor.</div>';
            }
        })
        .catch(error => {
            content.innerHTML = '<div class="text-center py-8 text-red-600">Error loading audit logs. Please try again.</div>';
            console.error('Error:', error);
        });
}

function closeAuditLogsModal() {
    const modal = document.getElementById('audit-logs-modal');
    modal.classList.add('hidden');
}

// Close audit logs modal when clicking outside
document.getElementById('audit-logs-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAuditLogsModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const emailModal = document.getElementById('email-modal');
        const auditModal = document.getElementById('audit-logs-modal');
        if (!emailModal.classList.contains('hidden')) {
            closeEmailModal();
        }
        if (!auditModal.classList.contains('hidden')) {
            closeAuditLogsModal();
        }
    }
});
</script>
@endsection
