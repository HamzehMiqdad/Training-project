<?php

namespace App\Services;

use App\Models\Advertisement;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class AdvertisementService
{
    /**
     * Get paginated advertisements
     */
    public function getAdvertisements(int $perPage = 10): LengthAwarePaginator
    {
        return Advertisement::latest()->paginate($perPage);
    }

    /**
     * Get a single advertisement
     */
    public function getAdvertisement(int $id): Advertisement
    {
        $ad = Advertisement::findOrFail($id);
        $ad->increment('hits');
        return $ad;
    }

    /**
     * Create a new advertisement
     */
    public function createAdvertisement(array $data): Advertisement
    {
        // Handle image upload
        if (isset($data['image']) && $data['image']) {
            $data['image'] = $data['image']->store('ads', 'public');
        }

        return Advertisement::create($data);
    }

    /**
     * Update an advertisement
     */
    public function updateAdvertisement(Advertisement $advertisement, array $data): Advertisement
    {
        // Handle image upload if new image is provided
        if (isset($data['image']) && $data['image']) {
            // Delete old image if exists
            if ($advertisement->image) {
                Storage::disk('public')->delete($advertisement->image);
            }
            $data['image'] = $data['image']->store('ads', 'public');
        }

        $advertisement->update($data);
        return $advertisement->fresh();
    }

    /**
     * Delete an advertisement
     */
    public function deleteAdvertisement(Advertisement $advertisement): bool
    {
        // Delete associated image if exists
        if ($advertisement->image) {
            Storage::disk('public')->delete($advertisement->image);
        }

        return $advertisement->delete();
    }

    /**
     * Get active advertisements
     */
    public function getActiveAdvertisements(): \Illuminate\Database\Eloquent\Collection
    {
        return Advertisement::active()->get();
    }
}

