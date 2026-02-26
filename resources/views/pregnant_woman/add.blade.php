@extends('layouts.main')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ __('app.client_page_title') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('app.client_register_breadcrumb') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('app.client_registration') }}</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0 text-center">{{ __('app.pregnancy_registration') }}</h4>
                    </div><!-- end card header -->
                    <div class="card-body form-steps">
                        <form class="vertical-navs-step" id="patient_reg">
                            <input type="hidden" name="is_pregnancy_registration" value="1">
                            <div class="row gy-5">
                                <div class="col-lg-3">
                                    <div class="nav flex-column custom-nav nav-pills" role="tablist" aria-orientation="vertical">
                                        <button class="nav-link done" id="v-pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bill-info" type="button" role="tab" aria-controls="v-pills-bill-info" aria-selected="false">
                                            <span class="step-title me-2">
                                                <i class="ri-close-circle-fill step-icon me-2"></i>
                                                {{ __('app.step1_personal_info') }}
                                            </span>
                                            {{ __('app.personal_information') }}
                                        </button>
                                        <button class="nav-link" id="v-pills-bill-address-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bill-address" type="button" role="tab" aria-controls="v-pills-bill-address" aria-selected="false">
                                            <span class="step-title me-2">
                                                <i class="ri-close-circle-fill step-icon me-2"></i>
                                                {{ __('app.step2_address_contacts') }}
                                            </span>
                                            {{ __('app.address_contacts') }}
                                        </button>
                                        <button class="nav-link" id="v-pills-payment-tab" data-bs-toggle="pill" data-bs-target="#v-pills-payment" type="button" role="tab" aria-controls="v-pills-payment" aria-selected="false">
                                            <span class="step-title me-2">
                                                <i class="ri-close-circle-fill step-icon me-2"></i>
                                                {{ __('app.step3_pregnancy_visit') }}
                                            </span>
                                            {{ __('app.pregnancy_visit') }}
                                        </button>
                                    </div>
                                    <!-- end nav -->
                                </div> <!-- end col-->
                                <div class="col-lg-9">
                                    <div class="px-lg-4">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="v-pills-bill-info" role="tabpanel" aria-labelledby="v-pills-bill-info-tab">
                                                <div>
                                                    <h5 class="text-center">{{ __('app.personal_identification_details') }}</h5>
                                                </div>
                                                <hr>
                                                <div>
                                                    <div class="row g-3">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label for="firstName" class="form-label"> {{ __('app.first_name') }} <i id="required-field"> * </i> </label>
                                                                <input type="text" class="form-control" id="firstName" placeholder="{{ __('app.first_name') }}" name="first_name" required>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <label for="lastName" class="form-label">{{ __('app.middle_name') }}</label>
                                                                <input type="text" class="form-control" id="middleName" placeholder="{{ __('app.middle_name') }}" name="middle_name">
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <label for="username" class="form-label">{{ __('app.last_name') }} <i id="required-field"> * </i></label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" id="lastName" placeholder="{{ __('app.last_name') }}" name="last_name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label for="DOB" class="form-label">{{ __('app.date_of_birth') }} <i id="required-field"> * </i></label>
                                                                <input type="date" class="form-control" id="dob" name="dob" max="{{ date('Y-m-d')}}">
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <!-- ID Type and ID Number removed -->

                                                        <P><b>{{ __('app.note_required_fields') }}</b></P>

                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-start gap-3 mt-4">
                                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab
    nexttab" data-nexttab="v-pills-bill-address-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>{{ __('app.go_to_address_contacts') }}</button>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->
                                            <div class="tab-pane fade " id="v-pills-bill-address" role="tabpanel" aria-labelledby="v-pills-bill-address-tab">
                                                <div>
                                                    <h5 class="text-center">{{ __('app.address_contacts') }}</h5>
                                                </div>
                                                <hr>
                                                <div>
                                                    <div class="row g-3">
                                                        <!-- Region/District/Ward selection removed -->
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="Location">{{ __('app.physical_location') }} <i id="required-field"> * </i></label>
                                                            <textarea name="location" rows="7" class="form-control" placeholder="{{ __('app.write_physical_address') }}"></textarea>
                                                        </div>

                                                    </div>

                                                    <hr class="my-4 text-muted">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="Location">{{ __('app.phone_number') }} <i id="required-field"> * </i></label>
                                                            <input type="number" class="form-control" placeholder="{{ __('app.enter_phone_number') }}" name="phone_number">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="Location">{{ __('app.alternative_phone_number') }}</label>
                                                            <input type="number" class="form-control" placeholder="{{ __('app.enter_alternative_phone_number') }}" name="alt_phone_number">
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-md-6">
                                                            <label for="Location">{{ __('app.emergency_contact_person') }}</label>
                                                            <input type="text" class="form-control" placeholder="{{ __('app.enter_emergency_contact_person') }}" name="emergency_contact_name">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="Location">{{ __('app.emergency_contact_phone') }}</label>
                                                            <input type="number" class="form-control" placeholder="{{ __('app.enter_emergency_contact_phone') }}" name="emergency_contact_phone">
                                                        </div>
                                                    </div>
                                                    <P style="margin-top: 15px;"><b>{{ __('app.note_required_fields') }}</b></P>

                                                </div>
                                                <div class="d-flex align-items-start gap-3 mt-4">
                                                    <button type="button" class="btn btn-light btn-label previestab" data-previous="v-pills-bill-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> {{ __('app.back_to_personal_info') }}</button>
                                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab
    nexttab" data-nexttab="v-pills-payment-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>{{ __('app.go_to_pregnancy_section') }}</button>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->
                                            <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                                                <div>
                                                    <h5 class="text-center">{{ __('app.pregnancy_obstetric_history') }}</h5>
                                                </div>

                                                <div>
                                                    <div class="row gy-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label">{{ __('app.gravida') }}</label>
                                                            <input type="number" class="form-control" name="gravida" min="0">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">{{ __('app.para_label') }}</label>
                                                            <input type="number" class="form-control" name="para" min="0">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">{{ __('app.number_of_living_children') }}</label>
                                                            <input type="number" class="form-control" name="living_children" min="0">
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-3">
                                                            <label class="form-label">{{ __('app.miscarriages_abortions') }}</label>
                                                            <input type="number" class="form-control" name="miscarriages" min="0">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">{{ __('app.stillbirths') }}</label>
                                                            <input type="number" class="form-control" name="stillbirths" min="0">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">{{ __('app.cesarean_sections') }}</label>
                                                            <input type="number" class="form-control" name="cesarean_sections" min="0">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">{{ __('app.preterm_births') }}</label>
                                                            <input type="number" class="form-control" name="preterm_births" min="0">
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Last Menstrual Period (LMP)</label>
                                                            <input type="date" class="form-control" name="lmp" max="{{ date('Y-m-d')}}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Estimated Due Date (EDD)</label>
                                                            <input type="date" class="form-control" name="edd">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Gestational Age (weeks)</label>
                                                            <input type="number" class="form-control" name="gestational_age_weeks" min="0">
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Pregnancy Type</label>
                                                            <select name="pregnancy_planned" class="form-select">
                                                                <option value="" selected>Please Select</option>
                                                                <option value="Planned">Planned</option>
                                                                <option value="Unplanned">Unplanned</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <hr class="my-4 text-muted">

                                                    <div>
                                                        <h5 class="text-center">Current Pregnancy Information</h5>
                                                    </div>

                                                    <div class="row gy-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Date of First ANC Visit</label>
                                                            <input type="date" class="form-control" name="first_anc_visit_date">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Pregnancy Confirmation Method</label>
                                                            <input type="text" class="form-control" name="pregnancy_confirmation_method" placeholder="e.g. Urine test, Ultrasound">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Pregnancy Number (1–20)</label>
                                                            <input type="number" class="form-control" name="pregnancy_number" min="1" max="20" placeholder="e.g. 1 for first pregnancy">
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Fetal Movements</label>
                                                            <select name="fetal_movements" class="form-select">
                                                                <option value="" selected>Please Select</option>
                                                                <option value="Yes">Yes</option>
                                                                <option value="No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">If Yes, When Started</label>
                                                            <input type="date" class="form-control" name="fetal_movements_started_at">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Multiple Pregnancy</label>
                                                            <input type="text" class="form-control" name="multiple_pregnancy_type" placeholder="Single, Twins, etc.">
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-12">
                                                            <label class="form-label">Danger Signs Reported</label>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="danger_signs[]" value="Bleeding" id="danger_bleeding">
                                                                        <label class="form-check-label" for="danger_bleeding">
                                                                            Bleeding
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="danger_signs[]" value="Severe pain" id="danger_pain">
                                                                        <label class="form-check-label" for="danger_pain">
                                                                            Severe pain
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="danger_signs[]" value="Severe vomiting" id="danger_vomiting">
                                                                        <label class="form-check-label" for="danger_vomiting">
                                                                            Severe vomiting
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="danger_signs[]" value="Swelling" id="danger_swelling">
                                                                        <label class="form-check-label" for="danger_swelling">
                                                                            Swelling
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="danger_signs[]" value="Headache/blurred vision" id="danger_headache">
                                                                        <label class="form-check-label" for="danger_headache">
                                                                            Headache / blurred vision
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="danger_signs[]" value="Others" id="danger_other">
                                                                        <label class="form-check-label" for="danger_other">
                                                                            Others
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr class="my-4 text-muted">

                                                    <div>
                                                        <h5 class="text-center">Medical History</h5>
                                                    </div>

                                                    <div class="row gy-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label d-block">Chronic Illnesses</label>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="chronic_illnesses[]" value="Hypertension" id="illness_hypertension">
                                                                        <label class="form-check-label" for="illness_hypertension">Hypertension</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="chronic_illnesses[]" value="Diabetes" id="illness_diabetes">
                                                                        <label class="form-check-label" for="illness_diabetes">Diabetes</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="chronic_illnesses[]" value="Asthma" id="illness_asthma">
                                                                        <label class="form-check-label" for="illness_asthma">Asthma</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="chronic_illnesses[]" value="Heart disease" id="illness_heart">
                                                                        <label class="form-check-label" for="illness_heart">Heart disease</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="chronic_illnesses[]" value="Epilepsy" id="illness_epilepsy">
                                                                        <label class="form-check-label" for="illness_epilepsy">Epilepsy</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label d-block">Previous Pregnancy Complications</label>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="previous_pregnancy_complications[]" value="Preeclampsia" id="comp_preeclampsia">
                                                                        <label class="form-check-label" for="comp_preeclampsia">Preeclampsia</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="previous_pregnancy_complications[]" value="Eclampsia" id="comp_eclampsia">
                                                                        <label class="form-check-label" for="comp_eclampsia">Eclampsia</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="previous_pregnancy_complications[]" value="Gestational diabetes" id="comp_gdm">
                                                                        <label class="form-check-label" for="comp_gdm">Gestational diabetes</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Blood Transfusion History</label>
                                                            <select name="blood_transfusion_history" class="form-select">
                                                                <option value="" selected>Please Select</option>
                                                                <option value="Yes">Yes</option>
                                                                <option value="No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Surgical History</label>
                                                            <input type="text" class="form-control" name="surgical_history" placeholder="Describe previous surgeries">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Allergies (drugs, foods)</label>
                                                            <input type="text" class="form-control" name="allergies" placeholder="List known allergies">
                                                        </div>
                                                    </div>

                                                    <hr class="my-4 text-muted">

                                                    <div>
                                                        <h5 class="text-center">Physical & Clinical Measurements (Baseline)</h5>
                                                    </div>

                                                    <div class="row gy-3">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Height (cm)</label>
                                                            <input type="number" step="0.1" class="form-control" name="height_cm">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Weight (kg)</label>
                                                            <input type="number" step="0.1" class="form-control" name="weight_kg">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">BMI</label>
                                                            <input type="number" step="0.1" class="form-control" name="bmi">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Blood Pressure</label>
                                                            <input type="text" class="form-control" name="blood_pressure" placeholder="e.g. 120/80">
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Temperature (°C)</label>
                                                            <input type="number" step="0.1" class="form-control" name="temperature_c">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Pulse Rate (beats/min)</label>
                                                            <input type="number" class="form-control" name="pulse_rate">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">MUAC (cm)</label>
                                                            <input type="number" step="0.1" class="form-control" name="muac_cm">
                                                        </div>
                                                    </div>

                                                    <hr class="my-4 text-muted">

                                                    <div>
                                                        <h5 class="text-center">Laboratory & Screening Information</h5>
                                                    </div>

                                                    <div class="row gy-3">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Blood Group</label>
                                                            <select name="blood_group" class="form-select">
                                                                <option value="" selected>Please Select</option>
                                                                <option value="A+">A+</option>
                                                                <option value="A-">A-</option>
                                                                <option value="B+">B+</option>
                                                                <option value="B-">B-</option>
                                                                <option value="AB+">AB+</option>
                                                                <option value="AB-">AB-</option>
                                                                <option value="O+">O+</option>
                                                                <option value="O-">O-</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Rhesus Factor</label>
                                                            <select name="rhesus_factor" class="form-select">
                                                                <option value="" selected>Please Select</option>
                                                                <option value="Pos">Positive</option>
                                                                <option value="Neg">Negative</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Hemoglobin (g/dL)</label>
                                                            <input type="number" step="0.1" class="form-control" name="hemoglobin_level">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">HIV Status</label>
                                                            <input type="text" class="form-control" name="hiv_status">
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Syphilis (VDRL/RPR)</label>
                                                            <input type="text" class="form-control" name="syphilis_result">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Hepatitis B</label>
                                                            <input type="text" class="form-control" name="hepatitis_b_result">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Urinalysis (Protein)</label>
                                                            <input type="text" class="form-control" name="urinalysis_protein">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Urinalysis (Sugar)</label>
                                                            <input type="text" class="form-control" name="urinalysis_sugar">
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Blood Sugar</label>
                                                            <input type="number" step="0.1" class="form-control" name="blood_sugar">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Malaria Test</label>
                                                            <input type="text" class="form-control" name="malaria_test_result">
                                                        </div>
                                                    </div>

                                                    <hr class="my-4 text-muted">

                                                    <div>
                                                        <h5 class="text-center">Medications & Supplements</h5>
                                                    </div>

                                                    <div class="row gy-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Iron & Folic Acid Started</label>
                                                            <select name="iron_folic_started" class="form-select">
                                                                <option value="" selected>Please Select</option>
                                                                <option value="Yes">Yes</option>
                                                                <option value="No">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Deworming Status</label>
                                                            <input type="text" class="form-control" name="deworming_status">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Tetanus Toxoid (TT) Doses</label>
                                                            <input type="number" class="form-control" name="tetanus_toxoid_doses" min="0">
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-12">
                                                            <label class="form-label">Any Current Medications</label>
                                                            <textarea class="form-control" name="current_medications" rows="2"></textarea>
                                                        </div>
                                                    </div>

                                                    <hr class="my-4 text-muted">

                                                    <div>
                                                        <h5 class="text-center">Social & Lifestyle Information</h5>
                                                    </div>

                                                    <div class="row gy-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Occupation</label>
                                                            <input type="text" class="form-control" name="occupation">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Education Level</label>
                                                            <input type="text" class="form-control" name="education_level">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Smoking Status</label>
                                                            <select name="smoking_status" class="form-select">
                                                                <option value="" selected>Please Select</option>
                                                                <option value="Never">Never</option>
                                                                <option value="Former">Former</option>
                                                                <option value="Current">Current</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Alcohol Use</label>
                                                            <select name="alcohol_use" class="form-select">
                                                                <option value="" selected>Please Select</option>
                                                                <option value="Never">Never</option>
                                                                <option value="Occasional">Occasional</option>
                                                                <option value="Regular">Regular</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Exposure to Domestic Violence</label>
                                                            <select name="domestic_violence_exposure" class="form-select">
                                                                <option value="" selected>Please Select</option>
                                                                <option value="Yes">Yes</option>
                                                                <option value="No">No</option>
                                                                <option value="Not disclosed">Not disclosed</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Nutritional Status / Food Security</label>
                                                            <input type="text" class="form-control" name="nutritional_status" placeholder="e.g. Adequate, Moderate, Poor">
                                                        </div>
                                                    </div>

                                                    <hr class="my-4 text-muted">

                                                    <div>
                                                        <h5 class="text-center">Service</h5>
                                                    </div>

                                                    <div class="row gy-3">
                                                        <div class="col-md-12">
                                                            <label for="cc-number" class="form-label">Type of service <i id="required-field"> * </i></label>
                                                            <select name="service" class="form-select" id="">
                                                                <option value="" selected>Please Select Type Of Service</option>
                                                                @foreach ($services as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>


                                                        <div class="col-md-12" id="patient_alert"></div>
                                                    </div>
                                                    <P style="margin-top: 15px;"><b>NOTE: Those field marked with <span id="required-field">*</span> are mandatory field</b></P>

                                                </div>

                                                <div class="d-flex align-items-start gap-3 mt-4">
                                                    <button type="button" class="btn btn-light btn-label previestab" data-previous="v-pills-bill-address-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to Address & Contacts</button>
                                                    <button type="button" id="patient_btn" class="btn btn-success btn-label right ms-auto nexttab
nexttab" ><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i> Submit</button>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->
                                            <!-- end tab pane -->
                                        </div>
                                        <!-- end tab content -->
                                    </div>
                                </div>
                                <!-- end col -->

                                {{-- <div class="col-lg-3">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="fs-14 text-primary mb-0"><i class="ri-shopping-cart-fill align-middle me-2"></i> Your cart</h5>
                                        <span class="badge bg-danger rounded-pill">3</span>
                                    </div>
                                    <ul class="list-group mb-3">
                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div>
                                                <h6 class="my-0">Product name</h6>
                                                <small class="text-muted">Brief description</small>
                                            </div>
                                            <span class="text-muted">$12</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div>
                                                <h6 class="my-0">Second product</h6>
                                                <small class="text-muted">Brief description</small>
                                            </div>
                                            <span class="text-muted">$8</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div>
                                                <h6 class="my-0">Third item</h6>
                                                <small class="text-muted">Brief description</small>
                                            </div>
                                            <span class="text-muted">$5</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between bg-light">
                                            <div class="text-success">
                                                <h6 class="my-0">Discount code</h6>
                                                <small>−$5 Discount</small>
                                            </div>
                                            <span class="text-success">−$5</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Total (USD)</span>
                                            <strong>$20</strong>
                                        </li>
                                    </ul>
                                </div> --}}
                            </div>
                            <!-- end row -->
                        </form>
                    </div>
                </div>
                <!-- end -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- container-fluid -->
</div>

@endsection

@push('scripts')
<script>
    document.querySelectorAll(".form-steps").forEach(function (n) {
        n.querySelectorAll(".nexttab").forEach(function (t) {
            n.querySelectorAll('button[data-bs-toggle="pill"]').forEach(function (e) {
                e.addEventListener("show.bs.tab", function (e) {
                    e.target.classList.add("done");
                });
            }),
                t.addEventListener("click", function () {
                    var e = t.getAttribute("data-nexttab");
                    document.getElementById(e).click();
                });
        }),
            n.querySelectorAll(".previestab").forEach(function (r) {
                r.addEventListener("click", function () {
                    for (var e = r.getAttribute("data-previous"), t = r.closest("form").querySelectorAll(".custom-nav .done").length, o = t - 1; o < t; o++)
                        r.closest("form").querySelectorAll(".custom-nav .done")[o] && r.closest("form").querySelectorAll(".custom-nav .done")[o].classList.remove("done");
                    document.getElementById(e).click();
                });
            });
        var l = n.querySelectorAll('button[data-bs-toggle="pill"]');
        l.forEach(function (o, r) {
            o.setAttribute("data-position", r),
                o.addEventListener("click", function () {
                    var e;
                    o.getAttribute("data-progressbar") &&
                        ((e = document.getElementById("custom-progress-bar").querySelectorAll("li").length - 1), (e = (r / e) * 100), (document.getElementById("custom-progress-bar").querySelector(".progress-bar").style.width = e + "%")),
                        0 < n.querySelectorAll(".custom-nav .done").length &&
                            n.querySelectorAll(".custom-nav .done").forEach(function (e) {
                                e.classList.remove("done");
                            });
                    for (var t = 0; t <= r; t++) l[t].classList.contains("active") ? l[t].classList.remove("done") : l[t].classList.add("done");
                });
        });
    });
</script>
<script>
      $(document).ready(function(){
        $('#patient_btn').on('click',function(e){
            e.preventDefault();

         var dataz =$("#patient_reg").serialize();

        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
            });
        $.ajax({
        type:'POST',
        url:"{{ route('client.create')}}",
        data:dataz,
        success:function(response){
          console.log(response);
          $('#patient_alert').html('<div class="alert alert-success">'+response.message+'</div>');
          if (response.is_pregnancy && response.patient_id) {
              setTimeout(function(){
                  window.location.href = "{{ url('pregnancy') }}/" + response.patient_id + "/pdf";
              },500);
          } else {
              setTimeout(function(){
                  window.location.href="{{ route('clients.list')}}";
              },500);
          }

        },
        error:function(response){
            console.log(response.responseText);
            if (jQuery.type(response.responseJSON.errors) == "object") {
              $('#patient_alert').html('');
            $.each(response.responseJSON.errors,function(key,value){
                $('#patient_alert').append('<div class="alert alert-danger">'+value+'</div>');
            });
            } else {
               $('#patient_alert').html('<div class="alert alert-danger">'+response.responseJSON.errors+'</div>');
            }
        },
        beforeSend : function(){
                     $('#patient_btn').html('<i class="fa fa-spinner fa-pulse fa-spin"></i> Submiting ---');
                     $('#patient_btn').attr('disabled', true);
                },
                complete : function(){
                  $('#patient_btn').html('<i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i> Submit');
                  $('#patient_btn').attr('disabled', false);
                }
        });
    });
    });
</script>
<script>

        $(document).ready(function(){
            $('#region_id').change(function(){
            var region_id = $('#region_id').val();
            if(region_id != ' '){
            $.ajax({
                url:"{{ url('/get_district')}}" +'/' + region_id,
                data:{'_method':'GET'},
                dataType: 'json',
                success:function(data){
                  $('#district_id').html(data);
                }
            });
            }
            });
        });

        $(document).ready(function(){
            $('#district_id').change(function(){
            var district_id = $('#district_id').val();
            if(district_id != ' '){
            $.ajax({
                url:"{{ url('/get_ward')}}" +'/' + district_id,
                data:{'_method':'GET'},
                dataType: 'json',
                success:function(data){
                  $('#ward_id').html(data);
                }
            });
            }
            });
        });
</script>

@endpush
