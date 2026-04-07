@extends('layouts.app')

@section('title', 'Required Facade Type')

@section('content')

<style>
    body {
        background: #f3f4f6;
        font-family: 'Segoe UI', sans-serif;
    }

    .facade-type-section {
        padding: 70px 20px 90px;
        background: #f3f4f6;
    }

    .facade-container {
        max-width: 1780px;
        margin: 0 auto;
    }

    .facade-heading-wrap {
        text-align: center;
        margin-bottom: 55px;
    }

    .facade-main-heading {
        font-size: 52px;
        font-weight: 800;
        color: #1b1b1b;
        margin: 0;
        line-height: 1.1;
    }

    .facade-heading-line {
        width: 460px;
        max-width: 90%;
        height: 4px;
        margin: 18px auto 0;
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

    .facade-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 34px;
        align-items: stretch;
    }

    .facade-card {
        background: #fff;
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.12);
        transition: all 0.25s ease;
        display: flex;
        flex-direction: column;
        min-height: 100%;
    }

    .facade-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 34px rgba(0, 0, 0, 0.16);
    }

    .facade-card.blue-theme {
        border: 3px solid #2d79bf;
    }

    .facade-card.orange-theme {
        border: 3px solid #ef7a22;
    }

    .facade-image {
        height: 390px;
        overflow: hidden;
        background: #ddd;
    }

    .facade-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .facade-card-body {
        background: #edf4fb;
        padding: 20px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        flex: 1;
    }

    .facade-title {
        margin: 0;
        font-size: 21px;
        font-weight: 800;
        color: #111827;
        line-height: 1.3;
        flex: 1;
    }

    .facade-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 170px;
        height: 52px;
        padding: 0 22px;
        border-radius: 14px;
        text-decoration: none;
        color: #fff;
        font-size: 17px;
        font-weight: 800;
        box-shadow: 0 6px 14px rgba(0,0,0,0.14);
        transition: all 0.2s ease;
        white-space: nowrap;
        border: none;
        cursor: pointer;
    }

    .facade-btn:hover {
        transform: translateY(-2px);
        color: #fff;
    }

    .blue-btn {
        background: linear-gradient(135deg, #3382cf, #2b6dac);
    }

    .orange-btn {
        background: linear-gradient(135deg, #f48a34, #eb6d14);
    }

    /* Modal */
    .facade-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.55);
        z-index: 9999;
        overflow-y: auto;
        padding: 18px 12px;
    }

    .facade-modal.show {
        display: block;
    }

    .facade-modal-box {
        background: #fff;
        max-width: 1180px;
        width: 100%;
        margin: 0 auto;
        border-radius: 24px;
        padding: 24px 24px 22px;
        position: relative;
        box-shadow: 0 18px 45px rgba(0,0,0,0.22);
    }

    .facade-close-btn {
        position: absolute;
        top: 14px;
        right: 16px;
        width: 40px;
        height: 40px;
        background: #2f78bf;
        color: #fff;
        border: none;
        border-radius: 50%;
        font-size: 22px;
        font-weight: 700;
        cursor: pointer;
        line-height: 1;
    }

    .facade-modal-title {
        text-align: center;
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 10px;
        color: #1f1f1f;
        padding-right: 28px;
    }

    .facade-modal-subtitle {
        text-align: center;
        max-width: 980px;
        margin: 0 auto 20px;
        font-size: 15px;
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
    width: 95%;
    height: 42px;
    border: 1px solid #9aa4af;
    border-radius: 6px;
    background: #edf4fb;
    padding: 10px 12px;
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
        min-width: 170px;
        height: 52px;
        border: none;
        border-radius: 14px;
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

    @media (max-width: 1400px) {
        .facade-image {
            height: 330px;
        }

        .facade-main-heading {
            font-size: 44px;
        }
    }

    @media (max-width: 1100px) {
        .facade-grid {
            grid-template-columns: 1fr;
            max-width: 760px;
            margin: 0 auto;
        }

        .facade-image {
            height: 360px;
        }
    }

    @media (max-width: 991px) {
        .facade-modal-box {
            max-width: 96%;
            padding: 20px 16px 18px;
        }

        .modal-form-grid {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .facade-modal-title {
            font-size: 24px;
        }

        .facade-modal-subtitle {
            font-size: 14px;
        }
    }

    @media (max-width: 768px) {
        .facade-type-section {
            padding: 50px 15px 70px;
        }

        .facade-main-heading {
            font-size: 34px;
        }

        .facade-heading-line {
            width: 220px;
        }

        .facade-image {
            height: 240px;
        }

        .facade-card-body {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
        }

        .facade-title {
            font-size: 20px;
        }

        .facade-btn {
            width: 100%;
            min-width: auto;
            height: 48px;
            font-size: 16px;
        }

        .facade-modal-title {
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

<section class="facade-type-section">
    <div class="facade-container">

        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <div class="facade-heading-wrap">
            <h2 class="facade-main-heading">Required Facade Type</h2>
            <div class="facade-heading-line"></div>
        </div>

        <div class="facade-grid">

            <!-- Glass Facade -->
            <div class="facade-card blue-theme">
                <div class="facade-image">
                    <img src="{{ asset('images/facade/glass-facade.png') }}" alt="Glass Facade">
                </div>
                <div class="facade-card-body">
                    <h3 class="facade-title">Glass Facade</h3>
                    <button type="button" class="facade-btn blue-btn open-facade-modal" data-facade="Glass Facade">Enquire Now</button>
                </div>
            </div>

            <!-- ACP Cladding -->
            <div class="facade-card orange-theme">
                <div class="facade-image">
                    <img src="{{ asset('images/facade/acp-cladding.png') }}" alt="ACP Cladding">
                </div>
                <div class="facade-card-body">
                    <h3 class="facade-title">ACP Cladding</h3>
                    <button type="button" class="facade-btn orange-btn open-facade-modal" data-facade="ACP Cladding">Enquire Now</button>
                </div>
            </div>

            <!-- HPL Cladding -->
            <div class="facade-card blue-theme">
                <div class="facade-image">
                    <img src="{{ asset('images/facade/hpl-cladding.png') }}" alt="HPL Cladding">
                </div>
                <div class="facade-card-body">
                    <h3 class="facade-title">HPL (High-Pressure Laminate) Cladding</h3>
                    <button type="button" class="facade-btn blue-btn open-facade-modal" data-facade="HPL (High-Pressure Laminate) Cladding">Enquire Now</button>
                </div>
            </div>

            <!-- Stone Cladding -->
            <div class="facade-card orange-theme">
                <div class="facade-image">
                    <img src="{{ asset('images/facade/stone.png') }}" alt="Stone Cladding">
                </div>
                <div class="facade-card-body">
                    <h3 class="facade-title">Stone Cladding</h3>
                    <button type="button" class="facade-btn orange-btn open-facade-modal" data-facade="Stone Cladding">Enquire Now</button>
                </div>
            </div>

            <!-- Metal Cladding -->
            <div class="facade-card blue-theme">
                <div class="facade-image">
                    <img src="{{ asset('images/facade/metal.png') }}" alt="Metal Cladding">
                </div>
                <div class="facade-card-body">
                    <h3 class="facade-title">Metal Cladding</h3>
                    <button type="button" class="facade-btn blue-btn open-facade-modal" data-facade="Metal Cladding">Enquire Now</button>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Modal -->
<div class="facade-modal" id="facadeModal">
    <div class="facade-modal-box">
        <button type="button" class="facade-close-btn" id="closeFacadeModal">&times;</button>

        <h2 class="facade-modal-title" id="facadeModalTitle">Glass Facade Services Requirement Form</h2>
        <p class="facade-modal-subtitle">
            Share your project details and facade service requirements to receive the right execution support.
        </p>

        <form action="{{ route('facade.enquiry.store') }}" method="POST">
            @csrf

            <input type="hidden" name="facade_type" id="facade_type" value="{{ old('facade_type') }}">

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
                    <label>Facade Type</label>
                    <select name="facade_sub_type" id="facade_sub_type" class="modal-form-control">
                        <option value="">Select Type</option>
                    </select>
                    @error('facade_sub_type') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>Project Area</label>
                    <input type="text" name="project_area" class="modal-form-control" value="{{ old('project_area') }}" placeholder="Enter project area">
                    @error('project_area') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group">
                    <label>Building Type</label>
                    <select name="building_type" class="modal-form-control">
                        <option value="">Select Building Type</option>
                        <option value="Residential" {{ old('building_type') == 'Residential' ? 'selected' : '' }}>Residential</option>
                        <option value="Commercial" {{ old('building_type') == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                        <option value="Industrial" {{ old('building_type') == 'Industrial' ? 'selected' : '' }}>Industrial</option>
                        <option value="Office" {{ old('building_type') == 'Office' ? 'selected' : '' }}>Office</option>
                        <option value="Hospitality" {{ old('building_type') == 'Hospitality' ? 'selected' : '' }}>Hospitality</option>
                        <option value="Institutional" {{ old('building_type') == 'Institutional' ? 'selected' : '' }}>Institutional</option>
                    </select>
                    @error('building_type') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="modal-form-group full-width">
                    <label>Required Facade Service Scope</label>
                    <select name="service_scope" class="modal-form-control">
                        <option value="">Select Service Scope</option>
                        <option value="Design" {{ old('service_scope') == 'Design' ? 'selected' : '' }}>Design</option>
                        <option value="Fabrication" {{ old('service_scope') == 'Fabrication' ? 'selected' : '' }}>Fabrication</option>
                        <option value="Installation" {{ old('service_scope') == 'Installation' ? 'selected' : '' }}>Installation</option>
                        <option value="Supply + Installation" {{ old('service_scope') == 'Supply + Installation' ? 'selected' : '' }}>Supply + Installation</option>
                        <option value="Complete Turnkey" {{ old('service_scope') == 'Complete Turnkey' ? 'selected' : '' }}>Complete Turnkey</option>
                        <option value="Repair / Replacement" {{ old('service_scope') == 'Repair / Replacement' ? 'selected' : '' }}>Repair / Replacement</option>
                    </select>
                    @error('service_scope') <div class="error-text">{{ $message }}</div> @enderror
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
    const modal = document.getElementById('facadeModal');
    const closeModal = document.getElementById('closeFacadeModal');
    const modalTitle = document.getElementById('facadeModalTitle');
    const facadeInput = document.getElementById('facade_type');
    const facadeSubType = document.getElementById('facade_sub_type');

    const facadeOptions = {
        "Glass Facade": [
            "Curtain Wall System",
            "Structural Glazing",
            "Spider Glazing",
            "Semi Unitized",
            "Unitized System",
            "Double Glazed Facade"
        ],
        "ACP Cladding": [
            "Exterior ACP Cladding",
            "Interior ACP Cladding",
            "Wood Finish ACP",
            "Metallic ACP",
            "Fire Retardant ACP"
        ],
        "HPL (High-Pressure Laminate) Cladding": [
            "Exterior HPL Cladding",
            "Wood Texture HPL",
            "Decorative HPL Panels",
            "Compact Laminate Panels"
        ],
        "Stone Cladding": [
            "Natural Stone Cladding",
            "Dry Stone Cladding",
            "Marble Cladding",
            "Granite Cladding",
            "Sandstone Cladding"
        ],
        "Metal Cladding": [
            "Aluminium Cladding",
            "Zinc Cladding",
            "Copper Cladding",
            "SS Cladding",
            "Perforated Metal Cladding"
        ]
    };

    function populateFacadeTypes(facadeName) {
        facadeSubType.innerHTML = '<option value="">Select Type</option>';

        if (facadeOptions[facadeName]) {
            facadeOptions[facadeName].forEach(function(item) {
                const option = document.createElement('option');
                option.value = item;
                option.textContent = item;
                facadeSubType.appendChild(option);
            });
        }
    }

    document.querySelectorAll('.open-facade-modal').forEach(function(button) {
        button.addEventListener('click', function () {
            const facadeName = this.getAttribute('data-facade');

            modalTitle.textContent = facadeName + ' Services Requirement Form';
            facadeInput.value = facadeName;

            populateFacadeTypes(facadeName);

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
    const modal = document.getElementById('facadeModal');
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
});
</script>
@endif

@endsection