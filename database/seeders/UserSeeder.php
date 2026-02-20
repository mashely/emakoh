<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



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
                'name'=>'Admin 1Mashely',
                'email'=>'admin@gmail.com',
                'username'=>'admin@gmail.com',
                'phone'=>'0765591131',
                'gender_id'=>'1',
                'active' =>1,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10)
            ],

            [
                'name'=>'Admin Deo',
                'email'=>'admiin@gmail.com',
                'username'=>'0765597134',
                'phone'=>'0765591131',
                'gender_id'=>'1',
                'active' =>1,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10)
            ]
            ];
             // Insert users into the 'users' table
        DB::table('users')->insert($users);
    }
}
