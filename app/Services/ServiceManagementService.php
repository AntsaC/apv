<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ServiceManagementService
{
    /**
     * Get paginated services with optional search filter
     *
     * @param string|null $search
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedServices(?string $search = null, int $perPage = 15): LengthAwarePaginator
    {
        $query = Service::query()->with('vehicle')->orderBy('id', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('service_type', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('vehicle', function ($vehicleQuery) use ($search) {
                        $vehicleQuery->where('immatriculation', 'like', "%{$search}%")
                            ->orWhere('brand', 'like', "%{$search}%")
                            ->orWhere('model', 'like', "%{$search}%");
                    });
            });
        }

        return $query->paginate($perPage)->withQueryString();
    }

    /**
     * Create a new service
     *
     * @param array $data
     * @return Service
     */
    public function createService(array $data): Service
    {
        return Service::create($data);
    }

    /**
     * Update a service
     *
     * @param string $id
     * @param array $data
     * @return Service
     */
    public function updateService(string $id, array $data): Service
    {
        $service = Service::findOrFail($id);
        $service->update($data);

        return $service;
    }

    /**
     * Delete a service
     *
     * @param string $id
     * @return bool
     */
    public function deleteService(string $id): bool
    {
        $service = Service::findOrFail($id);
        return $service->delete();
    }

    /**
     * Find a service by ID with vehicle relationship
     *
     * @param string $id
     * @return Service
     */
    public function findService(string $id): Service
    {
        return Service::with('vehicle')->findOrFail($id);
    }
}
