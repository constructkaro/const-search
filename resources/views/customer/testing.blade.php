@extends('layouts.app')

@section('title', 'Testing Services')

@section('content')

<style>
body {
    margin: 0;
    background: #e6e6e6;
    font-family: 'Segoe UI', sans-serif;
}

/* Layout */
.wrapper {
    display: flex;
    justify-content: center;
    gap: 40px;
     align-items: stretch;
    padding: 60px 20px;
    flex-wrap: wrap;
}

/* Card Base */
.card {
    position: relative;
    width: 360px;
    border-radius: 25px;
    padding: 40px 25px 30px;
    box-shadow: -4px 6px 10px rgba(0,0,0,0.18);
    overflow: visible;

    display: flex;
    flex-direction: column; /* IMPORTANT */
}

/* Badge */
.badge {
    position: absolute;
    top: -22px;
    left: 50%;
    transform: translateX(-50%);
    color: #fff;
    font-weight: 700;
    font-size: 18px;
    padding: 14px 28px;
    border-radius: 16px;
    box-shadow: 0 4px 0 rgba(0, 0, 0, 0.2);
    white-space: nowrap;
    text-align: center;
    line-height: 1.2;
    z-index: 2;
}

/* List */
.list {
    list-style: none;
    padding: 0;
    margin: 18px 0 25px 0;
    flex-grow: 1;
}

.list li {
    margin: 10px 0;
    font-size: 15px;
    display: flex;
    align-items: flex-start;
    color: #555;
    line-height: 1.5;
}

.list li::before {
    content: "●";
    margin-right: 10px;
    font-size: 12px;
    font-weight: bold;
    margin-top: 6px;
    flex-shrink: 0;
}

/* Buttons */
a.survey-card-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 170px;
    height: 42px;
    border-radius: 30px;
    color: #fff;
    font-weight: 700;
    text-decoration: none;
    margin-top: 10px;
    box-shadow: 0 4px 0 rgba(0, 0, 0, 0.2);
    transition: 0.2s;
    cursor: pointer;
}

a.survey-card-btn:hover {
    transform: translateY(-2px);
}

.button-wrap {
    text-align: center;
    margin-top: auto;
}

