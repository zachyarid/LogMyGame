<?php

namespace App\Providers;

use App\Game;
use App\Payment;
use App\Mileage;
use App\GameLocation;
use App\GameType;
use App\Policies\GamePolicy;
use App\Policies\MileagePolicy;
use App\Policies\PaymentPolicy;
use App\Policies\GameLocationPolicy;
use App\Policies\GameTypePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // Don't forget to include both classes above!!!!!
        Game::class => GamePolicy::class,
        Payment::class => PaymentPolicy::class,
        Mileage::class => MileagePolicy::class,
        GameLocation::class => GameLocationPolicy::class,
        GameType::class => GameTypePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}