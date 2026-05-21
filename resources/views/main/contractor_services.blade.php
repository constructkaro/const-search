@extends('layouts.app')

@section('meta_title', 'Civil Contractor Services in Navi Mumbai, Mumbai, Thane, Pune & Raigad | ConstructKaro')
@section('meta_description', 'Looking for reliable Civil Contractor Services in Navi Mumbai, Mumbai, Raigad, Thane, or Pune? ConstructKaro connects you with verified civil contractors for residential, commercial & infrastructure projects.')
@section('title', 'Civil Contractor Services | ConstructKaro')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800;900&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
:root {
    --or: #eb7a2f;
    --or2: #f39a56;
    --bl: #1e4db7;
    --bl2: #3a6fd8;
    --dark: #0f1923;
    --dark2: #1c2b3a;
    --text: #2d3e50;
    --soft: #71829b;
    --bg: #f2f4f7;
    --bg2: #eaecf0;
    --white: #ffffff;
    --line: #e0e6ef;
    --r: 16px;
    --r2: 24px;
    --shadow: 0 8px 32px rgba(15,25,35,0.08);
    --shadow-or: 0 12px 32px rgba(235,122,47,0.18);
    --shadow-bl: 0 12px 32px rgba(30,77,183,0.14);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body { font-family: 'DM Sans', sans-serif; color: var(--text); background: var(--white); }

.ck-wrap { max-width: 1280px; margin: 0 auto; padding: 0 24px; }

/* ════════════════════════════════════════
   HERO
════════════════════════════════════════ */
:root {
    --or: #eb7a2f;
    --or2: #f39a56;
    --bl: #1e4db7;
    --bl2: #3a6fd8;
    --dark: #0f1923;
    --dark2: #1c2b3a;
    --text: #2d3e50;
    --soft: #71829b;
    --bg: #f2f4f7;
    --bg2: #eaecf0;
    --white: #ffffff;
    --line: #e0e6ef;
    --r: 16px;
    --r2: 24px;
    --shadow: 0 8px 32px rgba(15,25,35,0.08);
    --shadow-or: 0 12px 32px rgba(235,122,47,0.18);
    --shadow-bl: 0 12px 32px rgba(30,77,183,0.14);
}

.ck-hero {
    position: relative;
    min-height: 420px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    overflow: hidden;
}

.ck-hero-left {
    background: var(--dark);
    display: flex;
    align-items: center;
    padding: 60px 56px 60px 48px;
    position: relative;
    z-index: 2;
}

.ck-hero-left::after {
    content: '';
    position: absolute;
    right: -60px;
    top: 0;
    bottom: 0;
    width: 120px;
    background: var(--dark);
    clip-path: polygon(0 0, 0 100%, 100% 100%);
    z-index: 1;
}

.ck-hero-text {
    position: relative;
    z-index: 2;
}

.ck-hero-text h1 {
    font-family: 'Manrope', sans-serif;
    font-size: clamp(28px, 3.8vw, 52px);
    font-weight: 900;
    color: var(--white);
    line-height: 1.1;
    letter-spacing: -0.02em;
}

.ck-hero-text h1 span {
    color: var(--or);
}

.ck-hero-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 28px;
}

.ck-hero-badge {
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.18);
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    padding: 6px 14px;
    border-radius: 999px;
    backdrop-filter: blur(4px);
}

.ck-hero-badge.active {
    background: var(--or);
    border-color: var(--or);
    color: #fff;
}

.ck-hero-right {
    position: relative;
    overflow: hidden;
}

.ck-hero-right img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.ck-hero-right::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, rgba(15,25,35,0.35) 0%, transparent 50%);
    z-index: 1;
}

/* ════════════════════════════════════════
   INTRO SECTION
════════════════════════════════════════ */
.ck-intro {
    padding: 64px 0 56px;
    background: var(--white);
}

.ck-section-head {
    text-align: center;
    margin-bottom: 40px;
}

.ck-section-head h2 {
    font-family: 'Manrope', sans-serif;
    font-size: clamp(22px, 2.6vw, 34px);
    font-weight: 900;
    color: var(--dark);
    margin-bottom: 14px;
    letter-spacing: -0.02em;
}

