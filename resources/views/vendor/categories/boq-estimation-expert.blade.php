@extends('vendor.layouts.vapp')

@section('title', 'BOQ Form')
@section('page_title', 'BOQ / Estimation Form')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    :root {
        --ck-dark: #111827;
        --ck-dark-2: #1f2937;
        --ck-text: #374151;
        --ck-text-soft: #6b7280;
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
        --ck-red: #dc2626;
        --ck-orange: #ea580c;
        --ck-navy: #111827;
        --ck-navy-2: #1f2937;
        --ck-line-dark: #dbe3ec;
        --ck-radius-md: 14px;
        --ck-shadow: 0 12px 35px rgba(15, 23, 42, 0.08);
    }

    body {
        background:
            linear-gradient(rgba(15, 23, 42, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(15, 23, 42, 0.03) 1px, transparent 1px),
            linear-gradient(180deg, #f8fafc 0%, #eef3f8 100%);
        background-size: 56px 56px, 56px 56px, auto;
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

    .boq-card,
    .section-card {
        background: var(--ck-white);
        border-radius: 26px;
        padding: 30px;
        box-shadow: var(--ck-shadow);
        border: 1px solid #edf2f7;
        position: relative;
        overflow: hidden;
        margin-top: 24px;
    }

    .boq-card::after,
    .section-card::after {
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

    .boq-title-wrap,
    .section-head {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .boq-icon,
    .section-badge {
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

    .boq-title h2,
    .section-title-wrap h2 {
        font-size: 22px;
        line-height: 1.2;
        color: var(--ck-dark);
        margin: 0 0 6px;
        font-weight: 800;
    }

    .boq-title p,
    .section-title-wrap p {
        margin: 0;
        color: var(--ck-muted);
        font-size: 15px;
    }

    .field-block + .field-block {
        margin-top: 24px;
    }

    .field-label {
        font-size: 16px;
        font-weight: 800;
        color: var(--ck-dark-2);
        margin-bottom: 10px;
    }

    .field-label .req,
    .req {
        color: var(--ck-danger);
    }

    .field-sub,
    .field-subtext {
        font-size: 13px;
        color: var(--ck-muted);
        margin-bottom: 14px;
    }

    .vendor-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 16px 18px;
        border: 1.5px solid var(--ck-border);
        border-radius: 18px;
        background: linear-gradient(180deg, #ffffff 0%, #fcfcfd 100%);
    }

    .vendor-value {
        font-size: 16px;
        font-weight: 800;
        color: var(--ck-dark);
    }

    .vendor-chip {
        background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
        color: #fff;
        padding: 9px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 800;
        white-space: nowrap;
    }

    .form-grid-2 {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .form-select,
    .form-input,
    .form-textarea {
        width: 100%;
        border: 1px solid #dbe3ec;
        border-radius: 14px;
        background: #fff;
        color: #111827;
        font-size: 14px;
        padding: 13px 14px;
        outline: none;
        transition: 0.25s ease;
    }

    .form-select:focus,
    .form-input:focus,
    .form-textarea:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.10);
    }

    .form-textarea {
        min-height: 110px;
        resize: vertical;
    }

    .project-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
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

    .upload-box input[type="file"]::file-selector-button {
        border: none;
        background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%);
        color: white;
        padding: 8px 12px;
        margin-right: 12px;
        border-radius: 8px;
        cursor: pointer;
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
    }

    .save-btn:hover {
        transform: translateY(-2px);
    }

    .alert-success {
        background: var(--ck-success-bg);
        color: var(--ck-success-text);
        padding: 14px 16px;
        border-radius: 16px;
        border: 1px solid var(--ck-success-border);
        font-weight: 700;
    }

    .text-danger {
        color: var(--ck-danger);
        font-size: 13px;
        margin-top: 6px;
        display: block;
        font-weight: 600;
    }

    .area-loading {
        display: none;
        font-size: 13px;
        color: #6b7280;
        font-weight: 600;
        margin-top: 8px;
    }

    .area-loading.visible {
        display: block;
    }

    .select2-container {
        width: 100% !important;
    }

    .select2-container .select2-selection--single {
        height: 52px !important;
        border: 1.5px solid var(--ck-line-dark) !important;
        border-radius: var(--ck-radius-md) !important;
        background: #fff !important;
        display: flex !important;
        align-items: center !important;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        line-height: 50px !important;
        padding-left: 14px !important;
        color: var(--ck-text) !important;
    }

    .select2-container .select2-selection--single .select2-selection__arrow {
        height: 50px !important;
        right: 10px !important;
    }

    .select2-container .select2-selection--multiple {
        min-height: 52px !important;
        border: 1.5px solid var(--ck-line-dark) !important;
        border-radius: var(--ck-radius-md) !important;
        background: #fff !important;
        padding: 6px 10px !important;
    }

    .select2-container .select2-selection--multiple .select2-selection__choice {
        background: #eef4ff !important;
        border: 1px solid #c7d8ff !important;
        color: #10204f !important;
        border-radius: 999px !important;
        padding: 4px 10px !important;
    }

    .select2-container .select2-selection--multiple .select2-selection__choice__remove {
        color: #10204f !important;
        border-right: none !important;
        margin-right: 6px !important;
    }

    .select2-dropdown {
        border: 1px solid var(--ck-line-dark) !important;
        border-radius: 12px !important;
        overflow: hidden;
    }

    .select2-results__option--highlighted {
        background: var(--ck-navy) !important;
        color: #fff !important;
    }

    @media (max-width: 1100px) {
        .project-grid,
        .upload-grid,
        .form-grid-2 {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .boq-hero,
        .boq-card,
        .section-card {
            padding: 22px;
            border-radius: 22px;
        }

        .boq-hero-text h1 {
            font-size: 22px;
        }

        .boq-card-header,
        .section-head,
        .vendor-bar,
        .form-footer {
            flex-direction: column;
            align-items: flex-start;
        }

        .project-grid,
        .upload-grid,
        .form-grid-2 {
            grid-template-columns: 1fr;
        }

        .save-btn {
            width: 100%;
        }
    }
</style>

@php
    $workType = $workType ?? null;
    $projectTypes = $projectTypes ?? collect();
    $turnaroundTimes = ['2 Days', '3 Days', '5 Days', '7 Days', '10 Days', '10+ Days'];

    $selectedProjectTypes = old('project_types', $existingData->project_types ?? []);
    if (is_string($selectedProjectTypes)) {
        $selectedProjectTypes = json_decode($selectedProjectTypes, true) ?? [];
    }
    if (!is_array($selectedProjectTypes)) {
        $selectedProjectTypes = [];
    }

    $selectedTurnaround = old('boq_turnaround_time', $existingData->boq_turnaround_time ?? '');

    $selectedCityIds = old('city_ids', !empty($existingData->city_ids)
        ? json_decode($existingData->city_ids, true)
        : (!empty($existingData->city_id) ? [$existingData->city_id] : [])
    );
    $selectedCityIds = is_array($selectedCityIds) ? array_map('strval', $selectedCityIds) : [];

    $selectedAreaIds = old('area_ids', !empty($existingData->area_ids)
        ? json_decode($existingData->area_ids, true)
        : []
    );
    $selectedAreaIds = is_array($selectedAreaIds) ? array_map('strval', $selectedAreaIds) : [];

    $savedPincodes = old('pincode', $existingData->pincode ?? '');
@endphp

<div class="boq-page">

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div style="background:#fee2e2;color:#991b1b;padding:14px 18px;border-radius:12px;font-weight:600;">
            <ul style="margin:0;padding-left:18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
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
                <div class="field-label">Find Your Construction Vendor <span class="req">*</span></div>
                <div class="vendor-bar">
                    <div class="vendor-value">{{ $workType->work_type ?? 'BOQ / Estimation Expert' }}</div>
                    <div class="vendor-chip">{{ $workType->work_type ?? 'BOQ / Estimation Expert' }}</div>
                </div>
            </div>

            <div class="field-block">
                <div class="field-label">Project Type <span class="req">*</span></div>
                <div class="field-subtext">Select all project types you have experience in.</div>

                <div class="project-grid">
                    @forelse($projectTypes as $index => $type)
                        <div class="project-item">
                            <input type="checkbox"
                                   id="project_type_{{ $index }}"
                                   name="project_types[]"
                                   value="{{ $type }}"
                                   {{ in_array($type, $selectedProjectTypes) ? 'checked' : '' }}>
                            <label for="project_type_{{ $index }}">{{ $type }}</label>
                        </div>
                    @empty
                        <p style="color:red; font-weight:600;">No project types found.</p>
                    @endforelse
                </div>

                @error('project_types')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
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
                                <option value="{{ $experience->id }}"
                                    {{ old('experience_years', $existingData->experience_years ?? '') == $experience->id ? 'selected' : '' }}>
                                    {{ $experience->experiance ?? $experience->experience }}
                                </option>
                            @endforeach
                        </select>
                        @error('experience_years')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <div class="field-label">Team Size <span class="req">*</span></div>
                        <select class="form-select" name="team_size" id="team_size">
                            <option value="">Select team size</option>
                            @foreach($team_size as $team)
                                <option value="{{ $team->id }}"
                                    {{ old('team_size', $existingData->team_size ?? '') == $team->id ? 'selected' : '' }}>
                                    {{ $team->team_size }}
                                </option>
                            @endforeach
                        </select>
                        @error('team_size')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <div class="field-label">City <span class="req">*</span></div>
                        <select class="form-select" name="city_ids[]" id="city_ids" multiple required>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}"
                                    {{ in_array((string)$city->id, $selectedCityIds) ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('city_ids')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <div class="field-label">Area <span class="req">*</span></div>
                        <select class="form-select" name="area_ids[]" id="area_ids" multiple required></select>

                        <small class="area-loading" id="areaLoading">
                            <i class="fa-solid fa-spinner fa-spin"></i> Loading areas…
                        </small>

                        @error('area_ids')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <div class="field-label">Pincode <span class="req">*</span></div>
                        <textarea class="form-textarea"
                                  id="pincode_id"
                                  name="pincode"
                                  readonly
                                  placeholder="Pincodes auto-fill from selected areas">{{ $savedPincodes }}</textarea>

                        @error('pincode')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <div class="field-label">Accepting projects of minimum value (₹) <span class="req">*</span></div>
                        <input type="number"
                               step="1"
                               min="0"
                               class="form-input"
                               name="minimum_project_value"
                               value="{{ old('minimum_project_value', $existingData->minimum_project_value ?? '') }}"
                               placeholder="Enter minimum project value">
                        <small class="text-muted">
                            Please enter amount in numbers only. Example: 500000 for ₹5 Lakhs. Do not write 5 Lakhs or 5L.
                        </small>
                    </div>
                </div>
            </div>

            <div class="field-block">
                <div class="field-label">BOQ Turnaround Time <span class="req">*</span></div>
                <div class="field-subtext">Choose your usual delivery timeline for BOQ / estimation work.</div>

                <div class="turnaround-grid">
                    @foreach($turnaroundTimes as $time)
                        <div class="turnaround-item">
                            <input type="radio"
                                   id="time_{{ $loop->index }}"
                                   name="boq_turnaround_time"
                                   value="{{ $time }}"
                                   {{ $selectedTurnaround == $time ? 'checked' : '' }}>
                            <label for="time_{{ $loop->index }}">{{ $time }}</label>
                        </div>
                    @endforeach
                </div>

                @error('boq_turnaround_time')
                    <span class="text-danger">{{ $message }}</span>
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
                        <input type="file" name="gst_certificate" id="gst_certificate" accept=".pdf,.jpg,.jpeg,.png">
                        <div class="file-note" id="gst_certificate_name"></div>

                        @if(!empty($existingData->gst_certificate))
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $existingData->gst_certificate) }}" target="_blank">
                                    View uploaded GST Certificate
                                </a>
                            </div>
                        @endif
                    </div>

                    @error('gst_certificate')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="upload-col">
                    <label class="top-label">Aadhaar Card</label>
                    <div class="upload-box">
                        <div class="upload-icon">
                            <i class="fa-solid fa-id-card"></i>
                        </div>
                        <h4>Upload Aadhaar Card</h4>
                        <p>Accepted: PDF, JPG, PNG<br>Maximum file size: 5MB</p>
                        <input type="file" name="aadhaar_card" id="aadhaar_card" accept=".pdf,.jpg,.jpeg,.png">
                        <div class="file-note" id="aadhaar_card_name"></div>

                        @if(!empty($existingData->aadhaar_card))
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $existingData->aadhaar_card) }}" target="_blank">
                                    View uploaded Aadhaar Card
                                </a>
                            </div>
                        @endif
                    </div>

                    @error('aadhaar_card')
                        <span class="text-danger">{{ $message }}</span>
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
                        <input type="file" name="company_profile" id="company_profile" accept=".pdf,.jpg,.jpeg,.png">
                        <div class="file-note" id="company_profile_name"></div>

                        @if(!empty($existingData->company_profile))
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $existingData->company_profile) }}" target="_blank">
                                    View uploaded Company Profile
                                </a>
                            </div>
                        @endif
                    </div>

                    @error('company_profile')
                        <span class="text-danger">{{ $message }}</span>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
