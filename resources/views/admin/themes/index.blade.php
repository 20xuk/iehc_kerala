@extends('layouts.app')

@section('title', 'Theme Management')

@section('content')
<div class="space-y-6">
    <!-- Professional Header -->
    <div class="bg-white border-b border-gray-200 pb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl font-bold text-gray-900">Theme Management</h1>
                <p class="text-gray-600 mt-1">Manage application themes and appearance</p>
            </div>
            <div class="flex-shrink-0">
                <button onclick="showThemeModal()" class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17v4a2 2 0 002 2h4M15 7l2-2 2 2-2 2-2-2zm-4 4l.5-.5"></path>
                    </svg>
                    Theme Settings
                </button>
            </div>
        </div>
    </div>

    <!-- Current Theme Info -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Current Theme</h3>
        </div>
        <div class="p-6">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17v4a2 2 0 002 2h4M15 7l2-2 2 2-2 2-2-2zm-4 4l.5-.5"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="text-xl font-semibold text-gray-900">{{ $activeTheme->name ?? 'Default' }}</h4>
                    <p class="text-gray-600">{{ $activeTheme->description ?? 'Default theme with blue and orange accents' }}</p>
                </div>
                <div class="ml-auto">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        Active
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Available Themes -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Available Themes</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($themes as $theme)
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-lg font-semibold text-gray-900">{{ $theme->name }}</h4>
                        @if($theme->is_active)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Active
                        </span>
                        @endif
                    </div>
                    
                    <div class="flex space-x-2 mb-3">
                        <div class="w-6 h-6 rounded" style="background-color: {{ $theme->colors['primary'] ?? '#3b82f6' }}"></div>
                        <div class="w-6 h-6 rounded" style="background-color: {{ $theme->colors['secondary'] ?? '#64748b' }}"></div>
                        <div class="w-6 h-6 rounded" style="background-color: {{ $theme->colors['accent'] ?? '#f59e0b' }}"></div>
                        <div class="w-6 h-6 rounded" style="background-color: {{ $theme->colors['background'] ?? '#ffffff' }}; border: 1px solid #e2e8f0;"></div>
                    </div>
                    
                    <p class="text-sm text-gray-600 mb-3">{{ $theme->description }}</p>
                    
                    <button onclick="applyThemeDirectly('{{ $theme->slug }}')" 
                            class="w-full px-3 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition-colors">
                        Apply Theme
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
function showThemeModal() {
    // Load theme modal content
    fetch('/admin/themes/modal')
        .then(response => response.text())
        .then(html => {
            // Create temporary container to parse HTML
            const temp = document.createElement('div');
            temp.innerHTML = html;
            
            // Remove existing modal if present
            const existingModal = document.getElementById('theme-modal');
            if (existingModal) {
                existingModal.remove();
            }
            
            // Add new modal to body
            document.body.appendChild(temp.firstElementChild);
            
            // Show modal
            document.getElementById('theme-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        })
        .catch(error => {
            console.error('Error loading theme modal:', error);
        });
}

function applyThemeDirectly(themeSlug) {
    fetch('/admin/themes/apply', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ theme_slug: themeSlug })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            showNotification('Theme applied successfully!', 'success');
            
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
</script>

@include('admin.themes.modal')
@endsection
