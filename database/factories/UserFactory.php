<?php

namespace Database\Factories;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name'   => $this->faker->firstName,
            'last_name'    => $this->faker->lastName,
            'email'        => $this->faker->unique()->safeEmail,
            'password'     => Hash::make('password'), // ثابت للسهولة
            'phone_number' => $this->faker->phoneNumber,
            'gender'       => $this->faker->randomElement(Gender::cases())->value,
            'age'          => $this->faker->numberBetween(18, 60),
            'whatsapp'     => $this->faker->phoneNumber,
            'facebook'     => 'https://facebook.com/'.$this->faker->userName,
            'store_name'   => $this->faker->company,
            'location'     => $this->faker->address,
            'logo'         => null, // أو 'logos/sample.png' إذا بدك
            'details'      => $this->faker->sentence,
            'country'      => 'Syria',
            'city'         => $this->faker->city,
            'user_image'   => 'users/default.png',
            'activated'    => true,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