function bindFileNamePreview(inputId, outputId) {
    const input = document.getElementById(inputId);
    const output = document.getElementById(outputId);

    if (!input || !output) return;

    input.addEventListener('change', function () {
        output.textContent = this.files && this.files.length ? this.files[0].name : '';
    });
}

bindFileNamePreview('gst_certificate', 'gst_certificate_name');
bindFileNamePreview('aadhaar_card', 'aadhaar_card_name');
bindFileNamePreview('company_profile', 'company_profile_name');
</script>

<script>
$(document).ready(function () {

    const preSelectedCityIds = @json($selectedCityIds);
    const preSelectedAreaIds = @json($selectedAreaIds);

    const areasRouteTemplate = "{{ route('get.areas', ':city_id') }}";
    const pincodesRoute = "{{ route('get.pincodes') }}";

    $('#city_ids').select2({
        placeholder: 'Select one or more cities',
        width: '100%',
        closeOnSelect: false
    });

    $('#area_ids').select2({
        placeholder: 'Select areas',
        width: '100%',
        closeOnSelect: false
    });

    function loadAreasForCities(cityIds, preselectAreaIds = []) {
        if (!cityIds || cityIds.length === 0) {
            $('#area_ids').html('').trigger('change');
            $('#pincode_id').val('');
            return;
        }

        $('#areaLoading').addClass('visible');
        $('#area_ids').prop('disabled', true);

        const requests = cityIds.map(cityId => {
            return $.ajax({
                url: areasRouteTemplate.replace(':city_id', cityId),
                type: 'GET',
                dataType: 'json'
            });
        });

        $.when(...requests).then(function (...responses) {
            let allAreas = [];

            if (cityIds.length === 1) {
                allAreas = responses[0];
            } else {
                responses.forEach(res => {
                    allAreas = allAreas.concat(res[0]);
                });
            }

            const seen = new Set();

            const uniqueAreas = allAreas.filter(area => {
                if (seen.has(area.id)) return false;
                seen.add(area.id);
                return true;
            });

            uniqueAreas.sort((a, b) => a.name.localeCompare(b.name));

            let html = '';

            uniqueAreas.forEach(area => {
                const selected =
                    preselectAreaIds.includes(area.id.toString()) ||
                    preselectAreaIds.includes(area.id);

                html += `<option value="${area.id}" ${selected ? 'selected' : ''}>${area.name}</option>`;
            });

            $('#area_ids').html(html).trigger('change');
            $('#area_ids').prop('disabled', false);
            $('#areaLoading').removeClass('visible');

            if (preselectAreaIds.length > 0) {
                loadPincodes(preselectAreaIds);
            }

        }).fail(function () {
            $('#area_ids').prop('disabled', false);
            $('#areaLoading').removeClass('visible');
            alert('Areas loading failed. Please check get.areas route.');
        });
    }

    function loadPincodes(areaIds) {
        if (!areaIds || areaIds.length === 0) {
            $('#pincode_id').val('');
            return;
        }

        $.ajax({
            url: pincodesRoute,
            type: 'GET',
            dataType: 'json',
            data: {
                area_ids: areaIds
            },
            success: function (data) {
                let uniquePincodes = [...new Set(data)];
                $('#pincode_id').val(uniquePincodes.join(', '));
            },
            error: function () {
                $('#pincode_id').val('');
            }
        });
    }

    $('#city_ids').on('change', function () {
        $('#pincode_id').val('');
        loadAreasForCities($(this).val() || [], []);
    });

    $('#area_ids').on('change', function () {
        loadPincodes($(this).val() || []);
    });

    if (preSelectedCityIds.length > 0) {
        $('#city_ids').val(preSelectedCityIds).trigger('change.select2');
        loadAreasForCities(preSelectedCityIds, preSelectedAreaIds);
    }

});
</script>

@endsection