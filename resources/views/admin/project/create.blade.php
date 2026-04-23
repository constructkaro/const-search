@extends('layouts.admin')

@section('title', 'Create New Project')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
* { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --navy:        #0f1e30;
    --navy-light:  #1c2c3e;
    --orange:      #f25c05;
    --orange-soft: #fff3ec;
    --orange-mid:  #fde0cc;
    --bg:          #f0f3f8;
    --card:        #ffffff;
    --muted:       #7a8a9e;
    --border:      #e4eaf4;
    --input-bg:    #f8fafd;
    --success:     #10b981;
    --radius-lg:   20px;
    --radius-md:   14px;
    --radius-sm:   10px;
    --shadow-card: 0 4px 24px rgba(15,30,48,0.07);
    --shadow-btn:  0 8px 28px rgba(242,92,5,0.30);
}

body {
    background: var(--bg);
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--navy);
}

.cp-page {
    padding: 32px 24px 80px;
    max-width: 1380px;
    margin: 0 auto;
}

.cp-topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 28px;
    flex-wrap: wrap;
    gap: 12px;
}

.cp-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: var(--muted);
    font-weight: 500;
}

.cp-breadcrumb a {
    color: var(--orange);
    text-decoration: none;
    font-weight: 600;
}

.cp-breadcrumb span { color: #c9d4e2; }

.cp-back-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 18px;
    border-radius: var(--radius-sm);
    background: #fff;
    border: 1px solid var(--border);
    color: var(--navy-light);
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: .2s;
}

.cp-back-btn:hover {
    background: var(--orange-soft);
    border-color: var(--orange-mid);
    color: var(--orange);
}

.cp-steps {
    display: flex;
    align-items: center;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 16px 24px;
    margin-bottom: 28px;
    box-shadow: var(--shadow-card);
    overflow-x: auto;
}

.cp-step {
    display: flex;
    align-items: center;
    gap: 10px;
    flex: 1;
    min-width: 130px;
}

.cp-step-num {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 800;
    flex-shrink: 0;
    transition: .3s;
}

.cp-step.active .cp-step-num {
    background: var(--orange);
    color: #fff;
    box-shadow: 0 4px 14px rgba(242,92,5,0.35);
}

.cp-step.done .cp-step-num {
    background: #ecfdf5;
    color: var(--success);
}

.cp-step.pending .cp-step-num {
    background: var(--bg);
    color: var(--muted);
}

.cp-step-info { flex: 1; }

.cp-step-label {
    font-size: 12px;
    font-weight: 500;
    color: var(--muted);
    line-height: 1;
    margin-bottom: 3px;
}

.cp-step.active .cp-step-label { color: var(--orange); }

.cp-step-title {
    font-size: 13px;
    font-weight: 700;
    color: var(--navy);
    line-height: 1;
}

.cp-step-divider {
    height: 1px;
    flex: 0 0 32px;
    background: var(--border);
    margin: 0 4px;
}

.cp-layout {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 24px;
    align-items: start;
}

.cp-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-card);
    overflow: hidden;
    margin-bottom: 20px;
}

.cp-card-header {
    padding: 20px 26px 18px;
    border-bottom: 1px solid #f0f4fa;
    display: flex;
    align-items: center;
    gap: 14px;
}

.cp-card-icon {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: var(--orange-soft);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--orange);
    font-size: 18px;
    flex-shrink: 0;
}

.cp-card-title {
    font-size: 16px;
    font-weight: 800;
    color: var(--navy);
    line-height: 1.2;
}

.cp-card-subtitle {
    font-size: 12px;
    color: var(--muted);
    margin-top: 2px;
    font-weight: 500;
}

.cp-card-body { padding: 24px 26px; }

.cp-grid-3 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}

.cp-grid-2 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.cp-full { grid-column: 1 / -1; }

.cp-field { display: flex; flex-direction: column; gap: 7px; }

.cp-label {
    font-size: 13px;
    font-weight: 700;
    color: var(--navy-light);
    display: flex;
    align-items: center;
    gap: 5px;
}

.cp-label .req {
    color: var(--orange);
    font-size: 15px;
    line-height: 1;
}

.cp-input,
.cp-select,
.cp-textarea {
    width: 100%;
    background: var(--input-bg);
    border: 1.5px solid var(--border);
    border-radius: var(--radius-md);
    padding: 12px 15px;
    font-size: 14px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: var(--navy);
    outline: none;
    transition: all .22s ease;
    -webkit-appearance: none;
}

