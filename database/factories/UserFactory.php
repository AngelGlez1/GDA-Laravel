<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
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


    public function customers(): array
    {
        return [
            // ->unique()->randomNumber(10, true),
            'dni' => fake()->regexify('[A-Z]{4}[0-4]{4}[A-Z]{2}[0-4]{2}'),
            'name' => fake()->name(),
            'last_name' => fake()->name(),
            'id_reg' => fake()->unique()->randomDigit(),
            'id_com' => fake()->unique()->randomDigit(),
            'email' => fake()->unique()->safeEmail(),
            'date_reg' => fake()->dateTime(),
        ];
    }
}
