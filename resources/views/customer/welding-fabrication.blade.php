@extends('layouts.app')

@section('title', 'Welding & Fabrication')

@section('content')

<style>
    body {
        background: #efefef;
        font-family: 'Segoe UI', sans-serif;
    }

    .welding-page {
        padding: 70px 20px 90px;
        background: #efefef;
    }

    .welding-container {
        max-width: 1680px;
        margin: 0 auto;
    }

    .welding-heading-wrap {
        text-align: center;
        margin-bottom: 58px;
    }

    .welding-main-heading {
        font-size: 64px;
        font-weight: 800;
        color: #171717;
        margin: 0;
        line-height: 1.1;
        letter-spacing: -1px;
    }

    .welding-heading-line {
        width: 250px;
        max-width: 90%;
        height: 4px;
        margin: 18px auto 0;
        border-radius: 30px;
        background: linear-gradient(to right, #2d79bf 50%, #ef7a22 50%);
    }

    .welding-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 34px;
    }

    .welding-card {
        border-radius: 32px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 12px 28px rgba(0,0,0,0.12);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        display: flex;
        flex-direction: column;
    }

    .welding-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 38px rgba(0,0,0,0.16);
    }

    .welding-card.blue-theme {
        border: 2px solid #2d79bf;
    }

    .welding-card.orange-theme {
        border: 2px solid #ef7a22;
    }

    .welding-card-image {
        height: 250px;
        overflow: hidden;
        background: linear-gradient(135deg, #dbe7f5, #f1f5fa);
        position: relative;
    }

    .welding-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }

    .welding-card:hover .welding-card-image img {
        transform: scale(1.05);
    }

    .welding-card-body {
        padding: 28px 30px 30px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .welding-card.blue-theme .welding-card-body {
        background: #dce6f0;
    }

    .welding-card.orange-theme .welding-card-body {
        background: #f3e2d6;
    }

    .welding-card-title {
        font-size: 34px;
        font-weight: 800;
        color: #000;
        text-align: center;
        line-height: 1.15;
        margin: 0 0 10px;
        letter-spacing: -0.5px;
    }

    .welding-card-subtitle {
        font-size: 18px;
        color: #5b5b5b;
        text-align: center;
        line-height: 1.5;
        margin: 0 0 24px;
        min-height: 54px;
    }

    .welding-points {
        list-style: none;
        padding: 0;
        margin: 0 0 28px;
        flex: 1;
    }

    .welding-points li {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        font-size: 17px;
        font-weight: 600;
        color: #555;
        line-height: 1.5;
        margin-bottom: 12px;
    }

    .point-icon {
        width: 19px;
        height: 19px;
        min-width: 19px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 800;
        color: #fff;
        margin-top: 4px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.15);
    }

    .welding-card.blue-theme .point-icon {
        background: #2d79bf;
    }

    .welding-card.orange-theme .point-icon {
        background: #ef7a22;
    }

    .welding-btn-wrap {
        text-align: center;
        margin-top: auto;
    }

    .welding-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 190px;
        height: 48px;
        padding: 0 24px;
        border-radius: 30px;
        text-decoration: none;
        color: #fff;
        font-size: 18px;
        font-weight: 800;
        transition: all 0.25s ease;
        box-shadow: inset 0 2px 3px rgba(255,255,255,0.18), 0 6px 12px rgba(0,0,0,0.14);
    }

    .welding-card.blue-theme .welding-btn {
        background: linear-gradient(180deg, #2f8de0, #1f64a3);
    }

    .welding-card.orange-theme .welding-btn {
        background: linear-gradient(180deg, #f58a2a, #df7116);
    }

    .welding-btn:hover {
        color: #fff;
        transform: translateY(-2px);
    }

    /* Modal */
    .welding-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.62);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 99999;
        padding: 18px;
    }

    .welding-modal-overlay.active {
        display: flex;
    }

    .welding-modal {
        width: 100%;
        max-width: 1280px;
        max-height: 94vh;
        background: #f5f5f5;
        border-radius: 28px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 25px 60px rgba(0,0,0,0.25);
        display: flex;
        flex-direction: column;
        animation: modalFade .25s ease;
    }

    @keyframes modalFade {
        from {
            opacity: 0;
            transform: translateY(20px) scale(.97);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .welding-modal-close {
        position: absolute;
        top: 18px;
        right: 18px;
        width: 44px;
        height: 44px;
        border: none;
        border-radius: 50%;
        background: #2d79bf;
        color: #fff;
        font-size: 26px;
        font-weight: 700;
        cursor: pointer;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .welding-modal-header {
        text-align: center;
        padding: 32px 70px 12px;
        flex-shrink: 0;
    }

    .welding-form-title {
        font-size: 32px;
        font-weight: 800;
        color: #222;
        line-height: 1.25;
        margin: 0 0 14px;
    }

    .welding-form-subtitle {
        font-size: 17px;
        color: #5c5c5c;
        line-height: 1.55;
        max-width: 800px;
        margin: 0 auto;
    }

    .welding-modal-body {
        padding: 10px 36px 30px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .welding-modal-body::-webkit-scrollbar {
        width: 8px;
    }

    .welding-modal-body::-webkit-scrollbar-thumb {
        background: #b7b7b7;
        border-radius: 20px;
    }

    .welding-section-title {
        font-size: 26px;
        font-weight: 800;
        color: #2d79bf;
        margin: 18px 0 16px;
    }

    .welding-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px 30px;
    }

    .welding-form-group.full {
        grid-column: span 2;
    }

    .welding-form-group label {
        display: block;
        font-size: 20px;
        font-weight: 800;
        color: #222;
        margin-bottom: 8px;
    }

    .welding-form-control,
    .welding-form-select,
    .welding-form-textarea {
        width: 100%;
        border: 1.5px solid #444;
        border-radius: 8px;
        background: #e5edf6;
        color: #222;
        font-size: 17px;
        padding: 14px 14px;
        outline: none;
        box-sizing: border-box;
    }

    .welding-form-control,
    .welding-form-select {
        height: 56px;
    }

    .welding-form-control::placeholder,
    .welding-form-textarea::placeholder {
        color: #a3a3a3;
    }

    .welding-form-textarea {
        min-height: 170px;
        resize: vertical;
    }

    .welding-select-wrap {
        position: relative;
    }

    .welding-select-wrap .welding-form-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        padding-right: 56px;
    }

    .welding-select-wrap::after {
        content: "⌄";
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 32px;
        height: 32px;
        background: #2d79bf;
        color: #fff;
        border-radius: 50%;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
    }

    .welding-area-wrap {
        position: relative;
    }

    .welding-area-wrap .welding-form-control {
        padding-right: 150px;
    }

    .welding-unit-select {
        position: absolute;
        right: 10px;
        top: 8px;
        height: 40px;
        width: 150px;
        border: none;
        border-radius: 14px;
        background: linear-gradient(180deg, #2f8de0, #1f64a3);
        color: #0a0909;
        font-size: 17px;
        font-weight: 800;
        padding: 0 18px;
        appearance: none;
        cursor: pointer;
    }

    .welding-submit-wrap {
        text-align: center;
        margin-top: 26px;
    }

    .welding-submit-btn {
        min-width: 186px;
        height: 57px;
        border: none;
        border-radius: 17px;
        background: linear-gradient(180deg, #2f8de0, #1f64a3);
        color: #fff;
        font-size: 22px;
        font-weight: 800;
        cursor: pointer;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.18);
    }

    .field-error {
        display: block;
        color: red;
        font-size: 14px;
        margin-top: 6px;
        font-weight: 600;
    }

    /* Success modal */
    .success-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.50);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 100000;
        padding: 20px;
    }

    .success-modal-overlay.active {
        display: flex;
    }

    .success-modal-box {
        width: 100%;
        max-width: 430px;
        background: #f4f4f4;
        border: 3px solid #2d79bf;
        border-radius: 18px;
        text-align: center;
        padding: 28px 24px 24px;
        box-shadow: 0 20px 45px rgba(0,0,0,0.22);
    }

    .success-check-icon {
        width: 90px;
        height: 90px;
        background: #ef7a22;
        border-radius: 50%;
        margin: 0 auto 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 50px;
        color: #fff;
        font-weight: 800;
    }

    .success-modal-title {
        font-size: 28px;
        font-weight: 800;
        color: #222;
        margin-bottom: 10px;
    }

    .success-modal-text {
        font-size: 18px;
        color: #555;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .success-ok-btn {
        min-width: 120px;
        height: 46px;
        border: none;
        border-radius: 8px;
        background: linear-gradient(180deg, #2f8de0, #1f64a3);
        color: #0a0909;
        font-size: 24px;
        font-weight: 800;
        cursor: pointer;
    }

    @media (max-width: 1100px) {
        .welding-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .welding-form-grid {
            grid-template-columns: 1fr;
        }

        .welding-form-group.full {
            grid-column: span 1;
        }
    }

    @media (max-width: 768px) {
        .welding-page {
            padding: 45px 14px 70px;
        }

        .welding-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .welding-main-heading {
            font-size: 36px;
        }

        .welding-heading-line {
            width: 180px;
        }

        .welding-card-image {
            height: 220px;
        }

        .welding-card-body {
            padding: 22px 18px 24px;
        }

        .welding-card-title {
            font-size: 28px;
        }

        .welding-card-subtitle {
            font-size: 17px;
            min-height: auto;
        }

        .welding-points li {
            font-size: 16px;
        }

        .welding-btn {
            width: 100%;
            min-width: auto;
            font-size: 17px;
            height: 46px;
        }

        .welding-modal {
            max-height: 95vh;
            border-radius: 18px;
        }

        .welding-modal-header {
            padding: 26px 50px 10px;
        }

        .welding-form-title {
            font-size: 24px;
        }

        .welding-form-subtitle {
            font-size: 14px;
        }

        .welding-modal-body {
            padding: 10px 14px 24px;
        }

        .welding-form-group label,
        .welding-section-title {
            font-size: 18px;
        }

        .welding-submit-btn {
            width: 100%;
            min-width: auto;
            height: 56px;
            font-size: 28px;
        }

        .welding-unit-select {
            width: 110px;
            font-size: 14px;
        }

        .welding-area-wrap .welding-form-control {
            padding-right: 120px;
        }
    }
</style>

<section class="welding-page">
    <div class="welding-container">
        <div class="welding-heading-wrap">
            <h1 class="welding-main-heading">Welding &amp; Fabrication</h1>
            <div class="welding-heading-line"></div>
        </div>

        <div class="welding-grid">

            <div class="welding-card blue-theme">
                <div class="welding-card-image">
                    <img src="{{ asset('images/welding/residential.png') }}" alt="Residential Welding Fabrication">
                </div>
                <div class="welding-card-body">
                    <h2 class="welding-card-title">Residential</h2>
                    <p class="welding-card-subtitle">Homes, villas, apartments</p>
                    <ul class="welding-points">
                        <li><span class="point-icon">✓</span> New house construction</li>
                        <li><span class="point-icon">✓</span> Gate / grill work</li>
                        <li><span class="point-icon">✓</span> Fabrication support</li>
                    </ul>
                    <div class="welding-btn-wrap">
                        <a href="javascript:void(0)" class="welding-btn openWeldingModal" data-category="Residential">Enquire Now</a>
                    </div>
                </div>
            </div>

            <div class="welding-card orange-theme">
                <div class="welding-card-image">
                    <img src="{{ asset('images/welding/commercial.png') }}" alt="Commercial Welding Fabrication">
                </div>
                <div class="welding-card-body">
                    <h2 class="welding-card-title">Commercial</h2>
                    <p class="welding-card-subtitle">Offices, shops, showrooms</p>
                    <ul class="welding-points">
                        <li><span class="point-icon">✓</span> Office metal work</li>
                        <li><span class="point-icon">✓</span> Staircase / railing</li>
                        <li><span class="point-icon">✓</span> Counter / partition work</li>
                    </ul>
                    <div class="welding-btn-wrap">
                        <a href="javascript:void(0)" class="welding-btn openWeldingModal" data-category="Commercial">Enquire Now</a>
                    </div>
                </div>
            </div>

            <div class="welding-card blue-theme">
                <div class="welding-card-image">
                    <img src="{{ asset('images/welding/industrial.png') }}" alt="Industrial Welding Fabrication">
                </div>
                <div class="welding-card-body">
                    <h2 class="welding-card-title">Industrial</h2>
                    <p class="welding-card-subtitle">Factories, plants, warehouses</p>
                    <ul class="welding-points">
                        <li><span class="point-icon">✓</span> Heavy fabrication</li>
                        <li><span class="point-icon">✓</span> Machine structures</li>
                        <li><span class="point-icon">✓</span> Industrial welding</li>
                    </ul>
                    <div class="welding-btn-wrap">
                        <a href="javascript:void(0)" class="welding-btn openWeldingModal" data-category="Industrial">Enquire Now</a>
                    </div>
                </div>
            </div>

            <div class="welding-card orange-theme">
                <div class="welding-card-image">
                    <img src="{{ asset('images/welding/infrastructure.png') }}" alt="Infrastructure Welding Fabrication">
                </div>
                <div class="welding-card-body">
                    <h2 class="welding-card-title">Infrastructure</h2>
                    <p class="welding-card-subtitle">Roads, bridges, utility projects</p>
                    <ul class="welding-points">
                        <li><span class="point-icon">✓</span> Structural steel work</li>
                        <li><span class="point-icon">✓</span> Site welding support</li>
                        <li><span class="point-icon">✓</span> Fabricated project items</li>
                    </ul>
                    <div class="welding-btn-wrap">
                        <a href="javascript:void(0)" class="welding-btn openWeldingModal" data-category="Infrastructure">Enquire Now</a>
                    </div>
                </div>
            </div>

            <div class="welding-card blue-theme">
                <div class="welding-card-image">
                    <img src="{{ asset('images/welding/interior.png') }}" alt="Interior Welding Fabrication">
                </div>
                <div class="welding-card-body">
                    <h2 class="welding-card-title">Interior</h2>
                    <p class="welding-card-subtitle">Home and office interior work</p>
                    <ul class="welding-points">
                        <li><span class="point-icon">✓</span> Decorative partitions</li>
                        <li><span class="point-icon">✓</span> SS / MS designer work</li>
                        <li><span class="point-icon">✓</span> Handrails / custom work</li>
                    </ul>
                    <div class="welding-btn-wrap">
                        <a href="javascript:void(0)" class="welding-btn openWeldingModal" data-category="Interior">Enquire Now</a>
                    </div>
                </div>
            </div>

            <div class="welding-card orange-theme">
                <div class="welding-card-image">
                    <img src="{{ asset('images/welding/renovation.png') }}" alt="Renovation Welding Fabrication">
                </div>
                <div class="welding-card-body">
                    <h2 class="welding-card-title">Renovation</h2>
                    <p class="welding-card-subtitle">Repair and upgrade work</p>
                    <ul class="welding-points">
                        <li><span class="point-icon">✓</span> Repair welding</li>
                        <li><span class="point-icon">✓</span> Grill / gate fixing</li>
                        <li><span class="point-icon">✓</span> Replacement fabrication</li>
                    </ul>
                    <div class="welding-btn-wrap">
                        <a href="javascript:void(0)" class="welding-btn openWeldingModal" data-category="Renovation">Enquire Now</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Enquiry Modal -->
<div class="welding-modal-overlay" id="weldingModal">
    <div class="welding-modal">
        <button type="button" class="welding-modal-close" id="closeWeldingModal">&times;</button>

        <div class="welding-modal-header">
            <h2 class="welding-form-title" id="weldingModalTitle">Residential Welding & Fabrication Services Requirement Form</h2>
            <p class="welding-form-subtitle">
                Share your project details and Welding &amp; Fabrication service requirements to receive the right execution support.
            </p>
        </div>

        <div class="welding-modal-body">
            <form action="{{ route('welding.fabrication.store') }}" method="POST">
                @csrf

                <input type="hidden" name="category" id="weldingCategoryInput" value="{{ old('category') }}">

                <h3 class="welding-section-title">Location Details:</h3>

                <div class="welding-form-grid">
                    <div class="welding-form-group">
                        <label>House no./ Building/Company Name</label>
                        <input type="text" name="building_name" class="welding-form-control" placeholder="Crescent Pearl B" value="{{ old('building_name') }}">
                        @error('building_name')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="welding-form-group">
                        <label>Road Name / Area / Colony</label>
                        <input type="text" name="road_name" class="welding-form-control" placeholder="Veena Nagar, Katrang Road, Khalapur" value="{{ old('road_name') }}">
                        @error('road_name')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="welding-form-group">
                        <label>City</label>
                        <input type="text" name="city" class="welding-form-control" placeholder="Khopoli" value="{{ old('city') }}">
                        @error('city')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="welding-form-group">
                        <label>Pincode</label>
                        <input type="text" name="pincode" class="welding-form-control" placeholder="405410" value="{{ old('pincode') }}">
                        @error('pincode')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <h3 class="welding-section-title">Project Information:</h3>

                <div class="welding-form-grid">
                    <div class="welding-form-group">
                        <label>Project Name</label>
                        <input type="text" name="project_name" class="welding-form-control" placeholder="Shreya Residency" value="{{ old('project_name') }}">
                        @error('project_name')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="welding-form-group">
                        <label>Project Area</label>
                        <div class="welding-area-wrap">
                            <input type="text" name="project_area" class="welding-form-control" placeholder="2000Sq.ft" value="{{ old('project_area') }}">
                            <select name="project_area_unit" class="welding-unit-select">
                                <option value="">Unit</option>
                                <option value="Sq.ft" {{ old('project_area_unit') == 'Sq.ft' ? 'selected' : '' }}>Sq.ft</option>
                                <option value="Sq.m" {{ old('project_area_unit') == 'Sq.m' ? 'selected' : '' }}>Sq.m</option>
                                <option value="Acre" {{ old('project_area_unit') == 'Acre' ? 'selected' : '' }}>Acre</option>
                                <option value="Guntha" {{ old('project_area_unit') == 'Guntha' ? 'selected' : '' }}>Guntha</option>
                            </select>
                        </div>
                        @error('project_area')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="welding-form-group">
                        <label>Service Type Required</label>
                        <div class="welding-select-wrap">
                            <select name="service_type_required" class="welding-form-select">
                                <option value="">Select</option>
                                <option value="Gate / Grill Work" {{ old('service_type_required') == 'Gate / Grill Work' ? 'selected' : '' }}>Gate / Grill Work</option>
                                <option value="Structural Fabrication" {{ old('service_type_required') == 'Structural Fabrication' ? 'selected' : '' }}>Structural Fabrication</option>
                                <option value="Staircase / Railing" {{ old('service_type_required') == 'Staircase / Railing' ? 'selected' : '' }}>Staircase / Railing</option>
                                <option value="Industrial Welding" {{ old('service_type_required') == 'Industrial Welding' ? 'selected' : '' }}>Industrial Welding</option>
                                <option value="Interior Metal Work" {{ old('service_type_required') == 'Interior Metal Work' ? 'selected' : '' }}>Interior Metal Work</option>
                                <option value="Repair Welding" {{ old('service_type_required') == 'Repair Welding' ? 'selected' : '' }}>Repair Welding</option>
                                <option value="Custom Fabrication" {{ old('service_type_required') == 'Custom Fabrication' ? 'selected' : '' }}>Custom Fabrication</option>
                            </select>
                        </div>
                        @error('service_type_required')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="welding-form-group">
                        <label>Service Model Required</label>
                        <div class="welding-select-wrap">
                            <select name="service_model_required" class="welding-form-select">
                                <option value="">Select</option>
                                <option value="Labour Only" {{ old('service_model_required') == 'Labour Only' ? 'selected' : '' }}>Labour Only</option>
                                <option value="Material + Labour" {{ old('service_model_required') == 'Material + Labour' ? 'selected' : '' }}>Material + Labour</option>
                                <option value="Fabrication + Installation" {{ old('service_model_required') == 'Fabrication + Installation' ? 'selected' : '' }}>Fabrication + Installation</option>
                                <option value="Site Visit Required" {{ old('service_model_required') == 'Site Visit Required' ? 'selected' : '' }}>Site Visit Required</option>
                            </select>
                        </div>
                        @error('service_model_required')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <h3 class="welding-section-title">Additional Requirement Details</h3>

                <div class="welding-form-group full">
                    <textarea name="additional_details" class="welding-form-textarea" placeholder="Provide any specific details or notes...">{{ old('additional_details') }}</textarea>
                    @error('additional_details')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="welding-submit-wrap">
                    <button type="submit" class="welding-submit-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="success-modal-overlay" id="successModal">
    <div class="success-modal-box">
        <div class="success-check-icon">✓</div>
        <div class="success-modal-title">Thank You.</div>
        <div class="success-modal-text">
            Your requirement has been posted successfully!<br>
            Our technical person will call you within<br>
            24 working hours.
        </div>
        <button type="button" class="success-ok-btn" id="successOkBtn">OK</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('weldingModal');
        const closeBtn = document.getElementById('closeWeldingModal');
        const openButtons = document.querySelectorAll('.openWeldingModal');
        const modalTitle = document.getElementById('weldingModalTitle');
        const categoryInput = document.getElementById('weldingCategoryInput');
        const successModal = document.getElementById('successModal');
        const successOkBtn = document.getElementById('successOkBtn');

        function openModal(modalEl) {
            modalEl.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalEl) {
            modalEl.classList.remove('active');
            document.body.style.overflow = '';
        }

        openButtons.forEach(button => {
            button.addEventListener('click', function () {
                const category = this.getAttribute('data-category');
                modalTitle.innerText = category + ' Welding & Fabrication Services Requirement Form';
                categoryInput.value = category;
                openModal(modal);
            });
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', function () {
                closeModal(modal);
            });
        }

        if (modal) {
            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    closeModal(modal);
                }
            });
        }

        if (successOkBtn) {
            successOkBtn.addEventListener('click', function () {
                closeModal(successModal);
            });
        }

        if (successModal) {
            successModal.addEventListener('click', function (e) {
                if (e.target === successModal) {
                    closeModal(successModal);
                }
            });
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeModal(modal);
                closeModal(successModal);
            }
        });

        @if($errors->any())
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
            @if(old('category'))
                modalTitle.innerText = "{{ old('category') }} Welding & Fabrication Services Requirement Form";
            @endif
        @endif

        @if(session('success_modal'))
            successModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        @endif
    });
</script>

@endsection