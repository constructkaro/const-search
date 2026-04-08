@extends('layouts.app')

@section('title', 'Home Page')

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
    padding: 60px 20px;
    flex-wrap: wrap;
}

/* Card Base */
.card {
    position: relative;
    width: 360px;
    background: #e6d2c2;
    border-radius: 25px;
    padding: 40px 25px 30px;
    box-shadow: -6px 8px 0px rgba(0,0,0,0.15);
}

/* Badge */
.badge {
    position: absolute;
    top: -28px;
    left: 50%;
    transform: translateX(-50%);
    color: #fff;
    font-weight: 700;
    font-size: 15px;
    padding: 12px 26px;
    border-radius: 14px;
    box-shadow: 0 4px 0 rgba(0,0,0,0.2);
}

/* Text */
.subtitle {
    text-align: center;
    color: #555;
    font-size: 14px;
    margin-bottom: 10px;
}

.price {
    text-align: center;
    font-size: 24px;
    font-weight: 800;
    margin: 12px 0 18px;
}

/* Section Titles */
.title {
    text-align: center;
    font-weight: 700;
    margin-top: 15px;
    margin-bottom: 10px;
}

/* List */
.list {
    list-style: none;
    padding: 0;
}

.list li {
    margin: 10px 0;
    font-size: 15px;
    display: flex;
    align-items: center;
}

/* Check Icon */
.list li::before {
    content: "✔";
    margin-right: 10px;
    background: #fff;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: bold;
}

/* Button */
.btn {
    display: block;
    margin: 25px auto 0;
    padding: 12px;
    border-radius: 25px;
    text-align: center;
    color: #fff;
    font-weight: 700;
    text-decoration: none;
    width: 75%;
    box-shadow: 0 4px 0 rgba(0,0,0,0.2);
    transition: 0.2s;
}

.btn:active {
    transform: translateY(2px);
    box-shadow: 0 2px 0 rgba(0,0,0,0.2);
}

/* === VARIANTS === */

