<?php

use Illuminate\Database\Seeder;

class AgesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ages')->insert([
            ['string' => 'U8', 'id' => 8],
            ['string' => 'U9', 'id' => 9],
            ['string' => 'U10', 'id' => 10],
            ['string' => 'U11', 'id' => 11],
            ['string' => 'U12', 'id' => 12],
            ['string' => 'U13', 'id' => 13],
            ['string' => 'U14', 'id' => 14],
            ['string' => 'U15', 'id' => 15],
            ['string' => 'U16', 'id' => 16],
            ['string' => 'U17', 'id' => 17],
            ['string' => 'U18', 'id' => 18],
            ['string' => 'U19', 'id' => 19],
            ['string' => 'Adult', 'id' => 20],
        ]);
    }
}
