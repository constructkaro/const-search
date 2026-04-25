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
    --blue-light:#2f80c8;
    --orange:#df6d1c;
    --bg:#f4f4f4;
    --text:#333;
    --muted:#666;
    --border:#ddd;
    --shadow:0 10px 30px rgba(0,0,0,0.08);
    --radius-lg:22px;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    background:var(--bg);
    color:var(--text);
    overflow-x:hidden;
}

.home-page{
    background:var(--bg);
}

/* HERO SECTION */
.hero-holder{
    width:100%;
    overflow:hidden;
}

.hero-banner{
    position:relative;
    width:100vw;
    height:340px;
    min-height:340px;
    margin-left:calc(50% - 50vw);
    margin-right:calc(50% - 50vw);
    display:flex;
    align-items:center;
    overflow:hidden;
    background-image:
        linear-gradient(
            90deg,
            rgba(0,0,0,0.88) 0%,
            rgba(0,0,0,0.74) 30%,
            rgba(0,0,0,0.28) 58%,
            rgba(0,0,0,0.05) 100%
        ),
        url("{{ asset('images/banner.jpg') }}");
    background-size:cover;
    background-position:center;
}

.hero-inner{
    width:100%;
    max-width:1320px;
    margin:0 auto;
    padding:35px 46px;
    position:relative;
    z-index:2;
}

.hero-content{
    max-width:620px;
}

.hero-title{
    margin:0 0 10px;
    color:#fff;
    font-size:42px;
    font-weight:900;
    line-height:1.08;
    letter-spacing:-0.5px;
    text-shadow:0 6px 18px rgba(0,0,0,0.35);
}

.hero-subtitle{
    margin:0 0 14px;
    color:#fff;
    font-size:22px;
    font-weight:600;
    line-height:1.35;
    text-shadow:0 6px 18px rgba(0,0,0,0.35);
}

.hero-description{
    margin:0 0 26px;
    max-width:560px;
    color:#fff;
    font-size:16px;
    font-weight:500;
    line-height:1.55;
    text-shadow:0 6px 18px rgba(0,0,0,0.35);
}

.hero-search-row{
    width:100%;
    display:flex;
    align-items:center;
}

.hero-field-search{
    width:100%;
    max-width:500px;
    height:52px;
    background:#f2f2f2;
    border:1px solid #dcdcdc;
    border-radius:16px;
    display:flex;
    align-items:center;
    padding:0 18px;
    box-shadow:0 6px 18px rgba(0,0,0,0.18);
}

.hero-icon-left{
    width:26px;
    height:26px;
    color:#1f78c8;
    margin-right:12px;
    flex-shrink:0;
}

.hero-field-search input{
    width:100%;
    height:100%;
    border:none;
    outline:none;
    background:transparent;
    font-size:15px;
    color:#333;
}

.hero-field-search input::placeholder{
    color:#b5b5b5;
}

/* SERVICE SECTIONS */
.service-cards-section{
    padding:45px 0 40px;
    background:var(--bg);
}

.service-cards-container,
.explore-services-container,
.faq-container{
    width:92%;
    max-width:1280px;
    margin:0 auto;
}

.service-cards-grid{
    display:grid;
    grid-template-columns:repeat(3, minmax(0, 1fr));
    gap:28px;
}

.service-card-item{
    background:#fff;
    border-radius:var(--radius-lg);
    overflow:hidden;
    border:1px solid var(--border);
    box-shadow:var(--shadow);
    transition:0.3s ease;
}

.service-card-item:hover{
    transform:translateY(-6px);
    box-shadow:0 16px 40px rgba(0,0,0,0.12);
}

.service-card-image{
    width:100%;
    height:220px;
    overflow:hidden;
    background:#eaeaea;
}

.service-card-image img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
}

.service-card-box{
    padding:18px 18px 22px;
    text-align:center;
}

.service-card-divider{
    display:flex;
    justify-content:center;
    margin-bottom:14px;
}

.service-card-title{
    margin:0 0 10px;
    font-size:22px;
    font-weight:700;
    color:var(--orange);
}

.service-card-text{
    margin:0 0 18px;
    font-size:14px;
    line-height:1.6;
    color:var(--muted);
}