.ck-divider {
    width: 80px;
    height: 4px;
    border-radius: 999px;
    margin: 0 auto 20px;
    background: linear-gradient(90deg, var(--or) 40%, var(--bl) 100%);
}

.ck-section-head p {
    font-size: 16px;
    color: var(--soft);
    max-width: 640px;
    margin: 0 auto;
    line-height: 1.7;
}

.ck-intro-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 20px;
}

.ck-intro-card {
    background: var(--bg);
    border-radius: var(--r2);
    padding: 28px 24px;
    border-left: 4px solid transparent;
    transition: all 0.25s ease;
    position: relative;
    overflow: hidden;
}

.ck-intro-card::before {
    content: '';
    position: absolute;
    right: -20px;
    top: -20px;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    opacity: 0.06;
    transition: 0.25s;
}

.ck-intro-card:nth-child(1) { border-left-color: var(--or); }
.ck-intro-card:nth-child(1)::before { background: var(--or); }
.ck-intro-card:nth-child(2) { border-left-color: var(--bl); }
.ck-intro-card:nth-child(2)::before { background: var(--bl); }
.ck-intro-card:nth-child(3) { border-left-color: var(--or); }
.ck-intro-card:nth-child(3)::before { background: var(--or); }

.ck-intro-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow);
}

.ck-intro-card p {
    font-size: 15px;
    line-height: 1.75;
    color: var(--text);
}

.ck-intro-card p strong { color: var(--dark); }

/* ════════════════════════════════════════
   SERVICES SECTION
════════════════════════════════════════ */
.ck-services {
    padding: 64px 0;
    background: var(--bg);
}

.ck-services-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
}

.ck-service-card {
    border-radius: 8px;
    overflow: hidden;
    background: rgba(30, 77, 183, 0.08);
    box-shadow: 0 4px 12px rgba(15,25,35,0.09);
    transition: all 0.28s ease;
    cursor: default;
    border: 2px solid var(--bl2);
    text-decoration: none;
}

.ck-service-card:nth-child(even) {
    background: rgba(235, 122, 47, 0.12);
    border-color: var(--or2);
}

.ck-service-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 48px rgba(15,25,35,0.13);
}

.ck-service-card:nth-child(odd):hover { border-color: var(--bl); }
.ck-service-card:nth-child(even):hover { border-color: var(--or); }

.ck-service-img {
    width: 100%;
    aspect-ratio: 1.42 / 1;
    height: auto;
    object-fit: cover;
    display: block;
}

.ck-service-foot {
    min-height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 8px 10px 10px;
}

.ck-service-foot h3 {
    font-family: 'Manrope', sans-serif;
    font-size: 14px;
    font-weight: 800;
    color: var(--dark);
    line-height: 1.15;
    text-align: center;
    margin: 0;
}

/* ════════════════════════════════════════
   WHY CHOOSE
════════════════════════════════════════ */
.ck-why {
    padding: 64px 0;
    background: var(--white);
}

.ck-why-image-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 28px;
    align-items: center;
    justify-items: center;
}

.ck-why-image {
    width: 100%;
    max-width: 260px;
    height: auto;
    display: block;
    object-fit: contain;
    filter: drop-shadow(0 10px 16px rgba(15,25,35,0.12));
}

/* ════════════════════════════════════════
   FAQ
════════════════════════════════════════ */
.ck-faq {
    padding: 64px 0;
    background: var(--bg);
}

.ck-faq-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
    max-width: 900px;
    margin: 0 auto;
}

.ck-faq-item {
    background: var(--white);
    border-radius: var(--r);
    border: 1.5px solid var(--line);
    overflow: hidden;
    transition: box-shadow 0.2s;
}

.ck-faq-item:hover { box-shadow: var(--shadow); }

.ck-faq-q {
    width: 100%;
    background: none;
    border: none;
    text-align: left;
    padding: 20px 24px;
    font-family: 'Manrope', sans-serif;
    font-size: 16px;
    font-weight: 700;
    color: var(--dark);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    transition: color 0.2s;
}

.ck-faq-q:hover { color: var(--or); }

.ck-faq-q .ck-faq-arrow {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: var(--bg);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: all 0.25s ease;
    font-size: 18px;
    line-height: 1;
    color: var(--soft);
}

