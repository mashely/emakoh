<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('whatsapp_conversations')) {
            Schema::create('whatsapp_conversations', function (Blueprint $table) {
                $table->id();
                $table->string('phone')->index();
                $table->string('display_name')->nullable();
                $table->timestamp('last_message_at')->nullable();
                $table->string('last_message_preview')->nullable();
                $table->unsignedInteger('unread_count')->default(0);
                $table->boolean('is_archived')->default(false);
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('whatsapp_conversations');
    }
};

