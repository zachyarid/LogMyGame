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
    Route::put('/profile/{user}', 'ProfileController@update')->name('profile.update');

    // Custom Routes
    Route::prefix('add')->group(function () {
        Route::post('gamelocation', 'GameLocationsController@store')->name('add-gameloc');
        Route::post('gametype', 'GameTypesController@store')->name('add-gametype');
    });

    Route::prefix('json')->group(function () {
        Route::get('teams', 'JsonController@showAllTeams')->name('json-teams');
        Route::get('referees', 'JsonController@showAllReferees')->name('json-referees');
    });

    Route::prefix('mileage')->group(function () {
        Route::get('pre-trip', 'MileageController@preTrip')->name('mileage.pretrip');
        Route::post('pre-trip', 'MileageController@storePreTrip')->name('mileage.pre-store');
        Route::put('pre-trip/{mileage}', 'MileageController@completePre')->name('mileage.pre-complete');
    });

    Route::resource('game', 'GameController');
    Route::resource('payment', 'PaymentController');
    Route::resource('mileage', 'MileageController');
});