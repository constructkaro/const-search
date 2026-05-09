@extends('layouts.app')

@section('title', $service['title'] ?? 'Apartment & Flat Layout Planning Services')

@section('content')

<style>
    :root{
        --af-orange:#eb7424;
        --af-blue:#1f73b8;
        --af-dark:#1f2430;
        --af-text:#555b66;
        --af-bg:#f3f4f6;
        --af-white:#ffffff;
        --af-border:#e5e7eb;
        --af-shadow:0 16px 40px rgba(31,36,48,.10);
        --af-shadow-sm:0 10px 24px rgba(31,36,48,.08);
    }

    .af-page{
        font-family:"Poppins","Segoe UI",sans-serif;
        background:var(--af-bg);
        color:var(--af-dark);
        overflow:hidden;
    }

    .af-container{
        width:100%;
        max-width:1280px;
        margin:0 auto;
        padding:0 20px;
    }

    .af-section{
        padding:72px 0;
        background:var(--af-bg);
    }

    .af-section.white{
        background:#ffffff;
    }

    .af-title{
        max-width:1120px;
        margin:0 auto 12px;
        text-align:center;
        font-size:34px;
        line-height:1.25;
        font-weight:900;
        color:var(--af-dark);
    }

    .af-subtitle{
        max-width:980px;
        margin:0 auto 30px;
        text-align:center;
        font-size:16px;
        line-height:1.8;
        color:var(--af-text);
    }

    .af-line{
        width:420px;
        max-width:75%;
        height:4px;
        margin:0 auto 32px;
        border-radius:100px;
        background:linear-gradient(90deg,var(--af-orange) 0%,var(--af-orange) 38%,var(--af-blue) 100%);
    }

    .af-text{
        margin:0 0 18px;
        color:var(--af-text);
        font-size:16px;
        line-height:1.8;
        font-weight:400;
    }

    .af-text strong{
        color:#444a54;
        font-weight:800;
    }

    /* HERO */
    .af-hero{
        position:relative;
        min-height:390px;
        display:flex;
        align-items:center;
        background:#111827;
        overflow:hidden;
    }

    .af-hero-img{
        position:absolute;
        inset:0;
        width:100%;
        height:100%;
        object-fit:cover;
        z-index:1;
    }

    .af-hero::after{
        content:"";
        position:absolute;
        inset:0;
        z-index:2;
        background:linear-gradient(
            90deg,
            rgba(0,0,0,.82) 0%,
            rgba(0,0,0,.62) 38%,
            rgba(0,0,0,.18) 70%,
            rgba(0,0,0,.03) 100%
        );
    }

    .af-hero-content{
        position:relative;
        z-index:3;
        width:100%;
        max-width:1280px;
        margin:0 auto;
        padding:68px 20px;
    }

    .af-hero-title{
        max-width:800px;
        margin:0;
        color:#fff;
        font-size:44px;
        line-height:1.22;
        font-weight:900;
        text-shadow:0 6px 16px rgba(0,0,0,.42);
    }

    /* INTRO BOX */
    .af-box{
        background:#fff;
        border:1px solid var(--af-border);
        border-radius:24px;
        padding:36px;
        box-shadow:var(--af-shadow-sm);
    }

    /* SERVICE IMAGE CARDS ONLY */
    .af-service-image-grid{
        display:grid;
        grid-template-columns:repeat(3, minmax(0, 1fr));
        gap:32px;
        margin-top:35px;
    }

    .af-service-image-card{
        width:100%;
        height:270px;
        border-radius:22px;
        overflow:hidden;
        background:#ffffff;
        border:3px solid var(--af-orange);
        box-shadow:var(--af-shadow);
        transition:all .3s ease;
    }

    .af-service-image-card.blue{
        border-color:var(--af-blue);
    }

    .af-service-image-card:hover{
        transform:translateY(-6px);
        box-shadow:0 22px 50px rgba(31,36,48,.18);
    }

    .af-service-image-card img{
        width:100%;
        height:100%;
        object-fit:cover;
        display:block;
    }

    /* LAYOUT OPTIONS */
    .af-layout-grid{
        display:grid;
        grid-template-columns:repeat(4,minmax(0,1fr));
        gap:28px;
        margin-top:28px;
    }

    .af-layout-card{
        background:linear-gradient(180deg,#1971bc 0%,#0f518e 100%);
        border-radius:22px;
        padding:18px 16px 20px;
        box-shadow:var(--af-shadow);
        text-align:center;
        color:#fff;
        transition:.25s ease;
    }

    .af-layout-card:hover{
        transform:translateY(-6px);
    }

    .af-layout-img{
        width:100%;
        height:190px;
        background:#fff;
        border-radius:12px;
        display:flex;
        align-items:center;
        justify-content:center;
        overflow:hidden;
        margin-bottom:16px;
        padding:10px;
    }

    .af-layout-img img{
        width:100%;
        height:100%;
        object-fit:cover;
        display:block;
        border-radius:8px;
    }

    .af-layout-card h3{
        margin:0;
        font-size:17px;
        line-height:1.35;
        font-weight:900;
        color:#fff;
    }

    /* WHY CHOOSE */
    .af-why-grid{
        display:grid;
        grid-template-columns:repeat(3,minmax(0,1fr));
        gap:22px 28px;
        margin-top:26px;
    }

    .af-why-item{
        background:#fff;
        border:1px solid var(--af-border);
        border-radius:16px;
        padding:20px;
        box-shadow:var(--af-shadow-sm);
        font-size:15px;
        line-height:1.5;
        color:var(--af-text);
        font-weight:700;
    }

    .af-why-item span{
        color:#3f4652;
        font-weight:800;
    }

    .af-area-box{
        background:#fff;
        border:1px solid var(--af-border);
        border-radius:20px;
        padding:24px 26px;
        box-shadow:var(--af-shadow-sm);
        margin-top:28px;
    }

    .af-area-box p{
        margin:0;
        font-size:15.5px;
        line-height:1.8;
        color:var(--af-text);
    }

    /* FAQ */
    .af-faq-wrap{
        max-width:1120px;
        margin:0 auto;
    }

    .af-faq-item{
        background:#fff;
        border-radius:16px;
        margin-bottom:18px;
        box-shadow:0 8px 18px rgba(0,0,0,.12);
        overflow:hidden;
    }

    .af-faq-btn{
        width:100%;
        background:#fff;
        border:none;
        padding:22px 26px;
        font-size:18px;
        line-height:1.4;
        font-weight:800;
        color:#111827;
        text-align:left;
        display:flex;
        justify-content:space-between;
        align-items:center;
        cursor:pointer;
    }

    .af-faq-btn span:last-child{
        font-size:26px;
        color:var(--af-blue);
        font-weight:900;
        margin-left:20px;
    }

    .af-faq-body{
        max-height:0;
        overflow:hidden;
        transition:max-height .3s ease;
        padding:0 26px;
    }

    .af-faq-item.active .af-faq-body{
        max-height:220px;
        padding:0 26px 22px;
    }

    .af-faq-body p{
        margin:0;
        font-size:15.5px;
        line-height:1.8;
        color:var(--af-text);
    }

    @media(max-width:1100px){
        .af-hero-title{
            font-size:38px;
        }

        .af-service-image-grid{
            grid-template-columns:repeat(2,1fr);
        }

        .af-layout-grid{
            grid-template-columns:repeat(2,minmax(0,1fr));
        }

        .af-why-grid{
            grid-template-columns:repeat(2,minmax(0,1fr));
        }
    }

    @media(max-width:768px){
        .af-section{
            padding:52px 0;
        }

        .af-hero{
            min-height:320px;
        }

        .af-hero-content{
            padding:54px 18px;
        }

        .af-hero-title{
            font-size:30px;
            line-height:1.3;
        }

        .af-title{
            font-size:26px;
        }

        .af-subtitle,
        .af-text{
            font-size:15px;
        }

        .af-line{
            width:260px;
            margin-bottom:24px;
        }

        .af-box{
            padding:24px 18px;
            border-radius:20px;
        }

        .af-service-image-grid{
            grid-template-columns:1fr;
            gap:24px;
        }

        .af-service-image-card{
            height:250px;
            border-radius:18px;
        }

        .af-layout-grid,
        .af-why-grid{
            grid-template-columns:1fr;
        }

        .af-layout-img{
            height:210px;
        }

        .af-faq-btn{
            font-size:16px;
            padding:20px 18px;
        }

        .af-faq-body{
            padding:0 18px;
        }

        .af-faq-item.active .af-faq-body{
            padding:0 18px 20px;
        }
    }

    @media(max-width:480px){
        .af-container{
            padding:0 14px;
        }

        .af-hero-title{
            font-size:26px;
        }

        .af-service-image-card{
            height:220px;
        }
    }

    .af-only-images-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 32px;
    margin-top: 35px;
    align-items: center;
}

