@extends('vendor.layouts.vapp')

@section('title', 'Interior Designer Registration Form')
@section('page_title', 'Interior Designer Registration Form')

@section('content')

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
    
</style>

@php
    $workType = $workType ?? null;
    $projectTypes = $projectTypes ?? collect();
    $experienceYears = $experienceYears ?? collect();
    $team_size = $team_size ?? collect();
    $entity_type = $entity_type ?? collect();
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
                            <option value="" disabled {{ old('experience_years') ? '' : 'selected' }}>Select years of experience</option>
                            @foreach($experienceYears as $experience)
                                <option value="{{ $experience->id }}" {{ old('experience_years') == $experience->id ? 'selected' : '' }}>
                                    {{ $experience->experiance ?? $experience->experience }}
                                </option>
                            @endforeach
                        </select>
                        @error('experience_years')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <div class="field-label">Team Size <span class="req">*</span></div>
                        <select class="form-select @error('team_size') is-invalid @enderror" name="team_size">
                            <option value="" disabled {{ old('team_size') ? '' : 'selected' }}>Select team size</option>
                            @foreach($team_size as $team)
                                <option value="{{ $team->id }}" {{ old('team_size') == $team->id ? 'selected' : '' }}>
                                    {{ $team->team_size }}
                                </option>
                            @endforeach
                        </select>
                        @error('team_size')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <div class="field-label">City <span class="req">*</span></div>
                        <input type="text" class="form-input @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" placeholder="Enter city">
                        @error('city')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <div class="field-label">Pincode <span class="req">*</span></div>
                        <input type="text" class="form-input @error('pincode') is-invalid @enderror" name="pincode" value="{{ old('pincode') }}" placeholder="Enter pincode">
                        @error('pincode')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <div class="field-label">Minimum Project Value Handled (₹) <span class="req">*</span></div>
                        <input type="text" class="form-input @error('minimum_project_value') is-invalid @enderror" name="minimum_project_value" value="{{ old('minimum_project_value') }}" placeholder="e.g. 200000">
                        @error('minimum_project_value')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
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
                        <input type="text" class="form-input @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}" placeholder="Enter studio or firm name">
                        @error('company_name')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <div class="field-label">Type of Entity <span class="req">*</span></div>
                        <select class="form-select @error('entity_type') is-invalid @enderror" name="entity_type">
                            <option value="" disabled {{ old('entity_type') ? '' : 'selected' }}>Select entity type</option>
                            @foreach($entity_type as $entity)
                                <option value="{{ $entity->id }}" {{ old('entity_type') == $entity->id ? 'selected' : '' }}>
                                    {{ $entity->entity_type }}
                                </option>
                            @endforeach
                        </select>
                        @error('entity_type')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="grid-column: 1 / -1;">
                        <div class="field-label">Registered Office Address <span class="req">*</span></div>
                        <textarea class="form-textarea @error('registered_address') is-invalid @enderror" name="registered_address" placeholder="Enter registered office address">{{ old('registered_address') }}</textarea>
                        @error('registered_address')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <div class="field-label">Principal Designer Name <span class="req">*</span></div>
                        <input type="text" class="form-input @error('contact_person_name') is-invalid @enderror" name="contact_person_name" value="{{ old('contact_person_name') }}" placeholder="Enter principal designer name">
                        @error('contact_person_name')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <div class="field-label">Designation <span class="req">*</span></div>
                        <input type="text" class="form-input @error('contact_person_designation') is-invalid @enderror" name="contact_person_designation" value="{{ old('contact_person_designation', 'Interior Designer') }}" placeholder="Enter designation">
                        @error('contact_person_designation')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <div class="field-label">PAN Number</div>
                        <input type="text" class="form-input @error('pan_number') is-invalid @enderror" name="pan_number" value="{{ old('pan_number') }}" placeholder="Enter PAN number">
                        @error('pan_number')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <div class="field-label">GST Number</div>
                        <input type="text" class="form-input @error('gst_number') is-invalid @enderror" name="gst_number" value="{{ old('gst_number') }}" placeholder="Enter GST number">
                        @error('gst_number')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <div class="field-label">Design Specialization</div>
                        <input type="text" class="form-input @error('specialization') is-invalid @enderror" name="specialization" value="{{ old('specialization') }}" placeholder="e.g. Modern, Luxury, Minimal, Commercial">
                        @error('specialization')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <div class="field-label">Website / Portfolio Link</div>
                        <input type="text" class="form-input @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}" placeholder="Enter website or portfolio link">
                        @error('website')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Documents & Portfolio --}}
            <div class="section-card">
                <div class="section-divider"></div>

                <div class="section-head">
                    <div class="section-badge"><i class="fa-solid fa-file-arrow-up"></i></div>
                    <div class="section-title-wrap">
                        <h2>Documents & Portfolio</h2>
                        <p>Upload company documents, brochure and portfolio images</p>
                    </div>
                </div>

                <div class="upload-grid-2">
                    <div>
                        <div class="upload-title">PAN Card <span class="req">*</span></div>
                        <div class="upload-box-wrap">
                            <input type="file" class="upload-input" id="pan_card" name="pan_card" accept=".pdf,.jpg,.jpeg,.png">
                            <label class="upload-box" for="pan_card">
                                <div class="upload-icon"><i class="fa-regular fa-id-card"></i></div>
                                <div>
                                    <div class="upload-main">Upload PAN Card</div>
                                    <div class="upload-note">PDF, JPG, PNG up to 20MB</div>
                                </div>
                            </label>
                            <a href="#" class="uploaded-link" id="pan_card_link" target="_blank" style="display:none;">View File</a>
                            <div class="file-name" id="pan_card_name"></div>
                        </div>
                        @error('pan_card')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <div class="upload-title">GST Certificate</div>
                        <div class="upload-box-wrap">
                            <input type="file" class="upload-input" id="gst_certificate" name="gst_certificate" accept=".pdf,.jpg,.jpeg,.png">
                            <label class="upload-box" for="gst_certificate">
                                <div class="upload-icon"><i class="fa-regular fa-file-lines"></i></div>
                                <div>
                                    <div class="upload-main">Upload GST Certificate</div>
                                    <div class="upload-note">PDF, JPG, PNG up to 20MB</div>
                                </div>
                            </label>
                            <a href="#" class="uploaded-link" id="gst_certificate_link" target="_blank" style="display:none;">View File</a>
                            <div class="file-name" id="gst_certificate_name"></div>
                        </div>
                        @error('gst_certificate')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <div class="upload-title">Company Profile / Brochure <span class="req">*</span></div>
                        <div class="upload-box-wrap">
                            <input type="file" class="upload-input" id="company_profile" name="company_profile" accept=".pdf,.jpg,.jpeg,.png">
                            <label class="upload-box" for="company_profile">
                                <div class="upload-icon"><i class="fa-regular fa-building"></i></div>
                                <div>
                                    <div class="upload-main">Upload Brochure</div>
                                    <div class="upload-note">PDF, JPG, PNG up to 20MB</div>
                                </div>
                            </label>
                            <a href="#" class="uploaded-link" id="company_profile_link" target="_blank" style="display:none;">View File</a>
                            <div class="file-name" id="company_profile_name"></div>
                        </div>
                        @error('company_profile')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <div class="upload-title">Client Testimonial / Work Completion Docs</div>
                        <div class="upload-box-wrap">
                            <input type="file" class="upload-input" id="supporting_documents" name="supporting_documents" accept=".pdf,.jpg,.jpeg,.png">
                            <label class="upload-box" for="supporting_documents">
                                <div class="upload-icon"><i class="fa-regular fa-file-circle-check"></i></div>
                                <div>
                                    <div class="upload-main">Upload Supporting Documents</div>
                                    <div class="upload-note">PDF, JPG, PNG up to 20MB</div>
                                </div>
                            </label>
                            <a href="#" class="uploaded-link" id="supporting_documents_link" target="_blank" style="display:none;">View File</a>
                            <div class="file-name" id="supporting_documents_name"></div>
                        </div>
                        @error('supporting_documents')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="field-block">
                    <div class="field-label">Portfolio Images</div>

                    <div class="photo-grid">
                        @for($i = 1; $i <= 3; $i++)
                            <div class="photo-card">
                                <input type="file" class="upload-input portfolio-image-input" id="portfolio_image_{{ $i }}" name="portfolio_images[]" accept=".jpg,.jpeg,.png">

                                <label for="portfolio_image_{{ $i }}" class="photo-preview">
                                    <img id="portfolio_preview_{{ $i }}" src="" alt="Portfolio Preview {{ $i }}">
                                    <div class="placeholder" id="portfolio_placeholder_{{ $i }}">Interior Project {{ $i }}</div>
                                </label>

                                <a href="#" class="uploaded-link" id="portfolio_link_{{ $i }}" target="_blank" style="display:none;">View Image</a>
                            </div>
                        @endfor
                    </div>

                    @error('portfolio_images')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
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

@endsection