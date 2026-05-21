@extends('layouts.app')

@section('title', 'Structural BOQ Consultant')

@section('content')

<style>
    /* body{
        font-family:"Poppins","Segoe UI",sans-serif;
        background:#f3f3f3;
        color:#1f2933;
    } */

    .rb-hero{
        min-height:280px;
        background:
            linear-gradient(90deg,rgba(0,0,0,.88) 0%,rgba(0,0,0,.66) 42%,rgba(0,0,0,.10) 100%),
            url("{{ asset('images/logo/b4.png') }}");
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

    .cb-info-box{
        border:4px solid #18a8ff;
        background:#fff;
        padding:22px;
        margin:30px 0 34px;
    }

    .cb-info-box .rb-title{
        font-size:24px;
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
        font-size:15px;
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
        font-size:15px;
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
        font-size:14px;
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
            font-size:36px;
        }

        .rb-hero span{
            font-size:20px;
        }

        .rb-section{
            padding:36px 20px;
        }

        .rb-title{
            font-size:26px;
        }

        .rb-benefits,
        .rb-type-grid{
            grid-template-columns:1fr;
        }
    }
</style>

<section class="rb-hero">
    <h1>
        Structural BOQ
        <span>(Bill of Quantities) Consultant</span>
    </h1>
</section>

<section class="rb-section">
    <div class="rb-wrap">
        <h2 class="rb-title">Structural BOQ (Bill of Quantities) Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane</h2>
        <div class="rb-line"></div>

        <p class="rb-copy">
            The strength of any building lies in its structure and proper cost planning is critical.
            At <strong>ConstructKaro</strong>, we provide expert <strong>Structural BOQ (Bill of Quantities)</strong>
            services to give you precise material quantities and cost estimates for the structural phase of your project.
        </p>

        <p class="rb-copy">
            From foundation to slabs, our BOQ ensures your project is technically sound, budget-controlled,
            and execution-ready.
        </p>

        <div class="cb-info-box">
            <h2 class="rb-title">What is Structural BOQ?</h2>
            <div class="rb-line"></div>

            <p class="rb-copy">
                A Structural BOQ (Bill of Quantities) is a detailed document that includes:
            </p>

            <div class="rb-benefits">
                <div class="rb-benefit">Structural material quantities</div>
                <div class="rb-benefit orange">RCC components estimation</div>
                <div class="rb-benefit">Reinforcement steel calculation</div>
                <div class="rb-benefit orange">Item-wise cost breakdown</div>
            </div>

            <p class="rb-copy" style="margin-top:22px;margin-bottom:0;">
                It helps you plan the core structure of your building with clarity and accuracy.
            </p>
        </div>
    </div>
</section>

<section class="rb-section">
    <div class="rb-wrap">
        <h2 class="rb-title">Our Structural BOQ Services Include</h2>
        <div class="rb-line"></div>

        <div class="rb-service-grid">
            <div class="rb-service-card">
                <div class="rb-number">1</div>
                <h3>Quantity Take-Off</h3>
                <ul>
                    <li>Concrete quantities</li>
                    <li>Brickwork, blockwork, beams, slabs</li>
                    <li>Cement, sand, and aggregate estimation</li>
                    <li>Site-stage-based calculation</li>
                </ul>
            </div>

            <div class="rb-service-card blue">
                <div class="rb-number">2</div>
                <h3>Reinforcement Steel Calculation</h3>
                <ul>
                    <li>Column, beam, and slab steel quantity</li>
                    <li>Bar bending schedule details</li>
                    <li>Wastage-based estimation</li>
                </ul>
            </div>

            <div class="rb-service-card">
                <div class="rb-number">3</div>
                <h3>Foundation & Substructure BOQ</h3>
                <ul>
                    <li>Footing and excavation quantities</li>
                    <li>PCC and RCC calculations</li>
                    <li>Anti-termite and waterproofing</li>
                </ul>
            </div>
        </div>

        <div class="rb-service-grid two">
            <div class="rb-service-card blue">
                <div class="rb-number">4</div>
                <h3>Superstructure BOQ</h3>
                <ul>
                    <li>Columns, beams, and slab calculation</li>
                    <li>Brickwork and block quantities</li>
                    <li>Structural framework planning</li>
                </ul>
            </div>

            <div class="rb-service-card">
                <div class="rb-number">5</div>
                <h3>Cost Estimation & Analysis</h3>
                <ul>
                    <li>Material and labour costing</li>
                    <li>Stage-wise rate breakdown</li>
                    <li>Budget optimization suggestions</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="rb-section">
    <div class="rb-wrap">
        <h2 class="rb-title">Types of Structural BOQ</h2>
        <div class="rb-line"></div>

        <div class="rb-type-grid">
            <div class="rb-type-card">
                <img src="{{ asset('images/logo/rb1.png') }}" alt="Residential Structural BOQ">
                <h3>Residential Structural BOQ</h3>
            </div>

            <div class="rb-type-card">
                <img src="{{ asset('images/logo/cb1.png') }}" alt="Commercial Structural BOQ">
                <h3>Commercial Structural BOQ</h3>
            </div>

            <div class="rb-type-card">
                <img src="{{ asset('images/logo/cds1.png') }}" alt="Industrial Structural BOQ">
                <h3>Industrial Structural BOQ</h3>
            </div>

            <div class="rb-type-card">
                <img src="{{ asset('images/logo/b4.png') }}" alt="Core and Shell Structural BOQ">
                <h3>Core & Shell Structural BOQ</h3>
            </div>
        </div>
    </div>
</section>

<section class="rb-section">
    <div class="rb-wrap">
        <h2 class="rb-title">Why Structural BOQ is Important?</h2>
        <div class="rb-line"></div>

        <div class="rb-important">
            <span>Ensures structural accuracy</span>
            <span>Prevents material wastage</span>
            <span>Controls construction cost</span>
            <span>Improves execution planning</span>
            <span>Avoids over or under estimation</span>
            <span>Supports contractor comparison</span>
        </div>

        <p class="rb-locations">
            <strong>Target Locations We Serve</strong>
            Structural BOQ Services in Navi Mumbai | Structural BOQ Services in Mumbai |
            Structural BOQ Services in Pune | Structural BOQ Services in Raigad |
            Structural BOQ Services in Thane
        </p>
    </div>
</section>

<section class="rb-section">
    <div class="rb-wrap">
        <h2 class="rb-title">Frequently Asked Questions (FAQs)</h2>
        <div class="rb-line"></div>

        <div class="rb-faq">
            <details>
                <summary>1. What is included in structural BOQ?</summary>
                <p>A structural BOQ includes foundation quantities, RCC quantities, reinforcement steel, labour cost, and item-wise structural cost details.</p>
            </details>

            <details>
                <summary>2. Do you provide bar bending schedule (BBS)?</summary>
                <p>Yes. BBS can be prepared when structural drawings and reinforcement details are available.</p>
            </details>

            <details>
                <summary>3. How much does structural BOQ cost?</summary>
                <p>The cost depends on project size, structural complexity, drawing quality, and the level of detail required.</p>
            </details>

            <details>
                <summary>4. Can BOQ help reduce structural cost?</summary>
                <p>Yes. Accurate quantity take-off reduces wastage, improves purchase planning, and helps compare contractor quotations.</p>
            </details>

            <details>
                <summary>5. How long does BOQ preparation take?</summary>
                <p>Timelines depend on project size, number of structural drawings, and whether BBS or stage-wise BOQ is required.</p>
            </details>
        </div>
    </div>
</section>

@endsection
