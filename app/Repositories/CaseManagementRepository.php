<?php

namespace App\Repositories;

use App\Models\CaseManagement;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\CourtRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;

class CaseManagementRepository implements Interfaces\CaseManagementRepositoryInterface
{
    /**
     * Constructor to inject dependencies.
     * 
     * @param CompanyRepositoryInterface $companyRepository
     * @param CourtRepositoryInterface $courtRepository
     */
    public function __construct(
        protected CompanyRepositoryInterface $companyRepository,
        protected CourtRepositoryInterface   $courtRepository,
    ) {}

    /**
     * Get all cases with specified relations and pagination for the authenticated company.
     * 
     * @param array $relations Relations to load with each case
     * @param int $perPage Number of cases per page
     * @return LengthAwarePaginator
     */
    public function getAllCasesWithRelationsAndPagination(array $relations, int $perPage = 10): LengthAwarePaginator
    {
        // Fetch the authenticated company
        $company = $this->companyRepository->getCompanyByAuthUser();

        // Fetch cases belonging to the company with specified relations and paginate the results
        return CaseManagement::with($relations)
            ->where('company_id', $company->id)
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get all courts.
     * 
     * @return Collection
     */
    public function getAllCourts(): Collection
    {
        // Fetch all courts
        return $this->courtRepository->getAll();
    }

    /**
     * Get all clients for the authenticated company.
     * 
     * @return mixed
     */
    public function getAllCompanyClients(): mixed
    {
        // Fetch all clients belonging to the authenticated company
        return $this->companyRepository->getCompanyClients();
    }

    /**
     * Get all lawyers for the authenticated company.
     * 
     * @return mixed
     */
    public function getAllCompanyLawyers(): mixed
    {
        // Fetch all lawyers belonging to the authenticated company
        return $this->companyRepository->getCompanyLawyers();
    }

    /**
     * Store a new case for the authenticated company.
     * 
     * @param array $data Data for the new case
     * @return CaseManagement
     */
    public function store(array $data): CaseManagement
    {
        // Add the authenticated company's ID to the case data
        $data['company_id'] = $this->companyRepository->getAuthCompanyID();

        // Create and return the new case
        return CaseManagement::create($data);
    }

    /**
     * Load the specified case with the given relations.
     * 
     * @param CaseManagement $caseManagement
     * @param array $relations Relations to load
     * @return CaseManagement
     */
    public function loadWithRelations(CaseManagement $caseManagement, array $relations): CaseManagement
    {
        // Load and return the case with the specified relations
        return $caseManagement->load($relations);
    }

    /**
     * Update the specified case for the authenticated company.
     * 
     * @param CaseManagement $caseManagement
     * @param array $data Data to update the case with
     * @return bool
     */
    public function update(CaseManagement $caseManagement, array $data): bool
    {
        // Add the authenticated company's ID to the case data
        $data['company_id'] = $this->companyRepository->getAuthCompanyID();

        // Update and return the result
        return $caseManagement->update($data);
    }

    /**
     * Delete the specified case.
     * 
     * @param CaseManagement $caseManagement
     * @return bool
     */
    public function delete(CaseManagement $caseManagement): bool
    {
        // Delete the case and return the result
        return $caseManagement->delete();
    }

    /**
     * Get the client associated with the specified case.
     * 
     * @param CaseManagement $caseManagement
     * @return mixed
     */
    public function getClient(CaseManagement $caseManagement): mixed
    {
        // Return the client associated with the case
        return $caseManagement->client;
    }

    /**
     * Get all hearings related to the specified case.
     * 
     * @param CaseManagement $caseManagement
     * @return HasMany
     */
    public function getRelatedHearings(CaseManagement $caseManagement): HasMany
    {
        // Return the hearings associated with the case
        return $caseManagement->hearings();
    }
}
