<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', __('messages.products'))</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .store-logo {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 6px;
        }
        .nav-link-custom {
            font-weight: 500;
        }
        .navbar-actions > *:not(:last-child) {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container d-flex flex-wrap justify-content-between align-items-center">

        {{-- Left: Brand / Store Logo --}}
        <a class="navbar-brand d-flex align-items-center mb-2 mb-lg-0" href="{{ route('products.index') }}">
            @auth
                @if(!empty(auth()->user()->logo))
                    <img src="{{ asset('storage/' . auth()->user()->logo) }}" alt="Logo" class="store-logo me-2">
                @endif
                <span>{{ auth()->user()->store_name ?? __('messages.my_store') }}</span>
            @else
                <span>{{ __('messages.products') }}</span>
            @endauth
        </a>

        {{-- Toggle button --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Collapsible content --}}
        <div class="collapse navbar-collapse" id="navbarContent">

            {{-- Center links --}}
@auth
<ul class="navbar-nav mx-auto mb-2 mb-lg-0 d-flex flex-column flex-lg-row justify-content-center align-items-center">
    <li class="nav-item me-lg-3 mb-2 mb-lg-0">
        <a class="nav-link nav-link-custom {{ request()->routeIs('dashboard') ? 'text-white' : 'text-secondary' }}"
           href="{{ route('dashboard') }}">{{ __('messages.dashboard') }}</a>
    </li>
    <li class="nav-item me-lg-3 mb-2 mb-lg-0">
        <a class="nav-link nav-link-custom {{ request()->routeIs('products.index') ? 'text-white' : 'text-secondary' }}"
           href="{{ route('products.index') }}">{{ __('messages.products') }}</a>
    </li>
    <li class="nav-item mb-2 mb-lg-0">
        <a class="nav-link nav-link-custom {{ request()->routeIs('profile.edit') ? 'text-white' : 'text-secondary' }}"
           href="{{ route('profile.edit') }}">{{ __('messages.profile') }}</a>
    </li>
</ul>
@endauth


            {{-- Right actions --}}
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex flex-column flex-lg-row navbar-actions">
                @guest
                    <li class="nav-item mb-2 mb-lg-0 me-lg-2">
                        <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light btn-sm text-dark" href="{{ route('register') }}">{{ __('messages.register') }}</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item mb-2 mb-lg-0 me-lg-2">
                        <a class="btn btn-success btn-sm" href="{{ route('products.create') }}">+ {{ __('messages.add_product') }}</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-outline-light btn-sm">{{ __('messages.logout') }}</button>
                        </form>
                    </li>
                @endauth
            </ul>

        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
