<?php

use Illuminate\Database\Seeder;

class GameTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('game_types')->insert([
            ['name' => 'HRRA - High School', 'location' => 'Home School', 'assignor' => 'Al Overton'],
            ['name' => 'MTSOA - High School', 'location' => 'Home School', 'assignor' => 'Coz Minetos'],
            ['name' => 'Travel Soccer', 'location' => 'Various', 'assignor' => 'Various'],
            ['name' => 'State Cup', 'location' => 'Richard Siegel Soccer Complex', 'assignor' => 'Gina Foster'],
            ['name' => 'Smyrna Rotary Soccer Cup', 'location' => 'Rotary Soccer Park', 'assignor' => 'Stephen Shirley'],
        ]);
    }
}
