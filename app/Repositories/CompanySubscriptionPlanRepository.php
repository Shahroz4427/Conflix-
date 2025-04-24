<?php

namespace App\Repositories;

use App\Models\CompanySubscriptionPlan;
use App\Repositories\Interfaces\CompanySubscriptionPlanRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CompanySubscriptionPlanRepository implements CompanySubscriptionPlanRepositoryInterface
{
    /**
     * Get all subscription plans.
     * 
     * @return Collection
     */
    public function getAll(): Collection
    {
        // Fetch and return all subscription plans
        return CompanySubscriptionPlan::all();
    }

    /**
     * Deactivate a subscription plan.
     * 
     * @param CompanySubscriptionPlan $plan The subscription plan to deactivate
     * @return bool True if the deactivation was successful, false otherwise
     */
    public function deactivate(CompanySubscriptionPlan $plan): bool
    {
        // Set the subscription plan's status to inactive
        $plan->is_active = 0;

        // Save the changes and return the result
        return $plan->save();
    }
}
