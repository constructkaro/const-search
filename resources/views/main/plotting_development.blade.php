@extends('layouts.app')

@section('title', 'End-to-End Plotting Development Solutions | ConstructKaro')
@section('meta_description', 'From Planning & Design to Infrastructure Development & Project Handover')
@section('og_image', asset('images/plotting/hero.webp'))

@push('styles')
<link rel="stylesheet" href="{{ asset('css/plotting-development.css') }}">
@endpush

@section('content')
<div class="plot-page">
    {{-- PDF page 1 --}}
    <section class="plot-hero">
        <div class="plot-wrap plot-hero-grid">
            <div class="plot-hero-copy">
                <h1>END-TO-END<br><em>PLOTTING DEVELOPMENT</em><br>SOLUTIONS</h1>
                <p>From Planning &amp; Design to Infrastructure Development &amp; Project Handover</p>
                <div class="plot-cover-label">COMPANY PROFILE &amp; PROJECT PORTFOLIO</div>
                <ul class="plot-cover-services">
                    <li>PLANNING &amp; DESIGN</li><li>SURVEY</li><li>INFRASTRUCTURE DEVELOPMENT</li><li>PROJECT HANDOVER</li>
                </ul>
            </div>
            <img class="plot-cover-image" src="{{ asset('images/plotting/hero.webp') }}" alt="Plotting Development" width="800" height="450" fetchpriority="high">
        </div>
    </section>

    {{-- PDF page 2 --}}
    <section class="plot-section">
        <div class="plot-wrap">
            <h2>ABOUT CONSTRUCTKARO</h2>
            <h3 class="plot-subheading">INTEGRATED CONSTRUCTION &amp; PLOTTING DEVELOPMENT SOLUTIONS</h3>
            <div class="plot-about-copy">
                <p>ConstructKaro is a construction services platform offering comprehensive solutions for plotting and land development projects.</p>
                <p>Backed by over 30 years of industry experience, our team brings extensive knowledge of land development, engineering, infrastructure construction and project execution.</p>
                <p>We offer integrated services covering the entire development lifecyclefrom initial feasibility assessment and land surveying to Architectural planning, technical design, cost estimation, construction &amp; final project handover.</p>
                <p>Our objective is to provide landowners and developers with a single, reliable platform for planning and executing their development projects efficiently.</p>
            </div>
        </div>
    </section>

    {{-- PDF pages 3 and 4 --}}
    <section class="plot-section plot-soft" id="development-services">
        <div class="plot-wrap">
            <h2>OUR END-TO-END DEVELOPMENT SOLUTIONS</h2>
            <h3 class="plot-subheading">COMPREHENSIVE SERVICES ACROSS EVERY STAGE OF PLOTTING DEVELOPMENT</h3>
            <p class="plot-section-copy">ConstructKaro provides coordinated technical, planning and construction solutions required for complete plotting development.</p>
            <div class="plot-services">
                <article class="plot-service"><h3><span>01</span> FEASIBILITY ASSESSMENT</h3><p>EVALUATION OF SITE CONDITIONS, LAND DEVELOPMENT POTENTIAL AND PRELIMINARY PROJECT VIABILITY.</p></article>
                <article class="plot-service"><h3><span>02</span> LAND SURVEYING</h3><p>TOPOGRAPHICAL SURVEYS, BOUNDARY MEASUREMENTS, SITE LEVELS AND MAPPING.</p></article>
                <article class="plot-service"><h3><span>03</span> ARCHITECTURAL PLANNING &amp; DESIGN</h3><p>PLOT SUBDIVISION LAYOUTS, ROAD PLANNING, OPEN SPACES AND MASTER LAYOUT DRAWINGS.</p></article>
                <article class="plot-service"><h3><span>04</span> COST ESTIMATION</h3><p>STRUCTURAL AND INFRASTRUCTURE DESIGN, BOQ PREPARATION AND DEVELOPMENT COST ESTIMATION.</p></article>
                <article class="plot-service"><h3><span>05</span> CONSTRUCTION &amp; INFRASTRUCTURE DEVELOPMENT</h3><p>EXECUTION OF ROADS, EARTHWORK, BOUNDARY WALLS, DRAINAGE, UTILITIES AND ASSOCIATED CIVIL WORKS.</p></article>
                <article class="plot-service"><h3><span>06</span> PROJECT COMPLETION &amp; HANDOVER</h3><p>QUALITY INSPECTIONS, FINISHING WORKS AND FINAL PROJECT DELIVERY.</p></article>
            </div>
        </div>
    </section>

    {{-- PDF pages 5 through 8, including the photo collage on page 7 --}}
    <section class="plot-section" id="plotting-projects">
        <div class="plot-wrap">
            <h2>COMPLETED PROJECTS</h2>
            <article class="plot-project">
                <div class="plot-project-copy">
                    <h3>1] GODREJ HILL VIEW</h3>
                    <dl><div><dt>PROJECT AREA:</dt><dd>40 ACRES</dd></div><div><dt>PROJECT LOCATION:</dt><dd>IMAGICA</dd></div></dl>
                    <h4>SCOPE OF WORK</h4>
                    <ul><li>PHASE C &amp; D &ndash; ROAD WORK</li><li>PHASE C &amp; D &ndash; AOS AREA CIVIL WORK</li><li>PLOTTING DEVELOPMENT</li></ul>
                </div>
                <div class="plot-project-images"><img src="{{ asset('images/plotting/godrej-hill-view.webp') }}" alt="GODREJ HILL VIEW" width="800" height="450" loading="lazy"></div>
            </article>
            <article class="plot-project">
                <div class="plot-project-copy">
                    <h3>2] GODREJ WOODSIDE PROPERTIES</h3>
                    <dl><div><dt>PROJECT AREA:</dt><dd>20 ACRES</dd></div><div><dt>PROJECT LOCATION:</dt><dd>KHALAPUR</dd></div></dl>
                    <h4>SCOPE OF WORK</h4>
                    <ul><li>PLOTTING DEVELOPMENT</li><li>ROAD WORK</li><li>UNDERGROUND GROUND TANK (UGT) WORK</li><li>ENTRANCE GATE WORK</li><li>CLUBHOUSE</li><li>OTHER PLOTTING DEVELOPMENT WORKS</li></ul>
                </div>
                <div class="plot-project-images"><img src="{{ asset('images/plotting/godrej-woodside.webp') }}" alt="GODREJ WOODSIDE PROPERTIES - ENTRANCE GATE" width="800" height="450" loading="lazy"><img src="{{ asset('images/plotting/woodside-road.webp') }}" alt="GODREJ WOODSIDE PROPERTIES - ROAD WORK" width="800" height="450" loading="lazy"></div>
            </article>
            <div class="plot-photo-collage"><img src="{{ asset('images/plotting/completed-projects.webp') }}" alt="COMPLETED PROJECTS" width="800" height="400" loading="lazy"></div>
            <article class="plot-project">
                <div class="plot-project-copy">
                    <h3>3] XRBIA &ndash; EIFFEL</h3>
                    <dl><div><dt>PROJECT AREA:</dt><dd>50 ACRES</dd></div><div><dt>PROJECT LOCATION:</dt><dd>WARAL, NERAL, TAL. KHALAPUR</dd></div></dl>
                    <h4>SCOPE OF WORK</h4>
                    <ul><li>INTERNAL ROAD PROJECT &ndash; PHASE I</li><li>INTERNAL ROAD PROJECT &ndash; PHASE II</li></ul>
                </div>
                <div class="plot-project-images"><img src="{{ asset('images/plotting/xrbia-eiffel.webp') }}" alt="XRBIA - EIFFEL" width="800" height="600" loading="lazy"></div>
            </article>
        </div>
    </section>

    {{-- PDF page 9 --}}
    <section class="plot-section plot-soft">
        <div class="plot-wrap">
            <h2>ONGOING PROJECTS</h2>
            <article class="plot-project">
                <div class="plot-project-copy">
                    <h3>1] NEOLIV</h3>
                    <dl><div><dt>PROJECT AREA:</dt><dd>10 ACRES</dd></div><div><dt>PROJECT LOCATION:</dt><dd>IMAGICA</dd></div></dl>
                    <h4>SCOPE OF WORK</h4>
                    <ul><li>PLOTTING DEVELOPMENT</li><li>RETAINING WALL WORK</li><li>PRECAST COMPOUND WALL WORK</li><li>STORM WATER DRAIN WORK</li></ul>
                </div>
                <div class="plot-project-images"><img src="{{ asset('images/plotting/neoliv.webp') }}" alt="NEOLIV - RETAINING WALL WORK" width="800" height="360" loading="lazy"><img src="{{ asset('images/plotting/neoliv-drainage.webp') }}" alt="NEOLIV - STORM WATER DRAIN WORK" width="800" height="450" loading="lazy"></div>
            </article>
        </div>
    </section>

    {{-- PDF page 10 --}}
    <section class="plot-section">
        <div class="plot-wrap">
            <h2>UPCOMING PROJECTS</h2>
            <div class="plot-upcoming">
                <article><h3>01 | JAMBHULPADA</h3><p class="plot-upcoming-area">PROJECT AREA: 10 ACRES</p><h4>Scope of Work</h4><ul><li>Internal Road Development</li><li>Retaining Wall Construction</li><li>Drainage Line Development</li><li>Entrance Gate Construction</li><li>Plot Demarcation</li></ul></article>
                <article><h3>02 | MANGAON</h3><p class="plot-upcoming-area">PROJECT AREA: 250 ACRES</p><h4>Scope of Work</h4><ul><li>Feasibility Study &amp; Site Assessment</li><li>Land Survey &amp; Layout Planning</li><li>Engineering Drawings &amp; BOQ</li><li>Plot Demarcation &amp; Infrastructure Development</li><li>Quality Monitoring &amp; Handover</li></ul></article>
                <article><h3>03 | POLADPUR</h3><p class="plot-upcoming-area">PROJECT AREA: 10.5 ACRES</p><h4>Scope of Work</h4><ul><li>Road Development</li><li>Clubhouse &amp; Hotel</li><li>Pool &amp; Restaurant</li><li>Kids Play Area</li><li>Yoga, Meditation &amp; Spa</li><li>Indoor &amp; Outdoor Games</li><li>Box Cricket &amp; Gym</li></ul></article>
                <article><h3>04 | KALOTE</h3><p class="plot-upcoming-area">PROJECT AREA: 3 ACRES</p><h4>Scope of Work</h4><ul><li>Internal Road Construction</li><li>Entrance Gate</li><li>Drainage Line Works</li><li>Plot Demarcation</li></ul></article>
                <article><h3>05 | KARJAT</h3><p class="plot-upcoming-area">PROJECT AREA: 6 ACRES</p><h4>Scope of Work</h4><ul><li>Internal Road Development</li><li>Plot Demarcation</li></ul></article>
            </div>
        </div>
    </section>

    {{-- PDF page 11 --}}
    <section class="plot-section plot-cta">
        <div class="plot-wrap">
            <h2>LET'S DEVELOP THE NEXT OPPORTUNITY TOGETHER.</h2>
            <h3 class="plot-subheading">YOUR VISION. OUR EXPERTISE. ONE INTEGRATED SOLUTION.</h3>
            <div class="plot-closing-copy">
                <p>EVERY SUCCESSFUL DEVELOPMENT BEGINS WITH THE RIGHT EXPERTISE AND EXECUTION PARTNER.</p>
                <p>AT CONSTRUCTKARO, WE BRING TOGETHER PLANNING, ENGINEERING AND CONSTRUCTION CAPABILITIES TO SUPPORT PLOTTING DEVELOPMENT PROJECTS OF VARYING SCALES AND COMPLEXITIES.</p>
                <p>WE WELCOME OPPORTUNITIES TO COLLABORATE WITH LEADING DEVELOPERS, LANDOWNERS AND ORGANIZATIONS SEEKING A RELIABLE PARTNER FOR THEIR UPCOMING DEVELOPMENTS.</p>
                <p class="plot-closing-line">LET'S EXPLORE HOW WE CAN CONTRIBUTE TO YOUR NEXT PROJECT.</p>
            </div>
            <div class="plot-contact"><a href="tel:+917385882657">73858 82657</a><a href="https://www.constructkaro.com">www.constructkaro.com</a></div>
        </div>
    </section>
</div>
@endsection
