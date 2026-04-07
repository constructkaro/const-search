@extends('layouts.app')

@section('title', 'Structural Audit')

@section('content')

<style>
    body {
        background: #efefef;
        font-family: 'Segoe UI', sans-serif;
    }

    .structural-audit-section {
        padding: 70px 20px 90px;
        background: #efefef;
    }

    .structural-audit-container {
        max-width: 1820px;
        margin: 0 auto;
    }

    .structural-audit-heading-wrap {
        text-align: center;
        margin-bottom: 70px;
    }

    .structural-audit-main-heading {
        font-size: 58px;
        font-weight: 800;
        color: #1b1b1b;
        margin: 0;
        line-height: 1.1;
    }

    .structural-audit-heading-line {
        width: 290px;
        max-width: 90%;
        height: 4px;
        margin: 16px auto 0;
        border-radius: 30px;
        background: linear-gradient(to right, #2d79bf 50%, #ef7a22 50%);
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

    .structural-audit-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 22px;
        align-items: stretch;
    }

    .structural-audit-card {
        position: relative;
        border-radius: 26px;
        overflow: visible;
        display: flex;
        flex-direction: column;
        min-height: 100%;
        transition: all 0.25s ease;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.14);
    }

    .structural-audit-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 28px rgba(0,0,0,0.18);
    }

    .structural-audit-card.orange-theme {
        background: #f5e6db;
        border: 2px solid #ef7a22;
    }

    .structural-audit-card.blue-theme {
        background: #e8f1fa;
        border: 2px solid #2d79bf;
    }

   .structural-audit-badge {
    position: absolute;
    top: -28px;
    left: 50%;
    transform: translateX(-50%);
    width: calc(100% - 46px);
    min-height: 21px;
    padding: 6px 8px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #fff;
    font-size: 17px;
    font-weight: 800;
    line-height: 1.15;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.18);
    z-index: 2;
}

    .orange-theme .structural-audit-badge {
        background: linear-gradient(135deg, #f48a34, #eb6d14);
    }

    .blue-theme .structural-audit-badge {
        background: linear-gradient(135deg, #3382cf, #2b6dac);
    }

    .structural-audit-card-body {
        padding: 78px 24px 18px;
        display: flex;
        flex-direction: column;
        flex: 1;
        text-align: center;
    }

    .structural-audit-desc {
        margin: 0 0 22px;
        font-size: 17px;
        line-height: 1.34;
        color: #575757;
        min-height: 118px;
    }

    .structural-audit-list {
        list-style: none;
        padding: 0;
        margin: 0;
        text-align: left;
        flex: 1;
    }

    .structural-audit-list li {
        position: relative;
        padding-left: 20px;
        margin: 12px 0;
        font-size: 17px;
        line-height: 1.4;
        color: #525f6b;
    }

    .structural-audit-list li::before {
        content: "●";
        position: absolute;
        left: 0;
        top: 0;
        font-size: 11px;
        font-weight: 700;
    }

    .orange-theme .structural-audit-list li::before {
        color: #ef7a22;
    }

    .blue-theme .structural-audit-list li::before {
        color: #2d79bf;
    }

    .structural-audit-btn-wrap {
        margin-top: auto;
        padding-top: 18px;
        text-align: center;
    }

    .structural-audit-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 215px;
        height: 44px;
        padding: 0 22px;
        border-radius: 14px;
        text-decoration: none;
        color: #fff;
        font-size: 15px;
        font-weight: 800;
        border: none;
        cursor: pointer;
        box-shadow: 0 5px 12px rgba(0,0,0,0.14);
        transition: all 0.2s ease;
    }

    .structural-audit-btn:hover {
        transform: translateY(-2px);
        color: #fff;
    }

    .orange-btn {
        background: linear-gradient(135deg, #f48a34, #eb6d14);
    }

    .blue-btn {
        background: linear-gradient(135deg, #3382cf, #2b6dac);
    }

    /* Modal */
    .structural-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.55);
        z-index: 9999;
        overflow-y: auto;
        padding: 18px 12px;
    }

    .structural-modal.show {
        display: block;
    }

    .structural-modal-box {
        background: #fff;
        max-width: 1280px;
        width: 100%;
        margin: 0 auto;
        border-radius: 24px;
        padding: 24px 28px 24px;
        position: relative;
        box-shadow: 0 18px 45px rgba(0,0,0,0.22);
    }

    .structural-close-btn {
        position: absolute;
        top: 16px;
        right: 18px;
        width: 42px;
        height: 42px;
        background: #2f78bf;
        color: #fff;
        border: none;
        border-radius: 50%;
        font-size: 24px;
        font-weight: 700;
        cursor: pointer;
        line-height: 1;
    }

    .structural-modal-title {
        text-align: center;
        font-size: 30px;
        font-weight: 800;
        margin-bottom: 12px;
        color: #1f1f1f;
        padding-right: 34px;
    }

    .structural-modal-subtitle {
        text-align: center;
        max-width: 900px;
        margin: 0 auto 22px;
        font-size: 16px;
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
        grid-template-columns: repeat(2, 1fr);
        gap: 14px 18px;
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
    height: 40px;
    border: 1px solid #9aa4af;
    border-radius: 8px;
    background: #edf4fb;
    padding: 8px -5px;
    font-size: 14px;
    color: #111;
    outline: none;
}

    .modal-form-control:focus {
        border-color: #2f78bf;
        box-shadow: 0 0 0 3px rgba(47, 120, 191, 0.10);
    }

    textarea.modal-form-control {
        height: 150px;
        resize: vertical;
        padding-top: 12px;
    }

    .full-width {
        grid-column: 1 / -1;
    }

    .submit-wrap {
        text-align: center;
        margin-top: 22px;
    }

    .submit-btn {
        min-width: 180px;
        height: 56px;
        border: none;
        border-radius: 14px;
        background: linear-gradient(135deg, #2f78bf, #2469a8);
        color: #fff;
        font-size: 24px;
        font-weight: 800;
        cursor: pointer;
        box-shadow: 0 5px 0 rgba(0,0,0,0.14);
    }

    .error-text {
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }

    @media (max-width: 1450px) {
        .structural-audit-grid {
            grid-template-columns: repeat(2, 1fr);
            max-width: 1100px;
            margin: 0 auto;
            gap: 32px;
        }
    }

    @media (max-width: 991px) {
        .structural-modal-box {
            max-width: 96%;
            padding: 20px 16px 18px;
        }

        .modal-form-grid {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .structural-modal-title {
            font-size: 24px;
        }

        .structural-modal-subtitle {
            font-size: 14px;
        }
    }

    @media (max-width: 900px) {
        .structural-audit-section {
            padding: 55px 15px 70px;
        }

        .structural-audit-grid {
            grid-template-columns: 1fr;
            max-width: 560px;
            margin: 0 auto;
            gap: 28px;
        }

        .structural-audit-main-heading {
            font-size: 40px;
        }

        .structural-audit-heading-line {
            width: 210px;
        }

        .structural-audit-badge {
            font-size: 21px;
            min-height: 84px;
        }

        .structural-audit-card-body {
            padding: 98px 22px 18px;
        }

        .structural-audit-desc {
            font-size: 16px;
            min-height: auto;
        }

        .structural-audit-list li {
            font-size: 16px;
        }
    }

    @media (max-width: 576px) {
        .structural-audit-main-heading {
            font-size: 32px;
        }

        .structural-audit-badge {
            width: calc(100% - 24px);
            font-size: 18px;
            min-height: 78px;
            border-radius: 16px;
        }

        .structural-audit-card-body {
            padding: 92px 18px 18px;
        }

        .structural-audit-desc {
            font-size: 15px;
        }

        .structural-audit-list li {
            font-size: 15px;
        }

        .structural-audit-btn {
            width: 100%;
            min-width: auto;
            height: 44px;
            font-size: 15px;
        }

        .structural-modal-title {
            font-size: 20px;
            line-height: 1.35;
        }

        .modal-form-control {
            height: 44px;
            font-size: 13px;
        }

        textarea.modal-form-control {
            height: 110px;
        }

        .submit-btn {
            min-width: 150px;
            height: 46px;
            font-size: 18px;
        }
    }
</style>

<section class="structural-audit-section">
    <div class="structural-audit-container">

        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <div class="structural-audit-heading-wrap">
            <h2 class="structural-audit-main-heading">Structural Audit</h2>
            <div class="structural-audit-heading-line"></div>
        </div>

        <div class="structural-audit-grid">

            <!-- New Construction Check -->
            <div class="structural-audit-card orange-theme">
                <div class="structural-audit-badge">New Construction<br>Check</div>
                <div class="structural-audit-card-body">
                    <p class="structural-audit-desc">
                        Moving into a newly constructed property? Ensure its structural integrity before you invest whether it's residential, commercial, or industrial
                    </p>

                    <ul class="structural-audit-list">
                        <li>Pre-occupancy safety clearance</li>
                        <li>Code compliance verification</li>
                        <li>Foundation &amp; load-bearing check</li>
                    </ul>

                    <div class="structural-audit-btn-wrap">
                        <button type="button" class="structural-audit-btn orange-btn open-structural-modal" data-audit="New Construction Check">Enquire Now</button>
                    </div>
                </div>
            </div>

            <!-- General Building Health Check -->
            <div class="structural-audit-card blue-theme">
                <div class="structural-audit-badge">General Building<br>Health Check</div>
                <div class="structural-audit-card-body">
                    <p class="structural-audit-desc">
                        Routine assessment for structure 5–15 years old. Catch problems before they escalate.
                    </p>

                    <ul class="structural-audit-list">
                        <li>Early issue detection</li>
                        <li>Maintenance roadmap</li>
                        <li>Insurance &amp; resale documentation</li>
                    </ul>

                    <div class="structural-audit-btn-wrap">
                        <button type="button" class="structural-audit-btn blue-btn open-structural-modal" data-audit="General Building Health Check">Enquire Now</button>
                    </div>
                </div>
            </div>

            <!-- Crack & Damage Inspection -->
            <div class="structural-audit-card orange-theme">
                <div class="structural-audit-badge">Crack &amp; Damage<br>Inspection</div>
                <div class="structural-audit-card-body">
                    <p class="structural-audit-desc">
                        Noticed cracks, water seepage, or shifting walls? Get an expert diagnosis immediately
                    </p>

                    <ul class="structural-audit-list">
                        <li>Root cause analysis</li>
                        <li>Severity classification</li>
                        <li>Repair priority report</li>
                    </ul>

                    <div class="structural-audit-btn-wrap">
                        <button type="button" class="structural-audit-btn orange-btn open-structural-modal" data-audit="Crack & Damage Inspection">Enquire Now</button>
                    </div>
                </div>
            </div>

            <!-- Old Building Safety Audit -->
            <div class="structural-audit-card blue-theme">
                <div class="structural-audit-badge">Old Building Safety<br>Audit</div>
                <div class="structural-audit-card-body">
                    <p class="structural-audit-desc">
                        Buildings 20+ years old need periodic structural certification for occupant safety
                    </p>

                    <ul class="structural-audit-list">
                        <li>Structural stability rating</li>
                        <li>Regulatory compliance</li>
                        <li>Retrofit recommendations</li>
                    </ul>

                    <div class="structural-audit-btn-wrap">
                        <button type="button" class="structural-audit-btn blue-btn open-structural-modal" data-audit="Old Building Safety Audit">Enquire Now</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Modal -->
<div class="structural-modal" id="structuralModal">
    <div class="structural-modal-box">
        <button type="button" class="structural-close-btn" id="closeStructuralModal">&times;</button>

        <h2 class="structural-modal-title" id="structuralModalTitle">Structural Audit</h2>
        <p class="structural-modal-subtitle">
            Fill out the form below, and our team will reach out to confirm your booking and discuss the Structural Audit details.
        </p>

        <form action="{{ route('structural.audit.enquiry.store') }}" method="POST">
            @csrf

            <input type="hidden" name="audit_type" id="audit_type" value="{{ old('audit_type') }}">

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
            </div>

            <div class="modal-section-title">Project Information:</div>

            <div class="modal-form-grid">
                <div class="modal-form-group">
                    <label>Project Name</label>
                    <input type="text" name="project_name" class="modal-form-control" value="{{ old('project_name') }}" placeholder="Enter project name">
                    @error('project_name') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>Building Age</label>
                    <input type="number" name="building_age" class="modal-form-control" value="{{ old('building_age') }}" placeholder="Enter building age">
                    @error('building_age') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>Property Type</label>
                    <select name="property_type" class="modal-form-control">
                        <option value="">Select</option>
                        <option value="Residential" {{ old('property_type') == 'Residential' ? 'selected' : '' }}>Residential</option>
                        <option value="Commercial" {{ old('property_type') == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                        <option value="Industrial" {{ old('property_type') == 'Industrial' ? 'selected' : '' }}>Industrial</option>
                        <option value="Institutional" {{ old('property_type') == 'Institutional' ? 'selected' : '' }}>Institutional</option>
                        <option value="Mixed Use" {{ old('property_type') == 'Mixed Use' ? 'selected' : '' }}>Mixed Use</option>
                    </select>
                    @error('property_type') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>Number of Floors</label>
                    <input type="number" name="number_of_floors" class="modal-form-control" value="{{ old('number_of_floors') }}" placeholder="Enter number of floors">
                    @error('number_of_floors') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>Occupancy Status</label>
                    <select name="occupancy_status" class="modal-form-control">
                        <option value="">Select</option>
                        <option value="Occupied" {{ old('occupancy_status') == 'Occupied' ? 'selected' : '' }}>Occupied</option>
                        <option value="Vacant" {{ old('occupancy_status') == 'Vacant' ? 'selected' : '' }}>Vacant</option>
                        <option value="Under Construction" {{ old('occupancy_status') == 'Under Construction' ? 'selected' : '' }}>Under Construction</option>
                    </select>
                    @error('occupancy_status') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>Construction Type</label>
                    <select name="construction_type" class="modal-form-control">
                        <option value="">Select</option>
                        <option value="RCC Frame" {{ old('construction_type') == 'RCC Frame' ? 'selected' : '' }}>RCC Frame</option>
                        <option value="Load Bearing" {{ old('construction_type') == 'Load Bearing' ? 'selected' : '' }}>Load Bearing</option>
                        <option value="Steel Structure" {{ old('construction_type') == 'Steel Structure' ? 'selected' : '' }}>Steel Structure</option>
                        <option value="Composite" {{ old('construction_type') == 'Composite' ? 'selected' : '' }}>Composite</option>
                    </select>
                    @error('construction_type') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group full-width">
                    <label style="color:#2f78bf;">Additional Requirement Details</label>
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
    const modal = document.getElementById('structuralModal');
    const closeModal = document.getElementById('closeStructuralModal');
    const modalTitle = document.getElementById('structuralModalTitle');
    const auditInput = document.getElementById('audit_type');

    document.querySelectorAll('.open-structural-modal').forEach(function(button) {
        button.addEventListener('click', function () {
            const auditName = this.getAttribute('data-audit');

            modalTitle.textContent = auditName;
            auditInput.value = auditName;

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
    const modal = document.getElementById('structuralModal');
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
});
</script>
@endif

@endsection