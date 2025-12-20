<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    public function edit(User $user,Product $product){

        return ($user->id === $product->user_id);
    }
    public function destroy(User $user,Product $product){
        return ($user->id == $product->user_id);
    }
    
}
