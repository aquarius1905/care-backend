<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DayofweeksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $day_of_weeks = [
            ['name' => "月曜日"],
            ['name' => "火曜日"],
            ['name' => "水曜日"],
            ['name' => "木曜日"],
            ['name' => "金曜日"],
            ['name' => "土曜日"],
            ['name' => "日曜日"]
        ];
        DB::table('dayofweeks')->insert($day_of_weeks);
    }
}
