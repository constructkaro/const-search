@extends('vendor.layouts.vapp')

@section('title', 'Testing Lab / Agency')
@section('page_title', 'Testing Lab / Agency')

@section('content')

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

    .testing-wrap{
        max-width: 1320px;
        margin: 0 auto;
    }

    .form-section-card{
        background: var(--white);
        border: 1px solid #edf1f7;
        border-radius: 28px;
        box-shadow: var(--shadow);
        padding: 34px;
        margin-bottom: 28px;
    }

    .section-head{
        display:flex;
        align-items:flex-start;
        gap:16px;
        margin-bottom:28px;
    }

    .section-icon{
        width:56px;
        height:56px;
        border-radius:16px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:24px;
        flex-shrink:0;
    }

    .section-icon.green{
        background: var(--green-soft);
        color: var(--green);
    }

    .section-icon.purple{
        background: var(--purple-soft);
        color: #7c3aed;
    }

    .section-head h2{
        margin:0;
        font-size:34px;
        line-height:1.1;
        color: var(--primary);
        font-weight:800;
    }

    .section-head p{
        margin:8px 0 0;
        color: #8a97a8;
        font-size:18px;
        font-weight:500;
    }

    .service-grid{
        display:grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap:20px;
    }

    .service-card{
        background:#fbfcfe;
        border:1px solid var(--line);
        border-radius:20px;
        padding:18px 18px 18px 18px;
        transition:.25s ease;
    }

    .service-card:hover{
        border-color:#d7dfeb;
        box-shadow:0 8px 20px rgba(15, 23, 42, 0.05);
        transform:translateY(-1px);
    }

    .service-top{
        display:flex;
        align-items:center;
        gap:14px;
        margin-bottom:14px;
    }

    .service-top i{
        color: var(--orange-dark);
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

    .service-select:focus{
        border-color:#ffb169;
        box-shadow:0 0 0 4px rgba(255, 106, 0, 0.08);
    }

    .divider{
        height:1px;
        background:#eef2f7;
        margin:34px 0 28px;
    }

    .sub-head{
        font-size:26px;
        font-weight:800;
        color:var(--primary);
        margin-bottom:24px;
    }

    .details-grid{
        display:grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap:28px;
    }

    .group-title{
        font-size:15px;
        font-weight:800;
        color:#475467;
        margin-bottom:14px;
    }

    .option-stack{
        display:grid;
        gap:12px;
    }

    .radio-card,
    .check-card{
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

    .radio-card:hover,
    .check-card:hover{
        border-color:#ffbc84;
        background:#fffaf5;
    }

    .radio-card input,
    .check-card input{
        accent-color: var(--orange);
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

    .toggle-row .label{
        font-weight:800;
        color:#2d3748;
    }

    .switch{
        position:relative;
        width:58px;
        height:32px;
        flex-shrink:0;
    }

    .switch input{
        display:none;
    }

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
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap:20px;
    }

    .upload-box{
        position:relative;
    }

    .upload-box input[type="file"]{
        display:none;
    }

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

    .upload-label:hover{
        border-color:#ffb27a;
        background:#fffaf6;
    }

    .upload-label.active{
        border-color:#ff9d57;
        background:#fff7f1;
    }

    .upload-label i{
        font-size:34px;
        color:#98a2b3;
    }

    .upload-label h4{
        margin:0;
        color:#27364d;
        font-size:18px;
        font-weight:800;
    }

    .upload-label p{
        margin:0;
        font-size:15px;
        color:#94a3b8;
        font-weight:600;
    }

    .file-name{
        margin-top:10px;
        font-size:13px;
        color:#f25c05;
        font-weight:700;
        text-align:center;
        word-break:break-word;
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
        transition:.25s ease;
    }

    .btn-submit:hover{
        transform:translateY(-2px);
        box-shadow:0 20px 32px rgba(255, 106, 0, 0.28);
    }

    @media (max-width: 1100px){
        .service-grid,
        .details-grid,
        .upload-grid{
            grid-template-columns:1fr;
        }

        .btn-submit{
            min-width:100%;
        }
    }

    @media (max-width: 768px){
        .form-section-card{
            padding:22px;
            border-radius:22px;
        }

        .section-head h2{
            font-size:28px;
        }

        .section-head p{
            font-size:16px;
        }

        .footer-actions{
            flex-direction:column;
            align-items:stretch;
        }
    }
</style>

<div class="testing-wrap">
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Testing Services --}}
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
                        <option>Soil Bearing Capacity Test</option>
                        <option>Soil Classification Test</option>
                        <option>Field Density Test</option>
                    </select>
                </div>

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-cube"></i>
                        <div class="service-title">Concrete Testing Reports</div>
                    </div>
                    <select class="service-select" name="services[concrete_testing_reports]">
                        <option value="">Select service type</option>
                        <option>Cube Compressive Strength</option>
                        <option>Core Cutting Test</option>
                        <option>Slump Test</option>
                    </select>
                </div>

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-layer-group"></i>
                        <div class="service-title">Aggregate Testing</div>
                    </div>
                    <select class="service-select" name="services[aggregate_testing]">
                        <option value="">Select service type</option>
                        <option>Sieve Analysis</option>
                        <option>Impact Test</option>
                        <option>Crushing Value Test</option>
                    </select>
                </div>

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-water"></i>
                        <div class="service-title">Sand Testing</div>
                    </div>
                    <select class="service-select" name="services[sand_testing]">
                        <option value="">Select service type</option>
                        <option>Silt Content Test</option>
                        <option>Fineness Modulus</option>
                        <option>Bulking of Sand</option>
                    </select>
                </div>

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-building"></i>
                        <div class="service-title">Brick / Block Testing</div>
                    </div>
                    <select class="service-select" name="services[brick_block_testing]">
                        <option value="">Select service type</option>
                        <option>Compressive Strength</option>
                        <option>Water Absorption Test</option>
                        <option>Dimension Check</option>
                    </select>
                </div>

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-box-open"></i>
                        <div class="service-title">Cement Testing</div>
                    </div>
                    <select class="service-select" name="services[cement_testing]">
                        <option value="">Select service type</option>
                        <option>Consistency Test</option>
                        <option>Setting Time Test</option>
                        <option>Soundness Test</option>
                    </select>
                </div>

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-bars-progress"></i>
                        <div class="service-title">Steel Testing</div>
                    </div>
                    <select class="service-select" name="services[steel_testing]">
                        <option value="">Select service type</option>
                        <option>Tensile Strength Test</option>
                        <option>Bend / Re-bend Test</option>
                        <option>Elongation Test</option>
                    </select>
                </div>

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-droplet"></i>
                        <div class="service-title">Water Testing</div>
                    </div>
                    <select class="service-select" name="services[water_testing]">
                        <option value="">Select service type</option>
                        <option>pH Test</option>
                        <option>Chloride Test</option>
                        <option>Sulphate Test</option>
                    </select>
                </div>

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-temperature-half"></i>
                        <div class="service-title">Bitumen Testing</div>
                    </div>
                    <select class="service-select" name="services[bitumen_testing]">
                        <option value="">Select service type</option>
                        <option>Penetration Test</option>
                        <option>Softening Point Test</option>
                        <option>Ductility Test</option>
                    </select>
                </div>

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-road"></i>
                        <div class="service-title">Road / Pavement Testing</div>
                    </div>
                    <select class="service-select" name="services[road_pavement_testing]">
                        <option value="">Select service type</option>
                        <option>CBR Test</option>
                        <option>Compaction Test</option>
                        <option>Road Core Test</option>
                    </select>
                </div>

                <div class="service-card">
                    <div class="service-top">
                        <i class="fa-solid fa-expand"></i>
                        <div class="service-title">NDT Testing</div>
                    </div>
                    <select class="service-select" name="services[ndt_testing]">
                        <option value="">Select service type</option>
                        <option>Rebound Hammer Test</option>
                        <option>UPV Test</option>
                        <option>Half Cell Potential</option>
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
                            <input type="radio" name="lab_type" value="in_house">
                            <span>In-house Laboratory</span>
                        </label>

                        <label class="radio-card">
                            <input type="radio" name="lab_type" value="third_party">
                            <span>Third-Party Laboratory</span>
                        </label>
                    </div>

                    <div style="height:20px;"></div>

                    <div class="group-title">Service Mode</div>
                    <div class="option-stack">
                        <label class="check-card">
                            <input type="checkbox" name="service_mode[]" value="field_testing">
                            <span>Field Testing</span>
                        </label>

                        <label class="check-card">
                            <input type="checkbox" name="service_mode[]" value="lab_testing">
                            <span>Lab Testing</span>
                        </label>
                    </div>
                </div>

                <div>
                    <div class="group-title">Certification</div>
                    <div class="option-stack">
                        <label class="radio-card">
                            <input type="radio" name="certification" value="nabl_certified">
                            <span>NABL Certified Lab</span>
                        </label>

                        <label class="radio-card">
                            <input type="radio" name="certification" value="non_certified">
                            <span>Non-Certified Lab</span>
                        </label>
                    </div>

                    <div style="height:20px;"></div>

                    <div class="group-title">Sample Pickup Available?</div>
                    <div class="toggle-row">
                        <div class="label">Enable sample pickup service</div>
                        <label class="switch">
                            <input type="checkbox" name="sample_pickup_available" value="1">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- Upload Documents --}}
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
                    <label for="gst_certificate" class="upload-label active">
                        <i class="fa-regular fa-file-lines"></i>
                        <h4>GST Certificate</h4>
                        <p>Click to upload</p>
                    </label>
                    <div class="file-name" id="gst_certificate_name"></div>
                </div>

                <div class="upload-box">
                    <input type="file" id="aadhaar_card" name="aadhaar_card">
                    <label for="aadhaar_card" class="upload-label">
                        <i class="fa-regular fa-id-card"></i>
                        <h4>Aadhaar Card</h4>
                        <p>Click to upload</p>
                    </label>
                    <div class="file-name" id="aadhaar_card_name"></div>
                </div>

                <div class="upload-box">
                    <input type="file" id="company_profile" name="company_profile">
                    <label for="company_profile" class="upload-label">
                        <i class="fa-regular fa-building"></i>
                        <h4>Company Profile</h4>
                        <p>Click to upload</p>
                    </label>
                    <div class="file-name" id="company_profile_name"></div>
                </div>

                <div class="upload-box">
                    <input type="file" id="nabl_certificate" name="nabl_certificate">
                    <label for="nabl_certificate" class="upload-label">
                        <i class="fa-regular fa-award"></i>
                        <h4>NABL Certificate</h4>
                        <p>Click to upload</p>
                    </label>
                    <div class="file-name" id="nabl_certificate_name"></div>
                </div>

                <div class="upload-box">
                    <input type="file" id="lab_photos" name="lab_photos[]" multiple>
                    <label for="lab_photos" class="upload-label">
                        <i class="fa-regular fa-image"></i>
                        <h4>Lab Photos</h4>
                        <p>Click to upload</p>
                    </label>
                    <div class="file-name" id="lab_photos_name"></div>
                </div>

                <div class="upload-box">
                    <input type="file" id="accreditation_certificate" name="accreditation_certificate">
                    <label for="accreditation_certificate" class="upload-label">
                        <i class="fa-regular fa-circle-check"></i>
                        <h4>Accreditation Certificate</h4>
                        <p>Click to upload</p>
                    </label>
                    <div class="file-name" id="accreditation_certificate_name"></div>
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
    const fileInputs = document.querySelectorAll('.upload-box input[type="file"]');

    fileInputs.forEach(input => {
        input.addEventListener('change', function () {
            const fileNameBox = document.getElementById(this.id + '_name');
            const label = this.closest('.upload-box').querySelector('.upload-label');

            if (this.files.length > 1) {
                fileNameBox.textContent = this.files.length + ' files selected';
                label.classList.add('active');
            } else if (this.files.length === 1) {
                fileNameBox.textContent = this.files[0].name;
                label.classList.add('active');
            } else {
                fileNameBox.textContent = '';
                label.classList.remove('active');
            }
        });
    });
</script>

@endsection