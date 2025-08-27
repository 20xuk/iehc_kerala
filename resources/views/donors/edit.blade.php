@extends('layouts.app')

@section('title', 'Edit Donor')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white border-b border-gray-200 pb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="mb-4 sm:mb-0">
                <div class="flex items-center">
                    <a href="{{ route('donors.show', $donor) }}" class="mr-4 text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Edit Donor</h1>
                        <p class="text-gray-600 mt-1">Update donor information for {{ $donor->display_name }}</p>
                    </div>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('donors.show', $donor) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Donor
                </a>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white shadow rounded-lg">
        <form action="{{ route('donors.update', $donor) }}" method="POST" enctype="multipart/form-data" class="space-y-8 p-6">
            @csrf
            @method('PUT')
            
            <!-- Profile Picture Section -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Profile Picture</h3>
                <div class="flex items-center space-x-6">
                    <div class="flex-shrink-0">
                        <div id="profile-preview" class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center overflow-hidden">
                            @if($donor->profile_picture)
                                <img src="{{ Storage::url($donor->profile_picture) }}" alt="Profile Picture" class="w-full h-full object-cover">
                            @else
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1">
                        <label for="profile_picture" class="block text-sm font-medium text-gray-700 mb-2">Update Profile Picture</label>
                        <input type="file" name="profile_picture" id="profile_picture" accept="image/*" 
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                               onchange="previewProfilePicture(this)">
                        <p class="mt-1 text-sm text-gray-500">PNG, JPG, GIF up to 2MB</p>
                    </div>
                </div>
            </div>
            
            <!-- Personal Information -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $donor->first_name) }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('first_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $donor->last_name) }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('last_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $donor->email) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone', $donor->phone) }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone_alt1" class="block text-sm font-medium text-gray-700 mb-2">Alternative Phone 1</label>
                        <input type="tel" name="phone_alt1" id="phone_alt1" value="{{ old('phone_alt1', $donor->phone_alt1) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('phone_alt1')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone_alt2" class="block text-sm font-medium text-gray-700 mb-2">Alternative Phone 2</label>
                        <input type="tel" name="phone_alt2" id="phone_alt2" value="{{ old('phone_alt2', $donor->phone_alt2) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('phone_alt2')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                                <select name="gender" id="gender" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                                <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $donor->date_of_birth ? $donor->date_of_birth->format('Y-m-d') : '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                @error('date_of_birth')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="wedding_date" class="block text-sm font-medium text-gray-700 mb-2">Wedding Date</label>
                                <input type="date" name="wedding_date" id="wedding_date" value="{{ old('wedding_date', $donor->wedding_date ? $donor->wedding_date->format('Y-m-d') : '') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                @error('wedding_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="occupation" class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                        <input type="text" name="occupation" id="occupation" value="{{ old('occupation', $donor->occupation) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('occupation')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Company/Organization</label>
                        <input type="text" name="company" id="company" value="{{ old('company', $donor->company) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('company')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Address Information -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Address Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="address_line_1" class="block text-sm font-medium text-gray-700 mb-2">Address Line 1 *</label>
                        <input type="text" name="address_line_1" id="address_line_1" value="{{ old('address_line_1', $donor->address_line_1) }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('address_line_1')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="address_line_2" class="block text-sm font-medium text-gray-700 mb-2">Address Line 2</label>
                        <input type="text" name="address_line_2" id="address_line_2" value="{{ old('address_line_2', $donor->address_line_2) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('address_line_2')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                        <input type="text" name="city" id="city" value="{{ old('city', $donor->city) }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('city')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700 mb-2">State/Province *</label>
                        <input type="text" name="state" id="state" value="{{ old('state', $donor->state) }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('state')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-2">Postal Code</label>
                        <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code', $donor->postal_code) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('postal_code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="region" class="block text-sm font-medium text-gray-700 mb-2">Region</label>
                        <select name="region" id="region" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Region</option>
                            @isset($regions)
                                @foreach($regions as $id => $name)
                                    <option value="{{ $name }}" {{ old('region', $donor->region) == $name ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            @endisset
                        </select>
                        @error('region')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                        <select name="country" id="country" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Country</option>
                            @isset($countries)
                                @foreach($countries as $id => $name)
                                    <option value="{{ $name }}" {{ old('country', $donor->country) == $name ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            @endisset
                        </select>
                        @error('country')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Additional Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="donor_type" class="block text-sm font-medium text-gray-700 mb-2">Donor Type *</label>
                        <select name="donor_type" id="donor_type" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                        <label for="donation_frequency" class="block text-sm font-medium text-gray-700 mb-2">Donation Frequency</label>
                        <select name="donation_frequency" id="donation_frequency" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Frequency</option>
                            <option value="weekly" {{ old('donation_frequency', $donor->donation_frequency) == 'weekly' ? 'selected' : '' }}>Weekly</option>
                            <option value="bi_monthly" {{ old('donation_frequency', $donor->donation_frequency) == 'bi_monthly' ? 'selected' : '' }}>Bi-monthly</option>
                            <option value="monthly" {{ old('donation_frequency', $donor->donation_frequency) == 'monthly' ? 'selected' : '' }}>Monthly</option>
                            <option value="quarterly" {{ old('donation_frequency', $donor->donation_frequency) == 'quarterly' ? 'selected' : '' }}>Quarterly</option>
                            <option value="half_yearly" {{ old('donation_frequency', $donor->donation_frequency) == 'half_yearly' ? 'selected' : '' }}>Half-yearly</option>
                            <option value="yearly" {{ old('donation_frequency', $donor->donation_frequency) == 'yearly' ? 'selected' : '' }}>Yearly</option>
                            <option value="one_time" {{ old('donation_frequency', $donor->donation_frequency) == 'one_time' ? 'selected' : '' }}>One time</option>
                            <option value="on_demand" {{ old('donation_frequency', $donor->donation_frequency) == 'on_demand' ? 'selected' : '' }}>On demand</option>
                            <option value="special_occasion" {{ old('donation_frequency', $donor->donation_frequency) == 'special_occasion' ? 'selected' : '' }}>Special occasion</option>
                            <option value="festival" {{ old('donation_frequency', $donor->donation_frequency) == 'festival' ? 'selected' : '' }}>Festival</option>
                            <option value="anniversary" {{ old('donation_frequency', $donor->donation_frequency) == 'anniversary' ? 'selected' : '' }}>Anniversary</option>
                            <option value="birthday" {{ old('donation_frequency', $donor->donation_frequency) == 'birthday' ? 'selected' : '' }}>Birthday</option>
                            <option value="other" {{ old('donation_frequency', $donor->donation_frequency) == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('donation_frequency')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="pan_number" class="block text-sm font-medium text-gray-700 mb-2">PAN Number</label>
                            <input type="text" name="pan_number" id="pan_number" value="{{ old('pan_number', $donor->pan_number) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="ABCDE1234F">
                            @error('pan_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="promotional_secretary" class="block text-sm font-medium text-gray-700 mb-2">Promotional Secretary</label>
                            <select name="promotional_secretary" id="promotional_secretary" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Secretary</option>
                                @isset($secretaries)
                                    @foreach($secretaries as $sec)
                                        <option value="{{ $sec->id }}" {{ old('promotional_secretary', $donor->promotional_secretary) == $sec->id ? 'selected' : '' }}>{{ $sec->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                            @error('promotional_secretary')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select name="status" id="status" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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

                <div class="mt-6">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                    <textarea name="notes" id="notes" rows="4" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Any additional notes about the donor...">{{ old('notes', $donor->notes) }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('donors.show', $donor) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Donor
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewProfilePicture(input) {
    const preview = document.getElementById('profile-preview');
    const file = input.files[0];
    
    if (file) {
        // Validate file size (2MB limit)
        if (file.size > 2 * 1024 * 1024) {
            alert('File size must be less than 2MB');
            input.value = '';
            return;
        }
        
        // Validate file type
        if (!file.type.startsWith('image/')) {
            alert('Please select an image file');
            input.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" alt="Profile Preview" class="w-full h-full object-cover">`;
        };
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
