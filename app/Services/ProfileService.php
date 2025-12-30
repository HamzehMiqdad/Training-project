<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    /**
     * Update user profile
     */
    public function updateProfile(User $user, array $data): User
    {
        // Handle logo upload
        if (isset($data['logo']) && $data['logo']) {
            // Delete old logo if exists
            if ($user->logo) {
                Storage::disk('public')->delete($user->logo);
            }
            $data['logo'] = $data['logo']->store('logos', 'public');
        }

        $user->update($data);
        return $user->fresh();
    }

    /**
     * Delete user account
     */
    public function deleteAccount(User $user): bool
    {
        // Delete user logo if exists
        if ($user->logo) {
            Storage::disk('public')->delete($user->logo);
        }

        // Delete user image if exists
        if ($user->user_image) {
            Storage::disk('public')->delete($user->user_image);
        }

        return $user->delete();
    }

    /**
     * Get user profile
     */
    public function getProfile(User $user): User
    {
        return $user;
    }
}

