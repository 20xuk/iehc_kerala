<!-- User Theme Customization Modal -->
<div id="user-theme-modal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="user-theme-title">
    <div class="absolute inset-0 modal-backdrop" onclick="closeUserThemeModal()" aria-hidden="true"></div>
    <div class="relative mx-auto my-8 w-full max-w-4xl transform transition-all">
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden border border-gray-200">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between bg-gradient-to-r from-purple-50 to-indigo-50">
                <div class="flex items-center">
                    <div class="p-2 rounded-lg bg-purple-100 mr-3">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17v4a2 2 0 002 2h4M15 7l2-2 2 2-2 2-2-2zm-4 4l.5-.5"></path>
                        </svg>
                    </div>
                    <h3 id="user-theme-title" class="text-xl font-semibold text-gray-900">Customize Your Theme</h3>
                </div>
                <button class="btn btn-icon btn-sm btn-secondary" onclick="closeUserThemeModal()" aria-label="Close">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Content -->
            <div class="flex">
                <!-- Sidebar Navigation -->
                <aside class="w-64 bg-gradient-to-b from-gray-50 to-gray-100 border-r border-gray-200 p-4" role="tablist" aria-orientation="vertical">
                    <nav class="space-y-2">
                        <button type="button" role="tab" aria-selected="true" aria-controls="tab-theme-selection" data-tab="tab-theme-selection" class="user-theme-tab-link group w-full flex items-center px-4 py-3 text-left rounded-lg border-l-4 border-purple-600 bg-white text-purple-700 shadow-md transition-all duration-200 hover:shadow-lg">
                            <div class="p-2 rounded-lg bg-purple-100 mr-3">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17v4a2 2 0 002 2h4M15 7l2-2 2 2-2 2-2-2zm-4 4l.5-.5"></path>
                                </svg>
                            </div>
                            <span class="font-medium">Theme Selection</span>
                        </button>
                        <button type="button" role="tab" aria-selected="false" aria-controls="tab-custom-colors" data-tab="tab-custom-colors" class="user-theme-tab-link group w-full flex items-center px-4 py-3 text-left rounded-lg border-l-4 border-transparent bg-gray-50 text-gray-700 transition-all duration-200 hover:bg-white hover:shadow-md">
                            <div class="p-2 rounded-lg bg-gray-200 mr-3">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17v4a2 2 0 002 2h4M15 7l2-2 2 2-2 2-2-2zm-4 4l.5-.5"></path>
                                </svg>
                            </div>
                            <span class="font-medium">Custom Colors</span>
                        </button>
                        <button type="button" role="tab" aria-selected="false" aria-controls="tab-preview" data-tab="tab-preview" class="user-theme-tab-link group w-full flex items-center px-4 py-3 text-left rounded-lg border-l-4 border-transparent bg-gray-50 text-gray-700 transition-all duration-200 hover:bg-white hover:shadow-md">
                            <div class="p-2 rounded-lg bg-gray-200 mr-3">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                            <span class="font-medium">Preview</span>
                        </button>
                    </nav>
                </aside>

                <!-- Tab Content -->
                <div class="flex-1 p-6">
                    <!-- Theme Selection Tab -->
                    <section id="tab-theme-selection" role="tabpanel" class="user-theme-tab-panel">
                        <div class="space-y-6">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Choose Your Theme</h4>
                                <p class="text-gray-600 mb-6">Select from available themes or use the system default</p>
                            </div>

                            <!-- System Theme Option -->
                            <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input type="radio" id="system-theme" name="theme-option" value="system" class="form-radio text-blue-600" checked>
                                        <label for="system-theme" class="ml-3 text-sm font-medium text-gray-900">Use System Theme</label>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Recommended
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 mt-2 ml-6">Follow the system-wide theme settings</p>
                            </div>

                            <!-- Available Themes -->
                            <div>
                                <h5 class="text-md font-medium text-gray-900 mb-3">Available Themes</h5>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="available-themes-grid">
                                    <!-- Themes will be loaded here -->
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Custom Colors Tab -->
                    <section id="tab-custom-colors" role="tabpanel" class="user-theme-tab-panel hidden">
                        <div class="space-y-6">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Customize Colors</h4>
                                <p class="text-gray-600 mb-6">Create your own color scheme</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Primary Color -->
                                <div>
                                    <label for="custom-primary" class="form-label">Primary Color</label>
                                    <div class="flex items-center space-x-3">
                                        <input type="color" id="custom-primary" name="custom_colors[primary]" value="#3b82f6" class="w-12 h-12 rounded-lg border-2 border-gray-300 cursor-pointer">
                                        <input type="text" id="custom-primary-text" value="#3b82f6" class="form-input flex-1" placeholder="#3b82f6">
                                    </div>
                                </div>

                                <!-- Secondary Color -->
                                <div>
                                    <label for="custom-secondary" class="form-label">Secondary Color</label>
                                    <div class="flex items-center space-x-3">
                                        <input type="color" id="custom-secondary" name="custom_colors[secondary]" value="#f59e0b" class="w-12 h-12 rounded-lg border-2 border-gray-300 cursor-pointer">
                                        <input type="text" id="custom-secondary-text" value="#f59e0b" class="form-input flex-1" placeholder="#f59e0b">
                                    </div>
                                </div>

                                <!-- Accent Color -->
                                <div>
                                    <label for="custom-accent" class="form-label">Accent Color</label>
                                    <div class="flex items-center space-x-3">
                                        <input type="color" id="custom-accent" name="custom_colors[accent]" value="#10b981" class="w-12 h-12 rounded-lg border-2 border-gray-300 cursor-pointer">
                                        <input type="text" id="custom-accent-text" value="#10b981" class="form-input flex-1" placeholder="#10b981">
                                    </div>
                                </div>

                                <!-- Background Color -->
                                <div>
                                    <label for="custom-background" class="form-label">Background Color</label>
                                    <div class="flex items-center space-x-3">
                                        <input type="color" id="custom-background" name="custom_colors[background]" value="#ffffff" class="w-12 h-12 rounded-lg border-2 border-gray-300 cursor-pointer">
                                        <input type="text" id="custom-background-text" value="#ffffff" class="form-input flex-1" placeholder="#ffffff">
                                    </div>
                                </div>
                            </div>

                            <!-- Color Preview -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h5 class="text-sm font-medium text-gray-900 mb-3">Color Preview</h5>
                                <div class="flex space-x-4">
                                    <div class="text-center">
                                        <div id="preview-primary-color" class="w-12 h-12 rounded-lg border-2 border-gray-300 mb-2"></div>
                                        <span class="text-xs text-gray-600">Primary</span>
                                    </div>
                                    <div class="text-center">
                                        <div id="preview-secondary-color" class="w-12 h-12 rounded-lg border-2 border-gray-300 mb-2"></div>
                                        <span class="text-xs text-gray-600">Secondary</span>
                                    </div>
                                    <div class="text-center">
                                        <div id="preview-accent-color" class="w-12 h-12 rounded-lg border-2 border-gray-300 mb-2"></div>
                                        <span class="text-xs text-gray-600">Accent</span>
                                    </div>
                                    <div class="text-center">
                                        <div id="preview-background-color" class="w-12 h-12 rounded-lg border-2 border-gray-300 mb-2"></div>
                                        <span class="text-xs text-gray-600">Background</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Preview Tab -->
                    <section id="tab-preview" role="tabpanel" class="user-theme-tab-panel hidden">
                        <div class="space-y-6">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Theme Preview</h4>
                                <p class="text-gray-600 mb-6">See how your theme will look</p>
                            </div>

                            <!-- Preview Area -->
                            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                                    <!-- Preview Header -->
                                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-lg font-semibold text-white">Preview Header</h3>
                                            <div class="flex items-center space-x-2">
                                                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Preview Content -->
                                    <div class="p-6">
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                                            <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                                                <h4 class="font-semibold text-blue-900 mb-2">Primary Card</h4>
                                                <p class="text-blue-700 text-sm">This shows primary color usage</p>
                                            </div>
                                            <div class="bg-orange-50 rounded-lg p-4 border border-orange-200">
                                                <h4 class="font-semibold text-orange-900 mb-2">Secondary Card</h4>
                                                <p class="text-orange-700 text-sm">This shows secondary color usage</p>
                                            </div>
                                            <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                                                <h4 class="font-semibold text-green-900 mb-2">Accent Card</h4>
                                                <p class="text-green-700 text-sm">This shows accent color usage</p>
                                            </div>
                                        </div>

                                        <div class="flex space-x-3">
                                            <button class="btn btn-primary">Primary Button</button>
                                            <button class="btn btn-secondary">Secondary Button</button>
                                            <button class="btn btn-accent">Accent Button</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- Footer -->
            <div class="flex justify-end space-x-3 p-6 border-t border-gray-200 bg-gray-50">
                <button type="button" onclick="closeUserThemeModal()" class="btn btn-secondary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Cancel
                </button>
                <button type="button" onclick="saveUserTheme()" class="btn btn-primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Save Theme
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// User theme modal functionality
let userThemeModal = null;
let availableThemes = [];
let currentThemeSelection = 'system';

