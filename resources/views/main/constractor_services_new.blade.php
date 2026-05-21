@extends('layouts.app')

@section('meta_title', 'Civil Contractor Services in Navi Mumbai, Mumbai, Thane, Pune & Raigad | ConstructKaro')
@section('meta_description', 'ConstructKaro helps you connect with verified civil contractors for residential, commercial, and infrastructure projects across Navi Mumbai, Mumbai, Thane, Pune, and Raigad.')
@section('title', 'Civil Contractor Services | ConstructKaro')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --cksn-blue: #0b8ee8;
        --cksn-orange: #f47b20;
        --cksn-blue-soft: #eaf6ff;
        --cksn-orange-soft: #fff0e5;
        --cksn-page: #ededed;
        --cksn-text: #101010;
        --cksn-muted: #4e5661;
        --cksn-line: #cfd5dc;
    }

    body {
        background: var(--cksn-page);
        font-family: "Inter", "Segoe UI", sans-serif;
    }

    .cksn-page {
        max-width: 760px;
        margin: 0 auto;
        padding: 0 18px 28px;
        background: var(--cksn-page);
        border-left: 3px solid var(--cksn-blue);
        color: var(--cksn-text);
    }

    .cksn-hero {
        min-height: 205px;
        display: grid;
        grid-template-columns: 43% 57%;
        overflow: hidden;
        background: #101010;
    }

    .cksn-hero-copy {
        min-height: 205px;
        display: flex;
        align-items: center;
        padding: 24px 16px 24px 26px;
        background: linear-gradient(90deg, #080808 0%, #111 74%, rgba(17, 17, 17, .25) 100%);
        position: relative;
        z-index: 1;
    }

    .cksn-hero-copy h1 {
        margin: 0;
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-size: 25px;
        font-weight: 900;
        line-height: 1.13;
    }

    .cksn-hero-img {
        min-height: 205px;
        background:
            linear-gradient(90deg, rgba(10, 10, 10, .32), rgba(10, 10, 10, .04)),
            url("{{ asset('images/logo/c12.png') }}") center / cover no-repeat;
    }

    .cksn-section {
        padding: 24px 22px 0;
    }

    .cksn-intro {
        padding-top: 22px;
    }

    .cksn-title {
        margin: 0 0 8px;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: 20px;
        font-weight: 900;
        line-height: 1.2;
        text-align: center;
    }

    .cksn-copy {
        margin: 0 auto;
        max-width: 700px;
    }

    .cksn-copy p {
        margin: 0 0 7px;
        color: #404750;
        font-size: 10px;
        font-weight: 500;
        line-height: 1.5;
    }

    .cksn-copy strong {
        color: #101010;
        font-weight: 900;
    }

    .cksn-subtitle {
        max-width: 650px;
        margin: 0 auto 18px;
        color: var(--cksn-muted);
        font-size: 10px;
        font-weight: 500;
        line-height: 1.5;
        text-align: center;
    }

    .cksn-services {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
        margin-top: 18px;
    }

    .cksn-service {
        min-width: 0;
        overflow: hidden;
        border: 2px solid var(--cksn-blue);
        border-radius: 7px;
        background: var(--cksn-blue-soft);
        box-shadow: 0 2px 5px rgba(11, 44, 77, .11);
    }

    .cksn-service:nth-child(even) {
        border-color: var(--cksn-orange);
        background: var(--cksn-orange-soft);
    }

    .cksn-service img {
        width: 100%;
        aspect-ratio: 1.38 / 1;
        display: block;
        object-fit: cover;
    }

    .cksn-service h3 {
        min-height: 39px;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 6px 6px 7px;
        color: #151515;
        font-family: "Manrope", sans-serif;
        font-size: 10px;
        font-weight: 800;
        line-height: 1.12;
        text-align: center;
    }

    .cksn-why-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        margin-top: 28px;
    }

    .cksn-why {
        min-height: 145px;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 30px 12px 18px;
        border: 2px solid var(--cksn-orange);
        border-radius: 7px;
        background: var(--cksn-orange-soft);
        text-align: center;
    }

    .cksn-why:nth-child(even) {
        border-color: var(--cksn-blue);
        background: var(--cksn-blue-soft);
    }

    .cksn-why-num {
        min-width: 23px;
        height: 23px;
        position: absolute;
        top: -11px;
        left: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transform: translateX(-50%);
        border-radius: 8px;
        background: var(--cksn-orange);
        color: #fff;
        font-family: "Manrope", sans-serif;
        font-size: 13px;
        font-weight: 900;
        line-height: 1;
    }

    .cksn-why:nth-child(even) .cksn-why-num {
        background: var(--cksn-blue);
    }

    .cksn-why-icon {
        width: 48px;
        height: 48px;
        display: grid;
        place-items: center;
        color: #161616;
    }

    .cksn-why-icon svg {
        width: 42px;
        height: 42px;
        stroke-width: 2.4;
    }

    .cksn-why h3 {
        max-width: 150px;
        margin: 0;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: 10px;
        font-weight: 900;
        line-height: 1.25;
    }

    .cksn-faqs {
        display: grid;
        gap: 10px;
        max-width: 650px;
        margin: 18px auto 0;
    }

    .cksn-faq {
        overflow: hidden;
        border: 1px solid var(--cksn-line);
        border-radius: 5px;
        background: #fff;
        box-shadow: 0 2px 4px rgba(20, 29, 38, .12);
    }

    .cksn-faq button {
        width: 100%;
        min-height: 42px;
        padding: 10px 16px;
        border: 0;
        background: transparent;
        color: #161616;
        cursor: pointer;
        font-family: "Manrope", sans-serif;
        font-size: 10px;
        font-weight: 900;
        line-height: 1.25;
        text-align: left;
    }

    .cksn-faq-answer {
        display: none;
        padding: 0 16px 13px;
        color: #505967;
        font-size: 10px;
        font-weight: 500;
        line-height: 1.55;
    }

    .cksn-faq.open .cksn-faq-answer {
        display: block;
    }

    .cksn-meta {
        padding: 24px 22px 0;
    }

    .cksn-meta h2 {
        margin: 0 0 6px;
        color: #111;
        font-family: "Manrope", sans-serif;
        font-size: 11px;
        font-weight: 900;
    }

    .cksn-meta p,
    .cksn-meta a {
        color: #424852;
        font-size: 10px;
        font-weight: 500;
        line-height: 1.5;
        text-decoration: none;
    }

    .cksn-meta a:hover {
        color: #075c9b;
    }

    @media (max-width: 720px) {
        .cksn-page {
            max-width: none;
            padding: 0 12px 28px;
        }

        .cksn-hero,
        .cksn-hero-copy,
        .cksn-hero-img {
            min-height: 170px;
        }

        .cksn-hero-copy {
            padding: 20px 16px;
        }

        .cksn-services,
        .cksn-why-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .cksn-section {
            padding-left: 10px;
            padding-right: 10px;
        }
    }

    @media (max-width: 430px) {
        .cksn-hero {
            grid-template-columns: 1fr;
        }

        .cksn-hero-copy {
            min-height: 230px;
            background:
                linear-gradient(90deg, rgba(0, 0, 0, .82), rgba(0, 0, 0, .36)),
                url("{{ asset('images/logo/c12.png') }}") center / cover no-repeat;
        }

        .cksn-hero-img {
            display: none;
        }

        .cksn-services,
        .cksn-why-grid {
            gap: 10px;
        }

        .cksn-why {
            min-height: 132px;
        }
    }
