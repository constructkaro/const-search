@extends('vendor.layouts.vapp')

@section('title', 'Testing Lab / Agency')
@section('page_title', 'Testing Lab / Agency')

@section('content')

@php
    $data = $existingData ?? null;

    $services = old('services');
    if (is_null($services)) {
        $services = $data && !empty($data->services) ? json_decode($data->services, true) : [];
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
        $serviceMode = $data && !empty($data->service_mode) ? json_decode($data->service_mode, true) : [];
    }
    $serviceMode = is_array($serviceMode) ? $serviceMode : [];

    $labPhotos = $data && !empty($data->lab_photos) ? json_decode($data->lab_photos, true) : [];
    $labPhotos = is_array($labPhotos) ? $labPhotos : [];

    $labType = old('lab_type', $data->lab_type ?? '');
    $certification = old('certification', $data->certification ?? '');
    $samplePickup = old('sample_pickup_available', $data->sample_pickup_available ?? 0);

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

    .form-section-card{
        background:var(--white);
        border:1px solid #edf1f7;
        border-radius:28px;
        box-shadow:var(--shadow);
        padding:34px;
        margin-bottom:28px;
    }

    .section-head{ display:flex; align-items:flex-start; gap:16px; margin-bottom:28px; }

    .section-icon{
        width:56px; height:56px; border-radius:16px; display:flex; align-items:center;
        justify-content:center; font-size:24px; flex-shrink:0;
    }

    .section-icon.green{ background:var(--green-soft); color:var(--green); }
    .section-icon.purple{ background:var(--purple-soft); color:#7c3aed; }

    .section-head h2{ margin:0; font-size:34px; line-height:1.1; color:var(--primary); font-weight:800; }
    .section-head p{ margin:8px 0 0; color:#8a97a8; font-size:18px; font-weight:500; }

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
        transition:.25s ease;
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

    .details-grid{
        display:grid;
        grid-template-columns:repeat(2, minmax(0, 1fr));
        gap:28px;
    }

    .group-title{ font-size:15px; font-weight:800; color:#475467; margin-bottom:14px; }
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
        transition:.2s ease;
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
        transition:.25s ease;
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

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
        color:#d35400 !important;
        margin-right:6px !important;
        border:none !important;
    }

    .select2-dropdown{
        border:1px solid #e5e7eb !important;
        border-radius:14px !important;
        overflow:hidden;
        box-shadow:0 12px 30px rgba(15, 23, 42, 0.12);
    }

    .select2-search--dropdown .select2-search__field{
        border:1px solid #dbe3ee !important;
        border-radius:10px !important;
        padding:10px 12px !important;
        outline:none !important;
    }

    .select2-results__option{
        padding:10px 14px !important;
        font-size:14px !important;
        font-weight:600 !important;
    }

    .select2-results__option--highlighted[aria-selected]{
        background:#fff4ec !important;
        color:#f25c05 !important;
    }

    @media (max-width:1100px){
        .service-grid, .details-grid, .upload-grid{ grid-template-columns:1fr; }
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
                                multiple="multiple"
                                data-placeholder="Select service type">
                            @foreach($config['options'] as $option)
                                <option value="{{ $option }}"
                                    {{ in_array($option, $services[$field] ?? []) ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>

                        <div class="service-hint">You can select multiple options</div>
                    </div>
                @endforeach
            </div>

            <div class="divider"></div>

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
                            <input type="checkbox" name="service_mode[]" value="field_testing" {{ in_array('field_testing', $serviceMode ?? []) ? 'checked' : '' }}>
                            <span>Field Testing</span>
                        </label>

                        <label class="check-card">
                            <input type="checkbox" name="service_mode[]" value="lab_testing" {{ in_array('lab_testing', $serviceMode ?? []) ? 'checked' : '' }}>
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
                    <a href="#" class="file-name" id="gst_certificate_name" style="display:none;"></a>
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
                    <a href="#" class="file-name" id="aadhaar_card_name" style="display:none;"></a>
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
                    <a href="#" class="file-name" id="company_profile_name" style="display:none;"></a>
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
                    <a href="#" class="file-name" id="nabl_certificate_name" style="display:none;"></a>
                </div>

                <div class="upload-box">
                    <input type="file" id="lab_photos" name="lab_photos[]" multiple>
                    <label for="lab_photos" class="upload-label">
                        <i class="fa-regular fa-image"></i>
                        <h4>Lab Photos</h4>
                        <p>Click to upload</p>
                    </label>

                    @if(!empty($labPhotos) && is_array($labPhotos))
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

                    <a href="#" class="file-name" id="lab_photos_name" style="display:none;"></a>
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
                    <a href="#" class="file-name" id="accreditation_certificate_name" style="display:none;"></a>
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
        $('.service-select-multi').select2({
            placeholder: function () {
                return $(this).data('placeholder');
            },
            allowClear: true,
            width: '100%',
            closeOnSelect: false
        });

        function bindFilePreview(inputId, fileNameId) {
            const input = document.getElementById(inputId);
            const fileNameBox = document.getElementById(fileNameId);

            if (!input || !fileNameBox) return;

            input.addEventListener('change', function () {
                if (this.files.length > 0) {
                    fileNameBox.textContent = this.files.length > 1
                        ? `${this.files.length} files selected`
                        : this.files[0].name;

                    fileNameBox.style.display = 'inline-block';

                    const label = this.closest('.upload-box')?.querySelector('.upload-label');
                    if (label) {
                        label.classList.add('active');
                    }
                } else {
                    fileNameBox.textContent = '';
                    fileNameBox.style.display = 'none';

                    const label = this.closest('.upload-box')?.querySelector('.upload-label');
                    if (label) {
                        label.classList.remove('active');
                    }
                }
            });
        }

        bindFilePreview('gst_certificate', 'gst_certificate_name');
        bindFilePreview('aadhaar_card', 'aadhaar_card_name');
        bindFilePreview('company_profile', 'company_profile_name');
        bindFilePreview('nabl_certificate', 'nabl_certificate_name');
        bindFilePreview('lab_photos', 'lab_photos_name');
        bindFilePreview('accreditation_certificate', 'accreditation_certificate_name');
    });
</script>
@endsection