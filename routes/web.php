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

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function() {
        return view('pages.home');
    })->name('home');

    Route::get('/profile', function() {
        return view('pages.profile');
    })->name('profile');

    Route::resource('log-game', 'GameController');
});