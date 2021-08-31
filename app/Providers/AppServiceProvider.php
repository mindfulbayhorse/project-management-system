<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\ProjectObserver;
use App\Models\Project;
use App\Models\Deliverable;
use App\Observers\DeliverableObserver;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Blade;

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
        Blade::directive('widget', function($expression){
            
            $name = trim($expression);
            return '<?= resolve("App\Http\Widgets\LastSeenProject")->loadView(); ?>';
        });
        
        Project::observe(ProjectObserver::class);
        Deliverable::observe(DeliverableObserver::class);
        DB::connection()->setQueryGrammar(new \App\Database\Query\Grammars\MySqlGrammar);

    }
}
