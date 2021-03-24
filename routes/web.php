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
//payment

Route::get('/', 'Users\HomeController@index');
Route::get('/home', 'Users\HomeController@index');
Route::post('course/payment', 'Users\UsersCoursesController@payment')->name('coursePayment');
Route::get('course/{slug}', ['uses'=>'Users\UsersCoursesController@show', 'as'=> 'courses.show']);
Route::post('lesson/{slug}/test', ['uses' => 'Users\UsersLessonsController@test', 'as' => 'lessons.test']);
Route::get('lesson/{course_id}/{slug}', ['uses'=>'Users\UsersLessonsController@show', 'as'=> 'lessons.show']);
Route::post('course/{course_id}/rating', ['uses' => 'Users\UsersCoursesController@rating', 'as' => 'courses.rating']);


// Registration Routes...
Route::get('register', ['uses'=>'Auth\RegisterController@showRegistrationForm', 'as'=> 'register']);
Route::post('register', ['uses'=>'Auth\RegisterController@register', 'as'=> 'register']);
Route::post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
