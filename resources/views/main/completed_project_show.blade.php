@extends('layouts.app')

@section('title', $project->title . ' | Completed Project | ConstructKaro')
@section('meta_description', 'View photos and details for ' . $project->title . ', a completed construction project by ConstructKaro.')
@section('canonical', route('completed.projects.show', $project->slug))
@section('og_title', $project->title . ' | Completed Project | ConstructKaro')
@section('og_description', 'Explore completed project photos and details for ' . $project->title . '.')
@section('og_image', asset($imageFiles[0] ?? $project->image))
@section('twitter_title', $project->title . ' | Completed Project | ConstructKaro')
@section('twitter_description', 'Explore completed project photos and details for ' . $project->title . '.')
@section('twitter_image', asset($imageFiles[0] ?? $project->image))

@push('styles')
<style>
.project-detail-page {
    background: #fff;
    padding: 66px 0 84px;
}

.project-detail-container {
    width: min(84%, 1380px);
    margin: 0 auto;
}

.project-back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 36px;
    color: #c77a00;
    font-size: 15px;
    font-weight: 800;
    text-decoration: none;
}

.project-back-link:hover {
    color: #9f5f00;
}

.project-detail-heading {
    max-width: 980px;
    margin-bottom: 44px;
}

.project-detail-heading h1 {
    margin: 0 0 24px;
    color: #0f1f33;
    font-size: 44px;
    font-weight: 900;
    line-height: 1.15;
}

.project-meta-list {
    display: grid;
    gap: 14px;
    color: #526174;
    font-size: 20px;
    font-weight: 600;
}

.project-meta-row {
    display: flex;
    align-items: center;
    gap: 12px;
}

.project-meta-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    color: #c77a00;
    font-size: 18px;
}

.project-photo-count {
    margin: 0 0 22px;
    color: #0f1f33;
    font-size: 24px;
    font-weight: 850;
}

.project-gallery-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 30px;
}

.project-gallery-card {
    overflow: hidden;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    background: #fff;
    box-shadow: 0 14px 30px rgba(15, 23, 42, .12);
    transition: transform .22s ease, box-shadow .22s ease;
}

.project-gallery-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 38px rgba(15, 23, 42, .16);
}

.project-gallery-card img {
    display: block;
    width: 100%;
    height: 285px;
    object-fit: cover;
}

.project-gallery-caption {
    padding: 16px 18px;
    color: #334155;
    font-size: 15px;
    font-weight: 700;
}

@media (max-width: 991px) {
    .project-detail-container {
        width: min(92%, 1280px);
    }

    .project-detail-heading h1 {
        font-size: 36px;
    }

    .project-gallery-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
    }

    .project-gallery-card img {
        height: 250px;
    }
}

@media (max-width: 576px) {
    .project-detail-page {
        padding: 42px 0 58px;
    }

    .project-back-link {
        margin-bottom: 26px;
    }

    .project-detail-heading {
        margin-bottom: 34px;
    }

    .project-detail-heading h1 {
        font-size: 30px;
    }

    .project-meta-list {
        font-size: 17px;
    }

    .project-gallery-grid {
        grid-template-columns: 1fr;
        gap: 22px;
    }

    .project-gallery-card img {
        height: 230px;
    }
}
</style>
@endpush

@section('content')
<section class="project-detail-page">
    <div class="project-detail-container">
        <a class="project-back-link" href="{{ route('completed.projects') }}">&larr; Back to Projects</a>

        <div class="project-detail-heading">
            <h1>{{ $project->title }}</h1>

            <div class="project-meta-list">
                <div class="project-meta-row">
                    <span class="project-meta-icon" aria-hidden="true">&#9679;</span>
                    <span>{{ $project->location }}</span>
                </div>
                <div class="project-meta-row">
                    <span class="project-meta-icon" aria-hidden="true">&#9679;</span>
                    <span>{{ $project->year }} | {{ $project->status }}</span>
                </div>
            </div>
        </div>

        <h2 class="project-photo-count">Project Photos</h2>

        <div class="project-gallery-grid">
            @foreach($imageFiles as $index => $image)
                <div class="project-gallery-card">
                    <img src="{{ asset($image) }}" alt="{{ $project->title }} photo {{ $index + 1 }}">
                    <div class="project-gallery-caption">{{ $project->title }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