/* Theme Colors */
.orange-btn {
    background: linear-gradient(#f08a3e, #e36f1e);
}

.blue-btn {
    background: linear-gradient(#4c8bc9, #2f6ea6);
}

/* Variants */
.orange-card {
    background: #ead9cd;
    border: 3px solid #eb7a25;
}
.orange-card .badge {
    background: #eb7a25;
}
.orange-card li::before {
    color: #eb7a25;
}

.blue-card {
    background: #d9e4ef;
    border: 3px solid #2f78bf;
}
.blue-card .badge {
    background: #2f78bf;
}
.blue-card li::before {
    color: #2f78bf;
}

/* Heading */
.testing-page-heading {
    text-align: center;
    margin-top: 40px;
}

.testing-page-heading h2 {
    font-size: 42px;
    font-weight: 800;
    margin-bottom: 10px;
}

.heading-line {
    width: 220px;
    height: 4px;
    margin: 10px auto 40px;
    border-radius: 20px;
    background: linear-gradient(to right, #2f78bf 50%, #eb7a25 50%);
}

/* Image */
.card-image {
    width: calc(100% + 50px);
    margin-left: -25px;
    margin-top: -40px;
    height: 290px;
    overflow: hidden;
    border-radius: 20px 20px 0 0;
}

.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Modal */
.testing-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    inset: 0;
    background: rgba(0,0,0,0.55);
    overflow-y: auto;
    padding: 40px 20px;
}

.testing-modal.show {
    display: block;
}

.testing-modal-box {
    position: relative;
    background: #fff;
    max-width: 1250px;
    width: 100%;
    margin: 0 auto;
    border-radius: 30px;
    padding: 35px 35px 25px;
    box-shadow: 0 15px 50px rgba(0,0,0,0.25);
}

.testing-modal-close {
    position: absolute;
    top: 16px;
    right: 22px;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #2f78bf;
    color: #fff;
    border: none;
    font-size: 22px;
    font-weight: 700;
    cursor: pointer;
}

.modal-main-title {
    text-align: center;
    font-size: 34px;
    font-weight: 800;
    color: #222;
    margin-bottom: 14px;
}

.modal-sub-title {
    text-align: center;
    max-width: 800px;
    margin: 0 auto 35px;
    font-size: 18px;
    line-height: 1.5;
    color: #555;
}

.section-title {
    color: #2f78bf;
    font-size: 28px;
    font-weight: 800;
    margin-bottom: 16px;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 26px 28px;
    margin-bottom: 28px;
}

.form-group label {
    display: block;
    font-size: 22px;
    font-weight: 800;
    color: #222;
    margin-bottom: 10px;
}

.form-control {
    width: 100%;
    height: 52px;
    border: 1.5px solid #333;
    border-radius: 6px;
    background: #dce7f2;
    padding: 10px 14px;
    font-size: 16px;
    color: #222;
    box-sizing: border-box;
}

textarea.form-control {
    height: 150px;
    resize: vertical;
    padding-top: 14px;
}

.full-width {
    grid-column: 1 / -1;
}

.modal-submit-wrap {
    text-align: center;
    margin-top: 10px;
}

.modal-submit-btn {
    min-width: 260px;
    height: 70px;
    border: none;
    border-radius: 18px;
    background: linear-gradient(#2f78bf, #2469a8);
    color: #fff;
    font-size: 36px;
    font-weight: 800;
    cursor: pointer;
    box-shadow: 0 6px 0 rgba(0,0,0,0.18);
}

.alert-success {
    max-width: 900px;
    margin: 20px auto 0;
    background: #dff3e4;
    color: #166534;
    padding: 14px 18px;
    border-radius: 10px;
    font-weight: 600;
    border: 1px solid #b6e2c0;
}

.error-text {
    color: red;
    font-size: 13px;
    margin-top: 5px;
}

@media (max-width: 991px) {
    .form-grid {
        grid-template-columns: 1fr;
    }

    .testing-modal-box {
        padding: 25px 18px 20px;
    }

    .modal-main-title {
        font-size: 26px;
    }

    .section-title {
        font-size: 24px;
    }

    .form-group label {
        font-size: 18px;
    }

    .modal-submit-btn {
        min-width: 200px;
        height: 56px;
        font-size: 28px;
    }
}

@media (max-width: 768px) {
    .wrapper {
        gap: 30px;
        padding: 40px 15px;
    }

    .card {
        width: 100%;
         height: 100%;
        max-width: 360px;
    }

    .badge {
        font-size: 14px;
        padding: 10px 18px;
        white-space: normal;
        width: calc(100% - 60px);
    }

    .card-image {
        height: 220px;
    }

    .testing-page-heading h2 {
        font-size: 32px;
    }
}
</style>

<div class="testing-page-heading">
    <h2>Testing Services</h2>
    <div class="heading-line"></div>
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<div class="wrapper">

    <!-- Soil Testing -->
    <div class="card orange-card">
        <div class="badge">Soil Testing Reports</div>
        <div class="card-image">
            <img src="{{ asset('images/testing/soil-testing.png') }}" alt="Soil Testing">
        </div>
        <ul class="list">
            <li>Soil Bearing Capacity Test Report (SBC)</li>
            <li>Plate Load Test Report</li>
            <li>Standard Penetration Test (SPT) Report</li>
            <li>Core Cutter Test Report</li>
            <li>Field Density Test (FDT) Report</li>
            <li>Proctor Compaction Test Report</li>
            <li>Atterberg Limits Test Report</li>
            <li>Soil Classification Report</li>
            <li>Permeability Test Report</li>
            <li>Consolidation Test Report</li>
        </ul>
        <div class="button-wrap">
            <a class="survey-card-btn orange-btn open-testing-modal" data-service="Soil Testing Services">Enquire Now</a>
        </div>
    </div>

    <!-- Concrete Testing -->
    <div class="card blue-card">
        <div class="badge">Concrete Testing Reports</div>
        <div class="card-image">
            <img src="{{ asset('images/testing/concrete-testing.png') }}" alt="Concrete Testing">
        </div>
        <ul class="list">
            <li>Cube Compressive Strength Test Report</li>
            <li>Slump Test Report</li>
            <li>Concrete Core Test Report</li>
            <li>Flexural Strength Test Report</li>
            <li>Rebound Hammer Test Report</li>
            <li>Ultrasonic Pulse Velocity (UPV) Test Report</li>
            <li>Concrete Mix Design Report</li>
            <li>Setting Time Test Report</li>
        </ul>
        <div class="button-wrap">
            <a class="survey-card-btn blue-btn open-testing-modal" data-service="Concrete Testing Services">Enquire Now</a>
        </div>
    </div>

    <!-- Aggregate Testing -->
    <div class="card orange-card">
        <div class="badge">Aggregate Testing Reports</div>
        <div class="card-image">
            <img src="{{ asset('images/testing/aggregate-testing.png') }}" alt="Aggregate Testing">
        </div>
        <ul class="list">
            <li>Sieve Analysis Test Report</li>
            <li>Crushing Value Test Report</li>
            <li>Impact Value Test Report</li>
            <li>Abrasion Test Report (Los Angeles)</li>
            <li>Specific Gravity Test Report</li>
            <li>Water Absorption Test Report</li>
            <li>Flakiness & Elongation Index Report</li>
        </ul>
        <div class="button-wrap">
            <a class="survey-card-btn orange-btn open-testing-modal" data-service="Aggregate Testing Services">Enquire Now</a>
        </div>
    </div>

    <!-- Sand Testing -->
    <div class="card blue-card">
        <div class="badge">Sand Testing Reports</div>
        <div class="card-image">
            <img src="{{ asset('images/testing/sand-testing.png') }}" alt="Sand Testing">
        </div>
        <ul class="list">
            <li>Silt Content Test Report</li>
            <li>Sand Sieve Analysis Report</li>
            <li>Bulking of Sand Test Report</li>
            <li>Specific Gravity of Sand Report</li>
        </ul>
        <div class="button-wrap">
            <a class="survey-card-btn blue-btn open-testing-modal" data-service="Sand Testing Services">Enquire Now</a>
        </div>
    </div>

    <!-- Brick / Block Testing -->
    <div class="card orange-card">
        <div class="badge">Brick / Block Testing Reports</div>
        <div class="card-image">
            <img src="{{ asset('images/testing/brick-block-testing.png') }}" alt="Brick Block Testing">
        </div>
        <ul class="list">
            <li>Compressive Strength Test Report</li>
            <li>Water Absorption Test Report</li>
            <li>Efflorescence Test Report</li>
            <li>Dimension Tolerance Report</li>
        </ul>
        <div class="button-wrap">
            <a class="survey-card-btn orange-btn open-testing-modal" data-service="Brick / Block Testing Services">Enquire Now</a>
        </div>
    </div>

    <!-- Cement Testing -->
    <div class="card blue-card">
        <div class="badge">Cement Testing Reports</div>
        <div class="card-image">
            <img src="{{ asset('images/testing/cement-testing.png') }}" alt="Cement Testing">
        </div>
        <ul class="list">
            <li>Fineness Test Report</li>
            <li>Standard Consistency Test Report</li>
            <li>Initial & Final Setting Time Report</li>
            <li>Soundness Test Report</li>
            <li>Compressive Strength of Cement Report</li>
        </ul>
        <div class="button-wrap">
            <a class="survey-card-btn blue-btn open-testing-modal" data-service="Cement Testing Services">Enquire Now</a>
        </div>
    </div>

    <!-- Steel Testing -->
    <div class="card orange-card">
        <div class="badge">Steel Testing Reports</div>
        <div class="card-image">
            <img src="{{ asset('images/testing/steel-testing.png') }}" alt="Steel Testing">
        </div>
        <ul class="list">
            <li>Tensile Strength Test Report</li>
            <li>Yield Strength Test Report</li>
            <li>Bend Test Report</li>
            <li>Rebend Test Report</li>
            <li>Elongation Test Report</li>
            <li>Chemical Composition Test Report</li>
        </ul>
        <div class="button-wrap">
            <a class="survey-card-btn orange-btn open-testing-modal" data-service="Steel Testing Services">Enquire Now</a>
        </div>
    </div>

    <!-- Water Testing -->
    <div class="card blue-card">
        <div class="badge">Water Testing Reports</div>
        <div class="card-image">
            <img src="{{ asset('images/testing/water-testing.png') }}" alt="Water Testing">
        </div>
        <ul class="list">
            <li>pH Value Test Report</li>
            <li>Chloride Content Test Report</li>
            <li>Sulphate Content Test Report</li>
            <li>Water Quality for Construction Report</li>
        </ul>
        <div class="button-wrap">
            <a class="survey-card-btn blue-btn open-testing-modal" data-service="Water Testing Services">Enquire Now</a>
        </div>
    </div>

    <!-- Bitumen Testing -->
    <div class="card orange-card">
        <div class="badge">Bitumen Testing Reports</div>
        <div class="card-image">
            <img src="{{ asset('images/testing/bitumen-testing.png') }}" alt="Bitumen Testing">
        </div>
        <ul class="list">
            <li>Penetration Test Report</li>
            <li>Ductility Test Report</li>
            <li>Softening Point Test Report</li>
            <li>Flash & Fire Point Test Report</li>
            <li>Viscosity Test Report</li>
        </ul>
        <div class="button-wrap">
            <a class="survey-card-btn orange-btn open-testing-modal" data-service="Bitumen Testing Services">Enquire Now</a>
        </div>
    </div>

    <!-- Road / Pavement Testing -->
    <div class="card blue-card">
        <div class="badge">Road / Pavement Testing Reports</div>
        <div class="card-image">
            <img src="{{ asset('images/testing/road-pavement-testing.png') }}" alt="Road Pavement Testing">
        </div>
        <ul class="list">
            <li>CBR Test Report (California Bearing Ratio)</li>
            <li>Marshall Stability Test Report</li>
            <li>Core Cutting for Road Thickness Report</li>
            <li>Density Test Report (Road)</li>
        </ul>
        <div class="button-wrap">
            <a class="survey-card-btn blue-btn open-testing-modal" data-service="Road / Pavement Testing Services">Enquire Now</a>
        </div>
    </div>

    <!-- NDT Testing -->
    <div class="card orange-card">
        <div class="badge">NDT (Non-Destructive<br>Testing) Reports</div>
        <div class="card-image">
            <img src="{{ asset('images/testing/ndt-testing.png') }}" alt="NDT Testing">
        </div>
        <ul class="list">
            <li>Rebound Hammer Test Report</li>
            <li>UPV Test Report</li>
            <li>Half-Cell Potential Test Report</li>
            <li>Cover Meter Test Report</li>
        </ul>
        <div class="button-wrap">
            <a class="survey-card-btn orange-btn open-testing-modal" data-service="NDT Testing Services">Enquire Now</a>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="testing-modal" id="testingEnquiryModal">
    <div class="testing-modal-box">
        <button type="button" class="testing-modal-close" id="closeTestingModal">&times;</button>

        <h2 class="modal-main-title" id="modalServiceTitle">Soil Testing Services</h2>
        <p class="modal-sub-title" id="modalServiceDescription">
            Fill out the form below, and our team will reach out to confirm your booking and discuss the service details.
        </p>

        <form action="{{ route('testing.enquiry.store') }}" method="POST">
            @csrf

            <input type="hidden" name="service_name" id="service_name">

            <div class="section-title">Location Details:</div>

            <div class="form-grid">
                <div class="form-group">
                    <label>House no./ Building/Company Name</label>
                    <input type="text" name="house_building_name" class="form-control" value="{{ old('house_building_name') }}" placeholder="Enter house no. / building / company name">
                    @error('house_building_name') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Road Name / Area / Colony</label>
                    <input type="text" name="road_area_colony" class="form-control" value="{{ old('road_area_colony') }}" placeholder="Enter road name / area / colony">
                    @error('road_area_colony') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" class="form-control" value="{{ old('city') }}" placeholder="Enter city">
                    @error('city') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Pincode</label>
                    <input type="text" name="pincode" class="form-control" value="{{ old('pincode') }}" placeholder="Enter pincode">
                    @error('pincode') <div class="error-text">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="section-title">Project Information:</div>

            <div class="form-grid">
                <div class="form-group">
                    <label>Project Name</label>
                    <input type="text" name="project_name" class="form-control" value="{{ old('project_name') }}" placeholder="Enter project name">
                    @error('project_name') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Number of Samples</label>
                    <input type="number" name="number_of_samples" class="form-control" value="{{ old('number_of_samples') }}" placeholder="Enter number of samples">
                    @error('number_of_samples') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="form-group full-width">
                    <label>Required Testing Type</label>
                    <select name="required_testing_type" id="required_testing_type" class="form-control">
                        <option value="">Select</option>
                    </select>
                    @error('required_testing_type') <div class="error-text">{{ $message }}</div> @enderror
                </div>

                <div class="form-group full-width">
                    <label style="color:#2f78bf; font-size:28px; font-weight:800;">Additional Requirement Details</label>
                    <textarea name="additional_details" class="form-control" placeholder="Provide any specific details or notes...">{{ old('additional_details') }}</textarea>
                    @error('additional_details') <div class="error-text">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="modal-submit-wrap">
                <button type="submit" class="modal-submit-btn">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('testingEnquiryModal');
    const closeBtn = document.getElementById('closeTestingModal');
    const serviceTitle = document.getElementById('modalServiceTitle');
    const serviceDescription = document.getElementById('modalServiceDescription');
    const serviceInput = document.getElementById('service_name');
    const testingTypeSelect = document.getElementById('required_testing_type');

    const serviceOptions = {
        "Soil Testing Services": [
            "Soil Bearing Capacity Test Report (SBC)",
            "Plate Load Test Report",
            "Standard Penetration Test (SPT) Report",
            "Core Cutter Test Report",
            "Field Density Test (FDT) Report",
            "Proctor Compaction Test Report",
            "Atterberg Limits Test Report",
            "Soil Classification Report",
            "Permeability Test Report",
            "Consolidation Test Report"
        ],
        "Concrete Testing Services": [
            "Cube Compressive Strength Test Report",
            "Slump Test Report",
            "Concrete Core Test Report",
            "Flexural Strength Test Report",
            "Rebound Hammer Test Report",
            "Ultrasonic Pulse Velocity (UPV) Test Report",
            "Concrete Mix Design Report",
            "Setting Time Test Report"
        ],
        "Aggregate Testing Services": [
            "Sieve Analysis Test Report",
            "Crushing Value Test Report",
            "Impact Value Test Report",
            "Abrasion Test Report (Los Angeles)",
            "Specific Gravity Test Report",
            "Water Absorption Test Report",
            "Flakiness & Elongation Index Report"
        ],
        "Sand Testing Services": [
            "Silt Content Test Report",
            "Sand Sieve Analysis Report",
            "Bulking of Sand Test Report",
            "Specific Gravity of Sand Report"
        ],
        "Brick / Block Testing Services": [
            "Compressive Strength Test Report",
            "Water Absorption Test Report",
            "Efflorescence Test Report",
            "Dimension Tolerance Report"
        ],
        "Cement Testing Services": [
            "Fineness Test Report",
            "Standard Consistency Test Report",
            "Initial & Final Setting Time Report",
            "Soundness Test Report",
            "Compressive Strength of Cement Report"
        ],
        "Steel Testing Services": [
            "Tensile Strength Test Report",
            "Yield Strength Test Report",
            "Bend Test Report",
            "Rebend Test Report",
            "Elongation Test Report",
            "Chemical Composition Test Report"
        ],
        "Water Testing Services": [
            "pH Value Test Report",
            "Chloride Content Test Report",
            "Sulphate Content Test Report",
            "Water Quality for Construction Report"
        ],
        "Bitumen Testing Services": [
            "Penetration Test Report",
            "Ductility Test Report",
            "Softening Point Test Report",
            "Flash & Fire Point Test Report",
            "Viscosity Test Report"
        ],
        "Road / Pavement Testing Services": [
            "CBR Test Report (California Bearing Ratio)",
            "Marshall Stability Test Report",
            "Core Cutting for Road Thickness Report",
            "Density Test Report (Road)"
        ],
        "NDT Testing Services": [
            "Rebound Hammer Test Report",
            "UPV Test Report",
            "Half-Cell Potential Test Report",
            "Cover Meter Test Report"
        ]
    };

    function populateTestingTypes(service) {
        testingTypeSelect.innerHTML = '<option value="">Select</option>';

        if (serviceOptions[service]) {
            serviceOptions[service].forEach(function (item) {
                const option = document.createElement('option');
                option.value = item;
                option.textContent = item;
                testingTypeSelect.appendChild(option);
            });
        }
    }

    document.querySelectorAll('.open-testing-modal').forEach(function (button) {
        button.addEventListener('click', function () {
            const service = this.getAttribute('data-service');

            serviceTitle.textContent = service;
            serviceDescription.textContent = `Fill out the form below, and our team will reach out to confirm your booking and discuss the ${service} details.`;
            serviceInput.value = service;

            populateTestingTypes(service);

            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        });
    });

    closeBtn.addEventListener('click', function () {
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

@endsection