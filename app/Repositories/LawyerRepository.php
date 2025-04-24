<?php

namespace App\Repositories;

use App\Models\Lawyer;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\JurisdictionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class LawyerRepository implements Interfaces\LawyerRepositoryInterface
{
    /**
     * Constructor to inject dependencies.
     * 
     * @param CompanyRepositoryInterface $companyRepository
     * @param JurisdictionRepositoryInterface $jurisdictionRepository
     */
    public function __construct(
        protected CompanyRepositoryInterface $companyRepository,
        protected JurisdictionRepositoryInterface $jurisdictionRepository,
    ) {}

    /**
     * Get all lawyers with specified relations and pagination.
     * 
     * @param array $relations Relations to load with each lawyer
     * @param int $perPage Number of lawyers per page
     * @return LengthAwarePaginator
     */
    public function getAllLawyersWithRelationAndPagination(array $relations, int $perPage = 10): LengthAwarePaginator
    {
        // Fetch lawyers belonging to the authenticated company with specified relations and paginate the results
        return Lawyer::with($relations)
            ->where('company_id', $this->companyRepository->getAuthCompanyID())
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get all jurisdictions.
     * 
     * @return Collection
     */
    public function getAllJurisdiction(): Collection
    {
        // Fetch and return all jurisdictions
        return $this->jurisdictionRepository->getAll();
    }

    /**
     * Store a new lawyer for the authenticated company.
     * 
     * @param array $data Data for the new lawyer
     * @return Lawyer
     */
    public function store(array $data): Lawyer
    {
        // Add the authenticated company's ID to the lawyer data
        $data['company_id'] = $this->companyRepository->getAuthCompanyID();

        // Create and return the new lawyer
        return Lawyer::create($data);
    }

    /**
     * Load specified relations for a lawyer.
     * 
     * @param array $relations Relations to load
     * @param Lawyer $lawyer The lawyer to load relations for
     * @return Model
     */
    public function loadRelations(array $relations, Lawyer $lawyer): Model
    {
        // Load and return the specified relations for the lawyer
        return $lawyer->load('jurisdiction');
    }

    /**
     * Update the specified lawyer.
     * 
     * @param array $data Data to update the lawyer with
     * @param Lawyer $lawyer The lawyer to update
     * @return bool
     */
    public function update(array $data, Lawyer $lawyer): bool
    {
        // Add the authenticated company's ID to the lawyer data
        $data['company_id'] = $this->companyRepository->getAuthCompanyID();

        // Update and return the result
        return $lawyer->update($data);
    }

    /**
     * Delete the specified lawyer.
     * 
     * @param Lawyer $lawyer The lawyer to delete
     * @return bool
     */
    public function delete(Lawyer $lawyer): bool
    {
        // Delete the lawyer and return the result
        return $lawyer->delete();
    }

    /**
     * Get the total count of lawyers.
     * 
     * @return int
     */
    public function totalLawyerCount(): int
    {
        // Count and return the total number of lawyers
        return (int) Lawyer::count();
    }
}
