<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function show(Request $request, User $user)
    {
        $products = $user->products()
            ->when($request->q, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->q . '%')
                    ->orWhere('category', 'like', '%' . $request->q . '%');
            })
            ->when($request->status !== null, function ($query) use ($request) {
                $query->where('availabe_for_sale', $request->status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.show', compact('user', 'products'));
    }


    public function toggle(User $user)
    {
        $user->update([
            'activated' => ! $user->activated
        ]);

        return back()->with('success', 'User status updated');
    }
}
