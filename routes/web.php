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

    Route::get('/mail', function() {
        $game = App\Game::find([57, 58, 59])->sortBy('date');
        $mileage = App\Mileage::find([])->sortByDesc('date_travel');

        //dd($game);

        return new App\Mail\InviteUser(\Auth::user(),  substr(sha1(time()), 0, 12));
    });

    // Custom Routes
    Route::prefix('profile')->group(function () {
        Route::get('', 'ProfileController@index')->name('profile');
        Route::post('', 'ProfileController@update')->name('profile.update');
        Route::get('/email', 'ProfileController@emailPreferences')->name('profile.email');
        Route::post('/email', 'ProfileController@storeEmailPreferences')->name('profile.email-store');
    });

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
        Route::get('add-gt-gl', 'HelpController@addglgt')->name('help.add-gt-gl');
        Route::post('inquiry', 'HelpController@storeInquiry')->name('help.inquiry');
        Route::get('game-tutorial', 'HelpController@gameTutorial')->name('help.gameTutorial');
        Route::get('payment-tutorial', 'HelpController@paymentTutorial')->name('help.paymentTutorial');
        Route::get('mileage-tutorial', 'HelpController@mileageTutorial')->name('help.mileageTutorial');
        Route::get('{inquiry}', 'HelpController@viewInquiry');
    });

    Route::middleware(\App\Http\Middleware\IsAdministrator::class)->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('', 'AdminController@index')->name('admin.index');
            Route::post('invite', 'AdminController@invite')->name('admin.invite');
            Route::post('dashboard-msg', 'AdminController@dboardMsg')->name('admin.dboardmsg');
        });
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

    Route::prefix('payment')->group(function () {
        Route::get('add/{game}', 'PaymentController@createWithGame')->name('payment.add-game');
    });

    Route::resource('game', 'GameController');
    Route::resource('payment', 'PaymentController');
    Route::resource('mileage', 'MileageController');
    Route::resource('gamelocation', 'GameLocationsController');
    Route::resource('gametype', 'GameTypesController');
});