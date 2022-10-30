<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

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
            $table->unsignedBigInteger('weekly_service_schedule_id');
            $table->date('date');
            $table->string('situation_at_home')->nullable();
            $table->float('body_temperature');
            $table->unsignedTinyInteger('systonic_blood_pressure');
            $table->unsignedTinyInteger('diastolic_blood_pressure');
            $table->unsignedTinyInteger('pulse');
            $table->unsignedTinyInteger('staple_food');
            $table->unsignedTinyInteger('side_dish');
            $table->json('rehabilitations');
            $table->string('others_detail')->nullable();
            $table->string('special_notes')->nullable();
            $table->string('entry_person');
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
