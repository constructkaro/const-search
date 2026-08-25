@extends('layouts.app')

@section('title', 'Topographic Survey Services')

@section('content')

<style>
    .topo-page {
        font-family: "Poppins", "Segoe UI", sans-serif;
        background: #efefef;
        color: #222;
    }

    .topo-hero {
        min-height: 330px;
        display: flex;
        align-items: center;
        padding: 58px 7%;
        background:
            /* linear-gradient(90deg, rgba(0,0,0,.86) 0%, rgba(0,0,0,.58) 48%, rgba(0,0,0,.08) 100%), */
            url("{{ asset('images/logo/ts1.png') }}") center/cover no-repeat;
    }

    .topo-hero h1 {
        max-width: 760px;
        margin: 0;
        color: #fff;
        font-size: clamp(34px, 5vw, 62px);
        line-height: 1.1;
        font-weight: 900;
        text-shadow: 0 5px 16px rgba(0,0,0,.5);
    }

    .topo-section {
        padding: 42px 7%;
    }

    .topo-wrap {
        max-width: 1180px;
        margin: 0 auto;
    }

    .topo-title {
        text-align: center;
        font-size: clamp(24px, 3vw, 36px);
        font-weight: 900;
        line-height: 1.2;
        margin: 0;
    }

    .topo-line {
        width: min(260px, 72vw);
        height: 4px;
        margin: 12px auto 28px;
        border-radius: 99px;
        background: linear-gradient(90deg, #f37021 0 50%, #1e73be 50% 100%);
    }

    .topo-copy {
        font-size: 17px;
        line-height: 1.7;
        color: #444;
        margin: 0 0 18px;
    }

    .topo-steps {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-top: 24px;
    }

    .topo-step {
        background: #fff;
        border: 2px solid #1e73be;
        border-radius: 8px;
        padding: 16px 12px;
        text-align: center;
        font-size: 14px;
        font-weight: 800;
        min-height: 78px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .topo-grid {
        display: grid;
        gap: 22px;
    }

    .topo-grid.three {
        grid-template-columns: repeat(3, 1fr);
    }

    .topo-grid.two {
        grid-template-columns: repeat(2, 1fr);
        max-width: 780px;
        margin: 22px auto 0;
    }

    .topo-grid.four {
        grid-template-columns: repeat(4, 1fr);
    }

    .topo-card {
        background: #fff;
        border: 2px solid #f37021;
        border-radius: 10px;
        padding: 22px;
        box-shadow: 0 6px 16px rgba(0,0,0,.08);
        position: relative;
    }

    .topo-card.blue {
        border-color: #1e73be;
        background: #f3f9ff;
    }

    .topo-number {
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

    .topo-card.blue .topo-number {
        background: #1e73be;
    }

    .topo-card h3 {
        margin: 8px 0 12px;
        color: #f37021;
        font-size: 18px;
        font-weight: 900;
    }

    .topo-card.blue h3 {
        color: #1e73be;
    }

    .topo-card ul {
        margin: 0;
        padding-left: 18px;
    }

    .topo-card li {
        color: #444;
        font-size: 14px;
        line-height: 1.55;
        margin-bottom: 7px;
    }

    .topo-project {
        overflow: hidden;
        padding: 0;
    }

    .topo-project img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        display: block;
    }

    .topo-project h3 {
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

    .topo-checks {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 16px;
        text-align: center;
    }

    .topo-check {
        font-size: 14px;
        line-height: 1.45;
        font-weight: 800;
    }

    .topo-check span {
        display: block;
        color: #1e73be;
        font-size: 20px;
        margin-bottom: 6px;
    }

    .topo-process {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 14px;
    }

    .topo-process div {
        font-size: 14px;
        font-weight: 800;
        text-align: center;
        background: #fff;
        border-radius: 8px;
        padding: 16px 10px;
        border-top: 4px solid #f37021;
    }

    .topo-locations {
        max-width: 760px;
        margin: 0 auto;
        color: #333;
        font-size: 16px;
        line-height: 1.75;
    }

    .topo-faq {
        display: flex;
        flex-direction: column;
        gap: 13px;
    }

    .topo-faq details {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,.12);
        overflow: hidden;
    }

    .topo-faq summary {
        cursor: pointer;
        padding: 18px 22px;
        font-weight: 900;
        font-size: 15px;
    }

    .topo-faq p {
        margin: 0;
        padding: 0 22px 18px;
        color: #555;
        line-height: 1.6;
        font-size: 14px;
    }

    @media (max-width: 991px) {
        .topo-steps,
        .topo-grid.three,
        .topo-grid.two,
        .topo-grid.four,
        .topo-checks,
        .topo-process {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .topo-hero {
            min-height: 280px;
            padding: 48px 22px;
        }

        .topo-section {
            padding: 34px 18px;
        }

        .topo-steps,
        .topo-grid.three,
        .topo-grid.two,
        .topo-grid.four,
        .topo-checks,
        .topo-process {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="topo-page">
    <section class="topo-hero">
    <h1 class="ck-visually-hidden">Topographic Survey</h1>
    </section>

    <section class="topo-section">
        <div class="topo-wrap">
            <h2 class="topo-title">Topographic Survey Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane</h2>
            <div class="topo-line"></div>
            <p class="topo-copy">
                Understanding the natural features and levels of your land is essential before starting any construction or infrastructure project. At ConstructKaro, we provide professional Topographic Survey Services through verified surveyors using advanced equipment like Total Station, DGPS, and drone survey technology.
            </p>
            <p class="topo-copy">
                Whether it is a residential plot, industrial land, township, road project, or farmhouse development, we help provide accurate topographic data for better planning and execution.
            </p>
        </div>
    </section>

    <section class="topo-section">
        <div class="topo-wrap">
            <h2 class="topo-title">What is a Topographic Survey?</h2>
            <div class="topo-line"></div>
            <p class="topo-copy">
                A topographic survey is a detailed land survey that records ground levels and existing site features.
            </p>
            <div class="topo-steps">
                <div class="topo-step">Ground levels and contours</div>
                <div class="topo-step">Natural and man-made features</div>
                <div class="topo-step">Elevation changes</div>
                <div class="topo-step">Existing structures and utilities</div>
            </div>
        </div>
    </section>

    <section class="topo-section">
        <div class="topo-wrap">
            <h2 class="topo-title">Our Topographic Survey Services Include</h2>
            <div class="topo-line"></div>
            <div class="topo-grid three">
                <div class="topo-card">
                    <div class="topo-number">1</div>
                    <h3>Contour & Level Survey</h3>
                    <ul>
                        <li>Ground level measurement</li>
                        <li>Contour mapping</li>
                        <li>Slope identification</li>
                    </ul>
                </div>
                <div class="topo-card blue">
                    <div class="topo-number">2</div>
                    <h3>Existing Site Feature Mapping</h3>
                    <ul>
                        <li>Roads and pathways</li>
                        <li>Existing structures</li>
                        <li>Drainage and utility features</li>
                    </ul>
                </div>
                <div class="topo-card">
                    <div class="topo-number">3</div>
                    <h3>DGPS & Total Station Survey</h3>
                    <ul>
                        <li>High-accuracy measurements</li>
                        <li>Coordinate recording</li>
                        <li>Reliable survey data collection</li>
                    </ul>
                </div>
            </div>
            <div class="topo-grid two">
                <div class="topo-card blue">
                    <div class="topo-number">4</div>
                    <h3>Plotting & Land Development Survey</h3>
                    <ul>
                        <li>Township development survey</li>
                        <li>Farmhouse layout support</li>
                        <li>Industrial land development survey</li>
                    </ul>
                </div>
                <div class="topo-card">
                    <div class="topo-number">5</div>
                    <h3>Survey Drawings & Documentation</h3>
                    <ul>
                        <li>Topographic survey drawings</li>
                        <li>AutoCAD survey maps</li>
                        <li>Survey report support</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="topo-section">
        <div class="topo-wrap">
            <h2 class="topo-title">Types of Topographic Survey Projects</h2>
            <div class="topo-line"></div>
            <div class="topo-grid four">
                <!-- <div class="topo-card topo-project"> -->
                    <img src="{{ asset('images/logo/ts2.png') }}" alt="Residential land topographic survey">
                    <!-- <h3>Residential Land Topographic Survey</h3>
                </div> -->
                <!-- <div class="topo-card topo-project blue"> -->
                    <img src="{{ asset('images/logo/ts3.png') }}" alt="Farmhouse and plot development survey">
                    <!-- <h3>Farmhouse & Plot Development Survey</h3>
                </div> -->
                <!-- <div class="topo-card topo-project"> -->
                    <img src="{{ asset('images/logo/ts4.png') }}" alt="Industrial and commercial topographic survey">
                    <!-- <h3>Industrial & Commercial Topographic Survey</h3> -->
                <!-- </div> -->
                <!-- <div class="topo-card topo-project blue"> -->
                    <img src="{{ asset('images/logo/ts5.png') }}" alt="Road and infrastructure survey">
                    <!-- <h3>Road & Infrastructure Survey</h3> -->
                <!-- </div> -->
            </div>
        </div>
    </section>

    <section class="topo-section">
        <div class="topo-wrap">
            <h2 class="topo-title">Why Topographic Survey is Important?</h2>
            <div class="topo-line"></div>
            <div class="topo-checks">
                <div class="topo-check"><span>&#10003;</span>Helps accurate site planning</div>
                <div class="topo-check"><span>&#10003;</span>Supports proper drainage design</div>
                <div class="topo-check"><span>&#10003;</span>Reduces construction errors</div>
                <div class="topo-check"><span>&#10003;</span>Improves land utilization</div>
                <div class="topo-check"><span>&#10003;</span>Essential for road and infrastructure projects</div>
            </div>
        </div>
    </section>

    <section class="topo-section">
        <div class="topo-wrap">
            <h2 class="topo-title">Why Choose ConstructKaro?</h2>
            <div class="topo-line"></div>
            <div class="topo-checks">
                <div class="topo-check"><span>&#10003;</span>Verified survey professionals</div>
                <div class="topo-check"><span>&#10003;</span>DGPS and total station survey support</div>
                <div class="topo-check"><span>&#10003;</span>Accurate contour and level mapping</div>
                <div class="topo-check"><span>&#10003;</span>Suitable for residential and infrastructure projects</div>
                <div class="topo-check"><span>&#10003;</span>Structured survey reporting and CAD support</div>
            </div>
        </div>
    </section>

    <section class="topo-section">
        <div class="topo-wrap">
            <h2 class="topo-title">Our Survey Process</h2>
            <div class="topo-line"></div>
            <div class="topo-process">
                <div>1. Requirement Discussion</div>
                <div>2. Site Inspection & Benchmark Setup</div>
                <div>3. Topographic Data Collection</div>
                <div>4. Contour & CAD Mapping</div>
                <div>5. Survey Report & Drawing Submission</div>
            </div>
        </div>
    </section>

    <section class="topo-section">
        <div class="topo-wrap">
            <h2 class="topo-title">Target Locations We Serve</h2>
            <div class="topo-line"></div>
            <ul class="topo-locations">
                <li>Topographic Survey in Navi Mumbai</li>
                <li>Contour Survey Services in Mumbai</li>
                <li>DGPS Survey Services in Pune</li>
                <li>Total Station Survey in Raigad</li>
                <li>Land Level Survey in Thane</li>
            </ul>
        </div>
    </section>

    <section class="topo-section">
        <div class="topo-wrap">
            <h2 class="topo-title">Frequently Asked Questions (FAQs)</h2>
            <div class="topo-line"></div>
            <div class="topo-faq">
                <details>
                    <summary>1. What is included in a topographic survey?</summary>
                    <p>It includes ground levels, contours, site features, existing structures, utilities, and drawings depending on project scope.</p>
                </details>
                <details>
                    <summary>2. Do you provide DGPS and Total Station surveys?</summary>
                    <p>Yes. ConstructKaro connects you with surveyors using DGPS, total station, and other equipment based on the requirement.</p>
                </details>
                <details>
                    <summary>3. Why is contour mapping important?</summary>
                    <p>Contour mapping helps understand land levels and slopes, which supports drainage, road, layout, and construction planning.</p>
                </details>
                <details>
                    <summary>4. Do you provide CAD drawings and reports?</summary>
                    <p>Yes. Survey drawings and report support can be provided based on your selected service scope.</p>
                </details>
                <details>
                    <summary>5. Can topographic surveys be used for road and infrastructure projects?</summary>
                    <p>Yes. Topographic surveys are commonly used for roads, infrastructure planning, industrial development, and large land projects.</p>
                </details>
            </div>
        </div>
    </section>
</div>

@endsection
