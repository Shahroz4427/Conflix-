<?php

namespace App\Services;

use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\LawyerRepositoryInterface;

class AdminHomeService
{
    public function __construct(
        protected CompanyRepositoryInterface $companyRepository,
        protected ClientRepositoryInterface  $clientRepository,
        protected LawyerRepositoryInterface  $lawyerRepository
    ){}

    public function data():array
    {
        return [
            'companies' => $this->companyRepository->totalCompanyCount(),
            'clients' => $this->clientRepository->totalClientCount(),
            'lawyers' => $this->lawyerRepository->totalLawyerCount(),
            'active_subscription' => $this->companyRepository->totalCompanyActiveSubscriptionCount(),
            'inactive_subscription' => $this->companyRepository->totalCompanyInActiveSubscriptionCount(),
            'conflict_sent' => $this->companyRepository->totalConflictSendCount(),
        ];
    }

}
