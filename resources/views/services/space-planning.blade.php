@extends('layouts.app')

@section('title', $service['title'] ?? 'Space Planning Services')

@section('content')
<style>
    .spp-page,
    .spp-page * {
        box-sizing: border-box;
    }

    .spp-page {
        background: #eeeeee;
        color: #20242c;
        font-family: "Poppins", "Segoe UI", sans-serif;
        overflow: hidden;
    }

    .spp-hero {
        position: relative;
        min-height: 360px;
        display: flex;
        align-items: center;
        background: #111;
        overflow: hidden;
    }

    .spp-hero img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .spp-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(0,0,0,.88), rgba(0,0,0,.58) 44%, rgba(0,0,0,.06));
    }

    .spp-hero-content {
        position: relative;
        z-index: 2;
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .spp-hero h1 {
        max-width: 680px;
        margin: 0;
        color: #fff;
        font-size: clamp(28px, 4vw, 50px);
        line-height: 1.18;
        font-weight: 900;
        text-shadow: 0 5px 18px rgba(0,0,0,.45);
    }

    .spp-section {
        padding: 48px 0;
        background: #eeeeee;
    }

    .spp-section.white {
        background: #fff;
    }

    .spp-container {
        width: min(1180px, calc(100% - 36px));
        margin: 0 auto;
    }

    .spp-title {
        margin: 0;
        color: #171923;
        font-size: clamp(23px, 3vw, 33px);
        line-height: 1.25;
        font-weight: 900;
        text-align: center;
    }

    .spp-line {
        width: min(560px, 72%);
        height: 4px;
        margin: 13px auto 30px;
        border-radius: 999px;
        background: linear-gradient(90deg, #f27524 0%, #f27524 40%, #1f73b8 100%);
    }

    .spp-copy {
        max-width: 1080px;
        margin: 0 auto;
        color: #4d5562;
        font-size: 17px;
        line-height: 1.75;
        font-weight: 600;
    }

    .spp-copy p {
        margin: 0 0 14px;
    }

    .spp-copy strong {
        color: #20242c;
        font-weight: 900;
    }

    .spp-value-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 18px;
        max-width: 1120px;
        margin: 30px auto 0;
    }

    .spp-value {
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

    .spp-value.orange {
        border-color: #f27524;
    }

    .spp-service-grid {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 24px;
        max-width: 1080px;
        margin: 42px auto 0;
    }

    .spp-service-card {
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

    .spp-service-card.blue {
        border-color: #1f73b8;
        background: #eaf4ff;
    }

    .spp-service-card.offset {
        grid-column: 2 / span 2;
    }

    .spp-num {
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

    .spp-service-card.blue .spp-num {
        background: #1f73b8;
    }

    .spp-service-card h3 {
        min-height: 44px;
        margin: 0 0 12px;
        color: #f27524;
        font-size: 17px;
        line-height: 1.25;
        font-weight: 900;
    }

    .spp-service-card.blue h3 {
        color: #1f73b8;
    }

    .spp-service-card p {
        margin: 0;
        color: #343b46;
        font-size: 14.5px;
        line-height: 1.55;
        font-weight: 600;
    }

    .spp-plan-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 26px;
        max-width: 1120px;
        margin: 34px auto 0;
        align-items: start;
    }

    .spp-plan-card {
        overflow: hidden;
        border: 2px solid #f27524;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 8px 16px rgba(28,44,62,.14);
    }

    .spp-plan-card.blue {
        border-color: #1f73b8;
    }

    .spp-plan-card img {
        width: 100%;
        aspect-ratio: 572 / 471;
        display: block;
        object-fit: cover;
    }

    .spp-plan-image {
        width: 100%;
        aspect-ratio: 572 / 471;
        display: block;
        object-fit: contain;
        filter: drop-shadow(0 8px 14px rgba(28,44,62,.14));
    }

    .spp-plan-label {
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

    .spp-footer-info {
        max-width: 980px;
        margin: 30px auto 0;
        color: #4d5562;
        font-size: 15px;
        line-height: 1.6;
        font-weight: 600;
    }

    .spp-footer-info h3 {
        margin: 0 0 8px;
        color: #171923;
        font-size: 18px;
        font-weight: 900;
    }

    .spp-faq {
        max-width: 1040px;
        margin: 30px auto 0;
        display: grid;
        gap: 12px;
    }

    .spp-faq details {
        border: 1px solid #d8dce2;
        border-radius: 7px;
        background: #fff;
        box-shadow: 0 5px 12px rgba(28,44,62,.08);
    }

    .spp-faq summary {
        cursor: pointer;
        padding: 17px 20px;
        color: #20242c;
        font-size: 15.5px;
        font-weight: 900;
    }

    .spp-faq p {
        margin: 0;
        padding: 0 20px 16px;
        color: #4d5562;
        font-size: 15px;
        line-height: 1.6;
        font-weight: 600;
    }

    @media (max-width: 991px) {
        .spp-value-grid,
        .spp-plan-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .spp-service-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            max-width: 720px;
        }

        .spp-service-card,
        .spp-service-card.offset {
            grid-column: auto;
        }
    }

    @media (max-width: 640px) {
        .spp-hero {
            min-height: 290px;
        }

        .spp-section {
            padding: 42px 0;
        }

        .spp-value-grid,
        .spp-service-grid,
        .spp-plan-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="spp-page">
    <section class="spp-hero">
        <img src="{{ asset('images/logo/bv1.png') }}" alt="Space planning services">
        <div class="spp-hero-content">
            <h1>
                Space Planning Services in<br>
                Navi Mumbai, Mumbai, Thane,<br>
                Pune &amp; Raigad
            </h1>
        </div>
    </section>

    <section class="spp-section white">
        <div class="spp-container">
            <h2 class="spp-title">Space Planning Services in Navi Mumbai, Mumbai, Pune, Raigad &amp; Thane</h2>
            <div class="spp-line"></div>

            <div class="spp-copy">
                <p>
                    A well-planned space is not just about design. It is about how efficiently every square foot works for you. At <strong>ConstructKaro</strong>, we offer expert <strong>Space Planning Services</strong> to help you optimize layouts, improve functionality, and create a seamless flow in your home, office, or commercial space.
                </p>
                <p>
                    Whether you are building from scratch or redesigning an existing space, we ensure your layout is practical, aesthetic, and future-ready.
                </p>
            </div>
        </div>
    </section>

    <section class="spp-section">
        <div class="spp-container">
            <h2 class="spp-title">What is Space Planning?</h2>
            <div class="spp-line"></div>

            <div class="spp-copy">
                <p>
                    Space planning is the strategic arrangement of rooms, furniture, and circulation areas to maximize usability, comfort, and efficiency.
                </p>
                <p>
                    It focuses on:
                </p>
            </div>

            <div class="spp-value-grid">
                <div class="spp-value blue">Efficient space utilization</div>
                <div class="spp-value orange">Functional zoning</div>
                <div class="spp-value blue">Movement &amp; accessibility</div>
                <div class="spp-value orange">Natural light &amp; ventilation</div>
                <div class="spp-value blue">Future expansion flexibility</div>
            </div>
        </div>
    </section>

    <section class="spp-section white">
        <div class="spp-container">
            <h2 class="spp-title">Our Space Planning Services Include</h2>
            <div class="spp-line"></div>

            @php
                $services = [
                    ['num' => '1', 'color' => 'orange', 'title' => 'Residential Space Planning', 'text' => '1 BHK, 2 BHK, 3 BHK, villa layouts, bedroom and living space planning, furniture placement, and storage optimization.'],
                    ['num' => '2', 'color' => 'blue', 'title' => 'Commercial Space Planning', 'text' => 'Office workspace design, retail shop and showroom layout, workstation planning, and productivity-focused spaces.'],
                    ['num' => '3', 'color' => 'orange', 'title' => 'Furniture & Layout Planning', 'text' => 'Furniture placement for optimal flow, modular kitchen and wardrobe planning, and multi-functional space utilization.'],
                    ['num' => '4', 'color' => 'blue', 'title' => 'Functional Zoning & Circulation', 'text' => 'Proper movement flow design, public vs private zone division, and practical entry and exit planning.'],
                    ['num' => '5', 'color' => 'orange', 'title' => 'Renovation & Re-Planning', 'text' => 'Redesign existing layouts, optimize unused spaces, and improve functionality without major changes.'],
                ];
            @endphp

            <div class="spp-service-grid">
                @foreach($services as $index => $item)
                    <div class="spp-service-card {{ $item['color'] === 'blue' ? 'blue' : '' }} {{ $index === 3 ? 'offset' : '' }}">
                        <div class="spp-num">{{ $item['num'] }}</div>
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="spp-section">
        <div class="spp-container">
            <h2 class="spp-title">Types of Space Planning Designs</h2>
            <div class="spp-line"></div>

            @php
                $plans = [
                    ['color' => 'orange', 'image' => asset('images/logo/spp1.png'), 'title' => 'Residential Space Planning', 'alt' => 'Residential space planning'],
                    ['color' => 'blue', 'image' => asset('images/logo/spp2.png'), 'title' => 'Office & Workspace Planning', 'alt' => 'Office and workspace planning'],
                    ['color' => 'orange', 'image' => asset('images/logo/spp3.png'), 'title' => 'Retail & Commercial Space Planning', 'alt' => 'Retail and commercial space planning'],
                    ['color' => 'blue', 'image' => asset('images/logo/spp4.png'), 'title' => 'Small Space Optimization', 'alt' => 'Small space optimization'],
                ];
            @endphp

            <div class="spp-plan-grid">
                @foreach($plans as $plan)
                    <img class="spp-plan-image" src="{{ $plan['image'] }}" alt="{{ $plan['alt'] }}">
                @endforeach
            </div>
        </div>
    </section>

    <section class="spp-section white">
        <div class="spp-container">
            <div class="spp-footer-info">
                <h3>Target Locations We Serve</h3>
                <p>Space Planning Services in Navi Mumbai | Space Planning Services in Mumbai | Space Planning Services in Pune | Space Planning Services in Raigad | Space Planning Services in Thane</p>
            </div>
        </div>
    </section>

    <section class="spp-section">
        <div class="spp-container">
            <h2 class="spp-title">Frequently Asked Questions (FAQs)</h2>
            <div class="spp-line"></div>

            <div class="spp-faq">
                <details>
                    <summary>1. What is the cost of space planning?</summary>
                    <p>The cost depends on space size, number of rooms, furniture planning, revisions, and drawing detail requirements.</p>
                </details>
                <details>
                    <summary>2. Can you optimize my existing layout?</summary>
                    <p>Yes, existing homes, offices, shops, and commercial spaces can be reviewed and re-planned for better use.</p>
                </details>
                <details>
                    <summary>3. Do you provide furniture layout planning?</summary>
                    <p>Yes, furniture placement and movement flow can be included in the planning process.</p>
                </details>
                <details>
                    <summary>4. Is space planning useful for small homes?</summary>
                    <p>Yes, small spaces benefit strongly from smart zoning, storage planning, and multi-functional layouts.</p>
                </details>
                <details>
                    <summary>5. Do you provide execution support?</summary>
                    <p>We can coordinate with suitable execution partners depending on your scope, location, and project needs.</p>
                </details>
            </div>
        </div>
    </section>
</div>
@endsection
