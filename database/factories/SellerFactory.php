<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seller>
 */
class SellerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Auto Direct',
                'Premium Motors',
                'Elite Cars',
                'Express Auto',
                'Quality Vehicles',
                'Best Deals Auto',
                'Top Trade Cars',
                'Pro Seller Motors'
            ]),
        ];
    }
}
