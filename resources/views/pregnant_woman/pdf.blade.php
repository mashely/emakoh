<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ __('app.pregnancy_registration') }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1, h2, h3 { margin: 0 0 8px 0; }
        .section { margin-bottom: 16px; }
        .section-title { font-weight: bold; border-bottom: 1px solid #000; margin-bottom: 6px; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 4px 6px; vertical-align: top; }
        .label { font-weight: bold; width: 30%; }
        .value { width: 70%; }
        .header { text-align: center; margin-bottom: 16px; }
        .small { font-size: 11px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>{{ $patient->hospital ? $patient->hospital->name : '' }}</h2>
        <h3>{{ __('app.pregnancy_registration') }}</h3>
        <p class="small">
            {{ __('app.client_id') }}: {{ $patient->patient_id }}
            &nbsp;|&nbsp;
            {{ __('app.client_name') }}: {{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}
        </p>
    </div>

    <div class="section">
        <div class="section-title">{{ __('app.personal_information') }}</div>
        <table>
            <tr>
                <td class="label">{{ __('app.first_name') }}</td>
                <td class="value">{{ $patient->first_name }}</td>
            </tr>
            <tr>
                <td class="label">{{ __('app.middle_name') }}</td>
                <td class="value">{{ $patient->middle_name }}</td>
            </tr>
            <tr>
                <td class="label">{{ __('app.last_name') }}</td>
                <td class="value">{{ $patient->last_name }}</td>
            </tr>
            <tr>
                <td class="label">{{ __('app.date_of_birth') }}</td>
                <td class="value">{{ $patient->dob }}</td>
            </tr>
        </table>
    </div>

    

    @if($pregnancy)
    <div class="section">
        <div class="section-title">{{ __('app.pregnancy_obstetric_history') }}</div>
        <table>
            <tr>
                <td class="label">{{ __('app.gravida') }}</td>
                <td class="value">{{ $pregnancy->gravida }}</td>
            </tr>
            <tr>
                <td class="label">{{ __('app.para_label') }}</td>
                <td class="value">{{ $pregnancy->para }}</td>
            </tr>
            <tr>
                <td class="label">{{ __('app.number_of_living_children') }}</td>
                <td class="value">{{ $pregnancy->living_children }}</td>
            </tr>
            <tr>
                <td class="label">{{ __('app.miscarriages_abortions') }}</td>
                <td class="value">{{ $pregnancy->miscarriages }}</td>
            </tr>
            <tr>
                <td class="label">LNMP</td>
                <td class="value">{{ $pregnancy->lmp }}</td>
            </tr>
            <tr>
                <td class="label">EDD</td>
                <td class="value">{{ $pregnancy->edd }}</td>
            </tr>
            <tr>
                <td class="label">Gestational age (weeks)</td>
                <td class="value">{{ $pregnancy->gestational_age_weeks }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Current Pregnancy Information</div>
        <table>
            <tr>
                <td class="label">Date of first ANC visit</td>
                <td class="value">{{ $pregnancy->first_anc_visit_date }}</td>
            </tr>
            <tr>
                <td class="label">Pregnancy confirmation method</td>
                <td class="value">{{ $pregnancy->pregnancy_confirmation_method }}</td>
            </tr>
            <tr>
                <td class="label">Pregnancy number</td>
                <td class="value">{{ $pregnancy->pregnancy_number }}</td>
            </tr>
            <tr>
                <td class="label">Fetal movements</td>
                <td class="value">{{ $pregnancy->fetal_movements }}</td>
            </tr>
            <tr>
                <td class="label">Fetal movements started at</td>
                <td class="value">{{ $pregnancy->fetal_movements_started_at }}</td>
            </tr>
            <tr>
                <td class="label">Multiple pregnancy</td>
                <td class="value">{{ $pregnancy->multiple_pregnancy_type }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Medical History</div>
        <table>
            <tr>
                <td class="label">Danger signs</td>
                <td class="value">{{ $pregnancy->danger_signs }}</td>
            </tr>
            <tr>
                <td class="label">Chronic illnesses</td>
                <td class="value">{{ $pregnancy->chronic_illnesses }}</td>
            </tr>
            <tr>
                <td class="label">Previous pregnancy complications</td>
                <td class="value">{{ $pregnancy->previous_pregnancy_complications }}</td>
            </tr>
            <tr>
                <td class="label">Blood transfusion history</td>
                <td class="value">{{ $pregnancy->blood_transfusion_history }}</td>
            </tr>
            <tr>
                <td class="label">Surgical history</td>
                <td class="value">{{ $pregnancy->surgical_history }}</td>
            </tr>
            <tr>
                <td class="label">Allergies</td>
                <td class="value">{{ $pregnancy->allergies }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Physical & Clinical Measurements</div>
        <table>
            <tr>
                <td class="label">Height (cm)</td>
                <td class="value">{{ $pregnancy->height_cm }}</td>
            </tr>
            <tr>
                <td class="label">Weight (kg)</td>
                <td class="value">{{ $pregnancy->weight_kg }}</td>
            </tr>
            <tr>
                <td class="label">BMI</td>
                <td class="value">{{ $pregnancy->bmi }}</td>
            </tr>
            <tr>
                <td class="label">Blood pressure</td>
                <td class="value">{{ $pregnancy->blood_pressure }}</td>
            </tr>
            <tr>
                <td class="label">Temperature (°C)</td>
                <td class="value">{{ $pregnancy->temperature_c }}</td>
            </tr>
            <tr>
                <td class="label">Pulse rate</td>
                <td class="value">{{ $pregnancy->pulse_rate }}</td>
            </tr>
            <tr>
                <td class="label">MUAC (cm)</td>
                <td class="value">{{ $pregnancy->muac_cm }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Laboratory & Screening</div>
        <table>
            <tr>
                <td class="label">Blood group</td>
                <td class="value">{{ $pregnancy->blood_group }}</td>
            </tr>
            <tr>
                <td class="label">Rhesus factor</td>
                <td class="value">{{ $pregnancy->rhesus_factor }}</td>
            </tr>
            <tr>
                <td class="label">Hemoglobin (g/dL)</td>
                <td class="value">{{ $pregnancy->hemoglobin_level }}</td>
            </tr>
            <tr>
                <td class="label">HIV status</td>
                <td class="value">{{ $pregnancy->hiv_status }}</td>
            </tr>
            <tr>
                <td class="label">Syphilis result</td>
                <td class="value">{{ $pregnancy->syphilis_result }}</td>
            </tr>
            <tr>
                <td class="label">Hepatitis B</td>
                <td class="value">{{ $pregnancy->hepatitis_b_result }}</td>
            </tr>
            <tr>
                <td class="label">Urinalysis (protein)</td>
                <td class="value">{{ $pregnancy->urinalysis_protein }}</td>
            </tr>
            <tr>
                <td class="label">Urinalysis (sugar)</td>
                <td class="value">{{ $pregnancy->urinalysis_sugar }}</td>
            </tr>
            <tr>
                <td class="label">Blood sugar</td>
                <td class="value">{{ $pregnancy->blood_sugar }}</td>
            </tr>
            <tr>
                <td class="label">Malaria test</td>
                <td class="value">{{ $pregnancy->malaria_test_result }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Treatment & Counseling</div>
        <table>
            <tr>
                <td class="label">Iron/folic started</td>
                <td class="value">{{ $pregnancy->iron_folic_started }}</td>
            </tr>
            <tr>
                <td class="label">Deworming status</td>
                <td class="value">{{ $pregnancy->deworming_status }}</td>
            </tr>
            <tr>
                <td class="label">Tetanus toxoid doses</td>
                <td class="value">{{ $pregnancy->tetanus_toxoid_doses }}</td>
            </tr>
            <tr>
                <td class="label">Current medications</td>
                <td class="value">{{ $pregnancy->current_medications }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Social & Lifestyle</div>
        <table>
            <tr>
                <td class="label">Occupation</td>
                <td class="value">{{ $pregnancy->occupation }}</td>
            </tr>
            <tr>
                <td class="label">Education level</td>
                <td class="value">{{ $pregnancy->education_level }}</td>
            </tr>
            <tr>
                <td class="label">Smoking status</td>
                <td class="value">{{ $pregnancy->smoking_status }}</td>
            </tr>
            <tr>
                <td class="label">Alcohol use</td>
                <td class="value">{{ $pregnancy->alcohol_use }}</td>
            </tr>
            <tr>
                <td class="label">Domestic violence exposure</td>
                <td class="value">{{ $pregnancy->domestic_violence_exposure }}</td>
            </tr>
            <tr>
                <td class="label">Nutritional status</td>
                <td class="value">{{ $pregnancy->nutritional_status }}</td>
            </tr>
        </table>
    </div>
    @endif
</body>
</html>
