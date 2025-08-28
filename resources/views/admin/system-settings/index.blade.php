@extends('layouts.app')

@section('title', 'System Settings')

@section('content')
<div class="space-y-8">
    <!-- Professional Header with Gradient -->
    <div class="bg-gradient-to-r from-slate-900 via-blue-900 to-slate-900 rounded-xl shadow-2xl p-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">System Settings</h1>
                <p class="text-blue-100 text-lg">Configure and manage system-wide settings, themes, and preferences</p>
            </div>
        </div>
    </div>

    <!-- Enhanced Navigation Tabs -->
    <div class="bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
            <nav class="flex space-x-1 p-2" aria-label="Tabs">
                <button type="button" 
                        class="tab-button flex-1 whitespace-nowrap py-4 px-6 border-b-2 font-semibold text-sm border-blue-500 text-blue-600 bg-white rounded-t-lg shadow-sm transition-all duration-200 flex items-center justify-center"
                        data-tab="general">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    General Settings
                </button>
                <button type="button" 
                        class="tab-button flex-1 whitespace-nowrap py-4 px-6 border-b-2 font-semibold text-sm border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300 transition-all duration-200 flex items-center justify-center"
                        data-tab="communication">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    Communication
                </button>
                <button type="button" 
                        class="tab-button flex-1 whitespace-nowrap py-4 px-6 border-b-2 font-semibold text-sm border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300 transition-all duration-200 flex items-center justify-center"
                        data-tab="users">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    User Management
                </button>
                <button type="button" 
                        class="tab-button flex-1 whitespace-nowrap py-4 px-6 border-b-2 font-semibold text-sm border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300 transition-all duration-200 flex items-center justify-center"
                        data-tab="permissions">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                    Permissions
                </button>
                <button type="button" 
                        class="tab-button flex-1 whitespace-nowrap py-4 px-6 border-b-2 font-semibold text-sm border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300 transition-all duration-200 flex items-center justify-center"
                        data-tab="themes">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17v4a2 2 0 002 2h4M15 7l2-2 2 2-2 2-2-2zm-4 4l.5-.5"></path>
                    </svg>
                    Theme Settings
                </button>
            </nav>
        </div>
    </div>

    <!-- Tab Content -->
    <!-- General Settings Tab -->
    <div id="general" class="tab-content">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Enhanced Settings Cards -->
            @include('admin.system-settings.partials.general-cards')
        </div>
    </div>

    <!-- Communication Tab -->
    <div id="communication" class="tab-content hidden">
        <div class="bg-white rounded-xl shadow-xl border border-gray-100 p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Communication Settings</h3>
            <p class="text-gray-600 text-lg">Communication settings will be configured here.</p>
        </div>
        </div>
        
    <!-- User Management Tab -->
    <div id="users" class="tab-content hidden">
        <div class="bg-white rounded-xl shadow-xl border border-gray-100 p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">User Management</h3>
            <p class="text-gray-600 text-lg">User management settings will be configured here.</p>
        </div>
                        </div>

    <!-- Permission Templates Tab -->
    <div id="permissions" class="tab-content hidden">
        <div class="bg-white rounded-xl shadow-xl border border-gray-100 p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Permission Templates</h3>
            <p class="text-gray-600 text-lg">Permission template settings will be configured here.</p>
                        </div>
                    </div>

    <!-- Enhanced Theme Settings Tab -->
    <div id="themes" class="tab-content hidden">
        <div class="space-y-8">
            <!-- Theme Selection Section with Inner Tabs -->
            <div class="bg-white rounded-xl shadow-xl border border-gray-100 p-8">
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Theme & Appearance Settings</h3>
                    <p class="text-gray-600 text-lg">Choose from pre-built themes or customize your own</p>
                </div>

                <!-- Inner Tabs -->
                <div class="border-b border-gray-200">
                    <nav class="flex space-x-6" aria-label="Theme tabs">
                        <button type="button" class="inner-tab-button py-2 px-1 border-b-2 font-medium text-sm border-blue-500 text-blue-600" data-subtab="prebuilt">Pre-built Themes</button>
                        <button type="button" class="inner-tab-button py-2 px-1 border-b-2 font-medium text-sm border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300" data-subtab="customize">Customize Theme</button>
                    </nav>
                </div>
                
                <!-- Pre-built Themes Content -->
                <div id="prebuilt" class="inner-tab-content mt-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <input type="radio" id="use-system-theme" name="theme-choice" class="form-radio" checked>
                            <label for="use-system-theme" class="text-sm text-gray-800">Use System Theme</label>
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="resetToSystemTheme()">Reset to System</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="theme-grid"></div>
                </div>

                <!-- Customize Theme Content -->
                <div id="customize" class="inner-tab-content hidden mt-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="form-label">Primary Color</label>
                            <div class="flex items-center space-x-3">
                                <input type="color" id="settings-custom-primary" value="#3b82f6" class="w-12 h-12 rounded-lg border-2 border-gray-300 cursor-pointer">
                                <input type="text" id="settings-custom-primary-text" value="#3b82f6" class="form-input flex-1" placeholder="#3b82f6">
            </div>
                        </div>
                        <div>
                            <label class="form-label">Secondary Color</label>
                            <div class="flex items-center space-x-3">
                                <input type="color" id="settings-custom-secondary" value="#f59e0b" class="w-12 h-12 rounded-lg border-2 border-gray-300 cursor-pointer">
                                <input type="text" id="settings-custom-secondary-text" value="#f59e0b" class="form-input flex-1" placeholder="#f59e0b">
                            </div>
                        </div>
                        <div>
                            <label class="form-label">Accent Color</label>
                            <div class="flex items-center space-x-3">
                                <input type="color" id="settings-custom-accent" value="#10b981" class="w-12 h-12 rounded-lg border-2 border-gray-300 cursor-pointer">
                                <input type="text" id="settings-custom-accent-text" value="#10b981" class="form-input flex-1" placeholder="#10b981">
                    </div>
                </div>
                        <div>
                            <label class="form-label">Background Color</label>
                            <div class="flex items-center space-x-3">
                                <input type="color" id="settings-custom-background" value="#ffffff" class="w-12 h-12 rounded-lg border-2 border-gray-300 cursor-pointer">
                                <input type="text" id="settings-custom-background-text" value="#ffffff" class="form-input flex-1" placeholder="#ffffff">
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-end space-x-3">
                        <button type="button" class="btn btn-secondary" onclick="resetToSystemTheme()">Reset to System</button>
                        <button type="button" class="btn btn-primary" onclick="saveCustomThemeFromSettings()">Save Custom Theme</button>
                    </div>
                </div>
            </div>

            <!-- Current Theme Status -->
            <div class="bg-white rounded-xl shadow-xl border border-gray-100 p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Current Theme Status</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-blue-800">Your Current Theme</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-200 text-blue-800" id="user-theme-status">
                                System Default
                            </span>
                        </div>
                        <p class="text-xl font-bold text-blue-900 mb-2" id="user-current-theme">System Theme</p>
                        <p class="text-sm text-blue-700" id="user-theme-desc">Using system default theme</p>
                </div>
                
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-green-800">System Theme</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-200 text-green-800">
                                Active
                        </span>
                        </div>
                        <p class="text-xl font-bold text-green-900 mb-2" id="current-system-theme">{{ $activeTheme->name ?? 'IEHC Professional' }}</p>
                        <p class="text-sm text-green-700" id="current-system-theme-desc">{{ $activeTheme->description ?? 'Official IEHC theme' }}</p>
            </div>

                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 border border-purple-200">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-purple-800">Available Themes</span>
                        </div>
                        <p class="text-xl font-bold text-purple-900 mb-2">{{ $themes->count() }}</p>
                        <p class="text-sm text-purple-700">Professional themes</p>
                </div>
                
                    <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-6 border border-orange-200">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-semibold text-orange-800">User Overrides</span>
                        </div>
                        <p class="text-xl font-bold text-orange-900 mb-2" id="user-override-count">0</p>
                        <p class="text-sm text-orange-700">Custom themes</p>
                    </div>
                </div>
            </div>

            <!-- Theme Statistics -->
            <div class="bg-white rounded-xl shadow-xl border border-gray-100 p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Theme Usage Statistics</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl p-6 border border-slate-200">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-100 rounded-xl mr-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-600">Total Users</p>
                                <p class="text-2xl font-bold text-slate-900" id="total-users">0</p>
                        </div>
                    </div>
                </div>
                
                    <div class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl p-6 border border-slate-200">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-100 rounded-xl mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-600">System Theme Users</p>
                                <p class="text-2xl font-bold text-slate-900" id="system-theme-users">0</p>
                            </div>
                </div>
            </div>

                    <div class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl p-6 border border-slate-200">
                        <div class="flex items-center">
                            <div class="p-3 bg-purple-100 rounded-xl mr-4">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17v4a2 2 0 002 2h4M15 7l2-2 2 2-2 2-2-2zm-4 4l.5-.5"></path>
                            </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-600">Custom Theme Users</p>
                                <p class="text-2xl font-bold text-slate-900" id="custom-theme-users">0</p>
                        </div>
                    </div>
                </div>
                
                    <div class="bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl p-6 border border-slate-200">
                        <div class="flex items-center">
                            <div class="p-3 bg-orange-100 rounded-xl mr-4">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-600">Most Popular</p>
                                <p class="text-2xl font-bold text-slate-900" id="popular-theme">IEHC Professional</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced tab functionality
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Remove active class from all buttons and contents
            tabButtons.forEach(btn => {
                btn.classList.remove('border-blue-500', 'text-blue-600', 'bg-white', 'shadow-sm');
                btn.classList.add('border-transparent', 'text-gray-600');
            });
            
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });
            
            // Add active class to current button and show content
            this.classList.remove('border-transparent', 'text-gray-600');
            this.classList.add('border-blue-500', 'text-blue-600', 'bg-white', 'shadow-sm');
            
            document.getElementById(targetTab).classList.remove('hidden');
        });
    });

    // Load theme data
    loadThemeData();
    loadUserThemeData();
    loadThemeStatistics();

    // inner tabs for theme section
    const innerTabButtons = document.querySelectorAll('.inner-tab-button');
    const innerTabContents = document.querySelectorAll('.inner-tab-content');
    innerTabButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const target = this.getAttribute('data-subtab');
            innerTabButtons.forEach(b => b.classList.remove('border-blue-500','text-blue-600'));
            innerTabButtons.forEach(b => b.classList.add('border-transparent','text-gray-600'));
            innerTabContents.forEach(c => c.classList.add('hidden'));
            this.classList.remove('border-transparent','text-gray-600');
            this.classList.add('border-blue-500','text-blue-600');
            document.getElementById(target).classList.remove('hidden');
        });
    });

    // sync custom color inputs
    bindSettingsColor('primary');
    bindSettingsColor('secondary');
    bindSettingsColor('accent');
    bindSettingsColor('background');
});

