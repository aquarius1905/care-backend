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
            $table->foreignId('care_manager_id')->constrained();
            $table->foreignId('care_level_id')->constrained();
            $table->string('name');
            $table->string('name_furigana');
            $table->tinyInteger('gender');
            $table->date('birthday');
            $table->string('post_code', 7);
            $table->string('address');
            $table->string('insurer_number', 8);
            $table->string('insured_number', 10);
            $table->string('keyperson_name');
            $table->string('keyperson_name_furigana');
            $table->string('relationship');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('tel', 11);
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
