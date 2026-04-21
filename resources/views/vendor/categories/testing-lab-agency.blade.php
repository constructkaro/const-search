@extends('vendor.layouts.vapp')

@section('title', 'Testing Lab / Agency')
@section('page_title', 'Testing Lab / Agency')

@section('content')

@php
    $data = $existingData ?? null;

    function safe_json_array($value) {
        if (is_array($value)) {
            return $value;
        }

        if (blank($value)) {
            return [];
        }

        $decoded = json_decode($value, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            if (is_array($decoded)) {
                return $decoded;
            }

            if (is_string($decoded)) {
                $decodedAgain = json_decode($decoded, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decodedAgain)) {
                    return $decodedAgain;
                }
            }
        }

        return [];
    }

    $services = old('services');
    if (is_null($services)) {
        $services = safe_json_array($data->services ?? []);
    }
    $services = is_array($services) ? $services : [];

    foreach ($services as $key => $value) {
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            $services[$key] = is_array($decoded) ? $decoded : [$value];
        } elseif (!is_array($value)) {
            $services[$key] = [];
        }
    }

    $serviceMode = old('service_mode');
    if (is_null($serviceMode)) {
        $serviceMode = safe_json_array($data->service_mode ?? []);
    }
    $serviceMode = is_array($serviceMode) ? $serviceMode : [];

    $labPhotos = safe_json_array($data->lab_photos ?? []);
    $labPhotos = is_array($labPhotos) ? $labPhotos : [];

    $labType = old('lab_type', $data->lab_type ?? '');
    $certification = old('certification', $data->certification ?? '');
    $samplePickup = old('sample_pickup_available', $data->sample_pickup_available ?? 0);

    $selectedCityId = old('city_id', $data->city_id ?? '');

    $selectedAreaIds = old('area_ids');
    if (is_null($selectedAreaIds)) {
        $selectedAreaIds = safe_json_array($data->area_ids ?? []);
    }
    $selectedAreaIds = is_array($selectedAreaIds) ? $selectedAreaIds : [];

    $savedPincodes = old('pincode', $data->pincode ?? '');

    $serviceOptions = [
        'soil_testing_reports' => [
            'title' => 'Soil Testing Reports',
            'icon' => 'fa-mountain',
            'options' => [
                'Soil Bearing Capacity Test',
                'Soil Classification Test',
                'Field Density Test',
            ],
        ],
        'concrete_testing_reports' => [
            'title' => 'Concrete Testing Reports',
            'icon' => 'fa-cube',
            'options' => [
                'Cube Compressive Strength',
                'Core Cutting Test',
                'Slump Test',
            ],
        ],
        'aggregate_testing' => [
            'title' => 'Aggregate Testing',
            'icon' => 'fa-layer-group',
            'options' => [
                'Sieve Analysis',
                'Impact Test',
                'Crushing Value Test',
            ],
        ],
        'sand_testing' => [
            'title' => 'Sand Testing',
            'icon' => 'fa-water',
            'options' => [
                'Silt Content Test',
                'Fineness Modulus',
                'Bulking of Sand',
            ],
        ],
        'brick_block_testing' => [
            'title' => 'Brick / Block Testing',
            'icon' => 'fa-building',
            'options' => [
                'Compressive Strength',
                'Water Absorption Test',
                'Dimension Check',
            ],
        ],
        'cement_testing' => [
            'title' => 'Cement Testing',
            'icon' => 'fa-box-open',
            'options' => [
                'Consistency Test',
                'Setting Time Test',
                'Soundness Test',
            ],
        ],
        'steel_testing' => [
            'title' => 'Steel Testing',
            'icon' => 'fa-bars-progress',
            'options' => [
                'Tensile Strength Test',
                'Bend / Re-bend Test',
                'Elongation Test',
            ],
        ],
        'water_testing' => [
            'title' => 'Water Testing',
            'icon' => 'fa-droplet',
            'options' => [
                'pH Test',
                'Chloride Test',
                'Sulphate Test',
            ],
        ],
        'bitumen_testing' => [
            'title' => 'Bitumen Testing',
            'icon' => 'fa-temperature-half',
            'options' => [
                'Penetration Test',
                'Softening Point Test',
                'Ductility Test',
            ],
        ],
        'road_pavement_testing' => [
            'title' => 'Road / Pavement Testing',
            'icon' => 'fa-road',
            'options' => [
                'CBR Test',
                'Compaction Test',
                'Road Core Test',
            ],
        ],
        'ndt_testing' => [
            'title' => 'NDT Testing',
            'icon' => 'fa-expand',
            'options' => [
                'Rebound Hammer Test',
                'UPV Test',
                'Half Cell Potential',
            ],
        ],
    ];
