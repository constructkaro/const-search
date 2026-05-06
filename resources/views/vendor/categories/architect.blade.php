@extends('vendor.layouts.vapp')

@section('title', 'Architect Registration Form')
@section('page_title', 'Architect Registration Form')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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

    .field-block + .field-block{ margin-top: 24px; }

    .field-label{
        margin: 0 0 12px;
        font-size: 16px;
        color: var(--ck-navy);
        font-weight: 800;
    }

    .field-label .req{ color: var(--ck-red); }

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
    .form-select{ height: 58px; }

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
        grid-template-columns: repeat(2, minmax(0, 1fr));
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
        gap: 18px;
        flex-wrap: wrap;
        margin-top: 6px;
    }

    .radio-pill{
        position: relative;
        display: inline-flex;
        align-items: center;
    }

    .radio-pill input[type="radio"]{
        position: absolute;
        opacity: 0;
        pointer-events: none;
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
        width: 18px;
        height: 18px;
        border-radius: 50%;
        border: 2px solid #b7c3d4;
        display: inline-block;
        background: #fff;
        transition: all 0.2s ease;
    }

    .radio-pill input[type="radio"]:checked + label::before{
        border-color: #f25c05;
        background: radial-gradient(circle at center, #f25c05 45%, #fff 46%);
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

    .upload-content{ flex: 1; }

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

    /* ══════════════════════════════════════
       SUBMIT BAR — two-button layout
    ══════════════════════════════════════ */
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

    .submit-bar-actions{
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    /* Agreement button — outlined navy */
    .agreement-view-btn{
        height: 58px;
        padding: 0 26px;
        border: 2px solid var(--ck-navy-2);
        border-radius: 16px;
        background: transparent;
        color: var(--ck-navy-2);
        font-size: 16px;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        cursor: pointer;
        transition: all .22s ease;
        white-space: nowrap;
    }

    .agreement-view-btn:hover{
        background: var(--ck-navy-2);
        color: #fff;
    }

    .agreement-view-btn.accepted{
        border-color: #16a34a;
        color: #16a34a;
    }

    .agreement-view-btn.accepted:hover{
        background: #16a34a;
        color: #fff;
    }

    /* Submit button */
    .submit-btn{
        height: 68px;
        padding: 0 36px;
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
        cursor: pointer;
        white-space: nowrap;
    }

    .submit-btn:disabled{
        opacity: 0.45;
        cursor: not-allowed;
        box-shadow: none;
    }

    .submit-btn:not(:disabled):hover{
        transform: translateY(-2px);
        box-shadow: 0 22px 44px rgba(235,122,47,0.28);
    }

    /* Status badges */
    .agreement-pending-notice{
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 700;
        color: #c2410c;
        background: #fff7ed;
        border: 1px solid #fed7aa;
        border-radius: 10px;
        padding: 8px 14px;
    }

    .agreement-accepted-badge{
        display: none;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 700;
        color: #027a48;
        background: #ecfdf3;
        border: 1px solid #abefc6;
        border-radius: 10px;
        padding: 8px 14px;
    }

    .agreement-accepted-badge.visible{ display: flex; }
    .agreement-pending-notice.hidden{ display: none; }

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

    .area-loading{
        display: none;
        font-size: 13px;
        color: var(--ck-text-soft);
        font-weight: 500;
        margin-top: 6px;
    }

    .area-loading.visible{ display: block; }

    /* Select2 overrides */
    .select2-container{ width: 100% !important; }

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

    .select2-results__option{ padding: 10px 14px !important; }

    .select2-results__option--highlighted{
        background: var(--ck-navy) !important;
        color: #fff !important;
    }

    /* Agreement Status Card */
    .agreement-status-card{
        background: linear-gradient(180deg, #ffffff 0%, #fbfcfe 100%);
        border: 1.5px solid var(--ck-line-dark);
        border-radius: 18px;
        padding: 18px;
        margin-bottom: 24px;
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

    .agreement-modal-overlay.active{ display: flex; }

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

    .agreement-modal-body p{ margin: 0 0 10px; }
    .agreement-modal-body ul{ margin: 6px 0 12px 20px; }

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

    /* readonly-mode: hide checkboxes + footer */
    .agreement-modal.readonly-mode .agreement-checks,
    .agreement-modal.readonly-mode .agreement-modal-footer{ display: none; }

    .agreement-modal.readonly-mode .agreement-modal-header{
        background: linear-gradient(135deg, #ecfdf3 0%, #ffffff 100%);
        border-bottom-color: #abefc6;
    }

    .agreement-readonly-banner{
        display: none;
        margin: 0 24px 0;
        padding: 12px 16px;
        background: #ecfdf3;
        border: 1px solid #abefc6;
        border-radius: 12px;
        color: #027a48;
        font-size: 14px;
        font-weight: 700;
        align-items: center;
        gap: 10px;
    }

    .agreement-modal.readonly-mode .agreement-readonly-banner{ display: flex; }

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

    .agreement-cancel-btn{ background: #f3f4f6; color: #374151; }

    .agreement-submit-btn{
        background: linear-gradient(135deg, var(--ck-orange), var(--ck-orange-2));
        color: #fff;
        box-shadow: var(--ck-shadow-lg);
    }

    .agreement-submit-btn:disabled{
        opacity: 0.55;
        cursor: not-allowed;
    }

    @media (max-width: 992px){
        .form-grid-2,
        .project-grid,
        .upload-grid-2{ grid-template-columns: 1fr; }

        .submit-bar-actions{
            width: 100%;
            flex-direction: column;
            align-items: stretch;
        }

        .agreement-view-btn,
        .submit-btn{ width: 100%; justify-content: center; }
    }

    @media (max-width: 768px){
        .contractor-page{ padding: 12px 0 22px; }
        .section-card{ padding: 18px 16px 22px; border-radius: 20px; }
        .section-title-wrap h2{ font-size: 20px; }
        .vendor-bar{ grid-template-columns: 1fr; }
        .agreement-status-grid{ grid-template-columns: 1fr; }
        .submit-bar{ flex-direction: column; align-items: stretch; }

        .agreement-modal{ max-height: 95vh; border-radius: 18px; }

        .agreement-modal-header,
        .agreement-modal-body,
        .agreement-checks,
        .agreement-modal-footer{ padding: 16px; }

        .agreement-modal-header h2{ font-size: 18px; }
    }
</style>

@php
    $decodeArray = function ($value) {
        if (is_array($value)) return $value;
        if (empty($value)) return [];
        $decoded = json_decode($value, true);
        if (is_string($decoded)) $decoded = json_decode($decoded, true);
        return is_array($decoded) ? $decoded : [];
    };

    $selectedProjects = old('project_types', $decodeArray($existingData->project_types ?? null));
    $selectedProjects = is_array($selectedProjects) ? $selectedProjects : [];

    $selectedCityIds = old('city_ids', $decodeArray($existingData->city_ids ?? null));
    $selectedCityIds = is_array($selectedCityIds) ? array_map('strval', $selectedCityIds) : [];

    $selectedAreaIds = old('area_ids', $decodeArray($existingData->area_ids ?? null));
    $selectedAreaIds = is_array($selectedAreaIds) ? array_map('strval', $selectedAreaIds) : [];

    $savedPincodes = old('pincode', $existingData->pincode ?? '');

    $workType     = $workType     ?? null;
    $projectTypes = $projectTypes ?? collect();

    $termsAccepted      = (int)($existingData->agreement_terms_accepted ?? 0) === 1;
    $privacyAccepted    = (int)($existingData->privacy_policy_accepted  ?? 0) === 1;
    $newsletterAccepted = (int)($existingData->newsletter_opt_in        ?? 0) === 1;

    /* Both mandatory fields accepted = fully agreed */
    $fullyAgreed = $termsAccepted && $privacyAccepted;

    $agreementDate = now()->format('d F Y');
@endphp

{{-- ── Agreement Acceptance Status Card ── --}}
<div class="agreement-status-card">
    <div class="agreement-status-title">Agreement Acceptance Status</div>

    <div class="agreement-status-grid">
        <div class="agreement-status-item {{ $termsAccepted ? 'accepted' : 'pending' }}">
            <span class="agreement-status-icon">
                <i class="fa-solid {{ $termsAccepted ? 'fa-check' : 'fa-clock' }}"></i>
            </span>
            <span>Terms &amp; Conditions {{ $termsAccepted ? 'Accepted' : 'Pending' }}</span>
        </div>

        <div class="agreement-status-item {{ $privacyAccepted ? 'accepted' : 'pending' }}">
            <span class="agreement-status-icon">
                <i class="fa-solid {{ $privacyAccepted ? 'fa-check' : 'fa-clock' }}"></i>
            </span>
            <span>Privacy Policy {{ $privacyAccepted ? 'Accepted' : 'Pending' }}</span>
        </div>

        <div class="agreement-status-item {{ $newsletterAccepted ? 'accepted' : 'pending' }}">
            <span class="agreement-status-icon">
                <i class="fa-solid {{ $newsletterAccepted ? 'fa-check' : 'fa-minus' }}"></i>
            </span>
            <span>Newsletter {{ $newsletterAccepted ? 'Accepted' : 'Optional' }}</span>
        </div>
    </div>

    @if(!empty($existingData->agreement_accepted_at))
        <small style="display:block;margin-top:12px;color:#71829b;font-weight:600;">
            Accepted At: {{ \Carbon\Carbon::parse($existingData->agreement_accepted_at)->format('d M Y, h:i A') }}
        </small>
    @endif
</div>

{{-- ══════════════════════════════════════
     MAIN FORM
══════════════════════════════════════ --}}
<div class="contractor-page">
    <div class="contractor-stack">

        <form action="{{ route('architect.store') }}" method="POST" enctype="multipart/form-data" id="architectRegisterForm">
            @csrf

            {{-- Hidden agreement fields — pre-seeded from DB --}}
            <input type="hidden" name="agreement_terms_accepted" id="agreement_terms_accepted" value="{{ $termsAccepted     ? 1 : 0 }}">
            <input type="hidden" name="privacy_policy_accepted"  id="privacy_policy_accepted"  value="{{ $privacyAccepted   ? 1 : 0 }}">
            <input type="hidden" name="newsletter_opt_in"        id="newsletter_opt_in"        value="{{ $newsletterAccepted ? 1 : 0 }}">
            <input type="hidden" name="agreement_accepted_at"    id="agreement_accepted_at"    value="{{ $existingData->agreement_accepted_at ?? '' }}">

            @if(session('success'))
                <div style="background:#d1fae5;color:#065f46;padding:14px 18px;border-radius:12px;margin-bottom:20px;font-weight:600;">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div style="background:#fee2e2;color:#991b1b;padding:14px 18px;border-radius:12px;margin-bottom:20px;font-weight:600;">
                    <ul style="margin:0;padding-left:18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ── Business & Work Details ── --}}
            <div class="section-card">
                <div class="section-head">
                    <div class="section-badge"><i class="fa-solid fa-compass-drafting"></i></div>
                    <div class="section-title-wrap">
                        <h2>Business &amp; Work Details</h2>
                        <p>Select your architectural specialization and project expertise</p>
                    </div>
                </div>

                <div class="field-block">
                    <div class="field-label">Find Your Construction Vendor <span class="req">*</span></div>
                    <div class="vendor-bar">
                        <div class="vendor-value">{{ $workType->work_type ?? 'Architect' }}</div>
                        <div class="vendor-chip">{{ $workType->work_type ?? 'Architect' }}</div>
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
                                       {{ in_array($type, $selectedProjects) ? 'checked' : '' }}>
                                <label for="project_type_{{ $index }}">{{ $type }}</label>
                            </div>
                        @empty
                            <p style="color:red;font-weight:600;">No project types found.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- ── Basic Business Information ── --}}
            <div class="section-card">
                <div class="section-divider"></div>
                <div class="section-head">
                    <div class="section-badge"><i class="fa-solid fa-building"></i></div>
                    <div class="section-title-wrap">
                        <h2>Basic Business Information</h2>
                        <p>Company overview and operating details</p>
                    </div>
                </div>

                <div class="form-grid-2 business-info-grid">
                    <div>
                        <div class="field-label">Years of Experience <span class="req">*</span></div>
                        <select class="form-select" name="experience_years" required>
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

                    <div>
                        <div class="field-label">Area <span class="req">*</span></div>
                        <select class="form-select" name="area_ids[]" id="area_ids" multiple required>
                            @foreach($selectedAreaIds as $aId)
                                <option value="{{ $aId }}" selected>{{ $aId }}</option>
                            @endforeach
                        </select>
                        <small class="area-loading" id="areaLoading">
                            <i class="fa-solid fa-spinner fa-spin"></i> Loading areas…
                        </small>
                    </div>

                    <div>
                        <div class="field-label">Pincode <span class="req">*</span></div>
                        <textarea class="form-textarea" id="pincode_id" name="pincode" readonly required
                                  placeholder="Pincodes auto-fill from selected areas">{{ $savedPincodes }}</textarea>
                    </div>

                    <div>
                        <div class="field-label">Accepting projects of minimum value (₹) <span class="req">*</span></div>
                        <input type="number" step="1" min="0" name="minimum_project_value" class="form-input" required
                               placeholder="Enter amount in numbers only, e.g. 500000"
                               value="{{ old('minimum_project_value', $existingData->minimum_project_value ?? '') }}">
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
                    <div class="section-badge"><i class="fa-solid fa-id-card"></i></div>
                    <div class="section-title-wrap">
                        <h2>Company &amp; Compliance Details</h2>
                        <p>Legal, statutory and contact information</p>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div>
                        <div class="field-label">Company Name <span class="req">*</span></div>
                        <input type="text" class="form-input" name="company_name" id="companyNameInput" required
                               placeholder="Enter company name"
                               value="{{ old('company_name', $existingData->company_name ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">Type of Entity <span class="req">*</span></div>
                        <select class="form-select" name="entity_type">
                            <option value="" selected disabled>Select entity type</option>
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
                        <textarea class="form-textarea" name="registered_address" id="registeredAddressInput" required
                                  placeholder="Enter registered office address">{{ old('registered_address', $existingData->registered_address ?? '') }}</textarea>
                    </div>

                    <div>
                        <div class="field-label">Contact Person Designation <span class="req">*</span></div>
                        <input type="text" class="form-input" name="contact_person_designation" required
                               placeholder="Enter contact person designation"
                               value="{{ old('contact_person_designation', $existingData->contact_person_designation ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">Contact Person Name</div>
                        <input type="text" class="form-input" name="contact_person_name"
                               placeholder="Enter contact person name"
                               value="{{ old('contact_person_name', $existingData->contact_person_name ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">PAN Number</div>
                        <input type="text" class="form-input" name="pan_number"
                               placeholder="Enter PAN number"
                               value="{{ old('pan_number', $existingData->pan_number ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">TAN Number</div>
                        <input type="text" class="form-input" name="tan_number"
                               placeholder="Enter TAN number"
                               value="{{ old('tan_number', $existingData->tan_number ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">GST Number</div>
                        <input type="text" class="form-input" name="gst_number"
                               placeholder="Enter GST number"
                               value="{{ old('gst_number', $existingData->gst_number ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">COA Number</div>
                        <input type="text" class="form-input" name="coa_number"
                               placeholder="Enter COA number"
                               value="{{ old('coa_number', $existingData->coa_number ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">Website</div>
                        <input type="text" class="form-input" name="website"
                               placeholder="Enter website"
                               value="{{ old('website', $existingData->website ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">ESIC Number</div>
                        <input type="text" class="form-input" name="esic_number"
                               placeholder="Enter ESIC number"
                               value="{{ old('esic_number', $existingData->esic_number ?? '') }}">
                    </div>

                    <div>
                        <div class="field-label">PF No</div>
                        <input type="text" class="form-input" name="pf_number"
                               placeholder="Enter PF number"
                               value="{{ old('pf_number', $existingData->pf_number ?? '') }}">
                    </div>

                    <div style="grid-column: 1 / -1;">
                        <div class="field-label">MSME/Udyam Registered <span class="req">*</span></div>
                        <div class="radio-group">
                            <div class="radio-pill">
                                <input type="radio" id="msme_yes" name="msme_registered" value="Yes" required
                                    {{ old('msme_registered', $existingData->msme_registered ?? '') == 'Yes' ? 'checked' : '' }}>
                                <label for="msme_yes">Yes</label>
                            </div>
                            <div class="radio-pill">
                                <input type="radio" id="msme_no" name="msme_registered" value="No" required
                                    {{ old('msme_registered', $existingData->msme_registered ?? '') == 'No' ? 'checked' : '' }}>
                                <label for="msme_no">No</label>
                            </div>
                        </div>
                        @error('msme_registered')
                            <div class="text-danger" style="margin-top:8px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="grid-column: 1 / -1;">
                        <div class="field-label">Upload MSME/Udyam Certificate</div>
                        <div class="upload-box-wrap">
                            <input type="file" id="msme_certificate" name="msme_certificate" accept=".pdf,.jpg,.jpeg,.png">
                            <label for="msme_certificate" class="upload-box">
                                <div class="upload-icon"><i class="fa-regular fa-award"></i></div>
                                <div class="upload-content">
                                    <div class="upload-main">Upload MSME/Udyam Certificate</div>
                                    <div class="upload-note file-name" id="msme_certificate_name">PDF, JPG, PNG up to 20MB</div>
                                </div>
                            </label>
                            @if(!empty($existingData->msme_certificate))
                                <a href="{{ asset('storage/'.$existingData->msme_certificate) }}"
                                   class="uploaded-link" id="msme_certificate_link" target="_blank"
                                   style="display:inline-block;">View Uploaded MSME</a>
                            @else
                                <a href="#" class="uploaded-link" id="msme_certificate_link" target="_blank"
                                   style="display:none;">View Uploaded MSME</a>
                            @endif
                            @error('msme_certificate')
                                <div class="text-danger" style="margin-top:8px;font-size:13px;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Documents & Work Proof ── --}}
            <div class="section-card">
                <div class="section-divider"></div>
                <div class="section-head">
                    <div class="section-badge"><i class="fa-solid fa-file-arrow-up"></i></div>
                    <div class="section-title-wrap">
                        <h2>Documents &amp; Work Proof</h2>
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
                            <a href="#" class="uploaded-link" id="gst_certificate_link" target="_blank" style="display:none;">View GST</a>
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
                            <a href="#" class="uploaded-link" id="aadhaar_card_link" target="_blank" style="display:none;">View Aadhaar</a>
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
                            <a href="#" class="uploaded-link" id="company_profile_link" target="_blank" style="display:none;">View Certificate</a>
                            @if(!empty($existingData->company_profile))
                                <div><a href="{{ asset('storage/'.$existingData->company_profile) }}" target="_blank">View Company Profile</a></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════════
                 SUBMIT BAR — TWO SEPARATE BUTTONS
            ══════════════════════════════════════ --}}
            <div class="submit-bar">
                <div class="submit-bar-actions">

                    {{-- ① View Agreement button — always visible --}}
                    <button type="button"
                            id="openAgreementBtn"
                            class="agreement-view-btn {{ $fullyAgreed ? 'accepted' : '' }}">
                        <i class="fa-solid {{ $fullyAgreed ? 'fa-file-circle-check' : 'fa-file-signature' }}"></i>
                        <span id="agreementBtnLabel">
                            {{ $fullyAgreed ? 'View Agreement' : 'Read & Accept Agreement' }}
                        </span>
                    </button>

                    {{-- Status badges --}}
                    <div class="agreement-pending-notice {{ $fullyAgreed ? 'hidden' : '' }}" id="agreementPendingNotice">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        Agreement acceptance required before submitting
                    </div>
                    <div class="agreement-accepted-badge {{ $fullyAgreed ? 'visible' : '' }}" id="agreementAcceptedBadge">
                        <i class="fa-solid fa-circle-check"></i>
                        Agreement Accepted
                    </div>

                    {{-- ② Submit button — enabled only when agreement accepted --}}
                    <button type="button"
                            class="submit-btn"
                            id="submitFormBtn"
                            {{ $fullyAgreed ? '' : 'disabled' }}>
                        <i class="fa-regular fa-paper-plane"></i>
                        <span>Submit Architect Profile</span>
                    </button>

                </div>

                <div class="submit-note">
                    By submitting, you agree to ConstructKaro's vendor verification process and project lead matching system.
                    @if(!$fullyAgreed)
                        <br><strong style="color:#c2410c;">Please read and accept the agreement first.</strong>
                    @endif
                </div>
            </div>

        </form>
    </div>
</div>

{{-- ══════════════════════════════════════
     AGREEMENT MODAL
══════════════════════════════════════ --}}
<div class="agreement-modal-overlay" id="agreementModal">
    <div class="agreement-modal" id="agreementModalInner">

        <div class="agreement-modal-header">
            <div>
                <h2>Project Execution &amp; Representation Agreement</h2>
                <p id="agreementModalSubtitle">Please read and accept the agreement before submitting your Architect profile.</p>
            </div>
            <button type="button" class="agreement-close-btn" id="closeAgreementBtn">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        {{-- Shown only in readonly-mode --}}
        <div class="agreement-readonly-banner">
            <i class="fa-solid fa-circle-check"></i>
            You have already accepted this agreement.
            @if(!empty($existingData->agreement_accepted_at))
                Accepted on {{ \Carbon\Carbon::parse($existingData->agreement_accepted_at)->format('d M Y, h:i A') }}.
            @endif
        </div>

        <div class="agreement-modal-body">
            <div class="agreement-title-box">
                <h1>CONSTRUCTKARO</h1>
                <h4>PROJECT EXECUTION &amp; REPRESENTATION AGREEMENT</h4>
                <p>This Agreement is executed on <strong>{{ $agreementDate }}</strong></p>
            </div>

            <h3>1. PARTIES</h3>
            <p>
                <strong>Swarajya Construction Private Limited</strong>, a company incorporated under the Companies Act, 2013,
                having its registered office at Crescent Pearl B, B-G/1, Veena Nagar, Near St. Anthony Church,
                Katrang Road, Khopoli-410203, operating under the brand name <strong>"ConstructKaro"</strong>
                shall hereinafter be referred to as <strong>"ConstructKaro"</strong>.
            </p>
            <p><strong>AND</strong></p>
            <p>
                <strong id="agreementCompanyName">{{ old('company_name', $existingData->company_name ?? 'Architect Company Name') }}</strong>,
                having its principal office at
                <strong id="agreementCompanyAddress">{{ old('registered_address', $existingData->registered_address ?? 'Architect Office Address') }}</strong>,
                shall hereinafter be referred to as <strong>"Architect"</strong>.
            </p>
            <p>ConstructKaro and Architect are individually referred to as a "Party" and collectively as the "Parties."</p>

            <h3>2. PURPOSE &amp; NATURE OF PLATFORM</h3>
            <p>ConstructKaro provides construction and project management services, overseeing execution of projects under its brand and contractual responsibility.</p>
            <p>The Architect agrees to execute assigned work as per specifications, quality standards, timelines, drawings, BOQ, and project-specific requirements provided by ConstructKaro.</p>
            <p>All projects shall be executed under the ConstructKaro brand. The Architect shall represent the work exclusively under ConstructKaro unless otherwise agreed in writing.</p>
            <p>ConstructKaro shall remain the primary contracting party with the customer. The Architect shall not engage in direct dealings with the customer without prior written consent from ConstructKaro.</p>

            <h3>3. INDEPENDENT ARCHITECT STATUS</h3>
            <p>The Architect is engaged as an independent execution partner for assigned works. Nothing in this Agreement shall create a partnership, joint venture, employer-employee relationship, or agency except limited representation authorized by ConstructKaro.</p>
            <ul>
                <li>The Architect shall manage its manpower, staff, and resources.</li>
                <li>The Architect shall comply with applicable laws, statutory requirements, and regulations.</li>
                <li>The Architect shall execute work at its own risk and cost, subject to ConstructKaro instructions.</li>
                <li>The Architect shall act as an authorized execution partner of ConstructKaro.</li>
            </ul>

            <h3>4. ARCHITECT OBLIGATIONS</h3>
            <ul>
                <li>Maintain all necessary licenses, registrations, GST compliance, and statutory approvals.</li>
                <li>Execute work as per scope, drawings, BOQ, specifications, and timelines approved by ConstructKaro.</li>
                <li>Ensure quality, safety, labour welfare, and compliance with applicable laws.</li>
                <li>Deploy qualified manpower, tools, and resources for proper and timely execution.</li>
                <li>Follow all instructions and execution guidelines issued by ConstructKaro.</li>
                <li>Not represent its own company name, brand, or identity before the customer without approval.</li>
                <li>Not directly contact, negotiate, or enter into any agreement with the customer.</li>
                <li>Maintain confidentiality of project details, customer information, drawings, BOQs, and rates.</li>
                <li>Not subcontract or assign work without prior written approval from ConstructKaro.</li>
            </ul>

            <h3>5. COMMERCIAL TERMS &amp; PAYMENT STRUCTURE</h3>
            <p>ConstructKaro shall share project BOQ, scope, drawings, and specifications with the Architect for rate submission. ConstructKaro shall have the exclusive right to determine final project pricing offered to the customer.</p>
            <p>All billing to the customer shall be done solely by ConstructKaro. The Architect shall not raise any invoice directly to the customer.</p>
            <p>Payment to the Architect shall be on a bill-to-bill basis and subject to receipt of corresponding payment from the customer and quality approval by ConstructKaro.</p>

            <h3>6. QUALITY CHECK &amp; PAYMENT RELEASE</h3>
            <p>ConstructKaro may appoint a Quality Check Officer to monitor and verify the quality of work. Payment shall be released only after inspection, verification, and approval.</p>

            <h3>7. NO GUARANTEE &amp; RISK ACKNOWLEDGEMENT</h3>
            <ul>
                <li>ConstructKaro does not guarantee allocation or continuity of any project.</li>
                <li>ConstructKaro does not guarantee specific project size, value, or volume.</li>
                <li>ConstructKaro does not guarantee timely payment from the customer.</li>
                <li>ConstructKaro shall not be liable for delay due to customer non-payment, site conditions, scope changes, or regulatory issues.</li>
            </ul>

            <h3>8. NON-CIRCUMVENTION &amp; NON-SOLICITATION</h3>
            <p>The Architect shall not directly or indirectly contact, solicit, negotiate, or execute work with any customer introduced, assigned, or handled by ConstructKaro except through ConstructKaro.</p>
            <p>This restriction shall remain valid during the term of this Agreement and for thirty-six (36) months from completion or termination. Breach may attract liquidated damages equal to 20% of total project value or ₹5,00,000, whichever is higher.</p>

            <h3>9. CONFIDENTIALITY &amp; DATA PROTECTION</h3>
            <p>All project details, BOQs, drawings, pricing, specifications, customer information, and commercial terms shared by ConstructKaro shall remain confidential and shall not be disclosed or reused without permission.</p>
            <p>The Architect shall comply with applicable data protection laws including the Digital Personal Data Protection Act, 2023.</p>

            <h3>10. INTELLECTUAL PROPERTY &amp; BRANDING</h3>
            <p>ConstructKaro retains exclusive ownership of its brand name, logo, trademarks, systems, data, documents, drawings, BOQs, reports, and related intellectual property.</p>
            <p>The Architect shall not use ConstructKaro's name, logo, or project content for marketing or commercial purposes without prior written consent.</p>

            <h3>11. LIABILITY &amp; INDEMNITY</h3>
            <p>The Architect shall indemnify and hold harmless ConstructKaro, its directors, employees, and representatives from claims, losses, damages, penalties, disputes, defective work, delay, negligence, third-party claims, or statutory non-compliance arising from the Architect's work.</p>

            <h3>12. DISPUTE HANDLING</h3>
            <p>Customer-related communication and disputes shall be handled exclusively by ConstructKaro. Any dispute between ConstructKaro and the Architect shall first be attempted to be resolved amicably within thirty (30) days. If unresolved, the dispute shall be referred to arbitration under the Arbitration &amp; Conciliation Act, 1996. The seat of arbitration shall be Khalapur Court.</p>

            <h3>13. TERMINATION</h3>
            <p>Either Party may terminate this Agreement by giving seven (7) days' prior written notice. ConstructKaro may terminate immediately in case of breach, poor quality, delay, misconduct, fraud, negligence, confidentiality breach, or non-circumvention breach.</p>

            <h3>14. GOVERNING LAW &amp; JURISDICTION</h3>
            <p>This Agreement shall be governed by the laws of India. Courts at Khalapur, Maharashtra shall have exclusive jurisdiction.</p>

            <h3>15. DIGITAL ACCEPTANCE</h3>
            <p>This Agreement may be executed via digital signature, click-wrap acceptance, or electronic confirmation. Such execution shall be legally valid under the Information Technology Act, 2000.</p>

            <h3>16. FINAL UNDERSTANDING</h3>
            <p>This Agreement constitutes the entire understanding between the Parties. If any clause is held invalid, remaining clauses shall continue to be enforceable.</p>
        </div>

        {{-- Checkboxes — hidden in readonly-mode via CSS --}}
        <div class="agreement-checks">
            <label class="agreement-check-row">
                <input type="checkbox" id="agreeTerms">
                <span>I have read, understood, and agree to the Terms &amp; Conditions of this Project Execution Agreement.</span>
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

        {{-- Footer — hidden in readonly-mode via CSS --}}
        <div class="agreement-modal-footer">
            <button type="button" class="agreement-cancel-btn" id="cancelAgreementBtn">Cancel</button>
            <button type="button" class="agreement-submit-btn" id="agreeSubmitBtn" disabled>
                Agree &amp; Continue
            </button>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- File preview --}}
<script>
function setupFilePreview(inputId, linkId, defaultNote) {
    const input = document.getElementById(inputId);
    const link  = document.getElementById(linkId);
    if (!input || !link) return;
    input.addEventListener('change', function () {
        const file = this.files[0];
        const wrap = this.closest('.upload-box-wrap');
        const fileNameBox = wrap ? wrap.querySelector('.file-name') : null;
        if (file) {
            link.href = URL.createObjectURL(file);
            link.style.display = 'inline-block';
            link.textContent = 'View Uploaded File';
            if (fileNameBox) fileNameBox.textContent = file.name;
        } else {
            link.href = '#';
            link.style.display = 'none';
            if (fileNameBox) fileNameBox.textContent = defaultNote || 'Choose and upload file';
        }
    });
}
setupFilePreview('msme_certificate', 'msme_certificate_link', 'PDF, JPG, PNG up to 20MB');
setupFilePreview('pan_card',         'pan_card_link',         'Choose and upload file');
setupFilePreview('gst_certificate',  'gst_certificate_link',  'Choose and upload file');
setupFilePreview('aadhaar_card',     'aadhaar_card_link',     'Choose and upload file');
setupFilePreview('company_profile',  'company_profile_link',  'Choose and upload file');
</script>

{{-- Multi-city + Multi-area select --}}
<script>
$(document).ready(function () {
    const preSelectedCityIds = @json($selectedCityIds);
    const preSelectedAreaIds = @json($selectedAreaIds);
    const areasRouteTemplate = "{{ route('get.areas', ':city_id') }}";
    const pincodesRoute      = "{{ route('get.pincodes') }}";

    $('#city_ids').select2({ placeholder: 'Select one or more cities', width: '100%', closeOnSelect: false });
    $('#area_ids').select2({ placeholder: 'Select areas',              width: '100%', closeOnSelect: false });

    function loadAreasForCities(cityIds, preselectAreaIds) {
        if (!cityIds || cityIds.length === 0) {
            $('#area_ids').html('').trigger('change');
            $('#pincode_id').val('');
            return;
        }
        $('#areaLoading').addClass('visible');
        $('#area_ids').prop('disabled', true);

        const requests = cityIds.map(cityId =>
            $.ajax({ url: areasRouteTemplate.replace(':city_id', cityId), type: 'GET', dataType: 'json' })
        );

        $.when(...requests).then(function (...responses) {
            let allAreas = [];
            if (cityIds.length === 1) {
                allAreas = responses[0];
            } else {
                responses.forEach(res => { allAreas = allAreas.concat(res[0]); });
            }
            const seen   = new Set();
            const unique = allAreas.filter(area => { if (seen.has(area.id)) return false; seen.add(area.id); return true; });
            unique.sort((a, b) => a.name.localeCompare(b.name));
            let html = '';
            unique.forEach(area => {
                const isSel = preselectAreaIds.includes(area.id.toString()) || preselectAreaIds.includes(area.id);
                html += `<option value="${area.id}" ${isSel ? 'selected' : ''}>${area.name}</option>`;
            });
            $('#area_ids').html(html).trigger('change');
            $('#area_ids').prop('disabled', false);
            $('#areaLoading').removeClass('visible');
            if (preselectAreaIds.length > 0) loadPincodes(preselectAreaIds);
        }).fail(function () {
            $('#area_ids').prop('disabled', false);
            $('#areaLoading').removeClass('visible');
        });
    }

    function loadPincodes(areaIds) {
        if (!areaIds || areaIds.length === 0) { $('#pincode_id').val(''); return; }
        $.ajax({
            url: pincodesRoute, type: 'GET', dataType: 'json', data: { area_ids: areaIds },
            success: function (data) { $('#pincode_id').val([...new Set(data)].join(', ')); }
        });
    }

    $('#city_ids').on('change', function () { $('#pincode_id').val(''); loadAreasForCities($(this).val() || [], []); });
    $('#area_ids').on('change', function () { loadPincodes($(this).val() || []); });

    if (preSelectedCityIds.length > 0) {
        $('#city_ids').val(preSelectedCityIds).trigger('change.select2');
        loadAreasForCities(preSelectedCityIds, preSelectedAreaIds);
    }
});
</script>

{{-- ══════════════════════════════════════
     AGREEMENT MODAL LOGIC (SEPARATED)
══════════════════════════════════════ --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const form             = document.getElementById('architectRegisterForm');
    const openBtn          = document.getElementById('openAgreementBtn');
    const submitFormBtn    = document.getElementById('submitFormBtn');

    const modal            = document.getElementById('agreementModal');
    const modalInner       = document.getElementById('agreementModalInner');
    const closeBtn         = document.getElementById('closeAgreementBtn');
    const cancelBtn        = document.getElementById('cancelAgreementBtn');
    const agreeSubmitBtn   = document.getElementById('agreeSubmitBtn');
    const modalSubtitle    = document.getElementById('agreementModalSubtitle');

    const agreeTerms       = document.getElementById('agreeTerms');
    const agreePrivacy     = document.getElementById('agreePrivacy');
    const agreeNewsletter  = document.getElementById('agreeNewsletter');

    const hiddenTerms      = document.getElementById('agreement_terms_accepted');
    const hiddenPrivacy    = document.getElementById('privacy_policy_accepted');
    const hiddenNewsletter = document.getElementById('newsletter_opt_in');
    const hiddenAcceptedAt = document.getElementById('agreement_accepted_at');

    const pendingNotice    = document.getElementById('agreementPendingNotice');
    const acceptedBadge    = document.getElementById('agreementAcceptedBadge');
    const agreementBtnLabel= document.getElementById('agreementBtnLabel');

    const companyNameInput = document.getElementById('companyNameInput');
    const registeredAddrInput = document.getElementById('registeredAddressInput');
    const modalCompanyName = document.getElementById('agreementCompanyName');
    const modalCompanyAddr = document.getElementById('agreementCompanyAddress');

    /* State — seeded from DB via hidden fields */
    let agreementAccepted = hiddenTerms.value === '1' && hiddenPrivacy.value === '1';

    /* ── Helpers ── */
    function openModal(readOnly) {
        /* Sync live form values into agreement text */
        if (companyNameInput && modalCompanyName) {
            modalCompanyName.textContent = companyNameInput.value.trim() || 'Architect Company Name';
        }
        if (registeredAddrInput && modalCompanyAddr) {
            modalCompanyAddr.textContent = registeredAddrInput.value.trim() || 'Architect Office Address';
        }

        if (readOnly) {
            modalInner.classList.add('readonly-mode');
            modalSubtitle.textContent = 'You can review this agreement at any time.';
        } else {
            modalInner.classList.remove('readonly-mode');
            modalSubtitle.textContent = 'Please read and accept the agreement before submitting your Architect profile.';
            agreeTerms.checked      = false;
            agreePrivacy.checked    = false;
            agreeNewsletter.checked = hiddenNewsletter.value === '1';
            agreeSubmitBtn.disabled = true;
        }

        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }

    function markAgreementAccepted(newsletterChecked) {
        agreementAccepted = true;

        hiddenTerms.value      = '1';
        hiddenPrivacy.value    = '1';
        hiddenNewsletter.value = newsletterChecked ? '1' : '0';
        hiddenAcceptedAt.value = new Date().toISOString();

        openBtn.classList.add('accepted');
        openBtn.querySelector('i').className = 'fa-solid fa-file-circle-check';
        agreementBtnLabel.textContent = 'View Agreement';

        pendingNotice.classList.add('hidden');
        acceptedBadge.classList.add('visible');

        submitFormBtn.disabled = false;
    }

    function toggleAgreeBtn() {
        agreeSubmitBtn.disabled = !(agreeTerms.checked && agreePrivacy.checked);
    }

    /* ── Events ── */
    openBtn.addEventListener('click', function () {
        openModal(agreementAccepted);
    });

    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    modal.addEventListener('click', function (e) {
        if (e.target === modal) closeModal();
    });

    agreeTerms.addEventListener('change',  toggleAgreeBtn);
    agreePrivacy.addEventListener('change', toggleAgreeBtn);

    agreeSubmitBtn.addEventListener('click', function () {
        if (!agreeTerms.checked || !agreePrivacy.checked) {
            alert('Please accept the required Terms & Conditions and Privacy Policy.');
            return;
        }
        markAgreementAccepted(agreeNewsletter.checked);
        closeModal();
    });

    submitFormBtn.addEventListener('click', function () {
        if (!agreementAccepted) {
            alert('Please read and accept the Agreement first by clicking the "Read & Accept Agreement" button.');
            return;
        }
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }
        form.submit();
    });
});
</script>

@endsection