<?php

namespace App\Repositories;

use App\Models\CaseHearing;
use App\Models\CaseManagement;
use App\Repositories\Interfaces\CaseManagementRepositoryInterface;
use App\Repositories\Interfaces\CourtRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CaseHearingRepository implements Interfaces\CaseHearingRepositoryInterface
{
    public function __construct(
        protected CaseManagementRepositoryInterface $caseManagementRepository,
        protected CourtRepositoryInterface $courtRepository
    ){}

    public function getAllCaseRelatedHearingWithPagination(CaseManagement $caseManagement, int $perPage = 10): LengthAwarePaginator
    {
        return $this->caseManagementRepository->getRelatedHearings($caseManagement)->latest()->paginate($perPage);
    }

    public function getClientFromCase(CaseManagement $caseManagement): mixed
    {
        return $this->caseManagementRepository->getClient($caseManagement);
    }

    public function getAllCourt(): Collection
    {
        return $this->courtRepository->getAll();
    }

    public function getRelatedCase(CaseHearing $caseHearing): mixed
    {
        return $caseHearing->case;
    }

    public function store(array $data): CaseHearing
    {
        return CaseHearing::create($data);
    }

    public function update(array $data, CaseHearing $caseHearing): bool
    {
        return $caseHearing->update($data);
    }

    public function delete(CaseHearing $caseHearing): bool
    {
       return $caseHearing->delete();
    }

    public function findWithCaseAndClient(int $id): Model|Collection|Builder|array|null
    {
        return CaseHearing::with('case.client')->find($id);
    }
}
