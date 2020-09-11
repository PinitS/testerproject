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
Route::group(['middleware' => 'auth'], function () 
{
    Route::resource('hashtag', 'HashtagController');

    Route::resource('material', 'MaterialController');

    Route::resource('job', 'JobController');

    Route::resource('role', 'RoleController');

    Route::resource('category', 'CategoryController');

    Route::resource('userinfo', 'UserinfoController');

    Route::resource('userRole', 'UserRoleController');

    Route::get('/userinfo/{Ative}/{Usid}/' ,'UserinfoController@activeupdate')->name('userinfo.activeupdate');
});

Route::get('/', function () 
{
    if(Auth::user())
    {
        return redirect()->action('HashtagController@index');
    }
    else
    {
        return view('auth.login');
    }
    
});

// Route::get('/', function () {
//     return view('page.member.index');
// });


Auth::routes();




//for test

Route::get('/test', function () {
    return view('page.test.index');
});