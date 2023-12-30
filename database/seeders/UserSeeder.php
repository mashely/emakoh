<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Generate user data here
         $users = [
            [
                'email'=>'admin@gmail.com',
                'password' => Hash::make('password'),
            ]
            ];
             // Insert users into the 'users' table
        DB::table('users')->insert($users);
    }
}
