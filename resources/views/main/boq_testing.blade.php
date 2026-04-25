@extends('layouts.app')

@section('title', 'BOQ / Estimation Services')

@section('content')

<style>
    body{
        font-family:"Poppins","Segoe UI",sans-serif;
        background:#fff;
        color:#222;
    }

    .boq-hero{
        min-height:430px;
        background:
            linear-gradient(90deg,rgba(0,0,0,.86) 0%,rgba(0,0,0,.60) 45%,rgba(0,0,0,.08) 100%),
            url("{{ asset('images/services/boq-banner.png') }}");
        background-size:cover;
        background-position:center;
        display:flex;
        align-items:center;
        padding:70px 7%;
    }

    .boq-hero h1{
        color:#fff;
        font-size:54px;
        line-height:1.18;
        font-weight:900;
        max-width:980px;
        margin:0;
        text-shadow:0 5px 14px rgba(0,0,0,.55);
    }

    .boq-section{
        padding:70px 7%;
        background:#fff;
    }

    .boq-section.gray{
        background:#f4f7fb;
    }

    .boq-title{
        text-align:center;
        font-size:42px;
        font-weight:900;
        line-height:1.25;
        margin:0;
        color:#202124;
    }

    .boq-line{
        width:230px;
        height:4px;
        border-radius:30px;
        margin:18px auto 38px;
        background:linear-gradient(90deg,#f37021 0%,#f37021 45%,#1e73be 45%,#1e73be 100%);
    }

    .boq-subtitle{
        text-align:center;
        font-size:22px;
        color:#555;
        font-weight:800;
        margin-bottom:45px;
    }

    .boq-content{
        max-width:1400px;
        margin:0 auto;
    }

    .boq-content p{
        font-size:24px;
        color:#555;
        line-height:1.45;
        margin-bottom:28px;
    }

    .boq-pill{
        max-width:1500px;
        margin:0 auto 70px;
        padding:22px 35px;
        border-radius:50px;
        background:linear-gradient(90deg,#ffd1b5 0%,#d7ecff 100%);
        box-shadow:0 6px 12px rgba(0,0,0,.18);
        font-size:28px;
        font-weight:900;
        display:flex;
        flex-wrap:wrap;
        justify-content:center;
        gap:24px;
    }

    .boq-card-grid{
        display:grid;
        grid-template-columns:repeat(3,1fr);
        gap:55px;
        max-width:1500px;
        margin:0 auto;
    }

    .boq-card-grid.two{
        grid-template-columns:repeat(2,1fr);
        max-width:1000px;
        margin-top:60px;
    }

    .boq-card{
        background:#fff0e6;
        border:4px solid #f37021;
        border-radius:20px;
        overflow:hidden;
        box-shadow:0 8px 16px rgba(0,0,0,.25);
    }

    .boq-card.blue{
        background:#eaf4ff;
        border-color:#1e73be;
    }

    .boq-card img{
        width:100%;
        height:260px;
        object-fit:cover;
        display:block;
    }

    .boq-card h3{
        min-height:125px;
        display:flex;
        align-items:center;
        justify-content:center;
        text-align:center;
        font-size:34px;
        line-height:1.2;
        font-weight:900;
        padding:18px;
        margin:0;
        color:#555;
    }

    .process-grid{
        display:grid;
        grid-template-columns:repeat(3,1fr);
        gap:38px;
        max-width:1500px;
        margin:0 auto;
    }

    .process-grid.two{
        grid-template-columns:repeat(2,1fr);
        max-width:980px;
        margin-top:90px;
    }

    .process-card{
        position:relative;
        background:#fff0e6;
        border:3px solid #f37021;
        border-radius:20px;
        min-height:300px;
        padding:80px 45px 35px;
        box-shadow:0 8px 15px rgba(0,0,0,.25);
    }

    .process-card.blue{
        background:#eaf4ff;
        border-color:#1e73be;
    }

    .process-number{
        position:absolute;
        top:-42px;
        left:50%;
        transform:translateX(-50%);
        width:72px;
        height:72px;
        border-radius:18px;
        background:#f37021;
        color:#fff;
        font-size:48px;
        font-weight:900;
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .process-card.blue .process-number{
        background:#1e73be;
    }

    .process-card h3{
        text-align:center;
        font-size:31px;
        line-height:1.25;
        font-weight:900;
        margin:0 0 24px;
        color:#111;
    }

    .process-card p,
    .process-card li{
        font-size:21px;
        color:#555;
        font-weight:700;
        line-height:1.45;
    }

    .process-card ul{
        margin:18px 0 0 35px;
    }

    .why-wrap{
        max-width:1400px;
        margin:0 auto;
    }

    .why-item{
        margin-bottom:55px;
    }

    .why-item h3{
        font-size:36px;
        line-height:1.25;
        font-weight:900;
        margin:0 0 12px;
    }

    .why-item p,
    .why-item li{
        font-size:27px;
        line-height:1.45;
        color:#555;
        font-weight:600;
    }

    .why-item ul{
        margin:15px 0 0 70px;
    }

    .orange{color:#f37021;}
    .blue-text{color:#1e73be;}

    .faq-wrap{
        max-width:1350px;
        margin:0 auto;
    }

    .faq-item{
        background:#fff;
        border-radius:14px;
        margin-bottom:28px;
        overflow:hidden;
        box-shadow:0 6px 12px rgba(0,0,0,.18);
    }

    .faq-question{
        width:100%;
        border:none;
        background:#fff;
        text-align:left;
        padding:32px 45px;
        font-size:26px;
        font-weight:900;
        cursor:pointer;
        display:flex;
        justify-content:space-between;
        align-items:center;
    }

    .faq-icon{
        color:#1e73be;
        font-size:34px;
        font-weight:900;
    }

    .faq-answer{
        max-height:0;
        overflow:hidden;
        padding:0 45px;
        transition:.3s ease;
        font-size:20px;
        line-height:1.6;
        color:#555;
    }

    .faq-item.active .faq-answer{
        max-height:260px;
        padding:0 45px 30px;
    }

    .footer-links{
        max-width:1400px;
        margin:0 auto;
    }

    .footer-links h3{
        font-size:36px;
        font-weight:900;
        margin:0 0 18px;
    }

    .footer-links p{
        font-size:27px;
        line-height:1.5;
        color:#555;
        margin:0 0 45px;
    }

    @media(max-width:1100px){
        .boq-card-grid,
        .process-grid{
            grid-template-columns:repeat(2,1fr);
        }
    }

    @media(max-width:768px){
        .boq-hero{
            min-height:320px;
            padding:50px 22px;
        }

        .boq-hero h1{
            font-size:30px;
        }

        .boq-section{
            padding:50px 20px;
        }

        .boq-title{
            font-size:28px;
        }

        .boq-content p,
        .boq-subtitle{
            font-size:16px;
        }

        .boq-pill{
            font-size:17px;
            border-radius:22px;
            padding:18px;
            gap:10px;
        }

        .boq-card-grid,
        .boq-card-grid.two,
        .process-grid,
        .process-grid.two{
            grid-template-columns:1fr;
        }

        .process-grid.two{
            margin-top:50px;
        }

        .boq-card img{
            height:220px;
        }

        .boq-card h3{
            font-size:24px;
            min-height:100px;
        }

        .process-card{
            margin-top:50px;
        }

        .process-card h3{
            font-size:24px;
        }

        .process-card p,
        .process-card li{
            font-size:16px;
        }

        .why-item h3{
            font-size:25px;
        }

        .why-item p,
        .why-item li,
        .footer-links p{
            font-size:18px;
        }

        .why-item ul{
            margin-left:35px;
        }

        .footer-links h3{
            font-size:26px;
        }

        .faq-question{
            font-size:18px;
            padding:22px;
        }

        .faq-answer{
            font-size:15px;
            padding:0 22px;
        }

        .faq-item.active .faq-answer{
            padding:0 22px 22px;
        }
    }


    .boq-hero{
    position: relative;
    min-height: 420px;

    /* IMAGE + DARK OVERLAY */
    background: 
        linear-gradient(90deg, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.6) 50%, rgba(0,0,0,0.1) 100%),
        url("{{ asset('images/logo/b1.png') }}");

    background-size: cover;
    background-position: center;

    display: flex;
    align-items: center;
    padding: 60px 80px;
}

.boq-hero h1{
    color: #fff;
    font-size: 52px;
    font-weight: 900;
    line-height: 1.2;
    max-width: 900px;
}
</style>

<section class="boq-hero">
    <h1>
        BOQ / Estimation Services in<br>
        Navi Mumbai, Mumbai,<br>
        Thane, Pune & Raigad
    </h1>
</section>

<section class="boq-section">
    <h2 class="boq-title">BOQ / Estimation Service Provider</h2>
    <div class="boq-line"></div>

    <div class="boq-content">
        <p>
            Accurate budgeting is the backbone of every successful construction project.
            At ConstructKaro, we provide professional BOQ / Estimation Services across
            Navi Mumbai, Mumbai, Thane, Raigad, and Pune, helping you plan costs, control expenses,
            and execute projects with clarity.
        </p>

        <p>
            A well-prepared BOQ (Bill of Quantities) ensures that every material, labour component,
            and activity is clearly defined — eliminating confusion, reducing risks, and improving decision-making.
        </p>

        <p>
            Whether you are a homeowner, builder, contractor, or developer, our Construction Estimation Services
            help you understand the true cost of your project before execution begins.
        </p>
    </div>
</section>

<section class="boq-section">
    <h2 class="boq-title">What is BOQ / Estimation?</h2>
    <div class="boq-line"></div>

    <p class="boq-subtitle">A BOQ (Bill of Quantities) is a detailed document that includes:</p>

    <div class="boq-pill">
        <span>• Quantity of materials required</span>
        <span>• Labour cost estimation</span>
        <span>• Item-wise cost breakdown</span>
        <span>• Total project cost</span>
    </div>

    <h2 class="boq-title">Types of BOQ / Estimation Services We Offer</h2>
    <div class="boq-line"></div>

    <p class="boq-subtitle">We provide estimation services for various project types:</p>

    <div class="boq-card-grid">
        <div class="boq-card">
            <img src="{{ asset('images/logo/b2.png') }}" alt="Residential BOQ">
            <h3>Residential BOQ</h3>
        </div>

        <div class="boq-card blue">
            <img src="{{ asset('images/logo/b3.png') }}" alt="Commercial BOQ">
            <h3>Commercial<br>BOQ</h3>
        </div>

        <div class="boq-card">
            <img src="{{ asset('images/logo/b4.png') }}" alt="Structural BOQ">
            <h3>Structural BOQ</h3>
        </div>
    </div>

    <div class="boq-card-grid two">
        <div class="boq-card blue">
            <img src="{{ asset('images/logo/b5.png') }}" alt="Interior BOQ">
            <h3>Interior BOQ</h3>
        </div>

        <div class="boq-card">
            <img src="{{ asset('images/logo/b6.png') }}" alt="Renovation Repair Estimation">
            <h3>Renovation & Repair<br>Estimation</h3>
        </div>
    </div>
</section>

<section class="boq-section">
    <h2 class="boq-title">What We Offer in BOQ / Estimation Services</h2>
    <div class="boq-line"></div>

    <p class="boq-subtitle">
        At ConstructKaro, we provide a complete and structured estimation process:
    </p>

    <div class="process-grid">
        <div class="process-card">
            <div class="process-number">1</div>
            <h3>Requirement Understanding</h3>
            <p>We collect:</p>
            <ul>
                <li>Drawings (2D/3D if available)</li>
                <li>Plot size / built-up area</li>
                <li>Project type</li>
                <li>Budget expectations</li>
            </ul>
        </div>

        <div class="process-card blue">
            <div class="process-number">2</div>
            <h3>Quantity Take-Off</h3>
            <ul>
                <li>Material quantity calculation</li>
                <li>Accurate measurement from drawings</li>
                <li>Item-wise breakdown</li>
            </ul>
        </div>

        <div class="process-card">
            <div class="process-number">3</div>
            <h3>Cost Estimation</h3>
            <ul>
                <li>Market-based material rates</li>
                <li>Labour cost inclusion</li>
                <li>Location-based pricing</li>
            </ul>
        </div>
    </div>

    <div class="process-grid two">
        <div class="process-card blue">
            <div class="process-number">4</div>
            <h3>Detailed BOQ Preparation</h3>
            <ul>
                <li>Structured Excel / PDF BOQ</li>
                <li>Item-wise costing</li>
                <li>Clear quantity + rate + amount format</li>
            </ul>
        </div>

        <div class="process-card">
            <div class="process-number">5</div>
            <h3>Value Engineering Support</h3>
            <ul>
                <li>Cost optimization suggestions</li>
                <li>Alternative materials</li>
                <li>Budget-friendly options</li>
            </ul>
        </div>
    </div>
</section>

<section class="boq-section">
    <h2 class="boq-title">Why Choose ConstructKaro for BOQ / Estimation Services?</h2>
    <div class="boq-line"></div>

    <div class="why-wrap">
        <div class="why-item">
            <h3 class="orange">1. Accurate Cost Planning</h3>
            <p>We ensure:</p>
            <ul>
                <li>Realistic budgets</li>
                <li>No underestimation or overestimation</li>
            </ul>
        </div>

        <div class="why-item">
            <h3 class="blue-text">2. Transparent BOQ Structure</h3>
            <ul>
                <li>Clear item-wise details</li>
                <li>Easy to understand format</li>
                <li>No hidden costs</li>
            </ul>
        </div>

        <div class="why-item">
            <h3 class="orange">3. Market-Based Pricing</h3>
            <ul>
                <li>Updated material rates</li>
                <li>Local contractor pricing</li>
                <li>Practical cost insights</li>
            </ul>
        </div>

        <div class="why-item">
            <h3 class="blue-text">4. Helps in Better Decision Making</h3>
            <ul>
                <li>Compare contractor quotes</li>
                <li>Control project expenses</li>
                <li>Avoid budget overruns</li>
            </ul>
        </div>

        <div class="why-item">
            <h3 class="orange">5. Location-Based Services</h3>
            <p>We provide:</p>
            <ul>
                <li>BOQ Services in Navi Mumbai</li>
                <li>Estimation Services in Mumbai</li>
                <li>BOQ Services in Thane</li>
                <li>Construction Estimation in Raigad</li>
                <li>BOQ / Estimation Services in Pune</li>
            </ul>
        </div>

        <div class="why-item">
            <h3 class="blue-text">6. Suitable for All Project Sizes</h3>
            <ul>
                <li>Small home construction</li>
                <li>Large commercial projects</li>
                <li>Interior works</li>
                <li>Renovation projects</li>
            </ul>
        </div>
    </div>
</section>

<section class="boq-section gray">
    <h2 class="boq-title">Frequently Asked Questions (FAQs)</h2>
    <div class="boq-line"></div>

    <div class="faq-wrap">
        @php
            $faqs = [
                'What is the purpose of a BOQ?' => 'A BOQ helps define quantities, materials, labour, rates, and total project cost clearly before execution.',
                'How much does BOQ / Estimation cost?' => 'The cost depends on project size, drawing availability, scope of work, and estimation detail required.',
                'Do I need drawings for BOQ?' => 'Yes, drawings help prepare accurate quantities. If drawings are not available, our team can guide you on the next step.',
                'Can BOQ help in reducing construction cost?' => 'Yes, a proper BOQ helps compare quotations, avoid overbilling, and control unnecessary expenses.',
                'Do you provide BOQ for interior projects?' => 'Yes, BOQ can be prepared for residential, commercial, interior, renovation, and structural works.',
                'Is BOQ useful for contractor selection?' => 'Yes, BOQ helps compare contractor quotes on the same item-wise scope.',
                'How long does it take to prepare BOQ?' => 'Timeline depends on project size and drawing details. Our team reviews your requirement and shares the expected timeline.'
            ];
        @endphp

        @foreach($faqs as $question => $answer)
            <div class="faq-item">
                <button type="button" class="faq-question">
                    <span>{{ $loop->iteration }}. {{ $question }}</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    {{ $answer }}
                </div>
            </div>
        @endforeach
    </div>
</section>

<section class="boq-section">
    <div class="footer-links">
        <h3>Our Other Services</h3>
        <p>Architect | Contractor | Interior Designer | Survey Services | Testing Services</p>

        <h3>BOQ / Estimation Services Locations:</h3>
        <p>
            BOQ / Estimation Services Navi Mumbai | BOQ / Estimation Services Mumbai |
            BOQ / Estimation Services Thane | BOQ / Estimation Services Raigad |
            BOQ / Estimation Services Pune
        </p>
    </div>
</section>

<script>
    document.querySelectorAll('.faq-question').forEach(function(button){
        button.addEventListener('click', function(){
            const item = this.closest('.faq-item');

            document.querySelectorAll('.faq-item').forEach(function(el){
                if(el !== item){
                    el.classList.remove('active');
                    el.querySelector('.faq-icon').innerHTML = '+';
                }
            });

            item.classList.toggle('active');
            this.querySelector('.faq-icon').innerHTML = item.classList.contains('active') ? '-' : '+';
        });
    });
</script>

@endsection