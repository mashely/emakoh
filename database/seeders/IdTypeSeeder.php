<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class IdTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id_type = [
            [
                'id'=>1,
                'name'=>'Nida'
            ],
            [
                'id'=>2,
                'name'=>'Voters/Kitambulisho cha kupigia kura'
            ],
            [
                'id'=>3,
                'name'=>'Driving License'
            ]
            ];
             // Insert users into the 'users' table
        DB::table('id_types')->insert($id_type);
    }
}
