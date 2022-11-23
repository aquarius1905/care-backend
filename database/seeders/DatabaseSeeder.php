<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints(); //外部キーチェックを無効にする
        $this->call(CareLevelsTableSeeder::class);
        $this->call(ServiceTypesTableSeeder::class);
        $this->call(RehabilitationContentsTableSeeder::class);
        Schema::enableForeignKeyConstraints(); //外部キーチェックを有効にする
    }
}
