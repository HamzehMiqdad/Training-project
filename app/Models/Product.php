<?php

namespace App\Models;

use App\Models\User;
use App\Policies\ProductPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Attribute casting for correct types.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'availabe_for_sale' => 'boolean',
        'hits' => 'integer',
        'price' => 'integer',
    ];
}
