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
        max-width: 420px;
        line-height: 1.5;
    }

    .form-footer-actions {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
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

    .save-btn:disabled {
        opacity: 0.45;
        cursor: not-allowed;
        box-shadow: none;
    }

    .save-btn:not(:disabled):hover {
        transform: translateY(-2px);
    }

    .agreement-view-btn {
        height: 56px;
        padding: 0 24px;
        border: 2px solid var(--ck-navy-2);
        border-radius: 16px;
        background: transparent;
        color: var(--ck-navy-2);
        font-size: 15px;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        cursor: pointer;
        transition: all .22s ease;
        white-space: nowrap;
    }

    .agreement-view-btn:hover {
        background: var(--ck-navy-2);
        color: #fff;
    }

    .agreement-view-btn.accepted {
        border-color: #16a34a;
        color: #16a34a;
    }

    .agreement-view-btn.accepted:hover {
        background: #16a34a;
        color: #fff;
    }

    .agreement-pending-notice {
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

    .agreement-accepted-badge {
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

    .agreement-accepted-badge.visible {
        display: flex;
    }

    .agreement-pending-notice.hidden {
        display: none;
    }

    .agreement-status-card {
        background: linear-gradient(180deg, #ffffff 0%, #fbfcfe 100%);
        border: 1.5px solid var(--ck-line-dark);
        border-radius: 18px;
        padding: 18px;
        box-shadow: var(--ck-shadow);
    }

    .agreement-status-title {
        font-size: 16px;
        font-weight: 900;
        color: var(--ck-navy);
        margin-bottom: 14px;
    }

    .agreement-status-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
    }

    .agreement-status-item {
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

    .agreement-status-item.accepted {
        background: #ecfdf3;
        border-color: #abefc6;
        color: #027a48;
    }

    .agreement-status-item.pending {
        background: #fff7ed;
        border-color: #fed7aa;
        color: #c2410c;
    }

    .agreement-status-icon {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .agreement-status-item.accepted .agreement-status-icon {
        background: #16a34a;
        color: #fff;
    }

    .agreement-status-item.pending .agreement-status-icon {
        background: #f97316;
        color: #fff;
    }

    .agreement-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 61, 0.72);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 99999;
        padding: 18px;
    }

    .agreement-modal-overlay.active {
        display: flex;
    }

    .agreement-modal {
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

    .agreement-modal-header {
        padding: 20px 24px;
        background: linear-gradient(135deg, #fff4eb 0%, #ffffff 100%);
        border-bottom: 1px solid #f1dfcf;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
    }

    .agreement-modal-header h2 {
        margin: 0;
        font-size: 22px;
        color: var(--ck-navy);
        font-weight: 900;
    }

    .agreement-modal-header p {
        margin: 6px 0 0;
        font-size: 14px;
        color: var(--ck-text-soft);
        font-weight: 500;
    }

    .agreement-close-btn {
        width: 38px;
        height: 38px;
        border: none;
        border-radius: 50%;
        background: #fff;
        color: var(--ck-navy);
        font-size: 18px;
        cursor: pointer;
        box-shadow: var(--ck-shadow);
    }

    .agreement-modal-body {
        padding: 24px;
        overflow-y: auto;
        color: #1f2937;
        line-height: 1.65;
        font-size: 14px;
    }

    .agreement-modal-body h3 {
        margin: 18px 0 8px;
        font-size: 17px;
        color: var(--ck-navy);
        font-weight: 900;
    }

    .agreement-modal-body p {
        margin: 0 0 10px;
    }

    .agreement-modal-body ul {
        margin: 6px 0 12px 20px;
    }

    .agreement-title-box {
        text-align: center;
        border: 1px solid #f1dfcf;
        border-radius: 18px;
        background: #fffaf6;
        padding: 16px;
        margin-bottom: 18px;
    }

    .agreement-title-box h1 {
        margin: 0;
        font-size: 22px;
        color: var(--ck-navy);
        font-weight: 900;
    }

    .agreement-title-box h4 {
        margin: 6px 0 0;
        color: var(--ck-orange);
        font-weight: 900;
    }

    .agreement-checks {
        padding: 18px 24px;
        border-top: 1px solid var(--ck-border);
        background: #fbfcfe;
    }

    .agreement-check-row {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        margin-bottom: 12px;
        color: var(--ck-text);
        font-size: 14px;
        font-weight: 600;
    }

    .agreement-check-row input {
        margin-top: 4px;
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }

    .agreement-modal-footer {
        padding: 16px 24px;
        border-top: 1px solid var(--ck-border);
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        flex-wrap: wrap;
    }

    .agreement-cancel-btn,
    .agreement-submit-btn {
        height: 48px;
        border-radius: 14px;
        padding: 0 22px;
        font-weight: 900;
        cursor: pointer;
        border: none;
    }

    .agreement-cancel-btn {
        background: #f3f4f6;
        color: #374151;
    }

    .agreement-submit-btn {
        background: linear-gradient(135deg, #f59e0b, #ea580c);
        color: #fff;
        box-shadow: 0 14px 26px rgba(245, 158, 11, 0.22);
    }

    .agreement-submit-btn:disabled {
        opacity: 0.55;
        cursor: not-allowed;
    }

    .agreement-modal.readonly-mode .agreement-checks,
    .agreement-modal.readonly-mode .agreement-modal-footer {
        display: none;
    }

    .agreement-modal.readonly-mode .agreement-modal-header {
        background: linear-gradient(135deg, #ecfdf3 0%, #ffffff 100%);
        border-bottom-color: #abefc6;
    }

    .agreement-readonly-banner {
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

    .agreement-modal.readonly-mode .agreement-readonly-banner {
        display: flex;
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

        .agreement-status-grid {
            grid-template-columns: 1fr;
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

        .form-footer-actions,
        .agreement-view-btn,
        .save-btn {
            width: 100%;
        }

        .form-footer-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .agreement-view-btn,
        .save-btn {
            justify-content: center;
        }

        .agreement-modal {
            max-height: 95vh;
            border-radius: 18px;
        }

        .agreement-modal-header,
        .agreement-modal-body,
        .agreement-checks,
        .agreement-modal-footer {
            padding: 16px;
        }

        .agreement-modal-header h2 {
            font-size: 18px;
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

    $termsAccepted      = (int)($existingData->agreement_terms_accepted ?? 0) === 1;
    $privacyAccepted    = (int)($existingData->privacy_policy_accepted ?? 0) === 1;
    $newsletterAccepted = (int)($existingData->newsletter_opt_in ?? 0) === 1;

    $fullyAgreed = $termsAccepted && $privacyAccepted;

    $agreementDate = now()->format('d F Y');
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

    {{-- Agreement Status --}}
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

    <form action="{{ route('vendor.boq.store') }}" method="POST" enctype="multipart/form-data" id="boqRegisterForm">
        @csrf

        <input type="hidden" name="agreement_terms_accepted" id="agreement_terms_accepted" value="{{ $termsAccepted ? 1 : 0 }}">
        <input type="hidden" name="privacy_policy_accepted" id="privacy_policy_accepted" value="{{ $privacyAccepted ? 1 : 0 }}">
        <input type="hidden" name="newsletter_opt_in" id="newsletter_opt_in" value="{{ $newsletterAccepted ? 1 : 0 }}">
        <input type="hidden" name="agreement_accepted_at" id="agreement_accepted_at" value="{{ $existingData->agreement_accepted_at ?? '' }}">

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
                        <select class="form-select" name="experience_years" id="experience_years" required>
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
                        <select class="form-select" name="team_size" id="team_size" required>
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
                                  required
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
                               placeholder="Enter minimum project value"
                               required>
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
                                   {{ $selectedTurnaround == $time ? 'checked' : '' }}
                                   required>
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
                        <input type="file" name="aadhar_card" id="aadhar_card" accept=".pdf,.jpg,.jpeg,.png">
                        <div class="file-note" id="aadhar_card_name"></div>

                        @if(!empty($existingData->aadhar_card))
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $existingData->aadhar_card) }}" target="_blank">
                                    View uploaded Aadhaar Card
                                </a>
                            </div>
                        @endif
                    </div>

                    @error('aadhar_card')
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

            <!-- <div class="form-footer">
                <div class="form-footer-note">
                    Please read and accept the agreement before saving your BOQ / Estimation profile.
                    @if(!$fullyAgreed)
                        <br><strong style="color:#c2410c;">Agreement acceptance is required before submitting.</strong>
                    @endif
                </div>

                <div class="form-footer-actions">
                    <button type="button"
                            id="openAgreementBtn"
                            class="agreement-view-btn {{ $fullyAgreed ? 'accepted' : '' }}">
                        <i class="fa-solid {{ $fullyAgreed ? 'fa-file-circle-check' : 'fa-file-signature' }}"></i>
                        <span id="agreementBtnLabel">
                            {{ $fullyAgreed ? 'View Agreement' : 'Read & Accept Agreement' }}
                        </span>
                    </button>

                    <div class="agreement-pending-notice {{ $fullyAgreed ? 'hidden' : '' }}" id="agreementPendingNotice">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        Agreement required
                    </div>

                    <div class="agreement-accepted-badge {{ $fullyAgreed ? 'visible' : '' }}" id="agreementAcceptedBadge">
                        <i class="fa-solid fa-circle-check"></i>
                        Agreement Accepted
                    </div>

                    <button type="button"
                        class="save-btn"
                        id="submitFormBtn">
                    Save &amp; Continue
                </button>
                </div>
            </div> -->
            <div class="form-footer">
    <div class="form-footer-actions">

        <button type="button"
                id="openAgreementBtn"
                class="agreement-view-btn {{ $fullyAgreed ? 'accepted' : '' }}">
            <i class="fa-solid {{ $fullyAgreed ? 'fa-file-circle-check' : 'fa-file-signature' }}"></i>
            <span id="agreementBtnLabel">
                {{ $fullyAgreed ? 'View Agreement' : 'Read Agreement' }}
            </span>
        </button>

        <div class="agreement-accepted-badge {{ $fullyAgreed ? 'visible' : '' }}" id="agreementAcceptedBadge">
            <i class="fa-solid fa-circle-check"></i>
            Agreement Accepted
        </div>

        <button type="button"
                class="save-btn"
                id="submitFormBtn">
            <i class="fa-regular fa-paper-plane"></i>
            <span>Save &amp; Continue</span>
        </button>

    </div>

    <div class="form-footer-note">
        By submitting, you agree to ConstructKaro's vendor verification process and BOQ / estimation lead matching system.
    </div>
</div>

        </div>
    </form>
</div>

{{-- Agreement Modal --}}
<div class="agreement-modal-overlay" id="agreementModal">
    <div class="agreement-modal" id="agreementModalInner">

        <div class="agreement-modal-header">
            <div>
                <h2>Project Execution &amp; Representation Agreement</h2>
                <p id="agreementModalSubtitle">Please read and accept the agreement before submitting your BOQ / Estimation profile.</p>
            </div>
            <button type="button" class="agreement-close-btn" id="closeAgreementBtn">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

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
                Katrang Road, Khopoli-410203, operating under the brand name <strong>"ConstructKaro"</strong>,
                shall hereinafter be referred to as <strong>"ConstructKaro"</strong>.
            </p>

            <p><strong>AND</strong></p>

            <p>
                <strong id="agreementCompanyName">{{ old('company_name', $existingData->company_name ?? 'BOQ / Estimation Partner') }}</strong>,
                having its principal office at
                <strong id="agreementCompanyAddress">{{ old('registered_address', $existingData->registered_address ?? 'BOQ / Estimation Partner Office Address') }}</strong>,
                shall hereinafter be referred to as <strong>"BOQ / Estimation Partner"</strong>.
            </p>

            <p>
                ConstructKaro and BOQ / Estimation Partner are individually referred to as a "Party" and collectively as the "Parties."
            </p>

            <h3>2. PURPOSE &amp; NATURE OF PLATFORM</h3>
            <p>
                ConstructKaro provides construction, BOQ, estimation, planning and project management services.
                The BOQ / Estimation Partner agrees to provide estimation, quantity calculation, rate analysis, BOQ preparation, costing support and related professional services as per requirements shared by ConstructKaro.
            </p>
            <p>
                All assigned work shall be carried out under the ConstructKaro brand unless otherwise agreed in writing.
                ConstructKaro shall remain the primary contracting party with the customer.
            </p>

            <h3>3. INDEPENDENT PARTNER STATUS</h3>
            <p>
                The BOQ / Estimation Partner is engaged as an independent professional execution partner.
                Nothing in this Agreement shall create partnership, joint venture, employer-employee relationship, or agency except limited representation authorized by ConstructKaro.
            </p>
            <ul>
                <li>The Partner shall manage its own staff, tools, software, systems and resources.</li>
                <li>The Partner shall comply with applicable laws, statutory requirements and professional standards.</li>
                <li>The Partner shall perform assigned work at its own risk and cost, subject to ConstructKaro instructions.</li>
                <li>The Partner shall act as an authorized execution partner of ConstructKaro for assigned work only.</li>
            </ul>

            <h3>4. PARTNER OBLIGATIONS</h3>
            <ul>
                <li>Prepare BOQ, quantity sheets, estimates, cost summaries and related reports accurately.</li>
                <li>Follow all drawings, specifications, scope documents, customer requirements and instructions shared by ConstructKaro.</li>
                <li>Maintain confidentiality of drawings, BOQs, rates, project information and customer details.</li>
                <li>Not directly contact, negotiate, or execute work with ConstructKaro customers without written approval.</li>
                <li>Not represent its own company name, brand, or identity before the customer without ConstructKaro approval.</li>
                <li>Deliver work within committed timelines and maintain professional quality standards.</li>
                <li>Not subcontract or assign work without prior written approval from ConstructKaro.</li>
            </ul>

            <h3>5. COMMERCIAL TERMS &amp; PAYMENT STRUCTURE</h3>
            <p>
                ConstructKaro may share drawings, project details, specifications and scope for BOQ / estimation work.
                The Partner shall submit base rates or service charges as required.
            </p>
            <p>
                All billing to the customer shall be done solely by ConstructKaro.
                The Partner shall not raise any invoice directly to the customer.
                Payment to the Partner shall be subject to work approval, verification and corresponding commercial terms agreed with ConstructKaro.
            </p>

            <h3>6. QUALITY CHECK &amp; PAYMENT RELEASE</h3>
            <p>
                ConstructKaro may verify the BOQ, quantity calculations, estimates, costing sheets and reports submitted by the Partner.
                Payment shall be released only after review, correction if required, and approval by ConstructKaro.
            </p>

            <h3>7. NO GUARANTEE &amp; RISK ACKNOWLEDGEMENT</h3>
            <ul>
                <li>ConstructKaro does not guarantee allocation or continuity of any project.</li>
                <li>ConstructKaro does not guarantee specific project size, value, volume or frequency.</li>
                <li>ConstructKaro does not guarantee timely payment from the customer.</li>
                <li>ConstructKaro shall not be liable for delay due to customer non-payment, scope changes, incomplete drawings, client revisions, or regulatory issues.</li>
            </ul>

            <h3>8. NON-CIRCUMVENTION &amp; NON-SOLICITATION</h3>
            <p>
                The Partner shall not directly or indirectly contact, solicit, negotiate, accept, or execute work with any customer introduced, assigned, or handled by ConstructKaro except through ConstructKaro.
            </p>
            <p>
                This restriction shall remain valid during the term of this Agreement and for thirty-six (36) months from completion or termination.
                Breach may attract liquidated damages equal to 20% of total project value or ₹5,00,000, whichever is higher.
            </p>

            <h3>9. CONFIDENTIALITY &amp; DATA PROTECTION</h3>
            <p>
                All project details, BOQs, drawings, rates, costing sheets, specifications, customer information, and commercial terms shared by ConstructKaro shall remain confidential and shall not be disclosed, copied, reused, or shared without written permission.
            </p>
            <p>
                The Partner shall comply with applicable data protection laws including the Digital Personal Data Protection Act, 2023.
            </p>

            <h3>10. INTELLECTUAL PROPERTY &amp; BRANDING</h3>
            <p>
                ConstructKaro retains exclusive ownership of its brand name, logo, trademarks, systems, data, documents, BOQs, reports, templates and related intellectual property.
                The Partner shall not use ConstructKaro’s name, logo, customer data, project documents, or project content for marketing or commercial purposes without prior written consent.
            </p>

            <h3>11. LIABILITY &amp; INDEMNITY</h3>
            <p>
                The Partner shall be responsible for accuracy of BOQ, estimates, quantity take-offs, costing assumptions and submitted documents.
                The Partner shall indemnify ConstructKaro from losses, disputes, customer claims, cost variation, wrong assessment, negligence, delay, or non-compliance arising from the Partner’s work.
            </p>

            <h3>12. DISPUTE HANDLING</h3>
            <p>
                Customer-related communication and disputes shall be handled exclusively by ConstructKaro.
                Any dispute between ConstructKaro and the Partner shall first be attempted to be resolved amicably within thirty (30) days.
                If unresolved, the dispute shall be referred to arbitration under the Arbitration &amp; Conciliation Act, 1996. The seat of arbitration shall be Khalapur Court.
            </p>

            <h3>13. TERMINATION</h3>
            <p>
                Either Party may terminate this Agreement by giving seven (7) days’ prior written notice.
                ConstructKaro may terminate immediately in case of breach, poor quality, delay, misconduct, fraud, negligence, confidentiality breach, or non-circumvention breach.
            </p>

            <h3>14. GOVERNING LAW &amp; JURISDICTION</h3>
            <p>
                This Agreement shall be governed by the laws of India. Courts at Khalapur, Maharashtra shall have exclusive jurisdiction.
            </p>

            <h3>15. DIGITAL ACCEPTANCE</h3>
            <p>
                This Agreement may be executed via digital signature, click-wrap acceptance, or electronic confirmation.
                Such execution shall be legally valid under the Information Technology Act, 2000.
            </p>

            <h3>16. FINAL UNDERSTANDING</h3>
            <p>
                This Agreement constitutes the entire understanding between the Parties.
                If any clause is held invalid, remaining clauses shall continue to be enforceable.
            </p>
        </div>

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
bindFileNamePreview('aadhar_card', 'aadhaar_card_name');
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

<script>
document.addEventListener('DOMContentLoaded', function () {

    const form             = document.getElementById('boqRegisterForm');
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

    const acceptedBadge     = document.getElementById('agreementAcceptedBadge');
    const agreementBtnLabel = document.getElementById('agreementBtnLabel');

    let agreementAccepted = hiddenTerms.value === '1' && hiddenPrivacy.value === '1';

    function mysqlDateTimeNow() {
        const now = new Date();

        const pad = function (num) {
            return String(num).padStart(2, '0');
        };

        return now.getFullYear() + '-' +
            pad(now.getMonth() + 1) + '-' +
            pad(now.getDate()) + ' ' +
            pad(now.getHours()) + ':' +
            pad(now.getMinutes()) + ':' +
            pad(now.getSeconds());
    }

    function openModal(readOnly) {
        if (readOnly) {
            modalInner.classList.add('readonly-mode');
            modalSubtitle.textContent = 'You can review this agreement at any time.';
        } else {
            modalInner.classList.remove('readonly-mode');
            modalSubtitle.textContent = 'You may read and accept this agreement separately.';

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
        hiddenAcceptedAt.value = mysqlDateTimeNow();

        openBtn.classList.add('accepted');

        const icon = openBtn.querySelector('i');
        if (icon) {
            icon.className = 'fa-solid fa-file-circle-check';
        }

        if (agreementBtnLabel) {
            agreementBtnLabel.textContent = 'View Agreement';
        }

        if (acceptedBadge) {
            acceptedBadge.classList.add('visible');
        }
    }

    function toggleAgreeBtn() {
        agreeSubmitBtn.disabled = !(agreeTerms.checked && agreePrivacy.checked);
    }

    openBtn.addEventListener('click', function () {
        openModal(agreementAccepted);
    });

    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            closeModal();
        }
    });

    agreeTerms.addEventListener('change', toggleAgreeBtn);
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
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        form.submit();
    });

});
</script>

@endsection