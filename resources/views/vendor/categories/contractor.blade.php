@extends('vendor.layouts.vapp')

@section('title', 'Contractor Registration Form')
@section('page_title', 'Contractor Registration Form')

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

        --ck-green: #22c55e;
        --ck-red: #ef4444;

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
            linear-gradient(rgba(15, 23, 61, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(15, 23, 61, 0.03) 1px, transparent 1px),
            linear-gradient(180deg, #f8fafc 0%, #eef3f8 100%);
        background-size: 56px 56px, 56px 56px, auto;
    }

    .contractor-page{
        max-width: 1280px;
        margin: 0 auto;
        padding: 20px 0 36px;
    }

    .contractor-stack{
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .section-card{
        background: linear-gradient(180deg, #ffffff 0%, #fcfdff 100%);
        border: 1px solid var(--ck-line);
        border-radius: var(--ck-radius-xl);
        box-shadow: var(--ck-shadow-md);
        padding: 28px 26px 30px;
        position: relative;
        overflow: hidden;
    }

    .section-card::before{
        content: "";
        position: absolute;
        right: -80px;
        top: -80px;
        width: 220px;
        height: 220px;
        background: radial-gradient(circle, rgba(235,122,47,0.05) 0%, transparent 72%);
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

    .section-badge{
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
        box-shadow: 0 8px 18px rgba(235,122,47,0.08);
    }

    .section-title-wrap h2{
        margin: 0;
        font-size: 22px;
        line-height: 1.15;
        letter-spacing: -.2px;
        color: var(--ck-navy-2);
        font-weight: 900;
    }

    .section-title-wrap p{
        margin: 6px 0 0;
        color: var(--ck-text-soft);
        font-size: 15px;
        font-weight: 500;
    }

    .field-block + .field-block{
        margin-top: 24px;
    }

    .field-label{
        margin: 0 0 12px;
        font-size: 16px;
        color: var(--ck-navy);
        font-weight: 800;
    }

    .field-label .req{
        color: var(--ck-red);
    }

    .field-sub{
        margin: -2px 0 14px;
        font-size: 14px;
        color: var(--ck-text-soft);
        font-weight: 500;
    }

    .form-grid-2{
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px 28px;
    }

    .form-grid-1{
        display: grid;
        grid-template-columns: 1fr;
        gap: 18px;
    }

    .form-input,
    .form-select,
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

    .form-input,
    .form-select{
        height: 58px;
    }

    .form-textarea{
        min-height: 110px;
        resize: vertical;
        padding: 16px 18px;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus{
        border-color: var(--ck-orange);
        box-shadow: 0 0 0 4px rgba(235,122,47,0.08);
    }

    .vendor-bar{
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 16px;
        align-items: center;
        padding: 16px;
        border: 1.5px solid var(--ck-line-dark);
        border-radius: var(--ck-radius-lg);
        background: linear-gradient(180deg, #fff 0%, #fbfcfe 100%);
    }

    .vendor-value{
        font-size: 18px;
        font-weight: 800;
        color: var(--ck-navy);
    }

    .vendor-chip{
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 40px;
        padding: 0 16px;
        border-radius: 999px;
        background: var(--ck-orange-soft);
        color: var(--ck-orange);
        border: 1px solid #ffd4bb;
        font-size: 14px;
        font-weight: 800;
    }

    .project-grid{
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px 20px;
    }

    .check-card input,
    .radio-pill input,
    .upload-box-wrap input[type="file"]{
        display: none;
    }

    .check-card label{
        min-height: 58px;
        border: 1.5px solid var(--ck-line-dark);
        border-radius: var(--ck-radius-md);
        background: linear-gradient(180deg, #ffffff 0%, #fbfcfe 100%);
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 0 18px;
        cursor: pointer;
        transition: all .22s ease;
        font-size: 16px;
        color: var(--ck-text);
        font-weight: 600;
    }

    .check-card label::before{
        content: "";
        width: 20px;
        height: 20px;
        border-radius: 6px;
        border: 2px solid #c4d0de;
        background: #fff;
        flex-shrink: 0;
        transition: .22s ease;
    }

    .check-card label:hover{
        transform: translateY(-1px);
        box-shadow: var(--ck-shadow-sm);
        border-color: #c6d3e4;
    }

    .check-card input:checked + label{
        border-color: #f3c6aa;
        background: linear-gradient(180deg, #fffaf6 0%, #fff2e9 100%);
        box-shadow: 0 10px 18px rgba(235,122,47,0.07);
    }

    .check-card input:checked + label::before{
        background: linear-gradient(135deg, var(--ck-orange) 0%, var(--ck-orange-2) 100%);
        border-color: var(--ck-orange);
        box-shadow: inset 0 0 0 4px #fff;
    }

    .radio-group{
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        align-items: center;
    }

    .radio-pill label{
        display: inline-flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        font-size: 16px;
        color: var(--ck-navy);
        font-weight: 700;
    }

    .radio-pill label::before{
        content: "";
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 2px solid #c4d0de;
        background: #fff;
        transition: .22s ease;
    }

    .radio-pill input:checked + label::before{
        border-color: #2f6fed;
        background: radial-gradient(circle at center, #2f6fed 45%, #fff 47%);
    }

    .upload-grid-2{
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px 20px;
    }

    .upload-title{
        margin: 0 0 8px;
        font-size: 15px;
        color: var(--ck-navy);
        font-weight: 800;
    }

    .upload-box{
        min-height: 92px;
        border: 1.5px solid var(--ck-line-dark);
        border-radius: var(--ck-radius-md);
        background: linear-gradient(180deg, #fff 0%, #fbfcfe 100%);
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 16px;
        cursor: pointer;
        transition: all .22s ease;
    }

    .upload-box:hover{
        transform: translateY(-1px);
        box-shadow: var(--ck-shadow-sm);
    }

    .upload-box.active{
        border-color: var(--ck-orange);
        background: linear-gradient(180deg, #fffaf6 0%, #fff2e9 100%);
    }

    .upload-icon{
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: #f6f7fb;
        color: var(--ck-orange);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .upload-content{
        flex: 1;
    }

    .upload-main{
        font-size: 16px;
        color: var(--ck-navy);
        font-weight: 800;
        margin-bottom: 4px;
    }

    .upload-note{
        font-size: 13px;
        color: var(--ck-text-soft);
        font-weight: 500;
    }

    .uploaded-link{
        margin-top: 8px;
        display: inline-block;
        font-size: 13px;
        font-weight: 700;
        color: #2563eb;
        text-decoration: underline;
    }

    .photo-grid{
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
    }

    .photo-card{
        border: 1px solid var(--ck-line);
        border-radius: 18px;
        background: #fff;
        padding: 14px;
        box-shadow: var(--ck-shadow-sm);
    }

    .photo-preview{
        width: 100%;
        height: 220px;
        border-radius: 14px;
        overflow: hidden;
        background: #f5f7fb;
        border: 1px solid var(--ck-line);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .photo-preview img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .photo-actions{
        margin-top: 12px;
    }

    .photo-link{
        display: inline-block;
        margin-bottom: 12px;
        color: #2563eb;
        font-size: 13px;
        font-weight: 800;
        text-decoration: underline;
    }

    .replace-row{
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 0;
        border: 1.5px solid var(--ck-line-dark);
        border-radius: 14px;
        overflow: hidden;
    }

    .replace-btn{
        border: none;
        background: #fff4eb;
        color: var(--ck-navy);
        padding: 0 16px;
        font-size: 14px;
        font-weight: 800;
        min-height: 46px;
    }

    .replace-row input[type="file"]{
        display: block !important;
        width: 100%;
        border: none;
        padding: 10px 12px;
        font-size: 14px;
        background: #fff;
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
        min-width: 320px;
        height: 68px;
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
        transition: .22s ease;
    }

    .submit-btn:hover{
        transform: translateY(-2px);
        box-shadow: 0 22px 40px rgba(235,122,47,0.24);
    }

    .submit-note{
        max-width: 480px;
        color: var(--ck-text-soft);
        font-size: 14px;
        font-weight: 500;
        line-height: 1.5;
    }

    .section-divider{
        height: 4px;
        width: 100%;
        background: linear-gradient(90deg, var(--ck-orange), rgba(235,122,47,0.08));
        border-radius: 999px;
        margin-bottom: 24px;
    }

    @media (max-width: 1200px){
        .photo-grid{
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 992px){
        .form-grid-2,
        .project-grid,
        .upload-grid-2,
        .photo-grid{
            grid-template-columns: 1fr;
        }

        .submit-btn{
            min-width: 100%;
            width: 100%;
        }
    }

    @media (max-width: 768px){
        .contractor-page{
            padding: 12px 0 22px;
        }

        .section-card{
            padding: 18px 16px 22px;
            border-radius: 20px;
        }

        .section-title-wrap h2{
            font-size: 20px;
        }

        .vendor-bar{
            grid-template-columns: 1fr;
        }
    }
</style>
<style>
    .uploaded-link {
        display: none;
        margin-top: 8px;
        color: #0d6efd;
        font-weight: 600;
        text-decoration: none;
    }

    .uploaded-link:hover {
        text-decoration: underline;
    }

    .upload-box-wrap input[type="file"] {
        display: none;
    }

    .upload-box {
        cursor: pointer;
        border: 1px dashed #cfd4dc;
        border-radius: 12px;
        padding: 16px;
        display: block;
        background: #fff;
    }

    .upload-note.file-name {
        font-size: 13px;
        color: #6c757d;
        margin-top: 4px;
        word-break: break-word;
    }
</style>
@php
$selectedProjects = json_decode($existingData->project_types ?? '[]', true);
@endphp
<form action="{{ route('contractor.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(session('success'))
    <div style="background:#d1fae5; color:#065f46; padding:14px 18px; border-radius:12px; margin-bottom:20px; font-weight:600;">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
        <div style="background:#fee2e2; color:#991b1b; padding:14px 18px; border-radius:12px; margin-bottom:20px; font-weight:600;">
            <ul style="margin:0; padding-left:18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="contractor-page">
        <div class="contractor-stack">

            {{-- SECTION 1 --}}
            <div class="section-card">
                <div class="section-head">
                    <div class="section-badge">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <div class="section-title-wrap">
                        <h2>Business & Work Details</h2>
                        <p>Select your construction category and project expertise</p>
                    </div>
                </div>

            
                <div class="field-block">
                    <div class="field-label">Find Your Construction Vendor <span class="req">*</span></div>
                    <div class="vendor-bar">
                        <div class="vendor-value">{{ $workType->work_type ?? 'Contractor' }}</div>
                        <div class="vendor-chip">{{ $workType->work_type ?? 'Contractor' }}</div>
                    </div>
                </div>

                <div class="field-block">
                    <div class="field-label">Project Type <span class="req">*</span></div>
                    <div class="field-sub">Select all project types you have experience in</div>

                    <div class="project-grid">
                        @forelse($projectTypes as $index => $type)
                            <div class="check-card">
                                <input
                                    type="checkbox"
                                    id="project_type_{{ $index }}"
                                    name="project_types[]"
                                    value="{{ $type }}" {{ in_array($type, old('project_types', $selectedProjects ?? [])) ? 'checked' : '' }}
                                    {{ in_array($type, old('project_types', [])) ? 'checked' : '' }}
                                >
                                <label for="project_type_{{ $index }}">{{ $type }}</label>
                            </div>
                        @empty
                            <p style="color:red; font-weight:600;">No project types found for Contractor.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- SECTION 2 --}}
            <div class="section-card">
                <div class="section-divider"></div>

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
                            <option value="" selected disabled>Select years of experience</option>
                            @foreach($experienceYears as $experience)
                                <option value="{{ $experience->id }}" {{ old('experience_years', $existingData->experience_years ?? '') == $experience->id ? 'selected' : '' }}>
                                    {{ $experience->experiance }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <div class="field-label">Team Size <span class="req">*</span></div>
                        <select class="form-select" name="team_size">
                            <option value="" selected disabled>Select team size</option>
                             @foreach($team_size as $team)
                                <option value="{{ $team->id }}" {{ old('team_size', $existingData->team_size ?? '') == $team->id ? 'selected' : '' }}>
                                    {{ $team->team_size }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    
                    <div>
                        <div class="field-label">City <span class="req">*</span></div>
                        <input type="text" class="form-input" name="city" placeholder="Enter city" value="{{ old('city', $existingData->city ?? '') }}">

                    </div>

                     <div>
                        <div class="field-label">Pincode <span class="req">*</span></div> 
                        <input type="text" class="form-input" name="pincode" placeholder="Enter pincode" value="{{ old('pincode', $existingData->pincode ?? '') }}">

                    </div>

                    <div>
                        <div class="field-label">Accepting projects of minimum value (₹) <span class="req">*</span></div>
                      
                         <input type="text" class="form-input" name="minimum_project_value" value="{{ old('minimum_project_value', $existingData->minimum_project_value ?? '') }}" placeholder="Enter minimum project value">
                    </div>
                </div>
            </div>

            {{-- SECTION 3 --}}
            <div class="section-card">
                <div class="section-divider"></div>

                <div class="section-head">
                    <div class="section-badge">
                        <i class="fa-solid fa-id-card"></i>
                    </div>
                    <div class="section-title-wrap">
                        <h2>Company & Compliance Details</h2>
                        <p>Legal, statutory and contact information</p>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div>
                        <div class="field-label">Company Name <span class="req">*</span></div>
                        <input type="text" class="form-input" name="company_name" placeholder="Enter company name" value="{{ old('company_name', $existingData->company_name ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">Type of Entity <span class="req">*</span></div>
                        <select class="form-select" name="entity_type">
                            <option value="" selected disabled>Select entity type</option>
                            @foreach($entity_type as $entity)
                                <option value="{{ $entity->id }}" {{ old('entity_type', $existingData->entity_type ?? '') == $entity->id ? 'selected' : '' }}>
                                    {{ $entity->entity_type }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div style="grid-column: 1 / -1;">
                        <div class="field-label">Registered Office Address <span class="req">*</span></div>
                       
                         <textarea class="form-textarea" name="registered_address" placeholder="Enter registered office address">{{ old('registered_address', $existingData->registered_address ?? '') }}</textarea>
                    </div>

                    <div>
                        <div class="field-label">Contact Person Designation <span class="req">*</span></div>
                         <input type="text" class="form-input" name="contact_person_designation" placeholder="Enter designation" value="{{ old('contact_person_designation', $existingData->contact_person_designation ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">Contact Person Name</div>
                        
                         <input type="text" class="form-input" name="contact_person_name" value="{{ old('contact_person_name', $existingData->contact_person_name ?? '') }}" placeholder="Enter contact person name">
                    </div>

                    <div>
                        <div class="field-label">PAN Number</div>
                      
                         <input type="text" class="form-input" name="pan_number" placeholder="Enter PAN number" value="{{ old('pan_number', $existingData->pan_number ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">TAN Number</div>
                      
                         <input type="text" class="form-input" name="tan_number" placeholder="Enter TAN number" value="{{ old('tan_number', $existingData->tan_number ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">ESIC Number</div>
                        
                         <input type="text" class="form-input" name="esic_number" placeholder="Enter ESIC number" value="{{ old('esic_number', $existingData->esic_number ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">PF No</div>
                         <input type="text" class="form-input" name="pf_number" placeholder="Enter PF number" value="{{ old('pf_number', $existingData->pf_number ?? '') }}">
                    </div>

                    <div style="grid-column: 1 / -1;">
                        <div class="field-label">MSME/Udyam Registered <span class="req">*</span></div>
                        <div class="radio-group">
                            <div class="radio-pill">
                                <input type="radio" id="msme_yes" name="msme_registered" value="Yes" {{ old('msme_registered', $existingData->msme_registered ?? '') == 'Yes' ? 'checked' : '' }}>
                                <label for="msme_yes">Yes</label>
                            </div>
                            <div class="radio-pill">
                                <input type="radio" id="msme_no" name="msme_registered" value="No" {{ old('msme_registered', $existingData->msme_registered ?? '') == 'No' ? 'checked' : '' }}>
                                <label for="msme_no">No</label>
                            </div>
                        </div>
                    </div>

                    <div style="grid-column: 1 / -1;">
                        <div class="field-label">Upload MSME/Udyam Certificate</div>
                        <div class="upload-box-wrap">
                            <input type="file" id="msme_certificate" name="msme_certificate">
                            <label for="msme_certificate" class="upload-box">
                                <div class="upload-icon"><i class="fa-regular fa-award"></i></div>
                                <div class="upload-content">
                                    <div class="upload-main">Upload MSME/Udyam Certificate</div>
                                    <div class="upload-note">PDF, JPG, PNG up to 20MB</div>
                                </div>
                            </label>
                            <a href="#" class="uploaded-link" id="msme_link" target="_blank" style="display:none;">View MSME</a>
                            @if(!empty($existingData->msme_certificate))
                            <div>
                                <a href="{{ asset('storage/'.$existingData->msme_certificate) }}" target="_blank">
                                    View MSME Certificate
                                </a>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            {{-- SECTION 4 --}}
            <div class="section-card">
                <div class="section-divider"></div>

                <div class="section-head">
                    <div class="section-badge">
                        <i class="fa-solid fa-file-arrow-up"></i>
                    </div>
                    <div class="section-title-wrap">
                        <h2>Documents & Work Proof</h2>
                        <p>Upload legal documents, company profile and work completion evidence</p>
                    </div>
                </div>
                <div class="upload-grid-2">
                    <div>
                        <div class="upload-title">PAN Card <span class="req">*</span> (PDF, max 20 MB)</div>
                        <div class="upload-box-wrap">
                            <input type="file" id="pan_card" name="pan_card" accept=".pdf,.jpg,.jpeg,.png">
                            <label for="pan_card" class="upload-box">
                                <div class="upload-icon"><i class="fa-regular fa-id-card"></i></div>
                                <div class="upload-content">
                                    <div class="upload-main">PAN Card</div>
                                    <div class="upload-note file-name">Choose and upload file</div>
                                </div>
                            </label>
                            <a href="#" class="uploaded-link" id="pan_card_link" target="_blank" style="display:none;">View PAN</a>
                             
                            @if(!empty($existingData->pan_card))
                            <div>
                                <a href="{{ asset('storage/'.$existingData->pan_card) }}" target="_blank">
                                    View PAN Certificate
                                </a>
                            </div>
                            @endif

                        </div>
                    </div>

                    <div>
                        <div class="upload-title">GST Certificate <span class="req">*</span> (PDF, max 20 MB)</div>
                        <div class="upload-box-wrap">
                            <input type="file" id="gst_certificate" name="gst_certificate" accept=".pdf,.jpg,.jpeg,.png">
                            <label for="gst_certificate" class="upload-box">
                                <div class="upload-icon"><i class="fa-regular fa-file-lines"></i></div>
                                <div class="upload-content">
                                    <div class="upload-main">GST Certificate</div>
                                    <div class="upload-note file-name">Choose and upload file</div>
                                </div>
                            </label>
                            <a href="#" class="uploaded-link" id="gst_certificate_link" target="_blank" style="display:none;">View GST</a>
                            @if(!empty($existingData->gst_certificate))
                                <div>
                                    <a href="{{ asset('storage/'.$existingData->gst_certificate) }}" target="_blank">
                                        View GST Certificate
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>

                    <div>
                        <div class="upload-title">Aadhaar Card <span class="req">*</span> (PDF, max 20 MB)</div>
                        <div class="upload-box-wrap">
                            <input type="file" id="aadhaar_card" name="aadhaar_card" accept=".pdf,.jpg,.jpeg,.png">
                            <label for="aadhaar_card" class="upload-box">
                                <div class="upload-icon"><i class="fa-regular fa-address-card"></i></div>
                                <div class="upload-content">
                                    <div class="upload-main">Aadhaar Card</div>
                                    <div class="upload-note file-name">Choose and upload file</div>
                                </div>
                            </label>
                            <a href="#" class="uploaded-link" id="aadhaar_card_link" target="_blank" style="display:none;">View Aadhaar</a>
                            @if(!empty($existingData->aadhaar_card))
                                <div>
                                    <a href="{{ asset('storage/'.$existingData->aadhaar_card) }}" target="_blank">
                                        View Adhar Certificate
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>

                    <div>
                        <div class="upload-title">Company Profile <span class="req">*</span> (PDF, max 20 MB)</div>
                        <div class="upload-box-wrap">
                            <input type="file" id="company_profile" name="company_profile" accept=".pdf,.jpg,.jpeg,.png">
                            <label for="company_profile" class="upload-box">
                                <div class="upload-icon"><i class="fa-regular fa-building"></i></div>
                                <div class="upload-content">
                                    <div class="upload-main">Company Profile</div>
                                    <div class="upload-note file-name">Choose and upload file</div>
                                </div>
                            </label>
                            <a href="#" class="uploaded-link" id="company_profile_link" target="_blank" style="display:none;">View Certificate</a>
                            @if(!empty($existingData->company_profile))
                                <div>
                                    <a href="{{ asset('storage/'.$existingData->company_profile) }}" target="_blank">
                                        View Company Profile
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
               
            </div>

            {{-- SUBMIT --}}
            <div class="submit-bar">
                <button type="submit" class="submit-btn">
                    <i class="fa-regular fa-paper-plane"></i>
                    <span>Submit Contractor Profile</span>
                </button>
                <div class="submit-note">
                    By submitting, you agree to ConstructKaro’s vendor verification process and project lead matching system.
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function setupFilePreview(inputId, linkId) {
        const input = document.getElementById(inputId);
        const link = document.getElementById(linkId);

        if (!input || !link) return;

        input.addEventListener('change', function () {
            const file = this.files[0];
            const fileNameBox = this.closest('.upload-box-wrap').querySelector('.file-name');

            if (file) {
                const fileURL = URL.createObjectURL(file);

                link.href = fileURL;
                link.style.display = 'inline-block';
                link.textContent = 'View File';

                if (fileNameBox) {
                    fileNameBox.textContent = file.name;
                }
            } else {
                link.href = '#';
                link.style.display = 'none';

                if (fileNameBox) {
                    fileNameBox.textContent = 'Choose and upload file';
                }
            }
        });
    }

    setupFilePreview('msme_certificate', 'msme_link');
    setupFilePreview('pan_card', 'pan_card_link');
    setupFilePreview('gst_certificate', 'gst_certificate_link');
    setupFilePreview('aadhaar_card', 'aadhaar_card_link');
    setupFilePreview('company_profile', 'company_profile_link');
</script>
@endsection