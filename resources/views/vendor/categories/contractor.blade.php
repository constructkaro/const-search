@extends('vendor.layouts.vapp')

@section('title', 'Contractor Registration Form')
@section('page_title', 'Contractor Registration Form')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    :root{
        --ck-bg: #f4f7fb;
        --ck-white: #ffffff;
        --ck-navy: #0f173d;
        --ck-navy-2: #1e3766;
        --ck-orange: #eb7a2f;
        --ck-orange-2: #f39a56;
        --ck-orange-soft: #fff4eb;
        --ck-text: #182b49;
        --ck-text-soft: #71829b;
        --ck-line: #e3eaf2;
        --ck-line-dark: #d6dfeb;
        --ck-red: #ef4444;
        --ck-shadow-sm: 0 8px 22px rgba(15, 23, 61, 0.05);
        --ck-shadow-md: 0 16px 38px rgba(15, 23, 61, 0.07);
        --ck-shadow-lg: 0 18px 38px rgba(235, 122, 47, 0.20);
        --ck-radius-xl: 28px;
        --ck-radius-lg: 20px;
        --ck-radius-md: 16px;
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
        display: none;
        margin-top: 8px;
        color: #0d6efd;
        font-weight: 600;
        text-decoration: none;
    }

    .uploaded-link:hover{
        text-decoration: underline;
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

    /* Area loading indicator */
    .area-loading{
        display: none;
        font-size: 13px;
        color: var(--ck-text-soft);
        font-weight: 500;
        margin-top: 6px;
    }
    .area-loading.visible{ display: block; }

    /* Select2 overrides */
    .select2-container{
        width: 100% !important;
    }

    .select2-container .select2-selection--single{
        height: 58px !important;
        border: 1.5px solid var(--ck-line-dark) !important;
        border-radius: var(--ck-radius-md) !important;
        display: flex !important;
        align-items: center !important;
        padding: 0 18px !important;
        background: #fff !important;
    }

    .select2-container .select2-selection--single .select2-selection__rendered{
        color: var(--ck-text) !important;
        line-height: 56px !important;
        padding-left: 0 !important;
    }

    .select2-container .select2-selection--single .select2-selection__arrow{
        height: 56px !important;
        right: 12px !important;
    }

    .select2-container .select2-selection--multiple{
        min-height: 58px !important;
        border: 1.5px solid var(--ck-line-dark) !important;
        border-radius: var(--ck-radius-md) !important;
        background: #fff !important;
        padding: 7px 12px !important;
    }

    .select2-container .select2-selection--multiple .select2-selection__rendered{
        display: flex !important;
        flex-wrap: wrap !important;
        gap: 6px !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .select2-container .select2-selection--multiple .select2-selection__choice{
        background: #eef4ff !important;
        border: 1px solid #c7d8ff !important;
        color: #10204f !important;
        border-radius: 999px !important;
        padding: 4px 10px !important;
        font-size: 14px !important;
        margin-top: 3px !important;
    }

    .select2-container .select2-selection--multiple .select2-selection__choice__remove{
        color: #10204f !important;
        margin-right: 6px !important;
        border-right: none !important;
    }

    .select2-dropdown{
        border: 1px solid var(--ck-line-dark) !important;
        border-radius: 12px !important;
        overflow: hidden;
    }

    .select2-results__option{
        padding: 10px 14px !important;
    }

    .select2-results__option--highlighted{
        background: var(--ck-navy) !important;
        color: #fff !important;
    }

    @media (max-width: 992px){
        .form-grid-2,
        .project-grid,
        .upload-grid-2{
            grid-template-columns: 1fr;
        }

        .submit-btn{
            min-width: 100%;
            width: 100%;
        }
    }

    @media (max-width: 768px){
        .contractor-page{ padding: 12px 0 22px; }
        .section-card{ padding: 18px 16px 22px; border-radius: 20px; }
        .section-title-wrap h2{ font-size: 20px; }
        .vendor-bar{ grid-template-columns: 1fr; }
    }


    /* Agreement Modal */
.agreement-modal-overlay{
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 61, 0.72);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 99999;
    padding: 18px;
}

.agreement-modal-overlay.active{
    display: flex;
}

.agreement-modal{
    width: 100%;
    max-width: 980px;
    max-height: 92vh;
    background: #fff;
    border-radius: 24px;
    box-shadow: 0 30px 90px rgba(0,0,0,0.28);
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.agreement-modal-header{
    padding: 20px 24px;
    background: linear-gradient(135deg, #fff4eb 0%, #ffffff 100%);
    border-bottom: 1px solid #f1dfcf;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 16px;
}

.agreement-modal-header h2{
    margin: 0;
    font-size: 22px;
    color: var(--ck-navy);
    font-weight: 900;
}

.agreement-modal-header p{
    margin: 6px 0 0;
    font-size: 14px;
    color: var(--ck-text-soft);
    font-weight: 500;
}

.agreement-close-btn{
    width: 38px;
    height: 38px;
    border: none;
    border-radius: 50%;
    background: #fff;
    color: var(--ck-navy);
    font-size: 18px;
    cursor: pointer;
    box-shadow: var(--ck-shadow-sm);
}

.agreement-modal-body{
    padding: 24px;
    overflow-y: auto;
    color: #1f2937;
    line-height: 1.65;
    font-size: 14px;
}

.agreement-modal-body h3{
    margin: 18px 0 8px;
    font-size: 17px;
    color: var(--ck-navy);
    font-weight: 900;
}

.agreement-modal-body p{
    margin: 0 0 10px;
}

.agreement-modal-body ul{
    margin: 6px 0 12px 20px;
}

.agreement-title-box{
    text-align: center;
    border: 1px solid #f1dfcf;
    border-radius: 18px;
    background: #fffaf6;
    padding: 16px;
    margin-bottom: 18px;
}

.agreement-title-box h1{
    margin: 0;
    font-size: 22px;
    color: var(--ck-navy);
    font-weight: 900;
}

.agreement-title-box h4{
    margin: 6px 0 0;
    color: var(--ck-orange);
    font-weight: 900;
}

.agreement-checks{
    padding: 18px 24px;
    border-top: 1px solid var(--ck-line);
    background: #fbfcfe;
}

.agreement-check-row{
    display: flex;
    gap: 10px;
    align-items: flex-start;
    margin-bottom: 12px;
    color: var(--ck-text);
    font-size: 14px;
    font-weight: 600;
}

.agreement-check-row input{
    margin-top: 4px;
    width: 18px;
    height: 18px;
    flex-shrink: 0;
}

.agreement-modal-footer{
    padding: 16px 24px;
    border-top: 1px solid var(--ck-line);
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    flex-wrap: wrap;
}

.agreement-cancel-btn,
.agreement-submit-btn{
    height: 48px;
    border-radius: 14px;
    padding: 0 22px;
    font-weight: 900;
    cursor: pointer;
    border: none;
}

.agreement-cancel-btn{
    background: #f3f4f6;
    color: #374151;
}

.agreement-submit-btn{
    background: linear-gradient(135deg, var(--ck-orange), var(--ck-orange-2));
    color: #fff;
    box-shadow: var(--ck-shadow-lg);
}

.agreement-submit-btn:disabled{
    opacity: 0.55;
    cursor: not-allowed;
}

@media(max-width: 768px){
    .agreement-modal{
        max-height: 95vh;
        border-radius: 18px;
    }

    .agreement-modal-header,
    .agreement-modal-body,
    .agreement-checks,
    .agreement-modal-footer{
        padding: 16px;
    }

    .agreement-modal-header h2{
        font-size: 18px;
    }
}

.agreement-status-card{
    background: linear-gradient(180deg, #ffffff 0%, #fbfcfe 100%);
    border: 1.5px solid var(--ck-line-dark);
    border-radius: 18px;
    padding: 18px;
    margin-top: 18px;
}

.agreement-status-title{
    font-size: 16px;
    font-weight: 900;
    color: var(--ck-navy);
    margin-bottom: 14px;
}

.agreement-status-grid{
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 12px;
}

.agreement-status-item{
    min-height: 54px;
    border-radius: 14px;
    border: 1px solid #e5eaf2;
    background: #fff;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    font-size: 14px;
    font-weight: 800;
    color: #64748b;
}

.agreement-status-item.accepted{
    background: #ecfdf3;
    border-color: #abefc6;
    color: #027a48;
}

.agreement-status-item.pending{
    background: #fff7ed;
    border-color: #fed7aa;
    color: #c2410c;
}

.agreement-status-icon{
    width: 26px;
    height: 26px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.agreement-status-item.accepted .agreement-status-icon{
    background: #16a34a;
    color: #fff;
}

.agreement-status-item.pending .agreement-status-icon{
    background: #f97316;
    color: #fff;
}

@media(max-width: 768px){
    .agreement-status-grid{
        grid-template-columns: 1fr;
    }
}
</style>
@php
    $termsAccepted = (int)($existingData->agreement_terms_accepted ?? 0) === 1;
    $privacyAccepted = (int)($existingData->privacy_policy_accepted ?? 0) === 1;
    $newsletterAccepted = (int)($existingData->newsletter_opt_in ?? 0) === 1;
@endphp
@php
    $selectedProjects = json_decode($existingData->project_types ?? '[]', true);

    /* ── Multi-city / area pre-fill ── */
    $selectedCityIds = old('city_ids', !empty($existingData->city_ids)
        ? json_decode($existingData->city_ids, true)
        : []);
    $selectedCityIds = is_array($selectedCityIds) ? array_map('strval', $selectedCityIds) : [];

    $selectedAreaIds = old('area_ids', !empty($existingData->area_ids)
        ? json_decode($existingData->area_ids, true)
        : []);
    $selectedAreaIds = is_array($selectedAreaIds) ? array_map('strval', $selectedAreaIds) : [];

    $savedPincodes = old('pincode', $existingData->pincode ?? '');
@endphp
<div class="agreement-status-card">
    <div class="agreement-status-title">Agreement Acceptance Status</div>

    <div class="agreement-status-grid">

        <div class="agreement-status-item {{ $termsAccepted ? 'accepted' : 'pending' }}">
            <span class="agreement-status-icon">
                <i class="fa-solid {{ $termsAccepted ? 'fa-check' : 'fa-clock' }}"></i>
            </span>
            <span>
                Terms & Conditions {{ $termsAccepted ? 'Accepted' : 'Pending' }}
            </span>
        </div>

        <div class="agreement-status-item {{ $privacyAccepted ? 'accepted' : 'pending' }}">
            <span class="agreement-status-icon">
                <i class="fa-solid {{ $privacyAccepted ? 'fa-check' : 'fa-clock' }}"></i>
            </span>
            <span>
                Privacy Policy {{ $privacyAccepted ? 'Accepted' : 'Pending' }}
            </span>
        </div>

        <div class="agreement-status-item {{ $newsletterAccepted ? 'accepted' : 'pending' }}">
            <span class="agreement-status-icon">
                <i class="fa-solid {{ $newsletterAccepted ? 'fa-check' : 'fa-minus' }}"></i>
            </span>
            <span>
                Newsletter {{ $newsletterAccepted ? 'Accepted' : 'Optional' }}
            </span>
        </div>

    </div>

    @if(!empty($existingData->agreement_accepted_at))
        <small style="display:block;margin-top:12px;color:#71829b;font-weight:600;">
            Accepted At: {{ \Carbon\Carbon::parse($existingData->agreement_accepted_at)->format('d M Y, h:i A') }}
        </small>
    @endif
</div>
<!-- <form action="{{ route('contractor.store') }}" method="POST" enctype="multipart/form-data"> -->
    <form action="{{ route('contractor.store') }}" method="POST" enctype="multipart/form-data" id="contractorRegisterForm">
    @csrf

    <input type="hidden" name="agreement_terms_accepted" id="agreement_terms_accepted" value="{{ $termsAccepted ? 1 : 0 }}">
<input type="hidden" name="privacy_policy_accepted" id="privacy_policy_accepted" value="{{ $privacyAccepted ? 1 : 0 }}">
<input type="hidden" name="newsletter_opt_in" id="newsletter_opt_in" value="{{ $newsletterAccepted ? 1 : 0 }}">
<input type="hidden" name="agreement_accepted_at" id="agreement_accepted_at" value="{{ $existingData->agreement_accepted_at ?? '' }}">

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

            {{-- ── Business & Work Details ── --}}
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
                                    value="{{ $type }}"
                                    {{ in_array($type, old('project_types', $selectedProjects ?? [])) ? 'checked' : '' }}
                                >
                                <label for="project_type_{{ $index }}">{{ $type }}</label>
                            </div>
                        @empty
                            <p style="color:red; font-weight:600;">No project types found for Contractor.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- ── Basic Business Information ── --}}
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
                    {{-- Experience --}}
                    <div>
                        <div class="field-label">Years of Experience <span class="req">*</span></div>
                        <select class="form-select" name="experience_years" id="experience_years">
                            <option value="" disabled selected>Select years of experience</option>
                            @foreach($experienceYears as $experience)
                                <option value="{{ $experience->id }}"
                                    {{ old('experience_years', $existingData->experience_years ?? '') == $experience->id ? 'selected' : '' }}>
                                    {{ $experience->experiance }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Team Size --}}
                    <div>
                        <div class="field-label">Team Size <span class="req">*</span></div>
                        <select class="form-select" name="team_size">
                            <option value="" disabled selected>Select team size</option>
                            @foreach($team_size as $team)
                                <option value="{{ $team->id }}"
                                    {{ old('team_size', $existingData->team_size ?? '') == $team->id ? 'selected' : '' }}>
                                    {{ $team->team_size }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- City — multiple --}}
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
                    </div>

                    {{-- Area — multiple, loaded via AJAX --}}
                    <div>
                        <div class="field-label">Area <span class="req">*</span></div>
                        <select class="form-select" name="area_ids[]" id="area_ids" multiple required>
                            {{-- Pre-populate IDs on validation failure; JS will refresh with names --}}
                            @foreach($selectedAreaIds as $aId)
                                <option value="{{ $aId }}" selected>{{ $aId }}</option>
                            @endforeach
                        </select>
                        <small class="area-loading" id="areaLoading">
                            <i class="fa-solid fa-spinner fa-spin"></i> Loading areas…
                        </small>
                    </div>

                    {{-- Pincode --}}
                    <div>
                        <div class="field-label">Pincode <span class="req">*</span></div>
                        <textarea
                            class="form-textarea"
                            id="pincode_id"
                            name="pincode"
                            readonly
                            placeholder="Pincodes auto-fill from selected areas"
                        >{{ $savedPincodes }}</textarea>
                    </div>

                    {{-- Minimum Project Value --}}
                    <div>
                        <div class="field-label">Accepting projects of minimum value (₹) <span class="req">*</span></div>
                        <input
                            type="text"
                            class="form-input"
                            name="minimum_project_value"
                            value="{{ old('minimum_project_value', $existingData->minimum_project_value ?? '') }}"
                            placeholder="Enter minimum project value"
                        >
                        <small class="text-muted">
                            Please enter amount in numbers only. Example: 500000 for ₹5 Lakhs.
                        </small>
                    </div>
                </div>
            </div>

            {{-- ── Company & Compliance Details ── --}}
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
                        <input type="text" class="form-input" name="company_name" placeholder="Enter company name"
                               value="{{ old('company_name', $existingData->company_name ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">Type of Entity <span class="req">*</span></div>
                        <select class="form-select" name="entity_type">
                            <option value="" disabled selected>Select entity type</option>
                            @foreach($entity_type as $entity)
                                <option value="{{ $entity->id }}"
                                    {{ old('entity_type', $existingData->entity_type ?? '') == $entity->id ? 'selected' : '' }}>
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
                        <input type="text" class="form-input" name="contact_person_designation" placeholder="Enter designation"
                               value="{{ old('contact_person_designation', $existingData->contact_person_designation ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">Contact Person Name</div>
                        <input type="text" class="form-input" name="contact_person_name" placeholder="Enter contact person name"
                               value="{{ old('contact_person_name', $existingData->contact_person_name ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">PAN Number</div>
                        <input type="text" class="form-input" name="pan_number" placeholder="Enter PAN number"
                               value="{{ old('pan_number', $existingData->pan_number ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">TAN Number</div>
                        <input type="text" class="form-input" name="tan_number" placeholder="Enter TAN number"
                               value="{{ old('tan_number', $existingData->tan_number ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">ESIC Number</div>
                        <input type="text" class="form-input" name="esic_number" placeholder="Enter ESIC number"
                               value="{{ old('esic_number', $existingData->esic_number ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">PF No</div>
                        <input type="text" class="form-input" name="pf_number" placeholder="Enter PF number"
                               value="{{ old('pf_number', $existingData->pf_number ?? '') }}">
                    </div>

                    <div style="grid-column: 1 / -1;">
                        <div class="field-label">MSME/Udyam Registered <span class="req">*</span></div>
                        <div class="radio-group">
                            <div class="radio-pill">
                                <input type="radio" id="msme_yes" name="msme_registered" value="Yes"
                                    {{ old('msme_registered', $existingData->msme_registered ?? '') == 'Yes' ? 'checked' : '' }}>
                                <label for="msme_yes">Yes</label>
                            </div>
                            <div class="radio-pill">
                                <input type="radio" id="msme_no" name="msme_registered" value="No"
                                    {{ old('msme_registered', $existingData->msme_registered ?? '') == 'No' ? 'checked' : '' }}>
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
                                    <div class="upload-note file-name">PDF, JPG, PNG up to 20MB</div>
                                </div>
                            </label>
                            <a href="#" class="uploaded-link" id="msme_link" target="_blank">View MSME</a>
                            @if(!empty($existingData->msme_certificate))
                                <div><a href="{{ asset('storage/'.$existingData->msme_certificate) }}" target="_blank">View MSME Certificate</a></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Documents & Work Proof ── --}}
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
                            <a href="#" class="uploaded-link" id="pan_card_link" target="_blank">View PAN</a>
                            @if(!empty($existingData->pan_card))
                                <div><a href="{{ asset('storage/'.$existingData->pan_card) }}" target="_blank">View PAN Certificate</a></div>
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
                            <a href="#" class="uploaded-link" id="gst_certificate_link" target="_blank">View GST</a>
                            @if(!empty($existingData->gst_certificate))
                                <div><a href="{{ asset('storage/'.$existingData->gst_certificate) }}" target="_blank">View GST Certificate</a></div>
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
                            <a href="#" class="uploaded-link" id="aadhaar_card_link" target="_blank">View Aadhaar</a>
                            @if(!empty($existingData->aadhaar_card))
                                <div><a href="{{ asset('storage/'.$existingData->aadhaar_card) }}" target="_blank">View Aadhaar Certificate</a></div>
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
                            <a href="#" class="uploaded-link" id="company_profile_link" target="_blank">View Certificate</a>
                            @if(!empty($existingData->company_profile))
                                <div><a href="{{ asset('storage/'.$existingData->company_profile) }}" target="_blank">View Company Profile</a></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Submit Bar ── --}}
            <div class="submit-bar">
               <button type="button" class="submit-btn" id="openAgreementBtn">
    <i class="fa-regular fa-paper-plane"></i>
    <span>Submit Contractor Profile</span>
