<?php

namespace App\Services;

use App\Repositories\Interfaces\CompanyRepositoryInterface;

class CompanyHomeService
{
    public function __construct(
        protected CompanyRepositoryInterface $companyRepository
    ){}

    public function data():array
    {
        return [
            'clients' => $this->companyRepository->totalCompanyClientCount(),
            'lawyers' => $this->companyRepository->totalCompanyLawyerCount(),
            'cases' => $this->companyRepository->totalCompanyCaseCount(),
            'conflicts' =>  $this->companyRepository->totalCompanyConflictsCount() ,
        ];
    }
}