// Initialize user theme modal
document.addEventListener('DOMContentLoaded', function() {
    userThemeModal = document.getElementById('user-theme-modal');
    loadAvailableThemes();
    setupColorInputs();
});

// Load available themes
async function loadAvailableThemes() {
    try {
        const response = await fetch('{{ route("user.themes.available") }}');
        const data = await response.json();
        
        if (data.success) {
            availableThemes = data.themes;
            renderAvailableThemes();
        }
    } catch (error) {
        console.error('Error loading available themes:', error);
    }
}

// Render available themes
function renderAvailableThemes() {
    const grid = document.getElementById('available-themes-grid');
    if (!grid) return;

    availableThemes.forEach(theme => {
        const themeCard = document.createElement('div');
        themeCard.className = 'bg-white rounded-lg p-4 border border-gray-200 hover:shadow-md transition-shadow cursor-pointer';
        themeCard.onclick = () => selectTheme(theme.slug);
        
        themeCard.innerHTML = `
            <div class="flex items-center justify-between mb-3">
                <input type="radio" id="theme-${theme.slug}" name="theme-option" value="${theme.slug}" class="form-radio text-blue-600">
                <label for="theme-${theme.slug}" class="ml-2 font-medium text-gray-900">${theme.name}</label>
            </div>
            <p class="text-sm text-gray-600 mb-3">${theme.description}</p>
            <div class="flex space-x-2">
                <div class="w-6 h-6 rounded-full" style="background-color: ${theme.colors.primary}"></div>
                <div class="w-6 h-6 rounded-full" style="background-color: ${theme.colors.secondary}"></div>
                <div class="w-6 h-6 rounded-full" style="background-color: ${theme.colors.accent}"></div>
            </div>
        `;
        
        grid.appendChild(themeCard);
    });
}

