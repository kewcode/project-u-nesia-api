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

Route::get('auth/{providerName}', 'AuthController@redirectToProvider');
Route::get('auth/{providerName}/callback', 'AuthController@handleProviderCallback');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/app', 'HomeController@index')->name('home');


Route::prefix('v0')->group(function(){

    Route::middleware('auth')->get('/login/{domainName}', 'AuthController@login');
    
    Route::middleware('auth:api')->get('/user', function () {
        return Auth::user();
    });

});
