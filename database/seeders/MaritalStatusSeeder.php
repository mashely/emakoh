<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marital_status = [
            [
                'id'=>1,
                'name'=>'Single'
            ],
            [
                'id'=>2,
                'name'=>'Married'
            ]
            ];
             // Insert users into the 'users' table
        DB::table('marital_status')->insert($marital_status);
    }
}