// Load and display themes
async function loadThemeData() {
    try {
        const response = await fetch('{{ route("user.themes.available") }}');
        const data = await response.json();
        
        if (data.success) {
            // reflect current preference in UI
            const pref = data.current_preference || {};
            const useSystemRadio = document.getElementById('use-system-theme');
            if (useSystemRadio) {
                useSystemRadio.checked = !!pref.use_system_theme;
                useSystemRadio.addEventListener('change', function(){
                    if (this.checked) resetToSystemTheme();
                });
            }

            // prefill custom inputs if custom colors exist
            if (pref.custom_colors) {
                const colors = pref.custom_colors;
                const map = ['primary','secondary','accent','background'];
                map.forEach(key => {
                    if (colors[key]) {
                        const p = document.getElementById(`settings-custom-${key}`);
                        const t = document.getElementById(`settings-custom-${key}-text`);
                        if (p) p.value = colors[key];
                        if (t) t.value = colors[key];
                    }
                });
            }

            renderThemeGrid(data.themes, pref);
        }
    } catch (error) {
        console.error('Error loading themes:', error);
    }
}

// Render theme grid
function renderThemeGrid(themes, pref) {
    const grid = document.getElementById('theme-grid');
    if (!grid) return;

    grid.innerHTML = '';

    const currentSlug = pref && !pref.use_system_theme && !pref.custom_colors ? pref.theme_slug : null;

    themes.forEach(theme => {
        const themeCard = document.createElement('div');
        themeCard.className = 'bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer';
        themeCard.onclick = (e) => {
            if (e.target && e.target.name === 'theme-choice') return; // let radio handler run
            selectTheme(theme.slug);
        };
        
        themeCard.innerHTML = `
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <input type="radio" id="theme-${theme.slug}" name="theme-choice" class="form-radio" ${currentSlug === theme.slug ? 'checked' : ''} onclick="event.stopPropagation();" />
                        <label for="theme-${theme.slug}" class="ml-2 text-sm font-medium text-gray-900">${theme.name}</label>
                    </div>
                    <div class="flex space-x-2">
                        <div class="w-4 h-4 rounded-full" style="background-color: ${theme.colors.primary}"></div>
                        <div class="w-4 h-4 rounded-full" style="background-color: ${theme.colors.secondary}"></div>
                        <div class="w-4 h-4 rounded-full" style="background-color: ${theme.colors.accent}"></div>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-4">${theme.description}</p>
                <div class="flex items-center justify-between">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold ${theme.is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'}">
                        ${theme.is_active ? 'Active' : 'Available'}
                    </span>
                    <button class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-sm font-semibold rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200" onclick="event.stopPropagation(); selectTheme('${theme.slug}');">Apply</button>
                </div>
            </div>
        `;

        // bind radio change
        setTimeout(() => {
            const radio = themeCard.querySelector(`#theme-${theme.slug}`);
            if (radio) {
                radio.addEventListener('change', function(e){
                    if (this.checked) selectTheme(theme.slug);
                });
            }
        }, 0);
        
        grid.appendChild(themeCard);
    });
}

