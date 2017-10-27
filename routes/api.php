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
Route::get('lesson', 'LessonController@index');
Route::get('lesson/{id}', 'LessonController@show');

Route::get('vocabulary', 'VocabularyController@index');
Route::get('vocabulary/{id}', 'VocabularyController@show');
Route::get('vocabularyByLesson/{NumberLesson}', 'VocabularyController@VocaLesson');


Route::get('user','UserController@index');
Route::get('user/{id}','UserController@show');
Route::post('user','UserController@store');
Route::put('user/{id}','UserController@update');
Route::delete('user/{id}','UserController@delete');


Route::get('userLearnt/{idUser}/{idLesson}/{point}','UserLearntController@updatePoint');

Route::get('sentence','SentenceController@index');
Route::get('sentence/{id}','SentenceController@show');
Route::post('sentence','SentenceController@store');
Route::put('sentence/{id}','SentenceController@update');
Route::delete('sentence/{id}','SentenceController@delete');

Route::get('favourite','FavouriteWordController@index');
Route::get('favourite/{id}/{idVocabulary}','FavouriteWordController@show');
Route::post('favourite','FavouriteWordController@store');
Route::put('favourite/{idUser}','FavouriteWordController@update');
Route::delete('favourite/{id}','FavouriteWordController@delete');
Route::get('favouriteByUser/{idUser}','FavouriteWordController@favouriteByUser');

Route::get('memorize','MemorizeController@index');
Route::get('memorize/{id}','MemorizeController@show');
Route::post('memorize','MemorizeController@store');
Route::put('memorize/{id}','MemorizeController@update');
Route::delete('memorize/{id}','MemorizeController@destroy');
Route::get('getListMemorize/{idUser}','MemorizeController@getListMemorize');


Route::post('login','UserController@postLogin');
Route::get('logout','UserController@logout');
