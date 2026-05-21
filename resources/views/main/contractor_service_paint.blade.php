@extends('layouts.app')

@section('meta_title', 'Paint Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane | ConstructKaro')
@section('meta_description', 'Paint Contractor Services for interior painting, exterior painting, wall preparation, decorative finishes, waterproof coatings and commercial painting.')
@section('title', 'Paint Contractor Services | ConstructKaro')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --pc-blue: #0a82d9;
        --pc-orange: #f27a21;
        --pc-bg: #ededed;
        --pc-text: #111;
        --pc-muted: #4b5563;
        --pc-line: #cfd6de;
        --pc-white: #fff;
    }

    body {
        background: var(--pc-bg);
        font-family: "Inter", "Segoe UI", sans-serif;
        color: var(--pc-text);
    }

    .pc-page {
        background: var(--pc-bg);
        padding-bottom: 44px;
    }

    .pc-wrap {
        width: min(1180px, calc(100% - 44px));
        margin: 0 auto;
    }

    .pc-hero {
        min-height: 300px;
        display: flex;
        align-items: center;
        background:
            /* linear-gradient(90deg, rgba(0,0,0,.86) 0%, rgba(0,0,0,.52) 38%, rgba(0,0,0,.10) 100%), */
            url("{{ asset('images/logo/pc1.png') }}") center / cover no-repeat;
    }

    .pc-hero h1 {
        max-width: 660px;
        margin: 0;
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-size: clamp(34px, 4vw, 58px);
        font-weight: 900;
        line-height: 1.05;
    }

    .pc-section {
        padding: 44px 0 0;
    }

    .pc-title {
        margin: 0 0 10px;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: clamp(24px, 2.4vw, 34px);
        font-weight: 900;
        line-height: 1.2;
        text-align: center;
    }

    .pc-title.left {
        text-align: left;
    }

    .pc-line {
        width: 76px;
        height: 3px;
        margin: 0 auto 22px;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--pc-orange), var(--pc-blue));
    }

    .pc-copy {
        color: #3f4650;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.7;
    }

    .pc-copy.narrow {
        max-width: 1050px;
        margin: 0 auto;
    }

    .pc-copy p {
        margin: 0 0 12px;
    }

    .pc-chip-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 18px;
        margin-top: 24px;
    }

    .pc-chip {
        min-height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 14px 16px;
        border: 2px solid var(--pc-blue);
        border-radius: 8px;
        background: #eaf6ff;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: 14px;
        font-weight: 900;
        line-height: 1.2;
        text-align: center;
        box-shadow: 0 6px 16px rgba(17,24,39,.08);
    }

    .pc-chip:nth-child(even) {
        border-color: var(--pc-orange);
        background: #fff0e5;
    }

    .pc-number-grid {
        max-width: 980px;
        margin: 28px auto 0;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 28px;
    }

    .pc-number-card {
        min-height: 150px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 32px 18px 20px;
        border: 2px solid var(--pc-orange);
        border-radius: 8px;
        background: #fff0e5;
        color: #111;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.35;
        text-align: center;
    }

    .pc-number-card:nth-child(even) {
        border-color: var(--pc-blue);
        background: #eaf6ff;
    }

    .pc-num {
        min-width: 28px;
        height: 28px;
        position: absolute;
        top: -14px;
        left: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transform: translateX(-50%);
        border-radius: 8px;
        background: var(--pc-orange);
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-weight: 900;
    }

    .pc-number-card:nth-child(even) .pc-num {
        background: var(--pc-blue);
    }

    .pc-number-card strong {
        display: block;
        margin-bottom: 8px;
        font-family: "Manrope", sans-serif;
        font-size: 14px;
        font-weight: 900;
    }

    .pc-project-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-top: 22px;
    }

    .pc-project {
        overflow: hidden;
        border: 2px solid var(--pc-blue);
        border-radius: 8px;
        background: #eaf6ff;
        box-shadow: 0 6px 16px rgba(17,24,39,.10);
    }

    .pc-project:nth-child(odd) {
        border-color: var(--pc-orange);
        background: #fff0e5;
    }

    .pc-project img {
        width: 100%;
        aspect-ratio: 1.25 / 1;
        display: block;
        object-fit: cover;
    }

    .pc-project h3 {
        min-height: 48px;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8px;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: 13px;
        font-weight: 900;
        line-height: 1.15;
        text-align: center;
    }

    .pc-checks {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 18px;
        margin-top: 18px;
        color: #111;
        font-size: 13px;
        font-weight: 800;
        line-height: 1.35;
        text-align: center;
    }

    .pc-process {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 12px;
        margin-top: 20px;
    }

    .pc-step {
        min-height: 62px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: 12px;
        font-weight: 900;
        line-height: 1.15;
        text-align: center;
    }

    .pc-faq-list {
        max-width: 900px;
        margin: 24px auto 0;
        display: grid;
        gap: 12px;
    }

    .pc-faq {
        overflow: hidden;
        border: 1px solid var(--pc-line);
        border-radius: 6px;
        background: var(--pc-white);
        box-shadow: 0 4px 12px rgba(17,24,39,.10);
    }

    .pc-faq button {
        width: 100%;
        min-height: 52px;
        padding: 14px 20px;
        border: 0;
        background: transparent;
        cursor: pointer;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: 14px;
        font-weight: 900;
        text-align: left;
    }

    .pc-faq-answer {
        display: none;
        padding: 0 20px 16px;
        color: var(--pc-muted);
        font-size: 14px;
        font-weight: 500;
        line-height: 1.6;
    }

    .pc-faq.open .pc-faq-answer {
        display: block;
    }

    @media (max-width: 980px) {
        .pc-chip-grid,
        .pc-project-grid,
        .pc-number-grid,
        .pc-checks,
        .pc-process {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .pc-wrap {
            width: calc(100% - 24px);
        }

        .pc-hero {
            min-height: 240px;
        }

        .pc-hero h1 {
            font-size: 34px;
        }

        .pc-chip-grid,
        .pc-project-grid,
        .pc-number-grid,
        .pc-checks,
        .pc-process {
            grid-template-columns: 1fr;
        }
    }
</style>

@php
    $scope = [
        'Interior & exterior painting',
        'Wall preparation & putty work',
        'Texture & decorative finishes',
        'Waterproof & protective coatings',
        'Industrial & commercial painting solutions',
    ];

    $services = [
        ['title' => 'Interior Painting Services', 'items' => ['Wall putty and surface preparation', 'Emulsion and premium paint finishing', 'Texture and decorative wall coatings', 'Ceiling and repainting work']],
        ['title' => 'Exterior Painting Services', 'items' => ['Weather-resistant exterior coating', 'Acrylic and elastomeric paints', 'Scaffolding and safety painting', 'Long-lasting exterior protection']],
        ['title' => 'Commercial Painting Services', 'items' => ['Office and showroom painting', 'Retail and commercial complex painting', 'Corporate branding finishes', 'Large-area commercial coating work']],
        ['title' => 'Industrial Painting Services', 'items' => ['Industrial protective coatings', 'Factory and warehouse painting', 'Anti-corrosion coating systems', 'Heavy-duty industrial finishes']],
        ['title' => 'Waterproof & Protective Coatings', 'items' => ['Damp-proof coatings', 'Terrace and wall waterproof painting', 'Heat-reflective coatings', 'Protective chemical-resistant coatings']],
    ];

    $projects = [
        ['title' => 'Residential Painting Projects', 'img' => 'images/logo/pc2.png'],
        ['title' => 'Commercial Painting Projects', 'img' => 'images/logo/pc3.png'],
        ['title' => 'Industrial Painting Projects', 'img' => 'images/logo/pc4.png'],
        ['title' => 'Texture & Decorative Painting', 'img' => 'images/logo/pc5.png'],
    ];

    $faqs = [
        ['q' => '1. What types of painting services do you provide?', 'a' => 'We support interior painting, exterior painting, texture finishes, decorative painting, waterproof coatings, industrial coatings and commercial painting work.'],
        ['q' => '2. Do you provide waterproof coatings?', 'a' => 'Yes. Waterproof coatings for terraces, walls, damp areas and protective exterior surfaces can be coordinated.'],
        ['q' => '3. Can you handle commercial and industrial painting projects?', 'a' => 'Yes. We can help with offices, showrooms, commercial buildings, factories, warehouses and industrial coating projects.'],
        ['q' => '4. Do you help with color selection?', 'a' => 'Yes. Contractors can support shade selection, finish recommendations and paint system guidance based on surface and usage.'],
        ['q' => '5. How do you ensure paint quality?', 'a' => 'Quality is supported through surface preparation, correct primer and paint system use, skilled applicators and final finishing checks.'],
    ];
@endphp

<main class="pc-page">
    <section class="pc-hero">
        <div class="pc-wrap">
            <!-- <h1>Paint Contractor</h1> -->
        </div>
    </section>

    <section class="pc-section">
        <div class="pc-wrap pc-copy narrow">
            <h2 class="pc-title">Paint Contractor Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane</h2>
            <p>Painting is not just about color. It protects surfaces, improves aesthetics, and enhances the overall value of your property. At ConstructKaro, we connect you with verified and experienced Paint Contractors for homes, offices, commercial buildings, industrial facilities, and infrastructure projects.</p>
            <p>From interior painting to exterior coatings and waterproof protective finishes, we help ensure smooth execution with quality workmanship and durable results.</p>
        </div>
    </section>

    <section class="pc-section">
        <div class="pc-wrap">
            <h2 class="pc-title">What Does a Paint Contractor Do?</h2>
            <div class="pc-line"></div>
            <p class="pc-copy">A paint contractor handles:</p>

            <div class="pc-chip-grid">
                @foreach($scope as $item)
                    <div class="pc-chip">{{ $item }}</div>
                @endforeach
            </div>

            <p class="pc-copy" style="margin-top: 14px;">These systems are critical for the functionality, safety, and efficiency of any property.</p>
        </div>
    </section>

    <section class="pc-section">
        <div class="pc-wrap">
            <h2 class="pc-title">Our Paint Contractor Services Include</h2>
            <div class="pc-line"></div>

            <div class="pc-number-grid">
                @foreach($services as $index => $service)
                    <article class="pc-number-card">
                        <span class="pc-num">{{ $index + 1 }}</span>
                        <div>
                            <strong>{{ $service['title'] }}</strong>
                            @foreach($service['items'] as $item)
                                <div>- {{ $item }}</div>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="pc-section">
        <div class="pc-wrap">
            <h2 class="pc-title">Types of Painting Projects</h2>
            <div class="pc-line"></div>

            <div class="pc-project-grid">
                @foreach($projects as $project)
                    <!-- <article class="pc-project"> -->
                        <img src="{{ asset($project['img']) }}" alt="{{ $project['title'] }}">
                        <!-- <h3>{{ $project['title'] }}</h3> -->
                    <!-- </article> -->
                @endforeach
            </div>
        </div>
    </section>

    <section class="pc-section">
        <div class="pc-wrap">
            <h2 class="pc-title">Why Choose ConstructKaro?</h2>
            <div class="pc-line"></div>
            <div class="pc-checks">
                <div>&#10003; Verified paint contractors</div>
                <div>&#10003; Quality-focused painting execution</div>
                <div>&#10003; Interior and exterior painting support</div>
                <div>&#10003; Waterproof and protective coating solutions</div>
                <div>&#10003; Suitable for residential and commercial projects</div>
            </div>
            <p class="pc-copy" style="margin-top: 18px;">We help ensure your painting work is smooth, durable, and professionally finished.</p>
        </div>
    </section>

    <section class="pc-section">
        <div class="pc-wrap">
            <h2 class="pc-title">Our Execution Process</h2>
            <div class="pc-line"></div>
            <div class="pc-process">
                <div class="pc-step">1. Requirement Discussion</div>
                <div class="pc-step">2. Site Inspection & Surface Analysis</div>
                <div class="pc-step">3. Material & Color Selection</div>
                <div class="pc-step">4. Contractor Assignment</div>
                <div class="pc-step">5. Painting Execution</div>
                <div class="pc-step">6. Final Finishing & Quality Check</div>
            </div>
        </div>
    </section>

    <section class="pc-section">
        <div class="pc-wrap pc-copy narrow">
            <h2 class="pc-title left">Target Locations We Serve</h2>
            <p>Paint Contractor in Navi Mumbai | Painting Services in Mumbai | Interior Painting Contractor in Pune | Exterior Paint Contractor in Raigad | Industrial Painting Contractor in Thane</p>
            <p>Also serving Panvel, Kharghar, Taloja, Mahape, Karjat, Khopoli and nearby areas.</p>
        </div>
    </section>

    <section class="pc-section">
        <div class="pc-wrap">
            <h2 class="pc-title">Frequently Asked Questions (FAQs)</h2>
            <div class="pc-line"></div>

            <div class="pc-faq-list">
                @foreach($faqs as $index => $faq)
                    <article class="pc-faq" id="pc-faq-{{ $index }}">
                        <button type="button" onclick="togglePaintFaq({{ $index }})">{{ $faq['q'] }}</button>
                        <div class="pc-faq-answer">{{ $faq['a'] }}</div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>

<script>
    function togglePaintFaq(index) {
        const item = document.getElementById('pc-faq-' + index);
        const wasOpen = item.classList.contains('open');

        document.querySelectorAll('.pc-faq').forEach(function (faqItem) {
            faqItem.classList.remove('open');
        });

        if (!wasOpen) {
            item.classList.add('open');
        }
    }
</script>

@endsection
