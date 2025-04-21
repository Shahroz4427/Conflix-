<?php

namespace App\Providers;

use App\Models\CaseHearing;
use App\Observers\CaseHearingObserver;
use App\Services\ConflictDetectorService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        CaseHearing::observe(new CaseHearingObserver(new ConflictDetectorService()));

        Paginator::useBootstrap();
    }
}
