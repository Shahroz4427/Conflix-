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
    /**
     * Constructor to inject repository dependencies.
     * 
     * @param CaseHearingRepositoryInterface $caseHearingRepository
     * @param CourtRepositoryInterface $courtRepository
     */
    public function __construct(
        protected CaseHearingRepositoryInterface $caseHearingRepository,
        protected CourtRepositoryInterface $courtRepository
    ) {}

    /**
     * Get all courts.
     * 
     * @return Collection A collection of all courts
     */
    public function getAllCourts(): Collection
    {
        // Fetch and return all courts
        return $this->courtRepository->getAll();
    }

    /**
     * Find a conflict case hearing by ID with its related case and client.
     * 
     * @param int $id The ID of the case hearing
     * @return Model|Collection|Builder|array|null The case hearing with related data
     */
    public function findConflictCaseHearing(int $id): Model|Collection|Builder|array|null
    {
        // Fetch and return the case hearing with its related case and client
        return $this->caseHearingRepository->findWithCaseAndClient($id);
    }

    /**
     * Update a case hearing to resolve a conflict.
     * 
     * @param array $data Data to update the case hearing with
     * @param CaseHearing $caseHearing The case hearing to update
     * @return bool True if the update was successful, false otherwise
     */
    public function update(array $data, CaseHearing $caseHearing): bool
    {
        // Update the case hearing and return the result
        return $this->caseHearingRepository->update($data, $caseHearing);
    }
}
