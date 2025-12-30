<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthService
{
    /**
     * Register a new user
     */
    public function register(array $data): User
    {
        // Handle logo upload
        if (isset($data['logo']) && $data['logo']) {
            $data['logo'] = $data['logo']->store('logos', 'public');
        }

        // Handle user image upload
        if (isset($data['user_image']) && $data['user_image']) {
            $data['user_image'] = $data['user_image']->store('user_images', 'public');
        }

        // Hash password
        $data['password'] = Hash::make($data['password']);

        // Create user
        return User::create($data);
    }

    /**
     * Create API token for authenticated user
     */
    public function createToken(User $user, string $tokenName = 'api-token'): string
    {
        return $user->createToken($tokenName)->plainTextToken;
    }

    /**
     * Get authenticated user
     */
    public function getAuthenticatedUser(): ?User
    {
        return Auth::user();
    }

    /**
     * Logout user (revoke current token)
     */
    public function logout($user): void
    {
        $user->currentAccessToken()->delete();
    }
}

