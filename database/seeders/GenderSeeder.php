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
                'name'=>'male'
            ],
            [
                'id'=>2,
                'name'=>'female'
            ]
            ];
             // Insert users into the 'users' table
        DB::table('gender')->insert($genders);
    }
}
