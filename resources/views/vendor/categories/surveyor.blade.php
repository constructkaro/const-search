@extends('vendor.layouts.vapp')

@section('title', 'Survey Provider Form')
@section('page_title', 'Survey Services Provider Form')

@section('content')

<style>
    :root{
        --bg: #f4f7fb;
        --white: #ffffff;
        --text: #18263a;
        --text-soft: #6b7a90;
        --line: #e6edf5;
        --line-dark: #d7e0ea;
        --primary: #ff6a00;
        --primary-2: #ff8533;
        --primary-soft: #fff4ec;
        --green: #22c55e;
        --shadow-1: 0 10px 30px rgba(15, 23, 42, 0.05);
        --shadow-2: 0 18px 45px rgba(15, 23, 42, 0.08);
        --shadow-3: 0 22px 55px rgba(255, 106, 0, 0.14);
        --radius-xl: 30px;
        --radius-lg: 22px;
        --radius-md: 18px;
        --radius-sm: 14px;
    }

    body{
        background:
            radial-gradient(circle at top right, rgba(255,106,0,0.05), transparent 18%),
            linear-gradient(180deg, #f7f9fc 0%, #eef3f8 100%);
    }

    .survey-page{
        max-width: 1180px;
        margin: 0 auto;
        padding: 16px 0 36px;
    }

    .page-stack{
        display: flex;
        flex-direction: column;
        gap: 26px;
    }

    .top-banner{
        background: linear-gradient(135deg, #ffffff 0%, #fff8f3 100%);
        border: 1px solid #f4dfcf;
        border-radius: 28px;
        padding: 24px 28px;
        box-shadow: var(--shadow-1);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }

    .top-banner-left{
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .top-banner-icon{
        width: 62px;
        height: 62px;
        border-radius: 18px;
        background: linear-gradient(135deg, #ff6a00 0%, #ff8a3d 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        box-shadow: 0 14px 28px rgba(255,106,0,0.20);
        flex-shrink: 0;
    }

    .top-banner h1{
        margin: 0;
        font-size: 26px;
        line-height: 1.2;
        color: var(--text);
        font-weight: 900;
    }

    .top-banner p{
        margin: 6px 0 0;
        color: var(--text-soft);
        font-size: 14px;
        font-weight: 500;
    }

    .top-badge{
        background: rgba(255,255,255,0.9);
        border: 1px solid #f4dfcf;
        color: var(--primary);
        padding: 12px 16px;
        border-radius: 999px;
        font-weight: 800;
        font-size: 14px;
        box-shadow: 0 8px 18px rgba(255,106,0,0.06);
    }

    .form-card{
        background: linear-gradient(180deg, #ffffff 0%, #fcfdff 100%);
        border: 1px solid #e7edf4;
        border-radius: var(--radius-xl);
        padding: 30px;
        box-shadow: var(--shadow-2);
        position: relative;
        overflow: hidden;
    }

    .form-card::before{
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        width: 220px;
        height: 220px;
        background: radial-gradient(circle, rgba(255,106,0,0.05) 0%, transparent 70%);
        pointer-events: none;
    }

    .section-head{
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 22px;
        position: relative;
        z-index: 2;
    }

    .section-icon{
        width: 54px;
        height: 54px;
        border-radius: 16px;
        background: linear-gradient(135deg, #fff2e8 0%, #ffe5d2 100%);
        border: 1px solid #ffd7bd;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        flex-shrink: 0;
    }

    .section-text h2{
        margin: 0;
        color: var(--text);
        font-size: 22px;
        font-weight: 900;
    }

    .section-text p{
        margin: 5px 0 0;
        color: var(--text-soft);
        font-size: 14px;
        font-weight: 500;
    }

    .divider{
        border: none;
        border-top: 1px solid var(--line);
        margin: 0 0 24px;
    }

    .field-title{
        color: var(--text);
        font-size: 17px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .field-note{
        color: var(--text-soft);
        font-size: 14px;
        margin-bottom: 18px;
        font-weight: 500;
    }

    .survey-grid{
        display: grid;
        grid-template-columns: repeat(3, minmax(0,1fr));
        gap: 18px;
        margin-bottom: 34px;
    }

    .survey-option input{
        display: none;
    }

    .survey-option label{
        min-height: 148px;
        border: 1.5px solid #dbe3ec;
        border-radius: 22px;
        background: linear-gradient(180deg, #ffffff 0%, #fbfcfd 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 12px;
        text-align: center;
        padding: 20px 16px;
        cursor: pointer;
        transition: all 0.24s ease;
        position: relative;
        overflow: hidden;
    }

    .survey-option label::after{
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255,106,0,0.06), transparent 50%);
        opacity: 0;
        transition: 0.24s ease;
    }

    .survey-option label i{
        font-size: 34px;
        color: #7f8ca0;
        transition: 0.24s ease;
        position: relative;
        z-index: 2;
    }

    .survey-option label span{
        color: var(--text);
        font-size: 18px;
        font-weight: 800;
        line-height: 1.35;
        position: relative;
        z-index: 2;
    }

    .survey-option label:hover{
        transform: translateY(-4px);
        box-shadow: var(--shadow-1);
        border-color: #ced8e4;
    }

    .survey-option label:hover::after{
        opacity: 1;
    }

    .survey-option input:checked + label{
        border-color: var(--primary);
        background: linear-gradient(180deg, #fffaf6 0%, #fff0e6 100%);
        box-shadow: 0 18px 32px rgba(255,106,0,0.10);
    }

    .survey-option input:checked + label i{
        color: var(--primary);
        transform: scale(1.05);
    }

    .survey-option input:checked + label::before{
        content: "\f00c";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        top: 14px;
        right: 14px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-2) 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        box-shadow: 0 10px 18px rgba(255,106,0,0.20);
        z-index: 3;
    }

    .capabilities-card{
        background: linear-gradient(180deg, #ffffff 0%, #fbfcfe 100%);
        border: 1px solid #e8eef5;
        border-radius: 24px;
        overflow: hidden;
    }

    .capability-row{
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        padding: 22px 24px;
        border-bottom: 1px solid #edf2f7;
        transition: 0.22s ease;
    }

    .capability-row:last-child{
        border-bottom: none;
    }

    .capability-row:hover{
        background: #fcfdff;
    }

    .capability-left{
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .capability-icon{
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: #f5f8fc;
        border: 1px solid #e6edf5;
        color: #7b8aa0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .capability-left span{
        color: var(--text);
        font-size: 17px;
        font-weight: 600;
    }

    .switch{
        position: relative;
        width: 72px;
        height: 40px;
        flex-shrink: 0;
        display: inline-block;
    }

    .switch input{
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider{
        position: absolute;
        inset: 0;
        background: #cfd6df;
        border-radius: 999px;
        cursor: pointer;
        transition: 0.25s ease;
    }

    .slider:before{
        content: "";
        position: absolute;
        width: 30px;
        height: 30px;
        left: 5px;
        top: 5px;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        transition: 0.25s ease;
    }

    .switch input:checked + .slider{
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-2) 100%);
        box-shadow: 0 10px 22px rgba(255,106,0,0.18);
    }

    .switch input:checked + .slider:before{
        transform: translateX(32px);
    }

    .upload-grid{
        display: grid;
        grid-template-columns: repeat(3, minmax(0,1fr));
        gap: 18px;
    }

    .upload-item input[type="file"]{
        display: none;
    }

    .upload-box{
        min-height: 190px;
        border: 2px dashed #d7e0ea;
        border-radius: 24px;
        background: linear-gradient(180deg, #ffffff 0%, #fbfcfd 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 12px;
        text-align: center;
        padding: 22px;
        cursor: pointer;
        transition: all 0.24s ease;
        position: relative;
        overflow: hidden;
    }

    .upload-box::after{
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255,106,0,0.05), transparent 50%);
        opacity: 0;
        transition: 0.24s ease;
    }

    .upload-icon{
        width: 60px;
        height: 60px;
        border-radius: 18px;
        background: #f6f9fc;
        border: 1px solid #e6edf5;
        color: #7b8aa0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        position: relative;
        z-index: 2;
    }

    .upload-box h4{
        margin: 0;
        color: var(--text);
        font-size: 18px;
        font-weight: 800;
        line-height: 1.35;
        position: relative;
        z-index: 2;
    }

    .upload-box p{
        margin: 0;
        color: var(--text-soft);
        font-size: 14px;
        font-weight: 500;
        position: relative;
        z-index: 2;
    }

    .upload-box:hover{
        transform: translateY(-4px);
        border-color: #ffc79f;
        background: linear-gradient(180deg, #fffdfb 0%, #fff7f1 100%);
        box-shadow: var(--shadow-1);
    }

    .upload-box:hover::after{
        opacity: 1;
    }

    .upload-item.active .upload-box{
        border-color: var(--primary);
        background: linear-gradient(180deg, #fffaf6 0%, #fff1e8 100%);
        box-shadow: 0 18px 32px rgba(255,106,0,0.10);
    }

    .upload-item.active .upload-icon{
        background: linear-gradient(135deg, #fff0e4 0%, #ffe1cf 100%);
        border-color: #ffd0b3;
        color: var(--primary);
    }

    .file-name{
        margin-top: 10px;
        text-align: center;
        color: var(--primary);
        font-size: 13px;
        font-weight: 800;
        word-break: break-word;
    }

    .submit-wrap{
        margin-top: 2px;
    }

    .submit-btn{
        width: 100%;
        min-height: 86px;
        border: none;
        border-radius: 24px;
        background: linear-gradient(135deg, #ff5d00 0%, #ff7b20 100%);
        color: #fff;
        font-size: 22px;
        font-weight: 900;
        letter-spacing: 0.2px;
        box-shadow: var(--shadow-3);
        transition: all 0.25s ease;
        position: relative;
        overflow: hidden;
    }

    .submit-btn::before{
        content: "";
        position: absolute;
        top: 0;
        left: -120%;
        width: 50%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
        transition: 0.65s ease;
    }

    .submit-btn:hover{
        transform: translateY(-2px);
        box-shadow: 0 26px 44px rgba(255,106,0,0.28);
    }

    .submit-btn:hover::before{
        left: 130%;
    }

    .trust-row{
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 18px;
        flex-wrap: wrap;
        margin-top: 2px;
    }

    .trust-pill{
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 18px;
        border-radius: 999px;
        background: rgba(255,255,255,0.82);
        border: 1px solid #e6edf5;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.04);
        color: var(--text-soft);
        font-size: 15px;
        font-weight: 700;
    }

    .trust-pill i{
        color: var(--green);
        font-size: 17px;
    }

    .alert-success{
        background: #ecfdf3;
        color: #027a48;
        border: 1px solid #abefc6;
        padding: 14px 16px;
        border-radius: 16px;
        font-weight: 700;
        box-shadow: 0 10px 20px rgba(2,122,72,0.06);
    }

    .alert-error{
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
        padding: 14px 16px;
        border-radius: 16px;
        font-weight: 700;
        box-shadow: 0 10px 20px rgba(185,28,28,0.05);
    }

    .text-danger{
        color: #dc2626;
        font-size: 13px;
        margin-top: 8px;
        display: block;
        font-weight: 700;
    }

    @media (max-width: 1100px){
        .survey-grid,
        .upload-grid{
            grid-template-columns: repeat(2, minmax(0,1fr));
        }
    }

    @media (max-width: 768px){
        .survey-page{
            padding: 12px 0 26px;
        }

        .top-banner,
        .form-card{
            padding: 20px 16px;
            border-radius: 22px;
        }

        .top-banner h1{
            font-size: 22px;
        }

        .section-text h2{
            font-size: 20px;
        }

        .survey-grid,
        .upload-grid{
            grid-template-columns: 1fr;
        }

        .capability-row{
            padding: 18px 14px;
        }

        .capability-left span{
            font-size: 15px;
        }

        .submit-btn{
            min-height: 72px;
            border-radius: 20px;
            font-size: 19px;
        }

        .trust-row{
            justify-content: flex-start;
        }

        .trust-pill{
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="survey-page">
    <div class="page-stack">

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <div class="top-banner">
            <div class="top-banner-left">
                <div class="top-banner-icon">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
                <div>
                    <h1>Join as a Survey Services Partner</h1>
                    <p>Complete your professional details and upload verification documents to start receiving quality leads.</p>
                </div>
            </div>
            <div class="top-badge">Trusted ConstructKaro Partner Onboarding</div>
        </div>

        <form action="{{ route('survey.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-card">
                <div class="section-head">
                    <div class="section-icon">
                        <i class="fa-solid fa-crosshairs"></i>
                    </div>
                    <div class="section-text">
                        <h2>Professional Details</h2>
                        <p>Select your survey services and capabilities</p>
                    </div>
                </div>

                <hr class="divider">

                <div class="field-title">Type of Survey Offered</div>
                <div class="field-note">You can select multiple services</div>

                @php
                    $surveyTypes = [
                        ['name' => 'Land Demarcation', 'icon' => 'fa-solid fa-border-all'],
                        ['name' => 'Topographic Survey', 'icon' => 'fa-solid fa-mountain'],
                        ['name' => 'Layout Survey', 'icon' => 'fa-regular fa-window-restore'],
                        ['name' => 'Road Survey', 'icon' => 'fa-solid fa-road'],
                        ['name' => 'Drone Survey', 'icon' => 'fa-solid fa-helicopter'],
                        ['name' => 'Boundary Survey', 'icon' => 'fa-regular fa-square'],
                    ];
                    $oldSurveyTypes = old('survey_types', []);
                @endphp

                <div class="survey-grid">
                    @foreach($surveyTypes as $index => $type)
                        <div class="survey-option">
                            <input
                                type="checkbox"
                                id="survey_type_{{ $index }}"
                                name="survey_types[]"
                                value="{{ $type['name'] }}"
                                {{ in_array($type['name'], $oldSurveyTypes) ? 'checked' : '' }}
                            >
                            <label for="survey_type_{{ $index }}">
                                <i class="{{ $type['icon'] }}"></i>
                                <span>{{ $type['name'] }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>

                @error('survey_types')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="field-title" style="margin-bottom: 14px;">Capabilities</div>

                <div class="capabilities-card">
                    <div class="capability-row">
                        <div class="capability-left">
                            <div class="capability-icon"><i class="fa-solid fa-award"></i></div>
                            <span>Licensed / Certified Surveyor</span>
                        </div>
                        <label class="switch">
                            <input type="checkbox" name="licensed_certified" value="1" {{ old('licensed_certified') ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="capability-row">
                        <div class="capability-left">
                            <div class="capability-icon"><i class="fa-solid fa-stamp"></i></div>
                            <span>Can provide stamped drawings</span>
                        </div>
                        <label class="switch">
                            <input type="checkbox" name="stamped_drawings" value="1" {{ old('stamped_drawings') ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="capability-row">
                        <div class="capability-left">
                            <div class="capability-icon"><i class="fa-solid fa-file-lines"></i></div>
                            <span>Report format available</span>
                        </div>
                        <label class="switch">
                            <input type="checkbox" name="report_format_available" value="1" {{ old('report_format_available') ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="capability-row">
                        <div class="capability-left">
                            <div class="capability-icon"><i class="fa-solid fa-landmark"></i></div>
                            <span>Land record coordination support</span>
                        </div>
                        <label class="switch">
                            <input type="checkbox" name="land_record_support" value="1" {{ old('land_record_support') ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-card">
                <div class="section-head">
                    <div class="section-icon">
                        <i class="fa-regular fa-file-arrow-up"></i>
                    </div>
                    <div class="section-text">
                        <h2>Upload Documents</h2>
                        <p>Upload your verification documents and previous project photos</p>
                    </div>
                </div>

                <hr class="divider">

                <div class="upload-grid">
                    <div class="upload-item" id="gst_wrap">
                        <label for="gst_certificate" class="upload-box">
                            <div class="upload-icon"><i class="fa-regular fa-file-lines"></i></div>
                            <h4>GST Certificate</h4>
                            <p>Click to upload document</p>
                        </label>
                        <input type="file" name="gst_certificate" id="gst_certificate">
                        <div class="file-name" id="gst_certificate_name"></div>
                        @error('gst_certificate')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="upload-item" id="aadhar_wrap">
                        <label for="aadhar_card" class="upload-box">
                            <div class="upload-icon"><i class="fa-regular fa-credit-card"></i></div>
                            <h4>Aadhaar Card</h4>
                            <p>Click to upload document</p>
                        </label>
                        <input type="file" name="aadhar_card" id="aadhar_card">
                        <div class="file-name" id="aadhar_card_name"></div>
                        @error('aadhar_card')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="upload-item" id="company_wrap">
                        <label for="company_profile" class="upload-box">
                            <div class="upload-icon"><i class="fa-regular fa-building"></i></div>
                            <h4>Company Profile</h4>
                            <p>Click to upload document</p>
                        </label>
                        <input type="file" name="company_profile" id="company_profile">
                        <div class="file-name" id="company_profile_name"></div>
                        @error('company_profile')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="upload-item" id="license_wrap">
                        <label for="license_certificate" class="upload-box">
                            <div class="upload-icon"><i class="fa-solid fa-award"></i></div>
                            <h4>License / Certificate</h4>
                            <p>Click to upload document</p>
                        </label>
                        <input type="file" name="license_certificate" id="license_certificate">
                        <div class="file-name" id="license_certificate_name"></div>
                        @error('license_certificate')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="upload-item" id="project_wrap">
                        <label for="previous_project_photos" class="upload-box">
                            <div class="upload-icon"><i class="fa-regular fa-image"></i></div>
                            <h4>Previous Project Photos</h4>
                            <p>Click to upload multiple photos</p>
                        </label>
                        <input type="file" name="previous_project_photos[]" id="previous_project_photos" multiple>
                        <div class="file-name" id="previous_project_photos_name"></div>
                        @error('previous_project_photos')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="submit-wrap">
                <button type="submit" class="submit-btn">Register as Survey Partner</button>
            </div>

            <div class="trust-row">
                <div class="trust-pill">
                    <i class="fa-regular fa-circle-check"></i>
                    <span>Verified Leads</span>
                </div>
                <div class="trust-pill">
                    <i class="fa-solid fa-bolt"></i>
                    <span>Fast Project Allocation</span>
                </div>
                <div class="trust-pill">
                    <i class="fa-solid fa-rocket"></i>
                    <span>Easy Onboarding</span>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function bindFilePreview(inputId, outputId, wrapperId) {
        const input = document.getElementById(inputId);
        const output = document.getElementById(outputId);
        const wrapper = document.getElementById(wrapperId);

        if (!input || !output || !wrapper) return;

        input.addEventListener('change', function () {
            if (this.files && this.files.length > 0) {
                output.textContent = this.files.length === 1
                    ? this.files[0].name
                    : this.files.length + ' files selected';
                wrapper.classList.add('active');
            } else {
                output.textContent = '';
                wrapper.classList.remove('active');
            }
        });
    }

    bindFilePreview('gst_certificate', 'gst_certificate_name', 'gst_wrap');
    bindFilePreview('aadhar_card', 'aadhar_card_name', 'aadhar_wrap');
    bindFilePreview('company_profile', 'company_profile_name', 'company_wrap');
    bindFilePreview('license_certificate', 'license_certificate_name', 'license_wrap');
    bindFilePreview('previous_project_photos', 'previous_project_photos_name', 'project_wrap');
</script>

@endsection