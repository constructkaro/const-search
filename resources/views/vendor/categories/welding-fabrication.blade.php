@extends('vendor.layouts.vapp')

@section('title', 'Fabrication Service Provider Form')
@section('page_title', 'Fabrication Service Provider Form')

@section('content')

<style>
    :root{
        --bg: #f4f7fb;
        --white: #ffffff;
        --text: #203047;
        --text-soft: #7b8aa0;
        --muted: #9aa7b8;
        --line: #e5ebf2;
        --line-dark: #d6dee8;
        --primary: #ff6a00;
        --primary-2: #ff8632;
        --primary-soft: #fff3ea;
        --navy: #1d2d44;
        --danger: #dc2626;
        --success: #16a34a;
        --shadow-sm: 0 8px 22px rgba(15, 23, 42, 0.05);
        --shadow-md: 0 14px 35px rgba(15, 23, 42, 0.07);
        --shadow-lg: 0 16px 30px rgba(255,106,0,0.18);
        --radius-xl: 24px;
        --radius-lg: 18px;
        --radius-md: 14px;
    }

    body{
        background:
            radial-gradient(circle at top right, rgba(255,106,0,0.04), transparent 18%),
            linear-gradient(180deg, #f7f9fc 0%, #eef3f7 100%);
    }

    .fab-page{
        max-width: 1180px;
        margin: 0 auto;
        padding: 16px 0 28px;
    }

    .fab-stack{
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .top-banner{
        background: linear-gradient(135deg, #ffffff 0%, #fff8f2 100%);
        border: 1px solid #f2e0d0;
        border-radius: 24px;
        box-shadow: var(--shadow-md);
        padding: 20px 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .top-banner-left{
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .top-banner-icon{
        width: 58px;
        height: 58px;
        border-radius: 18px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-2) 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        box-shadow: 0 14px 28px rgba(255,106,0,0.20);
        flex-shrink: 0;
    }

    .top-banner h1{
        margin: 0;
        font-size: 24px;
        font-weight: 900;
        color: var(--navy);
        line-height: 1.2;
    }

    .top-banner p{
        margin: 5px 0 0;
        color: var(--text-soft);
        font-size: 14px;
        font-weight: 500;
    }

    .top-badge{
        padding: 10px 14px;
        border-radius: 999px;
        background: #fff;
        border: 1px solid #f1dfcf;
        color: var(--primary);
        font-size: 13px;
        font-weight: 800;
        box-shadow: 0 8px 18px rgba(255,106,0,0.06);
    }

    .fab-card{
        background: linear-gradient(180deg, #ffffff 0%, #fcfdff 100%);
        border: 1px solid var(--line);
        border-radius: var(--radius-xl);
        padding: 22px;
        box-shadow: var(--shadow-md);
        position: relative;
        overflow: hidden;
    }

    .fab-card::before{
        content: "";
        position: absolute;
        right: -50px;
        top: -50px;
        width: 160px;
        height: 160px;
        background: radial-gradient(circle, rgba(255,106,0,0.04) 0%, transparent 72%);
        pointer-events: none;
    }

    .section-head{
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
        position: relative;
        z-index: 2;
    }

    .section-icon{
        width: 44px;
        height: 44px;
        border-radius: 14px;
        background: var(--navy);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        flex-shrink: 0;
        box-shadow: 0 10px 18px rgba(29, 45, 68, 0.16);
    }

    .section-title{
        margin: 0;
        font-size: 18px;
        font-weight: 900;
        color: var(--text);
        letter-spacing: .2px;
    }

    .section-sub{
        margin: 3px 0 0;
        font-size: 13px;
        color: var(--text-soft);
        font-weight: 500;
    }

    .divider{
        border: none;
        border-top: 1px solid var(--line);
        margin: 0 0 16px;
    }

    .section-divider{
        height: 4px;
        width: 100%;
        background: linear-gradient(90deg, var(--primary), rgba(255,106,0,0.08));
        border-radius: 999px;
        margin-bottom: 18px;
    }

    .field-block + .field-block{
        margin-top: 22px;
    }

    .field-label,
    .field-title{
        font-size: 15px;
        color: var(--text);
        font-weight: 800;
        margin-bottom: 12px;
    }

    .field-label .req,
    .field-title .req{
        color: var(--danger);
    }

    .field-sub{
        margin: -4px 0 14px;
        color: var(--text-soft);
        font-size: 13px;
        font-weight: 500;
    }

    .field-title small{
        color: var(--muted);
        font-size: 13px;
        font-weight: 700;
    }

    .vendor-bar{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:16px;
        padding:16px 18px;
        border:1.5px solid var(--line-dark);
        border-radius:14px;
        background:linear-gradient(180deg,#ffffff 0%,#fbfcfe 100%);
    }

    .vendor-value{
        font-size:16px;
        font-weight:800;
        color:var(--navy);
    }

    .vendor-chip{
        background:linear-gradient(135deg,var(--primary) 0%, var(--primary-2) 100%);
        color:#fff;
        padding:9px 14px;
        border-radius:999px;
        font-size:13px;
        font-weight:800;
        white-space:nowrap;
    }

    .inner-service-box{
        border: 1px solid #e8eef5;
        border-radius: 18px;
        padding: 16px;
        background: linear-gradient(180deg, #ffffff 0%, #fbfcfe 100%);
    }

    .inner-service-box + .inner-service-box{
        margin-top: 16px;
    }

    .service-grid,
    .project-grid{
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
    }

    .welding-grid{
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .project-item input,
    .option-item input,
    .pill-item input,
    .upload-item input[type="file"]{
        display: none;
    }

    .project-item label{
        min-height: 60px;
        border: 1.5px solid var(--line-dark);
        border-radius: 14px;
        background: #fff;
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 16px;
        cursor: pointer;
        transition: all 0.22s ease;
        font-size: 14px;
        color: var(--text);
        font-weight: 700;
        line-height: 1.3;
    }

    .project-item label::before{
        content: "";
        width: 18px;
        height: 18px;
        border: 2px solid #cbd5e1;
        border-radius: 6px;
        background: #fff;
        flex-shrink: 0;
        transition: all 0.22s ease;
    }

    .project-item label:hover{
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }

    .project-item input:checked + label{
        border-color: var(--primary);
        background: linear-gradient(180deg, #fffaf6 0%, #fff0e6 100%);
        box-shadow: 0 10px 22px rgba(255,106,0,0.10);
    }

    .project-item input:checked + label::before{
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-2) 100%);
        border-color: var(--primary);
        box-shadow: inset 0 0 0 4px #fff;
    }

    .option-label{
        min-height: 108px;
        border: 1.5px solid var(--line-dark);
        border-radius: 18px;
        background: linear-gradient(180deg, #ffffff 0%, #fbfcfd 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-align: center;
        padding: 14px 12px;
        cursor: pointer;
        transition: all 0.22s ease;
        position: relative;
        overflow: hidden;
    }

    .option-label::after{
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255,106,0,0.05), transparent 60%);
        opacity: 0;
        transition: 0.22s ease;
    }

    .option-icon{
        width: 46px;
        height: 46px;
        border-radius: 13px;
        background: #f3f5f8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #71849b;
        position: relative;
        z-index: 2;
        transition: all 0.22s ease;
    }

    .option-text{
        font-size: 14px;
        font-weight: 700;
        color: #59697d;
        line-height: 1.3;
        position: relative;
        z-index: 2;
    }

    .option-item input:checked + .option-label{
        border-color: var(--primary);
        background: linear-gradient(180deg, #fffaf6 0%, #fff0e6 100%);
        box-shadow: 0 10px 22px rgba(255,106,0,0.10);
    }

    .option-item input:checked + .option-label .option-icon{
        background: #ffe9d9;
        color: var(--primary);
    }

    .option-item input:checked + .option-label .option-text{
        color: var(--text);
    }

    .option-item input:checked + .option-label::before{
        content: "\f00c";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        top: 10px;
        right: 10px;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: var(--primary);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        z-index: 3;
        box-shadow: 0 6px 12px rgba(255,106,0,0.18);
    }

    .option-label:hover{
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }

    .option-label:hover::after{
        opacity: 1;
    }

    .pill-grid{
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .pill-item label{
        min-height: 42px;
        padding: 0 18px;
        border: 1.5px solid var(--line-dark);
        border-radius: 999px;
        background: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 14px;
        font-weight: 700;
        color: #68788d;
        transition: all 0.22s ease;
    }

    .pill-item input:checked + label{
        background: linear-gradient(135deg, #ff6a00 0%, #ff8632 100%);
        border-color: var(--primary);
        color: #fff;
        box-shadow: 0 10px 18px rgba(255,106,0,0.18);
    }

    .upload-grid{
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .upload-box{
        min-height: 150px;
        border: 1.8px dashed #d9e2ec;
        border-radius: 18px;
        background: linear-gradient(180deg, #ffffff 0%, #fbfcfd 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 9px;
        text-align: center;
        padding: 18px;
        cursor: pointer;
        transition: all 0.22s ease;
        position: relative;
        overflow: hidden;
    }

    .upload-box::after{
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(255,106,0,0.05), transparent 60%);
        opacity: 0;
        transition: 0.22s ease;
    }

    .upload-icon{
        width: 44px;
        height: 44px;
        border-radius: 13px;
        background: #f4f7fa;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #75879d;
        font-size: 18px;
        position: relative;
        z-index: 2;
    }

    .upload-box h4{
        margin: 0;
        font-size: 15px;
        font-weight: 800;
        color: var(--text);
        position: relative;
        z-index: 2;
    }

    .upload-box p{
        margin: 0;
        font-size: 12px;
        color: #96a3b4;
        font-weight: 700;
        position: relative;
        z-index: 2;
    }

    .upload-box:hover{
        transform: translateY(-2px);
        border-color: #ffc79f;
        box-shadow: var(--shadow-sm);
        background: linear-gradient(180deg, #fffdfb 0%, #fff8f2 100%);
    }

    .upload-box:hover::after{
        opacity: 1;
    }

    .upload-item.active .upload-box{
        border-color: var(--primary);
        background: linear-gradient(180deg, #fffaf6 0%, #fff1e8 100%);
        box-shadow: 0 10px 22px rgba(255,106,0,0.10);
    }

    .upload-item.active .upload-icon{
        background: #ffe9d9;
        color: var(--primary);
    }

    .file-name{
        margin-top: 8px;
        color: var(--primary);
        font-size: 12px;
        font-weight: 800;
        text-align: center;
        word-break: break-word;
    }

    .submit-wrap{
        margin-top: 2px;
    }

    .submit-btn{
        width: 100%;
        min-height: 60px;
        border: none;
        border-radius: 18px;
        background: linear-gradient(135deg, #ff5d00 0%, #ff7c21 100%);
        color: #fff;
        font-size: 18px;
        font-weight: 900;
        box-shadow: 0 16px 30px rgba(255,106,0,0.18);
        transition: all 0.22s ease;
    }

    .submit-btn:hover{
        transform: translateY(-2px);
        box-shadow: 0 20px 34px rgba(255,106,0,0.22);
    }

    .submit-note{
        margin-top: 12px;
        color: var(--muted);
        font-size: 13px;
        font-weight: 700;
        text-align: center;
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

    @media (max-width: 1100px){
        .service-grid,
        .project-grid{
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .welding-grid{
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 768px){
        .top-banner{
            padding: 16px 14px;
            border-radius: 18px;
        }

        .top-banner h1{
            font-size: 20px;
        }

        .fab-card{
            padding: 18px 14px;
            border-radius: 20px;
        }

        .vendor-bar{
            flex-direction: column;
            align-items: flex-start;
        }

        .service-grid,
        .project-grid,
        .upload-grid,
        .welding-grid{
            grid-template-columns: 1fr;
        }

        .pill-grid{
            gap: 8px;
        }

        .pill-item{
            width: 100%;
        }

        .pill-item label{
            width: 100%;
        }

        .submit-btn{
            min-height: 54px;
            font-size: 16px;
        }
    }
</style>

@php
    $oldServiceTypes = old('service_types', []);
    $oldWeldingServices = old('welding_services', []);
    $oldServiceModels = old('service_models', []);
    $oldProjectTypesHandled = old('project_types_handled', []);
    $workType = $workType ?? null;
    $projectTypes = $projectTypes ?? collect();

    $fabricationServices = [
        ['name' => 'Structural Fabrication', 'icon' => 'fa-regular fa-square-plus'],
        ['name' => 'Industrial Fabrication', 'icon' => 'fa-solid fa-industry'],
        ['name' => 'MS / SS Fabrication', 'icon' => 'fa-solid fa-layer-group'],
        ['name' => 'Aluminium Fabrication', 'icon' => 'fa-regular fa-gem'],
        ['name' => 'Gate / Railing', 'icon' => 'fa-solid fa-door-open'],
        ['name' => 'Shed / PEB Structure', 'icon' => 'fa-solid fa-warehouse'],
        ['name' => 'Staircase / Handrail', 'icon' => 'fa-solid fa-arrow-up-right-dots'],
        ['name' => 'Grill / Window', 'icon' => 'fa-regular fa-window-maximize'],
    ];

    $weldingServices = [
        ['name' => 'Welding Services', 'icon' => 'fa-solid fa-fire-flame-curved'],
        ['name' => 'MIG / TIG Welding', 'icon' => 'fa-solid fa-bolt'],
        ['name' => 'Pipeline Welding', 'icon' => 'fa-solid fa-diagram-project'],
    ];

    $serviceModels = [
        'Labour Only',
        'Fabrication Only',
        'Welding Only',
        'Material + Labour',
        'On-site Work',
        'Workshop Work',
        'Turnkey',
    ];

    $handledProjectTypes = [
        ['name' => 'Residential', 'icon' => 'fa-solid fa-house'],
        ['name' => 'Commercial', 'icon' => 'fa-solid fa-building'],
        ['name' => 'Industrial', 'icon' => 'fa-solid fa-industry'],
        ['name' => 'Infrastructure', 'icon' => 'fa-solid fa-landmark'],
        ['name' => 'Interior', 'icon' => 'fa-solid fa-couch'],
        ['name' => 'Renovation', 'icon' => 'fa-solid fa-hammer'],
        ['name' => 'Factory / Warehouse', 'icon' => 'fa-solid fa-warehouse'],
    ];
@endphp

<div class="fab-page">
    <div class="fab-stack">

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
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                </div>
                <div>
                    <h1>Join as a Fabrication Partner</h1>
                    <p>Show your fabrication, welding, and project execution expertise to receive relevant construction enquiries.</p>
                </div>
            </div>
            <div class="top-badge">Trusted ConstructKaro Partner Onboarding</div>
        </div>

        <form action="{{ route('fabrication_service.store') }}" method="POST" enctype="multipart/form-data" id="fabricationForm">
            @csrf

            <div class="fab-card">
                <div class="section-head">
                    <div class="section-icon">
                        <i class="fa-solid fa-gears"></i>
                    </div>
                    <div>
                        <h2 class="section-title">Service Category Details</h2>
                        <p class="section-sub">Select your fabrication and welding expertise</p>
                    </div>
                </div>

                <hr class="divider">

                <div class="field-block">
                    <div class="field-label">Find Your Construction Vendor <span class="req">*</span></div>
                    <div class="vendor-bar">
                        <div class="vendor-value">{{ $workType->work_type ?? 'Fabrication Services' }}</div>
                        <div class="vendor-chip">{{ $workType->work_type ?? 'Fabrication Services' }}</div>
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
                                    id="main_project_type_{{ $index }}"
                                    name="project_types[]"
                                    value="{{ $type }}"
                                    {{ in_array($type, old('project_types', [])) ? 'checked' : '' }}
                                >
                                <label for="main_project_type_{{ $index }}">{{ $type }}</label>
                            </div>
                        @empty
                            <p style="color:red; font-weight:600;">No project types found.</p>
                        @endforelse
                    </div>

                    @error('project_types')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="inner-service-box">
                    <div class="field-title">Fabrication Services <small>(select multiple)</small></div>

                    <div class="service-grid">
                        @foreach($fabricationServices as $index => $service)
                            <div class="option-item">
                                <input
                                    type="checkbox"
                                    id="fabrication_service_{{ $index }}"
                                    name="service_types[]"
                                    value="{{ $service['name'] }}"
                                    {{ in_array($service['name'], $oldServiceTypes) ? 'checked' : '' }}
                                >
                                <label class="option-label" for="fabrication_service_{{ $index }}">
                                    <div class="option-icon">
                                        <i class="{{ $service['icon'] }}"></i>
                                    </div>
                                    <div class="option-text">{{ $service['name'] }}</div>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    @error('service_types')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="inner-service-box">
                    <div class="field-title">Welding Services <small>(select multiple)</small></div>

                    <div class="welding-grid">
                        @foreach($weldingServices as $index => $service)
                            <div class="option-item">
                                <input
                                    type="checkbox"
                                    id="welding_service_{{ $index }}"
                                    name="welding_services[]"
                                    value="{{ $service['name'] }}"
                                    {{ in_array($service['name'], $oldWeldingServices) ? 'checked' : '' }}
                                >
                                <label class="option-label" for="welding_service_{{ $index }}">
                                    <div class="option-icon">
                                        <i class="{{ $service['icon'] }}"></i>
                                    </div>
                                    <div class="option-text">{{ $service['name'] }}</div>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    @error('welding_services')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field-block">
                    <div class="field-title">Service Model</div>

                    <div class="pill-grid">
                        @foreach($serviceModels as $index => $model)
                            <div class="pill-item">
                                <input
                                    type="checkbox"
                                    id="service_model_{{ $index }}"
                                    name="service_models[]"
                                    value="{{ $model }}"
                                    {{ in_array($model, $oldServiceModels) ? 'checked' : '' }}
                                >
                                <label for="service_model_{{ $index }}">{{ $model }}</label>
                            </div>
                        @endforeach
                    </div>

                    @error('service_models')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field-block">
                    <div class="field-title">Project Types Handled</div>

                    <div class="project-grid">
                        @foreach($handledProjectTypes as $index => $type)
                            <div class="option-item">
                                <input
                                    type="checkbox"
                                    id="handled_project_type_{{ $index }}"
                                    name="project_types_handled[]"
                                    value="{{ $type['name'] }}"
                                    {{ in_array($type['name'], $oldProjectTypesHandled) ? 'checked' : '' }}
                                >
                                <label class="option-label" for="handled_project_type_{{ $index }}">
                                    <div class="option-icon">
                                        <i class="{{ $type['icon'] }}"></i>
                                    </div>
                                    <div class="option-text">{{ $type['name'] }}</div>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    @error('project_types_handled')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="fab-card">
                <div class="section-divider"></div>
                <div class="section-head">
                    <div class="section-icon">
                        <i class="fa-solid fa-file-arrow-up"></i>
                    </div>
                    <div>
                        <h2 class="section-title">Upload Documents</h2>
                        <p class="section-sub">Upload your verification documents</p>
                    </div>
                </div>

                <hr class="divider">

                <div class="upload-grid">
                    <div class="upload-item" id="company_wrap">
                        <label for="company_profile" class="upload-box">
                            <div class="upload-icon"><i class="fa-regular fa-file-lines"></i></div>
                            <h4>Company Profile</h4>
                            <p>PDF, JPG or PNG · Max 5MB</p>
                        </label>
                        <input type="file" name="company_profile" id="company_profile">
                        <div class="file-name" id="company_profile_name"></div>
                        @error('company_profile')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="upload-item" id="gst_wrap">
                        <label for="gst_certificate" class="upload-box">
                            <div class="upload-icon"><i class="fa-solid fa-receipt"></i></div>
                            <h4>GST Certificate</h4>
                            <p>PDF, JPG or PNG · Max 5MB</p>
                        </label>
                        <input type="file" name="gst_certificate" id="gst_certificate">
                        <div class="file-name" id="gst_certificate_name"></div>
                        @error('gst_certificate')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="upload-item" id="aadhaar_wrap">
                        <label for="aadhaar_card" class="upload-box">
                            <div class="upload-icon"><i class="fa-regular fa-credit-card"></i></div>
                            <h4>Aadhaar Card</h4>
                            <p>PDF, JPG or PNG · Max 5MB</p>
                        </label>
                        <input type="file" name="aadhaar_card" id="aadhaar_card">
                        <div class="file-name" id="aadhaar_card_name"></div>
                        @error('aadhaar_card')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="upload-item" id="udyam_wrap">
                        <label for="udyam_certificate" class="upload-box">
                            <div class="upload-icon"><i class="fa-solid fa-award"></i></div>
                            <h4>Udyam Certificate</h4>
                            <p>PDF, JPG or PNG · Max 5MB</p>
                        </label>
                        <input type="file" name="udyam_certificate" id="udyam_certificate">
                        <div class="file-name" id="udyam_certificate_name"></div>
                        @error('udyam_certificate')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="submit-wrap">
                <button type="submit" class="submit-btn">Register as Fabrication Partner</button>
                <div class="submit-note">Our team will review your profile and activate your vendor account.</div>
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

    bindFilePreview('company_profile', 'company_profile_name', 'company_wrap');
    bindFilePreview('gst_certificate', 'gst_certificate_name', 'gst_wrap');
    bindFilePreview('aadhaar_card', 'aadhaar_card_name', 'aadhaar_wrap');
    bindFilePreview('udyam_certificate', 'udyam_certificate_name', 'udyam_wrap');

    document.getElementById('fabricationForm').addEventListener('submit', function (e) {
        const serviceTypes = document.querySelectorAll("input[name='service_types[]']:checked").length;
        const serviceModels = document.querySelectorAll("input[name='service_models[]']:checked").length;
        const projectTypesHandled = document.querySelectorAll("input[name='project_types_handled[]']:checked").length;

        if (serviceTypes === 0 || serviceModels === 0 || projectTypesHandled === 0) {
            e.preventDefault();
            alert('Please select at least one option from Fabrication Services, Service Model, and Project Types Handled.');
        }
    });
</script>

@endsection