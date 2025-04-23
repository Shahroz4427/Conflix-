<?php

namespace App\Repositories;

use App\Models\Company;
use App\Repositories\Interfaces\CompanySubscriptionPlanRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CompanyRepositoryRepository implements Interfaces\CompanyRepositoryInterface
{

    public function __construct(
        protected CompanySubscriptionPlanRepositoryInterface $companySubscriptionPlanRepository,
        protected UserRepositoryInterface $userRepository
    ){}

    public function getAllSubscriptionPlans(): Collection
    {
        return $this->companySubscriptionPlanRepository->getAll();
    }

    public function getAllWithPagination(int $perPage = 10): LengthAwarePaginator
    {
        return Company::latest()->with(['subscriptionPlan', 'user'])->paginate(10);
    }

    public function store(array $data): Company
    {
        $user = $this->userRepository->store($data, 'company');

        return Company::create([
            'status' => $data['status'],
            'company_subscription_plans_id' => $data['company_subscription_plans_id'],
            'user_id' => $user->id
        ]);
    }

    public function findWithRelations(Company $company, array $relations): Builder|array|Collection|Model
    {
        return Company::with($relations)->find($company->id);
    }

    public function update(Company $company, array $data): bool
    {
        $this->userRepository->update($company->user, $data);

        return $company->update($data);
    }

    public function delete(Company $company): bool
    {
        return $company->delete();
    }

    public function deactivate(Company $company): bool
    {
        $company->status = 'inactive';

        $this->companySubscriptionPlanRepository->deactivate($company->subscriptionPlan);

        return $company->save();
    }

    public function getCompanyByAuthUser(): Company
    {
        return Company::where('user_id', auth()->id())->firstOrFail();
    }

    public function getCompanyClients(): mixed
    {
        return $this->getCompanyByAuthUser()->clients;
    }

    public function getCompanyLawyers(): mixed
    {
        return $this->getCompanyByAuthUser()->lawyers;
    }

    public function getAuthCompanyID(): int
    {
        return $this->getCompanyByAuthUser()->id;
    }

    public function totalCompanyClientCount(): int
    {
        return $this->getCompanyByAuthUser()->clients->count();
    }

    public function totalCompanyLawyerCount(): int
    {
        return $this->getCompanyByAuthUser()->lawyers->count();
    }

    public function totalCompanyCaseCount(): int
    {
        return $this->getCompanyByAuthUser()->caseManagements->count();
    }

    public function totalCompanyConflictsCount(): int
    {
        return $this->getCompanyByAuthUser()->conflictLogs->count();
    }

    public function totalCompanyCount(): int
    {
        return Company::count();
    }

    public function totalCompanyActiveSubscriptionCount(): int
    {
        return Company::where('status', 'active')->count();
    }

    public function totalCompanyInActiveSubscriptionCount(): int
    {
        return Company::where('status', 'inactive')->count();
    }

    public function totalConflictSendCount() :int
    {
        return  Company::sum('total_conflict_sent');
    }
}
