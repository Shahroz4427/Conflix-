<?php

namespace App\Services;

use App\Repositories\Interfaces\CompanyRepositoryInterface;

class CompanyHomeService
{
    /**
     * Constructor to inject the CompanyRepository dependency.
     * 
     * @param CompanyRepositoryInterface $companyRepository
     */
    public function __construct(
        protected CompanyRepositoryInterface $companyRepository
    ) {}

    /**
     * Fetch data for the company home dashboard.
     * 
     * @return array An array containing various statistics for the dashboard
     */
    public function data(): array
    {
        return [
            // Total number of clients for the authenticated company
            'clients' => $this->companyRepository->totalCompanyClientCount(),

            // Total number of lawyers for the authenticated company
            'lawyers' => $this->companyRepository->totalCompanyLawyerCount(),

            // Total number of cases for the authenticated company
            'cases' => $this->companyRepository->totalCompanyCaseCount(),

            // Total number of conflicts for the authenticated company
            'conflicts' => $this->companyRepository->totalCompanyConflictsCount(),
        ];
    }
}
