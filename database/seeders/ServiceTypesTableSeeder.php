<?php

namespace Database\Seeders;

use App\Models\ServiceType;
use Illuminate\Database\Seeder;

class ServiceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service_types = [
            ['name' => '通所介護（デイサービス）'],
            ['name' => '通所リハビリテーション（デイケア）'],
            ['name' => '訪問介護'],
            ['name' => '訪問看護'],
            ['name' => '訪問リハビリテーション'],
            ['name' => '短期入所生活介護（ショートステイ）'],
            ['name' => '短期入所療養介護（ショートステイ）'],
            ['name' => '福祉用具貸与'],
            ['name' => '居宅療養管理指導']
        ];

        ServiceType::truncate();

        foreach ($service_types as $service_type) {
            ServiceType::create($service_type);
        }
    }
}
