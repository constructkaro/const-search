@extends('layouts.app')

@section('title', 'Residential BOQ Consultant')

@section('content')

<style>
    body{
        font-family:"Poppins","Segoe UI",sans-serif;
        background:#f3f3f3;
        color:#1f2933;
    }

    .rb-hero{
        min-height:280px;
        background:
            linear-gradient(90deg,rgba(0,0,0,.88) 0%,rgba(0,0,0,.66) 42%,rgba(0,0,0,.10) 100%),
            url("{{ asset('images/logo/b2.png') }}");
        background-size:cover;
        background-position:center;
        display:flex;
        align-items:center;
        padding:58px 7%;
    }

    .rb-hero h1{
        color:#fff;
        font-size:48px;
        line-height:1.1;
        font-weight:900;
        margin:0;
        text-shadow:0 4px 12px rgba(0,0,0,.55);
    }

    .rb-hero span{
        display:block;
        font-size:24px;
        margin-top:8px;
        font-weight:800;
    }

    .rb-section{
        padding:48px 7%;
        background:#f3f3f3;
    }

    .rb-wrap{
        max-width:1180px;
        margin:0 auto;
    }

    .rb-title{
        text-align:center;
        font-size:28px;
        font-weight:900;
        margin:0;
        color:#222;
    }

    .rb-line{
        width:170px;
        height:3px;
        margin:12px auto 28px;
        border-radius:999px;
        background:linear-gradient(90deg,#f37021 0%,#f37021 50%,#1e73be 50%,#1e73be 100%);
    }

    .rb-copy{
        font-size:16px;
        line-height:1.75;
        color:#4b5563;
        margin:0 0 24px;
    }

    .rb-copy strong{
        color:#202124;
    }

    .rb-benefits{
        display:grid;
        grid-template-columns:repeat(4,1fr);
        gap:22px;
        margin-top:30px;
    }

    .rb-benefit{
        background:#fff;
        border:2px solid #1e73be;
        border-radius:8px;
        min-height:82px;
        display:flex;
        align-items:center;
        justify-content:center;
        text-align:center;
        padding:14px;
        font-weight:800;
        color:#1f2933;
        box-shadow:0 4px 12px rgba(0,0,0,.08);
    }

    .rb-benefit.orange{
        border-color:#f37021;
        background:#fff4ed;
    }

    .rb-service-grid{
        display:grid;
        grid-template-columns:repeat(3,1fr);
        gap:28px;
        margin-top:36px;
    }

    .rb-service-grid.two{
        grid-template-columns:repeat(2,1fr);
        max-width:720px;
        margin:28px auto 0;
    }

    .rb-service-card{
        position:relative;
        background:#fff4ed;
        border:2px solid #f37021;
        border-radius:10px;
        padding:32px 22px 22px;
        min-height:150px;
        box-shadow:0 5px 14px rgba(0,0,0,.10);
    }

    .rb-service-card.blue{
        background:#eef7ff;
        border-color:#1e73be;
    }

    .rb-number{
        position:absolute;
        top:-16px;
        left:50%;
        transform:translateX(-50%);
        width:32px;
        height:32px;
        border-radius:7px;
        background:#f37021;
        color:#fff;
        display:flex;
        align-items:center;
        justify-content:center;
        font-weight:900;
    }

    .rb-service-card.blue .rb-number{
        background:#1e73be;
    }

    .rb-service-card h3{
        text-align:center;
        font-size:18px;
        line-height:1.3;
        margin:0 0 14px;
        color:#f37021;
        font-weight:900;
    }

    .rb-service-card.blue h3{
        color:#1e73be;
    }

    .rb-service-card ul{
        margin:0;
        padding-left:18px;
        color:#4b5563;
        font-weight:700;
        line-height:1.7;
        font-size:14px;
    }

    .rb-type-grid{
        display:grid;
        grid-template-columns:repeat(4,1fr);
        gap:28px;
    }

    .rb-type-card{
        background:#fff;
        border-radius:12px;
        overflow:hidden;
        box-shadow:0 10px 24px rgba(15,23,42,.12);
    }

    .rb-type-card img{
        width:100%;
        height:205px;
        object-fit:cover;
        display:block;
    }

    .rb-type-card h3{
        min-height:54px;
        margin:0;
        display:flex;
        align-items:center;
        justify-content:center;
        text-align:center;
        padding:10px 12px;
        background:#fff;
        font-size:16px;
        line-height:1.25;
        font-weight:900;
        color:#202124;
    }

    .rb-important{
        display:grid;
        grid-template-columns:repeat(3,1fr);
        gap:18px 34px;
        margin-top:20px;
        color:#222;
        font-size:15px;
        font-weight:800;
    }

    .rb-important span:before{
        content:"\2713";
        margin-right:7px;
        color:#111;
    }

    .rb-locations{
        margin-top:32px;
        font-size:15px;
        line-height:1.55;
        color:#374151;
        font-weight:700;
    }

    .rb-locations strong{
        display:block;
        color:#111;
        margin-bottom:5px;
    }

    .rb-faq{
        max-width:980px;
        margin:0 auto;
    }

    .rb-faq details{
        background:#fff;
        border-radius:8px;
        margin-bottom:14px;
        box-shadow:0 4px 10px rgba(0,0,0,.12);
        overflow:hidden;
    }

    .rb-faq summary{
        cursor:pointer;
        padding:18px 22px;
        font-weight:900;
        color:#222;
        list-style:none;
    }

    .rb-faq summary::-webkit-details-marker{
        display:none;
    }

    .rb-faq p{
        margin:0;
        padding:0 22px 18px;
        color:#4b5563;
        font-weight:600;
        line-height:1.65;
    }

    @media (max-width:992px){
        .rb-benefits,
        .rb-type-grid{
            grid-template-columns:repeat(2,1fr);
        }

        .rb-service-grid,
        .rb-service-grid.two,
        .rb-important{
            grid-template-columns:1fr;
            max-width:none;
        }
    }

    @media (max-width:576px){
        .rb-hero{
            min-height:230px;
            padding:42px 22px;
        }

        .rb-hero h1{
            font-size:34px;
        }

        .rb-hero span{
            font-size:18px;
        }

        .rb-section{
            padding:36px 20px;
        }

        .rb-title{
            font-size:24px;
        }

        .rb-benefits,
        .rb-type-grid{
            grid-template-columns:1fr;
        }
    }
</style>

<section class="rb-hero">
    <h1>
        Residential BOQ
        <span>(Bill of Quantities) Consultant</span>
    </h1>
</section>

<section class="rb-section">
    <div class="rb-wrap">
        <h2 class="rb-title">Residential BOQ (Bill of Quantities) Consultant</h2>
        <div class="rb-line"></div>

        <p class="rb-copy">
            Planning to build your home but unsure about the cost? At <strong>ConstructKaro</strong>, we provide
            professional <strong>Residential BOQ (Bill of Quantities)</strong> services to give you a clear,
            detailed, and transparent estimate of your construction project.
        </p>

        <p class="rb-copy">
            From material quantities to cost breakdowns, our BOQ helps you plan better, control budget,
            and avoid surprises during construction.
        </p>

        <h2 class="rb-title">What is Residential BOQ?</h2>
        <div class="rb-line"></div>

        <p class="rb-copy">
            A BOQ (Bill of Quantities) is a detailed document that lists all materials, quantities,
            specifications, and estimated costs required for your construction project.
        </p>

        <div class="rb-benefits">
            <div class="rb-benefit">Understanding total project cost</div>
            <div class="rb-benefit orange">Comparing contractor quotations</div>
            <div class="rb-benefit">Avoiding overcharging and hidden costs</div>
            <div class="rb-benefit orange">Planning budget effectively</div>
        </div>
    </div>
</section>

<section class="rb-section">
    <div class="rb-wrap">
        <h2 class="rb-title">Our Residential BOQ Services Include</h2>
        <div class="rb-line"></div>

        <div class="rb-service-grid">
            <div class="rb-service-card">
                <div class="rb-number">1</div>
                <h3>Quantity Take-Off</h3>
                <ul>
                    <li>Cement, steel, sand, aggregate</li>
                    <li>Bricks, plaster, RCC quantities</li>
                    <li>Finishing material estimation</li>
                </ul>
            </div>

            <div class="rb-service-card blue">
                <div class="rb-number">2</div>
                <h3>Material Specification</h3>
                <ul>
                    <li>Brand-wise recommendation</li>
                    <li>Standard or premium material options</li>
                    <li>Quality-based selection guidance</li>
                </ul>
            </div>

            <div class="rb-service-card">
                <div class="rb-number">3</div>
                <h3>Detailed Cost Estimation</h3>
                <ul>
                    <li>Item-wise rate breakdown</li>
                    <li>Labour and material costing</li>
                    <li>Stage-wise cost planning</li>
                </ul>
            </div>
        </div>

        <div class="rb-service-grid two">
            <div class="rb-service-card blue">
                <div class="rb-number">4</div>
                <h3>BOQ for Different Construction Stages</h3>
                <ul>
                    <li>Foundation and plinth BOQ</li>
                    <li>Structure and brickwork BOQ</li>
                    <li>Finishing and services BOQ</li>
                </ul>
            </div>

            <div class="rb-service-card">
                <div class="rb-number">5</div>
                <h3>Comparative Analysis Support</h3>
                <ul>
                    <li>Contractor quotation comparison</li>
                    <li>Rate validation</li>
                    <li>Cost optimization suggestions</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="rb-section">
    <div class="rb-wrap">
        <h2 class="rb-title">Types of Residential BOQ</h2>
        <div class="rb-line"></div>

        <div class="rb-type-grid">
            <!-- <div class="rb-type-card orange"> -->
                <img src="{{ asset('images/logo/rb1.png') }}" alt="Bungalow Villa BOQ">
                <!-- <h3>Bungalow / Villa BOQ</h3>
            </div> -->

            <!-- <div class="rb-type-card"> -->
                <img src="{{ asset('images/logo/rb4.png') }}" alt="Turnkey Construction BOQ">
                <!-- <h3>Turnkey Construction BOQ</h3>
            </div> -->

            <!-- <div class="rb-type-card"> -->
                <img src="{{ asset('images/logo/rb3.png') }}" alt="Core and Shell BOQ">
                <!-- <h3>Core & Shell BOQ</h3>
            </div> -->

            <!-- <div class="rb-type-card"> -->
                <img src="{{ asset('images/logo/rb2.png') }}" alt="Apartment Flat BOQ">
                <!-- <h3>Apartment / Flat BOQ</h3>
            </div> -->
        </div>
    </div>
</section>

<section class="rb-section">
    <div class="rb-wrap">
        <h2 class="rb-title">Why Residential BOQ is Important?</h2>
        <div class="rb-line"></div>

        <div class="rb-important">
            <span>Prevents budget overruns</span>
            <span>Brings cost transparency</span>
            <span>Helps compare contractors</span>
            <span>Avoids material wastage</span>
            <span>Ensures better financial planning</span>
            <span>Supports stage-wise execution</span>
        </div>

        <p class="rb-locations">
            <strong>Target Locations We Serve</strong>
            Residential BOQ Services in Navi Mumbai | Residential BOQ Services in Mumbai |
            Residential BOQ Services in Pune | Residential BOQ Services in Raigad |
            Residential BOQ Services in Thane
        </p>
    </div>
</section>

<section class="rb-section">
    <div class="rb-wrap">
        <h2 class="rb-title">Frequently Asked Questions (FAQs)</h2>
        <div class="rb-line"></div>

        <div class="rb-faq">
            <details>
                <summary>1. What is included in a BOQ?</summary>
                <p>A residential BOQ includes item-wise quantities, material specifications, labour cost, rates, and total estimated project cost.</p>
            </details>

            <details>
                <summary>2. How much does BOQ service cost?</summary>
                <p>The cost depends on project size, available drawings, scope of estimation, and level of detail required.</p>
            </details>

            <details>
                <summary>3. Can BOQ help reduce construction cost?</summary>
                <p>Yes. BOQ gives clear cost visibility, reduces wastage, helps compare contractor quotes, and supports value engineering.</p>
            </details>

            <details>
                <summary>4. Do you provide brand-wise material details?</summary>
                <p>Yes. We can include standard, premium, or project-specific brand recommendations based on your budget and requirement.</p>
            </details>

            <details>
                <summary>5. How long does BOQ preparation take?</summary>
                <p>Timelines depend on the project size and drawing availability. Small residential BOQs are usually faster than detailed turnkey estimates.</p>
            </details>
        </div>
    </div>
</section>

@endsection
