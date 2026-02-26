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
        Schema::create('pregnant_women', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedTinyInteger('gravida')->nullable();
            $table->unsignedTinyInteger('para')->nullable();
            $table->unsignedTinyInteger('living_children')->nullable();
            $table->unsignedTinyInteger('miscarriages')->nullable();
            $table->unsignedTinyInteger('stillbirths')->nullable();
            $table->unsignedTinyInteger('cesarean_sections')->nullable();
            $table->unsignedTinyInteger('preterm_births')->nullable();
            $table->date('lmp')->nullable();
            $table->date('edd')->nullable();
            $table->unsignedTinyInteger('gestational_age_weeks')->nullable();
            $table->string('pregnancy_planned')->nullable();
            $table->date('first_anc_visit_date')->nullable();
            $table->string('pregnancy_confirmation_method')->nullable();
            $table->unsignedTinyInteger('pregnancy_number')->nullable();
            $table->string('fetal_movements')->nullable();
            $table->date('fetal_movements_started_at')->nullable();
            $table->string('multiple_pregnancy_type')->nullable();
            $table->text('danger_signs')->nullable();
            $table->string('alt_phone_number')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->text('chronic_illnesses')->nullable();
            $table->text('previous_pregnancy_complications')->nullable();
            $table->string('blood_transfusion_history')->nullable();
            $table->text('surgical_history')->nullable();
            $table->text('allergies')->nullable();
            $table->decimal('height_cm',5,2)->nullable();
            $table->decimal('weight_kg',5,2)->nullable();
            $table->decimal('bmi',4,1)->nullable();
            $table->string('blood_pressure',20)->nullable();
            $table->decimal('temperature_c',4,1)->nullable();
            $table->unsignedSmallInteger('pulse_rate')->nullable();
            $table->decimal('muac_cm',4,1)->nullable();
            $table->string('blood_group',5)->nullable();
            $table->string('rhesus_factor',5)->nullable();
            $table->decimal('hemoglobin_level',4,1)->nullable();
            $table->string('hiv_status')->nullable();
            $table->string('syphilis_result')->nullable();
            $table->string('hepatitis_b_result')->nullable();
            $table->string('urinalysis_protein')->nullable();
            $table->string('urinalysis_sugar')->nullable();
            $table->decimal('blood_sugar',6,2)->nullable();
            $table->string('malaria_test_result')->nullable();
            $table->string('iron_folic_started')->nullable();
            $table->string('deworming_status')->nullable();
            $table->unsignedTinyInteger('tetanus_toxoid_doses')->nullable();
            $table->text('current_medications')->nullable();
            $table->string('occupation')->nullable();
            $table->string('education_level')->nullable();
            $table->string('smoking_status')->nullable();
            $table->string('alcohol_use')->nullable();
            $table->string('domestic_violence_exposure')->nullable();
            $table->string('nutritional_status')->nullable();
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pregnant_women');
    }
};
