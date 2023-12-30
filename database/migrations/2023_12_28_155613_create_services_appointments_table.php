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
        Schema::create('service_appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('service_id');
            $table->string('start_date');
            $table->string('end_date');
            $table->unsignedBigInteger('hospital_id');
            $table->timestamps();

            // Define foreign key constraints if needed
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('hospital_id')->references('id')->on('hospitals');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_appointments');
    }
};
