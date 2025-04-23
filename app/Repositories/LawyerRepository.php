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

    public function __construct(
        protected CompanyRepositoryInterface $companyRepository,
        protected JurisdictionRepositoryInterface $jurisdictionRepository,

    ){}

    public function getAllLawyersWithRelationAndPagination(array $relations, int $perPage = 10): LengthAwarePaginator
    {
        return Lawyer::with($relations)
            ->where('company_id', $this->companyRepository->getAuthCompanyID())
            ->latest()
            ->paginate($perPage);
    }

    public function getAllJurisdiction(): Collection
    {
        return $this->jurisdictionRepository->getAll();
    }

    public function store(array $data): Lawyer
    {
        $data['company_id'] = $this->companyRepository->getAuthCompanyID();

        return Lawyer::create($data);
    }

    public function loadRelations(array $relations,Lawyer $lawyer): Model
    {
       return $lawyer->load('jurisdiction');
    }

    public function update(array $data, Lawyer $lawyer): bool
    {
        $data['company_id'] = $this->companyRepository->getAuthCompanyID();

        return $lawyer->update($data);
    }

    public function delete(Lawyer $lawyer): bool
    {
        return $lawyer->delete();
    }

    public function totalLawyerCount(): int
    {
        return Lawyer::count();
    }
}
