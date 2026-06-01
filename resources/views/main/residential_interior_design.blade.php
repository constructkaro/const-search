@extends('layouts.app')

@section('title', 'Residential Interior Design')

@section('content')
<style>
    body {
        background: #e9e9e9;
        color: #262626;
        font-family: "Poppins", Arial, sans-serif;
    }

    .res-hero {
        min-height: 330px;
        background:
            linear-gradient(90deg, rgba(0,0,0,.88) 0%, rgba(0,0,0,.72) 38%, rgba(0,0,0,.18) 100%),
            url("{{ asset('images/logo/i2.png') }}");
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        padding: 48px 36px;
    }

    .res-hero h1 {
        margin: 0;
        color: #fff;
        font-size: 58px;
        line-height: 1.18;
        font-weight: 900;
        letter-spacing: .2px;
        max-width: 720px;
        text-shadow: 0 5px 14px rgba(0,0,0,.45);
    }

    .res-page {
        background: #e9e9e9;
        padding: 42px 18px 70px;
    }

    .res-wrap {
        max-width: 1180px;
        margin: 0 auto;
    }

    .res-section {
        margin-bottom: 56px;
    }

    .res-title {
        margin: 0;
        text-align: center;
        color: #252525;
        font-size: 28px;
        line-height: 1.25;
        font-weight: 900;
    }

    .res-title.small {
        font-size: 24px;
    }

    .res-line {
        width: 560px;
        max-width: 70%;
        height: 3px;
        margin: 12px auto 28px;
        background: linear-gradient(90deg, #f37021 0 50%, #1e73be 50% 100%);
        border-radius: 20px;
    }

    .res-text {
        max-width: 1100px;
        margin: 0 auto 18px;
        color: #4c4c4c;
        font-size: 15px;
        line-height: 1.55;
        font-weight: 500;
    }

    .res-text strong {
        color: #252525;
        font-weight: 900;
    }

    .pill-row {
        display: grid;
        grid-template-columns: repeat(7, minmax(0, 1fr));
        gap: 8px;
        margin: 22px auto;
    }

    .pill {
        min-height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 6px 8px;
        background: #eaf4ff;
        border: 2px solid #1e73be;
        border-radius: 4px;
        color: #111;
        font-size: 11px;
        font-weight: 900;
        line-height: 1.2;
    }

    .pill.orange {
        background: #fff0e6;
        border-color: #f37021;
    }

    .service-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 48px 40px;
        max-width: 940px;
        margin: 0 auto;
    }

    .service-card {
        position: relative;
        min-height: 145px;
        background: #fff0e6;
        border: 2px solid #f37021;
        border-radius: 10px;
        padding: 30px 18px 18px;
        box-shadow: 0 5px 7px rgba(0,0,0,.18);
    }

    .service-card.blue {
        background: #eaf4ff;
        border-color: #1e73be;
    }

    .service-num {
        position: absolute;
        top: -14px;
        left: 50%;
        transform: translateX(-50%);
        width: 26px;
        height: 26px;
        border-radius: 5px;
        background: #f37021;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        font-weight: 900;
    }

    .service-card.blue .service-num {
        background: #1e73be;
    }

    .service-card h3 {
        margin: 0 0 16px;
        text-align: center;
        color: #f37021;
        font-size: 15px;
        line-height: 1.25;
        font-weight: 900;
    }

    .service-card.blue h3 {
        color: #1e73be;
    }

    .service-card ul {
        margin: 0;
        padding-left: 28px;
        color: #111;
        font-size: 10px;
        line-height: 1.55;
        font-weight: 700;
    }

    .project-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        max-width: 900px;
        margin: 0 auto;
    }

    .project-card {
        background: #fff0e6;
        border: 2px solid #f37021;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0,0,0,.16);
    }

    .project-card.blue {
        background: #eaf4ff;
        border-color: #1e73be;
    }

    .project-card img {
        width: 100%;
        height: 118px;
        object-fit: cover;
        display: block;
    }

    .project-card h3 {
        min-height: 45px;
        margin: 0;
        padding: 8px 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #111;
        font-size: 10px;
        line-height: 1.15;
        font-weight: 900;
    }

    .style-row {
        display: flex;
        justify-content: center;
        gap: 18px;
        flex-wrap: wrap;
        max-width: 1040px;
        margin: 0 auto;
        color: #111;
        font-size: 12px;
        font-weight: 900;
        line-height: 1.6;
    }

    .style-row span::before,
    .check-item::before {
        content: "✓ ";
        font-weight: 900;
    }

    .check-grid {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 18px;
        margin: 0 auto 18px;
    }

    .check-item {
        text-align: center;
        color: #111;
        font-size: 11px;
        line-height: 1.25;
        font-weight: 900;
    }

    .center-note {
        max-width: 950px;
        margin: 16px auto 0;
        text-align: center;
        color: #4c4c4c;
        font-size: 11px;
        font-weight: 600;
    }

    .process-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 24px;
        max-width: 960px;
        margin: 0 auto;
    }

    .process-item {
        text-align: center;
        color: #111;
        font-size: 11px;
        line-height: 1.2;
        font-weight: 900;
    }

    .location-block {
        max-width: 1080px;
        margin: 0 auto 36px;
        color: #111;
        font-size: 12px;
        line-height: 1.7;
        font-weight: 700;
    }

    .location-block h3 {
        margin: 0 0 6px;
        color: #111;
        font-size: 14px;
        font-weight: 900;
    }

    .location-block ul {
        margin: 0;
        padding-left: 18px;
    }

    .faq-wrap {
        max-width: 680px;
        margin: 0 auto;
    }

    .faq-item {
        background: #fff;
        border-radius: 4px;
        margin-bottom: 12px;
        box-shadow: 0 2px 5px rgba(0,0,0,.2);
        overflow: hidden;
    }

    .faq-question {
        width: 100%;
        border: none;
        background: #fff;
        color: #111;
        padding: 16px 22px;
        text-align: left;
        font-size: 12px;
        font-weight: 900;
        cursor: pointer;
    }

    .faq-answer {
        display: none;
        padding: 0 22px 16px;
        color: #4c4c4c;
        font-size: 12px;
        line-height: 1.5;
        font-weight: 600;
    }

    .faq-item.active .faq-answer {
        display: block;
    }

    @media (max-width: 900px) {
        .res-hero h1 {
            font-size: 40px;
        }

        .pill-row,
        .service-grid,
        .project-grid,
        .check-grid,
        .process-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .res-hero {
            min-height: 260px;
            padding: 34px 20px;
        }

        .res-hero h1 {
            font-size: 32px;
        }

        .res-title,
        .res-title.small {
            font-size: 21px;
        }

        .pill-row,
        .service-grid,
        .project-grid,
        .check-grid,
        .process-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="res-hero">
    <h1>Residential Interior<br>Design</h1>
</section>

<main class="res-page">
    <div class="res-wrap">
        <section class="res-section">
            <h2 class="res-title">Residential Interior Design Services in Navi Mumbai, Mumbai, Pune, Raigad &amp; Thane</h2>
            <div class="res-line"></div>

            <p class="res-text">
                A well-designed home is more than just attractive interiors it reflects your lifestyle, personality, and comfort. At <strong>ConstructKaro</strong>, we provide professional <strong>Residential Interior Design</strong> Services for apartments, flats, villas, bungalows, duplex homes, and farmhouses.
            </p>
            <p class="res-text">
                Our interior designers focus on creating spaces that are stylish, practical, comfortable, and customized to your family's needs while optimizing every square foot of available space.
            </p>
        </section>

        <section class="res-section">
            <h2 class="res-title small">What is Residential Interior Design?</h2>
            <div class="res-line"></div>

            <p class="res-text">
                <strong>Residential Interior Design</strong> is the process of planning and designing the interior spaces of a home to improve functionality, aesthetics, comfort, and space utilization.
            </p>
            <p class="res-text">It includes:</p>

            <div class="pill-row">
                <div class="pill">Space planning</div>
                <div class="pill orange">Furniture layout</div>
                <div class="pill">Modular furniture design</div>
                <div class="pill orange">False ceiling design</div>
                <div class="pill">Lighting design</div>
                <div class="pill orange">Material<br>&amp; color selection</div>
                <div class="pill">Decorative elements</div>
            </div>

            <p class="res-text">The goal is to create a home that looks beautiful and functions efficiently.</p>
        </section>

        <section class="res-section">
            <h2 class="res-title">Our Residential Interior Design Services Include</h2>
            <div class="res-line"></div>

            <div class="service-grid">
                @php
                    $services = [
                        ['Complete Home Interior Design', ['Full-home interior solutions', 'Apartment interior design', 'Villa & bungalow interiors', 'Turnkey interior execution'], false],
                        ['Living Room Interior Design', ['TV unit design', 'Feature wall concepts', 'Seating layout planning', 'Lighting and decor solutions'], true],
                        ['Modular Kitchen Design', ['Modern modular kitchens', 'L-shaped kitchens', 'U-shaped kitchens', 'Island kitchen concepts', 'Storage optimization'], false],
                        ['Bedroom Interior Design', ['Master bedroom design', 'Kids bedroom interiors', 'Guest room design', 'Wardrobe & storage planning'], true],
                        ['Dining & Common Area Design', ['Dining room layouts', 'Family lounge design', 'Passage and foyer design', 'Space optimization solutions'], false],
                        ['False Ceiling & Lighting Design', ['Modern false ceiling concepts', 'Ambient lighting design', 'Decorative lighting planning', 'Energy-efficient lighting solutions'], true],
                    ];
                @endphp

                @foreach($services as $service)
                    <div class="service-card {{ $service[2] ? 'blue' : '' }}">
                        <div class="service-num">{{ $loop->iteration }}</div>
                        <h3>{{ $service[0] }}</h3>
                        <ul>
                            @foreach($service[1] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="res-section">
            <h2 class="res-title small">Types of Residential Interior Design Projects</h2>
            <div class="res-line"></div>

            <div class="project-grid">
                <!-- <div class="project-card"> -->
                    <img src="{{ asset('images/logo/ri1.png') }}" alt="1 BHK Interior Design">
                    <!-- <h3>1 BHK Interior Design</h3> -->
                <!-- </div> -->
                <!-- <div class="project-card blue"> -->
                    <img src="{{ asset('images/logo/ri2.png') }}" alt="2 BHK Interior Design">
                    <!-- <h3>2 BHK Interior Design</h3> -->
                <!-- </div> -->
                <!-- <div class="project-card"> -->
                    <img src="{{ asset('images/logo/ri3.png') }}" alt="3 BHK Interior Design">
                    <!-- <h3>3 BHK &amp; 4 BHK Interior<br>Design</h3> -->
                <!-- </div> -->
                <!-- <div class="project-card blue"> -->
                    <img src="{{ asset('images/logo/ri4.png') }}" alt="Villa and Bungalow Interior Design">
                    <!-- <h3>Villa &amp; Bungalow<br>Interior Design</h3> -->
                <!-- </div> -->
            </div>
        </section>

        <section class="res-section">
            <h2 class="res-title small">Popular Interior Design Styles</h2>
            <div class="res-line"></div>
            <div class="style-row">
                <span>Modern Interior Design</span>
                <span>Contemporary Interior Design</span>
                <span>Minimalist Home Interiors</span>
                <span>Luxury Interior Design</span>
                <span>Classic Interior Design</span>
                <span>Scandinavian Interior Design</span>
                <span>Industrial Interior Design</span>
                <span>Modern Indian Interior Design</span>
            </div>
        </section>

        <section class="res-section">
            <h2 class="res-title small">Why Residential Interior Design is Important?</h2>
            <div class="res-line"></div>
            <div class="check-grid">
                <div class="check-item">Better<br>space utilization</div>
                <div class="check-item">Improved<br>aesthetics &amp; comfort</div>
                <div class="check-item">Increased<br>property value</div>
                <div class="check-item">Organized<br>storage solutions</div>
                <div class="check-item">Better lighting<br>and functionality</div>
                <div class="check-item">Personalized<br>living experience</div>
            </div>
        </section>

        <section class="res-section">
            <h2 class="res-title small">Why Choose ConstructKaro?</h2>
            <div class="res-line"></div>
            <div class="check-grid">
                <div class="check-item">Experienced<br>residential interior<br>designers</div>
                <div class="check-item">Customized<br>home interior<br>solutions</div>
                <div class="check-item">3D design<br>visualization<br>support</div>
                <div class="check-item">Material<br>selection<br>guidance</div>
                <div class="check-item">Turnkey<br>interior execution<br>options</div>
                <div class="check-item">Budget-friendly<br>to luxury<br>interior solutions</div>
            </div>
            <p class="center-note">We help homeowners create beautiful, functional, and future-ready living spaces that match their lifestyle and budget.</p>
        </section>

        <section class="res-section">
            <h2 class="res-title small">Our Interior Design Process</h2>
            <div class="res-line"></div>
            <div class="process-grid">
                <div class="process-item">1. Requirement<br>Discussion</div>
                <div class="process-item">2. Site Measurement<br>&amp; Assessment</div>
                <div class="process-item">3. Space Planning &amp;<br>Concept Design</div>
                <div class="process-item">4. 3D Design &amp;<br>Visualization</div>
                <div class="process-item">5. Material<br>Selection</div>
                <div class="process-item">6. Execution &amp;<br>Installation</div>
                <div class="process-item">7. Final Handover</div>
            </div>
        </section>

        <section class="res-section">
            <div class="location-block">
                <h3>Target Locations We Serve</h3>
                <strong>Residential Interior Design Services</strong>
                <ul>
                    <li>Residential Interior Designer in Navi Mumbai</li>
                    <li>Home Interior Design Services in Mumbai</li>
                    <li>Residential Interior Designer in Pune</li>
                    <li>Interior Design Services in Raigad</li>
                    <li>Home Interior Designer in Thane</li>
                </ul>
            </div>

            <div class="location-block">
                <h3>Additional Locations</h3>
                <ul>
                    <li>Interior Designer in Panvel</li>
                    <li>Interior Designer in Kharghar</li>
                    <li>Interior Designer in Vashi</li>
                    <li>Interior Designer in Khopoli</li>
                    <li>Construction Survey in Alibaug</li>
                </ul>
            </div>
        </section>

        <section class="res-section">
            <h2 class="res-title small">Frequently Asked Questions (FAQs)</h2>
            <div class="res-line"></div>

            <div class="faq-wrap">
                @php
                    $faqs = [
                        ['What is included in residential interior design?', 'Residential interior design can include space planning, furniture layout, modular furniture, kitchen design, bedroom design, false ceiling, lighting, material selection, and execution support.'],
                        ['Do you provide 3D interior designs?', 'Yes, 3D interior design visualization can be provided depending on project scope.'],
                        ['Can you design interiors for 1 BHK, 2 BHK, and 3 BHK homes?', 'Yes, residential interior design can be planned for 1 BHK, 2 BHK, 3 BHK, villas, bungalows, and duplex homes.'],
                        ['Do you offer turnkey interior execution?', 'Yes, turnkey interior execution support can be provided through verified interior design and execution teams.'],
                        ['How much does residential interior design cost?', 'Cost depends on area, material quality, furniture scope, design style, and execution requirements.'],
                    ];
                @endphp

                @foreach($faqs as $faq)
                    <div class="faq-item">
                        <button type="button" class="faq-question">{{ $loop->iteration }}. {{ $faq[0] }}</button>
                        <div class="faq-answer">{{ $faq[1] }}</div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</main>

<script>
    document.querySelectorAll('.faq-question').forEach(function(button){
        button.addEventListener('click', function(){
            this.closest('.faq-item').classList.toggle('active');
        });
    });
</script>
@endsection
