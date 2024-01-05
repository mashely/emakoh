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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedBigInteger('gender_id'); // Change to unsignedBigInteger for referencing another table
            $table->foreign('gender_id')->references('id')->on('gender');
            $table->string('password');
            $table->string('phone');
            $table->tinyInteger('active')->nullable();
            $table->string('username')->nullable();
            $table->unsignedBigInteger('created_by')->nullable(); // Foreign key to users table
            $table->unsignedBigInteger('updated_by')->nullable(); // Foreign key to users table
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
