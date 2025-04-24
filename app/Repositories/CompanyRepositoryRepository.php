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
    /**
     * Constructor to inject dependencies.
     *
     * @param CompanySubscriptionPlanRepositoryInterface $companySubscriptionPlanRepository
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        protected CompanySubscriptionPlanRepositoryInterface $companySubscriptionPlanRepository,
        protected UserRepositoryInterface $userRepository
    ) {}

    /**
     * Get all subscription plans.
     *
     * @return Collection
     */
    public function getAllSubscriptionPlans(): Collection
    {
        // Fetch all subscription plans
        return $this->companySubscriptionPlanRepository->getAll();
    }

    /**
     * Get all companies with pagination.
     *
     * @param int $perPage Number of companies per page
     * @return LengthAwarePaginator
     */
    public function getAllWithPagination(int $perPage = 10): LengthAwarePaginator
    {
        // Fetch all companies with their subscription plans and users, ordered by latest
        return Company::latest()->with(['subscriptionPlan', 'user'])->paginate($perPage);
    }

    /**
     * Store a new company.
     *
     * @param array $data Data for the new company
     * @return Company
     */
    public function store(array $data): Company
    {
        // Create a new user for the company
        $user = $this->userRepository->store($data, 'company');

        // Create and return the new company
        return Company::create([
            'status' => $data['status'],
            'company_subscription_plans_id' => $data['company_subscription_plans_id'],
            'user_id' => $user->id
        ]);
    }

    /**
     * Find a company with specified relations.
     *
     * @param Company $company
     * @param array $relations Relations to load
     * @return Builder|array|Collection|Model
     */
    public function findWithRelations(Company $company, array $relations): Builder|array|Collection|Model
    {
        // Fetch the company with the specified relations
        return Company::with($relations)->find($company->id);
    }

    /**
     * Update a company.
     *
     * @param Company $company
     * @param array $data Data to update the company with
     * @return bool
     */
    public function update(Company $company, array $data): bool
    {
        // Update the associated user
        $this->userRepository->update($company->user, $data);

        // Update and return the result
        return $company->update($data);
    }

    /**
     * Delete a company.
     *
     * @param Company $company
     * @return bool
     */
    public function delete(Company $company): bool
    {
        // Delete the company and return the result
        return $company->delete();
    }

    /**
     * Deactivate a company and its subscription plan.
     *
     * @param Company $company
     * @return bool
     */
    public function deactivate(Company $company): bool
    {
        // Set the company's status to inactive
        $company->status = 'inactive';

        // Deactivate the company's subscription plan
        $this->companySubscriptionPlanRepository->deactivate($company->subscriptionPlan);

        // Save and return the result
        return $company->save();
    }

    /**
     * Get the company associated with the authenticated user.
     *
     * @return Company
     */
    public function getCompanyByAuthUser(): Company
    {
        // Fetch the company where the user ID matches the authenticated user's ID
        return Company::where('user_id', auth()->id())->firstOrFail();
    }

    /**
     * Get all clients for the authenticated company.
     *
     * @return mixed
     */
    public function getCompanyClients(): mixed
    {
        // Fetch all clients associated with the authenticated company
        return $this->getCompanyByAuthUser()->clients;
    }

    /**
     * Get all lawyers for the authenticated company.
     *
     * @return mixed
     */
    public function getCompanyLawyers(): mixed
    {
        // Fetch all lawyers associated with the authenticated company
        return $this->getCompanyByAuthUser()->lawyers;
    }

    /**
     * Get the authenticated company's ID.
     *
     * @return int
     */
    public function getAuthCompanyID(): int
    {
        // Return the ID of the authenticated company
        return $this->getCompanyByAuthUser()->id;
    }

    /**
     * Get the total count of clients for the authenticated company.
     *
     * @return int
     */
    public function totalCompanyClientCount(): int
    {
        // Count and return the total number of clients
        return $this->getCompanyByAuthUser()->clients->count();
    }

    /**
     * Get the total count of lawyers for the authenticated company.
     *
     * @return int
     */
    public function totalCompanyLawyerCount(): int
    {
        // Count and return the total number of lawyers
        return $this->getCompanyByAuthUser()->lawyers->count();
    }

    /**
     * Get the total count of cases for the authenticated company.
     *
     * @return int
     */
    public function totalCompanyCaseCount(): int
    {
        // Count and return the total number of cases
        return $this->getCompanyByAuthUser()->caseManagements->count();
    }

    /**
     * Get the total count of conflicts for the authenticated company.
     *
     * @return int
     */
    public function totalCompanyConflictsCount(): int
    {
        // Count and return the total number of conflicts
        return $this->getCompanyByAuthUser()->conflictLogs->count();
    }

    /**
     * Get the total count of all companies.
     *
     * @return int
     */
    public function totalCompanyCount(): int
    {
        // Count and return the total number of companies
        return (int) Company::count();
    }

    /**
     * Get the total count of active subscriptions across all companies.
     *
     * @return int
     */
    public function totalCompanyActiveSubscriptionCount(): int
    {
        // Count and return the total number of active subscriptions
        return (int) Company::where('status', 'active')->count();
    }

    /**
     * Get the total count of inactive subscriptions across all companies.
     *
     * @return int
     */
    public function totalCompanyInActiveSubscriptionCount(): int
    {
        // Count and return the total number of inactive subscriptions
        return (int) Company::where('status', 'inactive')->count();
    }

    /**
     * Get the total count of conflicts sent across all companies.
     *
     * @return int
     */
    public function totalConflictSendCount(): int
    {
        // Sum and return the total number of conflicts sent
        return (int) Company::sum('total_conflict_sent');
    }
}
