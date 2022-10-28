<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RehabilitationContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rehabilitaion_contents = [
            ['name' => "筋力トレーニング（上肢・下肢・体幹）"],
            ['name' => "立ち上がり練習"],
            ['name' => "ストレッチ"],
            ['name' => "温熱療法"],
            ['name' => "自転車運動"],
            ['name' => "歩行練習"],
            ['name' => "リハビリ計画書"],
            ['name' => "その他"]
        ];
        DB::table('rehabilitation_contents')->insert($rehabilitaion_contents);
    }
}
