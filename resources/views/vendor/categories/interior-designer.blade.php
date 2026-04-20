@extends('vendor.layouts.vapp')

@section('title', 'Interior Designer Registration Form')
@section('page_title', 'Interior Designer Registration Form')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root{
        --ck-bg: #f4f7fb;
        --ck-white: #ffffff;
        --ck-navy: #0f173d;
        --ck-navy-2: #1e3766;
        --ck-orange: #eb7a2f;
        --ck-orange-2: #f39a56;
        --ck-text: #182b49;
        --ck-text-soft: #71829b;
        --ck-muted: #99a6b7;
        --ck-line: #e3eaf2;
        --ck-line-dark: #d6dfeb;
        --ck-red: #ef4444;
        --ck-green: #16a34a;
        --ck-shadow-sm: 0 8px 22px rgba(15, 23, 61, 0.05);
        --ck-shadow-md: 0 16px 38px rgba(15, 23, 61, 0.07);
        --ck-shadow-lg: 0 18px 38px rgba(235, 122, 47, 0.20);
        --ck-radius-xl: 28px;
        --ck-radius-md: 16px;
    }

    body{
        background:
            linear-gradient(rgba(15, 23, 61, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(15, 23, 61, 0.03) 1px, transparent 1px),
            linear-gradient(180deg, #f8fafc 0%, #eef3f8 100%);
        background-size: 56px 56px, 56px 56px, auto;
    }

    .vendor-page{
        max-width: 1280px;
        margin: 0 auto;
        padding: 20px 0 36px;
    }

    .vendor-stack{
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .section-card{
        background: linear-gradient(180deg,#ffffff 0%,#fcfdff 100%);
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
    }

    .section-divider{
        height: 4px;
        width: 100%;
        background: linear-gradient(90deg,var(--ck-orange), rgba(235,122,47,0.08));
        border-radius: 999px;
        margin-bottom: 24px;
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
        background: linear-gradient(135deg,#fff4eb 0%,#ffe8d8 100%);
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
        line-height: 1.15;
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

    .form-input,
    .form-select,
    .form-textarea{
        width: 100%;
        border: 1.5px solid var(--ck-line-dark);
        border-radius: var(--ck-radius-md);
        background: #fff;
        color: var(--ck-text);
        font-size: 15px;
        padding: 0 18px;
        outline: none;
        transition: .22s;
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

    .form-input.is-invalid,
    .form-select.is-invalid,
    .form-textarea.is-invalid{
        border-color: var(--ck-red);
        box-shadow: 0 0 0 4px rgba(239,68,68,0.08);
    }

    .error-text{
        margin-top: 8px;
        font-size: 13px;
        color: var(--ck-red);
        font-weight: 600;
    }

    .vendor-bar{
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 16px 18px;
        border: 1.5px solid var(--ck-line-dark);
        border-radius: var(--ck-radius-md);
        background: linear-gradient(180deg,#ffffff 0%,#fbfcfe 100%);
    }

    .vendor-value{
        font-size: 16px;
        font-weight: 800;
        color: var(--ck-navy);
    }

    .vendor-chip{
        background: linear-gradient(135deg,var(--ck-orange) 0%, var(--ck-orange-2) 100%);
        color: #fff;
        padding: 9px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 800;
        white-space: nowrap;
    }

    .project-grid{
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px 20px;
    }

    .check-card input[type="checkbox"]{
        display: none;
    }

    .check-card label{
        min-height: 60px;
        border: 1.5px solid var(--ck-line-dark);
        border-radius: var(--ck-radius-md);
        background: linear-gradient(180deg,#ffffff 0%,#fbfcfe 100%);
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 18px;
        cursor: pointer;
        transition: .22s;
        font-size: 15px;
        color: var(--ck-text);
        font-weight: 700;
        line-height: 1.4;
    }

    .check-card label::before{
        content: "";
        width: 20px;
        height: 20px;
        border-radius: 6px;
        border: 2px solid #c4d0de;
        background: #fff;
        flex-shrink: 0;
        transition: .22s;
    }

    .check-card input:checked + label{
        border-color: #f3c6aa;
        background: linear-gradient(180deg,#fffaf6 0%,#fff2e9 100%);
        box-shadow: 0 10px 18px rgba(235,122,47,0.07);
    }

    .check-card input:checked + label::before{
        background: linear-gradient(135deg,var(--ck-orange) 0%,var(--ck-orange-2) 100%);
        border-color: var(--ck-orange);
        box-shadow: inset 0 0 0 4px #fff;
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

    .upload-input{
        display: none;
    }

    .upload-box-wrap{
        position: relative;
    }

    .upload-box{
        min-height: 92px;
        border: 1.5px solid var(--ck-line-dark);
        border-radius: var(--ck-radius-md);
        background: linear-gradient(180deg,#fff 0%,#fbfcfe 100%);
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 16px;
        cursor: pointer;
        transition: .22s;
    }

    .upload-box:hover{
        border-color: #f2bf9d;
        box-shadow: 0 10px 20px rgba(235,122,47,0.07);
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

    .file-name{
        margin-top: 8px;
        font-size: 13px;
        color: var(--ck-green);
        font-weight: 700;
        word-break: break-word;
    }

    .uploaded-link{
        display: none;
        margin-top: 8px;
        font-size: 13px;
        font-weight: 700;
        color: #eb7a2f;
        text-decoration: none;
    }

    .uploaded-link:hover{
        text-decoration: underline;
    }

    .photo-grid{
        display: grid;
        grid-template-columns: repeat(3,minmax(0,1fr));
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
        position: relative;
        cursor: pointer;
    }

    .photo-preview img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: none;
    }

    .photo-preview .placeholder{
        color: var(--ck-muted);
        font-weight: 700;
        text-align: center;
        padding: 12px;
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
        min-width: 324px;
        height: 58px;
        border: none;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--ck-orange) 0%, var(--ck-orange-2) 100%);
        color: #fff;
        font-size: 15px;
        font-weight: 900;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
        box-shadow: var(--ck-shadow-lg);
        transition: .22s;
        cursor: pointer;
    }

    .submit-btn:hover{
        transform: translateY(-1px);
        box-shadow: 0 22px 42px rgba(235, 122, 47, 0.24);
    }

    .submit-note{
        max-width: 480px;
        color: var(--ck-text-soft);
        font-size: 14px;
        font-weight: 500;
        line-height: 1.5;
    }

    @media (max-width: 1200px){
        .project-grid{
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .photo-grid{
            grid-template-columns: repeat(2,minmax(0,1fr));
        }
    }

    @media (max-width: 992px){
        .form-grid-2,
        .upload-grid-2,
        .photo-grid{
            grid-template-columns: 1fr;
        }

        .project-grid{
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .submit-btn{
            min-width: 100%;
            width: 100%;
        }
    }

    @media (max-width: 768px){
        .vendor-page{
            padding: 12px 0 22px;
        }

        .section-card{
            padding: 18px 16px 22px;
            border-radius: 20px;
        }

        .section-head{
            gap: 12px;
        }

        .section-badge{
            width: 48px;
            height: 48px;
            border-radius: 14px;
            font-size: 20px;
        }

        .section-title-wrap h2{
            font-size: 20px;
        }

        .vendor-bar{
            flex-direction: column;
            align-items: flex-start;
        }

        .project-grid{
            grid-template-columns: 1fr;
        }

        .submit-bar{
            padding: 16px;
        }

        .submit-btn{
            height: 62px;
            font-size: 17px;
        }
    }


    
.form-input,
.form-select,
.form-textarea,
.select2-container--default .select2-selection--single,
.select2-container--default .select2-selection--multiple {
    width: 100% !important;
    border: 2px solid #dbe4f0 !important;
    border-radius: 22px !important;
    background: #fff !important;
    color: #243b64 !important;
    font-size: 18px !important;
    box-shadow: none !important;
    transition: all 0.25s ease;
}

.form-input,
.form-select,
.select2-container--default .select2-selection--single {
    height: 78px !important;
    padding: 0 24px !important;
}

.form-input:focus,
.form-select:focus,
.form-textarea:focus,
.select2-container--default.select2-container--focus .select2-selection--single,
.select2-container--default.select2-container--focus .select2-selection--multiple {
    border-color: #c8d5e6 !important;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.05) !important;
    outline: none !important;
}

.form-textarea {
    min-height: 150px;
    padding: 24px !important;
    resize: vertical;
    line-height: 1.6;
}

.select2-container {
    width: 100% !important;
}

.select2-container--default .select2-selection--single {
    display: flex !important;
    align-items: center !important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #243b64 !important;
    line-height: 74px !important;
    padding-left: 0 !important;
    padding-right: 36px !important;
    font-size: 18px !important;
}

.select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #9aa6b2 !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 78px !important;
    right: 18px !important;
}

.select2-container--default .select2-selection--multiple {
    min-height: 78px !important;
    padding: 12px 18px !important;
    display: flex !important;
    align-items: center;
    flex-wrap: wrap;
}

.select2-container--default .select2-selection--multiple .select2-selection__rendered {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    padding: 0 !important;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background: #eef4ff !important;
    border: 1px solid #c7d7f7 !important;
    color: #243b64 !important;
    border-radius: 999px !important;
    padding: 6px 12px !important;
    font-size: 15px !important;
    margin: 0 !important;
}

.select2-dropdown {
    border: 1px solid #dbe4f0 !important;
    border-radius: 16px !important;
    overflow: hidden;
}

.select2-results__option {
    padding: 12px 16px !important;
    font-size: 16px !important;
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: #172554 !important;
    color: #fff !important;
}
    
</style>

@php
$selectedProjects = json_decode($existingData->project_types ?? '[]', true);
@endphp

<form action="{{ route('interior.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="vendor-page">
        <div class="vendor-stack">

            {{-- Business & Work Details --}}
            <div class="section-card">
                <div class="section-head">
                    <div class="section-badge"><i class="fa-solid fa-couch"></i></div>
                    <div class="section-title-wrap">
                        <h2>Business & Work Details</h2>
                        <p>Select your interior design specialization and project expertise</p>
                    </div>
                </div>

                <div class="field-block">
                    <div class="field-label">Find Your Construction Vendor <span class="req">*</span></div>
                    <div class="vendor-bar">
                        <div class="vendor-value">{{ $workType->work_type ?? 'Interiors' }}</div>
                        <div class="vendor-chip">{{ $workType->work_type ?? 'Interiors' }}</div>
                    </div>
                </div>

                <div class="field-block">
                    <div class="field-label">Project Type <span class="req">*</span></div>
                    <div class="field-sub">Select all project types you have experience in</div>

                    <div class="project-grid">
                        @forelse($projectTypes as $index => $type)
                            <div class="check-card">
                                <input type="checkbox"
                                    id="project_type_{{ $index }}"
                                    name="project_types[]"
                                    value="{{ $type }}"
                                    {{ collect($selectedProjects)->contains($type) ? 'checked' : '' }}>
                                <label for="project_type_{{ $index }}">{{ $type }}</label>
                            </div>
                        @empty
                            <p style="color:red; font-weight:600;">No project types found.</p>
                        @endforelse
                    </div>

                    @error('project_types')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Basic Business Information --}}
            <div class="section-card">
                <div class="section-divider"></div>

                <div class="section-head">
                    <div class="section-badge"><i class="fa-solid fa-building"></i></div>
                    <div class="section-title-wrap">
                        <h2>Basic Business Information</h2>
                        <p>Studio overview and operating details</p>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div>
                        <div class="field-label">Years of Experience <span class="req">*</span></div>
                      
                        <select class="form-select @error('experience_years') is-invalid @enderror" name="experience_years">
                            <option value="" disabled {{ old('experience_years', $existingData->experience_years ?? '') == '' ? 'selected' : '' }}>
                                Select years of experience
                            </option>

                            @foreach($experienceYears as $experience)
                                <option value="{{ $experience->id }}"
                                    {{ old('experience_years', $existingData->experience_years ?? '') == $experience->id ? 'selected' : '' }}>
                                    {{ $experience->experiance ?? $experience->experience }}
                                </option>
                            @endforeach
                        </select>
                       
                    </div>

                    <div>
                        <div class="field-label">Team Size <span class="req">*</span></div>
                         <select class="form-select" name="team_size">
                            <option value="" selected disabled>Select team size</option>
                            @foreach($team_size as $team)
                            <option value="{{ $team->id }}"  {{ old('team_size', $existingData->team_size ?? '') == $team->id ? 'selected' : '' }}>
                                {{ $team->team_size }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- <div>
                        <div class="field-label">City <span class="req">*</span></div>
                         <input type="text" name="city" class="form-input"
                               value="{{ old('city', $existingData->city ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">Pincode <span class="req">*</span></div>
                       <input type="text" class="form-input" name="pincode" class="form-control"
                               value="{{ old('pincode', $existingData->pincode ?? '') }}">
                    </div> -->
                      @php
                    $selectedCityId = old('city_id', $existingData->city_id ?? '');

                    $selectedAreaIds = old('area_ids');
                    if (!$selectedAreaIds) {
                        $selectedAreaIds = !empty($existingData->area_ids)
                            ? json_decode($existingData->area_ids, true)
                            : [];
                    }
                    $selectedAreaIds = is_array($selectedAreaIds) ? $selectedAreaIds : [];

                    $savedPincodes = old('pincode', $existingData->pincode ?? '');
                @endphp


                <div>
                        <div class="field-label">City <span class="req">*</span></div>
                        <select class="form-select" name="city_id" id="city_id">
                            <option value="">Select City</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ $selectedCityId == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <div class="field-label">Area <span class="req">*</span></div>
                        <select class="form-select" name="area_ids[]" id="area_id" multiple="multiple"></select>
                    </div>

                    <div>
                        <div class="field-label">Pincode <span class="req">*</span></div>
                        <textarea
                            class="form-textarea"
                            id="pincode_id"
                            name="pincode"
                            readonly
                            placeholder="Selected area pincodes will appear here"
                        >{{ $savedPincodes }}</textarea>
                    </div>

                    <div>
                        <div class="field-label">Minimum Project Value Handled (₹) <span class="req">*</span></div>
                       <input type="number" step="0.01" name="minimum_project_value" class="form-input"
                               value="{{ old('minimum_project_value', $existingData->minimum_project_value ?? '') }}">
                    </div>
                </div>
            </div>

            {{-- Studio & Compliance Details --}}
            <div class="section-card">
                <div class="section-divider"></div>

                <div class="section-head">
                    <div class="section-badge"><i class="fa-solid fa-id-card"></i></div>
                    <div class="section-title-wrap">
                        <h2>Studio & Compliance Details</h2>
                        <p>Firm details, contact information and registrations</p>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div>
                        <div class="field-label">Studio / Firm Name <span class="req">*</span></div>
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
                        <div class="field-label">Principal Designer Name <span class="req">*</span></div>
                         <input type="text" class="form-input" name="contact_person_designation" placeholder="Enter contact person designation"
                        value="{{ old('contact_person_designation', $existingData->contact_person_designation ?? '') }}">
                    </div>

                   
                    <div>
                        <div class="field-label">PAN Number</div>
                        <input type="text" class="form-input" name="pan_number" placeholder="Enter PAN number"
                        value="{{ old('pan_number', $existingData->pan_number ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">GST Number</div>
                       <input type="text" class="form-input" name="gst_number" placeholder="Enter PAN number"
                        value="{{ old('gst_number', $existingData->gst_number ?? '') }}">
                    </div>

                </div>
            </div>

            {{-- Documents & Portfolio --}}
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
                            <a href="#" class="uploaded-link" id="pan_card_link" target="_blank" style="display:none;">View PAN</a> @if(!empty($existingData->pan_card))
                            
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
                            <a href="#" class="uploaded-link" id="gst_certificate_link" target="_blank" style="display:none;">View GST</a> @if(!empty($existingData->gst_certificate))
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
                            <a href="#" class="uploaded-link" id="aadhaar_card_link" target="_blank" style="display:none;">View Aadhaar</a> @if(!empty($existingData->aadhaar_card))
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
                            <a href="#" class="uploaded-link" id="company_profile_link" target="_blank" style="display:none;">View Certificate</a> @if(!empty($existingData->company_profile))
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

            {{-- Submit --}}
            <div class="submit-bar">
                <button type="submit" class="submit-btn">
                    <i class="fa-regular fa-paper-plane"></i>
                    <span>Submit</span>
                </button>

                <div class="submit-note">
                    By submitting, you agree to ConstructKaro’s designer verification and project lead matching process.
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    function bindFilePreview(inputId, nameId, linkId) {
        const input = document.getElementById(inputId);
        const nameBox = document.getElementById(nameId);
        const linkBox = document.getElementById(linkId);

        if (!input || !linkBox) return;

        input.addEventListener('change', function () {
            const file = this.files[0];

            if (file) {
                const fileUrl = URL.createObjectURL(file);

                if (nameBox) {
                    nameBox.textContent = file.name;
                }

                linkBox.href = fileUrl;
                linkBox.style.display = 'inline-block';
                linkBox.setAttribute('target', '_blank');
            } else {
                if (nameBox) {
                    nameBox.textContent = '';
                }

                linkBox.href = '#';
                linkBox.style.display = 'none';
            }
        });
    }

    bindFilePreview('pan_card', 'pan_card_name', 'pan_card_link');
    bindFilePreview('gst_certificate', 'gst_certificate_name', 'gst_certificate_link');
    bindFilePreview('company_profile', 'company_profile_name', 'company_profile_link');
    bindFilePreview('supporting_documents', 'supporting_documents_name', 'supporting_documents_link');

    document.querySelectorAll('.portfolio-image-input').forEach(function(input, index) {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const imageNumber = index + 1;
            const preview = document.getElementById('portfolio_preview_' + imageNumber);
            const placeholder = document.getElementById('portfolio_placeholder_' + imageNumber);
            const link = document.getElementById('portfolio_link_' + imageNumber);

            if (file) {
                const fileUrl = URL.createObjectURL(file);

                if (preview) {
                    preview.src = fileUrl;
                    preview.style.display = 'block';
                }

                if (placeholder) {
                    placeholder.style.display = 'none';
                }

                if (link) {
                    link.href = fileUrl;
                    link.style.display = 'inline-block';
                    link.setAttribute('target', '_blank');
                }
            } else {
                if (preview) {
                    preview.src = '';
                    preview.style.display = 'none';
                }

                if (placeholder) {
                    placeholder.style.display = 'block';
                }

                if (link) {
                    link.href = '#';
                    link.style.display = 'none';
                }
            }
        });
    });
</script>
<script>
    function bindFilePreview(inputId, fileNameId, linkId) {
        const input = document.getElementById(inputId);
        const fileNameBox = document.getElementById(fileNameId);
        const linkBox = document.getElementById(linkId);

        if (!input) return;

        input.addEventListener('change', function () {
            const file = this.files[0];

            if (file) {
                const fileUrl = URL.createObjectURL(file);

                // green filename clickable
                if (fileNameBox) {
                    fileNameBox.textContent = file.name;
                    fileNameBox.href = fileUrl;
                    fileNameBox.style.display = 'inline-block';
                    fileNameBox.setAttribute('target', '_blank');
                }

                // optional separate view file link
                if (linkBox) {
                    linkBox.href = fileUrl;
                    linkBox.style.display = 'inline-block';
                    linkBox.setAttribute('target', '_blank');
                }
            } else {
                if (fileNameBox) {
                    fileNameBox.textContent = '';
                    fileNameBox.href = '#';
                    fileNameBox.style.display = 'none';
                }

                if (linkBox) {
                    linkBox.href = '#';
                    linkBox.style.display = 'none';
                }
            }
        });
    }

    bindFilePreview('pan_card', 'pan_card_name', 'pan_card_link');
    bindFilePreview('gst_certificate', 'gst_certificate_name', 'gst_certificate_link');
    bindFilePreview('company_profile', 'company_profile_name', 'company_profile_link');
    bindFilePreview('supporting_documents', 'supporting_documents_name', 'supporting_documents_link');
</script>
<script>
$(document).ready(function () {

    let selectedCityId = @json($selectedCityId);
    let selectedAreaIds = @json($selectedAreaIds);

    $('#city_id').select2({
        placeholder: 'Select City',
        width: '100%'
    });

    $('#area_id').select2({
        placeholder: 'Select Area',
        width: '100%',
        closeOnSelect: false
    });

    function loadAreas(cityId, selectedAreas = []) {
        $('#area_id').html('');

        if (!cityId) {
            $('#area_id').trigger('change');
            return;
        }

        $.ajax({
            url: "{{ route('get.areas', ':city_id') }}".replace(':city_id', cityId),
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                let options = '';

                $.each(data, function (index, area) {
                    let isSelected = selectedAreas.includes(area.id.toString()) || selectedAreas.includes(area.id);
                    options += `<option value="${area.id}" ${isSelected ? 'selected' : ''}>${area.name}</option>`;
                });

                $('#area_id').html(options).trigger('change');

                if (selectedAreas.length > 0) {
                    loadPincodes(selectedAreas);
                }
            }
        });
    }

    function loadPincodes(areaIds) {
        if (!areaIds || areaIds.length === 0) {
            $('#pincode_id').val('');
            return;
        }

        $.ajax({
            url: "{{ route('get.pincodes') }}",
            type: 'GET',
            dataType: 'json',
            data: { area_ids: areaIds },
            success: function (data) {
                let uniquePincodes = [...new Set(data)];
                $('#pincode_id').val(uniquePincodes.join(', '));
            }
        });
    }

    $('#city_id').on('change', function () {
        let cityId = $(this).val();
        $('#pincode_id').val('');
        loadAreas(cityId, []);
    });

    $('#area_id').on('change', function () {
        let areaIds = $(this).val();
        loadPincodes(areaIds);
    });

    if (selectedCityId) {
        loadAreas(selectedCityId, selectedAreaIds);
    }
});
</script>
@endsection