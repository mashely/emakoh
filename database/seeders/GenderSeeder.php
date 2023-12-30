<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = [
            [
                'id'=>1,
                'name'=>'Male'
            ],
            [
                'id'=>2,
                'name'=>'Female'
            ]
            ];
             // Insert users into the 'users' table
        DB::table('genders')->insert($genders);
    }
}
