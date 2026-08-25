@extends('layouts.app')

@section('title', 'Our Projects | ConstructKaro - Completed Construction Projects')
@section('meta_description', 'Explore completed projects by ConstructKaro across road work, civil engineering, industrial infrastructure, residential construction, site development, RCC work, and earthwork projects.')
@section('canonical', route('completed.projects'))
@section('og_title', 'Our Projects | ConstructKaro - Completed Construction Projects')
@section('og_description', 'Explore completed and delivered construction projects and civil work handled through ConstructKaro.')
@section('og_image', asset('images/banner.jpg'))
@section('twitter_title', 'Our Projects | ConstructKaro - Completed Construction Projects')
@section('twitter_description', 'Explore completed projects by ConstructKaro across road work, civil engineering, industrial infrastructure, residential construction, site development, RCC work, and earthwork projects.')
@section('twitter_image', asset('images/banner.jpg'))

@php
    $projects = $projects ?? collect([
        [
            'title' => 'Emergency Staircase, Pit and Chambers',
            'description' => 'Emergency Staircase, Pit and Chambers',
            'image' => 'project/bans/1.png',
        ],
        [
            'title' => 'Road work & Storm water drain',
            'description' => 'Godrej',
            'image' => 'project/godrej/1.jpg',
        ],
        [
            'title' => 'Civil & Infra Activity',
            'description' => 'Civil & Infra Activity',
            'image' => 'project/civilkalote/1.jpeg',
        ],
        [
            'title' => 'CNS Industrial Laundry Extension',
            'description' => 'CNS Industrial Laundry Extension',
            'image' => 'project/CNS/1.jpeg',
        ],
        [
            'title' => 'Strengthening and Retrofitting Work',
            'description' => 'Oriental Aromatics',
            'image' => 'project/John/1.jpg',
        ],
        [
            'title' => 'Site Development',
            'description' => 'Fountain Industries',
            'image' => 'project/site/1.png',
        ],
        [
            'title' => 'RCC Cable Trench',
            'description' => 'RCC Cable Trench',
            'image' => 'project/rcf/1.jpeg',
        ],
        [
            'title' => 'Land Development',
            'description' => 'Orbit Engineering Co. Ltd.',
            'image' => 'project/isro/1.jpeg',
        ],
        [
            'title' => 'Civil and Allied Activities at Various Locations',
            'description' => 'Civil and allied activities at various locations',
            'image' => 'project/ste/1.jpg',
        ],
        [
            'title' => 'Earthwork of 2.75 Pipe at Khopoli',
            'description' => 'Nagothane Ethane Pipeline Project',
            'image' => 'project/Warai/1.jpg',
        ],
        [
            'title' => 'RCC Core and Shell Work',
            'description' => 'Front Engine',
            'image' => 'project/building/1.JPG',
        ],
        [
            'title' => 'Earth Work and Infra Work',
            'description' => 'Maharashtra State Road Project',
            'image' => 'project/center_rail/1.jpg',
        ],
        [
            'title' => 'RCC Flooring Work at JNHS',
            'description' => 'JNHS Ltd.',
            'image' => 'project/jsw/1.jpg',
        ],
        [
            'title' => 'Building Project',
            'description' => 'Apartment / Building Project',
            'image' => 'project/building/2.JPG',
        ],
        [
            'title' => 'Factory Shed Work',
            'description' => 'Factory Shed Work',
            'image' => 'project/fac_shead/1.png',
        ],
        [
            'title' => 'Site Development',
            'description' => 'Lodha Group',
            'image' => 'project/kalptaru/1.jpg',
        ],
        [
            'title' => 'Internal Road Project Phase I and II',
            'description' => 'A.P. Mavala, Nerul',
            'image' => 'project/loha/1.png',
        ],
        [
            'title' => 'Construction of Minor Bridge and Earthwork',
            'description' => 'Mumbai-Ahmedabad High Speed Rail',
            'image' => 'project/rmhs/1.png',
        ],
        [
            'title' => 'Road Work for Kotwal Project Area at JNPT',
            'description' => 'JNPT / JN Port Authority',
            'image' => 'project/expat/1.jpg',
        ],
        [
            'title' => 'Bungalow Construction Work',
            'description' => 'Residential bungalow construction work',
            'image' => 'project/banglo/1.png',
        ],
        [
            'title' => 'Project Timeline and Progress',
            'description' => 'Project progress video documentation',
            'image' => 'images/banner.jpg',
        ],
    ])->map(function ($project) {
        return (object) [
            'title' => $project['title'],
            'slug' => \Illuminate\Support\Str::slug($project['title']),
            'description' => $project['description'],
            'images' => collect([(object) ['image_path' => $project['image']]]),
        ];
    });
