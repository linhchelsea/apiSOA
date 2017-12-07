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
Route::post('vocabularyShow', 'VocabularyController@show');
Route::post('vocabularyByLesson', 'VocabularyController@VocaLesson');


Route::post('user','UserController@index');
Route::post('userProfile','UserController@show');
Route::post('userCreate','UserController@store');
Route::put('userUpdate','UserController@update');
Route::delete('userDelete','UserController@delete');


Route::post('userLearnt','UserLearntController@updatePoint');

Route::post('sentenceList','SentenceController@index');
Route::post('sentenceShow','SentenceController@show');
Route::post('sentenceStore','SentenceController@store');
Route::put('sentenceUpdate','SentenceController@update');
Route::delete('sentenceDelete','SentenceController@delete');

Route::post('favourite','FavouriteWordController@index');
Route::post('favouriteShow','FavouriteWordController@show');
Route::post('favouriteStore','FavouriteWordController@store');
Route::delete('favouriteDelete','FavouriteWordController@destroy');
Route::post('favouriteByUser','FavouriteWordController@favouriteByUser');

Route::post('memorizeList','MemorizeController@index');
Route::post('memorizeShow','MemorizeController@show');
Route::post('memorizeStore','MemorizeController@store');
Route::put('memorizeUpdate','MemorizeController@update');
Route::delete('memorizeDelete','MemorizeController@destroy');
Route::post('memorizeByUser','MemorizeController@getListMemorize');

Route::post('topicList','TopicController@index');
Route::post('login','UserController@postLogin');
Route::post('logout','UserController@logout');
