@extends('layouts.app')

@section('title', 'Blogs / Articles')

@section('content')
<style>
    .blog-article-section {
        padding: 0 0 70px;
        background: #efefef;
    }

    .blog-article-wrapper {
        max-width: 1500px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .blog-hero {
        position: relative;
        padding: 62px 0 66px;
        margin-bottom: 46px;
        overflow: hidden;
        background:
            linear-gradient(112deg, rgba(16,42,67,.98) 0%, rgba(19,58,91,.98) 55%, rgba(31,103,171,.9) 100%);
        border-bottom: 5px solid #f25c05;
    }

    .blog-hero::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(255,255,255,.055) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.055) 1px, transparent 1px);
        background-size: 44px 44px;
        opacity: .5;
        pointer-events: none;
    }

    .blog-hero::after {
        content: "";
        position: absolute;
        right: -150px;
        top: -110px;
        width: 560px;
        height: 360px;
        background: rgba(242,92,5,.16);
        transform: rotate(-18deg);
        pointer-events: none;
    }

    .blog-hero-inner {
        position: relative;
        z-index: 1;
        display: grid;
        grid-template-columns: minmax(0, 1.05fr) minmax(320px, .95fr);
        align-items: center;
        gap: clamp(34px, 6vw, 86px);
    }

    .blog-kicker {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
        color: #f68a2e;
        font-size: 14px;
        font-weight: 900;
        letter-spacing: 1.2px;
        text-transform: uppercase;
    }

    .blog-kicker::before {
        content: "";
        width: 38px;
        height: 3px;
        border-radius: 999px;
        background: #f68a2e;
    }

    .blog-hero h1 {
        max-width: 780px;
        margin: 0;
        color: #fff;
        font-size: clamp(38px, 4.2vw, 60px);
        font-weight: 900;
        line-height: 1.08;
        letter-spacing: 0;
        text-shadow: 0 4px 14px rgba(0,0,0,.2);
    }

    .blog-hero p {
        max-width: 680px;
        margin: 18px 0 0;
        color: rgba(255,255,255,.84);
        font-size: 17px;
        line-height: 1.72;
    }

    .blog-hero-points {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 28px;
    }

    .blog-hero-points span {
        display: inline-flex;
        align-items: center;
        min-height: 36px;
        padding: 0 14px;
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 999px;
        background: rgba(255,255,255,.1);
        color: #fff;
        font-size: 14px;
        font-weight: 800;
        backdrop-filter: blur(8px);
    }

    .blog-hero-visual {
        position: relative;
        min-height: 245px;
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 8px;
        background:
            linear-gradient(135deg, rgba(255,255,255,.14), rgba(255,255,255,.04)),
            repeating-linear-gradient(0deg, transparent 0 27px, rgba(255,255,255,.08) 28px),
            repeating-linear-gradient(90deg, transparent 0 27px, rgba(255,255,255,.08) 28px);
        box-shadow: 0 24px 45px rgba(0,0,0,.22);
        overflow: hidden;
    }

    .blog-visual-card {
        position: absolute;
        z-index: 1;
        width: min(72%, 330px);
        padding: 18px;
        border-radius: 8px;
        background: rgba(255,255,255,.96);
        box-shadow: 0 18px 34px rgba(0,0,0,.2);
    }

    .blog-visual-card.primary {
        left: 34px;
        top: 32px;
    }

    .blog-visual-card.secondary {
        right: 28px;
        bottom: 30px;
        width: min(62%, 280px);
        border-top: 5px solid #f25c05;
    }

    .blog-visual-tag {
        display: inline-flex;
        align-items: center;
        min-height: 26px;
        padding: 0 10px;
        border-radius: 999px;
        background: rgba(31,103,171,.12);
        color: #1f67ab;
        font-size: 12px;
        font-weight: 900;
    }

    .blog-visual-card strong {
        display: block;
        margin-top: 14px;
        color: #172033;
        font-size: 21px;
        line-height: 1.22;
    }

    .blog-visual-card p {
        margin: 10px 0 0;
        color: #637083;
        font-size: 13px;
        line-height: 1.5;
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

    .dynamic-blog-empty-card {
        display: flex;
        min-height: 330px;
        align-items: center;
        justify-content: center;
        border: 2px dashed #f25c05;
        border-radius: 22px;
        background: #fff1e7;
        color: #1f1f1f;
        padding: 22px;
        text-align: center;
        text-decoration: none;
        font-size: 24px;
        font-weight: 900;
    }

    @media (max-width: 1199px) {
        .blog-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 991px) {
        .blog-hero {
            padding: 48px 0 52px;
            margin-bottom: 38px;
        }

        .blog-hero-inner {
            grid-template-columns: 1fr;
        }

        .blog-hero-visual {
            min-height: 220px;
        }
    }

    @media (max-width: 767px) {
        .blog-article-section {
            padding: 0 0 50px;
        }

        .blog-article-wrapper {
            padding: 0 15px;
        }

        .blog-hero {
            padding: 38px 0 42px;
            margin-bottom: 30px;
        }

        .blog-hero h1 {
            font-size: 36px;
        }

        .blog-hero p {
            font-size: 15px;
            line-height: 1.65;
        }

        .blog-hero-points span {
            min-height: 34px;
            font-size: 13px;
        }

        .blog-hero-visual {
            min-height: 190px;
        }

        .blog-visual-card {
            width: 78%;
            padding: 14px;
        }

        .blog-visual-card.primary {
            left: 18px;
            top: 20px;
        }

        .blog-visual-card.secondary {
            right: 16px;
            bottom: 18px;
            width: 70%;
        }

        .blog-visual-card strong {
            font-size: 17px;
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

        .dynamic-blog-empty-card {
            min-height: 220px;
        }
    }
</style>

<section class="blog-article-section">
    <header class="blog-hero">
        <div class="blog-article-wrapper">
            <div class="blog-hero-inner">
                <div>
                    <span class="blog-kicker">Constructshala</span>
                    <h1>Blogs and construction insights.</h1>
                    <p>
                        Practical guides, project knowledge, and expert perspectives to help you
                        make smarter construction decisions.
                    </p>
                    <div class="blog-hero-points">
                        <span>Planning Guides</span>
                        <span>Cost Insights</span>
                        <span>Expert Advice</span>
                    </div>
                </div>
                <div class="blog-hero-visual" aria-hidden="true">
                    <div class="blog-visual-card primary">
                        <span class="blog-visual-tag">Latest Insight</span>
                        <strong>Choose better before construction starts.</strong>
                        <p>Read clear, practical explainers for customers and vendors.</p>
                    </div>
                    <div class="blog-visual-card secondary">
                        <span class="blog-visual-tag">ConstructKaro</span>
                        <strong>Plan. Compare. Execute.</strong>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="blog-article-wrapper">

        <div class="blog-search-wrap">
            <form class="blog-search-bar" action="{{ route('blogsinsights') }}" method="GET">
                <div class="blog-search-icon">&#128269;</div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for How to Choose the Right Contractor in India?">
                <button type="submit">search</button>
            </form>
        </div>

        <h2 class="blog-title">Blogs / Articles</h2>
        <div class="blog-title-line">
            <span class="blue"></span>
            <span class="orange"></span>
        </div>

        <div class="blog-grid">
            @foreach($blogs ?? [] as $blog)
                @if($blog->image)
                    <a href="{{ route('blogs.show', $blog->slug) }}" class="blog-image-card">
                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($blog->image) }}" alt="{{ $blog->title }}">
                    </a>
                @else
                    <a href="{{ route('blogs.show', $blog->slug) }}" class="dynamic-blog-empty-card">
                        {{ $blog->title }}
                    </a>
                @endif
            @endforeach

            @if(!request('search'))
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

                 <a href="{{route('case-study.mumbai-pune-missing-link')}}" class="blog-image-card">
                    <img src="{{ asset('images/topics/misinline.png') }}" alt="Mumbai Pune Missing Link Project">
                </a>
            @elseif(($blogs ?? collect())->isEmpty())
                <div class="empty-box">No blogs found.</div>
            @endif

        </div>

    </div>
</section>
@endsection
