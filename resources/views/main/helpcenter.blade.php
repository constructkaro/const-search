@extends('layouts.app')

@section('title', 'Help Center')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');

    .help-center-page,
    .help-center-page * {
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    .help-center-page {
        width: 100%;
        margin: 0;
        padding: 0;
        background: #f3f3f3;
        color: #222;
        overflow-x: hidden;
    }

    .help-center-page .page-container {
        width: 100%;
        max-width: 1231px;
        margin: 0 auto;
        padding-left: 40px;
        padding-right: 40px;
    }

    /* HERO */
    .help-center-page .hero-section {
        width: 100%;
        background: linear-gradient(90deg, #edc1a3 0%, #a9c5df 100%);
        padding: 95px 0 90px;
        text-align: center;
    }

    .help-center-page .hero-title {
        font-size: 64px;
        font-weight: 800;
        line-height: 1.15;
        color: #1f1f1f;
        margin: 0 0 18px;
    }

    .help-center-page .section-line {
        width: 180px;
        height: 4px;
        margin: 0 auto 24px;
        border-radius: 20px;
        overflow: hidden;
        display: flex;
    }

    .help-center-page .section-line span:first-child {
        width: 50%;
        background: #2b78c5;
    }

    .help-center-page .section-line span:last-child {
        width: 50%;
        background: #f47b20;
    }

    .help-center-page .hero-text {
        max-width: 980px;
        margin: 0 auto 34px;
        font-size: 18px;
        line-height: 1.8;
        color: #5c5c5c;
    }

    .help-center-page .search-box {
        max-width: 1220px;
        margin: 0 auto;
        background: #fff;
        border-radius: 22px;
        box-shadow: 0 6px 14px rgba(0,0,0,0.08);
        padding: 16px 22px;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .help-center-page .search-box svg {
        width: 24px;
        height: 24px;
        color: #9a9a9a;
        flex-shrink: 0;
    }

    .help-center-page .search-box input {
        width: 100%;
        border: none;
        outline: none;
        background: transparent;
        font-size: 16px;
        color: #444;
    }

    .help-center-page .search-box input::placeholder {
        color: #9e9e9e;
    }

    /* FAQ */
    .help-center-page .faq-section {
        padding: 70px 0 30px;
        background: #f3f3f3;
    }

    .help-center-page .section-heading {
        text-align: center;
        margin-bottom: 40px;
    }

    .help-center-page .section-heading h2 {
        font-size: 58px;
        font-weight: 800;
        line-height: 1.15;
        color: #1f1f1f;
        margin: 0 0 14px;
    }

    .help-center-page .section-heading p {
        font-size: 17px;
        color: #666;
        margin: 0;
    }

    .help-center-page .faq-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .help-center-page .faq-item {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 5px 12px rgba(0,0,0,0.10);
        overflow: hidden;
        transition: 0.3s ease;
    }

    .help-center-page .faq-item:hover {
        transform: translateY(-2px);
    }

    .help-center-page .faq-question {
        width: 100%;
        background: transparent;
        border: none;
        padding: 24px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        text-align: left;
        cursor: pointer;
    }

    .help-center-page .faq-question-text {
        flex: 1;
        font-size: 20px;
        font-weight: 700;
        line-height: 1.5;
        color: #111;
    }

    .help-center-page .faq-icon {
        font-size: 24px;
        font-weight: 500;
        color: #444;
        min-width: 20px;
        text-align: center;
    }

    .help-center-page .faq-answer {
        display: none;
        padding: 0 28px 24px;
        font-size: 15px;
        line-height: 1.8;
        color: #5e5e5e;
    }

    .help-center-page .faq-item.active .faq-answer {
        display: block;
    }

    /* SUPPORT */
    .help-center-page .support-section {
        padding: 60px 0 40px;
        background: #f3f3f3;
    }

    .help-center-page .support-grid {
        max-width: 1120px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }

    .help-center-page .support-card {
        border-radius: 20px;
        padding: 34px 20px 30px;
        text-align: center;
        box-shadow: 0 8px 16px rgba(0,0,0,0.10);
        transition: 0.3s ease;
        min-height: 250px;
    }

    .help-center-page .support-card:hover {
        transform: translateY(-4px);
    }

    .help-center-page .support-card.orange {
        background: #f8e8dd;
        border: 1.5px solid #f47b20;
    }

    .help-center-page .support-card.blue {
        background: #deebf8;
        border: 1.5px solid #2b78c5;
    }

    .help-center-page .support-icon {
        width: 72px;
        height: 72px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        font-size: 30px;
        color: #fff;
    }

    .help-center-page .support-card.orange .support-icon {
        background: #f47b20;
    }

    .help-center-page .support-card.blue .support-icon {
        background: #2b78c5;
    }

    .help-center-page .support-card h3 {
        font-size: 18px;
        font-weight: 800;
        margin: 0 0 14px;
        color: #111;
    }

    .help-center-page .support-card p {
        margin: 0 0 8px;
        font-size: 15px;
        line-height: 1.7;
        color: #5e5e5e;
    }

    /* CALLBACK */
    .help-center-page .callback-section {
        padding: 45px 0 80px;
        background: #f3f3f3;
    }

    .help-center-page .callback-box {
        max-width: 920px;
        margin: 0 auto;
        background: #fff;
        border-radius: 22px;
        box-shadow: 0 10px 18px rgba(0,0,0,0.12);
        border-left: 6px solid #2b78c5;
        padding: 42px 34px 36px;
    }

    .help-center-page .callback-box h2 {
        text-align: center;
        font-size: 54px;
        font-weight: 800;
        line-height: 1.15;
        margin: 0 0 28px;
        color: #111;
    }

    .help-center-page .form-group {
        margin-bottom: 18px;
    }

    .help-center-page .form-group label {
        display: block;
        font-size: 16px;
        font-weight: 700;
        color: #111;
        margin-bottom: 8px;
    }

    .help-center-page .form-control-custom {
        width: 100%;
        height: 56px;
        border: none;
        outline: none;
        border-radius: 10px;
        background: #efefef;
        box-shadow: inset 0 0 0 1px rgba(0,0,0,0.02), 0 3px 8px rgba(0,0,0,0.08);
        padding: 0 16px;
        font-size: 15px;
        color: #444;
    }

    .help-center-page .form-control-custom::placeholder {
        color: #9c9c9c;
    }

    .help-center-page .submit-wrap {
        text-align: center;
        padding-top: 6px;
    }

    .help-center-page .submit-btn {
        min-width: 190px;
        height: 48px;
        border: none;
        border-radius: 10px;
        background: #2b78c5;
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        box-shadow: 0 6px 12px rgba(43,120,197,0.30);
        cursor: pointer;
        transition: 0.3s ease;
    }

    .help-center-page .submit-btn:hover {
        background: #1f67ae;
        transform: translateY(-2px);
    }

    @media (max-width: 1200px) {
        .help-center-page .page-container {
            padding-left: 24px;
            padding-right: 24px;
        }

        .help-center-page .hero-title,
        .help-center-page .section-heading h2,
        .help-center-page .callback-box h2 {
            font-size: 46px;
        }
    }

    @media (max-width: 991px) {
        .help-center-page .support-grid {
            grid-template-columns: 1fr;
            max-width: 460px;
        }

        .help-center-page .hero-title,
        .help-center-page .section-heading h2,
        .help-center-page .callback-box h2 {
            font-size: 38px;
        }

        .help-center-page .faq-question-text {
            font-size: 18px;
        }
    }

    @media (max-width: 767px) {
        .help-center-page .page-container {
            padding-left: 16px;
            padding-right: 16px;
        }

        .help-center-page .hero-section {
            padding: 70px 0 65px;
        }

        .help-center-page .hero-title,
        .help-center-page .section-heading h2,
        .help-center-page .callback-box h2 {
            font-size: 30px;
        }

        .help-center-page .hero-text,
        .help-center-page .section-heading p {
            font-size: 14px;
        }

        .help-center-page .faq-question {
            padding: 18px 18px;
        }

        .help-center-page .faq-question-text {
            font-size: 16px;
        }

        .help-center-page .faq-answer {
            padding: 0 18px 18px;
            font-size: 14px;
        }

        .help-center-page .callback-box {
            padding: 28px 18px 24px;
        }

        .help-center-page .form-control-custom {
            height: 52px;
            font-size: 14px;
        }
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<div class="help-center-page">

    <section class="hero-section">
        <div class="page-container">
            <h1 class="hero-title">How can we help you?</h1>

            <div class="section-line">
                <span></span>
                <span></span>
            </div>

            <p class="hero-text">
                Find answers about construction services, project process, pricing, support, and service availability in Mumbai,
                Navi Mumbai, Raigad, Thane, and Pune.
            </p>

            <div class="search-box">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" id="faqSearch" placeholder="Search for contractor in Mumbai, BOQ in Navi Mumbai, structural audit in Pune...">
            </div>
        </div>
    </section>

    <section class="faq-section">
        <div class="page-container">
            <div class="section-heading">
                <h2>Frequently Asked Questions</h2>
                <div class="section-line">
                    <span></span>
                    <span></span>
                </div>
                <p>Top questions from homeowners and businesses across Maharashtra</p>
            </div>

            <div class="faq-list" id="faqList">

                <div class="faq-item active">
                    <button type="button" class="faq-question">
                        <span class="faq-question-text">1. How do I contact ConstructKaro for support?</span>
                        <span class="faq-icon">−</span>
                    </button>
                    <div class="faq-answer">
                        You can contact ConstructKaro through our website enquiry form, phone support, or WhatsApp.
                        Our team will connect with you to understand your requirement and guide you further.
                    </div>
                </div>

                <div class="faq-item">
                    <button type="button" class="faq-question">
                        <span class="faq-question-text">2. Does ConstructKaro provide end-to-end support for construction-related requirements?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        Yes, ConstructKaro provides structured support for multiple construction services including architect,
                        contractor, interior, survey, testing, and BOQ/estimation.
                    </div>
                </div>

                <div class="faq-item">
                    <button type="button" class="faq-question">
                        <span class="faq-question-text">3. Which locations do you currently serve?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        We currently serve Mumbai, Navi Mumbai, Raigad, Thane, Pune, and nearby regions based on service availability.
                    </div>
                </div>

                <div class="faq-item">
                    <button type="button" class="faq-question">
                        <span class="faq-question-text">4. Can I request more than one service for the same project?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        Yes, you can request multiple services for one project. Our team will understand your full requirement and guide you with the right execution process.
                    </div>
                </div>

                <div class="faq-item">
                    <button type="button" class="faq-question">
                        <span class="faq-question-text">5. Does ConstructKaro provide testing services for construction projects?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        Yes. We support testing-related requirements for construction projects based on service availability and project scope.
                    </div>
                </div>

                <div class="faq-item">
                    <button type="button" class="faq-question">
                        <span class="faq-question-text">6. How are service providers assigned to my project?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        After understanding your project requirement, our team assigns suitable professionals or service partners based on service type, location, and project needs.
                    </div>
                </div>

                <div class="faq-item">
                    <button type="button" class="faq-question">
                        <span class="faq-question-text">7. Are survey services available in Navi Mumbai and Raigad?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        Yes, survey services are available in Navi Mumbai, Raigad, and nearby serviceable locations, subject to project requirement and team availability.
                    </div>
                </div>

                <div class="faq-item">
                    <button type="button" class="faq-question">
                        <span class="faq-question-text">8. How do I find a trusted contractor in Mumbai through ConstructKaro?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        You can submit your requirement through ConstructKaro. Our team will understand your needs and connect you with the right contractor through our structured process.
                    </div>
                </div>

            </div>
        </div>
    </section>


<section class="support-section">
    <div class="page-container">
       

        <div class="support-image-box">
            <img src="{{ asset('images/help-center/contact-support-image.png') }}" alt="ConstructKaro Support Team">
        </div>
    </div>
</section>
    <section class="callback-section">
        <div class="page-container">
            <div class="callback-box">
                <h2>Request a Callback</h2>

                <form action="{{ route('help.callback.submit') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control-custom" type="text" id="name" name="name" placeholder="Your full name">
                    </div>

                    <div class="form-group">
                        <label for="mobile">Mobile Number</label>
                        <input class="form-control-custom" type="text" id="mobile" name="mobile" placeholder="+91 XXXXX XXXXX">
                    </div>

                    <div class="form-group">
                        <label for="city">City</label>
                        <select class="form-control-custom" id="city" name="city">
                            <option value="">Select your city</option>
                            <option>Mumbai</option>
                            <option>Navi Mumbai</option>
                            <option>Raigad</option>
                            <option>Thane</option>
                            <option>Pune</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="area">Area / Location</label>
                        <input class="form-control-custom" type="text" id="area" name="area" placeholder="Enter your area or locality">
                    </div>

                    <div class="form-group">
                        <label for="pincode">Pincode</label>
                        <input class="form-control-custom" type="text" id="pincode" name="pincode" placeholder="e.g. 410210">
                    </div>

                    <div class="submit-wrap">
                        <button type="submit" class="submit-btn">Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const faqItems = document.querySelectorAll('.help-center-page .faq-item');
        const searchInput = document.getElementById('faqSearch');

        faqItems.forEach(item => {
            const questionBtn = item.querySelector('.faq-question');

            questionBtn.addEventListener('click', function () {
                const isActive = item.classList.contains('active');

                faqItems.forEach(faq => {
                    faq.classList.remove('active');
                    const icon = faq.querySelector('.faq-icon');
                    if (icon) icon.textContent = '+';
                });

                if (!isActive) {
                    item.classList.add('active');
                    const activeIcon = item.querySelector('.faq-icon');
                    if (activeIcon) activeIcon.textContent = '−';
                }
            });
        });

        if (searchInput) {
            searchInput.addEventListener('keyup', function () {
                const value = this.value.toLowerCase();

                faqItems.forEach(item => {
                    const text = item.innerText.toLowerCase();
                    item.style.display = text.includes(value) ? '' : 'none';
                });
            });
        }
    });
</script>

@endsection