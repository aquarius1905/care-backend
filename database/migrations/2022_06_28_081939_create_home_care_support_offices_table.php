<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeCareSupportOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_care_support_offices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('support_office_id');
            $table->string('office_number', 8);
            $table->string('name');
            $table->string('post_code', 7);
            $table->string('address');
            $table->string('tel', 11);
            $table->string('fax', 11)->nullable();
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
        Schema::dropIfExists('home_care_support_offices');
    }
}
