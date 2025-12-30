<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'name' => $this->faker->words(2, true),
            'details' => $this->faker->paragraph,
            'category' => $this->faker->randomElement(['ملابس','ادوات','الكترونيات','طعام','أحذية']),
            'subcategory' => $this->faker->randomElement(['رجالي','نسائي','منزلي','موبايلات']),
            'price' => $this->faker->numberBetween(100000, 500000),
            'availabe_for_sale' => true,
            'image' => 'products/sample.jpg',
         ];
    }
}
