@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

@php
    $isCustomerLoggedIn = session('customer_logged_in');
@endphp

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
:root{
    --blue:#1f67ab;
    --blue-light:#2f89d0;
    --orange:#df6d1c;
    --orange-light:#ef8a39;
    --bg:#eeeeee;
    --text:#222;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:var(--bg);
    color:var(--text);
    overflow-x:hidden;
}

.home-page{
    background:#eeeeee;
}

/* HERO */
.hero-banner{
    width:100vw;
    height:340px;
    margin-left:calc(50% - 50vw);
    background-image:
        linear-gradient(90deg,rgba(0,0,0,.88),rgba(0,0,0,.70),rgba(0,0,0,.12)),
        url("{{ asset('images/banner.jpg') }}");
    background-size:cover;
    background-position:center;
    display:flex;
    align-items:center;
}

.hero-inner{
    width:92%;
    max-width:1320px;
    margin:0 auto;
}

.hero-content{
    max-width:620px;
}

.hero-title{
    color:#fff;
    font-size:42px;
    font-weight:900;
    line-height:1.1;
    margin-bottom:10px;
}

.hero-subtitle{
    color:#fff;
    font-size:22px;
    font-weight:600;
    margin-bottom:14px;
}

.hero-description{
    color:#fff;
    font-size:16px;
    line-height:1.5;
    margin-bottom:26px;
}

.hero-field-search{
    width:100%;
    max-width:500px;
    height:52px;
    background:#f2f2f2;
    border-radius:16px;
    display:flex;
    align-items:center;
    padding:0 18px;
}

.hero-icon-left{
    width:26px;
    height:26px;
    color:#1f78c8;
    margin-right:12px;
}

.hero-field-search input{
    width:100%;
    height:100%;
    border:none;
    outline:none;
    background:transparent;
    font-size:15px;
}

/* TRUST */
.ck-trust-section{
    padding:70px 0;
}

.ck-trust-container{
    width:92%;
    max-width:1180px;
    margin:0 auto;
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:28px;
    text-align:center;
}

.ck-trust-item{
    display:flex;
    flex-direction:column;
    align-items:center;
}

.ck-trust-icon-img{
    width:64px;
    height:64px;
    object-fit:contain;
    margin-bottom:10px;
}

.ck-trust-title{
    font-size:18px;
    font-weight:800;
    line-height:1.25;
    color:#000;
}

/* MAIN SERVICES */
.ck-services-section{
    padding:80px 0 55px;
}

.ck-services-container,
.explore-services-container,
.ck-guide-container,
.faq-container{
    width:92%;
    max-width:1500px;
    margin:0 auto;
}

.ck-services-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:110px;
}

.ck-service-card{
    background:#fff;
    border:1.5px solid #111;
    border-radius:18px;
    box-shadow:0 5px 12px rgba(0,0,0,.22);
    text-align:center;
    height:288px;
    padding:0 16px 22px;
}

.ck-service-image{
    width:250px;
    height:192px;
    margin:-55px auto 20px;
    border-radius:16px;
    overflow:hidden;
    border:1.5px solid #111;
    box-shadow:0 4px 10px rgba(0,0,0,.22);
}

.ck-service-image img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.ck-service-title{
    color:var(--orange);
    font-size:22px;
    font-weight:800;
}

.ck-service-line{
    width:150px;
    height:1px;
    background:#555;
    margin:5px auto 12px;
}

.ck-service-text{
    color:#555;
    font-size:10px;
    margin-bottom:14px;
    font-style:oblique;
}

.ck-service-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    width:241px;
    height:40px;
    border-radius:10px;
    background:linear-gradient(180deg,#2f89d0,#1d6eb3);
    color:#fff;
    text-decoration:none;
    font-size:14px;
    font-weight:800;
}

/* MORE SERVICES */
.explore-services-section{
    padding:45px 0 55px;
}

.explore-services-heading{
    text-align:center;
    margin-bottom:55px;
}

.explore-services-heading h2{
    font-size:42px;
    font-weight:900;
    color:#1f1f1f;
}

.heading-line{
    width:240px;
    height:4px;
    margin:12px auto 0;
    border-radius:50px;
    background:linear-gradient(90deg,#ef7d2d,#2f78bf);
}

.explore-services-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:110px;
}

.explore-card{
    background:#fff;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 5px 12px rgba(0,0,0,.22);
    text-align:center;
}

.orange-card{
    border:2px solid #ef7d2d;
}

