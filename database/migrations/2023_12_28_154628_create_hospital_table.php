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
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number');
            $table->string('email');
            $table->unsignedBigInteger('region_id'); // Foreign key to regions table
            $table->unsignedBigInteger('district_id'); // Foreign key to districts table
            $table->unsignedBigInteger('ward_id'); // Foreign key to wards table
            $table->string('location');
            $table->unsignedBigInteger('created_by'); // Foreign key to users table
            $table->timestamps();

            // Adding foreign key constraints
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('ward_id')->references('id')->on('wards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospitals');
    }
};
