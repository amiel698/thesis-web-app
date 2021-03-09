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

Route::get('/home', 'HomeController@index')->name('home');


Route::post('login', 'UserController@login')->middleware('AlreadyLoggedIn');
Route::post('register', 'UserController@register')->middleware('AlreadyLoggedIn');
Route::get('home', 'UserController@home')->middleware('isLogged');
Route::get('logout', 'UserController@logout')->name('logout');





URL::forceScheme('https');
