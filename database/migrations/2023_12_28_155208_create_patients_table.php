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
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('dob');
            $table->string('service');
            $table->unsignedBigInteger('gender_id');
            $table->unsignedBigInteger('id_type');
            $table->string('id_number');
            $table->string('service');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('ward_id');
            $table->unsignedBigInteger('marital_status_id');
            $table->string('physical_address');
            $table->string('phone_number');
            $table->string('patient_id');
            $table->unsignedBigInteger('hospital_id');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            // Define foreign key constraints if needed
            $table->foreign('gender_id')->references('id')->on('gender');
            $table->foreign('id_type')->references('id')->on('id_types');
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('ward_id')->references('id')->on('wards');
            $table->foreign('hospital_id')->references('id')->on('hospitals');
            $table->foreign('marital_status_id')->references('id')->on('marital_status');
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
