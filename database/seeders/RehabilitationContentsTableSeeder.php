<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RehabilitationContent;

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

        RehabilitationContent::truncate();

        foreach ($rehabilitaion_contents as $rehabilitaion_content) {
            RehabilitationContent::create($rehabilitaion_content);
        }
    }
}