</style>

@php
    $services = [
        ['title' => 'Residential Contractor', 'img' => 'images/logo/c1.png'],
        ['title' => 'Road & Highway Contractor', 'img' => 'images/logo/c2.png'],
        ['title' => 'Bridge Contractor', 'img' => 'images/logo/c3.png'],
        ['title' => 'Earthwork Excavation Contractor', 'img' => 'images/logo/c4.png'],
        ['title' => 'MEP Contractor', 'img' => 'images/logo/c5.png'],
        ['title' => 'Paint Contractor', 'img' => 'images/logo/c6.png'],
        ['title' => 'Waterproofing Contractor', 'img' => 'images/logo/c7.png'],
        ['title' => 'Labour Contractor', 'img' => 'images/logo/c8.png'],
        ['title' => 'Landscaping Contractor', 'img' => 'images/logo/c9.png'],
        ['title' => 'Commercial Contractor', 'img' => 'images/logo/c10.png'],
        ['title' => 'Industrial Civil Contractor', 'img' => 'images/logo/c11.png'],
        ['title' => 'Culverts Contractor', 'img' => 'images/logo/c3.png'],
    ];

    $whys = [
        ['title' => 'Verified & Experienced Contractors', 'icon' => 'verified'],
        ['title' => 'End-to-End Project Management', 'icon' => 'project'],
        ['title' => 'Transparent Pricing Structure', 'icon' => 'pricing'],
        ['title' => 'Quality Assurance', 'icon' => 'quality'],
        ['title' => 'On-Time Delivery', 'icon' => 'time'],
        ['title' => 'Multi-City Coverage', 'icon' => 'city'],
    ];

    $faqs = [
        ['q' => '1. What are Civil Contractor Services?', 'a' => 'Civil Contractor Services cover construction activities for buildings, roads, bridges, drainage, excavation, and infrastructure. A contractor manages labour, materials, equipment, and execution as per design and specifications.'],
        ['q' => '2. How does ConstructKaro select contractors?', 'a' => 'ConstructKaro verifies contractor experience, documents, past work quality, and project suitability before assigning the right contractor for your requirement.'],
        ['q' => '3. Do you provide services for small projects?', 'a' => 'Yes. We help with small repairs, home renovation work, commercial fit-outs, and large residential, industrial, or infrastructure projects.'],
        ['q' => '4. How long does it take to start the project?', 'a' => 'Most projects can move toward site mobilisation after requirement confirmation, contractor matching, scope finalisation, and quotation approval.'],
        ['q' => '5. Is pricing transparent?', 'a' => 'Yes. We aim to provide clear BOQ-based or scope-based quotations so labour, material, and execution costs are easier to understand before work starts.'],
    ];
