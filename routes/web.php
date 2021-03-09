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
Route::get('login', 'UserController@login')->middleware('AlreadyLoggedIn')->name('login');
Route::get('register', 'UserController@register')->middleware('AlreadyLoggedIn')->name('register');
Route::get('home', 'UserController@home')->middleware('AuthCheck')->name('home');
Route::get('logout', 'UserController@logout')->name('logout');




Route::post('check', 'UserController@check')->name('check');
Route::post('save', 'UserController@savee')->name('save');

Route::group(['middleware' =>['AuthCheck']], function(){

});



URL::forceScheme('https');
