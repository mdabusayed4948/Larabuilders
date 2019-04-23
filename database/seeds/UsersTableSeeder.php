<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'role_id'  => '1',
            'name'     => 'admin',
            'username' => 'admin',
            'email'    => 'admin@gmail.com',
            'password' => bcrypt('adminadmin'),
        ]);

        DB::table('users')->insert([
            'role_id'  => '2',
            'name'     => 'user',
            'username' => 'user',
            'email'    => 'user@gmail.com',
            'password' => bcrypt('useruser'),
        ]);
    }
}
