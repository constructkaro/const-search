@extends('layouts.app')

@section('title', 'Road & Infrastructure Survey Services')

@section('content')

<style>
    .road-page {
        font-family: "Poppins", "Segoe UI", sans-serif;
        background: #efefef;
        color: #222;
    }

    .road-hero {
        min-height: 330px;
        display: flex;
        align-items: center;
        padding: 58px 7%;
        background:
            /* linear-gradient(90deg, rgba(0,0,0,.86) 0%, rgba(0,0,0,.56) 45%, rgba(0,0,0,.08) 100%), */
            url("{{ asset('images/logo/ris1.png') }}") center/cover no-repeat;
    }

    .road-hero h1 {
        max-width: 760px;
        margin: 0;
        color: #fff;
        font-size: clamp(34px, 5vw, 62px);
        line-height: 1.1;
        font-weight: 900;
        text-shadow: 0 5px 16px rgba(0,0,0,.5);
    }

    .road-section {
        padding: 42px 7%;
    }

    .road-wrap {
        max-width: 1180px;
        margin: 0 auto;
    }

    .road-title {
        text-align: center;
        font-size: clamp(24px, 3vw, 36px);
        font-weight: 900;
        line-height: 1.2;
        margin: 0;
    }

    .road-line {
        width: min(260px, 72vw);
        height: 4px;
        margin: 12px auto 28px;
        border-radius: 99px;
        background: linear-gradient(90deg, #f37021 0 50%, #1e73be 50% 100%);
    }

    .road-copy {
        font-size: 17px;
        line-height: 1.7;
        color: #444;
        margin: 0 0 18px;
    }

    .road-steps {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 12px;
        margin-top: 24px;
    }

    .road-step {
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

    .road-grid {
        display: grid;
        gap: 22px;
    }

    .road-grid.three {
        grid-template-columns: repeat(3, 1fr);
    }

    .road-grid.two {
        grid-template-columns: repeat(2, 1fr);
        max-width: 780px;
        margin: 22px auto 0;
    }

    .road-grid.four {
        grid-template-columns: repeat(4, 1fr);
    }

    .road-card {
        background: #fff7f1;
        border: 2px solid #f37021;
        border-radius: 10px;
        padding: 22px;
        box-shadow: 0 6px 16px rgba(0,0,0,.08);
        position: relative;
    }

    .road-card.blue {
        border-color: #1e73be;
        background: #f3f9ff;
    }

    .road-number {
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

    .road-card.blue .road-number {
        background: #1e73be;
    }

    .road-card h3 {
        margin: 8px 0 12px;
        color: #f37021;
        font-size: 18px;
        font-weight: 900;
    }

    .road-card.blue h3 {
        color: #1e73be;
    }

    .road-card ul {
        margin: 0;
        padding-left: 18px;
    }

    .road-card li {
        color: #444;
        font-size: 14px;
        line-height: 1.55;
        margin-bottom: 7px;
    }

    .road-project {
        overflow: hidden;
        padding: 0;
        background: #fff;
    }

    .road-project img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        display: block;
    }

    .road-project h3 {
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

    .road-checks {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 14px;
        text-align: center;
    }

    .road-check {
        font-size: 13px;
        line-height: 1.45;
        font-weight: 800;
    }

    .road-check span {
        display: block;
        color: #1e73be;
        font-size: 19px;
        margin-bottom: 6px;
    }

    .road-process {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 14px;
    }

    .road-process div {
        font-size: 14px;
        font-weight: 800;
        text-align: center;
        background: #fff;
        border-radius: 8px;
        padding: 16px 10px;
        border-top: 4px solid #f37021;
    }

    .road-list-block {
        max-width: 760px;
        margin: 0 auto 28px;
        color: #333;
        font-size: 16px;
        line-height: 1.75;
    }

    .road-list-block h3 {
        margin: 0 0 8px;
        font-size: 19px;
        font-weight: 900;
    }

    .road-faq {
        display: flex;
        flex-direction: column;
        gap: 13px;
    }

    .road-faq details {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,.12);
        overflow: hidden;
    }

    .road-faq summary {
        cursor: pointer;
        padding: 18px 22px;
        font-weight: 900;
        font-size: 15px;
    }

    .road-faq p {
        margin: 0;
        padding: 0 22px 18px;
        color: #555;
        line-height: 1.6;
        font-size: 14px;
    }

    @media (max-width: 991px) {
        .road-steps,
        .road-grid.three,
        .road-grid.four,
        .road-checks,
        .road-process {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .road-hero {
            min-height: 280px;
            padding: 48px 22px;
        }

        .road-section {
            padding: 34px 18px;
        }

        .road-steps,
        .road-grid.three,
        .road-grid.two,
        .road-grid.four,
        .road-checks,
        .road-process {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="road-page">
    <section class="road-hero">
        <h1 class="ck-visually-hidden">Road &amp; Infrastructure Survey</h1>
    </section>

    <section class="road-section">
        <div class="road-wrap">
            <h2 class="road-title">Road & Infrastructure Survey Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane</h2>
            <div class="road-line"></div>
            <p class="road-copy">
                Successful infrastructure development begins with accurate survey data. At ConstructKaro, we provide professional Road & Infrastructure Survey Services using advanced Total Station, DGPS, Drone Survey, and GIS Mapping technologies to support planning, design, execution, and monitoring of infrastructure projects.
            </p>
            <p class="road-copy">
                Whether it is a highway, internal road, industrial corridor, drainage network, bridge approach road, or township infrastructure project, our survey solutions provide the precise data required for efficient project execution.
            </p>
        </div>
    </section>

    <section class="road-section">
        <div class="road-wrap">
            <h2 class="road-title">What is a Road & Infrastructure Survey?</h2>
            <div class="road-line"></div>
            <p class="road-copy">
                A Road & Infrastructure Survey is a detailed engineering survey conducted to collect site data for the planning, design, construction, and maintenance of infrastructure projects.
            </p>
            <p class="road-copy">The survey includes:</p>
            <div class="road-steps">
                <div class="road-step">Alignment survey</div>
                <div class="road-step">Topographic mapping</div>
                <div class="road-step">Road levels and gradients</div>
                <div class="road-step">Structure survey</div>
                <div class="road-step">Drainage and utility survey</div>
                <div class="road-step">As-built survey</div>
            </div>
            <p class="road-copy" style="margin-top:24px;">
                This data helps engineers and planners make informed decisions before and during project execution.
            </p>
        </div>
    </section>

    <section class="road-section">
        <div class="road-wrap">
            <h2 class="road-title">Our Road & Infrastructure Survey Services Include</h2>
            <div class="road-line"></div>
            <div class="road-grid three">
                <div class="road-card">
                    <div class="road-number">1</div>
                    <h3>Road Alignment Survey</h3>
                    <ul>
                        <li>Centerline alignment marking</li>
                        <li>Road boundary survey</li>
                        <li>Chainage and benchmark marking</li>
                        <li>Right-of-way verification</li>
                    </ul>
                </div>
                <div class="road-card blue">
                    <div class="road-number">2</div>
                    <h3>Topographic & Contour Survey</h3>
                    <ul>
                        <li>Road level mapping</li>
                        <li>Contour survey</li>
                        <li>Terrain analysis</li>
                        <li>Cross-section data</li>
                    </ul>
                </div>
                <div class="road-card">
                    <div class="road-number">3</div>
                    <h3>Construction Layout Survey</h3>
                    <ul>
                        <li>Road centerline setting out</li>
                        <li>Curve marking</li>
                        <li>Culvert and drainage alignment</li>
                        <li>Structure layout marking</li>
                    </ul>
                </div>
            </div>
            <div class="road-grid two">
                <div class="road-card blue">
                    <div class="road-number">4</div>
                    <h3>Utility & Corridor Survey</h3>
                    <ul>
                        <li>Existing utility survey</li>
                        <li>Pipeline and cable route mapping</li>
                        <li>Drainage network survey</li>
                        <li>Water and sewer line survey</li>
                    </ul>
                </div>
                <div class="road-card">
                    <div class="road-number">5</div>
                    <h3>As-Built & Progress Survey</h3>
                    <ul>
                        <li>Construction progress data</li>
                        <li>As-built verification</li>
                        <li>Road width and level checks</li>
                        <li>Quality assurance support</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="road-section">
        <div class="road-wrap">
            <h2 class="road-title">Types of Road & Infrastructure Survey Projects</h2>
            <div class="road-line"></div>
            <div class="road-grid four">
                <!-- <div class="road-card road-project"> -->
                    <img src="{{ asset('images/logo/ris2.png') }}" alt="Road and highway survey">
                    <!-- <h3>Road & Highway Survey</h3>
                </div> -->
                <!-- <div class="road-card road-project blue"> -->
                    <img src="{{ asset('images/logo/ris3.png') }}" alt="Drainage and utility infrastructure survey">
                    <!-- <h3>Drainage & Utility Infrastructure Survey</h3>
                </div> -->
                <!-- <div class="road-card road-project"> -->
                    <img src="{{ asset('images/logo/ris4.png') }}" alt="Bridge, culvert and infrastructure survey">
                    <!-- <h3>Bridge, Culvert & Infrastructure Survey</h3>
                </div> -->
                <!-- <div class="road-card road-project blue"> -->
                    <img src="{{ asset('images/logo/ris5.png') }}" alt="Industrial and township infrastructure survey">
                    <!-- <h3>Industrial & Township Infrastructure Survey</h3>
                </div> -->
            </div>
        </div>
    </section>

    <section class="road-section">
        <div class="road-wrap">
            <h2 class="road-title">Survey Technologies We Use</h2>
            <div class="road-line"></div>
            <div class="road-list-block">
                <h3>Total Station Survey</h3>
                <ul>
                    <li>High-precision measurements</li>
                    <li>Construction layout marking</li>
                    <li>Alignment and setting out</li>
                </ul>
            </div>
            <div class="road-list-block">
                <h3>DGPS Survey</h3>
                <ul>
                    <li>Large-scale coordinate mapping</li>
                    <li>Accurate road corridor mapping</li>
                    <li>Infrastructure planning</li>
                </ul>
            </div>
            <div class="road-list-block">
                <h3>Drone Survey</h3>
                <ul>
                    <li>Aerial mapping</li>
                    <li>Progress monitoring</li>
                    <li>Topographic data collection</li>
                </ul>
            </div>
            <div class="road-list-block">
                <h3>GIS Mapping</h3>
                <ul>
                    <li>Digital infrastructure planning</li>
                    <li>Utility corridor mapping</li>
                    <li>Geospatial analysis</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="road-section">
        <div class="road-wrap">
            <h2 class="road-title">Benefits of Road & Infrastructure Survey</h2>
            <div class="road-line"></div>
            <div class="road-checks">
                <div class="road-check"><span>&#10003;</span>Accurate project planning</div>
                <div class="road-check"><span>&#10003;</span>Reduced design errors</div>
                <div class="road-check"><span>&#10003;</span>Better route optimization</div>
                <div class="road-check"><span>&#10003;</span>Faster construction execution</div>
                <div class="road-check"><span>&#10003;</span>Improved earthwork estimation</div>
                <div class="road-check"><span>&#10003;</span>Accurate utility coordination</div>
                <div class="road-check"><span>&#10003;</span>Enhanced project monitoring</div>
            </div>
        </div>
    </section>

    <section class="road-section">
        <div class="road-wrap">
            <h2 class="road-title">Why Choose ConstructKaro?</h2>
            <div class="road-line"></div>
            <div class="road-checks">
                <div class="road-check"><span>&#10003;</span>Experienced infrastructure survey professionals</div>
                <div class="road-check"><span>&#10003;</span>Advanced DGPS, Drone and Total Station equipment</div>
                <div class="road-check"><span>&#10003;</span>Accurate engineering survey data</div>
                <div class="road-check"><span>&#10003;</span>CAD drawings and digital reports</div>
                <div class="road-check"><span>&#10003;</span>Support for public and private infrastructure projects</div>
                <div class="road-check"><span>&#10003;</span>We help engineers, developers, contractors, and infrastructure teams execute projects with accurate survey data and professional support.</div>
            </div>
        </div>
    </section>

    <section class="road-section">
        <div class="road-wrap">
            <h2 class="road-title">Our Survey Process</h2>
            <div class="road-line"></div>
            <div class="road-process">
                <div>1. Project Requirement Analysis</div>
                <div>2. Site Reconnaissance Survey</div>
                <div>3. Data Collection & Mapping</div>
                <div>4. Processing & Engineering Analysis</div>
                <div>5. CAD Drawings & Report Preparation</div>
                <div>6. Final Survey Submission</div>
            </div>
        </div>
    </section>

    <section class="road-section">
        <div class="road-wrap">
            <h2 class="road-title">Target Locations We Serve</h2>
            <div class="road-line"></div>
            <div class="road-list-block">
                <h3>Maharashtra Infrastructure Survey Services</h3>
                <ul>
                    <li>Road Survey in Navi Mumbai</li>
                    <li>Infrastructure Survey in Mumbai</li>
                    <li>Highway Survey in Pune</li>
                    <li>Road Alignment Survey in Raigad</li>
                    <li>Engineering Survey in Thane</li>
                </ul>
            </div>
            <div class="road-list-block">
                <h3>Additional Locations</h3>
                <ul>
                    <li>Road Survey in Panvel</li>
                    <li>Infrastructure Survey in Kharghar</li>
                    <li>Highway Survey in Karjat</li>
                    <li>Construction Survey in Khopoli</li>
                    <li>Engineering Survey in Alibaug</li>
                </ul>
            </div>
            <div class="road-list-block">
                <h3>Industries We Serve</h3>
                <ul>
                    <li>Road & Highway Contractors</li>
                    <li>Infrastructure Developers</li>
                    <li>Government Projects</li>
                    <li>Industrial Developers</li>
                    <li>Logistics & Warehousing Companies</li>
                    <li>Township Developers</li>
                    <li>Civil Engineering Consultants</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="road-section">
        <div class="road-wrap">
            <h2 class="road-title">Frequently Asked Questions (FAQs)</h2>
            <div class="road-line"></div>
            <div class="road-faq">
                <details>
                    <summary>1. What is a road alignment survey?</summary>
                    <p>A road alignment survey marks and verifies the centerline, levels, curves, gradients, and reference points needed for road construction and planning.</p>
                </details>
                <details>
                    <summary>2. Do you provide surveys for drainage and utility infrastructure?</summary>
                    <p>Yes, surveys can include drainage lines, utility corridors, pipeline routes, cable routes, and related infrastructure mapping.</p>
                </details>
                <details>
                    <summary>3. Which survey technologies do you use?</summary>
                    <p>We use Total Station, DGPS, Drone Survey, CAD mapping, and GIS mapping depending on the project requirement.</p>
                </details>
                <details>
                    <summary>4. Can you provide as-built surveys after construction?</summary>
                    <p>Yes, as-built surveys can verify completed work, road widths, levels, alignments, and utility positions after construction.</p>
                </details>
                <details>
                    <summary>5. Do you support industrial and township infrastructure projects?</summary>
                    <p>Yes, we support industrial parks, townships, internal roads, infrastructure corridors, and other land development projects.</p>
                </details>
            </div>
        </div>
    </section>
</div>

@endsection