@endphp

<main class="cksn-page">
    <section class="cksn-hero">
        <div class="cksn-hero-copy">
            <h1>Civil Contractor Service in Navi Mumbai, Mumbai, Thane, Pune & Raigad</h1>
        </div>
        <div class="cksn-hero-img" aria-hidden="true"></div>
    </section>

    <section class="cksn-section cksn-intro">
        <h2 class="cksn-title">Civil Contractor Services in Navi Mumbai, Mumbai, Raigad, Thane & Pune</h2>
        <div class="cksn-copy">
            <p>Looking for reliable <strong>Civil Contractor Services</strong> in Navi Mumbai, Mumbai, Raigad, Thane, or Pune? ConstructKaro brings you a trusted platform where your construction project is handled by experienced professionals under one streamlined system.</p>
            <p>We are not just another listing platform. <strong>ConstructKaro</strong> takes responsibility for your project execution, ensuring quality, transparency, and timely delivery by assigning the right civil construction contractors for your needs.</p>
            <p>Whether you're planning a home, commercial space, industrial project, or infrastructure work, we connect you with the best civil construction contractors and manage the process end to end.</p>
        </div>
    </section>

    <section class="cksn-section">
        <h2 class="cksn-title">Our Civil Contractor Services</h2>
        <p class="cksn-subtitle">We offer complete civil works services across residential, commercial, and infrastructure projects.</p>

        <div class="cksn-services">
            @foreach($services as $service)
                <article class="cksn-service">
                    <img src="{{ asset($service['img']) }}" alt="{{ $service['title'] }}">
                    <h3>{{ $service['title'] }}</h3>
                </article>
            @endforeach
        </div>
    </section>

    <section class="cksn-section">
        <h2 class="cksn-title">Why Choose ConstructKaro for Civil Contractor Services?</h2>

        <div class="cksn-why-grid">
            @foreach($whys as $index => $why)
                <article class="cksn-why">
                    <span class="cksn-why-num">{{ $index + 1 }}</span>
                    <span class="cksn-why-icon" aria-hidden="true">
                        @switch($why['icon'])
                            @case('verified')
                                <svg viewBox="0 0 48 48" fill="none" stroke="currentColor"><path d="M18 26l5 5 10-13"/><path d="M24 5l5 5 7-1 3 7 6 4-3 7 1 7-7 3-4 6-8-2-8 2-4-6-7-3 1-7-3-7 6-4 3-7 7 1 5-5z"/></svg>
                                @break
                            @case('project')
                                <svg viewBox="0 0 48 48" fill="none" stroke="currentColor"><path d="M16 16h19a7 7 0 010 14H14"/><path d="M18 10l-7 6 7 6"/><path d="M32 38l7-6-7-6"/><path d="M33 32H14a7 7 0 010-14h20"/></svg>
                                @break
                            @case('pricing')
                                <svg viewBox="0 0 48 48" fill="none" stroke="currentColor"><circle cx="24" cy="24" r="16"/><path d="M24 14v20"/><path d="M18 19c1.5-3 10.5-3 12 1 2 6-12 4-10 10 1.2 4 10.5 4 12 0"/></svg>
                                @break
                            @case('quality')
                                <svg viewBox="0 0 48 48" fill="none" stroke="currentColor"><path d="M16 28a12 12 0 1116 0"/><path d="M17 31l-3 10 10-5 10 5-3-10"/><path d="M20 22l3 3 6-7"/></svg>
                                @break
                            @case('time')
                                <svg viewBox="0 0 48 48" fill="none" stroke="currentColor"><circle cx="24" cy="24" r="16"/><path d="M24 14v11l8 5"/><path d="M16 7h16"/></svg>
                                @break
                            @default
                                <svg viewBox="0 0 48 48" fill="none" stroke="currentColor"><path d="M10 42h28"/><path d="M14 42V18h10v24"/><path d="M24 42V10h12v32"/><path d="M18 24h2M18 31h2M28 17h3M28 24h3M28 31h3"/></svg>
                        @endswitch
                    </span>
                    <h3>{{ $why['title'] }}</h3>
                </article>
            @endforeach
        </div>
    </section>

    <section class="cksn-section">
        <h2 class="cksn-title">Frequently Asked Questions (FAQs)</h2>

        <div class="cksn-faqs">
            @foreach($faqs as $index => $faq)
                <article class="cksn-faq" id="cksn-faq-{{ $index }}">
                    <button type="button" onclick="toggleContractorNewFaq({{ $index }})">{{ $faq['q'] }}</button>
                    <div class="cksn-faq-answer">{{ $faq['a'] }}</div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="cksn-meta">
        <h2>Our Other Services</h2>
        <p>
            <a href="#">Architect</a> |
            <a href="#">Contractor</a> |
            <a href="#">Interior Designer</a> |
            <a href="#">Survey Services</a> |
            <a href="#">Testing Services</a> |
            <a href="#">BOQ / Estimation</a>
        </p>

        <h2 style="margin-top: 18px;">Civil Contractor Services Locations:</h2>
        <p>Civil Contractor Services Navi Mumbai | Civil Contractor Services Mumbai | Civil Contractor Services Thane | Civil Contractor Services Raigad | Civil Contractor Services Pune</p>
    </section>
</main>

<script>
    function toggleContractorNewFaq(index) {
        const item = document.getElementById('cksn-faq-' + index);
        const wasOpen = item.classList.contains('open');

        document.querySelectorAll('.cksn-faq').forEach(function (faqItem) {
            faqItem.classList.remove('open');
        });

        if (!wasOpen) {
            item.classList.add('open');
        }
    }
</script>

@endsection