.ck-faq-item.open .ck-faq-q { color: var(--or); }
.ck-faq-item.open .ck-faq-arrow {
    background: var(--or);
    color: #fff;
    transform: rotate(45deg);
}

.ck-faq-a {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.35s ease, padding 0.2s;
    padding: 0 24px;
}

.ck-faq-a-inner {
    padding-bottom: 20px;
    font-size: 15px;
    color: var(--soft);
    line-height: 1.75;
    border-top: 1px solid var(--line);
    padding-top: 14px;
}

.ck-faq-item.open .ck-faq-a { max-height: 300px; }

/* ════════════════════════════════════════
   FOOTER META (Other Services + Locations)
════════════════════════════════════════ */
.ck-meta {
    padding: 40px 0 48px;
    background: var(--bg2);
    border-top: 1px solid var(--line);
}

.ck-meta-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
}

.ck-meta-block h4 {
    font-family: 'Manrope', sans-serif;
    font-size: 16px;
    font-weight: 800;
    color: var(--dark);
    margin-bottom: 10px;
}

.ck-meta-links {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.ck-meta-link {
    font-size: 14px;
    color: var(--soft);
    text-decoration: none;
    transition: color 0.2s;
    display: flex;
    align-items: center;
    gap: 4px;
}

.ck-meta-link:not(:last-child)::after {
    content: '|';
    color: var(--line);
    margin-left: 6px;
}

.ck-meta-link:hover { color: var(--or); }

.ck-loc-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 2px;
}

.ck-loc-tag {
    font-size: 13px;
    color: var(--bl);
    text-decoration: none;
    background: rgba(30,77,183,0.07);
    padding: 4px 12px;
    border-radius: 999px;
    font-weight: 600;
    transition: all 0.2s;
}

.ck-loc-tag:hover {
    background: var(--bl);
    color: #fff;
}

/* ════════════════════════════════════════
   RESPONSIVE
════════════════════════════════════════ */
@media (max-width: 1024px) {
    .ck-services-grid { grid-template-columns: repeat(2, 1fr); }
    .ck-intro-grid { grid-template-columns: 1fr 1fr; }
}

@media (max-width: 768px) {
    .ck-hero { grid-template-columns: 1fr; min-height: auto; }
    .ck-hero-left { padding: 48px 24px; }
    .ck-hero-left::after { display: none; }
    .ck-hero-right { height: 240px; }
    .ck-why-image-grid { grid-template-columns: repeat(2, 1fr); }
    .ck-meta-grid { grid-template-columns: 1fr; gap: 24px; }
}

@media (max-width: 600px) {
    .ck-services-grid { grid-template-columns: 1fr; }
    .ck-intro-grid { grid-template-columns: 1fr; }
    .ck-why-image-grid { grid-template-columns: 1fr; gap: 18px; }
}


 .ck-hero{
        min-height:430px;
        background:
            linear-gradient(90deg,rgba(0,0,0,.78) 0%,rgba(0,0,0,.55) 40%,rgba(0,0,0,.10) 100%),
            url("{{ asset('images/logo/c12.png') }}");
        background-size:cover;
        background-position:center;
        display:flex;
        align-items:center;
        padding:70px 7%;
    }

    .ck-hero h1{
        max-width:720px;
        color:#fff;
        font-size:52px;
        line-height:1.18;
        font-weight:900;
        text-shadow:0 4px 12px rgba(0,0,0,.45);
        margin:0;
    }
</style>

{{-- ══════════════════════════════════════
     HERO
══════════════════════════════════════ --}}


<section class="ck-hero">
    <h1>
        Civil Contractor Service in<br>
        Navi Mumbai, Mumbai,<br>
        Thane, Pune & Raigad
    </h1>
</section>
{{-- ══════════════════════════════════════
     INTRO
══════════════════════════════════════ --}}
<section class="ck-intro">
    <div class="ck-wrap">
        <div class="ck-section-head">
            <h2>Civil Contractor Services in Navi Mumbai, Mumbai, Raigad, Thane &amp; Pune</h2>
            <div class="ck-divider"></div>
        </div>
