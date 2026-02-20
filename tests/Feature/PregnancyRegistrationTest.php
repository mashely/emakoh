<?php

namespace Tests\Feature;

use App\Models\District;
use App\Models\Hospital;
use App\Models\Region;
use App\Models\Service;
use App\Models\Staff;
use App\Models\User;
use Database\Seeders\DistrictSeeder;
use Database\Seeders\GenderSeeder;
use Database\Seeders\IdTypeSeeder;
use Database\Seeders\MaritalStatusSeeder;
use Database\Seeders\RegionSeeder;
use Database\Seeders\ServicesSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\WardSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PregnancyRegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(GenderSeeder::class);
        $this->seed(MaritalStatusSeeder::class);
        $this->seed(IdTypeSeeder::class);
        $this->seed(UserSeeder::class);
        $this->seed(RegionSeeder::class);
        $this->seed(DistrictSeeder::class);
        $this->seed(WardSeeder::class);
        $this->seed(ServicesSeeder::class);
    }

    protected function createAuthenticatedUserWithHospital(): User
    {
        $user = User::first();

        $region = Region::first();
        $district = District::first();
        $wardId = \DB::table('wards')->value('id');

        $hospital = Hospital::create([
            'name' => 'Test Hospital',
            'phone_number' => '0712345678',
            'email' => 'hospital@example.com',
            'region_id' => $region ? $region->id : 1,
            'district_id' => $district ? $district->id : 1,
            'ward_id' => $wardId ?: 1,
            'location' => 'Test Location',
            'created_by' => $user->id,
        ]);

        Staff::create([
            'user_id' => $user->id,
            'hospital_id' => $hospital->id,
        ]);

        $this->actingAs($user);

        return $user;
    }

    protected function buildFullRegistrationPayload(Service $service): array
    {
        $today = now()->toDateString();
        $region = Region::first();
        $district = District::first();
        $wardId = \DB::table('wards')->value('id');

        return [
            'first_name' => 'Jane',
            'middle_name' => 'Mary',
            'last_name' => 'Doe',
            'dob' => '1995-01-15',
            'gender' => 2,
            'marital_status' => 2,
            'id_type' => 1,
            'id_number' => 'ID-TEST-123',
            'region' => $region ? $region->id : 1,
            'district' => $district ? $district->id : 1,
            'ward' => $wardId ?: 1,
            'location' => 'Test Address',
            'phone_number' => '0711111111',
            'alt_phone_number' => '0722222222',
            'emergency_contact_name' => 'Emergency Person',
            'emergency_contact_phone' => '0733333333',
            'service' => $service->id,
            'start_date' => $today,
            'end_date' => $today,
            'is_pregnancy_registration' => 1,
            'gravida' => 2,
            'para' => 1,
            'living_children' => 1,
            'miscarriages' => 0,
            'stillbirths' => 0,
            'cesarean_sections' => 1,
            'preterm_births' => 0,
            'lmp' => '2024-01-01',
            'edd' => '2024-10-01',
            'gestational_age_weeks' => 12,
            'pregnancy_planned' => 'Planned',
            'first_anc_visit_date' => '2024-02-01',
            'pregnancy_confirmation_method' => 'Ultrasound',
            'pregnancy_number' => 1,
            'fetal_movements' => 'No',
            'fetal_movements_started_at' => null,
            'multiple_pregnancy_type' => 'Single',
            'danger_signs' => ['Bleeding', 'Severe pain'],
            'chronic_illnesses' => ['Diabetes', 'Epilepsy'],
            'previous_pregnancy_complications' => ['Preeclampsia'],
            'blood_transfusion_history' => 'No',
            'surgical_history' => 'Previous C-section',
            'allergies' => 'Penicillin',
            'height_cm' => 165.5,
            'weight_kg' => 60.2,
            'bmi' => 22.0,
            'blood_pressure' => '120/80',
            'temperature_c' => 36.7,
            'pulse_rate' => 80,
            'muac_cm' => 25.5,
            'blood_group' => 'O+',
            'rhesus_factor' => 'Pos',
            'hemoglobin_level' => 12.5,
            'hiv_status' => 'Negative',
            'syphilis_result' => 'Non-reactive',
            'hepatitis_b_result' => 'Negative',
            'urinalysis_protein' => 'Negative',
            'urinalysis_sugar' => 'Negative',
            'blood_sugar' => 4.8,
            'malaria_test_result' => 'Negative',
            'iron_folic_started' => 'Yes',
            'deworming_status' => 'Given at 20 weeks',
            'tetanus_toxoid_doses' => 2,
            'current_medications' => 'Prenatal vitamins',
            'occupation' => 'Teacher',
            'education_level' => 'Secondary',
            'smoking_status' => 'Never',
            'alcohol_use' => 'Occasional',
            'domestic_violence_exposure' => 'No',
            'nutritional_status' => 'Adequate',
        ];
    }

    public function test_can_register_pregnant_client_with_full_details()
    {
        $this->createAuthenticatedUserWithHospital();
        $service = Service::firstOrFail();

        $payload = $this->buildFullRegistrationPayload($service);

        $response = $this->post(route('client.create'), $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'is_pregnancy' => true,
        ]);

        $patientId = $response->json('patient_id');

        $this->assertNotNull($patientId);

        $this->assertDatabaseHas('patients', [
            'id' => $patientId,
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'id_number' => 'ID-TEST-123',
        ]);

        $this->assertDatabaseHas('pregnant_women', [
            'patient_id' => $patientId,
            'gravida' => 2,
            'pregnancy_planned' => 'Planned',
            'blood_group' => 'O+',
            'occupation' => 'Teacher',
        ]);

        $this->assertDatabaseHas('service_appointments', [
            'patient_id' => $patientId,
            'service_id' => $service->id,
        ]);
    }

    public function test_can_update_pregnancy_and_details_are_reflected_in_pdf()
    {
        $this->createAuthenticatedUserWithHospital();
        $service = Service::firstOrFail();

        $createPayload = $this->buildFullRegistrationPayload($service);

        $createResponse = $this->post(route('client.create'), $createPayload);
        $patientId = $createResponse->json('patient_id');

        $updatePayload = $createPayload;
        $updatePayload['client_id'] = $patientId;
        $updatePayload['first_name'] = 'Jane Updated';
        $updatePayload['gravida'] = 3;
        $updatePayload['blood_group'] = 'AB-';
        $updatePayload['occupation'] = 'Nurse';
        $updatePayload['is_pregnancy_registration'] = 1;

        unset($updatePayload['service'], $updatePayload['start_date'], $updatePayload['end_date']);

        $updateResponse = $this->post(route('client.update'), $updatePayload);

        $updateResponse->assertStatus(200);
        $updateResponse->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('patients', [
            'id' => $patientId,
            'first_name' => 'Jane Updated',
        ]);

        $this->assertDatabaseHas('pregnant_women', [
            'patient_id' => $patientId,
            'gravida' => 3,
            'blood_group' => 'AB-',
            'occupation' => 'Nurse',
        ]);

        $pdfResponse = $this->get(route('pregnancy.pdf', ['id' => $patientId]));

        $pdfResponse->assertStatus(200);

        $contentType = $pdfResponse->headers->get('content-type');
        $this->assertTrue(str_contains($contentType, 'application/pdf'));
    }
}
