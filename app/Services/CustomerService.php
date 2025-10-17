<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CustomerService
{
    /**
     * Get paginated customers with optional search filter
     *
     * @param string|null $search
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedCustomers(?string $search = null, int $perPage = 15): LengthAwarePaginator
    {
        $query = Customer::query()->orderBy('id', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('cardNumber', 'like', "%{$search}%")
                    ->orWhere('firstName', 'like', "%{$search}%")
                    ->orWhere('lastName', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('portablePhone', 'like', "%{$search}%");
            });
        }

        return $query->paginate($perPage)->withQueryString();
    }

    /**
     * Create a new customer
     *
     * @param array $data
     * @return Customer
     */
    public function createCustomer(array $data): Customer
    {
        return Customer::create($data);
    }

    /**
     * Update a customer
     *
     * @param string $id
     * @param array $data
     * @return Customer
     */
    public function updateCustomer(string $id, array $data): Customer
    {
        $customer = Customer::findOrFail($id);
        $customer->update($data);

        return $customer;
    }

    /**
     * Delete a customer
     *
     * @param string $id
     * @return bool
     */
    public function deleteCustomer(string $id): bool
    {
        $customer = Customer::findOrFail($id);
        return $customer->delete();
    }

    /**
     * Find a customer by ID
     *
     * @param string $id
     * @return Customer
     */
    public function findCustomer(string $id): Customer
    {
        return Customer::findOrFail($id);
    }
}
