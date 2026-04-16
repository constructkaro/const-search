@extends('layouts.app')

@section('title', 'Blogs / Articles')

@section('content')
<style>
    .blog-article-section {
        padding: 45px 0 70px;
        background: #efefef;
    }

    .blog-article-wrapper {
        max-width: 1500px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .blog-search-wrap {
        display: flex;
        justify-content: center;
        margin-bottom: 28px;
    }

    .blog-search-bar {
        width: 100%;
        max-width: 1200px;
        display: flex;
        align-items: center;
        overflow: hidden;
        border-radius: 30px;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .blog-search-icon {
        width: 55px;
        min-width: 55px;
        text-align: center;
        font-size: 20px;
        color: #8d8d8d;
    }

    .blog-search-bar input {
        flex: 1;
        height: 52px;
        border: none;
        outline: none;
        background: transparent;
        font-size: 14px;
        color: #333;
    }

    .blog-search-bar input::placeholder {
        color: #9b9b9b;
    }

    .blog-search-bar button {
        border: none;
        background: #4c4c4c;
        color: #fff;
        padding: 0 30px;
        height: 42px;
        margin-right: 8px;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
    }

    .blog-title {
        text-align: center;
        font-size: 36px;
        font-weight: 800;
        color: #1f1f1f;
        margin-bottom: 10px;
    }

    .blog-title-line {
        display: flex;
        justify-content: center;
        margin-bottom: 35px;
    }

    .blog-title-line span {
        height: 4px;
        width: 75px;
    }

    .blog-title-line .blue {
        background: #2b78d0;
        border-radius: 20px 0 0 20px;
    }

    .blog-title-line .orange {
        background: #f25c05;
        border-radius: 0 20px 20px 0;
    }

    .blog-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
        align-items: start;
    }

    .blog-image-card {
        display: block;
        border-radius: 22px;
        overflow: hidden;
        text-decoration: none;
        transition: all 0.35s ease;
        /* box-shadow: 0 10px 25px rgba(0,0,0,0.08); */
        /* background: #fff; */
    }

    .blog-image-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 35px rgba(0,0,0,0.14);
    }

    .blog-image-card.orange-border {
        border: 2px solid #f25c05;
    }

    .blog-image-card.blue-border {
        border: 2px solid #2b78d0;
    }

    .blog-image-card img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }

    @media (max-width: 1199px) {
        .blog-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 767px) {
        .blog-article-section {
            padding: 30px 0 50px;
        }

        .blog-article-wrapper {
            padding: 0 15px;
        }

        .blog-title {
            font-size: 28px;
        }

        .blog-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .blog-search-bar {
            border-radius: 18px;
        }

        .blog-search-icon {
            width: 45px;
            min-width: 45px;
            font-size: 18px;
        }

        .blog-search-bar input {
            font-size: 13px;
            height: 48px;
        }

        .blog-search-bar button {
            height: 38px;
            padding: 0 18px;
            font-size: 13px;
            border-radius: 10px;
        }
    }
</style>

<section class="blog-article-section">
    <div class="blog-article-wrapper">

        <div class="blog-search-wrap">
            <form class="blog-search-bar" action="#" method="GET">
                <div class="blog-search-icon">&#128269;</div>
                <input type="text" name="search" placeholder="Search for How to Choose the Right Contractor in India?">
                <button type="submit">search</button>
            </form>
        </div>

        <h2 class="blog-title">Blogs / Articles</h2>
        <div class="blog-title-line">
            <span class="blue"></span>
            <span class="orange"></span>
        </div>

        <div class="blog-grid">

            <a href="{{route('chooserightcontractor')}}" class="blog-image-card ">
                <img src="{{ asset('images/topics/contractor-guide.png') }}" alt="How to Choose the Right Contractor in India">
            </a>

            <a href="{{route('constructionarticle')}}" class="blog-image-card">
                <img src="{{ asset('images/topics/cost-breakdown.png') }}" alt="House Construction Cost Breakdown in India">
            </a>

            <a href="{{route('differentconsultant')}}" class="blog-image-card">
                <img src="{{ asset('images/topics/professional-difference.png') }}" alt="Difference Between Contractor Architect Interior Designer Surveyor and Consultant">
            </a>

            <a href="{{route('blogsinsightspage')}}" class="blog-image-card">
                <img src="{{ asset('images/topics/soiltest.png') }}" alt="Importance of Soil Testing Before Construction">
            </a>

        </div>

    </div>
</section>
@endsection