.service-card-btn{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    min-width:210px;
    padding:12px 22px;
    border-radius:12px;
    background:linear-gradient(180deg, var(--blue-light), var(--blue));
    color:#fff;
    text-decoration:none;
    font-size:14px;
    font-weight:700;
}

.service-card-btn:hover{
    color:#fff;
    text-decoration:none;
}

/* RESPONSIVE */
@media(max-width:991px){
    .hero-banner{
        height:320px;
        min-height:320px;
        background-position:center right;
    }

    .hero-inner{
        padding:30px 28px;
    }

    .hero-title{
        font-size:36px;
    }

    .hero-subtitle{
        font-size:20px;
    }

    .hero-description{
        font-size:15px;
        margin-bottom:22px;
    }

    .hero-field-search{
        max-width:460px;
    }

    .service-cards-grid{
        grid-template-columns:repeat(2, minmax(0, 1fr));
    }
}

@media(max-width:767px){
    .hero-banner{
        height:310px;
        min-height:310px;
        background-image:
            linear-gradient(90deg, rgba(0,0,0,0.88) 0%, rgba(0,0,0,0.75) 100%),
            url("{{ asset('images/hero-banner.png') }}");
    }

    .hero-inner{
        padding:28px 18px;
    }

    .hero-title{
        font-size:30px;
    }

    .hero-subtitle{
        font-size:18px;
    }

    .hero-description{
        font-size:14px;
        margin-bottom:20px;
    }

    .hero-field-search{
        height:48px;
        max-width:100%;
    }

    .service-cards-section{
        padding:35px 0;
    }

    .service-cards-grid{
        grid-template-columns:1fr;
    }

    .service-card-item{
        max-width:420px;
        width:100%;
        margin:0 auto;
    }
}

.ck-trust-section {
    background: #eeeeee;
    padding: 28px 0;
}

.ck-trust-container {
    width: 92%;
    max-width: 1180px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 28px;
    text-align: center;
}

.ck-trust-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.ck-trust-icon {
    width: 64px;
    height: 64px;
    margin-bottom: 10px;
    color: #1468ad;
}

.ck-trust-title {
    font-size: 18px;
    font-weight: 800;
    line-height: 1.25;
    color: #000;
    margin: 0;
}

@media (max-width: 767px) {
    .ck-trust-container {
        grid-template-columns: repeat(2, 1fr);
        gap: 24px 18px;
    }

    .ck-trust-title {
        font-size: 15px;
    }

    .ck-trust-icon {
        width: 52px;
        height: 52px;
    }
}

.ck-trust-icon-img {
    width: 64px;
    height: 64px;
    object-fit: contain;
    margin-bottom: 10px;
    display: block;
}


.ck-services-section {
    background: #eeeeee;
    padding: 80px 0 55px;
}

.ck-services-container {
    width: 92%;
    max-width: 1500px;
    margin: 0 auto;
}

.ck-services-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 110px;
}

.ck-service-card {
    padding: 0 16px 22px;
    background: #fff;
    border: 1.5px solid #111;
    border-radius: 18px;
    box-shadow: 0 5px 12px rgba(0,0,0,0.22);
    text-align: center;
    height: 288px;
}

.ck-service-image {
    width: 250px;
    height: 192px;
    margin: -55px auto 20px;
    border-radius: 16px;
    overflow: hidden;
    border: 1.5px solid #111;
    box-shadow: 0 4px 10px rgba(0,0,0,0.22);
}

.ck-service-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.ck-service-title {
    color: #df6d1c;
    font-size: 22px;
    font-weight: 800;
    margin: 0;
}

.ck-service-line {
    width: 150px;
    height: 1px;
    background: #555;
    margin: 5px auto 12px;
}

.ck-service-text {
    color: #555;
    font-size: 10px;
    margin: 0 0 14px;
    font-style: oblique;
}

.ck-service-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 241px;
    height: 40px;
    border-radius: 10px;
    background: linear-gradient(180deg, #2f89d0 0%, #1d6eb3 100%);
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    font-weight: 800;
}

.ck-service-btn:hover {
    color: #fff;
    text-decoration: none;
}

@media (max-width: 991px) {
    .ck-services-grid {
        grid-template-columns: 1fr;
        gap: 85px;
    }

    .ck-service-card {
        max-width: 470px;
        margin: 0 auto;
    }
}

