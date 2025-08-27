<!-- Theme & Appearance Settings Modal -->
<div id="theme-modal" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-0 border-0 w-full max-w-4xl">
        <div class="relative bg-white rounded-xl shadow-2xl mx-4">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17v4a2 2 0 002 2h4M15 7l2-2 2 2-2 2-2-2zm-4 4l.5-.5"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Theme & Appearance Settings</h3>
                </div>
                <button onclick="closeThemeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Navigation Tabs -->
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-6" aria-label="Tabs">
                    <button type="button" 
                            class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-blue-500 text-blue-600 transition-colors duration-200"
                            data-tab="preset-themes">
                        Preset Themes
                    </button>
                    <button type="button" 
                            class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors duration-200"
                            data-tab="custom-colors">
                        Custom Colors
                    </button>
                    <button type="button" 
                            class="tab-button whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-colors duration-200"
                            data-tab="preview">
                        Preview
                    </button>
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="p-6">
                <!-- Preset Themes Tab -->
                <div id="preset-themes" class="tab-content">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($themes as $theme)
                        <div class="theme-card bg-white border-2 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 cursor-pointer {{ $theme->is_active ? 'border-blue-500' : 'border-gray-200' }}"
                             data-theme-slug="{{ $theme->slug }}"
                             onclick="selectTheme('{{ $theme->slug }}')">
                            <div class="p-6">
                                <!-- Theme Header -->
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="text-lg font-semibold text-gray-900">{{ $theme->name }}</h4>
                                    @if($theme->is_active)
                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    @endif
                                </div>

                                <!-- Color Palette -->
                                <div class="flex space-x-2 mb-4">
                                    <div class="w-8 h-8 rounded" style="background-color: {{ $theme->colors['primary'] ?? '#3b82f6' }}"></div>
                                    <div class="w-8 h-8 rounded" style="background-color: {{ $theme->colors['secondary'] ?? '#64748b' }}"></div>
                                    <div class="w-8 h-8 rounded" style="background-color: {{ $theme->colors['accent'] ?? '#f59e0b' }}"></div>
                                    <div class="w-8 h-8 rounded" style="background-color: {{ $theme->colors['background'] ?? '#ffffff' }}; border: 1px solid #e2e8f0;"></div>
                                </div>

                                <!-- Description -->
                                <p class="text-sm text-gray-600 mb-4">{{ $theme->description }}</p>

                                <!-- Action Text -->
                                <p class="text-sm text-blue-600 font-medium">Click to select this theme</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Custom Colors Tab -->
                <div id="custom-colors" class="tab-content hidden">
                    <div class="space-y-6">
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Customize Your Theme Colors</h4>
                            <p class="text-sm text-gray-600 mb-6">Create your own unique theme by customizing the primary colors.</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Primary Color</label>
                                    <div class="flex items-center space-x-3">
                                        <input type="color" id="custom-primary" value="#3b82f6" class="h-10 w-16 border-gray-300 rounded-lg">
                                        <input type="text" id="custom-primary-text" value="#3b82f6" class="flex-1 border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="#3b82f6">
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Secondary Color</label>
                                    <div class="flex items-center space-x-3">
                                        <input type="color" id="custom-secondary" value="#64748b" class="h-10 w-16 border-gray-300 rounded-lg">
                                        <input type="text" id="custom-secondary-text" value="#64748b" class="flex-1 border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="#64748b">
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Accent Color</label>
                                    <div class="flex items-center space-x-3">
                                        <input type="color" id="custom-accent" value="#f59e0b" class="h-10 w-16 border-gray-300 rounded-lg">
                                        <input type="text" id="custom-accent-text" value="#f59e0b" class="flex-1 border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="#f59e0b">
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Background Color</label>
                                    <div class="flex items-center space-x-3">
                                        <input type="color" id="custom-background" value="#ffffff" class="h-10 w-16 border-gray-300 rounded-lg">
                                        <input type="text" id="custom-background-text" value="#ffffff" class="flex-1 border-gray-300 rounded-lg px-3 py-2 text-sm" placeholder="#ffffff">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <button onclick="saveCustomColors()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Save Custom Colors
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Preview Tab -->
                <div id="preview" class="tab-content hidden">
                    <div class="space-y-6">
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Theme Preview</h4>
                            <p class="text-sm text-gray-600 mb-6">Preview how your selected theme will look across the application.</p>
                            
                            <div id="theme-preview" class="bg-white rounded-lg border border-gray-200 p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h5 class="text-lg font-semibold">Sample Interface</h5>
                                    <div class="flex space-x-2">
                                        <button class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">Primary Button</button>
                                        <button class="px-3 py-1 bg-gray-600 text-white text-sm rounded hover:bg-gray-700">Secondary Button</button>
                                    </div>
                                </div>
                                
                                <div class="space-y-4">
                                    <div class="p-4 bg-gray-50 rounded-lg">
                                        <h6 class="font-medium mb-2">Sample Card</h6>
                                        <p class="text-sm text-gray-600">This is how cards and content areas will appear with the selected theme.</p>
                                    </div>
                                    
                                    <div class="flex items-center space-x-4">
                                        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                                            <span class="text-white text-sm font-bold">A</span>
                                        </div>
                                        <div>
                                            <p class="font-medium">Sample User</p>
                                            <p class="text-sm text-gray-500">user@example.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex items-center justify-between p-6 border-t border-gray-200 bg-gray-50 rounded-b-xl">
                <div class="flex space-x-3">
                    <button onclick="previewTheme()" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Preview Theme
                    </button>
                    <button onclick="resetToDefault()" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Reset to Default
                    </button>
                </div>
                
                <div class="flex space-x-3">
                    <button onclick="closeThemeModal()" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        Cancel
                    </button>
                    <button onclick="applyTheme()" class="px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        Apply Theme
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let selectedThemeSlug = '{{ $activeTheme->slug ?? "default" }}';
let previewMode = false;

