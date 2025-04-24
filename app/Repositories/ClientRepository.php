<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientRepository implements Interfaces\ClientRepositoryInterface
{
    /**
     * Constructor to inject the CompanyRepository dependency.
     * 
     * @param CompanyRepositoryInterface $companyRepository
     */
    public function __construct(
        protected CompanyRepositoryInterface $companyRepository
    ) {}

    /**
     * Get all clients with pagination for the authenticated company.
     * 
     * @param int $perPage Number of clients per page
     * @return LengthAwarePaginator Paginated list of clients
     */
    public function getAllClientsWithPagination(int $perPage = 10): LengthAwarePaginator
    {
        // Fetch clients belonging to the authenticated company, ordered by latest
        return Client::where('company_id', $this->companyRepository->getAuthCompanyID())
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Store a new client for the authenticated company.
     * 
     * @param array $data Data for the new client
     * @return Client The created client instance
     */
    public function store(array $data): Client
    {
        // Add the authenticated company's ID to the client data
        $data['company_id'] = $this->companyRepository->getAuthCompanyID();

        // Create and return the new client
        return Client::create($data);
    }

    /**
     * Update the specified client.
     * 
     * @param Client $client The client to update
     * @param array $data Data to update the client with
     * @return bool True if the update was successful, false otherwise
     */
    public function update(Client $client, array $data): bool
    {
        // Update the client with the provided data
        return $client->update($data);
    }

    /**
     * Delete the specified client.
     * 
     * @param Client $client The client to delete
     * @return bool True if the deletion was successful, false otherwise
     */
    public function delete(Client $client): bool
    {
        // Delete the client and return the result
        return $client->delete();
    }

    /**
     * Get the total count of all clients.
     * 
     * @return int Total number of clients
     */
    public function totalClientCount(): int
    {
        // Count and return the total number of clients
        return (int) Client::count();
    }
}
