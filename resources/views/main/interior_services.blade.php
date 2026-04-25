@extends('layouts.app')

@section('title', 'Interior Design Services')

@section('content')

<style>
    body{
        font-family:"Poppins","Segoe UI",sans-serif;
        background:#eeeeee;
        color:#222;
    }

    .id-hero{
        min-height:420px;
        background:
            linear-gradient(90deg,rgba(0,0,0,.82) 0%,rgba(0,0,0,.58) 42%,rgba(0,0,0,.12) 100%),
            url("{{ asset('images/services/interior-banner.png') }}");
        background-size:cover;
        background-position:center;
        display:flex;
        align-items:center;
        padding:70px 7%;
    }

    .id-hero h1{
        color:#fff;
        font-size:54px;
        line-height:1.18;
        font-weight:900;
        max-width:850px;
        margin:0;
        text-shadow:0 5px 14px rgba(0,0,0,.55);
    }

    .id-section{
        padding:70px 7%;
        background:#eeeeee;
    }

    .id-section.white{
        background:#fff;
    }

    .id-title{
        text-align:center;
        font-size:42px;
        font-weight:900;
        line-height:1.25;
        margin:0;
        color:#202124;
    }

    .id-line{
        width:190px;
        height:4px;
        border-radius:30px;
        margin:18px auto 38px;
        background:linear-gradient(90deg,#f37021 0%,#f37021 45%,#1e73be 45%,#1e73be 100%);
    }

    .id-subtitle{
        text-align:center;
        font-size:20px;
        color:#555;
        font-weight:700;
        margin-bottom:45px;
    }

    .id-content{
        max-width:1280px;
        margin:0 auto;
    }

    .id-content p{
        font-size:22px;
        color:#555;
        line-height:1.45;
        margin-bottom:28px;
    }

    .id-content strong{
        font-weight:900;
    }

    .category-grid{
        display:grid;
        grid-template-columns:repeat(3,1fr);
        gap:60px;
        max-width:1500px;
        margin:0 auto;
    }

    .category-grid.two{
        grid-template-columns:repeat(2,1fr);
        max-width:960px;
        margin-top:55px;
    }

    .category-card{
        background:#fff0e6;
        border:4px solid #f37021;
        border-radius:20px;
        overflow:hidden;
        box-shadow:0 8px 16px rgba(0,0,0,.25);
    }

    .category-card.blue{
        background:#eaf4ff;
        border-color:#1e73be;
    }

    .category-card img{
        width:100%;
        height:250px;
        object-fit:cover;
        display:block;
    }

    .category-card h3{
        min-height:135px;
        display:flex;
        align-items:center;
        justify-content:center;
        text-align:center;
        font-size:34px;
        line-height:1.25;
        font-weight:900;
        padding:20px;
        margin:0;
        color:#111;
    }

    .category-card.blue h3{
        color:#555;
    }

    .offer-grid{
        display:grid;
        grid-template-columns:repeat(3,1fr);
        gap:38px;
        max-width:1500px;
        margin:0 auto;
    }

    .offer-card{
        position:relative;
        background:#fff0e6;
        border:3px solid #f37021;
        border-radius:20px;
        min-height:310px;
        padding:75px 45px 35px;
        box-shadow:0 8px 15px rgba(0,0,0,.25);
    }

    .offer-card.blue{
        background:#eaf4ff;
        border-color:#1e73be;
    }

    .offer-number{
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

    .offer-card.blue .offer-number{
        background:#1e73be;
    }

    .offer-card h3{
        text-align:center;
        font-size:31px;
        line-height:1.25;
        font-weight:900;
        margin:0 0 22px;
        color:#111;
    }

    .offer-card p,
    .offer-card li{
        font-size:21px;
        color:#555;
        font-weight:700;
        line-height:1.45;
    }

    .offer-card ul{
        margin:16px 0 0 30px;
    }

    .offer-card.second-row{
        margin-top:80px;
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

    .work-list{
        max-width:1200px;
        margin:0 auto;
        font-size:32px;
        line-height:1.45;
        color:#555;
        font-weight:900;
    }

    .location-list{
        max-width:1300px;
        margin:0 auto;
    }

    .location-list ul{
        margin-left:50px;
    }

    .location-list li{
        font-size:30px;
        line-height:1.45;
        color:#555;
        font-weight:900;
    }

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
        padding:35px 45px;
        font-size:28px;
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
        max-height:200px;
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
        .category-grid,
        .offer-grid{
            grid-template-columns:1fr 1fr;
            gap:35px;
        }

        .id-hero h1{
            font-size:42px;
        }
    }

    @media(max-width:768px){
        .id-hero{
            min-height:310px;
            padding:50px 22px;
        }

        .id-hero h1{
            font-size:30px;
        }

        .id-section{
            padding:50px 20px;
        }

        .id-title{
            font-size:28px;
        }

        .id-content p,
        .id-subtitle{
            font-size:16px;
        }

        .category-grid,
        .category-grid.two,
        .offer-grid{
            grid-template-columns:1fr;
        }

        .category-card img{
            height:210px;
        }

        .category-card h3{
            font-size:25px;
            min-height:100px;
        }

        .offer-card,
        .offer-card.second-row{
            margin-top:50px;
        }

        .offer-card h3{
            font-size:24px;
        }

        .offer-card p,
        .offer-card li{
            font-size:16px;
        }

        .why-item h3{
            font-size:25px;
        }

        .why-item p,
        .why-item li,
        .work-list,
        .location-list li,
        .footer-links p{
            font-size:18px;
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

    .id-hero{
        min-height:420px;
        background:
            linear-gradient(90deg, rgba(0,0,0,.82) 0%, rgba(0,0,0,.58) 42%, rgba(0,0,0,.12) 100%),
            url("{{ asset('images/logo/i1.png') }}");

        background-size:cover;
        background-position:center;
        display:flex;
        align-items:center;
        padding:70px 7%;
    }
</style>

<section class="id-hero">
    <h1>
        Interior Design Services in<br>
        Navi Mumbai, Mumbai,<br>
        Thane, Pune & Raigad
    </h1>
</section>

<section class="id-section">
    <h2 class="id-title">Build Your Project with the Right Architectural Guidance</h2>
    <div class="id-line"></div>

    <div class="id-content">
        <p>
            Creating a space is not just about construction it’s about how that space feels, functions,
            and reflects your lifestyle or brand. At ConstructKaro, we provide
            <strong>professional Interior Design Services</strong> across
            <strong>Navi Mumbai, Mumbai, Thane, Raigad, and Pune</strong>, helping you transform empty
            spaces into well-planned, functional, and visually stunning environments.
        </p>

        <p>
            Whether it’s a home, office, retail space, or commercial project, our platform connects you
            with the <strong>right interior designers and execution teams</strong> to bring your vision
            to life from concept to completion.
        </p>
    </div>
</section>

<section class="id-section">
    <h2 class="id-title">Types of Interior Design Services We Offer</h2>
    <div class="id-line"></div>

    <p class="id-subtitle">
        We cover a wide range of interior design categories to match different project needs:
    </p>

    <div class="category-grid">
        <div class="category-card">
            <img src="{{ asset('images/logo/i2.png') }}" alt="Residential Interior Design">
            <h3>Residential<br>Interior Design</h3>
        </div>

        <div class="category-card blue">
            <img src="{{ asset('images/logo/i3.png') }}" alt="Commercial Interior Design">
            <h3>Commercial<br>Interior Design</h3>
        </div>

        <div class="category-card">
            <img src="{{ asset('images/logo/i4.png') }}" alt="Retail Showroom Interiors">
            <h3>Retail & Showroom<br>Interiors</h3>
        </div>
    </div>

    <div class="category-grid two">
        <div class="category-card blue">
            <img src="{{ asset('images/logo/i5.png') }}" alt="Hospitality Interior Design">
            <h3>Hospitality<br>Interior Design</h3>
        </div>

        <div class="category-card">
            <img src="{{ asset('images/logo/i6.png') }}" alt="Industrial Specialized Interiors">
            <h3>Industrial &<br>Specialized Interiors</h3>
        </div>
    </div>
</section>

<section class="id-section">
    <h2 class="id-title">What We Offer in Interior Design Services</h2>
    <div class="id-line"></div>

    <p class="id-subtitle">
        At ConstructKaro, we don’t just connect you with designers — we provide a structured, end-to-end interior solution
    </p>

    <div class="offer-grid">
        <div class="offer-card">
            <div class="offer-number">1</div>
            <h3>Requirement Understanding</h3>
            <p>We begin by understanding:</p>
            <ul>
                <li>Your space size & layout</li>
                <li>Budget range</li>
                <li>Timeline & urgency</li>
                <li>Design preference</li>
            </ul>
        </div>

        <div class="offer-card blue">
            <div class="offer-number">2</div>
            <h3>Design Planning & Concepts</h3>
            <ul>
                <li>2D layout planning</li>
                <li>3D design visualization</li>
                <li>Material selection guidance</li>
                <li>Color & theme suggestions</li>
            </ul>
        </div>

        <div class="offer-card">
            <div class="offer-number">3</div>
            <h3>BOQ & Cost Estimation</h3>
            <ul>
                <li>Detailed cost breakdown</li>
                <li>Material-wise pricing</li>
                <li>Transparent budgeting</li>
                <li>Value engineering options</li>
            </ul>
        </div>

        <div class="offer-card blue second-row">
            <div class="offer-number">4</div>
            <h3>Vendor & Designer Matching</h3>
            <p>We assign:</p>
            <ul>
                <li>Verified interior designers</li>
                <li>Execution teams based on location</li>
                <li>Category-specific experts</li>
            </ul>
        </div>

        <div class="offer-card second-row">
            <div class="offer-number">5</div>
            <h3>Execution & Site Coordination</h3>
            <ul>
                <li>On-site work execution</li>
                <li>Material procurement</li>
                <li>Skilled labour & supervision</li>
                <li>Quality checks at each stage</li>
            </ul>
        </div>

        <div class="offer-card blue second-row">
            <div class="offer-number">6</div>
            <h3>Project Completion & Handover</h3>
            <ul>
                <li>Final finishing</li>
                <li>Snag checks</li>
                <li>Clean handover</li>
                <li>Ready-to-use space</li>
            </ul>
        </div>
    </div>
</section>

<section class="id-section">
    <h2 class="id-title">Why Choose ConstructKaro for Interior Design?</h2>
    <div class="id-line"></div>

    <p class="id-subtitle">
        At ConstructKaro, we don’t just connect you with designers — we provide a structured, end-to-end interior solution
    </p>

    <div class="why-wrap">
        <div class="why-item">
            <h3 class="orange">1. One Platform for Complete Interior Solutions</h3>
            <p>No need to search for multiple vendors. From design to execution, everything is managed in one place.</p>
        </div>

        <div class="why-item">
            <h3 class="blue-text">2. Right Designer for Your Project</h3>
            <p>We don’t assign randomly — we match your requirement with the most suitable interior expert based on:</p>
            <ul>
                <li>Budget</li>
                <li>Location</li>
                <li>Project type</li>
            </ul>
        </div>

        <div class="why-item">
            <h3 class="orange">3. Professional Project Handling</h3>
            <ul>
                <li>Structured workflow</li>
                <li>Dedicated coordination</li>
                <li>Timely updates</li>
            </ul>
        </div>

        <div class="why-item">
            <h3 class="blue-text">4. Location-Based Service Network</h3>
            <p>We actively serve:</p>
            <ul>
                <li>Interior Design Services in Navi Mumbai</li>
                <li>Interior Design Services in Mumbai</li>
                <li>Interior Design Services in Thane</li>
                <li>Interior Design Services in Raigad</li>
                <li>Interior Design Services in Pune</li>
            </ul>
            <p>This ensures faster execution and better on-site coordination.</p>
        </div>

        <div class="why-item">
            <h3 class="orange">5. Scalable for Small to Large Projects</h3>
            <p>Whether it’s:</p>
            <ul>
                <li>A single room makeover</li>
                <li>Full home interior</li>
                <li>Office setup</li>
                <li>Commercial space</li>
            </ul>
            <p>We handle projects of all sizes.</p>
        </div>

        <div class="why-item">
            <h3 class="blue-text">6. Transparent Pricing</h3>
            <ul>
                <li>Structured workflow</li>
                <li>Dedicated coordination</li>
                <li>Timely updates</li>
            </ul>
        </div>
    </div>
</section>

<section class="id-section">
    <h2 class="id-title">How It Works</h2>
    <div class="id-line"></div>

    <div class="work-list">
        1. Submit your interior requirement<br>
        2. Our team reviews your details<br>
        3. We connect you within 24 working hours<br>
        4. Discuss design, budget & timeline<br>
        5. Finalize plan & start execution
    </div>
</section>

<section class="id-section">
    <h2 class="id-title">Interior Design Services Locations We Cover</h2>
    <div class="id-line"></div>

    <p class="id-subtitle">We provide services across major and growing regions:</p>

    <div class="location-list">
        <ul>
            <li>Navi Mumbai (Panvel, Ghansoli, Vashi, Kharghar)</li>
            <li>Mumbai (Western & Central suburbs)</li>
            <li>Thane (Ghodbunder, Majiwada, Kasarvadavali)</li>
            <li>Raigad (Panvel, Khalapur, Alibag region)</li>
            <li>Pune (PCMC, Hinjewadi, Wakad, Baner)</li>
        </ul>
    </div>
</section>

<section class="id-section">
    <h2 class="id-title">Frequently Asked Questions (FAQs)</h2>
    <div class="id-line"></div>

    <div class="faq-wrap">
        @php
            $faqs = [
                'What is the cost of interior design services?' => 'The cost depends on the property size, design scope, material selection, and execution requirements.',
                'Do you provide both design and execution?' => 'Yes, we can help with design planning, BOQ, vendor matching, execution coordination, and project handover.',
                'How long does an interior project take?' => 'Timeline depends on the project size and scope. Our team reviews your requirement and guides you with an estimated timeline.',
                'Can I customize the design as per my budget?' => 'Yes, designs and material selections can be planned according to your preferred budget range.',
                'How do I get started?' => 'Submit your requirement and our team will contact you within 24 working hours.'
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

<section class="id-section">
    <div class="footer-links">
        <h3>Our Other Services</h3>
        <p>Architect | Contractor | Interior Designer | Survey Services | Testing Services | BOQ / Estimation</p>

        <h3>Interior Design Services Locations:</h3>
        <p>
            Interior Design Services Navi Mumbai | Interior Design Services Mumbai |
            Interior Design Services Thane | Interior Design Services Raigad |
            Interior Design Services Pune
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