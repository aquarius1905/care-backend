<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaycareDiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daycare_diaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('care_recevier_id');
            $table->unsignedBigInteger('nursing_care_office_id');
            $table->date('date');
            $table->string('situation_at_home');
            $table->float('body_temperature', 2, 1);
            $table->unsignedTinyInteger('systonic_blood_pressure');
            $table->unsignedTinyInteger('diastolic_blood_pressure');
            $table->unsignedTinyInteger('pulse');
            $table->unsignedTinyInteger('staple_food');
            $table->unsignedTinyInteger('side_dish');
            $table->json('rehabilitations');
            $table->string('others_detail');
            $table->string('special_notes');
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daycare_diaries');
    }
}
