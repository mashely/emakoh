<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userroles = [
            [
                'user_id'=>1,
                'role_id'=>1
            ]
            ];
             // Insert role_users into the 'roles' table
        DB::table('role_user')->insert($userroles);
    }
}
