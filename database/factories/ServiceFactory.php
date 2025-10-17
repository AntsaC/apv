<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $serviceTypes = ['Maintenance', 'Repair', 'Oil Change', 'Tire Change', 'Inspection', 'Detailing', 'Bodywork'];

        return [
            'name' => fake()->randomElement([
                'Oil Change Service',
                'Brake Repair',
                'Tire Replacement',
                'Engine Diagnostic',
                'Transmission Service',
                'Air Conditioning Service',
                'Battery Replacement',
                'Suspension Repair',
                'Exhaust System Repair',
                'Full Vehicle Inspection'
            ]),
            'description' => fake()->optional()->sentence(),
            'price' => fake()->randomFloat(2, 50, 2000),
            'service_date' => fake()->dateTimeBetween('-2 years', 'now'),
            'service_type' => fake()->randomElement($serviceTypes),
        ];
    }
}
