<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    /** @use HasFactory<\Database\Factories\AdvertisementFactory> */
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'start_time' => 'date',
        'end_time'   => 'date',
    ];


    public function scopeActive($query)
    {
        return $query->whereDate('start_time', '<=', now())
                     ->whereDate('end_time', '>=', now());
    }
}
