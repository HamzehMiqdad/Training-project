<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        // Redirect to unified login page - it will automatically detect admin credentials
        return redirect()->route('login');
    }

    public function store(AdminLoginRequest $request)
    {
        // This method is no longer used, but kept for backward compatibility
        // Admin login is now handled through the user login page
        $request->authenticate();

        $request->session()->regenerate();

        return redirect('admin/dashboard');
    }
    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

