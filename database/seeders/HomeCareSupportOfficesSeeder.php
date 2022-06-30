<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeCareSupportOfficesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offices = [
            [
                'office_number' => '1370300000',
                'name' => 'ケアステーション新橋',
                'post_code' => '1050004',
                'address' => '東京都港区新橋1-2-3 福祉プラザ新橋',
                'tel' => '0311111111',
                'fax' => '0311112222',
                'email' => 'care_station_shimbashi@sample.com'
            ],
            [
                'office_number' => '1370300001',
                'name' => '居宅介護事業所赤坂',
                'post_code' => '1070052',
                'address' => '東京都港区赤坂2-3-4 赤坂ビル1階',
                'tel' => '0322222222',
                'fax' => '0322223333',
                'email' => 'care_office_akasaka@example.jp'
            ],
            [
                'office_number' => '1370300001',
                'name' => 'ケアマネステーション元麻布',
                'post_code' => '1060046',
                'address' => '東京都港区元麻布3-5-6',
                'tel' => '0333333333',
                'fax' => '0333334444',
                'email' => 'cms_motoazabu@sample.jp'
            ],
        ];
        foreach ($offices as $office) {
            DB::table('home_care_support_offices')->insert($office);
        }
    }
}
