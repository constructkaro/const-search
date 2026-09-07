@extends('layouts.app')

@section('title', 'Our Projects | ConstructKaro - Completed Construction Projects')
@section('meta_description', 'Explore completed projects by ConstructKaro across road work, civil engineering, residential construction, site development, RCC work, and earthwork projects.')
@section('canonical', route('completed.projects'))
@section('og_title', 'Our Projects | ConstructKaro - Completed Construction Projects')
@section('og_description', 'Explore completed and delivered construction projects and civil work handled through ConstructKaro.')
@section('og_image', asset('images/banner.jpg'))
@section('twitter_title', 'Our Projects | ConstructKaro - Completed Construction Projects')
@section('twitter_description', 'Explore completed projects by ConstructKaro across road work, civil engineering, residential construction, site development, RCC work, and earthwork projects.')
@section('twitter_image', asset('images/banner.jpg'))

@php
    $projects = collect($projects ?? []);
    $statuses = ['Completed', 'In Progress', 'Upcoming'];
@endphp

@push('styles')
<style>
.projects-page {
    min-height: 100vh;
    background: #f3f3f3;
    color: #231f20;
    font-family: "Poppins", "Segoe UI", sans-serif;
}

.projects-hero {
    min-height: 170px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 48px 20px;
    background:
        linear-gradient(rgba(19, 11, 11, .66), rgba(19, 11, 11, .66)),
        url("{{ asset('images/banner.jpg') }}") center / cover no-repeat;
}

.projects-hero h1 {
    margin: 0;
    color: #fff;
    font-size: clamp(36px, 5vw, 62px);
    font-weight: 900;
    letter-spacing: 0;
    text-align: center;
    text-transform: uppercase;
}

.projects-shell {
    width: min(94%, 1180px);
    margin: 0 auto;
    padding: 42px 0 64px;
}

.project-tabs {
    display: grid;
    grid-template-columns: repeat(3, minmax(160px, 1fr));
    gap: clamp(28px, 6vw, 72px);
    width: min(720px, 100%);
    margin: 0 auto 42px;
}

.project-tab {
    min-height: 44px;
    border: 1px solid rgba(35, 31, 32, .35);
    border-radius: 8px;
    background: #2b1d1d;
    color: #fff;
    box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .08), 0 2px 4px rgba(0, 0, 0, .28);
    font-size: 17px;
    font-weight: 800;
    cursor: pointer;
    transition: transform .18s ease, box-shadow .18s ease, background .18s ease;
}

.project-tab:hover {
    transform: translateY(-1px);
}

.project-tab.active {
    background: #f37021;
    box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .14), 0 3px 7px rgba(243, 112, 33, .35);
}

.projects-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 34px 28px;
}

.project-card {
    display: block;
    overflow: hidden;
    border-radius: 6px;
    background: transparent;
    text-decoration: none;
    transition: transform .2s ease, box-shadow .2s ease;
}

.project-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(35, 31, 32, .16);
}

.project-card.is-hidden {
    display: none;
}

.project-image {
    display: block;
    width: 100%;
    height: auto;
    object-fit: contain;
}

.projects-empty {
    display: none;
    grid-column: 1 / -1;
    margin: 18px 0 0;
    padding: 28px;
    border-radius: 10px;
    background: rgba(255, 255, 255, .74);
    color: #4b3f3f;
    font-size: 18px;
    font-weight: 800;
    text-align: center;
}

.projects-empty.active {
    display: block;
}

@media (max-width: 991px) {
    .projects-shell {
        width: min(92%, 820px);
    }

    .projects-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 720px) {
    .projects-hero {
        min-height: 130px;
        padding: 36px 16px;
    }

    .project-tabs {
        grid-template-columns: 1fr;
        gap: 14px;
        margin-bottom: 30px;
    }

    .projects-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

@section('content')
<section class="projects-page">
    <div class="projects-hero">
        <h1>Our Projects</h1>
    </div>

    <div class="projects-shell">
        <div class="project-tabs" role="tablist" aria-label="Project status">
            @foreach($statuses as $status)
                <button
                    type="button"
                    class="project-tab {{ $loop->first ? 'active' : '' }}"
                    data-project-tab="{{ $status }}"
                    role="tab"
                    aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                >
                    {{ $status }}
                </button>
            @endforeach
        </div>

        <div class="projects-grid" id="projectsGrid">
            @foreach($projects as $project)
                @php
                    $status = $project->status ?? 'Completed';
                    $imagePath = optional($project->images->first())->image_path ?? 'images/banner.jpg';
                @endphp

                <a class="project-card {{ $status !== 'Completed' ? 'is-hidden' : '' }}" data-project-status="{{ $status }}" id="project-{{ $project->slug }}" href="{{ route('completed.projects.show', $project->slug) }}" aria-label="View details for {{ $project->title }}">
                    <img class="project-image" src="{{ asset($imagePath) }}" alt="{{ $project->title }}">
                </a>
            @endforeach

            <p class="projects-empty" id="projectsEmpty">No projects found.</p>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabs = Array.from(document.querySelectorAll('[data-project-tab]'));
    const cards = Array.from(document.querySelectorAll('[data-project-status]'));
    const empty = document.getElementById('projectsEmpty');

    function showStatus(status) {
        let visibleCount = 0;

        tabs.forEach(function (tab) {
            const isActive = tab.dataset.projectTab === status;
            tab.classList.toggle('active', isActive);
            tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });

        cards.forEach(function (card) {
            const isVisible = card.dataset.projectStatus === status;
            card.classList.toggle('is-hidden', !isVisible);
            if (isVisible) visibleCount += 1;
        });

        if (empty) {
            empty.classList.toggle('active', visibleCount === 0);
        }
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            showStatus(tab.dataset.projectTab);
        });
    });

    showStatus('Completed');
});
</script>
@endpush
