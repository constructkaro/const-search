@extends('layouts.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<style>
    :root{
        --navy:#1c2c3e;
        --navy-soft:#2e435d;
        --orange:#f25c05;
        --orange-dark:#d94f04;
        --bg:#f4f7fb;
        --card:#ffffff;
        --muted:#6b7280;
        --border:#e5ebf3;
        --input:#fbfcff;
        --success:#16a34a;
        --danger:#dc2626;
        --blue:#2563eb;
        --shadow:0 18px 45px rgba(15,23,42,0.08);
    }

    body{
        background: var(--bg);
        font-family: 'Segoe UI', sans-serif;
    }

    .engineer-detail-page{
        padding: 28px 0 80px;
    }

    .engineer-wrapper{
        max-width: 1540px;
        margin: 0 auto;
        padding: 0 18px;
    }

    .engineer-shell{
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 28px;
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    .engineer-header{
        padding: 34px 38px 28px;
        border-bottom: 1px solid #eef2f7;
        background:
            radial-gradient(circle at top right, rgba(242,92,5,0.10), transparent 25%),
            linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
    }

    .engineer-header-top{
        display:flex;
        justify-content:space-between;
        align-items:flex-start;
        gap:18px;
        flex-wrap:wrap;
    }

    .engineer-title{
        margin:0 0 8px;
        font-size:40px;
        line-height:1.08;
        font-weight:900;
        color:var(--navy);
        letter-spacing:-0.7px;
    }

    .engineer-subtitle{
        margin:0;
        font-size:15px;
        color:var(--muted);
        max-width:850px;
    }

    .header-actions{
        display:flex;
        gap:10px;
        flex-wrap:wrap;
    }

    .header-btn{
        display:inline-flex;
        align-items:center;
        gap:8px;
        text-decoration:none;
        border:none;
        border-radius:16px;
        padding:12px 18px;
        font-weight:700;
        font-size:14px;
        transition:.25s ease;
    }

    .header-btn.back-btn{
        background:#eef3f8;
        color:var(--navy);
    }

    .header-btn.back-btn:hover{
        background:#dde7f1;
        color:var(--navy);
    }

    .header-btn.view-file-btn{
        background:rgba(37,99,235,0.10);
        color:var(--blue);
    }

    .header-btn.view-file-btn:hover{
        background:rgba(37,99,235,0.16);
        color:#1d4ed8;
    }

    .header-badge-row{
        display:flex;
        flex-wrap:wrap;
        gap:12px;
        margin-top:22px;
    }

    .header-badge{
        display:inline-flex;
        align-items:center;
        gap:8px;
        border-radius:999px;
        padding:10px 14px;
        font-size:13px;
        font-weight:700;
        border:1px solid transparent;
    }

    .badge-id{
        background:#eef4ff;
        color:#1d4ed8;
        border-color:#dbe7ff;
    }

    .badge-city{
        background:#effcf6;
        color:#15803d;
        border-color:#d6f7e5;
    }

    .badge-owner{
        background:#fff7ed;
        color:#c2410c;
        border-color:#fed7aa;
    }

    .engineer-body{
        padding:30px 38px 38px;
    }

    .top-grid{
        display:grid;
        grid-template-columns: 1.1fr 1.6fr;
        gap:24px;
        margin-bottom:24px;
        align-items:start;
    }

    .panel-card{
        background:#fff;
        border:1px solid #edf2f8;
        border-radius:24px;
        padding:24px;
        box-shadow:0 10px 24px rgba(15,23,42,0.04);
    }

    .panel-title{
        display:flex;
        align-items:center;
        gap:12px;
        margin:0 0 20px;
        font-size:22px;
        font-weight:800;
        color:var(--navy);
    }

    .panel-title::before{
        content:"";
        width:5px;
        height:24px;
        border-radius:999px;
        background:linear-gradient(180deg, var(--orange), #ff9d4b);
    }

    .lead-detail-grid{
        display:grid;
        grid-template-columns: repeat(2, minmax(0,1fr));
        gap:14px;
    }

    .detail-box{
        background:#fbfcff;
        border:1px solid var(--border);
        border-radius:18px;
        padding:16px;
    }

    .detail-label{
        font-size:12px;
        font-weight:700;
        color:#94a3b8;
        text-transform:uppercase;
        letter-spacing:.5px;
        margin-bottom:8px;
    }

    .detail-value{
        font-size:15px;
        font-weight:700;
        color:var(--navy);
        line-height:1.55;
        word-break:break-word;
    }

    .desc-panel{
        margin-top:16px;
        border:1px solid var(--border);
        border-radius:22px;
        background:linear-gradient(180deg,#fcfdff 0%, #f8fbff 100%);
        padding:18px;
    }

    .desc-panel .desc-label{
        font-size:15px;
        font-weight:800;
        color:var(--navy);
        margin-bottom:10px;
    }

    .desc-panel .desc-value{
        margin:0;
        font-size:14px;
        line-height:1.8;
        color:#4b5563;
        white-space:pre-line;
    }

    .upload-box{
        border:2px dashed #d8e1ec;
        border-radius:22px;
        padding:26px 22px;
        background:linear-gradient(180deg,#fcfdff 0%,#f7fbff 100%);
        text-align:center;
        transition:.25s ease;
    }

    .upload-box:hover{
        border-color:rgba(242,92,5,0.45);
        background:#fff8f2;
    }

    .upload-icon{
        width:60px;
        height:60px;
        margin:0 auto 14px;
        border-radius:50%;
        display:flex;
        align-items:center;
        justify-content:center;
        background:rgba(242,92,5,0.10);
        color:var(--orange);
        font-size:24px;
    }

    .upload-title{
        font-size:18px;
        color:var(--navy);
        font-weight:800;
        margin-bottom:8px;
    }

    .upload-subtitle{
        font-size:13px;
        color:var(--muted);
        margin-bottom:16px;
    }

    .file-chip{
        display:inline-flex;
        align-items:center;
        gap:8px;
        border-radius:14px;
        padding:10px 14px;
        background:#eef4ff;
        color:#1d4ed8;
        font-size:13px;
        font-weight:700;
        text-decoration:none;
    }

    .file-chip:hover{
        background:#dbeafe;
        color:#1d4ed8;
    }

    .engineer-form-card{
        background:#fff;
        border:1px solid #edf2f8;
        border-radius:24px;
        padding:26px;
        box-shadow:0 10px 24px rgba(15,23,42,0.04);
    }

    .section-block{
        background:#fff;
        border:1px solid #edf2f8;
        border-radius:22px;
        padding:22px;
        margin-bottom:20px;
        box-shadow:0 8px 20px rgba(15,23,42,0.03);
    }

    .section-heading{
        display:flex;
        align-items:center;
        gap:12px;
        margin:0 0 18px;
        font-size:20px;
        font-weight:800;
        color:var(--navy);
    }

    .section-heading .icon{
        width:42px;
        height:42px;
        border-radius:14px;
        display:flex;
        align-items:center;
        justify-content:center;
        background:rgba(242,92,5,0.10);
        color:var(--orange);
        font-size:18px;
    }

    .form-label{
        display:block;
        font-size:14px;
        font-weight:700;
        color:var(--navy);
        margin-bottom:8px;
    }

    .form-control-custom,
    .form-select-custom,
    .form-textarea-custom{
        width:100%;
        min-height:56px;
        background:var(--input);
        border:1px solid var(--border);
        border-radius:16px;
        padding:14px 16px;
        font-size:14px;
        color:#1f2937;
        outline:none;
        box-sizing:border-box;
        transition:.25s ease;
    }

    .form-textarea-custom{
        min-height:135px;
        resize:vertical;
    }

    .form-control-custom:focus,
    .form-select-custom:focus,
    .form-textarea-custom:focus{
        border-color:rgba(242,92,5,0.45);
        box-shadow:0 0 0 4px rgba(242,92,5,0.10);
        background:#fff;
    }

    .field-hint{
        font-size:12px;
        color:#94a3b8;
        margin-top:6px;
    }

    .form-grid{
        display:grid;
        grid-template-columns: repeat(1, minmax(0,1fr));
        gap:18px;
    }

    .form-field.full{
        grid-column:1 / -1;
    }

    .toggle-row{
        display:flex;
        gap:14px;
        flex-wrap:wrap;
        margin-top:8px;
    }

    .toggle-card{
        min-width:180px;
        border:1px solid var(--border);
        border-radius:18px;
        padding:14px 16px;
        background:#fbfcff;
        display:flex;
        align-items:center;
        gap:10px;
        cursor:pointer;
        font-weight:700;
        color:var(--navy);
        transition:.25s ease;
    }

    .toggle-card:hover{
        transform:translateY(-1px);
    }

    .toggle-card input{
        margin:0;
    }

    .toggle-card.yes{
        background:#f0fdf4;
        border-color:#bbf7d0;
        color:#15803d;
    }

    .toggle-card.no{
        background:#fef2f2;
        border-color:#fecaca;
        color:#b91c1c;
    }

    .hidden-box{
        display:none;
        margin-top:14px;
        padding:18px;
        border:1px solid #e6eef8;
        border-radius:20px;
        background:linear-gradient(180deg,#fcfdff 0%,#f8fbff 100%);
    }

    .service-grid{
        display:grid;
        grid-template-columns: repeat(5, minmax(0,1fr));
        gap:14px;
        margin-top:8px;
    }

    .service-option{
        position:relative;
    }

    .service-option input{
        position:absolute;
        opacity:0;
    }

    .service-option label{
        display:flex;
        align-items:center;
        justify-content:center;
        min-height:58px;
        border-radius:16px;
        border:1px solid var(--border);
        background:#fbfcff;
        font-size:14px;
        font-weight:700;
        color:var(--navy);
        cursor:pointer;
        transition:.25s ease;
        text-align:center;
        padding:10px;
    }

    .service-option input:checked + label{
        background:rgba(242,92,5,0.10);
        border-color:rgba(242,92,5,0.45);
        color:var(--orange-dark);
        box-shadow:0 0 0 4px rgba(242,92,5,0.08);
    }

    .save-bar{
        margin-top:22px;
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:18px;
        flex-wrap:wrap;
        padding:20px 22px;
        border:1px solid #fde4d3;
        background:linear-gradient(135deg,#fff8f3,#ffffff);
        border-radius:22px;
    }

    .save-note{
        margin:0;
        font-size:14px;
        color:var(--muted);
        font-weight:600;
    }

    .save-btn{
        min-width:250px;
        height:56px;
        border:none;
        border-radius:18px;
        background:linear-gradient(135deg, #ff9a3c, var(--orange));
        color:#fff;
        font-size:17px;
        font-weight:800;
        box-shadow:0 18px 38px rgba(242,92,5,0.23);
        transition:.25s ease;
    }

    .save-btn:hover{
        transform:translateY(-1px);
    }

    .alert-success-custom{
        margin-bottom:20px;
        border-radius:18px;
        padding:15px 18px;
        background:#ecfdf3;
        color:#166534;
        border:1px solid #bbf7d0;
        font-weight:700;
    }

    @media (max-width: 1200px){
        .top-grid{
            grid-template-columns:1fr;
        }

        .service-grid{
            grid-template-columns: repeat(3, minmax(0,1fr));
        }
    }

    @media (max-width: 768px){
        .engineer-wrapper{
            padding:0 12px;
        }

        .engineer-header,
        .engineer-body{
            padding-left:16px;
            padding-right:16px;
        }

        .engineer-title{
            font-size:29px;
        }

        .form-grid,
        .lead-detail-grid{
            grid-template-columns:1fr;
        }

        .service-grid{
            grid-template-columns:1fr 1fr;
        }

        .save-bar{
            flex-direction:column;
            align-items:stretch;
        }

        .save-btn{
            width:100%;
            min-width:unset;
        }
    }

    .service-option label {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 58px;
    border-radius: 16px;
    border: 1px solid var(--border);
    background: #fbfcff;
    font-size: 14px;
    font-weight: 700;
    color: var(--navy);
    cursor: pointer;
    transition: .25s ease;
    text-align: center;
    padding: 10px 14px;
    gap: 8px;
}
</style>

<div class="engineer-detail-page">
    <div class="engineer-wrapper">
        <div class="engineer-shell">
            <div class="engineer-header">
                <div class="engineer-header-top">
                    <div>
                        <h1 class="engineer-title">Lead Details & Engineer Desk Review</h1>
                        <p class="engineer-subtitle">
                            Review the lead, understand exact technical requirement, check if drawing or BOQ is available, inspect plot size and site condition, then decide which service this project actually needs.
                        </p>
                    </div>

                    <div class="header-actions">
                        <a href="{{ url()->previous() }}" class="header-btn back-btn">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>

                        @if(!empty($post->files))
                            <a href="{{ asset('storage/' . $post->files) }}" target="_blank" class="header-btn view-file-btn">
                                <i class="bi bi-paperclip"></i> View File
                            </a>
                        @endif
                    </div>
                </div>

                <div class="header-badge-row">
                    <span class="header-badge badge-id">
                        <i class="bi bi-hash"></i> Lead ID: {{ $post->id ?? '-' }}
                    </span>
                    <span class="header-badge badge-city">
                        <i class="bi bi-geo-alt"></i> {{ $post->city ?? 'Location not added' }}
                    </span>
                    <span class="header-badge badge-owner">
                        <i class="bi bi-person-workspace"></i> Engineer Desk: Manali
                    </span>
                </div>
            </div>

            <div class="engineer-body">
                @if(session('success'))
                    <div class="alert-success-custom">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="top-grid">
                    <div class="panel-card">
                        <h2 class="panel-title">Lead Snapshot</h2>

                        <div class="lead-detail-grid">
                            <div class="detail-box">
                                <div class="detail-label">Title</div>
                                <div class="detail-value">{{ $post->title ?? '-' }}</div>
                            </div>

                            <div class="detail-box">
                                <div class="detail-label">Contact Name</div>
                                <div class="detail-value">{{ $post->contact_name ?? '-' }}</div>
                            </div>

                            <div class="detail-box">
                                <div class="detail-label">Mobile</div>
                                <div class="detail-value">{{ $post->mobile ?? '-' }}</div>
                            </div>

                            <div class="detail-box">
                                <div class="detail-label">Email</div>
                                <div class="detail-value">{{ $post->email ?? '-' }}</div>
                            </div>

                            <div class="detail-box">
                                <div class="detail-label">City</div>
                                <div class="detail-value">{{ $post->city ?? '-' }}</div>
                            </div>

                            <div class="detail-box">
                                <div class="detail-label">Area</div>
                                <div class="detail-value">{{ $post->area ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="desc-panel">
                            <div class="desc-label">Project Description</div>
                            <p class="desc-value">{{ $post->description ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="panel-card">
                        <h2 class="panel-title">Available Documents</h2>

                        <div class="upload-box">
                            <div class="upload-icon">
                                <i class="bi bi-folder2-open"></i>
                            </div>

                            <div class="upload-title">Drawing / BOQ / Reference Check</div>
                            <div class="upload-subtitle">
                                Review whether the customer has already shared project files, drawings, BOQ, references, or technical supporting documents.
                            </div>

                            @if(!empty($post->files))
                                <a href="{{ asset('storage/' . $post->files) }}" target="_blank" class="file-chip">
                                    <i class="bi bi-file-earmark-text"></i> Open Uploaded File
                                </a>
                            @else
                                <span class="file-chip" style="background:#f8fafc;color:#64748b;">
                                    <i class="bi bi-x-circle"></i> No file uploaded
                                </span>
                            @endif
                        </div>

                        <div class="desc-panel" style="margin-top:18px;">
                            <div class="desc-label">Engineer Note</div>
                            <p class="desc-value">
                                Use the form below to convert this raw inquiry into structured technical understanding before it moves toward partner selection.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="engineer-form-card">
                    <form action="{{ route('admin.post-leads.saveEngineerData', $post->id) }}" method="POST">
                        @csrf

                        <div class="section-block">
                            <h3 class="section-heading">
                                <span class="icon"><i class="bi bi-clipboard-data"></i></span>
                                <span>Technical Understanding</span>
                            </h3>

                            <div class="form-grid">
                                <div class="form-field full">
                                    <label class="form-label">What exactly customer wants</label>
                                    <textarea
                                        name="customer_requirement"
                                        rows="5"
                                        class="form-textarea-custom"
                                        placeholder="Example: Customer wants a turnkey contractor for G+1 bungalow construction, with civil, electrical, plumbing and finishing work.">{{ old('customer_requirement', $engineerDesk->customer_requirement ?? '') }}</textarea>
                                    <div class="field-hint">Write exact requirement clearly so the next desk can understand it without calling again.</div>
                                </div>

                                <div class="form-field full">
                                    <label class="form-label">Drawing / BOQ Available?</label>

                                    <div class="toggle-row">
                                        <label class="toggle-card yes">
                                            <input
                                                class="drawing-boq-toggle"
                                                type="radio"
                                                name="drawing_boq_option"
                                                value="yes"
                                                {{ old('drawing_boq_option', !empty($engineerDesk->drawing_boq) ? 'yes' : '') == 'yes' ? 'checked' : '' }}>
                                            <span><i class="bi bi-check-circle"></i> Yes</span>
                                        </label>

                                        <label class="toggle-card no">
                                            <input
                                                class="drawing-boq-toggle"
                                                type="radio"
                                                name="drawing_boq_option"
                                                value="no"
                                                {{ old('drawing_boq_option', empty($engineerDesk->drawing_boq) ? 'no' : '') == 'no' ? 'checked' : '' }}>
                                            <span><i class="bi bi-x-circle"></i> No</span>
                                        </label>
                                    </div>

                                    <div id="drawingBoqTextBox" class="hidden-box"
                                        style="{{ old('drawing_boq_option', !empty($engineerDesk->drawing_boq) ? 'yes' : '') == 'yes' ? 'display:block;' : 'display:none;' }}">
                                        <label class="form-label">Drawing / BOQ Details</label>
                                        <textarea
                                            name="drawing_boq"
                                            rows="4"
                                            class="form-textarea-custom"
                                            placeholder="Mention file details, BOQ status, drawing type, revision note, or what exactly has been received.">{{ old('drawing_boq', $engineerDesk->drawing_boq ?? '') }}</textarea>

                                        @if(!empty($post->files))
                                            <div class="field-hint" style="margin-top:10px;">
                                                Uploaded file already available above. Mention what type of drawing or BOQ it contains after checking it.
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-field">
                                    <label class="form-label">Plot size / area</label>
                                    <input
                                        type="text"
                                        name="plot_size"
                                        class="form-control-custom"
                                        placeholder="e.g. Plot: 2000 sq.ft / Built-up: 1500 sq.ft"
                                        value="{{ old('plot_size', $engineerDesk->plot_size ?? $post->area ?? '') }}">
                                </div>

                                <div class="form-field full">
                                    <label class="form-label">Site condition</label>
                                    <textarea
                                        name="site_condition"
                                        rows="4"
                                        class="form-textarea-custom"
                                        placeholder="Example: Site is clear / old structure present / sloping land / road access available / utility connection pending.">{{ old('site_condition', $engineerDesk->site_condition ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="section-block">
                            <h3 class="section-heading">
                                <span class="icon"><i class="bi bi-diagram-3"></i></span>
                                <span>Decide Required Service</span>
                            </h3>

                            <label class="form-label">Which service does this project need?</label>
                            <div class="service-grid">
                                @foreach($workTypes as $type)
                                    @php
                                        $serviceId = 'service_' . $type->id;
                                        $selectedService = old('service_type', $engineerDesk->service_type ?? '');
                                    @endphp

                                    <div class="service-option">
                                        <input
                                            type="radio"
                                            name="service_type"
                                            id="{{ $serviceId }}"
                                            value="{{ $type->work_type }}"
                                            {{ $selectedService == $type->work_type ? 'checked' : '' }}
                                        >
                                        <label for="{{ $serviceId }}">
                                            @if(!empty($type->icon))
                                                <i class="bi {{ $type->icon }}" style="margin-right:8px;"></i>
                                            @endif
                                            {{ $type->work_type }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="field-hint" style="margin-top:10px;">
                                Choose the primary service needed for this project based on the lead details, available files, and technical understanding.
                            </div>
                        </div>
                        <div class="section-block">
                            <h3 class="section-heading">
                                <span class="icon"><i class="bi bi-journal-text"></i></span>
                                <span>Lead Structuring</span>
                            </h3>

                            <div class="form-grid">
                                <div class="form-field">
                                   <textarea
                                            name="lead_structuring"
                                            rows="4"
                                            class="form-textarea-custom"
                                            placeholder="Example: G+1 Bungalow."></textarea>

                                </div>

                            
                            </div>
                        </div>

                        <div class="save-bar">
                            <p class="save-note">
                                Save this engineer review so the project can move into structured execution flow.
                            </p>

                            <button type="submit" class="save-btn">
                                {{ $engineerDesk ? 'Update Engineer Desk Details' : 'Save Engineer Desk Details' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.drawing-boq-toggle').on('change', function () {
            if ($(this).val() === 'yes') {
                $('#drawingBoqTextBox').slideDown();
            } else {
                $('#drawingBoqTextBox').slideUp();
                $('#drawingBoqTextBox textarea').val('');
            }
        });
    });
</script>
@endsection