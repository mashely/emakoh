<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

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
                'reg_code' => '01',
                'reg_name' => 'Dodoma',
            ],
            [
                'reg_code' => '02',
                'reg_name' => 'Arusha',
            ],
            [
                'reg_code' => '03',
                'reg_name' => 'Kilimanjaro',
            ],
            [
                'reg_code' => '04',
                'reg_name' => 'Tanga',
            ],
            [
                'reg_code' => '05',
                'reg_name' => 'Morogoro',
            ],
            [
                'reg_code' => '06',
                'reg_name' => 'Pwani',
            ],
            [
                'reg_code' => '07',
                'reg_name' => 'Dar-es-salaam',
            ],
            [
                'reg_code' => '08',
                'reg_name' => 'Lindi',
            ],
            [
                'reg_code' => '09',
                'reg_name' => 'Mtwara',
            ],
            [
                'reg_code' => '10',
                'reg_name' => 'Ruvuma',
            ],
            [
                'reg_code' => '11',
                'reg_name' => 'Iringa',
            ],
            [
                'reg_code' => '12',
                'reg_name' => 'Mbeya',
            ],
            [
                'reg_code' => '13',
                'reg_name' => 'Singida',
            ],
            [
                'reg_code' => '14',
                'reg_name' => 'Tabora',
            ],
            [
                'reg_code' => '15',
                'reg_name' => 'Rukwa',
            ],
            [
                'reg_code' => '16',
                'reg_name' => 'Kogoma',
            ],
            [
                'reg_code' => '17',
                'reg_name' => 'Shinyanga',
            ],
            [
                'reg_code' => '18',
                'reg_name' => 'Kagera',
            ],
            [
                'reg_code' => '19',
                'reg_name' => 'Mwanza',
            ],
            [
                'reg_code' => '20',
                'reg_name' => 'Mara',
            ],
            [
                'reg_code' => '21',
                'reg_name' => 'Manyara',
            ],
            [
                'reg_code' => '22',
                'reg_name' => 'Njombe',
            ],
            [
                'reg_code' => '23',
                'reg_name' => 'Katavi',
            ],
            [
                'reg_code' => '24',
                'reg_name' => 'Simiyu',
            ],
            [
                'reg_code' => '25',
                'reg_name' => 'Geita',
            ],
            [
                'reg_code' => '51',
                'reg_name' => 'Kaskazini Unguja',
            ],
            [
                'reg_code' => '52',
                'reg_name' => 'Kusini Unguja',
            ],
            [
                'reg_code' => '53',
                'reg_name' => 'Mjini Magharibi',
            ],
            [
                'reg_code' => '54',
                'reg_name' => 'Kaskazini Pemba',
            ],
            [
                'reg_code' => '55',
                'reg_name' => 'Kusini Pemba',
            ],
        ];

        foreach ($regions as $regionData) {
            Region::updateOrCreate([
                'reg_code' => $regionData['reg_code'],
                'reg_name' => $regionData['reg_name'],
            ]);
        }
    }
}
