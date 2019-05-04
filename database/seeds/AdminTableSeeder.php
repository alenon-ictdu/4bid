<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'Liana',
            'middlename' => 'J',
            'lastname' => 'Lacson',
            'user_type' => 1,
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
