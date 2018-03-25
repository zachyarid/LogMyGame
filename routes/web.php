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

    Route::prefix('export')->group(function () {
        Route::get('', 'ExportController@index')->name('export.index');
        Route::post('games', 'ExportController@exportGames')->name('export.games');
        Route::post('mileage', 'ExportController@exportMileage')->name('export.mileage');
        Route::post('payments', 'ExportController@exportPayments')->name('export.payments');
    });

    Route::prefix('import')->group(function () {
        Route::get('', 'ImportController@index')->name('import.index');
        Route::post('games', 'ImportController@importGames')->name('import.games');
        Route::get('instructions', 'ImportController@instructions')->name('import.instructions');
    });

    Route::prefix('help')->group(function () {
        Route::get('', 'HelpController@index')->name('help.index');
        Route::get('faq', 'HelpController@faq')->name('help.faq');
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