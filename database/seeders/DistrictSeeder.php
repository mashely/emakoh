<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = [
            [
                "reg_code" => "01",
                "dis_code" => "01",
                "dis_name" => "Kondoa"
            ],
            [
                "reg_code" => "01",
                "dis_code" => "02",
                "dis_name" => "Mpwapwa"
            ],
            [
                "reg_code" => "01",
                "dis_code" => "03",
                "dis_name" => "Kongwa"
            ],
            [
                "reg_code" => "01",
                "dis_code" => "04",
                "dis_name" => "Chamwino"
            ],
            [
                "reg_code" => "01",
                "dis_code" => "05",
                "dis_name" => "Dodoma Urban"
            ],
            [
                "reg_code" => "01",
                "dis_code" => "06",
                "dis_name" => "Bahi"
            ],
            [
                "reg_code" => "01",
                "dis_code" => "07",
                "dis_name" => "Chemba"
            ],
            [
                "reg_code" => "02",
                "dis_code" => "01",
                "dis_name" => "Monduli"
            ],
            [
                "reg_code" => "02",
                "dis_code" => "02",
                "dis_name" => "Meru"
            ],
            [
                "reg_code" => "02",
                "dis_code" => "03",
                "dis_name" => "Arusha Urban"
            ],
            [
                "reg_code" => "02",
                "dis_code" => "04",
                "dis_name" => "Karatu"
            ],
            [
                "reg_code" => "02",
                "dis_code" => "05",
                "dis_name" => "Ngorongoro"
            ],
            [
                "reg_code" => "02",
                "dis_code" => "06",
                "dis_name" => "Arusha"
            ],
            [
                "reg_code" => "02",
                "dis_code" => "07",
                "dis_name" => "Longido"
            ],
            [
                "reg_code" => "03",
                "dis_code" => "01",
                "dis_name" => "Rombo"
            ],
            [
                "reg_code" => "03",
                "dis_code" => "02",
                "dis_name" => "Mwanga"
            ],
            [
                "reg_code" => "03",
                "dis_code" => "03",
                "dis_name" => "Same"
            ],
            [
                "reg_code" => "03",
                "dis_code" => "04",
                "dis_name" => "Moshi"
            ],
            [
                "reg_code" => "03",
                "dis_code" => "05",
                "dis_name" => "Hai"
            ],
            [
                "reg_code" => "03",
                "dis_code" => "06",
                "dis_name" => "Moshi Municipal"
            ],
            [
                "reg_code" => "03",
                "dis_code" => "07",
                "dis_name" => "Siha"
            ],
            [
                "reg_code" => "04",
                "dis_code" => "01",
                "dis_name" => "Lushoto"
            ],
            [
                "reg_code" => "04",
                "dis_code" => "02",
                "dis_name" => "Korogwe"
            ],
            [
                "reg_code" => "04",
                "dis_code" => "03",
                "dis_name" => "Muheza"
            ],
            [
                "reg_code" => "04",
                "dis_code" => "04",
                "dis_name" => "Tanga"
            ],
            [
                "reg_code" => "04",
                "dis_code" => "05",
                "dis_name" => "Pangani"
            ],
            [
                "reg_code" => "04",
                "dis_code" => "06",
                "dis_name" => "Handeni"
            ],
            [
                "reg_code" => "04",
                "dis_code" => "07",
                "dis_name" => "Kilindi"
            ],
            [
                "reg_code" => "04",
                "dis_code" => "08",
                "dis_name" => "Mkinga"
            ],
            [
                "reg_code" => "04",
                "dis_code" => "09",
                "dis_name" => "Korogwe Township Authority"
            ],
            [
                "reg_code" => "04",
                "dis_code" => "10",
                "dis_name" => "Handeni Township Authority"
            ],
            [
                "reg_code" => "05",
                "dis_code" => "01",
                "dis_name" => "Kilosa"
            ],
            [
                "reg_code" => "05",
                "dis_code" => "02",
                "dis_name" => "Morogoro"
            ],
            [
                "reg_code" => "05",
                "dis_code" => "03",
                "dis_name" => "Kilombero"
            ],
            [
                "reg_code" => "05",
                "dis_code" => "04",
                "dis_name" => "Ulanga"
            ],
            [
                "reg_code" => "05",
                "dis_code" => "05",
                "dis_name" => "Morogoro Urban"
            ],
            [
                "reg_code" => "05",
                "dis_code" => "06",
                "dis_name" => "Mvomero"
            ],
            [
                "reg_code" => "05",
                "dis_code" => "07",
                "dis_name" => "Gairo"
            ],
            [
                "reg_code" => "06",
                "dis_code" => "01",
                "dis_name" => "Bagamoyo"
            ],
            [
                "reg_code" => "06",
                "dis_code" => "02",
                "dis_name" => "Kibaha"
            ],
            [
                "reg_code" => "06",
                "dis_code" => "03",
                "dis_name" => "Kisarawe"
            ],
            [
                "reg_code" => "06",
                "dis_code" => "04",
                "dis_name" => "Mkuranga"
            ],
            [
                "reg_code" => "06",
                "dis_code" => "05",
                "dis_name" => "Rufiji"
            ],
            [
                "reg_code" => "06",
                "dis_code" => "06",
                "dis_name" => "Mafia"
            ],
            [
                "reg_code" => "06",
                "dis_code" => "07",
                "dis_name" => "Kibaha Urban"
            ],
            [
                "reg_code" => "07",
                "dis_code" => "01",
                "dis_name" => "Kinondoni"
            ],
            [
                "reg_code" => "07",
                "dis_code" => "02",
                "dis_name" => "Ilala"
            ],
            [
                "reg_code" => "07",
                "dis_code" => "03",
                "dis_name" => "Temeke"
            ],
            [
                "reg_code" => "08",
                "dis_code" => "01",
                "dis_name" => "Kilwa"
            ],
            [
                "reg_code" => "08",
                "dis_code" => "02",
                "dis_name" => "Lindi Rural"
            ],
            [
                "reg_code" => "08",
                "dis_code" => "03",
                "dis_name" => "Nachingwea"
            ],
            [
                "reg_code" => "08",
                "dis_code" => "04",
                "dis_name" => "Liwale"
            ],
            [
                "reg_code" => "08",
                "dis_code" => "05",
                "dis_name" => "Ruangwa"
            ],
            [
                "reg_code" => "08",
                "dis_code" => "06",
                "dis_name" => "Lindi Urban"
            ],
            [
                "reg_code" => "09",
                "dis_code" => "01",
                "dis_name" => "Mtwara Rural"
            ],
            [
                "reg_code" => "09",
                "dis_code" => "02",
                "dis_name" => "Newala"
            ],
            [
                "reg_code" => "09",
                "dis_code" => "03",
                "dis_name" => "Masasi"
            ],
            [
                "reg_code" => "09",
                "dis_code" => "04",
                "dis_name" => "Tandahimba"
            ],
            [
                "reg_code" => "09",
                "dis_code" => "05",
                "dis_name" => "Mtwara Urban"
            ],
            [
                "reg_code" => "09",
                "dis_code" => "06",
                "dis_name" => "Nanyumbu"
            ],
            [
                "reg_code" => "09",
                "dis_code" => "07",
                "dis_name" => "Masasi Township Authority"
            ],
            [
                "reg_code" => "10",
                "dis_code" => "01",
                "dis_name" => "Tunduru"
            ],
            [
                "reg_code" => "10",
                "dis_code" => "02",
                "dis_name" => "Songea Rural"
            ],
            [
                "reg_code" => "10",
                "dis_code" => "03",
                "dis_name" => "Mbinga"
            ],
            [
                "reg_code" => "10",
                "dis_code" => "04",
                "dis_name" => "Songea Urban"
            ],
            [
                "reg_code" => "10",
                "dis_code" => "05",
                "dis_name" => "Namtumbo"
            ],
            [
                "reg_code" => "10",
                "dis_code" => "06",
                "dis_name" => "Nyasa"
            ],
            [
                "reg_code" => "11",
                "dis_code" => "01",
                "dis_name" => "Iringa Rural"
            ],
            [
                "reg_code" => "11",
                "dis_code" => "02",
                "dis_name" => "Mufindi"
            ],
            [
                "reg_code" => "11",
                "dis_code" => "03",
                "dis_name" => "Iringa Urban"
            ],
            [
                "reg_code" => "11",
                "dis_code" => "04",
                "dis_name" => "Kilolo"
            ],
            [
                "reg_code" => "11",
                "dis_code" => "05",
                "dis_name" => "Mafinga Township Authority"
            ],
            [
                "reg_code" => "12",
                "dis_code" => "01",
                "dis_name" => "Chunya"
            ],
            [
                "reg_code" => "12",
                "dis_code" => "02",
                "dis_name" => "Mbeya Rural"
            ],
            [
                "reg_code" => "12",
                "dis_code" => "03",
                "dis_name" => "Kyela"
            ],
            [
                "reg_code" => "12",
                "dis_code" => "04",
                "dis_name" => "Rungwe"
            ],
            [
                "reg_code" => "12",
                "dis_code" => "05",
                "dis_name" => "Ileje"
            ],
            [
                "reg_code" => "12",
                "dis_code" => "06",
                "dis_name" => "Mbozi"
            ],
            [
                "reg_code" => "12",
                "dis_code" => "07",
                "dis_name" => "Mbarali"
            ],
            [
                "reg_code" => "12",
                "dis_code" => "08",
                "dis_name" => "Mbeya Urban"
            ],
            [
                "reg_code" => "12",
                "dis_code" => "09",
                "dis_name" => "Momba"
            ],
            [
                "reg_code" => "12",
                "dis_code" => "10",
                "dis_name" => "Tunduma"
            ],
            [
                "reg_code" => "13",
                "dis_code" => "01",
                "dis_name" => "Iramba"
            ],
            [
                "reg_code" => "13",
                "dis_code" => "02",
                "dis_name" => "Singida"
            ],
            [
                "reg_code" => "13",
                "dis_code" => "03",
                "dis_name" => "Manyoni"
            ],
            [
                "reg_code" => "13",
                "dis_code" => "04",
                "dis_name" => "Singida Urban"
            ],
            [
                "reg_code" => "13",
                "dis_code" => "05",
                "dis_name" => "Ikungi"
            ],
            [
                "reg_code" => "13",
                "dis_code" => "06",
                "dis_name" => "Mkalama"
            ],
            [
                "reg_code" => "14",
                "dis_code" => "01",
                "dis_name" => "Nzega"
            ],
            [
                "reg_code" => "14",
                "dis_code" => "02",
                "dis_name" => "Igunga"
            ],
            [
                "reg_code" => "14",
                "dis_code" => "03",
                "dis_name" => "Uyui"
            ],
            [
                "reg_code" => "14",
                "dis_code" => "04",
                "dis_name" => "Urambo"
            ],
            [
                "reg_code" => "14",
                "dis_code" => "05",
                "dis_name" => "Sikonge"
            ],
            [
                "reg_code" => "14",
                "dis_code" => "06",
                "dis_name" => "Tabora Urban"
            ],
            [
                "reg_code" => "14",
                "dis_code" => "07",
                "dis_name" => "Kaliua"
            ],
            [
                "reg_code" => "15",
                "dis_code" => "01",
                "dis_name" => "Kalambo"
            ],
            [
                "reg_code" => "15",
                "dis_code" => "02",
                "dis_name" => "Sumbawanga Rural"
            ],
            [
                "reg_code" => "15",
                "dis_code" => "03",
                "dis_name" => "Nkasi"
            ],
            [
                "reg_code" => "15",
                "dis_code" => "04",
                "dis_name" => "Sumbawanga Urban"
            ],
            [
                "reg_code" => "16",
                "dis_code" => "01",
                "dis_name" => "Kibondo"
            ],
            [
                "reg_code" => "16",
                "dis_code" => "02",
                "dis_name" => "Kasulu"
            ],
            [
                "reg_code" => "16",
                "dis_code" => "03",
                "dis_name" => "Kigoma Rural"
            ],
            [
                "reg_code" => "16",
                "dis_code" => "04",
                "dis_name" => "Kigoma Municipal-Ujiji"
            ],
            [
                "reg_code" => "16",
                "dis_code" => "05",
                "dis_name" => "Uvinza"
            ],
            [
                "reg_code" => "16",
                "dis_code" => "06",
                "dis_name" => "Buhigwe"
            ],
            [
                "reg_code" => "16",
                "dis_code" => "07",
                "dis_name" => "Kakonko"
            ],
            [
                "reg_code" => "16",
                "dis_code" => "08",
                "dis_name" => "Kasulu Township Authority"
            ],
            [
                "reg_code" => "17",
                "dis_code" => "01",
                "dis_name" => "Shinyanga Urban"
            ],
            [
                "reg_code" => "17",
                "dis_code" => "02",
                "dis_name" => "Kishapu"
            ],
            [
                "reg_code" => "17",
                "dis_code" => "03",
                "dis_name" => "Shinyanga Rural"
            ],
            [
                "reg_code" => "17",
                "dis_code" => "04",
                "dis_name" => "Kahama"
            ],
            [
                "reg_code" => "17",
                "dis_code" => "05",
                "dis_name" => "Kahama Township Authority"
            ],
            [
                "reg_code" => "18",
                "dis_code" => "01",
                "dis_name" => "Karagwe"
            ],
            [
                "reg_code" => "18",
                "dis_code" => "02",
                "dis_name" => "Bukoba Rural"
            ],
            [
                "reg_code" => "18",
                "dis_code" => "03",
                "dis_name" => "Muleba"
            ],
            [
                "reg_code" => "18",
                "dis_code" => "04",
                "dis_name" => "Biharamulo"
            ],
            [
                "reg_code" => "18",
                "dis_code" => "05",
                "dis_name" => "Ngara"
            ],
            [
                "reg_code" => "18",
                "dis_code" => "06",
                "dis_name" => "Bukoba Urban"
            ],
            [
                "reg_code" => "18",
                "dis_code" => "07",
                "dis_name" => "Missenyi"
            ],
            [
                "reg_code" => "18",
                "dis_code" => "08",
                "dis_name" => "Kyerwa"
            ],
            [
                "reg_code" => "19",
                "dis_code" => "01",
                "dis_name" => "Ukerewe"
            ],
            [
                "reg_code" => "19",
                "dis_code" => "02",
                "dis_name" => "Magu"
            ],
            [
                "reg_code" => "19",
                "dis_code" => "03",
                "dis_name" => "Nyamagana"
            ],
            [
                "reg_code" => "19",
                "dis_code" => "04",
                "dis_name" => "Kwimba"
            ],
            [
                "reg_code" => "19",
                "dis_code" => "05",
                "dis_name" => "Sengerema"
            ],
            [
                "reg_code" => "19",
                "dis_code" => "06",
                "dis_name" => "Ilemela"
            ],
            [
                "reg_code" => "19",
                "dis_code" => "07",
                "dis_name" => "Misungwi"
            ],
            [
                "reg_code" => "20",
                "dis_code" => "01",
                "dis_name" => "Tarime"
            ],
            [
                "reg_code" => "20",
                "dis_code" => "02",
                "dis_name" => "Serengeti"
            ],
            [
                "reg_code" => "20",
                "dis_code" => "03",
                "dis_name" => "Musoma"
            ],
            [
                "reg_code" => "20",
                "dis_code" => "04",
                "dis_name" => "Bunda"
            ],
            [
                "reg_code" => "20",
                "dis_code" => "06",
                "dis_name" => "Rorya"
            ],
            [
                "reg_code" => "20",
                "dis_code" => "07",
                "dis_name" => "Butiama"
            ],
            [
                "reg_code" => "21",
                "dis_code" => "01",
                "dis_name" => "Babati"
            ],
            [
                "reg_code" => "21",
                "dis_code" => "02",
                "dis_name" => "Hanang"
            ],
            [
                "reg_code" => "21",
                "dis_code" => "03",
                "dis_name" => "Mbulu"
            ],
            [
                "reg_code" => "21",
                "dis_code" => "04",
                "dis_name" => "Simanjiro"
            ],
            [
                "reg_code" => "21",
                "dis_code" => "05",
                "dis_name" => "Kiteto"
            ],
            [
                "reg_code" => "21",
                "dis_code" => "06",
                "dis_name" => "Babati Urban"
            ],
            [
                "reg_code" => "22",
                "dis_code" => "01",
                "dis_name" => "Njombe Urban"
            ],
            [
                "reg_code" => "22",
                "dis_code" => "02",
                "dis_name" => "Wanging'ombe"
            ],
            [
                "reg_code" => "22",
                "dis_code" => "03",
                "dis_name" => "Makete"
            ],
            [
                "reg_code" => "22",
                "dis_code" => "04",
                "dis_name" => "Njombe Rural"
            ],
            [
                "reg_code" => "22",
                "dis_code" => "05",
                "dis_name" => "Ludewa"
            ],
            [
                "reg_code" => "22",
                "dis_code" => "06",
                "dis_name" => "Makambako Township Authority"
            ],
            [
                "reg_code" => "23",
                "dis_code" => "01",
                "dis_name" => "Mpanda Urban"
            ],
            [
                "reg_code" => "23",
                "dis_code" => "02",
                "dis_name" => "Mpanda Rural"
            ],
            [
                "reg_code" => "23",
                "dis_code" => "03",
                "dis_name" => "Mlele"
            ],
            [
                "reg_code" => "24",
                "dis_code" => "01",
                "dis_name" => "Bariadi"
            ],
            [
                "reg_code" => "24",
                "dis_code" => "02",
                "dis_name" => "Itilima"
            ],
            [
                "reg_code" => "24",
                "dis_code" => "03",
                "dis_name" => "Meatu"
            ],
            [
                "reg_code" => "24",
                "dis_code" => "04",
                "dis_name" => "Maswa"
            ],
            [
                "reg_code" => "24",
                "dis_code" => "05",
                "dis_name" => "Busega"
            ],
            [
                "reg_code" => "25",
                "dis_code" => "01",
                "dis_name" => "Geita"
            ],
            [
                "reg_code" => "25",
                "dis_code" => "02",
                "dis_name" => "Nyang'wale"
            ],
            [
                "reg_code" => "25",
                "dis_code" => "03",
                "dis_name" => "Mbogwe"
            ],
            [
                "reg_code" => "25",
                "dis_code" => "04",
                "dis_name" => "Bukombe"
            ],
            [
                "reg_code" => "25",
                "dis_code" => "05",
                "dis_name" => "Chato"
            ],
            [
                "reg_code" => "51",
                "dis_code" => "01",
                "dis_name" => "Kaskazini A"
            ],
            [
                "reg_code" => "51",
                "dis_code" => "02",
                "dis_name" => "Kaskazini B"
            ],
            [
                "reg_code" => "52",
                "dis_code" => "01",
                "dis_name" => "Kati"
            ],
            [
                "reg_code" => "52",
                "dis_code" => "02",
                "dis_name" => "Kusini"
            ],
            [
                "reg_code" => "53",
                "dis_code" => "01",
                "dis_name" => "Magharibi"
            ],
            [
                "reg_code" => "53",
                "dis_code" => "02",
                "dis_name" => "Mjini"
            ],
            [
                "reg_code" => "54",
                "dis_code" => "01",
                "dis_name" => "Wete"
            ],
            [
                "reg_code" => "54",
                "dis_code" => "02",
                "dis_name" => "Micheweni"
            ],
            [
                "reg_code" => "55",
                "dis_code" => "01",
                "dis_name" => "Chake Chake"
            ],
            [
                "reg_code" => "55",
                "dis_code" => "02",
                "dis_name" => "Mkoani"
            ],
            [
                "reg_code" => "20",
                "dis_code" => "05",
                "dis_name" => "Musoma Municipal"
            ]
        ];

        foreach ($districts as $data) {
            District::updateOrCreate([
                'reg_code' => $data['reg_code'],
                'dis_code' => $data['dis_code'],
                'dis_name' => $data['dis_name']
            ]);
        }
    }
}
