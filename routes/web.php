<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\User;

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

//GET
Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', 'UserController@logout')->name('logout');
Route::get('data', 'UserController@index')->name('data');

//POST
Route::post('check', 'UserController@check')->name('check');
Route::post('save', 'UserController@save')->name('save');

 Route::group(['middleware' =>['AuthCheck']], function(){
    Route::get('home', 'UserController@home')->name('home');
    Route::get('login', 'UserController@login')->name('login');
    Route::get('register', 'UserController@register')->name('register');
 });



URL::forceScheme('https');
