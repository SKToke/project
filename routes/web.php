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

Route::get('/project-details', 'ProjectController@index')->name('project-details');
Route::post('/project-details-list', 'ProjectController@getList')->name('projectDetailsList');
Route::post('/project-details', 'ProjectController@createProject');
Route::patch('/project-details/{id}', 'ProjectController@getProjectById');
Route::put('/project-details/{id}', 'ProjectController@updateProject');
Route::delete('/project-details/{id}', 'ProjectController@deleteProject');


Route::get('/home', 'HomeController@index')->name('home');
