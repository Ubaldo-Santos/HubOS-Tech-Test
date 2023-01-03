<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@hubos.com',
            'password' => bcrypt('admin'),
            'role' => 1,
        ]);
        DB::table('users')->insert([
            'name' => 'Alex',
            'email' => 'Alex@gmail.com',
            'password' => bcrypt('P@ssw0rd'),
            'role' => 0,
        ]);

        DB::table('users')->insert([
            'name' => 'Tom',
            'email' => 'Tom@gmail.com',
            'password' => bcrypt('P@ssw0rd'),
            'role' => 0,
        ]);

        DB::table('users')->insert([
            'name' => 'Laura',
            'email' => 'Laura@gmail.com',
            'password' => bcrypt('P@ssw0rd'),
            'role' => 0,
        ]);

        DB::table('users')->insert([
            'name' => 'Maria',
            'email' => 'Maria@gmail.com',
            'password' => bcrypt('P@ssw0rd'),
            'role' => 0,
        ]);
    }
}