// Select theme
async function selectTheme(themeSlug) {
    try {
        const response = await fetch('{{ route("user.themes.update") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                theme_slug: themeSlug,
                use_system_theme: false
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            loadUserThemeData();
            showNotification('Theme applied successfully!', 'success');
            refreshThemeCss();
        } else {
            showNotification('Failed to apply theme', 'error');
        }
    } catch (error) {
        console.error('Error selecting theme:', error);
        showNotification('Error applying theme', 'error');
    }
}

// Load user theme data
async function loadUserThemeData() {
    try {
        const response = await fetch('{{ route("user.themes.current") }}');
        const data = await response.json();
        
        if (data.success) {
            updateUserThemeDisplay(data);
        }
    } catch (error) {
        console.error('Error loading user theme data:', error);
    }
}

// Update user theme display
function updateUserThemeDisplay(data) {
    const preference = data.preference;
    const effectiveTheme = data.effective_theme;
    
    const statusElement = document.getElementById('user-theme-status');
    const themeElement = document.getElementById('user-current-theme');
    const descElement = document.getElementById('user-theme-desc');
    
    if (preference.use_system_theme) {
        statusElement.textContent = 'System Default';
        statusElement.className = 'inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-200 text-blue-800';
        themeElement.textContent = 'System Theme';
        descElement.textContent = 'Using system default theme';
    } else if (preference.theme_slug) {
        statusElement.textContent = 'Custom Theme';
        statusElement.className = 'inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-purple-200 text-purple-800';
        themeElement.textContent = effectiveTheme.name;
        descElement.textContent = effectiveTheme.description;
    }
}

