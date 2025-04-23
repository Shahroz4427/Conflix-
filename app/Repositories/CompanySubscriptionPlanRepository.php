<?php

namespace App\Repositories;

use App\Models\CompanySubscriptionPlan;
use App\Repositories\Interfaces\CompanySubscriptionPlanRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CompanySubscriptionPlanRepository implements CompanySubscriptionPlanRepositoryInterface
{

    public function getAll(): Collection
    {
        return CompanySubscriptionPlan::all();
    }

    public function deactivate(CompanySubscriptionPlan $plan): bool
    {
        $plan->is_active = 0;
        return $plan->save();
    }

}
