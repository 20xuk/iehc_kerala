@extends('layouts.app')

@section('title', 'Donor Details')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white border-b border-gray-200 pb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                               <div class="mb-4 sm:mb-0">
                       <div class="flex items-center">
                           <a href="{{ route('donors.index') }}" class="mr-4 text-gray-400 hover:text-gray-600">
                               <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                               </svg>
                           </a>
                           <div class="flex items-center space-x-4">
                               <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center overflow-hidden">
                                   @if($donor->profile_picture)
                                       <img src="{{ Storage::url($donor->profile_picture) }}" alt="Profile Picture" class="w-full h-full object-cover">
                                   @else
                                       <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                       </svg>
                                   @endif
                               </div>
                               <div>
                                   <h1 class="text-2xl font-bold text-gray-900">{{ $donor->display_name }}</h1>
                                   <p class="text-gray-600 mt-1">Donor ID: {{ $donor->id }}</p>
                               </div>
                           </div>
                       </div>
                   </div>
            <div class="flex space-x-3">
                <a href="{{ route('donors.edit', $donor) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Donor
                </a>
                <button onclick="showEmailModal({{ $donor->id }})" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Send Email
                </button>
            </div>
        </div>
    </div>

    <!-- Status Badge -->
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                    @if($donor->status === 'active') bg-green-100 text-green-800
                    @elseif($donor->status === 'blocked') bg-red-100 text-red-800
                    @elseif($donor->status === 'deceased') bg-gray-100 text-gray-800
                    @else bg-yellow-100 text-yellow-800 @endif">
                    {{ ucfirst($donor->status) }}
                </span>
                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                    @if($donor->donor_type === 'individual') bg-blue-100 text-blue-800
                    @elseif($donor->donor_type === 'corporate') bg-purple-100 text-purple-800
                    @elseif($donor->donor_type === 'foundation') bg-yellow-100 text-yellow-800
                    @elseif($donor->donor_type === 'church') bg-green-100 text-green-800
                    @else bg-gray-100 text-gray-800 @endif">
                    {{ ucfirst($donor->donor_type) }}
                </span>
                @if($donor->is_anonymous)
                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-gray-100 text-gray-800">
                        Anonymous
                    </span>
                @endif
            </div>
            <div class="text-sm text-gray-500">
                Member since {{ $donor->created_at->format('M Y') }}
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Personal Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Personal Information -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Personal Information</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <p class="text-sm text-gray-900">{{ $donor->full_name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <p class="text-sm text-gray-900">{{ $donor->email ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <p class="text-sm text-gray-900">{{ $donor->phone ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alternative Phone 1</label>
                            <p class="text-sm text-gray-900">{{ $donor->phone_alt1 ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alternative Phone 2</label>
                            <p class="text-sm text-gray-900">{{ $donor->phone_alt2 ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                            <p class="text-sm text-gray-900">{{ ucfirst($donor->gender) ?? 'Not specified' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                            <p class="text-sm text-gray-900">{{ $donor->date_of_birth ? $donor->date_of_birth->format('M d, Y') : 'Not provided' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Wedding Date</label>
                            <p class="text-sm text-gray-900">{{ $donor->wedding_date ? $donor->wedding_date->format('M d, Y') : 'Not provided' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Occupation</label>
                            <p class="text-sm text-gray-900">{{ $donor->occupation ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Company/Organization</label>
                            <p class="text-sm text-gray-900">{{ $donor->company ?? 'Not provided' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Information -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Address Information</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Complete Address</label>
                            <p class="text-sm text-gray-900">{{ $donor->full_address }}</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                                <p class="text-sm text-gray-900">{{ $donor->city ?? 'Not provided' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">State/Province</label>
                                <p class="text-sm text-gray-900">{{ $donor->state ?? 'Not provided' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                                <p class="text-sm text-gray-900">{{ $donor->postal_code ?? 'Not provided' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                <p class="text-sm text-gray-900">{{ $donor->country ?? 'India' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Donation History -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Donation History</h3>
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
                                    <tr class="hover:bg-gray-50">
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
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            ₹{{ number_format($collection->total_amount, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                @if($collection->status === 'active') bg-green-100 text-green-800
                                                @elseif($collection->status === 'cancelled') bg-red-100 text-red-800
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
                                    View all {{ $donor->collections->count() }} donations
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

        <!-- Right Column - Statistics & Actions -->
        <div class="space-y-6">
            <!-- Donation Statistics -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Donation Statistics</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-700">Total Donations</span>
                        <span class="text-lg font-semibold text-gray-900">{{ $donor->donation_count }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-700">Total Amount</span>
                        <span class="text-lg font-semibold text-gray-900">₹{{ number_format($donor->total_donations, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-700">Average Donation</span>
                        <span class="text-lg font-semibold text-gray-900">₹{{ number_format($donor->average_donation, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-700">First Donation</span>
                        <span class="text-sm text-gray-900">{{ $donor->first_donation_date ? $donor->first_donation_date->format('M Y') : 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-700">Last Donation</span>
                        <span class="text-sm text-gray-900">{{ $donor->last_donation_date ? $donor->last_donation_date->format('M Y') : 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Additional Information</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Source</label>
                        <p class="text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $donor->source)) ?? 'Not specified' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                        <p class="text-sm text-gray-900">{{ $donor->notes ?? 'No notes available' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Verified</label>
                        <p class="text-sm text-gray-900">
                            @if($donor->email_verified)
                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Verified
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Not Verified
                                </span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Verified</label>
                        <p class="text-sm text-gray-900">
                            @if($donor->phone_verified)
                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Verified
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Not Verified
                                </span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="{{ route('collections.create') }}?donor_id={{ $donor->id }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        Record Donation
                    </a>
                    <button onclick="showEmailModal({{ $donor->id }})" class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Send Email
                    </button>
                    <form action="{{ route('donors.destroy', $donor) }}" method="POST" class="inline w-full" onsubmit="return confirm('Are you sure you want to delete this donor? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Donor
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Email Modal -->
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

<script>
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
</script>
@endsection
