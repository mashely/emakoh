<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hospital;
use App\Models\Region;
use App\Models\District;
use App\Models\Ward;
use App\Models\User;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = User::orderBy('id')->value('id');
        $regionId = Region::orderBy('id')->value('id');
        $districtId = District::orderBy('id')->value('id');
        $wardId = Ward::orderBy('id')->value('id');

        if (!$userId || !$regionId || !$districtId || !$wardId) {
            return;
        }

        Hospital::updateOrCreate(
            ['name' => 'Muhimbili National Hospital'],
            [
                'phone_number' => '0220000000',
                'email' => 'info@mnh.go.tz',
                'region_id' => $regionId,
                'district_id' => $districtId,
                'ward_id' => $wardId,
                'location' => 'Dar es Salaam',
                'created_by' => $userId,
            ]
        );
    }
}

