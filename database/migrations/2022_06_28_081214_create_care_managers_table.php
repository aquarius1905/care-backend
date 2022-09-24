<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('care_managers', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number', 8);
            $table->string('name');
            $table->string('name_furigana');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('tel', 11);
            $table->string('office_name');
            $table->string('corporate_name');
            $table->string('office_number', 10);
            $table->string('office_postcode', 7);
            $table->string('office_address');
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
        Schema::dropIfExists('care_managers');
    }
}