.af-only-images-grid img {
    width: 100%;
    height: 270px;
    object-fit: contain;
    display: block;
}

/* Tablet */
@media (max-width: 991px) {
    .af-only-images-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 28px;
    }

    .af-only-images-grid img {
        height: 250px;
    }
}

/* Mobile */
@media (max-width: 575px) {
    .af-only-images-grid {
        grid-template-columns: 1fr;
        gap: 22px;
    }

    .af-only-images-grid img {
        height: auto;
        max-height: 300px;
    }
}
</style>

<div class="af-page">

    {{-- HERO --}}
    <section class="af-hero">
        <img
            class="af-hero-img"
            src="{{ asset('images/architecture/apartment-layout-banner.jpg') }}"
            onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1494526585095-c41746248156?w=1600&q=85'"
            alt="Apartment and Flat Layout Planning Services"
        >

        <div class="af-hero-content">
            <h1 class="af-hero-title">
                Apartment & Flat Layout<br>
                Planning Services in<br>
                Navi Mumbai, Mumbai, Thane,<br>
                Pune & Raigad
            </h1>
        </div>
    </section>

    {{-- INTRO --}}
    <section class="af-section white">
        <div class="af-container">
            <div class="af-box">
                <h2 class="af-title">
                    Apartment & Flat Layout Planning Services in Navi Mumbai, Mumbai, Raigad, Thane & Pune
                </h2>
                <div class="af-line"></div>

                <p class="af-text">
                    Planning your apartment layout is the most important step before construction or interior work begins.
                    At <strong>ConstructKaro</strong>, we provide expert <strong>Apartment Layout Planning</strong> and
                    <strong>Flat Layout Planning</strong> services to help you design functional, spacious, and future-ready homes.
                </p>

                <p class="af-text">
                    Whether you're designing a <strong>1 BHK, 2 BHK, 3 BHK, or 4 BHK apartment</strong>,
                    our expert architects and planners ensure that every inch of your space is utilized efficiently
                    with proper ventilation, lighting, and modern design principles.
                </p>
            </div>
        </div>
    </section>

    {{-- OUR SERVICES - IMAGE ONLY CARDS --}}
   {{-- OUR SERVICES - ONLY IMAGES --}}