@endphp

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    :root{
        --primary:#0f172a;
        --text:#24324a;
        --muted:#7b8794;
        --line:#e6ebf2;
        --soft:#f8fafc;
        --white:#ffffff;
        --orange:#ff6a00;
        --orange-dark:#f25c05;
        --green-soft:#ecfdf3;
        --green:#12b76a;
        --purple-soft:#f4efff;
        --shadow:0 10px 30px rgba(16, 24, 40, 0.06);
    }

    .testing-wrap{ max-width:1320px; margin:0 auto; }

    .form-section-card,
    .section-card{
        background:var(--white);
        border:1px solid #edf1f7;
        border-radius:28px;
        box-shadow:var(--shadow);
        padding:34px;
        margin-bottom:28px;
    }

    .section-head{
        display:flex;
        align-items:flex-start;
        gap:16px;
        margin-bottom:28px;
    }

    .section-icon,
    .section-badge{
        width:56px;
        height:56px;
        border-radius:16px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:24px;
        flex-shrink:0;
    }

    .section-icon.green{ background:var(--green-soft); color:var(--green); }
    .section-icon.purple{ background:var(--purple-soft); color:#7c3aed; }
    .section-badge{ background:#fff3eb; color:var(--orange-dark); }

    .section-head h2,
    .section-title-wrap h2{
        margin:0;
        font-size:34px;
        line-height:1.1;
        color:var(--primary);
        font-weight:800;
    }

    .section-head p,
    .section-title-wrap p{
        margin:8px 0 0;
        color:#8a97a8;
        font-size:18px;
        font-weight:500;
    }

    .service-grid{
        display:grid;
        grid-template-columns:repeat(2, minmax(0, 1fr));
        gap:20px;
    }

    .service-card{
        background:#fbfcfe;
        border:1px solid var(--line);
        border-radius:20px;
        padding:18px;
    }

    .service-top{
        display:flex;
        align-items:center;
        gap:14px;
        margin-bottom:14px;
    }

    .service-top i{
        color:var(--orange-dark);
        font-size:22px;
        width:24px;
        text-align:center;
    }

    .service-title{
        font-size:16px;
        font-weight:800;
        color:var(--text);
        flex:1;
    }

    .service-hint{
        margin-top:8px;
        font-size:12px;
        color:#94a3b8;
        font-weight:600;
    }

    .divider{ height:1px; background:#eef2f7; margin:34px 0 28px; }
    .sub-head{ font-size:26px; font-weight:800; color:var(--primary); margin-bottom:24px; }

    .details-grid,
    .form-grid-2{
        display:grid;
        grid-template-columns:repeat(2, minmax(0, 1fr));
        gap:28px;
    }

    .group-title,
    .field-label{
        font-size:15px;
        font-weight:800;
        color:#475467;
        margin-bottom:14px;
    }

    .field-label .req{ color:#dc2626; }

    .option-stack{ display:grid; gap:12px; }

    .radio-card, .check-card{
        display:flex;
        align-items:center;
        gap:12px;
        padding:14px 16px;
        border:1px solid #e4eaf2;
        border-radius:16px;
        background:#fff;
        cursor:pointer;
        font-weight:700;
        color:#2d3748;
    }

    .radio-card input, .check-card input{
        accent-color:var(--orange);
        width:18px;
        height:18px;
        margin:0;
    }

    .toggle-row{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:16px;
        padding:14px 16px;
        border:1px solid #e4eaf2;
        border-radius:16px;
        background:#fff;
    }

    .toggle-row .label{ font-weight:800; color:#2d3748; }

    .switch{ position:relative; width:58px; height:32px; flex-shrink:0; }
    .switch input{ display:none; }

    .slider{
        position:absolute;
        inset:0;
        background:#d0d7e2;
        border-radius:999px;
        cursor:pointer;
        transition:.25s ease;
    }

    .slider:before{
        content:'';
        position:absolute;
        height:24px;
        width:24px;
        left:4px;
        top:4px;
        background:#fff;
        border-radius:50%;
        transition:.25s ease;
        box-shadow:0 3px 8px rgba(0,0,0,0.15);
    }

    .switch input:checked + .slider{
        background:linear-gradient(135deg, #ff8a00, #ff5a00);
    }

    .switch input:checked + .slider:before{
        transform:translateX(26px);
    }

    .form-select,
    .form-input,
    .form-textarea{
        width:100%;
        border:1px solid #dbe3ee;
        border-radius:14px;
        background:#fff;
        color:#111827;
        font-size:14px;
        padding:13px 14px;
        outline:none;
    }

    .form-textarea{
        min-height:110px;
        resize:vertical;
    }

    .upload-grid{
        display:grid;
        grid-template-columns:repeat(3, minmax(0, 1fr));
        gap:20px;
    }

    .upload-box input[type="file"]{ display:none; }

    .upload-label{
        min-height:168px;
        border:2px dashed #d4dbe6;
        border-radius:22px;
        background:#fbfcfe;
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        text-align:center;
        gap:10px;
        cursor:pointer;
        padding:20px;
    }

    .upload-label.active{
        border-color:#ff9d57;
        background:#fff7f1;
    }

    .upload-label i{ font-size:34px; color:#98a2b3; }
    .upload-label h4{ margin:0; color:#27364d; font-size:18px; font-weight:800; }
    .upload-label p{ margin:0; font-size:15px; color:#94a3b8; font-weight:600; }

    .file-name{
        display:inline-block;
        margin-top:10px;
        font-size:13px;
        font-weight:700;
        color:#16a34a;
        text-decoration:none;
        word-break:break-word;
    }

    .existing-file-box{
        margin-top:10px;
        padding:10px 12px;
        background:#f8fafc;
        border:1px solid #e2e8f0;
        border-radius:12px;
    }

    .existing-file-box a{
        color:#0f172a;
        font-size:13px;
        font-weight:700;
        text-decoration:none;
        word-break:break-all;
    }

    .footer-actions{
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:16px;
        margin-top:34px;
        flex-wrap:wrap;
    }

    .btn-back{
        display:inline-flex;
        align-items:center;
        gap:10px;
        text-decoration:none;
        color:#64748b;
        font-size:16px;
        font-weight:800;
        padding:12px 8px;
    }

    .btn-submit{
        border:none;
        border-radius:18px;
        padding:20px 34px;
        min-width:360px;
        background:linear-gradient(135deg, #ff5a00, #ff8a24);
        color:#fff;
        font-size:18px;
        font-weight:900;
        box-shadow:0 16px 28px rgba(255, 106, 0, 0.20);
        cursor:pointer;
    }

    .text-danger{
        color:#dc2626;
        font-size:12px;
        margin-top:6px;
        display:block;
        font-weight:600;
    }

    .select2-container{
        width:100% !important;
    }

    .select2-container--default .select2-selection--single{
        height:50px !important;
        border:1px solid #dbe3ee !important;
        border-radius:14px !important;
        background:#fff !important;
        display:flex !important;
        align-items:center !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered{
        line-height:48px !important;
        padding-left:14px !important;
        color:#24324a !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow{
        height:48px !important;
    }

    .select2-container--default .select2-selection--multiple{
        min-height:50px;
        border:1px solid #dbe3ee !important;
        border-radius:14px !important;
        padding:6px 10px !important;
        background:#fff !important;
        display:flex !important;
        align-items:center;
        gap:6px;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple{
        border-color:#ff8a24 !important;
        box-shadow:0 0 0 3px rgba(255, 106, 0, 0.08);
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        background:#fff3eb !important;
        border:1px solid #ffd5bf !important;
        color:#d35400 !important;
        border-radius:10px !important;
        padding:4px 10px !important;
        font-size:12px !important;
        font-weight:700 !important;
        margin-top:4px !important;
    }

    .select2-dropdown{
        border:1px solid #e5e7eb !important;
        border-radius:14px !important;
        overflow:hidden;
        box-shadow:0 12px 30px rgba(15, 23, 42, 0.12);
    }

    @media (max-width:1100px){
        .service-grid, .details-grid, .form-grid-2, .upload-grid{ grid-template-columns:1fr; }
        .btn-submit{ min-width:100%; }
    }
</style>

<div class="testing-wrap">
    <form action="{{ route('testinglabagency.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-section-card">
            <div class="section-head">
                <div class="section-icon green">
                    <i class="fa-solid fa-flask"></i>
                </div>
                <div>
                    <h2>Testing Services</h2>
                    <p>Select services you provide</p>
                </div>
            </div>

            <div class="service-grid">
                @foreach($serviceOptions as $field => $config)
                    <div class="service-card">
                        <div class="service-top">
                            <i class="fa-solid {{ $config['icon'] }}"></i>
                            <div class="service-title">{{ $config['title'] }}</div>
                        </div>

                        <select class="service-select-multi"
                                name="services[{{ $field }}][]"
                                multiple
                                data-placeholder="Select service type">
                            @foreach($config['options'] as $option)
                                <option value="{{ $option }}"
                                    {{ in_array($option, $services[$field] ?? []) ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-section-card">
            <div class="sub-head">Additional Details</div>

            <div class="details-grid">
                <div>
                    <div class="group-title">Lab Type</div>
                    <div class="option-stack">
                        <label class="radio-card">
                            <input type="radio" name="lab_type" value="in_house" {{ $labType == 'in_house' ? 'checked' : '' }}>
                            <span>In-house Laboratory</span>
                        </label>

                        <label class="radio-card">
                            <input type="radio" name="lab_type" value="third_party" {{ $labType == 'third_party' ? 'checked' : '' }}>
                            <span>Third-Party Laboratory</span>
                        </label>
                    </div>

                    <div style="height:20px;"></div>

                    <div class="group-title">Service Mode</div>
                    <div class="option-stack">
                        <label class="check-card">
                            <input type="checkbox" name="service_mode[]" value="field_testing" {{ in_array('field_testing', $serviceMode) ? 'checked' : '' }}>
                            <span>Field Testing</span>
                        </label>

                        <label class="check-card">
                            <input type="checkbox" name="service_mode[]" value="lab_testing" {{ in_array('lab_testing', $serviceMode) ? 'checked' : '' }}>
                            <span>Lab Testing</span>
                        </label>
                    </div>
                </div>

                <div>
                    <div class="group-title">Certification</div>
                    <div class="option-stack">
                        <label class="radio-card">
                            <input type="radio" name="certification" value="nabl_certified" {{ $certification == 'nabl_certified' ? 'checked' : '' }}>
                            <span>NABL Certified Lab</span>
                        </label>

                        <label class="radio-card">
                            <input type="radio" name="certification" value="non_certified" {{ $certification == 'non_certified' ? 'checked' : '' }}>
                            <span>Non-Certified Lab</span>
                        </label>
                    </div>

                    <div style="height:20px;"></div>

                    <div class="group-title">Sample Pickup Available?</div>
                    <div class="toggle-row">
                        <div class="label">Enable sample pickup service</div>
                        <label class="switch">
                            <input type="hidden" name="sample_pickup_available" value="0">
                            <input type="checkbox" name="sample_pickup_available" value="1" {{ $samplePickup ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-card">
            <div class="section-head">
                <div class="section-badge">
                    <i class="fa-solid fa-building"></i>
                </div>
                <div class="section-title-wrap">
                    <h2>Basic Business Information</h2>
                    <p>Company overview and operating details</p>
                </div>
            </div>

            <div class="form-grid-2">
                <div>
                    <div class="field-label">Years of Experience <span class="req">*</span></div>
                    <select class="form-select" name="experience_years" id="experience_years">
                        <option value="">Select years of experience</option>
                        @foreach($experienceYears as $experience)
                            <option value="{{ $experience->id }}" {{ old('experience_years', $data->experience_years ?? '') == $experience->id ? 'selected' : '' }}>
                                {{ $experience->experiance ?? $experience->experience }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <div class="field-label">Team Size <span class="req">*</span></div>
                    <select class="form-select" name="team_size" id="team_size">
                        <option value="">Select team size</option>
                        @foreach($team_size as $team)
                            <option value="{{ $team->id }}" {{ old('team_size', $data->team_size ?? '') == $team->id ? 'selected' : '' }}>
                                {{ $team->team_size }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <div class="field-label">City <span class="req">*</span></div>
                    <select class="form-select" name="city_id" id="city_id">
                        <option value="">Select City</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ $selectedCityId == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <div class="field-label">Area <span class="req">*</span></div>
                    <select class="form-select" name="area_ids[]" id="area_id" multiple></select>
                </div>

                <div>
                    <div class="field-label">Pincode <span class="req">*</span></div>
                    <textarea class="form-textarea"
                              id="pincode_id"
                              name="pincode"
                              readonly>{{ $savedPincodes }}</textarea>
                </div>

                <div>
                    <div class="field-label">Accepting projects of minimum value (₹) <span class="req">*</span></div>
                    <input type="text"
                           class="form-input"
                           name="minimum_project_value"
                           value="{{ old('minimum_project_value', $data->minimum_project_value ?? '') }}"
                           placeholder="Enter minimum project value">
                </div>
            </div>
        </div>

        <div class="form-section-card">
            <div class="section-head">
                <div class="section-icon purple">
                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                </div>
                <div>
                    <h2>Upload Documents</h2>
                    <p>Upload relevant certificates and documents</p>
                </div>
            </div>

            <div class="upload-grid">
                <div class="upload-box">
                    <input type="file" id="gst_certificate" name="gst_certificate">
                    <label for="gst_certificate" class="upload-label">
                        <i class="fa-regular fa-file-lines"></i>
                        <h4>GST Certificate</h4>
                        <p>Click to upload</p>
                    </label>
                    @if(!empty($data?->gst_certificate))
                        <div class="existing-file-box">
                            <a href="{{ asset('storage/' . $data->gst_certificate) }}" target="_blank">View Existing GST Certificate</a>
                        </div>
                    @endif
                </div>

                <div class="upload-box">
                    <input type="file" id="aadhaar_card" name="aadhaar_card">
                    <label for="aadhaar_card" class="upload-label">
                        <i class="fa-regular fa-id-card"></i>
                        <h4>Aadhaar Card</h4>
                        <p>Click to upload</p>
                    </label>
                    @if(!empty($data?->aadhaar_card))
                        <div class="existing-file-box">
                            <a href="{{ asset('storage/' . $data->aadhaar_card) }}" target="_blank">View Existing Aadhaar Card</a>
                        </div>
                    @endif
                </div>

                <div class="upload-box">
                    <input type="file" id="company_profile" name="company_profile">
                    <label for="company_profile" class="upload-label">
                        <i class="fa-regular fa-building"></i>
                        <h4>Company Profile</h4>
                        <p>Click to upload</p>
                    </label>
                    @if(!empty($data?->company_profile))
                        <div class="existing-file-box">
                            <a href="{{ asset('storage/' . $data->company_profile) }}" target="_blank">View Existing Company Profile</a>
                        </div>
                    @endif
                </div>

                <div class="upload-box">
                    <input type="file" id="nabl_certificate" name="nabl_certificate">
                    <label for="nabl_certificate" class="upload-label">
                        <i class="fa-regular fa-award"></i>
                        <h4>NABL Certificate</h4>
                        <p>Click to upload</p>
                    </label>
                    @if(!empty($data?->nabl_certificate))
                        <div class="existing-file-box">
                            <a href="{{ asset('storage/' . $data->nabl_certificate) }}" target="_blank">View Existing NABL Certificate</a>
                        </div>
                    @endif
                </div>

                <div class="upload-box">
                    <input type="file" id="lab_photos" name="lab_photos[]" multiple>
                    <label for="lab_photos" class="upload-label">
                        <i class="fa-regular fa-image"></i>
                        <h4>Lab Photos</h4>
                        <p>Click to upload</p>
                    </label>

                    @if(!empty($labPhotos))
                        <div class="existing-file-box">
                            @foreach($labPhotos as $photo)
                                <div style="margin-bottom:6px;">
                                    <a href="{{ asset('storage/' . $photo) }}" target="_blank">
                                        View Existing Lab Photo {{ $loop->iteration }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="upload-box">
                    <input type="file" id="accreditation_certificate" name="accreditation_certificate">
                    <label for="accreditation_certificate" class="upload-label">
                        <i class="fa-regular fa-circle-check"></i>
                        <h4>Accreditation Certificate</h4>
                        <p>Click to upload</p>
                    </label>
                    @if(!empty($data?->accreditation_certificate))
                        <div class="existing-file-box">
                            <a href="{{ asset('storage/' . $data->accreditation_certificate) }}" target="_blank">
                                View Existing Accreditation Certificate
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="footer-actions">
                <a href="{{ url()->previous() }}" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </a>

                <button type="submit" class="btn-submit">
                    Submit & Get Verified Leads
                </button>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        const selectedCityId = @json($selectedCityId);
        const selectedAreaIds = @json($selectedAreaIds);

        $('.service-select-multi').select2({
            placeholder: function () {
                return $(this).data('placeholder');
            },
            allowClear: true,
            width: '100%',
            closeOnSelect: false
        });

        $('#city_id').select2({
            placeholder: 'Select City',
            width: '100%'
        });

        $('#area_id').select2({
            placeholder: 'Select Area',
            width: '100%',
            closeOnSelect: false
        });

        function loadAreas(cityId, selectedAreas = []) {
            $('#area_id').html('').trigger('change');

            if (!cityId) {
                $('#pincode_id').val('');
                return;
            }

            $.ajax({
                url: "{{ route('get.areas', ':city_id') }}".replace(':city_id', cityId),
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    let options = '';

                    $.each(data, function (index, area) {
                        const isSelected =
                            selectedAreas.includes(area.id.toString()) ||
                            selectedAreas.includes(area.id);

                        options += `<option value="${area.id}" ${isSelected ? 'selected' : ''}>${area.name}</option>`;
                    });

                    $('#area_id').html(options).trigger('change');

                    if (selectedAreas.length > 0) {
                        loadPincodes(selectedAreas);
                    } else {
                        $('#pincode_id').val('');
                    }
                }
            });
        }

        function loadPincodes(areaIds) {
            if (!areaIds || areaIds.length === 0) {
                $('#pincode_id').val('');
                return;
            }

            $.ajax({
                url: "{{ route('get.pincodes') }}",
                type: 'GET',
                dataType: 'json',
                data: { area_ids: areaIds },
                success: function (data) {
                    let uniquePincodes = [...new Set(data)];
                    $('#pincode_id').val(uniquePincodes.join(', '));
                }
            });
        }

        if (selectedCityId) {
            loadAreas(selectedCityId, selectedAreaIds);
        }

        $('#city_id').on('change', function () {
            loadAreas($(this).val(), []);
        });

        $('#area_id').on('change', function () {
            loadPincodes($(this).val());
        });
    });
</script>

@endsection