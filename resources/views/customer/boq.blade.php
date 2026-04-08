@extends('layouts.app')

@section('title', 'BOQ / Estimation')

@section('content')

<style>
    body {
        background: #f4f4f4;
        font-family: 'Segoe UI', sans-serif;
    }

    .boq-section {
        padding: 55px 20px 80px;
        background: linear-gradient(180deg, #f8fafc 0%, #eef3f8 100%);
    }

    .boq-container {
        max-width: 1240px;
        margin: 0 auto;
    }

    .boq-heading {
        text-align: center;
        margin-bottom: 42px;
    }

    .boq-heading h2 {
        font-size: 52px;
        font-weight: 800;
        color: #111827;
        line-height: 1.1;
        margin-bottom: 10px;
    }

    .boq-line {
        width: 180px;
        height: 4px;
        margin: 0 auto 16px;
        border-radius: 30px;
        background: linear-gradient(to right, #2f78bf 50%, #ef7a22 50%);
    }

    .boq-heading p {
        font-size: 16px;
        color: #6b7280;
        margin: 0;
    }

    .success-message {
        max-width: 900px;
        margin: 0 auto 20px;
        background: #dff7e6;
        color: #1d6b37;
        padding: 12px 16px;
        border-radius: 10px;
        font-weight: 600;
        border: 1px solid #b6e7c4;
    }

    .boq-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 22px;
        align-items: stretch;
    }

    .boq-card {
        position: relative;
        border-radius: 22px;
        overflow: visible;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
        display: flex;
        flex-direction: column;
        min-height: 620px;
        transition: all 0.25s ease;
    }

    .boq-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 34px rgba(15, 23, 42, 0.12);
    }

    .boq-card.orange-theme {
        background: #fff6ef;
        border: 2px solid #ef7a22;
    }

    .boq-card.blue-theme {
        background: #f1f7ff;
        border: 2px solid #2f78bf;
    }

    .boq-card.white-theme {
        background: #ffffff;
        border: 2px solid #e5e7eb;
    }

    .boq-badge {
        position: absolute;
        top: -26px;
        left: 50%;
        transform: translateX(-50%);
        width: calc(65% - 34px);
        min-height: 22px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 13px 16px;
        color: #fff;
        font-size: 16px;
        font-weight: 800;
        line-height: 1.25;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
        z-index: 2;
    }

    .orange-badge {
        background: linear-gradient(135deg, #f48b35, #eb6f15);
    }

    .blue-badge {
        background: linear-gradient(135deg, #3a86d1, #2b6dac);
    }

    .mix-badge {
        background: linear-gradient(90deg, #f48b35 0%, #2f78bf 100%);
    }

    .boq-card-body {
        display: flex;
        flex-direction: column;
        flex: 1;
        padding: 58px 22px 22px;
        text-align: center;
    }

    .boq-top-text {
        font-size: 15px;
        color: #6b7280;
        margin: 0 0 16px;
        line-height: 1.45;
        min-height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .boq-content {
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .boq-block {
        margin-bottom: 16px;
    }

    .boq-subtitle {
        font-size: 15px;
        font-weight: 800;
        margin: 0 0 8px;
    }

    .orange-text {
        color: #ef7a22;
    }

    .blue-text {
        color: #2f78bf;
    }

    .mix-text {
        color: #9b7a56;
    }

    .boq-list {
        list-style: none;
        padding: 0;
        margin: 0;
        text-align: center;
    }

    .boq-list li {
        position: relative;
        display: inline-block;
        padding-left: 15px;
        margin: 7px 0;
        font-size: 15px;
        line-height: 1.45;
        color: #4b5563;
    }

    .boq-list li::before {
        content: "";
        position: absolute;
        left: 0;
        top: 10px;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #ef7a22;
    }

    .blue-theme .boq-list li::before {
        background: #2f78bf;
    }

    .white-theme .boq-list li::before {
        background: #9ca3af;
    }

    .boq-bottom {
        margin-top: auto;
        padding-top: 8px;
    }

    .boq-price-box {
        min-height: 92px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .boq-price-box h3 {
        font-size: 17px;
        font-weight: 800;
        color: #111827;
        margin: 0 0 6px;
        line-height: 1.35;
    }

    .boq-price-box p {
        font-size: 13px;
        color: #6b7280;
        line-height: 1.45;
        margin: 0;
    }

    .boq-free-box h2 {
        font-size: 44px;
        font-weight: 900;
        color: #111827;
        margin: 0 0 6px;
        line-height: 1;
    }

    .boq-free-box h2 span {
        font-size: 16px;
        font-weight: 700;
        color: #4b5563;
    }

    .boq-btn-wrap {
        margin-top: 16px;
        text-align: center;
    }

    .boq-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 170px;
        height: 44px;
        padding: 0 20px;
        border-radius: 12px;
        text-decoration: none;
        color: #fff;
        font-size: 15px;
        font-weight: 800;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
        transition: all 0.2s ease;
        cursor: pointer;
        border: none;
    }

    .boq-btn:hover {
        transform: translateY(-2px);
        color: #fff;
    }

    .orange-btn {
        background: linear-gradient(135deg, #f48b35, #eb6f15);
    }

    .blue-btn {
        background: linear-gradient(135deg, #3a86d1, #2b6dac);
    }

    .mix-btn {
        background: linear-gradient(90deg, #f48b35 0%, #2f78bf 100%);
    }

    /* Modal */
    .boq-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.55);
        z-index: 9999;
        overflow-y: auto;
        padding: 20px 12px;
    }

    .boq-modal.show {
        display: block;
    }

    .boq-modal-box {
        background: #fff;
        max-width: 1080px;
        width: 100%;
        margin: 0 auto;
        border-radius: 22px;
        padding: 24px 24px 22px;
        position: relative;
        box-shadow: 0 18px 45px rgba(0,0,0,0.22);
    }

    .boq-close-btn {
        position: absolute;
        top: 14px;
        right: 18px;
        width: 38px;
        height: 38px;
        background: #2f78bf;
        color: #fff;
        border: none;
        border-radius: 50%;
        font-size: 22px;
        font-weight: 700;
        cursor: pointer;
        line-height: 1;
    }

    .boq-modal-title {
        text-align: center;
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 8px;
        color: #1f1f1f;
        padding-right: 24px;
    }

    .boq-modal-subtitle {
        text-align: center;
        max-width: 700px;
        margin: 0 auto 20px;
        font-size: 14px;
        color: #555;
        line-height: 1.5;
    }

    .modal-section-title {
        color: #2f78bf;
        font-size: 18px;
        font-weight: 800;
        margin: 16px 0 10px;
    }

    .modal-form-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px 16px;
    }

    .modal-form-group label {
        display: block;
        font-size: 15px;
        font-weight: 700;
        color: #1f1f1f;
        margin-bottom: 6px;
    }

    .modal-form-control {
        width: 100%;
        height: 42px;
        border: 1px solid #9aa4af;
        border-radius: 6px;
        background: #edf4fb;
        padding: 8px 12px;
        font-size: 14px;
        color: #111;
        outline: none;
        box-sizing: border-box;
    }

    .modal-form-control:focus {
        border-color: #2f78bf;
        box-shadow: 0 0 0 3px rgba(47, 120, 191, 0.10);
    }

    textarea.modal-form-control {
        height: 95px;
        resize: vertical;
        padding-top: 10px;
    }

    .full-width {
        grid-column: 1 / -1;
    }

    .file-upload-box {
        position: relative;
        overflow: hidden;
    }

    .file-upload-box input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }

    .file-upload-label {
        height: 42px;
        display: flex;
        align-items: center;
        gap: 10px;
        background: #2f78bf;
        color: #fff;
        border-radius: 6px;
        padding: 0 14px;
        font-size: 14px;
        font-weight: 600;
        border: 1px solid #1b5d9a;
    }

    .file-upload-label i {
        font-style: normal;
        font-size: 20px;
    }

    .submit-wrap {
        text-align: center;
        margin-top: 20px;
    }

    .submit-btn {
        min-width: 160px;
        height: 48px;
        border: none;
        border-radius: 12px;
        background: linear-gradient(135deg, #2f78bf, #2469a8);
        color: #fff;
        font-size: 22px;
        font-weight: 800;
        cursor: pointer;
        box-shadow: 0 5px 0 rgba(0,0,0,0.14);
    }

    .error-text {
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }

    @media (max-width: 1200px) {
        .boq-grid {
            grid-template-columns: 1fr;
            max-width: 430px;
            margin: 0 auto;
        }

        .boq-card {
            min-height: auto;
        }
    }

    @media (max-width: 991px) {
        .boq-modal-box {
            max-width: 96%;
            padding: 22px 18px 20px;
        }

        .modal-form-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }

        .boq-heading h2 {
            font-size: 42px;
        }
    }

    @media (max-width: 768px) {
        .boq-section {
            padding: 45px 14px 65px;
        }

        .boq-heading {
            margin-bottom: 34px;
        }

        .boq-heading h2 {
            font-size: 34px;
        }

        .boq-line {
            width: 150px;
        }

        .boq-heading p {
            font-size: 14px;
        }

        .boq-badge {
            width: calc(100% - 24px);
            min-height: 52px;
            font-size: 15px;
            padding: 10px 12px;
        }

        .boq-card-body {
            padding: 56px 18px 20px;
        }

        .boq-list li {
            font-size: 14px;
        }

        .boq-free-box h2 {
            font-size: 38px;
        }

        .boq-btn {
            min-width: 165px;
            height: 42px;
            font-size: 14px;
        }
    }

    @media (max-width: 576px) {
        .modal-form-grid {
            grid-template-columns: 1fr;
        }

        .boq-modal {
            padding: 12px 8px;
        }

        .boq-modal-box {
            border-radius: 16px;
            padding: 16px 12px 16px;
        }

        .boq-close-btn {
            width: 32px;
            height: 32px;
            font-size: 18px;
            top: 8px;
            right: 8px;
        }

        .boq-modal-title {
            font-size: 18px;
            line-height: 1.35;
            padding-right: 20px;
        }

        .modal-section-title {
            font-size: 16px;
        }

        .modal-form-group label {
            font-size: 14px;
        }

        .modal-form-control {
            height: 40px;
            font-size: 13px;
        }

        textarea.modal-form-control {
            height: 85px;
        }

        .submit-btn {
            min-width: 135px;
            height: 44px;
            font-size: 18px;
        }
    }

    .simple-file-input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        background: #fff;
        font-size: 14px;
        color: #374151;
        box-sizing: border-box;
    }
</style>

<section class="boq-section">
    <div class="boq-container">

        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <div class="boq-heading">
            <h2>BOQ / Estimation</h2>
            <div class="boq-line"></div>
            <p>Choose the right estimation option based on your project stage and requirement.</p>
        </div>

        <div class="boq-grid">

            <!-- Rough Estimate -->
            <div class="boq-card orange-theme">
                <div class="boq-badge orange-badge">Rough Estimate</div>

                <div class="boq-card-body">
                    <p class="boq-top-text">Quick planning without site visit</p>

                    <div class="boq-content">
                        <div class="boq-block">
                            <h4 class="boq-subtitle orange-text">Best For</h4>
                            <ul class="boq-list">
                                <li>Early planning / idea stage</li>
                            </ul>
                        </div>

                        <div class="boq-block">
                            <h4 class="boq-subtitle orange-text">Includes</h4>
                            <ul class="boq-list">
                                <li>Approximate project cost</li>
                                <li>Basic quantity estimation</li>
                                <li>Item-wise cost breakup</li>
                                <li>Based on standard assumptions</li>
                            </ul>
                        </div>

                        <div class="boq-block">
                            <h4 class="boq-subtitle orange-text">Input Required</h4>
                            <ul class="boq-list">
                                <li>Plot size / area</li>
                                <li>Basic requirements</li>
                                <li>Drawings</li>
                            </ul>
                        </div>
                    </div>

                    <div class="boq-bottom">
                        <div class="boq-price-box">
                            <h3>₹2,000 – ₹7,000</h3>
                            <p>Final cost may vary after site measurement</p>
                        </div>

                        <div class="boq-btn-wrap">
                            <button type="button" class="boq-btn orange-btn open-boq-modal" data-package="Rough Estimate">Get Estimate</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed BOQ -->
            <div class="boq-card blue-theme">
                <div class="boq-badge blue-badge">Detailed BOQ + Site Measurement</div>

                <div class="boq-card-body">
                    <p class="boq-top-text">Accurate costing for real execution</p>

                    <div class="boq-content">
                        <div class="boq-block">
                            <h4 class="boq-subtitle blue-text">Best For</h4>
                            <ul class="boq-list">
                                <li>Ready sites / final budgeting</li>
                            </ul>
                        </div>

                        <div class="boq-block">
                            <h4 class="boq-subtitle blue-text">Includes</h4>
                            <ul class="boq-list">
                                <li>Site visit by expert</li>
                                <li>Measurement sheet</li>
                                <li>Detailed BOQ</li>
                                <li>Accurate quantity takeoff</li>
                                <li>Market-based cost estimation</li>
                            </ul>
                        </div>
                    </div>

                    <div class="boq-bottom">
                        <div class="boq-price-box">
                            <h3>Visit: ₹2,000 – ₹10,000</h3>
                            <h3>BOQ: ₹5,000 – ₹1,00,000+</h3>
                        </div>

                        <div class="boq-btn-wrap">
                            <button type="button" class="boq-btn blue-btn open-boq-modal" data-package="Detailed BOQ + Site Measurement">Book Site Visit</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Free BOQ -->
            <div class="boq-card white-theme">
                <div class="boq-badge mix-badge">Free BOQ with Execution</div>

                <div class="boq-card-body">
                    <p class="boq-top-text">Zero upfront cost for serious projects</p>

                    <div class="boq-content">
                        <div class="boq-block">
                            <h4 class="boq-subtitle mix-text">Best For</h4>
                            <ul class="boq-list">
                                <li>Clients ready to start construction</li>
                            </ul>
                        </div>

                        <div class="boq-block">
                            <h4 class="boq-subtitle mix-text">Includes</h4>
                            <ul class="boq-list">
                                <li>Free site measurement</li>
                                <li>Complete BOQ</li>
                                <li>End-to-end execution support</li>
                            </ul>
                        </div>

                        <div class="boq-block">
                            <h4 class="boq-subtitle mix-text">How It Works</h4>
                            <ul class="boq-list">
                                <li>No upfront BOQ cost</li>
                                <li>Execution via ConstructKaro</li>
                                <li>Managed by ConstructKaro</li>
                            </ul>
                        </div>
                    </div>

                    <div class="boq-bottom">
                        <div class="boq-price-box boq-free-box">
                            <h2>₹0 <span>upfront</span></h2>
                            <p>Applicable only if project is executed through ConstructKaro</p>
                        </div>

                        <div class="boq-btn-wrap">
                            <button type="button" class="boq-btn mix-btn open-boq-modal" data-package="Free BOQ with Execution">Start My Project</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Modal -->
<div class="boq-modal" id="boqModal">
    <div class="boq-modal-box">
        <button type="button" class="boq-close-btn" id="closeBoqModal">&times;</button>

        <h2 class="boq-modal-title" id="boqModalTitle">Book Your BOQ / Estimation Package</h2>
        <p class="boq-modal-subtitle">
            Fill out the form below, and our team will reach out to confirm your booking and discuss the BOQ/Estimation details.
        </p>

        <form action="{{ route('boq.enquiry.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="package_name" id="package_name" value="{{ old('package_name') }}">

            <div class="modal-section-title">Location Details:</div>

            <div class="modal-form-grid">
                <div class="modal-form-group">
                    <label>House no./ Building/Company Name</label>
                    <input type="text" name="house_building_name" class="modal-form-control" value="{{ old('house_building_name') }}" placeholder="Enter house / building / company name">
                    @error('house_building_name') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>Road Name / Area / Colony</label>
                    <input type="text" name="road_area_colony" class="modal-form-control" value="{{ old('road_area_colony') }}" placeholder="Enter road / area / colony">
                    @error('road_area_colony') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>City</label>
                    <input type="text" name="city" class="modal-form-control" value="{{ old('city') }}" placeholder="Enter city">
                    @error('city') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>Pincode</label>
                    <input type="text" name="pincode" class="modal-form-control" value="{{ old('pincode') }}" placeholder="Enter pincode">
                    @error('pincode') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>Landmark</label>
                    <input type="text" name="landmark" class="modal-form-control" value="{{ old('landmark') }}" placeholder="Enter landmark">
                    @error('landmark') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>Site Location Type</label>
                    <select name="site_location_type" class="modal-form-control">
                        <option value="">Select</option>
                        <option value="Urban" {{ old('site_location_type') == 'Urban' ? 'selected' : '' }}>Urban</option>
                        <option value="Semi Urban" {{ old('site_location_type') == 'Semi Urban' ? 'selected' : '' }}>Semi Urban</option>
                        <option value="Rural" {{ old('site_location_type') == 'Rural' ? 'selected' : '' }}>Rural</option>
                    </select>
                    @error('site_location_type') <div class="error-text">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="modal-section-title">Project Information:</div>

            <div class="modal-form-grid">
                <div class="modal-form-group">
                    <label>Project Name</label>
                    <input type="text" name="project_name" class="modal-form-control" value="{{ old('project_name') }}" placeholder="Enter project name">
                    @error('project_name') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>No. of Floors</label>
                    <input type="number" name="no_of_floors" class="modal-form-control" value="{{ old('no_of_floors') }}" placeholder="Enter no. of floors">
                    @error('no_of_floors') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>Project Area</label>
                    <input type="text" name="project_area" class="modal-form-control" value="{{ old('project_area') }}" placeholder="Enter project area">
                    @error('project_area') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>Unit</label>
                    <select name="unit" class="modal-form-control">
                        <option value="">Select Unit</option>
                        <option value="Sq.ft" {{ old('unit') == 'Sq.ft' ? 'selected' : '' }}>Sq.ft</option>
                        <option value="Sq.m" {{ old('unit') == 'Sq.m' ? 'selected' : '' }}>Sq.m</option>
                        <option value="Acre" {{ old('unit') == 'Acre' ? 'selected' : '' }}>Acre</option>
                        <option value="Guntha" {{ old('unit') == 'Guntha' ? 'selected' : '' }}>Guntha</option>
                    </select>
                    @error('unit') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>Project Type</label>
                    <select name="project_type" class="modal-form-control">
                        <option value="">Select Project Type</option>
                        <option value="Residential" {{ old('project_type') == 'Residential' ? 'selected' : '' }}>Residential</option>
                        <option value="Commercial" {{ old('project_type') == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                        <option value="Industrial" {{ old('project_type') == 'Industrial' ? 'selected' : '' }}>Industrial</option>
                        <option value="Bungalow" {{ old('project_type') == 'Bungalow' ? 'selected' : '' }}>Bungalow</option>
                        <option value="Apartment" {{ old('project_type') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                        <option value="Villa" {{ old('project_type') == 'Villa' ? 'selected' : '' }}>Villa</option>
                        <option value="Warehouse" {{ old('project_type') == 'Warehouse' ? 'selected' : '' }}>Warehouse</option>
                        <option value="Other" {{ old('project_type') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('project_type') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>Service Required</label>
                    <select name="service_required" id="service_required" class="modal-form-control">
                        <option value="">Select Service</option>
                        <option value="Rough Estimate" {{ old('service_required') == 'Rough Estimate' ? 'selected' : '' }}>Rough Estimate</option>
                        <option value="Detailed BOQ" {{ old('service_required') == 'Detailed BOQ' ? 'selected' : '' }}>Detailed BOQ</option>
                        <option value="Site Measurement" {{ old('service_required') == 'Site Measurement' ? 'selected' : '' }}>Site Measurement</option>
                        <option value="BOQ + Site Measurement" {{ old('service_required') == 'BOQ + Site Measurement' ? 'selected' : '' }}>BOQ + Site Measurement</option>
                        <option value="Execution Support" {{ old('service_required') == 'Execution Support' ? 'selected' : '' }}>Execution Support</option>
                    </select>
                    @error('service_required') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>Scope of Work Required</label>
                    <select name="scope_of_work_required" class="modal-form-control">
                        <option value="">Select Service Scope</option>
                        <option value="Structural" {{ old('scope_of_work_required') == 'Structural' ? 'selected' : '' }}>Structural</option>
                        <option value="Architectural" {{ old('scope_of_work_required') == 'Architectural' ? 'selected' : '' }}>Architectural</option>
                        <option value="Civil" {{ old('scope_of_work_required') == 'Civil' ? 'selected' : '' }}>Civil</option>
                        <option value="Interior" {{ old('scope_of_work_required') == 'Interior' ? 'selected' : '' }}>Interior</option>
                        <option value="MEP" {{ old('scope_of_work_required') == 'MEP' ? 'selected' : '' }}>MEP</option>
                        <option value="Complete Project" {{ old('scope_of_work_required') == 'Complete Project' ? 'selected' : '' }}>Complete Project</option>
                    </select>
                    @error('scope_of_work_required') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>Drawing Availability</label>
                    <select name="drawing_availability" class="modal-form-control">
                        <option value="">Select</option>
                        <option value="Yes" {{ old('drawing_availability') == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ old('drawing_availability') == 'No' ? 'selected' : '' }}>No</option>
                        <option value="In Progress" {{ old('drawing_availability') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    </select>
                    @error('drawing_availability') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>Expected Budget</label>
                    <input type="text" name="expected_budget" class="modal-form-control" value="{{ old('expected_budget') }}" placeholder="Enter expected budget">
                    @error('expected_budget') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>Expected Start Time</label>
                    <select name="expected_start_time" class="modal-form-control">
                        <option value="">Select</option>
                        <option value="Immediate" {{ old('expected_start_time') == 'Immediate' ? 'selected' : '' }}>Immediate</option>
                        <option value="Within 1 Month" {{ old('expected_start_time') == 'Within 1 Month' ? 'selected' : '' }}>Within 1 Month</option>
                        <option value="Within 3 Months" {{ old('expected_start_time') == 'Within 3 Months' ? 'selected' : '' }}>Within 3 Months</option>
                        <option value="Later" {{ old('expected_start_time') == 'Later' ? 'selected' : '' }}>Later</option>
                    </select>
                    @error('expected_start_time') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
    <label>Upload Drawings</label>
    <input type="file" name="drawing_file" class="simple-file-input" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.dwg">
    @error('drawing_file') <div class="error-text">{{ $message }}</div> @enderror
</div>

                <div class="modal-form-group full-width">
                    <label style="color:#2f78bf;">Additional Requirement Details:</label>
                    <textarea name="additional_details" class="modal-form-control" placeholder="Provide any specific details or notes...">{{ old('additional_details') }}</textarea>
                    @error('additional_details') <div class="error-text">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="submit-wrap">
                <button type="submit" class="submit-btn">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('boqModal');
    const closeModal = document.getElementById('closeBoqModal');
    const modalTitle = document.getElementById('boqModalTitle');
    const packageInput = document.getElementById('package_name');
    const serviceRequired = document.getElementById('service_required');

    document.querySelectorAll('.open-boq-modal').forEach(function(button) {
        button.addEventListener('click', function () {
            const packageName = this.getAttribute('data-package');

            modalTitle.textContent = 'Book Your ' + packageName + ' Package';
            packageInput.value = packageName;

            if (serviceRequired) {
                if (packageName === 'Rough Estimate') {
                    serviceRequired.value = 'Rough Estimate';
                } else if (packageName === 'Detailed BOQ + Site Measurement') {
                    serviceRequired.value = 'BOQ + Site Measurement';
                } else if (packageName === 'Free BOQ with Execution') {
                    serviceRequired.value = 'Execution Support';
                }
            }

            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        });
    });

    closeModal.addEventListener('click', function () {
        modal.classList.remove('show');
        document.body.style.overflow = 'auto';
    });

    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
        }
    });
});
</script>

@if($errors->any())
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('boqModal');
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
});
</script>
@endif

@endsection