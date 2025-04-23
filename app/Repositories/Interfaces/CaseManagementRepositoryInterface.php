<?php

namespace App\Repositories\Interfaces;

use App\Models\CaseManagement;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;

interface CaseManagementRepositoryInterface
{
    public function getAllCasesWithRelationsAndPagination(array $relations, int $perPage = 10): LengthAwarePaginator;

    public function getAllCourts(): Collection;

    public function getAllCompanyClients(): mixed;

    public function getAllCompanyLawyers(): mixed;

    public function store(array $data): CaseManagement;

    public function loadWithRelations(CaseManagement $caseManagement, array $relations): CaseManagement;

    public function update(CaseManagement $caseManagement, array $data): bool;

    public function delete(CaseManagement $caseManagement): bool;

    public function getClient(CaseManagement $caseManagement): mixed;

    public function getRelatedHearings(CaseManagement $caseManagement): HasMany;

}
