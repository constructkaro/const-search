@extends('layouts.app')
@section('title', 'End-to-End Plotting Development & Infrastructure | ConstructKaro')
@section('meta_description', 'From land to landmark. End-to-end feasibility, surveying, planning, engineering and infrastructure execution across Raigad and the Mumbai 3.0 growth corridor.')
@section('og_image', asset('images/plotting/hero.webp'))
@push('styles')
<link rel="stylesheet" href="{{ asset('css/plotting-development.css') }}?v=20261031-full">
@endpush
@section('content')
<div class="plot-page">
    <section class="plot-hero" aria-labelledby="plot-heading">
        <div class="plot-wrap">
            <div class="plot-hero-copy">
                <p class="plot-eyebrow">LAND DEVELOPMENT | PLANNING | INFRASTRUCTURE | EXECUTION</p>
                <h1 id="plot-heading">From <span class="plot-gradient">Land to Landmark.</span><br>One Complete<br><span class="plot-gradient">Development Partner.</span></h1>
                <p>Transform your land into a well-planned, development-ready destination with ConstructKaro.</p>
                <p>Backed by <strong>30+ years of industry experience</strong>, we bring together technical expertise, regional understanding and on-ground execution capabilities to support your entire plotting development journey.</p>
                <p>From feasibility and land surveying to infrastructure construction and final handover — everything under one roof.</p>
                <div class="plot-hero-actions">
                    <a class="plot-btn plot-btn-primary" href="#development-services">Explore Our Solutions <span aria-hidden="true">&rarr;</span></a><a class="plot-btn plot-btn-outline" href="{{ route('guide.requirement') }}">Discuss Your Project</a>
                </div>
                <p class="plot-region-note"><em>Supporting land development across Khopoli, Khalapur, Karjat, Raigad and the Mumbai 3.0 growth corridor.</em></p>
            </div>
        </div>
    </section>
    <nav class="plot-section-nav" aria-label="Explore plotting development">
        <div class="plot-wrap">
            <a href="#project-experience">Project Experience</a><a href="#service-locations">Service Locations</a><a href="#development-services">Our Services</a><a href="#why-choose-us">Why Choose Us</a><a href="#our-process">Our Process</a><a href="#contact">Contact</a>
        </div>
    </nav>
    <section id="our-strength" class="plot-section plot-strength" aria-labelledby="our-strength-heading">
        <div class="plot-wrap">
            <div class="plot-section-intro">
                <p class="plot-eyebrow">Our strength</p><h2 id="our-strength-heading">Built on Experience. Driven by Execution.</h2><p>We understand that developing land requires more than planning and construction. It takes technical knowledge, local understanding, practical problem-solving and the right execution partner.</p><p>With experience supporting multi-acre developments for established real estate companies, our team brings the expertise needed to manage projects of different scales and complexities.</p>
            </div>
            <h3 class="plot-core-title">Our Core Strengths</h3>
            <div class="plot-highlights" aria-label="Our development expertise">
                <div class="plot-highlight">
                    <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="24" cy="24" r="11"/><circle cx="24" cy="24" r="7"/><path d="m20 24 3 3 6-7M17 33l-4 11 8-3 3 5 4-12m3-1 4 11-8-3M8 6l2 4 5 1-4 3 1 5-4-2-4 2 1-5-4-3 5-1Zm16-5 2 4 5 1-4 3 1 5-4-2-4 2 1-5-4-3 5-1Zm16 5 2 4 5 1-4 3 1 5-4-2-4 2 1-5-4-3 5-1Z"/></svg>
                    <div>
                        <strong>30+ Years</strong><span>Industry Experience</span>
                    </div>
                </div>
                <div class="plot-highlight">
                    <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M40 19c0 12-16 27-16 27S8 31 8 19a16 16 0 1 1 32 0Z"/><circle cx="24" cy="19" r="6"/></svg>
                    <div>
                        <strong>Regional</strong><span>Execution Expertise</span>
                    </div>
                </div>
                <div class="plot-highlight">
                    <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 44h42M7 44V30h8v14m5 0V22h8v22m5 0V12h8v32M4 24C20 22 31 13 42 3m-11 0h11v11"/></svg>
                    <div>
                        <strong>End-to-End</strong><span>Development Solutions</span>
                    </div>
                </div>
                <div class="plot-highlight">
                    <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="24" cy="14" r="7"/><circle cx="9" cy="18" r="5"/><circle cx="39" cy="18" r="5"/><path d="M12 41V31a12 12 0 0 1 24 0v10ZM12 27a8 8 0 0 0-11 7v5h11m24-12a8 8 0 0 1 11 7v5H36"/></svg>
                    <div>
                        <strong>Single-Window</strong><span>Project Support</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="project-experience" class="plot-section plot-footprint" aria-labelledby="project-experience-heading">
        <div class="plot-wrap">
            <p><strong>OUR REGIONAL EXPERIENCE</strong></p><h2 id="project-experience-heading">Rooted in the Region. Experienced in Development.</h2><p>Our project portfolio spans key development destinations across Raigad, including completed infrastructure works, ongoing execution and upcoming development engagements.</p><p>Our experience with established developers gives us practical knowledge of regional terrain, infrastructure requirements and the challenges of developing multi-acre land parcels.</p><h3>Established Regional Execution Experience</h3>
            <div class="plot-regional-projects">
                <article class="plot-experience-card">
                    <img src="{{ asset('images/plotting/godrej-hill-view.webp') }}" alt="IMAGICA CORRIDOR — 40 ACRES" loading="lazy" width="800" height="450">
                    <div class="plot-experience-copy">
                        <h4>01 | IMAGICA CORRIDOR — 40 ACRES</h4><p class="plot-project-state "><em>Completed Project</em></p><p>Internal road development, plotting infrastructure and associated civil works.</p>
                    </div>
                </article>
                <article class="plot-experience-card">
                    <img src="{{ asset('images/plotting/godrej-woodside.webp') }}" alt="KHALAPUR — 20 ACRES" loading="lazy" width="800" height="450">
                    <div class="plot-experience-copy">
                        <h4>02 | KHALAPUR — 20 ACRES</h4><p class="plot-project-state "><em>Completed Project</em></p><p>Plotted development infrastructure, internal roads, underground water tank, entrance gate and clubhouse works.</p>
                    </div>
                </article>
                <article class="plot-experience-card">
                    <img src="{{ asset('images/plotting/xrbia-eiffel.webp') }}" alt="WARAL–NERAL — 50 ACRES" loading="lazy" width="800" height="450">
                    <div class="plot-experience-copy">
                        <h4>03 | WARAL–NERAL — 50 ACRES</h4><p class="plot-project-state "><em>Completed Project</em></p><p>Internal road development executed across multiple project phases.</p>
                    </div>
                </article>
                <article class="plot-experience-card">
                    <img src="{{ asset('images/plotting/neoliv.webp') }}" alt="IMAGICA CORRIDOR — 10 ACRES" loading="lazy" width="800" height="450">
                    <div class="plot-experience-copy">
                        <h4>04 | IMAGICA CORRIDOR — 10 ACRES</h4><p class="plot-project-state is-ongoing"><em>Ongoing Project</em></p><p>Retaining wall construction, precast compound walls, stormwater drainage and associated infrastructure.</p>
                    </div>
                </article>
            </div>
            <h3>Regional Development Portfolio</h3>
            <div class="plot-upcoming">
                <article class="plot-upcoming-card">
                    <h4><strong>MANGAON | 250 ACRES</strong></h4><p class="plot-status"><em>Upcoming Development Engagement</em></p>
                    <div class="plot-project-scope">
                        <p>Feasibility studies, land surveying, layout planning, engineering drawings, BOQ, plot demarcation, infrastructure planning and project coordination.</p>
                    </div>
                </article>
                <article class="plot-upcoming-card">
                    <h4><strong>JAMBHULPADA | 10 ACRES</strong></h4><p class="plot-status"><em>Upcoming Development Engagement</em></p>
                    <div class="plot-project-scope">
                        <p>Internal road development, retaining walls, drainage infrastructure, entrance gate construction and plot demarcation.</p>
                    </div>
                </article>
                <article class="plot-upcoming-card">
                    <h4><strong>POLADPUR | 10.5 ACRES</strong></h4><p class="plot-status"><em>Upcoming Development Engagement</em></p>
                    <div class="plot-project-scope">
                        <p>Road development and planned hospitality and recreation infrastructure, including clubhouse and amenity facilities.</p>
                    </div>
                </article>
                <article class="plot-upcoming-card">
                    <h4><strong>KALOTE | 3 ACRES</strong></h4><p class="plot-status"><em>Upcoming Development Engagement</em></p>
                    <div class="plot-project-scope">
                        <p>Internal roads, entrance gate, drainage infrastructure and plot demarcation.</p>
                    </div>
                </article>
                <article class="plot-upcoming-card">
                    <h4><strong>KARJAT | 6 ACRES</strong></h4><p class="plot-status"><em>Upcoming Development Engagement</em></p>
                    <div class="plot-project-scope">
                        <p>Internal road development and plot demarcation.</p>
                    </div>
                </article>
            </div>
            <p class="plot-section-note"><strong>Regional Experience. Practical Knowledge. Development-Focused Expertise.</strong></p>
        </div>
    </section>
    <section id="service-locations" class="plot-section plot-locations" aria-labelledby="service-locations-heading">
        <div class="plot-wrap">
            <div class="plot-location-layout">
                <div>
                    <p><strong>WHERE WE WORK</strong></p><h2 id="service-locations-heading">Supporting the Next Wave of Development Across Mumbai 3.0 &amp; Raigad.</h2><p>With strong regional understanding and execution capabilities, ConstructKaro supports landowners, real estate developers and development partners across emerging growth destinations.</p>
                </div>
                <div class="plot-location-panel">
                    <h3>Our Service Locations</h3>
                    <ul class="plot-location-list">
                        <li>Khopoli</li><li>Khalapur</li><li>Karjat</li><li>Jambhulpada</li><li>Mangaon</li><li>Poladpur</li><li>Kalote</li><li>Pali</li><li>Pen</li><li>Panvel</li><li>Lonavala</li><li>Raigad</li><li>Mumbai 3.0</li>
                    </ul>
                </div>
            </div>
            <p>Whether you are planning a new plotted development, villa community or large-scale land development project, our team can provide technical, planning and execution support tailored to your location and project requirements.</p><p class="plot-section-note"><strong>One Development Partner. Multiple Locations. Complete Project Support.</strong></p>
        </div>
    </section>
    <section id="development-services" class="plot-section plot-solutions" aria-labelledby="development-services-heading">
        <div class="plot-wrap">
            <p><strong>WHAT WE DO</strong></p><h2 id="development-services-heading">Everything Your Development Needs.</h2><p>Integrated solutions designed to support every stage of plotting and infrastructure development.</p>
            <div class="plot-services">
                <article class="plot-detail-card">
                    <span class="plot-step-number" aria-hidden="true">01</span><h3>Land Feasibility &amp; Assessment</h3><p>Site evaluation, development potential, technical feasibility, market assessment and preliminary project viability.</p>
                </article>
                <article class="plot-detail-card">
                    <span class="plot-step-number" aria-hidden="true">02</span><h3>Land Surveying &amp; Mapping</h3><p>Topographical surveys, boundary measurements, contour mapping, site levels and plot demarcation.</p>
                </article>
                <article class="plot-detail-card">
                    <span class="plot-step-number" aria-hidden="true">03</span><h3>Architectural &amp; Layout Planning</h3><p>Master layouts, plot subdivision, internal road planning, open spaces and development drawings.</p>
                </article>
                <article class="plot-detail-card">
                    <span class="plot-step-number" aria-hidden="true">04</span><h3>Engineering, BOQ &amp; Estimation</h3><p>Infrastructure engineering, structural planning, technical drawings, quantity estimation and development cost planning.</p>
                </article>
                <article class="plot-detail-card">
                    <span class="plot-step-number" aria-hidden="true">05</span><h3>Civil &amp; Infrastructure Construction</h3><p>Internal roads, earthwork, drainage, retaining walls, compound walls, water infrastructure, entrance gates and associated civil works.</p>
                </article>
                <article class="plot-detail-card">
                    <span class="plot-step-number" aria-hidden="true">06</span><h3>Project Management &amp; Handover</h3><p>Execution coordination, contractor supervision, quality monitoring, project documentation and final handover support.</p>
                </article>
            </div>
            <div class="plot-section-note">
                <p><strong>From Initial Planning to Final Execution — Everything Under One Roof.</strong></p>
            </div>
        </div>
    </section>
    <section id="local-support" class="plot-section plot-local-support" aria-labelledby="local-support-heading">
        <div class="plot-wrap">
            <p><strong>LOCAL EXPERTISE. PRACTICAL SOLUTIONS.</strong></p><h2 id="local-support-heading">Local Challenges? We've Got Your Back.</h2><p>Every land development project comes with its own challenges — technical, operational, regulatory and local.</p><p>Our regional experience helps us understand these challenges and coordinate practical solutions, so your project can move forward with greater clarity and confidence.</p><h3>How We Support You</h3>
            <div class="plot-support-grid">
                <article class="plot-support-item">
                    <span class="plot-check" aria-hidden="true">&#10003;</span>
                    <div>
                        <h4><strong>Local Coordination</strong></h4><p>Support for on-ground communication, local stakeholders and site-related coordination.</p>
                    </div>
                </article>
                <article class="plot-support-item">
                    <span class="plot-check" aria-hidden="true">&#10003;</span>
                    <div>
                        <h4><strong>Legal &amp; Documentation Assistance</strong></h4><p>Coordination with qualified professionals for land documentation, due diligence and related legal requirements.</p>
                    </div>
                </article>
                <article class="plot-support-item">
                    <span class="plot-check" aria-hidden="true">&#10003;</span>
                    <div>
                        <h4><strong>Approval &amp; Liaisoning Support</strong></h4><p>Assistance with applicable development permissions, documentation and authority coordination.</p>
                    </div>
                </article>
                <article class="plot-support-item">
                    <span class="plot-check" aria-hidden="true">&#10003;</span>
                    <div>
                        <h4><strong>Technical Problem-Solving</strong></h4><p>Practical solutions for terrain, drainage, levels, infrastructure design and site-specific engineering challenges.</p>
                    </div>
                </article>
                <article class="plot-support-item">
                    <span class="plot-check" aria-hidden="true">&#10003;</span>
                    <div>
                        <h4><strong>Contractor &amp; Execution Coordination</strong></h4><p>Coordinated site activities, technical supervision, work planning and quality monitoring.</p>
                    </div>
                </article>
            </div>
            <div class="plot-partner-note">
                <h3>More Than a Contractor.</h3><p><strong>A Development Partner You Can Rely On.</strong></p>
            </div>
        </div>
    </section>
    <section id="why-choose-us" class="plot-section plot-why" aria-labelledby="why-choose-us-heading">
        <div class="plot-wrap">
            <p><strong>WHY DEVELOPERS CHOOSE US</strong></p><h2 id="why-choose-us-heading">Technical Expertise You Can Trust. Local Experience You Can Rely On.</h2>
            <div class="plot-reasons-grid">
                <article class="plot-detail-card">
                    <span class="plot-step-number" aria-hidden="true">01</span><h3>30+ Years of Industry Expertise</h3><p>Decades of practical technical knowledge across civil construction, infrastructure engineering and project execution.</p>
                </article>
                <article class="plot-detail-card">
                    <span class="plot-step-number" aria-hidden="true">02</span><h3>Experience Across Multi-Acre Developments</h3><p>Hands-on execution experience involving established real estate developers and regional plotted development projects.</p>
                </article>
                <article class="plot-detail-card">
                    <span class="plot-step-number" aria-hidden="true">03</span><h3>Strong Regional Understanding</h3><p>Practical understanding of land conditions, infrastructure requirements and development challenges across the Raigad corridor.</p>
                </article>
                <article class="plot-detail-card">
                    <span class="plot-step-number" aria-hidden="true">04</span><h3>End-to-End Development Capabilities</h3><p>One integrated approach covering feasibility, surveying, planning, engineering, construction and handover.</p>
                </article>
                <article class="plot-detail-card">
                    <span class="plot-step-number" aria-hidden="true">05</span><h3>Cost-Conscious Engineering</h3><p>Detailed BOQ, development estimates and practical engineering solutions to support effective project budgeting.</p>
                </article>
                <article class="plot-detail-card">
                    <span class="plot-step-number" aria-hidden="true">06</span><h3>Reliable On-Ground Coordination</h3><p>Technical teams, contractor coordination, site supervision and structured project monitoring.</p>
                </article>
            </div>
            <div class="plot-section-note">
                <p><strong>Your Project. Our Commitment. From Planning to Completion.</strong></p>
            </div>
        </div>
    </section>
    <section id="our-process" class="plot-section plot-process" aria-labelledby="our-process-heading">
        <div class="plot-wrap">
            <p><strong>HOW WE WORK</strong></p><h2 id="our-process-heading">A Clear Process. From Vision to Handover.</h2>
            <div class="plot-process-grid">
                <article class="plot-detail-card">
                    <span class="plot-step-number" aria-hidden="true">01</span><h3>Discover</h3><p>Understand your land, development vision and project requirements.</p>
                </article>
                <article class="plot-detail-card">
                    <span class="plot-step-number" aria-hidden="true">02</span><h3>Assess</h3><p>Evaluate feasibility, site conditions and technical challenges.</p>
                </article>
                <article class="plot-detail-card">
                    <span class="plot-step-number" aria-hidden="true">03</span><h3>Plan</h3><p>Prepare master layouts, engineering plans and development strategy.</p>
                </article>
                <article class="plot-detail-card">
                    <span class="plot-step-number" aria-hidden="true">04</span><h3>Estimate</h3><p>Develop BOQ, detailed costing and project execution planning.</p>
                </article>
                <article class="plot-detail-card">
                    <span class="plot-step-number" aria-hidden="true">05</span><h3>Execute</h3><p>Deliver civil and infrastructure works with coordinated supervision and quality monitoring.</p>
                </article>
                <article class="plot-detail-card">
                    <span class="plot-step-number" aria-hidden="true">06</span><h3>Handover</h3><p>Complete inspections, finishing works, documentation and final project delivery.</p>
                </article>
            </div>
            <div class="plot-section-note">
                <p><strong>Structured Planning. Coordinated Execution. Confident Delivery.</strong></p>
            </div>
        </div>
    </section>
    <section id="who-we-work-with" class="plot-section plot-audience" aria-labelledby="who-we-work-with-heading">
        <div class="plot-wrap">
            <p><strong>BUILT FOR DEVELOPMENT</strong></p><h2 id="who-we-work-with-heading">Supporting Developers, Landowners &amp; Growing Communities.</h2>
            <div class="plot-audience-grid">
                <article class="plot-audience-card">
                    <h3><strong>Real Estate Developers</strong></h3><p>Integrated technical and infrastructure execution support for large-scale developments.</p>
                </article>
                <article class="plot-audience-card">
                    <h3><strong>Plotted Development Companies</strong></h3><p>Specialized solutions for plotted layouts, villa communities and horizontal developments.</p>
                </article>
                <article class="plot-audience-card">
                    <h3><strong>Landowners &amp; JV Partners</strong></h3><p>Technical planning and development support to unlock land potential.</p>
                </article>
                <article class="plot-audience-card">
                    <h3><strong>Emerging Regional Developers</strong></h3><p>Experienced execution and engineering support for growing development businesses.</p>
                </article>
            </div>
        </div>
    </section>
    <section id="contact" class="plot-section plot-contact" aria-labelledby="contact-heading">
        <div class="plot-wrap">
            <p><strong>LET'S DEVELOP YOUR NEXT PROJECT TOGETHER</strong></p><h2 id="contact-heading">Your Land. Your Vision. Our Expertise.</h2><p>Every successful development starts with the right planning, technical knowledge and execution partner.</p><p>Whether you are evaluating land, planning a new plotting project or seeking dependable infrastructure execution support, ConstructKaro is ready to collaborate.</p><h3>Your Vision. Our Expertise. One Integrated Solution.</h3>
            <div class="plot-hero-actions">
                <a class="plot-btn plot-btn-primary" href="{{ route('guide.requirement') }}">Discuss Your Project <span aria-hidden="true">&rarr;</span></a><a class="plot-btn plot-btn-outline" href="{{ route('guide.requirement') }}">Request a Consultation</a>
            </div>
            <p><em>Let's explore how we can bring your next development to life.</em></p><a class="plot-phone" href="tel:+917385882657">Call +91 73858 82657</a>
        </div>
    </section>
</div>
@endsection
