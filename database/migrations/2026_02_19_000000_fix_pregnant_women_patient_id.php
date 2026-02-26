<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ensure pregnant_women table has patient_id column used by the application.
     *
     * This is safe to run even if the original create table migration
     * has already added the column.
     */
    public function up()
    {
        if (Schema::hasTable('pregnant_women') && !Schema::hasColumn('pregnant_women', 'patient_id')) {
            Schema::table('pregnant_women', function (Blueprint $table) {
                $table->unsignedBigInteger('patient_id')->after('id');
            });
        }
    }

    /**
     * Roll back the patient_id column if it was added by this migration.
     */
    public function down()
    {
        if (Schema::hasTable('pregnant_women') && Schema::hasColumn('pregnant_women', 'patient_id')) {
            Schema::table('pregnant_women', function (Blueprint $table) {
                $table->dropColumn('patient_id');
            });
        }
    }
};

