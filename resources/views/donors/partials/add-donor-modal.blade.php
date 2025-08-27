<!-- Add Donor Modal -->
<div id="donor-modal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="add-donor-title">
    <div class="absolute inset-0 bg-gray-900/60" onclick="closeDonorModal()" aria-hidden="true"></div>
    <div class="relative mx-auto my-8 w-full max-w-3xl">
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 id="add-donor-title" class="text-xl font-semibold text-gray-900">Add Donor</h3>
                <button class="text-gray-400 hover:text-gray-600" onclick="closeDonorModal()" aria-label="Close">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('donors.store') }}" method="POST" class="flex">
                @csrf
                <input type="hidden" name="redirect_to" value="index">

                <aside class="w-48 bg-gray-50 border-r border-gray-200 p-4" role="tablist" aria-orientation="vertical">
                    <nav class="space-y-1">
                        <button type="button" role="tab" aria-selected="true" aria-controls="tab-personal" data-tab="tab-personal" class="donor-tab-link group w-full flex items-center px-3 py-2 text-left rounded-md border-l-4 border-blue-600 bg-white text-blue-700 shadow-sm">
                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Personal
                        </button>
                        <button type="button" role="tab" aria-selected="false" aria-controls="tab-contact" data-tab="tab-contact" class="donor-tab-link group w-full flex items-center px-3 py-2 text-left rounded-md text-gray-700 hover:text-gray-900 hover:bg-white hover:shadow-sm border-l-4 border-transparent">
                            <svg class="w-4 h-4 mr-2 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 4H8m8-8H8M5 8h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2v-8a2 2 0 012-2z"/></svg>
                            Contact
                        </button>
                        <button type="button" role="tab" aria-selected="false" aria-controls="tab-address" data-tab="tab-address" class="donor-tab-link group w-full flex items-center px-3 py-2 text-left rounded-md text-gray-700 hover:text-gray-900 hover:bg-white hover:shadow-sm border-l-4 border-transparent">
                            <svg class="w-4 h-4 mr-2 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Address
                        </button>
                        <button type="button" role="tab" aria-selected="false" aria-controls="tab-donor" data-tab="tab-donor" class="donor-tab-link group w-full flex items-center px-3 py-2 text-left rounded-md text-gray-700 hover:text-gray-900 hover:bg-white hover:shadow-sm border-l-4 border-transparent">
                            <svg class="w-4 h-4 mr-2 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/></svg>
                            Donor Details
                        </button>
                        <button type="button" role="tab" aria-selected="false" aria-controls="tab-notes" data-tab="tab-notes" class="donor-tab-link group w-full flex items-center px-3 py-2 text-left rounded-md text-gray-700 hover:text-gray-900 hover:bg-white hover:shadow-sm border-l-4 border-transparent">
                            <svg class="w-4 h-4 mr-2 text-gray-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8M8 12h8m2-8H6a2 2 0 00-2 2v12a2 2 0 002 2h7l5-5V6a2 2 0 00-2-2z"/></svg>
                            Notes
                        </button>
                    </nav>
                </aside>

                <div class="flex-1 p-6">
                    <section id="tab-personal" role="tabpanel" class="donor-tab-panel">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1" for="first_name">First Name *</label>
                                <input class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
                                @error('first_name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1" for="last_name">Last Name *</label>
                                <input class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="last_name" id="last_name" value="{{ old('last_name') }}" required>
                                @error('last_name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1" for="date_of_birth">Date of Birth</label>
                                <input type="date" class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}">
                                @error('date_of_birth')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1" for="gender">Gender</label>
                                <select class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="gender" id="gender">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender')=='male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender')=='female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender')=='other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('gender')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-medium text-gray-700 mb-1" for="occupation">Occupation *</label>
                                <input class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="occupation" id="occupation" value="{{ old('occupation') }}" required>
                                @error('occupation')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </section>

                    <section id="tab-contact" role="tabpanel" class="donor-tab-panel hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1" for="email">Email *</label>
                                <input type="email" class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="email" id="email" value="{{ old('email') }}" required>
                                @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1" for="phone">Phone Number *</label>
                                <input class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="phone" id="phone" value="{{ old('phone') }}" required>
                                @error('phone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div id="phone-alt-1" class="hidden">
                                <label class="block text-xs font-medium text-gray-700 mb-1" for="phone_alt1">Another Phone</label>
                                <input class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="phone_alt1" id="phone_alt1" value="{{ old('phone_alt1') }}">
                                @error('phone_alt1')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div id="phone-alt-2" class="hidden">
                                <label class="block text-xs font-medium text-gray-700 mb-1" for="phone_alt2">Another Phone</label>
                                <input class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="phone_alt2" id="phone_alt2" value="{{ old('phone_alt2') }}">
                                @error('phone_alt2')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" id="add-phone-btn" class="text-sm text-blue-600 hover:text-blue-800">+ Add another phone</button>
                        </div>
                    </section>

                    <section id="tab-address" role="tabpanel" class="donor-tab-panel hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-medium text-gray-700 mb-1" for="address_line_1">Address Line *</label>
                                <input class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="address_line_1" id="address_line_1" value="{{ old('address_line_1') }}" required>
                                @error('address_line_1')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1" for="city">City *</label>
                                <input class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="city" id="city" value="{{ old('city') }}" required>
                                @error('city')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1" for="state">State *</label>
                                <input class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="state" id="state" value="{{ old('state') }}" required>
                                @error('state')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1" for="postal_code">Postcode *</label>
                                <input class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" required>
                                @error('postal_code')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1" for="address_line_2">Police Station *</label>
                                <input class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="address_line_2" id="address_line_2" value="{{ old('address_line_2') }}" required>
                                @error('address_line_2')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1" for="region">Region</label>
                                <select class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="region" id="region">
                                    <option value="">Select Region</option>
                                    @foreach(($regions ?? []) as $id => $name)
                                        <option value="{{ $name }}" {{ old('region')==$name ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('region')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1" for="country">Country</label>
                                <select class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="country" id="country">
                                    <option value="">Select Country</option>
                                    @foreach(($countries ?? []) as $id => $name)
                                        <option value="{{ $name }}" {{ old('country','India')==$name ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('country')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </section>

                    <section id="tab-donor" role="tabpanel" class="donor-tab-panel hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1" for="donor_type">Donor Type *</label>
                                <select class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="donor_type" id="donor_type" required>
                                    <option value="">Select Donor Type</option>
                                    <option value="individual" {{ old('donor_type')=='individual' ? 'selected' : '' }}>Individual</option>
                                    <option value="corporate" {{ old('donor_type')=='corporate' ? 'selected' : '' }}>Corporate</option>
                                    <option value="foundation" {{ old('donor_type')=='foundation' ? 'selected' : '' }}>Foundation</option>
                                    <option value="church" {{ old('donor_type')=='church' ? 'selected' : '' }}>Church</option>
                                    <option value="anonymous" {{ old('donor_type')=='anonymous' ? 'selected' : '' }}>Anonymous</option>
                                </select>
                                @error('donor_type')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1" for="donation_frequency">Donation Frequency</label>
                                <select class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="donation_frequency" id="donation_frequency">
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
                                @error('donation_frequency')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1" for="pan_number">PAN Number</label>
                                <input class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="pan_number" id="pan_number" value="{{ old('pan_number') }}" placeholder="ABCDE1234F">
                                @error('pan_number')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1" for="promotional_secretary">Promotional Secretary</label>
                                <select class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="promotional_secretary" id="promotional_secretary">
                                    <option value="">Select Secretary</option>
                                    @foreach(($secretaries ?? []) as $sec)
                                        <option value="{{ $sec->id }}" {{ old('promotional_secretary')==$sec->id ? 'selected' : '' }}>{{ $sec->name }}</option>
                                    @endforeach
                                </select>
                                @error('promotional_secretary')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </section>

                    <section id="tab-notes" role="tabpanel" class="donor-tab-panel hidden">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1" for="notes">Notes</label>
                            <textarea class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500" name="notes" id="notes" rows="3" placeholder="Any additional notes about the donor...">{{ old('notes') }}</textarea>
                            @error('notes')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </section>

                    <div class="flex justify-end space-x-3 mt-6 border-t border-gray-200 pt-4">
                        <button type="button" onclick="closeDonorModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Left menu tab behavior
    const tabButtons = document.querySelectorAll('.donor-tab-link');
    const tabPanels = document.querySelectorAll('.donor-tab-panel');

    tabButtons.forEach(btn => {
        btn.addEventListener('click', function(){
            const target = this.getAttribute('data-tab');

            tabButtons.forEach(b => {
                b.setAttribute('aria-selected', 'false');
                b.classList.remove('bg-white','text-blue-700','shadow-sm','border-blue-600');
                b.classList.add('text-gray-700');
            });
            this.setAttribute('aria-selected', 'true');
            this.classList.add('bg-white','text-blue-700','shadow-sm','border-blue-600');

            tabPanels.forEach(p => p.classList.add('hidden'));
            const panel = document.getElementById(target);
            if (panel) {
                panel.classList.remove('hidden');
                const focusable = panel.querySelector('input, select, textarea, button');
                if (focusable) focusable.focus();
            }
        });
    });

    const addBtn = document.getElementById('add-phone-btn');
    if (addBtn) {
        addBtn.addEventListener('click', function() {
            const alt1 = document.getElementById('phone-alt-1');
            const alt2 = document.getElementById('phone-alt-2');
            if (alt1.classList.contains('hidden')) {
                alt1.classList.remove('hidden');
                document.getElementById('phone_alt1').focus();
            } else if (alt2.classList.contains('hidden')) {
                alt2.classList.remove('hidden');
                document.getElementById('phone_alt2').focus();
            } else {
                addBtn.setAttribute('disabled', 'disabled');
                addBtn.classList.add('text-gray-400');
            }
        });
    }
});

function openDonorModal() {
    const modal = document.getElementById('donor-modal');
    modal.classList.remove('hidden');
    setTimeout(() => {
        const first = document.getElementById('first_name');
        if (first) first.focus();
    }, 0);
}
function closeDonorModal() {
    document.getElementById('donor-modal').classList.add('hidden');
}

@if($errors->any())
window.addEventListener('load', function(){ openDonorModal(); });
@endif
</script>