@media (max-width: 576px) {
    .ck-service-image {
        width: 92%;
        height: 210px;
    }

    .ck-service-title {
        font-size: 27px;
    }

    .ck-service-btn {
        width: 100%;
        font-size: 15px;
    }
}


/* ── EXPLORE MORE SERVICES ── */
.explore-services-section {
  padding: 60px 0;
  background: var(--bg);
}
 
.explore-services-container {
  width: 92%;
  max-width: 1280px;
  margin: 0 auto;
}
 
.explore-services-heading {
  margin-bottom: 36px;
}
 
.explore-services-heading h2 {
  font-size: 30px;
  font-weight: 800;
  color: var(--text);
  margin-bottom: 10px;
}
 
.heading-line {
  display: flex;
  gap: 6px;
}
 
.line-orange {
  display: block;
  width: 56px;
  height: 4px;
  border-radius: 4px;
  background: var(--orange);
}
 
.line-blue {
  display: block;
  width: 28px;
  height: 4px;
  border-radius: 4px;
  background: var(--blue);
}
 
.explore-services-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 28px;
}
 
.explore-card {
  border-radius: var(--radius-lg);
  overflow: hidden;
  border: 1px solid var(--border);
  box-shadow: var(--shadow);
  background: #fff;
  transition: transform 0.3s, box-shadow 0.3s;
}
 
.explore-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 18px 40px rgba(0,0,0,0.13);
}
 
.explore-card-image {
  width: 100%;
  height: 190px;
  overflow: hidden;
  background: #e8e8e8;
}
 
.explore-card-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.4s;
}
 
.explore-card:hover .explore-card-image img {
  transform: scale(1.04);
}
 
.explore-card-body {
  padding: 20px 22px 24px;
}
 
.explore-card-body h3 {
  font-size: 19px;
  font-weight: 800;
  margin-bottom: 6px;
  color: var(--text);
}
 
.explore-card-body p {
  font-size: 13px;
  color: var(--muted);
  margin-bottom: 16px;
  line-height: 1.5;
}
 
.explore-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 10px 24px;
  border-radius: 10px;
  text-decoration: none;
  font-size: 13px;
  font-weight: 700;
  transition: opacity 0.2s;
}
 
.explore-btn:hover { opacity: 0.88; text-decoration: none; }
 
