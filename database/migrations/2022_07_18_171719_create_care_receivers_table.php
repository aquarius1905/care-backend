<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareReceiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('care_receivers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('care_manager_id');
            $table->unsignedBigInteger('key_person_id');
            $table->string('name');
            $table->string('name_furigana');
            $table->date('birthday');
            $table->string('post_code', 7);
            $table->string('address');
            $table->string('insurer_number', 8);
            $table->string('insured_number', 11);
            $table->unsignedBigInteger('care_level_id');
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
        Schema::dropIfExists('care_receivers');
    }
}
