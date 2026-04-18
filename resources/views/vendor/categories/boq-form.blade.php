@extends('vendor.layouts.app')

@section('title', 'BOQ Form')
@section('page_title', 'BOQ / Estimation Form')

@section('content')

<style>
    .form-wrapper {
        display: flex;
        flex-direction: column;
        gap: 28px;
    }

    .form-card {
        background: #fff;
        border-radius: 22px;
        padding: 28px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.05);
    }

    .form-card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 24px;
    }

    .form-card-title-wrap {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .form-icon-box {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: #fdf1e8;
        color: #f97316;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .form-card-title h2 {
        font-size: 22px;
        color: #1f2937;
        margin-bottom: 4px;
    }

    .form-card-title p {
        color: #98a2b3;
        font-size: 15px;
    }

    .step-badge {
        background: #fff2e8;
        color: #f97316;
        font-size: 14px;
        font-weight: 700;
        padding: 10px 14px;
        border-radius: 12px;
    }

    .section-label {
        font-size: 16px;
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 14px;
    }

    .checkbox-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-bottom: 26px;
    }

    .check-card {
        border: 1px solid #d8dee8;
        border-radius: 16px;
        min-height: 62px;
        display: flex;
        align-items: center;
        padding: 0 18px;
        gap: 12px;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .check-card:hover {
        border-color: #f5a623;
    }

    .check-card input {
        width: 20px;
        height: 20px;
    }

    .chip-grid {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .chip-option {
        position: relative;
    }

    .chip-option input {
        display: none;
    }

    .chip-option label {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 105px;
        height: 50px;
        border: 1px solid #d8dee8;
        border-radius: 999px;
        padding: 0 18px;
        font-weight: 500;
        color: #4b5563;
        cursor: pointer;
        transition: 0.2s ease;
        background: #fff;
    }

    .chip-option input:checked + label {
        background: #f5a623;
        border-color: #f5a623;
        color: #111633;
        font-weight: 700;
    }

    .upload-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .upload-group label.top-label {
        display: block;
        font-size: 16px;
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 10px;
    }

    .upload-box {
        border: 2px dashed #d8dee8;
        border-radius: 18px;
        min-height: 160px;
        padding: 20px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #fcfcfd;
    }

    .upload-box i {
        font-size: 34px;
        color: #98a2b3;
    }

    .upload-box p {
        margin: 0;
        color: #667085;
        font-weight: 600;
    }

    .upload-box small {
        color: #98a2b3;
    }

    .upload-box input[type="file"] {
        margin-top: 8px;
        width: 100%;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 24px;
    }

    .submit-btn {
        height: 54px;
        padding: 0 28px;
        border: none;
        border-radius: 14px;
        background: #f5a623;
        color: #111633;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
    }

    .alert-success {
        background: #ecfdf3;
        color: #027a48;
        padding: 14px 16px;
        border-radius: 12px;
        margin-bottom: 18px;
    }

    .text-danger {
        color: #dc2626;
        font-size: 13px;
        margin-top: 6px;
        display: block;
    }

    @media (max-width: 992px) {
        .checkbox-grid,
        .upload-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .checkbox-grid,
        .upload-grid {
            grid-template-columns: 1fr;
        }

        .form-card-header {
            flex-direction: column;
            gap: 14px;
        }
    }
</style>

<div class="form-wrapper">

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('vendor.boq.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title-wrap">
                    <div class="form-icon-box">
                        <i class="fa-regular fa-clipboard"></i>
                    </div>
                    <div class="form-card-title">
                        <h2>Professional Details</h2>
                        <p>Your expertise and turnaround capabilities</p>
                    </div>
                </div>
                <div class="step-badge">Step 3/4</div>
            </div>

            <div class="section-label">Project Types Handled</div>

            <div class="checkbox-grid">
                @php
                    $projectTypes = ['Residential', 'Commercial', 'Industrial', 'Infrastructure', 'Interior', 'Renovation'];
                    $oldProjectTypes = old('project_types', []);
                @endphp

                @foreach($projectTypes as $type)
                    <label class="check-card">
                        <input type="checkbox" name="project_types[]" value="{{ $type }}"
                            {{ in_array($type, $oldProjectTypes) ? 'checked' : '' }}>
                        <span>{{ $type }}</span>
                    </label>
                @endforeach
            </div>
            @error('project_types')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="section-label">BOQ Turnaround Time</div>

            <div class="chip-grid">
                @php
                    $turnaroundTimes = ['2 Days', '3 Days', '5 Days', '7 Days', '10 Days', '10+ Days'];
                @endphp

                @foreach($turnaroundTimes as $time)
                    <div class="chip-option">
                        <input type="radio" id="time_{{ $loop->index }}" name="boq_turnaround_time" value="{{ $time }}"
                            {{ old('boq_turnaround_time') == $time ? 'checked' : '' }}>
                        <label for="time_{{ $loop->index }}">{{ $time }}</label>
                    </div>
                @endforeach
            </div>
            @error('boq_turnaround_time')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title-wrap">
                    <div class="form-icon-box">
                        <i class="fa-regular fa-file-arrow-up"></i>
                    </div>
                    <div class="form-card-title">
                        <h2>Upload Documents</h2>
                        <p>Required for verification (PDF, JPG, PNG)</p>
                    </div>
                </div>
                <div class="step-badge">Step 4/4</div>
            </div>

            <div class="upload-grid">
                <div class="upload-group">
                    <label class="top-label">GST Certificate</label>
                    <div class="upload-box">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <p>Click to upload</p>
                        <small>PDF, JPG up to 5MB</small>
                        <input type="file" name="gst_certificate">
                    </div>
                    @error('gst_certificate')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="upload-group">
                    <label class="top-label">Aadhar Card</label>
                    <div class="upload-box">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <p>Click to upload</p>
                        <small>PDF, JPG up to 5MB</small>
                        <input type="file" name="aadhar_card">
                    </div>
                    @error('aadhar_card')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="upload-group">
                    <label class="top-label">Company Profile</label>
                    <div class="upload-box">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <p>Click to upload</p>
                        <small>PDF up to 10MB</small>
                        <input type="file" name="company_profile">
                    </div>
                    @error('company_profile')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-btn">Save & Continue</button>
            </div>
        </div>
    </form>
</div>

@endsection