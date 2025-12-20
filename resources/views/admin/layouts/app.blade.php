<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .admin-navbar {
            background-color: #1f2937;
        }

        .admin-navbar .nav-link,
        .admin-navbar .navbar-brand {
            color: #e5e7eb;
        }

        .admin-navbar .nav-link.active {
            color: #ffffff;
            font-weight: 600;
        }

        .admin-navbar .nav-link:hover {
            color: #ffffff;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg admin-navbar">
    <div class="container-fluid px-4">

        {{-- Brand --}}
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            Admin Panel
        </a>

        {{-- Toggle --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNavbar">

            {{-- Left links --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                    href="{{ route('admin.users.index') }}">
                        Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.advertisements.*') ? 'active' : '' }}"
                    href="{{ route('admin.advertisements.index') }}">
                        Advertisements
                    </a>
                </li>
            </ul>


            {{-- Right --}}
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-light btn-sm">
                    Logout
                </button>
            </form>

        </div>
    </div>
</nav>

{{-- Page Content --}}
<div class="container-fluid px-4 py-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
