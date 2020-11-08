<?php

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

Route::resource('projects', 'ProjectController')->names([
    'update' => 'project.update',
    'show' => 'project.show',
    'store' => 'project.create'
])->middleware(['auth']);

Route::resource('projects.wbs', 'ProjectWBSController')->parameters([
                'wbs' => 'wbs'
])->scoped();

Route::resource('projects.deliverables', 'WBS_DeliverableController');

Route::resource('rssfeed', 'RssfeedsController');

Route::resource('statuses', 'StatusController')->middleware(['auth']);

Route::resource('work_units', 'WorkAmountController');
//Route::post('projects/{project}/deliverables', 'DeliverableController@store');
//Route::get('projects/{project}/deliverables/{deliverable}/edit', 'WBS_DeliverableController@edit');
//Route::get('projects/{project}/wbs', 'DeliverableController@index');
//Route::patch('projects/{project}/wbs/{deliverable}', 'DeliverableController@update');


Auth::routes();