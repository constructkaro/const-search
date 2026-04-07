@extends('layouts.app')

@section('title', 'NA Support & Legal Due Diligence')

@section('content')

<style>
    body {
        background: #efefef;
        font-family: 'Segoe UI', sans-serif;
    }

    .na-support-section {
        padding: 70px 20px 90px;
        background: #efefef;
    }

    .na-support-container {
        max-width: 1600px;
        margin: 0 auto;
    }

    .na-support-heading-wrap {
        text-align: center;
        margin-bottom: 34px;
    }

    .na-support-main-heading {
        font-size: 54px;
        font-weight: 800;
        color: #111;
        margin: 0;
        line-height: 1.1;
    }

    .na-support-heading-line {
        width: 320px;
        max-width: 90%;
        height: 4px;
        margin: 16px auto 12px;
        border-radius: 30px;
        background: linear-gradient(to right, #2d79bf 50%, #ef7a22 50%);
    }

    .na-support-subtitle {
        font-size: 24px;
        color: #444;
        margin: 0;
        font-weight: 500;
    }

    .na-support-box {
        position: relative;
        background: #f6e6db;
        border: 2px solid #ef7a22;
        border-left: 28px solid #ef7a22;
        border-radius: 30px;
        padding: 34px 34px 40px;
        box-shadow: 0 10px 22px rgba(0, 0, 0, 0.12);
        margin-top: 36px;
    }

    .na-support-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 22px 24px;
    }

    .na-support-item {
        background: #ffff;
        border: 1.5px solid #2d79bf;
        border-radius: 20px;
        min-height: 102px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px;
        text-align: center;
        box-shadow: 0 3px 8px rgba(0,0,0,0.08);
        transition: all 0.2s ease;
    }

    .na-support-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 18px rgba(0,0,0,0.12);
    }

    .na-support-item span {
        font-size: 22px;
        line-height: 1.2;
        font-weight: 800;
        color: #000;
        display: block;
    }

    .na-support-btn-wrap {
        text-align: center;
        margin-top: 34px;
    }

    .na-support-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 290px;
        height: 68px;
        padding: 0 34px;
        border-radius: 40px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        color: #fff;
        font-size: 28px;
        font-weight: 800;
        background: linear-gradient(135deg, #114f95, #0b3f79);
        box-shadow: 0 10px 18px rgba(0, 0, 0, 0.16);
        transition: all 0.2s ease;
    }

    .na-support-btn:hover {
        transform: translateY(-2px);
        color: #fff;
    }

    /* =========================
       ENQUIRY MODAL
    ========================= */
    .na-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.65);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 99999;
        padding: 20px;
    }

    .na-modal-overlay.active {
        display: flex;
    }

    .na-modal {
        width: 100%;
        max-width: 1080px;
        max-height: 90vh;
        background: #f5f5f5;
        border-radius: 22px;
        position: relative;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.28);
        overflow: hidden;
        animation: naModalFade 0.25s ease;
        display: flex;
        flex-direction: column;
    }

    @keyframes naModalFade {
        from {
            opacity: 0;
            transform: translateY(20px) scale(0.97);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .na-modal-close {
        position: absolute;
        top: 16px;
        right: 16px;
        width: 44px;
        height: 44px;
        border: none;
        border-radius: 50%;
        background: #ef7a22;
        color: #fff;
        font-size: 26px;
        font-weight: 700;
        cursor: pointer;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
    }

    .na-modal-header {
        padding: 36px 70px 18px;
        text-align: center;
        background: #f5f5f5;
        flex-shrink: 0;
    }

    .na-form-title {
        font-size: 34px;
        font-weight: 800;
        color: #222;
        margin: 0 0 10px;
        line-height: 1.2;
    }

    .na-form-subtitle {
        max-width: 760px;
        margin: 0 auto;
        font-size: 17px;
        color: #5b5b5b;
        line-height: 1.6;
    }

    .na-modal-body {
        padding: 8px 26px 30px;
        overflow-y: auto;
        overflow-x: hidden;
        flex: 1;
    }

    .na-modal-body::-webkit-scrollbar {
        width: 8px;
    }

    .na-modal-body::-webkit-scrollbar-thumb {
        background: #bdbdbd;
        border-radius: 10px;
    }

    .na-modal-form-inner {
        padding: 0 6px;
    }

    .na-form-section-title {
        font-size: 24px;
        font-weight: 800;
        color: #2d79bf;
        margin: 20px 0 14px;
    }

    .na-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px 24px;
    }

    .na-form-group.full {
        grid-column: span 2;
    }

    .na-form-group label {
        display: block;
        font-size: 19px;
        font-weight: 800;
        color: #222;
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .na-form-control,
    .na-form-select,
    .na-form-textarea {
        width: 100%;
        border: 1.5px solid #8c96a3;
        border-radius: 8px;
        background: #e5ecf4;
        padding: 14px 14px;
        font-size: 17px;
        color: #222;
        outline: none;
        transition: 0.2s ease;
        box-sizing: border-box;
    }

    .na-form-control,
    .na-form-select {
        height: 58px;
    }

    .na-form-control:focus,
    .na-form-select:focus,
    .na-form-textarea:focus {
        border-color: #2d79bf;
        box-shadow: 0 0 0 3px rgba(45, 121, 191, 0.10);
    }

    .na-form-control::placeholder,
    .na-form-textarea::placeholder {
        color: #a1a1a1;
    }

    .na-form-textarea {
        min-height: 150px;
        resize: vertical;
    }

    .na-select-wrap {
        position: relative;
    }

    .na-select-wrap .na-form-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        padding-right: 55px;
    }

    .na-select-wrap::after {
        content: "⌄";
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 30px;
        height: 30px;
        background: #2d79bf;
        color: #fff;
        border-radius: 50%;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
    }

    .na-area-wrap {
        position: relative;
    }

    .na-area-wrap .na-form-control {
        padding-right: 130px;
    }

    .na-unit-select {
        position: absolute;
        right: 8px;
        top: 9px;
        height: 40px;
        width: 115px;
        border: none;
        border-radius: 12px;
        background: linear-gradient(135deg, #3382cf, #2b6dac);
        color: #fff;
        font-size: 15px;
        font-weight: 700;
        padding: 0 12px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
    }

    .na-toggle-block {
        margin-bottom: 24px;
    }

    .na-toggle-question {
        font-size: 22px;
        font-weight: 800;
        color: #222;
        margin-bottom: 12px;
        line-height: 1.4;
    }

    .na-toggle-options {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
    }

    .na-toggle-options input {
        display: none;
    }

    .na-toggle-options label {
        min-width: 110px;
        height: 48px;
        padding: 0 20px;
        border-radius: 8px;
        border: 1.5px solid #7d8793;
        background: #e8eef5;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 700;
        cursor: pointer;
        margin-bottom: 0;
    }

    .na-toggle-options input:checked + label {
        background: #2d79bf;
        border-color: #2d79bf;
        color: #fff;
    }

    .na-submit-wrap {
        text-align: center;
        margin-top: 30px;
    }

    .na-submit-btn {
        min-width: 250px;
        height: 60px;
        border: none;
        border-radius: 14px;
        background: linear-gradient(135deg, #3382cf, #2b6dac);
        color: #fff;
        font-size: 30px;
        font-weight: 800;
        cursor: pointer;
        box-shadow: 0 10px 18px rgba(0, 0, 0, 0.14);
    }

    .na-submit-btn:hover {
        opacity: 0.96;
    }

    /* =========================
       SUCCESS MODAL
    ========================= */
    .success-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.55);
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
        padding: 26px 22px 24px;
        box-shadow: 0 20px 45px rgba(0,0,0,0.22);
        animation: successPop 0.25s ease;
    }

    @keyframes successPop {
        from {
            opacity: 0;
            transform: scale(0.92);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .success-check-icon {
        width: 92px;
        height: 92px;
        background: #ef7a22;
        border-radius: 50%;
        margin: 0 auto 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 52px;
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
        font-size: 19px;
        color: #555;
        line-height: 1.6;
        margin-bottom: 22px;
    }

    .success-ok-btn {
        min-width: 120px;
        height: 46px;
        border: none;
        border-radius: 8px;
        background: linear-gradient(135deg, #3382cf, #2b6dac);
        color: #fff;
        font-size: 24px;
        font-weight: 800;
        cursor: pointer;
        box-shadow: 0 5px 12px rgba(0,0,0,0.18);
    }

    .field-error {
        display: block;
        margin-top: 6px;
        color: red;
        font-size: 14px;
        font-weight: 600;
    }

    @media (max-width: 1500px) {
        .na-support-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .na-support-main-heading {
            font-size: 46px;
        }

        .na-support-item span {
            font-size: 20px;
        }
    }

    @media (max-width: 1100px) {
        .na-support-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .na-support-box {
            padding: 28px 20px 34px;
        }

        .na-modal {
            max-width: 95vw;
        }

        .na-modal-header {
            padding: 32px 50px 16px;
        }

        .na-form-grid {
            grid-template-columns: 1fr;
        }

        .na-form-group.full {
            grid-column: span 1;
        }

        .na-form-title {
            font-size: 30px;
        }
    }

    @media (max-width: 768px) {
        .na-support-section {
            padding: 50px 14px 70px;
        }

        .na-support-main-heading {
            font-size: 34px;
        }

        .na-support-heading-line {
            width: 220px;
        }

        .na-support-subtitle {
            font-size: 18px;
        }

        .na-support-grid {
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .na-support-box {
            border-left-width: 12px;
            padding: 20px 14px 28px;
            border-radius: 22px;
        }

        .na-support-item {
            min-height: 82px;
            border-radius: 16px;
        }

        .na-support-item span {
            font-size: 18px;
        }

        .na-support-btn {
            width: 100%;
            min-width: auto;
            height: 56px;
            font-size: 24px;
        }

        .na-modal-overlay {
            padding: 10px;
        }

        .na-modal {
            max-height: 94vh;
            border-radius: 16px;
        }

        .na-modal-header {
            padding: 24px 42px 14px;
        }

        .na-form-title {
            font-size: 26px;
        }

        .na-form-subtitle {
            font-size: 14px;
        }

        .na-modal-body {
            padding: 8px 14px 22px;
        }

        .na-form-group label,
        .na-toggle-question {
            font-size: 16px;
        }

        .na-submit-btn {
            width: 100%;
            min-width: auto;
            font-size: 24px;
            height: 54px;
        }

        .na-unit-select {
            width: 95px;
            font-size: 13px;
        }

        .na-area-wrap .na-form-control {
            padding-right: 110px;
        }

        .success-modal-box {
            max-width: 95%;
            padding: 24px 18px 22px;
        }

        .success-check-icon {
            width: 78px;
            height: 78px;
            font-size: 42px;
        }

        .success-modal-title {
            font-size: 24px;
        }

        .success-modal-text {
            font-size: 16px;
        }

        .success-ok-btn {
            font-size: 20px;
            height: 42px;
        }
    }
</style>

<section class="na-support-section">
    <div class="na-support-container">
        <div class="na-support-heading-wrap">
            <h2 class="na-support-main-heading">NA Support &amp; Legal Due Diligence</h2>
            <div class="na-support-heading-line"></div>
            <p class="na-support-subtitle">For land &amp; industrial only</p>
        </div>

        <div class="na-support-box">
            <div class="na-support-grid">
                <div class="na-support-item"><span>Title Search (7/12)</span></div>
                <div class="na-support-item"><span>8A Extract<br>Verification</span></div>
                <div class="na-support-item"><span>Basic Title<br>Verification Report</span></div>
                <div class="na-support-item"><span>Sale Deed Drafting</span></div>

                <div class="na-support-item"><span>Agreement to<br>Sale Drafting</span></div>
                <div class="na-support-item"><span>Stamp Duty<br>Calculation</span></div>
                <div class="na-support-item"><span>Document<br>Registration Support</span></div>
                <div class="na-support-item"><span>Encumbrance<br>Check</span></div>

                <div class="na-support-item"><span>Property Tax Receipt<br>Verification</span></div>
                <div class="na-support-item"><span>20–30 Years<br>Title Search</span></div>
                <div class="na-support-item"><span>Chain of Documents<br>Verification</span></div>
                <div class="na-support-item"><span>Ownership<br>Verification</span></div>

                <div class="na-support-item"><span>Encumbrance<br>Certificate Analysis</span></div>
                <div class="na-support-item"><span>Court Case /<br>Litigation Check</span></div>
                <div class="na-support-item"><span>Land Use<br>Verification</span></div>
                <div class="na-support-item"><span>Zoning Regulation<br>Check</span></div>

                <div class="na-support-item"><span>RERA Project<br>Verification</span></div>
                <div class="na-support-item"><span>Layout Approval<br>Verification</span></div>
                <div class="na-support-item"><span>Buyer KYC<br>Verification</span></div>
                <div class="na-support-item"><span>NA Feasibility<br>Check</span></div>

                <div class="na-support-item"><span>Land Zoning<br>Verification</span></div>
                <div class="na-support-item"><span>NA Application<br>Documentation</span></div>
                <div class="na-support-item"><span>NA File<br>Submission</span></div>
                <div class="na-support-item"><span>Sale Deed<br>Execution Support</span></div>

                <div class="na-support-item"><span>Property Registration<br>Support</span></div>
                <div class="na-support-item"><span>Mutation Entry<br>(7/12 Transfer)</span></div>
                <div class="na-support-item"><span>Property Card<br>Update</span></div>
                <div class="na-support-item"><span>Final Legal<br>Opinion</span></div>

                <div class="na-support-item"><span>Complete Documentation<br>Handover</span></div>
                <div class="na-support-item"><span>Basic Title<br>Verification Report</span></div>
            </div>

            <div class="na-support-btn-wrap">
                <a href="javascript:void(0)" class="na-support-btn" id="openEnquiryModal">Enquire Now</a>
            </div>
        </div>
    </div>
</section>

<!-- Enquiry Modal -->
<div class="na-modal-overlay" id="naEnquiryModal">
    <div class="na-modal">
        <button type="button" class="na-modal-close" id="closeEnquiryModal">&times;</button>

        <div class="na-modal-header">
            <h2 class="na-form-title">NA Support &amp; Legal Due Diligence</h2>
            <p class="na-form-subtitle">
                Fill out the form below, and our team will reach out to confirm your booking and discuss
                the NA Support &amp; Legal Due Diligence details.
            </p>
        </div>

        <div class="na-modal-body">
            <div class="na-modal-form-inner">
                <form action="{{ route('na.support.store') }}" method="POST">
                    @csrf

                    <h3 class="na-form-section-title">Location Details:</h3>

                    <div class="na-form-grid">
                        <div class="na-form-group">
                            <label>House no./ Building/Company Name</label>
                            <input type="text" name="building_name" class="na-form-control" placeholder="Crescent Pearl B" value="{{ old('building_name') }}">
                            @error('building_name')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="na-form-group">
                            <label>Road Name / Area / Colony</label>
                            <input type="text" name="road_name" class="na-form-control" placeholder="Veena Nagar, Katrang Road, Khalapur" value="{{ old('road_name') }}">
                            @error('road_name')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="na-form-group">
                            <label>City</label>
                            <input type="text" name="city" class="na-form-control" placeholder="Khopoli" value="{{ old('city') }}">
                            @error('city')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="na-form-group">
                            <label>Pincode</label>
                            <input type="text" name="pincode" class="na-form-control" placeholder="405410" value="{{ old('pincode') }}">
                            @error('pincode')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <h3 class="na-form-section-title">Project Information:</h3>

                    <div class="na-form-grid">
                        <div class="na-form-group full">
                            <label>Project Name <span style="color:red;">*</span></label>
                            <input type="text" name="project_name" class="na-form-control" placeholder="Shreya Residency" value="{{ old('project_name') }}">
                            @error('project_name')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="na-form-group">
                            <label>Current Land Status</label>
                            <div class="na-select-wrap">
                                <select name="land_status" class="na-form-select">
                                    <option value="">Select</option>
                                    <option value="agricultural" {{ old('land_status') == 'agricultural' ? 'selected' : '' }}>Agricultural</option>
                                    <option value="na_land" {{ old('land_status') == 'na_land' ? 'selected' : '' }}>NA Land</option>
                                    <option value="residential" {{ old('land_status') == 'residential' ? 'selected' : '' }}>Residential</option>
                                    <option value="commercial" {{ old('land_status') == 'commercial' ? 'selected' : '' }}>Commercial</option>
                                    <option value="industrial" {{ old('land_status') == 'industrial' ? 'selected' : '' }}>Industrial</option>
                                </select>
                            </div>
                            @error('land_status')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="na-form-group">
                            <label>Project Area</label>
                            <div class="na-area-wrap">
                                <input type="text" name="project_area" class="na-form-control" placeholder="2000" value="{{ old('project_area') }}">
                                <select name="project_area_unit" class="na-unit-select">
                                    <option value="">Unit</option>
                                    <option value="sqft" {{ old('project_area_unit') == 'sqft' ? 'selected' : '' }}>Sq.ft</option>
                                    <option value="sqm" {{ old('project_area_unit') == 'sqm' ? 'selected' : '' }}>Sq.m</option>
                                    <option value="acre" {{ old('project_area_unit') == 'acre' ? 'selected' : '' }}>Acre</option>
                                    <option value="guntha" {{ old('project_area_unit') == 'guntha' ? 'selected' : '' }}>Guntha</option>
                                </select>
                            </div>
                            @error('project_area')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                            @error('project_area_unit')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div style="margin-top: 24px;">
                        <div class="na-toggle-block">
                            <div class="na-toggle-question">Do you require complete NA process end-to-end?</div>
                            <div class="na-toggle-options">
                                <input type="radio" id="na_process_yes" name="complete_na_process" value="yes" {{ old('complete_na_process') == 'yes' ? 'checked' : '' }}>
                                <label for="na_process_yes">Yes</label>

                                <input type="radio" id="na_process_no" name="complete_na_process" value="no" {{ old('complete_na_process') == 'no' ? 'checked' : '' }}>
                                <label for="na_process_no">No</label>
                            </div>
                            @error('complete_na_process')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="na-toggle-block">
                            <div class="na-toggle-question">Do you require legal opinion reports?</div>
                            <div class="na-toggle-options">
                                <input type="radio" id="legal_report_yes" name="legal_opinion_report" value="yes" {{ old('legal_opinion_report') == 'yes' ? 'checked' : '' }}>
                                <label for="legal_report_yes">Yes</label>

                                <input type="radio" id="legal_report_no" name="legal_opinion_report" value="no" {{ old('legal_opinion_report') == 'no' ? 'checked' : '' }}>
                                <label for="legal_report_no">No</label>
                            </div>
                            @error('legal_opinion_report')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="na-toggle-block">
                            <div class="na-toggle-question">Do you require advocate coordinate?</div>
                            <div class="na-toggle-options">
                                <input type="radio" id="advocate_yes" name="advocate_coordinate" value="yes" {{ old('advocate_coordinate') == 'yes' ? 'checked' : '' }}>
                                <label for="advocate_yes">Yes</label>

                                <input type="radio" id="advocate_no" name="advocate_coordinate" value="no" {{ old('advocate_coordinate') == 'no' ? 'checked' : '' }}>
                                <label for="advocate_no">No</label>
                            </div>
                            @error('advocate_coordinate')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <h3 class="na-form-section-title">Additional Requirement Details</h3>

                    <div class="na-form-group">
                        <textarea name="additional_details" class="na-form-textarea" placeholder="Provide any specific details or notes...">{{ old('additional_details') }}</textarea>
                        @error('additional_details')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="na-submit-wrap">
                        <button type="submit" class="na-submit-btn">Submit</button>
                    </div>
                </form>
            </div>
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
        const openBtn = document.getElementById('openEnquiryModal');
        const enquiryModal = document.getElementById('naEnquiryModal');
        const closeBtn = document.getElementById('closeEnquiryModal');
        const successModal = document.getElementById('successModal');
        const successOkBtn = document.getElementById('successOkBtn');

        function openModal(modal) {
            if (modal) {
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeModal(modal) {
            if (modal) {
                modal.classList.remove('active');
                document.body.style.overflow = '';
            }
        }

        if (openBtn) {
            openBtn.addEventListener('click', function () {
                openModal(enquiryModal);
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', function () {
                closeModal(enquiryModal);
            });
        }

        if (enquiryModal) {
            enquiryModal.addEventListener('click', function (e) {
                if (e.target === enquiryModal) {
                    closeModal(enquiryModal);
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
                closeModal(enquiryModal);
                closeModal(successModal);
            }
        });

        @if($errors->any())
            openModal(enquiryModal);
        @endif

        @if(session('success_modal'))
            openModal(successModal);
        @endif
    });
</script>

@endsection