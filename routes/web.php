<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::view('/', 'index');
// Route::view('/movie', 'show');

Route::get('/', 'MoviesController@index')->name('movies.index');
Route::get('/movies/{movieId}', 'MoviesController@show')->name('movies.show');
Route::get('/actors', 'ActorsController@index')->name('actors.index');
Route::get('/actors/page/{page?}', 'ActorsController@index')->name('actors.page');
Route::get('/actors/{actorId}', 'ActorsController@show')->name('actors.show');
Route::get('/search', 'SearchController@index')->name('seacrh.index');
