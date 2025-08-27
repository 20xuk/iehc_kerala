<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IEHCKerala') }} - @yield('title', 'Dashboard')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Livewire Scripts -->
    @livewireStyles
    
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ route('admin.themes.css') }}" id="theme-css">
    
    <!-- Additional Styles -->
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        .sidebar.collapsed {
            width: 4rem;
        }
        .sidebar.collapsed .sidebar-text,
        .sidebar.collapsed .sidebar-heading {
            display: none;
        }
        .sidebar.collapsed .nav-item {
            justify-content: center;
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }
        .sidebar.collapsed .nav-item svg {
            margin-right: 0;
        }
        .sidebar.collapsed h1 {
            display: none;
        }
        .sidebar.collapsed .sidebar-toggle-icon {
            transform: rotate(180deg);
        }
        .main-content {
            transition: margin-left 0.3s ease;
        }
        .main-content.expanded {
            margin-left: 4rem;
        }
        .nav-item {
            transition: all 0.2s ease;
        }
        .nav-item:hover {
            background-color: rgba(59, 130, 246, 0.1);
        }
        .nav-item.active {
            background-color: rgba(59, 130, 246, 0.2);
            border-right: 3px solid #3b82f6;
        }
        .sidebar-toggle-icon {
            transition: transform 0.3s ease;
        }
        
        /* Tooltip styles for collapsed sidebar */
        .sidebar.collapsed .nav-item {
            position: relative;
        }
        
        .sidebar.collapsed .nav-item::after {
            content: attr(data-tooltip);
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            background: #1f2937;
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
            z-index: 1000;
            margin-left: 0.5rem;
        }
        
        .sidebar.collapsed .nav-item:hover::after {
            opacity: 1;
            visibility: visible;
        }
        
        .sidebar.collapsed .nav-item::before {
            content: '';
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            border: 5px solid transparent;
            border-right-color: #1f2937;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
            z-index: 1000;
            margin-left: -0.25rem;
        }
        
        .sidebar.collapsed .nav-item:hover::before {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div id="sidebar" class="sidebar bg-white shadow-lg w-64 min-h-screen">
            <div class="p-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h1 class="text-xl font-bold text-gray-800">IEHCKerala</h1>
                    <button id="sidebar-toggle" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-5 h-5 sidebar-toggle-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <nav class="mt-4">
                <div class="px-4 mb-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider sidebar-heading">Main Menu</p>
                </div>

                <a href="{{ route(Auth::user()->getDashboardRoute()) }}" class="nav-item flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 {{ request()->routeIs('*.dashboard') ? 'active' : '' }}" data-tooltip="Dashboard">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                    </svg>
                    <span class="sidebar-text">Dashboard</span>
                </a>

                @if(Auth::user()->canAccessMenu('donors'))
                <div class="px-4 mt-6 mb-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider sidebar-heading">Donor Management</p>
                </div>

                <a href="{{ route('donors.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 {{ request()->routeIs('donors.*') ? 'active' : '' }}" data-tooltip="Donors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="sidebar-text">Donors</span>
                </a>

                <a href="{{ route('donors.blocked') }}" class="nav-item flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 {{ request()->routeIs('donors.blocked') ? 'active' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                    </svg>
                    <span class="sidebar-text">Blocked/Deceased</span>
                </a>
                @endif

                @if(Auth::user()->canAccessMenu('collections'))
                <div class="px-4 mt-6 mb-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider sidebar-heading">Collections</p>
                </div>

                <a href="{{ route('collections.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 {{ request()->routeIs('collections.index') ? 'active' : '' }}" data-tooltip="Collections">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                    <span class="sidebar-text">Collections</span>
                </a>

                <a href="{{ route('collections.create') }}" class="nav-item flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 {{ request()->routeIs('collections.create') ? 'active' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span class="sidebar-text">New Collection</span>
                </a>

                <a href="{{ route('collections.grouped') }}" class="nav-item flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 {{ request()->routeIs('collections.grouped') ? 'active' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span class="sidebar-text">Grouped Collections</span>
                </a>
                @endif

                @if(Auth::user()->canAccessMenu('magazines'))
                <div class="px-4 mt-6 mb-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider sidebar-heading">Magazines</p>
                </div>

                <a href="{{ route('magazines.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 {{ request()->routeIs('magazines.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <span class="sidebar-text">Subscriptions</span>
                </a>

                <a href="{{ route('magazines.address-register') }}" class="nav-item flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 {{ request()->routeIs('magazines.address-register') ? 'active' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="sidebar-text">Address Register</span>
                </a>
                @endif

                @if(Auth::user()->canAccessMenu('reports'))
                <div class="px-4 mt-6 mb-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider sidebar-heading">Reports</p>
                </div>

                <a href="{{ route('reports.donor-collections') }}" class="nav-item flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 {{ request()->routeIs('reports.donor-collections') ? 'active' : '' }}" data-tooltip="Reports">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span class="sidebar-text">Donor Collections</span>
                </a>

                <a href="{{ route('reports.collection-register') }}" class="nav-item flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 {{ request()->routeIs('reports.collection-register') ? 'active' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="sidebar-text">Collection Register</span>
                </a>

                <a href="{{ route('reports.promotional-secretary') }}" class="nav-item flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 {{ request()->routeIs('reports.promotional-secretary') ? 'active' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="sidebar-text">Promotional Secretary</span>
                </a>
                @endif

                @if(Auth::user()->canAccessMenu('communications') || Auth::user()->canAccessMenu('bible_verses'))
                <div class="px-4 mt-6 mb-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider sidebar-heading">Communication</p>
                </div>

                @if(Auth::user()->canAccessMenu('communications'))
                <a href="{{ route('communications.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 {{ request()->routeIs('communications.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <span class="sidebar-text">Communications</span>
                </a>
                @endif

                @if(Auth::user()->canAccessMenu('bible_verses'))
                <a href="{{ route('bible-verses.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 {{ request()->routeIs('bible-verses.*') ? 'active' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <span class="sidebar-text">Bible Verses</span>
                </a>
                @endif
                @endif

                @if(Auth::user()->isSystemAdmin())
                <div class="px-4 mt-6 mb-4">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider sidebar-heading">System Administration</p>
                </div>

                <a href="{{ route('admin.users.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" data-tooltip="Admin Users">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    <span class="sidebar-text">Admin User Management</span>
                </a>

                <a href="{{ route('system-settings.index') }}" class="nav-item flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 {{ request()->routeIs('system-settings.*') ? 'active' : '' }}" data-tooltip="System Settings">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="sidebar-text">System Settings</span>
                </a>
                @endif
            </nav>
        </div>

        <!-- Main Content -->
        <div id="main-content" class="main-content flex-1">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <h2 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h2>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Bible Verse Display -->
                        @if(isset($todaysVerse) && $todaysVerse)
                        <div class="hidden md:block">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg px-4 py-2">
                                <p class="text-sm text-blue-800 font-medium">{{ $todaysVerse->reference }}</p>
                                <p class="text-xs text-blue-600">{{ Str::limit($todaysVerse->display_text, 100) }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- User Menu -->
                        <div class="relative">
                            <div class="flex items-center space-x-4">
                                <div class="text-right">
                                    <div class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-gray-500">{{ Auth::user()->getRoleDisplayName() }}</div>
                                </div>
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="flex items-center text-gray-700 hover:text-red-600 transition-colors">
                                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Sidebar toggle functionality
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            
            // Store sidebar state in localStorage
            const isCollapsed = sidebar.classList.contains('collapsed');
            localStorage.setItem('sidebarCollapsed', isCollapsed);
        });

        // Auto-hide sidebar on mobile
        function handleResize() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            
            if (window.innerWidth < 768) {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('expanded');
            } else {
                // On desktop, restore the saved state
                const savedState = localStorage.getItem('sidebarCollapsed');
                if (savedState === 'true') {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('expanded');
                } else {
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('expanded');
                }
            }
        }

        // Initialize sidebar state on page load
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            
            // Check if we're on mobile
            if (window.innerWidth < 768) {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('expanded');
            } else {
                // On desktop, restore the saved state
                const savedState = localStorage.getItem('sidebarCollapsed');
                if (savedState === 'true') {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('expanded');
                }
            }
        });

        window.addEventListener('resize', handleResize);
        handleResize();
    </script>
    
    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html>
