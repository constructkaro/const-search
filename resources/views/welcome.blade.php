@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

@php
    $isCustomerLoggedIn = session('customer_logged_in');
@endphp

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root{
        --header-height: 96px;
        --hero-full-height: calc(100vh - var(--header-height));
        --hero-small-height: 347px;
        --blue: #1f67ab;
        --blue-light: #2f80c8;
        --orange: #df6d1c;
        --bg: #f4f4f4;
        --text: #333333;
        --muted: #666666;
    }

    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body{
        background: var(--bg);
        overflow-x: hidden;
    }

    .home-page{
        background: var(--bg);
    }

    .hero-holder{
        position: relative;
        width: 100%;
    }

    .hero-banner{
        position: relative;
        width: 100vw;
        height: var(--hero-full-height);
        min-height: 620px;
        margin-left: calc(50% - 50vw);
        margin-right: calc(50% - 50vw);
        display: flex;
        align-items: center;
        overflow: hidden;
        background: url('{{ asset('images/banner.png') }}') center center / cover no-repeat;
        transition: height 0.45s ease, min-height 0.45s ease;
    }

    .hero-banner::before{
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
            90deg,
            rgba(0,0,0,0.95) 0%,
            rgba(0,0,0,0.88) 18%,
            rgba(0,0,0,0.72) 34%,
            rgba(0,0,0,0.45) 48%,
            rgba(0,0,0,0.18) 62%,
            rgba(0,0,0,0.03) 100%
        );
        z-index: 1;
    }

    body.hero-scrolled .hero-banner{
        height: var(--hero-small-height);
        min-height: var(--hero-small-height);
    }

    .hero-inner{
        width: 100%;
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 46px;
        position: relative;
        z-index: 2;
    }

    .hero-content{
        max-width: 620px;
    }

    .hero-title{
        margin: 0 0 34px 0;
        color: #ffffff;
        font-size: 52px;
        font-weight: 800;
        line-height: 1.08;
        letter-spacing: -1px;
        transition: font-size 0.45s ease, margin 0.45s ease;
    }

    body.hero-scrolled .hero-title{
        font-size: 50px;
        margin-bottom: 30px;
    }

    .hero-search-row{
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .hero-field{
        position: relative;
        height: 46px;
        background: #ffffff;
        border-radius: 999px;
        display: flex;
        align-items: center;
        box-shadow: 0 8px 20px rgba(0,0,0,0.10);
    }

    .hero-field-search{
        width: 246px;
    }

    .hero-field-location{
        width: 246px;
    }

    .hero-icon-left{
        position: absolute;
        left: 14px;
        width: 16px;
        height: 16px;
        color: #a0a0a0;
        pointer-events: none;
    }

    .hero-icon-right{
        position: absolute;
        right: 14px;
        width: 16px;
        height: 16px;
        color: #9f9f9f;
        pointer-events: none;
    }

    .hero-banner input,
    .hero-banner select{
        width: 100%;
        height: 100%;
        border: 0;
        outline: none;
        background: transparent;
        color: #808080;
        font-size: 13px;
        font-weight: 400;
        padding-left: 38px;
        padding-right: 16px;
        border-radius: 999px;
    }

    .hero-banner input::placeholder{
        color: #b8b8b8;
    }

    .hero-banner select{
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
        padding-right: 38px;
        color: #9b9b9b;
    }

    .service-cards-section{
        position: relative;
        z-index: 10;
        background: #f4f4f4;
        padding: 60px 0 50px;
    }

    .service-cards-container{
        width: 92%;
        max-width: 1280px;
        margin: 0 auto;
    }

    .service-cards-grid{
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 32px;
        align-items: stretch;
    }

    .service-card-item{
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #d9d9d9;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        opacity: 0;
        transform: translateY(50px);
        transition: opacity 0.7s ease, transform 0.7s ease, box-shadow 0.3s ease;
    }

    .service-card-item.show{
        opacity: 1;
        transform: translateY(0);
    }

    .service-card-item:hover{
        transform: translateY(-8px);
        box-shadow: 0 16px 38px rgba(0,0,0,0.12);
    }

    .service-card-item:nth-child(2){
        transition-delay: 0.12s;
    }

    .service-card-item:nth-child(3){
        transition-delay: 0.24s;
    }

    .service-card-image{
        width: 100%;
        height: 250px;
        overflow: hidden;
        background: #e9e9e9;
    }

    .service-card-image img{
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
        object-position: center;
        transition: transform 0.4s ease;
    }

    .service-card-item:hover .service-card-image img{
        transform: scale(1.05);
    }

    .service-card-box{
        padding: 22px 22px 26px;
        text-align: center;
    }

    .service-card-divider{
        display: flex;
        justify-content: center;
        margin-bottom: 16px;
    }

    .service-card-divider svg{
        display: block;
        max-width: 100%;
    }

    .service-card-title{
        margin: 0 0 10px;
        font-size: 24px;
        line-height: 1.2;
        font-weight: 700;
        color: var(--orange);
    }

    .service-card-text{
        margin: 0 0 20px;
        font-size: 14px;
        line-height: 1.7;
        color: var(--muted);
        min-height: 48px;
    }

    .service-card-btn{
        display: inline-block;
        min-width: 200px;
        padding: 12px 22px;
        border-radius: 12px;
        background: linear-gradient(180deg, var(--blue-light), var(--blue));
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        box-shadow: 0 6px 14px rgba(31, 103, 171, 0.22);
        transition: all 0.3s ease;
    }

    .service-card-btn:hover{
        transform: translateY(-2px);
        background: linear-gradient(180deg, #3d8dd4, #1c5f9d);
    }

    .explore-services-section {
        padding: 50px 0 30px;
        background: #f4f4f4;
    }

    .explore-services-container {
        width: 92%;
        max-width: 1320px;
        margin: 0 auto;
    }

    .explore-services-heading {
        text-align: center;
        margin-bottom: 34px;
    }

    .explore-services-heading h2 {
        margin: 0;
        color: #222;
        font-size: 34px;
        font-weight: 800;
        line-height: 1.2;
    }

    .heading-line {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-top: 10px;
    }

    .heading-line span {
        display: block;
        height: 3px;
        border-radius: 20px;
    }

    .line-orange {
        width: 88px;
        background: #e97827;
    }

    .line-blue {
        width: 126px;
        background: #2f78bf;
    }

    .explore-services-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 28px;
    }

    .explore-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 6px 16px rgba(0,0,0,0.12);
        transition: 0.3s ease;
    }

    .explore-card:hover {
        transform: translateY(-6px);
    }

    .orange-card {
        border: 2px solid #ea7a27;
    }

    .blue-card {
        border: 2px solid #2f78bf;
    }

    .explore-card-image {
        width: 100%;
        height: 170px;
        overflow: hidden;
        border-bottom: 1px solid #d7d7d7;
    }

    .explore-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .explore-card-body {
        padding: 14px 16px 18px;
        text-align: center;
        background: #fff;
    }

    .explore-card-body h3 {
        margin: 0 0 10px;
        font-size: 18px;
        font-weight: 800;
        line-height: 1.2;
    }

    .orange-card h3 {
        color: #e97827;
    }

    .blue-card h3 {
        color: #2f78bf;
    }

    .explore-card-body h3.small-title {
        font-size: 14px;
        line-height: 1.25;
        letter-spacing: -0.2px;
    }

    .explore-card-body p {
        margin: 0 0 14px;
        color: #333;
        font-size: 12px;
        line-height: 1.45;
        min-height: 34px;
    }

    .explore-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 180px;
        height: 30px;
        padding: 0 18px;
        border-radius: 10px;
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(0,0,0,0.18);
        transition: 0.3s ease;
        cursor: pointer;
    }

    .explore-btn:hover {
        transform: translateY(-2px);
    }

    .orange-btn {
        background: linear-gradient(180deg, #ef8a39 0%, #df7122 100%);
    }

    .blue-btn {
        background: linear-gradient(180deg, #3485cd 0%, #206eb4 100%);
    }

    .custom-modal-overlay{
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.55);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 99999;
        padding: 20px;
    }

    .custom-modal-overlay.active{
        display: flex;
    }

    .custom-modal-box{
        width: 100%;
        max-width: 430px;
        background: #fff;
        border-radius: 18px;
        padding: 26px 22px;
        position: relative;
        box-shadow: 0 18px 50px rgba(0,0,0,0.22);
        animation: modalFadeIn 0.25s ease;
    }

    @keyframes modalFadeIn{
        from{
            opacity: 0;
            transform: translateY(20px) scale(0.98);
        }
        to{
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .custom-modal-close{
        position: absolute;
        top: 10px;
        right: 14px;
        border: none;
        background: transparent;
        font-size: 28px;
        line-height: 1;
        cursor: pointer;
        color: #666;
    }

    .custom-modal-header h3{
        margin: 0 0 6px;
        font-size: 26px;
        font-weight: 700;
        color: #1c2c3e;
    }

    .custom-modal-header p{
        margin: 0 0 22px;
        font-size: 14px;
        color: #666;
    }

    .form-group{
        margin-bottom: 16px;
    }

    .form-group label{
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #222;
    }

    .custom-input{
        width: 100%;
        height: 48px;
        border: 1px solid #d8d8d8;
        border-radius: 12px;
        padding: 0 14px;
        font-size: 14px;
        outline: none;
        transition: 0.3s ease;
    }

    .custom-input:focus{
        border-color: #f25c05;
        box-shadow: 0 0 0 4px rgba(242,92,5,0.08);
    }

    .custom-modal-actions{
        display: flex;
        gap: 12px;
        margin-top: 14px;
    }

    .modal-btn{
        border: none;
        border-radius: 12px;
        padding: 12px 18px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .primary-btn{
        background: linear-gradient(180deg, #f58a3c, #f25c05);
        color: #fff;
        width: 100%;
    }

    .verify-btn{
        background: linear-gradient(180deg, #2f80c8, #1f67ab);
        color: #fff;
        width: 100%;
    }

    .error-text{
        display: block;
        margin-top: 6px;
        font-size: 12px;
        color: #dc2626;
    }

    .otp-success-msg{
        font-size: 13px;
        color: #15803d;
        margin-top: 8px;
    }

    @media (max-width: 1200px){
        .hero-title{
            font-size: 54px;
        }

        body.hero-scrolled .hero-title{
            font-size: 44px;
        }
    }

    @media (max-width: 991px){
        .hero-inner{
            padding: 0 28px;
        }

        .hero-title{
            font-size: 44px;
        }

        body.hero-scrolled .hero-title{
            font-size: 38px;
        }

        .service-cards-grid{
            grid-template-columns: repeat(2, 1fr);
        }

        .explore-services-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .explore-services-heading h2 {
            font-size: 30px;
        }
    }

    @media (max-width: 767px){
        .hero-banner,
        body.hero-scrolled .hero-banner{
            height: 420px;
            min-height: 420px;
            background-position: 74% center;
        }

        .hero-banner::before{
            background: linear-gradient(
                180deg,
                rgba(0,0,0,0.82) 0%,
                rgba(0,0,0,0.62) 48%,
                rgba(0,0,0,0.28) 100%
            );
        }

        .hero-inner{
            padding: 0 18px;
        }

        .hero-title,
        body.hero-scrolled .hero-title{
            font-size: 32px;
            margin-bottom: 24px;
        }

        .hero-search-row{
            flex-direction: column;
            align-items: stretch;
        }

        .hero-field-search,
        .hero-field-location{
            width: 100%;
        }

        .service-cards-grid{
            grid-template-columns: 1fr;
        }

        .service-card-item{
            max-width: 420px;
            margin: 0 auto;
            width: 100%;
        }

        .service-card-image{
            height: 230px;
        }

        .explore-services-grid {
            grid-template-columns: 1fr;
        }

        .explore-card {
            max-width: 360px;
            margin: 0 auto;
            width: 100%;
        }

        .explore-services-heading h2 {
            font-size: 26px;
        }
    }

    @media (max-width: 480px){
        .hero-title,
        body.hero-scrolled .hero-title{
            font-size: 28px;
        }

        .service-card-image{
            height: 210px;
        }

        .service-card-title{
            font-size: 22px;
        }

        .service-card-btn{
            min-width: 100%;
        }
    }
</style>

<div class="home-page">

    <div class="hero-holder">
        <section class="hero-banner">
            <div class="hero-inner">
                <div class="hero-content">
                    <h1 class="hero-title">Which services are you<br>Looking for today?</h1>

                    <div class="hero-search-row">
                        <div class="hero-field hero-field-search">
                            <svg class="hero-icon-left" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M10 2a8 8 0 105.293 14.293l4.707 4.707 1.414-1.414-4.707-4.707A8 8 0 0010 2zm0 2a6 6 0 110 12 6 6 0 010-12z"/>
                            </svg>
                            <input type="text" placeholder="Search for Residential Architect">
                        </div>

                        <div class="hero-field hero-field-location">
                            <svg class="hero-icon-left" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M12 2C8.14 2 5 5.14 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.86-3.14-7-7-7zm0 9.5A2.5 2.5 0 1112 6a2.5 2.5 0 010 5.5z"/>
                            </svg>

                            <select>
                                <option selected>Kharghar, Navi Mumbai</option>
                                <option>Mumbai</option>
                                <option>Navi Mumbai</option>
                                <option>Pune</option>
                                <option>Raigad</option>
                            </select>

                            <svg class="hero-icon-right" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M7 10l5 5 5-5z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section class="service-cards-section">
        <div class="service-cards-container">
            <div class="service-cards-grid">

                <div class="service-card-item reveal-card">
                    <div class="service-card-image">
                        <img src="{{ asset('images/b1.png') }}" alt="Architect">
                    </div>
                    <div class="service-card-box">
                        <div class="service-card-divider">
                            <svg xmlns="http://www.w3.org/2000/svg" width="152" height="1" viewBox="0 0 152 1" fill="none">
                                <path d="M0 0.5L152 0.500015" stroke="#4A4A4A"/>
                            </svg>
                        </div>
                        <h3 class="service-card-title">Architect</h3>
                        <p class="service-card-text">Post your requirements and get your quote within 24 hours.</p>
                        <a href="{{ route('post', ['work_type_id' => 2]) }}" class="service-card-btn">
                            Post Your Requirement
                        </a>
                    </div>
                </div>

                <div class="service-card-item reveal-card">
                    <div class="service-card-image">
                        <img src="{{ asset('images/b2.png') }}" alt="Contractor">
                    </div>
                    <div class="service-card-box">
                        <div class="service-card-divider">
                            <svg xmlns="http://www.w3.org/2000/svg" width="152" height="1" viewBox="0 0 152 1" fill="none">
                                <path d="M0 0.5L152 0.500015" stroke="#4A4A4A"/>
                            </svg>
                        </div>
                        <h3 class="service-card-title">Contractor</h3>
                        <p class="service-card-text">Post your requirements and get your quote within 24 hours.</p>
                        <a href="{{ route('post', ['work_type_id' => 1]) }}" class="service-card-btn">
                            Post Your Requirement
                        </a>
                    </div>
                </div>

                <div class="service-card-item reveal-card">
                    <div class="service-card-image">
                        <img src="{{ asset('images/b3.png') }}" alt="Interior Designer">
                    </div>
                    <div class="service-card-box">
                        <div class="service-card-divider">
                            <svg xmlns="http://www.w3.org/2000/svg" width="152" height="1" viewBox="0 0 152 1" fill="none">
                                <path d="M0 0.5L152 0.500015" stroke="#4A4A4A"/>
                            </svg>
                        </div>
                        <h3 class="service-card-title">Interior Designer</h3>
                        <p class="service-card-text">Post your requirements and get your quote within 24 hours.</p>
                        <a href="{{ route('post', ['work_type_id' => 4]) }}" class="service-card-btn">
                            Post Your Requirement
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="explore-services-section">
        <div class="explore-services-container">

            <div class="explore-services-heading">
                <h2>Explore More Services</h2>
                <div class="heading-line">
                    <span class="line-orange"></span>
                    <span class="line-blue"></span>
                </div>
            </div>

            <div class="explore-services-grid">

                @php $surveyUrl = route('customer.survey'); @endphp
                <div class="explore-card orange-card">
                    <div class="explore-card-image">
                        <img src="{{ asset('images/explore/survey-services.png') }}" alt="Survey Services">
                    </div>
                    <div class="explore-card-body">
                        <h3>Survey Services</h3>
                        <p>Explore All Categories of Survey Services</p>
                        <a href="{{ $isCustomerLoggedIn ? $surveyUrl : 'javascript:void(0)' }}"
                           class="explore-btn orange-btn {{ $isCustomerLoggedIn ? '' : 'open-customer-login-modal' }}"
                           data-redirect="{{ $surveyUrl }}">
                            Get Started
                        </a>
                    </div>
                </div>

                @php $testingUrl = route('customer.testing'); @endphp
                <div class="explore-card blue-card">
                    <div class="explore-card-image">
                        <img src="{{ asset('images/explore/testing-services.png') }}" alt="Testing Services">
                    </div>
                    <div class="explore-card-body">
                        <h3>Testing Services</h3>
                        <p>Explore All Categories of Testing Services</p>
                        <a href="{{ $isCustomerLoggedIn ? $testingUrl : 'javascript:void(0)' }}"
                           class="explore-btn blue-btn {{ $isCustomerLoggedIn ? '' : 'open-customer-login-modal' }}"
                           data-redirect="{{ $testingUrl }}">
                            Get Started
                        </a>
                    </div>
                </div>

                @php $boqUrl = route('customer.boq'); @endphp
                <div class="explore-card orange-card">
                    <div class="explore-card-image">
                        <img src="{{ asset('images/explore/boq-estimation.png') }}" alt="BOQ Estimation">
                    </div>
                    <div class="explore-card-body">
                        <h3>BOQ/Estimation</h3>
                        <p>Explore All Categories of BOQ/Estimation Services</p>
                        <a href="{{ $isCustomerLoggedIn ? $boqUrl : 'javascript:void(0)' }}"
                           class="explore-btn orange-btn {{ $isCustomerLoggedIn ? '' : 'open-customer-login-modal' }}"
                           data-redirect="{{ $boqUrl }}">
                            Get Started
                        </a>
                    </div>
                </div>

                @php $facadeUrl = route('customer.facade'); @endphp
                <div class="explore-card blue-card">
                    <div class="explore-card-image">
                        <img src="{{ asset('images/explore/facade-services.png') }}" alt="Facade Services">
                    </div>
                    <div class="explore-card-body">
                        <h3>Facade Services</h3>
                        <p>Explore All Categories of Facade Services</p>
                        <a href="{{ $isCustomerLoggedIn ? $facadeUrl : 'javascript:void(0)' }}"
                           class="explore-btn blue-btn {{ $isCustomerLoggedIn ? '' : 'open-customer-login-modal' }}"
                           data-redirect="{{ $facadeUrl }}">
                            Get Started
                        </a>
                    </div>
                </div>

                @php $machineryUrl = '#'; @endphp
                <div class="explore-card orange-card">
                    <div class="explore-card-image">
                        <img src="{{ asset('images/explore/machinery-on-hire.png') }}" alt="Machinery On Hire">
                    </div>
                    <div class="explore-card-body">
                        <h3>Machinery On Hire</h3>
                        <p>Explore All Categories of Machinery On Hire Services</p>
                        <a href="javascript:void(0)" class="explore-btn orange-btn open-coming-soon-modal">
                            Get Started
                        </a>
                    </div>
                </div>

                @php $structuralAuditUrl = route('customer.structuralaudit'); @endphp
                <div class="explore-card blue-card">
                    <div class="explore-card-image">
                        <img src="{{ asset('images/explore/structural-audit.png') }}" alt="Structural Audit">
                    </div>
                    <div class="explore-card-body">
                        <h3>Structural Audit</h3>
                        <p>Explore All Categories of Structural Audit Services</p>
                        <a href="{{ $isCustomerLoggedIn ? $structuralAuditUrl : 'javascript:void(0)' }}"
                           class="explore-btn blue-btn {{ $isCustomerLoggedIn ? '' : 'open-customer-login-modal' }}"
                           data-redirect="{{ $structuralAuditUrl }}">
                            Get Started
                        </a>
                    </div>
                </div>

                @php $legalUrl = route('customer.nasupport'); @endphp
                <div class="explore-card orange-card">
                    <div class="explore-card-image">
                        <img src="{{ asset('images/explore/legal-due-diligence.png') }}" alt="NA Support and Legal Due Diligence">
                    </div>
                    <div class="explore-card-body">
                        <h3 class="small-title">NA Support &amp; Legal Due Diligence</h3>
                        <p>Explore All Categories of NA Support &amp; Legal Due Diligence Services</p>
                        <a href="{{ $isCustomerLoggedIn ? $legalUrl : 'javascript:void(0)' }}"
                           class="explore-btn orange-btn {{ $isCustomerLoggedIn ? '' : 'open-customer-login-modal' }}"
                           data-redirect="{{ $legalUrl }}">
                            Get Started
                        </a>
                    </div>
                </div>

                @php $weldingUrl = route('customer.welding_fabrication'); @endphp
                <div class="explore-card blue-card">
                    <div class="explore-card-image">
                        <img src="{{ asset('images/explore/welding-fabrication.png') }}" alt="Welding and Fabrication">
                    </div>
                    <div class="explore-card-body">
                        <h3>Welding &amp; Fabrication</h3>
                        <p>Explore All Categories of Welding &amp; Fabrication Services</p>
                        <a href="{{ $isCustomerLoggedIn ? $weldingUrl : 'javascript:void(0)' }}"
                           class="explore-btn blue-btn {{ $isCustomerLoggedIn ? '' : 'open-customer-login-modal' }}"
                           data-redirect="{{ $weldingUrl }}">
                            Get Started
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<div id="customerLoginOtpModal" class="custom-modal-overlay">
    <div class="custom-modal-box">
        <button type="button" class="custom-modal-close" id="closeCustomerLoginModal">&times;</button>

        <div class="custom-modal-header">
            <h3>Login to Continue</h3>
            <p>Enter your mobile number to get OTP</p>
        </div>

        <div class="custom-modal-body">
            <input type="hidden" id="customer_redirect_url">

            <div class="form-group">
                <label>Mobile Number</label>
                <input type="text" id="customer_mobile_number" class="custom-input" placeholder="Enter mobile number" maxlength="10">
                <small class="error-text" id="customer_mobile_error"></small>
            </div>

            <div class="form-group" id="customerOtpSection" style="display:none;">
                <label>Enter OTP</label>
                <input type="text" id="customer_otp_code" class="custom-input" placeholder="Enter OTP" maxlength="6">
                <small class="error-text" id="customer_otp_error"></small>
            </div>

            <div class="otp-success-msg" id="customer_otp_success_msg"></div>

            <div class="custom-modal-actions">
                <button type="button" class="modal-btn primary-btn" id="customerSendOtpBtn">Get OTP</button>
                <button type="button" class="modal-btn verify-btn" id="customerVerifyOtpBtn" style="display:none;">Verify OTP</button>
            </div>
        </div>
    </div>
</div>
<div id="comingSoonModal" class="custom-modal-overlay">
    <div class="custom-modal-box" style="max-width:420px; text-align:center;">
        <button type="button" class="custom-modal-close" id="closeComingSoonModal">&times;</button>

        <div class="custom-modal-header">
            <h3>Coming Soon</h3>
            <p>This service will be available soon on ConstructKaro.</p>
        </div>

        <div class="custom-modal-body">
            <div style="font-size:56px; margin-bottom:12px;">🚧</div>
            <p style="font-size:14px; color:#666; margin-bottom:18px;">
                We are working on launching Machinery On Hire services shortly.
            </p>

            <button type="button" class="modal-btn primary-btn" id="okayComingSoonBtn">
                Okay
            </button>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    $(document).on('click', '.open-customer-login-modal', function () {
        let redirectUrl = $(this).data('redirect');

        $('#customer_redirect_url').val(redirectUrl);
        $('#customer_mobile_number').val('');
        $('#customer_otp_code').val('');
        $('#customer_mobile_error').text('');
        $('#customer_otp_error').text('');
        $('#customer_otp_success_msg').text('');
        $('#customerOtpSection').hide();
        $('#customerVerifyOtpBtn').hide();
        $('#customerSendOtpBtn').show();

        $('#customerLoginOtpModal').addClass('active');
    });

    $('#closeCustomerLoginModal').on('click', function () {
        $('#customerLoginOtpModal').removeClass('active');
    });

    $('#customerLoginOtpModal').on('click', function (e) {
        if (e.target.id === 'customerLoginOtpModal') {
            $('#customerLoginOtpModal').removeClass('active');
        }
    });

    $('#customerSendOtpBtn').on('click', function () {
        let mobile = $('#customer_mobile_number').val();

        $('#customer_mobile_error').text('');
        $('#customer_otp_error').text('');
        $('#customer_otp_success_msg').text('');

        $.ajax({
            url: "{{ route('customer.send.otp') }}",
            type: "POST",
            data: {
                mobile: mobile
            },
            success: function (response) {
                if (response.status) {
                    $('#customerOtpSection').show();
                    $('#customerVerifyOtpBtn').show();
                    $('#customerSendOtpBtn').hide();
                    $('#customer_otp_success_msg').text(response.message);
                } else {
                    $('#customer_mobile_error').text(response.message);
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON) {
                    if (xhr.responseJSON.errors && xhr.responseJSON.errors.mobile) {
                        $('#customer_mobile_error').text(xhr.responseJSON.errors.mobile[0]);
                    } else if (xhr.responseJSON.message) {
                        $('#customer_mobile_error').text(xhr.responseJSON.message);
                    }
                }
            }
        });
    });

    $('#customerVerifyOtpBtn').on('click', function () {
        let mobile = $('#customer_mobile_number').val();
        let otp = $('#customer_otp_code').val();
        let redirectUrl = $('#customer_redirect_url').val();

        $('#customer_mobile_error').text('');
        $('#customer_otp_error').text('');

        $.ajax({
            url: "{{ route('customer.verify.otp') }}",
            type: "POST",
            data: {
                mobile: mobile,
                otp: otp,
                redirect_url: redirectUrl
            },
            success: function (response) {
                if (response.status) {
                    window.location.href = response.redirect;
                } else {
                    $('#customer_otp_error').text(response.message);
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON) {
                    if (xhr.responseJSON.errors) {
                        if (xhr.responseJSON.errors.mobile) {
                            $('#customer_mobile_error').text(xhr.responseJSON.errors.mobile[0]);
                        }
                        if (xhr.responseJSON.errors.otp) {
                            $('#customer_otp_error').text(xhr.responseJSON.errors.otp[0]);
                        }
                    } else if (xhr.responseJSON.message) {
                        $('#customer_otp_error').text(xhr.responseJSON.message);
                    }
                }
            }
        });
    });
</script>

<script>
    function toggleHeroResize() {
        if (window.scrollY > 60) {
            document.body.classList.add('hero-scrolled');
        } else {
            document.body.classList.remove('hero-scrolled');
        }
    }

    window.addEventListener('scroll', toggleHeroResize);
    window.addEventListener('load', toggleHeroResize);
    window.addEventListener('resize', toggleHeroResize);

    const revealItems = document.querySelectorAll('.reveal-card');

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
            }
        });
    }, {
        threshold: 0.2
    });

    revealItems.forEach((item) => {
        revealObserver.observe(item);
    });
</script>
<script>
    $(document).on('click', '.open-coming-soon-modal', function () {
        $('#comingSoonModal').addClass('active');
    });

    $('#closeComingSoonModal, #okayComingSoonBtn').on('click', function () {
        $('#comingSoonModal').removeClass('active');
    });

    $('#comingSoonModal').on('click', function (e) {
        if (e.target.id === 'comingSoonModal') {
            $('#comingSoonModal').removeClass('active');
        }
    });
</script>
@endsection