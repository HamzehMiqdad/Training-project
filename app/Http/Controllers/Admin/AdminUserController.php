<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function __construct(
        private UserService $userService,
        private ProductService $productService
    ) {}

    public function index()
    {
        $users = $this->userService->getUsers(10);

        return view('admin.users.index', compact('users'));
    }

    public function show(Request $request, User $user)
    {
        $filters = [
            'search' => $request->input('q'),
            'status' => $request->input('status'),
            'per_page' => 10,
        ];

        $products = $this->userService->getUserProducts($user, $filters)->withQueryString();

        return view('admin.users.show', compact('user', 'products'));
    }

    public function toggle(User $user)
    {
        $this->userService->toggleActivation($user);

        return back()->with('success', 'User status updated');
    }
}
