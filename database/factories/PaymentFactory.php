<?php

use Faker\Generator as Faker;

$factory->define(App\Payment::class, function (Faker $faker) {
    return [
        'game_id' => $faker->numberBetween(1, 30),
        'user_id' => $faker->numberBetween(1,12),
        'payer' => $faker->company,
        'check_number' => $faker->numberBetween(1000,500000),
        'date_received' => $faker->dateTimeThisMonth,
    ];
});
