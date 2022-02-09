<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectWBSController;
use App\Http\Controllers\DeliverableController;
use App\Http\Controllers\DeliverableAsMilestoneController;
use App\Http\Controllers\DeliverableAsPackageController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\WorkAmountController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\CandidatesController;
use App\Http\Controllers\SectionTitleController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ProjectResourceController;
use App\Http\Controllers\ResourceTypeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ProjectEquipmentController;

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

Route::middleware(['auth', 'verified'])->group(function(){
    
    Route::resource('projects', ProjectController::class,['where'=>['project','[A-z_\-]+']]);
    
    Route::resource('projects.wbs', ProjectWBSController::class)->parameters([
        'wbs' => 'wbs'
    ])->scoped();
    
    Route::resource('projects.deliverables', DeliverableController::class)->names([
        'show' => 'deliverable'
    ]);
    
    Route::resource('resources_types', ResourceTypeController::class)->parameters([
        'resources_types' => 'resourceType'
    ]);
    
    Route::get('/projects/{project}/resources/equipment', 
        [ProjectEquipmentController::class, 'index'])
            ->name('projects.equipment.index');
    
    Route::get('/projects/{project}/resources/equipment/assign',
        [ProjectResourceController::class, 'chooseEquipment']);
    
    Route::post('/projects/{project}/resources/equipment', 
            [ProjectResourceController::class, 'assignEquipmentToProject']);
            
    Route::post('/projects/{project}/team', [TeamController::class, 'store']);
    
    Route::get('/projects/{project}/team', [TeamController::class, 'index']);
    
    Route::get('/projects/{project}/team/edit', [TeamController::class, 'edit']);
    
    Route::get('/projects/{project}/resources/',[
        ResourceController::class, 'index'
        ])->name('resources.index');
    
    Route::get('/projects/{project}/resources/{$type}',[
            ResourceController::class, 'show'
        ])->name('projects.resources.types.show');
    
    Route::resource('statuses', StatusController::class);
    
    Route::resource('work_units', WorkAmountController::class);
    
});


    
Route::prefix('wbs')->middleware(['auth', 'verified'])->group(function () {
    
    Route::post('/milestones/{deliverable}', 
            [DeliverableAsMilestoneController::class, 'store'])
            ->name('create_milestone');
    
    Route::delete('/milestones/{deliverable}', 
            [DeliverableAsMilestoneController::class, 'destroy'])
            ->name('destroy_milestone');
    
    Route::post('/packages/{deliverable}',
                [DeliverableAsPackageController::class, 'store'])
                ->name('create_package');
    
    Route::delete('/packages/{deliverable}', 
            [DeliverableAsPackageController::class, 'destroy'])
            ->name('destroy_package');
    
});

Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::resource('sections', SectionTitleController::class)->parameters([
        'section' => 'section'
    ])->middleware(['can:edit_section']);
    
    Route::resource('roles', RoleController::class);
});


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::group(['middleware'=>'auth'], function(){
    
    Route::resource('suppliers', SupplierController::class)->names([
        'show' => 'supplier'
    ]);
    
    Route::resource('candidates', CandidatesController::class)->parameters([
        'candidate' => 'candidate'
    ])->scoped();
    
    Route::resource('equipment', EquipmentController::class);
    
    Route::resource('profile', UserController::class)->names([
        'index' => 'profile'
    ]);

});

