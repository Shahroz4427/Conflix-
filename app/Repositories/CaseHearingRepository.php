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
    /**
     * Constructor to inject dependencies.
     * 
     * @param CaseManagementRepositoryInterface $caseManagementRepository
     * @param CourtRepositoryInterface $courtRepository
     */
    public function __construct(
        protected CaseManagementRepositoryInterface $caseManagementRepository,
        protected CourtRepositoryInterface $courtRepository
    ) {}

    /**
     * Get all hearings related to a specific case with pagination.
     * 
     * @param CaseManagement $caseManagement
     * @param int $perPage Number of hearings per page
     * @return LengthAwarePaginator
     */
    public function getAllCaseRelatedHearingWithPagination(CaseManagement $caseManagement, int $perPage = 10): LengthAwarePaginator
    {
        // Fetch related hearings for the given case and paginate the results
        return $this->caseManagementRepository->getRelatedHearings($caseManagement)
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get the client associated with a specific case.
     * 
     * @param CaseManagement $caseManagement
     * @return mixed
     */
    public function getClientFromCase(CaseManagement $caseManagement): mixed
    {
        // Fetch the client associated with the given case
        return $this->caseManagementRepository->getClient($caseManagement);
    }

    /**
     * Get all courts.
     * 
     * @return Collection
     */
    public function getAllCourt(): Collection
    {
        // Fetch all courts
        return $this->courtRepository->getAll();
    }

    /**
     * Get the case associated with a specific hearing.
     * 
     * @param CaseHearing $caseHearing
     * @return mixed
     */
    public function getRelatedCase(CaseHearing $caseHearing): mixed
    {
        // Fetch the case related to the given hearing
        return $caseHearing->case;
    }

    /**
     * Store a new case hearing.
     * 
     * @param array $data Data for the new case hearing
     * @return CaseHearing
     */
    public function store(array $data): CaseHearing
    {
        // Create and return the new case hearing
        return CaseHearing::create($data);
    }

    /**
     * Update the specified case hearing.
     * 
     * @param array $data Data to update the case hearing with
     * @param CaseHearing $caseHearing The case hearing to update
     * @return bool True if the update was successful, false otherwise
     */
    public function update(array $data, CaseHearing $caseHearing): bool
    {
        // Update the case hearing with the provided data
        return $caseHearing->update($data);
    }

    /**
     * Delete the specified case hearing.
     * 
     * @param CaseHearing $caseHearing The case hearing to delete
     * @return bool True if the deletion was successful, false otherwise
     */
    public function delete(CaseHearing $caseHearing): bool
    {
        // Delete the case hearing and return the result
        return $caseHearing->delete();
    }

    /**
     * Find a case hearing by ID with its related case and client.
     * 
     * @param int $id The ID of the case hearing
     * @return Model|Collection|Builder|array|null
     */
    public function findWithCaseAndClient(int $id): Model|Collection|Builder|array|null
    {
        // Fetch the case hearing with its related case and client
        return CaseHearing::with('case.client')->find($id);
    }
}