// Load theme statistics
async function loadThemeStatistics() {
    try {
        document.getElementById('total-users').textContent = '{{ $userThemeStats["total_users"] }}';
        document.getElementById('system-theme-users').textContent = '{{ $userThemeStats["system_theme_users"] }}';
        document.getElementById('custom-theme-users').textContent = '{{ $userThemeStats["custom_theme_users"] }}';
        document.getElementById('user-override-count').textContent = '{{ $userThemeStats["user_overrides"] }}';
    } catch (error) {
        console.error('Error loading theme statistics:', error);
    }
}

// Show user theme modal
function showUserThemeModal() {
    const modal = document.getElementById('user-theme-modal');
    if (modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
}

// Show system theme modal
function showThemeModal() {
    const modal = document.getElementById('theme-modal');
    if (modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
}

// Show notification
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-xl shadow-2xl z-50 transform transition-all duration-300 ${
        type === 'success' ? 'bg-gradient-to-r from-green-500 to-emerald-500 text-white' :
        type === 'error' ? 'bg-gradient-to-r from-red-500 to-pink-500 text-white' :
        'bg-gradient-to-r from-blue-500 to-indigo-500 text-white'
    }`;
    notification.innerHTML = `
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            ${message}
        </div>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Cache-bust and refresh the theme CSS across the app
function refreshThemeCss() {
    const link = document.getElementById('theme-css');
    if (!link) return;
    const baseHref = link.getAttribute('href').split('?')[0];
    link.setAttribute('href', `${baseHref}?v=${Date.now()}`);
}
function bindSettingsColor(name){
    const picker = document.getElementById(`settings-custom-${name}`);
    const text = document.getElementById(`settings-custom-${name}-text`);
    if(!picker || !text) return;
    picker.addEventListener('input', ()=>{ text.value = picker.value; });
    text.addEventListener('input', ()=>{ if(/^#[0-9A-Fa-f]{6}$/.test(text.value)) picker.value = text.value; });
}

async function saveCustomThemeFromSettings(){
    try {
        const payload = {
            use_system_theme: false,
            theme_slug: null,
            custom_colors: {
                primary: document.getElementById('settings-custom-primary').value,
                secondary: document.getElementById('settings-custom-secondary').value,
                accent: document.getElementById('settings-custom-accent').value,
                background: document.getElementById('settings-custom-background').value,
            }
        };
        const response = await fetch('{{ route("user.themes.update") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(payload)
        });
        const data = await response.json();
        if (data.success) {
            showNotification('Custom theme saved!', 'success');
            refreshThemeCss();
        } else {
            showNotification('Failed to save custom theme', 'error');
        }
    } catch (e) {
        console.error(e);
        showNotification('Error saving custom theme', 'error');
    }
}

async function resetToSystemTheme(){
    try {
        const response = await fetch('{{ route("user.themes.reset") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        const data = await response.json();
        if (data.success) {
            showNotification('Reverted to system theme', 'success');
            refreshThemeCss();
        } else {
            showNotification('Could not reset to system theme', 'error');
        }
    } catch (e) {
        console.error(e);
        showNotification('Error resetting theme', 'error');
    }
}
</script>

@include('admin.themes.modal')
@include('admin.system-settings.user-theme-modal')
@endsection
