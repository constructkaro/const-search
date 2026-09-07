@extends('layouts.app')

@section('title', $project->title . ' | Project | ConstructKaro')
@section('meta_description', 'View photos and details for ' . $project->title . ', a construction project by ConstructKaro.')
@section('canonical', route('completed.projects.show', $project->slug))
@section('og_title', $project->title . ' | Project | ConstructKaro')
@section('og_description', 'Explore project photos and details for ' . $project->title . '.')
@section('og_image', asset($imageFiles[0] ?? $project->image))
@section('twitter_title', $project->title . ' | Project | ConstructKaro')
@section('twitter_description', 'Explore project photos and details for ' . $project->title . '.')
@section('twitter_image', asset($imageFiles[0] ?? $project->image))

@php
    $metaItems = array_values(array_filter([
        $project->area ?? null,
        $project->floors ?? null,
        $project->status ?? null,
    ]));

    $detailParagraphs = $project->details ?? [
        $project->description . ' is a ConstructKaro project completed with practical planning, site coordination, and quality-focused execution.',
        'The project work was managed with attention to site requirements, usable space, construction sequencing, and finish quality.',
        'The final outcome reflects a clear execution approach and a functional construction result suited to the project requirement.',
    ];
@endphp

@push('styles')
<style>
.project-detail-page {
    min-height: 100vh;
    padding: 42px 0 64px;
    background: #fff;
    color: #111;
    font-family: "Poppins", "Segoe UI", sans-serif;
}

.project-detail-shell {
    width: min(94%, 1720px);
    margin: 0 auto;
}

.project-back-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 46px;
    height: 46px;
    margin: 0 0 24px 0;
    border-radius: 50%;
    background: #1f73b7;
    color: #fff;
    font-size: 31px;
    font-weight: 800;
    line-height: 1;
    text-decoration: none;
    box-shadow: 0 4px 10px rgba(31, 115, 183, .22);
}

.project-back-btn:hover {
    color: #fff;
    text-decoration: none;
    background: #185f99;
}

.project-detail-grid {
    display: grid;
    grid-template-columns: minmax(560px, 1fr) minmax(520px, .95fr);
    gap: clamp(46px, 5vw, 82px);
    align-items: start;
}

.project-media-wrap {
    position: relative;
    padding: 0 50px;
}

.project-main-image {
    display: block;
    width: 100%;
    aspect-ratio: 1.4 / 1;
    border-radius: 26px;
    object-fit: cover;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .18);
}

.project-arrow {
    position: absolute;
    top: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border: 0;
    border-radius: 50%;
    background: #1f73b7;
    color: #fff;
    font-size: 32px;
    font-weight: 800;
    line-height: 1;
    cursor: pointer;
    transform: translateY(-50%);
    box-shadow: 0 3px 9px rgba(31, 115, 183, .24);
}

.project-arrow:hover {
    background: #185f99;
}

.project-arrow.prev {
    left: 0;
}

.project-arrow.next {
    right: 0;
}

.project-info h1 {
    margin: 0 0 18px;
    color: #000;
    font-size: clamp(38px, 3.5vw, 58px);
    font-weight: 900;
    line-height: 1.1;
    letter-spacing: 0;
}

.project-meta-row {
    display: flex;
    flex-wrap: wrap;
    gap: clamp(34px, 4vw, 72px);
    margin-bottom: 18px;
    color: #555;
    font-size: clamp(20px, 1.55vw, 28px);
    font-weight: 800;
}

.project-copy {
    max-width: 840px;
    color: #555;
    font-size: clamp(19px, 1.28vw, 25px);
    font-weight: 500;
    line-height: 1.25;
}

.project-copy p {
    margin: 0 0 28px;
}

.project-copy p:last-child {
    margin-bottom: 0;
}

@media (max-width: 1100px) {
    .project-detail-grid {
        grid-template-columns: 1fr;
        align-items: start;
    }

    .project-info h1 {
        font-size: clamp(36px, 8vw, 58px);
    }

    .project-copy {
        font-size: 21px;
    }
}

@media (max-width: 640px) {
    .project-detail-page {
        padding-top: 20px;
    }

    .project-media-wrap {
        padding: 0 38px;
    }

    .project-main-image {
        border-radius: 18px;
    }

    .project-arrow {
        width: 32px;
        height: 32px;
        font-size: 28px;
    }

    .project-meta-row {
        gap: 20px;
        font-size: 19px;
    }

    .project-copy {
        font-size: 18px;
        line-height: 1.35;
    }
}
</style>
@endpush

@section('content')
<section class="project-detail-page">
    <div class="project-detail-shell">
        <a class="project-back-btn" href="{{ route('completed.projects') }}" aria-label="Back to projects">&larr;</a>

        <div class="project-detail-grid">
            <div class="project-media-wrap">
                <button type="button" class="project-arrow prev" data-project-prev aria-label="Previous image">&lsaquo;</button>
                <img
                    class="project-main-image"
                    id="projectMainImage"
                    src="{{ asset($imageFiles[0] ?? $project->image) }}"
                    alt="{{ $project->title }}"
                    data-images='@json(array_map(fn ($image) => asset($image), $imageFiles))'
                >
                <button type="button" class="project-arrow next" data-project-next aria-label="Next image">&rsaquo;</button>
            </div>

            <div class="project-info">
                <h1>{{ $project->title }}</h1>

                @if(count($metaItems))
                    <div class="project-meta-row">
                        @foreach($metaItems as $item)
                            <span>{{ $item }}</span>
                        @endforeach
                    </div>
                @endif

                <div class="project-copy">
                    @foreach($detailParagraphs as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const image = document.getElementById('projectMainImage');
    if (!image) return;

    let images = [];
    try {
        images = JSON.parse(image.dataset.images || '[]');
    } catch (error) {
        images = [];
    }

    if (!images.length) {
        images = [image.src];
    }

    let index = 0;
    const prev = document.querySelector('[data-project-prev]');
    const next = document.querySelector('[data-project-next]');

    function showImage(nextIndex) {
        index = (nextIndex + images.length) % images.length;
        image.src = images[index];
    }

    if (prev) {
        prev.addEventListener('click', function () {
            showImage(index - 1);
        });
    }

    if (next) {
        next.addEventListener('click', function () {
            showImage(index + 1);
        });
    }
});
</script>
@endpush
