<?php

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\Village;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamps = date('Y-m-d H:i:s');
        $province = new Province;
        $province->insert(array(
            [
                'Name' => 'DKI Jakarta',
                'ProvinceCode' => '31',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Jawa Barat',
                'ProvinceCode' => '32',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ]
        ));
        $city = new City;
        $city->insert(array(
            [
                'Name' => 'Kota Jakarta Selatan',
                'CityCode' => '3171',
                'ProvinceCode' => '31',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Kota Jakarta Timur',
                'CityCode' => '3172',
                'ProvinceCode' => '31',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Kota Bandung',
                'CityCode' => '3273',
                'ProvinceCode' => '32',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Kab. Bandung',
                'CityCode' => '3204',
                'ProvinceCode' => '32',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ]
        ));
        $district = new District;
        $district->insert(array(
            [
                'Name' => 'Jagakarsa',
                'DistrictCode' => '3171010',
                'CityCode' => '3171',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Pasar Minggu',
                'DistrictCode' => '3171020',
                'CityCode' => '3171',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Pasar Rebo',
                'DistrictCode' => '3172010',
                'CityCode' => '3172',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Ciracas',
                'DistrictCode' => '3172020',
                'CityCode' => '3172',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Bandung Kulon',
                'DistrictCode' => '3273010',
                'CityCode' => '3273',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Babakan Ciparay',
                'DistrictCode' => '3273020',
                'CityCode' => '3273',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Banjaran',
                'DistrictCode' => '3204160',
                'CityCode' => '3204',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Cangkuang',
                'DistrictCode' => '3204161',
                'CityCode' => '3204',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ]
        ));
        $village = new Village;
        $village->insert(array(
            [
                'Name' => 'Cipedak',
                'VillageCode' => '3171010001',
                'DistrictCode' => '3171010',
                'ZipCode' => '12630',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Srengseng Sawah',
                'VillageCode' => '3171010002',
                'DistrictCode' => '3171010',
                'ZipCode' => '12640',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Cilandak Timur',
                'VillageCode' => '3171020001',
                'DistrictCode' => '3171020',
                'ZipCode' => '12560',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Ragunan',
                'VillageCode' => '3171020002',
                'DistrictCode' => '3171020',
                'ZipCode' => '12550',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Pekayonan',
                'VillageCode' => '3172010001',
                'DistrictCode' => '3172010',
                'ZipCode' => '13710',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Kalisari',
                'VillageCode' => '3172010002',
                'DistrictCode' => '3172010',
                'ZipCode' => '13790',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Cibubur',
                'VillageCode' => '3172020001',
                'DistrictCode' => '3172020',
                'ZipCode' => '13720',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Kelapa Dua Wetan',
                'VillageCode' => '3172020002',
                'DistrictCode' => '13730',
                'ZipCode' => '13730',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Gempol Sari',
                'VillageCode' => '3273010001',
                'DistrictCode' => '3273010',
                'ZipCode' => '40215',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Cigondewah Kaler',
                'VillageCode' => '3273010002',
                'DistrictCode' => '3273010',
                'ZipCode' => '40214',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Margasuka',
                'VillageCode' => '3273020001',
                'DistrictCode' => '3273020',
                'ZipCode' => '40225',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Cirangrang',
                'VillageCode' => '3273020002',
                'DistrictCode' => '3273020',
                'ZipCode' => '40227',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Mekarjaya',
                'VillageCode' => '3204160001',
                'DistrictCode' => '3204160',
                'ZipCode' => '40377',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Banjaran Wetan',
                'VillageCode' => '3204160002',
                'DistrictCode' => '3204160',
                'ZipCode' => '40377',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Pananjung',
                'VillageCode' => '3204161004',
                'DistrictCode' => '3204161',
                'ZipCode' => '40238',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'Name' => 'Ciluncat',
                'VillageCode' => '3204161006',
                'DistrictCode' => '3204161',
                'ZipCode' => '40238',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ]
        ));
    }
}
