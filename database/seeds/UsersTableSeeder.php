<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['fname' => 'Zach', 'lname' => 'Yarid', 'email' => 'zach.yarid@gmail.com', 'password' => bcrypt('secret'), 'ussf_grade' => 6],
            ['fname' => 'Test', 'lname' => 'Account', 'email' => 'test@logmygame.me', 'password' => bcrypt('secret'), 'ussf_grade' => 7]
        ]);
    }
}
