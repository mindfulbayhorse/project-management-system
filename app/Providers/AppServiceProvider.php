<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\ProjectObserver;
use App\Models\Project;
use App\Models\Deliverable;
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
        Deliverable::observe(DeliverableObserver::class);
    }
}