// Select theme
function selectTheme(themeSlug) {
    currentThemeSelection = themeSlug;
    
    // Update radio buttons
    document.querySelectorAll('input[name="theme-option"]').forEach(radio => {
        radio.checked = radio.value === themeSlug;
    });
    
    // Update preview
    updateThemePreview();
}

// Setup color inputs
function setupColorInputs() {
    const colorInputs = ['primary', 'secondary', 'accent', 'background'];
    
    colorInputs.forEach(color => {
        const colorInput = document.getElementById(`custom-${color}`);
        const textInput = document.getElementById(`custom-${color}-text`);
        const preview = document.getElementById(`preview-${color}-color`);
        
        if (colorInput && textInput && preview) {
            // Sync color picker with text input
            colorInput.addEventListener('input', function() {
                textInput.value = this.value;
                preview.style.backgroundColor = this.value;
            });
            
            // Sync text input with color picker
            textInput.addEventListener('input', function() {
                if (/^#[0-9A-F]{6}$/i.test(this.value)) {
                    colorInput.value = this.value;
                    preview.style.backgroundColor = this.value;
                }
            });
            
            // Initialize preview
            preview.style.backgroundColor = colorInput.value;
        }
    });
}

// Update theme preview
function updateThemePreview() {
    // This would update the preview tab with the selected theme
    console.log('Updating theme preview for:', currentThemeSelection);
}

