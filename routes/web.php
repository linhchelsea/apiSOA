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

Route::group(['prefix'=> 'admin','namespace'=>'BackEnd'],function (){
    Route::get('/','UserController@index');
    Route::resource('users','UserController');
    Route::resource('lessons','LessonController');
    Route::resource('topics','TopicController');
    Route::resource('sentences','SentenceController');
    Route::resource('user-learnt','UserLearntController');
    Route::resource('vocabularies','VocabularyController');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
