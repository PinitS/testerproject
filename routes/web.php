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

Route::resource('hashtag', 'HashtagController');

Route::resource('material', 'MaterialController');

Route::resource('job', 'JobController');

Route::resource('role', 'RoleController');

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test', function () {
    return view('page.test.index');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
