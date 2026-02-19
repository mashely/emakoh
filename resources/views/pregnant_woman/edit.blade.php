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
                        <h4 class="card-title mb-0 text-center">{{ __('app.client_registration') }}</h4>
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
                                                {{ __('app.step1_basic_info') }}
                                            </span>
                                            {{ __('app.basic_information') }}
                                        </button>
                                        <button class="nav-link done" id="v-pills-bill-address-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bill-address" type="button" role="tab" aria-controls="v-pills-bill-address" aria-selected="false">
                                            <span class="step-title me-2">
                                                <i class="ri-close-circle-fill step-icon me-2"></i>
                                                {{ __('app.step2_address') }}
                                            </span>
                                            {{ __('app.address') }}
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
                                                    <h5 class="text-center">{{ __('app.client_basic_information') }}</h5>
                                                </div>
                                                <hr>
                                                <div>
                                                    <div class="row g-3">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label for="firstName" class="form-label">{{ __('app.first_name') }}</label>
                                                                <input type="text" class="form-control" id="firstName" value="{{ $client->first_name }}" name="first_name" required>
                                                                <input type="hidden" name="client_id" value="{{ $client->id}}">
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <label for="lastName" class="form-label">{{ __('app.middle_name') }}</label>
                                                                <input type="text" class="form-control" id="middleName" value="{{ $client->middle_name }}" name="middle_name">
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <label for="username" class="form-label">{{ __('app.last_name') }}</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" id="lastName" value="{{ $client->last_name }}" name="last_name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label for="DOB" class="form-label">{{ __('app.date_of_birth') }}</label>
                                                                <input type="date" class="form-control" id="dob" name="dob" max="{{ date('Y-m-d')}}" value="{{ $client->dob }}">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="Gender" class="form-label">{{ __('app.gender') }}</label>
                                                               <select name="gender" class="form-select" id="">
                                                                   <option value="{{$client->gender_id}}" selected>{{$client->gender->name}}</option>
                                                                   @foreach ($gender as $item)
                                                                       <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                   @endforeach
                                                               </select>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="Gender" class="form-label">{{ __('app.marital_status') }}</label>
                                                                <select name="marital_status" class="form-select" id="">
                                                                    <option value="{{ $client->marital_status_id }}" selected>{{ $client->marital->name }}</option>
                                                                    @foreach ($marital_status as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label for="DOB" class="form-label">{{ __('app.id_type') }}</label>
                                                                <select name="id_type" class="form-select" id="">
                                                                    <option value="{{ $client->id_type }}" selected>{{ $client->idType->name }}</option>
                                                                    @foreach ($idtype as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="Id" class="form-label">{{ __('app.id_number') }}</label>
                                                                <input type="twxt" class="form-control" id="idnumber" name="id_number" value="{{ $client->id_number }}">
                                                            </div>
                                                        </div>



                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-start gap-3 mt-4">
                                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab
nexttab" data-nexttab="v-pills-bill-address-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>{{ __('app.go_to_address') }}</button>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->
                                            <div class="tab-pane fade " id="v-pills-bill-address" role="tabpanel" aria-labelledby="v-pills-bill-address-tab">
                                                <div>
                                                    <h5 class="text-center">{{ __('app.client_address') }}</h5>
                                                </div>
                                                <hr>
                                                <div>
                                                    <div class="row g-3">
                                                        <div class="col-md-4">
                                                            <label for="region_id" class="form-label">{{ __('app.region') }}</label>
                                                            <select class="form-select" name="region" id="region_id" >
                                                                <option value="{{ $client->reg_code }}">{{ $client->region->reg_name }}</option>
                                                                @foreach ($regions as $item)
                                                                <option value="{{ $item->reg_code }}">{{ $item->reg_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="district_id" class="form-label">{{ __('app.district') }}</label>
                                                            <select class="form-select" name="district" id="district_id">
                                                                <option value="{{ $client->dis_code }}" selected>{{ $client->district->dis_name }}</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label for="zip" class="form-label">{{ __('app.ward') }}</label>
                                                            <select name="ward" class="form-select"  id="ward_id">
                                                                <option value="{{ $client->ward_code }}" selected>{{ $client->ward->ward_name }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="Location">{{ __('app.physical_location') }}</label>
                                                            <textarea name="location" rows="7" class="form-control">{{ $client->physical_address }}</textarea>
                                                        </div>
                                                    </div>

                                                    <hr class="my-4 text-muted">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="Location">{{ __('app.phone_number') }}</label>
                                                            <input type="number" class="form-control" value="{{ $client->phone_number }}" name="phone_number">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="Location">{{ __('app.alternative_phone_number') }}</label>
                                                            <input type="number" class="form-control" name="alt_phone_number" value="{{ isset($pregnancy) ? $pregnancy->alt_phone_number : '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-md-6">
                                                            <label for="Location">{{ __('app.emergency_contact_person') }}</label>
                                                            <input type="text" class="form-control" name="emergency_contact_name" value="{{ isset($pregnancy) ? $pregnancy->emergency_contact_name : '' }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="Location">{{ __('app.emergency_contact_phone') }}</label>
                                                            <input type="number" class="form-control" name="emergency_contact_phone" value="{{ isset($pregnancy) ? $pregnancy->emergency_contact_phone : '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12" id="patient_alert"></div>
                                                    </div>

                                                </div>
                                                <div class="d-flex align-items-start gap-3 mt-4">
                                                    <button type="button" class="btn btn-light btn-label previestab" data-previous="v-pills-bill-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> {{ __('app.back_to_address_info') }}</button>
                                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab" data-nexttab="v-pills-payment-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i> {{ __('app.go_to_pregnancy_section') }}</button>
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
                                                            <input type="number" class="form-control" name="gravida" min="0" value="{{ isset($pregnancy) ? $pregnancy->gravida : '' }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">{{ __('app.para_label') }}</label>
                                                            <input type="number" class="form-control" name="para" min="0" value="{{ isset($pregnancy) ? $pregnancy->para : '' }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">{{ __('app.number_of_living_children') }}</label>
                                                            <input type="number" class="form-control" name="living_children" min="0" value="{{ isset($pregnancy) ? $pregnancy->living_children : '' }}">
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-3">
                                                            <label class="form-label">{{ __('app.miscarriages_abortions') }}</label>
                                                            <input type="number" class="form-control" name="miscarriages" min="0" value="{{ isset($pregnancy) ? $pregnancy->miscarriages : '' }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">{{ __('app.stillbirths') }}</label>
                                                            <input type="number" class="form-control" name="stillbirths" min="0" value="{{ isset($pregnancy) ? $pregnancy->stillbirths : '' }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">{{ __('app.cesarean_sections') }}</label>
                                                            <input type="number" class="form-control" name="cesarean_sections" min="0" value="{{ isset($pregnancy) ? $pregnancy->cesarean_sections : '' }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">{{ __('app.preterm_births') }}</label>
                                                            <input type="number" class="form-control" name="preterm_births" min="0" value="{{ isset($pregnancy) ? $pregnancy->preterm_births : '' }}">
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Last Menstrual Period (LMP)</label>
                                                            <input type="date" class="form-control" name="lmp" max="{{ date('Y-m-d')}}" value="{{ isset($pregnancy) ? $pregnancy->lmp : '' }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Estimated Due Date (EDD)</label>
                                                            <input type="date" class="form-control" name="edd" value="{{ isset($pregnancy) ? $pregnancy->edd : '' }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Gestational Age (weeks)</label>
                                                            <input type="number" class="form-control" name="gestational_age_weeks" min="0" value="{{ isset($pregnancy) ? $pregnancy->gestational_age_weeks : '' }}">
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Pregnancy Type</label>
                                                            <select name="pregnancy_planned" class="form-select">
                                                                <option value="">{{ __('app.please_choose_option') }}</option>
                                                                <option value="Planned" {{ isset($pregnancy) && $pregnancy->pregnancy_planned === 'Planned' ? 'selected' : '' }}>Planned</option>
                                                                <option value="Unplanned" {{ isset($pregnancy) && $pregnancy->pregnancy_planned === 'Unplanned' ? 'selected' : '' }}>Unplanned</option>
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
                                                            <input type="date" class="form-control" name="first_anc_visit_date" value="{{ isset($pregnancy) ? $pregnancy->first_anc_visit_date : '' }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Pregnancy Confirmation Method</label>
                                                            <input type="text" class="form-control" name="pregnancy_confirmation_method" value="{{ isset($pregnancy) ? $pregnancy->pregnancy_confirmation_method : '' }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Pregnancy Number</label>
                                                            <input type="number" class="form-control" name="pregnancy_number" min="1" value="{{ isset($pregnancy) ? $pregnancy->pregnancy_number : '' }}">
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Fetal Movements</label>
                                                            <select name="fetal_movements" class="form-select">
                                                                <option value="">{{ __('app.please_choose_option') }}</option>
                                                                <option value="Yes" {{ isset($pregnancy) && $pregnancy->fetal_movements === 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ isset($pregnancy) && $pregnancy->fetal_movements === 'No' ? 'selected' : '' }}>No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">If Yes, When Started</label>
                                                            <input type="date" class="form-control" name="fetal_movements_started_at" value="{{ isset($pregnancy) ? $pregnancy->fetal_movements_started_at : '' }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Multiple Pregnancy</label>
                                                            <input type="text" class="form-control" name="multiple_pregnancy_type" value="{{ isset($pregnancy) ? $pregnancy->multiple_pregnancy_type : '' }}">
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-12">
                                                            <label class="form-label">Danger Signs Reported</label>
                                                            <textarea class="form-control" name="danger_signs" rows="2">{{ isset($pregnancy) ? $pregnancy->danger_signs : '' }}</textarea>
                                                        </div>
                                                    </div>

                                                    <hr class="my-4 text-muted">

                                                    <div>
                                                        <h5 class="text-center">Medical History</h5>
                                                    </div>

                                                    <div class="row gy-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label d-block">Chronic Illnesses</label>
                                                            <textarea class="form-control" name="chronic_illnesses" rows="2">{{ isset($pregnancy) ? $pregnancy->chronic_illnesses : '' }}</textarea>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label d-block">Previous Pregnancy Complications</label>
                                                            <textarea class="form-control" name="previous_pregnancy_complications" rows="2">{{ isset($pregnancy) ? $pregnancy->previous_pregnancy_complications : '' }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Blood Transfusion History</label>
                                                            <select name="blood_transfusion_history" class="form-select">
                                                                <option value="">{{ __('app.please_choose_option') }}</option>
                                                                <option value="Yes" {{ isset($pregnancy) && $pregnancy->blood_transfusion_history === 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                <option value="No" {{ isset($pregnancy) && $pregnancy->blood_transfusion_history === 'No' ? 'selected' : '' }}>No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Surgical History</label>
                                                            <input type="text" class="form-control" name="surgical_history" value="{{ isset($pregnancy) ? $pregnancy->surgical_history : '' }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Allergies (drugs, foods)</label>
                                                            <input type="text" class="form-control" name="allergies" value="{{ isset($pregnancy) ? $pregnancy->allergies : '' }}">
                                                        </div>
                                                    </div>

                                                    <hr class="my-4 text-muted">

                                                    <div>
                                                        <h5 class="text-center">Physical & Clinical Measurements (Baseline)</h5>
                                                    </div>

                                                    <div class="row gy-3">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Height (cm)</label>
                                                            <input type="number" step="0.1" class="form-control" name="height_cm" value="{{ isset($pregnancy) ? $pregnancy->height_cm : '' }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Weight (kg)</label>
                                                            <input type="number" step="0.1" class="form-control" name="weight_kg" value="{{ isset($pregnancy) ? $pregnancy->weight_kg : '' }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">BMI</label>
                                                            <input type="number" step="0.1" class="form-control" name="bmi" value="{{ isset($pregnancy) ? $pregnancy->bmi : '' }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Blood Pressure</label>
                                                            <input type="text" class="form-control" name="blood_pressure" value="{{ isset($pregnancy) ? $pregnancy->blood_pressure : '' }}">
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Temperature (°C)</label>
                                                            <input type="number" step="0.1" class="form-control" name="temperature_c" value="{{ isset($pregnancy) ? $pregnancy->temperature_c : '' }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Pulse Rate</label>
                                                            <input type="number" class="form-control" name="pulse_rate" value="{{ isset($pregnancy) ? $pregnancy->pulse_rate : '' }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">MUAC (cm)</label>
                                                            <input type="number" step="0.1" class="form-control" name="muac_cm" value="{{ isset($pregnancy) ? $pregnancy->muac_cm : '' }}">
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Blood Group</label>
                                                            <select name="blood_group" class="form-select">
                                                                <option value="">{{ __('app.please_choose_option') }}</option>
                                                                <option value="A+" {{ isset($pregnancy) && $pregnancy->blood_group === 'A+' ? 'selected' : '' }}>A+</option>
                                                                <option value="A-" {{ isset($pregnancy) && $pregnancy->blood_group === 'A-' ? 'selected' : '' }}>A-</option>
                                                                <option value="B+" {{ isset($pregnancy) && $pregnancy->blood_group === 'B+' ? 'selected' : '' }}>B+</option>
                                                                <option value="B-" {{ isset($pregnancy) && $pregnancy->blood_group === 'B-' ? 'selected' : '' }}>B-</option>
                                                                <option value="AB+" {{ isset($pregnancy) && $pregnancy->blood_group === 'AB+' ? 'selected' : '' }}>AB+</option>
                                                                <option value="AB-" {{ isset($pregnancy) && $pregnancy->blood_group === 'AB-' ? 'selected' : '' }}>AB-</option>
                                                                <option value="O+" {{ isset($pregnancy) && $pregnancy->blood_group === 'O+' ? 'selected' : '' }}>O+</option>
                                                                <option value="O-" {{ isset($pregnancy) && $pregnancy->blood_group === 'O-' ? 'selected' : '' }}>O-</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Rhesus Factor</label>
                                                            <select name="rhesus_factor" class="form-select">
                                                                <option value="">{{ __('app.please_choose_option') }}</option>
                                                                <option value="Positive" {{ isset($pregnancy) && $pregnancy->rhesus_factor === 'Positive' ? 'selected' : '' }}>Positive</option>
                                                                <option value="Negative" {{ isset($pregnancy) && $pregnancy->rhesus_factor === 'Negative' ? 'selected' : '' }}>Negative</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Hemoglobin Level</label>
                                                            <input type="text" class="form-control" name="hemoglobin_level" value="{{ isset($pregnancy) ? $pregnancy->hemoglobin_level : '' }}">
                                                        </div>
                                                    </div>

                                                    <hr class="my-4 text-muted">

                                                    <div>
                                                        <h5 class="text-center">Laboratory Results</h5>
                                                    </div>

                                                    <div class="row gy-3">
                                                        <div class="col-md-3">
                                                            <label class="form-label">HIV Status</label>
                                                            <input type="text" class="form-control" name="hiv_status" value="{{ isset($pregnancy) ? $pregnancy->hiv_status : '' }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Syphilis Result</label>
                                                            <input type="text" class="form-control" name="syphilis_result" value="{{ isset($pregnancy) ? $pregnancy->syphilis_result : '' }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Hepatitis B Result</label>
                                                            <input type="text" class="form-control" name="hepatitis_b_result" value="{{ isset($pregnancy) ? $pregnancy->hepatitis_b_result : '' }}">
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Urinalysis Protein</label>
                                                            <input type="text" class="form-control" name="urinalysis_protein" value="{{ isset($pregnancy) ? $pregnancy->urinalysis_protein : '' }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Urinalysis Sugar</label>
                                                            <input type="text" class="form-control" name="urinalysis_sugar" value="{{ isset($pregnancy) ? $pregnancy->urinalysis_sugar : '' }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Blood Sugar</label>
                                                            <input type="text" class="form-control" name="blood_sugar" value="{{ isset($pregnancy) ? $pregnancy->blood_sugar : '' }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Malaria Test Result</label>
                                                            <input type="text" class="form-control" name="malaria_test_result" value="{{ isset($pregnancy) ? $pregnancy->malaria_test_result : '' }}">
                                                        </div>
                                                    </div>

                                                    <hr class="my-4 text-muted">

                                                    <div>
                                                        <h5 class="text-center">Treatment & Preventive Care</h5>
                                                    </div>

                                                    <div class="row gy-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Iron/Folic Started</label>
                                                            <input type="text" class="form-control" name="iron_folic_started" value="{{ isset($pregnancy) ? $pregnancy->iron_folic_started : '' }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Deworming Status</label>
                                                            <input type="text" class="form-control" name="deworming_status" value="{{ isset($pregnancy) ? $pregnancy->deworming_status : '' }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Tetanus Toxoid Doses</label>
                                                            <input type="text" class="form-control" name="tetanus_toxoid_doses" value="{{ isset($pregnancy) ? $pregnancy->tetanus_toxoid_doses : '' }}">
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Current Medications</label>
                                                            <input type="text" class="form-control" name="current_medications" value="{{ isset($pregnancy) ? $pregnancy->current_medications : '' }}">
                                                        </div>
                                                    </div>

                                                    <hr class="my-4 text-muted">

                                                    <div>
                                                        <h5 class="text-center">Social & Lifestyle Factors</h5>
                                                    </div>

                                                    <div class="row gy-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Occupation</label>
                                                            <input type="text" class="form-control" name="occupation" value="{{ isset($pregnancy) ? $pregnancy->occupation : '' }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Education Level</label>
                                                            <input type="text" class="form-control" name="education_level" value="{{ isset($pregnancy) ? $pregnancy->education_level : '' }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Smoking Status</label>
                                                            <input type="text" class="form-control" name="smoking_status" value="{{ isset($pregnancy) ? $pregnancy->smoking_status : '' }}">
                                                        </div>
                                                    </div>

                                                    <div class="row gy-3 mt-1">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Alcohol Use</label>
                                                            <input type="text" class="form-control" name="alcohol_use" value="{{ isset($pregnancy) ? $pregnancy->alcohol_use : '' }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Domestic Violence Exposure</label>
                                                            <input type="text" class="form-control" name="domestic_violence_exposure" value="{{ isset($pregnancy) ? $pregnancy->domestic_violence_exposure : '' }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Nutritional Status</label>
                                                            <input type="text" class="form-control" name="nutritional_status" value="{{ isset($pregnancy) ? $pregnancy->nutritional_status : '' }}">
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-md-12" id="patient_alert"></div>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-start gap-3 mt-4">
                                                    <button type="button" class="btn btn-light btn-label previestab" data-previous="v-pills-bill-address-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> {{ __('app.back_to_address_info') }}</button>
                                                    <button type="button" id="patient_btn" class="btn btn-success btn-label right ms-auto"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i> Update</button>
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
        url:"{{ route('client.update')}}",
        data:dataz,
        success:function(response){
          console.log(response);
         // return;
          $('#patient_alert').html('<div class="alert alert-success">'+response.message+'</div>');
          setTimeout(function(){
            window.location.href="{{ route('clients.list')}}";
        },500);

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
