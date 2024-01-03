<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'id'=>1,
                'name'=>'Pills',
                'description'=>'Vidonge vya majira',
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP')
            ],
            [
                'id'=>2,
                'name'=>'Condoms',
                'description'=>'Condumu',
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP')
            ],
            [
                'id'=>3,
                'name'=>'Intra-Uterine Devices',
                'description'=>'Kitanzi',
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP')
            ],
            [
                'id'=>4,
                'name'=>'Injectable',
                'description'=>'Sindano za Majira',
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP')
            ],
            [
                'id'=>5,
                'name'=>'Implants',
                'description'=>'Vipandikizi/vijiti',
                'created_at'=>DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=>DB::raw('CURRENT_TIMESTAMP')
            ]
            ];
             // Insert services into the 'services' table
        DB::table('services')->insert($services);
    }
}
