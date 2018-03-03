<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            AgesTableSeeder::class,
            GameLocationTableSeeder::class,
            GameTypesTableSeeder::class,
            GamesTableSeeder::class,
            PaymentsTableSeeder::class,
        ]);
    }
}
