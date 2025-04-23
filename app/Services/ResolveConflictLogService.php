<?php

namespace App\Services;

use App\Models\CaseHearing;
use App\Repositories\Interfaces\CaseHearingRepositoryInterface;
use App\Repositories\Interfaces\CourtRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ResolveConflictLogService
{
    public function __construct(
        protected CaseHearingRepositoryInterface $caseHearingRepository,
        protected CourtRepositoryInterface $courtRepository
    ){}

    public function getAllCourts(): Collection
    {
        return $this->courtRepository->getAll();
    }

    public function findConflictCaseHearing(int $id): Model|Collection|Builder|array|null
    {
        return $this->caseHearingRepository->findWithCaseAndClient($id);
    }

    public function update(array $data, CaseHearing $caseHearing): bool
    {
        return $this->caseHearingRepository->update($data, $caseHearing);
    }


}
