<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Seller;
use App\Models\Service;
use App\Models\User;
use App\Models\Vehicle;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test user
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create sellers
        $sellers = Seller::factory(5)->create();

        // Create customers
        $customers = Customer::factory(20)->create();

        // Create vehicles with relationships and services
        $customers->each(function ($customer) use ($sellers) {
            // Each customer can have 1-3 vehicles
            $vehicleCount = rand(1, 3);

            for ($i = 0; $i < $vehicleCount; $i++) {
                $vehicle = Vehicle::factory()->create([
                    'customer_id' => $customer->id,
                    'vn_seller_id' => $sellers->random()->id,
                    'vo_seller_id' => rand(0, 1) ? $sellers->random()->id : null,
                    'intermediate_seller_id' => rand(0, 1) ? $sellers->random()->id : null,
                ]);

                // Add 1-5 services per vehicle
                Service::factory(rand(1, 5))->create([
                    'vehicle_id' => $vehicle->id,
                ]);
            }
        });
    }
}
