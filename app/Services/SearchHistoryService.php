<?php

namespace App\Services;

use App\Models\Search_Histroy;

class SearchHistoryService
{
    /**
     * Record a search query
     */
    public function recordSearch(string $query): Search_Histroy
    {
        return Search_Histroy::create([
            'text' => $query
        ]);
    }

    /**
     * Get search history
     */
    public function getSearchHistory(int $limit = 10): \Illuminate\Database\Eloquent\Collection
    {
        return Search_Histroy::latest()->limit($limit)->get();
    }
}

