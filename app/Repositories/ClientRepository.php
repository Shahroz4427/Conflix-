<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientRepository implements Interfaces\ClientRepositoryInterface
{

    public function __construct(
        protected CompanyRepositoryInterface $companyRepository
    ){}

    public function getAllClientsWithPagination(int $perPage = 10): LengthAwarePaginator
    {
        return Client::where('company_id', $this->companyRepository->getAuthCompanyID())
            ->latest()
            ->paginate($perPage);
    }

    public function store(array $data): Client
    {
        $data['company_id'] = $this->companyRepository->getAuthCompanyID();
        return Client::create($data);
    }

    public function update(Client $client, array $data): bool
    {
        return $client->update($data);
    }

    public function delete(Client $client): bool
    {
       return $client->delete();
    }

    public function totalClientCount(): int
    {
        return Client::count();
    }
}
