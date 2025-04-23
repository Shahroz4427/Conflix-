<?php

namespace App\Repositories\Interfaces;

use App\Models\Client;
use Illuminate\Pagination\LengthAwarePaginator;

interface ClientRepositoryInterface
{
    public function getAllClientsWithPagination(int $perPage = 10): LengthAwarePaginator;

    public function store(array $data): Client;

    public function update(Client $client, array $data): bool;

    public function delete(Client $client): bool;

    public function totalClientCount(): int;

}
