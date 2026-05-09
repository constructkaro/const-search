@extends('layouts.app')

@section('title', $service['title'] ?? 'Bungalow & Villa Design Services')

@section('content')

<style>
    :root{
        --bv-orange:#eb7424;
        --bv-orange-soft:#fff1e7;
        --bv-blue:#1f73b8;
        --bv-blue-soft:#edf6ff;
        --bv-dark:#1f2430;
        --bv-text:#555b66;
        --bv-muted:#6b7280;
        --bv-bg:#f3f4f6;
        --bv-white:#ffffff;
        --bv-border:#e5e7eb;
        --bv-shadow:0 16px 40px rgba(31,36,48,.10);
        --bv-shadow-sm:0 10px 24px rgba(31,36,48,.08);
    }

    .bv-page{
        font-family:"Poppins","Segoe UI",sans-serif;
        background:var(--bv-bg);
        color:var(--bv-dark);
        overflow:hidden;
    }

    .bv-container{
        width:100%;
        max-width:1240px;
        margin:0 auto;
        padding:0 20px;
    }

    .bv-section{
        padding:72px 0;
        background:var(--bv-bg);
    }

    .bv-section.white{
        background:#fff;
    }

    .bv-section.pt-small{
        padding-top:45px;
    }

    .bv-heading{
        max-width:1050px;
        margin:0 auto 12px;
        text-align:center;
        font-size:36px;
        line-height:1.25;
        font-weight:900;
        color:var(--bv-dark);
        letter-spacing:.2px;
    }

    .bv-title{
        max-width:1050px;
        margin:0 auto 12px;
        text-align:center;
        font-size:34px;
        line-height:1.25;
        font-weight:900;
        color:var(--bv-dark);
        letter-spacing:.2px;
    }

    .bv-underline{
        width:520px;
        max-width:75%;
        height:4px;
        margin:0 auto 34px;
        border-radius:100px;
        background:linear-gradient(90deg,var(--bv-orange) 0%,var(--bv-orange) 38%,var(--bv-blue) 100%);
    }

    .bv-content{
        max-width:1120px;
        margin:0 auto;
    }

    .bv-text{
        margin:0 0 20px;
        color:var(--bv-text);
        font-size:17px;
        line-height:1.8;
        font-weight:400;
    }

    .bv-text strong{
        color:#444a54;
        font-weight:800;
    }

    .bv-list{
        margin:6px 0 26px;
        padding:0;
        display:grid;
        grid-template-columns:repeat(2, minmax(0,1fr));
        gap:12px 18px;
        list-style:none;
    }

    .bv-list li{
        position:relative;
        padding:13px 16px 13px 42px;
        background:#fff;
        border:1px solid var(--bv-border);
        border-radius:14px;
        color:var(--bv-text);
        font-size:16px;
        line-height:1.45;
        box-shadow:0 8px 20px rgba(31,36,48,.05);
    }

    .bv-list li::before{
        content:"";
        position:absolute;
        left:16px;
        top:50%;
        width:9px;
        height:9px;
        border-radius:50%;
        background:var(--bv-orange);
        transform:translateY(-50%);
    }

    /* Hero */
    .bv-hero{
        position:relative;
        min-height:420px;
        display:flex;
        align-items:center;
        overflow:hidden;
        background:#111827;
    }

    .bv-hero-img{
        position:absolute;
        inset:0;
        width:100%;
        height:100%;
        object-fit:cover;
        z-index:1;
    }

    .bv-hero::after{
        content:"";
        position:absolute;
        inset:0;
        z-index:2;
        background:linear-gradient(90deg,rgba(0,0,0,.82) 0%,rgba(0,0,0,.65) 36%,rgba(0,0,0,.22) 68%,rgba(0,0,0,.05) 100%);
    }

    .bv-hero-content{
        position:relative;
        z-index:3;
        width:100%;
        max-width:1240px;
        margin:0 auto;
        padding:70px 20px;
    }

    .bv-hero-title{
        max-width:760px;
        margin:0;
        color:#fff;
        font-size:48px;
        line-height:1.22;
        font-weight:900;
        letter-spacing:.5px;
        text-shadow:0 6px 18px rgba(0,0,0,.45);
    }

    /* Intro Box */
    .bv-intro-box{
        background:#fff;
        border:1px solid var(--bv-border);
        border-radius:26px;
        padding:38px;
        box-shadow:var(--bv-shadow-sm);
    }

    /* Cards */
    .bv-card-grid{
        display:grid;
        grid-template-columns:repeat(2, minmax(0,1fr));
        gap:64px 42px;
        margin-top:48px;
    }

    .bv-plan-card{
        position:relative;
        min-height:365px;
        border-radius:24px;
        border:2px solid var(--bv-orange);
        background:var(--bv-orange-soft);
        padding:55px 28px 28px;
        box-shadow:var(--bv-shadow);
        transition:.25s ease;
    }

    .bv-plan-card:hover{
        transform:translateY(-6px);
    }

    .bv-plan-card.blue{
        border-color:var(--bv-blue);
        background:var(--bv-blue-soft);
    }

    .bv-card-badge{
        position:absolute;
        top:-25px;
        left:50%;
        transform:translateX(-50%);
        width:max-content;
        max-width:calc(100% - 50px);
        padding:12px 34px;
        border-radius:15px;
        background:var(--bv-orange);
        color:#fff;
        font-size:24px;
        line-height:1.15;
        font-weight:900;
        text-align:center;
        box-shadow:0 12px 24px rgba(235,116,36,.22);
        white-space:normal;
    }

    .bv-plan-card.blue .bv-card-badge{
        background:var(--bv-blue);
        box-shadow:0 12px 24px rgba(31,115,184,.22);
    }

    .bv-card-inner{
        display:grid;
        grid-template-columns:210px 1fr;
        gap:28px;
        align-items:center;
    }

    .bv-card-image{
        width:100%;
        height:250px;
        padding:10px;
        border-radius:14px;
        overflow:hidden;
        background:#fff;
        box-shadow:0 10px 22px rgba(31,36,48,.08);
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .bv-card-image img{
        width:100%;
        height:100%;
        object-fit:contain;
        display:block;
    }

    .bv-card-text{
        color:var(--bv-text);
        font-size:18px;
        line-height:1.55;
        font-weight:500;
    }

    .bv-card-text strong{
        color:#3f4652;
        font-weight:900;
    }

    /* Info Panels */
    .bv-info-card{
        background:#fff;
        border:1px solid var(--bv-border);
        border-radius:26px;
        padding:36px 38px;
        box-shadow:var(--bv-shadow-sm);
    }

    .bv-two-col{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:28px;
        margin-top:20px;
    }

    .bv-mini-card{
        background:#fff;
        border:1px solid var(--bv-border);
        border-radius:20px;
        padding:26px;
        box-shadow:var(--bv-shadow-sm);
        height:100%;
    }

    .bv-mini-card h3{
        margin:0 0 14px;
        font-size:22px;
        line-height:1.3;
        font-weight:900;
        color:var(--bv-dark);
    }

    .bv-mini-card.orange{
        border-top:5px solid var(--bv-orange);
    }

    .bv-mini-card.blue{
        border-top:5px solid var(--bv-blue);
    }

    /* Types */
    .bv-type-grid{
        display:grid;
        grid-template-columns:repeat(2,minmax(0,1fr));
        gap:22px;
        margin-top:28px;
    }

    .bv-type-block{
        background:#fff;
        border:1px solid var(--bv-border);
        border-radius:20px;
        padding:24px 26px;
        box-shadow:var(--bv-shadow-sm);
    }

    .bv-type-block.full{
        grid-column:1 / -1;
    }

    .bv-type-block h3{
        margin:0 0 8px;
        font-size:21px;
        font-weight:900;
        color:var(--bv-dark);
    }

    .bv-type-block p{
        margin:0;
        font-size:16px;
        line-height:1.7;
        color:var(--bv-text);
    }

    .bv-type-block.orange{
        border-left:5px solid var(--bv-orange);
    }

    .bv-type-block.blue{
        border-left:5px solid var(--bv-blue);
    }

    /* CTA */
    .bv-cta{
        background:linear-gradient(135deg,var(--bv-blue),#123f70);
        border-radius:28px;
        padding:42px 30px;
        text-align:center;
        box-shadow:var(--bv-shadow);
    }

    .bv-cta h2{
        margin:0 0 12px;
        color:#fff;
        font-size:32px;
        line-height:1.25;
        font-weight:900;
    }

    .bv-cta p{
        max-width:780px;
        margin:0 auto 24px;
        color:rgba(255,255,255,.88);
        font-size:17px;
        line-height:1.7;
    }

    .bv-cta-btn{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        padding:14px 28px;
        border-radius:999px;
        background:var(--bv-orange);
        color:#fff;
        font-weight:900;
        text-decoration:none;
        transition:.25s ease;
    }

    .bv-cta-btn:hover{
        background:#fff;
        color:var(--bv-blue);
        text-decoration:none;
    }

    @media(max-width:1100px){
        .bv-hero-title{
            font-size:40px;
        }

        .bv-card-grid{
            grid-template-columns:1fr;
            max-width:780px;
            margin-left:auto;
            margin-right:auto;
        }

        .bv-plan-card{
            min-height:auto;
        }
    }

    @media(max-width:768px){
        .bv-section{
            padding:52px 0;
        }

        .bv-hero{
            min-height:330px;
        }

        .bv-hero-content{
            padding:55px 18px;
        }

        .bv-hero-title{
            font-size:30px;
            line-height:1.3;
        }

        .bv-heading,
        .bv-title{
            font-size:26px;
        }

        .bv-underline{
            width:260px;
            margin-bottom:26px;
        }

        .bv-intro-box,
        .bv-info-card{
            padding:24px 18px;
            border-radius:20px;
        }

        .bv-text{
            font-size:15.5px;
            line-height:1.75;
        }

        .bv-list{
            grid-template-columns:1fr;
        }

        .bv-list li{
            font-size:15px;
            padding:12px 14px 12px 38px;
        }

        .bv-card-grid{
            gap:58px;
            margin-top:42px;
        }

        .bv-plan-card{
            padding:48px 18px 22px;
            border-radius:20px;
        }

        .bv-card-badge{
            top:-22px;
            font-size:18px;
            padding:10px 18px;
            max-width:calc(100% - 32px);
        }

        .bv-card-inner{
            grid-template-columns:1fr;
            gap:20px;
        }

        .bv-card-image{
            height:240px;
        }

        .bv-card-text{
            font-size:15.5px;
            line-height:1.7;
        }

        .bv-two-col,
        .bv-type-grid{
            grid-template-columns:1fr;
        }

        .bv-type-block.full{
            grid-column:auto;
        }

        .bv-mini-card,
        .bv-type-block{
            padding:22px 18px;
        }

        .bv-cta h2{
            font-size:25px;
        }

        .bv-cta p{
            font-size:15.5px;
        }
    }

    @media(max-width:480px){
        .bv-container{
            padding:0 14px;
        }

        .bv-hero-title{
            font-size:26px;
        }

        .bv-card-image{
            height:210px;
        }
    }
</style>

<div class="bv-page">

    {{-- HERO --}}
    <section class="bv-hero">
        <img
            class="bv-hero-img"
            src="{{ asset('images/logo/bv1.png') }}"
            onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1600&q=85'"
            alt="Bungalow and Villa Design Services"
        >

        <div class="bv-hero-content">
            <h1 class="bv-hero-title">
                Bungalow & Villa Design Services in<br>
                Navi Mumbai, Mumbai, Thane,<br>
                Pune & Raigad
            </h1>
        </div>
    </section>

    {{-- INTRO --}}
    <section class="bv-section white">
        <div class="bv-container">
            <div class="bv-intro-box">
                <h2 class="bv-heading">
                    Bungalow & Villa Design Services in Navi Mumbai, Mumbai, Pune, Raigad & Thane
                </h2>
                <div class="bv-underline"></div>

                <p class="bv-text">
                    At <strong>ConstructKaro</strong>, we help customers looking for professional
                    <strong>Bungalow & Villa Design Services in Navi Mumbai, Mumbai, Pune, Raigad, and Thane.</strong>
                    Whether you are planning a <strong>1 BHK bungalow, 2 BHK villa, 3 BHK bungalow, 4 BHK villa</strong>,
                    or a custom luxury home on your plot, we help simplify the process by connecting your requirement
                    with suitable architect partners.
                </p>

                <p class="bv-text">
                    ConstructKaro works as a service <strong>coordination platform and project intermediary.</strong>
                    We understand your requirement, review your project details, and connect you with the right architect
                    or design professional from our network. The actual work is carried out by relevant service partners
                    based on your project type, location, and design needs.
                </p>

                <p class="bv-text">
                    If you are planning a dream home with proper <strong>floor planning</strong>, smart
                    <strong>bedroom layouts</strong>, modern elevation concepts, or a spacious villa on a
                    <strong>guntha plot</strong>, ConstructKaro helps you begin in a more structured and guided way.
                </p>
            </div>
        </div>
    </section>

    {{-- ABOUT --}}
    <section class="bv-section">
        <div class="bv-container">
            <div class="bv-info-card">
                <h2 class="bv-title">About Our Bungalow & Villa Design Services</h2>
                <div class="bv-underline"></div>

                <p class="bv-text">
                    A bungalow or villa is more than just a structure. It is a space designed around lifestyle, comfort,
                    family needs, and future use. Good planning is important to make sure the home looks attractive while
                    also being practical for day-to-day living.
                </p>

                <p class="bv-text">
                    At ConstructKaro, our <strong>Bungalow & Villa Design Services</strong> are suitable for customers who want support for:
                </p>

                <ul class="bv-list">
                    <li>New bungalow design</li>
                    <li>New villa design</li>
                    <li>Custom residential architecture</li>
                    <li>Plot-based bungalow planning</li>
                    <li>Villa design on guntha plots</li>
                    <li>Duplex and multi-floor bungalow design</li>
                    <li>Modern and luxury villa concepts</li>
                    <li>Home renovation and redesign</li>
                    <li>Floor plan development</li>
                    <li>Bedroom and living space planning</li>
                </ul>

                <p class="bv-text">
                    Whether you are planning a compact home or a premium residence, proper design helps improve space usage,
                    natural light, ventilation, comfort, and the overall appearance of the property.
                </p>
            </div>
        </div>
    </section>

    {{-- DIFFERENT HOME TYPES --}}
    <section class="bv-section white">
        <div class="bv-container">
            <h2 class="bv-title">Bungalow & Villa Design for Different Home Types</h2>
            <div class="bv-underline"></div>

            <p class="bv-text" style="max-width:1000px;margin-left:auto;margin-right:auto;text-align:center;">
                Every family has different needs, and every plot has different possibilities. That is why bungalow and villa planning should be done according to space, budget, and lifestyle.
            </p>

            <div class="bv-card-grid">

                <div class="bv-plan-card">
                    <div class="bv-card-badge">1 BHK Bungalow Design</div>

                    <div class="bv-card-inner">
                        <!-- <div class="bv-card-image"> -->
                            <img
                                src="{{ asset('images/logo/bv2.png') }}"
                                onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1600566753376-12c8ab7fb75b?w=800&q=80'"
                                alt="1 BHK Bungalow Design"
                            >
                        <!-- </div> -->

                        <div class="bv-card-text">
                            A <strong>1 BHK bungalow design</strong> is ideal for compact plots, farmhouse concepts,
                            weekend homes, or small family living. It requires smart planning for the bedroom,
                            living room, kitchen, and circulation space so that the home feels open and functional.
                        </div>
                    </div>
                </div>

                <div class="bv-plan-card blue">
                    <div class="bv-card-badge">2 BHK Villa Design</div>

                    <div class="bv-card-inner">
                        <!-- <div class="bv-card-image"> -->
                            <img
                                 src="{{ asset('images/logo/bv3.png') }}"
                                onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1600607687644-c7171b42498f?w=800&q=80'"
                                alt="2 BHK Villa Design"
                            >
                        <!-- </div> -->

                        <div class="bv-card-text">
                            A <strong>2 BHK villa design</strong> is one of the most common choices for families who want
                            a practical and comfortable home. It allows better division of private and common spaces,
                            and can be planned as a single floor home or as part of a duplex concept.
                        </div>
                    </div>
                </div>

                <div class="bv-plan-card blue">
                    <div class="bv-card-badge">3 BHK Bungalow Design</div>

                    <div class="bv-card-inner">
                        <!-- <div class="bv-card-image"> -->
                            <img
                                 src="{{ asset('images/logo/bv4.png') }}"
                                onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&q=80'"
                                alt="3 BHK Bungalow Design"
                            >
                        <!-- </div> -->

                        <div class="bv-card-text">
                            A <strong>3 BHK bungalow design</strong> is suitable for growing families who need multiple
                            bedrooms, larger living areas, attached bathrooms, parking space, and better internal planning.
                            This type of design is often chosen for independent homes in suburban and plot-based developments.
                        </div>
                    </div>
                </div>

                <div class="bv-plan-card">
                    <div class="bv-card-badge">4 BHK Villa Design</div>

                    <div class="bv-card-inner">
                        <!-- <div class="bv-card-image"> -->
                            <img
                                src="{{ asset('images/logo/bv5.png') }}"
                                onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1600566752355-35792bedcfea?w=800&q=80'"
                                alt="4 BHK Villa Design"
                            >
                        <!-- </div> -->

                        <div class="bv-card-text">
                            A <strong>4 BHK villa design</strong> is ideal for larger families or customers looking for a
                            premium residential experience. These homes may include multiple floors, larger front elevation,
                            balconies, terraces, family lounges, and dedicated utility or guest spaces.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- PLOT SIZE + FLOOR --}}
    <section class="bv-section">
        <div class="bv-container">
            <div class="bv-two-col">
                <div class="bv-mini-card orange">
                    <h2 class="bv-title" style="font-size:28px;text-align:left;margin:0 0 10px;">Design Planning Based on Plot Size and Guntha</h2>
                    <p class="bv-text">
                        Plot size plays an important role in bungalow and villa planning. Many customers search for home design ideas according to plot dimensions or local land measurement units such as <strong>guntha.</strong>
                    </p>

                    <ul class="bv-list" style="grid-template-columns:1fr;">
                        <li>Bungalow design on 1 guntha plot</li>
                        <li>Villa design on 2 guntha plot</li>
                        <li>House planning on 3 guntha land</li>
                        <li>Compact bungalow design on small plots</li>
                        <li>Spacious villa design for larger residential plots</li>
                    </ul>
                </div>

                <div class="bv-mini-card blue">
                    <h2 class="bv-title" style="font-size:28px;text-align:left;margin:0 0 10px;">Floor Planning for Bungalows & Villas</h2>
                    <p class="bv-text">
                        A good floor plan decides how the home will function every day and how each room will connect with the others.
                    </p>

                    <ul class="bv-list" style="grid-template-columns:1fr;">
                        <li>Ground floor and first floor planning</li>
                        <li>Duplex floor layout</li>
                        <li>Staircase placement</li>
                        <li>Living, dining and kitchen positioning</li>
                        <li>Bedroom, bathroom, balcony and terrace concepts</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- BEDROOM PLANNING --}}
    <section class="bv-section white">
        <div class="bv-container">
            <div class="bv-info-card">
                <h2 class="bv-title">Bedroom Planning in Bungalow & Villa Design</h2>
                <div class="bv-underline"></div>

                <p class="bv-text">
                    The bedroom is one of the most important areas in any home, especially in bungalow and villa projects.
                    Good bedroom planning improves comfort, privacy, and overall usability of the house.
                </p>

                <p class="bv-text">
                    ConstructKaro helps customers looking for designs that consider:
                </p>

                <ul class="bv-list">
                    <li>Master bedroom size and layout</li>
                    <li>Children’s bedroom planning</li>
                    <li>Guest bedroom arrangement</li>
                    <li>Attached toilet layout</li>
                    <li>Wardrobe and storage space</li>
                    <li>Bedroom ventilation and window placement</li>
                    <li>Balcony access from bedroom</li>
                    <li>Bedroom positioning for privacy</li>
                </ul>

                <p class="bv-text">
                    Whether it is a 2 bedroom bungalow, 3 bedroom villa, or 4 bedroom luxury home, the design should match
                    the family’s living pattern and comfort needs.
                </p>
            </div>
        </div>
    </section>

    {{-- TYPES --}}
    <section class="bv-section">
        <div class="bv-container">
            <h2 class="bv-title">Types of Bungalow & Villa Designs We Help With</h2>
            <div class="bv-underline"></div>

            <div class="bv-type-grid">
                <div class="bv-type-block orange">
                    <h3>Modern Bungalow Design</h3>
                    <p>Modern bungalow designs focus on clean lines, open layouts, practical room planning, and a simple yet attractive exterior.</p>
                </div>

                <div class="bv-type-block blue">
                    <h3>Luxury Villa Design</h3>
                    <p>Luxury villas are designed with spacious bedrooms, premium floor layouts, balconies, landscape space, and elegant elevation concepts.</p>
                </div>

                <div class="bv-type-block blue">
                    <h3>Duplex Bungalow Design</h3>
                    <p>A duplex bungalow design helps separate living and private spaces across two floors, making it ideal for medium to large families.</p>
                </div>

                <div class="bv-type-block orange">
                    <h3>Multi-Floor Villa Design</h3>
                    <p>Multi-floor villa design is suitable for customers who want larger built-up areas on limited land with bedrooms, lounges, terraces, and utility areas.</p>
                </div>

                <div class="bv-type-block orange full">
                    <h3>Guntha Plot Bungalow Design</h3>
                    <p>Customers with land measured in guntha often need plot-specific design planning. Proper layout helps balance construction area, open space, setbacks, and future scope.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <!-- <section class="bv-section white">
        <div class="bv-container">
            <div class="bv-cta">
                <h2>Planning a Bungalow or Villa?</h2>
                <p>
                    Share your plot size, location, budget, and design requirement. ConstructKaro will help you start with a more structured planning process.
                </p>
                <a href="{{ url('/') }}" class="bv-cta-btn">Post Your Requirement</a>
            </div>
        </div>
    </section> -->

</div>

@endsection