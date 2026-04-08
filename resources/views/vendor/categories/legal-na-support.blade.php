@extends('vendor.layouts.vapp')

@section('title', 'NA Support + Legal Due Diligence Provider Form')
@section('page_title', 'NA Support + Legal Due Diligence Provider Form')

@section('content')

<style>
    :root{
        --bg: #f4f7fb;
        --white: #ffffff;
        --text: #1c3558;
        --text-soft: #71829a;
        --muted: #97a4b5;
        --line: #e3eaf2;
        --line-dark: #d4dde9;
        --primary: #ea7b2f;
        --primary-soft: #fff5ed;
        --navy: #1d355a;
        --navy-soft: #eef3fb;
        --green: #43b96f;
        --green-soft: #eefaf2;
        --red: #ef5e7c;
        --red-soft: #fff3f6;
        --shadow-sm: 0 8px 24px rgba(15, 23, 42, 0.04);
        --shadow-md: 0 16px 38px rgba(15, 23, 42, 0.06);
        --shadow-lg: 0 18px 38px rgba(234, 123, 47, 0.18);
        --radius-xl: 26px;
        --radius-lg: 18px;
        --radius-md: 14px;
    }

    *{
        box-sizing: border-box;
    }

    body{
        background:
            radial-gradient(circle at top right, rgba(234,123,47,0.05), transparent 16%),
            linear-gradient(180deg, #f7f9fc 0%, #eef3f8 100%);
    }

    .provider-page{
        max-width: 1160px;
        margin: 0 auto;
        padding: 18px 0 34px;
    }

    .provider-stack{
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .form-card{
        background: linear-gradient(180deg, #ffffff 0%, #fcfdff 100%);
        border: 1px solid var(--line);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-md);
        padding: 24px 24px 28px;
        position: relative;
        overflow: hidden;
    }

    .form-card::before{
        content: "";
        position: absolute;
        right: -60px;
        top: -60px;
        width: 180px;
        height: 180px;
        background: radial-gradient(circle, rgba(234,123,47,0.05) 0%, transparent 70%);
        pointer-events: none;
    }

    .section-head{
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 22px;
    }

    .section-icon{
        width: 52px;
        height: 52px;
        border-radius: 16px;
        background: linear-gradient(135deg, #fff4eb 0%, #ffe8d8 100%);
        border: 1px solid #ffd7bf;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        box-shadow: 0 10px 20px rgba(234,123,47,0.08);
        flex-shrink: 0;
    }

    .section-title-wrap h2{
        margin: 0;
        font-size: 24px;
        color: var(--navy);
        font-weight: 900;
        line-height: 1.2;
    }

    .section-title-wrap p{
        margin: 5px 0 0;
        color: var(--text-soft);
        font-size: 14px;
        font-weight: 500;
    }

    .field-block + .field-block{
        margin-top: 24px;
    }

    .field-title{
        margin: 0 0 14px;
        font-size: 17px;
        color: var(--navy);
        font-weight: 800;
    }

    .check-grid{
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
    }

    .check-item input{
        display: none;
    }

    .check-item label{
        min-height: 58px;
        border: 1.5px solid var(--line-dark);
        border-radius: 15px;
        background: linear-gradient(180deg, #ffffff 0%, #fcfdff 100%);
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 0 18px;
        cursor: pointer;
        transition: all .22s ease;
        font-size: 16px;
        color: #24354e;
        font-weight: 600;
        position: relative;
        overflow: hidden;
    }

    .check-item label::before{
        content: "";
        width: 22px;
        height: 22px;
        border-radius: 7px;
        border: 2px solid #b8c7da;
        background: #fff;
        flex-shrink: 0;
        transition: all .22s ease;
    }

    .check-item label:hover{
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
        border-color: #c6d3e4;
    }

    .check-item input:checked + label{
        border-color: var(--primary);
        background: linear-gradient(180deg, #fffaf6 0%, #fff2e9 100%);
        box-shadow: 0 10px 22px rgba(234,123,47,0.08);
    }

    .check-item input:checked + label::before{
        background: linear-gradient(135deg, #ea7b2f 0%, #f09a57 100%);
        border-color: var(--primary);
        box-shadow: inset 0 0 0 4px #fff;
    }

    .info-panel{
        border: 1px solid var(--line);
        background: linear-gradient(180deg, #ffffff 0%, #fbfcfe 100%);
        border-radius: 18px;
        padding: 18px;
    }

    .toggle-row{
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: center;
        gap: 18px;
        padding: 12px 0;
        border-bottom: 1px solid #edf2f7;
    }

    .toggle-row:last-child{
        border-bottom: none;
    }

    .toggle-question{
        color: var(--navy);
        font-size: 16px;
        font-weight: 600;
    }

    .toggle-options{
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .toggle-pill input{
        display: none;
    }

    .toggle-pill label{
        min-width: 110px;
        height: 50px;
        padding: 0 20px;
        border-radius: 999px;
        border: 1.5px solid var(--line-dark);
        background: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        cursor: pointer;
        font-size: 15px;
        font-weight: 800;
        color: #2d3a4f;
        transition: all .22s ease;
    }

    .toggle-pill.yes input:checked + label{
        background: var(--green-soft);
        border-color: #bfe7cb;
        color: #257243;
        box-shadow: 0 10px 20px rgba(67,185,111,0.08);
    }

    .toggle-pill.no input:checked + label{
        background: var(--red-soft);
        border-color: #f4c4d1;
        color: #b94863;
        box-shadow: 0 10px 20px rgba(239,94,124,0.08);
    }

    .toggle-pill .icon-yes{
        color: var(--green);
        font-size: 18px;
    }

    .toggle-pill .icon-no{
        color: var(--red);
        font-size: 18px;
    }

    .select-wrap{
        max-width: 420px;
    }

    .form-select{
        width: 100%;
        height: 58px;
        border: 1.5px solid var(--line-dark);
        border-radius: 15px;
        background: #fff;
        padding: 0 18px;
        color: #213552;
        font-size: 16px;
        font-weight: 500;
        outline: none;
        transition: all .22s ease;
    }

    .form-select:focus{
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(234,123,47,0.08);
    }

    .upload-grid{
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px 20px;
    }

    .upload-item input[type="file"]{
        display: none;
    }

    .upload-title{
        margin: 0 0 10px;
        font-size: 16px;
        color: var(--navy);
        font-weight: 800;
    }

    .upload-box{
        min-height: 164px;
        border: 2px dashed #bfd0e4;
        border-radius: 18px;
        background: linear-gradient(180deg, #ffffff 0%, #fbfcfe 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 9px;
        text-align: center;
        padding: 18px;
        cursor: pointer;
        transition: all .22s ease;
        position: relative;
        overflow: hidden;
    }

    .upload-box::after{
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(234,123,47,0.05), transparent 55%);
        opacity: 0;
        transition: .22s ease;
    }

    .upload-box:hover{
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
        border-color: #a9c0de;
    }

    .upload-box:hover::after{
        opacity: 1;
    }

    .upload-box.active-orange{
        border-color: var(--primary);
        background: linear-gradient(180deg, #fffaf6 0%, #fff2e9 100%);
        box-shadow: 0 10px 22px rgba(234,123,47,0.08);
    }

    .upload-icon-wrap{
        width: 58px;
        height: 58px;
        border-radius: 18px;
        background: #f4f7fb;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 2;
    }

    .upload-box.active-orange .upload-icon-wrap{
        background: #ffe9da;
    }

    .upload-icon{
        font-size: 28px;
        color: #88a0c3;
        line-height: 1;
    }

    .upload-text{
        position: relative;
        z-index: 2;
        font-size: 16px;
        color: #6a84b3;
        font-weight: 500;
    }

    .upload-text span{
        color: var(--primary);
        font-weight: 800;
    }

    .upload-note{
        position: relative;
        z-index: 2;
        font-size: 13px;
        color: #97a5b7;
        font-weight: 700;
    }

    .file-name{
        margin-top: 10px;
        font-size: 13px;
        color: #16a34a;
        font-weight: 700;
        word-break: break-word;
        display: inline-block;
        text-decoration: none;
        cursor: pointer;
    }

    .file-name:hover{
        text-decoration: underline;
    }

    .submit-wrap{
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;
        padding-top: 4px;
    }

    .submit-btn{
        min-width: 360px;
        height: 74px;
        border: none;
        border-radius: 18px;
        background: linear-gradient(135deg, #ea7b2f 0%, #f0934d 100%);
        color: #fff;
        font-size: 21px;
        font-weight: 900;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
        box-shadow: var(--shadow-lg);
        transition: all .22s ease;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .submit-btn::before{
        content: "";
        position: absolute;
        top: 0;
        left: -120%;
        width: 50%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
        transition: .6s ease;
    }

    .submit-btn:hover{
        transform: translateY(-2px);
        box-shadow: 0 22px 42px rgba(234,123,47,0.24);
    }

    .submit-btn:hover::before{
        left: 130%;
    }

    .submit-note{
        text-align: center;
        font-size: 14px;
        color: #97a4b6;
        font-weight: 700;
    }

    .alert-success{
        background: #ecfdf3;
        color: #027a48;
        border: 1px solid #abefc6;
        padding: 12px 14px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 14px;
    }

    .alert-error{
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
        padding: 12px 14px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 14px;
    }

    .text-danger{
        color: #dc2626;
        font-size: 12px;
        margin-top: 8px;
        display: block;
        font-weight: 700;
    }

    .error-list{
        margin: 0;
        padding-left: 18px;
    }

    @media (max-width: 992px){
        .check-grid{
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .toggle-row{
            grid-template-columns: 1fr;
        }

        .upload-grid{
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px){
        .provider-page{
            padding: 12px 0 24px;
        }

        .form-card{
            padding: 18px 16px 22px;
            border-radius: 20px;
        }

        .section-title-wrap h2{
            font-size: 21px;
        }

        .check-grid{
            grid-template-columns: 1fr;
        }

        .submit-btn{
            min-width: 100%;
            width: 100%;
            height: 62px;
            font-size: 18px;
        }

        .toggle-options{
            width: 100%;
        }

        .toggle-pill label{
            min-width: 90px;
            height: 46px;
        }
    }
</style>

<div class="provider-page">
    <div class="provider-stack">

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('na_legal.store') }}" method="POST" enctype="multipart/form-data" id="naLegalForm">
            @csrf

            <div class="form-card">
                <div class="section-head">
                    <div class="section-icon">⚖️</div>
                    <div class="section-title-wrap">
                        <h2>Services & Expertise</h2>
                        <p>Select your legal and NA support capabilities</p>
                    </div>
                </div>

                @php
                    $services = [
                        'NA Conversion',
                        'Title Verification',
                        'Legal Scrutiny',
                        'Document Verification',
                        'Search Report',
                        'Encumbrance Review',
                        'Zoning Verification',
                        'Litigation Check',
                        'Transaction Support',
                    ];

                    $propertyTypes = [
                        'Residential',
                        'Commercial',
                        'Industrial',
                        'Agricultural Land',
                        'NA Land',
                        'Layout / Land Dev',
                        'Redevelopment',
                        'Mixed-Use',
                    ];

                    $oldServices = old('services_offered', []);
                    $oldPropertyTypes = old('property_types_handled', []);
                @endphp

                <div class="field-block">
                    <h3 class="field-title">Which services do you offer? *</h3>
                    <div class="check-grid">
                        @foreach($services as $index => $service)
                            <div class="check-item">
                                <input
                                    type="checkbox"
                                    id="service_{{ $index }}"
                                    name="services_offered[]"
                                    value="{{ $service }}"
                                    {{ in_array($service, $oldServices) ? 'checked' : '' }}
                                >
                                <label for="service_{{ $index }}">{{ $service }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('services_offered')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field-block">
                    <h3 class="field-title">Property Types Handled *</h3>
                    <div class="check-grid">
                        @foreach($propertyTypes as $index => $type)
                            <div class="check-item">
                                <input
                                    type="checkbox"
                                    id="property_{{ $index }}"
                                    name="property_types_handled[]"
                                    value="{{ $type }}"
                                    {{ in_array($type, $oldPropertyTypes) ? 'checked' : '' }}
                                >
                                <label for="property_{{ $index }}">{{ $type }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('property_types_handled')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field-block">
                    <h3 class="field-title">Additional Information</h3>

                    <div class="info-panel">
                        <div class="toggle-row">
                            <div class="toggle-question">Do you handle complete NA process end-to-end?</div>
                            <div class="toggle-options">
                                <div class="toggle-pill yes">
                                    <input type="radio" id="na_process_yes" name="complete_na_process" value="Yes" {{ old('complete_na_process') == 'Yes' ? 'checked' : '' }}>
                                    <label for="na_process_yes"><span class="icon-yes">✅</span> Yes</label>
                                </div>
                                <div class="toggle-pill no">
                                    <input type="radio" id="na_process_no" name="complete_na_process" value="No" {{ old('complete_na_process') == 'No' ? 'checked' : '' }}>
                                    <label for="na_process_no"><span class="icon-no">❌</span> No</label>
                                </div>
                            </div>
                        </div>

                        <div class="toggle-row">
                            <div class="toggle-question">Do you provide legal opinion reports?</div>
                            <div class="toggle-options">
                                <div class="toggle-pill yes">
                                    <input type="radio" id="legal_report_yes" name="legal_opinion_reports" value="Yes" {{ old('legal_opinion_reports') == 'Yes' ? 'checked' : '' }}>
                                    <label for="legal_report_yes"><span class="icon-yes">✅</span> Yes</label>
                                </div>
                                <div class="toggle-pill no">
                                    <input type="radio" id="legal_report_no" name="legal_opinion_reports" value="No" {{ old('legal_opinion_reports') == 'No' ? 'checked' : '' }}>
                                    <label for="legal_report_no"><span class="icon-no">❌</span> No</label>
                                </div>
                            </div>
                        </div>

                        <div class="toggle-row">
                            <div class="toggle-question">Do you coordinate with advocates?</div>
                            <div class="toggle-options">
                                <div class="toggle-pill yes">
                                    <input type="radio" id="advocate_yes" name="coordinate_with_advocates" value="Yes" {{ old('coordinate_with_advocates') == 'Yes' ? 'checked' : '' }}>
                                    <label for="advocate_yes"><span class="icon-yes">✅</span> Yes</label>
                                </div>
                                <div class="toggle-pill no">
                                    <input type="radio" id="advocate_no" name="coordinate_with_advocates" value="No" {{ old('coordinate_with_advocates') == 'No' ? 'checked' : '' }}>
                                    <label for="advocate_no"><span class="icon-no">❌</span> No</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field-block" style="margin-top:18px;">
                        <h3 class="field-title">Average Turnaround Time</h3>
                        <div class="select-wrap">
                            <select name="average_turnaround_time" class="form-select">
                                <option value="">Select</option>
                                <option value="1-3 Days" {{ old('average_turnaround_time') == '1-3 Days' ? 'selected' : '' }}>1-3 Days</option>
                                <option value="3-5 Days" {{ old('average_turnaround_time') == '3-5 Days' ? 'selected' : '' }}>3-5 Days</option>
                                <option value="5-7 Days" {{ old('average_turnaround_time') == '5-7 Days' ? 'selected' : '' }}>5-7 Days</option>
                                <option value="7-10 Days" {{ old('average_turnaround_time') == '7-10 Days' ? 'selected' : '' }}>7-10 Days</option>
                                <option value="10+ Days" {{ old('average_turnaround_time') == '10+ Days' ? 'selected' : '' }}>10+ Days</option>
                            </select>
                        </div>
                        @error('average_turnaround_time')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-card">
                <div class="section-head">
                    <div class="section-icon">📎</div>
                    <div class="section-title-wrap">
                        <h2>Documents</h2>
                        <p>Upload business and verification documents</p>
                    </div>
                </div>

                <div class="upload-grid">
                    <div class="upload-item" id="gst_wrap">
                        <h4 class="upload-title">GST Certificate</h4>
                        <label for="gst_certificate" class="upload-box active-orange">
                            <div class="upload-icon-wrap">
                                <div class="upload-icon">☁️</div>
                            </div>
                            <div class="upload-text">Drag & drop or <span>browse</span></div>
                            <div class="upload-note">PDF, JPG, PNG (Max 5MB)</div>
                        </label>
                        <input type="file" name="gst_certificate" id="gst_certificate" accept=".pdf,.jpg,.jpeg,.png">
                        <a href="#" class="file-name" id="gst_certificate_name" target="_blank" style="display:none;"></a>
                        @error('gst_certificate')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="upload-item" id="aadhar_wrap">
                        <h4 class="upload-title">Aadhar Card</h4>
                        <label for="aadhar_card" class="upload-box">
                            <div class="upload-icon-wrap">
                                <div class="upload-icon">☁️</div>
                            </div>
                            <div class="upload-text">Drag & drop or <span>browse</span></div>
                            <div class="upload-note">PDF, JPG, PNG (Max 5MB)</div>
                        </label>
                        <input type="file" name="aadhar_card" id="aadhar_card" accept=".pdf,.jpg,.jpeg,.png">
                        <a href="#" class="file-name" id="aadhar_card_name" target="_blank" style="display:none;"></a>
                        @error('aadhar_card')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="upload-item" id="company_wrap">
                        <h4 class="upload-title">Company Profile</h4>
                        <label for="company_profile" class="upload-box">
                            <div class="upload-icon-wrap">
                                <div class="upload-icon">☁️</div>
                            </div>
                            <div class="upload-text">Drag & drop or <span>browse</span></div>
                            <div class="upload-note">PDF, JPG, PNG (Max 5MB)</div>
                        </label>
                        <input type="file" name="company_profile" id="company_profile" accept=".pdf,.jpg,.jpeg,.png">
                        <a href="#" class="file-name" id="company_profile_name" target="_blank" style="display:none;"></a>
                        @error('company_profile')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="upload-item" id="license_wrap">
                        <h4 class="upload-title">Registration / License</h4>
                        <label for="registration_license" class="upload-box">
                            <div class="upload-icon-wrap">
                                <div class="upload-icon">☁️</div>
                            </div>
                            <div class="upload-text">Drag & drop or <span>browse</span></div>
                            <div class="upload-note">PDF, JPG, PNG (Max 5MB)</div>
                        </label>
                        <input type="file" name="registration_license" id="registration_license" accept=".pdf,.jpg,.jpeg,.png">
                        <a href="#" class="file-name" id="registration_license_name" target="_blank" style="display:none;"></a>
                        @error('registration_license')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="submit-wrap">
                <button type="submit" class="submit-btn">
                    <span>🛡️</span>
                    <span>Submit & Get Verified</span>
                </button>
                <div class="submit-note">Our team will review your profile and activate your account within 24–48 hours.</div>
            </div>
        </form>
    </div>
</div>

<script>
    function bindFilePreview(inputId, outputId, wrapperId, activeOrange = false) {
        const input = document.getElementById(inputId);
        const output = document.getElementById(outputId);
        const wrapper = document.getElementById(wrapperId);

        if (!input || !output || !wrapper) return;

        input.addEventListener('change', function () {
            const label = wrapper.querySelector('.upload-box');
            const file = this.files[0];

            if (file) {
                const fileUrl = URL.createObjectURL(file);

                output.textContent = file.name;
                output.href = fileUrl;
                output.style.display = 'inline-block';
                output.setAttribute('target', '_blank');

                if (!activeOrange && label) {
                    label.classList.add('active-orange');
                }
            } else {
                output.textContent = '';
                output.href = '#';
                output.style.display = 'none';

                if (!activeOrange && label) {
                    label.classList.remove('active-orange');
                }
            }
        });
    }

    bindFilePreview('gst_certificate', 'gst_certificate_name', 'gst_wrap', true);
    bindFilePreview('aadhar_card', 'aadhar_card_name', 'aadhar_wrap');
    bindFilePreview('company_profile', 'company_profile_name', 'company_wrap');
    bindFilePreview('registration_license', 'registration_license_name', 'license_wrap');

    document.getElementById('naLegalForm').addEventListener('submit', function (e) {
        const services = document.querySelectorAll("input[name='services_offered[]']:checked").length;
        const propertyTypes = document.querySelectorAll("input[name='property_types_handled[]']:checked").length;

        if (services === 0 || propertyTypes === 0) {
            e.preventDefault();
            alert('Please select at least one service and one property type.');
        }
    });
</script>
@endsection