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
            ['name' => 'HRRA - High School', 'location' => 'Home School', 'assignor' => 'Al Overton', 'is_default' => true],
            ['name' => 'MTSOA - High School', 'location' => 'Home School', 'assignor' => 'Coz Minetos', 'is_default' => true],
            ['name' => 'Travel Soccer', 'location' => 'Various', 'assignor' => 'Various', 'is_default' => true],
            ['name' => 'State Cup', 'location' => 'Richard Siegel Soccer Complex', 'assignor' => 'Gina Foster', 'is_default' => true],
            ['name' => 'Smyrna Rotary Soccer Cup', 'location' => 'Rotary Soccer Park', 'assignor' => 'Stephen Shirley', 'is_default' => true],
        ]);
    }
}
