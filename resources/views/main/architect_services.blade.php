@extends('layouts.app')

@section('title','Architect Services')

@section('content')

<style>
    body{
        font-family:"Poppins","Segoe UI",sans-serif;
        background:#f3f6fa;
        color:#222;
    }

    .ck-hero{
        min-height:430px;
        background:
            linear-gradient(90deg,rgba(0,0,0,.78) 0%,rgba(0,0,0,.55) 40%,rgba(0,0,0,.10) 100%),
            url("{{ asset('images/architect-banner.jpg') }}");
        background-size:cover;
        background-position:center;
        display:flex;
        align-items:center;
        padding:70px 7%;
    }

    .ck-hero h1{
        max-width:720px;
        color:#fff;
        font-size:52px;
        line-height:1.18;
        font-weight:900;
        text-shadow:0 4px 12px rgba(0,0,0,.45);
        margin:0;
    }

    .ck-section{
        padding:70px 7%;
        background:#fff;
    }

    .ck-section.gray{
        background:#f3f6fa;
    }

    .ck-title{
        text-align:center;
        font-size:36px;
        line-height:1.25;
        font-weight:900;
        margin:0;
        color:#151515;
    }

    .ck-line{
        width:140px;
        height:4px;
        margin:16px auto 35px;
        border-radius:30px;
        background:linear-gradient(90deg,#f25c05 0%,#f25c05 45%,#1e73be 45%,#1e73be 100%);
    }

    .ck-subtitle{
        text-align:center;
        font-size:17px;
        color:#666;
        font-weight:600;
        margin-bottom:38px;
    }

    .ck-content{
        max-width:1220px;
        margin:0 auto;
    }

    .ck-content p{
        font-size:18px;
        line-height:1.75;
        color:#555;
        margin-bottom:18px;
    }

    .ck-service-list{
        max-width:900px;
        margin:0 auto;
        display:grid;
        gap:16px;
    }

    .ck-service-item{
        background:#fff;
        border:1px solid #e1e5ea;
        border-radius:10px;
        padding:20px 24px;
        font-size:18px;
        font-weight:800;
        color:#4b4b4b;
        box-shadow:0 6px 18px rgba(0,0,0,.08);
    }

    .ck-cards{
        max-width:980px;
        margin:0 auto;
        display:grid;
        grid-template-columns:repeat(3,1fr);
        gap:50px;
    }

    .ck-card{
        min-height:185px;
        background:linear-gradient(135deg,#247fc6,#073b69);
        border-radius:18px;
        color:#fff;
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        text-align:center;
        padding:25px;
        box-shadow:0 12px 24px rgba(0,0,0,.25);
        transition:.25s;
    }

    .ck-card:hover{
        transform:translateY(-6px);
    }

    .ck-card-icon{
        width:62px;
        height:62px;
        object-fit:contain;
        margin-bottom:18px;
        filter:brightness(0) invert(1);
    }

    .ck-card h3{
        font-size:24px;
        line-height:1.25;
        font-weight:900;
        margin:0;
    }

    .ck-why{
        max-width:980px;
        margin:0 auto;
    }

    .ck-why-item{
        margin-bottom:30px;
    }

    .ck-why-item h3{
        font-size:27px;
        font-weight:900;
        margin-bottom:8px;
    }

    .ck-why-item p{
        font-size:18px;
        line-height:1.6;
        color:#555;
        margin:0;
    }

    .orange{
        color:#f25c05;
    }

    .blue{
        color:#1e73be;
    }

    .ck-footer-info{
        max-width:980px;
        margin:45px auto 0;
    }

    .ck-footer-info h3{
        font-size:26px;
        font-weight:900;
        margin:28px 0 8px;
    }

    .ck-footer-info p{
        font-size:18px;
        color:#555;
        line-height:1.6;
        margin:0;
    }

    @media(max-width:992px){
        .ck-hero{
            min-height:340px;
            padding:55px 25px;
        }

        .ck-hero h1{
            font-size:38px;
        }

        .ck-section{
            padding:55px 25px;
        }

        .ck-cards{
            grid-template-columns:1fr;
            gap:25px;
            max-width:360px;
        }
    }

    @media(max-width:576px){
        .ck-hero h1{
            font-size:28px;
        }

        .ck-title{
            font-size:25px;
        }

        .ck-content p,
        .ck-service-item,
        .ck-why-item p,
        .ck-footer-info p{
            font-size:15px;
        }

        .ck-why-item h3{
            font-size:21px;
        }
    }

    .accordion-item {
    background:#fff;
    border-radius:10px;
    margin-bottom:12px;
    overflow:hidden;
    box-shadow:0 6px 15px rgba(0,0,0,0.08);
}

.accordion-header {
    padding:18px 20px;
    font-weight:700;
    cursor:pointer;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.accordion-header:hover {
    background:#f5f7fb;
}

.accordion-body {
    max-height:0;
    overflow:hidden;
    padding:0 20px;
    font-size:15px;
    color:#555;
    transition:0.3s;
}

.accordion-item.active .accordion-body {
    max-height:200px;
    padding:15px 20px;
}

.icon {
    font-size:20px;
    font-weight:800;
    color:#1e73be;
}

.ck-hero{
    min-height:420px;
    display:flex;
    align-items:center;
    padding:70px 7%;
    
    background:
        linear-gradient(90deg, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.5) 40%, rgba(0,0,0,0.1) 100%),
        url("{{ asset('images/logo/a4.png') }}");

    background-size:cover;
    background-position:center;
}
</style>

<section class="ck-hero">
    <h1>
        Architect Services in<br>
        Navi Mumbai, Mumbai,<br>
        Thane, Pune & Raigad
    </h1>
</section>

<section class="ck-section">
    <h2 class="ck-title">Build Your Project with the Right Architectural Guidance</h2>
    <div class="ck-line"></div>

    <div class="ck-content">
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

<section class="ck-section gray">
    <h2 class="ck-title">Our Architect Services Include</h2>
    <div class="ck-line"></div>

    <p class="ck-subtitle">
        We help coordinate a wide range of architecture-related services, including:
    </p>

   <div class="ck-service-list">

    @php
        $services = [
            'Residential architectural planning' => 'Planning for houses, villas, and residential layouts with proper space utilization.',
            'Bungalow and villa design' => 'Custom bungalow and villa designs based on plot size, lifestyle, and budget.',
            'Apartment and flat layout planning' => 'Efficient flat layouts with ventilation, light, and functional design.',
            'Commercial building design' => 'Design for offices, shops, malls, and commercial spaces.',
            'Office and showroom planning' => 'Modern office and showroom layouts for business needs.',
            'Farmhouse design' => 'Farmhouse planning with landscape and open space concepts.',
            'Plot development planning' => 'Layout planning for plotting projects and land development.',
              // ✅ NEW ADDED (your screenshot)
            'Elevation and facade design' => 'Front elevation and facade design for modern and premium look.',
            'Floor plan design' => 'Detailed floor planning with proper space utilization.',
            'Space planning' => 'Smart space planning for better functionality and flow.',
            'Concept design' => 'Initial concept design based on your ideas and requirements.',
            'Renovation planning' => 'Planning for renovation and redesign of existing structures.',
            'Approval drawing support' => 'Support for municipal approval drawings and documentation.',
            'Submission drawing assistance' => 'Assistance in preparing drawings for submission process.',
            'Basic design consultation' => 'Consultation for design ideas, layout, and planning guidance.'
        ];
    @endphp

    @foreach($services as $title => $desc)
        <div class="accordion-item">
            <div class="accordion-header">
                {{ $title }}
                <span class="icon">+</span>
            </div>
            <div class="accordion-body">
                {{ $desc }}
            </div>
        </div>
    @endforeach

</div>
</section>

<section class="ck-section">
    <h2 class="ck-title">Who Can Use Our Architect Services</h2>
    <div class="ck-line"></div>

    <p class="ck-subtitle">
        ConstructKaro can help if you are looking for:
    </p>

    <div class="ck-cards">
        <div class="ck-card">
            <img class="ck-card-icon" src="{{ asset('images/logo/a1.png') }}" alt="2D Planning">
            <h3>2D +<br>Planning</h3>
        </div>

        <div class="ck-card">
            <img class="ck-card-icon" src="{{ asset('images/logo/a2.png') }}" alt="3D Elevation">
            <h3>3D +<br>Elevation</h3>
        </div>

        <div class="ck-card">
            <img class="ck-card-icon" src="{{ asset('images/logo/a3.png') }}" alt="Walkthrough">
            <h3>Walkthrough</h3>
        </div>
    </div>
</section>

<section class="ck-section gray">
    <h2 class="ck-title">Why Choose ConstructKaro for Architect Services</h2>
    <div class="ck-line"></div>

    <p class="ck-subtitle">
        Choosing ConstructKaro means getting a more organized way to begin your project.
    </p>

    <div class="ck-why">
        <div class="ck-why-item">
            <h3 class="orange">1. Easy Requirement Submission</h3>
            <p>You do not need to search endlessly for architects. Just share your requirement with us.</p>
        </div>

        <div class="ck-why-item">
            <h3 class="blue">2. Better Project Understanding</h3>
            <p>Our team first understands your location, property type, scope, and approximate budget.</p>
        </div>

        <div class="ck-why-item">
            <h3 class="orange">3. Suitable Architect Matching</h3>
            <p>Based on your requirement, we coordinate with architects who are suitable for your type of project.</p>
        </div>

        <div class="ck-why-item">
            <h3 class="blue">4. Time-Saving Process</h3>
            <p>Instead of approaching multiple people individually, you get a more guided and structured process.</p>
        </div>

        <div class="ck-why-item">
            <h3 class="orange">5. Multi-City Service Availability</h3>
            <p>We help customers looking for architect services in Navi Mumbai, Mumbai, Pune, Raigad, and Thane.</p>
        </div>
    </div>

    <div class="ck-footer-info">
        <h3>Architect Services Locations:</h3>
        <p>Navi Mumbai | Mumbai | Pune | Raigad | Thane</p>

        <h3>Our Other Services</h3>
        <p>Contractor Services | Interior Design Services | Survey Services | Testing Services | BOQ/Estimation Services</p>
    </div>
</section>
<script>
document.querySelectorAll('.accordion-header').forEach(item => {
    item.addEventListener('click', function () {

        let parent = this.parentElement;

        document.querySelectorAll('.accordion-item').forEach(el => {
            if (el !== parent) {
                el.classList.remove('active');
                el.querySelector('.icon').innerHTML = '+';
            }
        });

        parent.classList.toggle('active');

        let icon = this.querySelector('.icon');
        icon.innerHTML = parent.classList.contains('active') ? '-' : '+';
    });
});
</script>
@endsection