<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            ['name' => '通所介護'],
            ['name' => '通所リハビリテーション'],
            ['name' => '訪問看護'],
        ];
        foreach ($service_types as $service_type) {
            DB::table('service_types')->insert($service_type);
        }
    }
}
