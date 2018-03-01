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
        factory(App\User::class, 10)->create();

        DB::table('users')->insert([
            ['fname' => 'Zach', 'lname' => 'Yarid', 'email' => 'zach.yarid@gmail.com', 'password' => bcrypt('secret'), 'ussf_grade' => 6],
            ['fname' => 'Colin', 'lname' => 'Yarid', 'email' => 'colin.yarid11@gmail.com', 'password' => bcrypt('secret'), 'ussf_grade' => 8]
        ]);

    }
}
