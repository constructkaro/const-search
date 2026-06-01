@extends('layouts.app')

@section('title', 'How to Start House Construction on Your Plot')

@section('content')
<style>
    body {
        background: #e9e9e9;
        color: #171717;
        font-family: "Poppins", Arial, sans-serif;
    }

    .plot-guide {
        background: #e9e9e9;
        padding-bottom: 46px;
    }

    .plot-hero {
        min-height: 270px;
        background:
            linear-gradient(90deg, rgba(2, 8, 16, .96) 0%, rgba(2, 8, 16, .78) 43%, rgba(2, 8, 16, .12) 100%),
            url("{{ asset('images/topics/cs1.png') }}");
        background-size: cover;
        background-position: center right;
        display: flex;
        align-items: center;
        padding: 42px 70px;
    }

    .plot-hero-inner {
        max-width: 760px;
    }

    .plot-hero h1 {
        margin: 0;
        color: #fff;
        font-size: 42px;
        line-height: 1.08;
        font-weight: 900;
        letter-spacing: 0;
    }

    .plot-title-line {
        width: 236px;
        height: 4px;
        margin: 10px 0 15px;
        background: linear-gradient(90deg, #f37021 0 58%, #1e73be 58% 100%);
        border-radius: 999px;
    }

    .plot-hero p {
        margin: 0;
        color: #fff;
        font-size: 15px;
        line-height: 1.35;
        font-weight: 800;
        max-width: 470px;
    }

    .plot-wrap {
        max-width: 1130px;
        margin: 0 auto;
        padding: 26px 26px 0;
    }

    .plot-summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 76px;
        margin: 0 24px 34px;
    }

    .summary-card {
        background: #fff;
        border: 1px solid #bdbdbd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,.16);
        padding: 14px 18px 16px;
        min-height: 120px;
    }

    .summary-card h2 {
        margin: 0 0 8px;
        padding-bottom: 9px;
        border-bottom: 1px solid #9b9b9b;
        color: #111;
        text-align: center;
        font-size: 21px;
        line-height: 1.15;
        font-weight: 900;
    }

    .summary-card ul,
    .step-copy ul,
    .bottom-box ul {
        margin: 0;
        padding-left: 18px;
    }

    .summary-card li {
        color: #333;
        font-size: 14px;
        line-height: 1.38;
        font-weight: 500;
    }

    .center-title {
        margin: 0 0 20px;
        text-align: center;
        color: #050505;
        font-size: 22px;
        line-height: 1.2;
        font-weight: 900;
    }

    .timeline {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 0;
        margin-bottom: 36px;
    }

    .step-arrow {
        min-height: 62px;
        padding: 9px 18px 9px 22px;
        clip-path: polygon(0 0, calc(100% - 18px) 0, 100% 50%, calc(100% - 18px) 100%, 0 100%, 16px 50%);
        color: #fff;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin-left: -12px;
    }

    .step-arrow:first-child {
        margin-left: 0;
        clip-path: polygon(0 0, calc(100% - 18px) 0, 100% 50%, calc(100% - 18px) 100%, 0 100%);
    }

    .step-arrow.blue {
        background: #1d75bb;
    }

    .step-arrow.orange {
        background: #f37021;
    }

    .step-arrow span {
        display: block;
        font-size: 10px;
        line-height: 1.1;
        font-weight: 900;
    }

    .step-arrow strong {
        display: block;
        margin-top: 2px;
        font-size: 9px;
        line-height: 1.15;
        font-weight: 800;
    }

    .section-divider {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: center;
        gap: 24px;
        margin-bottom: 22px;
    }

    .section-divider::before,
    .section-divider::after {
        content: "";
        height: 1px;
        background: #606060;
    }

    .section-divider h2 {
        margin: 0;
        color: #111;
        font-size: 22px;
        font-weight: 900;
        white-space: nowrap;
    }

    .step-row {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        gap: 26px;
        align-items: center;
        margin-bottom: 42px;
    }

    .step-image {
        width: 100%;
        height: 386px;
        display: block;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 2px 5px rgba(0,0,0,.14);
    }

    .step-copy h3 {
        margin: 0 0 13px;
        padding-bottom: 7px;
        border-bottom: 2px solid #f37021;
        color: #050505;
        font-size: 18px;
        line-height: 1.25;
        font-weight: 900;
    }

    .step-copy p {
        margin: 0 0 12px;
        color: #111;
        font-size: 13px;
        line-height: 1.45;
        font-weight: 800;
    }

    .step-copy h4 {
        margin: 14px 0 6px;
        color: #101010;
        font-size: 14px;
        line-height: 1.25;
        font-weight: 900;
    }

    .step-copy h4::before {
        content: "";
        width: 9px;
        height: 9px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 6px;
        background: #1e73be;
        vertical-align: 1px;
    }

    .step-copy h4.orange-dot::before {
        background: #f37021;
    }

    .step-copy li {
        color: #444;
        font-size: 13px;
        line-height: 1.35;
        font-weight: 500;
    }

    .dream-line {
        margin-top: 20px;
        color: #111;
        font-size: 15px;
        font-weight: 900;
    }

    .dream-line::before {
        content: "";
        width: 9px;
        height: 9px;
        display: inline-block;
        margin-right: 7px;
        border-radius: 50%;
        background: #f37021;
    }

    .bottom-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 90px;
        max-width: 980px;
        margin: 4px auto 30px;
    }

    .bottom-box h2 {
        margin: 0 0 12px;
        color: #111;
        font-size: 25px;
        line-height: 1.2;
        font-weight: 900;
    }

    .bottom-box p,
    .bottom-box li {
        color: #444;
        font-size: 14px;
        line-height: 1.35;
        font-weight: 500;
    }

    .bottom-box p {
        margin: 0 0 8px;
    }

    .enquiry-card {
        width: min(430px, 100%);
        margin: 0 auto;
        background: #fff;
        border: 1px solid #d4d4d4;
        border-radius: 10px;
        padding: 24px 42px 26px;
        box-shadow: 0 2px 4px rgba(0,0,0,.12);
        text-align: center;
    }

    .enquiry-card h2 {
        margin: 0 0 6px;
        color: #111;
        font-size: 23px;
        line-height: 1.2;
        font-weight: 900;
    }

    .enquiry-card p {
        margin: 0 auto 14px;
        color: #555;
        font-size: 12px;
        line-height: 1.25;
        max-width: 290px;
        font-weight: 500;
    }

    .enquiry-card input,
    .enquiry-card textarea {
        width: 100%;
        border: 0;
        border-radius: 7px;
        background: #ededed;
        color: #333;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 12px;
        padding: 12px 14px;
        outline: none;
    }

    .enquiry-card textarea {
        min-height: 44px;
        resize: vertical;
    }

    .enquiry-card button {
        width: 100%;
        border: 0;
        border-radius: 5px;
        background: #f37021;
        color: #fff;
        font-size: 17px;
        line-height: 1;
        font-weight: 900;
        padding: 15px 18px;
        cursor: pointer;
    }

    @media (max-width: 992px) {
        .plot-hero {
            padding: 36px 26px;
        }

        .plot-hero h1 {
            font-size: 34px;
        }

        .plot-summary {
            grid-template-columns: 1fr;
            gap: 18px;
            margin-inline: 0;
        }

        .timeline {
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .step-arrow,
        .step-arrow:first-child {
            margin-left: 0;
            clip-path: none;
            border-radius: 7px;
        }

        .step-row,
        .bottom-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .step-image {
            height: 300px;
        }

        .step-copy.order-first {
            order: -1;
        }
    }

    @media (max-width: 576px) {
        .plot-hero {
            min-height: 235px;
            padding: 30px 18px;
        }

        .plot-hero h1 {
            font-size: 27px;
        }

        .plot-hero p {
            font-size: 13px;
        }

        .plot-wrap {
            padding: 20px 14px 0;
        }

        .section-divider {
            gap: 10px;
        }

        .section-divider h2 {
            font-size: 17px;
        }

        .step-image {
            height: 230px;
        }

        .enquiry-card {
            padding: 22px 18px;
        }
    }
</style>

<main class="plot-guide">
    <section class="plot-hero">
        <div class="plot-hero-inner">
            <h1>How to Start House<br>Construction on Your Plot</h1>
            <div class="plot-title-line"></div>
            <p>Many people buy a plot with a dream of building their own home... but then they get stuck.</p>
        </div>
    </section>

    <div class="plot-wrap">
        <section class="plot-summary">
            <div class="summary-card">
                <h2>Your Problem</h2>
                <ul>
                    <li>What should I do first?</li>
                    <li>Whom to architect?</li>
                    <li>Do I need survey or fit</li>
                </ul>
            </div>
            <div class="summary-card">
                <h2>Common Mistakes</h2>
                <ul>
                    <li>Skipping survey</li>
                    <li>No budget planning</li>
                    <li>Rushing to hire contractor</li>
                </ul>
            </div>
            <div class="summary-card">
                <h2>Our Solution</h2>
                <ul>
                    <li>Step-by-step guidance</li>
                    <li>Verified professionals</li>
                    <li>Complete service package</li>
                </ul>
            </div>
        </section>

        <h2 class="center-title">Step-by-Step Guide for Building Your Dream Home.</h2>

        <section class="timeline" aria-label="House construction steps">
            <div class="step-arrow blue"><span>Step 1:</span><strong>Land Survey, Soil Testing &amp;<br>Site Understanding</strong></div>
            <div class="step-arrow orange"><span>Step 2:</span><strong>Requirement Planning +<br>Legal Groundwork</strong></div>
            <div class="step-arrow blue"><span>Step 3:</span><strong>Architect Design &amp;<br>Building Plan Approval</strong></div>
            <div class="step-arrow orange"><span>Step 4:</span><strong>BOQ (Bill Of Quantities)<br>&amp; Cost Estimation</strong></div>
            <div class="step-arrow blue"><span>Step 5:</span><strong>Contractor Finalization</strong></div>
            <div class="step-arrow orange"><span>Step 6:</span><strong>Construction Execution<br>Begins</strong></div>
            <div class="step-arrow blue"><span>Step 7:</span><strong>Interior &amp; Finishing<br>Work</strong></div>
        </section>

        <section class="section-divider">
            <h2>Detail Steps Explained</h2>
        </section>

        <section class="step-row">
            <img class="step-image" src="{{ asset('images/topics/cs2.png') }}" alt="Land survey and soil testing">
            <div class="step-copy">
                <h3>Step 1: Land Survey, Soil Testing &amp; Site Understanding</h3>
                <p>Before anything starts, you must clearly understand your plot</p>
                <h4>What to confirm:</h4>
                <ul>
                    <li>Exact plot boundaries</li>
                    <li>Plot dimensions</li>
                    <li>Site levels (slope / height difference)</li>
                    <li>Road access</li>
                    <li>Water &amp; drainage conditions</li>
                </ul>
                <h4>This is done using:</h4>
                <ul>
                    <li>Total Station Survey</li>
                    <li>Soil Testing (Very Important)</li>
                </ul>
                <h4>Why Soil Testing matters:</h4>
                <ul>
                    <li>Checks soil strength (bearing capacity)</li>
                    <li>Helps decide foundation type</li>
                    <li>Prevents future cracks &amp; settlement issues</li>
                </ul>
                <h4>Why this step is important:</h4>
                <ul>
                    <li>Avoids boundary disputes</li>
                    <li>Ensures accurate construction layout</li>
                    <li>Prevents legal and design mistakes</li>
                </ul>
            </div>
        </section>

        <section class="step-row">
            <div class="step-copy">
                <h3>Step 2: Requirement Planning + Legal Groundwork</h3>
                <p>Now define what you actually want to build</p>
                <h4 class="orange-dot">Planning your needs:</h4>
                <ul>
                    <li>1BHK / 2BHK / Bungalow</li>
                    <li>Number of floors</li>
                    <li>Parking requirement</li>
                    <li>Budget range</li>
                </ul>
                <h4 class="orange-dot">Important additional actions:</h4>
                <ul>
                    <li>Basic chain-link fencing (to secure plot)</li>
                    <li>Check legal permissions &amp; documents</li>
                    <li>Verify local authority permissions</li>
                    <li>Confirm NA status (if required)</li>
                </ul>
                <h4 class="orange-dot">Why this step is important:</h4>
                <ul>
                    <li>Avoids legal issues later</li>
                    <li>Secures your land physically</li>
                    <li>Helps in proper design planning</li>
                    <li>Sets clear direction for the project</li>
                </ul>
            </div>
            <img class="step-image" src="{{ asset('images//topics/cs3.png') }}" alt="Planning with professionals">
        </section>

        <section class="step-row">
            <img class="step-image" src="{{ asset('images/topics/cs4.png') }}" alt="Architect design discussion">
            <div class="step-copy">
                <h3>Step 3: Architectural Design &amp; Building Plan Approval</h3>
                <p>Now the actual design phase begins</p>
                <h4>Architect will:</h4>
                <ul>
                    <li>Create 2D layout plans</li>
                    <li>Design 3D elevation (front view)</li>
                    <li>Optimize space planning</li>
                    <li>Prepare working drawings</li>
                </ul>
                <h4>Additional Important Step:</h4>
                <ul>
                    <li>Building Plan Approval from local authority</li>
                </ul>
                <h4>Why this step is important:</h4>
                <ul>
                    <li>Avoids rework during construction</li>
                    <li>Improves functionality &amp; aesthetics</li>
                    <li>Gives clear execution drawings</li>
                    <li>Ensures legal approval before starting</li>
                </ul>
            </div>
        </section>

        <section class="step-row">
            <div class="step-copy">
                <h3>Step 4: BOQ (Bill of Quantities) &amp; Cost Estimation</h3>
                <p>Now convert your design into cost</p>
                <h4 class="orange-dot">BOQ includes:</h4>
                <ul>
                    <li>Material quantities</li>
                    <li>Labour cost</li>
                    <li>Item-wise costing</li>
                    <li>Total project estimate</li>
                </ul>
                <h4 class="orange-dot">Why this step is important:</h4>
                <ul>
                    <li>Prevents budget overflow</li>
                    <li>Gives full cost clarity before starting</li>
                    <li>Helps compare contractors</li>
                    <li>Avoids hidden expenses</li>
                </ul>
            </div>
            <img class="step-image" src="{{ asset('images/topics/cs5.png') }}" alt="Cost estimation and BOQ">
        </section>

        <section class="step-row">
            <img class="step-image" src="{{ asset('images/topics/cs6.png') }}" alt="Contractor finalization">
            <div class="step-copy">
                <h3>Step 5: Contractor Finalization</h3>
                <p>Now choose who will build your house</p>
                <h4>Selection based on:</h4>
                <ul>
                    <li>Experience</li>
                    <li>Past projects</li>
                    <li>Pricing</li>
                    <li>Timeline</li>
                </ul>
                <h4>Types of contractors:</h4>
                <ul>
                    <li>Labour Contractor + You supply material</li>
                    <li>Material + Labour Contractor</li>
                    <li>Turnkey Contractor + Complete end-to-end execution</li>
                </ul>
                <h4>Why this step is important:</h4>
                <ul>
                    <li>Ensures quality work</li>
                    <li>Avoids delays</li>
                    <li>Keeps budget under control</li>
                    <li>Reduces stress in execution</li>
                </ul>
            </div>
        </section>

        <section class="step-row">
            <div class="step-copy">
                <h3>Step 6: Construction Execution Begins</h3>
                <p>Now actual construction starts</p>
                <h4 class="orange-dot">Key activities:</h4>
                <ul>
                    <li>Site marking (as per drawing)</li>
                    <li>Excavation &amp; foundation work</li>
                    <li>Column, beam &amp; slab construction</li>
                    <li>Brickwork &amp; plaster</li>
                </ul>
                <h4 class="orange-dot">Why this step is important:</h4>
                <ul>
                    <li>This is where your design becomes reality</li>
                    <li>Requires proper supervision &amp; quality control</li>
                </ul>
                <div class="dream-line">Now your dream home journey truly begins...</div>
            </div>
            <img class="step-image" src="{{ asset('images/topics/cs7.png') }}" alt="Construction execution">
        </section>

        <section class="step-row">
            <img class="step-image" src="{{ asset('images/topics/cs8.png') }}" alt="Interior and finishing work">
            <div class="step-copy">
                <h3>Step 7: Interior &amp; Finishing Work</h3>
                <p>Final stage - making your house livable</p>
                <h4>Includes:</h4>
                <ul>
                    <li>Flooring &amp; tiles</li>
                    <li>Painting &amp; polishing</li>
                    <li>Electrical &amp; plumbing fittings</li>
                    <li>Modular kitchen &amp; furniture</li>
                    <li>False ceiling &amp; lighting</li>
                </ul>
                <h4>Types of contractors:</h4>
                <ul>
                    <li>Labour Contractor + You supply material</li>
                    <li>Material + Labour Contractor</li>
                    <li>Turnkey Contractor + Complete end-to-end execution</li>
                </ul>
                <h4>Why this step is important:</h4>
                <ul>
                    <li>Defines final look &amp; comfort</li>
                    <li>Impacts usability and lifestyle</li>
                </ul>
            </div>
        </section>

        <section class="bottom-grid">
            <div class="bottom-box">
                <h2>How ConstructKaro Helps:</h2>
                <p>Instead of managing everything separately, ConstructKaro:</p>
                <ul>
                    <li>Understands your requirement</li>
                    <li>Guides you step-by-step</li>
                    <li>Connects you with the right professionals</li>
                    <li>Manages the entire process</li>
                </ul>
            </div>
            <div class="bottom-box">
                <h2>Final Outcome</h2>
                <ul>
                    <li>No confusion</li>
                    <li>No wrong decisions</li>
                    <li>Controlled budget</li>
                    <li>Smooth execution</li>
                    <li>A properly planned and built dream home</li>
                </ul>
            </div>
        </section>

        <section class="enquiry-card">
            <h2>Ready to Build Your Home?</h2>
            <p>Enquire today and get expert help at every step of your dream home construction.</p>
            <form onsubmit="return false;">
                <input type="text" name="name" placeholder="Name">
                <input type="tel" name="phone" placeholder="Phone">
                <textarea name="message" placeholder="Message"></textarea>
                <button type="submit">Enquire Now</button>
            </form>
        </section>
    </div>
</main>
@endsection
