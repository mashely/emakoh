<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->bigIncrements('gender_id');
            $table->bigIncrements('id_type');
            $table->bigIncrements('id_number');
            $table->bigIncrements('region_id');
            $table->bigIncrements('district_id');
            $table->bigIncrements('ward_id');
            $table->string('physical_address');
            $table->string('phone_number');
            $table->string('patient_id');
            $table->bigIncrements('hospital_id');
            $table->bigIncrements('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
