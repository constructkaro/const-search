@extends('layouts.app')

@section('title', $service['title'] ?? 'Farmhouse Design Services')

@section('content')
<style>
    .fh-page,
    .fh-page * {
        box-sizing: border-box;
    }

    .fh-page {
        background: #eeeeee;
        color: #20242c;
        font-family: "Poppins", "Segoe UI", sans-serif;
        overflow: hidden;
    }

    .fh-hero {
        position: relative;
        min-height: 360px;
        display: flex;
        align-items: center;
        background: #111;
        overflow: hidden;
    }

    .fh-hero img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .fh-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(0,0,0,.86), rgba(0,0,0,.58) 42%, rgba(0,0,0,.05));
    }

    .fh-hero-content {
        position: relative;
        z-index: 2;
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .fh-hero h1 {
        max-width: 680px;
        margin: 0;
        color: #fff;
        font-size: clamp(29px, 4.1vw, 52px);
        line-height: 1.18;
        font-weight: 900;
        text-shadow: 0 5px 18px rgba(0,0,0,.45);
    }

    .fh-section {
        padding: 48px 0;
        background: #eeeeee;
    }

    .fh-section.white {
        background: #fff;
    }

    .fh-container {
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .fh-title {
        margin: 0;
        color: #171923;
        font-size: clamp(24px, 3vw, 34px);
        line-height: 1.25;
        font-weight: 900;
        text-align: center;
    }

    .fh-line {
        width: min(560px, 72%);
        height: 4px;
        margin: 13px auto 30px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f27524 0%, #f27524 40%, #1f73b8 100%);
    }

    .fh-copy {
        max-width: 1080px;
        margin: 0 auto;
        color: #4d5562;
        font-size: 15px;
        line-height: 1.75;
        font-weight: 500;
    }

    .fh-copy p {
        margin: 0 0 14px;
    }

    .fh-copy strong {
        color: #20242c;
        font-weight: 900;
    }

    .fh-service-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 15px;
        max-width: 1235px;
        margin-top: 45px;
        margin-left: auto;
        margin-right: auto;
        align-items: start;
    }

    .fh-service-card {
        min-height: 210px;
        padding: 18px 14px;
        border: 2px solid #f27524;
        border-radius: 8px;
        background: #fff0e4;
        box-shadow: 0 8px 16px rgba(28,44,62,.13);
        text-align: center;
    }

    .fh-service-card.blue {
        border-color: #1f73b8;
        background: #eaf4ff;
    }

    .fh-num {
        width: 32px;
        height: 32px;
        margin: 0 auto 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        background: #f27524;
        color: #fff;
        font-size: 16px;
        font-weight: 900;
    }

    .fh-service-card.blue .fh-num {
        background: #1f73b8;
    }

    .fh-service-card h3 {
        min-height: 38px;
        margin: 0 0 10px;
        color: #f27524;
        font-size: 15px;
        line-height: 1.25;
        font-weight: 900;
    }

    .fh-service-card.blue h3 {
        color: #1f73b8;
    }

    .fh-service-card p {
        margin: 0;
        color: #343b46;
        font-size: 12.5px;
        line-height: 1.45;
        font-weight: 600;
    }

    .fh-service-image {
        width: 100%;
        aspect-ratio: 1.22 / 1;
        display: block;
        object-fit: cover;
        border: 2px solid #f27524;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 8px 16px rgba(28,44,62,.13);
    }

    .fh-service-image.blue {
        border-color: #1f73b8;
    }

    .fh-service-grid > img {
        width: 100%;
        aspect-ratio: 455 / 289;
        display: block;
        object-fit: contain;
        border-radius: 8px;
        background: transparent;
        box-shadow: 0 8px 16px rgba(28,44,62,.13);
    }

    .fh-card-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 30px 42px;
        max-width: 960px;
        margin: 34px auto 0;
    }

    .fh-card-grid.five {
        grid-template-columns: repeat(6, minmax(0, 1fr));
    }

    .fh-image-card {
        grid-column: span 2;
        overflow: hidden;
        border: 2px solid #1f73b8;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 8px 16px rgba(28,44,62,.16);
    }

    .fh-image-card.orange {
        border-color: #f27524;
    }

    .fh-image-card.offset {
        grid-column: 2 / span 2;
    }

    .fh-image-card img {
        width: 100%;
        aspect-ratio: 1.35 / 1;
        display: block;
        object-fit: cover;
    }

    .fh-card-grid.five .fh-image-card img {
        aspect-ratio: 1.28 / 1;
    }

   .fh-bedroom-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 15px;
    max-width: 1205px;
    margin: 36px auto 0;
    align-items: start;
}

    .fh-bedroom-image {
        width: 100%;
        aspect-ratio: 412 / 379;
        display: block;
        object-fit: contain;
    }

    .fh-style-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px;
        max-width: 1040px;
        margin: 34px auto 0;
        align-items: start;
    }

    .fh-style-image {
        width: 100%;
        aspect-ratio: 572 / 471;
        display: block;
        object-fit: contain;
    }

    .fh-label {
        min-height: 44px;
        padding: 11px 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #20242c;
        font-size: 13px;
        line-height: 1.2;
        font-weight: 900;
        text-align: center;
    }

    .fh-faq {
        max-width: 1040px;
        margin: 30px auto 0;
        display: grid;
        gap: 12px;
    }

    .fh-faq details {
        border: 1px solid #d8dce2;
        border-radius: 7px;
        background: #fff;
        box-shadow: 0 5px 12px rgba(28,44,62,.08);
    }

    .fh-faq summary {
        cursor: pointer;
        padding: 15px 18px;
        color: #20242c;
        font-size: 14px;
        font-weight: 900;
    }

    .fh-faq p {
        margin: 0;
        padding: 0 18px 16px;
        color: #4d5562;
        font-size: 13.5px;
        line-height: 1.6;
        font-weight: 600;
    }

    @media (max-width: 991px) {
        .fh-service-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .fh-bedroom-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            max-width: 680px;
        }

        .fh-style-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            max-width: 780px;
        }

        .fh-card-grid,
        .fh-card-grid.five {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            max-width: 700px;
        }

        .fh-image-card,
        .fh-image-card.offset {
            grid-column: auto;
        }
    }

    @media (max-width: 640px) {
        .fh-hero {
            min-height: 290px;
        }

        .fh-section {
            padding: 42px 0;
        }

        .fh-service-grid,
        .fh-card-grid,
        .fh-card-grid.five,
        .fh-bedroom-grid,
        .fh-style-grid {
            grid-template-columns: 1fr;
        }

        .fh-bedroom-grid {
            max-width: 330px;
            gap: 22px;
        }

        .fh-style-grid {
            max-width: 340px;
            gap: 22px;
        }
    }
