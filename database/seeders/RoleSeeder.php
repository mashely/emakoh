<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id'=>1,
                'name'=>'Admin'
            ],
            [
                'id'=>2,
                'name'=>'Staff'
            ],
            [
                'id'=>3,
                'name'=>'Nurse'
            ],
            [
                'id'=>4,
                'name'=>'SRH Health care Expert'
            ]
            ];
             // Insert users into the 'roles' table
        DB::table('roles')->insert($roles);
    }
}
