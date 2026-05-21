@extends('layouts.app')

@section('title','Architect Services')

@section('content')

<style>
    :root{
        --ck-orange:#f25c05;
        --ck-blue:#1e73be;
        --ck-navy:#1c2c3e;
        --ck-text:#4b5563;
        --ck-soft:#f3f6fa;
        --ck-white:#ffffff;
        --ck-border:#e5eaf0;
    }

    body{
        font-family:"Poppins","Segoe UI",sans-serif;
        background:var(--ck-soft);
        color:#222;
    }

    /* HERO */
    .arch-hero{
        min-height:420px;
        display:flex;
        align-items:center;
        padding:70px 7%;
        background:
            linear-gradient(90deg,rgba(0,0,0,.72) 0%,rgba(0,0,0,.45) 45%,rgba(0,0,0,.10) 100%),
            url("{{ asset('images/logo/a4.png') }}");
        background-size:cover;
        background-position:center;
    }

    .arch-hero h1{
        max-width:720px;
        color:#fff;
        font-size:52px;
        line-height:1.18;
        font-weight:900;
        text-shadow:0 4px 12px rgba(0,0,0,.45);
        margin:0;
    }

    /* COMMON SECTION */
    .arch-section{
        padding:70px 7%;
        background:var(--ck-white);
        text-align:center;
    }

    .arch-section.gray{
        background:var(--ck-soft);
    }

    .arch-title{
        font-size:34px;
        line-height:1.25;
        font-weight:900;
        color:var(--ck-navy);
        margin:0;
    }

    .arch-line{
        width:80px;
        height:4px;
        background:var(--ck-orange);
        margin:15px auto 28px;
        border-radius:50px;
    }

    .arch-subtitle{
        max-width:820px;
        margin:0 auto 38px;
        font-size:17px;
        color:#667085;
        line-height:1.7;
    }

    .arch-content{
        max-width:1180px;
        margin:0 auto;
    }

    .arch-content p{
        font-size:17px;
        line-height:1.85;
        color:#555;
        margin:0 0 16px;
    }

    /* SERVICE BUTTONS */
    .arch-service-list{
        max-width:1180px;
        margin:0 auto;
        display:grid;
        grid-template-columns:1fr;
        gap:10px;
        text-align:left;
    }

    .arch-service-button{
        min-height:46px;
        display:flex;
        align-items:center;
        justify-content:flex-start;
        background:#ffeadc;
        border:1px solid #c9c9c9;
        border-radius:6px;
        padding:10px 12px;
        box-shadow:0 2px 5px rgba(28,44,62,.18);
        color:#4d5661;
        font-size:16px;
        font-weight:800;
        line-height:1.25;
        text-decoration:none;
        transition:background-color .22s ease, border-color .22s ease, color .22s ease, transform .22s ease;
    }

    .arch-service-button:hover{
        transform:translateY(-1px);
        background:#ffe0cc;
        border-color:var(--ck-orange);
        color:var(--ck-navy);
        text-decoration:none;
    }

    /* WHO CAN USE CARDS */
    .arch-use-cards{
        display:grid;
        grid-template-columns:repeat(3,1fr);
        gap:32px;
        max-width:900px;
        margin:0 auto;
        align-items:start;
    }

    .arch-use-card{
        background:transparent;
        border:0;
        border-radius:0;
        overflow:visible;
        box-shadow:none;
        transition:all .3s ease;
        text-align:center;
    }

    .arch-use-card:hover{
        transform:translateY(-6px);
    }

    .arch-use-img-box{
        width:100%;
        aspect-ratio:1274 / 1094;
        border-radius:16px;
        overflow:visible;
    }

    .arch-use-img{
        width:100%;
        height:auto;
        aspect-ratio:1274 / 1094;
        object-fit:contain;
        display:block;
        filter:drop-shadow(0 14px 18px rgba(28,44,62,.16));
    }

    .arch-use-content{
        padding:22px 18px 26px;
    }

    .arch-use-content h3{
        font-size:22px;
        font-weight:900;
        color:var(--ck-navy);
        margin:0 0 8px;
        line-height:1.25;
    }

    .arch-use-content p{
        margin:0;
        color:#667085;
        font-size:15px;
        line-height:1.6;
    }

    /* WHY CHOOSE */
    .arch-why{
        max-width:1180px;
        margin:0 auto;
        text-align:left;
    }

    .arch-why-item{
        margin-bottom:28px;
    }

    .arch-why-item h3{
        font-size:25px;
        font-weight:900;
        margin:0 0 8px;
    }

    .arch-why-item p{
        font-size:17px;
        line-height:1.7;
        color:#555;
        margin:0;
    }

    .orange{
        color:var(--ck-orange);
    }

    .blue{
        color:var(--ck-blue);
    }

    .arch-footer-info{
        max-width:1180px;
        margin:45px auto 0;
        text-align:left;
    }

    .arch-footer-info h3{
        font-size:24px;
        font-weight:900;
        margin:28px 0 8px;
        color:var(--ck-navy);
    }

    .arch-footer-info p{
        font-size:17px;
        color:#555;
        line-height:1.7;
        margin:0;
    }

    @media(max-width:992px){
        .arch-hero{
            min-height:340px;
            padding:55px 25px;
        }

        .arch-hero h1{
            font-size:38px;
        }

        .arch-section{
            padding:55px 25px;
        }

        .arch-use-cards{
            grid-template-columns:repeat(2,1fr);
        }
    }

    @media(max-width:576px){
        .arch-hero{
            min-height:300px;
            padding:45px 18px;
        }

        .arch-hero h1{
            font-size:28px;
        }

        .arch-title{
            font-size:25px;
        }

        .arch-subtitle{
            font-size:15px;
        }

        .arch-content p,
        .arch-why-item p,
        .arch-footer-info p{
            font-size:15px;
        }

        .arch-use-cards{
            grid-template-columns:1fr;
            gap:22px;
        }

        .arch-service-button{
            min-height:42px;
            padding:9px 10px;
            font-size:14px;
        }

        .arch-use-cards{
            max-width:320px;
        }

        .arch-use-img-box{
            height:auto;
        }

        .arch-why-item h3{
            font-size:21px;
        }
    }
