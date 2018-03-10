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
            ['location' => 'Richard Seigel Soccer Complex', 'is_default' => true],
            ['location' => 'Downs Boulevard', 'is_default' => true],
            ['location' => 'Smyrna Rotary Soccer Park', 'is_default' => true],
            ['location' => 'Mike Rose Soccer Complex', 'is_default' => true],
            ['location' => 'Camp Jordan Soccer Complex', 'is_default' => true],
            ['location' => 'Upper Cumberland United Soccer Complex', 'is_default' => true],
        ]);
    }
}
