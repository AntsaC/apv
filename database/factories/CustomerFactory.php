<?php

namespace Database\Factories;

use App\Enum\CivilityType;
use App\Enum\CustomerType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cardNumber' => fake()->unique()->numerify('CARD-######'),
            'civility' => fake()->randomElement(CivilityType::cases())->value,
            'firstName' => fake()->firstName(),
            'lastName' => fake()->lastName(),
            'address' => fake()->streetAddress(),
            'additionnalAdress' => fake()->optional()->secondaryAddress(),
            'city' => fake()->city(),
            'postalCode' => fake()->postcode(),
            'homePhone' => fake()->optional()->phoneNumber(),
            'portablePhone' => fake()->phoneNumber(),
            'jobPhone' => fake()->optional()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'type' => fake()->randomElement(CustomerType::cases())->value,
        ];
    }
}
