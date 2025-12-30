<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    /**
     * Get paginated list of users
     */
    public function getUsers(int $perPage = 10): LengthAwarePaginator
    {
        return User::latest()->paginate($perPage);
    }

    /**
     * Get a single user by ID
     */
    public function getUser(int $id): User
    {
        return User::findOrFail($id);
    }

    /**
     * Toggle user activation status
     */
    public function toggleActivation(User $user): User
    {
        $user->update([
            'activated' => !$user->activated
        ]);

        return $user->fresh();
    }

    /**
     * Get user's products with filters
     */
    public function getUserProducts(User $user, array $filters = []): LengthAwarePaginator
    {
        $query = $user->products();

        if (isset($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('category', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (isset($filters['status']) && $filters['status'] !== null) {
            $query->where('availabe_for_sale', $filters['status']);
        }

        return $query->latest()->paginate($filters['per_page'] ?? 10);
    }
}