</button>
                <div class="submit-note">
                    By submitting, you agree to ConstructKaro's vendor verification process and project lead matching system.
                </div>
            </div>

        </div>
    </div>
</form>
@php
    $agreementDate = now()->format('d F Y');
    $agreementPartnerName = old('company_name', $existingData->company_name ?? 'Execution Partner Company Name');
    $agreementPartnerAddress = old('registered_address', $existingData->registered_address ?? 'Partner Office Address');
    $agreementPartnerRole = $workType->work_type ?? 'Execution Partner';
@endphp

<!-- <div class="agreement-modal-overlay" id="agreementModal">
    <div class="agreement-modal">

        <div class="agreement-modal-header">
            <div>
                <h2>Project Execution & Representation Agreement</h2>
                <p>Please read and accept the agreement before submitting your profile.</p>
            </div>
            <button type="button" class="agreement-close-btn" id="closeAgreementBtn">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="agreement-modal-body">
            <div class="agreement-title-box">
                <h1>CONSTRUCTKARO</h1>
                <h4>PROJECT EXECUTION & REPRESENTATION AGREEMENT</h4>
                <p>This Agreement is executed on <strong>{{ $agreementDate }}</strong></p>
            </div>

            <h3>1. PARTIES</h3>
            <p>
                <strong>Swarajya Construction Private Limited</strong>, a company incorporated under the Companies Act, 2013,
                having its registered office at Crescent Pearl B, B-G/1, Veena Nagar, Near St. Anthony Church,
                Katrang Road, Khopoli-410203, operating under the brand name <strong>“ConstructKaro”</strong>
                shall hereinafter be referred to as <strong>“ConstructKaro”</strong>.
            </p>

            <p>
                AND
            </p>

            <p>
                <strong>{{ $agreementPartnerName }}</strong>, having its principal office at
                <strong>{{ $agreementPartnerAddress }}</strong>, shall hereinafter be referred to as
                <strong>“{{ $agreementPartnerRole }}”</strong>.
            </p>

            <p>
                ConstructKaro and {{ $agreementPartnerRole }} are individually referred to as a “Party”
                and collectively as the “Parties.”
            </p>

            <h3>2. PURPOSE & NATURE OF PLATFORM</h3>
            <p>
                ConstructKaro provides construction and project management services, overseeing the execution
                of construction projects under its brand and contractual responsibility.
            </p>
            <p>
                The {{ $agreementPartnerRole }} agrees to execute assigned work as per specifications provided
                by ConstructKaro, adhering to quality standards, timelines, and project-specific requirements.
            </p>
            <p>
                All projects shall be executed under the ConstructKaro brand. The {{ $agreementPartnerRole }}
                shall represent the work exclusively under ConstructKaro unless otherwise agreed in writing.
            </p>
            <p>
                ConstructKaro shall remain the primary contracting party with the customer, and the
                {{ $agreementPartnerRole }} shall not directly deal with the customer without prior written consent.
            </p>

            <h3>3. INDEPENDENT EXECUTION PARTNER STATUS</h3>
            <p>
                The {{ $agreementPartnerRole }} is engaged as an independent execution partner for assigned works.
                Nothing in this Agreement shall create a partnership, joint venture, employer-employee relationship,
                or agency except limited representation authorized by ConstructKaro.
            </p>
            <p>The {{ $agreementPartnerRole }} shall be responsible for:</p>
            <ul>
                <li>Deployment and management of manpower and labour.</li>
                <li>Compliance with applicable labour laws, statutory requirements, and regulations.</li>
                <li>Payment of wages, PF, ESIC, insurance, and other statutory dues.</li>
                <li>Site execution, supervision, safety, and operational control.</li>
            </ul>

            <h3>4. EXECUTION PARTNER OBLIGATIONS</h3>
            <ul>
                <li>Maintain all necessary licenses, registrations, GST compliance, and statutory approvals.</li>
                <li>Execute work as per scope, drawings, BOQ, specifications, and timelines approved by ConstructKaro.</li>
                <li>Ensure site safety, labour welfare, and compliance with applicable laws.</li>
                <li>Deploy qualified manpower, tools, and resources required for timely execution.</li>
                <li>Follow all instructions and execution guidelines issued by ConstructKaro.</li>
                <li>Not represent its own brand before the customer unless approved in writing.</li>
                <li>Not directly contact, negotiate, or enter into any agreement with the customer.</li>
                <li>Maintain confidentiality of project details, customer information, drawings, BOQs, and rates.</li>
                <li>Not subcontract or assign work without prior written approval from ConstructKaro.</li>
            </ul>

            <h3>5. COMMERCIAL TERMS & PAYMENT STRUCTURE</h3>
            <p>
                ConstructKaro shall share the project BOQ, scope, drawings, and specifications with the
                {{ $agreementPartnerRole }} for submission of base rates.
            </p>
            <p>
                ConstructKaro shall have the exclusive right to determine final project pricing to be offered
                to the customer, including its margin, service charges, or commercial adjustments.
            </p>
            <p>
                All billing to the customer shall be done solely by ConstructKaro. The {{ $agreementPartnerRole }}
                shall not raise any invoice directly to the customer.
            </p>
            <p>
                Payments shall be released to the {{ $agreementPartnerRole }} on a bill-to-bill basis, subject
                to receipt of corresponding payment from the customer and quality approval.
            </p>

            <h3>6. QUALITY CHECK & PAYMENT RELEASE</h3>
            <p>
                ConstructKaro may assign a Quality Check Officer to monitor and verify the work performed.
                Payment shall be released only after inspection, verification, and approval by ConstructKaro.
            </p>

            <h3>7. NO GUARANTEE & RISK ACKNOWLEDGEMENT</h3>
            <p>ConstructKaro does not guarantee:</p>
            <ul>
                <li>Allocation or continuity of any project.</li>
                <li>Specific project size, value, or volume of work.</li>
                <li>Timely payments from the customer.</li>
                <li>Changes in project scope, timelines, or site conditions.</li>
            </ul>

            <h3>8. NON-CIRCUMVENTION & NON-SOLICITATION</h3>
            <p>
                The {{ $agreementPartnerRole }} shall not directly or indirectly contact, engage, solicit,
                negotiate, or enter into any agreement with customers introduced, assigned, or handled by
                ConstructKaro except through ConstructKaro.
            </p>
            <p>
                This restriction shall remain valid during the term of this Agreement and for thirty-six (36)
                months from completion or termination. In case of breach, the {{ $agreementPartnerRole }} shall
                be liable to pay liquidated damages equal to 20% of the total project value or ₹5,00,000,
                whichever is higher.
            </p>

            <h3>9. CONFIDENTIALITY & DATA PROTECTION</h3>
            <p>
                All information shared by ConstructKaro, including project details, pricing, BOQs, drawings,
                specifications, customer information, and commercial terms, shall be treated as strictly confidential.
            </p>
            <p>
                The {{ $agreementPartnerRole }} shall comply with applicable data protection laws, including the
                Digital Personal Data Protection Act, 2023.
            </p>

            <h3>10. INTELLECTUAL PROPERTY & BRANDING</h3>
            <p>
                ConstructKaro shall retain exclusive ownership of its brand name, logo, trademarks, platform,
                systems, data, documents, drawings, BOQs, and related intellectual property.
            </p>
            <p>
                The {{ $agreementPartnerRole }} shall not use ConstructKaro’s brand, logo, or project content
                for marketing or commercial purposes without prior written consent.
            </p>

            <h3>11. LIABILITY & INDEMNITY</h3>
            <p>
                The {{ $agreementPartnerRole }} shall indemnify and hold harmless ConstructKaro, its directors,
                employees, and representatives from claims, losses, damages, penalties, disputes, defective work,
                delay, negligence, third-party claims, or statutory non-compliance.
            </p>

            <h3>12. DISPUTE HANDLING</h3>
            <p>
                Customer-related communication, disputes, and claims shall be handled exclusively by ConstructKaro.
                Any dispute between ConstructKaro and the {{ $agreementPartnerRole }} shall first be attempted to
                be resolved amicably within thirty (30) days.
            </p>
            <p>
                If unresolved, the dispute shall be referred to arbitration under the Arbitration & Conciliation Act, 1996.
                The seat of arbitration shall be Khalapur Court and the language shall be English.
            </p>

            <h3>13. TERMINATION</h3>
            <p>
                Either Party may terminate this Agreement by giving seven (7) days’ prior written notice.
                ConstructKaro may terminate immediately in case of breach, poor quality, delay, misconduct,
                fraud, negligence, confidentiality breach, or non-circumvention breach.
            </p>

            <h3>14. GOVERNING LAW & JURISDICTION</h3>
            <p>
                This Agreement shall be governed by the laws of India. Courts at Khalapur, Maharashtra shall
                have exclusive jurisdiction.
            </p>

            <h3>15. DIGITAL ACCEPTANCE</h3>
            <p>
                This Agreement may be executed by digital signature, click-wrap acceptance, or electronic confirmation.
                Such execution shall be legally valid under the Information Technology Act, 2000.
            </p>

            <h3>16. FINAL UNDERSTANDING</h3>
            <p>
                This Agreement constitutes the entire understanding between the Parties. If any clause is held invalid,
                the remaining clauses shall continue to be enforceable.
            </p>
        </div>

        <div class="agreement-checks">
            <label class="agreement-check-row">
                <input type="checkbox" id="agreeTerms">
                <span>I have read, understood, and agree to the Terms & Conditions of this Project Execution Agreement.</span>
            </label>

            <label class="agreement-check-row">
                <input type="checkbox" id="agreePrivacy">
                <span>I have read and agree to the Privacy Policy of ConstructKaro, including collection and processing of my personal and business data.</span>
            </label>

            <label class="agreement-check-row">
                <input type="checkbox" id="agreeNewsletter">
                <span>I agree to receive communication, updates, and newsletters from ConstructKaro. Optional.</span>
            </label>
        </div>

        <div class="agreement-modal-footer">
            <button type="button" class="agreement-cancel-btn" id="cancelAgreementBtn">Cancel</button>
            <button type="button" class="agreement-submit-btn" id="agreeSubmitBtn" disabled>
                Agree & Submit
            </button>
        </div>

    </div>
