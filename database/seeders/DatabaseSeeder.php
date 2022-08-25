<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ServiceTypesTableSeeder::class);
        $this->call(HomeCareSupportOfficesSeeder::class);
        $this->call(CareLevelsTableSeeder::class);
        $this->call(HomeCareServicesTableSeeder::class);
    }
}
