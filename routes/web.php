<?php

use Illuminate\Support\Facades\Route;

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
    return view('dashboard');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/project', 'ProjectController@index')->name('project');
Route::post('/project-list', 'ProjectController@getList')->name('projectList');
Route::post('/project', 'ProjectController@createProject');
Route::patch('/project/{id}', 'ProjectController@getProjectById');
Route::put('/project/{id}', 'ProjectController@updateProject');
Route::delete('/project/{id}', 'ProjectController@deleteProject');

Route::get('/project-details', 'ProjectDetailsController@index')->name('project-details');
Route::post('/project-details-list', 'ProjectDetailsController@getList')->name('projectDetailsList');
Route::post('/project-details', 'ProjectDetailsController@createProjectDetails');
Route::patch('/project-details/{id}', 'ProjectDetailsController@getProjectDetailsById');
Route::put('/project-details/{id}', 'ProjectDetailsController@updateProjectDetails');
Route::delete('/project-details/{id}', 'ProjectDetailsController@deleteProjectDetails');

Route::post('/calculate-project', 'ProjectDetailsController@calculateById')->name('calculateByProject');


Route::get('/home', 'HomeController@index')->name('home');
