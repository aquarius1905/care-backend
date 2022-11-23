<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CareLevel;

class CareLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $care_levels = [
            ['name' => "要支援1"],
            ['name' => "要支援2"],
            ['name' => "要介護1"],
            ['name' => "要介護2"],
            ['name' => "要介護3"],
            ['name' => "要介護4"],
            ['name' => "要介護5"]
        ];

        CareLevel::truncate();

        foreach ($care_levels as $care_level) {
            CareLevel::create($care_level);
        }
    }
}