</div> -->
@php
    $agreementDate = $agreementDate ?? now()->format('d F Y');
@endphp

<div class="agreement-modal-overlay" id="agreementModal">
    <div class="agreement-modal">

        <div class="agreement-modal-header">
            <div>
                <h2>Project Execution & Representation Agreement</h2>
                <p>Please read and accept the agreement before submitting your Contractor profile.</p>
            </div>
            <button type="button" class="agreement-close-btn" id="closeAgreementBtn">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="agreement-modal-body">
            <div class="agreement-title-box">
                <h1>CONSTRUCTKARO</h1>
                <h4>PROJECT EXECUTION & REPRESENTATION AGREEMENT</h4>
                <p>This Agreement is executed on <strong>{{ $agreementDate }}</strong></p>
            </div>

            <h3>1. PARTIES</h3>

            <p>
                <strong>Swarajya Construction Private Limited</strong>, a company incorporated under the Companies Act, 2013,
                having its registered office at Crescent Pearl B, B-G/1, Veena Nagar, Near St. Anthony Church,
                Katrang Road, Khopoli-410203, operating under the brand name <strong>“ConstructKaro”</strong>
                hereinafter referred to as <strong>“ConstructKaro”</strong>, which expression shall include its successors and permitted assigns.
            </p>

            <p><strong>AND</strong></p>

            <p>
                <strong id="agreementCompanyName">{{ old('company_name', $existingData->company_name ?? 'Contractor Company Name') }}</strong>,
                a company / firm / entity incorporated or registered under applicable laws,
                having its principal office at
                <strong id="agreementCompanyAddress">{{ old('registered_address', $existingData->registered_address ?? 'Contractor Office Address') }}</strong>,
                hereinafter referred to as <strong>“Contractor”</strong>, which expression shall include its successors and permitted assigns.
            </p>

            <p>
                ConstructKaro and Contractor are individually referred to as a <strong>“Party”</strong> and collectively as the <strong>“Parties.”</strong>
            </p>

            <h3>2. PURPOSE & NATURE OF PLATFORM</h3>

            <p>
                <strong>2.1 Platform Purpose:</strong> ConstructKaro provides construction and project management services,
                overseeing the execution of construction projects under its brand and contractual responsibility.
            </p>

            <p>
                <strong>2.2 Role of Contractor:</strong> The Contractor agrees to execute the assigned work as per the specifications provided by ConstructKaro,
                adhering to quality standards, timelines, and other project-specific requirements.
            </p>

            <p>
                <strong>2.3 ConstructKaro's Representation:</strong> All projects shall be executed under the ConstructKaro brand.
                The Contractor shall represent the work exclusively under ConstructKaro, unless otherwise agreed in writing.
            </p>

            <p>
                <strong>2.4 Customer Relationship:</strong> The Contractor acknowledges that ConstructKaro will remain the primary contracting party with the customer,
                and the Contractor shall not engage in direct dealings with the customer without prior written consent from ConstructKaro.
            </p>

            <p>
                <strong>2.5 Subcontracting:</strong> The Contractor shall not subcontract or assign work to third parties without prior written approval from ConstructKaro.
            </p>

            <h3>3. INDEPENDENT CONTRACTOR STATUS</h3>

            <p>
                <strong>3.1</strong> The Contractor is engaged as an independent contractor for execution of assigned works under this Agreement.
            </p>

            <p>
                <strong>3.2</strong> Nothing contained in this Agreement shall be deemed to create any relationship of:
            </p>

            <ul>
                <li>Partnership</li>
                <li>Joint venture</li>
                <li>Employer–employee</li>
                <li>Agency, except to the limited extent of representation authorized by ConstructKaro</li>
            </ul>

            <p>
                <strong>3.3</strong> The Contractor shall be solely responsible for:
            </p>

            <ul>
                <li>Deployment and management of its manpower and labour</li>
                <li>Compliance with all applicable labour laws, statutory requirements, and regulations</li>
                <li>Payment of wages, PF, ESIC, insurance, and other statutory dues</li>
                <li>Site execution, supervision, safety, and operational control of its workforce</li>
            </ul>

            <p>
                <strong>3.4</strong> The Contractor shall execute the work at its own risk and cost, subject to the instructions and project requirements defined by ConstructKaro.
            </p>

            <p>
                <strong>3.5</strong> The Contractor shall act as an Authorized Execution Partner of ConstructKaro, representing ConstructKaro for project execution under assigned scope.
            </p>

            <p>
                <strong>3.6</strong> The Contractor operates as an independent entity but is authorized to represent ConstructKaro for execution purposes under agreed terms.
                ConstructKaro acts as a coordination, monitoring, and service platform.
            </p>

            <p>
                <strong>3.7</strong> The Contractor agrees to execute assigned projects as a ConstructKaro-authorized partner and shall adhere to all quality,
                timeline, and communication standards defined by ConstructKaro.
            </p>

            <h3>4. CONTRACTOR OBLIGATIONS</h3>

            <p>The Contractor agrees to:</p>

            <ul>
                <li>Hold and maintain all necessary licenses, registrations, GST compliance, and statutory approvals required for execution of the assigned work.</li>
                <li>Execute the work strictly in accordance with the scope, drawings, BOQ, specifications, and timelines provided and approved by ConstructKaro.</li>
                <li>Ensure site safety, labour welfare, and full compliance with applicable laws, regulations, and safety standards.</li>
                <li>Deploy qualified manpower, tools, and resources required for proper and timely execution of the work.</li>
                <li>Follow all instructions, directions, and execution guidelines issued by ConstructKaro from time to time.</li>
                <li>Not represent its own company name, brand, or identity before the customer and shall act only as a ConstructKaro representative.</li>
                <li>Not directly contact, negotiate, or enter into any agreement with the customer without prior written approval of ConstructKaro.</li>
                <li>Not bypass, circumvent, or attempt to deal directly with any customer or project assigned by ConstructKaro.</li>
                <li>Maintain strict confidentiality of all project details, customer information, drawings, BOQs, rates, and any data shared by ConstructKaro.</li>
                <li>Refrain from misusing ConstructKaro’s brand, name, data, or any platform-related information for personal or business gain.</li>
                <li>Not subcontract or assign the work to any third party without prior written approval of ConstructKaro.</li>
            </ul>

            <h3>5. COMMERCIAL TERMS & PAYMENT STRUCTURE</h3>

            <p><strong>5.1</strong> ConstructKaro shall share the project BOQ, scope, drawings, and specifications with the Contractor for submission of base rates.</p>

            <p><strong>5.2</strong> The Contractor shall submit its rates against the BOQ, which shall be treated as the base execution cost.</p>

            <p>
                <strong>5.3</strong> ConstructKaro shall have the exclusive right to determine the final project pricing to be offered to the customer,
                including addition of its margin, service charges, or commercial adjustments.
            </p>

            <p><strong>5.4</strong> The Contractor expressly agrees that the rates submitted by it shall remain confidential and shall not be disclosed to the customer.</p>

            <p><strong>5.5</strong> All billing to the customer shall be done solely by ConstructKaro. The Contractor shall not raise any invoice directly to the customer.</p>

            <p>
                <strong>5.6</strong> Payments received from the customer shall be managed by ConstructKaro, and the Contractor shall be paid on a bill-to-bill basis,
                subject to receipt of corresponding payment from the customer.
            </p>

            <p>
                <strong>5.7</strong> ConstructKaro shall release payment to the Contractor after deducting its agreed margin and any applicable deductions,
                within a reasonable time from receipt of payment from the customer.
            </p>

            <p>
                <strong>5.8</strong> The Contractor acknowledges that ConstructKaro does not guarantee payments from the customer,
                and payment to the Contractor is strictly linked to actual realization of funds from the customer.
            </p>

            <p><strong>5.9</strong> The Contractor shall raise tax-compliant invoices only to ConstructKaro and not to the customer.</p>

            <p><strong>5.10</strong> All payments under this Agreement shall be exclusive of applicable taxes, including GST, which shall be charged and paid as per prevailing laws.</p>

            <h3>6. QUALITY CHECK & PAYMENT RELEASE</h3>

            <p><strong>6.1</strong> A designated ConstructKaro Quality Check Officer shall be assigned to monitor and verify the quality of work performed by the Contractor.</p>

            <p>
                <strong>6.2</strong> The Quality Check Officer will inspect the site regularly and ensure that the work meets the prescribed quality standards.
                The Contractor shall allow the Quality Check Officer full access to the site for this purpose.
            </p>

            <p>
                <strong>6.3</strong> The Contractor shall submit work photos and other relevant documentation to the site engineer or Quality Check Officer as part of the verification process.
            </p>

            <p>
                <strong>6.4</strong> The payment to the Contractor shall be processed on a bill-to-bill basis.
                Payment will be released only after the work has been inspected, verified, and approved by the ConstructKaro Quality Check Officer.
            </p>

            <h3>7. NO GUARANTEE & RISK ACKNOWLEDGEMENT</h3>

            <p><strong>7.1</strong> ConstructKaro does not guarantee:</p>

            <ul>
                <li>Allocation or continuity of any project or work</li>
                <li>Specific project size, value, or volume of work</li>
                <li>Timely payments from the customer</li>
                <li>Any changes in project scope, timelines, or conditions</li>
            </ul>

            <p>
                <strong>7.2</strong> The Contractor acknowledges that construction projects involve inherent risks, uncertainties,
                and site-related challenges, including but not limited to delays, design changes, and external factors beyond control.
            </p>

            <p>
                <strong>7.3</strong> The Contractor agrees that execution of work shall be undertaken at its own risk and cost,
                subject to the terms of this Agreement and instructions issued by ConstructKaro.
            </p>

            <p><strong>7.4</strong> ConstructKaro shall not be liable for any losses, damages, or delays arising due to:</p>

            <ul>
                <li>Non-payment or delayed payment by the customer</li>
                <li>Changes in project scope or requirements</li>
                <li>Site conditions, local issues, or regulatory constraints</li>
            </ul>

            <h3>8. NON-CIRCUMVENTION & NON-SOLICITATION</h3>

            <p>
                <strong>8.1</strong> The Contractor shall not, directly or indirectly, contact, engage, solicit, negotiate,
                or enter into any agreement with any customer, client, or project introduced, assigned, or handled by ConstructKaro, except through ConstructKaro.
            </p>

            <p>
                <strong>8.2</strong> The Contractor shall not attempt to bypass, avoid, or circumvent ConstructKaro in any manner
                for the purpose of obtaining work, payments, or future projects from such customers.
            </p>

            <p>
                <strong>8.3</strong> This restriction shall remain valid during the term of this Agreement and for a period of thirty-six (36) months
                from the completion or termination of this Agreement, with such period being extended upon renewal of the Agreement.
            </p>

            <p>
                <strong>8.4</strong> The Contractor shall not directly or indirectly solicit, accept, or execute any work from the customer independently,
                whether in its own name or through any third party.
            </p>

            <p>
                <strong>8.5</strong> In the event of any breach of this clause, the Contractor shall be liable to pay liquidated damages equal to
                20% of the total project value or ₹5,00,000, whichever is higher, in addition to any other legal remedies available to ConstructKaro.
                This liability is in accordance with ConstructKaro’s trademark, which is owned by Swarajya Construction Pvt. Ltd.,
                and any breach of this clause will be subject to the provisions of trademark law.
            </p>

            <h3>9. CONFIDENTIALITY & DATA PROTECTION</h3>

            <p>
                <strong>9.1</strong> The Contractor shall treat all information shared by ConstructKaro as strictly confidential,
                including but not limited to project details, pricing, BOQs, drawings, specifications, customer information, and commercial terms.
            </p>

            <p>
                <strong>9.2</strong> The Contractor shall not disclose, share, copy, reproduce, or use any such information for any purpose other than execution of the assigned work,
                without prior written consent of ConstructKaro.
            </p>

            <p><strong>9.3</strong> The Contractor shall ensure that its employees, staff, and representatives also comply with the confidentiality obligations under this Agreement.</p>

            <p><strong>9.4</strong> The Contractor shall comply with all applicable data protection laws, including the Digital Personal Data Protection Act, 2023.</p>

            <p><strong>9.5</strong> The Contractor shall not use any customer information, contact details, or project data for direct or indirect business solicitation or personal gain.</p>

            <p>
                <strong>9.6</strong> All documents, data, and information provided by ConstructKaro shall remain the exclusive property of ConstructKaro
                and shall be returned or deleted upon completion or termination of the project, if required.
            </p>

            <p>
                <strong>9.7</strong> The confidentiality obligations under this Agreement shall survive for a period of three (3) years
                from the date of termination or completion of the project, whichever is later.
            </p>

            <h3>10. INTELLECTUAL PROPERTY & BRANDING</h3>

            <p>
                <strong>10.1</strong> ConstructKaro shall retain exclusive ownership of its brand name, logo, trademarks, platform,
                systems, data, documents, drawings, BOQs, and all related intellectual property.
            </p>

            <p>
                <strong>10.2</strong> All projects shall be executed strictly under the ConstructKaro brand,
                and the Contractor shall represent the work only in the name of ConstructKaro.
            </p>

            <p>
                <strong>10.3</strong> The Contractor shall not use its own company name, brand, logo, or identity in any manner before the customer
                in relation to the assigned project, unless expressly approved in writing by ConstructKaro.
            </p>

            <p>
                <strong>10.4</strong> The Contractor shall not use, display, reproduce, or publish the ConstructKaro name, logo,
                or any project-related content for marketing, promotional, or commercial purposes without prior written consent.
            </p>

            <p>
                <strong>10.5</strong> All project-related documents, drawings, BOQs, designs, reports, and data shall remain the exclusive property of ConstructKaro
                and shall not be reused, shared, or replicated by the Contractor without permission.
            </p>

            <p>
                <strong>10.6</strong> The Contractor shall not claim any ownership, rights, or association with the ConstructKaro brand or project beyond execution of assigned work.
            </p>

            <h3>11. LIABILITY & INDEMNITY</h3>

            <p><strong>11.1</strong> The Contractor shall be solely responsible for:</p>

            <ul>
                <li>Execution of the assigned work</li>
                <li>Quality, workmanship, and completion of the project</li>
                <li>Site safety, labour deployment, and supervision</li>
                <li>Compliance with all applicable laws, statutory requirements, and regulations</li>
            </ul>

            <p><strong>11.2</strong> The Contractor shall indemnify, defend, and hold harmless ConstructKaro, its directors, employees, and representatives from and against any and all:</p>

            <ul>
                <li>Claims, demands, or disputes raised by the customer</li>
                <li>Legal notices, penalties, or regulatory actions</li>
                <li>Losses, damages, or liabilities arising out of defective work, delay, or negligence</li>
                <li>Third-party claims, including injury, accident, or property damage caused during execution</li>
            </ul>

            <p>
                <strong>11.3</strong> The Contractor shall be fully liable for any loss, damage, or cost incurred due to its acts,
                omissions, negligence, or non-compliance during execution of the project.
            </p>

            <p>
                <strong>11.4</strong> ConstructKaro’s liability, if any, shall be strictly limited to the amount actually received by ConstructKaro from the customer
                for the specific project, and ConstructKaro shall not be liable for any indirect, consequential, or incidental damages.
            </p>

            <h3>12. DISPUTE HANDLING</h3>

            <p>
                <strong>12.1</strong> All customer-related communication, disputes, and claims shall be handled exclusively by ConstructKaro.
                Any disputes with suppliers or vendors shall be handled by the Contractor, who will be responsible for resolving such matters directly.
            </p>

            <p>
                <strong>12.2</strong> The Contractor shall not directly engage with the customer for dispute resolution,
                unless specifically instructed or authorized in writing by ConstructKaro.
            </p>

            <p>
                <strong>12.3</strong> In case of any dispute arising out of execution, quality, delay, or performance of work,
                the Contractor shall fully cooperate with ConstructKaro in resolving such issues.
            </p>

            <p>
                <strong>12.4</strong> Any dispute between ConstructKaro and the Contractor arising out of or in connection with this Agreement
                shall first be attempted to be resolved amicably within thirty (30) days.
            </p>

            <p>
                <strong>12.5</strong> During the 30-day dispute resolution period, the Contractor shall continue to perform work on the project as per the instructions,
                despite the ongoing dispute with the client. ConstructKaro will handle and resolve any disputes with the client.
                If the dispute remains unresolved within the 30-day period, ConstructKaro reserves the right to assign the project to a different vendor within the following seven (7) days.
            </p>

            <p>
                <strong>12.6</strong> If the dispute remains unresolved, it shall be referred to arbitration in accordance with the provisions of the Arbitration & Conciliation Act, 1996.
            </p>

            <ul>
                <li>The seat of arbitration shall be Khalapur court.</li>
                <li>The language of arbitration shall be English.</li>
                <li>The decision of the arbitrator shall be final and binding on both parties.</li>
            </ul>

            <h3>13. TERMINATION</h3>

            <p><strong>13.1</strong> Either Party may terminate this Agreement by giving seven (7) days’ prior written notice to the other Party.</p>

            <p><strong>13.2</strong> ConstructKaro shall have the right to terminate this Agreement immediately, without prior notice, in case of:</p>

            <ul>
                <li>Breach of terms of this Agreement</li>
                <li>Poor quality of work or non-performance</li>
                <li>Delay in execution without valid reason</li>
                <li>Misconduct, fraud, or negligence</li>
                <li>Breach of confidentiality or non-circumvention obligations</li>
            </ul>

            <p><strong>13.3</strong> Upon termination:</p>

            <ul>
                <li>The Contractor shall immediately stop using ConstructKaro’s name, brand, and materials.</li>
                <li>All project-related documents, data, and information shall be returned to ConstructKaro.</li>
                <li>ConstructKaro shall have the right to reassign the project to another contractor.</li>
            </ul>

            <p><strong>13.4</strong> Termination shall not affect:</p>

            <ul>
                <li>Ongoing obligations related to completed or ongoing work</li>
                <li>Payments due for work completed and approved, subject to receipt of payment from the customer</li>
                <li>Rights and obligations arising prior to termination</li>
            </ul>

            <h3>14. GOVERNING LAW & JURISDICTION</h3>

            <p><strong>14.1</strong> This Agreement shall be governed by the laws of India.</p>

            <p><strong>14.2</strong> Courts at Khalapur, Maharashtra shall have exclusive jurisdiction.</p>

            <h3>15. DIGITAL ACCEPTANCE</h3>

            <p><strong>15.1</strong> This Agreement may be executed via:</p>

            <ul>
                <li>Digital signature</li>
                <li>Click-wrap acceptance</li>
                <li>Electronic confirmation</li>
            </ul>

            <p><strong>15.2</strong> Such execution shall be legally valid under the Information Technology Act, 2000.</p>

            <h3>16. FINAL UNDERSTANDING</h3>

            <p><strong>16.1</strong> This Agreement constitutes the entire understanding between the Parties.</p>

            <p><strong>16.2</strong> If any clause is held invalid, remaining clauses shall continue to be enforceable.</p>
        </div>

        <div class="agreement-checks">
            <label class="agreement-check-row">
                <input type="checkbox" id="agreeTerms">
                <span>I have read, understood, and agree to the Terms & Conditions of this Project Execution Agreement and accept all obligations defined herein.</span>
            </label>

            <label class="agreement-check-row">
                <input type="checkbox" id="agreePrivacy">
                <span>I have read and agree to the Privacy Policy of ConstructKaro, including the collection, use, and processing of my personal and business data.</span>
            </label>

            <label class="agreement-check-row">
                <input type="checkbox" id="agreeNewsletter">
                <span>I agree to receive communication, updates, and newsletters from ConstructKaro related to projects, opportunities, and platform updates. Optional.</span>
            </label>
        </div>

        <div class="agreement-modal-footer">
            <button type="button" class="agreement-cancel-btn" id="cancelAgreementBtn">Cancel</button>
            <button type="button" class="agreement-submit-btn" id="agreeSubmitBtn" disabled>
                Agree & Submit
            </button>
        </div>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- ── File preview ── --}}
