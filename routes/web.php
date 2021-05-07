<?php

use App\Http\Controllers\ChartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
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

Route::get('/', 'AuthController@login')->name('login');
Route::get('register', 'AuthController@register')->name('register');
Route::post('store', 'AuthController@store')->name('store');
Route::post('authentication', 'AuthController@authentication')->name('authentication');
Route::post('authentication-api', 'AuthController@api_authentication')->name('authentication_api');
Route::post('authentication-api-logout', 'AuthController@authentication_api_logout')->name('authentication_api_logout');
Route::get('chart/{id}','StudentController@charts_test')->name('chart');
Route::get('admin-dashboard','UserController@index')->name('admin_dash');



Route::middleware('auth')->group(function(){
	Route::post('logout', 'AuthController@logout')->name('logout');

	Route::get('home', 'HomeController@index')->name('home');

	Route::resource('words', 'WordsController');
    Route::get('words/delete/{id}', 'WordsController@remove')->name('words.delete');

	Route::get('teacher/remove/{id}', 'TeacherController@delete')->name('teacher.remove.student');
	Route::get('teacher/assign-student', 'TeacherController@create_student')->name('teacher.create_student');
	Route::post('teacher/assign-student', 'TeacherController@store_student')->name('teacher.store_student');
    Route::post('teacher/multiple-delete', 'TeacherController@multiple_delete')->name('teacher.multi_delete');
	Route::resource('teacher', 'TeacherController');
    Route::get('student/score/show/{id}', 'StudentController@show')->name('student.show.score');
	Route::get('student/score/{id}', 'StudentController@api_scores')->name('student.scores');
	Route::resource('student', 'StudentController');
});


Route::get('easy', 'ChallengeController@easy')->name('challenge_easy');
Route::get('medium', 'ChallengeController@medium')->name('challenge_medium');
Route::get('hard', 'ChallengeController@hard')->name('challenge_hard');
Route::get('get-result', 'ChallengeController@getResult')->name('challenge_get_result');
Route::post('get-result', 'ChallengeController@getResult')->name('challenge_get_result_post');

URL::forceScheme('https');
