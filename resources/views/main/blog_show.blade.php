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
    }

    .blog-detail-content strong {
        color: #222;
        font-weight: 900;
    }

    .blog-detail-content p,
    .blog-detail-content div {
        margin: 0 0 14px;
    }

    .blog-detail-content ul,
    .blog-detail-content ol {
        margin: 0 0 14px 22px;
        padding: 0;
    }

    .blog-detail-content a {
        color: #f37021;
        font-weight: 800;
    }

    .blog-builder {
        margin-top: 26px;
        display: grid;
        gap: 24px;
    }

    .blog-builder h2 {
        color: #111827;
        font-size: 26px;
        line-height: 1.3;
        font-weight: 900;
        margin: 0 0 8px;
        text-align: center;
    }

    .blog-builder-text {
        color: #4b5563;
        font-size: 15px;
        line-height: 1.8;
        font-weight: 500;
        white-space: pre-line;
    }

    .blog-builder-image {
        width: 100%;
        border-radius: 14px;
        display: block;
        object-fit: cover;
    }

    .blog-builder-image-text {
        display: grid;
        grid-template-columns: minmax(260px, 0.9fr) minmax(280px, 1.1fr);
        gap: 22px;
        align-items: center;
    }

    .blog-builder-faq {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 16px 18px;
        background: #fbfdff;
    }

    .blog-builder-faq h3 {
        margin: 0 0 8px;
        color: #111827;
        font-size: 17px;
        font-weight: 900;
    }

    .blog-builder-faq p {
        margin: 0;
        color: #4b5563;
        line-height: 1.7;
    }

    .blog-builder-cta {
        text-align: center;
    }

    .blog-builder-cta a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 44px;
        padding: 10px 22px;
        border-radius: 999px;
        background: #f37021;
        color: #fff;
        font-weight: 900;
        text-decoration: none;
        box-shadow: 0 8px 18px rgba(243, 112, 33, .24);
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

        .blog-builder-image-text {
            grid-template-columns: 1fr;
        }

        .blog-builder h2 {
            font-size: 22px;
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

        @if($blog->content)
            <div class="blog-detail-content">{!! $blog->content !!}</div>
        @endif

        @if(! empty($blog->content_blocks))
            <div class="blog-builder">
                @foreach($blog->content_blocks as $block)
                    @php
                        $type = $block['type'] ?? '';
                        $image = ! empty($block['image'])
                            ? \Illuminate\Support\Facades\Storage::disk('public')->url($block['image'])
                            : null;
                    @endphp

                    @if($type === 'heading' && ! empty($block['heading']))
                        <section>
                            <h2>{{ $block['heading'] }}</h2>
                        </section>
                    @elseif($type === 'text')
                        <section>
                            @if(! empty($block['heading']))
                                <h2>{{ $block['heading'] }}</h2>
                            @endif
                            @if(! empty($block['body']))
                                <div class="blog-builder-text">{{ $block['body'] }}</div>
                            @endif
                        </section>
                    @elseif($type === 'image' && $image)
                        <section>
                            <img src="{{ $image }}" class="blog-builder-image" alt="{{ $block['image_alt'] ?? $blog->title }}">
                        </section>
                    @elseif($type === 'image_text')
                        <section class="blog-builder-image-text">
                            @if($image)
                                <img src="{{ $image }}" class="blog-builder-image" alt="{{ $block['image_alt'] ?? $blog->title }}">
                            @endif
                            <div>
                                @if(! empty($block['heading']))
                                    <h2>{{ $block['heading'] }}</h2>
                                @endif
                                @if(! empty($block['body']))
                                    <div class="blog-builder-text">{{ $block['body'] }}</div>
                                @endif
                            </div>
                        </section>
                    @elseif($type === 'faq' && (! empty($block['question']) || ! empty($block['answer'])))
                        <section class="blog-builder-faq">
                            @if(! empty($block['question']))
                                <h3>{{ $block['question'] }}</h3>
                            @endif
                            @if(! empty($block['answer']))
                                <p>{{ $block['answer'] }}</p>
                            @endif
                        </section>
                    @elseif($type === 'cta' && ! empty($block['button_text']))
                        <section class="blog-builder-cta">
                            @if(! empty($block['heading']))
                                <h2>{{ $block['heading'] }}</h2>
                            @endif
                            <a href="{{ $block['button_url'] ?: '#' }}">{{ $block['button_text'] }}</a>
                        </section>
                    @endif
                @endforeach
            </div>
        @endif
    </article>
</main>
@endsection
