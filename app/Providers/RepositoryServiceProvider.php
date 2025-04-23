<?php

namespace App\Providers;

use App\Repositories\CaseHearingRepository;
use App\Repositories\CaseManagementRepository;
use App\Repositories\ClientRepository;
use App\Repositories\CompanyConflictLetterTemplateRepository;
use App\Repositories\CompanyRepositoryRepository;
use App\Repositories\CompanySubscriptionPlanRepository;
use App\Repositories\CourtRepository;
use App\Repositories\Interfaces\CaseHearingRepositoryInterface;
use App\Repositories\Interfaces\CaseManagementRepositoryInterface;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Repositories\Interfaces\CompanyConflictLetterTemplateRepositoryInterface;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\CompanySubscriptionPlanRepositoryInterface;
use App\Repositories\Interfaces\CourtRepositoryInterface;
use App\Repositories\Interfaces\JurisdictionRepositoryInterface;
use App\Repositories\Interfaces\LawyerRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\JurisdictionRepository;
use App\Repositories\LawyerRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            CompanyConflictLetterTemplateRepositoryInterface::class,
            CompanyConflictLetterTemplateRepository::class
        );

        $this->app->bind(
            CompanySubscriptionPlanRepositoryInterface::class,
            CompanySubscriptionPlanRepository::class
        );

        $this->app->bind(
            CompanyRepositoryInterface::class,
            CompanyRepositoryRepository::class,
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class,
        );

        $this->app->bind(
            CaseManagementRepositoryInterface::class,
            CaseManagementRepository::class,
        );

        $this->app->bind(
            CourtRepositoryInterface::class,
            CourtRepository::class,
        );

        $this->app->bind(
            CaseHearingRepositoryInterface::class,
            CaseHearingRepository::class,
        );

        $this->app->bind(
            ClientRepositoryInterface::class,
            ClientRepository::class
        );

        $this->app->bind(
            JurisdictionRepositoryInterface::class,
              JurisdictionRepository::class,
        );

        $this->app->bind(
            LawyerRepositoryInterface::class,
            LawyerRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
