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
                'name'=>'admin mashely',
                'email'=>'admin@gmail.com',
                'username'=>'admin@gmail.com',
                'phone'=>'0765591131',
                'gender_id'=>'1',
                'password' => Hash::make('password'),
            ]
            ];
             // Insert users into the 'users' table
        DB::table('users')->insert($users);
    }
}
