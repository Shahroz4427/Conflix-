<?php

namespace App\Repositories\Interfaces;

use App\Models\CaseHearing;
use App\Models\CaseManagement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface CaseHearingRepositoryInterface
{
    public function getAllCaseRelatedHearingWithPagination(CaseManagement $caseManagement, int $perPage = 10): LengthAwarePaginator;

    public function getClientFromCase(CaseManagement $caseManagement): mixed;

    public function getAllCourt(): Collection;

    public function getRelatedCase(CaseHearing $caseHearing): mixed;

    public function store(array $data): CaseHearing;

    public function update(array $data, CaseHearing $caseHearing): bool;

    public function delete(CaseHearing $caseHearing): bool;

    public function findWithCaseAndClient(int $id): Model|Collection|Builder|array|null;
}
