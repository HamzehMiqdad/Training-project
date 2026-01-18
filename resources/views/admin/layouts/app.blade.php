<!DOCTYPE html>
<html class="light" lang="en">
<head>
    @include('partials.head-assets')
    <title>@yield('title', 'Admin Panel') - MarketPlace</title>
    <style type="text/tailwindcss">
        body {
            font-family: "Spline Sans", sans-serif;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-text-main dark:text-white min-h-screen flex flex-col font-display">
    {{-- Admin Header --}}
    <header class="sticky top-0 z-50 w-full bg-background-light/90 dark:bg-background-dark/90 backdrop-blur-md border-b border-[#e6e6e0] dark:border-[#3a3928]">
        <div class="max-w-[1440px] mx-auto px-4 md:px-8 py-3 flex items-center justify-between gap-4">
            <a class="flex items-center gap-2 group shrink-0" href="{{ route('admin.dashboard') }}">
                <div class="size-8 bg-primary rounded-lg flex items-center justify-center text-[#181811]">
                    <span class="material-symbols-outlined">admin_panel_settings</span>
                </div>
                <h1 class="text-xl font-bold tracking-tight text-[#181811] dark:text-white hidden sm:block">Admin Panel</h1>
            </a>
            
            <nav class="hidden md:flex items-center gap-1">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-full text-sm font-bold transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-[#181811]' : 'text-text-muted hover:text-text-main dark:hover:text-white hover:bg-white/50 dark:hover:bg-[#32311b]' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 rounded-full text-sm font-bold transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-primary text-[#181811]' : 'text-text-muted hover:text-text-main dark:hover:text-white hover:bg-white/50 dark:hover:bg-[#32311b]' }}">
                    Users
                </a>
                <a href="{{ route('admin.advertisements.index') }}" class="px-4 py-2 rounded-full text-sm font-bold transition-colors {{ request()->routeIs('admin.advertisements.*') ? 'bg-primary text-[#181811]' : 'text-text-muted hover:text-text-main dark:hover:text-white hover:bg-white/50 dark:hover:bg-[#32311b]' }}">
                    Advertisements
                </a>
            </nav>

            <div class="flex items-center gap-3">
                {{-- Mobile Menu Button --}}
                <button id="adminMobileMenuToggle" onclick="toggleAdminMobileMenu()" class="md:hidden size-10 flex items-center justify-center rounded-full bg-white dark:bg-[#32311b] hover:bg-gray-100 dark:hover:bg-[#3d3c22] transition-colors border border-[#e6e6e0] dark:border-[#3a3928]">
                    <span class="material-symbols-outlined text-xl">menu</span>
                </button>

                <form action="{{ route('admin.logout') }}" method="POST" class="inline hidden sm:block">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 px-4 py-2 rounded-full bg-white dark:bg-[#32311b] hover:bg-gray-100 dark:hover:bg-[#3d3c22] transition-colors border border-[#e6e6e0] dark:border-[#3a3928] text-sm font-bold">
                        <span class="material-symbols-outlined text-lg">logout</span>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="adminMobileMenu" class="md:hidden hidden border-t border-[#e6e6e0] dark:border-[#3a3928] bg-background-light dark:bg-background-dark">
            <nav class="flex flex-col px-4 py-3 gap-1">
                <a href="{{ route('admin.dashboard') }}" onclick="toggleAdminMobileMenu()" class="px-4 py-3 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-[#181811]' : 'text-text-muted hover:text-text-main dark:hover:text-white hover:bg-white/50 dark:hover:bg-[#32311b]' }} flex items-center gap-3">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.users.index') }}" onclick="toggleAdminMobileMenu()" class="px-4 py-3 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-primary text-[#181811]' : 'text-text-muted hover:text-text-main dark:hover:text-white hover:bg-white/50 dark:hover:bg-[#32311b]' }} flex items-center gap-3">
                    <span class="material-symbols-outlined">people</span>
                    <span>Users</span>
                </a>
                <a href="{{ route('admin.advertisements.index') }}" onclick="toggleAdminMobileMenu()" class="px-4 py-3 rounded-xl text-sm font-bold transition-colors {{ request()->routeIs('admin.advertisements.*') ? 'bg-primary text-[#181811]' : 'text-text-muted hover:text-text-main dark:hover:text-white hover:bg-white/50 dark:hover:bg-[#32311b]' }} flex items-center gap-3">
                    <span class="material-symbols-outlined">campaign</span>
                    <span>Advertisements</span>
                </a>
                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="w-full px-4 py-3 rounded-xl text-sm font-bold text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors flex items-center gap-3">
                        <span class="material-symbols-outlined">logout</span>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
        </div>
    </header>

    {{-- Page Content --}}
    <main class="flex-grow w-full max-w-[1440px] mx-auto px-4 md:px-8 py-6">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl">
                <p class="text-sm text-green-600 dark:text-green-400">{{ session('success') }}</p>
            </div>
        @endif

        @yield('content')
    </main>

    @include('partials.footer')

    <script>
        function toggleAdminMobileMenu() {
            const menu = document.getElementById('adminMobileMenu');
            const button = document.getElementById('adminMobileMenuToggle');
            if (menu) {
                menu.classList.toggle('hidden');
                if (button) {
                    const icon = button.querySelector('.material-symbols-outlined');
                    if (icon) {
                        icon.textContent = menu.classList.contains('hidden') ? 'menu' : 'close';
                    }
                }
            }
        }
    </script>
</body>
</html>
