@extends('layouts.app')

@section('title', $service['title'] ?? 'Concept Design Services')

@section('content')
<style>
    .cd-page,
    .cd-page * {
        box-sizing: border-box;
    }

    .cd-page {
        background: #eeeeee;
        color: #20242c;
        font-family: "Poppins", "Segoe UI", sans-serif;
        overflow: hidden;
    }

    .cd-hero {
        position: relative;
        min-height: 360px;
        display: flex;
        align-items: center;
        background: #111;
        overflow: hidden;
    }

    .cd-hero img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .cd-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(0,0,0,.88), rgba(0,0,0,.58) 44%, rgba(0,0,0,.06));
    }

    .cd-hero-content {
        position: relative;
        z-index: 2;
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .cd-hero h1 {
        max-width: 680px;
        margin: 0;
        color: #fff;
        font-size: clamp(28px, 4vw, 50px);
        line-height: 1.18;
        font-weight: 900;
        text-shadow: 0 5px 18px rgba(0,0,0,.45);
    }

    .cd-section {
        padding: 48px 0;
        background: #eeeeee;
    }

    .cd-section.white {
        background: #fff;
    }

    .cd-container {
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .cd-title {
        margin: 0;
        color: #171923;
        font-size: clamp(23px, 3vw, 33px);
        line-height: 1.25;
        font-weight: 900;
        text-align: center;
    }

    .cd-line {
        width: min(560px, 72%);
        height: 4px;
        margin: 13px auto 30px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f27524 0%, #f27524 40%, #1f73b8 100%);
    }

    .cd-copy {
        max-width: 1080px;
        margin: 0 auto;
        color: #4d5562;
        font-size: 17px;
        line-height: 1.75;
        font-weight: 600;
    }

    .cd-copy p {
        margin: 0 0 14px;
    }

    .cd-copy strong {
        color: #20242c;
        font-weight: 900;
    }

    .cd-value-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 22px;
        max-width: 1040px;
        margin: 30px auto 0;
    }

    .cd-value {
        min-height: 68px;
        padding: 14px 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #1f73b8;
        border-radius: 6px;
        background: #fff;
        color: #20242c;
        font-size: 14px;
        line-height: 1.25;
        font-weight: 900;
        text-align: center;
        box-shadow: 0 6px 12px rgba(28,44,62,.08);
    }

    .cd-value.orange {
        border-color: #f27524;
    }

    .cd-service-grid {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 24px;
        max-width: 1080px;
        margin: 42px auto 0;
    }

    .cd-service-card {
        grid-column: span 2;
        position: relative;
        min-height: 205px;
        padding: 36px 22px 24px;
        border: 2px solid #f27524;
        border-radius: 8px;
        background: #fff0e4;
        box-shadow: 0 8px 16px rgba(28,44,62,.13);
        text-align: center;
    }

    .cd-service-card.blue {
        border-color: #1f73b8;
        background: #eaf4ff;
    }

    .cd-service-card.offset {
        grid-column: 2 / span 2;
    }

    .cd-num {
        position: absolute;
        top: -16px;
        left: 50%;
        width: 32px;
        height: 32px;
        transform: translateX(-50%);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        background: #f27524;
        color: #fff;
        font-size: 16px;
        font-weight: 900;
    }

    .cd-service-card.blue .cd-num {
        background: #1f73b8;
    }

    .cd-service-card h3 {
        min-height: 44px;
        margin: 0 0 12px;
        color: #f27524;
        font-size: 17px;
        line-height: 1.25;
        font-weight: 900;
    }

    .cd-service-card.blue h3 {
        color: #1f73b8;
    }

    .cd-service-card p {
        margin: 0;
        color: #343b46;
        font-size: 14.5px;
        line-height: 1.55;
        font-weight: 600;
    }

    .cd-project-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 26px;
        max-width: 1193px;
        margin: 35px auto 0;
        align-items: start;
    }

    .cd-project-card {
        overflow: hidden;
        border: 2px solid #f27524;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 8px 16px rgba(28,44,62,.14);
    }

    .cd-project-card.blue {
        border-color: #1f73b8;
    }

    .cd-project-card img {
        width: 100%;
        aspect-ratio: 1640 / 1212;
        display: block;
        object-fit: cover;
    }

    .cd-project-image {
        width: 100%;
        aspect-ratio: 1640 / 1212;
        display: block;
        object-fit: contain;
        filter: drop-shadow(0 8px 14px rgba(28,44,62,.14));
    }

    .cd-project-label {
        min-height: 54px;
        padding: 13px 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #20242c;
        font-size: 15px;
        line-height: 1.2;
        font-weight: 900;
        text-align: center;
    }

    .cd-footer-info {
        max-width: 980px;
        margin: 30px auto 0;
        color: #4d5562;
        font-size: 15px;
        line-height: 1.6;
        font-weight: 600;
    }

    .cd-footer-info h3 {
        margin: 0 0 8px;
        color: #171923;
        font-size: 18px;
        font-weight: 900;
    }

    .cd-faq {
        max-width: 1040px;
        margin: 30px auto 0;
        display: grid;
        gap: 12px;
    }

    .cd-faq details {
        border: 1px solid #d8dce2;
        border-radius: 7px;
        background: #fff;
        box-shadow: 0 5px 12px rgba(28,44,62,.08);
    }

    .cd-faq summary {
        cursor: pointer;
        padding: 17px 20px;
        color: #20242c;
        font-size: 15.5px;
        font-weight: 900;
    }

    .cd-faq p {
        margin: 0;
        padding: 0 20px 16px;
        color: #4d5562;
        font-size: 15px;
        line-height: 1.6;
        font-weight: 600;
    }

    @media (max-width: 991px) {
        .cd-value-grid,
        .cd-project-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .cd-service-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            max-width: 720px;
        }

        .cd-service-card,
        .cd-service-card.offset {
            grid-column: auto;
        }
    }

    @media (max-width: 640px) {
        .cd-hero {
            min-height: 290px;
        }

        .cd-section {
            padding: 42px 0;
        }

        .cd-value-grid,
        .cd-service-grid,
        .cd-project-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="cd-page">
    <section class="cd-hero">
        <img src="{{ asset('images/logo/bv1.png') }}" alt="Concept design services">
        <div class="cd-hero-content">
            <h1>
                Concept Design Services in<br>
                Navi Mumbai, Mumbai, Thane,<br>
                Pune &amp; Raigad
            </h1>
        </div>
    </section>

    <section class="cd-section white">
        <div class="cd-container">
            <h2 class="cd-title">Concept Design Services in Navi Mumbai, Mumbai, Pune, Raigad &amp; Thane</h2>
            <div class="cd-line"></div>

            <div class="cd-copy">
                <p>
                    Every successful project starts with a strong idea. At <strong>ConstructKaro</strong>, we offer professional <strong>Concept Design Services</strong> that transform your vision into a clear, practical, and visually defined design direction.
                </p>
                <p>
                    Whether you are planning a home, villa, commercial space, or layout development, our concept design process helps you visualize, refine, and finalize your project before execution begins.
                </p>
            </div>
        </div>
    </section>

    <section class="cd-section">
        <div class="cd-container">
            <h2 class="cd-title">What is Concept Design?</h2>
            <div class="cd-line"></div>

            <div class="cd-copy">
                <p>
                    Concept design is the initial stage of design where ideas are converted into a structured plan. It includes layout concepts, design themes, and visual representation that guide the entire project.
                </p>
                <p>
                    It focuses on:
                </p>
            </div>

            <div class="cd-value-grid">
                <div class="cd-value blue">Understanding your requirement &amp; lifestyle</div>
                <div class="cd-value orange">Creating initial layout ideas</div>
                <div class="cd-value blue">Defining design style &amp; theme</div>
                <div class="cd-value orange">Visualizing the project before detailed planning</div>
            </div>
        </div>
    </section>

    <section class="cd-section white">
        <div class="cd-container">
            <h2 class="cd-title">Our Concept Design Services Include</h2>
            <div class="cd-line"></div>

            @php
                $services = [
                    ['num' => '1', 'color' => 'orange', 'title' => 'Requirement Analysis & Idea Development', 'text' => 'Understanding your vision, budget, land details, functional requirement mapping, and space usage planning.'],
                    ['num' => '2', 'color' => 'blue', 'title' => 'Concept Layout Planning', 'text' => 'Initial floor plan concepts, zoning and circulation planning, and multiple layout options.'],
                    ['num' => '3', 'color' => 'orange', 'title' => 'Design Theme & Style Selection', 'text' => 'Modern, classic, luxury, minimalist, and theme selection with material and color concept alignment.'],
                    ['num' => '4', 'color' => 'blue', 'title' => '3D Concept Visualization', 'text' => 'Basic 3D views of your project, exterior massing and form development, and early-stage visual concepts.'],
                    ['num' => '5', 'color' => 'orange', 'title' => 'Project Feasibility Guidance', 'text' => 'Basic cost understanding, space vs budget alignment, and practical design recommendations.'],
                ];
            @endphp

            <div class="cd-service-grid">
                @foreach($services as $index => $item)
                    <div class="cd-service-card {{ $item['color'] === 'blue' ? 'blue' : '' }} {{ $index === 3 ? 'offset' : '' }}">
                        <div class="cd-num">{{ $item['num'] }}</div>
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="cd-section">
        <div class="cd-container">
            <h2 class="cd-title">Types of Concept Design Projects</h2>
            <div class="cd-line"></div>

            @php
                $projects = [
                    ['color' => 'orange', 'image' => asset('images/logo/cds1.png'), 'title' => 'Residential Concept Design', 'alt' => 'Residential concept design'],
                    ['color' => 'blue', 'image' => asset('images/logo/cds2.png'), 'title' => 'Commercial Concept Design', 'alt' => 'Commercial concept design'],
                    ['color' => 'orange', 'image' => asset('images/logo/cds3.png'), 'title' => 'Farmhouse & Plot Concept Planning', 'alt' => 'Farmhouse and plot concept planning'],
                    ['color' => 'blue', 'image' => asset('images/logo/cds4.png'), 'title' => 'Interior Concept Design', 'alt' => 'Interior concept design'],
                ];
            @endphp

            <div class="cd-project-grid">
                @foreach($projects as $project)
                    <img class="cd-project-image" src="{{ $project['image'] }}" alt="{{ $project['alt'] }}">
                @endforeach
            </div>
        </div>
    </section>

    <section class="cd-section white">
        <div class="cd-container">
            <div class="cd-footer-info">
                <h3>Target Locations We Serve</h3>
                <p>Concept Design Services in Navi Mumbai | Concept Design Services in Mumbai | Concept Design Services in Pune | Concept Design Services in Raigad | Concept Design Services in Thane</p>
            </div>
        </div>
    </section>

    <section class="cd-section">
        <div class="cd-container">
            <h2 class="cd-title">Frequently Asked Questions (FAQs)</h2>
            <div class="cd-line"></div>

            <div class="cd-faq">
                <details>
                    <summary>1. What is included in concept design?</summary>
                    <p>Concept design includes idea development, initial layout options, zoning, design theme, visual direction, and feasibility guidance.</p>
                </details>
                <details>
                    <summary>2. How much does concept design cost?</summary>
                    <p>The cost depends on project type, size, number of options, visualization requirements, and revision scope.</p>
                </details>
                <details>
                    <summary>3. Do you provide multiple concept options?</summary>
                    <p>Yes, multiple options can be prepared based on your requirements and budget.</p>
                </details>
                <details>
                    <summary>4. Is concept design necessary before construction?</summary>
                    <p>Yes, it helps avoid confusion and gives the project a clear direction before detailed drawings and execution.</p>
                </details>
                <details>
                    <summary>5. Do you provide execution after concept design?</summary>
                    <p>We can coordinate with suitable design and execution partners depending on your project scope and location.</p>
                </details>
            </div>
        </div>
    </section>
</div>
@endsection
