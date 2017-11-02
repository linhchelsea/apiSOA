<?php

use Illuminate\Http\Request;
use App\Article;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('lesson', 'LessonController@index');
Route::post('lessonShow', 'LessonController@show');

Route::post('vocabulary', 'VocabularyController@index');
Route::post('vocabulary/{id}', 'VocabularyController@show');
Route::post('vocabularyByLesson/{NumberLesson}', 'VocabularyController@VocaLesson');


Route::post('user','UserController@index');
Route::post('userProfile','UserController@show');
Route::post('userCreate','UserController@store');
Route::put('userUpdate','UserController@update');
Route::delete('userDelete','UserController@delete');


Route::post('userLearnt','UserLearntController@updatePoint');

Route::post('sentence','SentenceController@index');
Route::post('sentence/{id}','SentenceController@show');
Route::post('sentence','SentenceController@store');
Route::put('sentence/{id}','SentenceController@update');
Route::delete('sentence/{id}','SentenceController@delete');

Route::post('favourite','FavouriteWordController@index');
Route::post('favouriteShow','FavouriteWordController@show');
Route::post('favouriteStore','FavouriteWordController@store');
Route::delete('favouriteDelete','FavouriteWordController@destroy');
Route::post('favouriteByUser','FavouriteWordController@favouriteByUser');

Route::post('memorize','MemorizeController@index');
Route::post('memorize/{id}','MemorizeController@show');
Route::post('memorize','MemorizeController@store');
Route::put('memorize/{id}','MemorizeController@update');
Route::delete('memorize/{id}','MemorizeController@destroy');
Route::post('getListMemorize/{idUser}','MemorizeController@getListMemorize');


Route::post('login','UserController@postLogin');
Route::post('logout','UserController@logout');
