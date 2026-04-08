@extends('vendor.layouts.vapp')

@section('title', 'Machinery Provider Form')
@section('page_title', 'Machinery Provider Form')

@section('content')

<style>
    :root{
        --bg: #f4f7fb;
        --white: #ffffff;
        --text: #1c3558;
        --text-soft: #72839a;
        --muted: #97a4b5;
        --line: #e3eaf2;
        --line-dark: #d4deea;
        --primary: #ea7b2f;
        --primary-2: #f39a56;
        --primary-soft: #fff5ed;
        --navy: #1d355a;
        --danger: #dc2626;
        --shadow-sm: 0 8px 24px rgba(15, 23, 42, 0.04);
        --shadow-md: 0 16px 38px rgba(15, 23, 42, 0.06);
        --shadow-lg: 0 18px 38px rgba(234, 123, 47, 0.18);
        --radius-xl: 26px;
        --radius-lg: 18px;
        --radius-md: 14px;
    }

    body{
        background:
            linear-gradient(rgba(15, 23, 42, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(15, 23, 42, 0.03) 1px, transparent 1px),
            linear-gradient(180deg, #f7f9fc 0%, #eef3f8 100%);
        background-size: 56px 56px, 56px 56px, auto;
    }

    .page-wrap{
        max-width: 1220px;
        margin: 0 auto;
        padding: 18px 0 34px;
    }

    .stack{
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .top-banner{
        background: linear-gradient(135deg, #ffffff 0%, #fff8f2 100%);
        border: 1px solid #f2e0d0;
        border-radius: 26px;
        box-shadow: var(--shadow-md);
        padding: 22px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 18px;
        flex-wrap: wrap;
    }

    .top-banner-left{
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .top-banner-icon{
        width: 64px;
        height: 64px;
        border-radius: 20px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-2) 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        box-shadow: 0 16px 32px rgba(234,123,47,0.22);
        flex-shrink: 0;
    }

    .top-banner h1{
        margin: 0;
        color: var(--navy);
        font-size: 28px;
        line-height: 1.2;
        font-weight: 900;
    }

    .top-banner p{
        margin: 6px 0 0;
        color: var(--text-soft);
        font-size: 14px;
        font-weight: 500;
    }

    .top-badge{
        padding: 11px 16px;
        border-radius: 999px;
        background: #fff;
        border: 1px solid #f1dfcf;
        color: var(--primary);
        font-size: 14px;
        font-weight: 800;
        box-shadow: 0 8px 18px rgba(234,123,47,0.06);
    }

    .card-box{
        background: linear-gradient(180deg, #ffffff 0%, #fcfdff 100%);
        border: 1px solid var(--line);
        border-radius: 26px;
        box-shadow: var(--shadow-md);
        padding: 26px;
        position: relative;
        overflow: hidden;
    }

    .card-box::before{
        content:"";
        position:absolute;
        right:-80px;
        top:-80px;
        width:220px;
        height:220px;
        background: radial-gradient(circle, rgba(234,123,47,0.06) 0%, transparent 72%);
        pointer-events:none;
    }

    .section-divider{
        height: 4px;
        width: 100%;
        background: linear-gradient(90deg, var(--primary), rgba(234,123,47,0.08));
        border-radius: 999px;
        margin-bottom: 24px;
    }

    .card-head{
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 22px;
        position: relative;
        z-index: 2;
    }

    .card-icon{
        width: 54px;
        height: 54px;
        border-radius: 16px;
        background: linear-gradient(135deg, #fff4eb 0%, #ffe8d8 100%);
        border: 1px solid #ffd7bf;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
        flex-shrink: 0;
    }

    .card-title-wrap h2{
        margin: 0;
        font-size: 24px;
        color: var(--navy);
        font-weight: 900;
    }

    .card-title-wrap p{
        margin: 4px 0 0;
        color: var(--text-soft);
        font-size: 15px;
        font-weight: 500;
    }

    .field-block + .field-block{
        margin-top: 24px;
    }

    .field-title,
    .field-label{
        margin: 0 0 12px;
        font-size: 16px;
        color: var(--navy);
        font-weight: 800;
    }

    .field-title .req,
    .field-label .req{
        color: var(--danger);
    }

    .field-sub{
        margin: -2px 0 14px;
        font-size: 14px;
        color: var(--text-soft);
        font-weight: 500;
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

    .project-grid{
        display:grid;
        grid-template-columns:repeat(3, minmax(0, 1fr));
        gap:16px;
    }

    .project-item input,
    .category-item input,
    .pill-item input,
    .toggle-wrap input,
    .upload-item input[type="file"]{
        display: none;
    }

    .project-item label{
        min-height: 62px;
        border: 1.5px solid var(--line-dark);
        border-radius: 14px;
        background: #fff;
        display:flex;
        align-items:center;
        gap:14px;
        padding:14px 16px;
        cursor:pointer;
        transition: all .22s ease;
        font-size:15px;
        color:var(--text);
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
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }

    .project-item input:checked + label{
        border-color: var(--primary);
        background: linear-gradient(180deg, #fffaf6 0%, #fff1e8 100%);
        box-shadow: 0 12px 22px rgba(234,123,47,0.10);
    }

    .project-item input:checked + label::before{
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-2) 100%);
        border-color: var(--primary);
        box-shadow: inset 0 0 0 4px #fff;
    }

    .category-grid{
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 16px;
    }

    .category-item label{
        min-height: 152px;
        border: 1.5px solid var(--line-dark);
        border-radius: 18px;
        background: #fff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 14px;
        text-align: center;
        padding: 16px 12px;
        cursor: pointer;
        transition: all .22s ease;
        position: relative;
    }

    .category-item label:hover{
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }

    .cat-icon{
        width: 54px;
        height: 54px;
        border-radius: 16px;
        background: #fff2ea;
        color: #f26a00;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .cat-text{
        font-size: 16px;
        font-weight: 800;
        color: #243b60;
        line-height: 1.35;
    }

    .category-item input:checked + label{
        border-color: var(--primary);
        background: linear-gradient(180deg, #fffaf6 0%, #fff1e8 100%);
        box-shadow: 0 12px 22px rgba(234,123,47,0.10);
    }

    .category-item input:checked + label::before{
        content: "\f00c";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        top: 12px;
        right: 12px;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: var(--primary);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
    }

    .divider{
        border: none;
        border-top: 1px solid var(--line);
        margin: 24px 0;
    }

    .machine-head{
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 14px;
        flex-wrap: wrap;
    }

    .add-machine-btn{
        border: none;
        background: none;
        color: var(--primary);
        font-size: 16px;
        font-weight: 800;
        cursor: pointer;
    }

    .machine-box{
        border: 1px solid var(--line-dark);
        border-radius: 18px;
        background: #fbfcfe;
        padding: 18px;
        margin-bottom: 16px;
    }

    .machine-grid{
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
    }

    .label-sm{
        margin: 0 0 8px;
        font-size: 14px;
        color: #8a9ab2;
        font-weight: 700;
    }

    .form-input,
    .form-select{
        width: 100%;
        height: 56px;
        border: 1.5px solid var(--line-dark);
        border-radius: 14px;
        background: #fff;
        padding: 0 16px;
        font-size: 16px;
        color: var(--text);
        outline: none;
    }

    .form-input::placeholder{
        color:#97a4b5;
        font-weight:500;
    }

    .form-input:focus,
    .form-select:focus{
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(234,123,47,0.08);
    }

    .remove-machine{
        margin-top: 12px;
        border: none;
        background: #fff2f2;
        color: #d94b4b;
        border-radius: 10px;
        padding: 8px 12px;
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
    }

    .toggle-grid{
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px 28px;
        margin-top: 8px;
    }

    .toggle-wrap label{
        min-height: 84px;
        border: 1.5px solid var(--line);
        border-radius: 18px;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 18px;
        cursor: pointer;
    }

    .toggle-title{
        margin: 0;
        font-size: 17px;
        color: var(--navy);
        font-weight: 900;
    }

    .toggle-sub{
        margin: 4px 0 0;
        font-size: 13px;
        color: var(--text-soft);
        font-weight: 500;
    }

    .toggle-ui{
        width: 64px;
        height: 34px;
        border-radius: 999px;
        background: #d7e0eb;
        position: relative;
        flex-shrink: 0;
        transition: .22s ease;
    }

    .toggle-ui::before{
        content: "";
        position: absolute;
        top: 4px;
        left: 4px;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,.10);
        transition: .22s ease;
    }

    .toggle-wrap input:checked + label .toggle-ui{
        background: #ffd8bf;
    }

    .toggle-wrap input:checked + label .toggle-ui::before{
        left: 34px;
    }

    .pill-grid{
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 10px;
    }

    .pill-item label{
        min-height: 50px;
        padding: 0 22px;
        border-radius: 14px;
        border: 1.5px solid var(--line-dark);
        background: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 16px;
        color: #35517f;
        font-weight: 700;
        transition: .22s ease;
    }

    .pill-item input:checked + label{
        border-color: var(--primary);
        background: #fff4eb;
        color: var(--navy);
        box-shadow: 0 10px 18px rgba(234,123,47,0.08);
    }

    .duration-wrap{
        max-width: 460px;
        margin-top: 18px;
    }

    .upload-grid{
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px 22px;
    }

    .upload-title{
        margin: 0 0 10px;
        font-size: 16px;
        color: var(--navy);
        font-weight: 800;
    }

    .upload-box{
        min-height: 156px;
        border: 2px dashed #c4d4e7;
        border-radius: 18px;
        background: #fff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-align: center;
        padding: 18px;
        cursor: pointer;
        transition: .22s ease;
    }

    .upload-box:hover{
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }

    .upload-box.active{
        border-color: var(--primary);
        background: #fffaf6;
    }

    .upload-icon{
        font-size: 34px;
        color: #8ea3c1;
    }

    .upload-text{
        font-size: 15px;
        color: #6b83ad;
        font-weight: 500;
    }

    .upload-text span{
        color: var(--primary);
        font-weight: 800;
    }

    .upload-note{
        font-size: 13px;
        color: var(--muted);
        font-weight: 700;
    }

    .file-name{
        margin-top: 8px;
        font-size: 12px;
        color: var(--navy);
        font-weight: 800;
        word-break: break-word;
    }

    .submit-box{
        text-align: center;
    }

    .submit-btn{
        min-width: 390px;
        height: 74px;
        border: none;
        border-radius: 18px;
        background: linear-gradient(135deg, #ff5d00 0%, #ff7d20 100%);
        color: #fff;
        font-size: 20px;
        font-weight: 900;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
        box-shadow: var(--shadow-lg);
        transition: .22s ease;
    }

    .submit-btn:hover{
        transform: translateY(-2px);
    }

    .submit-note{
        margin-top: 16px;
        font-size: 14px;
        color: var(--muted);
        font-weight: 700;
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

    @media (max-width: 1100px){
        .category-grid{
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .project-grid{
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 992px){
        .machine-grid,
        .toggle-grid,
        .upload-grid{
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px){
        .page-wrap{
            padding: 12px 0 24px;
        }

        .top-banner{
            padding: 18px 16px;
            border-radius: 20px;
        }

        .top-banner h1{
            font-size: 22px;
        }

        .card-box{
            padding: 18px 16px 22px;
            border-radius: 20px;
        }

        .vendor-bar{
            flex-direction: column;
            align-items: flex-start;
        }

        .category-grid,
        .project-grid{
            grid-template-columns: 1fr;
        }

        .submit-btn{
            min-width: 100%;
            width: 100%;
            height: 62px;
            font-size: 18px;
        }
    }
</style>

@php
    $categories = [
        ['name' => 'Earthwork & Excavation', 'icon' => 'fa-solid fa-trowel'],
        ['name' => 'Material Handling', 'icon' => 'fa-solid fa-box-open'],
        ['name' => 'Concrete Machinery', 'icon' => 'fa-solid fa-fire-flame-curved'],
        ['name' => 'Road Equipment', 'icon' => 'fa-solid fa-road'],
        ['name' => 'Compaction Equipment', 'icon' => 'fa-solid fa-layer-group'],
        ['name' => 'Foundation & Piling', 'icon' => 'fa-solid fa-anchor'],
        ['name' => 'Power & Utility', 'icon' => 'fa-solid fa-bolt'],
        ['name' => 'Transport & Hauling', 'icon' => 'fa-solid fa-truck'],
        ['name' => 'Finishing Equipment', 'icon' => 'fa-solid fa-paint-roller'],
        ['name' => 'Survey & Tech', 'icon' => 'fa-solid fa-crosshairs'],
    ];

    $oldCategories = old('machinery_categories', []);
    $oldRentalBasis = old('rental_basis', []);
    $workType = $workType ?? null;
    $projectTypes = $projectTypes ?? collect();
@endphp

<div class="page-wrap">
    <div class="stack">

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
                    <i class="fa-solid fa-truck-monster"></i>
                </div>
                <div>
                    <h1>Join as a Machinery Provider</h1>
                    <p>Show your machinery inventory, rental options, and support services to receive relevant construction equipment enquiries.</p>
                </div>
            </div>
            <div class="top-badge">Trusted ConstructKaro Partner Onboarding</div>
        </div>

        <form action="{{ route('machinery_provider.store') }}" method="POST" enctype="multipart/form-data" id="machineryForm">
            @csrf

            <div class="card-box">
                <div class="card-head">
                    <div class="card-icon"><i class="fa-solid fa-gears"></i></div>
                    <div class="card-title-wrap">
                        <h2>Machinery & Professional Details</h2>
                        <p>Select your equipment categories and add machine details</p>
                    </div>
                </div>

                <div class="field-block">
                    <div class="field-label">Find Your Construction Vendor <span class="req">*</span></div>
                    <div class="vendor-bar">
                        <div class="vendor-value">{{ $workType->work_type ?? 'Machinery Provider' }}</div>
                        <div class="vendor-chip">{{ $workType->work_type ?? 'Machinery Provider' }}</div>
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
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field-block">
                    <div class="field-title">Machinery Categories <span class="req">*</span></div>

                    <div class="category-grid">
                        @foreach($categories as $index => $category)
                            <div class="category-item">
                                <input
                                    type="checkbox"
                                    id="machinery_category_{{ $index }}"
                                    name="machinery_categories[]"
                                    value="{{ $category['name'] }}"
                                    {{ in_array($category['name'], $oldCategories) ? 'checked' : '' }}
                                >
                                <label for="machinery_category_{{ $index }}">
                                    <div class="cat-icon"><i class="{{ $category['icon'] }}"></i></div>
                                    <div class="cat-text">{{ $category['name'] }}</div>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    @error('machinery_categories')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <hr class="divider">

                <div class="machine-head">
                    <div class="field-title" style="margin:0;">Machine Details</div>
                    <button type="button" class="add-machine-btn" id="addMachineBtn">
                        <i class="fa-regular fa-circle-plus"></i> Add Machine
                    </button>
                </div>

                <div id="machineRows">
                    @php
                        $brands = old('brand', ['']);
                        $models = old('model', ['']);
                        $quantities = old('quantity', ['1']);
                        $capacities = old('capacity', ['']);
                    @endphp

                    @foreach($brands as $i => $brand)
                        <div class="machine-box machine-row">
                            <div class="machine-grid">
                                <div>
                                    <div class="label-sm">Brand</div>
                                    <input type="text" name="brand[]" class="form-input" placeholder="Enter brand name" value="{{ $brand }}">
                                </div>
                                <div>
                                    <div class="label-sm">Model</div>
                                    <input type="text" name="model[]" class="form-input" placeholder="Enter machine model" value="{{ $models[$i] ?? '' }}">
                                </div>
                                <div>
                                    <div class="label-sm">Quantity</div>
                                    <input type="number" min="1" name="quantity[]" class="form-input" placeholder="Enter quantity" value="{{ $quantities[$i] ?? 1 }}">
                                </div>
                                <div>
                                    <div class="label-sm">Capacity</div>
                                    <input type="text" name="capacity[]" class="form-input" placeholder="e.g. 3 Ton, 20 HP" value="{{ $capacities[$i] ?? '' }}">
                                </div>
                            </div>

                            @if($i > 0)
                                <button type="button" class="remove-machine">Remove</button>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="toggle-grid">
                    <div class="toggle-wrap">
                        <input type="checkbox" id="operator_available" name="operator_available" value="1" {{ old('operator_available') ? 'checked' : '' }}>
                        <label for="operator_available">
                            <div>
                                <div class="toggle-title">Operator Available</div>
                                <div class="toggle-sub">Do you provide operators?</div>
                            </div>
                            <div class="toggle-ui"></div>
                        </label>
                    </div>

                    <div class="toggle-wrap">
                        <input type="checkbox" id="breakdown_support" name="breakdown_support" value="1" {{ old('breakdown_support') ? 'checked' : '' }}>
                        <label for="breakdown_support">
                            <div>
                                <div class="toggle-title">Breakdown Support</div>
                                <div class="toggle-sub">Onsite repair available?</div>
                            </div>
                            <div class="toggle-ui"></div>
                        </label>
                    </div>

                    <div class="toggle-wrap">
                        <input type="checkbox" id="night_shift_support" name="night_shift_support" value="1" {{ old('night_shift_support') ? 'checked' : '' }}>
                        <label for="night_shift_support">
                            <div>
                                <div class="toggle-title">Night Shift Support</div>
                                <div class="toggle-sub">Available after working hours?</div>
                            </div>
                            <div class="toggle-ui"></div>
                        </label>
                    </div>

                    <div class="toggle-wrap">
                        <input type="checkbox" id="availability_24x7" name="availability_24x7" value="1" {{ old('availability_24x7') ? 'checked' : '' }}>
                        <label for="availability_24x7">
                            <div>
                                <div class="toggle-title">24×7 Availability</div>
                                <div class="toggle-sub">Round-the-clock service?</div>
                            </div>
                            <div class="toggle-ui"></div>
                        </label>
                    </div>
                </div>

                <div class="field-title" style="margin-top:24px;">Rental Basis <span style="font-weight:600;color:#8a9ab2;">(Select all that apply)</span></div>

                @php
                    $rentalBasis = ['Hourly', 'Daily', 'Weekly', 'Monthly', 'Project-Based'];
                @endphp

                <div class="pill-grid">
                    @foreach($rentalBasis as $index => $basis)
                        <div class="pill-item">
                            <input
                                type="checkbox"
                                id="rental_basis_{{ $index }}"
                                name="rental_basis[]"
                                value="{{ $basis }}"
                                {{ in_array($basis, $oldRentalBasis) ? 'checked' : '' }}
                            >
                            <label for="rental_basis_{{ $index }}">{{ $basis }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="duration-wrap">
                    <div class="field-title" style="margin-top:18px;">Minimum Rental Duration</div>
                    <select name="minimum_rental_duration" class="form-select">
                        <option value="">Select minimum duration</option>
                        <option value="4 Hours" {{ old('minimum_rental_duration') == '4 Hours' ? 'selected' : '' }}>4 Hours</option>
                        <option value="8 Hours" {{ old('minimum_rental_duration') == '8 Hours' ? 'selected' : '' }}>8 Hours</option>
                        <option value="1 Day" {{ old('minimum_rental_duration') == '1 Day' ? 'selected' : '' }}>1 Day</option>
                        <option value="3 Days" {{ old('minimum_rental_duration') == '3 Days' ? 'selected' : '' }}>3 Days</option>
                        <option value="1 Week" {{ old('minimum_rental_duration') == '1 Week' ? 'selected' : '' }}>1 Week</option>
                        <option value="1 Month" {{ old('minimum_rental_duration') == '1 Month' ? 'selected' : '' }}>1 Month</option>
                    </select>
                </div>
            </div>

            <div class="card-box">
                <div class="section-divider"></div>
                <div class="card-head">
                    <div class="card-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                    <div class="card-title-wrap">
                        <h2>Document Upload</h2>
                        <p>Upload documents for verification</p>
                    </div>
                </div>

                <div class="upload-grid">
                    @php
                        $uploads = [
                            ['name' => 'gst_certificate', 'label' => 'GST Certificate', 'icon' => 'fa-regular fa-file-lines'],
                            ['name' => 'aadhaar_card', 'label' => 'Aadhaar Card', 'icon' => 'fa-regular fa-credit-card'],
                            ['name' => 'company_profile', 'label' => 'Company Profile', 'icon' => 'fa-regular fa-building'],
                            ['name' => 'insurance_file', 'label' => 'Insurance', 'icon' => 'fa-regular fa-shield'],
                            ['name' => 'ownership_proof', 'label' => 'Ownership Proof', 'icon' => 'fa-regular fa-file-circle-check'],
                            ['name' => 'machinery_photos', 'label' => 'Machinery Photos', 'icon' => 'fa-regular fa-camera'],
                        ];
                    @endphp

                    @foreach($uploads as $upload)
                        <div class="upload-item" id="{{ $upload['name'] }}_wrap">
                            <div class="upload-title">{{ $upload['label'] }}</div>
                            <label for="{{ $upload['name'] }}" class="upload-box">
                                <div class="upload-icon"><i class="{{ $upload['icon'] }}"></i></div>
                                <div class="upload-text">Drag & drop or <span>browse</span></div>
                                <div class="upload-note">PDF, JPG, PNG up to 5MB</div>
                            </label>
                            <input type="file" name="{{ $upload['name'] }}" id="{{ $upload['name'] }}">
                            <div class="file-name" id="{{ $upload['name'] }}_name"></div>
                            @error($upload['name'])
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card-box submit-box">
                <button type="submit" class="submit-btn">
                    <i class="fa-regular fa-circle-check"></i>
                    <span>Submit & Get Verified</span>
                </button>
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
        'gst_certificate',
        'aadhaar_card',
        'company_profile',
        'insurance_file',
        'ownership_proof',
        'machinery_photos'
    ].forEach(function(name){
        bindFilePreview(name, name + '_name', name + '_wrap');
    });

    document.getElementById('addMachineBtn').addEventListener('click', function () {
        const container = document.getElementById('machineRows');
        const row = document.createElement('div');
        row.className = 'machine-box machine-row';
        row.innerHTML = `
            <div class="machine-grid">
                <div>
                    <div class="label-sm">Brand</div>
                    <input type="text" name="brand[]" class="form-input" placeholder="Enter brand name">
                </div>
                <div>
                    <div class="label-sm">Model</div>
                    <input type="text" name="model[]" class="form-input" placeholder="Enter machine model">
                </div>
                <div>
                    <div class="label-sm">Quantity</div>
                    <input type="number" min="1" name="quantity[]" class="form-input" placeholder="Enter quantity" value="1">
                </div>
                <div>
                    <div class="label-sm">Capacity</div>
                    <input type="text" name="capacity[]" class="form-input" placeholder="e.g. 3 Ton, 20 HP">
                </div>
            </div>
            <button type="button" class="remove-machine">Remove</button>
        `;
        container.appendChild(row);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-machine')) {
            e.target.closest('.machine-row').remove();
        }
    });
</script>

@endsection