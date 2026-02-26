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
        if (Schema::hasTable('patients') && !Schema::hasColumn('patients', 'updated_by')) {
            Schema::table('patients', function (Blueprint $table) {
                $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('patients') && Schema::hasColumn('patients', 'updated_by')) {
            Schema::table('patients', function (Blueprint $table) {
                $table->dropColumn('updated_by');
            });
        }
    }
};

