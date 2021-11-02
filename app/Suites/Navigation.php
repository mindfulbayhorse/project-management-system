<?php 
namespace App\Suites;

use App\Models\SectionTitle;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

trait Navigation{
    
    public function getSection(){
        
        $section = cache()->remember('section.breadcrumbs', now()->addDay(), function () {
            var_dump('new section title');
            return SectionTitle::where('code', Route::currentRouteName())->get()->first();
        });
        
        return $section;

    }
}