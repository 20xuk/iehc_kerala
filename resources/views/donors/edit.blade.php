@extends('layouts.app')

@section('title', 'Edit Donor - ' . $donor->name)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Professional Header -->
    <div class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-6">
                <div class="flex items-center justify-between">
                    <!-- Back Button and Title -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('donors.show', $donor) }}" class="p-2 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Edit Donor Profile</h1>
                            <p class="text-sm text-gray-600">Update information for {{ $donor->name }}</p>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('donors.show', $donor) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Cancel
                        </a>
                        <button type="submit" form="edit-donor-form" class="inline-flex items-center px-6 py-2 bg-blue-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form id="edit-donor-form" action="{{ route('donors.update', $donor) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Left Sidebar - Profile Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden sticky top-8">
                        <!-- Profile Header -->
                        <div class="relative bg-gradient-to-r from-blue-600 to-purple-600 p-6">
                            <div class="text-center">
                                <!-- Avatar Section -->
                                <div class="relative inline-block">
                                    <div class="w-32 h-32 rounded-full bg-white p-2 shadow-lg mx-auto">
                                        <div class="w-full h-full rounded-full overflow-hidden bg-gray-200">
                                            @if($donor->profile_picture)
                                                <img src="{{ asset('storage/' . $donor->profile_picture) }}" 
                                                     alt="{{ $donor->name }}" 
                                                     class="w-full h-full object-cover"
                                                     id="profile-avatar-preview"
                                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-300 to-gray-400" style="display: {{ $donor->profile_picture ? 'none' : 'flex' }};">
                                                    <span class="text-4xl font-bold text-gray-600">
                                                        {{ strtoupper(substr($donor->name, 0, 2)) }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Upload Button -->
                                    <button type="button" onclick="document.getElementById('profile_picture').click()" 
                                            class="absolute bottom-0 right-0 bg-white rounded-full p-2 shadow-lg hover:shadow-xl transition-all duration-200 border-2 border-blue-600">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </button>
                                </div>
                                
                                <!-- Donor Info -->
                                <div class="mt-4 text-white">
                                    <h2 class="text-xl font-bold">{{ $donor->name }}</h2>
                                    <p class="text-blue-100 text-sm">Donor ID: {{ $donor->encrypted_donor_id }}</p>
                                    <p class="text-blue-100 text-sm">Member since {{ $donor->created_at->format('M Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Picture Upload -->
                        <div class="p-6">
                            <div class="space-y-4">
                                <div>
                                    <label for="profile_picture" class="block text-sm font-semibold text-gray-800 mb-2">Profile Picture</label>
                                    <input type="file" name="profile_picture" id="profile_picture" accept="image/*" 
                                           class="hidden" onchange="previewProfilePicture(this)">
                                    <div class="flex items-center justify-center w-full">
                                        <label for="profile_picture" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                </svg>
                                                <p class="mb-2 text-sm text-gray-500">
                                                    <span class="font-semibold">Click to upload</span> or drag and drop
                                                </p>
                                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Status Badges -->
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium text-gray-700">Status</span>
                                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full 
                                            @if($donor->status === 'active') bg-green-100 text-green-800
                                            @elseif($donor->status === 'blocked') bg-red-100 text-red-800
                                            @elseif($donor->status === 'deceased') bg-gray-100 text-gray-800
                                            @else bg-yellow-100 text-yellow-800 @endif">
                                            {{ ucfirst($donor->status) }}
                                        </span>
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium text-gray-700">Type</span>
                                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full 
                                            @if($donor->donor_type === 'individual') bg-blue-100 text-blue-800
                                            @elseif($donor->donor_type === 'corporate') bg-purple-100 text-purple-800
                                            @elseif($donor->donor_type === 'foundation') bg-yellow-100 text-yellow-800
                                            @elseif($donor->donor_type === 'church') bg-green-100 text-green-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($donor->donor_type) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-3 space-y-6">
                    <!-- Personal Information Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Personal Information
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="first_name" class="block text-sm font-semibold text-gray-800 mb-2">First Name *</label>
                                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $donor->first_name) }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    @error('first_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="last_name" class="block text-sm font-semibold text-gray-800 mb-2">Last Name *</label>
                                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $donor->last_name) }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    @error('last_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-semibold text-gray-800 mb-2">Email Address</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $donor->email) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-semibold text-gray-800 mb-2">Phone Number *</label>
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone', $donor->phone) }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone_alt1" class="block text-sm font-semibold text-gray-800 mb-2">Alternative Phone 1</label>
                                    <input type="tel" name="phone_alt1" id="phone_alt1" value="{{ old('phone_alt1', $donor->phone_alt1) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    @error('phone_alt1')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone_alt2" class="block text-sm font-semibold text-gray-800 mb-2">Alternative Phone 2</label>
                                    <input type="tel" name="phone_alt2" id="phone_alt2" value="{{ old('phone_alt2', $donor->phone_alt2) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    @error('phone_alt2')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="gender" class="block text-sm font-semibold text-gray-800 mb-2">Gender</label>
                                    <select name="gender" id="gender" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender', $donor->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', $donor->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender', $donor->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="marital_status" class="block text-sm font-semibold text-gray-800 mb-2">Marital Status</label>
                                    <select name="marital_status" id="marital_status" onchange="toggleWeddingDate()" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                        <option value="">Select Marital Status</option>
                                        <option value="single" {{ old('marital_status', $donor->marital_status) == 'single' ? 'selected' : '' }}>Single</option>
                                        <option value="married" {{ old('marital_status', $donor->marital_status) == 'married' ? 'selected' : '' }}>Married</option>
                                        <option value="divorced" {{ old('marital_status', $donor->marital_status) == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                        <option value="widowed" {{ old('marital_status', $donor->marital_status) == 'widowed' ? 'selected' : '' }}>Widowed</option>
                                    </select>
                                    @error('marital_status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="date_of_birth" class="block text-sm font-semibold text-gray-800 mb-2">Date of Birth</label>
                                    <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $donor->date_of_birth ? $donor->date_of_birth->format('Y-m-d') : '') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    @error('date_of_birth')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div id="wedding-date-field" class="{{ old('marital_status', $donor->marital_status) == 'married' ? '' : 'hidden' }}">
                                    <label for="wedding_date" class="block text-sm font-semibold text-gray-800 mb-2">Wedding Date</label>
                                    <input type="date" name="wedding_date" id="wedding_date" value="{{ old('wedding_date', $donor->wedding_date ? $donor->wedding_date->format('Y-m-d') : '') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    @error('wedding_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="occupation" class="block text-sm font-semibold text-gray-800 mb-2">Occupation</label>
                                    <input type="text" name="occupation" id="occupation" value="{{ old('occupation', $donor->occupation) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    @error('occupation')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="company" class="block text-sm font-semibold text-gray-800 mb-2">Company/Organization</label>
                                    <input type="text" name="company" id="company" value="{{ old('company', $donor->company) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    @error('company')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                                                 <div>
                                     <label for="amount_promised" class="block text-sm font-semibold text-gray-800 mb-2">Amount Promised</label>
                                     <input type="number" step="0.01" name="amount_promised" id="amount_promised" value="{{ old('amount_promised', $donor->amount_promised) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="Enter amount promised">
                                     @error('amount_promised')
                                         <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                     @enderror
                                 </div>

                                 <div>
                                     <label for="status" class="block text-sm font-semibold text-gray-800 mb-2">Status *</label>
                                     <select name="status" id="status" required class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                         <option value="active" {{ old('status', $donor->status) == 'active' ? 'selected' : '' }}>Active</option>
                                         <option value="inactive" {{ old('status', $donor->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                         <option value="blocked" {{ old('status', $donor->status) == 'blocked' ? 'selected' : '' }}>Blocked</option>
                                         <option value="deceased" {{ old('status', $donor->status) == 'deceased' ? 'selected' : '' }}>Deceased</option>
                                     </select>
                                     @error('status')
                                         <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                     @enderror
                                 </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address Information Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Address Information
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-6">
                                <div>
                                    <label for="address_line_1" class="block text-sm font-semibold text-gray-800 mb-2">Address Line 1 *</label>
                                    <input type="text" name="address_line_1" id="address_line_1" value="{{ old('address_line_1', $donor->address_line_1) }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    @error('address_line_1')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="address_line_2" class="block text-sm font-semibold text-gray-800 mb-2">Address Line 2</label>
                                    <input type="text" name="address_line_2" id="address_line_2" value="{{ old('address_line_2', $donor->address_line_2) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    @error('address_line_2')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="city" class="block text-sm font-semibold text-gray-800 mb-2">City *</label>
                                        <input type="text" name="city" id="city" value="{{ old('city', $donor->city) }}" required
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                        @error('city')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="state" class="block text-sm font-semibold text-gray-800 mb-2">State/Province *</label>
                                        <input type="text" name="state" id="state" value="{{ old('state', $donor->state) }}" required
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                        @error('state')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="postal_code" class="block text-sm font-semibold text-gray-800 mb-2">Postal Code</label>
                                        <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $donor->postal_code) }}"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                        @error('postal_code')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="country_id" class="block text-sm font-semibold text-gray-800 mb-2">Country</label>
                                        <select name="country_id" id="country_id" onchange="loadRegions(this.value)" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                            <option value="">Select Country</option>
                                            @foreach(($countries ?? []) as $id => $name)
                                                <option value="{{ $id }}" {{ old('country_id', $donor->country_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="region_id" class="block text-sm font-semibold text-gray-800 mb-2">Region</label>
                                        <select name="region_id" id="region_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                            <option value="">Select Region</option>
                                            @if($donor->region)
                                                <option value="{{ $donor->region->id }}" selected>{{ $donor->region->name }}</option>
                                            @endif
                                        </select>
                                        @error('region_id')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Donor Details Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                Donor Details
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="donor_type" class="block text-sm font-semibold text-gray-800 mb-2">Donor Type *</label>
                                    <select name="donor_type" id="donor_type" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                        <option value="">Select Donor Type</option>
                                        <option value="individual" {{ old('donor_type', $donor->donor_type) == 'individual' ? 'selected' : '' }}>Individual</option>
                                        <option value="corporate" {{ old('donor_type', $donor->donor_type) == 'corporate' ? 'selected' : '' }}>Corporate</option>
                                        <option value="foundation" {{ old('donor_type', $donor->donor_type) == 'foundation' ? 'selected' : '' }}>Foundation</option>
                                        <option value="church" {{ old('donor_type', $donor->donor_type) == 'church' ? 'selected' : '' }}>Church</option>
                                        <option value="anonymous" {{ old('donor_type', $donor->donor_type) == 'anonymous' ? 'selected' : '' }}>Anonymous</option>
                                    </select>
                                    @error('donor_type')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="donation_frequency" class="block text-sm font-semibold text-gray-800 mb-2">Donation Frequency</label>
                                    <select name="donation_frequency" id="donation_frequency" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                        <option value="">Select Frequency</option>
                                        <option value="weekly" {{ old('donation_frequency', $donor->donation_frequency) == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                        <option value="bi_monthly" {{ old('donation_frequency', $donor->donation_frequency) == 'bi_monthly' ? 'selected' : '' }}>Bi-Monthly</option>
                                        <option value="monthly" {{ old('donation_frequency', $donor->donation_frequency) == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                        <option value="quarterly" {{ old('donation_frequency', $donor->donation_frequency) == 'quarterly' ? 'selected' : '' }}>Quarterly</option>
                                        <option value="half_yearly" {{ old('donation_frequency', $donor->donation_frequency) == 'half_yearly' ? 'selected' : '' }}>Half Yearly</option>
                                        <option value="yearly" {{ old('donation_frequency', $donor->donation_frequency) == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                        <option value="one_time" {{ old('donation_frequency', $donor->donation_frequency) == 'one_time' ? 'selected' : '' }}>One Time</option>
                                        <option value="on_demand" {{ old('donation_frequency', $donor->donation_frequency) == 'on_demand' ? 'selected' : '' }}>On Demand</option>
                                        <option value="special_occasion" {{ old('donation_frequency', $donor->donation_frequency) == 'special_occasion' ? 'selected' : '' }}>Special Occasion</option>
                                        <option value="festival" {{ old('donation_frequency', $donor->donation_frequency) == 'festival' ? 'selected' : '' }}>Festival</option>
                                        <option value="anniversary" {{ old('donation_frequency', $donor->donation_frequency) == 'anniversary' ? 'selected' : '' }}>Anniversary</option>
                                        <option value="birthday" {{ old('donation_frequency', $donor->donation_frequency) == 'birthday' ? 'selected' : '' }}>Birthday</option>
                                        <option value="other" {{ old('donation_frequency', $donor->donation_frequency) == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('donation_frequency')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="notes" class="block text-sm font-semibold text-gray-800 mb-2">Notes</label>
                                    <textarea name="notes" id="notes" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="Additional notes about the donor">{{ old('notes', $donor->notes) }}</textarea>
                                    @error('notes')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons with Proper Margins -->
            <div class="mt-8 mb-8 px-6 py-4 bg-gray-50 rounded-xl border border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                        <a href="{{ route('donors.show', $donor) }}" 
                           class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg font-semibold text-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            View Details
                        </a>
                        <a href="{{ route('donors.index') }}" 
                           class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg font-semibold text-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to List
                        </a>
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                        <button type="button" onclick="document.getElementById('edit-donor-form').reset()" 
                                class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg font-semibold text-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset Form
                        </button>
                        <button type="submit" 
                                class="inline-flex items-center px-8 py-3 border border-transparent rounded-lg font-semibold text-sm text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Donor
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Profile picture preview functionality
function previewProfilePicture(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('profile-avatar-preview');
            if (preview) {
                preview.src = e.target.result;
            } else {
                // If no preview exists, create one
                const avatarContainer = document.querySelector('.w-32.h-32 .w-full.h-full');
                avatarContainer.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover" id="profile-avatar-preview">`;
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Function to toggle wedding date field based on marital status
function toggleWeddingDate() {
    const maritalStatus = document.getElementById('marital_status').value;
    const weddingDateField = document.getElementById('wedding-date-field');
    const weddingDateInput = document.getElementById('wedding_date');
    
    if (maritalStatus === 'married') {
        weddingDateField.classList.remove('hidden');
        weddingDateInput.required = true;
    } else {
        weddingDateField.classList.add('hidden');
        weddingDateInput.required = false;
        weddingDateInput.value = ''; // Clear the value when hidden
    }
}

// Function to load regions based on selected country
function loadRegions(countryId) {
    const regionSelect = document.getElementById('region_id');
    regionSelect.innerHTML = '<option value="">Loading regions...</option>';
    
    if (!countryId) {
        regionSelect.innerHTML = '<option value="">Select Region</option>';
        return;
    }
    
    fetch(`/api/regions/${countryId}`)
        .then(response => response.json())
        .then(data => {
            regionSelect.innerHTML = '<option value="">Select Region</option>';
            Object.keys(data).forEach(id => {
                const option = document.createElement('option');
                option.value = id;
                option.textContent = data[id];
                regionSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error loading regions:', error);
            regionSelect.innerHTML = '<option value="">Error loading regions</option>';
        });
}

// Initialize wedding date field visibility on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleWeddingDate();
});
</script>
@endsection