<script>
function setupFilePreview(inputId, linkId) {
    const input = document.getElementById(inputId);
    const link  = document.getElementById(linkId);
    if (!input || !link) return;

    input.addEventListener('change', function () {
        const file        = this.files[0];
        const fileNameBox = this.closest('.upload-box-wrap').querySelector('.file-name');

        if (file) {
            link.href          = URL.createObjectURL(file);
            link.style.display = 'inline-block';
            link.textContent   = 'View File';
            if (fileNameBox) fileNameBox.textContent = file.name;
        } else {
            link.href          = '#';
            link.style.display = 'none';
            if (fileNameBox) fileNameBox.textContent = 'Choose and upload file';
        }
    });
}

setupFilePreview('msme_certificate',  'msme_link');
setupFilePreview('pan_card',          'pan_card_link');
setupFilePreview('gst_certificate',   'gst_certificate_link');
setupFilePreview('aadhaar_card',      'aadhaar_card_link');
setupFilePreview('company_profile',   'company_profile_link');
</script>

{{-- ── Multi-city + Multi-area select ── --}}
<script>
$(document).ready(function () {

    /* PHP → JS pre-selected values */
    const preSelectedCityIds = @json($selectedCityIds);   // e.g. ["2","5"]
    const preSelectedAreaIds = @json($selectedAreaIds);   // e.g. ["12","15"]

    /* Route templates */
    const areasRouteTemplate = "{{ route('get.areas', ':city_id') }}";
    const pincodesRoute      = "{{ route('get.pincodes') }}";

    /* ── Init Select2 ── */
    $('#city_ids').select2({
        placeholder   : 'Select one or more cities',
        width         : '100%',
        closeOnSelect : false
    });

    $('#area_ids').select2({
        placeholder   : 'Select areas',
        width         : '100%',
        closeOnSelect : false
    });

    /* ────────────────────────────────────────────
       loadAreasForCities(cityIds, preselectAreaIds)
       Fetches areas for ALL selected cities in
       parallel, merges + deduplicates, rebuilds
       the area <select>.
    ──────────────────────────────────────────── */
    function loadAreasForCities(cityIds, preselectAreaIds) {
        if (!cityIds || cityIds.length === 0) {
            $('#area_ids').html('').trigger('change');
            $('#pincode_id').val('');
            return;
        }

        $('#areaLoading').addClass('visible');
        $('#area_ids').prop('disabled', true);

        const requests = cityIds.map(cityId =>
            $.ajax({
                url      : areasRouteTemplate.replace(':city_id', cityId),
                type     : 'GET',
                dataType : 'json'
            })
        );

        $.when(...requests).then(function (...responses) {
            let allAreas = [];

            if (cityIds.length === 1) {
                /* Single deferred: $.when resolves as (data, status, jqXHR) */
                allAreas = responses[0];
            } else {
                /* Multiple deferreds: each response = [data, status, jqXHR] */
                responses.forEach(res => {
                    allAreas = allAreas.concat(res[0]);
                });
            }

            /* Deduplicate by id */
            const seen   = new Set();
            const unique = allAreas.filter(area => {
                if (seen.has(area.id)) return false;
                seen.add(area.id);
                return true;
            });

            /* Sort alphabetically */
            unique.sort((a, b) => a.name.localeCompare(b.name));

            /* Build <option> list */
            let html = '';
            unique.forEach(area => {
                const isSel = preselectAreaIds.includes(area.id.toString())
                           || preselectAreaIds.includes(area.id);
                html += `<option value="${area.id}" ${isSel ? 'selected' : ''}>${area.name}</option>`;
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
            console.error('Failed to load areas.');
        });
    }

    /* ── loadPincodes ── */
    function loadPincodes(areaIds) {
        if (!areaIds || areaIds.length === 0) {
            $('#pincode_id').val('');
            return;
        }

        $.ajax({
            url      : pincodesRoute,
            type     : 'GET',
            dataType : 'json',
            data     : { area_ids: areaIds },
            success  : function (data) {
                $('#pincode_id').val([...new Set(data)].join(', '));
            }
        });
    }

    /* ── City change → reload areas ── */
    $('#city_ids').on('change', function () {
        loadAreasForCities($(this).val() || [], []);
        $('#pincode_id').val('');
    });

    /* ── Area change → reload pincodes ── */
    $('#area_ids').on('change', function () {
        loadPincodes($(this).val() || []);
    });

    /* ── Restore state on validation failure ── */
    if (preSelectedCityIds.length > 0) {
        $('#city_ids').val(preSelectedCityIds).trigger('change.select2');
        loadAreasForCities(preSelectedCityIds, preSelectedAreaIds);
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('contractorRegisterForm');
    const openBtn = document.getElementById('openAgreementBtn');

    const modal = document.getElementById('agreementModal');
    const closeBtn = document.getElementById('closeAgreementBtn');
    const cancelBtn = document.getElementById('cancelAgreementBtn');
    const agreeSubmitBtn = document.getElementById('agreeSubmitBtn');

    const agreeTerms = document.getElementById('agreeTerms');
    const agreePrivacy = document.getElementById('agreePrivacy');
    const agreeNewsletter = document.getElementById('agreeNewsletter');

    const hiddenTerms = document.getElementById('agreement_terms_accepted');
    const hiddenPrivacy = document.getElementById('privacy_policy_accepted');
    const hiddenNewsletter = document.getElementById('newsletter_opt_in');
    const hiddenAcceptedAt = document.getElementById('agreement_accepted_at');

    function toggleSubmitButton() {
        agreeSubmitBtn.disabled = !(agreeTerms.checked && agreePrivacy.checked);
    }

    function openAgreementModal() {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeAgreementModal() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }

    openBtn.addEventListener('click', function () {
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        openAgreementModal();
    });

    closeBtn.addEventListener('click', closeAgreementModal);
    cancelBtn.addEventListener('click', closeAgreementModal);

    agreeTerms.addEventListener('change', toggleSubmitButton);
    agreePrivacy.addEventListener('change', toggleSubmitButton);

    agreeSubmitBtn.addEventListener('click', function () {
        if (!agreeTerms.checked || !agreePrivacy.checked) {
            alert('Please accept required agreement terms and privacy policy.');
            return;
        }

        hiddenTerms.value = '1';
        hiddenPrivacy.value = '1';
        hiddenNewsletter.value = agreeNewsletter.checked ? '1' : '0';
        hiddenAcceptedAt.value = new Date().toISOString();

        closeAgreementModal();
        form.submit();
    });
});


openBtn.addEventListener('click', function () {
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const alreadyAccepted = hiddenTerms.value === '1' && hiddenPrivacy.value === '1';

    if (alreadyAccepted) {
        form.submit();
        return;
    }

    openAgreementModal();
});
</script>
@endsection