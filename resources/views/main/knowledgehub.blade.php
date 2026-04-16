@extends('layouts.app')

@section('title', 'Knowledge Hub')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        background: #f3f3f3;
        color: #202020;
    }

    .kh-page {
        width: 100%;
        padding: 34px 0 80px;
    }

    .kh-container {
        width: 100%;
        max-width: 1800px;
        margin: 0 auto;
        padding: 0 28px;
    }

    /* SEARCH */
    .kh-search-wrap {
        margin: 0 auto 46px;
        max-width: 100%;
    }

    .kh-search-box {
        display: flex;
        align-items: center;
        gap: 14px;
        background: #fff;
        border-radius: 24px;
        padding: 10px 12px 10px 18px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }

    .kh-search-icon {
        width: 30px;
        height: 30px;
        flex-shrink: 0;
        color: #9c9c9c;
    }

    .kh-search-input {
        flex: 1;
        border: none;
        outline: none;
        background: transparent;
        font-size: 16px;
        color: #4a4a4a;
    }

    .kh-search-input::placeholder {
        color: #9c9c9c;
    }

    .kh-search-btn {
        min-width: 128px;
        height: 46px;
        border: none;
        border-radius: 14px;
        background: linear-gradient(180deg, #6b6b6b, #4d4d4d);
        color: #fff;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        box-shadow: inset 0 -2px 0 rgba(255,255,255,0.12), 0 4px 10px rgba(0,0,0,0.18);
        transition: 0.3s ease;
    }

    .kh-search-btn:hover {
        transform: translateY(-2px);
    }

    /* COMMON */
    .section-block {
        margin-bottom: 72px;
    }

    .section-title {
        font-size: 56px;
        line-height: 1.08;
        font-weight: 800;
        color: #1f1f1f;
        margin-bottom: 16px;
    }

    .title-line {
        width: 235px;
        height: 4px;
        display: flex;
        border-radius: 30px;
        overflow: hidden;
        margin-bottom: 28px;
    }

    .title-line .blue {
        width: 50%;
        background: #2b79c2;
    }

    .title-line .orange {
        width: 50%;
        background: #eb7b2d;
    }

    /* EXPLORE TOPICS - IMAGE ONLY */
    .topics-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 18px;
    }

    .topic-image-card {
        display: block;
        width: 100%;
        height: 270px;
        border-radius: 24px;
        overflow: hidden;
        text-decoration: none;
        transition: 0.3s ease;
        /* background: #fff; */
        /* box-shadow: 0 8px 18px rgba(0,0,0,0.10); */
    }

    .topic-image-card:hover {
        transform: translateY(-4px);
    }

    .topic-image-card img {
        width: 89%;
        height: 98%;
        object-fit: cover;
        display: block;
    }

    /* FEATURED INSIGHTS - IMAGE ONLY */
    .featured-image-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 24px;
    }

    .featured-image-card {
        display: block;
        width: 100%;
        height: 420px;
        border-radius: 28px;
        overflow: hidden;
        /* background: #fff; */
        /* box-shadow: 0 10px 18px rgba(0,0,0,0.10); */
        transition: 0.3s ease;
        text-decoration: none;
    }

    .featured-image-card:hover {
        transform: translateY(-5px);
    }

    .featured-image-card img {
        width: 96%;
        height: 101%;
        object-fit: cover;
        display: block;
    }

    /* RESPONSIVE */
    @media (max-width: 1400px) {
        .topics-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .featured-image-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 1200px) {
        .kh-container {
            padding: 0 22px;
        }

        .section-title {
            font-size: 44px;
        }

        .topics-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .featured-image-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .kh-page {
            padding: 24px 0 50px;
        }

        .kh-container {
            padding: 0 16px;
        }

        .kh-search-box {
            flex-wrap: wrap;
            border-radius: 18px;
            padding: 12px;
        }

        .kh-search-btn {
            width: 100%;
            min-width: 100%;
            height: 46px;
            border-radius: 12px;
        }

        .section-title {
            font-size: 34px;
        }

        .title-line {
            width: 210px;
            margin-bottom: 22px;
        }

        .topics-grid {
            grid-template-columns: 1fr;
        }

        .topic-image-card {
            height: 240px;
            border-radius: 20px;
        }

        .featured-image-grid {
            grid-template-columns: 1fr;
        }

        .featured-image-card {
            height: 250px;
            border-radius: 22px;
        }
    }
</style>

<div class="kh-page">
    <div class="kh-container">

        <!-- SEARCH -->
        <div class="kh-search-wrap">
            <div class="kh-search-box">
                <svg class="kh-search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" class="kh-search-input" placeholder="Search for How to Choose the Right Contractor in India?">
                <button class="kh-search-btn">Search</button>
            </div>
        </div>

        <!-- EXPLORE TOPICS -->
        <section class="section-block">
            <h2 class="section-title">Explore Topics</h2>
            <div class="title-line">
                <span class="blue"></span>
                <span class="orange"></span>
            </div>

            <div class="topics-grid">
                <a href="{{route('constructioneduction')}}" class="topic-image-card">
                    <img src="{{ asset('images/topics/construction-education.png') }}" alt="Construction Education">
                </a>

                <a href="{{route('constwork')}}" class="topic-image-card">
                    <img src="{{ asset('images/topics/how-constructkaro-works.png') }}" alt="How ConstructKaro Works">
                </a>

                <a href="{{route('blogsinsights')}}" class="topic-image-card">
                    <img src="{{ asset('images/topics/blogs-insights.png') }}" alt="Blogs & Insights">
                </a>

                <a href="#" class="topic-image-card">
                    <img src="{{ asset('images/topics/social-feed.png') }}" alt="Social Feed">
                </a>

                <a href="#" class="topic-image-card">
                    <img src="{{ asset('images/topics/case-studies.png') }}" alt="Case Studies">
                </a>
            </div>
        </section>

        <!-- FEATURED INSIGHTS -->
        <section class="section-block">
            <h2 class="section-title">Featured Insights</h2>
            <div class="title-line">
                <span class="blue"></span>
                <span class="orange"></span>
            </div>

            <div class="featured-image-grid">
                <a href="{{route('chooserightcontractor')}}" class="featured-image-card">
                    <img src="{{ asset('images/topics/contractor-guide.png') }}" alt="Contractor Article">
                </a>

                <a href="{{route('constructionarticle')}}" class="featured-image-card">
                    <img src="{{ asset('images/topics/cost-breakdown.png') }}" alt="Construction Cost Article">
                </a>

                <a href="{{route('differentconsultant')}}" class="featured-image-card">
                    <img src="{{ asset('images/topics/professional-difference.png') }}" alt="Professional Roles Article">
                </a>
            </div>
        </section>

    </div>
</div>

@endsection