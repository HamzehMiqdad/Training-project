<!DOCTYPE html>
<html class="light" lang="en">
<head>
    @include('partials.head-assets')
    <title>@yield('title', 'Sign Up / Login - Marketplace')</title>
    <style>
        body {
            font-family: "Spline Sans", sans-serif;
        }
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: transparent; 
        }
        ::-webkit-scrollbar-thumb {
            background: #e6e6db; 
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #d1d1c4; 
        }
    </style>
    @stack('styles')
</head>
<body class="bg-background-light dark:bg-background-dark text-text-main dark:text-white transition-colors duration-200 min-h-screen flex flex-col">
    @include('partials.auth-header')

    <main class="flex-grow flex items-center justify-center p-4 lg:p-10">
        @yield('content')
    </main>

    @include('partials.auth-footer')

    @stack('scripts')
</body>
</html>

