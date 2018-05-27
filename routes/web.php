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

Route::any('/','HomeController@index');


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group([
    'middleware' => 'auth',
], function () {

    Route::get('/show','BlogController@toShowTheBlog')->name('toshowblog');

    Route::any('/add', 'BlogController@addTheBlog');
    Route::post('/filter', ['as'=>'filterByCategory','uses'=>'FilterController@filterTheBlogsByCategory']);
    Route::post('/filterbydate', ['as'=>'filterByDate','uses'=>'FilterController@filterTheBlogsByDate']);
    Route::post('/filterbyauthor', ['as'=>'filterByAuthor','uses'=>'FilterController@filterTheBlogsByAuthor']);


});