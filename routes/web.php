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
    return view('index');
})->name('index');

Auth::routes();
Route::get('/register', 'Auth\AuthController@register')->name('register');
Route::post('/register', 'Auth\AuthController@storeUser');

Route::get('/home', 'Auth\AuthController@login')->name('login');
Route::post('/login', 'Auth\AuthController@authenticate');
Route::get('logout', 'Auth\AuthController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/exercise','HomeController@exercise')->name('exercise');

// Exercise detail
Route::get('/exercise/{exercise_name}','HomeController@exercise_detail')->name('exercise-detail');
Route::post('/exercise-save','HomeController@exercise_save')->name('exercise-save');
Route::get('/workout', 'HomeController@workout')->name('workout');