</style>

<section class="arch-hero">
    <h1>
        Architect Services in<br>
        Navi Mumbai, Mumbai,<br>
        Thane, Pune & Raigad
    </h1>
</section>

<section class="arch-section">
    <h2 class="arch-title">Build Your Project with the Right Architectural Guidance</h2>
    <div class="arch-line"></div>

    <div class="arch-content">
        <p>
            <strong>ConstructKaro</strong> helps customers connect with the right architectural professionals
            for residential, commercial, and redevelopment projects across
            <strong>Navi Mumbai, Mumbai, Thane, Pune, and Raigad.</strong>
        </p>

        <p>
            Whether you are planning a new bungalow, apartment renovation, commercial space,
            plotting layout, farmhouse, villa, office, or redevelopment project, finding the right
            architect can be confusing. That is where <strong>ConstructKaro</strong> comes in.
        </p>

        <p>
            We work as a <strong>service coordination platform</strong> that understands your project
            requirements and helps you connect with suitable architectural professionals based on your
            location, budget, and project type.
        </p>
    </div>
</section>

<section class="arch-section gray">
    <h2 class="arch-title">Our Architect Services Include</h2>
    <div class="arch-line"></div>

    <p class="arch-subtitle">
        We help coordinate a wide range of architecture-related services, including:
    </p>

    @php
        $services = [
            [
                'title' => 'Residential architectural planning',
                'slug' => 'residential-architectural-planning',
                'desc' => 'Planning for houses, villas, and residential layouts with proper space utilization.',
            ],
            [
                'title' => 'Bungalow and villa design',
                'slug' => 'bungalow-and-villa-design',
                'desc' => 'Custom bungalow and villa designs based on plot size, lifestyle, and budget.',
            ],
            [
                'title' => 'Apartment and flat layout planning',
                'slug' => 'apartment-flat-layout-planning',
                'desc' => 'Efficient flat layouts with ventilation, light, and functional design.',
            ],
            [
                'title' => 'Commercial building design',
                'slug' => 'commercial-building-design',
                'desc' => 'Design for offices, shops, malls, and commercial spaces.',
            ],
            [
                'title' => 'Office planning',
                'slug' => 'office-and-showroom-planning',
                'desc' => 'Modern office layouts for business needs.',
            ],
            [
                'title' => 'Showroom planning',
                'slug' => 'showroom-planning',
                'desc' => 'Modern showroom layouts for business needs.',
            ],
            [
                'title' => 'Farmhouse design',
                'slug' => 'farmhouse-design',
                'desc' => 'Farmhouse planning with landscape and open space concepts.',
            ],
            [
                'title' => 'Plot development planning',
                'slug' => 'plot-development-planning',
                'desc' => 'Layout planning for plotting projects and land development.',
            ],
            [
                'title' => 'Elevation and facade design',
                'slug' => 'elevation-and-facade-design',
                'desc' => 'Front elevation and facade design for modern and premium look.',
            ],
            [
                'title' => 'Floor plan design',
                'slug' => 'floor-plan-design',
                'desc' => 'Detailed floor planning with proper space utilization.',
            ],
            [
                'title' => 'Space planning',
                'slug' => 'space-planning',
                'desc' => 'Smart space planning for better functionality and flow.',
            ],
            [
                'title' => 'Concept design',
                'slug' => 'concept-design',
                'desc' => 'Initial concept design based on your ideas and requirements.',
            ],
            [
                'title' => 'Renovation planning',
                'slug' => 'renovation-planning',
                'desc' => 'Planning for renovation and redesign of existing structures.',
            ],
            [
                'title' => 'Approval drawing support',
                'slug' => 'approval-drawing-support',
                'desc' => 'Support for municipal approval drawings and documentation.',
            ],
            [
                'title' => 'Submission drawing assistance',
                'slug' => 'submission-drawing-assistance',
                'desc' => 'Assistance in preparing drawings for submission process.',
            ],
            [
                'title' => 'Basic design consultation',
                'slug' => 'basic-design-consultation',
                'desc' => 'Consultation for design ideas, layout, and planning guidance.',
            ],
        ];
    @endphp

    <div class="arch-service-list">
        @foreach($services as $service)
            <a href="{{ route('architectural.service.details', $service['slug']) }}" class="arch-service-button">
                <span>{{ $service['title'] }}</span>
            </a>
        @endforeach
    </div>
