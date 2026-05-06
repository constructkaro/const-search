@extends('vendor.layouts.vapp')

@section('title', 'Structural Audit Provider Form')
@section('page_title', 'Structural Audit Provider Form')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    :root{
        --ck-bg:#f4f7fb;
        --ck-white:#ffffff;
        --ck-navy:#0f173d;
        --ck-navy-2:#1e3766;
        --ck-navy-3:#355c9a;
        --ck-orange:#eb7a2f;
        --ck-orange-2:#f39a56;
        --ck-orange-soft:#fff4eb;
        --ck-text:#182b49;
        --ck-text-soft:#71829b;
        --ck-line:#e3eaf2;
        --ck-line-dark:#d6dfeb;
        --ck-red:#dc2626;
        --ck-green:#16a34a;
        --ck-shadow-sm:0 8px 22px rgba(15,23,61,.05);
        --ck-shadow-md:0 16px 38px rgba(15,23,61,.07);
        --ck-shadow-lg:0 18px 38px rgba(235,122,47,.20);
        --ck-radius-xl:28px;
        --ck-radius-lg:20px;
        --ck-radius-md:16px;
        --ck-radius-sm:14px;
    }

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }

    body{
        background:
            linear-gradient(rgba(15,23,61,.032) 1px, transparent 1px),
            linear-gradient(90deg, rgba(15,23,61,.032) 1px, transparent 1px),
            linear-gradient(180deg,#f8fafc 0%,#eef3f8 100%);
        background-size:56px 56px,56px 56px,auto;
    }

    .audit-page{
        max-width:1220px;
        margin:0 auto;
        padding:22px 0 36px;
    }

    .audit-stack{
        display:flex;
        flex-direction:column;
        gap:24px;
    }

    .top-banner{
        background:linear-gradient(135deg,#ffffff 0%,#fff8f2 100%);
        border:1px solid #f2e0d0;
        border-radius:26px;
        box-shadow:var(--ck-shadow-md);
        padding:22px 24px;
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:18px;
        flex-wrap:wrap;
    }

    .top-banner-left{
        display:flex;
        align-items:center;
        gap:16px;
    }

    .top-banner-icon{
        width:64px;
        height:64px;
        border-radius:20px;
        background:linear-gradient(135deg,var(--ck-orange),var(--ck-orange-2));
        color:#fff;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:26px;
        box-shadow:0 16px 32px rgba(235,122,47,.22);
        flex-shrink:0;
    }

    .top-banner h1{
        margin:0;
        color:var(--ck-navy);
        font-size:28px;
        line-height:1.2;
        font-weight:900;
    }

    .top-banner p{
        margin:6px 0 0;
        color:var(--ck-text-soft);
        font-size:14px;
        font-weight:500;
    }

    .top-badge{
        padding:11px 16px;
        border-radius:999px;
        background:#fff;
        border:1px solid #f1dfcf;
        color:var(--ck-orange);
        font-size:14px;
        font-weight:800;
        box-shadow:0 8px 18px rgba(235,122,47,.06);
    }

    .step-card{
        background:linear-gradient(180deg,#ffffff 0%,#fcfdff 100%);
        border:1px solid var(--ck-line);
        border-radius:var(--ck-radius-xl);
        box-shadow:var(--ck-shadow-md);
        padding:28px 26px 30px;
        position:relative;
        overflow:hidden;
    }

    .step-card::before{
        content:"";
        position:absolute;
        right:-70px;
        top:-70px;
        width:220px;
        height:220px;
        background:radial-gradient(circle,rgba(15,23,61,.05) 0%,transparent 72%);
        pointer-events:none;
    }

    .section-divider{
        height:4px;
        width:100%;
        background:linear-gradient(90deg,var(--ck-orange),rgba(235,122,47,.08));
        border-radius:999px;
        margin-bottom:24px;
    }

    .step-head{
        display:flex;
        align-items:flex-start;
        gap:16px;
        margin-bottom:24px;
        position:relative;
        z-index:2;
    }

    .step-badge{
        width:54px;
        height:54px;
        border-radius:18px;
        background:linear-gradient(135deg,#fff4eb 0%,#ffe8d8 100%);
        color:var(--ck-orange);
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:22px;
        flex-shrink:0;
    }

    .step-title-wrap h2{
        margin:0;
        font-size:24px;
        line-height:1.15;
        color:var(--ck-navy-2);
        font-weight:900;
    }

    .step-title-wrap p{
        margin:6px 0 0;
        color:var(--ck-text-soft);
        font-size:15px;
        font-weight:500;
    }

    .field-block + .field-block{
        margin-top:24px;
    }

    .field-label{
        margin:0 0 10px;
        font-size:16px;
        color:var(--ck-navy);
        font-weight:800;
        display:block;
    }

    .req{
        color:var(--ck-red);
    }

    .field-sub{
        margin:-2px 0 14px;
        font-size:14px;
        color:var(--ck-text-soft);
        font-weight:500;
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
        background:linear-gradient(135deg,var(--ck-orange),var(--ck-orange-2));
        color:#fff;
        padding:9px 14px;
        border-radius:999px;
        font-size:13px;
        font-weight:800;
        white-space:nowrap;
    }

    .project-grid{
        display:grid;
        grid-template-columns:repeat(3,minmax(0,1fr));
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
        min-height:64px;
        border:1.5px solid var(--ck-line-dark);
        border-radius:var(--ck-radius-md);
        background:linear-gradient(180deg,#ffffff 0%,#fbfcfe 100%);
        display:flex;
        align-items:center;
        gap:14px;
        padding:14px 16px;
        cursor:pointer;
        transition:.22s ease;
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
        transform:translateY(-2px);
        box-shadow:var(--ck-shadow-sm);
        border-color:#c7d3e4;
    }

    .project-item input:checked + label{
        border-color:var(--ck-orange);
        background:linear-gradient(180deg,#fffaf6 0%,#fff2e9 100%);
        box-shadow:0 10px 18px rgba(235,122,47,.08);
    }

    .project-item input:checked + label::before{
        background:linear-gradient(135deg,var(--ck-orange),var(--ck-orange-2));
        border-color:var(--ck-orange);
        box-shadow:inset 0 0 0 4px #fff;
    }

    .structure-grid{
        display:grid;
        grid-template-columns:repeat(3,minmax(0,1fr));
        gap:18px;
        max-width:820px;
    }

    .card-option label{
        min-height:142px;
        border:1.5px solid var(--ck-line-dark);
        border-radius:var(--ck-radius-lg);
        background:linear-gradient(180deg,#ffffff 0%,#fbfcfe 100%);
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        gap:13px;
        text-align:center;
        padding:18px 14px;
        cursor:pointer;
        transition:.25s ease;
        position:relative;
        overflow:hidden;
    }

    .card-option label:hover{
        transform:translateY(-4px);
        box-shadow:var(--ck-shadow-sm);
        border-color:#c7d3e4;
    }

    .card-icon{
        width:62px;
        height:62px;
        border-radius:18px;
        background:#f2f6fc;
        color:var(--ck-navy-3);
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:28px;
        position:relative;
        z-index:2;
        transition:.24s ease;
    }

    .card-text{
        font-size:17px;
        line-height:1.35;
        color:var(--ck-navy-2);
        font-weight:800;
        position:relative;
        z-index:2;
    }

    .card-option input:checked + label{
        border-color:var(--ck-orange);
        background:linear-gradient(180deg,#fffaf6 0%,#fff2e9 100%);
        box-shadow:0 16px 28px rgba(235,122,47,.10);
    }

    .card-option input:checked + label .card-icon{
        background:#ffe7d6;
        color:var(--ck-orange);
        transform:scale(1.03);
    }

    .card-option input:checked + label::before{
        content:"\f00c";
        font-family:"Font Awesome 6 Free";
        font-weight:900;
        position:absolute;
        top:12px;
        right:12px;
        width:24px;
        height:24px;
        border-radius:50%;
        background:var(--ck-orange);
        color:#fff;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:9px;
        z-index:3;
    }

    .chip-grid{
        display:flex;
        flex-wrap:wrap;
        gap:12px;
    }

    .chip-option label{
        min-height:54px;
        padding:0 18px;
        border-radius:var(--ck-radius-sm);
        border:1.5px solid var(--ck-line-dark);
        background:linear-gradient(180deg,#ffffff 0%,#fbfcfe 100%);
        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap:10px;
        cursor:pointer;
        font-size:15px;
        color:var(--ck-navy-2);
        font-weight:700;
        transition:.22s ease;
    }

    .chip-option label:hover{
        transform:translateY(-1px);
        box-shadow:var(--ck-shadow-sm);
    }

    .chip-option input:checked + label{
        border-color:var(--ck-orange);
        background:linear-gradient(180deg,#fffaf6 0%,#fff2e9 100%);
        color:var(--ck-navy);
        box-shadow:0 10px 18px rgba(235,122,47,.08);
    }

    .form-grid-2{
        display:grid;
        grid-template-columns:repeat(2,minmax(0,1fr));
        gap:20px 24px;
    }

    .form-select,
    .form-input,
    .form-textarea{
        width:100%;
        border:1.5px solid var(--ck-line-dark);
        border-radius:var(--ck-radius-md);
        background:#fff;
        color:var(--ck-text);
        font-size:16px;
        padding:0 18px;
        outline:none;
        transition:.22s ease;
        font-family:inherit;
    }

    .form-select,
    .form-input{
        height:60px;
    }

    .form-textarea{
        min-height:150px;
        padding:18px;
        resize:vertical;
    }

    .form-select:focus,
    .form-input:focus,
    .form-textarea:focus{
        border-color:var(--ck-orange);
        box-shadow:0 0 0 4px rgba(235,122,47,.08);
    }

    .switch-panel{
        min-height:92px;
        border:1.5px solid var(--ck-line);
        border-radius:var(--ck-radius-lg);
        background:linear-gradient(180deg,#ffffff 0%,#fbfcfe 100%);
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:14px;
        padding:18px 20px;
        cursor:pointer;
        transition:.22s ease;
    }

    .switch-panel:hover{
        box-shadow:var(--ck-shadow-sm);
        border-color:#c6d3e4;
    }

    .switch-panel-title{
        font-size:16px;
        color:var(--ck-navy);
        font-weight:800;
    }

    .switch-panel-sub{
        margin-top:4px;
        font-size:13px;
        color:var(--ck-text-soft);
        font-weight:500;
    }

    .switch-ui{
        width:70px;
        height:38px;
        border-radius:999px;
        background:#d8e0ec;
        position:relative;
        flex-shrink:0;
        transition:.22s ease;
    }

    .switch-ui::before{
        content:"";
        position:absolute;
        top:4px;
        left:4px;
        width:30px;
        height:30px;
        border-radius:50%;
        background:#fff;
        box-shadow:0 4px 10px rgba(0,0,0,.10);
        transition:.22s ease;
    }

    .toggle-switch input:checked + label .switch-ui{
        background:#ffd7bf;
    }

    .toggle-switch input:checked + label .switch-ui::before{
        left:36px;
    }

    .upload-grid{
        display:grid;
        grid-template-columns:repeat(3,minmax(0,1fr));
        gap:18px 24px;
    }

    .upload-title{
        margin:0 0 10px;
        font-size:15px;
        color:var(--ck-navy);
        font-weight:800;
    }

    .upload-box{
        min-height:148px;
        border:1.8px dashed #c6d5e8;
        border-radius:var(--ck-radius-lg);
        background:linear-gradient(180deg,#ffffff 0%,#fbfcfe 100%);
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        gap:9px;
        text-align:center;
        padding:16px;
        cursor:pointer;
        transition:.22s ease;
    }

    .upload-box:hover{
        transform:translateY(-2px);
        box-shadow:var(--ck-shadow-sm);
        border-color:#a9c0de;
    }

    .upload-box.active{
        border-color:var(--ck-orange);
        background:linear-gradient(180deg,#fffaf6 0%,#fff2e9 100%);
    }

    .upload-icon{
        font-size:36px;
        color:#88a0c3;
        line-height:1;
    }

    .upload-text{
        font-size:15px;
        color:var(--ck-navy-3);
        font-weight:500;
    }

    .file-name{
        margin-top:8px;
        font-size:12px;
        font-weight:800;
        color:var(--ck-navy);
        word-break:break-word;
    }

    .submit-bar{
        background:linear-gradient(135deg,rgba(255,255,255,.97) 0%,rgba(255,255,255,.93) 100%);
        border:1px solid var(--ck-line);
        border-radius:24px;
        box-shadow:var(--ck-shadow-md);
        padding:18px 22px;
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:18px;
        flex-wrap:wrap;
    }

    .submit-bar-actions{
        display:flex;
        align-items:center;
        gap:14px;
        flex-wrap:wrap;
    }

    .submit-btn{
        min-width:350px;
        height:70px;
        border:none;
        border-radius:18px;
        background:linear-gradient(135deg,var(--ck-orange),var(--ck-orange-2));
        color:#fff;
        font-size:19px;
        font-weight:900;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap:14px;
        box-shadow:var(--ck-shadow-lg);
        transition:.22s ease;
        cursor:pointer;
    }

    .submit-btn:hover{
        transform:translateY(-2px);
        box-shadow:0 22px 40px rgba(235,122,47,.24);
    }

    .agreement-view-btn{
        height:60px;
        padding:0 24px;
        border:2px solid var(--ck-navy-2);
        border-radius:16px;
        background:transparent;
        color:var(--ck-navy-2);
        font-size:16px;
        font-weight:800;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap:10px;
        cursor:pointer;
        transition:all .22s ease;
        white-space:nowrap;
    }

    .agreement-view-btn:hover{
        background:var(--ck-navy-2);
        color:#fff;
    }

    .agreement-view-btn.accepted{
        border-color:#16a34a;
        color:#16a34a;
    }

    .agreement-view-btn.accepted:hover{
        background:#16a34a;
        color:#fff;
    }

    .agreement-pending-notice{
        display:flex;
        align-items:center;
        gap:8px;
        font-size:13px;
        font-weight:700;
        color:#c2410c;
        background:#fff7ed;
        border:1px solid #fed7aa;
        border-radius:10px;
        padding:8px 14px;
    }

    .agreement-accepted-badge{
        display:none;
        align-items:center;
        gap:8px;
        font-size:13px;
        font-weight:700;
        color:#027a48;
        background:#ecfdf3;
        border:1px solid #abefc6;
        border-radius:10px;
        padding:8px 14px;
    }

    .agreement-accepted-badge.visible{
        display:flex;
    }

    .agreement-pending-notice.hidden{
        display:none;
    }

    .submit-note{
        max-width:500px;
        color:var(--ck-text-soft);
        font-size:14px;
        font-weight:500;
        line-height:1.5;
    }

    .text-danger{
        color:var(--ck-red);
        font-size:12px;
        margin-top:8px;
        display:block;
        font-weight:700;
    }

    .text-muted{
        color:var(--ck-text-soft);
        font-size:13px;
        font-weight:500;
    }

    .alert-success{
        background:#ecfdf3;
        color:#027a48;
        border:1px solid #abefc6;
        padding:12px 14px;
        border-radius:14px;
        font-weight:700;
    }

    .alert-error{
        background:#fef2f2;
        color:#b91c1c;
        border:1px solid #fecaca;
        padding:12px 14px;
        border-radius:14px;
        font-weight:700;
    }

    .error-list{
        margin:0;
        padding-left:18px;
    }

    .area-loading{
        display:none;
        font-size:13px;
        color:var(--ck-text-soft);
        font-weight:600;
        margin-top:8px;
    }

    .area-loading.visible{
        display:block;
    }

    .agreement-status-card{
        background:linear-gradient(180deg,#ffffff 0%,#fbfcfe 100%);
        border:1.5px solid var(--ck-line-dark);
        border-radius:18px;
        padding:18px;
    }

    .agreement-status-title{
        font-size:16px;
        font-weight:900;
        color:var(--ck-navy);
        margin-bottom:14px;
    }

    .agreement-status-grid{
        display:grid;
        grid-template-columns:repeat(3,minmax(0,1fr));
        gap:12px;
    }

    .agreement-status-item{
        min-height:54px;
        border-radius:14px;
        border:1px solid #e5eaf2;
        background:#fff;
        display:flex;
        align-items:center;
        gap:10px;
        padding:12px 14px;
        font-size:14px;
        font-weight:800;
        color:#64748b;
    }

    .agreement-status-item.accepted{
        background:#ecfdf3;
        border-color:#abefc6;
        color:#027a48;
    }

    .agreement-status-item.pending{
        background:#fff7ed;
        border-color:#fed7aa;
        color:#c2410c;
    }

    .agreement-status-icon{
        width:26px;
        height:26px;
        border-radius:50%;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        flex-shrink:0;
    }

    .agreement-status-item.accepted .agreement-status-icon{
        background:#16a34a;
        color:#fff;
    }

    .agreement-status-item.pending .agreement-status-icon{
        background:#f97316;
        color:#fff;
    }

    .agreement-modal-overlay{
        position:fixed;
        inset:0;
        background:rgba(15,23,61,.72);
        display:none;
        align-items:center;
        justify-content:center;
        z-index:99999;
        padding:18px;
    }

    .agreement-modal-overlay.active{
        display:flex;
    }

    .agreement-modal{
        width:100%;
        max-width:980px;
        max-height:92vh;
        background:#fff;
        border-radius:24px;
        box-shadow:0 30px 90px rgba(0,0,0,.28);
        overflow:hidden;
        display:flex;
        flex-direction:column;
    }

    .agreement-modal-header{
        padding:20px 24px;
        background:linear-gradient(135deg,#fff4eb 0%,#ffffff 100%);
        border-bottom:1px solid #f1dfcf;
        display:flex;
        justify-content:space-between;
        align-items:flex-start;
        gap:16px;
    }

    .agreement-modal-header h2{
        margin:0;
        font-size:22px;
        color:var(--ck-navy);
        font-weight:900;
    }

    .agreement-modal-header p{
        margin:6px 0 0;
        font-size:14px;
        color:var(--ck-text-soft);
        font-weight:500;
    }

    .agreement-close-btn{
        width:38px;
        height:38px;
        border:none;
        border-radius:50%;
        background:#fff;
        color:var(--ck-navy);
        font-size:18px;
        cursor:pointer;
        box-shadow:var(--ck-shadow-sm);
    }

    .agreement-modal-body{
        padding:24px;
        overflow-y:auto;
        color:#1f2937;
        line-height:1.65;
        font-size:14px;
    }

    .agreement-modal-body h3{
        margin:18px 0 8px;
        font-size:17px;
        color:var(--ck-navy);
        font-weight:900;
    }

    .agreement-modal-body p{
        margin:0 0 10px;
    }

    .agreement-modal-body ul{
        margin:6px 0 12px 20px;
    }

    .agreement-title-box{
        text-align:center;
        border:1px solid #f1dfcf;
        border-radius:18px;
        background:#fffaf6;
        padding:16px;
        margin-bottom:18px;
    }

    .agreement-title-box h1{
        margin:0;
        font-size:22px;
        color:var(--ck-navy);
        font-weight:900;
    }

    .agreement-title-box h4{
        margin:6px 0 0;
        color:var(--ck-orange);
        font-weight:900;
    }

    .agreement-checks{
        padding:18px 24px;
        border-top:1px solid var(--ck-line);
        background:#fbfcfe;
    }

    .agreement-check-row{
        display:flex;
        gap:10px;
        align-items:flex-start;
        margin-bottom:12px;
        color:var(--ck-text);
        font-size:14px;
        font-weight:600;
    }

    .agreement-check-row input{
        margin-top:4px;
        width:18px;
        height:18px;
        flex-shrink:0;
    }

    .agreement-modal-footer{
        padding:16px 24px;
        border-top:1px solid var(--ck-line);
        display:flex;
        justify-content:flex-end;
        gap:12px;
        flex-wrap:wrap;
    }

    .agreement-cancel-btn,
    .agreement-submit-btn{
        height:48px;
        border-radius:14px;
        padding:0 22px;
        font-weight:900;
        cursor:pointer;
        border:none;
    }

    .agreement-cancel-btn{
        background:#f3f4f6;
        color:#374151;
    }

    .agreement-submit-btn{
        background:linear-gradient(135deg,var(--ck-orange),var(--ck-orange-2));
        color:#fff;
        box-shadow:var(--ck-shadow-lg);
    }

    .agreement-submit-btn:disabled{
        opacity:.55;
        cursor:not-allowed;
    }

    .agreement-modal.readonly-mode .agreement-checks,
    .agreement-modal.readonly-mode .agreement-modal-footer{
        display:none;
    }

    .agreement-modal.readonly-mode .agreement-modal-header{
        background:linear-gradient(135deg,#ecfdf3 0%,#ffffff 100%);
        border-bottom-color:#abefc6;
    }

    .agreement-readonly-banner{
        display:none;
        margin:0 24px 0;
        padding:12px 16px;
        background:#ecfdf3;
        border:1px solid #abefc6;
        border-radius:12px;
        color:#027a48;
        font-size:14px;
        font-weight:700;
        align-items:center;
        gap:10px;
    }

    .agreement-modal.readonly-mode .agreement-readonly-banner{
        display:flex;
    }

    .select2-container{
        width:100% !important;
    }

    .select2-container--default .select2-selection--single,
    .select2-container--default .select2-selection--multiple{
        width:100% !important;
        border:1.5px solid var(--ck-line-dark) !important;
        border-radius:var(--ck-radius-md) !important;
        background:#fff !important;
        color:var(--ck-text) !important;
        font-size:16px !important;
        box-shadow:none !important;
    }

    .select2-container--default .select2-selection--single{
        height:60px !important;
        display:flex !important;
        align-items:center !important;
        padding:0 18px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered{
        color:var(--ck-text) !important;
        line-height:58px !important;
        padding-left:0 !important;
        padding-right:34px !important;
        font-size:16px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow{
        height:60px !important;
        right:14px !important;
    }

    .select2-container--default .select2-selection--multiple{
        min-height:60px !important;
        padding:8px 12px !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered{
        display:flex !important;
        flex-wrap:wrap !important;
        gap:6px !important;
        padding:0 !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        background:#eef4ff !important;
        border:1px solid #c7d8ff !important;
        color:#10204f !important;
        border-radius:999px !important;
        padding:5px 10px !important;
        font-size:14px !important;
        margin:0 !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
        color:#10204f !important;
        border-right:none !important;
        margin-right:6px !important;
    }

    .select2-dropdown{
        border:1px solid var(--ck-line-dark) !important;
        border-radius:12px !important;
        overflow:hidden;
    }

    .select2-results__option{
        padding:10px 14px !important;
        font-size:15px !important;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected]{
        background:var(--ck-navy) !important;
        color:#fff !important;
    }

    @media(max-width:1100px){
        .project-grid,
        .upload-grid{
            grid-template-columns:repeat(2,minmax(0,1fr));
        }
    }

    @media(max-width:992px){
        .form-grid-2{
            grid-template-columns:1fr;
        }

        .structure-grid{
            grid-template-columns:repeat(2,minmax(0,1fr));
        }

        .agreement-status-grid{
            grid-template-columns:1fr;
        }

        .submit-bar-actions{
            width:100%;
            flex-direction:column;
            align-items:stretch;
        }

        .agreement-view-btn,
        .submit-btn{
            width:100%;
            min-width:100%;
            justify-content:center;
        }
    }

    @media(max-width:768px){
        .audit-page{
            padding:12px 0 22px;
        }

        .top-banner{
            padding:18px 16px;
            border-radius:20px;
        }

        .top-banner h1{
            font-size:22px;
        }

        .step-card{
            padding:18px 16px;
            border-radius:20px;
        }

        .step-title-wrap h2{
            font-size:20px;
        }

        .vendor-bar{
            flex-direction:column;
            align-items:flex-start;
        }

        .project-grid,
        .structure-grid,
        .upload-grid{
            grid-template-columns:1fr;
        }

        .submit-btn{
            width:100%;
            min-width:100%;
            height:60px;
        }

        .submit-bar{
            padding:16px;
        }

        .agreement-modal{
            max-height:95vh;
            border-radius:18px;
        }

        .agreement-modal-header,
        .agreement-modal-body,
        .agreement-checks,
        .agreement-modal-footer{
            padding:16px;
        }

        .agreement-modal-header h2{
            font-size:18px;
        }
    }
</style>

@php
    $existingData = $existingData ?? (object)[];
    $workType = $workType ?? null;
    $projectTypes = $projectTypes ?? collect();
    $cities = $cities ?? collect();

    $structureTypes = [
        ['name' => 'RCC', 'icon' => 'fa-solid fa-table-cells-large'],
        ['name' => 'Steel', 'icon' => 'fa-solid fa-compass-drafting'],
        ['name' => 'Foundation', 'icon' => 'fa-solid fa-grip-lines'],
    ];

    $auditTypes = [
        ['name' => 'Structural Stability Audit', 'icon' => 'fa-solid fa-shield-halved'],
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

    $decodeArray = function ($value) {
        if (is_array($value)) {
            return $value;
        }

        for ($i = 0; $i < 2; $i++) {
            if (is_string($value) && $value !== '') {
                $decoded = json_decode($value, true);

                if (json_last_error() === JSON_ERROR_NONE) {
                    $value = $decoded;
                } else {
                    break;
                }
            }
        }

        return is_array($value) ? $value : [];
    };

    $oldAssetTypes = old('asset_types', $decodeArray($existingData->asset_types ?? null));
    $oldStructureTypes = old('structure_types', $decodeArray($existingData->structure_types ?? null));
    $oldAuditTypes = old('audit_types', $decodeArray($existingData->audit_types ?? null));
    $oldDeliverables = old('deliverables', $decodeArray($existingData->deliverables ?? null));

    $selectedCityIds = old('city_ids', !empty($existingData->city_ids)
        ? $decodeArray($existingData->city_ids)
        : (!empty($existingData->city_id) ? [$existingData->city_id] : [])
    );
    $selectedCityIds = is_array($selectedCityIds) ? array_map('strval', $selectedCityIds) : [];

    $selectedAreaIds = old('area_ids', !empty($existingData->area_ids)
        ? $decodeArray($existingData->area_ids)
        : []
    );
    $selectedAreaIds = is_array($selectedAreaIds) ? array_map('strval', $selectedAreaIds) : [];

    $savedPincodes = old('pincode', $existingData->pincode ?? '');

    $termsAccepted = (int)($existingData->agreement_terms_accepted ?? 0) === 1;
    $privacyAccepted = (int)($existingData->privacy_policy_accepted ?? 0) === 1;
    $newsletterAccepted = (int)($existingData->newsletter_opt_in ?? 0) === 1;

    $fullyAgreed = $termsAccepted && $privacyAccepted;

    $agreementDate = now()->format('d F Y');
@endphp

<div class="audit-page">
    <div class="audit-stack">

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                <ul class="error-list">
                    @foreach($errors->all() as $error)
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

        <form action="{{ route('structural_audit.store') }}" method="POST" enctype="multipart/form-data" id="structuralAuditForm">
            @csrf

            <input type="hidden" name="agreement_terms_accepted" id="agreement_terms_accepted" value="{{ $termsAccepted ? 1 : 0 }}">
            <input type="hidden" name="privacy_policy_accepted" id="privacy_policy_accepted" value="{{ $privacyAccepted ? 1 : 0 }}">
            <input type="hidden" name="newsletter_opt_in" id="newsletter_opt_in" value="{{ $newsletterAccepted ? 1 : 0 }}">
            <input type="hidden" name="agreement_accepted_at" id="agreement_accepted_at" value="{{ $existingData->agreement_accepted_at ?? '' }}">

            <div class="step-card">
                <div class="step-head">
                    <div class="step-badge">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div class="step-title-wrap">
                        <h2>Asset Type Expertise</h2>
                        <p>Select all asset types you have experience with</p>
                    </div>
                </div>

                <div class="field-block">
                    <div class="field-label">Work Type</div>
                    <div class="vendor-bar">
                        <div class="vendor-value">{{ $workType->work_type ?? 'Structural Audit' }}</div>
                        <div class="vendor-chip">{{ $workType->work_type ?? 'Structural Audit' }}</div>
                    </div>
                </div>

                <div class="field-block">
                    <div class="field-label">Project / Asset Type <span class="req">*</span></div>
                    <div class="field-sub">Select all project types you have experience in</div>

                    <div class="project-grid">
                        @forelse($projectTypes as $index => $type)
                            <div class="project-item">
                                <input
                                    type="checkbox"
                                    id="asset_type_{{ $index }}"
                                    name="asset_types[]"
                                    value="{{ $type }}"
                                    {{ in_array($type, old('asset_types', $oldAssetTypes)) ? 'checked' : '' }}
                                >
                                <label for="asset_type_{{ $index }}">{{ $type }}</label>
                            </div>
                        @empty
                            <p style="color:red; font-weight:600;">No project types found.</p>
                        @endforelse
                    </div>

                    @error('asset_types')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="step-card">
                <div class="section-divider"></div>

                <div class="step-head">
                    <div class="step-badge">
                        <i class="fa-solid fa-diagram-project"></i>
                    </div>
                    <div class="step-title-wrap">
                        <h2>Structure Type Expertise</h2>
                        <p>Types of structures you specialise in</p>
                    </div>
                </div>

                <div class="structure-grid">
                    @foreach($structureTypes as $index => $item)
                        <div class="card-option">
                            <input
                                type="checkbox"
                                id="structure_{{ $index }}"
                                name="structure_types[]"
                                value="{{ $item['name'] }}"
                                {{ in_array($item['name'], old('structure_types', $oldStructureTypes)) ? 'checked' : '' }}
                            >
                            <label for="structure_{{ $index }}">
                                <div class="card-icon">
                                    <i class="{{ $item['icon'] }}"></i>
                                </div>
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
                    <div class="step-badge">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <div class="step-title-wrap">
                        <h2>Audit Type Expertise</h2>
                        <p>Select all audit types you can perform</p>
                    </div>
                </div>

                <div class="chip-grid">
                    @foreach($auditTypes as $index => $item)
                        <div class="chip-option">
                            <input
                                type="checkbox"
                                id="audit_{{ $index }}"
                                name="audit_types[]"
                                value="{{ $item['name'] }}"
                                {{ in_array($item['name'], old('audit_types', $oldAuditTypes)) ? 'checked' : '' }}
                            >
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
                    <div class="step-badge">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </div>
                    <div class="step-title-wrap">
                        <h2>Service Scope / Deliverables</h2>
                        <p>What services and deliverables can you provide?</p>
                    </div>
                </div>

                <div class="chip-grid">
                    @foreach($deliverables as $index => $item)
                        <div class="chip-option">
                            <input
                                type="checkbox"
                                id="deliverable_{{ $index }}"
                                name="deliverables[]"
                                value="{{ $item['name'] }}"
                                {{ in_array($item['name'], old('deliverables', $oldDeliverables)) ? 'checked' : '' }}
                            >
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
                    <div class="step-badge">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <div class="step-title-wrap">
                        <h2>Technical &amp; Business Information</h2>
                        <p>Operational and compliance details</p>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="field-block">
                        <label class="field-label" for="team_size">Team Size</label>
                        <select class="form-select" id="team_size" name="team_size">
                            <option value="">Select team size</option>
                            @foreach(['1-5','6-10','11-25','26-50','50+'] as $opt)
                                <option value="{{ $opt }}" {{ old('team_size', $existingData->team_size ?? '') == $opt ? 'selected' : '' }}>
                                    {{ $opt }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="field-block">
                        <label class="field-label" for="company_name">Company / Consultant Name <span class="req">*</span></label>
                        <input
                            type="text"
                            class="form-input"
                            id="company_name"
                            name="company_name"
                            placeholder="Enter company / consultant name"
                            value="{{ old('company_name', $existingData->company_name ?? '') }}"
                            required
                        >
                    </div>

                    <div class="field-block" style="grid-column:1/-1;">
                        <label class="field-label" for="registered_address">Registered Office Address <span class="req">*</span></label>
                        <textarea
                            class="form-textarea"
                            id="registered_address"
                            name="registered_address"
                            placeholder="Enter registered office address"
                            required
                        >{{ old('registered_address', $existingData->registered_address ?? '') }}</textarea>
                    </div>

                    <div class="field-block">
                        <label class="field-label" for="city_ids">City <span class="req">*</span></label>
                        <select class="form-select" name="city_ids[]" id="city_ids" multiple required>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ in_array((string)$city->id, $selectedCityIds) ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="field-block">
                        <label class="field-label" for="area_ids">Area <span class="req">*</span></label>
                        <select class="form-select" name="area_ids[]" id="area_ids" multiple required>
                            @foreach($selectedAreaIds as $aId)
                                <option value="{{ $aId }}" selected>{{ $aId }}</option>
                            @endforeach
                        </select>

                        <small class="area-loading" id="areaLoading">
                            <i class="fa-solid fa-spinner fa-spin"></i> Loading areas…
                        </small>
                    </div>

                    <div class="field-block">
                        <label class="field-label" for="pincode_id">Pincode <span class="req">*</span></label>
                        <textarea
                            class="form-textarea"
                            id="pincode_id"
                            name="pincode"
                            readonly
                            required
                            placeholder="Pincodes auto-fill from selected areas"
                        >{{ $savedPincodes }}</textarea>
                    </div>

                    <div class="field-block">
                        <label class="field-label" for="minimum_project_value">Minimum Project Value Accepted</label>
                        <input
                            type="number"
                            step="1"
                            min="0"
                            class="form-input"
                            name="minimum_project_value"
                            id="minimum_project_value"
                            value="{{ old('minimum_project_value', $existingData->minimum_project_value ?? '') }}"
                            placeholder="Enter minimum project value"
                        >
                        <small class="text-muted">
                            Please enter amount in numbers only. Example: 500000 for ₹5 Lakhs. Do not write 5 Lakhs or 5L.
                        </small>
                    </div>

                    <div class="field-block">
                        <div class="toggle-switch">
                            <input
                                type="checkbox"
                                id="emergency_inspection"
                                name="available_for_emergency_inspection"
                                value="1"
                                {{ old('available_for_emergency_inspection', $existingData->available_for_emergency_inspection ?? '') ? 'checked' : '' }}
                            >
                            <label class="switch-panel" for="emergency_inspection">
                                <div>
                                    <div class="switch-panel-title">Available for Emergency Inspection?</div>
                                    <div class="switch-panel-sub">Urgent site visits within 24–48 hrs</div>
                                </div>
                                <div class="switch-ui"></div>
                            </label>
                        </div>
                    </div>

                    <div class="field-block">
                        <div class="toggle-switch">
                            <input
                                type="checkbox"
                                id="site_visit"
                                name="available_for_site_visit"
                                value="1"
                                {{ old('available_for_site_visit', $existingData->available_for_site_visit ?? '') ? 'checked' : '' }}
                            >
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
                        <label class="field-label" for="gst_number">GST Number</label>
                        <input
                            type="text"
                            class="form-input"
                            id="gst_number"
                            name="gst_number"
                            placeholder="Enter GST number"
                            value="{{ old('gst_number', $existingData->gst_number ?? '') }}"
                        >
                    </div>

                    <div class="field-block">
                        <label class="field-label" for="pan_number">PAN Number</label>
                        <input
                            type="text"
                            class="form-input"
                            id="pan_number"
                            name="pan_number"
                            placeholder="Enter PAN number"
                            value="{{ old('pan_number', $existingData->pan_number ?? '') }}"
                        >
                    </div>

                    <div class="field-block" style="grid-column:1/-1;">
                        <div class="toggle-switch">
                            <input
                                type="checkbox"
                                id="msme_udyam"
                                name="msme_udyam_registered"
                                value="1"
                                {{ old('msme_udyam_registered', $existingData->msme_udyam_registered ?? '') ? 'checked' : '' }}
                            >
                            <label class="switch-panel" for="msme_udyam">
                                <div>
                                    <div class="switch-panel-title">MSME / Udyam Registered?</div>
                                    <div class="switch-panel-sub">Micro, Small &amp; Medium Enterprise registration</div>
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
                                <div class="upload-icon">
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                </div>
                                <div class="upload-text">Click to upload PDF, JPG, PNG</div>
                            </label>
                            <input type="file" id="certificate_file" name="certificate_file" accept=".pdf,.jpg,.jpeg,.png">
                            <div class="file-name" id="certificate_file_name"></div>

                            @if(!empty($existingData->certificate_file))
                                <div style="margin-top:8px;">
                                    <a href="{{ asset('storage/'.$existingData->certificate_file) }}" target="_blank">
                                        View Uploaded Certificate
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="upload-item" id="company_profile_wrap">
                            <div class="upload-title">Upload Company Profile</div>
                            <label for="company_profile_file" class="upload-box">
                                <div class="upload-icon">
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                </div>
                                <div class="upload-text">Click to upload PDF, DOC</div>
                            </label>
                            <input type="file" id="company_profile_file" name="company_profile_file" accept=".pdf,.doc,.docx">
                            <div class="file-name" id="company_profile_file_name"></div>

                            @if(!empty($existingData->company_profile_file))
                                <div style="margin-top:8px;">
                                    <a href="{{ asset('storage/'.$existingData->company_profile_file) }}" target="_blank">
                                        View Uploaded Company Profile
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="upload-item" id="logo_wrap">
                            <div class="upload-title">Upload Logo</div>
                            <label for="logo_file" class="upload-box">
                                <div class="upload-icon">
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                </div>
                                <div class="upload-text">Click to upload JPG, PNG, SVG</div>
                            </label>
                            <input type="file" id="logo_file" name="logo_file" accept=".jpg,.jpeg,.png,.svg">
                            <div class="file-name" id="logo_file_name"></div>

                            @if(!empty($existingData->logo_file))
                                <div style="margin-top:8px;">
                                    <a href="{{ asset('storage/'.$existingData->logo_file) }}" target="_blank">
                                        View Uploaded Logo
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="step-card">
                <div class="section-divider"></div>

                <div class="step-head">
                    <div class="step-badge">
                        <i class="fa-solid fa-pen"></i>
                    </div>
                    <div class="step-title-wrap">
                        <h2>Final Details</h2>
                        <p>Tell us more about your services</p>
                    </div>
                </div>

                <div class="field-block">
                    <label class="field-label" for="service_description">Brief Description of Services</label>
                    <textarea
                        class="form-textarea"
                        id="service_description"
                        name="service_description"
                        placeholder="Describe your core structural audit services, specialisations, and key strengths..."
                    >{{ old('service_description', $existingData->service_description ?? '') }}</textarea>
                </div>

                <div class="field-block">
                    <label class="field-label" for="major_cities_covered">Major Cities Covered</label>
                    <input
                        type="text"
                        class="form-input"
                        id="major_cities_covered"
                        name="major_cities_covered"
                        placeholder="e.g. Mumbai, Pune, Navi Mumbai, Thane"
                        value="{{ old('major_cities_covered', $existingData->major_cities_covered ?? '') }}"
                    >
                </div>
            </div>

            <div class="submit-bar">
                <div class="submit-bar-actions">
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

                    <button type="button" class="submit-btn" id="submitFormBtn">
                        <i class="fa-regular fa-paper-plane"></i>
                        <span>Submit Structural Audit Profile</span>
                    </button>
                </div>

                <div class="submit-note">
                    By submitting, your Structural Audit profile details will be saved or updated.
                    @if(!$fullyAgreed)
                        <br><strong style="color:#c2410c;">Agreement can be accepted separately using the agreement button.</strong>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<div class="agreement-modal-overlay" id="agreementModal">
    <div class="agreement-modal" id="agreementModalInner">
        <div class="agreement-modal-header">
            <div>
                <h2>Project Execution &amp; Representation Agreement</h2>
                <p id="agreementModalSubtitle">Please read and accept the agreement.</p>
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
                Katrang Road, Khopoli-410203, operating under the brand name <strong>"ConstructKaro"</strong>
                shall hereinafter be referred to as <strong>"ConstructKaro"</strong>.
            </p>

            <p><strong>AND</strong></p>

            <p>
                <strong id="agreementCompanyName">{{ old('company_name', $existingData->company_name ?? 'Structural Consultant Company Name') }}</strong>,
                having its principal office at
                <strong id="agreementCompanyAddress">{{ old('registered_address', $existingData->registered_address ?? 'Structural Consultant Office Address') }}</strong>,
                shall hereinafter be referred to as <strong>"Structural Consultant"</strong>.
            </p>

            <p>
                ConstructKaro and Structural Consultant are individually referred to as a "Party" and collectively as the "Parties."
            </p>

            <h3>2. PURPOSE &amp; NATURE OF PLATFORM</h3>
            <p>
                ConstructKaro provides construction and project management services, overseeing execution of construction projects under its brand and contractual responsibility.
            </p>
            <p>
                The Structural Consultant agrees to execute assigned work as per specifications provided by ConstructKaro, adhering to quality standards, timelines, and other project-specific requirements.
            </p>
            <p>
                All projects shall be executed under the ConstructKaro brand. The Structural Consultant shall represent the work exclusively under ConstructKaro unless otherwise agreed in writing.
            </p>
            <p>
                ConstructKaro shall remain the primary contracting party with the customer. The Structural Consultant shall not engage in direct dealings with the customer without prior written consent from ConstructKaro.
            </p>

            <h3>3. INDEPENDENT STRUCTURAL CONSULTANT STATUS</h3>
            <p>
                The Structural Consultant is engaged as an independent Structural Consultant for execution of assigned works under this Agreement.
            </p>
            <ul>
                <li>No partnership, joint venture, employer-employee relationship, or agency is created except limited representation authorized by ConstructKaro.</li>
                <li>The Structural Consultant shall manage its own manpower, staff, and resources.</li>
                <li>The Structural Consultant shall comply with all applicable laws and statutory requirements.</li>
                <li>The Structural Consultant shall execute work at its own risk and cost.</li>
                <li>The Structural Consultant shall act as an Authorized Execution Partner of ConstructKaro.</li>
            </ul>

            <h3>4. STRUCTURAL CONSULTANT OBLIGATIONS</h3>
            <ul>
                <li>Maintain all necessary licenses, registrations, GST compliance, and statutory approvals.</li>
                <li>Execute work strictly as per scope, drawings, BOQ, specifications, and timelines approved by ConstructKaro.</li>
                <li>Ensure site safety, labour welfare, quality, and compliance with applicable laws.</li>
                <li>Deploy qualified manpower, tools, and resources required for proper and timely execution.</li>
                <li>Follow all instructions and execution guidelines issued by ConstructKaro.</li>
                <li>Not represent its own company name, brand, or identity before the customer without written approval.</li>
                <li>Not directly contact, negotiate, or enter into any agreement with the customer.</li>
                <li>Maintain confidentiality of project details, customer information, drawings, BOQs, rates, and data.</li>
                <li>Not subcontract or assign work without prior written approval from ConstructKaro.</li>
            </ul>

            <h3>5. COMMERCIAL TERMS &amp; PAYMENT STRUCTURE</h3>
            <p>
                ConstructKaro shall share project BOQ, scope, drawings, and specifications with the Structural Consultant for rate submission.
                ConstructKaro shall have the exclusive right to determine final project pricing offered to the customer.
            </p>
            <p>
                All billing to the customer shall be done solely by ConstructKaro. The Structural Consultant shall not raise any invoice directly to the customer.
            </p>
            <p>
                Payment to the Structural Consultant shall be on a bill-to-bill basis and subject to receipt of corresponding payment from the customer and quality approval by ConstructKaro.
            </p>

            <h3>6. QUALITY CHECK &amp; PAYMENT RELEASE</h3>
            <p>
                ConstructKaro may appoint a Quality Check Officer to monitor and verify the quality of work.
                Payment shall be released only after inspection, verification, and approval.
            </p>

            <h3>7. NO GUARANTEE &amp; RISK ACKNOWLEDGEMENT</h3>
            <ul>
                <li>ConstructKaro does not guarantee allocation or continuity of any project.</li>
                <li>ConstructKaro does not guarantee specific project size, value, or volume.</li>
                <li>ConstructKaro does not guarantee timely payment from the customer.</li>
                <li>ConstructKaro shall not be liable for delay due to customer non-payment, site conditions, scope changes, or regulatory issues.</li>
            </ul>

            <h3>8. NON-CIRCUMVENTION &amp; NON-SOLICITATION</h3>
            <p>
                The Structural Consultant shall not directly or indirectly contact, solicit, negotiate, or execute work with any customer introduced, assigned, or handled by ConstructKaro except through ConstructKaro.
            </p>
            <p>
                This restriction shall remain valid during the term of this Agreement and for thirty-six (36) months from completion or termination.
                Breach may attract liquidated damages equal to 20% of total project value or ₹5,00,000, whichever is higher.
            </p>

            <h3>9. CONFIDENTIALITY &amp; DATA PROTECTION</h3>
            <p>
                All project details, BOQs, drawings, pricing, specifications, customer information, and commercial terms shared by ConstructKaro shall remain confidential and shall not be disclosed or reused without permission.
            </p>

            <h3>10. INTELLECTUAL PROPERTY &amp; BRANDING</h3>
            <p>
                ConstructKaro retains exclusive ownership of its brand name, logo, trademarks, systems, data, documents, drawings, BOQs, reports, and related intellectual property.
            </p>

            <h3>11. LIABILITY &amp; INDEMNITY</h3>
            <p>
                The Structural Consultant shall indemnify and hold harmless ConstructKaro, its directors, employees, and representatives from claims, losses, damages, penalties, disputes, defective work, delay, negligence, third-party claims, or statutory non-compliance arising from the Structural Consultant’s work.
            </p>
            <p>
                The Structural Consultant shall be fully liable for loss or damage caused due to acts, omissions, negligence, non-compliance, incorrect structural design, wrong calculations, defective assessment, or failure to follow applicable codes and standards.
            </p>

            <h3>12. DISPUTE HANDLING</h3>
            <p>
                Customer-related communication and disputes shall be handled exclusively by ConstructKaro.
                Any dispute between ConstructKaro and the Structural Consultant shall first be attempted to be resolved amicably within thirty (30) days.
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
                This Agreement constitutes the entire understanding between the Parties. If any clause is held invalid, remaining clauses shall continue to be enforceable.
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form             = document.getElementById('structuralAuditForm');
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

    const pendingNotice     = document.getElementById('agreementPendingNotice');
    const acceptedBadge     = document.getElementById('agreementAcceptedBadge');
    const agreementBtnLabel = document.getElementById('agreementBtnLabel');

    const agreementCompanyName = document.getElementById('agreementCompanyName');
    const agreementCompanyAddress = document.getElementById('agreementCompanyAddress');

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

    function refreshAgreementPartyDetails() {
        const companyInput = form.querySelector('[name="company_name"]');
        const addressInput = form.querySelector('[name="registered_address"]');

        if (agreementCompanyName && companyInput) {
            agreementCompanyName.textContent = companyInput.value.trim() || 'Structural Consultant Company Name';
        }

        if (agreementCompanyAddress && addressInput) {
            agreementCompanyAddress.textContent = addressInput.value.trim() || 'Structural Consultant Office Address';
        }
    }

    function openModal(readOnly) {
        refreshAgreementPartyDetails();

        if (readOnly) {
            modalInner.classList.add('readonly-mode');
            modalSubtitle.textContent = 'You can review this agreement at any time.';
        } else {
            modalInner.classList.remove('readonly-mode');
            modalSubtitle.textContent = 'Please read and accept the agreement.';

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

        agreementBtnLabel.textContent = 'View Agreement';

        if (pendingNotice) {
            pendingNotice.classList.add('hidden');
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

        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        form.submit();
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