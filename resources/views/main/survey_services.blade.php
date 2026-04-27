@extends('layouts.app')

@section('title', 'Land Survey Services')

@section('content')

<style>
    body{
        font-family:"Poppins","Segoe UI",sans-serif;
        background:#fff;
        color:#222;
    }

    .survey-hero{
        min-height:430px;
        background:
            linear-gradient(90deg,rgba(0,0,0,.85) 0%,rgba(0,0,0,.58) 43%,rgba(0,0,0,.08) 100%),
            url("{{ asset('images/services/survey-banner.png') }}");
        background-size:cover;
        background-position:center;
        display:flex;
        align-items:center;
        padding:70px 7%;
    }

    .survey-hero h1{
        color:#fff;
        font-size:54px;
        line-height:1.18;
        font-weight:900;
        max-width:900px;
        margin:0;
        text-shadow:0 5px 14px rgba(0,0,0,.55);
    }

    .survey-section{
        padding:70px 7%;
        background:#fff;
    }

    .survey-section.gray{
        background:#f4f7fb;
    }

    .survey-title{
        text-align:center;
        font-size:42px;
        font-weight:900;
        line-height:1.25;
        margin:0;
        color:#202124;
    }

    .survey-line{
        width:220px;
        height:4px;
        border-radius:30px;
        margin:18px auto 38px;
        background:linear-gradient(90deg,#f37021 0%,#f37021 45%,#1e73be 45%,#1e73be 100%);
    }

    .survey-subtitle{
        text-align:center;
        font-size:22px;
        color:#555;
        font-weight:800;
        margin-bottom:45px;
    }

    .survey-content{
        max-width:1400px;
        margin:0 auto;
    }

    .survey-content p{
        font-size:24px;
        color:#555;
        line-height:1.45;
        margin-bottom:28px;
    }

    .survey-content strong{
        font-weight:900;
    }

    .survey-card-grid{
        display:grid;
        grid-template-columns:repeat(4,1fr);
        gap:35px;
        max-width:1600px;
        margin:0 auto;
    }

    .survey-card{
        background:#fff0e6;
        border:4px solid #f37021;
        border-radius:20px;
        overflow:hidden;
        box-shadow:0 8px 16px rgba(0,0,0,.25);
    }

    .survey-card.blue{
        background:#eaf4ff;
        border-color:#1e73be;
    }

    .survey-card img{
        width:100%;
        height:250px;
        object-fit:cover;
        display:block;
    }

    .survey-card h3{
        min-height:115px;
        display:flex;
        align-items:center;
        justify-content:center;
        text-align:center;
        font-size:25px;
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
        max-height:220px;
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

    @media(max-width:1200px){
        .survey-card-grid{
            grid-template-columns:repeat(2,1fr);
        }

        .process-grid{
            grid-template-columns:1fr 1fr;
        }
    }

    @media(max-width:768px){
        .survey-hero{
            min-height:320px;
            padding:50px 22px;
        }

        .survey-hero h1{
            font-size:30px;
        }

        .survey-section{
            padding:50px 20px;
        }

        .survey-title{
            font-size:28px;
        }

        .survey-content p,
        .survey-subtitle{
            font-size:16px;
        }

        .survey-card-grid,
        .process-grid,
        .process-grid.two{
            grid-template-columns:1fr;
        }

        .process-grid.two{
            margin-top:50px;
        }

        .survey-card img{
            height:220px;
        }

        .survey-card h3{
            font-size:24px;
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
.survey-hero{
    min-height:430px;
    background:
        linear-gradient(90deg, rgba(0,0,0,.85) 0%, rgba(0,0,0,.58) 43%, rgba(0,0,0,.08) 100%),
        url("{{ asset('images/logo/s1.png') }}");

    background-size:cover;
    background-position:center;
    display:flex;
    align-items:center;
    padding:70px 7%;
}
    
</style>

<section class="survey-hero">
    <h1>
        Land Survey Services in<br>
        Navi Mumbai, Mumbai,<br>
        Thane, Pune & Raigad
    </h1>
</section>

<section class="survey-section">
    <h2 class="survey-title">Land Survey Service Provider</h2>
    <div class="survey-line"></div>

    <div class="survey-content">
        <p>
            Accurate land measurement is the foundation of every successful construction or property decision.
            At ConstructKaro, we provide <strong>professional Land Survey Services</strong> across
            <strong>Navi Mumbai, Mumbai, Thane, Raigad, and Pune</strong>, ensuring precise data,
            clear boundaries, and reliable site insights before you begin any project.
        </p>

        <p>
            Whether you are planning construction, buying land, resolving disputes, or preparing legal documentation,
            our platform connects you with <strong>experienced surveyors equipped with modern tools like Total Station,
            DGPS, and drone surveys.</strong>
        </p>
    </div>
</section>

<section class="survey-section">
    <h2 class="survey-title">Types of Land Survey Services We Offer</h2>
    <div class="survey-line"></div>

    <p class="survey-subtitle">
        We offer a complete range of land and site survey solutions:
    </p>

    <div class="survey-card-grid">
        @php
            $surveyTypes = [
                ['Boundary Survey<br>(Demarcation)', 'images/logo/s2.png', 'orange'],
                ['Topographic Survey', 'images/logo/s3.png', 'blue'],
                ['Total Station Survey', 'images/logo/s4.png', 'orange'],
                ['DGPS Survey<br>(Differential GPS)', 'images/logo/s9.png', 'blue'],
                ['Layout & Plotting<br>Survey', 'images/logo/s5.png', 'blue'],
                ['Construction Layout<br>Survey', 'images/logo/s6.png', 'orange'],
                ['Drone Survey', 'images/logo/s7.png', 'blue'],
                ['Road & Infrastructure<br>Survey', 'images/logo/s8.png', 'orange'],
            ];
        @endphp

        @foreach($surveyTypes as $item)
            <div class="survey-card {{ $item[2] == 'blue' ? 'blue' : '' }}">
                <img src="{{ asset($item[1]) }}" alt="{!! strip_tags($item[0]) !!}">
                <h3>{!! $item[0] !!}</h3>
            </div>
        @endforeach
    </div>
</section>

<section class="survey-section">
    <h2 class="survey-title">What We Offer in Land Survey Services</h2>
    <div class="survey-line"></div>

    <p class="survey-subtitle">
        At ConstructKaro, we provide a structured and professional survey process:
    </p>

    <div class="process-grid">
        <div class="process-card">
            <div class="process-number">1</div>
            <h3>Requirement Understanding</h3>
            <p>We collect:</p>
            <ul>
                <li>Location details</li>
                <li>Land size & type</li>
                <li>Purpose of survey</li>
            </ul>
        </div>

        <div class="process-card blue">
            <div class="process-number">2</div>
            <h3>Survey Planning</h3>
            <ul>
                <li>Selection of survey method</li>
                <li>Team allocation based on location</li>
                <li>Timeline planning</li>
            </ul>
        </div>

        <div class="process-card">
            <div class="process-number">3</div>
            <h3>Site Visit & Data Collection</h3>
            <ul>
                <li>On-site measurement</li>
                <li>Use of advanced instruments</li>
                <li>Accurate field data recording</li>
            </ul>
        </div>
    </div>

    <div class="process-grid two">
        <div class="process-card blue">
            <div class="process-number">4</div>
            <h3>Data Processing & Mapping</h3>
            <ul>
                <li>Digital drawings (AutoCAD)</li>
                <li>Contour maps</li>
                <li>Layout plans</li>
            </ul>
        </div>

        <div class="process-card">
            <div class="process-number">5</div>
            <h3>Report & Deliverables</h3>
            <ul>
                <li>Survey report</li>
                <li>Layout drawings</li>
                <li>Coordinates & measurements</li>
                <li>Ready-to-use files</li>
            </ul>
        </div>
    </div>
</section>

<section class="survey-section">
    <h2 class="survey-title">Why Choose ConstructKaro for Land Survey Services?</h2>
    <div class="survey-line"></div>

    <div class="why-wrap">
        <div class="why-item">
            <h3 class="orange">1. Verified Professional Surveyors</h3>
            <p>We connect you with experienced and location-based survey experts.</p>
        </div>

        <div class="why-item">
            <h3 class="blue-text">2. Modern Equipment & Accuracy</h3>
            <p>We use:</p>
            <ul>
                <li>Total Station</li>
                <li>DGPS</li>
                <li>Drone Technology</li>
            </ul>
            <p>Ensuring high precision and reliable results.</p>
        </div>

        <div class="why-item">
            <h3 class="orange">3. Fast Turnaround Time</h3>
            <ul>
                <li>Quick site visits</li>
                <li>Timely report delivery</li>
                <li>Efficient coordination</li>
            </ul>
        </div>

        <div class="why-item">
            <h3 class="blue-text">4. Transparent Pricing</h3>
            <ul>
                <li>Clear cost structure</li>
                <li>No hidden charges</li>
                <li>Value-based service</li>
            </ul>
        </div>

        <div class="why-item">
            <h3 class="orange">5. Location-Based Service Network</h3>
            <p>We provide:</p>
            <ul>
                <li>Land Survey Services in Navi Mumbai</li>
                <li>Land Survey Services in Mumbai</li>
                <li>Land Survey Services in Thane</li>
                <li>Land Survey Services in Raigad</li>
                <li>Land Survey Services in Pune</li>
            </ul>
            <p>This ensures faster availability and local expertise.</p>
        </div>

        <div class="why-item">
            <h3 class="blue-text">6. Suitable for All Project Types</h3>
            <ul>
                <li>Residential plots</li>
                <li>Industrial land</li>
                <li>Agricultural land</li>
                <li>Commercial properties</li>
                <li>Large township developments</li>
            </ul>
        </div>
    </div>
</section>

<section class="survey-section gray">
    <h2 class="survey-title">Frequently Asked Questions (FAQs)</h2>
    <div class="survey-line"></div>

    <div class="faq-wrap">
        @php
            $faqs = [
                'What is the cost of land survey services?' => 'Cost depends on:
                •	Land size 
                •	Survey type 
                •	Location 
                Typically ranges from ₹5,000 to ₹50,000+ depending on project scope.
                ',
                'How long does a land survey take?' => '•	Small plots: 1–2 days 
                •	Medium land: 2–4 days 
                •	Large projects: 5+ days 
                ',
                'What is a Total Station Survey?' => 'It is a high-precision digital survey method used for accurate measurement and construction layout.',
                'Do you provide survey reports and drawings?' => 'Yes, we provide:
                    •	AutoCAD drawings 
                    •	Survey reports 
                    •	Layout plans 
                    ',
                'Is land survey necessary before construction?' => 'Yes, it helps:
                •	Avoid boundary disputes 
                •	Ensure correct construction layout 
                •	Plan site development properly 
                ',
                'How do I get started?' => 'Submit your requirement, and our team will contact you within 24 working hours.'
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

<section class="survey-section">
    <div class="footer-links">
        <h3>Our Other Services</h3>
        <p>Architect | Contractor | Interior Designer | Testing Services | BOQ / Estimation</p>

        <h3>Land Survey Services Locations:</h3>
        <p>
            Land Survey Services Navi Mumbai | Land Survey Services Mumbai |
            Land Survey Services Thane | Land Survey Services Raigad |
            Land Survey Services Pune
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