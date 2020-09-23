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

Route::resource('rssfeed', 'RssfeedsController');
Route::resource('projects', 'ProjectController');
Route::resource('statuses', 'StatusController');
Route::resource('projects.wbs', 'ProjectWBSController')->parameters([
                'wbs' => 'wbs'
])->scoped();
Route::resource('work_units', 'WorkAmountController');
//Route::post('projects/{project}/deliverables', 'DeliverableController@store');
//Route::get('projects/{project}/wbs/{deliverable}', 'DeliverableController@show');
//Route::get('projects/{project}/wbs', 'DeliverableController@index');
//Route::patch('projects/{project}/wbs/{deliverable}', 'DeliverableController@update');


Auth::routes();