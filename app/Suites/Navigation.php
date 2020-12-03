<?php 
namespace App\Suites;

use App\Models\SectionTitle;
use Illuminate\Support\Facades\Route;

trait Navigation{
    
    public function getSection(){
        
        return SectionTitle::where('code', Route::currentRouteName())->get()->first();
    }
}