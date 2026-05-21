@extends('layouts.app')

@section('title', $service['title'] ?? 'Floor Plan Design Services')

@section('content')
<style>
    .fp-page,
    .fp-page * {
        box-sizing: border-box;
    }

    .fp-page {
        background: #eeeeee;
        color: #20242c;
        font-family: "Poppins", "Segoe UI", sans-serif;
        overflow: hidden;
    }

    .fp-hero {
        position: relative;
        min-height: 360px;
        display: flex;
        align-items: center;
        background: #111;
        overflow: hidden;
    }

    .fp-hero img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .fp-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(0,0,0,.88), rgba(0,0,0,.58) 44%, rgba(0,0,0,.06));
    }

    .fp-hero-content {
        position: relative;
        z-index: 2;
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .fp-hero h1 {
        max-width: 680px;
        margin: 0;
        color: #fff;
        font-size: clamp(28px, 4vw, 50px);
        line-height: 1.18;
        font-weight: 900;
        text-shadow: 0 5px 18px rgba(0,0,0,.45);
    }

    .fp-section {
        padding: 48px 0;
        background: #eeeeee;
    }

    .fp-section.white {
        background: #fff;
    }

    .fp-container {
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .fp-title {
        margin: 0;
        color: #171923;
        font-size: clamp(23px, 3vw, 33px);
        line-height: 1.25;
        font-weight: 900;
        text-align: center;
    }

    .fp-line {
        width: min(560px, 72%);
        height: 4px;
        margin: 13px auto 30px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f27524 0%, #f27524 40%, #1f73b8 100%);
    }

    .fp-copy {
        max-width: 1080px;
        margin: 0 auto;
        color: #4d5562;
        font-size: 17px;
        line-height: 1.75;
        font-weight: 600;
    }

    .fp-copy p {
        margin: 0 0 14px;
    }

    .fp-copy strong {
        color: #20242c;
        font-weight: 900;
    }

    .fp-value-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 22px;
        max-width: 1040px;
        margin: 30px auto 0;
    }

    .fp-value {
        min-height: 72px;
        padding: 15px 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #1f73b8;
        border-radius: 6px;
        background: #fff;
        color: #20242c;
        font-size: 15px;
        line-height: 1.25;
        font-weight: 900;
        text-align: center;
        box-shadow: 0 6px 12px rgba(28,44,62,.08);
    }

    .fp-value.orange {
        border-color: #f27524;
    }

    .fp-service-grid {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 24px;
        max-width: 1080px;
        margin: 42px auto 0;
    }

    .fp-service-card {
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

    .fp-service-card.blue {
        border-color: #1f73b8;
        background: #eaf4ff;
    }

    .fp-num {
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

    .fp-service-card.blue .fp-num {
        background: #1f73b8;
    }

    .fp-service-card h3 {
        min-height: 44px;
        margin: 0 0 12px;
        color: #f27524;
        font-size: 17px;
        line-height: 1.25;
        font-weight: 900;
    }

    .fp-service-card.blue h3 {
        color: #1f73b8;
    }

    .fp-service-card p {
        margin: 0;
        color: #343b46;
        font-size: 14.5px;
        line-height: 1.55;
        font-weight: 600;
    }

    .fp-service-card.offset {
        grid-column: 2 / span 2;
    }

    .fp-plan-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 26px;
        max-width: 1180px;
        margin: 34px auto 0;
        align-items: start;
    }

    .fp-plan-card {
        overflow: hidden;
        border: 2px solid #f27524;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 8px 16px rgba(28,44,62,.14);
    }

    .fp-plan-card.blue {
        border-color: #1f73b8;
    }

    .fp-plan-card img {
        width: 100%;
        aspect-ratio: 412 / 379;
        display: block;
        object-fit: contain;
        background: #fff;
    }

    .fp-plan-label {
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

    .fp-footer-info {
        max-width: 980px;
        margin: 30px auto 0;
        color: #4d5562;
        font-size: 15px;
        line-height: 1.6;
        font-weight: 600;
    }

    .fp-footer-info h3 {
        margin: 0 0 8px;
        color: #171923;
        font-size: 18px;
        font-weight: 900;
    }

    .fp-faq {
        max-width: 1040px;
        margin: 30px auto 0;
        display: grid;
        gap: 12px;
    }

    .fp-faq details {
        border: 1px solid #d8dce2;
        border-radius: 7px;
        background: #fff;
        box-shadow: 0 5px 12px rgba(28,44,62,.08);
    }

    .fp-faq summary {
        cursor: pointer;
        padding: 17px 20px;
        color: #20242c;
        font-size: 15.5px;
        font-weight: 900;
    }

    .fp-faq p {
        margin: 0;
        padding: 0 18px 16px;
        color: #4d5562;
        font-size: 15px;
        line-height: 1.6;
        font-weight: 600;
    }

    @media (max-width: 991px) {
        .fp-value-grid,
        .fp-plan-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .fp-service-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            max-width: 720px;
        }

        .fp-service-card {
            grid-column: auto;
        }

        .fp-service-card.offset {
            grid-column: auto;
        }
    }

    @media (max-width: 640px) {
        .fp-hero {
            min-height: 290px;
        }

        .fp-section {
            padding: 42px 0;
        }

        .fp-value-grid,
        .fp-service-grid,
        .fp-plan-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="fp-page">
    <section class="fp-hero">
        <img src="{{ asset('images/logo/bv1.png') }}" alt="Floor plan design services">
        <div class="fp-hero-content">
            <h1>
                Floor Plan Design Services in<br>
                Navi Mumbai, Mumbai, Thane,<br>
                Pune &amp; Raigad
            </h1>
        </div>
    </section>

    <section class="fp-section white">
        <div class="fp-container">
            <h2 class="fp-title">Floor Plan Design Services in Navi Mumbai, Mumbai, Pune, Raigad &amp; Thane</h2>
            <div class="fp-line"></div>

            <div class="fp-copy">
                <p>
                    A well-designed layout is the foundation of any successful project. At <strong>ConstructKaro</strong>, we offer expert <strong>Floor Plan Design Services</strong> that focus on space optimization, functionality, and future-ready living.
                </p>
                <p>
                    Whether you are building a home, office, or commercial space, our structured approach ensures your layout is practical, aesthetic, and aligned with your needs.
                </p>
            </div>
        </div>
    </section>

    <section class="fp-section">
        <div class="fp-container">
            <h2 class="fp-title">What is Floor Plan Design?</h2>
            <div class="fp-line"></div>

            <div class="fp-copy">
                <p>
                    A <strong>floor plan design</strong> is a 2D representation of your space showing the arrangement of rooms, walls, doors, windows, and circulation areas.
                </p>
                <p>
                    A good floor plan ensures:
                </p>
            </div>

            <div class="fp-value-grid">
                <div class="fp-value blue">Strong visual identity</div>
                <div class="fp-value orange">Smooth movement &amp; functionality</div>
                <div class="fp-value blue">Proper natural light &amp; ventilation</div>
                <div class="fp-value orange">Better construction planning</div>
            </div>
        </div>
    </section>

    <section class="fp-section white">
        <div class="fp-container">
            <h2 class="fp-title">Our Floor Plan Design Services Include</h2>
            <div class="fp-line"></div>

            @php
                $services = [
                    ['num' => '1', 'color' => 'orange', 'title' => 'Residential Floor Plan Design', 'text' => '1 BHK, 2 BHK, 3 BHK, and duplex home layouts with room sizing and daily-use planning.'],
                    ['num' => '2', 'color' => 'blue', 'title' => 'Commercial Floor Plan Design', 'text' => 'Office, retail, showroom, workspace, lobby, reception, and circulation planning.'],
                    ['num' => '3', 'color' => 'orange', 'title' => 'Plot-Based Custom Planning', 'text' => 'Layouts based on plot size, vastu needs, setbacks, parking, and future expansion.'],
                    ['num' => '4', 'color' => 'blue', 'title' => 'Space Optimization & Planning', 'text' => 'Smart storage, furniture movement, traffic flow, and multi-functional space layouts.'],
                    ['num' => '5', 'color' => 'orange', 'title' => '2D Detailed Floor Plans', 'text' => 'Furniture layout planning, dimensioned drawings, circulation, and construction-friendly plans.'],
                ];
            @endphp

            <div class="fp-service-grid">
                @foreach($services as $index => $item)
                    <div class="fp-service-card {{ $item['color'] === 'blue' ? 'blue' : '' }} {{ $index === 3 ? 'offset' : '' }}">
                        <div class="fp-num">{{ $item['num'] }}</div>
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="fp-section">
        <div class="fp-container">
            <h2 class="fp-title">Types of Floor Plan Design Styles</h2>
            <div class="fp-line"></div>

            @php
                $plans = [
                    ['color' => 'orange', 'image' => asset('images/logo/fp1.png'), 'title' => '2 BHK Floor Plan Design', 'alt' => '2 BHK floor plan design'],
                    ['color' => 'blue', 'image' => asset('images/logo/fp2.png'), 'title' => '3 BHK Floor Plan Design', 'alt' => '3 BHK floor plan design'],
                    ['color' => 'orange', 'image' => asset('images/logo/fp3.png'), 'title' => '4 BHK & Luxury Floor Plans', 'alt' => '4 BHK luxury floor plans'],
                    ['color' => 'blue', 'image' => asset('images/logo/fp4.png'), 'title' => 'Commercial Layout Planning', 'alt' => 'Commercial layout planning'],
                ];
            @endphp

            <div class="fp-plan-grid">
                @foreach($plans as $plan)
                    <!-- <div class="fp-plan-card {{ $plan['color'] === 'blue' ? 'blue' : '' }}"> -->
                        <img src="{{ $plan['image'] }}" alt="{{ $plan['alt'] }}">
                        <!-- <div class="fp-plan-label">{{ $plan['title'] }}</div> -->
                    <!-- </div> -->
                @endforeach
            </div>
        </div>
    </section>

    <section class="fp-section white">
        <div class="fp-container">
            <div class="fp-footer-info">
                <h3>Target Locations We Serve</h3>
                <p>Floor Plan Design in Navi Mumbai | Floor Plan Design in Mumbai | Floor Plan Design in Pune | Floor Plan Design in Raigad | Floor Plan Design in Thane</p>
            </div>
        </div>
    </section>

    <section class="fp-section">
        <div class="fp-container">
            <h2 class="fp-title">Frequently Asked Questions (FAQs)</h2>
            <div class="fp-line"></div>

            <div class="fp-faq">
                <details>
                    <summary>1. What is the cost of floor plan design?</summary>
                    <p>The cost depends on plot size, number of floors, drawing details, revisions, vastu requirements, and whether furniture layout is included.</p>
                </details>
                <details>
                    <summary>2. Do you provide Vastu-compliant plans?</summary>
                    <p>Yes, Vastu-compliant planning can be included based on your project requirements.</p>
                </details>
                <details>
                    <summary>3. Can I get multiple floor plan options?</summary>
                    <p>Yes, multiple layout options can be prepared so you can compare space usage and circulation.</p>
                </details>
                <details>
                    <summary>4. Do you include furniture layout in plans?</summary>
                    <p>Yes, furniture placement can be included to help visualize practical room usage.</p>
                </details>
                <details>
                    <summary>5. How long does it take to design a floor plan?</summary>
                    <p>Timeline depends on project size, clarity of requirements, revisions, and drawing scope.</p>
                </details>
            </div>
        </div>
    </section>
</div>
@endsection
