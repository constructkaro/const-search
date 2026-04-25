@extends('layouts.app')

@section('title', 'Construction Testing Services')

@section('content')

<style>
    body{
        font-family:"Poppins","Segoe UI",sans-serif;
        background:#fff;
        color:#222;
    }

    .testing-hero{
        min-height:430px;
        background:
            linear-gradient(90deg,rgba(0,0,0,.86) 0%,rgba(0,0,0,.60) 45%,rgba(0,0,0,.08) 100%),
            url("{{ asset('images/services/testing-banner.png') }}");
        background-size:cover;
        background-position:center;
        display:flex;
        align-items:center;
        padding:70px 7%;
    }

    .testing-hero h1{
        color:#fff;
        font-size:54px;
        line-height:1.18;
        font-weight:900;
        max-width:980px;
        margin:0;
        text-shadow:0 5px 14px rgba(0,0,0,.55);
    }

    .testing-section{
        padding:70px 7%;
        background:#fff;
    }

    .testing-section.gray{
        background:#f4f7fb;
    }

    .testing-title{
        text-align:center;
        font-size:42px;
        font-weight:900;
        line-height:1.25;
        margin:0;
        color:#202124;
    }

    .testing-line{
        width:230px;
        height:4px;
        border-radius:30px;
        margin:18px auto 38px;
        background:linear-gradient(90deg,#f37021 0%,#f37021 45%,#1e73be 45%,#1e73be 100%);
    }

    .testing-subtitle{
        text-align:center;
        font-size:22px;
        color:#555;
        font-weight:800;
        margin-bottom:45px;
    }

    .testing-content{
        max-width:1400px;
        margin:0 auto;
    }

    .testing-content p{
        font-size:24px;
        color:#555;
        line-height:1.45;
        margin-bottom:28px;
    }

    .testing-content strong{
        font-weight:900;
    }

    .testing-card-grid{
        display:grid;
        grid-template-columns:repeat(4,1fr);
        gap:35px;
        max-width:1600px;
        margin:0 auto;
    }

    .testing-card{
        background:#fff0e6;
        border:4px solid #f37021;
        border-radius:20px;
        overflow:hidden;
        box-shadow:0 8px 16px rgba(0,0,0,.25);
    }

    .testing-card.blue{
        background:#eaf4ff;
        border-color:#1e73be;
    }

    .testing-card img{
        width:100%;
        height:250px;
        object-fit:cover;
        display:block;
    }

    .testing-card h3{
        min-height:115px;
        display:flex;
        align-items:center;
        justify-content:center;
        text-align:center;
        font-size:30px;
        line-height:1.2;
        font-weight:900;
        padding:18px;
        margin:0;
        color:#555;
    }

    .testing-card-grid.center{
        grid-template-columns:repeat(3,1fr);
        max-width:1050px;
        margin-top:35px;
    }

   .category-table-wrap{
    max-width: 1500px;
    margin: 0 auto;
    overflow-x: auto;
}

.category-table{
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    overflow: hidden;
    border-radius: 12px;
}

.category-table th{
    background: #f37021;
    color: #fff;
    font-size: 28px;
    font-weight: 900;
    text-align: center;
    padding: 28px 18px;
    border-right: 5px solid #fff;
}

.category-table th:last-child{
    border-right: none;
}

.category-table td{
    background: #e7e7e7;
    color: #222;
    font-size: 21px;
    font-weight: 700;
    line-height: 1.3;
    padding: 24px 18px;
    border-right: 5px solid #fff;
    border-top: 5px solid #fff;
}

.category-table td:last-child{
    border-right: none;
}

.category-table td:first-child{
    background: #2478bd;
    color: #fff;
    text-align: center;
    font-size: 28px;
    font-weight: 900;
}

.category-table thead th:first-child{
    border-top-left-radius: 12px;
}

.category-table thead th:last-child{
    border-top-right-radius: 12px;
}

.category-table tbody tr:last-child td:first-child{
    border-bottom-left-radius: 12px;
}

.category-table tbody tr:last-child td:last-child{
    border-bottom-right-radius: 12px;
}

@media(max-width:768px){
    .category-table{
        min-width: 850px;
    }

    .category-table th{
        font-size: 20px;
        padding: 18px 12px;
    }

    .category-table td{
        font-size: 16px;
        padding: 16px 12px;
    }

    .category-table td:first-child{
        font-size: 18px;
    }
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

    @media(max-width:1200px){
        .testing-card-grid{
            grid-template-columns:repeat(2,1fr);
        }

        .testing-card-grid.center{
            grid-template-columns:repeat(2,1fr);
        }

        .process-grid{
            grid-template-columns:1fr 1fr;
        }
    }

    @media(max-width:768px){
        .testing-hero{
            min-height:320px;
            padding:50px 22px;
        }

        .testing-hero h1{
            font-size:30px;
        }

        .testing-section{
            padding:50px 20px;
        }

        .testing-title{
            font-size:28px;
        }

        .testing-content p,
        .testing-subtitle{
            font-size:16px;
        }

        .testing-card-grid,
        .testing-card-grid.center,
        .process-grid,
        .process-grid.two{
            grid-template-columns:1fr;
        }

        .process-grid.two{
            margin-top:50px;
        }

        .testing-card img{
            height:220px;
        }

        .testing-card h3{
            font-size:24px;
        }

        .category-table th{
            font-size:20px;
        }

        .category-table td,
        .category-table td:first-child{
            font-size:16px;
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


    .testing-hero {
    height: 420px;

    /* IMAGE + OVERLAY */
    background:
        linear-gradient(90deg, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.6) 45%, rgba(0,0,0,0.1) 100%),
        url("/images/logo/t1.png"); /* change path */

    background-size: cover;
    background-position: center;

    display: flex;
    align-items: center;
    padding: 0 60px;
}

.testing-hero h1 {
    color: #fff;
    font-size: 48px;
    font-weight: 900;
    line-height: 1.2;
    max-width: 900px;
}
</style>

<section class="testing-hero">
    <div class="hero-content">
        <h1>
            Construction Testing Services in<br>
            Navi Mumbai, Mumbai,<br>
            Thane, Pune & Raigad
        </h1>
    </div>
</section>

<section class="testing-section">
    <h2 class="testing-title">Construction Testing Service Provider</h2>
    <div class="testing-line"></div>

    <div class="testing-content">
        <p>
            In any construction project, quality is not just about materials it’s about verified performance,
            safety, and long-term durability. At ConstructKaro, we provide professional
            <strong>Construction Testing Services</strong> and <strong>Construction Material Testing</strong>
            across Navi Mumbai, Mumbai, Thane, Raigad, and Pune.
        </p>

        <p>
            From raw materials to finished structures, our testing services ensure that every component
            meets industry standards, safety norms, and engineering requirements.
        </p>

        <p>
            Whether you are a builder, contractor, developer, or property owner, accurate testing helps
            you avoid costly failures, ensure compliance, and build with confidence.
        </p>
    </div>
</section>

<section class="testing-section">
    <h2 class="testing-title">Types of Construction Testing Services</h2>
    <div class="testing-line"></div>

    <p class="testing-subtitle">
        We offer a wide range of Construction Material Testing services, covering every stage of construction:
    </p>

    <div class="testing-card-grid">
        @php
            $testingTypes = [
                ['Soil Testing', 'images/logo/t2.png', 'orange'],
                ['Concrete Testing', 'images/logo/t3.png', 'blue'],
                ['Steel Testing', 'images/logo/t4.png', 'orange'],
                ['Water Testing', 'images/logo/t5.png', 'blue'],
                ['Aggregate Testing', 'images/logo/t6.png', 'blue'],
                ['Bitumen & Asphalt<br>Testing', 'images/logo/t7.png', 'orange'],
                ['Brick & Block Testing', 'images/logo/t8.png', 'blue'],
                ['Sand Testing', 'images/logo/t9.png', 'orange'],
                 ['Cement Testing', 'images/logo/t10.png', 'blue'],
                  ['Road / Pavement Testing', 'images/logo/t11.png', 'orange'],
                   ['NDT (Non-Destructive Testing)', 'images/logo/t12.png', 'blue'],
            ];
        @endphp

        @foreach($testingTypes as $item)
            <div class="testing-card {{ $item[2] == 'blue' ? 'blue' : '' }}">
                <img src="{{ asset($item[1]) }}" alt="{!! strip_tags($item[0]) !!}">
                <h3>{!! $item[0] !!}</h3>
            </div>
        @endforeach
    </div>

    
</section>

<section class="testing-section">
    <h2 class="testing-title">Construction Material Testing Categories</h2>
    <div class="testing-line"></div>

    <p class="testing-subtitle">
        Below is a structured table covering major testing categories:
    </p>

    <div class="category-table-wrap">
    <table class="category-table">
        <thead>
            <tr>
                <th>Category</th>
                <th>Tests Included</th>
                <th>Purpose</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Physical Test</td>
                <td>Sieve Analysis, Density Test, Moisture Content, Slump Test, Compressive Strength</td>
                <td>To check physical properties like strength, size, and consistency</td>
            </tr>
            <tr>
                <td>Chemical Test</td>
                <td>pH Test, Sulphate Content, Chloride Test, Cement Composition</td>
                <td>To analyze chemical composition and reactions affecting durability</td>
            </tr>
            <tr>
                <td>Field Test</td>
                <td>Field Density Test, Plate Load Test, Slump Test, Rebound Hammer</td>
                <td>To check on-site quality and real-time performance</td>
            </tr>
            <tr>
                <td>NDT (Non-Destructive Test)</td>
                <td>Rebound Hammer Test, Ultrasonic Pulse Velocity (UPV), Core Testing, Half-Cell Potential</td>
                <td>To evaluate structural strength without damaging the structure</td>
            </tr>
        </tbody>
    </table>
</div>
</section>

<section class="testing-section">
    <h2 class="testing-title">What We Offer in Construction Testing Services</h2>
    <div class="testing-line"></div>

    <p class="testing-subtitle">
        At ConstructKaro, we provide a complete, structured testing solution:
    </p>

    <div class="process-grid">
        <div class="process-card">
            <div class="process-number">1</div>
            <h3>Requirement Understanding</h3>
            <p>We assess:</p>
            <ul>
                <li>Project type</li>
                <li>Material to be tested</li>
                <li>Site condition</li>
                <li>Testing purpose</li>
            </ul>
        </div>

        <div class="process-card blue">
            <div class="process-number">2</div>
            <h3>Lab & Field<br>Testing Coordination</h3>
            <ul>
                <li>NABL-standard labs</li>
                <li>On-site field testing</li>
                <li>Sample collection & transport</li>
            </ul>
        </div>

        <div class="process-card">
            <div class="process-number">3</div>
            <h3>Advanced Testing Methods</h3>
            <p>We use:</p>
            <ul>
                <li>Modern lab equipment</li>
                <li>Digital testing tools</li>
                <li>Standardized procedures</li>
            </ul>
        </div>
    </div>

    <div class="process-grid two">
        <div class="process-card blue">
            <div class="process-number">4</div>
            <h3>Accurate Reports<br>& Analysis</h3>
            <ul>
                <li>Detailed test report</li>
                <li>Graphs & readings</li>
                <li>Compliance status</li>
                <li>Engineer-ready documentation</li>
            </ul>
        </div>

        <div class="process-card">
            <div class="process-number">5</div>
            <h3>Quality Assurance<br>Support</h3>
            <ul>
                <li>Suggestions based on results</li>
                <li>Risk identification</li>
                <li>Improvement recommendations</li>
            </ul>
        </div>
    </div>
</section>

<section class="testing-section">
    <h2 class="testing-title">Why Choose ConstructKaro for Construction Testing?</h2>
    <div class="testing-line"></div>

    <div class="why-wrap">
        <div class="why-item">
            <h3 class="orange">1. Verified Testing Professionals</h3>
            <p>No need to search for multiple vendors. From design to execution, everything is managed in one place.</p>
        </div>

        <div class="why-item">
            <h3 class="blue-text">2. Complete Construction Material Testing Support</h3>
            <p>From soil to structure, we cover all testing requirements under one platform.</p>
            <ul>
                <li>Budget</li>
                <li>Location</li>
                <li>Project type</li>
            </ul>
        </div>

        <div class="why-item">
            <h3 class="orange">3. High Accuracy & Standards</h3>
            <ul>
                <li>Industry-standard testing methods</li>
                <li>Reliable results</li>
                <li>Compliance-ready reports</li>
            </ul>
        </div>

        <div class="why-item">
            <h3 class="blue-text">4. Fast Turnaround Time</h3>
            <ul>
                <li>Quick sample collection</li>
                <li>Efficient testing process</li>
                <li>Timely report delivery</li>
            </ul>
        </div>

        <div class="why-item">
            <h3 class="orange">5. Suitable for All Projects</h3>
            <ul>
                <li>Residential construction</li>
                <li>Commercial buildings</li>
                <li>Industrial projects</li>
                <li>Infrastructure projects</li>
            </ul>
        </div>
    </div>
</section>

<section class="testing-section gray">
    <h2 class="testing-title">Frequently Asked Questions (FAQs)</h2>
    <div class="testing-line"></div>

    <div class="faq-wrap">
        @php
            $faqs = [
                'What is Construction Material Testing?' => 'Construction material testing checks the strength, quality, and suitability of materials used in construction.',
                'Why is construction testing important?' => 'It helps ensure safety, durability, compliance, and quality before and during construction.',
                'How much does construction testing cost?' => 'The cost depends on the type of material, number of tests, site location, and report requirements.',
                'What is NDT (Non-Destructive Testing)?' => 'NDT helps assess structural quality without damaging the existing structure.',
                'Do you provide lab and on-site testing?' => 'Yes, testing can be coordinated through lab testing and on-site field testing depending on requirement.',
                'How long does testing take?' => 'The timeline depends on the test type and sample requirements.',
                'Do you provide reports for engineers?' => 'Yes, test reports and documentation can be provided for engineering and compliance use.'
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

<section class="testing-section">
    <div class="footer-links">
        <h3>Our Other Services</h3>
        <p>Architect | Contractor | Interior Designer | Land Survey | BOQ / Estimation</p>

        <h3>Construction Testing Services Locations:</h3>
        <p>
            Construction Testing Services in Navi Mumbai | Construction Testing Services in Mumbai |
            Construction Testing Services in Thane | Construction Testing Services in Raigad |
            Construction Testing Services in Pune
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