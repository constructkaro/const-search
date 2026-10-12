@extends('layouts.app')

@section('title', 'End-to-End Construction Solutions | ConstructKaro')
@section('meta_description', 'Explore ConstructKaro end-to-end construction solutions for residential homes, commercial buildings, plotting, warehouses, hotels, resorts, colleges, sports complexes, and road work.')

@section('content')
@php
    $solutionBanners = [
        ['title' => 'End-to-End Residential Solution', 'slug' => 'residential-home', 'image' => 'residential-solution.png', 'width' => 7784, 'height' => 2477],
        ['title' => 'End-to-End PEB Warehouse Construction', 'slug' => 'peb-warehouse', 'image' => 'peb-warehouse.jpg', 'width' => 7784, 'height' => 2457],
        ['title' => 'End-to-End RCC Warehouse Construction', 'slug' => 'rcc-warehouse', 'image' => 'rcc-warehouse.jpg', 'width' => 7784, 'height' => 2461],
        ['title' => 'End-to-End Commercial Solution', 'slug' => 'commercial-building', 'image' => 'commercial-building.jpg', 'width' => 7784, 'height' => 2477],
        ['title' => 'End-to-End Hotel Construction Solution', 'slug' => 'hotel', 'image' => 'hotel.jpg', 'width' => 7784, 'height' => 2461],
        ['title' => 'End-to-End Residential Building Solution', 'slug' => 'residential-building', 'image' => 'residential-building.jpg', 'width' => 7784, 'height' => 2477],
        ['title' => 'End-to-End Plotting Development Solution', 'slug' => 'plotting-development', 'image' => 'plotting-development.jpg', 'width' => 7784, 'height' => 2477],
        ['title' => 'End-to-End Resort Construction Solution', 'slug' => 'resort', 'image' => 'resort.jpg', 'width' => 7784, 'height' => 2461],
        ['title' => 'End-to-End Farmhouse Construction Solution', 'slug' => 'farmhouse', 'image' => 'farmhouse.jpg', 'width' => 7784, 'height' => 2461],
        ['title' => 'End-to-End College Construction Solution', 'slug' => 'college-university', 'image' => 'college.jpg', 'width' => 7784, 'height' => 2461],
        ['title' => 'End-to-End Sports Complex Construction Solution', 'slug' => 'sports-complex', 'image' => 'sports-complex.jpg', 'width' => 7784, 'height' => 2385],
    ];

    $categoryCards = [
        ['title' => 'Residential Homes', 'image' => 'residential-homes.png'],
        ['title' => 'Farmhouse', 'image' => 'farmhouse.png'],
        ['title' => 'Residential Building', 'image' => 'residential-building.png'],
        ['title' => 'Commercial Building', 'image' => 'commercial-building.png'],
        ['title' => 'Plotting Development', 'image' => 'plotting-development.png'],
        ['title' => 'PEB Warehouse', 'image' => 'peb-warehouse.png'],
        ['title' => 'RCC Warehouse', 'image' => 'rcc-warehouse.png'],
        ['title' => 'Hotel', 'image' => 'hotel.png'],
        ['title' => 'Resort', 'image' => 'resort.png'],
        ['title' => 'Hospital', 'image' => 'hospital.png'],
        ['title' => 'Sports Complex', 'image' => 'sports-complex.png'],
        ['title' => 'Road Work', 'image' => 'road-work.png'],
    ];
@endphp

<style>
    .ete-page {
        background: #eeeeee;
        color: #242424;
        font-family: 'Inter', Arial, sans-serif;
    }

    .ete-topbar {
        position: sticky;
        top: 0;
        z-index: 20;
        height: 76px;
        display: flex;
        align-items: center;
        padding: 0 64px;
        background: #ededed;
        border-bottom: 1px solid #d9d9d9;
        box-shadow: 0 1px 4px rgba(0,0,0,.08);
    }

    .ete-back {
        width: 43px;
        height: 43px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #1f75bc;
        color: #fff;
        text-decoration: none;
        box-shadow: 0 3px 8px rgba(31, 117, 188, .26);
    }

    .ete-back:hover,
    .ete-back:focus-visible {
        color: #fff;
    }

    .ete-back svg {
        width: 28px;
        height: 28px;
    }

    .ete-banner-list {
        display: grid;
        gap: 38px;
        padding-bottom: 48px;
    }

    .ete-banner-link {
        display: block;
        width: 100%;
        line-height: 0;
        text-decoration: none;
        background: #fff;
        box-shadow: 0 3px 8px rgba(0,0,0,.22);
        overflow: hidden;
    }

    .ete-banner-link img {
        display: block;
        width: 100%;
        aspect-ratio: 7784 / 2477;
        height: auto;
        object-fit: cover;
        object-position: center;
    }

    .ete-card-section {
        padding: 0 74px 72px;
        background: #fff;
    }

    .ete-card-heading {
        max-width: 1180px;
        margin: 0 auto 28px;
        text-align: center;
    }

    .ete-card-heading h2 {
        margin: 0;
        color: #242424;
        font-size: clamp(28px, 3vw, 42px);
        line-height: 1.15;
        font-weight: 900;
    }

    .ete-card-grid {
        max-width: 1780px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 24px;
    }

    .ete-image-card {
        overflow: hidden;
        border-radius: 18px;
        background: #eef4fa;
        box-shadow: 0 4px 8px rgba(16, 36, 58, .28);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .ete-image-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 22px rgba(16, 36, 58, .22);
    }

    .ete-image-card img {
        display: block;
        width: 100%;
        aspect-ratio: 1210 / 892;
        object-fit: cover;
    }

    @media (max-width: 1200px) {
        .ete-topbar {
            padding: 0 32px;
        }

        .ete-banner-list {
            gap: 30px;
        }

        .ete-card-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .ete-card-section {
            padding-left: 40px;
            padding-right: 40px;
        }
    }

    @media (max-width: 768px) {
        .ete-topbar {
            height: 62px;
            padding: 0 18px;
        }

        .ete-back {
            width: 40px;
            height: 40px;
        }

        .ete-banner-list {
            gap: 22px;
            padding-bottom: 32px;
        }

        .ete-card-section {
            padding: 0 16px 44px;
        }

        .ete-card-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .ete-image-card {
            border-radius: 14px;
        }
    }

    @media (max-width: 480px) {
        .ete-card-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="ete-page">
    <div class="ete-topbar">
        <a class="ete-back" href="{{ route('welcome') }}" aria-label="Back to home">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M19 12H5"></path>
                <path d="m12 19-7-7 7-7"></path>
            </svg>
        </a>
    </div>

    <div class="">
        @foreach($solutionBanners as $banner)
            <a class="ete-banner-link" href="{{ route('post', ['work_type_id' => 17, 'solution' => $banner['slug']]) }}" aria-label="{{ $banner['title'] }}">
                <img src="{{ asset('images/home/end-to-end/banners/' . $banner['image']) }}" alt="{{ $banner['title'] }}" width="{{ $banner['width'] }}" height="{{ $banner['height'] }}" loading="{{ $loop->first ? 'eager' : 'lazy' }}" decoding="async">
            </a>
        @endforeach
    </div>

   
</div>
@endsection
