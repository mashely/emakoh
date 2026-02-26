<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
           $this->call(GenderSeeder::class);
           $this->call(MaritalStatusSeeder::class);
           $this->call(IdTypeSeeder::class);

      //\App\Models\User::factory(10)->create();

      $this->call(UserSeeder::class);
      $this->call(RoleSeeder::class);
      $this->call(UserRoleSeeder::class);
      $this->call(RegionSeeder::class);
      $this->call(DistrictSeeder::class);
      $this->call(WardSeeder::class);
      $this->call(ServicesSeeder::class);
      $this->call(HospitalSeeder::class);
    }
}
