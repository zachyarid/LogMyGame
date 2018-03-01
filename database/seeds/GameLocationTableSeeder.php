<?php

use Illuminate\Database\Seeder;

class GameLocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('game_locations')->insert([
            ['location' => 'Richard Seigel Soccer Complex'],
            ['location' => 'Downs Boulevard'],
            ['location' => 'Smyrna Rotary Soccer Park'],
            ['location' => 'Mike Rose Soccer Complex'],
            ['location' => 'Camp Jordan Soccer Complex'],
            ['location' => 'Upper Cumberland United Soccer Complex'],
        ]);
    }
}
