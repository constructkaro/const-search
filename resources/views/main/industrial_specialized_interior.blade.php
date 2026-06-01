@extends('layouts.app')

@section('title', 'Industrial & Specialized Interior Design')

@section('content')
<style>
    body {
        background: #e9e9e9;
        color: #262626;
        font-family: "Poppins", Arial, sans-serif;
    }

    .ind-hero {
        min-height: 330px;
        background:
            linear-gradient(90deg, rgba(0,0,0,.90) 0%, rgba(0,0,0,.72) 38%, rgba(0,0,0,.18) 100%),
            url("{{ asset('images/logo/i6.png') }}");
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        padding: 48px 36px;
    }

    .ind-hero h1 {
        margin: 0;
        color: #fff;
        font-size: 50px;
        line-height: 1.12;
        font-weight: 900;
        letter-spacing: .2px;
        max-width: 760px;
        text-shadow: 0 5px 14px rgba(0,0,0,.45);
    }

    .ind-page {
        background: #e9e9e9;
        padding: 42px 18px 70px;
    }

    .ind-wrap {
        max-width: 1180px;
        margin: 0 auto;
    }

    .ind-section {
        margin-bottom: 56px;
    }

    .ind-title {
        margin: 0;
        text-align: center;
        color: #252525;
        font-size: 28px;
        line-height: 1.25;
        font-weight: 900;
    }

    .ind-title.small {
        font-size: 24px;
    }

    .ind-line {
        width: 560px;
        max-width: 70%;
        height: 3px;
        margin: 12px auto 28px;
        background: linear-gradient(90deg, #f37021 0 50%, #1e73be 50% 100%);
        border-radius: 20px;
    }

    .ind-text {
        max-width: 1100px;
        margin: 0 auto 18px;
        color: #4c4c4c;
        font-size: 15px;
        line-height: 1.55;
        font-weight: 500;
    }

    .ind-text strong {
        color: #252525;
        font-weight: 900;
    }

    .pill-row {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
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
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 18px;
        max-width: 980px;
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
        .ind-hero h1 {
            font-size: 38px;
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
        .ind-hero {
            min-height: 260px;
            padding: 34px 20px;
        }

        .ind-hero h1 {
            font-size: 30px;
        }

        .ind-title,
        .ind-title.small {
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

<section class="ind-hero">
    <h1>Industrial &amp; Specialized<br>Interior Design</h1>
</section>

<main class="ind-page">
    <div class="ind-wrap">
        <section class="ind-section">
            <h2 class="ind-title">Industrial &amp; Specialized Interior Design Services in Navi Mumbai, Mumbai, Pune, Raigad &amp; Thane</h2>
            <div class="ind-line"></div>

            <p class="ind-text">
                Industrial and specialized facilities require interior spaces that are highly functional, safe, organized, efficient, and compliant with technical needs while maintaining a professional appearance. At <strong>ConstructKaro</strong>, we provide expert Industrial &amp; Specialized Interior Design Services for factories, warehouses, manufacturing facilities, laboratories, data centers, healthcare facilities, educational institutions, and specialized commercial environments.
            </p>
            <p class="ind-text">
                Our designs focus on optimizing workflow, minimizing space utilization, improving productivity, and supporting industry-specific operational requirements.
            </p>
        </section>

        <section class="ind-section">
            <h2 class="ind-title small">What are Industrial &amp; Specialized Interiors?</h2>
            <div class="ind-line"></div>

            <p class="ind-text">
                Industrial &amp; Specialized Interior Design involves designing workspaces and facilities that require technical planning, operational functionality, safety standards, and efficient space management.
            </p>

            <div class="pill-row">
                <div class="pill">Factories &amp;<br>Manufacturing Units</div>
                <div class="pill orange">Warehouses &amp;<br>Logistics Facilities</div>
                <div class="pill">Industrial Offices</div>
                <div class="pill orange">Laboratories</div>
                <div class="pill">Data Centers</div>
                <div class="pill orange">Control Rooms</div>
                <div class="pill">Educational<br>Institutions</div>
                <div class="pill orange">Healthcare Facilities</div>
                <div class="pill">Research Centers</div>
                <div class="pill orange">Clean Rooms</div>
            </div>

            <p class="ind-text">The objective is to create practical and efficient spaces that support daily operations and future growth.</p>
        </section>

        <section class="ind-section">
            <h2 class="ind-title">Our Hospitality Interior Design Services Include</h2>
            <div class="ind-line"></div>

            <div class="service-grid">
                @php
                    $services = [
                        ['Factory & Manufacturing Unit Interiors', ['Production area planning', 'Admin and office interiors', 'Worker facility planning', 'Workflow optimization'], false],
                        ['Warehouse & Logistics Interior Design', ['Warehouse office interiors', 'Storage zone planning', 'Dispatch and receiving areas', 'Staff facilities and admin zones'], true],
                        ['Laboratory Interior Design', ['Research laboratory planning', 'Technical furniture layout', 'Safety-focused interiors', 'Storage and utility coordination'], false],
                        ['Data Center Interior Design', ['Server room planning', 'Technical furniture', 'Cooling and cabling coordination', 'Control room interiors'], true],
                        ['Healthcare & Institutional Interiors', ['Clinic and healthcare interiors', 'Institutional spaces', 'Hygienic layouts', 'Functional planning'], false],
                        ['Turnkey Industrial Interior Solutions', ['Design to execution', 'MEP coordination', 'Technical furniture', 'Site supervision and handover'], true],
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

        <section class="ind-section">
            <h2 class="ind-title small">Types of Industrial &amp; Specialized Interior Projects</h2>
            <div class="ind-line"></div>

            <div class="project-grid">
                <div class="project-card">
                    <img src="{{ asset('images/logo/i6.png') }}" alt="Factory and Manufacturing Interiors">
                    <h3>Factory &amp; Manufacturing<br>Interiors</h3>
                </div>
                <div class="project-card blue">
                    <img src="{{ asset('images/logo/ic5.png') }}" alt="Warehouse and Logistics Interiors">
                    <h3>Warehouse &amp; Logistics<br>Interiors</h3>
                </div>
                <div class="project-card">
                    <img src="{{ asset('images/logo/i3.png') }}" alt="Laboratory and Research Facility Interiors">
                    <h3>Laboratory &amp; Research<br>Facility Interiors</h3>
                </div>
                <div class="project-card blue">
                    <img src="{{ asset('images/logo/i4.png') }}" alt="Data Center and Technical Facility Interiors">
                    <h3>Data Center &amp; Technical<br>Facility Interiors</h3>
                </div>
            </div>
        </section>

        <section class="ind-section">
            <h2 class="ind-title small">Industries We Serve</h2>
            <div class="ind-line"></div>
            <div class="style-row">
                <span>Manufacturing Industry</span>
                <span>Warehousing &amp; Logistics</span>
                <span>Educational Institutions</span>
                <span>Technology &amp; Data Infrastructure</span>
                <span>Research &amp; Development</span>
            </div>
        </section>

        <section class="ind-section">
            <h2 class="ind-title small">Key Features of Industrial &amp; Specialized Interiors</h2>
            <div class="ind-line"></div>
            <div class="check-grid">
                <div class="check-item">Efficient workflow planning</div>
                <div class="check-item">Safe space utilization</div>
                <div class="check-item">Safety-focused design</div>
                <div class="check-item">Industry-specific functionality</div>
                <div class="check-item">MEP integration support</div>
                <div class="check-item">Durable and low-maintenance materials</div>
                <div class="check-item">Compliance-oriented planning</div>
                <div class="check-item">Future expansion consideration</div>
            </div>
        </section>

        <section class="ind-section">
            <h2 class="ind-title small">Why Choose ConstructKaro?</h2>
            <div class="ind-line"></div>
            <div class="check-grid">
                <div class="check-item">Experienced<br>industrial interior<br>designers</div>
                <div class="check-item">Specialized<br>facility<br>planning expertise</div>
                <div class="check-item">MEP and utility<br>coordination<br>support</div>
                <div class="check-item">Industry-specific<br>workflow<br>solutions</div>
                <div class="check-item">Turnkey<br>execution<br>services</div>
                <div class="check-item">Suitable for<br>industrial and technical<br>environments</div>
            </div>
            <p class="center-note">We help organizations create efficient, productive, and future-ready facilities that support operational excellence.</p>
        </section>

        <section class="ind-section">
            <h2 class="ind-title small">Our Design Process</h2>
            <div class="ind-line"></div>
            <div class="process-grid">
                <div class="process-item">1. Requirement &amp;<br>Operational<br>Analysis</div>
                <div class="process-item">2. Site<br>Assessment &amp;<br>Measurement</div>
                <div class="process-item">3. Workflow &amp;<br>Space<br>Planning</div>
                <div class="process-item">4. Concept<br>Development &amp; 3D<br>Design</div>
                <div class="process-item">5. Technical<br>Coordination &amp;<br>Material Selection</div>
                <div class="process-item">6. Final<br>Testing &amp;<br>Handover</div>
            </div>
        </section>

        <section class="ind-section">
            <div class="location-block">
                <h3>Target Locations We Serve</h3>
                <strong>Industrial Interior Design Services</strong>
                <ul>
                    <li>Industrial Interior Designer in Navi Mumbai</li>
                    <li>Factory Interior Design Services in Mumbai</li>
                    <li>Warehouse Interior Designer in Pune</li>
                    <li>Specialized Interior Design Services in Raigad</li>
                    <li>Industrial Interior Designer in Thane</li>
                </ul>
            </div>

            <div class="location-block">
                <h3>Additional Locations</h3>
                <ul>
                    <li>Industrial Interior Designer in Panvel</li>
                    <li>Warehouse Interior Designer in Taloja</li>
                    <li>Factory Interior Designer in Khopoli</li>
                    <li>Industrial Interior Designers in Bhiwandi</li>
                    <li>Specialized Interior Design in Alibaug</li>
                </ul>
            </div>
        </section>

        <section class="ind-section">
            <h2 class="ind-title small">Frequently Asked Questions (FAQs)</h2>
            <div class="ind-line"></div>

            <div class="faq-wrap">
                @php
                    $faqs = [
                        ['What types of industrial interiors do you design?', 'We design factory interiors, warehouse interiors, laboratory interiors, data center interiors, control rooms, healthcare facilities, educational institutions, research centers, and technical spaces.'],
                        ['Do you provide MEP coordination for industrial projects?', 'Yes, industrial and specialized interiors can include coordination for electrical, plumbing, HVAC, fire safety, utility lines, and technical service requirements.'],
                        ['Can you design laboratories and technical facilities?', 'Yes, laboratory, research, data center, control room, and specialized technical facility interiors can be planned based on operational requirements.'],
                        ['Do you provide turnkey industrial interior execution?', 'Yes, turnkey execution support can include planning, material selection, technical coordination, site execution, and handover.'],
                        ['How much does industrial interior design cost?', 'Cost depends on area, technical requirements, material specifications, MEP scope, safety needs, and execution complexity.'],
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
