<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Ensure all expected pregnancy columns exist on pregnant_women table.
     */
    public function up()
    {
        if (!Schema::hasTable('pregnant_women')) {
            return;
        }

        Schema::table('pregnant_women', function (Blueprint $table) {
            if (!Schema::hasColumn('pregnant_women', 'gravida')) {
                $table->unsignedTinyInteger('gravida')->nullable()->after('patient_id');
            }
            if (!Schema::hasColumn('pregnant_women', 'para')) {
                $table->unsignedTinyInteger('para')->nullable()->after('gravida');
            }
            if (!Schema::hasColumn('pregnant_women', 'living_children')) {
                $table->unsignedTinyInteger('living_children')->nullable()->after('para');
            }
            if (!Schema::hasColumn('pregnant_women', 'miscarriages')) {
                $table->unsignedTinyInteger('miscarriages')->nullable()->after('living_children');
            }
            if (!Schema::hasColumn('pregnant_women', 'stillbirths')) {
                $table->unsignedTinyInteger('stillbirths')->nullable()->after('miscarriages');
            }
            if (!Schema::hasColumn('pregnant_women', 'cesarean_sections')) {
                $table->unsignedTinyInteger('cesarean_sections')->nullable()->after('stillbirths');
            }
            if (!Schema::hasColumn('pregnant_women', 'preterm_births')) {
                $table->unsignedTinyInteger('preterm_births')->nullable()->after('cesarean_sections');
            }
            if (!Schema::hasColumn('pregnant_women', 'lmp')) {
                $table->date('lmp')->nullable()->after('preterm_births');
            }
            if (!Schema::hasColumn('pregnant_women', 'edd')) {
                $table->date('edd')->nullable()->after('lmp');
            }
            if (!Schema::hasColumn('pregnant_women', 'gestational_age_weeks')) {
                $table->unsignedTinyInteger('gestational_age_weeks')->nullable()->after('edd');
            }
            if (!Schema::hasColumn('pregnant_women', 'pregnancy_planned')) {
                $table->string('pregnancy_planned')->nullable()->after('gestational_age_weeks');
            }
            if (!Schema::hasColumn('pregnant_women', 'first_anc_visit_date')) {
                $table->date('first_anc_visit_date')->nullable()->after('pregnancy_planned');
            }
            if (!Schema::hasColumn('pregnant_women', 'pregnancy_confirmation_method')) {
                $table->string('pregnancy_confirmation_method')->nullable()->after('first_anc_visit_date');
            }
            if (!Schema::hasColumn('pregnant_women', 'pregnancy_number')) {
                $table->unsignedTinyInteger('pregnancy_number')->nullable()->after('pregnancy_confirmation_method');
            }
            if (!Schema::hasColumn('pregnant_women', 'fetal_movements')) {
                $table->string('fetal_movements')->nullable()->after('pregnancy_number');
            }
            if (!Schema::hasColumn('pregnant_women', 'fetal_movements_started_at')) {
                $table->date('fetal_movements_started_at')->nullable()->after('fetal_movements');
            }
            if (!Schema::hasColumn('pregnant_women', 'multiple_pregnancy_type')) {
                $table->string('multiple_pregnancy_type')->nullable()->after('fetal_movements_started_at');
            }
            if (!Schema::hasColumn('pregnant_women', 'danger_signs')) {
                $table->text('danger_signs')->nullable()->after('multiple_pregnancy_type');
            }
            if (!Schema::hasColumn('pregnant_women', 'alt_phone_number')) {
                $table->string('alt_phone_number')->nullable()->after('danger_signs');
            }
            if (!Schema::hasColumn('pregnant_women', 'emergency_contact_name')) {
                $table->string('emergency_contact_name')->nullable()->after('alt_phone_number');
            }
            if (!Schema::hasColumn('pregnant_women', 'emergency_contact_phone')) {
                $table->string('emergency_contact_phone')->nullable()->after('emergency_contact_name');
            }
            if (!Schema::hasColumn('pregnant_women', 'chronic_illnesses')) {
                $table->text('chronic_illnesses')->nullable()->after('emergency_contact_phone');
            }
            if (!Schema::hasColumn('pregnant_women', 'previous_pregnancy_complications')) {
                $table->text('previous_pregnancy_complications')->nullable()->after('chronic_illnesses');
            }
            if (!Schema::hasColumn('pregnant_women', 'blood_transfusion_history')) {
                $table->string('blood_transfusion_history')->nullable()->after('previous_pregnancy_complications');
            }
            if (!Schema::hasColumn('pregnant_women', 'surgical_history')) {
                $table->text('surgical_history')->nullable()->after('blood_transfusion_history');
            }
            if (!Schema::hasColumn('pregnant_women', 'allergies')) {
                $table->text('allergies')->nullable()->after('surgical_history');
            }
            if (!Schema::hasColumn('pregnant_women', 'height_cm')) {
                $table->decimal('height_cm', 5, 2)->nullable()->after('allergies');
            }
            if (!Schema::hasColumn('pregnant_women', 'weight_kg')) {
                $table->decimal('weight_kg', 5, 2)->nullable()->after('height_cm');
            }
            if (!Schema::hasColumn('pregnant_women', 'bmi')) {
                $table->decimal('bmi', 4, 1)->nullable()->after('weight_kg');
            }
            if (!Schema::hasColumn('pregnant_women', 'blood_pressure')) {
                $table->string('blood_pressure', 20)->nullable()->after('bmi');
            }
            if (!Schema::hasColumn('pregnant_women', 'temperature_c')) {
                $table->decimal('temperature_c', 4, 1)->nullable()->after('blood_pressure');
            }
            if (!Schema::hasColumn('pregnant_women', 'pulse_rate')) {
                $table->unsignedSmallInteger('pulse_rate')->nullable()->after('temperature_c');
            }
            if (!Schema::hasColumn('pregnant_women', 'muac_cm')) {
                $table->decimal('muac_cm', 4, 1)->nullable()->after('pulse_rate');
            }
            if (!Schema::hasColumn('pregnant_women', 'blood_group')) {
                $table->string('blood_group', 5)->nullable()->after('muac_cm');
            }
            if (!Schema::hasColumn('pregnant_women', 'rhesus_factor')) {
                $table->string('rhesus_factor', 5)->nullable()->after('blood_group');
            }
            if (!Schema::hasColumn('pregnant_women', 'hemoglobin_level')) {
                $table->decimal('hemoglobin_level', 4, 1)->nullable()->after('rhesus_factor');
            }
            if (!Schema::hasColumn('pregnant_women', 'hiv_status')) {
                $table->string('hiv_status')->nullable()->after('hemoglobin_level');
            }
            if (!Schema::hasColumn('pregnant_women', 'syphilis_result')) {
                $table->string('syphilis_result')->nullable()->after('hiv_status');
            }
            if (!Schema::hasColumn('pregnant_women', 'hepatitis_b_result')) {
                $table->string('hepatitis_b_result')->nullable()->after('syphilis_result');
            }
            if (!Schema::hasColumn('pregnant_women', 'urinalysis_protein')) {
                $table->string('urinalysis_protein')->nullable()->after('hepatitis_b_result');
            }
            if (!Schema::hasColumn('pregnant_women', 'urinalysis_sugar')) {
                $table->string('urinalysis_sugar')->nullable()->after('urinalysis_protein');
            }
            if (!Schema::hasColumn('pregnant_women', 'blood_sugar')) {
                $table->decimal('blood_sugar', 6, 2)->nullable()->after('urinalysis_sugar');
            }
            if (!Schema::hasColumn('pregnant_women', 'malaria_test_result')) {
                $table->string('malaria_test_result')->nullable()->after('blood_sugar');
            }
            if (!Schema::hasColumn('pregnant_women', 'iron_folic_started')) {
                $table->string('iron_folic_started')->nullable()->after('malaria_test_result');
            }
            if (!Schema::hasColumn('pregnant_women', 'deworming_status')) {
                $table->string('deworming_status')->nullable()->after('iron_folic_started');
            }
            if (!Schema::hasColumn('pregnant_women', 'tetanus_toxoid_doses')) {
                $table->unsignedTinyInteger('tetanus_toxoid_doses')->nullable()->after('deworming_status');
            }
            if (!Schema::hasColumn('pregnant_women', 'current_medications')) {
                $table->text('current_medications')->nullable()->after('tetanus_toxoid_doses');
            }
            if (!Schema::hasColumn('pregnant_women', 'occupation')) {
                $table->string('occupation')->nullable()->after('current_medications');
            }
            if (!Schema::hasColumn('pregnant_women', 'education_level')) {
                $table->string('education_level')->nullable()->after('occupation');
            }
            if (!Schema::hasColumn('pregnant_women', 'smoking_status')) {
                $table->string('smoking_status')->nullable()->after('education_level');
            }
            if (!Schema::hasColumn('pregnant_women', 'alcohol_use')) {
                $table->string('alcohol_use')->nullable()->after('smoking_status');
            }
            if (!Schema::hasColumn('pregnant_women', 'domestic_violence_exposure')) {
                $table->string('domestic_violence_exposure')->nullable()->after('alcohol_use');
            }
            if (!Schema::hasColumn('pregnant_women', 'nutritional_status')) {
                $table->string('nutritional_status')->nullable()->after('domestic_violence_exposure');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * This migration is additive only; we do not drop columns on down().
     */
    public function down()
    {
        // Intentionally left empty to avoid dropping data columns.
    }
};

