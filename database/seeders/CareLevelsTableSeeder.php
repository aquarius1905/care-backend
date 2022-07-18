<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        DB::table('care_levels')->insert($care_levels);
    }
}
