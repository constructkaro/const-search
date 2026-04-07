@extends('vendor.layouts.vapp')

@section('title', 'BOQ Form')
@section('page_title', 'BOQ / Estimation Form')

@section('content')

<style>
    :root {
        --ck-dark: #111827;
        --ck-dark-2: #1f2937;
        --ck-text: #374151;
        --ck-muted: #6b7280;
        --ck-border: #e5e7eb;
        --ck-soft: #f8fafc;
        --ck-white: #ffffff;
        --ck-primary: #f59e0b;
        --ck-primary-dark: #ea580c;
        --ck-primary-soft: #fff7ed;
        --ck-success-bg: #ecfdf3;
        --ck-success-text: #027a48;
        --ck-success-border: #abefc6;
        --ck-danger: #dc2626;
        --ck-shadow: 0 12px 35px rgba(15, 23, 42, 0.08);
        --ck-shadow-hover: 0 18px 40px rgba(15, 23, 42, 0.12);
    }

    .boq-page {
        display: flex;
        flex-direction: column;
        gap: 24px;
        padding: 8px 0 24px;
    }

    .boq-hero {
        position: relative;
        overflow: hidden;
        border-radius: 28px;
        padding: 28px 30px;
        background:
            radial-gradient(circle at top right, rgba(245, 158, 11, 0.18), transparent 26%),
            linear-gradient(135deg, #fff8ef 0%, #ffffff 45%, #fffdf9 100%);
        border: 1px solid #fde7c3;
        box-shadow: var(--ck-shadow);
    }

    .boq-hero::before {
        content: "";
        position: absolute;
        right: -60px;
        top: -60px;
        width: 180px;
        height: 180px;
        background: rgba(245, 158, 11, 0.08);
        border-radius: 50%;
    }

    .boq-hero-content {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
    }

    .boq-hero-left {
        display: flex;
        align-items: flex-start;
        gap: 16px;
    }

    .boq-hero-icon {
        width: 64px;
        height: 64px;
        border-radius: 18px;
        background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        box-shadow: 0 12px 24px rgba(245, 158, 11, 0.28);
        flex-shrink: 0;
    }

    .boq-hero-text h1 {
        margin: 0 0 8px;
        font-size: 28px;
        line-height: 1.15;
        font-weight: 800;
        color: var(--ck-dark);
    }

    .boq-hero-text p {
        margin: 0;
        font-size: 15px;
        color: var(--ck-muted);
        max-width: 680px;
    }

    .boq-progress {
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(255,255,255,0.8);
        border: 1px solid #fde7c3;
        border-radius: 999px;
        padding: 10px 14px;
        backdrop-filter: blur(6px);
    }

    .boq-progress span {
        font-size: 13px;
        font-weight: 700;
        color: var(--ck-dark);
        white-space: nowrap;
    }

    .boq-progress-bar {
        width: 110px;
        height: 8px;
        background: #f3f4f6;
        border-radius: 999px;
        overflow: hidden;
    }

    .boq-progress-fill {
        width: 75%;
        height: 100%;
        background: linear-gradient(90deg, #f59e0b 0%, #ea580c 100%);
        border-radius: 999px;
    }

    .boq-card {
        background: var(--ck-white);
        border-radius: 26px;
        padding: 30px;
        box-shadow: var(--ck-shadow);
        border: 1px solid #edf2f7;
        position: relative;
        overflow: hidden;
    }

    .boq-card::after {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, #f59e0b, #ea580c);
        opacity: 0.9;
    }

    .boq-card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 26px;
    }

    .boq-title-wrap {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .boq-icon {
        width: 58px;
        height: 58px;
        border-radius: 18px;
        background: linear-gradient(135deg, #fff3e8 0%, #ffe4cc 100%);
        color: var(--ck-primary-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        flex-shrink: 0;
        border: 1px solid #fde7c3;
    }

    .boq-title h2 {
        font-size: 22px;
        line-height: 1.2;
        color: var(--ck-dark);
        margin: 0 0 6px;
        font-weight: 800;
    }

    .boq-title p {
        margin: 0;
        color: var(--ck-muted);
        font-size: 15px;
    }

    .step-tag {
        background: var(--ck-primary-soft);
        color: var(--ck-primary-dark);
        font-size: 13px;
        font-weight: 800;
        padding: 10px 14px;
        border-radius: 999px;
        white-space: nowrap;
        border: 1px solid #fde7c3;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.8);
    }

    .field-block + .field-block {
        margin-top: 28px;
    }

    .field-label {
        font-size: 16px;
        font-weight: 800;
        color: var(--ck-dark-2);
        margin-bottom: 14px;
    }

    .field-subtext {
        font-size: 13px;
        color: var(--ck-muted);
        margin-bottom: 14px;
    }

    .project-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 6px;
    }

    .project-item input {
        display: none;
    }

    .project-item label {
        min-height: 74px;
        border: 1px solid var(--ck-border);
        border-radius: 20px;
        padding: 14px 18px;
        display: flex;
        align-items: center;
        gap: 14px;
        cursor: pointer;
        transition: all 0.25s ease;
        background: linear-gradient(180deg, #ffffff 0%, #fcfcfd 100%);
        font-size: 15px;
        font-weight: 700;
        color: #4b5563;
        position: relative;
    }

    .project-item label::before {
        content: "";
        width: 22px;
        height: 22px;
        border: 2px solid #cbd5e1;
        border-radius: 8px;
        flex-shrink: 0;
        transition: all 0.25s ease;
        background: #fff;
    }

    .project-item label:hover {
        border-color: #f59e0b;
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(245, 158, 11, 0.10);
    }

    .project-item input:checked + label {
        border-color: #f59e0b;
        background: linear-gradient(180deg, #fffaf2 0%, #fff4e8 100%);
        color: #111827;
        box-shadow: 0 14px 28px rgba(245, 158, 11, 0.16);
    }

    .project-item input:checked + label::before {
        background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
        border-color: #f59e0b;
        box-shadow: inset 0 0 0 4px #fff;
    }

    .turnaround-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .turnaround-item input {
        display: none;
    }

    .turnaround-item label {
        min-width: 120px;
        height: 52px;
        border: 1px solid var(--ck-border);
        border-radius: 999px;
        padding: 0 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        cursor: pointer;
        font-weight: 700;
        color: #4b5563;
        transition: all 0.25s ease;
    }

    .turnaround-item label:hover {
        border-color: #f59e0b;
        box-shadow: 0 8px 18px rgba(245, 158, 11, 0.10);
        transform: translateY(-1px);
    }

    .turnaround-item input:checked + label {
        background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
        border-color: transparent;
        color: #fff;
        box-shadow: 0 12px 20px rgba(245, 158, 11, 0.20);
    }

    .upload-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .upload-col .top-label {
        display: block;
        font-size: 15px;
        font-weight: 800;
        color: var(--ck-dark-2);
        margin-bottom: 10px;
    }

    .upload-box {
        border: 1.5px dashed #d7dee8;
        border-radius: 22px;
        min-height: 215px;
        background: linear-gradient(180deg, #fcfdff 0%, #f8fafc 100%);
        padding: 22px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.25s ease;
        position: relative;
    }

    .upload-box:hover {
        border-color: #f59e0b;
        background: linear-gradient(180deg, #fffdf9 0%, #fff7ed 100%);
        transform: translateY(-2px);
        box-shadow: 0 14px 28px rgba(245, 158, 11, 0.10);
    }

    .upload-icon {
        width: 62px;
        height: 62px;
        border-radius: 18px;
        background: linear-gradient(135deg, #fff3e8 0%, #ffe9d5 100%);
        color: #ea580c;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        border: 1px solid #fde7c3;
    }

    .upload-box h4 {
        margin: 0;
        font-size: 17px;
        color: var(--ck-dark);
        font-weight: 800;
    }

    .upload-box p {
        margin: 0;
        font-size: 13px;
        color: var(--ck-muted);
        line-height: 1.5;
    }

    .upload-box input[type="file"] {
        width: 100%;
        margin-top: 10px;
        font-size: 13px;
        border: 1px solid #e5e7eb;
        background: #fff;
        border-radius: 12px;
        padding: 10px 12px;
    }

    .file-note {
        margin-top: 6px;
        font-size: 13px;
        color: var(--ck-primary-dark);
        font-weight: 700;
        word-break: break-word;
    }

    .form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-top: 28px;
        padding-top: 22px;
        border-top: 1px solid #eef2f7;
        flex-wrap: wrap;
    }

    .form-footer-note {
        font-size: 13px;
        color: var(--ck-muted);
    }

    .save-btn {
        min-width: 210px;
        height: 56px;
        border: none;
        border-radius: 18px;
        background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
        color: #fff;
        font-size: 16px;
        font-weight: 800;
        cursor: pointer;
        box-shadow: 0 14px 26px rgba(245, 158, 11, 0.22);
        transition: all 0.25s ease;
        letter-spacing: 0.2px;
    }

    .save-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 30px rgba(245, 158, 11, 0.28);
    }

    .alert-success {
        background: var(--ck-success-bg);
        color: var(--ck-success-text);
        padding: 14px 16px;
        border-radius: 16px;
        margin-bottom: 4px;
        border: 1px solid var(--ck-success-border);
        font-weight: 700;
    }

    .text-danger {
        color: var(--ck-danger);
        font-size: 13px;
        margin-top: 8px;
        display: block;
        font-weight: 600;
    }

    @media (max-width: 1100px) {
        .project-grid,
        .upload-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .boq-hero,
        .boq-card {
            padding: 22px;
            border-radius: 22px;
        }

        .boq-hero-text h1 {
            font-size: 22px;
        }

        .boq-card-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .project-grid,
        .upload-grid {
            grid-template-columns: 1fr;
        }

        .form-footer {
            justify-content: stretch;
        }

        .save-btn {
            width: 100%;
        }

        .boq-progress {
            width: 100%;
            justify-content: space-between;
        }
    }
</style>

<div class="boq-page">

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="boq-hero">
        <div class="boq-hero-content">
            <div class="boq-hero-left">
                <div class="boq-hero-icon">
                    <i class="fa-solid fa-calculator"></i>
                </div>
                <div class="boq-hero-text">
                    <h1>BOQ / Estimation Partner Form</h1>
                    <p>
                        Complete your professional profile and upload your documents for verification.
                        A strong profile helps you get more relevant BOQ and estimation leads.
                    </p>
                </div>
            </div>

            <div class="boq-progress">
                <span>Profile Progress</span>
                <div class="boq-progress-bar">
                    <div class="boq-progress-fill"></div>
                </div>
                <span>75%</span>
            </div>
        </div>
    </div>

    <form action="{{ route('vendor.boq.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="boq-card">
            <div class="boq-card-header">
                <div class="boq-title-wrap">
                    <div class="boq-icon">
                        <i class="fa-regular fa-clipboard"></i>
                    </div>
                    <div class="boq-title">
                        <h2>Professional Details</h2>
                        <p>Your project expertise and estimated turnaround timeline</p>
                    </div>
                </div>
                
            </div>

            <div class="field-block">
                <div class="field-label">Project Types Handled</div>
                <div class="field-subtext">Select all project categories you can handle professionally.</div>

                @php
                    $projectTypes = ['Residential', 'Commercial', 'Industrial', 'Infrastructure', 'Interior', 'Renovation'];
                    $oldProjectTypes = old('project_types_handled', []);
                @endphp

                <div class="project-grid">
                    @foreach($projectTypes as $type)
                        <div class="project-item">
                            <input
                                type="checkbox"
                                id="project_{{ $loop->index }}"
                                name="project_types_handled[]"
                                value="{{ $type }}"
                                {{ in_array($type, $oldProjectTypes) ? 'checked' : '' }}
                            >
                            <label for="project_{{ $loop->index }}">{{ $type }}</label>
                        </div>
                    @endforeach
                </div>

                @error('project_types_handled')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="field-block">
                <div class="field-label">BOQ Turnaround Time</div>
                <div class="field-subtext">Choose your usual delivery timeline for BOQ / estimation work.</div>

                @php
                    $turnaroundTimes = ['2 Days', '3 Days', '5 Days', '7 Days', '10 Days', '10+ Days'];
                @endphp

                <div class="turnaround-grid">
                    @foreach($turnaroundTimes as $time)
                        <div class="turnaround-item">
                            <input
                                type="radio"
                                id="time_{{ $loop->index }}"
                                name="boq_turnaround_time"
                                value="{{ $time }}"
                                {{ old('boq_turnaround_time') == $time ? 'checked' : '' }}
                            >
                            <label for="time_{{ $loop->index }}">{{ $time }}</label>
                        </div>
                    @endforeach
                </div>

                @error('boq_turnaround_time')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="boq-card">
            <div class="boq-card-header">
                <div class="boq-title-wrap">
                    <div class="boq-icon">
                        <i class="fa-regular fa-file-arrow-up"></i>
                    </div>
                    <div class="boq-title">
                        <h2>Upload Documents</h2>
                        <p>Upload your business and identity documents for verification</p>
                    </div>
                </div>
                
            </div>

            <div class="upload-grid">
                <div class="upload-col">
                    <label class="top-label">GST Certificate</label>
                    <div class="upload-box">
                        <div class="upload-icon">
                            <i class="fa-solid fa-file-invoice"></i>
                        </div>
                        <h4>Upload GST Document</h4>
                        <p>Accepted: PDF, JPG, PNG<br>Maximum file size: 5MB</p>
                        <input type="file" name="gst_certificate" id="gst_certificate">
                        <div class="file-note" id="gst_certificate_name"></div>
                    </div>
                    @error('gst_certificate')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="upload-col">
                    <label class="top-label">Aadhar Card</label>
                    <div class="upload-box">
                        <div class="upload-icon">
                            <i class="fa-solid fa-id-card"></i>
                        </div>
                        <h4>Upload Aadhar Card</h4>
                        <p>Accepted: PDF, JPG, PNG<br>Maximum file size: 5MB</p>
                        <input type="file" name="aadhar_card" id="aadhar_card">
                        <div class="file-note" id="aadhar_card_name"></div>
                    </div>
                    @error('aadhar_card')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="upload-col">
                    <label class="top-label">Company Profile</label>
                    <div class="upload-box">
                        <div class="upload-icon">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <h4>Upload Company Profile</h4>
                        <p>Accepted: PDF preferred<br>Maximum file size: 10MB</p>
                        <input type="file" name="company_profile" id="company_profile">
                        <div class="file-note" id="company_profile_name"></div>
                    </div>
                    @error('company_profile')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-footer">
                <div class="form-footer-note">
                    Please check all details before continuing to the next step.
                </div>
                <button type="submit" class="save-btn">Save & Continue</button>
            </div>
        </div>
    </form>
</div>

<script>
    function bindFileNamePreview(inputId, outputId) {
        const input = document.getElementById(inputId);
        const output = document.getElementById(outputId);

        if (!input || !output) return;

        input.addEventListener('change', function () {
            if (this.files && this.files.length > 0) {
                output.textContent = this.files[0].name;
            } else {
                output.textContent = '';
            }
        });
    }

    bindFileNamePreview('gst_certificate', 'gst_certificate_name');
    bindFileNamePreview('aadhar_card', 'aadhar_card_name');
    bindFileNamePreview('company_profile', 'company_profile_name');
</script>

@endsection