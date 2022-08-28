<?php

namespace Database\Seeders;

use App\Models\HomeCareService;
use Illuminate\Database\Seeder;

class HomeCareServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            ['name' => '通所介護（デイサービス）'],
            ['name' => '通所リハビリテーション（デイケア）'],
            ['name' => '訪問看護'],
        ];
        foreach ($services as $service) {
            HomeCareService::create($service);
        }
    }
}
