<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareReceiverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('care_receiver', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('care_manager_id');
            $table->string('name');
            $table->string('name_furigana');
            $table->date('birtyday');
            $table->string('post_code');
            $table->string('address');
            $table->unsignedInteger('care_level', 1);
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
        Schema::dropIfExists('care_receiver');
    }
}
