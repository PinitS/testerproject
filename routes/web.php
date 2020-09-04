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
    return view('welcome');
});

Route::get('/index', function () {
    return view('page.member.index');
});

Route::get('/hastag', function () {
    return view('page.manager.hashtag');
});

Route::get('/userinfo', function () {
    return view('page.manager.userinfo');
});


Route::get('/master', function () {
    return view('layouts.master');
});