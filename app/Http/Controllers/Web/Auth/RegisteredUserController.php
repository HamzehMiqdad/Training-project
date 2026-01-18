<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        if (Auth::check()) {
            return redirect()->route('products.index');
        }
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // store required user image and optional logo
        $userImagePath = $request->file('user_image')->store('users', 'public');
        $logoPath = $request->hasFile('logo') ? $request->file('logo')->store('logos', 'public') : null;

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'age' => $data['age'],
            'city' => $data['city'],
            'country' => $data['country'],
            'location' => $data['location'],
            'phone_number' => $data['phone_number'],
            'store_name' => $data['store_name'],
            'whatsapp' => $data['whatsapp'],
            'facebook' => $data['facebook'],
            'gender' => $data['gender'],
            'logo' => $logoPath,
            'details' => $data['details'] ?? null,
            'user_image' => $userImagePath,
            'password' => $data['password'],
        ]);

        event(new Registered($user));

        Auth::login($user);
        return redirect(route('dashboard', absolute: false));
    }
}
