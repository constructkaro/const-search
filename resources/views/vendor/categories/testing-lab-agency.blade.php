@extends('vendor.layouts.vapp')

@section('title', 'Testing Lab / Agency')
@section('page_title', 'Testing Lab / Agency')

@section('content')

@php
    $services = old('services', isset($existingData->services) ? json_decode($existingData->services, true) : []);
    $serviceMode = old('service_mode', isset($existingData->service_mode) ? json_decode($existingData->service_mode, true) : []);
    $labPhotos = isset($existingData->lab_photos) ? json_decode($existingData->lab_photos, true) : [];

    $labType = old('lab_type', $existingData->lab_type ?? '');
    $certification = old('certification', $existingData->certification ?? '');
    $samplePickup = old('sample_pickup_available', $existingData->sample_pickup_available ?? 0);
@endphp

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
        --radius-xl:26px;
        --radius-lg:18px;
        --radius-md:14px;
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

    .service-select{
        width:100%;
        height:50px;
        border:1px solid #dbe3ee;
        border-radius:14px;
        padding:0 16px;
        background:#fff;
        color:#344054;
        font-size:14px;
        font-weight:600;
        outline:none;
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

    .file-name:hover{ text-decoration:underline; }

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

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-mountain"></i>
                        <div class="service-title">Soil Testing Reports</div>
                    </div>
                    <select class="service-select" name="services[soil_testing_reports]">
                        <option value="">Select service type</option>
                        <option value="Soil Bearing Capacity Test" {{ ($services['soil_testing_reports'] ?? '') == 'Soil Bearing Capacity Test' ? 'selected' : '' }}>Soil Bearing Capacity Test</option>
                        <option value="Soil Classification Test" {{ ($services['soil_testing_reports'] ?? '') == 'Soil Classification Test' ? 'selected' : '' }}>Soil Classification Test</option>
                        <option value="Field Density Test" {{ ($services['soil_testing_reports'] ?? '') == 'Field Density Test' ? 'selected' : '' }}>Field Density Test</option>
                    </select>
                </div>

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-cube"></i>
                        <div class="service-title">Concrete Testing Reports</div>
                    </div>
                    <select class="service-select" name="services[concrete_testing_reports]">
                        <option value="">Select service type</option>
                        <option value="Cube Compressive Strength" {{ ($services['concrete_testing_reports'] ?? '') == 'Cube Compressive Strength' ? 'selected' : '' }}>Cube Compressive Strength</option>
                        <option value="Core Cutting Test" {{ ($services['concrete_testing_reports'] ?? '') == 'Core Cutting Test' ? 'selected' : '' }}>Core Cutting Test</option>
                        <option value="Slump Test" {{ ($services['concrete_testing_reports'] ?? '') == 'Slump Test' ? 'selected' : '' }}>Slump Test</option>
                    </select>
                </div>

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-layer-group"></i>
                        <div class="service-title">Aggregate Testing</div>
                    </div>
                    <select class="service-select" name="services[aggregate_testing]">
                        <option value="">Select service type</option>
                        <option value="Sieve Analysis" {{ ($services['aggregate_testing'] ?? '') == 'Sieve Analysis' ? 'selected' : '' }}>Sieve Analysis</option>
                        <option value="Impact Test" {{ ($services['aggregate_testing'] ?? '') == 'Impact Test' ? 'selected' : '' }}>Impact Test</option>
                        <option value="Crushing Value Test" {{ ($services['aggregate_testing'] ?? '') == 'Crushing Value Test' ? 'selected' : '' }}>Crushing Value Test</option>
                    </select>
                </div>

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-water"></i>
                        <div class="service-title">Sand Testing</div>
                    </div>
                    <select class="service-select" name="services[sand_testing]">
                        <option value="">Select service type</option>
                        <option value="Silt Content Test" {{ ($services['sand_testing'] ?? '') == 'Silt Content Test' ? 'selected' : '' }}>Silt Content Test</option>
                        <option value="Fineness Modulus" {{ ($services['sand_testing'] ?? '') == 'Fineness Modulus' ? 'selected' : '' }}>Fineness Modulus</option>
                        <option value="Bulking of Sand" {{ ($services['sand_testing'] ?? '') == 'Bulking of Sand' ? 'selected' : '' }}>Bulking of Sand</option>
                    </select>
                </div>

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-building"></i>
                        <div class="service-title">Brick / Block Testing</div>
                    </div>
                    <select class="service-select" name="services[brick_block_testing]">
                        <option value="">Select service type</option>
                        <option value="Compressive Strength" {{ ($services['brick_block_testing'] ?? '') == 'Compressive Strength' ? 'selected' : '' }}>Compressive Strength</option>
                        <option value="Water Absorption Test" {{ ($services['brick_block_testing'] ?? '') == 'Water Absorption Test' ? 'selected' : '' }}>Water Absorption Test</option>
                        <option value="Dimension Check" {{ ($services['brick_block_testing'] ?? '') == 'Dimension Check' ? 'selected' : '' }}>Dimension Check</option>
                    </select>
                </div>

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-box-open"></i>
                        <div class="service-title">Cement Testing</div>
                    </div>
                    <select class="service-select" name="services[cement_testing]">
                        <option value="">Select service type</option>
                        <option value="Consistency Test" {{ ($services['cement_testing'] ?? '') == 'Consistency Test' ? 'selected' : '' }}>Consistency Test</option>
                        <option value="Setting Time Test" {{ ($services['cement_testing'] ?? '') == 'Setting Time Test' ? 'selected' : '' }}>Setting Time Test</option>
                        <option value="Soundness Test" {{ ($services['cement_testing'] ?? '') == 'Soundness Test' ? 'selected' : '' }}>Soundness Test</option>
                    </select>
                </div>

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-bars-progress"></i>
                        <div class="service-title">Steel Testing</div>
                    </div>
                    <select class="service-select" name="services[steel_testing]">
                        <option value="">Select service type</option>
                        <option value="Tensile Strength Test" {{ ($services['steel_testing'] ?? '') == 'Tensile Strength Test' ? 'selected' : '' }}>Tensile Strength Test</option>
                        <option value="Bend / Re-bend Test" {{ ($services['steel_testing'] ?? '') == 'Bend / Re-bend Test' ? 'selected' : '' }}>Bend / Re-bend Test</option>
                        <option value="Elongation Test" {{ ($services['steel_testing'] ?? '') == 'Elongation Test' ? 'selected' : '' }}>Elongation Test</option>
                    </select>
                </div>

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-droplet"></i>
                        <div class="service-title">Water Testing</div>
                    </div>
                    <select class="service-select" name="services[water_testing]">
                        <option value="">Select service type</option>
                        <option value="pH Test" {{ ($services['water_testing'] ?? '') == 'pH Test' ? 'selected' : '' }}>pH Test</option>
                        <option value="Chloride Test" {{ ($services['water_testing'] ?? '') == 'Chloride Test' ? 'selected' : '' }}>Chloride Test</option>
                        <option value="Sulphate Test" {{ ($services['water_testing'] ?? '') == 'Sulphate Test' ? 'selected' : '' }}>Sulphate Test</option>
                    </select>
                </div>

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-temperature-half"></i>
                        <div class="service-title">Bitumen Testing</div>
                    </div>
                    <select class="service-select" name="services[bitumen_testing]">
                        <option value="">Select service type</option>
                        <option value="Penetration Test" {{ ($services['bitumen_testing'] ?? '') == 'Penetration Test' ? 'selected' : '' }}>Penetration Test</option>
                        <option value="Softening Point Test" {{ ($services['bitumen_testing'] ?? '') == 'Softening Point Test' ? 'selected' : '' }}>Softening Point Test</option>
                        <option value="Ductility Test" {{ ($services['bitumen_testing'] ?? '') == 'Ductility Test' ? 'selected' : '' }}>Ductility Test</option>
                    </select>
                </div>

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-road"></i>
                        <div class="service-title">Road / Pavement Testing</div>
                    </div>
                    <select class="service-select" name="services[road_pavement_testing]">
                        <option value="">Select service type</option>
                        <option value="CBR Test" {{ ($services['road_pavement_testing'] ?? '') == 'CBR Test' ? 'selected' : '' }}>CBR Test</option>
                        <option value="Compaction Test" {{ ($services['road_pavement_testing'] ?? '') == 'Compaction Test' ? 'selected' : '' }}>Compaction Test</option>
                        <option value="Road Core Test" {{ ($services['road_pavement_testing'] ?? '') == 'Road Core Test' ? 'selected' : '' }}>Road Core Test</option>
                    </select>
                </div>

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-expand"></i>
                        <div class="service-title">NDT Testing</div>
                    </div>
                    <select class="service-select" name="services[ndt_testing]">
                        <option value="">Select service type</option>
                        <option value="Rebound Hammer Test" {{ ($services['ndt_testing'] ?? '') == 'Rebound Hammer Test' ? 'selected' : '' }}>Rebound Hammer Test</option>
                        <option value="UPV Test" {{ ($services['ndt_testing'] ?? '') == 'UPV Test' ? 'selected' : '' }}>UPV Test</option>
                        <option value="Half Cell Potential" {{ ($services['ndt_testing'] ?? '') == 'Half Cell Potential' ? 'selected' : '' }}>Half Cell Potential</option>
                    </select>
                </div>

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
                    @if(!empty($existingData->gst_certificate))
                        <div class="existing-file-box">
                            <a href="{{ asset('storage/' . $existingData->gst_certificate) }}" target="_blank">
                                View Existing GST Certificate
                            </a>
                        </div>
                    @endif
                    <a href="#" class="file-name file-link" id="gst_certificate_name" target="_blank" style="display:none;"></a>
                </div>

                <div class="upload-box">
                    <input type="file" id="aadhaar_card" name="aadhaar_card">
                    <label for="aadhaar_card" class="upload-label">
                        <i class="fa-regular fa-id-card"></i>
                        <h4>Aadhaar Card</h4>
                        <p>Click to upload</p>
                    </label>
                    @if(!empty($existingData->aadhaar_card))
                        <div class="existing-file-box">
                            <a href="{{ asset('storage/' . $existingData->aadhaar_card) }}" target="_blank">
                                View Existing Aadhaar Card
                            </a>
                        </div>
                    @endif
                    <a href="#" class="file-name file-link" id="aadhaar_card_name" target="_blank" style="display:none;"></a>
                </div>

                <div class="upload-box">
                    <input type="file" id="company_profile" name="company_profile">
                    <label for="company_profile" class="upload-label">
                        <i class="fa-regular fa-building"></i>
                        <h4>Company Profile</h4>
                        <p>Click to upload</p>
                    </label>
                    @if(!empty($existingData->company_profile))
                        <div class="existing-file-box">
                            <a href="{{ asset('storage/' . $existingData->company_profile) }}" target="_blank">
                                View Existing Company Profile
                            </a>
                        </div>
                    @endif
                    <a href="#" class="file-name file-link" id="company_profile_name" target="_blank" style="display:none;"></a>
                </div>

                <div class="upload-box">
                    <input type="file" id="nabl_certificate" name="nabl_certificate">
                    <label for="nabl_certificate" class="upload-label">
                        <i class="fa-regular fa-award"></i>
                        <h4>NABL Certificate</h4>
                        <p>Click to upload</p>
                    </label>
                    @if(!empty($existingData->nabl_certificate))
                        <div class="existing-file-box">
                            <a href="{{ asset('storage/' . $existingData->nabl_certificate) }}" target="_blank">
                                View Existing NABL Certificate
                            </a>
                        </div>
                    @endif
                    <a href="#" class="file-name file-link" id="nabl_certificate_name" target="_blank" style="display:none;"></a>
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

                    <a href="#" class="file-name file-link" id="lab_photos_name" target="_blank" style="display:none;"></a>
                </div>

                <div class="upload-box">
                    <input type="file" id="accreditation_certificate" name="accreditation_certificate">
                    <label for="accreditation_certificate" class="upload-label">
                        <i class="fa-regular fa-circle-check"></i>
                        <h4>Accreditation Certificate</h4>
                        <p>Click to upload</p>
                    </label>
                    @if(!empty($existingData->accreditation_certificate))
                        <div class="existing-file-box">
                            <a href="{{ asset('storage/' . $existingData->accreditation_certificate) }}" target="_blank">
                                View Existing Accreditation Certificate
                            </a>
                        </div>
                    @endif
                    <a href="#" class="file-name file-link" id="accreditation_certificate_name" target="_blank" style="display:none;"></a>
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

<script>
    function bindFilePreview(inputId, fileNameId) {
        const input = document.getElementById(inputId);
        const fileNameBox = document.getElementById(fileNameId);

        if (!input || !fileNameBox) return;

        input.addEventListener('change', function () {
            if (this.files.length > 0) {
                const file = this.files[0];
                const fileUrl = URL.createObjectURL(file);

                fileNameBox.textContent = this.files.length > 1
                    ? `${this.files.length} files selected`
                    : file.name;

                fileNameBox.href = fileUrl;
                fileNameBox.style.display = 'inline-block';
                fileNameBox.setAttribute('target', '_blank');
            } else {
                fileNameBox.textContent = '';
                fileNameBox.href = '#';
                fileNameBox.style.display = 'none';
            }
        });
    }

    bindFilePreview('gst_certificate', 'gst_certificate_name');
    bindFilePreview('aadhaar_card', 'aadhaar_card_name');
    bindFilePreview('company_profile', 'company_profile_name');
    bindFilePreview('nabl_certificate', 'nabl_certificate_name');
    bindFilePreview('lab_photos', 'lab_photos_name');
    bindFilePreview('accreditation_certificate', 'accreditation_certificate_name');
</script>
@endsection