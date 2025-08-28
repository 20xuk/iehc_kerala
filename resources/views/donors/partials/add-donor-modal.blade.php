<!-- Add Donor Modal -->
<div id="donor-modal" class="fixed inset-0 z-[9999] hidden" role="dialog" aria-modal="true" aria-labelledby="add-donor-title" style="display: none;">
    <div class="absolute inset-0 bg-gray-600 bg-opacity-50 backdrop-blur-sm" onclick="closeDonorModal()" aria-hidden="true"></div>
    <div class="relative mx-auto w-full max-w-2xl transform transition-all flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200 w-full">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between bg-gradient-to-r from-blue-50 to-indigo-50">
                <div class="flex items-center">
                    <div class="p-2 rounded-lg bg-blue-100 mr-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h3 id="add-donor-title" class="text-xl font-semibold text-gray-900">Add New Donor</h3>
                </div>
                <button class="btn btn-icon btn-sm btn-secondary" onclick="closeDonorModal()" aria-label="Close">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="add-donor-form" action="{{ route('donors.store') }}" method="POST" class="flex">
                @csrf
                <input type="hidden" name="redirect_to" value="index">

                <aside class="w-56 bg-gradient-to-b from-gray-50 to-gray-100 border-r border-gray-200 p-4" role="tablist" aria-orientation="vertical">
                    <nav class="space-y-2">
                        <button type="button" role="tab" aria-selected="true" aria-controls="tab-personal" data-tab="tab-personal" class="donor-tab-link group w-full flex items-center px-4 py-3 text-left rounded-lg border-l-4 border-blue-600 bg-white text-blue-700 shadow-md transition-all duration-200 hover:shadow-lg">
                            <div class="p-2 rounded-lg bg-blue-100 mr-3">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <span class="font-medium">Personal Info</span>
                        </button>
                        <button type="button" role="tab" aria-selected="false" aria-controls="tab-contact" data-tab="tab-contact" class="donor-tab-link group w-full flex items-center px-4 py-3 text-left rounded-lg text-gray-700 hover:text-gray-900 hover:bg-white hover:shadow-md border-l-4 border-transparent transition-all duration-200">
                            <div class="p-2 rounded-lg bg-gray-100 mr-3 group-hover:bg-blue-100">
                                <svg class="w-4 h-4 text-gray-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 4H8m8-8H8M5 8h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2v-8a2 2 0 012-2z"/></svg>
                            </div>
                            <span class="font-medium">Contact</span>
                        </button>
                        <button type="button" role="tab" aria-selected="false" aria-controls="tab-address" data-tab="tab-address" class="donor-tab-link group w-full flex items-center px-4 py-3 text-left rounded-lg text-gray-700 hover:text-gray-900 hover:bg-white hover:shadow-md border-l-4 border-transparent transition-all duration-200">
                            <div class="p-2 rounded-lg bg-gray-100 mr-3 group-hover:bg-blue-100">
                                <svg class="w-4 h-4 text-gray-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <span class="font-medium">Address</span>
                        </button>
                        <button type="button" role="tab" aria-selected="false" aria-controls="tab-donor" data-tab="tab-donor" class="donor-tab-link group w-full flex items-center px-4 py-3 text-left rounded-lg text-gray-700 hover:text-gray-900 hover:bg-white hover:shadow-md border-l-4 border-transparent transition-all duration-200">
                            <div class="p-2 rounded-lg bg-gray-100 mr-3 group-hover:bg-blue-100">
                                <svg class="w-4 h-4 text-gray-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/></svg>
                            </div>
                            <span class="font-medium">Donor Details</span>
                        </button>
                        <button type="button" role="tab" aria-selected="false" aria-controls="tab-notes" data-tab="tab-notes" class="donor-tab-link group w-full flex items-center px-4 py-3 text-left rounded-lg text-gray-700 hover:text-gray-900 hover:bg-white hover:shadow-md border-l-4 border-transparent transition-all duration-200">
                            <div class="p-2 rounded-lg bg-gray-100 mr-3 group-hover:bg-blue-100">
                                <svg class="w-4 h-4 text-gray-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8M8 12h8m2-8H6a2 2 0 00-2 2v12a2 2 0 002 2h7l5-5V6a2 2 0 00-2-2z"/></svg>
                            </div>
                            <span class="font-medium">Notes</span>
                        </button>
                    </nav>
                </aside>

                <div class="flex-1 p-6">
                    <section id="tab-personal" role="tabpanel" class="donor-tab-panel">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="form-label font-semibold text-gray-800" for="first_name">First Name *</label>
                                <input class="form-input" name="first_name" id="first_name" value="{{ old('first_name') }}" required placeholder="Enter first name">
                                @error('first_name')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="form-label font-semibold text-gray-800" for="last_name">Last Name *</label>
                                <input class="form-input" name="last_name" id="last_name" value="{{ old('last_name') }}" required placeholder="Enter last name">
                                @error('last_name')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="form-label font-semibold text-gray-800" for="date_of_birth">Date of Birth</label>
                                <input type="date" class="form-input" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}">
                                @error('date_of_birth')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="form-label font-semibold text-gray-800" for="gender">Gender</label>
                                <select class="form-select" name="gender" id="gender">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender')=='male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender')=='female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender')=='other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('gender')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                            <div id="wedding-date-field" class="hidden">
                                <label class="form-label font-semibold text-gray-800" for="wedding_date">Wedding Date</label>
                                <input type="date" class="form-input" name="wedding_date" id="wedding_date" value="{{ old('wedding_date') }}">
                                @error('wedding_date')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="form-label font-semibold text-gray-800" for="marital_status">Marital Status</label>
                                <select class="form-select" name="marital_status" id="marital_status" onchange="toggleWeddingDate()">
                                    <option value="">Select Marital Status</option>
                                    <option value="single" {{ old('marital_status')=='single' ? 'selected' : '' }}>Single</option>
                                    <option value="married" {{ old('marital_status')=='married' ? 'selected' : '' }}>Married</option>
                                    <option value="divorced" {{ old('marital_status')=='divorced' ? 'selected' : '' }}>Divorced</option>
                                    <option value="widowed" {{ old('marital_status')=='widowed' ? 'selected' : '' }}>Widowed</option>
                                </select>
                                @error('marital_status')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                            <div class="md:col-span-2">
                                <label class="form-label font-semibold text-gray-800" for="occupation">Occupation *</label>
                                <input class="form-input" name="occupation" id="occupation" value="{{ old('occupation') }}" required placeholder="Enter occupation">
                                @error('occupation')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </section>

                    <section id="tab-contact" role="tabpanel" class="donor-tab-panel hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="form-label font-semibold text-gray-800" for="email">Email Address</label>
                                <input type="email" class="form-input" name="email" id="email" value="{{ old('email') }}" placeholder="Enter email address">
                                @error('email')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="form-label font-semibold text-gray-800" for="phone">Phone Number *</label>
                                <input class="form-input" name="phone" id="phone" value="{{ old('phone') }}" required placeholder="Enter phone number">
                                @error('phone')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                            <div id="phone-alt-1" class="hidden">
                                <label class="form-label font-semibold text-gray-800" for="phone_alt1">Alternative Phone 1</label>
                                <input class="form-input" name="phone_alt1" id="phone_alt1" value="{{ old('phone_alt1') }}" placeholder="Enter alternative phone">
                                @error('phone_alt1')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                            <div id="phone-alt-2" class="hidden">
                                <label class="form-label font-semibold text-gray-800" for="phone_alt2">Alternative Phone 2</label>
                                <input class="form-input" name="phone_alt2" id="phone_alt2" value="{{ old('phone_alt2') }}" placeholder="Enter alternative phone">
                                @error('phone_alt2')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="button" id="add-phone-btn" class="btn btn-sm btn-secondary">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Add Another Phone
                            </button>
                        </div>
                    </section>

                    <section id="tab-address" role="tabpanel" class="donor-tab-panel hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="form-label font-semibold text-gray-800" for="address_line_1">Address Line 1 *</label>
                                <input class="form-input" name="address_line_1" id="address_line_1" value="{{ old('address_line_1') }}" required placeholder="Enter address line 1">
                                @error('address_line_1')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                            <div class="md:col-span-2">
                                <label class="form-label font-semibold text-gray-800" for="address_line_2">Address Line 2</label>
                                <input class="form-input" name="address_line_2" id="address_line_2" value="{{ old('address_line_2') }}" placeholder="Enter address line 2 (optional)">
                                @error('address_line_2')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="form-label font-semibold text-gray-800" for="city">City *</label>
                                <input class="form-input" name="city" id="city" value="{{ old('city') }}" required placeholder="Enter city">
                                @error('city')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="form-label font-semibold text-gray-800" for="state">State/Province *</label>
                                <input class="form-input" name="state" id="state" value="{{ old('state') }}" required placeholder="Enter state">
                                @error('state')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="form-label font-semibold text-gray-800" for="postal_code">Postal Code</label>
                                <input class="form-input" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" placeholder="Enter postal code">
                                @error('postal_code')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="form-label font-semibold text-gray-800" for="country_id">Country</label>
                                <select class="form-select" name="country_id" id="country_id" onchange="loadRegions(this.value)">
                                    <option value="">Select Country</option>
                                    @foreach(($countries ?? []) as $id => $name)
                                        <option value="{{ $id }}" {{ old('country_id')==$id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="form-label font-semibold text-gray-800" for="region_id">Region</label>
                                <select class="form-select" name="region_id" id="region_id">
                                    <option value="">Select Region</option>
                                </select>
                                @error('region_id')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </section>

                    <section id="tab-donor" role="tabpanel" class="donor-tab-panel hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="form-label font-semibold text-gray-800" for="donor_type">Donor Type *</label>
                                <select class="form-select" name="donor_type" id="donor_type" required>
                                    <option value="">Select Donor Type</option>
                                    <option value="individual" {{ old('donor_type')=='individual' ? 'selected' : '' }}>Individual</option>
                                    <option value="corporate" {{ old('donor_type')=='corporate' ? 'selected' : '' }}>Corporate</option>
                                    <option value="foundation" {{ old('donor_type')=='foundation' ? 'selected' : '' }}>Foundation</option>
                                    <option value="church" {{ old('donor_type')=='church' ? 'selected' : '' }}>Church</option>
                                    <option value="anonymous" {{ old('donor_type')=='anonymous' ? 'selected' : '' }}>Anonymous</option>
                                </select>
                                @error('donor_type')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="form-label font-semibold text-gray-800" for="donation_frequency">Donation Frequency</label>
                                <select class="form-select" name="donation_frequency" id="donation_frequency">
                                    <option value="">Select Frequency</option>
                                    <option value="weekly" {{ old('donation_frequency')=='weekly' ? 'selected' : '' }}>Weekly</option>
                                    <option value="bi_monthly" {{ old('donation_frequency')=='bi_monthly' ? 'selected' : '' }}>Bi-monthly</option>
                                    <option value="monthly" {{ old('donation_frequency')=='monthly' ? 'selected' : '' }}>Monthly</option>
                                    <option value="quarterly" {{ old('donation_frequency')=='quarterly' ? 'selected' : '' }}>Quarterly</option>
                                    <option value="half_yearly" {{ old('donation_frequency')=='half_yearly' ? 'selected' : '' }}>Half-yearly</option>
                                    <option value="yearly" {{ old('donation_frequency')=='yearly' ? 'selected' : '' }}>Yearly</option>
                                    <option value="one_time" {{ old('donation_frequency')=='one_time' ? 'selected' : '' }}>One time</option>
                                    <option value="on_demand" {{ old('donation_frequency')=='on_demand' ? 'selected' : '' }}>On demand</option>
                                    <option value="special_occasion" {{ old('donation_frequency')=='special_occasion' ? 'selected' : '' }}>Special occasion</option>
                                    <option value="festival" {{ old('donation_frequency')=='festival' ? 'selected' : '' }}>Festival</option>
                                    <option value="anniversary" {{ old('donation_frequency')=='anniversary' ? 'selected' : '' }}>Anniversary</option>
                                    <option value="birthday" {{ old('donation_frequency')=='birthday' ? 'selected' : '' }}>Birthday</option>
                                    <option value="other" {{ old('donation_frequency')=='other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('donation_frequency')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="form-label font-semibold text-gray-800" for="pan_number">PAN Number</label>
                                <input class="form-input" name="pan_number" id="pan_number" value="{{ old('pan_number') }}" placeholder="ABCDE1234F">
                                @error('pan_number')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="form-label font-semibold text-gray-800" for="promotional_secretary">Promotional Secretary</label>
                                <select class="form-select" name="promotional_secretary" id="promotional_secretary">
                                    <option value="">Select Secretary</option>
                                    @foreach(($secretaries ?? []) as $sec)
                                        <option value="{{ $sec->id }}" {{ old('promotional_secretary')==$sec->id ? 'selected' : '' }}>{{ $sec->name }}</option>
                                    @endforeach
                                </select>
                                @error('promotional_secretary')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="form-label font-semibold text-gray-800" for="amount_promised">Amount Promised</label>
                                <input type="number" step="0.01" class="form-input" name="amount_promised" id="amount_promised" value="{{ old('amount_promised') }}" placeholder="Enter amount promised">
                                @error('amount_promised')<p class="form-error">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </section>

                    <section id="tab-notes" role="tabpanel" class="donor-tab-panel hidden">
                        <div>
                            <label class="form-label font-semibold text-gray-800" for="notes">Notes</label>
                            <textarea class="form-textarea" name="notes" id="notes" rows="4" placeholder="Any additional notes about the donor...">{{ old('notes') }}</textarea>
                            @error('notes')<p class="form-error">{{ $message }}</p>@enderror
                        </div>
                    </section>

                    <div class="flex justify-end space-x-3 mt-8 mb-4 mx-6 border-t border-gray-200 pt-6">
                        <button type="button" onclick="closeDonorModal()" class="btn btn-secondary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancel
                        </button>
                        <button type="submit" id="submit-donor-btn" class="btn btn-primary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span id="submit-text">Create Donor</span>
                            <svg id="submit-spinner" class="hidden w-4 h-4 mr-2 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Enhanced tab behavior with professional styling
    const tabButtons = document.querySelectorAll('.donor-tab-link');
    const tabPanels = document.querySelectorAll('.donor-tab-panel');

    tabButtons.forEach(btn => {
        btn.addEventListener('click', function(){
            const target = this.getAttribute('data-tab');

            // Update tab button states
            tabButtons.forEach(b => {
                b.setAttribute('aria-selected', 'false');
                b.classList.remove('bg-white','text-blue-700','shadow-md','border-blue-600');
                b.classList.add('text-gray-700');
                // Reset icon backgrounds
                const iconDiv = b.querySelector('div');
                if (iconDiv) {
                    iconDiv.classList.remove('bg-blue-100');
                    iconDiv.classList.add('bg-gray-100');
                }
            });
            
            // Set active tab
            this.setAttribute('aria-selected', 'true');
            this.classList.add('bg-white','text-blue-700','shadow-md','border-blue-600');
            // Update icon background
            const iconDiv = this.querySelector('div');
            if (iconDiv) {
                iconDiv.classList.remove('bg-gray-100');
                iconDiv.classList.add('bg-blue-100');
            }

            // Show/hide panels with smooth transition
            tabPanels.forEach(p => {
                p.classList.add('hidden');
                p.style.opacity = '0';
            });
            
            const panel = document.getElementById(target);
            if (panel) {
                panel.classList.remove('hidden');
                setTimeout(() => {
                    panel.style.opacity = '1';
                    const focusable = panel.querySelector('input, select, textarea, button');
                    if (focusable) focusable.focus();
                }, 50);
            }
        });
    });

    // Enhanced phone button functionality
    const addBtn = document.getElementById('add-phone-btn');
    if (addBtn) {
        addBtn.addEventListener('click', function() {
            const alt1 = document.getElementById('phone-alt-1');
            const alt2 = document.getElementById('phone-alt-2');
            if (alt1.classList.contains('hidden')) {
                alt1.classList.remove('hidden');
                setTimeout(() => {
                    document.getElementById('phone_alt1').focus();
                }, 100);
            } else if (alt2.classList.contains('hidden')) {
                alt2.classList.remove('hidden');
                setTimeout(() => {
                    document.getElementById('phone_alt2').focus();
                }, 100);
            } else {
                addBtn.setAttribute('disabled', 'disabled');
                addBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        });
    }

    // Add smooth transitions to panels
    tabPanels.forEach(panel => {
        panel.style.transition = 'opacity 0.2s ease-in-out';
    });

    // Initialize wedding date field visibility based on marital status
    toggleWeddingDate();

    // AJAX form submission
    const form = document.getElementById('add-donor-form');
    const submitBtn = document.getElementById('submit-donor-btn');
    const submitText = document.getElementById('submit-text');
    const submitSpinner = document.getElementById('submit-spinner');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        submitBtn.disabled = true;
        submitText.textContent = 'Creating...';
        submitSpinner.classList.remove('hidden');
        
        // Get form data
        const formData = new FormData(form);
        
        // Send AJAX request
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                showNotification('Donor created successfully!', 'success');
                closeDonorModal();
                // Reload page to show new donor
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                // Show error message
                showNotification(data.message || 'Error creating donor', 'error');
                // Reset button state
                submitBtn.disabled = false;
                submitText.textContent = 'Create Donor';
                submitSpinner.classList.add('hidden');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error creating donor. Please try again.', 'error');
            // Reset button state
            submitBtn.disabled = false;
            submitText.textContent = 'Create Donor';
            submitSpinner.classList.add('hidden');
        });
    });
});

// Notification function
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm transform transition-all duration-300 translate-x-full`;
    
    const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
    notification.classList.add(bgColor, 'text-white');
    
    notification.innerHTML = `
        <div class="flex items-center">
            <div class="flex-shrink-0">
                ${type === 'success' ? '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>' :
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
    
    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 300);
    }, 5000);
}

// Modal functions are now defined in the main donors/index.blade.php file

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

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    const modal = document.getElementById('donor-modal');
    if (e.target === modal) {
        closeDonorModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('donor-modal');
        if (!modal.classList.contains('hidden')) {
            closeDonorModal();
        }
    }
});

@if($errors->any())
window.addEventListener('load', function(){ 
    setTimeout(() => {
        openDonorModal(); 
    }, 500);
});
@endif
</script>

