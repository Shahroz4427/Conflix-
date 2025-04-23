<?php

namespace App\Repositories\Interfaces;

use App\Models\Lawyer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;


interface LawyerRepositoryInterface
{
    public function getAllLawyersWithRelationAndPagination(array $relations, int $perPage = 10): LengthAwarePaginator;

    public function getAllJurisdiction(): Collection;

    public function store(array $data): Lawyer;

    public function loadRelations(array $relations, Lawyer $lawyer): Model;

    public function update(array $data, Lawyer $lawyer): bool;

    public function totalLawyerCount(): int;

    public function delete(Lawyer $lawyer): bool;
}