<div>
        <!-- <div class="ck-intro-grid"> -->
            <!-- <div class="ck-intro-card"> -->
                <p>Looking for <strong>reliable Civil Contractor Services</strong> in Navi Mumbai, Mumbai, Raigad, Thane, or Pune? ConstructKaro brings you a trusted platform where your construction project is handled by experienced professionals under one streamlined system.</p>
            <!-- </div> -->
            <!-- <div class="ck-intro-card"> -->
                <p>We are not just another listing platform. <strong>ConstructKaro</strong> takes responsibility for your project execution, ensuring quality, transparency, and timely delivery by assigning the right civil construction contractors for your needs.</p>
            <!-- </div> -->
            <!-- <div class="ck-intro-card"> -->
                <p>Whether you're planning a home, commercial space, industrial project, or infrastructure work, we connect you with the best <strong>civil construction contractors</strong> and manage the process end-to-end.</p>
            <!-- </div> -->
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     OUR SERVICES
══════════════════════════════════════ --}}
<section class="ck-services">
    <div class="ck-wrap">
        <div class="ck-section-head">
            <h2>Our Civil Contractor Services</h2>
            <div class="ck-divider"></div>
            <p>We offer complete civil works services across residential, commercial, and infrastructure projects.</p>
        </div>

        <div class="ck-services-grid">
            @php
                $services = [
                    ['title' => 'Residential Contractor', 'img' => 'images/logo/c1.png', 'url' => route('contractor.service.details', 'residential-contractor')],
                    ['title' => 'Road & Highway Contractor', 'img' => 'images/logo/c2.png', 'url' => route('contractor.service.details', 'road-highway-contractor')],
                    ['title' => 'Bridge Contractor', 'img' => 'images/logo/c3.png', 'url' => route('contractor.service.details', 'bridge-contractor')],
                    ['title' => 'Earthwork Excavation Contractor', 'img' => 'images/logo/c4.png', 'url' => route('contractor.service.details', 'earthwork-excavation-contractor')],
                    ['title' => 'MEP Contractor', 'img' => 'images/logo/c5.png', 'url' => route('contractor.service.details', 'mep-contractor')],
                    ['title' => 'Paint Contractor', 'img' => 'images/logo/c6.png', 'url' => route('contractor.service.details', 'paint-contractor')],
                    ['title' => 'Waterproofing Contractor', 'img' => 'images/logo/c7.png', 'url' => route('contractor.service.details', 'waterproofing-contractor')],
                    ['title' => 'Labour Contractor', 'img' => 'images/logo/c8.png', 'url' => route('contractor.service.details', 'labour-contractor')],


                    ['title' => 'Landscaping Contractor', 'img' => 'images/logo/c9.png', 'url' => route('contractor.service.details', 'landscaping-contractor')],
                    ['title' => 'Commercial Contractor', 'img' => 'images/logo/c10.png', 'url' => route('contractor.service.details', 'commercial-contractor')],
                    ['title' => 'Industrial Civil Contractor', 'img' => 'images/logo/c11.png', 'url' => route('contractor.service.details', 'industrial-civil-contractor')],
                    ['title' => 'Culverts Contractor', 'img' => 'images/logo/c3.png', 'url' => route('contractor.service.details', 'culverts-contractor')],
                ];
            @endphp

            @foreach($services as $s)
                <a class="ck-service-card" href="{{ $s['url'] ?? 'javascript:void(0)' }}">
                    <img class="ck-service-img" src="{{ asset($s['img']) }}" alt="{{ $s['title'] }}">
                    <div class="ck-service-foot">
                        <h3>{{ $s['title'] }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     WHY CHOOSE
══════════════════════════════════════ --}}
<section class="ck-why">
    <div class="ck-wrap">
        <div class="ck-section-head">
            <h2>Why Choose ConstructKaro for Civil Contractor Services?</h2>
            <div class="ck-divider"></div>
        </div>

        <div class="ck-why-image-grid">
            @php
                $whyImages = [
                    ['img' => 'images/logo/c13.png', 'alt' => 'Verified contractor service'],
                    ['img' => 'images/logo/c18.png', 'alt' => 'On-ground project management'],
                    ['img' => 'images/logo/c17.png', 'alt' => 'Transparent pricing'],
                    ['img' => 'images/logo/c14.png', 'alt' => 'Quality assurance'],
                    ['img' => 'images/logo/c16.png', 'alt' => 'On-time construction delivery'],
                    ['img' => 'images/logo/c15.png', 'alt' => 'Multi-city contractor coverage'],
                ];
            @endphp

            @foreach($whyImages as $image)
                <img class="ck-why-image" src="{{ asset($image['img']) }}" alt="{{ $image['alt'] }}">
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     FAQ
══════════════════════════════════════ --}}
<section class="ck-faq">
    <div class="ck-wrap">
        <div class="ck-section-head">
            <h2>Frequently Asked Questions (FAQs)</h2>
            <div class="ck-divider"></div>
        </div>

        <div class="ck-faq-list">
            @php
                $faqs = [
                    [
                        'q' => '1. What are Civil Contractor Services?',
                        'a' => 'Civil Contractor Services cover all construction activities related to buildings, roads, bridges, drainage, excavation, and infrastructure. A civil contractor manages labour, materials, equipment, and execution to complete a construction project as per design and specifications.',
                    ],
                    [
                        'q' => '2. How does ConstructKaro select contractors?',
                        'a' => 'ConstructKaro follows a strict onboarding process: contractors must submit valid licenses, proof of past project experience, and references. Our team verifies documents, conducts background checks, and evaluates work quality before listing them on the platform.',
                    ],
                    [
                        'q' => '3. Do you provide services for small projects?',
                        'a' => 'Yes. ConstructKaro caters to projects of all sizes — from individual home renovations and small commercial fit-outs to large-scale infrastructure and industrial construction. We match the right contractor size and expertise to your project scope.',
                    ],
                    [
                        'q' => '4. How long does it take to start the project?',
                        'a' => 'Once your requirements are confirmed and the contractor is assigned, most projects can begin site mobilisation within 5–10 working days. Timeline varies based on project size, permits, and material procurement requirements.',
                    ],
                    [
                        'q' => '5. Is pricing transparent?',
                        'a' => 'Absolutely. ConstructKaro provides detailed BOQ-based quotations before any work begins. All costs — labour, material, equipment, and overhead — are itemised so there are no surprises. Any scope changes are documented and priced separately with your approval.',
                    ],
                ];
            @endphp

            @foreach($faqs as $i => $faq)
                <div class="ck-faq-item" id="faq-{{ $i }}">
                    <button class="ck-faq-q" onclick="toggleFaq({{ $i }})">
                        <span>{{ $faq['q'] }}</span>
                        <span class="ck-faq-arrow">+</span>
                    </button>
                    <div class="ck-faq-a" id="faq-a-{{ $i }}">
                        <div class="ck-faq-a-inner">{{ $faq['a'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     META — OTHER SERVICES + LOCATIONS
══════════════════════════════════════ --}}
<section class="ck-meta">
    <div class="ck-wrap">
        <div class="ck-meta-grid">

            <div class="ck-meta-block">
                <h4>Our Other Services</h4>
                <div class="ck-meta-links">
                    @foreach(['Architect','Contractor','Interior Designer','Survey Services','Testing Services','BOQ / Estimation'] as $svc)
                        <a href="#" class="ck-meta-link">{{ $svc }}</a>
                    @endforeach
                </div>
            </div>

            <div class="ck-meta-block">
                <h4>Civil Contractor Services Locations:</h4>
                <div class="ck-loc-tags">
                    @foreach([
                        'Navi Mumbai' => '#',
                        'Mumbai'      => '#',
                        'Thane'       => '#',
                        'Raigad'      => '#',
                        'Pune'        => '#',
                    ] as $city => $url)
                        <a href="{{ $url }}" class="ck-loc-tag">Civil Contractor Services {{ $city }}</a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

    <!-- Include FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
function toggleFaq(idx) {
    const item = document.getElementById('faq-' + idx);
    const isOpen = item.classList.contains('open');
    // Close all
    document.querySelectorAll('.ck-faq-item').forEach(el => el.classList.remove('open'));
    // Open clicked if it was closed
    if (!isOpen) item.classList.add('open');
}
</script>

@endsection