<section class="af-section">
    <div class="af-container">
        <h2 class="af-title">Our Apartment & Flat Layout Planning Services</h2>
        <div class="af-line"></div>

        <p class="af-subtitle">
            At ConstructKaro, we connect you with experienced architects who specialize in:
        </p>

        <div class="af-only-images-grid">

            <img
                src="{{ asset('images/logo/af2.png') }}"
                onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=900&q=85'"
                alt="Space Optimization Planning"
            >

            <img
                src="{{ asset('images/logo/af3.png') }}"
                onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1484154218962-a197022b5858?w=900&q=85'"
                alt="Functional Room Planning"
            >

            <img
                src="{{ asset('images/logo/af4.png') }}"
                onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1494526585095-c41746248156?w=900&q=85'"
                alt="Vastu Compliant Layouts"
            >

            <img
                src="{{ asset('images/logo/af5.png') }}"
                onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=900&q=85'"
                alt="Furniture Friendly Layout Design"
            >

            <img
                src="{{ asset('images/logo/af6.png') }}"
                onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1484154218962-a197022b5858?w=900&q=85'"
                alt="Ventilation and Lighting Planning"
            >

            <img
                src="{{ asset('images/logo/af7.png') }}"
                onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1494526585095-c41746248156?w=900&q=85'"
                alt="Future Ready Planning"
            >

        </div>
    </div>
