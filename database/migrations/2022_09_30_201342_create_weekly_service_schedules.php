<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeeklyServiceSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_service_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('care_receiver_id');
            $table->unsignedTinyInteger('dayofweek_id');
            $table->unsignedBigInteger('nursing_care_office_id');
            $table->time('starting_time');
            $table->time('ending_time');
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
        Schema::dropIfExists('weekly_service_schedules');
    }
}
