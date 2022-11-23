<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNursingCareOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nursing_care_offices', function (Blueprint $table) {
            $table->id();
            $table->string('office_name');
            $table->string('corporate_name');
            $table->foreignId('service_type_id')->constrained();
            $table->string('office_number', 10);
            $table->string('post_code', 7);
            $table->string('address');
            $table->string('name');
            $table->string('name_furigana');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('tel', 11);
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('nursing_care_offices');
    }
}
