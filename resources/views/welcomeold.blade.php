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
        --hero-small-height: 350px;
        --blue: #1f67ab;
        --blue-light: #2f80c8;
        --orange: #df6d1c;
        --orange-light: #ef8a39;
        --bg: #f4f4f4;
        --white: #ffffff;
        --text: #333333;
        --muted: #666666;
        --border: #dddddd;
        --shadow: 0 10px 30px rgba(0,0,0,0.08);
        --radius-lg: 22px;
        --radius-md: 16px;
        --radius-sm: 12px;
    }

    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body{
        background: var(--bg);
        color: var(--text);
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
        min-height: 650px;
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
            rgba(0,0,0,0.92) 0%,
            rgba(0,0,0,0.82) 22%,
            rgba(0,0,0,0.62) 42%,
            rgba(0,0,0,0.28) 62%,
            rgba(0,0,0,0.05) 100%
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
        max-width: 650px;
    }

    .hero-title{
        margin: 0 0 30px;
        color: #fff;
        font-size: 54px;
        font-weight: 800;
        line-height: 1.08;
        letter-spacing: -1px;
        transition: all 0.45s ease;
        text-shadow: 0 8px 24px rgba(0,0,0,0.2);
    }

    body.hero-scrolled .hero-title{
        font-size: 46px;
        margin-bottom: 24px;
    }

    .hero-search-row{
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .hero-field{
        position: relative;
        height: 50px;
        background: #fff;
        border-radius: 999px;
        display: flex;
        align-items: center;
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    .hero-field-search,
    .hero-field-location{
        width: 250px;
    }

    .hero-icon-left,
    .hero-icon-right{
        position: absolute;
        width: 16px;
        height: 16px;
        color: #9d9d9d;
        pointer-events: none;
    }

    .hero-icon-left{
        left: 14px;
    }

    .hero-icon-right{
        right: 14px;
    }

    .hero-banner input,
    .hero-banner select{
        width: 100%;
        height: 100%;
        border: 0;
        outline: none;
        background: transparent;
        font-size: 13px;
        color: #7a7a7a;
        border-radius: 999px;
    }

    .hero-banner input{
        padding: 0 16px 0 40px;
    }

    .hero-banner select{
        padding: 0 38px 0 40px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
    }

    .hero-banner input::placeholder{
        color: #b5b5b5;
    }

    .service-cards-section{
        padding: 65px 0 55px;
        background: var(--bg);
    }

    .service-cards-container,
    .explore-services-container,
    .faq-container{
        width: 92%;
        max-width: 1280px;
        margin: 0 auto;
    }

    .service-cards-grid{
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px;
    }

    .service-card-item{
        background: #fff;
        border-radius: var(--radius-lg);
        overflow: hidden;
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.7s ease, transform 0.7s ease, box-shadow 0.3s ease;
    }

    .service-card-item.show{
        opacity: 1;
        transform: translateY(0);
    }

    .service-card-item:hover{
        transform: translateY(-8px);
        box-shadow: 0 16px 40px rgba(0,0,0,0.12);
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
        background: #eaeaea;
    }

    .service-card-image img{
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
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
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 210px;
        padding: 12px 22px;
        border-radius: 12px;
        background: linear-gradient(180deg, var(--blue-light), var(--blue));
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        transition: all 0.3s ease;
        box-shadow: 0 8px 18px rgba(31, 103, 171, 0.22);
    }

    .service-card-btn:hover{
        transform: translateY(-2px);
        color: #fff;
        text-decoration: none;
    }

    .explore-services-section{
        padding: 50px 0 35px;
        background: var(--bg);
    }

    .explore-services-heading,
    .upcoming-services-heading,
    .faq-heading{
        text-align: center;
        margin-bottom: 34px;
    }

    .explore-services-heading h2,
    .faq-heading h2{
        margin: 0;
        color: #1f1f1f;
        font-size: 34px;
        font-weight: 800;
        line-height: 1.2;
    }

    .heading-line,
    .faq-heading-line{
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 10px;
    }

    .heading-line{
        gap: 8px;
    }

    .heading-line span,
    .faq-heading-line span{
        display: block;
        height: 3px;
    }

    .line-orange{
        width: 88px;
        background: #e97827;
        border-radius: 20px;
    }

    .line-blue{
        width: 126px;
        background: #2f78bf;
        border-radius: 20px;
    }

    .faq-line-orange{
        width: 110px;
        background: #e97827;
        border-radius: 20px 0 0 20px;
    }

    .faq-line-blue{
        width: 110px;
        background: #2f78bf;
        border-radius: 0 20px 20px 0;
    }

    .explore-services-grid{
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 26px;
    }

    .explore-card{
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0,0,0,0.10);
        transition: all 0.3s ease;
    }

    .explore-card:hover{
        transform: translateY(-6px);
    }

    .orange-card{
        border: 2px solid #ea7a27;
    }

    .blue-card{
        border: 2px solid #2f78bf;
    }

    .explore-card-image{
        width: 100%;
        height: 180px;
        overflow: hidden;
        border-bottom: 1px solid #d9d9d9;
    }

    .explore-card-image img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.35s ease;
    }

    .explore-card:hover .explore-card-image img{
        transform: scale(1.04);
    }

    .explore-card-body{
        padding: 16px 16px 20px;
        text-align: center;
        background: #fff;
    }

    .explore-card-body h3{
        margin: 0 0 10px;
        font-size: 18px;
        font-weight: 800;
        line-height: 1.25;
        min-height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .orange-card h3{
        color: #e97827;
    }

    .blue-card h3{
        color: #2f78bf;
    }

    .explore-card-body h3.small-title{
        font-size: 15px;
        line-height: 1.35;
        letter-spacing: -0.1px;
    }

    .explore-card-body p{
        margin: 0 0 14px;
        color: #444;
        font-size: 12px;
        line-height: 1.5;
        min-height: 38px;
    }

    .explore-btn{
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 180px;
        height: 38px;
        padding: 0 18px;
        border-radius: 10px;
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 6px 14px rgba(0,0,0,0.16);
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
    }

    .explore-btn:hover{
        transform: translateY(-2px);
        color: #fff;
        text-decoration: none;
    }

    .orange-btn{
        background: linear-gradient(180deg, #ef8a39 0%, #df7122 100%);
    }

    .blue-btn{
        background: linear-gradient(180deg, #3485cd 0%, #206eb4 100%);
    }

    .upcoming-services-section{
        padding: 70px 0 60px;
        background: linear-gradient(180deg, #f7f7f7 0%, #ececec 100%);
        overflow: hidden;
        position: relative;
    }

    .upcoming-services-container{
        width: 100%;
        max-width: 100%;
        margin: 0 auto;
        position: relative;
    }

    .upcoming-services-heading h2{
        margin: 0;
        font-size: 42px;
        font-weight: 800;
        line-height: 1.15;
        color: #1f1f1f;
    }

    .upcoming-heading-line{
        width: 220px;
        height: 4px;
        margin: 14px auto 0;
        border-radius: 999px;
        background: linear-gradient(90deg, #ef7d2d 0%, #2f78bf 100%);
    }

    .upcoming-auto-scroll-wrap{
        width: 100%;
        overflow: hidden;
        position: relative;
        padding: 8px 0;
    }

    .upcoming-auto-scroll-track{
        display: flex;
        align-items: stretch;
        gap: 24px;
        width: max-content;
        animation: upcomingAutoScroll 30s linear infinite;
        will-change: transform;
    }

    .upcoming-auto-scroll-wrap:hover .upcoming-auto-scroll-track{
        animation-play-state: paused;
    }

    @keyframes upcomingAutoScroll{
        0%{ transform: translateX(0); }
        100%{ transform: translateX(-50%); }
    }

    .upcoming-card{
        width: 390px;
        min-width: 390px;
        background: #fff;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 12px 28px rgba(0,0,0,0.12);
        transition: all 0.35s ease;
        position: relative;
    }

    .upcoming-card:hover{
        transform: translateY(-8px);
        box-shadow: 0 18px 40px rgba(0,0,0,0.16);
    }

    .upcoming-card.orange-border{
        border: 2px solid #ef7d2d;
    }

    .upcoming-card.blue-border{
        border: 2px solid #2f78bf;
    }

    .upcoming-badge{
        position: absolute;
        top: 14px;
        left: 14px;
        z-index: 2;
        padding: 7px 12px;
        border-radius: 999px;
        background: rgba(17, 24, 39, 0.86);
        color: #fff;
        font-size: 11px;
        font-weight: 700;
    }

    .upcoming-card-image{
        width: 100%;
        height: 250px;
        overflow: hidden;
        position: relative;
    }

    .upcoming-card-image img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.45s ease;
    }

    .upcoming-card:hover .upcoming-card-image img{
        transform: scale(1.06);
    }

    .upcoming-card-body{
        padding: 22px 18px 24px;
        text-align: center;
    }

    .upcoming-card-body h3{
        margin: 0;
        font-size: 22px;
        font-weight: 800;
        line-height: 1.25;
    }

    .upcoming-card.orange-border .upcoming-card-body h3{
        color: #ef7d2d;
    }

    .upcoming-card.blue-border .upcoming-card-body h3{
        color: #2f78bf;
    }

    .upcoming-card-body p{
        margin: 8px 0 0;
        font-size: 13px;
        line-height: 1.5;
        color: #666;
    }

    .faq-section{
        padding: 70px 0 60px;
        background: #e9e9e9;
    }

    .faq-container{
        max-width: 1000px;
    }

    .faq-heading h2{
        margin: 0;
        font-size: 32px;
        font-weight: 800;
        color: #1f1f1f;
    }

    .faq-accordion{
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .faq-item{
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.12);
        overflow: hidden;
        transition: 0.3s ease;
    }

    .faq-item.active{
        box-shadow: 0 8px 18px rgba(0,0,0,0.14);
    }

    .faq-question{
        width: 100%;
        border: none;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        text-align: left;
        padding: 22px 24px;
        font-size: 18px;
        font-weight: 800;
        color: #111;
        cursor: pointer;
    }

    .faq-question span:first-child{
        flex: 1;
        line-height: 1.5;
    }

    .faq-icon{
        min-width: 24px;
        text-align: center;
        color: var(--blue);
        font-size: 24px;
        font-weight: 700;
    }

    .faq-answer{
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s ease;
    }

    .faq-item.active .faq-answer{
        max-height: 300px;
    }

    .faq-answer p{
        margin: 0;
        padding: 0 24px 22px;
        color: #555;
        font-size: 15px;
        line-height: 1.7;
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
            transform: translateY(18px) scale(0.98);
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

    .floating-chatbot-btn{
        position: fixed;
        right: 22px;
        bottom: 90px;
        height: 54px;
        padding: 0 20px;
        border-radius: 16px;
        background: linear-gradient(180deg, #3485cd 0%, #206eb4 100%);
        color: #fff !important;
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 18px;
        font-weight: 800;
        box-shadow: 0 12px 28px rgba(32,110,180,0.28);
        z-index: 9998;
        transition: all 0.3s ease;
        border: 2px solid rgba(255,255,255,0.20);
        white-space: nowrap;
    }

    .floating-chatbot-btn svg{
        width: 22px;
        height: 22px;
        flex-shrink: 0;
    }

    .floating-chatbot-btn:hover{
        transform: translateY(-2px);
        color: #fff !important;
        text-decoration: none !important;
    }

    @media (max-width: 1200px){
        .hero-title{
            font-size: 48px;
        }

        body.hero-scrolled .hero-title{
            font-size: 40px;
        }
    }

    @media (max-width: 991px){
        .hero-inner{
            padding: 0 28px;
        }

        .hero-title{
            font-size: 42px;
        }

        body.hero-scrolled .hero-title{
            font-size: 36px;
        }

        .service-cards-grid,
        .explore-services-grid{
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .upcoming-services-heading h2{
            font-size: 34px;
        }

        .upcoming-card{
            width: 320px;
            min-width: 320px;
        }

        .upcoming-card-image{
            height: 210px;
        }
    }

    @media (max-width: 767px){
        .hero-banner,
        body.hero-scrolled .hero-banner{
            height: 430px;
            min-height: 430px;
            background-position: 72% center;
        }

        .hero-banner::before{
            background: linear-gradient(
                180deg,
                rgba(0,0,0,0.84) 0%,
                rgba(0,0,0,0.62) 52%,
                rgba(0,0,0,0.25) 100%
            );
        }

        .hero-inner{
            padding: 0 18px;
        }

        .hero-title,
        body.hero-scrolled .hero-title{
            font-size: 31px;
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

        .service-cards-grid,
        .explore-services-grid{
            grid-template-columns: 1fr;
        }

        .service-card-item,
        .explore-card{
            max-width: 420px;
            width: 100%;
            margin: 0 auto;
        }

        .service-card-image{
            height: 230px;
        }

        .explore-card-image{
            height: 190px;
        }

        .explore-services-heading h2,
        .faq-heading h2{
            font-size: 26px;
        }

        .upcoming-services-section{
            padding: 46px 0 38px;
        }

        .upcoming-services-heading h2{
            font-size: 28px;
        }

        .upcoming-heading-line{
            width: 165px;
            height: 3px;
        }

        .upcoming-auto-scroll-track{
            gap: 16px;
            animation-duration: 22s;
        }

        .upcoming-card{
            width: 270px;
            min-width: 270px;
            border-radius: 18px;
        }

        .upcoming-card-image{
            height: 180px;
        }

        .upcoming-card-body{
            padding: 16px 12px 18px;
        }

        .upcoming-card-body h3{
            font-size: 18px;
        }

        .faq-question{
            padding: 18px 16px;
            font-size: 16px;
        }

        .faq-answer p{
            padding: 0 16px 18px;
            font-size: 14px;
        }

        .floating-chatbot-btn{
            right: 14px;
            bottom: 82px;
            height: 48px;
            padding: 0 16px;
            font-size: 15px;
            border-radius: 14px;
            gap: 8px;
        }

        .floating-chatbot-btn svg{
            width: 20px;
            height: 20px;
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
            width: 100%;
            min-width: 100%;
        }

        .explore-btn{
            min-width: 100%;
        }

        .floating-chatbot-btn{
            right: 12px;
            left: auto;
            bottom: 78px;
        }
    }

   /* WhatsApp button */
.floating-chatbot-btn{
    position: fixed;
    right: 20px;
    bottom: 20px;   /* keep this lower */
    z-index: 9998;
}




@media (max-width: 767px){
    .floating-chatbot-btn{
        right: 14px;
        bottom: 16px;
    }

   
}

.hero-location-wrap{
    width: 320px;
    padding-right: 120px;
    position: relative;
}

.hero-location-wrap input{
    width: 100%;
    height: 100%;
    border: 0;
    outline: none;
    background: transparent;
    font-size: 13px;
    color: #7a7a7a;
    border-radius: 999px;
    padding: 0 125px 0 40px;
}

.hero-location-btn{
    position: absolute;
    right: 6px;
    top: 50%;
    transform: translateY(-50%);
    height: 38px;
    border: none;
    border-radius: 999px;
    padding: 0 14px;
    background: linear-gradient(180deg, #f58a3c, #f25c05);
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    white-space: nowrap;
}

.hero-location-btn:hover{
    background: linear-gradient(180deg, #ef7f2e, #de5304);
}

.location-status{
    margin-top: 14px;
    display: inline-block;
    padding: 10px 14px;
    border-radius: 12px;
    font-size: 13px;
    line-height: 1.5;
    background: rgba(255,255,255,0.10);
    color: #fff;
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.18);
    max-width: 520px;
}

@media (max-width: 767px){
    .hero-location-wrap{
        width: 100%;
        padding-right: 110px;
    }

    .hero-location-wrap input{
        padding-right: 115px;
    }

    .hero-location-btn{
        height: 34px;
        font-size: 11px;
        padding: 0 12px;
    }
}
</style>

<div class="home-page">

    <div class="hero-holder">
        <section class="hero-banner">
            <div class="hero-inner">
                <div class="hero-content">
                    <h1 class="hero-title">Which services are you<br>looking for today?</h1>

                    <div class="hero-search-row">
                        <div id="locationStatusBox" class="location-status" style="display:none;">
    Waiting for location...
</div>
                        <div class="hero-field hero-field-search">
                            <svg class="hero-icon-left" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M10 2a8 8 0 105.293 14.293l4.707 4.707 1.414-1.414-4.707-4.707A8 8 0 0010 2zm0 2a6 6 0 110 12 6 6 0 010-12z"/>
                            </svg>
                            <input type="text" placeholder="Search for Residential Architect">
                        </div>

                        <div class="hero-field hero-field-location hero-location-wrap">
                            <svg class="hero-icon-left" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M12 2C8.14 2 5 5.14 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.86-3.14-7-7-7zm0 9.5A2.5 2.5 0 1112 6a2.5 2.5 0 010 5.5z"/>
                            </svg>

                            <input
                                type="text"
                                id="hero_location_input"
                                placeholder="Select your location"
                                autocomplete="off"
                            >

                            <button type="button" class="hero-location-btn" onclick="getProperLocation()">
                                Use Current
                            </button>
                        </div>

                        <input type="hidden" id="location_json">
                        <input type="hidden" id="location_lat">
                        <input type="hidden" id="location_long">
                        <input type="hidden" id="location_pincode">
                        <input type="hidden" id="location_city_key">
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
                        <a href="{{ route('post', ['work_type_id' => 2]) }}" class="service-card-btn">Post Your Requirement</a>
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
                        <a href="{{ route('post', ['work_type_id' => 1]) }}" class="service-card-btn">Post Your Requirement</a>
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
                        <a href="{{ route('post', ['work_type_id' => 4]) }}" class="service-card-btn">Post Your Requirement</a>
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
                        <img src="{{ asset('images/explore/boq-estimation.png') }}" alt="BOQ/Estimation">
                    </div>
                    <div class="explore-card-body">
                        <h3>BOQ / Estimation</h3>
                        <p>Explore All Categories of BOQ / Estimation Services</p>
                        <a href="{{ $isCustomerLoggedIn ? $boqUrl : 'javascript:void(0)' }}"
                           class="explore-btn orange-btn {{ $isCustomerLoggedIn ? '' : 'open-customer-login-modal' }}"
                           data-redirect="{{ $boqUrl }}">
                            Get Started
                        </a>
                    </div>
                </div>

              

            </div>
        </div>
    </section>

    <section class="upcoming-services-section">
        <div class="upcoming-services-container">
            <div class="upcoming-services-heading">
                <h2>Our Upcoming Services</h2>
                <div class="upcoming-heading-line"></div>
            </div>

            <div class="upcoming-auto-scroll-wrap">
                <div class="upcoming-auto-scroll-track">
                    @foreach ([
                        ['legal-due-diligence.png','NA Support & Legal Due Diligence','orange-border'],
                        ['welding-fabrication.png','Welding & Fabrication','blue-border'],
                        ['structural-audit.png','Structural Audit','blue-border'],
                        ['machinery-on-hire.png','Machinery On Hire','orange-border'],
                        ['facade-services.png','Facade Services','blue-border'],
                        ['legal-due-diligence.png','NA Support & Legal Due Diligence','orange-border'],
                        ['welding-fabrication.png','Welding & Fabrication','blue-border'],
                        ['structural-audit.png','Structural Audit','blue-border'],
                        ['machinery-on-hire.png','Machinery On Hire','orange-border'],
                        ['facade-services.png','Facade Services','blue-border'],
                    ] as $upcoming)
                        <div class="upcoming-card {{ $upcoming[2] }}">
                            <span class="upcoming-badge">Coming Soon</span>
                            <div class="upcoming-card-image">
                                <img src="{{ asset('images/explore/' . $upcoming[0]) }}" alt="{{ $upcoming[1] }}">
                            </div>
                            <div class="upcoming-card-body">
                                <h3>{{ $upcoming[1] }}</h3>
                                <p>Launching soon on ConstructKaro</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="faq-section">
        <div class="faq-container">
            <div class="faq-heading">
                <h2>Frequently Asked Questions (FAQs)</h2>
                <div class="faq-heading-line">
                    <span class="faq-line-orange"></span>
                    <span class="faq-line-blue"></span>
                </div>
            </div>

            <div class="faq-accordion">
                <div class="faq-item active">
                    <button class="faq-question" type="button">
                        <span>1. How does ConstructKaro work?</span>
                        <span class="faq-icon">−</span>
                    </button>
                    <div class="faq-answer">
                        <p>ConstructKaro helps customers find the right construction-related service provider based on project needs. You submit your requirement, our team reviews it, and then connects you with suitable professionals or service partners.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" type="button">
                        <span>2. What construction services are available in Navi Mumbai?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>ConstructKaro helps customers with services such as architects, contractors, interior designers, survey services, testing services, BOQ / estimation, structural audit, facade services, and more depending on project requirements.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" type="button">
                        <span>3. Which areas does ConstructKaro serve in Maharashtra?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>ConstructKaro serves multiple locations in Maharashtra, including Mumbai, Navi Mumbai, Pune, Raigad, Thane, and nearby regions depending on service availability and project type.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" type="button">
                        <span>4. How can I hire an architect in Pune through ConstructKaro?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>You can hire an architect in Pune by submitting your project requirement through ConstructKaro. Our team reviews your needs and connects you with suitable architectural professionals for your project.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" type="button">
                        <span>5. Can I get a BOQ and cost estimation for my project in Raigad?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>Yes, ConstructKaro can help you get BOQ and estimation support for projects in Raigad. You can submit your requirement and our team will connect you with the right estimation support based on your project details.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" type="button">
                        <span>6. Can I hire interior designers through ConstructKaro in Mumbai and Pune?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>Yes, ConstructKaro helps connect customers with interior design professionals in Mumbai, Pune, and other major service areas based on project type, budget, and requirement.</p>
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
                We are working on launching this service shortly.
            </p>
            <button type="button" class="modal-btn primary-btn" id="okayComingSoonBtn">Okay</button>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//code.tidio.co/fi6ihkvtowtmsmkipuyc3vxfybpel3na.js" async></script>
<!-- <script 
      type="text/javascript"
      src="https://d3mkw6s8thqya7.cloudfront.net/integration-plugin.js"
      id="aisensy-wa-widget"
      widget-id="aabcqe"
    >
    </script> -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    $(document).ready(function () {

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

        function revealCards() {
            $('.reveal-card').each(function () {
                let top = $(this).offset().top;
                let windowBottom = $(window).scrollTop() + $(window).height() - 60;

                if (windowBottom > top) {
                    $(this).addClass('show');
                }
            });
        }

        $(window).on('scroll load', revealCards);

        $('.faq-question').on('click', function () {
            const currentItem = $(this).closest('.faq-item');
            const isActive = currentItem.hasClass('active');

            $('.faq-item').removeClass('active');
            $('.faq-icon').text('+');

            if (!isActive) {
                currentItem.addClass('active');
                currentItem.find('.faq-icon').text('−');
            }
        });

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

        const chatBtn = document.getElementById('openChatbotBtn');

        function openTidioWidget() {
            if (window.tidioChatApi) {
                try {
                    window.tidioChatApi.display(true);
                    window.tidioChatApi.open();
                    return true;
                } catch (e) {
                    console.log('Tidio API open failed:', e);
                }
            }

            const possibleLaunchers = [
                document.querySelector('[title="Tidio Chat"]'),
                document.querySelector('iframe[title*="chat"]'),
                document.querySelector('#tidio-chat iframe'),
                document.querySelector('[class*="tidio"]')
            ];

            for (let el of possibleLaunchers) {
                if (el) {
                    try {
                        el.click();
                        return true;
                    } catch (e) {}
                }
            }

            return false;
        }

        if (chatBtn) {
            chatBtn.addEventListener('click', function () {
                const opened = openTidioWidget();

                if (!opened) {
                    console.log('Tidio widget is not ready yet.');
                }
            });
        }
    });



    $(document).on('click', '#customerSendOtpBtn', function (e) {
    e.preventDefault();

    let mobile = $('#customer_mobile_number').val().trim();

    $('#customer_mobile_error').text('');
    $('#customer_otp_error').text('');
    $('#customer_otp_success_msg').text('');

    if (mobile === '') {
        $('#customer_mobile_error').text('Please enter mobile number');
        return;
    }

    if (!/^[0-9]{10}$/.test(mobile)) {
        $('#customer_mobile_error').text('Please enter valid 10 digit mobile number');
        return;
    }

    let $btn = $(this);
    $btn.prop('disabled', true).text('Sending...');

    $.ajax({
        url: "{{ route('customer.send.otp') }}",
        type: "POST",
        data: {
            mobile: mobile
        },
        success: function (response) {
            if (response.status === true) {
                $('#customerOtpSection').show();
                $('#customerVerifyOtpBtn').show();
                $('#customerSendOtpBtn').hide();
                $('#customer_otp_success_msg').text(response.message || 'OTP sent successfully');
            } else {
                $('#customer_mobile_error').text(response.message || 'Failed to send OTP');
            }
        },
        error: function (xhr) {
            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                if (xhr.responseJSON.errors.mobile) {
                    $('#customer_mobile_error').text(xhr.responseJSON.errors.mobile[0]);
                } else {
                    $('#customer_mobile_error').text('Validation failed');
                }
            } else if (xhr.status === 419) {
                $('#customer_mobile_error').text('Session expired. Please refresh the page.');
            } else if (xhr.status === 404) {
                $('#customer_mobile_error').text('OTP route not found.');
            } else {
                $('#customer_mobile_error').text('Something went wrong while sending OTP');
            }

            console.log(xhr.responseText);
        },
        complete: function () {
            $btn.prop('disabled', false).text('Get OTP');
        }
    });
});


$(document).on('click', '#customerVerifyOtpBtn', function (e) {
    e.preventDefault();

    let mobile = $('#customer_mobile_number').val().trim();
    let otp = $('#customer_otp_code').val().trim();
    let redirectUrl = $('#customer_redirect_url').val();

    $('#customer_mobile_error').text('');
    $('#customer_otp_error').text('');
    $('#customer_otp_success_msg').text('');

    if (otp === '') {
        $('#customer_otp_error').text('Please enter OTP');
        return;
    }

    if (!/^[0-9]{4,6}$/.test(otp)) {
        $('#customer_otp_error').text('Please enter valid OTP');
        return;
    }

    let $btn = $(this);
    $btn.prop('disabled', true).text('Verifying...');

    $.ajax({
        url: "{{ route('customer.verify.otp') }}",
        type: "POST",
        data: {
            mobile: mobile,
            otp: otp
        },
        success: function (response) {
            if (response.status === true) {
                $('#customer_otp_success_msg').text(response.message || 'OTP verified successfully');

                setTimeout(function () {
                    if (redirectUrl && redirectUrl !== '') {
                        window.location.href = redirectUrl;
                    } else {
                        window.location.reload();
                    }
                }, 800);
            } else {
                $('#customer_otp_error').text(response.message || 'Invalid OTP');
            }
        },
        error: function (xhr) {
            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                if (xhr.responseJSON.errors.otp) {
                    $('#customer_otp_error').text(xhr.responseJSON.errors.otp[0]);
                } else {
                    $('#customer_otp_error').text('Validation failed');
                }
            } else {
                $('#customer_otp_error').text('Something went wrong while verifying OTP');
            }

            console.log(xhr.responseText);
        },
        complete: function () {
            $btn.prop('disabled', false).text('Verify OTP');
        }
    });
});
</script>
<script>
    let watchId = null;
    let bestPosition = null;
    let finalLocationObject = null;

    function getProperLocation() {
        const statusBox = document.getElementById("locationStatusBox");
        const locationInput = document.getElementById("hero_location_input");

        statusBox.style.display = "inline-block";
        statusBox.innerHTML = "Getting accurate current location... please wait.";
        locationInput.value = "";
        document.getElementById("location_json").value = "";
        document.getElementById("location_lat").value = "";
        document.getElementById("location_long").value = "";
        document.getElementById("location_pincode").value = "";
        document.getElementById("location_city_key").value = "";

        finalLocationObject = null;

        if (!navigator.geolocation) {
            statusBox.innerHTML = "Geolocation is not supported by this browser.";
            return;
        }

        bestPosition = null;

        watchId = navigator.geolocation.watchPosition(
            function(position) {
                const accuracy = position.coords.accuracy;

                if (!bestPosition || accuracy < bestPosition.coords.accuracy) {
                    bestPosition = position;
                }

                statusBox.innerHTML =
                    "Improving accuracy...<br>" +
                    "Latitude: " + position.coords.latitude + "<br>" +
                    "Longitude: " + position.coords.longitude + "<br>" +
                    "Accuracy: " + Math.round(accuracy) + " meters";
            },
            function(error) {
                let msg = "Location error.";
                if (error.code === 1) msg = "Location permission denied.";
                if (error.code === 2) msg = "Location unavailable.";
                if (error.code === 3) msg = "Location request timed out.";
                statusBox.innerHTML = msg;
            },
            {
                enableHighAccuracy: true,
                timeout: 20000,
                maximumAge: 0
            }
        );

        setTimeout(async function() {
            if (watchId !== null) {
                navigator.geolocation.clearWatch(watchId);
            }

            if (!bestPosition) {
                statusBox.innerHTML = "Unable to get current location.";
                return;
            }

            await fetchFullLocation(bestPosition);
        }, 10000);
    }

    async function fetchFullLocation(position) {
        const statusBox = document.getElementById("locationStatusBox");
        const locationInput = document.getElementById("hero_location_input");

        const lat = position.coords.latitude;
        const long = position.coords.longitude;
        const accuracy = position.coords.accuracy;

        try {
            const response = await fetch(
                `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${long}&addressdetails=1&zoom=18`
            );

            const osmData = await response.json();
            const a = osmData.address || {};

            const properAddress = buildProperAddress(a, osmData.display_name);
            const cityName = a.city || a.town || a.village || "";
            const stateName = a.state || "";

            finalLocationObject = {
                city_key: null,
                cityKey: generateCityKey(cityName, stateName),
                customerId: "",
                countryKey: (a.country_code || "in").toUpperCase() === "IN" ? "IND" : (a.country_code || "").toUpperCase(),
                address: properAddress,
                homescreenAddress: {
                    ucAddress: {},
                    placeId: "",
                    address: properAddress,
                    formattedAddress: properAddress
                },
                locationDetails: {
                    lat: lat,
                    long: long
                },
                lat: lat,
                long: long,
                placeId: "",
                visibleBottomTabs: [],
                pincode: a.postcode || "",
                accuracy: accuracy,
                rawDisplayName: osmData.display_name || "",
                reverseGeocodeData: osmData
            };

            locationInput.value = properAddress;
            document.getElementById("location_json").value = JSON.stringify(finalLocationObject);
            document.getElementById("location_lat").value = lat;
            document.getElementById("location_long").value = long;
            document.getElementById("location_pincode").value = a.postcode || "";
            document.getElementById("location_city_key").value = finalLocationObject.cityKey;

            statusBox.innerHTML = "Proper location fetched successfully.";
        } catch (error) {
            statusBox.innerHTML = "Failed to fetch full location details.";
            console.error(error);
        }
    }

    function buildProperAddress(addressParts, fallbackDisplayName) {
        const locality =
            addressParts.suburb ||
            addressParts.neighbourhood ||
            addressParts.hamlet ||
            addressParts.quarter ||
            addressParts.residential ||
            addressParts.city_district ||
            "";

        const road = addressParts.road || "";
        const city =
            addressParts.city ||
            addressParts.town ||
            addressParts.village ||
            "";

        const state = addressParts.state || "";
        const postcode = addressParts.postcode || "";
        const country = addressParts.country || "India";

        const parts = [];

        if (road && road !== locality && road !== city) parts.push(road);
        if (locality && locality !== city) parts.push(locality);
        if (city) parts.push(city);
        if (state) parts.push(state);

        let address = parts.join(", ");

        if (postcode) {
            address += (address ? " " : "") + postcode;
        }

        if (country) {
            address += (address ? ", " : "") + country;
        }

        return address || fallbackDisplayName || "";
    }

    function generateCityKey(city, state) {
        const citySlug = slugify(city || "unknown");
        const stateSlug = slugify(state || "unknown");
        return `city_${citySlug}_(${stateSlug})_v2`;
    }

    function slugify(text) {
        return String(text)
            .toLowerCase()
            .trim()
            .replace(/\s+/g, "_")
            .replace(/[^\w_()]/g, "");
    }
</script>
@endsection