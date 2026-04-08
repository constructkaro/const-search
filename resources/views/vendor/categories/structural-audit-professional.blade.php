@extends('vendor.layouts.vapp')

@section('title', 'Structural Audit Provider Form')
@section('page_title', 'Structural Audit Provider Form')

@section('content')

<style>
    :root{
        --ck-bg: #f4f7fb;
        --ck-white: #ffffff;
        --ck-navy: #0f173d;
        --ck-navy-2: #1e3766;
        --ck-navy-3: #355c9a;
        --ck-orange: #eb7a2f;
        --ck-orange-2: #f39a56;
        --ck-orange-soft: #fff4eb;
        --ck-text: #182b49;
        --ck-text-soft: #71829b;
        --ck-muted: #99a6b7;
        --ck-line: #e3eaf2;
        --ck-line-dark: #d6dfeb;
        --ck-red: #dc2626;
        --ck-green: #16a34a;
        --ck-shadow-sm: 0 8px 22px rgba(15, 23, 61, 0.05);
        --ck-shadow-md: 0 16px 38px rgba(15, 23, 61, 0.07);
        --ck-shadow-lg: 0 18px 38px rgba(235, 122, 47, 0.20);
        --ck-radius-xl: 28px;
        --ck-radius-lg: 20px;
        --ck-radius-md: 16px;
        --ck-radius-sm: 14px;
    }

    body{
        background:
            linear-gradient(rgba(15, 23, 61, 0.032) 1px, transparent 1px),
            linear-gradient(90deg, rgba(15, 23, 61, 0.032) 1px, transparent 1px),
            linear-gradient(180deg, #f8fafc 0%, #eef3f8 100%);
        background-size: 56px 56px, 56px 56px, auto;
    }

    .audit-page{
        max-width: 1220px;
        margin: 0 auto;
        padding: 22px 0 36px;
    }

    .audit-stack{
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .top-banner{
        background: linear-gradient(135deg, #ffffff 0%, #fff8f2 100%);
        border: 1px solid #f2e0d0;
        border-radius: 26px;
        box-shadow: var(--ck-shadow-md);
        padding: 22px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 18px;
        flex-wrap: wrap;
    }

    .top-banner-left{
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .top-banner-icon{
        width: 64px;
        height: 64px;
        border-radius: 20px;
        background: linear-gradient(135deg, var(--ck-orange) 0%, var(--ck-orange-2) 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        box-shadow: 0 16px 32px rgba(235,122,47,0.22);
        flex-shrink: 0;
    }

    .top-banner h1{
        margin: 0;
        color: var(--ck-navy);
        font-size: 28px;
        line-height: 1.2;
        font-weight: 900;
    }

    .top-banner p{
        margin: 6px 0 0;
        color: var(--ck-text-soft);
        font-size: 14px;
        font-weight: 500;
    }

    .top-badge{
        padding: 11px 16px;
        border-radius: 999px;
        background: #fff;
        border: 1px solid #f1dfcf;
        color: var(--ck-orange);
        font-size: 14px;
        font-weight: 800;
        box-shadow: 0 8px 18px rgba(235,122,47,0.06);
    }

    .step-card{
        background: linear-gradient(180deg, #ffffff 0%, #fcfdff 100%);
        border: 1px solid var(--ck-line);
        border-radius: var(--ck-radius-xl);
        box-shadow: var(--ck-shadow-md);
        padding: 28px 26px 30px;
        position: relative;
        overflow: hidden;
    }

    .step-card::before{
        content: "";
        position: absolute;
        right: -70px;
        top: -70px;
        width: 220px;
        height: 220px;
        background: radial-gradient(circle, rgba(15, 23, 61, 0.05) 0%, transparent 72%);
        pointer-events: none;
    }

    .section-divider{
        height: 4px;
        width: 100%;
        background: linear-gradient(90deg, var(--ck-orange), rgba(235,122,47,0.08));
        border-radius: 999px;
        margin-bottom: 24px;
    }

    .step-head{
        display: flex;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 24px;
        position: relative;
        z-index: 2;
    }

    .step-badge{
        width: 54px;
        height: 54px;
        border-radius: 18px;
        background: linear-gradient(135deg, #fff4eb 0%, #ffe8d8 100%);
        color: var(--ck-orange);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .step-title-wrap h2{
        margin: 0;
        font-size: 24px;
        line-height: 1.15;
        color: var(--ck-navy-2);
        font-weight: 900;
    }

    .step-title-wrap p{
        margin: 6px 0 0;
        color: var(--ck-text-soft);
        font-size: 15px;
        font-weight: 500;
    }

    .field-block + .field-block{
        margin-top: 24px;
    }

    .field-label{
        margin: 0 0 10px;
        font-size: 16px;
        color: var(--ck-navy);
        font-weight: 800;
    }

    .field-label .req{
        color: var(--ck-red);
    }

    .field-help,
    .field-sub{
        margin: -2px 0 14px;
        font-size: 14px;
        color: var(--ck-text-soft);
        font-weight: 500;
    }

    .vendor-bar{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:16px;
        padding:16px 18px;
        border:1.5px solid var(--ck-line-dark);
        border-radius:var(--ck-radius-md);
        background:linear-gradient(180deg,#ffffff 0%,#fbfcfe 100%);
    }

    .vendor-value{
        font-size:16px;
        font-weight:800;
        color:var(--ck-navy);
    }

    .vendor-chip{
        background:linear-gradient(135deg,var(--ck-orange) 0%, var(--ck-orange-2) 100%);
        color:#fff;
        padding:9px 14px;
        border-radius:999px;
        font-size:13px;
        font-weight:800;
        white-space:nowrap;
    }

    .project-grid{
        display:grid;
        grid-template-columns:repeat(3, minmax(0, 1fr));
        gap:16px 18px;
    }

    .project-item input,
    .card-option input,
    .chip-option input,
    .toggle-switch input,
    .upload-item input[type="file"]{
        display:none;
    }

    .project-item label{
        min-height: 64px;
        border: 1.5px solid var(--ck-line-dark);
        border-radius: var(--ck-radius-md);
        background: linear-gradient(180deg,#ffffff 0%,#fbfcfe 100%);
        display:flex;
        align-items:center;
        gap:14px;
        padding:14px 16px;
        cursor:pointer;
        transition: all .22s ease;
        font-size:15px;
        color:var(--ck-text);
        font-weight:700;
        line-height:1.4;
    }

    .project-item label::before{
        content:"";
        width:20px;
        height:20px;
        border-radius:6px;
        border:2px solid #c4d0de;
        background:#fff;
        flex-shrink:0;
        transition:.22s ease;
    }

    .project-item label:hover{
        transform: translateY(-2px);
        box-shadow: var(--ck-shadow-sm);
        border-color:#c7d3e4;
    }

    .project-item input:checked + label{
        border-color:var(--ck-orange);
        background:linear-gradient(180deg,#fffaf6 0%,#fff2e9 100%);
        box-shadow:0 10px 18px rgba(235,122,47,0.08);
    }

    .project-item input:checked + label::before{
        background:linear-gradient(135deg,var(--ck-orange) 0%,var(--ck-orange-2) 100%);
        border-color:var(--ck-orange);
        box-shadow: inset 0 0 0 4px #fff;
    }

    .structure-grid{
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        max-width: 820px;
    }

    .chip-grid{
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .form-grid-2{
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px 24px;
    }

    .card-option label{
        min-height: 142px;
        border: 1.5px solid var(--ck-line-dark);
        border-radius: var(--ck-radius-lg);
        background: linear-gradient(180deg, #ffffff 0%, #fbfcfe 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 13px;
        text-align: center;
        padding: 18px 14px;
        cursor: pointer;
        transition: all .25s ease;
        position: relative;
        overflow: hidden;
    }

    .card-option label::after{
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(235,122,47,0.07), transparent 60%);
        opacity: 0;
        transition: .25s ease;
    }

    .card-option label:hover{
        transform: translateY(-4px);
        box-shadow: var(--ck-shadow-sm);
        border-color: #c7d3e4;
    }

    .card-option label:hover::after{
        opacity: 1;
    }

    .card-icon{
        width: 62px;
        height: 62px;
        border-radius: 18px;
        background: #f2f6fc;
        color: var(--ck-navy-3);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        position: relative;
        z-index: 2;
        transition: all .24s ease;
    }

    .card-text{
        font-size: 17px;
        line-height: 1.35;
        color: var(--ck-navy-2);
        font-weight: 800;
        position: relative;
        z-index: 2;
        transition: all .24s ease;
    }

    .card-option input:checked + label{
        border-color: var(--ck-orange);
        background: linear-gradient(180deg, #fffaf6 0%, #fff2e9 100%);
        box-shadow: 0 16px 28px rgba(235,122,47,0.10);
    }

    .card-option input:checked + label .card-icon{
        background: #ffe7d6;
        color: var(--ck-orange);
        transform: scale(1.03);
    }

    .card-option input:checked + label .card-text{
        color: var(--ck-navy);
    }

    .card-option input:checked + label::before{
        content: "\f00c";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        top: 12px;
        right: 12px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: var(--ck-orange);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        z-index: 3;
        box-shadow: 0 8px 14px rgba(235,122,47,0.18);
    }

    .chip-option label{
        min-height: 54px;
        padding: 0 18px;
        border-radius: var(--ck-radius-sm);
        border: 1.5px solid var(--ck-line-dark);
        background: linear-gradient(180deg, #ffffff 0%, #fbfcfe 100%);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        cursor: pointer;
        font-size: 15px;
        color: var(--ck-navy-2);
        font-weight: 700;
        transition: all .22s ease;
    }

    .chip-option label:hover{
        transform: translateY(-1px);
        box-shadow: var(--ck-shadow-sm);
    }

    .chip-option input:checked + label{
        border-color: var(--ck-orange);
        background: linear-gradient(180deg, #fffaf6 0%, #fff2e9 100%);
        color: var(--ck-navy);
        box-shadow: 0 10px 18px rgba(235,122,47,0.08);
    }

    .form-select,
    .form-input,
    .form-textarea{
        width: 100%;
        border: 1.5px solid var(--ck-line-dark);
        border-radius: var(--ck-radius-md);
        background: #fff;
        color: var(--ck-text);
        font-size: 16px;
        padding: 0 18px;
        outline: none;
        transition: all .22s ease;
    }

    .form-input::placeholder,
    .form-textarea::placeholder{
        color:#9aa7b8;
        font-weight:500;
    }

    .form-select,
    .form-input{
        height: 60px;
    }

    .form-textarea{
        min-height: 170px;
        padding: 18px;
        resize: vertical;
    }

    .form-select:focus,
    .form-input:focus,
    .form-textarea:focus{
        border-color: var(--ck-orange);
        box-shadow: 0 0 0 4px rgba(235,122,47,0.08);
    }

    .switch-panel{
        min-height: 92px;
        border: 1.5px solid var(--ck-line);
        border-radius: var(--ck-radius-lg);
        background: linear-gradient(180deg, #ffffff 0%, #fbfcfe 100%);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 18px 20px;
        cursor: pointer;
        transition: all .22s ease;
    }

    .switch-panel:hover{
        box-shadow: var(--ck-shadow-sm);
        border-color: #c6d3e4;
    }

    .switch-panel-title{
        margin: 0;
        font-size: 16px;
        color: var(--ck-navy);
        font-weight: 800;
    }

    .switch-panel-sub{
        margin: 4px 0 0;
        font-size: 13px;
        color: var(--ck-text-soft);
        font-weight: 500;
    }

    .switch-ui{
        width: 70px;
        height: 38px;
        border-radius: 999px;
        background: #d8e0ec;
        position: relative;
        flex-shrink: 0;
        transition: all .22s ease;
    }

    .switch-ui::before{
        content: "";
        position: absolute;
        top: 4px;
        left: 4px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,.10);
        transition: all .22s ease;
    }

    .toggle-switch input:checked + label .switch-ui{
        background: #ffd7bf;
    }

    .toggle-switch input:checked + label .switch-ui::before{
        left: 36px;
    }

    .upload-grid{
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px 24px;
    }

    .upload-title{
        margin: 0 0 10px;
        font-size: 15px;
        color: var(--ck-navy);
        font-weight: 800;
    }

    .upload-box{
        min-height: 148px;
        border: 1.8px dashed #c6d5e8;
        border-radius: var(--ck-radius-lg);
        background: linear-gradient(180deg, #ffffff 0%, #fbfcfe 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 9px;
        text-align: center;
        padding: 16px;
        cursor: pointer;
        transition: all .22s ease;
    }

    .upload-box:hover{
        transform: translateY(-2px);
        box-shadow: var(--ck-shadow-sm);
        border-color: #a9c0de;
    }

    .upload-box.active{
        border-color: var(--ck-orange);
        background: linear-gradient(180deg, #fffaf6 0%, #fff2e9 100%);
        box-shadow: 0 10px 18px rgba(235,122,47,0.08);
    }

    .upload-icon{
        font-size: 36px;
        color: #88a0c3;
        line-height: 1;
    }

    .upload-text{
        font-size: 15px;
        color: var(--ck-navy-3);
        font-weight: 500;
    }

    .file-name{
        margin-top: 8px;
        font-size: 12px;
        font-weight: 800;
        color: var(--ck-navy);
        word-break: break-word;
    }

    .submit-bar{
        background: linear-gradient(135deg, rgba(255,255,255,.97) 0%, rgba(255,255,255,.93) 100%);
        border: 1px solid var(--ck-line);
        border-radius: 24px;
        box-shadow: var(--ck-shadow-md);
        padding: 18px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
    }

    .submit-btn{
        min-width: 350px;
        height: 70px;
        border: none;
        border-radius: 18px;
        background: linear-gradient(135deg, var(--ck-orange) 0%, var(--ck-orange-2) 100%);
        color: #fff;
        font-size: 19px;
        font-weight: 900;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
        box-shadow: var(--ck-shadow-lg);
        transition: all .22s ease;
    }

    .submit-btn:hover{
        transform: translateY(-2px);
        box-shadow: 0 22px 40px rgba(235,122,47,0.24);
    }

    .submit-note{
        max-width: 500px;
        color: var(--ck-text-soft);
        font-size: 14px;
        font-weight: 500;
        line-height: 1.5;
    }

    .text-danger{
        color: var(--ck-red);
        font-size: 12px;
        margin-top: 8px;
        display: block;
        font-weight: 700;
    }

    .alert-success{
        background: #ecfdf3;
        color: #027a48;
        border: 1px solid #abefc6;
        padding: 12px 14px;
        border-radius: 14px;
        font-weight: 700;
    }

    .alert-error{
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
        padding: 12px 14px;
        border-radius: 14px;
        font-weight: 700;
    }

    .error-list{
        margin: 0;
        padding-left: 18px;
    }

    @media (max-width: 1100px){
        .project-grid,
        .upload-grid{
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 992px){
        .form-grid-2{
            grid-template-columns: 1fr;
        }

        .structure-grid{
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 768px){
        .audit-page{
            padding: 12px 0 22px;
        }

        .top-banner{
            padding: 18px 16px;
            border-radius: 20px;
        }

        .top-banner h1{
            font-size: 22px;
        }

        .step-card{
            padding: 18px 16px;
            border-radius: 20px;
        }

        .step-title-wrap h2{
            font-size: 20px;
        }

        .vendor-bar{
            flex-direction: column;
            align-items: flex-start;
        }

        .project-grid,
        .structure-grid,
        .upload-grid{
            grid-template-columns: 1fr;
        }

        .submit-btn{
            width: 100%;
            min-width: 100%;
            height: 60px;
        }

        .submit-bar{
            padding: 16px;
        }
    }
</style>

@php
    $workType = $workType ?? null;
    $projectTypes = $projectTypes ?? collect();

    $structureTypes = [
        ['name' => 'RCC', 'icon' => 'fa-solid fa-table-cells-large'],
        ['name' => 'Steel', 'icon' => 'fa-solid fa-compass-drafting'],
        ['name' => 'Foundation', 'icon' => 'fa-solid fa-grip-lines'],
    ];

    $auditTypes = [
        ['name' => 'Structural Stability Audit', 'icon' => 'fa-regular fa-shield'],
        ['name' => 'Old / Dilapidated Building Audit', 'icon' => 'fa-solid fa-triangle-exclamation'],
        ['name' => 'Pre-Purchase Structural Audit', 'icon' => 'fa-solid fa-magnifying-glass'],
        ['name' => 'Post-Fire Structural Audit', 'icon' => 'fa-solid fa-fire-flame-curved'],
        ['name' => 'Post-Earthquake / Post-Disaster Audit', 'icon' => 'fa-solid fa-wave-square'],
        ['name' => 'Crack & Distress Assessment Audit', 'icon' => 'fa-solid fa-magnifying-glass-plus'],
    ];

    $deliverables = [
        ['name' => 'Visual Inspection', 'icon' => 'fa-regular fa-eye'],
        ['name' => 'NDT / Testing', 'icon' => 'fa-solid fa-expand'],
        ['name' => 'Structural Assessment', 'icon' => 'fa-regular fa-clipboard'],
        ['name' => 'Stability Certificate', 'icon' => 'fa-regular fa-file-lines'],
        ['name' => 'Repair Recommendation', 'icon' => 'fa-solid fa-wrench'],
        ['name' => 'Repair & Rehabilitation Design', 'icon' => 'fa-solid fa-drafting-compass'],
        ['name' => 'Retrofitting / Strengthening Design', 'icon' => 'fa-solid fa-hard-hat'],
        ['name' => 'Tender / BOQ / Specification Support', 'icon' => 'fa-regular fa-file-lines'],
        ['name' => 'Repair Supervision / QAQC', 'icon' => 'fa-regular fa-circle-check'],
    ];
@endphp

<div class="audit-page">
    <div class="audit-stack">

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

        <div class="top-banner">
            <div class="top-banner-left">
                <div class="top-banner-icon">
                    <i class="fa-solid fa-building-shield"></i>
                </div>
                <div>
                    <h1>Join as a Structural Audit Partner</h1>
                    <p>Show your structural audit expertise, service coverage, and technical capabilities to receive quality project enquiries.</p>
                </div>
            </div>
            <div class="top-badge">Trusted ConstructKaro Partner Onboarding</div>
        </div>

        <form action="{{ route('structural_audit.store') }}" method="POST" enctype="multipart/form-data" id="structuralAuditForm">
            @csrf

            <div class="step-card">
                <div class="step-head">
                    <div class="step-badge"><i class="fa-solid fa-layer-group"></i></div>
                    <div class="step-title-wrap">
                        <h2>Asset Type Expertise</h2>
                        <p>Select all asset types you have experience with</p>
                    </div>
                </div>

                <div class="field-block">
                    <div class="field-label">Find Your Construction Vendor <span class="req">*</span></div>
                    <div class="vendor-bar">
                        <div class="vendor-value">{{ $workType->work_type ?? 'Structural Audit' }}</div>
                        <div class="vendor-chip">{{ $workType->work_type ?? 'Structural Audit' }}</div>
                    </div>
                </div>

                <div class="field-block">
                    <div class="field-label">Project Type <span class="req">*</span></div>
                    <div class="field-sub">Select all project types you have experience in</div>

                    <div class="project-grid">
                        @forelse($projectTypes as $index => $type)
                            <div class="project-item">
                                <input
                                    type="checkbox"
                                    id="project_type_{{ $index }}"
                                    name="project_types[]"
                                    value="{{ $type }}"
                                    {{ in_array($type, old('project_types', [])) ? 'checked' : '' }}
                                >
                                <label for="project_type_{{ $index }}">{{ $type }}</label>
                            </div>
                        @empty
                            <p style="color:red; font-weight:600;">No project types found.</p>
                        @endforelse
                    </div>

                    @error('project_types')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="step-card">
                <div class="section-divider"></div>
                <div class="step-head">
                    <div class="step-badge"><i class="fa-solid fa-diagram-project"></i></div>
                    <div class="step-title-wrap">
                        <h2>Structure Type Expertise</h2>
                        <p>Types of structures you specialize in</p>
                    </div>
                </div>

                <div class="structure-grid">
                    @foreach($structureTypes as $index => $item)
                        <div class="card-option">
                            <input type="checkbox" id="structure_{{ $index }}" name="structure_types[]" value="{{ $item['name'] }}" {{ in_array($item['name'], old('structure_types', [])) ? 'checked' : '' }}>
                            <label for="structure_{{ $index }}">
                                <div class="card-icon"><i class="{{ $item['icon'] }}"></i></div>
                                <div class="card-text">{{ $item['name'] }}</div>
                            </label>
                        </div>
                    @endforeach
                </div>

                @error('structure_types')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="step-card">
                <div class="section-divider"></div>
                <div class="step-head">
                    <div class="step-badge"><i class="fa-solid fa-list-check"></i></div>
                    <div class="step-title-wrap">
                        <h2>Audit Type Expertise</h2>
                        <p>Select all audit types you can perform</p>
                    </div>
                </div>

                <div class="chip-grid">
                    @foreach($auditTypes as $index => $item)
                        <div class="chip-option">
                            <input type="checkbox" id="audit_{{ $index }}" name="audit_types[]" value="{{ $item['name'] }}" {{ in_array($item['name'], old('audit_types', [])) ? 'checked' : '' }}>
                            <label for="audit_{{ $index }}">
                                <i class="{{ $item['icon'] }}"></i>
                                <span>{{ $item['name'] }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>

                @error('audit_types')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="step-card">
                <div class="section-divider"></div>
                <div class="step-head">
                    <div class="step-badge"><i class="fa-solid fa-screwdriver-wrench"></i></div>
                    <div class="step-title-wrap">
                        <h2>Service Scope / Deliverables</h2>
                        <p>What services and deliverables can you provide?</p>
                    </div>
                </div>

                <div class="chip-grid">
                    @foreach($deliverables as $index => $item)
                        <div class="chip-option">
                            <input type="checkbox" id="deliverable_{{ $index }}" name="deliverables[]" value="{{ $item['name'] }}" {{ in_array($item['name'], old('deliverables', [])) ? 'checked' : '' }}>
                            <label for="deliverable_{{ $index }}">
                                <i class="{{ $item['icon'] }}"></i>
                                <span>{{ $item['name'] }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>

                @error('deliverables')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="step-card">
                <div class="section-divider"></div>
                <div class="step-head">
                    <div class="step-badge"><i class="fa-solid fa-briefcase"></i></div>
                    <div class="step-title-wrap">
                        <h2>Technical & Business Information</h2>
                        <p>Operational and compliance details</p>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="field-block">
                        <label class="field-label">Team Size</label>
                        <select class="form-select" name="team_size">
                            <option value="">Select team size</option>
                            <option value="1-5" {{ old('team_size') == '1-5' ? 'selected' : '' }}>1-5</option>
                            <option value="6-10" {{ old('team_size') == '6-10' ? 'selected' : '' }}>6-10</option>
                            <option value="11-25" {{ old('team_size') == '11-25' ? 'selected' : '' }}>11-25</option>
                            <option value="26-50" {{ old('team_size') == '26-50' ? 'selected' : '' }}>26-50</option>
                            <option value="50+" {{ old('team_size') == '50+' ? 'selected' : '' }}>50+</option>
                        </select>
                    </div>

                    <div class="field-block">
                        <label class="field-label">Minimum Project Value Accepted</label>
                        <select class="form-select" name="minimum_project_value">
                            <option value="">Select project value</option>
                            <option value="Below 50K" {{ old('minimum_project_value') == 'Below 50K' ? 'selected' : '' }}>Below 50K</option>
                            <option value="50K - 1L" {{ old('minimum_project_value') == '50K - 1L' ? 'selected' : '' }}>50K - 1L</option>
                            <option value="1L - 5L" {{ old('minimum_project_value') == '1L - 5L' ? 'selected' : '' }}>1L - 5L</option>
                            <option value="5L - 10L" {{ old('minimum_project_value') == '5L - 10L' ? 'selected' : '' }}>5L - 10L</option>
                            <option value="10L+" {{ old('minimum_project_value') == '10L+' ? 'selected' : '' }}>10L+</option>
                        </select>
                    </div>

                    <div class="field-block">
                        <div class="toggle-switch">
                            <input type="checkbox" id="emergency_inspection" name="available_for_emergency_inspection" value="1" {{ old('available_for_emergency_inspection') ? 'checked' : '' }}>
                            <label class="switch-panel" for="emergency_inspection">
                                <div>
                                    <div class="switch-panel-title">Available for Emergency Inspection?</div>
                                    <div class="switch-panel-sub">Urgent site visits within 24-48 hrs</div>
                                </div>
                                <div class="switch-ui"></div>
                            </label>
                        </div>
                    </div>

                    <div class="field-block">
                        <div class="toggle-switch">
                            <input type="checkbox" id="site_visit" name="available_for_site_visit" value="1" {{ old('available_for_site_visit') ? 'checked' : '' }}>
                            <label class="switch-panel" for="site_visit">
                                <div>
                                    <div class="switch-panel-title">Available for Site Visit?</div>
                                    <div class="switch-panel-sub">On-site physical inspection</div>
                                </div>
                                <div class="switch-ui"></div>
                            </label>
                        </div>
                    </div>

                    <div class="field-block">
                        <label class="field-label">GST Number</label>
                        <input type="text" class="form-input" name="gst_number" placeholder="Enter GST number" value="{{ old('gst_number') }}">
                    </div>

                    <div class="field-block">
                        <label class="field-label">PAN Number</label>
                        <input type="text" class="form-input" name="pan_number" placeholder="Enter PAN number" value="{{ old('pan_number') }}">
                    </div>

                    <div class="field-block" style="grid-column: 1 / -1;">
                        <div class="toggle-switch">
                            <input type="checkbox" id="msme_udyam" name="msme_udyam_registered" value="1" {{ old('msme_udyam_registered') ? 'checked' : '' }}>
                            <label class="switch-panel" for="msme_udyam">
                                <div>
                                    <div class="switch-panel-title">MSME / Udyam Registered?</div>
                                    <div class="switch-panel-sub">Micro, Small & Medium Enterprise registration</div>
                                </div>
                                <div class="switch-ui"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="field-block">
                    <div class="upload-grid">
                        <div class="upload-item" id="certificate_wrap">
                            <div class="upload-title">Upload Certificate</div>
                            <label for="certificate_file" class="upload-box">
                                <div class="upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                <div class="upload-text">Click to upload PDF, JPG, PNG</div>
                            </label>
                            <input type="file" id="certificate_file" name="certificate_file">
                            <div class="file-name" id="certificate_file_name"></div>
                        </div>

                        <div class="upload-item" id="company_profile_wrap">
                            <div class="upload-title">Upload Company Profile</div>
                            <label for="company_profile_file" class="upload-box">
                                <div class="upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                <div class="upload-text">Click to upload PDF, DOC</div>
                            </label>
                            <input type="file" id="company_profile_file" name="company_profile_file">
                            <div class="file-name" id="company_profile_file_name"></div>
                        </div>

                        <div class="upload-item" id="logo_wrap">
                            <div class="upload-title">Upload Logo</div>
                            <label for="logo_file" class="upload-box">
                                <div class="upload-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                <div class="upload-text">Click to upload JPG, PNG, SVG</div>
                            </label>
                            <input type="file" id="logo_file" name="logo_file">
                            <div class="file-name" id="logo_file_name"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="step-card">
                <div class="section-divider"></div>
                <div class="step-head">
                    <div class="step-badge"><i class="fa-solid fa-pen"></i></div>
                    <div class="step-title-wrap">
                        <h2>Final Details</h2>
                        <p>Tell us more about your services</p>
                    </div>
                </div>

                <div class="field-block">
                    <label class="field-label">Brief Description of Services</label>
                    <textarea class="form-textarea" name="service_description" placeholder="Describe your core structural audit services, specializations, and key strengths...">{{ old('service_description') }}</textarea>
                </div>

                <div class="field-block">
                    <label class="field-label">Major Cities Covered</label>
                    <input type="text" class="form-input" name="major_cities_covered" placeholder="e.g. Mumbai, Pune, Navi Mumbai, Thane" value="{{ old('major_cities_covered') }}">
                </div>
            </div>

            <div class="submit-bar">
                <button type="submit" class="submit-btn">
                    <i class="fa-regular fa-paper-plane"></i>
                    <span>Submit Structural Audit Profile</span>
                </button>
                <div class="submit-note">
                    By submitting, you agree to ConstructKaro's vendor terms and verification process.
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
            const box = wrapper.querySelector('.upload-box');
            if (this.files && this.files.length > 0) {
                output.textContent = this.files[0].name;
                box.classList.add('active');
            } else {
                output.textContent = '';
                box.classList.remove('active');
            }
        });
    }

    bindFilePreview('certificate_file', 'certificate_file_name', 'certificate_wrap');
    bindFilePreview('company_profile_file', 'company_profile_file_name', 'company_profile_wrap');
    bindFilePreview('logo_file', 'logo_file_name', 'logo_wrap');
</script>

@endsection