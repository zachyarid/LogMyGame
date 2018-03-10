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
    Route::post('/profile', 'ProfileController@update')->name('profile.update');

    // Custom Routes
    Route::prefix('json')->group(function () {
        Route::get('teams', 'JsonController@showAllTeams')->name('json-teams');
        Route::get('referees', 'JsonController@showAllReferees')->name('json-referees');
    });

    // Custom with Resource
    Route::prefix('mileage')->group(function () {
        Route::get('pre-trip', 'MileageController@preTrip')->name('mileage.pretrip');
        Route::post('pre-trip', 'MileageController@storePreTrip')->name('mileage.pre-store');
        Route::put('pre-trip/{mileage}', 'MileageController@completePre')->name('mileage.pre-complete');
    });

    Route::prefix('gametype')->group(function() {
        Route::post('add/ajax', 'GameTypesController@storeAjax')->name('add-gametype');
        Route::get('gamesused/{type}', 'GameTypesController@viewGamesUsed')->name('gametype.games-used');
    });

    Route::prefix('gamelocation')->group(function () {
        Route::post('add/ajax', 'GameLocationsController@storeAjax')->name('add-gameloc');
        Route::get('gamesused/{location}', 'GameLocationsController@viewGamesUsed')->name('gamelocation.games-used');
    });

    Route::resource('game', 'GameController');
    Route::resource('payment', 'PaymentController');
    Route::resource('mileage', 'MileageController');
    Route::resource('gamelocation', 'GameLocationsController');
    Route::resource('gametype', 'GameTypesController');
});