@endphp

@push('styles')
<style>
.projects-page {
    background: #fff;
    padding: 46px 0 76px;
}

.projects-container {
    width: min(84%, 1540px);
    margin: 0 auto;
}

.projects-title {
    margin: 0 0 42px;
    color: #0f1f33;
    font-size: 36px;
    font-weight: 900;
    line-height: 1.2;
    text-align: center;
}

.projects-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 42px;
}

.project-card {
    overflow: hidden;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    background: #fff;
    box-shadow: 0 12px 28px rgba(15, 23, 42, .12);
    transition: transform .22s ease, box-shadow .22s ease;
}

.project-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 18px 36px rgba(15, 23, 42, .16);
}

.project-card img {
    width: 100%;
    height: 320px;
    object-fit: cover;
    display: block;
}

.project-card-body {
    padding: 34px 32px 32px;
}

.project-card h3 {
    margin: 0 0 12px;
    color: #06182d;
    font-size: 23px;
    font-weight: 800;
    line-height: 1.3;
}

.project-card p {
    margin: 0 0 18px;
    color: #334155;
    font-size: 16px;
    line-height: 1.55;
}

.project-card a {
    color: #c77a00;
    font-size: 17px;
    font-weight: 800;
    text-decoration: none;
}

.project-card a:hover {
    color: #9f5f00;
}

.projects-empty {
    grid-column: 1 / -1;
    text-align: center;
    color: #4b5563;
}

@media (max-width: 991px) {
    .projects-container {
        width: min(92%, 1280px);
    }

    .projects-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 28px;
    }

    .project-card img {
        height: 260px;
    }

    .project-card-body {
        padding: 24px;
    }
}

@media (max-width: 576px) {
    .projects-page {
        padding: 36px 0 56px;
    }

    .projects-title {
        margin-bottom: 28px;
        font-size: 30px;
    }

    .projects-grid {
        grid-template-columns: 1fr;
        gap: 24px;
    }

    .project-card img {
        height: 220px;
    }

    .project-card-body {
        padding: 22px;
    }

    .project-card h3 {
        font-size: 20px;
    }

    .project-card p,
    .project-card a {
        font-size: 14px;
    }
}
</style>
@endpush

@section('content')
<section class="projects-page">
    <div class="projects-container">
        <h1 class="projects-title">Our Projects</h1>

        {{-- Optional Filter Buttons --}}
        {{--
        <div class="flex justify-center gap-4 mb-10">
            <a href="{{ route('completed.projects') }}" class="bg-yellow-400 text-gray-800 px-4 py-2 rounded-lg font-medium">All</a>
            <a href="#" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium">Roads</a>
            <a href="#" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium">Residential</a>
            <a href="#" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium">Industrial</a>
        </div>
        --}}

        @php
            $projectsWithImages = $projects->filter(fn($p) => $p->images->first());
            $projectsWithoutImages = $projects->filter(fn($p) => !$p->images->first());
        @endphp

        <div class="projects-grid">
            {{-- Projects with images --}}
            @foreach($projectsWithImages as $project)
                <div class="project-card" id="project-{{ $project->slug }}">
                    <img src="{{ asset($project->images->first()->image_path) }}"
                         alt="{{ $project->title }}">
                    <div class="project-card-body">
                        <h3>{{ $project->title }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit($project->description, 80) }}</p>
                        <a href="{{ route('completed.projects.show', $project->slug) }}">View Details &rarr;</a>
                    </div>
                </div>
            @endforeach

            {{-- Projects without images (placeholder) --}}
            @foreach($projectsWithoutImages as $project)
                <div class="project-card" id="project-{{ $project->slug }}">
                    <img src="{{ asset('images/banner.jpg') }}"
                         alt="Placeholder">
                    <div class="project-card-body">
                        <h3>{{ $project->title }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit($project->description, 80) }}</p>
                        <a href="{{ route('completed.projects.show', $project->slug) }}">View Details &rarr;</a>
                    </div>
                </div>
            @endforeach

            @if($projects->isEmpty())
                <p class="projects-empty">No projects found.</p>
            @endif
        </div>
    </div>
</section>
@endsection
