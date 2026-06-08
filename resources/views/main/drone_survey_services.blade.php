@extends('layouts.app')

@section('title', 'Drone Survey Services')

@section('content')

<style>
    .drone-page {
        font-family: "Poppins", "Segoe UI", sans-serif;
        background: #efefef;
        color: #222;
    }

    .drone-hero {
        min-height: 330px;
        display: flex;
        align-items: center;
        padding: 58px 7%;
        background:
            /* linear-gradient(90deg, rgba(0,0,0,.86) 0%, rgba(0,0,0,.56) 45%, rgba(0,0,0,.08) 100%), */
            url("{{ asset('images/logo/ds1.png') }}") center/cover no-repeat;
    }

    .drone-hero h1 {
        max-width: 760px;
        margin: 0;
        color: #fff;
        font-size: clamp(34px, 5vw, 62px);
        line-height: 1.1;
        font-weight: 900;
        text-shadow: 0 5px 16px rgba(0,0,0,.5);
    }

    .drone-section {
        padding: 42px 7%;
    }

    .drone-wrap {
        max-width: 1180px;
        margin: 0 auto;
    }

    .drone-title {
        text-align: center;
        font-size: clamp(24px, 3vw, 36px);
        font-weight: 900;
        line-height: 1.2;
        margin: 0;
    }

    .drone-line {
        width: min(260px, 72vw);
        height: 4px;
        margin: 12px auto 28px;
        border-radius: 99px;
        background: linear-gradient(90deg, #f37021 0 50%, #1e73be 50% 100%);
    }

    .drone-copy {
        font-size: 17px;
        line-height: 1.7;
        color: #444;
        margin: 0 0 18px;
    }

    .drone-steps {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 12px;
        margin-top: 24px;
    }

    .drone-step {
        background: #fff;
        border: 2px solid #1e73be;
        border-radius: 8px;
        padding: 14px 10px;
        text-align: center;
        font-size: 13px;
        font-weight: 800;
        min-height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .drone-grid {
        display: grid;
        gap: 22px;
    }

    .drone-grid.three {
        grid-template-columns: repeat(3, 1fr);
    }

    .drone-grid.two {
        grid-template-columns: repeat(2, 1fr);
        max-width: 780px;
        margin: 22px auto 0;
    }

    .drone-grid.four {
        grid-template-columns: repeat(4, 1fr);
    }

    .drone-card {
        background: #fff7f1;
        border: 2px solid #f37021;
        border-radius: 10px;
        padding: 22px;
        box-shadow: 0 6px 16px rgba(0,0,0,.08);
        position: relative;
    }

    .drone-card.blue {
        border-color: #1e73be;
        background: #f3f9ff;
    }

    .drone-number {
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 28px;
        height: 28px;
        border-radius: 6px;
        background: #f37021;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 900;
    }

    .drone-card.blue .drone-number {
        background: #1e73be;
    }

    .drone-card h3 {
        margin: 8px 0 12px;
        color: #f37021;
        font-size: 18px;
        font-weight: 900;
    }

    .drone-card.blue h3 {
        color: #1e73be;
    }

    .drone-card ul {
        margin: 0;
        padding-left: 18px;
    }

    .drone-card li {
        color: #444;
        font-size: 14px;
        line-height: 1.55;
        margin-bottom: 7px;
    }

    .drone-project {
        overflow: hidden;
        padding: 0;
        background: #fff;
    }

    .drone-project img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        display: block;
    }

    .drone-project h3 {
        min-height: 64px;
        margin: 0;
        padding: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-size: 15px;
        color: #222;
    }

    .drone-checks {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 14px;
        text-align: center;
    }

    .drone-check {
        font-size: 13px;
        line-height: 1.45;
        font-weight: 800;
    }

    .drone-check span {
        display: block;
        color: #1e73be;
        font-size: 19px;
        margin-bottom: 6px;
    }

    .drone-process {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 14px;
    }

    .drone-process div {
        font-size: 14px;
        font-weight: 800;
        text-align: center;
        background: #fff;
        border-radius: 8px;
        padding: 16px 10px;
        border-top: 4px solid #f37021;
    }

    .drone-locations {
        max-width: 760px;
        margin: 0 auto;
        color: #333;
        font-size: 16px;
        line-height: 1.75;
    }

    .drone-faq {
        display: flex;
        flex-direction: column;
        gap: 13px;
    }

    .drone-faq details {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,.12);
        overflow: hidden;
    }

    .drone-faq summary {
        cursor: pointer;
        padding: 18px 22px;
        font-weight: 900;
        font-size: 15px;
    }

    .drone-faq p {
        margin: 0;
        padding: 0 22px 18px;
        color: #555;
        line-height: 1.6;
        font-size: 14px;
    }

    @media (max-width: 991px) {
        .drone-steps,
        .drone-grid.three,
        .drone-grid.four,
        .drone-checks,
        .drone-process {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .drone-hero {
            min-height: 280px;
            padding: 48px 22px;
        }

        .drone-section {
            padding: 34px 18px;
        }

        .drone-steps,
        .drone-grid.three,
        .drone-grid.two,
        .drone-grid.four,
        .drone-checks,
        .drone-process {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="drone-page">
    <section class="drone-hero">
        <!-- <h1>Drone Survey</h1> -->
    </section>

    <section class="drone-section">
        <div class="drone-wrap">
            <h2 class="drone-title">Drone Survey Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane</h2>
            <div class="drone-line"></div>
            <p class="drone-copy">
                Modern construction and land development projects require fast, accurate, and detailed site information. At ConstructKaro, we provide professional Drone Survey Services using advanced UAV technology to capture high-resolution aerial imagery, topographic data, and mapping information for construction, land development, infrastructure, mining, and real estate projects.
            </p>
            <p class="drone-copy">
                Drone surveys offer faster data collection, better site visualization, and highly accurate digital mapping compared to traditional survey methods.
            </p>
        </div>
    </section>

    <section class="drone-section">
        <div class="drone-wrap">
            <h2 class="drone-title">What is a Drone Survey?</h2>
            <div class="drone-line"></div>
            <p class="drone-copy">
                A Drone Survey uses specialized drones equipped with high-resolution cameras and mapping technology to capture aerial images and geospatial data.
            </p>
            <div class="drone-steps">
                <div class="drone-step">Orthomosaic maps</div>
                <div class="drone-step">Topographic maps</div>
                <div class="drone-step">Contour maps</div>
                <div class="drone-step">3D terrain models</div>
                <div class="drone-step">Site progress reports</div>
                <div class="drone-step">Volume calculation reports</div>
            </div>
            <p class="drone-copy" style="margin-top:24px;">
                This technology allows surveyors, architects, engineers, and developers to analyze large areas quickly and accurately.
            </p>
        </div>
    </section>

    <section class="drone-section">
        <div class="drone-wrap">
            <h2 class="drone-title">Our Drone Survey Services Include</h2>
            <div class="drone-line"></div>
            <div class="drone-grid three">
                <div class="drone-card">
                    <div class="drone-number">1</div>
                    <h3>Aerial Land Survey</h3>
                    <ul>
                        <li>High-speed area mapping</li>
                        <li>Property boundary visualization</li>
                        <li>Site development observation</li>
                        <li>Land measurement planning</li>
                    </ul>
                </div>
                <div class="drone-card blue">
                    <div class="drone-number">2</div>
                    <h3>Topographic & Contour Mapping</h3>
                    <ul>
                        <li>Ground level data</li>
                        <li>Contour mapping</li>
                        <li>Elevation analysis</li>
                        <li>Terrain modeling</li>
                    </ul>
                </div>
                <div class="drone-card">
                    <div class="drone-number">3</div>
                    <h3>Construction Progress Monitoring</h3>
                    <ul>
                        <li>Monthly progress tracking</li>
                        <li>Site status reporting</li>
                        <li>Project milestone updates</li>
                        <li>Construction area visualization</li>
                    </ul>
                </div>
            </div>
            <div class="drone-grid two">
                <div class="drone-card blue">
                    <div class="drone-number">4</div>
                    <h3>Volume Calculation Survey</h3>
                    <ul>
                        <li>Earthwork quantity calculation</li>
                        <li>Cut and fill volume calculation</li>
                        <li>Stockpile measurement</li>
                    </ul>
                </div>
                <div class="drone-card">
                    <div class="drone-number">5</div>
                    <h3>3D Mapping & Digital Models</h3>
                    <ul>
                        <li>Digital 3D models</li>
                        <li>Digital surface models</li>
                        <li>Site visualization support</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="drone-section">
        <div class="drone-wrap">
            <h2 class="drone-title">Applications of Drone Survey</h2>
            <div class="drone-line"></div>
            <div class="drone-grid four">
                <!-- <div class="drone-card drone-project"> -->
                    <img src="{{ asset('images/logo/ds2.png') }}" alt="Land development and plotting projects">
                    <!-- <h3>Land Development & Plotting Projects</h3> -->
                <!-- </div> -->
                <!-- <div class="drone-card drone-project blue"> -->
                    <img src="{{ asset('images/logo/ds3.png') }}" alt="Construction project monitoring">
                    <!-- <h3>Construction Project Monitoring</h3>
                </div> -->
                <!-- <div class="drone-card drone-project"> -->
                    <img src="{{ asset('images/logo/ds4.png') }}" alt="Infrastructure and road projects">
                    <!-- <h3>Infrastructure & Road Projects</h3>
                </div> -->
                <!-- <div class="drone-card drone-project blue"> -->
                    <img src="{{ asset('images/logo/ds5.png') }}" alt="Mining earthwork and volume analysis">
                    <!-- <h3>Mining, Earthwork & Volume Analysis</h3>
                </div> -->
            </div>
        </div>
    </section>

    <section class="drone-section">
        <div class="drone-wrap">
            <h2 class="drone-title">Benefits of Drone Survey</h2>
            <div class="drone-line"></div>
            <div class="drone-checks">
                <div class="drone-check"><span>&#10003;</span>Faster survey execution</div>
                <div class="drone-check"><span>&#10003;</span>High-resolution aerial imagery</div>
                <div class="drone-check"><span>&#10003;</span>Accurate topographic data</div>
                <div class="drone-check"><span>&#10003;</span>Large-area coverage</div>
                <div class="drone-check"><span>&#10003;</span>Reduced field survey time</div>
                <div class="drone-check"><span>&#10003;</span>Better project monitoring</div>
                <div class="drone-check"><span>&#10003;</span>Detailed 3D mapping capabilities</div>
            </div>
        </div>
    </section>

    <section class="drone-section">
        <div class="drone-wrap">
            <h2 class="drone-title">Why Choose ConstructKaro?</h2>
            <div class="drone-line"></div>
            <div class="drone-checks">
                <div class="drone-check"><span>&#10003;</span>Experienced drone survey professionals</div>
                <div class="drone-check"><span>&#10003;</span>Advanced UAV survey technology</div>
                <div class="drone-check"><span>&#10003;</span>High-resolution aerial mapping</div>
                <div class="drone-check"><span>&#10003;</span>Digital reports and GIS-compatible outputs</div>
                <div class="drone-check"><span>&#10003;</span>Support for residential, commercial and infrastructure projects</div>
                <div class="drone-check"><span>&#10003;</span>We help you gain complete site visibility, accurate land data, and faster project decision-making.</div>
            </div>
        </div>
    </section>

    <section class="drone-section">
        <div class="drone-wrap">
            <h2 class="drone-title">Our Drone Survey Process</h2>
            <div class="drone-line"></div>
            <div class="drone-process">
                <div>1. Requirement Discussion</div>
                <div>2. Site Assessment & Flight Planning</div>
                <div>3. Drone Data Collection</div>
                <div>4. Data Processing & Mapping</div>
                <div>5. Report Generation & Delivery</div>
            </div>
        </div>
    </section>

    <section class="drone-section">
        <div class="drone-wrap">
            <h2 class="drone-title">Target Locations We Serve</h2>
            <div class="drone-line"></div>
            <ul class="drone-locations">
                <li>Drone Survey in Navi Mumbai</li>
                <li>Drone Survey in Mumbai</li>
                <li>Drone Survey in Pune</li>
                <li>Drone Survey in Raigad</li>
                <li>Drone Survey in Thane</li>
            </ul>
        </div>
    </section>

    <section class="drone-section">
        <div class="drone-wrap">
            <h2 class="drone-title">Additional Locations</h2>
            <div class="drone-line"></div>
            <ul class="drone-locations">
                <li>Drone Survey in Panvel</li>
                <li>Drone Survey in Kharghar</li>
                <li>Drone Survey in Karjat</li>
                <li>Drone Survey in Khopoli</li>
                <li>Drone Survey in Alibaug</li>
            </ul>
        </div>
    </section>

    <section class="drone-section">
        <div class="drone-wrap">
            <h2 class="drone-title">Industries We Serve</h2>
            <div class="drone-line"></div>
            <ul class="drone-locations">
                <li>Real Estate Developers</li>
                <li>Construction Companies</li>
                <li>Infrastructure Contractors</li>
                <li>Industrial Developers</li>
                <li>Plotting & Township Projects</li>
                <li>Warehousing & Logistics Projects</li>
                <li>Government & Institutional Projects</li>
            </ul>
        </div>
    </section>

    <section class="drone-section">
        <div class="drone-wrap">
            <h2 class="drone-title">Frequently Asked Questions (FAQs)</h2>
            <div class="drone-line"></div>
            <div class="drone-faq">
                <details>
                    <summary>1. What is a drone survey used for?</summary>
                    <p>Drone survey is used for aerial mapping, topographic survey, land development planning, construction monitoring, volume calculation, and site visualization.</p>
                </details>
                <details>
                    <summary>2. How accurate are drone surveys?</summary>
                    <p>Drone survey accuracy depends on flight planning, control points, equipment, and processing methods. It can provide highly accurate data for planning and monitoring.</p>
                </details>
                <details>
                    <summary>3. Can drone surveys replace traditional surveys?</summary>
                    <p>Drone surveys are excellent for fast area coverage and mapping. For some high-precision site markings, they may be combined with Total Station or DGPS surveys.</p>
                </details>
                <details>
                    <summary>4. Do you provide contour maps and 3D models?</summary>
                    <p>Yes, drone survey outputs can include contour maps, orthomosaic maps, elevation models, and 3D digital models based on the project scope.</p>
                </details>
                <details>
                    <summary>5. Can drone surveys be used for plotting projects?</summary>
                    <p>Yes, drone surveys can support plotting projects through land visualization, topographic data, area planning, and development monitoring.</p>
                </details>
            </div>
        </div>
    </section>
</div>

@endsection