// Tab functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Remove active class from all buttons and contents
            tabButtons.forEach(btn => {
                btn.classList.remove('border-blue-500', 'text-blue-600');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });
            
            // Add active class to current button and show content
            this.classList.remove('border-transparent', 'text-gray-500');
            this.classList.add('border-blue-500', 'text-blue-600');
            
            document.getElementById(targetTab).classList.remove('hidden');
        });
    });

    // Color input synchronization
    document.querySelectorAll('input[type="color"]').forEach(colorInput => {
        colorInput.addEventListener('input', function() {
            const textInput = this.parentElement.querySelector('input[type="text"]');
            if (textInput) {
                textInput.value = this.value;
            }
        });
    });

    // Text input synchronization for color inputs
    document.querySelectorAll('input[type="text"]').forEach(textInput => {
        if (textInput.id.includes('custom-')) {
            textInput.addEventListener('input', function() {
                const colorInput = this.parentElement.querySelector('input[type="color"]');
                if (colorInput && this.value.match(/^#[0-9A-F]{6}$/i)) {
                    colorInput.value = this.value;
                }
            });
        }
    });
});

function showThemeModal() {
    document.getElementById('theme-modal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeThemeModal() {
    document.getElementById('theme-modal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    
    // Remove preview mode if active
    if (previewMode) {
        removePreviewMode();
    }
}

function selectTheme(themeSlug) {
    selectedThemeSlug = themeSlug;
    
    // Update visual selection
    document.querySelectorAll('.theme-card').forEach(card => {
        card.classList.remove('border-blue-500');
        card.classList.add('border-gray-200');
        card.querySelector('.w-6.h-6')?.remove();
    });
    
    const selectedCard = document.querySelector(`[data-theme-slug="${themeSlug}"]`);
    if (selectedCard) {
        selectedCard.classList.remove('border-gray-200');
        selectedCard.classList.add('border-blue-500');
        
        // Add checkmark
        const header = selectedCard.querySelector('.flex.items-center.justify-between');
        if (header && !header.querySelector('.w-6.h-6')) {
            const checkmark = document.createElement('div');
            checkmark.className = 'w-6 h-6 bg-green-500 rounded-full flex items-center justify-center';
            checkmark.innerHTML = '<svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
            header.appendChild(checkmark);
        }
    }
}

function previewTheme() {
    if (!selectedThemeSlug) return;
    
    fetch('/admin/themes/preview', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ theme_slug: selectedThemeSlug })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            applyPreviewTheme(data.css_variables);
            previewMode = true;
        }
    })
    .catch(error => {
        console.error('Error previewing theme:', error);
    });
}

function applyPreviewTheme(cssVariables) {
    // Remove existing preview styles
    removePreviewMode();
    
    // Create and apply preview styles
    const style = document.createElement('style');
    style.id = 'theme-preview-styles';
    style.textContent = ':root {';
    
    Object.entries(cssVariables).forEach(([variable, value]) => {
        style.textContent += `\n    ${variable}: ${value};`;
    });
    
    style.textContent += '\n}';
    document.head.appendChild(style);
}

function removePreviewMode() {
    const existingStyle = document.getElementById('theme-preview-styles');
    if (existingStyle) {
        existingStyle.remove();
    }
    previewMode = false;
}

function applyTheme() {
    if (!selectedThemeSlug) return;
    
    fetch('/admin/themes/apply', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ theme_slug: selectedThemeSlug })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Apply theme to current page
            applyPreviewTheme(data.css_variables);
            
            // Show success message
            showNotification('Theme applied successfully!', 'success');
            
            // Close modal
            closeThemeModal();
            
            // Reload page to apply theme fully
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        }
    })
    .catch(error => {
        console.error('Error applying theme:', error);
        showNotification('Error applying theme', 'error');
    });
}

function resetToDefault() {
    fetch('/admin/themes/reset', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Apply default theme
            applyPreviewTheme(data.css_variables);
            
            // Update selection
            selectTheme('default');
            
            showNotification('Theme reset to default!', 'success');
        }
    })
    .catch(error => {
        console.error('Error resetting theme:', error);
        showNotification('Error resetting theme', 'error');
    });
}

function saveCustomColors() {
    const colors = {
        primary: document.getElementById('custom-primary').value,
        secondary: document.getElementById('custom-secondary').value,
        accent: document.getElementById('custom-accent').value,
        background: document.getElementById('custom-background').value
    };
    
    fetch('/admin/themes/custom-colors', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ colors: colors })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Custom colors saved successfully!', 'success');
            // Switch to preset themes tab and select custom theme
            selectTheme('custom');
        }
    })
    .catch(error => {
        console.error('Error saving custom colors:', error);
        showNotification('Error saving custom colors', 'error');
    });
}

function showNotification(message, type) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg text-white font-medium ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
    }`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Close modal when clicking outside
document.getElementById('theme-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeThemeModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeThemeModal();
    }
});
</script>
