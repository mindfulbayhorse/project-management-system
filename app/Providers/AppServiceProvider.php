<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\ProjectObserver;
use App\Project;
use App\WorkBreakdownStructure;
use App\Observers\WorkBreakdownStructureObserver;
use App\Deliverable;
use App\Observers\DeliverableObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Project::observe(ProjectObserver::class);
        //WorkBreakdownStructure::observe(WorkBreakdownStructureObserver::class);
        //Deliverable::observe(DeliverableObserver::class);
    }
}
