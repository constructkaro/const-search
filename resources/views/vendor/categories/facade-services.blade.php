@extends('vendor.layouts.vapp')

@section('title', 'Facade Services Provider Form')
@section('page_title', 'Facade Services Provider Form')

@section('content')

<style>
    :root{
        --ck-bg: #f5f7fb;
        --ck-white: #ffffff;

        --ck-navy: #1a2f52;
        --ck-navy-2: #243f6b;
        --ck-navy-3: #6f8098;

        --ck-orange: #f26a00;
        --ck-orange-2: #ff8a2a;
        --ck-orange-soft: #fff3ea;

        --ck-text: #233754;
        --ck-text-soft: #7a8798;
        --ck-muted: #9ca8b8;

        --ck-line: #e3e9f1;
        --ck-line-dark: #d7e0ea;

        --ck-green: #22c55e;

        --ck-shadow-sm: 0 8px 22px rgba(15, 23, 42, 0.05);
        --ck-shadow-md: 0 16px 40px rgba(15, 23, 42, 0.07);
        --ck-shadow-lg: 0 18px 38px rgba(242, 106, 0, 0.20);

        --ck-radius-xl: 28px;
        --ck-radius-lg: 20px;
        --ck-radius-md: 16px;
        --ck-radius-sm: 14px;
    }

    body{
        background: linear-gradient(180deg, #f7f9fc 0%, #eef3f8 100%);
    }

    .facade-page{
        max-width: 1180px;
        margin: 0 auto;
        padding: 18px 0 34px;
    }

    .facade-stack{
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .facade-card{
        background: linear-gradient(180deg, #ffffff 0%, #fcfdff 100%);
        border: 1px solid var(--ck-line);
        border-radius: var(--ck-radius-xl);
        box-shadow: var(--ck-shadow-md);
        padding: 28px 26px 30px;
        position: relative;
        overflow: hidden;
    }

    .facade-card::before{
        content: "";
        position: absolute;
        right: -70px;
        top: -70px;
        width: 220px;
        height: 220px;
        background: radial-gradient(circle, rgba(242,106,0,0.05) 0%, transparent 72%);
        pointer-events: none;
    }

    .section-head{
        display: flex;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 24px;
        position: relative;
        z-index: 2;
    }

    .section-icon{
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

    .section-title-wrap h2{
        margin: 0;
        font-size: 22px;
        line-height: 1.18;
        color: var(--ck-navy);
        font-weight: 900;
        letter-spacing: -.2px;
    }

    .section-title-wrap p{
        margin: 6px 0 0;
        color: var(--ck-text-soft);
        font-size: 15px;
        font-weight: 500;
    }

    .field-block + .field-block{
        margin-top: 26px;
    }

    .field-title{
        margin: 0 0 14px;
        font-size: 16px;
        color: var(--ck-navy);
        font-weight: 800;
    }

    .field-title small{
        color: var(--ck-muted);
        font-weight: 700;
        font-size: 14px;
    }

    .service-grid{
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
    }

    .building-grid{
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 18px;
    }

    .card-option input,
    .pill-option input,
    .upload-item input[type="file"]{
        display: none;
    }

    .card-option label{
        min-height: 138px;
        border: 1.5px solid var(--ck-line-dark);
        border-radius: var(--ck-radius-lg);
        background: linear-gradient(180deg, #ffffff 0%, #fbfcfe 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 14px;
        text-align: center;
        padding: 18px 14px;
        cursor: pointer;
        transition: all .24s ease;
        position: relative;
        overflow: hidden;
    }

    .card-option label:hover{
        transform: translateY(-3px);
        box-shadow: var(--ck-shadow-sm);
        border-color: #cad5e3;
    }

    .card-option label::after{
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(242,106,0,0.06), transparent 60%);
        opacity: 0;
        transition: .24s ease;
    }

    .card-option label:hover::after{
        opacity: 1;
    }

    .card-icon{
        width: 54px;
        height: 54px;
        border-radius: 16px;
        background: #f6f7fb;
        color: #6f7b8d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        transition: all .24s ease;
        position: relative;
        z-index: 2;
    }

    .card-text{
        font-size: 16px;
        line-height: 1.35;
        color: #2b3f60;
        font-weight: 800;
        position: relative;
        z-index: 2;
    }

    .card-option input:checked + label{
        border-color: #f5c9af;
        background: linear-gradient(180deg, #fffaf6 0%, #fff2e9 100%);
        box-shadow: 0 14px 24px rgba(242,106,0,0.10);
    }

    .card-option input:checked + label .card-icon{
        background: #ffe9db;
        color: var(--ck-orange);
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
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: var(--ck-orange);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        z-index: 3;
    }

    .pill-grid{
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
    }

    .pill-option label{
        min-height: 52px;
        padding: 0 22px;
        border-radius: var(--ck-radius-sm);
        border: 1.5px solid var(--ck-line-dark);
        background: linear-gradient(180deg, #ffffff 0%, #fbfcfe 100%);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 15px;
        color: #55667f;
        font-weight: 800;
        transition: all .22s ease;
    }

    .pill-option label:hover{
        transform: translateY(-1px);
        box-shadow: var(--ck-shadow-sm);
    }

    .pill-option input:checked + label{
        border-color: #f5c9af;
        background: linear-gradient(180deg, #fffaf6 0%, #fff2e9 100%);
        color: var(--ck-navy);
        box-shadow: 0 10px 18px rgba(242,106,0,0.08);
    }

    .upload-grid{
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .upload-title{
        margin: 0 0 10px;
        font-size: 15px;
        color: var(--ck-navy);
        font-weight: 800;
    }

    .upload-box{
        min-height: 170px;
        border: 2px dashed #cad5e3;
        border-radius: 18px;
        background: linear-gradient(180deg, #ffffff 0%, #fbfcfe 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-align: center;
        padding: 18px;
        cursor: pointer;
        transition: all .22s ease;
        position: relative;
        overflow: hidden;
    }

    .upload-box:hover{
        transform: translateY(-2px);
        box-shadow: var(--ck-shadow-sm);
        border-color: #b8c8dc;
    }

    .upload-box.active{
        border-color: var(--ck-orange);
        background: linear-gradient(180deg, #fffaf6 0%, #fff2e9 100%);
        box-shadow: 0 10px 18px rgba(242,106,0,0.08);
    }

    .upload-icon{
        font-size: 30px;
        color: #9aa6b6;
        line-height: 1;
    }

    .upload-main{
        font-size: 16px;
        color: var(--ck-navy);
        font-weight: 900;
    }

    .upload-note{
        font-size: 13px;
        color: var(--ck-text-soft);
        font-weight: 500;
    }

    .file-name{
        margin-top: 8px;
        font-size: 12px;
        font-weight: 800;
        color: var(--ck-navy);
        word-break: break-word;
    }

    .cta-wrap{
        text-align: center;
    }

    .cta-btn{
        min-width: 500px;
        height: 84px;
        border: none;
        border-radius: 22px;
        background: linear-gradient(135deg, #ff5b00 0%, #ff7f22 100%);
        color: #fff;
        font-size: 22px;
        font-weight: 900;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        box-shadow: 0 20px 36px rgba(242,106,0,0.22);
        transition: .22s ease;
    }

    .cta-btn:hover{
        transform: translateY(-2px);
        box-shadow: 0 24px 40px rgba(242,106,0,0.26);
    }

    .trust-row{
        margin-top: 24px;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 30px;
    }

    .trust-item{
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #6c7d95;
        font-size: 15px;
        font-weight: 700;
    }

    .trust-item i{
        color: var(--ck-green);
        font-size: 18px;
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

    @media (max-width: 1200px){
        .building-grid{
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .upload-grid{
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 992px){
        .service-grid{
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .building-grid,
        .upload-grid{
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .cta-btn{
            min-width: 100%;
            width: 100%;
        }
    }

    @media (max-width: 768px){
        .facade-page{
            padding: 12px 0 24px;
        }

        .facade-card{
            padding: 18px 16px 22px;
            border-radius: 20px;
        }

        .service-grid,
        .building-grid,
        .upload-grid{
            grid-template-columns: 1fr;
        }

        .section-title-wrap h2{
            font-size: 20px;
        }

        .cta-btn{
            height: 64px;
            font-size: 18px;
        }

        .trust-row{
            gap: 16px;
        }
    }
</style>

<div class="facade-page">
    <div class="facade-stack">

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

        <form action="{{ route('facade_services.store') }}" method="POST" enctype="multipart/form-data" id="facadeForm">
            @csrf

            <div class="facade-card">
                <div class="section-head">
                    <div class="section-icon">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div class="section-title-wrap">
                        <h2>Service Category Details</h2>
                        <p>Select all services you offer</p>
                    </div>
                </div>

                @php
                    $serviceTypes = [
                        ['name' => 'Glass Facade', 'icon' => 'fa-regular fa-glass-water'],
                        ['name' => 'ACP Cladding', 'icon' => 'fa-regular fa-credit-card'],
                        ['name' => 'Aluminium Facade', 'icon' => 'fa-regular fa-window-maximize'],
                        ['name' => 'Curtain Wall', 'icon' => 'fa-regular fa-square'],
                        ['name' => 'Structural Glazing', 'icon' => 'fa-solid fa-grip'],
                        ['name' => 'Spider Glazing', 'icon' => 'fa-regular fa-gem'],
                        ['name' => 'HPL Cladding', 'icon' => 'fa-regular fa-square'],
                        ['name' => 'Stone Cladding', 'icon' => 'fa-regular fa-mountain'],
                        ['name' => 'Metal Cladding', 'icon' => 'fa-regular fa-shield'],
                        ['name' => 'Facade Design', 'icon' => 'fa-solid fa-screwdriver-wrench'],
                        ['name' => 'Facade Execution', 'icon' => 'fa-solid fa-helmet-safety'],
                        ['name' => 'Repair / Maintenance', 'icon' => 'fa-solid fa-wrench'],
                    ];

                    $serviceModels = [
                        'Consultancy Only',
                        'Design Only',
                        'Execution Only',
                        'Design + Execution',
                        'Repair / Maintenance',
                        'Turnkey',
                    ];

                    $buildingTypes = [
                        ['name' => 'Residential', 'icon' => 'fa-solid fa-house'],
                        ['name' => 'Commercial', 'icon' => 'fa-solid fa-building'],
                        ['name' => 'Industrial', 'icon' => 'fa-solid fa-industry'],
                        ['name' => 'Infrastructure', 'icon' => 'fa-solid fa-landmark'],
                        ['name' => 'Interior', 'icon' => 'fa-solid fa-couch'],
                        ['name' => 'Renovation', 'icon' => 'fa-solid fa-hammer'],
                    ];

                    $oldServiceTypes = old('service_types', []);
                    $oldServiceModels = old('service_models', []);
                    $oldBuildingTypes = old('building_types', []);
                @endphp

                <div class="field-block">
                    <div class="field-title">Service Type <small>(select multiple)</small></div>

                    <div class="service-grid">
                        @foreach($serviceTypes as $index => $item)
                            <div class="card-option">
                                <input
                                    type="checkbox"
                                    id="service_type_{{ $index }}"
                                    name="service_types[]"
                                    value="{{ $item['name'] }}"
                                    {{ in_array($item['name'], $oldServiceTypes) ? 'checked' : '' }}
                                >
                                <label for="service_type_{{ $index }}">
                                    <div class="card-icon"><i class="{{ $item['icon'] }}"></i></div>
                                    <div class="card-text">{{ $item['name'] }}</div>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    @error('service_types')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field-block">
                    <div class="field-title">Service Model</div>

                    <div class="pill-grid">
                        @foreach($serviceModels as $index => $model)
                            <div class="pill-option">
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
                    <div class="field-title">Building Types</div>

                    <div class="building-grid">
                        @foreach($buildingTypes as $index => $item)
                            <div class="card-option">
                                <input
                                    type="checkbox"
                                    id="building_type_{{ $index }}"
                                    name="building_types[]"
                                    value="{{ $item['name'] }}"
                                    {{ in_array($item['name'], $oldBuildingTypes) ? 'checked' : '' }}
                                >
                                <label for="building_type_{{ $index }}">
                                    <div class="card-icon"><i class="{{ $item['icon'] }}"></i></div>
                                    <div class="card-text">{{ $item['name'] }}</div>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    @error('building_types')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="facade-card">
                <div class="section-head">
                    <div class="section-icon">
                        <i class="fa-solid fa-file-arrow-up"></i>
                    </div>
                    <div class="section-title-wrap">
                        <h2>Upload Documents</h2>
                        <p>Drag & drop or click to upload</p>
                    </div>
                </div>

                @php
                    $documents = [
                        ['name' => 'company_profile', 'label' => 'Company Profile', 'icon' => 'fa-regular fa-file-lines'],
                        ['name' => 'gst_certificate', 'label' => 'GST Certificate', 'icon' => 'fa-regular fa-file-certificate'],
                        ['name' => 'aadhaar_card', 'label' => 'Aadhaar Card', 'icon' => 'fa-regular fa-credit-card'],
                        ['name' => 'safety_certifications', 'label' => 'Safety Certifications', 'icon' => 'fa-regular fa-shield'],
                        ['name' => 'quality_certifications', 'label' => 'Quality Certifications', 'icon' => 'fa-regular fa-award'],
                    ];
                @endphp

                <div class="upload-grid">
                    @foreach($documents as $doc)
                        <div class="upload-item" id="{{ $doc['name'] }}_wrap">
                            <div class="upload-title">{{ $doc['label'] }}</div>
                            <label for="{{ $doc['name'] }}" class="upload-box">
                                <div class="upload-icon"><i class="{{ $doc['icon'] }}"></i></div>
                                <div class="upload-main">{{ $doc['label'] }}</div>
                                <div class="upload-note">PDF, JPG, PNG (max 5MB)</div>
                            </label>
                            <input type="file" name="{{ $doc['name'] }}" id="{{ $doc['name'] }}">
                            <div class="file-name" id="{{ $doc['name'] }}_name"></div>
                            @error($doc['name'])
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="cta-wrap">
                <button type="submit" class="cta-btn">
                    <i class="fa-regular fa-shield-check"></i>
                    <span>Register as Facade Partner</span>
                </button>

                <div class="trust-row">
                    <div class="trust-item">
                        <i class="fa-solid fa-check"></i>
                        Verified Platform
                    </div>
                    <div class="trust-item">
                        <i class="fa-solid fa-check"></i>
                        Genuine Project Leads
                    </div>
                    <div class="trust-item">
                        <i class="fa-solid fa-check"></i>
                        Easy Vendor Onboarding
                    </div>
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

    [
        'company_profile',
        'gst_certificate',
        'aadhaar_card',
        'safety_certifications',
        'quality_certifications'
    ].forEach(function(name){
        bindFilePreview(name, name + '_name', name + '_wrap');
    });

    document.getElementById('facadeForm').addEventListener('submit', function (e) {
        const serviceTypes = document.querySelectorAll("input[name='service_types[]']:checked").length;
        const serviceModels = document.querySelectorAll("input[name='service_models[]']:checked").length;
        const buildingTypes = document.querySelectorAll("input[name='building_types[]']:checked").length;

        if (serviceTypes === 0 || serviceModels === 0 || buildingTypes === 0) {
            e.preventDefault();
            alert('Please select at least one Service Type, Service Model, and Building Type.');
        }
    });
</script>

@endsection