.blue-card{
    border:2px solid #2f78bf;
}

.explore-card-image{
    height:220px;
    overflow:hidden;
}

.explore-card-image img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.explore-card-body{
    padding:18px 18px 20px;
}

.explore-card-body h3{
    font-size:27px;
    font-weight:900;
    margin-bottom:14px;
}

.orange-card h3{
    color:#df6d1c;
}

.blue-card h3{
    color:#1f67ab;
}

.explore-card-body p{
    font-size:14px;
    color:#111;
    margin-bottom:18px;
}

.explore-btn{
    width:260px;
    height:46px;
    border-radius:12px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    font-size:16px;
    font-weight:800;
    text-decoration:none;
}

.orange-btn{
    background:linear-gradient(180deg,#ef8a39,#df6d1c);
}

.blue-btn{
    background:linear-gradient(180deg,#2f89d0,#1d6eb3);
}

/* GUIDE SECTION */
.ck-guide-section{
    padding:35px 0;
}

.ck-guide-container{
    display:grid;
    grid-template-columns:0.8fr 1.45fr;
    gap:24px;
    align-items:stretch;
}

.ck-guide-image-box{
    height:280px;
    border:3px solid #f26f21;
    border-left:6px solid #1f78c8;
    border-radius:16px;
    overflow:hidden;
    box-shadow:0 8px 12px rgba(0,0,0,.25);
}

.ck-guide-image-box img{
    width:100%;
    height:100%;
    object-fit:cover;
    object-position:center center;
    display:block;
}

.ck-guide-content-box{
    min-height:280px;
    border-radius:16px;
    overflow:hidden;
    background:
        /* linear-gradient(rgba(31,103,171,.88),rgba(31,103,171,.88)), */
        url("{{ asset('images/logo/Confused.png') }}");
    background-size:cover;
    background-position:center;
    box-shadow:0 8px 12px rgba(0,0,0,.25);
    padding:32px 38px;
    color:#fff;
    text-align:center;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
}

.ck-guide-title{
    font-size:28px;
    font-weight:900;
    line-height:1.25;
    margin-bottom:18px;
}

.ck-guide-text{
    font-size:19px;
    line-height:1.35;
    margin-bottom:30px;
}

.ck-guide-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    min-width:360px;
    height:50px;
    border-radius:10px;
    background:#fff;
    color:#222;
    text-decoration:none;
    font-size:21px;
    font-weight:900;
    box-shadow:0 5px 10px rgba(0,0,0,.35);
}

/* UPCOMING */
.upcoming-services-section{
    padding:70px 0 60px;
    background:linear-gradient(180deg,#f7f7f7,#ececec);
    overflow:hidden;
}

.upcoming-services-heading{
    text-align:center;
    margin-bottom:34px;
}

.upcoming-services-heading h2{
    font-size:42px;
    font-weight:800;
    color:#1f1f1f;
}

.upcoming-heading-line{
    width:220px;
    height:4px;
    margin:14px auto 0;
    border-radius:999px;
    background:linear-gradient(90deg,#ef7d2d,#2f78bf);
}

.upcoming-auto-scroll-wrap{
    overflow:hidden;
    padding:8px 0;
}

.upcoming-auto-scroll-track{
    display:flex;
    gap:24px;
    width:max-content;
    animation:upcomingAutoScroll 30s linear infinite;
}

@keyframes upcomingAutoScroll{
    0%{transform:translateX(0);}
    100%{transform:translateX(-50%);}
}

.upcoming-card{
    width:390px;
    min-width:390px;
    background:#fff;
    border-radius:24px;
    overflow:hidden;
    box-shadow:0 12px 28px rgba(0,0,0,.12);
    position:relative;
}

.upcoming-card.orange-border{
    border:2px solid #ef7d2d;
}

.upcoming-card.blue-border{
    border:2px solid #2f78bf;
}

.upcoming-badge{
    position:absolute;
    top:14px;
    left:14px;
    z-index:2;
    padding:7px 12px;
    border-radius:999px;
    background:rgba(17,24,39,.86);
    color:#fff;
    font-size:11px;
    font-weight:700;
}

.upcoming-card-image{
    height:250px;
}

.upcoming-card-image img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.upcoming-card-body{
    padding:22px 18px 24px;
    text-align:center;
}

.upcoming-card-body h3{
    font-size:22px;
    font-weight:800;
}

.upcoming-card-body p{
    font-size:13px;
    color:#666;
    margin-top:8px;
}

/* FAQ */
.faq-section{
    padding:70px 0 60px;
    background:#e9e9e9;
}

.faq-container{
    max-width:1000px;
}

.faq-heading{
    text-align:center;
    margin-bottom:34px;
}

.faq-heading h2{
    font-size:32px;
    font-weight:800;
}

.faq-heading-line{
    display:flex;
    justify-content:center;
    margin-top:10px;
}

.faq-line-orange,
.faq-line-blue{
    width:110px;
    height:3px;
    display:block;
}

.faq-line-orange{
    background:#e97827;
    border-radius:20px 0 0 20px;
}

.faq-line-blue{
    background:#2f78bf;
    border-radius:0 20px 20px 0;
}

.faq-accordion{
    display:flex;
    flex-direction:column;
    gap:16px;
}

.faq-item{
    background:#fff;
    border-radius:14px;
    box-shadow:0 4px 10px rgba(0,0,0,.12);
    overflow:hidden;
}

.faq-question{
    width:100%;
    border:none;
    background:#fff;
    display:flex;
    justify-content:space-between;
    gap:16px;
    text-align:left;
    padding:22px 24px;
    font-size:18px;
    font-weight:800;
    cursor:pointer;
}

.faq-icon{
    color:var(--blue);
    font-size:24px;
    font-weight:700;
}

.faq-answer{
    max-height:0;
    overflow:hidden;
    transition:.3s ease;
}

.faq-item.active .faq-answer{
    max-height:300px;
}

.faq-answer p{
    padding:0 24px 22px;
    color:#555;
    font-size:15px;
    line-height:1.7;
}

/* MODAL */
.custom-modal-overlay{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.55);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:99999;
    padding:20px;
}

.custom-modal-overlay.active{
    display:flex;
}

.custom-modal-box{
    width:100%;
    max-width:430px;
    background:#fff;
    border-radius:18px;
    padding:26px 22px;
    position:relative;
}

.custom-modal-close{
    position:absolute;
    top:10px;
    right:14px;
    border:none;
    background:transparent;
    font-size:28px;
    cursor:pointer;
}

.custom-modal-header h3{
    font-size:26px;
    color:#1c2c3e;
}

.custom-modal-header p{
    font-size:14px;
    color:#666;
    margin:6px 0 22px;
}

.form-group{
    margin-bottom:16px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-size:14px;
    font-weight:600;
}

.custom-input{
    width:100%;
    height:48px;
    border:1px solid #d8d8d8;
    border-radius:12px;
    padding:0 14px;
    font-size:14px;
    outline:none;
}

.error-text{
    display:block;
    margin-top:6px;
    font-size:12px;
    color:#dc2626;
}

.otp-success-msg{
    font-size:13px;
    color:#15803d;
    margin-top:8px;
}

.custom-modal-actions{
    margin-top:14px;
}

.modal-btn{
    width:100%;
    border:none;
    border-radius:12px;
    padding:12px 18px;
    font-size:14px;
    font-weight:700;
    cursor:pointer;
}

.primary-btn{
    background:linear-gradient(180deg,#f58a3c,#f25c05);
    color:#fff;
}

.verify-btn{
    background:linear-gradient(180deg,#2f80c8,#1f67ab);
    color:#fff;
}

/* LINKS HOVER */
.ck-service-btn:hover,
.explore-btn:hover{
    color:#fff;
    text-decoration:none;
}

.ck-guide-btn:hover{
    color:#222;
    text-decoration:none;
}

/* RESPONSIVE */
@media(max-width:991px){
    .ck-trust-container{
        grid-template-columns:repeat(2,1fr);
    }

    .ck-services-grid,
    .explore-services-grid,
    .ck-guide-container{
        grid-template-columns:1fr;
        gap:80px;
    }

    .ck-service-card,
    .explore-card{
        max-width:470px;
        margin:0 auto;
    }

    .ck-guide-container{
        gap:24px;
    }
}

@media(max-width:576px){
    .hero-banner{
        height:310px;
    }

    .hero-title{
        font-size:30px;
    }

    .hero-subtitle{
        font-size:18px;
    }

    .hero-description{
        font-size:14px;
    }

    .ck-trust-title{
        font-size:15px;
    }

    .ck-services-section{
        padding:70px 0 40px;
    }

    .ck-service-card{
        height:auto;
    }

    .ck-service-image{
        width:92%;
        height:210px;
    }

    .ck-service-btn,
    .explore-btn,
    .ck-guide-btn{
        width:100%;
        min-width:100%;
    }

    .explore-services-heading h2,
    .upcoming-services-heading h2{
        font-size:32px;
    }

    .explore-card-image{
        height:190px;
    }

    .ck-guide-title{
        font-size:24px;
    }

    .ck-guide-text{
        font-size:16px;
    }

    .upcoming-card{
        width:270px;
        min-width:270px;
    }

    .upcoming-card-image{
        height:180px;
    }
}

.ck-vendor-section {
    background: #eeeeee;
    padding: 45px 0;
}

.ck-vendor-container {
    width: 92%;
    max-width: 1500px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 28px;
    align-items: stretch;
}

.ck-vendor-content-box {
    min-height: 300px;
    border-radius: 16px;
    background:
        linear-gradient(rgba(223,109,28,0.92), rgba(223,109,28,0.92)),
        url("{{ asset('images/logo/Confused.png') }}");
    background-size: cover;
    background-position: center;
    box-shadow: 0 8px 12px rgba(0,0,0,0.25);
    padding: 42px 38px;
    text-align: center;
    color: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.ck-vendor-title {
    font-size: 30px;
    font-weight: 900;
    line-height: 1.25;
    margin: 0 0 24px;
}
.ck-city-title {
    font-size: 30px;
    font-weight: 900;
    line-height: 1.25;
    margin: 0 0 24px;
}
.ck-vendor-text {
    font-size: 22px;
    line-height: 1.35;
    margin: 0 0 28px;
    max-width: 720px;
}

.ck-vendor-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 250px;
    height: 52px;
    padding: 0 26px;
    border-radius: 10px;
    background: #fff;
    color: #2b2b2b;
    text-decoration: none;
    font-size: 22px;
    font-weight: 900;
    box-shadow: 0 5px 10px rgba(0,0,0,0.35);
}

.ck-vendor-btn:hover {
    color: #2b2b2b;
    text-decoration: none;
}

.ck-vendor-image-box {
    height: 300px;
    border: 3px solid #f26f21;
    border-left: 6px solid #1f78c8;
    border-right: 6px solid #1f78c8;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 12px rgba(0,0,0,0.25);
    background: #fff;
}

.ck-vendor-image-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
}

@media (max-width: 991px) {
    .ck-vendor-container {
        grid-template-columns: 1fr;
    }

    .ck-vendor-content-box {
        min-height: 260px;
        padding: 34px 24px;
    }

    .ck-vendor-title {
        font-size: 26px;
    }

    .ck-vendor-text {
        font-size: 18px;
    }

    .ck-vendor-image-box {
        height: 260px;
    }
}

@media (max-width: 576px) {
    .ck-vendor-section {
        padding: 35px 0;
    }

    .ck-vendor-title {
        font-size: 23px;
    }

    .ck-vendor-text {
        font-size: 16px;
    }

    .ck-vendor-btn {
        width: 100%;
        min-width: 100%;
        font-size: 18px;
    }

    .ck-vendor-image-box {
        height: 220px;
    }
}

.ck-vendor-content-box {
    position: relative;
    min-height: 300px;
    border-radius: 16px;

    background:
        /* linear-gradient(rgba(223,109,28,0.92), rgba(223,109,28,0.92)), */
        url("{{ asset('images/logo/area.png') }}"); /* 👈 your bg image */

    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;

    box-shadow: 0 8px 12px rgba(0,0,0,0.25);
    padding: 42px 38px;
    text-align: center;
    color: #fff;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}


.ck-city-section {
    padding: 40px 0;
    background: #f4f4f4;
}

.ck-city-grid {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 40px;
    flex-wrap: wrap;
}

.ck-city-card {
    width: 210px;
    height: auto;
    background: transparent;
    box-shadow: none;
    border-radius: 0;
    padding: 0;
}

.ck-city-card img {
    width: 100%;
    height: auto;
    object-fit: contain;
    display: block;
}

.ck-all-services-section {
    background: #eeeeee;
    padding: 35px 0 60px;
    text-align: center;
}

.ck-all-services-title {
    font-size: 42px;
    font-weight: 900;
    color: #1f1f1f;
    margin: 0;
}

.ck-all-services-line {
    width: 260px;
    height: 4px;
    margin: 12px auto 45px;
    border-radius: 50px;
    background: linear-gradient(90deg, #ef7d2d, #2f78bf);
}

.ck-service-slider {
    width: 92%;
    max-width: 940px;
    height: 420px;
    margin: 0 auto;
    display: flex;
    gap: 8px;
    overflow: hidden;
}

.ck-slide {
    flex: 1;
    min-width: 78px;
    border-radius: 14px;
    overflow: hidden;
    position: relative;
    box-shadow: 0 6px 10px rgba(0,0,0,0.25);
    transition: all 0.45s ease;
    cursor: pointer;
}

.ck-slide.active {
    flex: 3.1;
}

.ck-slide img {
    width: 106%;
    height: 100%;
    object-fit: cover;
    display: block;
    filter: grayscale(100%);
}

.ck-slide.active img {
    filter: grayscale(0%);
}

.ck-slide-label {
    position: absolute;
    left: 12px;
    bottom: 18px;
    writing-mode: vertical-rl;
    transform: rotate(180deg);
    background: #1f78c8;
    color: #fff;
    padding: 12px 8px;
    border-radius: 8px;
    font-size: 18px;
    font-weight: 900;
}

.ck-slide.active .ck-slide-label {
    writing-mode: initial;
    transform: none;
    left: 50%;
    bottom: 18px;
    translate: -50% 0;
    padding: 8px 35px;
    font-size: 15px;
}

.ck-slide-btn {
    display: none;
}

.ck-slide.active .ck-slide-btn {
    display: inline-flex;
    position: absolute;
    left: 50%;
    bottom: 18px;
    translate: -50% 0;
    width: 180px;
    height: 34px;
    align-items: center;
    justify-content: center;
    border-radius: 999px;
    background: linear-gradient(180deg, #2f89d0, #1d6eb3);
    color: #fff;
    text-decoration: none;
    font-size: 15px;
    font-weight: 800;
}

@media (max-width: 768px) {
    .ck-service-slider {
        height: auto;
        flex-direction: column;
    }

    .ck-slide,
    .ck-slide.active {
        flex: unset;
        height: 260px;
    }

    .ck-slide img {
        filter: grayscale(0%);
    }

    .ck-slide-label {
        writing-mode: initial;
        transform: none;
        left: 15px;
        bottom: 15px;
    }
}

.ck-testimonial-section {
    background: #eeeeee;
    padding: 55px 0 65px;
}

.ck-testimonial-heading {
    text-align: center;
    margin-bottom: 85px;
}

.ck-testimonial-heading h2 {
    font-size: 42px;
    font-weight: 900;
    color: #1f1f1f;
    margin: 0;
}

.ck-testimonial-line {
    width: 460px;
    height: 4px;
    margin: 12px auto 0;
    border-radius: 50px;
    background: linear-gradient(90deg, #ef7d2d, #2f78bf);
}

.ck-testimonial-grid {
    width: 92%;
    max-width: 1500px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 28px;
}

.ck-testimonial-card {
    position: relative;
    background: #fff;
    border: 1.5px solid #1f67ab;
    border-radius: 18px;
    padding: 82px 24px 24px;
    text-align: center;
    min-height: 255px;
}

.ck-testimonial-img {
    position: absolute;
    top: -62px;
    left: 50%;
    transform: translateX(-50%);
    width: 112px;
    height: 112px;
    border-radius: 50%;
    overflow: hidden;
    background: #ddd;
}

.ck-testimonial-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.ck-testimonial-name {
    font-size: 20px;
    font-weight: 800;
    color: #2b2b2b;
    margin: 0 0 6px;
}

.ck-testimonial-role {
    font-size: 15px;
    color: #555;
    margin: 0 0 12px;
}

.ck-stars {
    color: #ffb800;
    font-size: 28px;
    line-height: 1;
    margin-bottom: 16px;
    letter-spacing: 2px;
}

.ck-testimonial-text {
    font-size: 13px;
    line-height: 1.45;
    color: #666;
    margin: 0;
}

@media (max-width: 1200px) {
    .ck-testimonial-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 85px 28px;
    }
}

@media (max-width: 576px) {
    .ck-testimonial-heading h2 {
        font-size: 30px;
    }

    .ck-testimonial-line {
        width: 260px;
    }

    .ck-testimonial-grid {
        grid-template-columns: 1fr;
        gap: 85px;
    }

    .ck-testimonial-card {
        padding: 78px 18px 22px;
    }
}
</style>

<div class="home-page">

    <section class="hero-banner">
        <div class="hero-inner">
            <div class="hero-content">
                <h1 class="hero-title">Plan. Hire. Execute</h1>
                <p class="hero-subtitle">We manage your construction end-to-end</p>
                <p class="hero-description">From planning and design to execution and quality checks everything handled through us</p>

                <div class="hero-field-search">
                    <svg class="hero-icon-left" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M10 2a8 8 0 105.293 14.293l4.707 4.707 1.414-1.414-4.707-4.707A8 8 0 0010 2zm0 2a6 6 0 110 12 6 6 0 010-12z"/>
                    </svg>
                    <input type="text" placeholder="Search for Residential Architect">
                </div>
            </div>
        </div>
    </section>

    <section class="ck-trust-section">
        <div class="ck-trust-container">
            <div class="ck-trust-item">
                <img src="{{ asset('images/logo/safety-helmet.png') }}" class="ck-trust-icon-img" alt="">
                <p class="ck-trust-title">Built by 20+ years<br>construction experience</p>
            </div>

            <div class="ck-trust-item">
                <img src="{{ asset('images/logo/verify.png') }}" class="ck-trust-icon-img" alt="">
                <p class="ck-trust-title">Verified<br>vendors only</p>
            </div>

            <div class="ck-trust-item">
                <img src="{{ asset('images/logo/onground.png') }}" class="ck-trust-icon-img" alt="">
                <p class="ck-trust-title">On-ground<br>execution support</p>
            </div>

            <div class="ck-trust-item">
                <img src="{{ asset('images/logo/transpernt.png') }}" class="ck-trust-icon-img" alt="">
                <p class="ck-trust-title">Transparent<br>pricing approach</p>
            </div>
        </div>
    </section>

    <section class="ck-services-section">
        <div class="ck-services-container">
            <div class="ck-services-grid">

                <div class="ck-service-card">
                    <div class="ck-service-image">
                        <img src="{{ asset('images/b1.png') }}" alt="Architect">
                    </div>
                    <h3 class="ck-service-title">Architect</h3>
                    <div class="ck-service-line"></div>
                    <p class="ck-service-text">Post your requirements and get your quote within 24 hours.</p>
                    <a href="{{ route('post', ['work_type_id' => 2]) }}" class="ck-service-btn">Post Your Requirement</a>
                </div>

                <div class="ck-service-card">
                    <div class="ck-service-image">
                        <img src="{{ asset('images/b2.png') }}" alt="Contractor">
                    </div>
                    <h3 class="ck-service-title">Contractor</h3>
                    <div class="ck-service-line"></div>
                    <p class="ck-service-text">Post your requirements and get your quote within 24 hours.</p>
                    <a href="{{ route('post', ['work_type_id' => 1]) }}" class="ck-service-btn">Post Your Requirement</a>
                </div>

                <div class="ck-service-card">
                    <div class="ck-service-image">
                        <img src="{{ asset('images/b3.png') }}" alt="Interior Designer">
                    </div>
                    <h3 class="ck-service-title">Interior Designer</h3>
                    <div class="ck-service-line"></div>
                    <p class="ck-service-text">Post your requirements and get your quote within 24 hours.</p>
                    <a href="{{ route('post', ['work_type_id' => 4]) }}" class="ck-service-btn">Post Your Requirement</a>
                </div>

            </div>
        </div>
    </section>

    <section class="explore-services-section">
        <div class="explore-services-container">
            <div class="explore-services-heading">
                <h2>Explore More Services</h2>
                <div class="heading-line"></div>
            </div>

            <div class="explore-services-grid">

                <div class="explore-card orange-card">
                    <div class="explore-card-image">
                        <img src="{{ asset('images/explore/survey-services.png') }}" alt="Survey Services">
                    </div>
                    <div class="explore-card-body">
                        <h3>Survey Services</h3>
                        <p>Explore All Categories of Survey Services</p>
                        <a href="{{ route('customer.survey') }}" class="explore-btn orange-btn">Get Started</a>
                    </div>
                </div>

                <div class="explore-card blue-card">
                    <div class="explore-card-image">
                        <img src="{{ asset('images/explore/testing-services.png') }}" alt="Testing Services">
                    </div>
                    <div class="explore-card-body">
                        <h3>Testing Services</h3>
                        <p>Explore All Categories of Testing Services</p>
                        <a href="{{ route('customer.testing') }}" class="explore-btn blue-btn">Get Started</a>
                    </div>
                </div>

                <div class="explore-card orange-card">
                    <div class="explore-card-image">
                        <img src="{{ asset('images/explore/boq-estimation.png') }}" alt="BOQ/Estimation">
                    </div>
                    <div class="explore-card-body">
                        <h3>BOQ / Estimation</h3>
                        <p>Explore All Categories of BOQ / Estimation Services</p>
                        <a href="{{ route('customer.boq') }}" class="explore-btn orange-btn">Get Started</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="ck-guide-section">
        <div class="ck-guide-container">
            <div class="ck-guide-image-box">
                <img src="{{ asset('images/logo/confused-customer.jpg') }}" alt="Confused Customer">
            </div>

            <div class="ck-guide-content-box">
                <h2 class="ck-guide-title">
                    Confused About Which Construction Service or<br>
                    Package to Choose for Your Project?
                </h2>

                <p class="ck-guide-text">
                    From initial planning to complete project execution, ConstructKaro<br>
                    guides you with the right services at every stage.
                </p>

                <a href="javascript:void(0)" class="ck-guide-btn open-customer-login-modal">
                    Let ConstructKaro Guide Me
                </a>
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
<section class="ck-vendor-section">
    <div class="ck-vendor-container">

        <div class="ck-vendor-content-box">
            <h2 class="ck-vendor-title">
                Get real construction projects in your area
            </h2>

            <p class="ck-vendor-text">
                Join ConstructKaro and start receiving verified leads.
                No commission, no listing fees.
            </p>

            <a href="#" class="ck-vendor-btn">
                Join as Vendor
            </a>
        </div>

        <div class="ck-vendor-image-box">
            <img src="{{ asset('images/logo/a1.jpg') }}" alt="Construction Projects">
        </div>

    </div>
</section>
<section class="ck-city-section">
     <h2 class="ck-city-title">
                Cities We Serve
            </h2>
   
    <div class="ck-city-grid">
        <div class="ck-city-card">
            <img src="{{ asset('images/logo/navi-mumbai.png') }}" alt="Navi Mumbai">
        </div>

        <div class="ck-city-card">
            <img src="{{ asset('images/logo/mumbai.png') }}" alt="Mumbai">
        </div>

        <div class="ck-city-card">
            <img src="{{ asset('images/logo/thane.png') }}" alt="Thane">
        </div>

        <div class="ck-city-card">
            <img src="{{ asset('images/logo/pune.png') }}" alt="Pune">
        </div>

        <div class="ck-city-card">
            <img src="{{ asset('images/logo/raigad.png') }}" alt="Raigad">
        </div>
    </div>
</section>
 
<section class="ck-all-services-section">
    <h2 class="ck-all-services-title">Explore All Our Services</h2>
    <div class="ck-all-services-line"></div>

    <div class="ck-service-slider">

        <div class="ck-slide">
            <img src="{{ asset('images/services/contractor.png') }}" alt="Contractor">
            <!-- <div class="ck-slide-label">Contractor</div> -->
        </div>

        <div class="ck-slide">
            <img src="{{ asset('images/services/architect.png') }}" alt="Architect">
            <!-- <div class="ck-slide-label">Architect</div> -->
        </div>

        <div class="ck-slide active">
            <img src="{{ asset('images/services/interior.png') }}" alt="Interior Designing">
            <!-- <a href="#" class="ck-slide-btn">Know More</a> -->
        </div>

        <div class="ck-slide">
            <img src="{{ asset('images/services/survey.png') }}" alt="Survey">
            <!-- <div class="ck-slide-label">Survey</div> -->
        </div>

        <div class="ck-slide">
            <img src="{{ asset('images/services/testing.png') }}" alt="Testing">
            <!-- <div class="ck-slide-label">Testing</div> -->
        </div>

        <div class="ck-slide">
            <img src="{{ asset('images/services/boq.png') }}" alt="BOQ">
            <!-- <div class="ck-slide-label">BOQ</div> -->
        </div>

    </div>
</section>


<section class="ck-testimonial-section">
    <div class="ck-testimonial-heading">
        <h2>What People Say About Us</h2>
        <div class="ck-testimonial-line"></div>
    </div>

    <div class="ck-testimonial-grid">

        <div class="ck-testimonial-card">
            <div class="ck-testimonial-img">
                <img src="{{ asset('images/testimonials/client1.png') }}" alt="Client">
            </div>

            <h3 class="ck-testimonial-name">Patil Infra & Realtors Pvt. Ltd.</h3>
            <p class="ck-testimonial-role">Real Estate Developer | Khopoli</p>

            <div class="ck-stars">★★★★☆</div>

            <p class="ck-testimonial-text">
                For our ongoing building projects, finding dependable contractors on time is always a challenge.
                Through ConstructKaro, we were able to identify suitable labour contractors quickly,
                improving our execution efficiency.
            </p>
        </div>

        <div class="ck-testimonial-card">
            <div class="ck-testimonial-img">
                <img src="{{ asset('images/testimonials/client2.png') }}" alt="Client">
            </div>

            <h3 class="ck-testimonial-name">Dinesh Shirke</h3>
            <p class="ck-testimonial-role">Home Owner | Nagothane, Maharashtra</p>

            <div class="ck-stars">★★★★☆</div>

            <p class="ck-testimonial-text">
                I was planning to construct a bungalow and didn’t know how to start.
                I posted my requirement on ConstructKaro and received genuine responses.
                One lead converted into actual work and my bungalow construction has started.
            </p>
        </div>

        <div class="ck-testimonial-card">
            <div class="ck-testimonial-img">
                <img src="{{ asset('images/testimonials/client3.png') }}" alt="Client">
            </div>

            <h3 class="ck-testimonial-name">Omkar Vidhate</h3>
            <p class="ck-testimonial-role">Architect | Pune</p>

            <div class="ck-stars">★★★☆☆</div>

            <p class="ck-testimonial-text">
                After leaving my job, getting independent projects was challenging.
                Through ConstructKaro, I received architectural planning and interior design work
                that matched my skills perfectly.
            </p>
        </div>

        <div class="ck-testimonial-card">
            <div class="ck-testimonial-img">
                <img src="{{ asset('images/testimonials/client4.png') }}" alt="Client">
            </div>

            <h3 class="ck-testimonial-name">Sanket Asgaonkar</h3>
            <p class="ck-testimonial-role">Land Surveyor & Drone Survey Specialist | Raigad</p>

            <div class="ck-stars">★★★★☆</div>

            <p class="ck-testimonial-text">
                I had the skills and equipment, but finding the right drone survey clients was difficult.
                Through ConstructKaro, I received a drone survey requirement in Poladpur that perfectly matched my profile.
            </p>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
});

$(document).ready(function () {
    $(document).on('click', '.open-customer-login-modal', function () {
        let redirectUrl = $(this).data('redirect') || '';

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

    $('.faq-question').on('click', function () {
        const item = $(this).closest('.faq-item');
        const active = item.hasClass('active');

        $('.faq-item').removeClass('active');
        $('.faq-icon').text('+');

        if (!active) {
            item.addClass('active');
            item.find('.faq-icon').text('−');
        }
    });
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

    let btn = $(this);
    btn.prop('disabled', true).text('Sending...');

    $.ajax({
        url: "{{ route('customer.send.otp') }}",
        type: "POST",
        data: { mobile: mobile },
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
        error: function () {
            $('#customer_mobile_error').text('Something went wrong while sending OTP');
        },
        complete: function () {
            btn.prop('disabled', false).text('Get OTP');
        }
    });
});

$(document).on('click', '#customerVerifyOtpBtn', function (e) {
    e.preventDefault();

    let mobile = $('#customer_mobile_number').val().trim();
    let otp = $('#customer_otp_code').val().trim();
    let redirectUrl = $('#customer_redirect_url').val();

    $('#customer_otp_error').text('');
    $('#customer_otp_success_msg').text('');

    if (otp === '') {
        $('#customer_otp_error').text('Please enter OTP');
        return;
    }

    let btn = $(this);
    btn.prop('disabled', true).text('Verifying...');

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
                    if (redirectUrl) {
                        window.location.href = redirectUrl;
                    } else {
                        window.location.reload();
                    }
                }, 700);
            } else {
                $('#customer_otp_error').text(response.message || 'Invalid OTP');
            }
        },
        error: function () {
            $('#customer_otp_error').text('Something went wrong while verifying OTP');
        },
        complete: function () {
            btn.prop('disabled', false).text('Verify OTP');
        }
    });
});
</script>
<script>
document.querySelectorAll('.ck-slide').forEach(function(slide) {
    slide.addEventListener('mouseenter', function() {
        document.querySelectorAll('.ck-slide').forEach(function(item) {
            item.classList.remove('active');
        });
        slide.classList.add('active');
    });
});
</script>
@endsection