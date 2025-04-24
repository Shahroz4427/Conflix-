<?php

namespace App\Services;

use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\LawyerRepositoryInterface;

class AdminHomeService
{
    /**
     * Constructor to inject repository dependencies.
     * 
     * @param CompanyRepositoryInterface $companyRepository
     * @param ClientRepositoryInterface $clientRepository
     * @param LawyerRepositoryInterface $lawyerRepository
     */
    public function __construct(
        protected CompanyRepositoryInterface $companyRepository,
        protected ClientRepositoryInterface  $clientRepository,
        protected LawyerRepositoryInterface  $lawyerRepository
    ) {}

    /**
     * Fetch data for the admin home dashboard.
     * 
     * @return array An array containing various statistics for the dashboard
     */
    public function data(): array
    {
        return [
            // Total number of companies
            'companies' => $this->companyRepository->totalCompanyCount(),

            // Total number of clients
            'clients' => $this->clientRepository->totalClientCount(),

            // Total number of lawyers
            'lawyers' => $this->lawyerRepository->totalLawyerCount(),

            // Total number of active subscriptions
            'active_subscription' => $this->companyRepository->totalCompanyActiveSubscriptionCount(),

            // Total number of inactive subscriptions
            'inactive_subscription' => $this->companyRepository->totalCompanyInActiveSubscriptionCount(),

            // Total number of conflicts sent
            'conflict_sent' => $this->companyRepository->totalConflictSendCount(),
        ];
    }
}
