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

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/profile', 'ProfileController@index')->name('profile');

    Route::resource('game', 'GameController');
    Route::resource('payment', 'PaymentController');
    Route::resource('mileage', 'MileageController');

    // Add GameLocation and GameType routes
    Route::post('/gamelocation/add', 'GameLocationsController@store')->name('add-gameloc');
    Route::post('/gametype/add', 'GameTypesController@store')->name('add-gametype');
});