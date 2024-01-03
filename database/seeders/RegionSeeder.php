<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            [
                'id'=>1,
                'name'=>'Dar es Salaam'
            ],
            [
                'id'=>2,
                'name'=>'Kilimanjaro'
            ],
            [
                'id'=>3,
                'name'=>'Tanga'
            ]
            ];
             // Insert regions into the 'regions' table
        DB::table('regions')->insert($regions);
    }
}
