@extends('layouts.app')

@section('title', 'Renovation & Repair Estimation Consultant')

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
            url("{{ asset('images/logo/b6.png') }}");
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

    @media (min-width:993px){
        .rb-service-grid.two{
            grid-template-columns:repeat(3,1fr);
            max-width:1180px;
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
        Renovation &<br>Repair Estimation
        <span>(Bill of Quantities) Consultant</span>
    </h1>
</section>

<section class="rb-section">
    <div class="rb-wrap">
        <h2 class="rb-title">Renovation & Repair Estimation Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane</h2>
        <div class="rb-line"></div>

        <p class="rb-copy">
            Planning to renovate your home, office, or building but unsure about the budget?
            At <strong>ConstructKaro</strong>, we provide expert <strong>Renovation & Repair Estimation</strong>
            services to give you a clear, detailed, and realistic cost breakdown before starting work.
        </p>

        <p class="rb-copy">
            From minor repairs to full renovation projects, our estimation helps you plan better,
            avoid overspending, and execute work smoothly.
        </p>

        <div class="cb-info-box">
            <h2 class="rb-title">What is Renovation & Repair Estimation?</h2>
            <div class="rb-line"></div>

            <p class="rb-copy">
                Renovation and repair estimation is the process of calculating:
            </p>

            <div class="rb-benefits">
                <div class="rb-benefit">Material quantities</div>
                <div class="rb-benefit orange">Labour costs</div>
                <div class="rb-benefit">Repair scope & execution cost</div>
                <div class="rb-benefit orange">Total renovation budget</div>
            </div>

            <p class="rb-copy" style="margin-top:22px;margin-bottom:0;">
                It ensures your project is financially planned and executed without unexpected expenses.
            </p>
        </div>
    </div>
</section>

<section class="rb-section">
    <div class="rb-wrap">
        <h2 class="rb-title">Our Renovation & Repair Estimation Services Include</h2>
        <div class="rb-line"></div>

        <div class="rb-service-grid">
            <div class="rb-service-card">
                <div class="rb-number">1</div>
                <h3>Site Inspection & Condition Analysis</h3>
                <ul>
                    <li>Existing structure evaluation</li>
                    <li>Damage and repair scope identification</li>
                    <li>Requirement and upgrade assessment</li>
                </ul>
            </div>

            <div class="rb-service-card blue">
                <div class="rb-number">2</div>
                <h3>Quantity Take-Off</h3>
                <ul>
                    <li>Repair material quantity calculation</li>
                    <li>Painting materials estimation</li>
                    <li>Replacement material quantity planning</li>
                </ul>
            </div>

            <div class="rb-service-card">
                <div class="rb-number">3</div>
                <h3>Material Specification</h3>
                <ul>
                    <li>Material upgrade options</li>
                    <li>Brand-wise recommendations</li>
                    <li>Durable and cost-effective solutions</li>
                </ul>
            </div>
        </div>

        <div class="rb-service-grid two">
            <div class="rb-service-card blue">
                <div class="rb-number">4</div>
                <h3>Detailed Cost Estimation</h3>
                <ul>
                    <li>Item-wise cost breakdown</li>
                    <li>Labour and material costing</li>
                    <li>Room-wise or area-wise estimation</li>
                </ul>
            </div>

            <div class="rb-service-card">
                <div class="rb-number">5</div>
                <h3>Repair & Renovation BOQ</h3>
                <ul>
                    <li>Waterproofing BOQ</li>
                    <li>Painting and plaster repair BOQ</li>
                    <li>Flooring and tile replacement BOQ</li>
                    <li>Electrical and plumbing repair BOQ</li>
                </ul>
            </div>

            <div class="rb-service-card blue">
                <div class="rb-number">6</div>
                <h3>Contractor Comparison & Budget Optimization</h3>
                <ul>
                    <li>Vendor quotation comparison</li>
                    <li>Rate validation</li>
                    <li>Cost-saving suggestions</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="rb-section">
    <div class="rb-wrap">
        <h2 class="rb-title">Types of Renovation & Repair Estimation</h2>
        <div class="rb-line"></div>

        <div class="rb-type-grid">
            <!-- <div class="rb-type-card"> -->
                <img src="{{ asset('images/logo/rrb1.png') }}" alt="Home Renovation Estimation">
                <!-- <h3>Home Renovation Estimation</h3>
            </div> -->

            <!-- <div class="rb-type-card"> -->
                <img src="{{ asset('images/logo/rrb2.png') }}" alt="Apartment Repair and Renovation">
                <!-- <h3>Apartment Repair & Renovation</h3>
            </div> -->

            <!-- <div class="rb-type-card"> -->
                <img src="{{ asset('images/logo/rrb3.png') }}" alt="Commercial Renovation Estimation">
                <!-- <h3>Commercial Renovation Estimation</h3>
            </div> -->

            <!-- <div/ class="rb-type-card"> -->
                <img src="{{ asset('images/logo/rrb4.png') }}" alt="Structural Repair and Maintenance Estimation">
                <!-- <h3>Structural Repair & Maintenance Estimation</h3> -->
            <!-- </div> -->
        </div>
    </div>
</section>

<section class="rb-section">
    <div class="rb-wrap">
        <h2 class="rb-title">Why Renovation & Repair Estimation is Important?</h2>
        <div class="rb-line"></div>

        <div class="rb-important">
            <span>Prevents budget overruns</span>
            <span>Ensures cost transparency</span>
            <span>Helps prioritize repair work</span>
            <span>Avoids unnecessary expenses</span>
            <span>Improves execution planning</span>
            <span>Supports room-wise budgeting</span>
        </div>

        <p class="rb-locations">
            <strong>Target Locations We Serve</strong>
            Renovation Estimation in Navi Mumbai | Repair Estimation in Mumbai |
            Renovation Estimation in Pune | Repair Estimation in Raigad |
            Renovation Estimation in Thane
        </p>
    </div>
</section>

<section class="rb-section">
    <div class="rb-wrap">
        <h2 class="rb-title">Frequently Asked Questions (FAQs)</h2>
        <div class="rb-line"></div>

        <div class="rb-faq">
            <details>
                <summary>1. What is included in renovation estimation?</summary>
                <p>It includes repair scope, material quantities, labour cost, item-wise rates, and total renovation budget.</p>
            </details>

            <details>
                <summary>2. How much does estimation service cost?</summary>
                <p>The cost depends on property size, repair scope, site condition, and the level of detail required.</p>
            </details>

            <details>
                <summary>3. Can you estimate partial renovation work?</summary>
                <p>Yes. We can estimate single-room, kitchen, bathroom, flooring, painting, or selected repair work.</p>
            </details>

            <details>
                <summary>4. Do you provide BOQ for repair work?</summary>
                <p>Yes. Repair BOQ can include waterproofing, plaster repair, painting, tile replacement, plumbing, and electrical repair items.</p>
            </details>

            <details>
                <summary>5. How long does BOQ preparation take?</summary>
                <p>Timelines depend on property size, inspection requirements, and the repair or renovation scope.</p>
            </details>
        </div>
    </div>
</section>

@endsection
