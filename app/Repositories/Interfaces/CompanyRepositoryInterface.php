<?php

namespace App\Repositories\Interfaces;

use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface CompanyRepositoryInterface
{
    public function getAllSubscriptionPlans(): Collection;

    public function getAllWithPagination(int $perPage = 10): LengthAwarePaginator;

    public function store(array $data): Company;

    public function findWithRelations(Company $company, array $relations): Builder|array|Collection|Model;

    public function update(Company $company, array $data): bool;

    public function delete(Company $company): bool;

    public function deactivate(Company $company): bool;

    public function getCompanyByAuthUser(): Company;

    public function getCompanyClients(): mixed;

    public function getCompanyLawyers(): mixed;

    public function getAuthCompanyID(): int;

    public function totalCompanyCount(): int;

    public function totalCompanyClientCount(): int;

    public function totalCompanyLawyerCount(): int;

    public function totalCompanyCaseCount(): int;

    public function totalCompanyConflictsCount(): int;

    public function totalCompanyActiveSubscriptionCount(): int;

    public function totalCompanyInActiveSubscriptionCount(): int;

    public function totalConflictSendCount(): int;

}