/* BASIC */
.basic {
    border: 2px solid #e36f1e;
    box-shadow: -6px 8px 0px #d65f12;
}
.basic .badge {
    background: #e36f1e;
}
.basic .title,
.basic li::before {
    color: #e36f1e;
}
.basic .btn {
    background: linear-gradient(#f08a3e, #e36f1e);
}

/* STANDARD */
.standard {
    background: #d3dde8;
    border: 2px solid #2f6ea6;
    box-shadow: -6px 8px 0px #255a8a;
}
.standard .badge {
    background: #2f6ea6;
}
.standard .title,
.standard li::before {
    color: #2f6ea6;
}
.standard .btn {
    background: linear-gradient(#4c8bc9, #2f6ea6);
}

/* ADVANCED */
.advanced {
    border: 2px solid #e36f1e;
    box-shadow: -6px 8px 0px #d65f12;
}
.advanced .badge {
    background: #e36f1e;
}
.advanced .title,
.advanced li::before {
    color: #e36f1e;
}
.advanced .btn {
    background: linear-gradient(#f08a3e, #e36f1e);
}

/* Responsive */
@media(max-width: 1000px) {
    .wrapper {
        flex-direction: column;
        align-items: center;
    }
}


.booking-modal-overlay{
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.55);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 99999;
    padding: 24px;
    overflow: hidden;
}

.booking-modal-overlay.active{
    display: flex;
}

.booking-modal-box{
    width: 100%;
    max-width: 980px;
    max-height: 92vh;
    overflow-y: auto;
    background: #efefef;
    border-radius: 22px;
    padding: 28px 34px 30px;
    position: relative;
    box-shadow: 0 18px 40px rgba(0,0,0,0.22);
    animation: bookingFadeIn 0.25s ease;
}



@keyframes bookingFadeIn{
    from{
        opacity: 0;
        transform: translateY(18px) scale(0.98);
    }
    to{
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.booking-modal-close{
    position: absolute;
    top: 10px;
    right: 16px;
    border: none;
    background: transparent;
    font-size: 30px;
    cursor: pointer;
    color: #444;
}

.booking-modal-header h2{
    font-size: 38px;
    line-height: 1.2;
    font-weight: 800;
    color: #1f2329;
    text-align: center;
    margin-bottom: 14px;
}

.booking-modal-header p{
    max-width: 760px;
    margin: 0 auto 28px;
    text-align: center;
    color: #555;
    font-size: 18px;
    line-height: 1.6;
}

.booking-form-row{
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

.booking-form-group{
    margin-bottom: 18px;
}

.booking-form-group label{
    display: block;
    margin-bottom: 10px;
    font-size: 18px;
    font-weight: 800;
    color: #1f2329;
}

.booking-form-group input, .booking-form-group textarea, .booking-form-group select {
    width: 99%;
    border: 1px solid #333;
    background: #dfe7ef;
    border-radius: 7px;
    padding: 13px 5px;
    font-size: 19px;
    outline: none;
}

.booking-form-group textarea{
    resize: vertical;
}

.booking-land-area-wrap{
    display: grid;
    grid-template-columns: 1fr 170px;
    gap: 0;
}

.booking-land-area-wrap input{
    border-radius: 10px 0 0 10px;
    border-right: 0;
}

.booking-land-area-wrap select{
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    border: 1px solid #333;
    border-left: 0;
    border-radius: 0 10px 10px 0;
    background: linear-gradient(180deg, #3485cd 0%, #206eb4 100%);
    color: #030303;
    font-weight: 700;
    font-size: 16px;
    padding: 0 42px 0 16px;
    height: 100%;
    min-height: 52px;
    cursor: pointer;
    background-image:
        linear-gradient(180deg, #3485cd 0%, #206eb4 100%),
        url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'><polyline points='6 9 12 15 18 9'/></svg>");
    background-repeat: no-repeat, no-repeat;
    background-position: center, right 14px center;
    background-size: cover, 14px;
}

.booking-land-area-wrap select:focus{
    outline: none;
    box-shadow: none;
}

.booking-submit-wrap{
    text-align: center;
    margin-top: 26px;
}

.booking-submit-btn{
    min-width: 260px;
    border: none;
    border-radius: 16px;
    background: linear-gradient(180deg, #3485cd 0%, #206eb4 100%);
    color: #fff;
    font-size: 24px;
    font-weight: 800;
    padding: 16px 30px;
    cursor: pointer;
    box-shadow: 0 8px 18px rgba(0,0,0,0.18);
}

.error-text{
    display: block;
    margin-top: 6px;
    font-size: 12px;
    color: #dc2626;
}

.booking-success-text{
    text-align: center;
    margin-top: 14px;
    font-size: 14px;
    color: #15803d;
    font-weight: 600;
}

@media (max-width: 767px){
    .booking-modal-box{
        padding: 28px 18px;
    }

    .booking-modal-header h2{
        font-size: 28px;
    }

    .booking-modal-header p{
        font-size: 16px;
    }

    .booking-form-row{
        grid-template-columns: 1fr;
        gap: 0;
    }

    .booking-land-area-wrap{
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .booking-land-area-wrap input,
    .booking-land-area-wrap select{
        border-radius: 8px;
        border-left: 1px solid #333;
    }

    .booking-submit-btn{
        width: 100%;
        min-width: 100%;
        font-size: 22px;
    }
}

.survey-card{
    display: flex;
    flex-direction: column;
}

a.survey-card-btn, a.survey-card-btn:link, a.survey-card-btn:visited {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 303px;
    height: 48px;
    padding: 4px 24px;
    border-radius: 15px;
    text-decoration: none !important;
    color: #fff !important;
    font-size: 16px;
    font-weight: 700;
    line-height: 1;
    border: none;
    cursor: pointer;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.18);
    transition: all 0.3s ease;
    margin-top: auto;
    align-self: center;
}

a.survey-card-btn:hover{
    transform: translateY(-2px);
    color: #fff !important;
    text-decoration: none !important;
}

.orange-btn{
    background: linear-gradient(180deg, #f08b39 0%, #df7122 100%);
}

.blue-btn{
    background: linear-gradient(180deg, #3485cd 0%, #206eb4 100%);
}
</style>



<div class="wrapper">

    <!-- BASIC -->
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

    <!-- STANDARD -->
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

    <!-- ADVANCED -->
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
        <button type="button" class="booking-modal-close" id="closeSurveyBookingModal">&times;</button>

        <div class="booking-modal-header">
            <h2>Book Your Land Survey Package</h2>
            <p>
                Fill out the form below, and our team will reach out to confirm your booking
                and discuss the survey details.
            </p>
        </div>

        <form id="surveyBookingForm">
            <input type="hidden" name="service_name" id="booking_service_name">
            <input type="hidden" name="package_name" id="booking_package_name">

            <div class="booking-form-group full-width">
                <label>Full Name</label>
                <input type="text" name="full_name" id="booking_full_name" placeholder="Enter your full name">
                <small class="error-text" id="error_full_name"></small>
            </div>

            <div class="booking-form-row">
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
            </div>

            <div class="booking-form-group full-width">
                <label>Full Address</label>
                <input type="text" name="full_address" id="booking_full_address" placeholder="Enter your site address">
                <small class="error-text" id="error_full_address"></small>
            </div>

            <div class="booking-form-group full-width">
                <label>Land Area</label>
               <div class="booking-land-area-wrap">
                    <input type="text" name="land_area" id="booking_land_area" placeholder="Enter your Approx Land Area">
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

            <div class="booking-submit-wrap">
                <button type="submit" class="booking-submit-btn">Submit</button>
            </div>

            <div class="booking-success-text" id="booking_success_text"></div>
        </form>
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

        $('#booking_service_name').val(serviceName);
        $('#booking_package_name').val(packageName);

        $('#surveyBookingForm')[0].reset();
        $('.error-text').text('');
        $('#booking_success_text').text('');

        $('#surveyBookingModal').addClass('active');
    });

    $('#closeSurveyBookingModal').on('click', function () {
        $('#surveyBookingModal').removeClass('active');
    });

    $('#surveyBookingModal').on('click', function (e) {
        if (e.target.id === 'surveyBookingModal') {
            $('#surveyBookingModal').removeClass('active');
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
                    $('#booking_success_text').text(response.message);

                    setTimeout(function () {
                        $('#surveyBookingModal').removeClass('active');
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        }
                    }, 1200);
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;

                    if (errors.full_name) $('#error_full_name').text(errors.full_name[0]);
                    if (errors.mobile) $('#error_mobile').text(errors.mobile[0]);
                    if (errors.email) $('#error_email').text(errors.email[0]);
                    if (errors.full_address) $('#error_full_address').text(errors.full_address[0]);
                    if (errors.land_area) $('#error_land_area').text(errors.land_area[0]);
                    if (errors.area_unit) $('#error_area_unit').text(errors.area_unit[0]);
                    if (errors.description) $('#error_description').text(errors.description[0]);
                }
            }
        });
    });
</script>
@endsection
