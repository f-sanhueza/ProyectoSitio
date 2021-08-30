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


Auth::routes();


Route::group(['middleware' => 'auth'], function () {

    // Advance Routes
    Route::get('/students', 'StudentController@index')->name('index');
    Route::resource('students', 'StudentController');

    Route::get('students_data/get_data', 'StudentController@getStudent');


    Route::get('/professors', 'ProfessorController@index')->name('index');
    Route::resource('professors', 'ProfessorController');

    Route::get('professors_data/get_data', 'ProfessorController@getProfessor');


});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