</style>

<div class="fh-page">
    <section class="fh-hero">
        <img src="{{ asset('images/logo/bv1.png') }}" alt="Farmhouse design services">
        <div class="fh-hero-content">
            <h1>
                Farmhouse Design Services in<br>
                Navi Mumbai, Mumbai, Thane,<br>
                Pune &amp; Raigad
            </h1>
        </div>
    </section>

    <section class="fh-section white">
        <div class="fh-container">
            <h2 class="fh-title">Farmhouse Design Services In Navi Mumbai,<br> Mumbai, Raigad, Thane &amp; Pune</h2>
            <div class="fh-line"></div>

            <div class="fh-copy">
                <p>
                    Looking to build a peaceful getaway or a luxurious countryside home? At <strong>ConstructKaro</strong>, we offer professional <strong>farmhouse design services</strong> tailored to your land, lifestyle, and budget. Whether it is a weekend retreat near Karjat or a luxury farmhouse in Pune, we connect you with the right architects and designers to bring your vision to life.
                </p>
                <p>
                    From concept planning to detailed drawings, our structured approach ensures your farmhouse is functional, aesthetic, and future-ready.
                </p>
            </div>
        </div>
    </section>

    <section class="fh-section">
        <div class="fh-container">
            <h2 class="fh-title">What is Farmhouse Design?</h2>
            <div class="fh-line"></div>

            <div class="fh-copy">
                <p>
                    Farmhouse design focuses on creating homes that blend nature, comfort, and modern living. It combines open spaces, natural materials, and elegant simplicity to give you a relaxing and premium living experience.
                </p>
                <p>
                    At ConstructKaro, we do not just design. We guide you through the entire process with verified professionals and clear execution steps.
                </p>
            </div>
        </div>
    </section>

    <section class="fh-section white">
        <div class="fh-container">
            <h2 class="fh-title">Our Farmhouse Design Services Include</h2>
            <div class="fh-line"></div>

            @php
                $farmhouseServices = [
                    ['color' => 'orange', 'image' => asset('images/logo/fh1.png'), 'alt' => 'Layout planning and concept design'],
                    ['color' => 'blue', 'image' => asset('images/logo/fh2.png'), 'alt' => '2D and 3D farmhouse design'],
                    ['color' => 'orange', 'image' => asset('images/logo/fh3.png'), 'alt' => 'Farmhouse working drawings'],
                    ['color' => 'blue', 'image' => asset('images/logo/fh4.png'), 'alt' => 'Style based farmhouse design customization'],
                ];
            @endphp

            <div class="fh-service-grid">
                @foreach($farmhouseServices as $item)
                    <img
                       
                        src="{{ $item['image'] }}"
                        alt="{{ $item['alt'] }}"
                    >
                @endforeach
            </div>
        </div>
    </section>

    <section class="fh-section">
        <div class="fh-container">
            <h2 class="fh-title">Farmhouse Design Options Based on Bedrooms</h2>
            <div class="fh-line"></div>

            @php
                $bedroomPlans = [
                    ['image' => asset('images/logo/fh5.png'), 'title' => '2 Bedroom Farmhouse Plan', 'alt' => '2 bedroom farmhouse plan'],
                    ['image' => asset('images/logo/fh6.png'), 'title' => '3 Bedroom Farmhouse Plan', 'alt' => '3 bedroom farmhouse plan'],
                    ['image' => asset('images/logo/fh7.png'), 'title' => '4 Bedroom Farmhouse Plan', 'alt' => '4 bedroom farmhouse plan'],
                    ['image' => asset('images/logo/fh8.png'), 'title' => '5 Bedroom Farmhouse Plan', 'alt' => '5 bedroom farmhouse plan'],
                    ['image' => asset('images/logo/fh9.png'), 'title' => '6 Bedroom Farmhouse Plan', 'alt' => '6 bedroom farmhouse plan'],
                ];
            @endphp

            <div class="fh-bedroom-grid">
                @foreach($bedroomPlans as $plan)
                    <img class="fh-bedroom-image" src="{{ $plan['image'] }}" alt="{{ $plan['alt'] }}">
                @endforeach
            </div>
        </div>
    </section>

    <section class="fh-section white">
        <div class="fh-container">
            <h2 class="fh-title">Types of Farmhouse Design Styles</h2>
            <div class="fh-line"></div>

            @php
                $stylePlans = [
                    ['image' => asset('images/logo/fh10.png'), 'title' => 'Modern Farmhouse Design', 'alt' => 'Modern farmhouse design'],
                    ['image' => asset('images/logo/fh11.png'), 'title' => 'Coastal Farmhouse Plans', 'alt' => 'Coastal farmhouse plans'],
                    ['image' => asset('images/logo/fh12.png'), 'title' => 'Cottage Farmhouse Plans', 'alt' => 'Cottage farmhouse plans'],
                    ['image' => asset('images/logo/fh13.png'), 'title' => 'Colonial Farmhouse Plans', 'alt' => 'Colonial farmhouse plans'],
                    ['image' => asset('images/logo/fh14.png'), 'title' => 'Classic Farmhouse Plans', 'alt' => 'Classic farmhouse plans'],
                ];
            @endphp

            <div class="fh-style-grid">
                @foreach($stylePlans as $plan)
                    <img class="fh-style-image" src="{{ $plan['image'] }}" alt="{{ $plan['alt'] }}">
                @endforeach
            </div>
        </div>
    </section>

    <section class="fh-section">
        <div class="fh-container">
            <h2 class="fh-title">Frequently Asked Questions (FAQs)</h2>
            <div class="fh-line"></div>

            <div class="fh-faq">
                <details>
                    <summary>1. What is the cost of farmhouse design?</summary>
                    <p>The cost depends on plot size, number of rooms, design style, drawing scope, and 3D visualization requirements.</p>
                </details>
                <details>
                    <summary>2. Can I build a farmhouse on agricultural land?</summary>
                    <p>Rules vary by location and land type. Our team can help you understand the planning and approval support required for your area.</p>
                </details>
                <details>
                    <summary>3. Do you provide both design and construction?</summary>
                    <p>We coordinate design requirements and can connect you with suitable execution partners based on project scope and location.</p>
                </details>
                <details>
                    <summary>4. How long does farmhouse design take?</summary>
                    <p>Basic concepts can be prepared faster, while detailed 2D, 3D, and working drawings depend on revisions and project complexity.</p>
                </details>
                <details>
                    <summary>5. Do you provide 3D elevation designs?</summary>
                    <p>Yes, 3D elevation and visualization support can be included so you can review the farmhouse look before execution.</p>
                </details>
            </div>
        </div>
    </section>
</div>
@endsection
