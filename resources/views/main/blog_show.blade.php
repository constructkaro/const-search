@extends('layouts.app')

@section('title', $blog->title)

@section('content')
<style>
    body {
        background: #f1f1f1;
        color: #263238;
        font-family: "Poppins", Arial, sans-serif;
    }

    .blog-detail-hero {
        min-height: 330px;
        background:
            linear-gradient(90deg, rgba(0,0,0,.88) 0%, rgba(0,0,0,.68) 42%, rgba(0,0,0,.18) 100%),
            var(--blog-hero-image);
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        padding: 48px 26px;
    }

    .blog-detail-hero h1 {
        margin: 0;
        color: #fff;
        font-size: 38px;
        line-height: 1.18;
        font-weight: 900;
        max-width: 830px;
        text-shadow: 0 6px 16px rgba(0,0,0,.45);
    }

    .blog-detail-page {
        padding: 28px 18px 70px;
        background: #f1f1f1;
    }

    .blog-detail-wrap {
        max-width: 1474px;
        margin: 0 auto;
        background: #fff;
        border: 1px solid #d8d8d8;
        box-shadow: 0 4px 12px rgba(0,0,0,.12);
        padding: 28px 30px 34px;
    }

    .blog-detail-meta {
        color: #f37021;
        font-size: 15px;
        font-weight: 900;
        margin-bottom: 20px;
    }

    .blog-detail-content {
        color: #4b5563;
        font-size: 15px;
        line-height: 1.8;
        font-weight: 500;
        white-space: pre-line;
    }

    .blog-detail-content strong {
        color: #222;
        font-weight: 900;
    }

    @media (max-width: 768px) {
        .blog-detail-hero {
            min-height: 270px;
            padding: 34px 20px;
        }

        .blog-detail-hero h1 {
            font-size: 28px;
        }

        .blog-detail-wrap {
            padding: 22px 18px 28px;
        }
    }
</style>

@php
    $heroImagePath = $blog->hero_image ?: $blog->image;
    $heroImage = $heroImagePath
        ? \Illuminate\Support\Facades\Storage::disk('public')->url($heroImagePath)
        : asset('images/topics/blogs-insights.png');
@endphp

<section class="blog-detail-hero" style="--blog-hero-image: url('{{ $heroImage }}')">
    <h1>{{ $blog->title }}</h1>
</section>

<main class="blog-detail-page">
    <article class="blog-detail-wrap">
        <div class="blog-detail-meta">
            {{ optional($blog->published_at)->format('d M Y') ?: optional($blog->created_at)->format('d M Y') }}
        </div>

        @if($blog->excerpt)
            <div class="blog-detail-content"><strong>{{ $blog->excerpt }}</strong></div>
            <hr>
        @endif

        <div class="blog-detail-content">{{ $blog->content }}</div>
    </article>
</main>
@endsection