</section>

<section class="arch-section">
    <h2 class="arch-title">Who Can Use Our Architect Services</h2>
    <div class="arch-line"></div>

    <p class="arch-subtitle">
        ConstructKaro can help if you are looking for:
    </p>

    <div class="arch-use-cards">

        <div class="arch-use-card">
            <div class="arch-use-img-box">
                <img
                    class="arch-use-img"
                    src="{{ asset('images/logo/as1.png') }}"
                    alt="2D Planning"
                >
            </div>

            
        </div>

        <div class="arch-use-card">
            <div class="arch-use-img-box">
                <img
                    class="arch-use-img"
                    src="{{ asset('images/logo/as2.png') }}"
                    alt="Architectural Walkthrough"
                >
            </div>

         
        </div>

        <div class="arch-use-card">
            <div class="arch-use-img-box">
                <img
                    class="arch-use-img"
                    src="{{ asset('images/logo/as3.png') }}"
                    alt="3D Elevation"
                >
            </div>

        </div>

    </div>
</section>

<section class="arch-section gray">
    <h2 class="arch-title">Why Choose ConstructKaro for Architect Services</h2>
    <div class="arch-line"></div>

    <p class="arch-subtitle">
        Choosing ConstructKaro means getting a more organized way to begin your project.
    </p>

    <div class="arch-why">
        <div class="arch-why-item">
            <h3 class="orange">1. Easy Requirement Submission</h3>
            <p>You do not need to search endlessly for architects. Just share your requirement with us.</p>
        </div>

        <div class="arch-why-item">
            <h3 class="blue">2. Better Project Understanding</h3>
            <p>Our team first understands your location, property type, scope, and approximate budget.</p>
        </div>

        <div class="arch-why-item">
            <h3 class="orange">3. Suitable Architect Matching</h3>
            <p>Based on your requirement, we coordinate with architects who are suitable for your type of project.</p>
        </div>

        <div class="arch-why-item">
            <h3 class="blue">4. Time-Saving Process</h3>
            <p>Instead of approaching multiple people individually, you get a more guided and structured process.</p>
        </div>

        <div class="arch-why-item">
            <h3 class="orange">5. Multi-City Service Availability</h3>
            <p>We help customers looking for architect services in Navi Mumbai, Mumbai, Pune, Raigad, and Thane.</p>
        </div>
    </div>

    <div class="arch-footer-info">
        <h3>Architect Services Locations:</h3>
        <p>Navi Mumbai | Mumbai | Pune | Raigad | Thane</p>

        <h3>Our Other Services</h3>
        <p>Contractor Services | Interior Design Services | Survey Services | Testing Services | BOQ/Estimation Services</p>
    </div>
</section>

@endsection
