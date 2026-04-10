@extends('layouts.app')

@section('title', 'Survey Packages')

@section('content')

<style>
    /* body {
        margin: 0;
        background: #e9edf2;
        font-family: 'Segoe UI', sans-serif;
    } */

    .wrapper {
        display: flex;
        justify-content: center;
        align-items: stretch;
        gap: 36px;
        padding: 70px 20px;
        flex-wrap: wrap;
    }

    .card {
        position: relative;
        width: 360px;
        border-radius: 28px;
        padding: 42px 25px 28px;
        display: flex;
        flex-direction: column;
        min-height: 100%;
        background: #fff;
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.12);
        transition: 0.3s ease;
    }

    .card:hover {
        transform: translateY(-6px);
    }

    .basic,
    .advanced {
        background: #fff7f2;
        border: 2px solid #e36f1e;
    }

    .standard {
        background: #f3f8fe;
        border: 2px solid #2f6ea6;
    }

    .badge {
        position: absolute;
        top: -18px;
        left: 50%;
        transform: translateX(-50%);
        color: #fff;
        font-weight: 800;
        font-size: 14px;
        padding: 11px 24px;
        border-radius: 14px;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.14);
        white-space: nowrap;
        text-align: center;
    }

    .basic .badge,
    .advanced .badge {
        background: linear-gradient(180deg, #f08b39 0%, #df7122 100%);
    }

    .standard .badge {
        background: linear-gradient(180deg, #3485cd 0%, #206eb4 100%);
    }

    .subtitle {
        text-align: center;
        color: #5b6470;
        font-size: 15px;
        line-height: 1.5;
        margin-bottom: 10px;
        min-height: 46px;
    }

    .price {
        text-align: center;
        font-size: 30px;
        font-weight: 800;
        margin: 12px 0 20px;
        color: #111827;
    }

    .title {
        text-align: center;
        font-weight: 800;
        margin: 14px 0 12px;
        font-size: 18px;
    }

    .basic .title,
    .advanced .title,
    .basic .list li::before,
    .advanced .list li::before {
        color: #e36f1e;
    }

    .standard .title,
    .standard .list li::before {
        color: #2f6ea6;
    }

    .list {
        list-style: none;
        padding: 0;
        margin: 0 0 12px;
    }

    .list li {
        margin: 11px 0;
        font-size: 15px;
        display: flex;
        align-items: flex-start;
        line-height: 1.5;
        color: #334155;
    }

    .list li::before {
        content: "✔";
        margin-right: 10px;
        background: #fff;
        width: 19px;
        height: 19px;
        min-width: 19px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 800;
        margin-top: 2px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }

    .survey-card-btn,
    .survey-card-btn:link,
    .survey-card-btn:visited {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 260px;
        min-height: 52px;
        padding: 12px 24px;
        border-radius: 16px;
        text-decoration: none !important;
        color: #fff !important;
        font-size: 16px;
        font-weight: 800;
        border: none;
        cursor: pointer;
        margin-top: auto;
        align-self: center;
        text-align: center;
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.16);
        transition: 0.3s ease;
    }

    .survey-card-btn:hover {
        transform: translateY(-2px);
    }

    .orange-btn {
        background: linear-gradient(180deg, #f08b39 0%, #df7122 100%);
    }

    .blue-btn {
        background: linear-gradient(180deg, #3485cd 0%, #206eb4 100%);
    }

    /* Modal */
    .booking-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.62);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 99999;
        padding: 20px;
        overflow-y: auto;
    }

    .booking-modal-overlay.active {
        display: flex;
    }

    .booking-modal-box {
        width: 100%;
        max-width: 920px;
        background: #ffffff;
        border-radius: 24px;
        position: relative;
        box-shadow: 0 24px 60px rgba(0, 0, 0, 0.20);
        animation: bookingFadeIn 0.25s ease;
        overflow: hidden;
    }

    .booking-modal-topbar {
        height: 300px;
        background: linear-gradient(90deg, #f08b39 0%, #df7122 45%, #3485cd 100%);
    }

    @keyframes bookingFadeIn {
        from {
            opacity: 0;
            transform: translateY(16px) scale(0.98);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .booking-modal-close {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 38px;
        height: 38px;
        border: none;
        border-radius: 50%;
        background: #f1f5f9;
        color: #334155;
        font-size: 24px;
        font-weight: 700;
        cursor: pointer;
        z-index: 5;
        transition: 0.25s ease;
    }

    .booking-modal-close:hover {
        background: #e2e8f0;
        transform: rotate(90deg);
    }

    .booking-modal-header {
        padding: 28px 28px 8px;
        text-align: center;
    }

    .booking-modal-header h2 {
        margin: 0 0 8px;
        font-size: 28px;
        line-height: 1.2;
        font-weight: 800;
        color: #111827;
    }

    .booking-modal-header p {
        max-width: 680px;
        margin: 0 auto;
        color: #64748b;
        font-size: 16px;
        line-height: 1.6;
    }

    .booking-form-wrap {
        padding: 18px 28px 28px;
    }

    .booking-form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px 20px;
    }

    .booking-form-group {
        margin-bottom: 14px;
    }

    .booking-form-group label {
        display: block;
        margin-bottom: 8px;
        font-size: 15px;
        font-weight: 700;
        color: #1f2937;
    }

    .booking-form-group input,
    .booking-form-group textarea,
    .booking-form-group select {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #d7e2ee;
        background: #f8fbff;
        border-radius: 12px;
        padding: 13px 15px;
        font-size: 15px;
        color: #111827;
        outline: none;
        transition: 0.25s ease;
    }

    .booking-form-group input:focus,
    .booking-form-group textarea:focus,
    .booking-form-group select:focus {
        border-color: #3485cd;
        box-shadow: 0 0 0 3px rgba(52, 133, 205, 0.12);
        background: #ffffff;
    }

    .booking-form-group textarea {
        resize: none;
        min-height: 96px;
    }

    .full-width {
        grid-column: 1 / -1;
    }

    .booking-land-area-wrap {
        display: grid;
        grid-template-columns: 1fr 160px;
        gap: 10px;
    }

    .booking-land-area-wrap select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: linear-gradient(180deg, #3485cd 0%, #206eb4 100%);
        color: #fff;
        border: none;
        font-weight: 700;
        padding-right: 40px;
        cursor: pointer;
        background-image:
            linear-gradient(180deg, #3485cd 0%, #206eb4 100%),
            url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'><polyline points='6 9 12 15 18 9'/></svg>");
        background-repeat: no-repeat, no-repeat;
        background-position: center, right 14px center;
        background-size: cover, 14px;
    }

    .booking-submit-wrap {
        text-align: center;
        margin-top: 8px;
    }

    .booking-submit-btn {
        min-width: 240px;
        border: none;
        border-radius: 14px;
        background: linear-gradient(180deg, #3485cd 0%, #206eb4 100%);
        color: #fff;
        font-size: 18px;
        font-weight: 800;
        padding: 14px 26px;
        cursor: pointer;
        box-shadow: 0 12px 24px rgba(32, 110, 180, 0.24);
        transition: 0.3s ease;
    }

    .booking-submit-btn:hover {
        transform: translateY(-2px);
    }

    .error-text {
        display: block;
        min-height: 16px;
        margin-top: 5px;
        font-size: 12px;
        color: #dc2626;
    }

    .booking-success-text {
        text-align: center;
        margin-top: 10px;
        font-size: 14px;
        color: #15803d;
        font-weight: 600;
    }

    /* Success Popup */
    .success-popup-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.55);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 999999;
        padding: 20px;
    }

    .success-popup-overlay.active {
        display: flex;
    }

    .success-popup-box {
        width: 100%;
        max-width: 560px;
        background: #ffffff;
        border-radius: 28px;
        padding: 30px 24px 24px;
        text-align: center;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.22);
        animation: popupFadeIn 0.35s ease;
        position: relative;
        overflow: hidden;
    }

    .success-popup-box::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, #f08b39 0%, #df7122 100%);
    }

    .success-check-wrap {
        display: flex;
        justify-content: center;
        margin-bottom: 18px;
    }

    .success-check-icon {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(180deg, #f08b39 0%, #df7122 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 18px 35px rgba(223, 113, 34, 0.28);
        position: relative;
    }

    .success-check-icon span {
        color: #fff;
        font-size: 60px;
        line-height: 1;
        font-weight: 900;
    }

    .success-popup-box h2 {
        margin: 0 0 10px;
        font-size: 42px;
        line-height: 1.1;
        font-weight: 800;
        color: #1f2329;
    }

    .success-popup-message {
        max-width: 420px;
        margin: 0 auto 8px;
        font-size: 18px;
        line-height: 1.5;
        color: #555;
        font-weight: 500;
    }

    .success-popup-submessage {
        max-width: 380px;
        margin: 0 auto 20px;
        font-size: 18px;
        line-height: 1.5;
        color: #555;
        font-weight: 500;
    }

    .success-popup-btn {
        min-width: 160px;
        height: 48px;
        border: none;
        border-radius: 12px;
        background: linear-gradient(180deg, #3485cd 0%, #206eb4 100%);
        color: #fff;
        font-size: 22px;
        font-weight: 800;
        cursor: pointer;
        box-shadow: 0 10px 20px rgba(32, 110, 180, 0.26);
        transition: all 0.25s ease;
    }

    .success-popup-btn:hover {
        transform: translateY(-2px);
    }

    @keyframes popupFadeIn {
        from {
            opacity: 0;
            transform: scale(0.94) translateY(18px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @media (max-width: 1000px) {
        .wrapper {
            flex-direction: column;
            align-items: center;
        }

        .card {
            width: 100%;
            max-width: 360px;
        }
    }

    @media (max-width: 767px) {
        .wrapper {
            padding: 55px 15px;
            gap: 28px;
        }

        .badge {
            white-space: normal;
            width: calc(100% - 70px);
        }

        .survey-card-btn {
            min-width: 100%;
        }

        .booking-modal-overlay {
            padding: 12px;
            align-items: flex-start;
        }

        .booking-modal-box {
            margin: 10px 0;
            border-radius: 18px;
        }

        .booking-modal-header {
            padding: 22px 16px 8px;
        }

        .booking-modal-header h2 {
            font-size: 24px;
        }

        .booking-modal-header p {
            font-size: 14px;
        }

        .booking-form-wrap {
            padding: 14px 16px 22px;
        }

        .booking-form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .booking-land-area-wrap {
            grid-template-columns: 1fr;
        }

        .booking-submit-btn {
            width: 100%;
            min-width: 100%;
        }

        .success-popup-box {
            max-width: 95%;
            padding: 24px 18px 20px;
            border-radius: 22px;
        }

        .success-check-icon {
            width: 96px;
            height: 96px;
        }

        .success-check-icon span {
            font-size: 48px;
        }

        .success-popup-box h2 {
            font-size: 34px;
        }

        .success-popup-message,
        .success-popup-submessage {
            font-size: 16px;
        }

        .success-popup-btn {
            width: 100%;
            min-width: 100%;
            font-size: 20px;
        }
    }
</style>

<div class="wrapper">
    <div class="card basic">
        <div class="badge">BASIC PLAN</div>
        <p class="subtitle">Plot measurement & boundary verification</p>
        <div class="price">₹8500 – ₹15000</div>

        <div class="title">Includes:</div>
        <ul class="list">
            <li>Site visit</li>
            <li>Plot measurement</li>
            <li>Boundary marking</li>
            <li>Basic 2D layout</li>
        </ul>

        <div class="title">Best For:</div>
        <ul class="list">
            <li>Individual home owners</li>
            <li>Small plots (&lt;2000–3000 sqft)</li>
        </ul>

        <a href="javascript:void(0)"
           class="survey-card-btn orange-btn open-survey-booking-modal"
           data-service="Survey Services"
           data-package="Basic Plan">
            Book Basic Survey
        </a>
    </div>

    <div class="card standard">
        <div class="badge">STANDARD PLAN</div>
        <p class="subtitle">Construction planning survey (levels + contours)</p>
        <div class="price">₹15000 – ₹30000</div>

        <div class="title">Includes:</div>
        <ul class="list">
            <li>Measurement + levels</li>
            <li>Contour mapping</li>
            <li>Topographic drawing</li>
            <li>Basic planning-ready output</li>
        </ul>

        <div class="title">Best For:</div>
        <ul class="list">
            <li>House construction</li>
            <li>Small builders</li>
            <li>Architects</li>
        </ul>

        <a href="javascript:void(0)"
           class="survey-card-btn blue-btn open-survey-booking-modal"
           data-service="Survey Services"
           data-package="Standard Plan">
            Book Standard Survey
        </a>
    </div>

    <div class="card advanced">
        <div class="badge">ADVANCED PLAN</div>
        <p class="subtitle">Large land mapping & detailed survey</p>
        <div class="price">₹25000 – ₹1L+</div>

        <div class="title">Includes:</div>
        <ul class="list">
            <li>Full land mapping</li>
            <li>High-accuracy survey</li>
            <li>DGPS / Drone (internally decided)</li>
            <li>Detailed reports</li>
        </ul>

        <div class="title">Best For:</div>
        <ul class="list">
            <li>Developers</li>
            <li>Layout projects</li>
            <li>Large land parcels</li>
        </ul>

        <a href="javascript:void(0)"
           class="survey-card-btn orange-btn open-survey-booking-modal"
           data-service="Survey Services"
           data-package="Advanced Plan">
            Book Advanced Survey
        </a>
    </div>
</div>

<div id="surveyBookingModal" class="booking-modal-overlay">
    <div class="booking-modal-box">
        <div class="booking-modal-topbar"></div>

        <button type="button" class="booking-modal-close" id="closeSurveyBookingModal">&times;</button>

        <div class="booking-modal-header">
            <h2>Book Your Land Survey Package</h2>
            <p>
                Fill out the form below and our team will contact you to confirm your booking
                and discuss your survey requirements.
            </p>
        </div>

        <form id="surveyBookingForm">
            @csrf

            <input type="hidden" name="service_name" id="booking_service_name">
            <input type="hidden" name="package_name" id="booking_package_name">

            <div class="booking-form-wrap">
                <div class="booking-form-row">
                    <div class="booking-form-group full-width">
                        <label>Full Name</label>
                        <input type="text" name="full_name" id="booking_full_name" placeholder="Enter your full name">
                        <small class="error-text" id="error_full_name"></small>
                    </div>

                    <div class="booking-form-group">
                        <label>Mobile No.</label>
                        <input type="text" name="mobile" id="booking_mobile" placeholder="Enter your mobile number">
                        <small class="error-text" id="error_mobile"></small>
                    </div>

                    <div class="booking-form-group">
                        <label>Email ID</label>
                        <input type="email" name="email" id="booking_email" placeholder="Enter your email address">
                        <small class="error-text" id="error_email"></small>
                    </div>

                    <div class="booking-form-group">
                        <label>House No. / Building / Company Name</label>
                        <input type="text" name="house_building_name" placeholder="Enter house no. / building / company name">
                        <small class="error-text" id="error_house_building_name"></small>
                    </div>

                    <div class="booking-form-group">
                        <label>Road Name / Area / Colony</label>
                        <input type="text" name="road_area_colony" placeholder="Enter road name / area / colony">
                        <small class="error-text" id="error_road_area_colony"></small>
                    </div>

                    <div class="booking-form-group">
                        <label>City</label>
                        <input type="text" name="city" placeholder="Enter city">
                        <small class="error-text" id="error_city"></small>
                    </div>

                    <div class="booking-form-group">
                        <label>Pincode</label>
                        <input type="text" name="pincode" placeholder="Enter pincode">
                        <small class="error-text" id="error_pincode"></small>
                    </div>

                    <div class="booking-form-group full-width">
                        <label>Land Area</label>
                        <div class="booking-land-area-wrap">
                            <input type="text" name="land_area" id="booking_land_area" placeholder="Enter your approx. land area">
                            <select name="area_unit" id="booking_area_unit">
                                <option value="">Unit</option>
                                <option value="sqft">Sq.ft</option>
                                <option value="sqmt">Sq.m</option>
                                <option value="acre">Acre</option>
                                <option value="guntha">Guntha</option>
                            </select>
                        </div>
                        <small class="error-text" id="error_land_area"></small>
                        <small class="error-text" id="error_area_unit"></small>
                    </div>

                    <div class="booking-form-group full-width">
                        <label>Description</label>
                        <textarea name="description" id="booking_description" rows="4" placeholder="Enter a brief description of your survey requirements (optional)"></textarea>
                        <small class="error-text" id="error_description"></small>
                    </div>
                </div>

                <div class="booking-submit-wrap">
                    <button type="submit" class="booking-submit-btn">Submit Requirement</button>
                </div>

                <div class="booking-success-text" id="booking_success_text"></div>
            </div>
        </form>
    </div>
</div>

<div id="successPopup" class="success-popup-overlay">
    <div class="success-popup-box">
        <div class="success-check-wrap">
            <div class="success-check-icon">
                <span>✓</span>
            </div>
        </div>

        <h2>Thank You.</h2>
        <p class="success-popup-message">Your requirement has been posted successfully!</p>
        <p class="success-popup-submessage">Our technical person will call you within 24 working hours.</p>

        <button type="button" id="successPopupOk" class="success-popup-btn">OK</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    $(document).on('click', '.open-survey-booking-modal', function () {
        let serviceName = $(this).data('service');
        let packageName = $(this).data('package');

        $('#surveyBookingForm')[0].reset();
        $('.error-text').text('');
        $('#booking_success_text').text('');

        $('#booking_service_name').val(serviceName);
        $('#booking_package_name').val(packageName);

        $('#surveyBookingModal').addClass('active');
        $('body').css('overflow', 'hidden');
    });

    $('#closeSurveyBookingModal').on('click', function () {
        $('#surveyBookingModal').removeClass('active');
        $('body').css('overflow', 'auto');
    });

    $('#surveyBookingModal').on('click', function (e) {
        if (e.target.id === 'surveyBookingModal') {
            $('#surveyBookingModal').removeClass('active');
            $('body').css('overflow', 'auto');
        }
    });

    $('#successPopupOk').on('click', function () {
        $('#successPopup').removeClass('active');
        $('body').css('overflow', 'auto');
    });

    $('#successPopup').on('click', function (e) {
        if (e.target.id === 'successPopup') {
            $('#successPopup').removeClass('active');
            $('body').css('overflow', 'auto');
        }
    });

    $('#surveyBookingForm').on('submit', function (e) {
        e.preventDefault();

        $('.error-text').text('');
        $('#booking_success_text').text('');

        $.ajax({
            url: "{{ route('customer.survey.booking.save') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function (response) {
                if (response.status) {
                    $('#surveyBookingModal').removeClass('active');
                    $('#successPopup').addClass('active');
                    $('#surveyBookingForm')[0].reset();
                    $('.error-text').text('');
                    $('#booking_success_text').text('');
                    $('body').css('overflow', 'hidden');
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;

                    if (errors.full_name) $('#error_full_name').text(errors.full_name[0]);
                    if (errors.mobile) $('#error_mobile').text(errors.mobile[0]);
                    if (errors.email) $('#error_email').text(errors.email[0]);
                    if (errors.house_building_name) $('#error_house_building_name').text(errors.house_building_name[0]);
                    if (errors.road_area_colony) $('#error_road_area_colony').text(errors.road_area_colony[0]);
                    if (errors.city) $('#error_city').text(errors.city[0]);
                    if (errors.pincode) $('#error_pincode').text(errors.pincode[0]);
                    if (errors.land_area) $('#error_land_area').text(errors.land_area[0]);
                    if (errors.area_unit) $('#error_area_unit').text(errors.area_unit[0]);
                    if (errors.description) $('#error_description').text(errors.description[0]);
                }
            }
        });
    });
</script>

@endsection