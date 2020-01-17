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
Route::post('projects/{project}/deliverables', 'DeliverableController@store');
Route::get('projects/{project}/deliverables/{deliverable}', 'DeliverableController@show');



Auth::routes();