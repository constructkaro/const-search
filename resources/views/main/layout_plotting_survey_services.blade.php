@extends('layouts.app')

@section('title', 'Layout & Plotting Survey Services')

@section('content')

<style>
    .layout-page {
        font-family: "Poppins", "Segoe UI", sans-serif;
        background: #efefef;
        color: #222;
    }

    .layout-hero {
        min-height: 330px;
        display: flex;
        align-items: center;
        padding: 58px 7%;
        background:
            /* linear-gradient(90deg, rgba(0,0,0,.86) 0%, rgba(0,0,0,.56) 45%, rgba(0,0,0,.08) 100%), */
            url("{{ asset('images/logo/lps1.png') }}") center/cover no-repeat;
    }

    .layout-hero h1 {
        max-width: 760px;
        margin: 0;
        color: #fff;
        font-size: clamp(34px, 5vw, 62px);
        line-height: 1.1;
        font-weight: 900;
        text-shadow: 0 5px 16px rgba(0,0,0,.5);
    }

    .layout-section {
        padding: 42px 7%;
    }

    .layout-wrap {
        max-width: 1180px;
        margin: 0 auto;
    }

    .layout-title {
        text-align: center;
        font-size: clamp(24px, 3vw, 36px);
        font-weight: 900;
        line-height: 1.2;
        margin: 0;
    }

    .layout-line {
        width: min(260px, 72vw);
        height: 4px;
        margin: 12px auto 28px;
        border-radius: 99px;
        background: linear-gradient(90deg, #f37021 0 50%, #1e73be 50% 100%);
    }

    .layout-copy {
        font-size: 17px;
        line-height: 1.7;
        color: #444;
        margin: 0 0 18px;
    }

    .layout-steps {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 12px;
        margin-top: 24px;
    }

    .layout-step {
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

    .layout-grid {
        display: grid;
        gap: 22px;
    }

    .layout-grid.three {
        grid-template-columns: repeat(3, 1fr);
    }

    .layout-grid.two {
        grid-template-columns: repeat(2, 1fr);
        max-width: 780px;
        margin: 22px auto 0;
    }

    .layout-grid.four {
        grid-template-columns: repeat(4, 1fr);
    }

    .layout-card {
        background: #fff7f1;
        border: 2px solid #f37021;
        border-radius: 10px;
        padding: 22px;
        box-shadow: 0 6px 16px rgba(0,0,0,.08);
        position: relative;
    }

    .layout-card.blue {
        border-color: #1e73be;
        background: #f3f9ff;
    }

    .layout-number {
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

    .layout-card.blue .layout-number {
        background: #1e73be;
    }

    .layout-card h3 {
        margin: 8px 0 12px;
        color: #f37021;
        font-size: 18px;
        font-weight: 900;
    }

    .layout-card.blue h3 {
        color: #1e73be;
    }

    .layout-card ul {
        margin: 0;
        padding-left: 18px;
    }

    .layout-card li {
        color: #444;
        font-size: 14px;
        line-height: 1.55;
        margin-bottom: 7px;
    }

    .layout-project {
        overflow: hidden;
        padding: 0;
        background: #fff;
    }

    .layout-project img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        display: block;
    }

    .layout-project h3 {
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

    .layout-checks {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 14px;
        text-align: center;
    }

    .layout-check {
        font-size: 13px;
        line-height: 1.45;
        font-weight: 800;
    }

    .layout-check span {
        display: block;
        color: #1e73be;
        font-size: 19px;
        margin-bottom: 6px;
    }

    .layout-process {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 14px;
    }

    .layout-process div {
        font-size: 13px;
        font-weight: 800;
        text-align: center;
        background: #fff;
        border-radius: 8px;
        padding: 16px 10px;
        border-top: 4px solid #f37021;
    }

    .layout-locations {
        max-width: 760px;
        margin: 0 auto;
        color: #333;
        font-size: 16px;
        line-height: 1.75;
    }

    .layout-faq {
        display: flex;
        flex-direction: column;
        gap: 13px;
    }

    .layout-faq details {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,.12);
        overflow: hidden;
    }

    .layout-faq summary {
        cursor: pointer;
        padding: 18px 22px;
        font-weight: 900;
        font-size: 15px;
    }

    .layout-faq p {
        margin: 0;
        padding: 0 22px 18px;
        color: #555;
        line-height: 1.6;
        font-size: 14px;
    }

    @media (max-width: 991px) {
        .layout-steps,
        .layout-grid.three,
        .layout-grid.four,
        .layout-checks,
        .layout-process {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .layout-hero {
            min-height: 280px;
            padding: 48px 22px;
        }

        .layout-section {
            padding: 34px 18px;
        }

        .layout-steps,
        .layout-grid.three,
        .layout-grid.two,
        .layout-grid.four,
        .layout-checks,
        .layout-process {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="layout-page">
    <section class="layout-hero">
    <h1 class="ck-visually-hidden">Layout &amp; Plotting Survey</h1>
    </section>

    <section class="layout-section">
        <div class="layout-wrap">
            <h2 class="layout-title">Layout & Plotting Survey Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane</h2>
            <div class="layout-line"></div>
            <p class="layout-copy">
                Planning a plotting project, township, farmhouse development, or land subdivision? Accurate surveying is the first step toward successful land development. At ConstructKaro, we provide professional Layout & Plotting Survey Services to help landowners, developers, investors, and builders convert raw land into well-planned and marketable plots.
            </p>
            <p class="layout-copy">
                Using advanced surveying technologies such as DGPS Survey, Total Station Survey, and CAD Mapping, we ensure accurate plot demarcation, road alignment, and layout planning.
            </p>
        </div>
    </section>

    <section class="layout-section">
        <div class="layout-wrap">
            <h2 class="layout-title">What is a Layout & Plotting Survey?</h2>
            <div class="layout-line"></div>
            <p class="layout-copy">
                A Layout & Plotting Survey is the process of dividing a larger land parcel into smaller plots while accurately marking roads, open spaces, amenities, and utility corridors.
            </p>
            <div class="layout-steps">
                <div class="layout-step">Plot boundaries</div>
                <div class="layout-step">Internal roads</div>
                <div class="layout-step">Open spaces</div>
                <div class="layout-step">Amenities area</div>
                <div class="layout-step">Utility corridors</div>
            </div>
            <p class="layout-copy" style="margin-top:24px;">
                This survey helps developers maximize land utilization while maintaining proper planning and execution.
            </p>
        </div>
    </section>

    <section class="layout-section">
        <div class="layout-wrap">
            <h2 class="layout-title">Our Layout & Plotting Survey Services Include</h2>
            <div class="layout-line"></div>
            <div class="layout-grid three">
                <div class="layout-card">
                    <div class="layout-number">1</div>
                    <h3>Land Measurement & Boundary Verification</h3>
                    <ul>
                        <li>Property boundary survey</li>
                        <li>Total area verification</li>
                        <li>Existing land condition study</li>
                        <li>Boundary dispute prevention</li>
                    </ul>
                </div>
                <div class="layout-card blue">
                    <div class="layout-number">2</div>
                    <h3>Plot Layout Planning</h3>
                    <ul>
                        <li>Residential plotting layout</li>
                        <li>Farmhouse plotting layout</li>
                        <li>Road and open space planning</li>
                        <li>Marketable development layout</li>
                    </ul>
                </div>
                <div class="layout-card">
                    <div class="layout-number">3</div>
                    <h3>Plot Demarcation & Marking</h3>
                    <ul>
                        <li>Individual plot marking</li>
                        <li>Road centerline marking</li>
                        <li>Plot corner fixing</li>
                        <li>On-site layout execution</li>
                    </ul>
                </div>
            </div>
            <div class="layout-grid two">
                <div class="layout-card blue">
                    <div class="layout-number">4</div>
                    <h3>Internal Road & Infrastructure Planning</h3>
                    <ul>
                        <li>Internal road alignment</li>
                        <li>Open space planning</li>
                        <li>Utility corridor marking</li>
                        <li>Future project compatibility</li>
                    </ul>
                </div>
                <div class="layout-card">
                    <div class="layout-number">5</div>
                    <h3>Survey Drawings & Documentation</h3>
                    <ul>
                        <li>Layout drawings</li>
                        <li>Plot dimension plans</li>
                        <li>Area statements</li>
                        <li>Survey report files</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="layout-section">
        <div class="layout-wrap">
            <h2 class="layout-title">Types of Layout & Plotting Survey Projects</h2>
            <div class="layout-line"></div>
            <div class="layout-grid four">
                <!-- <div class="layout-card layout-project"> -->
                    <img src="{{ asset('images/logo/lps2.png') }}" alt="Residential plotting projects">
                    <!-- <h3>Residential Plotting Projects</h3>
                </div> -->
                <!-- <div class="layout-card layout-project blue"> -->
                    <img src="{{ asset('images/logo/lps3.png') }}" alt="Farmhouse plotting projects">
                    <!-- <h3>Farmhouse Plotting Projects</h3>
                </div> -->
                <!-- <div class="layout-card layout-project"> -->
                    <img src="{{ asset('images/logo/lps4.png') }}" alt="Commercial plotting projects">
                    <!-- <h3>Commercial Plotting Projects</h3>
                </div> -->
                <!-- <div class="layout-card layout-project blue"> -->
                    <img src="{{ asset('images/logo/lps5.png') }}" alt="Township and land development projects">
                    <!-- <h3>Township & Land Development Projects</h3>
                </div> -->
            </div>
        </div>
    </section>

    <section class="layout-section">
        <div class="layout-wrap">
            <h2 class="layout-title">Benefits of Layout & Plotting Survey</h2>
            <div class="layout-line"></div>
            <div class="layout-checks">
                <div class="layout-check"><span>&#10003;</span>Accurate plot demarcation</div>
                <div class="layout-check"><span>&#10003;</span>Better land utilization</div>
                <div class="layout-check"><span>&#10003;</span>Proper road and infrastructure planning</div>
                <div class="layout-check"><span>&#10003;</span>Reduced boundary disputes</div>
                <div class="layout-check"><span>&#10003;</span>Faster project execution</div>
                <div class="layout-check"><span>&#10003;</span>Improved project marketability</div>
            </div>
        </div>
    </section>

    <section class="layout-section">
        <div class="layout-wrap">
            <h2 class="layout-title">Why Choose ConstructKaro?</h2>
            <div class="layout-line"></div>
            <div class="layout-checks">
                <div class="layout-check"><span>&#10003;</span>Verified survey professionals</div>
                <div class="layout-check"><span>&#10003;</span>DGPS and Total Station survey support</div>
                <div class="layout-check"><span>&#10003;</span>Accurate plot marking and layout planning</div>
                <div class="layout-check"><span>&#10003;</span>CAD drawings and digital reports</div>
                <div class="layout-check"><span>&#10003;</span>Suitable for residential, commercial and industrial developments</div>
                <div class="layout-check"><span>&#10003;</span>We help developers and landowners transform land into well-planned, development-ready plotting projects.</div>
            </div>
        </div>
    </section>

    <section class="layout-section">
        <div class="layout-wrap">
            <h2 class="layout-title">Our Survey Process</h2>
            <div class="layout-line"></div>
            <div class="layout-process">
                <div>1. Requirement Discussion</div>
                <div>2. Land Document Review</div>
                <div>3. Site Survey & Measurement</div>
                <div>4. Layout Planning & Plot Division</div>
                <div>5. Plot Marking & Demarcation</div>
                <div>6. Final Survey Report & Layout Drawing</div>
            </div>
        </div>
    </section>

    <section class="layout-section">
        <div class="layout-wrap">
            <h2 class="layout-title">Target Locations We Serve</h2>
            <div class="layout-line"></div>
            <ul class="layout-locations">
                <li>Layout & Plotting Survey in Navi Mumbai</li>
                <li>Layout Survey in Mumbai</li>
                <li>Plotting Survey in Pune</li>
                <li>Land Development Survey in Raigad</li>
                <li>Layout Planning Survey in Thane</li>
            </ul>
        </div>
    </section>

    <section class="layout-section">
        <div class="layout-wrap">
            <h2 class="layout-title">Additional Locations</h2>
            <div class="layout-line"></div>
            <ul class="layout-locations">
                <li>Layout Survey in Panvel</li>
                <li>Plotting Survey in Kharghar</li>
                <li>Layout Survey in Karjat</li>
                <li>Plot Development Survey in Khopoli</li>
                <li>Land Survey in Alibaug</li>
            </ul>
        </div>
    </section>

    <section class="layout-section">
        <div class="layout-wrap">
            <h2 class="layout-title">Frequently Asked Questions (FAQs)</h2>
            <div class="layout-line"></div>
            <div class="layout-faq">
                <details>
                    <summary>1. What is a plotting survey?</summary>
                    <p>A plotting survey divides land into properly measured plots with roads, open spaces, amenities, and utility areas marked as per the layout plan.</p>
                </details>
                <details>
                    <summary>2. Do you provide physical plot marking on site?</summary>
                    <p>Yes, plot corners, road alignments, and layout reference points can be physically marked on site.</p>
                </details>
                <details>
                    <summary>3. Can you help with farmhouse plotting projects?</summary>
                    <p>Yes, layout and plotting surveys are suitable for farmhouse projects, residential plotting, township layouts, and land development projects.</p>
                </details>
                <details>
                    <summary>4. Do you provide CAD layout drawings?</summary>
                    <p>Yes, CAD drawings, plot dimensions, area statements, and survey reports can be provided based on project scope.</p>
                </details>
                <details>
                    <summary>5. Which survey equipment do you use?</summary>
                    <p>Survey work may use DGPS, Total Station, and CAD mapping depending on the location, land size, and accuracy requirement.</p>
                </details>
            </div>
        </div>
    </section>
</div>

@endsection
