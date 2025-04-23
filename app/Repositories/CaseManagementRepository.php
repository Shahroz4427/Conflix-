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

    public function __construct(
        protected CompanyRepositoryInterface $companyRepository,
        protected CourtRepositoryInterface   $courtRepository,
    ){}

    public function getAllCasesWithRelationsAndPagination(array $relations, int $perPage = 10): LengthAwarePaginator
    {
        $company = $this->companyRepository->getCompanyByAuthUser();

        return CaseManagement::with($relations)
            ->where('company_id', $company->id)
            ->latest()
            ->paginate($perPage);
    }

    public function getAllCourts(): Collection
    {
        return $this->courtRepository->getAll();
    }

    public function getAllCompanyClients(): mixed
    {
        return $this->companyRepository->getCompanyClients();
    }

    public function getAllCompanyLawyers(): mixed
    {
        return $this->companyRepository->getCompanyLawyers();
    }

    public function store(array $data): CaseManagement
    {
        $data['company_id'] = $this->companyRepository->getAuthCompanyID();

        return CaseManagement::create($data);
    }

    public function loadWithRelations(CaseManagement $caseManagement, array $relations): CaseManagement
    {
        return $caseManagement->load($relations);
    }

    public function update(CaseManagement $caseManagement, array $data): bool
    {
        $data['company_id'] = $this->companyRepository->getAuthCompanyID();

        return $caseManagement->update($data);
    }

    public function delete(CaseManagement $caseManagement): bool
    {
        return $caseManagement->delete();
    }

    public function getClient(CaseManagement $caseManagement): mixed
    {
        return $caseManagement->client;
    }

    public function getRelatedHearings(CaseManagement $caseManagement): HasMany
    {
        return $caseManagement->hearings();
    }
}
