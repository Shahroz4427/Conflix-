<?php

namespace App\Repositories\Interfaces;


use App\Models\CompanySubscriptionPlan;
use Illuminate\Database\Eloquent\Collection;

interface CompanySubscriptionPlanRepositoryInterface
{
    public function getAll(): Collection;

    public function deactivate(CompanySubscriptionPlan $plan): bool;
}
