<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => "admin@cell5.com",
            'firstname' => "Dustin",
            'lastname' => "Ramirez",
            'middlename' => 'Sevilla',
            'password' => Hash::make('qqww1122')
        ]);
    }
}