// Show user theme modal
function showUserThemeModal() {
    if (userThemeModal) {
        userThemeModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Load current user theme data
        loadCurrentUserTheme();
    }
}

// Close user theme modal
function closeUserThemeModal() {
    if (userThemeModal) {
        userThemeModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
}

// Load current user theme
async function loadCurrentUserTheme() {
    try {
        const response = await fetch('{{ route("user.themes.current") }}');
        const data = await response.json();
        
        if (data.success) {
            const preference = data.preference;
            
            // Set current selection
            if (preference.use_system_theme) {
                currentThemeSelection = 'system';
                document.getElementById('system-theme').checked = true;
            } else if (preference.theme_slug) {
                currentThemeSelection = preference.theme_slug;
                document.getElementById(`theme-${preference.theme_slug}`).checked = true;
            }
            
            // Set custom colors if available
            if (preference.custom_colors) {
                Object.keys(preference.custom_colors).forEach(color => {
                    const colorInput = document.getElementById(`custom-${color}`);
                    const textInput = document.getElementById(`custom-${color}-text`);
                    if (colorInput && textInput) {
                        colorInput.value = preference.custom_colors[color];
                        textInput.value = preference.custom_colors[color];
                    }
                });
            }
        }
    } catch (error) {
        console.error('Error loading current user theme:', error);
    }
}

// Save user theme
async function saveUserTheme() {
    const formData = {
        use_system_theme: currentThemeSelection === 'system',
        theme_slug: currentThemeSelection !== 'system' ? currentThemeSelection : null,
        custom_colors: null
    };
    
    // If custom colors are being used, collect them
    if (currentThemeSelection === 'custom') {
        formData.custom_colors = {
            primary: document.getElementById('custom-primary').value,
            secondary: document.getElementById('custom-secondary').value,
            accent: document.getElementById('custom-accent').value,
            background: document.getElementById('custom-background').value
        };
    }
    
    try {
        const response = await fetch('{{ route("user.themes.update") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        });
        
        const data = await response.json();
        
        if (data.success) {
            closeUserThemeModal();
            loadUserThemeData(); // Refresh the main page data
            showNotification('Theme updated successfully', 'success');
        } else {
            showNotification('Failed to update theme', 'error');
        }
    } catch (error) {
        console.error('Error saving user theme:', error);
        showNotification('Error saving theme', 'error');
    }
}

// Tab functionality for user theme modal
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.user-theme-tab-link');
    const tabPanels = document.querySelectorAll('.user-theme-tab-panel');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Remove active class from all buttons and hide panels
            tabButtons.forEach(btn => {
                btn.classList.remove('border-purple-600', 'bg-white', 'text-purple-700', 'shadow-md');
                btn.classList.add('border-transparent', 'bg-gray-50', 'text-gray-700');
                btn.setAttribute('aria-selected', 'false');
            });
            
            tabPanels.forEach(panel => {
                panel.classList.add('hidden');
            });
            
            // Add active class to current button and show panel
            this.classList.remove('border-transparent', 'bg-gray-50', 'text-gray-700');
            this.classList.add('border-purple-600', 'bg-white', 'text-purple-700', 'shadow-md');
            this.setAttribute('aria-selected', 'true');
            
            document.getElementById(targetTab).classList.remove('hidden');
        });
    });
});
</script>
