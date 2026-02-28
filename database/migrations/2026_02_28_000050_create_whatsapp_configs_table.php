<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('whatsapp_configs')) {
            Schema::create('whatsapp_configs', function (Blueprint $table) {
                $table->id();
                $table->string('channel')->default('WHATSAPP');
                $table->string('phone_number_id')->unique();
                $table->text('access_token');
                $table->string('verify_token');
                $table->boolean('is_active')->default(false);
                $table->unsignedBigInteger('created_by')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('whatsapp_configs');
    }
};

