<?php

namespace App\Services;

use App\Models\Vehicle;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class VehicleService
{
    /**
     * Get paginated vehicles with optional search filter
     *
     * @param string|null $search
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedVehicles(?string $search = null, int $perPage = 15): LengthAwarePaginator
    {
        $query = Vehicle::query()->with('customer')->orderBy('id', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('vin', 'like', "%{$search}%")
                    ->orWhere('immatriculation', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%")
                    ->orWhere('version', 'like', "%{$search}%")
                    ->orWhereHas('customer', function ($customerQuery) use ($search) {
                        $customerQuery->where('firstName', 'like', "%{$search}%")
                            ->orWhere('lastName', 'like', "%{$search}%");
                    });
            });
        }

        return $query->paginate($perPage)->withQueryString();
    }

    /**
     * Create a new vehicle
     *
     * @param array $data
     * @return Vehicle
     */
    public function createVehicle(array $data): Vehicle
    {
        return Vehicle::create($data);
    }

    /**
     * Update a vehicle
     *
     * @param string $id
     * @param array $data
     * @return Vehicle
     */
    public function updateVehicle(string $id, array $data): Vehicle
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($data);

        return $vehicle;
    }

    /**
     * Delete a vehicle
     *
     * @param string $id
     * @return bool
     */
    public function deleteVehicle(string $id): bool
    {
        $vehicle = Vehicle::findOrFail($id);
        return $vehicle->delete();
    }

    /**
     * Find a vehicle by ID
     *
     * @param string $id
     * @return Vehicle
     */
    public function findVehicle(string $id): Vehicle
    {
        return Vehicle::findOrFail($id);
    }
}
