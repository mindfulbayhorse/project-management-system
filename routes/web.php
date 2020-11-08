<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectWBSController;
use App\Http\Controllers\WBS_DeliverableController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\WorkAmountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::resource('projects.wbs', ProjectWBSController::class)->parameters([
                    'wbs' => 'wbs'
])->scoped();
    
Route::resource('projects.deliverables', WBS_DeliverableController::class);




Route::resource('work_units', WorkAmountController::class);


Auth::routes();
