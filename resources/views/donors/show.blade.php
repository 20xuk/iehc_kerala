@extends('layouts.app')

@section('title', 'Donor Details - ' . $donor->name)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Professional Header with Theme Support -->
    <div class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-6">
                <div class="flex items-center justify-between">
                    <!-- Back Button and Title -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('donors.index') }}" class="p-2 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Donor Profile</h1>
                            <p class="text-sm text-gray-600">Manage donor information and activities</p>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-3">
                        <button onclick="showEmailModal({{ $donor->id }})" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Send Email
                        </button>
                        <a href="{{ route('donors.edit', $donor) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Left Sidebar - Profile Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
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
                                                  id="profile-avatar"
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
                                <button onclick="openAvatarUpload()" 
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

                    <!-- Status Badges -->
                    <div class="p-6">
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

                            @if($donor->is_anonymous)
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">Visibility</span>
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Anonymous
                                </span>
                            </div>
                            @endif

                            @if($donor->amount_promised)
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">Amount Promised</span>
                                <span class="text-sm font-semibold text-green-600">
                                    ₹{{ number_format($donor->amount_promised, 2) }}
                                </span>
                            </div>
                            @endif
                        </div>

                        <!-- Quick Stats -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h3 class="text-sm font-semibold text-gray-900 mb-3">Donation Summary</h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Total Donations</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ $donor->donation_count }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Total Amount</span>
                                    <span class="text-sm font-semibold text-green-600">₹{{ number_format($donor->total_donations, 2) }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Average Donation</span>
                                    <span class="text-sm font-semibold text-blue-600">₹{{ number_format($donor->average_donation, 2) }}</span>
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
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1">Full Name</label>
                                    <p class="text-sm text-gray-900">{{ $donor->name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1">Email Address</label>
                                    <p class="text-sm text-gray-900">{{ $donor->email ?? 'Not provided' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1">Primary Phone</label>
                                    <p class="text-sm text-gray-900">{{ $donor->phone ?? 'Not provided' }}</p>
                                </div>
                                @if($donor->phone_alt1)
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1">Alternative Phone 1</label>
                                    <p class="text-sm text-gray-900">{{ $donor->phone_alt1 }}</p>
                                </div>
                                @endif
                                @if($donor->phone_alt2)
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1">Alternative Phone 2</label>
                                    <p class="text-sm text-gray-900">{{ $donor->phone_alt2 }}</p>
                                </div>
                                @endif
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1">Gender</label>
                                    <p class="text-sm text-gray-900">{{ ucfirst($donor->gender) ?? 'Not specified' }}</p>
                                </div>
                                @if($donor->marital_status)
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1">Marital Status</label>
                                    <p class="text-sm text-gray-900">{{ ucfirst($donor->marital_status) }}</p>
                                </div>
                                @endif
                                @if($donor->date_of_birth)
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1">Date of Birth</label>
                                    <p class="text-sm text-gray-900">{{ $donor->date_of_birth->format('M d, Y') }}</p>
                                </div>
                                @endif
                                @if($donor->wedding_date)
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1">Wedding Date</label>
                                    <p class="text-sm text-gray-900">{{ $donor->wedding_date->format('M d, Y') }}</p>
                                </div>
                                @endif
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1">Occupation</label>
                                    <p class="text-sm text-gray-900">{{ $donor->occupation ?? 'Not provided' }}</p>
                                </div>
                                @if($donor->company)
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1">Company/Organization</label>
                                    <p class="text-sm text-gray-900">{{ $donor->company }}</p>
                                </div>
                                @endif
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
                        <div class="space-y-4">
                            <div>
                                                            <label class="block text-sm font-semibold text-gray-800 mb-1">Complete Address</label>
                            <p class="text-sm text-gray-900">{{ $donor->full_address }}</p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1">City</label>
                                    <p class="text-sm text-gray-900">{{ $donor->city ?? 'Not provided' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1">State/Province</label>
                                    <p class="text-sm text-gray-900">{{ $donor->state ?? 'Not provided' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1">Postal Code</label>
                                    <p class="text-sm text-gray-900">{{ $donor->postal_code ?? 'Not provided' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1">Country</label>
                                    <p class="text-sm text-gray-900">{{ $donor->country->name ?? $donor->country ?? 'India' }}</p>
                                </div>
                                @if($donor->region)
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-1">Region</label>
                                    <p class="text-sm text-gray-900">{{ $donor->region->name ?? 'Not provided' }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Donation History Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            Recent Donations
                        </h3>
                    </div>
                    <div class="p-6">
                        @if($donor->collections->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Receipt</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($donor->collections->take(10) as $collection)
                                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <a href="{{ route('collections.show', $collection) }}" class="text-blue-600 hover:text-blue-900">
                                                    {{ $collection->receipt_number }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $collection->collection_date->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ ucfirst(str_replace('_', ' ', $collection->donation_type)) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">
                                                ₹{{ number_format($collection->total_amount, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                    @if($collection->status === 'active') bg-green-100 text-green-800
                                                    @elseif($collection->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst($collection->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($donor->collections->count() > 10)
                                <div class="mt-4 text-center">
                                    <a href="#" class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                        View all {{ $donor->collections->count() }} donations →
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No donations yet</h3>
                                <p class="mt-1 text-sm text-gray-500">This donor hasn't made any donations yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Avatar Upload Modal -->
<div id="avatar-upload-modal" class="fixed inset-0 z-[9999] hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Update Profile Picture</h3>
        </div>
        <div class="p-6">
            <form id="avatar-upload-form" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Image</label>
                        <input type="file" id="avatar-input" name="profile_picture" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <div id="avatar-preview" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                        <div class="w-32 h-32 rounded-full overflow-hidden bg-gray-200 mx-auto">
                            <img id="preview-image" class="w-full h-full object-cover" src="" alt="Preview">
                        </div>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeAvatarUpload()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Cancel
                    </button>
                    <button type="submit" id="upload-btn" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Email Modal -->
<div id="email-modal" class="fixed inset-0 z-[9999] hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Send Email to {{ $donor->name }}</h3>
        </div>
        <div class="p-6">
            <form id="email-form" method="POST" action="#">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="email-subject" class="block text-sm font-medium text-gray-700">Subject</label>
                        <input type="text" name="subject" id="email-subject" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="email-message" class="block text-sm font-medium text-gray-700">Message</label>
                        <textarea name="message" id="email-message" rows="4" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeEmailModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Send Email
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Avatar upload functionality
function openAvatarUpload() {
    document.getElementById('avatar-upload-modal').classList.remove('hidden');
}

function closeAvatarUpload() {
    document.getElementById('avatar-upload-modal').classList.add('hidden');
    document.getElementById('avatar-input').value = '';
    document.getElementById('avatar-preview').classList.add('hidden');
}

// Preview image before upload
document.getElementById('avatar-input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
            document.getElementById('avatar-preview').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
});

// Handle avatar upload
document.getElementById('avatar-upload-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    formData.append('donor_id', {{ $donor->id }});
    
    const uploadBtn = document.getElementById('upload-btn');
    uploadBtn.disabled = true;
    uploadBtn.textContent = 'Uploading...';
    
    fetch('/donors/{{ $donor->id }}/upload-avatar', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the avatar on the page
            const avatarImg = document.getElementById('profile-avatar');
            if (avatarImg) {
                avatarImg.src = data.avatar_url;
            } else {
                // If no image exists, create one
                const avatarContainer = document.querySelector('.w-32.h-32 .w-full.h-full');
                avatarContainer.innerHTML = `<img src="${data.avatar_url}" alt="${data.donor_name}" class="w-full h-full object-cover" id="profile-avatar">`;
            }
            closeAvatarUpload();
            showNotification('Profile picture updated successfully!', 'success');
        } else {
            showNotification(data.message || 'Error uploading image', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Error uploading image. Please try again.', 'error');
    })
    .finally(() => {
        uploadBtn.disabled = false;
        uploadBtn.textContent = 'Upload';
    });
});

// Email modal functions
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

// Close modals when clicking outside
document.getElementById('avatar-upload-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeAvatarUpload();
    }
});

document.getElementById('email-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEmailModal();
    }
});

// Close modals with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeAvatarUpload();
        closeEmailModal();
    }
});

// Notification function
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm transform transition-all duration-300 translate-x-full`;
    
    const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
    notification.classList.add(bgColor, 'text-white');
    
    notification.innerHTML = `
        <div class="flex items-center">
            <div class="flex-shrink-0">
                ${type === 'success' ? '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586l-1.293-1.293a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>' :
                  type === 'error' ? '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>' :
                  '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>'}
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">${message}</p>
            </div>
            <div class="ml-auto pl-3">
                <button onclick="this.parentElement.parentElement.parentElement.remove()" class="text-white hover:text-gray-200">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 300);
    }, 5000);
}
</script>
@endsection