</section>

    {{-- LAYOUT OPTIONS --}}
    <section class="af-section white">
        <div class="af-container">
            <h2 class="af-title">Apartment Layout Options We Design</h2>
            <div class="af-line"></div>

            <div class="af-layout-grid">

                <div class="af-layout-card">
                    <div class="af-layout-img">
                        <img
                            src="{{ asset('images/architecture/1-bedroom-apartment-plan.jpg') }}"
                            onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1560185007-c5ca9d2c014d?w=800&q=85'"
                            alt="1 Bedroom Apartment Layout"
                        >
                    </div>
                    <h3>1 Bedroom Apartment House Floor Layout Plans</h3>
                </div>

                <div class="af-layout-card">
                    <div class="af-layout-img">
                        <img
                            src="{{ asset('images/architecture/2-bedroom-apartment-plan.jpg') }}"
                            onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800&q=85'"
                            alt="2 Bedroom Apartment Layout"
                        >
                    </div>
                    <h3>2 Bedroom Apartment House Floor Layout Plans</h3>
                </div>

                <div class="af-layout-card">
                    <div class="af-layout-img">
                        <img
                            src="{{ asset('images/architecture/3-bedroom-apartment-plan.jpg') }}"
                            onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=800&q=85'"
                            alt="3 Bedroom Apartment Layout"
                        >
                    </div>
                    <h3>3 Bedroom Apartment House Floor Layout Plans</h3>
                </div>

                <div class="af-layout-card">
                    <div class="af-layout-img">
                        <img
                            src="{{ asset('images/architecture/4-bedroom-apartment-plan.jpg') }}"
                            onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800&q=85'"
                            alt="4 Bedroom Apartment Layout"
                        >
                    </div>
                    <h3>4 Bedroom Apartment House Floor Layout Plans</h3>
                </div>

            </div>
        </div>
    </section>

    {{-- WHY CHOOSE --}}
    <section class="af-section">
        <div class="af-container">
            <h2 class="af-title">Why Choose ConstructKaro?</h2>
            <div class="af-line"></div>

            <div class="af-why-grid">
                <div class="af-why-item">✔ <span>Verified Architects & Designers</span></div>
                <div class="af-why-item">✔ <span>Location-Based Expert Allocation</span></div>
                <div class="af-why-item">✔ <span>End-to-End Planning Support</span></div>
                <div class="af-why-item">✔ <span>Fast Turnaround Time</span></div>
                <div class="af-why-item">✔ <span>Cost-Effective Design Solutions</span></div>
                <div class="af-why-item">✔ <span>Support for Construction & Execution</span></div>
            </div>

            <div class="af-area-box">
                <p>
                    <strong>Areas we serve:</strong><br>
                    Apartment Layout Planning in Navi Mumbai |
                    Apartment Layout Planning in Mumbai |
                    Apartment Layout Planning in Raigad |
                    Apartment Layout Planning in Thane |
                    Apartment Layout Planning in Pune
                </p>
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="af-section white">
        <div class="af-container">
            <h2 class="af-title">Frequently Asked Questions (FAQs)</h2>
            <div class="af-line"></div>

            <div class="af-faq-wrap">

                <div class="af-faq-item">
                    <button type="button" class="af-faq-btn">
                        <span>1. What is apartment layout planning?</span>
                        <span>+</span>
                    </button>
                    <div class="af-faq-body">
                        <p>
                            Apartment layout planning means organizing rooms, circulation, furniture flow,
                            utility zones, ventilation, and natural light in a way that makes the flat practical,
                            comfortable, and efficient.
                        </p>
                    </div>
                </div>

                <div class="af-faq-item">
                    <button type="button" class="af-faq-btn">
                        <span>2. How much does flat layout planning cost?</span>
                        <span>+</span>
                    </button>
                    <div class="af-faq-body">
                        <p>
                            Cost depends on apartment size, number of layout options, design complexity,
                            and whether you need only layout planning or full architectural and interior support.
                        </p>
                    </div>
                </div>

                <div class="af-faq-item">
                    <button type="button" class="af-faq-btn">
                        <span>3. Can I get multiple layout options?</span>
                        <span>+</span>
                    </button>
                    <div class="af-faq-body">
                        <p>
                            Yes, multiple apartment layout options can be developed so you can compare space usage,
                            circulation, room positions, and furniture planning before finalizing the best one.
                        </p>
                    </div>
                </div>

                <div class="af-faq-item">
                    <button type="button" class="af-faq-btn">
                        <span>4. Do you provide 1 BHK to 4 BHK layout designs?</span>
                        <span>+</span>
                    </button>
                    <div class="af-faq-body">
                        <p>
                            Yes. ConstructKaro can help customers looking for 1 BHK, 2 BHK, 3 BHK,
                            and 4 BHK apartment and flat layout planning services depending on project size
                            and family requirements.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.af-faq-btn').forEach(function(button) {
            button.addEventListener('click', function () {
                let item = this.closest('.af-faq-item');

                document.querySelectorAll('.af-faq-item').forEach(function(otherItem) {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');

                        let sign = otherItem.querySelector('.af-faq-btn span:last-child');
                        if (sign) {
                            sign.textContent = '+';
                        }
                    }
                });

                item.classList.toggle('active');

                let sign = item.querySelector('.af-faq-btn span:last-child');
                if (sign) {
                    sign.textContent = item.classList.contains('active') ? '−' : '+';
                }
            });
        });
    });
</script>

@endsection