.orange-btn {
  background: linear-gradient(180deg, #f07c30, var(--orange));
  color: #fff;
}
 
.blue-btn {
  background: linear-gradient(180deg, var(--blue-light), var(--blue));
  color: #fff;
}
</style>
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
        background: url('{{ asset('images/banner.jpg') }}') center center / cover no-repeat;
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

    .location-trigger-box{
        cursor: pointer;
    }

    .location-trigger-box input{
        cursor: pointer;
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
        right: 20px;
        bottom: 20px;
        z-index: 9998;
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

    .ck-location-modal-overlay{
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.58);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 999999;
        padding: 20px;
    }

    .ck-location-modal-overlay.active{
        display: flex;
    }

    .ck-location-modal{
        width: 100%;
        max-width: 650px;
        background: #fff;
        border-radius: 24px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 24px 60px rgba(0,0,0,0.25);
        animation: ckLocationFade 0.25s ease;
    }

    @keyframes ckLocationFade{
        from{
            opacity: 0;
            transform: translateY(20px) scale(0.98);
        }
        to{
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .ck-location-close{
        position: absolute;
        top: 14px;
        right: 18px;
        width: 44px;
        height: 44px;
        border: none;
        border-radius: 50%;
        background: #fff;
        font-size: 34px;
        line-height: 1;
        cursor: pointer;
        color: #222;
        z-index: 3;
        box-shadow: 0 6px 16px rgba(0,0,0,0.12);
    }

    .ck-location-search-wrap{
        margin: 32px 22px 18px;
        height: 60px;
        border: 1px solid #dddddd;
        border-radius: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0 18px;
    }

    .ck-location-back-icon{
        width: 28px;
        height: 28px;
        color: #222;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .ck-location-back-icon svg{
        width: 24px;
        height: 24px;
    }

    .ck-location-search-input{
        width: 100%;
        border: none;
        outline: none;
        background: transparent;
        font-size: 16px;
        color: #333;
    }

    .ck-location-search-input::placeholder{
        color: #9a9a9a;
    }

    .ck-use-current-location{
        margin: 0 22px 18px;
        border: none;
        background: transparent;
        color: #6a38ff;
        font-size: 16px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        padding: 6px 0;
    }

    .ck-current-location-icon{
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #6a38ff;
    }

    .ck-current-location-icon svg{
        width: 22px;
        height: 22px;
    }

    .ck-location-divider{
        height: 10px;
        background: #f2f2f2;
    }

    .ck-location-body{
        padding: 20px 22px 10px;
        min-height: 260px;
        max-height: 420px;
        overflow-y: auto;
    }

    .ck-location-heading{
        margin: 0 0 18px;
        font-size: 18px;
        font-weight: 700;
        color: #111;
    }

    .ck-recent-item,
    .ck-search-item{
        display: flex;
        gap: 14px;
        align-items: flex-start;
        padding: 16px 0;
        border-bottom: 1px solid #ececec;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .ck-recent-item:hover,
    .ck-search-item:hover{
        background: #fafafa;
    }

    .ck-recent-icon,
    .ck-search-icon{
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #f2f2f2;
        color: #666;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .ck-recent-icon svg,
    .ck-search-icon svg{
        width: 18px;
        height: 18px;
    }

    .ck-recent-content h4,
    .ck-search-content h4{
        margin: 0 0 4px;
        font-size: 16px;
        color: #111;
        font-weight: 600;
    }

    .ck-recent-content p,
    .ck-search-content p{
        margin: 0;
        font-size: 14px;
        color: #666;
        line-height: 1.5;
    }

    .ck-location-status{
        margin-top: 15px;
        padding: 12px 14px;
        border-radius: 12px;
        background: #fff7ed;
        border: 1px solid #fed7aa;
        color: #9a3412;
        font-size: 14px;
        line-height: 1.6;
    }

    .ck-location-footer{
        padding: 18px 22px 20px;
        text-align: center;
        font-size: 14px;
        color: #888;
        border-top: 1px solid #ececec;
        background: #fafafa;
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
            bottom: 16px;
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

        .ck-location-modal{
            max-width: 100%;
            border-radius: 20px;
        }

        .ck-location-search-wrap{
            margin: 22px 14px 14px;
            height: 54px;
            padding: 0 14px;
        }

        .ck-use-current-location{
            margin: 0 14px 14px;
            font-size: 15px;
        }

        .ck-location-body{
            padding: 18px 14px 10px;
        }

        .ck-location-close{
            top: 10px;
            right: 12px;
            width: 40px;
            height: 40px;
            font-size: 30px;
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
            bottom: 12px;
        }
    }

    .ck-guide-section {
    background: #eeeeee;
    padding: 55px 0;
}

.ck-guide-container {
    width: 92%;
    max-width: 1500px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1.8fr;
    gap: 28px;
    align-items: stretch;
}

.ck-guide-image-box {
    border: 3px solid #f26f21;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 12px rgba(0,0,0,0.25);
    background: #fff;
}

.ck-guide-image-box img {
    width: 100%;
    height: 100%;
    min-height: 340px;
    object-fit: cover;
    display: block;
}

.ck-guide-content-box {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    background:
        linear-gradient(rgba(31,103,171,0.92), rgba(31,103,171,0.92)),
        url("{{ asset('images/guide-bg.png') }}");
    background-size: cover;
    background-position: center;
    box-shadow: 0 8px 12px rgba(0,0,0,0.25);
    padding: 48px 55px;
    text-align: center;
    color: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.ck-guide-title {
    font-size: 34px;
    font-weight: 900;
    line-height: 1.28;
    margin: 0 0 26px;
}

.ck-guide-text {
    font-size: 24px;
    font-weight: 400;
    line-height: 1.35;
    max-width: 900px;
    margin: 0 0 42px;
}

.ck-guide-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 410px;
    height: 56px;
    padding: 0 28px;
    border-radius: 10px;
    background: #fff;
    color: #2b2b2b;
    text-decoration: none;
    font-size: 25px;
    font-weight: 900;
    box-shadow: 0 5px 10px rgba(0,0,0,0.35);
}

.ck-guide-btn:hover {
    color: #2b2b2b;
    text-decoration: none;
}

@media (max-width: 991px) {
    .ck-guide-container {
        grid-template-columns: 1fr;
    }

    .ck-guide-content-box {
        padding: 38px 24px;
    }

    .ck-guide-title {
        font-size: 28px;
    }

    .ck-guide-text {
        font-size: 19px;
    }

    .ck-guide-btn {
        min-width: auto;
        width: 100%;
        font-size: 20px;
    }
}

@media (max-width: 576px) {
    .ck-guide-section {
        padding: 38px 0;
    }

    .ck-guide-image-box img {
        min-height: 260px;
    }

    .ck-guide-title {
        font-size: 24px;
    }

    .ck-guide-text {
        font-size: 16px;
        margin-bottom: 28px;
    }

    .ck-guide-btn {
        height: 50px;
        font-size: 17px;
    }
}
</style>
<div class="home-page">

    <div class="hero-holder">
        <section class="hero-banner">
            <div class="hero-inner">
                <div class="hero-content">

                    <h1 class="hero-title">Plan. Hire. Execute</h1>

                    <p class="hero-subtitle">
                        We manage your construction end-to-end
                    </p>

                    <p class="hero-description">
                        From planning and design to execution and quality checks everything handled through us
                    </p>

                    <div class="hero-search-row">
                        <div class="hero-field-search">
                            <svg class="hero-icon-left" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M10 2a8 8 0 105.293 14.293l4.707 4.707 1.414-1.414-4.707-4.707A8 8 0 0010 2zm0 2a6 6 0 110 12 6 6 0 010-12z"/>
                            </svg>

                            <input type="text" placeholder="Search for Residential Architect">
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
    <section class="ck-trust-section">
        <div class="ck-trust-container">

            <div class="ck-trust-item">
                <img src="{{ asset('images/logo/safety-helmet.png') }}" 
                    alt="Built by 20+ years construction experience" 
                    class="ck-trust-icon-img">

                <p class="ck-trust-title">
                    Built by 20+ years<br>construction experience
                </p>
            </div>

            <div class="ck-trust-item">
                <img src="{{ asset('images/logo/verify.png') }}" 
                    alt="Built by 20+ years construction experience" 
                    class="ck-trust-icon-img">
                <p class="ck-trust-title">Verified<br>vendors only</p>
            </div>

            <div class="ck-trust-item">
                <img src="{{ asset('images/logo/onground.png') }}" 
                    alt="Built by 20+ years construction experience" 
                    class="ck-trust-icon-img">
                <p class="ck-trust-title">On-ground<br>execution support</p>
            </div>

            <div class="ck-trust-item">
                <img src="{{ asset('images/logo/transpernt.png') }}" 
                    alt="Built by 20+ years construction experience" 
                    class="ck-trust-icon-img">
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

                    <p class="ck-service-text">
                        Post your requirements and get your quote within 24 hours.
                    </p>

                    <a href="{{ route('post', ['work_type_id' => 2]) }}" class="ck-service-btn">
                        Post Your Requirement
                    </a>
                </div>

                <div class="ck-service-card">
                    <div class="ck-service-image">
                        <img src="{{ asset('images/b2.png') }}" alt="Contractor">
                    </div>

                    <h3 class="ck-service-title">Contractor</h3>
                    <div class="ck-service-line"></div>

                    <p class="ck-service-text">
                        Post your requirements and get your quote within 24 hours.
                    </p>

                    <a href="{{ route('post', ['work_type_id' => 1]) }}" class="ck-service-btn">
                        Post Your Requirement
                    </a>
                </div>

                <div class="ck-service-card">
                    <div class="ck-service-image">
                        <img src="{{ asset('images/b3.png') }}" alt="Interior Designer">
                    </div>

                    <h3 class="ck-service-title">Interior Designer</h3>
                    <div class="ck-service-line"></div>

                    <p class="ck-service-text">
                        Post your requirements and get your quote within 24 hours.
                    </p>

                    <a href="{{ route('post', ['work_type_id' => 4]) }}" class="ck-service-btn">
                        Post Your Requirement
                    </a>
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
    <section class="ck-guide-section">
    <div class="ck-guide-container">

        <div class="ck-guide-image-box">
            <img src="{{ asset('images/confused-customer.png') }}" alt="Confused About Construction Service">
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

            <a href="#" class="ck-guide-btn">
                Let ConstructKaro Guide Me
            </a>
        </div>

    </div>
</section>

@endsection