.cp-input::placeholder,
.cp-textarea::placeholder {
    color: #b0bcc9;
    font-size: 13px;
}

.cp-input:focus,
.cp-select:focus,
.cp-textarea:focus {
    border-color: var(--orange);
    background: #fff;
    box-shadow: 0 0 0 4px rgba(242,92,5,0.09);
}

.cp-select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%237a8a9e' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 36px;
    cursor: pointer;
}

.cp-textarea {
    resize: vertical;
    min-height: 130px;
    line-height: 1.6;
}

.cp-hint {
    font-size: 11.5px;
    color: #a0b0c4;
    font-weight: 500;
    line-height: 1.4;
}

.cp-input-wrap { position: relative; }

.cp-input-wrap .cp-input,
.cp-input-wrap .cp-select { padding-left: 42px; }

.cp-input-wrap .cp-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #b0bcc9;
    font-size: 15px;
    pointer-events: none;
    z-index: 1;
}

.cp-upload {
    border: 2px dashed #d5dff0;
    border-radius: var(--radius-lg);
    padding: 32px 24px;
    text-align: center;
    background: linear-gradient(180deg, #fafcff 0%, #f5f8fd 100%);
    transition: .25s;
    cursor: pointer;
    position: relative;
}

.cp-upload:hover {
    border-color: rgba(242,92,5,0.5);
    background: var(--orange-soft);
}

.cp-upload input[type="file"] {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
    width: 100%;
    height: 100%;
}

.cp-upload-icon {
    width: 58px;
    height: 58px;
    margin: 0 auto 14px;
    border-radius: 50%;
    background: var(--orange-soft);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--orange);
    font-size: 22px;
}

.cp-upload-title {
    font-size: 15px;
    font-weight: 700;
    color: var(--navy);
    margin-bottom: 6px;
}

.cp-upload-sub { font-size: 12px; color: var(--muted); }

.cp-sidebar { position: sticky; top: 24px; }

.cp-tip-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-card);
    margin-bottom: 16px;
}

.cp-tip-header {
    background: linear-gradient(135deg, #0f1e30, #1a3352);
    padding: 18px 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.cp-tip-header i { color: var(--orange); font-size: 18px; }
.cp-tip-header span { color: #fff; font-size: 14px; font-weight: 700; }

.cp-tip-body { padding: 18px 20px; }

.cp-tip-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 14px;
    font-size: 13px;
    color: #4a5e72;
    line-height: 1.5;
    font-weight: 500;
}

.cp-tip-item:last-child { margin-bottom: 0; }

.cp-tip-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--orange);
    flex-shrink: 0;
    margin-top: 5px;
}

.cp-summary {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 20px;
    box-shadow: var(--shadow-card);
    margin-bottom: 16px;
}

.cp-summary-title {
    font-size: 13px;
    font-weight: 700;
    color: var(--navy);
    margin-bottom: 14px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--border);
}

.cp-summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px dashed #edf2f8;
    font-size: 13px;
}

.cp-summary-row:last-child { border-bottom: none; }
.cp-summary-key { color: var(--muted); font-weight: 500; }

.cp-summary-val {
    color: var(--navy);
    font-weight: 700;
    text-align: right;
    max-width: 160px;
    word-break: break-word;
}

.cp-submit-area {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 22px 26px;
    box-shadow: var(--shadow-card);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
}

.cp-secure {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: var(--muted);
    font-weight: 500;
}

.cp-secure i { color: var(--success); font-size: 16px; }

.cp-submit-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 36px;
    border: none;
    border-radius: 14px;
    background: var(--orange);
    color: #fff;
    font-size: 15px;
    font-weight: 800;
    font-family: 'Plus Jakarta Sans', sans-serif;
    box-shadow: var(--shadow-btn);
    cursor: pointer;
    transition: .25s;
}

.cp-submit-btn:hover {
    background: #d94f04;
    transform: translateY(-2px);
    box-shadow: 0 12px 32px rgba(242,92,5,0.38);
}

.cp-submit-btn:active { transform: translateY(0); }

/* ── Select2 Overrides ── */
.select2-container--default .select2-selection--single,
.select2-container--default .select2-selection--multiple {
    min-height: 46px !important;
    border: 1.5px solid var(--border) !important;
    border-radius: var(--radius-md) !important;
    background: var(--input-bg) !important;
    padding: 4px 8px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    display: flex;
    align-items: center;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 36px;
    color: var(--navy);
    font-size: 14px;
    padding-left: 4px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 44px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background: var(--orange-soft);
    border: 1px solid var(--orange-mid);
    color: var(--orange);
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    padding: 3px 10px;
}

