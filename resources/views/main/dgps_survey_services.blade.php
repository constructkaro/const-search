@extends('layouts.app')

@section('title', 'DGPS Survey Services')

@section('content')

<style>
    .dgps-page {
        font-family: "Poppins", "Segoe UI", sans-serif;
        background: #efefef;
        color: #222;
    }

    .dgps-hero {
        min-height: 330px;
        display: flex;
        align-items: center;
        padding: 58px 7%;
        background:
            /* linear-gradient(90deg, rgba(0,0,0,.86) 0%, rgba(0,0,0,.56) 45%, rgba(0,0,0,.08) 100%), */
            url("{{ asset('images/logo/dgps1.png') }}") center/cover no-repeat;
    }

    .dgps-hero h1 {
        max-width: 760px;
        margin: 0;
        color: #fff;
        font-size: clamp(34px, 5vw, 62px);
        line-height: 1.1;
        font-weight: 900;
        text-shadow: 0 5px 16px rgba(0,0,0,.5);
    }

    .dgps-section {
        padding: 42px 7%;
    }

    .dgps-wrap {
        max-width: 1180px;
        margin: 0 auto;
    }

    .dgps-title {
        text-align: center;
        font-size: clamp(24px, 3vw, 36px);
        font-weight: 900;
        line-height: 1.2;
        margin: 0;
    }

    .dgps-line {
        width: min(260px, 72vw);
        height: 4px;
        margin: 12px auto 28px;
        border-radius: 99px;
        background: linear-gradient(90deg, #f37021 0 50%, #1e73be 50% 100%);
    }

    .dgps-copy {
        font-size: 17px;
        line-height: 1.7;
        color: #444;
        margin: 0 0 18px;
    }

    .dgps-steps {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 12px;
        margin-top: 24px;
    }

    .dgps-step {
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

    .dgps-grid {
        display: grid;
        gap: 22px;
    }

    .dgps-grid.three {
        grid-template-columns: repeat(3, 1fr);
    }

    .dgps-grid.two {
        grid-template-columns: repeat(2, 1fr);
        max-width: 780px;
        margin: 22px auto 0;
    }

    .dgps-grid.four {
        grid-template-columns: repeat(4, 1fr);
    }

    .dgps-card {
        background: #fff7f1;
        border: 2px solid #f37021;
        border-radius: 10px;
        padding: 22px;
        box-shadow: 0 6px 16px rgba(0,0,0,.08);
        position: relative;
    }

    .dgps-card.blue {
        border-color: #1e73be;
        background: #f3f9ff;
    }

    .dgps-number {
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

    .dgps-card.blue .dgps-number {
        background: #1e73be;
    }

    .dgps-card h3 {
        margin: 8px 0 12px;
        color: #f37021;
        font-size: 18px;
        font-weight: 900;
    }

    .dgps-card.blue h3 {
        color: #1e73be;
    }

    .dgps-card ul {
        margin: 0;
        padding-left: 18px;
    }

    .dgps-card li {
        color: #444;
        font-size: 14px;
        line-height: 1.55;
        margin-bottom: 7px;
    }

    .dgps-project {
        overflow: hidden;
        padding: 0;
        background: #fff;
    }

    .dgps-project img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        display: block;
    }

    .dgps-project h3 {
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

    .dgps-checks {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 14px;
        text-align: center;
    }

    .dgps-check {
        font-size: 13px;
        line-height: 1.45;
        font-weight: 800;
    }

    .dgps-check span {
        display: block;
        color: #1e73be;
        font-size: 19px;
        margin-bottom: 6px;
    }

    .dgps-process {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 14px;
    }

    .dgps-process div {
        font-size: 14px;
        font-weight: 800;
        text-align: center;
        background: #fff;
        border-radius: 8px;
        padding: 16px 10px;
        border-top: 4px solid #f37021;
    }

    .dgps-locations {
        max-width: 760px;
        margin: 0 auto;
        color: #333;
        font-size: 16px;
        line-height: 1.75;
    }

    .dgps-faq {
        display: flex;
        flex-direction: column;
        gap: 13px;
    }

    .dgps-faq details {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,.12);
        overflow: hidden;
    }

    .dgps-faq summary {
        cursor: pointer;
        padding: 18px 22px;
        font-weight: 900;
        font-size: 15px;
    }

    .dgps-faq p {
        margin: 0;
        padding: 0 22px 18px;
        color: #555;
        line-height: 1.6;
        font-size: 14px;
    }

    @media (max-width: 991px) {
        .dgps-steps,
        .dgps-grid.three,
        .dgps-grid.four,
        .dgps-checks,
        .dgps-process {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .dgps-hero {
            min-height: 280px;
            padding: 48px 22px;
        }

        .dgps-section {
            padding: 34px 18px;
        }

        .dgps-steps,
        .dgps-grid.three,
        .dgps-grid.two,
        .dgps-grid.four,
        .dgps-checks,
        .dgps-process {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dgps-page">
    <section class="dgps-hero">
    <h1 class="ck-visually-hidden">DGPS Survey</h1>
    </section>

    <section class="dgps-section">
        <div class="dgps-wrap">
            <h2 class="dgps-title">DGPS Survey Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane</h2>
            <div class="dgps-line"></div>
            <p class="dgps-copy">
                Accurate land data is the foundation of successful planning, design, and construction. At ConstructKaro, we provide professional DGPS Survey Services using advanced Differential Global Positioning System technology to deliver highly accurate coordinates, boundary mapping, and geospatial data for residential, commercial, industrial, and infrastructure projects.
            </p>
            <p class="dgps-copy">
                Whether you are planning a plotting project, land acquisition, road development, industrial park, or large-scale infrastructure project, our DGPS surveys provide reliable and precise location-based information.
            </p>
        </div>
    </section>

    <section class="dgps-section">
        <div class="dgps-wrap">
            <h2 class="dgps-title">What is a DGPS Survey?</h2>
            <div class="dgps-line"></div>
            <p class="dgps-copy">
                A DGPS (Differential Global Positioning System) Survey is an advanced surveying method that uses satellite signals and correction data to provide highly accurate geographic coordinates and land measurements.
            </p>
            <p class="dgps-copy">
                DGPS surveys are commonly used for:
            </p>
            <div class="dgps-steps">
                <div class="dgps-step">Land boundary surveys</div>
                <div class="dgps-step">Large land parcel measurements</div>
                <div class="dgps-step">Topographic surveys</div>
                <div class="dgps-step">Infrastructure planning</div>
                <div class="dgps-step">Government and industrial projects</div>
            </div>
            <p class="dgps-copy" style="margin-top:24px;">
                Compared to standard GPS, DGPS offers significantly higher accuracy and reliability.
            </p>
        </div>
    </section>

    <section class="dgps-section">
        <div class="dgps-wrap">
            <h2 class="dgps-title">Our DGPS Survey Services Include</h2>
            <div class="dgps-line"></div>
            <div class="dgps-grid three">
                <div class="dgps-card">
                    <div class="dgps-number">1</div>
                    <h3>Boundary & Land Demarcation Survey</h3>
                    <ul>
                        <li>High accuracy boundary identification</li>
                        <li>Land measurement verification</li>
                        <li>Coordinate mapping</li>
                        <li>Legal document support</li>
                    </ul>
                </div>
                <div class="dgps-card blue">
                    <div class="dgps-number">2</div>
                    <h3>Topographic & Contour Survey</h3>
                    <ul>
                        <li>Ground level and elevation mapping</li>
                        <li>Contour generation</li>
                        <li>Large area terrain mapping</li>
                        <li>Natural and existing features</li>
                    </ul>
                </div>
                <div class="dgps-card">
                    <div class="dgps-number">3</div>
                    <h3>Plotting & Township Survey</h3>
                    <ul>
                        <li>Residential plotting layouts</li>
                        <li>Township planning support</li>
                        <li>Road and plot marking</li>
                        <li>Land subdivision planning</li>
                    </ul>
                </div>
            </div>
            <div class="dgps-grid two">
                <div class="dgps-card blue">
                    <div class="dgps-number">4</div>
                    <h3>Infrastructure & Utility Survey</h3>
                    <ul>
                        <li>Road alignment survey</li>
                        <li>Utility corridor mapping</li>
                        <li>Pipeline and powerline planning</li>
                        <li>Public and institutional land survey</li>
                    </ul>
                </div>
                <div class="dgps-card">
                    <div class="dgps-number">5</div>
                    <h3>GIS & Mapping Support</h3>
                    <ul>
                        <li>Digital mapping data</li>
                        <li>Coordinate data collection</li>
                        <li>Geospatial documentation</li>
                        <li>Survey report preparation</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="dgps-section">
        <div class="dgps-wrap">
            <h2 class="dgps-title">Applications of DGPS Survey</h2>
            <div class="dgps-line"></div>
            <div class="dgps-grid four">
                <!-- <div class="dgps-card dgps-project"> -->
                    <img src="{{ asset('images/logo/dgps2.png') }}" alt="Large land parcel surveys">
                    <!-- <h3>Large Land Parcel Surveys</h3>
                </div> -->
                <!-- <div class="dgps-card dgps-proj ect blue"> -->
                    <img src="{{ asset('images/logo/dgps3.png') }}" alt="Plotting and township development">
                    <!-- <h3>Plotting & Township Development</h3>
                </div> -->
                <!-- <div class="dgps-card dgps-project"> -->
                    <img src="{{ asset('images/logo/dgps4.png') }}" alt="Industrial and commercial projects">
                    <!-- <h3>Industrial & Commercial Projects</h3>
                </div> -->
                <!-- <div class="dgps-card dgps-project blue"> -->
                    <img src="{{ asset('images/logo/dgps5.png') }}" alt="Road and infrastructure projects">
                    <!-- <h3>Road & Infrastructure Projects</h3>
                </div> -->
            </div>
        </div>
    </section>

    <section class="dgps-section">
        <div class="dgps-wrap">
            <h2 class="dgps-title">Benefits of DGPS Survey</h2>
            <div class="dgps-line"></div>
            <div class="dgps-checks">
                <div class="dgps-check"><span>&#10003;</span>High coordinate accuracy</div>
                <div class="dgps-check"><span>&#10003;</span>Faster coverage of large areas</div>
                <div class="dgps-check"><span>&#10003;</span>Reliable satellite-based measurements</div>
                <div class="dgps-check"><span>&#10003;</span>Accurate boundary identification</div>
                <div class="dgps-check"><span>&#10003;</span>Supports GIS and mapping applications</div>
                <div class="dgps-check"><span>&#10003;</span>Ideal for large-scale land development</div>
            </div>
        </div>
    </section>

    <section class="dgps-section">
        <div class="dgps-wrap">
            <h2 class="dgps-title">Why Choose ConstructKaro?</h2>
            <div class="dgps-line"></div>
            <div class="dgps-checks">
                <div class="dgps-check"><span>&#10003;</span>Experienced survey professionals</div>
                <div class="dgps-check"><span>&#10003;</span>Advanced DGPS survey equipment</div>
                <div class="dgps-check"><span>&#10003;</span>Accurate land and infrastructure surveys</div>
                <div class="dgps-check"><span>&#10003;</span>Digital reports and mapping support</div>
                <div class="dgps-check"><span>&#10003;</span>Suitable for residential, commercial and industrial projects</div>
                <div class="dgps-check"><span>&#10003;</span>We help you make informed decisions with precise land data and professional survey solutions.</div>
            </div>
        </div>
    </section>

    <section class="dgps-section">
        <div class="dgps-wrap">
            <h2 class="dgps-title">Our Survey Process</h2>
            <div class="dgps-line"></div>
            <div class="dgps-process">
                <div>1. Requirement Discussion</div>
                <div>2. Site Inspection & Planning</div>
                <div>3. DGPS Data Collection</div>
                <div>4. Data Processing & Mapping</div>
                <div>5. Survey Report & Drawing Submission</div>
            </div>
        </div>
    </section>

    <section class="dgps-section">
        <div class="dgps-wrap">
            <h2 class="dgps-title">Target Locations We Serve</h2>
            <div class="dgps-line"></div>
            <ul class="dgps-locations">
                <li>DGPS Survey in Navi Mumbai</li>
                <li>DGPS Survey in Mumbai</li>
                <li>DGPS Survey in Pune</li>
                <li>DGPS Survey in Raigad</li>
                <li>DGPS Survey in Thane</li>
            </ul>
        </div>
    </section>

    <section class="dgps-section">
        <div class="dgps-wrap">
            <h2 class="dgps-title">Additional Locations</h2>
            <div class="dgps-line"></div>
            <ul class="dgps-locations">
                <li>DGPS Survey in Panvel</li>
                <li>DGPS Survey in Kharghar</li>
                <li>DGPS Survey in Karjat</li>
                <li>DGPS Survey in Khopoli</li>
                <li>DGPS Survey in Alibaug</li>
            </ul>
        </div>
    </section>

    <section class="dgps-section">
        <div class="dgps-wrap">
            <h2 class="dgps-title">Frequently Asked Questions (FAQs)</h2>
            <div class="dgps-line"></div>
            <div class="dgps-faq">
                <details>
                    <summary>1. What is a DGPS survey used for?</summary>
                    <p>DGPS survey is used for accurate coordinate collection, large land parcel measurement, boundary mapping, topographic data, and infrastructure planning.</p>
                </details>
                <details>
                    <summary>2. How accurate is a DGPS Survey?</summary>
                    <p>DGPS provides much higher accuracy than standard GPS and is suitable for professional land, infrastructure, and GIS mapping requirements.</p>
                </details>
                <details>
                    <summary>3. Do you provide coordinate maps and survey reports?</summary>
                    <p>Yes, we provide coordinate data, maps, survey drawings, and reports based on project requirements.</p>
                </details>
                <details>
                    <summary>4. Is DGPS suitable for plotting projects?</summary>
                    <p>Yes, DGPS is useful for plotting, township development, land subdivision, and large-area development planning.</p>
                </details>
                <details>
                    <summary>5. What is the difference between DGPS and Total Station Survey?</summary>
                    <p>DGPS is preferred for wide-area coordinate mapping, while Total Station is preferred for detailed on-site layout marking and high-precision local measurements.</p>
                </details>
            </div>
        </div>
    </section>
</div>

@endsection
