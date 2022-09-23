<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOfficeColumnsToCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('care_managers', function (Blueprint $table) {
            $table->string('office_name');
            $table->string('corporate_name');
            $table->string('office_number', 10);
            $table->string('office_postcode', 7);
            $table->string('office_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('care_managers', function (Blueprint $table) {
            //
        });
    }
}