.select2-dropdown {
    border-radius: 14px !important;
    border: 1.5px solid var(--border) !important;
    box-shadow: 0 8px 32px rgba(15,30,48,0.12) !important;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
}

.select2-container--default .select2-results__option--highlighted {
    background: var(--orange) !important;
}

@media (max-width: 1100px) {
    .cp-layout { grid-template-columns: 1fr; }
    .cp-sidebar { position: static; }
}

@media (max-width: 768px) {
    .cp-page { padding: 16px 12px 60px; }
    .cp-grid-3 { grid-template-columns: 1fr; }
    .cp-grid-2 { grid-template-columns: 1fr; }
    .cp-card-body { padding: 18px 16px; }
    .cp-card-header { padding: 16px; }
    .cp-submit-area { flex-direction: column; align-items: stretch; }
    .cp-submit-btn { justify-content: center; width: 100%; }
    .cp-steps { padding: 12px 16px; }
}

@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
</style>

<div class="cp-page">

    {{-- Top Bar --}}
    <div class="cp-topbar">
        <div class="cp-breadcrumb">
            <a href="{{ route('admin.allprojects') }}">Projects</a>
            <span>/</span>
            <span>Create New</span>
        </div>
        <a href="{{ route('admin.allprojects') }}" class="cp-back-btn">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>

    {{-- Progress Steps --}}
    <div class="cp-steps">
        <div class="cp-step active">
            <div class="cp-step-num">1</div>
            <div class="cp-step-info">
                <div class="cp-step-label">Step 1</div>
                <div class="cp-step-title">Project Info</div>
            </div>
        </div>
        <div class="cp-step-divider"></div>
        <div class="cp-step pending">
            <div class="cp-step-num">2</div>
            <div class="cp-step-info">
                <div class="cp-step-label">Step 2</div>
                <div class="cp-step-title">Documents</div>
            </div>
        </div>
        <div class="cp-step-divider"></div>
        <div class="cp-step pending">
            <div class="cp-step-num">3</div>
            <div class="cp-step-info">
                <div class="cp-step-label">Step 3</div>
                <div class="cp-step-title">Description</div>
            </div>
        </div>
        <div class="cp-step-divider"></div>
        <div class="cp-step pending">
            <div class="cp-step-num">4</div>
            <div class="cp-step-info">
                <div class="cp-step-label">Step 4</div>
                <div class="cp-step-title">Submit</div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.save.adminpost') }}" method="POST" enctype="multipart/form-data" id="projectPostForm">
    @csrf

    <div class="cp-layout">

        {{-- ── LEFT COLUMN ── --}}
        <div>

            {{-- Section 1: Project Info --}}
            <div class="cp-card">
                <div class="cp-card-header">
                    <div class="cp-card-icon"><i class="bi bi-briefcase"></i></div>
                    <div>
                        <div class="cp-card-title">Project Information</div>
                        <div class="cp-card-subtitle">Basic details about your project</div>
                    </div>
                </div>
                <div class="cp-card-body">
                    <div class="cp-grid-3">

                        <div class="cp-field">
                            <label class="cp-label">Vendor Type <span class="req">*</span></label>
                            <div class="cp-input-wrap">
                                <i class="bi bi-briefcase cp-icon"></i>
                                <select class="cp-select" id="work_type" name="work_type_id" style="padding-left:42px;">
                                    <option value="">Select Vendor Type</option>
                                    @foreach($work_types as $worktype)
                                        <option value="{{ $worktype->id }}"
                                            {{ ((string)($selectedWorkTypeId ?? '') === (string)$worktype->id) ? 'selected' : '' }}>
                                            {{ $worktype->work_type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="cp-field">
                            <label class="cp-label">Project Type <span class="req">*</span></label>
                            <div class="cp-input-wrap">
                                <i class="bi bi-diagram-3 cp-icon"></i>
                                <select class="cp-select" id="work_subtype" name="work_subtype_id" style="padding-left:42px;">
                                    <option value="">Select Project Type</option>
                                </select>
                            </div>
                        </div>

                        <div class="cp-field">
                            <label class="cp-label">Project Title</label>
                            <div class="cp-input-wrap">
                                <i class="bi bi-pencil cp-icon"></i>
                                <input type="text" class="cp-input" name="title" id="project_title"
                                    placeholder="e.g. 2BHK Residential Construction">
                            </div>
                            <span class="cp-hint">Auto-filled after selecting project type</span>
                        </div>

                        <div class="cp-field">
                            <label class="cp-label">City <span class="req">*</span></label>
                            <select class="cp-select" name="city_id" id="city_id">
                                <option value="">Select City</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="cp-field">
                            <label class="cp-label">Area <span class="req">*</span></label>
                            <select name="area_ids[]" id="area_id" multiple="multiple" style="width:100%;">
                            </select>
                        </div>

                        <div class="cp-field">
                            <label class="cp-label">Pincode</label>
                            <div class="cp-input-wrap">
                                <i class="bi bi-mailbox cp-icon"></i>
                                <input type="text" class="cp-input" id="pincode_id" name="pincode" readonly
                                    placeholder="Auto-filled from area selection" style="padding-left:42px;">
                            </div>
                        </div>

                        <div class="cp-field">
                            <label class="cp-label">Approx Budget (₹)</label>
                            <div class="cp-input-wrap">
                                <i class="bi bi-currency-rupee cp-icon"></i>
                                <select class="cp-select" name="budget" style="padding-left:42px;">
                                    <option value="">Select Budget Range</option>
                                    @foreach($budget_range as $range)
                                        <option value="{{ $range->id }}">{{ $range->budget_range }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="cp-field">
                            <label class="cp-label">Area Size</label>
                            <div class="cp-input-wrap">
                                <i class="bi bi-aspect-ratio cp-icon"></i>
                                <input type="text" class="cp-input" name="area"
                                    placeholder="e.g. Plot 2000 / Built-up 1500">
                            </div>
                        </div>

                        <div class="cp-field">
                            <label class="cp-label">Unit</label>
                            <div class="cp-input-wrap">
                                <i class="bi bi-rulers cp-icon"></i>
                                <select class="cp-select" name="unit" style="padding-left:42px;">
                                    <option value="">Select Unit</option>
                                    @foreach($unit as $units)
                                        <option value="{{ $units->id }}">{{ $units->unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Section 2: Contact Info --}}
            <div class="cp-card">
                <div class="cp-card-header">
                    <div class="cp-card-icon"><i class="bi bi-person-lines-fill"></i></div>
                    <div>
                        <div class="cp-card-title">Contact Information</div>
                        <div class="cp-card-subtitle">Person responsible for this project</div>
                    </div>
                </div>
                <div class="cp-card-body">
                    <div class="cp-grid-3">

                        <div class="cp-field">
                            <label class="cp-label">Contact Name <span class="req">*</span></label>
                            <div class="cp-input-wrap">
                                <i class="bi bi-person cp-icon"></i>
                                <input type="text" class="cp-input" name="contact_name"
                                    placeholder="e.g. Aniket Patil">
                            </div>
                        </div>

                        <div class="cp-field">
                            <label class="cp-label">Mobile <span class="req">*</span></label>
                            <div class="cp-input-wrap">
                                <i class="bi bi-phone cp-icon"></i>
                                <input type="text" class="cp-input" name="mobile" id="main_mobile"
                                    placeholder="e.g. 9876543210" maxlength="10">
                            </div>
                        </div>

                        <div class="cp-field">
                            <label class="cp-label">Email</label>
                            <div class="cp-input-wrap">
                                <i class="bi bi-envelope cp-icon"></i>
                                <input type="email" class="cp-input" name="email"
                                    placeholder="e.g. aniket@example.com">
                            </div>
                        </div>

                        <div class="cp-field">
                            <label class="cp-label">Added By</label>
                            <div class="cp-input-wrap">
                                <i class="bi bi-person-badge cp-icon"></i>
                                <input type="text" class="cp-input" name="add_by"
                                    placeholder="Enter name of who is adding this">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Section 3: Documents --}}
            <div class="cp-card">
                <div class="cp-card-header">
                    <div class="cp-card-icon"><i class="bi bi-folder2-open"></i></div>
                    <div>
                        <div class="cp-card-title">Project Documents</div>
                        <div class="cp-card-subtitle">Upload drawings, BOQ, or reference files</div>
                    </div>
                </div>
                <div class="cp-card-body">
                    <div class="cp-upload" id="uploadBox">
                        <input type="file" name="files" multiple id="fileInput">
                        <div class="cp-upload-icon"><i class="bi bi-cloud-arrow-up"></i></div>
                        <div class="cp-upload-title">Drop files here or click to browse</div>
                        <div class="cp-upload-sub" id="fileLabel">PDF · JPG · PNG · Excel &nbsp;•&nbsp; Max 10MB each</div>
                    </div>
                </div>
            </div>

            {{-- Section 4: Description --}}
            <div class="cp-card">
                <div class="cp-card-header">
                    <div class="cp-card-icon"><i class="bi bi-textarea-t"></i></div>
                    <div>
                        <div class="cp-card-title">Project Description</div>
                        <div class="cp-card-subtitle">Describe your project requirements in detail</div>
                    </div>
                </div>
                <div class="cp-card-body">
                    <div class="cp-field">
                        <textarea class="cp-textarea" name="description" rows="5"
                            placeholder="Example: Construction of a 2BHK residential house on 1500 sq.ft in Pune. Includes civil, plumbing, electrical & finishing. Expected start in 1 month."></textarea>
                        <span class="cp-hint">Mention scope of work, timeline, site condition, project size, and any special requirements.</span>
                    </div>
                </div>
            </div>

            {{-- Submit Bar --}}
            <div class="cp-submit-area">
                <div class="cp-secure">
                    <i class="bi bi-shield-check"></i>
                    Your data is encrypted and secure
                </div>
                <button type="submit" class="cp-submit-btn" id="submitBtn">
                    <i class="bi bi-send"></i>
                    Submit Project
                </button>
            </div>

        </div>

        {{-- ── RIGHT SIDEBAR ── --}}
        <div class="cp-sidebar">

            {{-- Live Summary --}}
            <div class="cp-summary">
                <div class="cp-summary-title">📋 Live Summary</div>
                <div class="cp-summary-row">
                    <span class="cp-summary-key">Vendor Type</span>
                    <span class="cp-summary-val" id="sum-vendor">—</span>
                </div>
                <div class="cp-summary-row">
                    <span class="cp-summary-key">Project Type</span>
                    <span class="cp-summary-val" id="sum-type">—</span>
                </div>
                <div class="cp-summary-row">
                    <span class="cp-summary-key">Contact</span>
                    <span class="cp-summary-val" id="sum-contact">—</span>
                </div>
                <div class="cp-summary-row">
                    <span class="cp-summary-key">Mobile</span>
                    <span class="cp-summary-val" id="sum-mobile">—</span>
                </div>
                <div class="cp-summary-row">
                    <span class="cp-summary-key">City</span>
                    <span class="cp-summary-val" id="sum-city">—</span>
                </div>
                <div class="cp-summary-row">
                    <span class="cp-summary-key">Budget</span>
                    <span class="cp-summary-val" id="sum-budget">—</span>
                </div>
                <div class="cp-summary-row">
                    <span class="cp-summary-key">Files</span>
                    <span class="cp-summary-val" id="sum-files">None</span>
                </div>
            </div>

            {{-- Tips --}}
            <div class="cp-tip-card">
                <div class="cp-tip-header">
                    <i class="bi bi-lightbulb"></i>
                    <span>Pro Tips</span>
                </div>
                <div class="cp-tip-body">
                    <div class="cp-tip-item">
                        <div class="cp-tip-dot"></div>
                        <span>Mention exact scope of work so vendors can quote accurately</span>
                    </div>
                    <div class="cp-tip-item">
                        <div class="cp-tip-dot"></div>
                        <span>Add timeline and expected start date to attract serious vendors</span>
                    </div>
                    <div class="cp-tip-item">
                        <div class="cp-tip-dot"></div>
                        <span>Upload drawings or BOQ files for faster vendor matching</span>
                    </div>
                    <div class="cp-tip-item">
                        <div class="cp-tip-dot"></div>
                        <span>Mention site access conditions if work location is remote</span>
                    </div>
                </div>
            </div>

            {{-- Lead Status --}}
            <div style="background:#fff;border:1px solid var(--border);border-radius:var(--radius-lg);padding:18px 20px;box-shadow:var(--shadow-card);">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
                    <div style="width:10px;height:10px;border-radius:50%;background:#10b981;box-shadow:0 0 0 3px rgba(16,185,129,0.2);"></div>
                    <span style="font-size:13px;font-weight:700;color:var(--navy);">Lead will be created as</span>
                </div>
                <div style="background:#f0fdf4;border:1px solid #d1fae5;border-radius:10px;padding:10px 14px;display:flex;align-items:center;gap:8px;">
                    <i class="bi bi-check-circle-fill" style="color:#10b981;font-size:16px;"></i>
                    <span style="font-size:13px;font-weight:700;color:#065f46;">Active Lead</span>
                </div>
                <p style="font-size:12px;color:var(--muted);margin-top:10px;line-height:1.5;">
                    After submission the lead will be visible in your Projects list and can be assigned to vendors.
                </p>
            </div>

        </div>

    </div>
    </form>

</div>

{{-- Scripts --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(function () {

    // ── 1. Init Select2 ──
    $('#city_id').select2({
        placeholder: 'Select City',
        width: '100%'
    });

    $('#area_id').select2({
        placeholder: 'Select areas',
        allowClear: true,
        width: '100%',
        closeOnSelect: false
    });

    // ── 2. Vendor Type → Project Subtypes ──
    $('#work_type').on('change', function () {
        const id  = $(this).val();
        const sub = $('#work_subtype');
        $('#sum-vendor').text($(this).find('option:selected').text() || '—');
        sub.html('<option value="">Loading...</option>');

        if (id) {
            $.get('/get-project-types/' + id, function (data) {
                sub.html('<option value="">Select Project Type</option>');
                data.forEach(i => sub.append(`<option value="${i.id}">${i.work_subtype}</option>`));
            });
        } else {
            sub.html('<option value="">Select Project Type</option>');
        }
    });

    if ($('#work_type').val()) $('#work_type').trigger('change');

    // ── 3. Project Subtype → Auto-fill Title ──
    $('#work_subtype').on('change', function () {
        const text = $(this).find('option:selected').text();
        $('#sum-type').text(text || '—');
        if (text && text !== 'Select Project Type') {
            $('#project_title').val(text);
        }
    });

    // ── 4. City → Load Areas ──
    function loadAreas(cityId, selectedAreas = []) {
        $('#area_id').html('').trigger('change');
        $('#pincode_id').val('');
        if (!cityId) return;

        $.ajax({
            url: "{{ route('get.areas', ':city_id') }}".replace(':city_id', cityId),
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                data.forEach(function (area) {
                    const isSelected = selectedAreas.includes(area.id.toString()) || selectedAreas.includes(area.id);
                    const option = new Option(area.name, area.id, isSelected, isSelected);
                    $('#area_id').append(option);
                });
                $('#area_id').trigger('change');
                if (selectedAreas.length) loadPincodes(selectedAreas);
            }
        });
    }

    $('#city_id').on('change', function () {
        const text = $(this).find('option:selected').text();
        $('#sum-city').text(text || '—');
        loadAreas($(this).val(), []);
    });

    // ── 5. Area → Load Pincodes ──
    function loadPincodes(areaIds) {
        if (!areaIds || !areaIds.length) {
            $('#pincode_id').val('');
            return;
        }
        $.ajax({
            url: "{{ route('get.pincodes') }}",
            type: 'GET',
            dataType: 'json',
            data: { area_ids: areaIds },
            success: function (data) {
                $('#pincode_id').val([...new Set(data)].join(', '));
            }
        });
    }

    $('#area_id').on('change', function () {
        loadPincodes($(this).val());
    });

    // ── 6. Live Summary ──
    $('input[name="contact_name"]').on('input', function () {
        $('#sum-contact').text($(this).val() || '—');
    });

    $('input[name="mobile"]').on('input', function () {
        $('#sum-mobile').text($(this).val() || '—');
    });

    $('select[name="budget"]').on('change', function () {
        $('#sum-budget').text($(this).find('option:selected').text() || '—');
    });

    // ── 7. File Input ──
    $('#fileInput').on('change', function () {
        const count = this.files.length;
        $('#fileLabel').text(count ? count + ' file(s) selected' : 'PDF · JPG · PNG · Excel • Max 10MB each');
        $('#sum-files').text(count ? count + ' file(s)' : 'None');
    });

    // ── 8. Form Submit ──
    $('#projectPostForm').on('submit', function (e) {
        e.preventDefault();
        const btn = $('#submitBtn');
        btn.html('<i class="bi bi-arrow-repeat" style="animation:spin .7s linear infinite;display:inline-block;"></i> Submitting...');
        btn.prop('disabled', true);

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function () {
                window.location.href = "{{ route('admin.allprojects') }}";
            },
            error: function (xhr) {
                btn.html('<i class="bi bi-send"></i> Submit Project');
                btn.prop('disabled', false);

                let msg = 'Something went wrong. Please check the form.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: msg,
                    confirmButtonColor: '#f25c05',
                    borderRadius: '18px'
                });
            }
        });
    });

});
</script>

@endsection