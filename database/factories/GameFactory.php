<?php

use Faker\Generator as Faker;

$factory->define(App\Game::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,12),
        'date' => $faker->dateTimeThisMonth,
        'time' => $faker->time('H:i'),
        'location_id' => $faker->numberBetween(1,5),
        'age_id' => $faker->numberBetween(9,20),
        'home_team' => $faker->company,
        'home_team_score' => $faker->numberBetween(1,7),
        'away_team' => $faker->company,
        'away_team_score' => $faker->numberBetween(1,7),
        'center_name' => $faker->name,
        'ar1_name' => $faker->name,
        'ar2_name' => $faker->name,
        'th_name' => $faker->name,
        'comments' => $faker->sentence,
        'ussf_grade' => $faker->numberBetween(1,9),
        'game_fee' => $faker->numberBetween(1,95),
        'miles_run' => $faker->numberBetween(1,7),
        'type' => $faker->numberBetween(1,7),
        'platform' => 'Chrome'
    ];
});