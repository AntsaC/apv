<?php

namespace Database\Factories;

use App\Enum\EnergyType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brands = ['Peugeot', 'Renault', 'Citroën', 'Volkswagen', 'BMW', 'Mercedes', 'Audi', 'Toyota', 'Ford'];
        $brand = fake()->randomElement($brands);

        return [
            'circulationDate' => fake()->dateTimeBetween('-10 years', '-1 year'),
            'purchaseDate' => fake()->dateTimeBetween('-2 years', 'now'),
            'lastEventDate' => fake()->optional()->dateTimeBetween('-1 year', 'now'),
            'brand' => $brand,
            'model' => fake()->randomElement(['308', '208', 'Clio', 'Golf', '3 Series', 'A4', 'Corolla']),
            'version' => fake()->randomElement(['Business', 'Sport', 'Premium', 'GT', 'Allure']),
            'vin' => strtoupper(fake()->bothify('??#############')),
            'immatriculation' => strtoupper(fake()->bothify('??-###-??')),
            'kilometrage' => fake()->numberBetween(5000, 250000),
            'energy' => fake()->randomElement(EnergyType::cases())->value,
            'saleType' => fake()->randomElement(['VN', 'VO']),
            'saleFileNumber' => fake()->optional()->numerify('FILE-####'),
            'eventDate' => fake()->optional()->dateTimeBetween('-1 year', 'now'),
            'eventOrigin' => null,
            'invoiceComment' => fake()->optional()->sentence(),
        ];
    }
}
