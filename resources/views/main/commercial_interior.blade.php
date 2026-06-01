@extends('layouts.app')

@section('title', 'Commercial Interior Design')

@section('content')

<style>
    body{font-family:"Poppins","Segoe UI",sans-serif;background:#f7f7f7;color:#222;font-size:18px}

    .ci-hero{
        min-height:320px;
        background:linear-gradient(90deg,rgba(0,0,0,.55),rgba(0,0,0,.2)), url("{{ asset('images/services/commercial-banner.png') }}");
        background-size:cover;background-position:center;display:flex;align-items:center;padding:60px 7%;
    }

    .ci-hero h1{color:#fff;font-size:56px;line-height:1.1;font-weight:900;margin:0;max-width:980px;text-shadow:0 6px 18px rgba(0,0,0,.45)}

    .ci-section{padding:60px 7%;background:#f7f7f7}
    .ci-section.white{background:#fff}

    .ci-title{text-align:center;font-size:44px;font-weight:900;margin:0 0 10px;color:#111}
    .ci-sub{font-size:22px;text-align:center;color:#555;margin-bottom:30px;font-weight:700}
    .ci-line{width:200px;height:5px;background:linear-gradient(90deg,#f37021,#1e73be);margin:18px auto 34px;border-radius:30px}

    .services-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;max-width:1200px;margin:0 auto}
    .svc-card{background:#fff;border-radius:14px;padding:26px;box-shadow:0 8px 18px rgba(0,0,0,.08);text-align:center}
    .svc-card h4{font-size:22px;margin:8px 0 6px;font-weight:800}
    .svc-card p{font-size:18px;color:#555;margin:0}

    .types-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;max-width:1300px;margin:30px auto}
    .type-card{background:#fff;border-radius:10px;overflow:hidden;box-shadow:0 6px 14px rgba(0,0,0,.08)}
    .type-card img{width:100%;height:140px;object-fit:cover;display:block}
    .type-card h5{font-size:18px;padding:12px;font-weight:900;margin:0;color:#111}

    .process{max-width:1100px;margin:30px auto;font-size:20px}
    .process ol{padding-left:20px}
    .process li{margin:12px 0;font-weight:700}

    .why-list{max-width:1100px;margin:20px auto}
    .why-list h3{font-size:26px;margin-bottom:8px}
    .why-list p{font-size:18px;color:#555}

    .faq-wrap{max-width:1100px;margin:30px auto}
    .faq-item{background:#fff;border-radius:10px;margin-bottom:12px;overflow:hidden;box-shadow:0 6px 12px rgba(0,0,0,.06)}
    .faq-q{padding:18px 22px;font-size:18px;font-weight:800;display:flex;justify-content:space-between;cursor:pointer}
    .faq-a{padding:0 22px 18px;font-size:17px;color:#444;display:none}

    @media(max-width:1100px){.types-grid{grid-template-columns:repeat(2,1fr)}.services-grid{grid-template-columns:1fr 1fr}}
    @media(max-width:768px){.ci-hero h1{font-size:34px}.types-grid{grid-template-columns:1fr}.services-grid{grid-template-columns:1fr}}
</style>

<section class="ci-hero">
    <h1>Commercial Interior Design Services in Navi Mumbai, Mumbai, Pune & Thane</h1>
</section>

<section class="ci-section white">
    <h2 class="ci-title">Complete Commercial Interior Solutions</h2>
    <div class="ci-line"></div>
    <p class="ci-sub">End-to-end commercial interiors — offices, retail, hospitality, restaurants and showrooms</p>

    <div class="services-grid">
        <div class="svc-card">
            <img src="{{ asset('images/logo/i2.png') }}" alt="" style="height:120px;object-fit:contain">
            <h4>Office Interior Design</h4>
            <p>Space planning, workstations, meeting rooms & MEP coordination</p>
        </div>

        <div class="svc-card">
            <img src="{{ asset('images/logo/i3.png') }}" alt="" style="height:120px;object-fit:contain">
            <h4>Retail & Showroom Design</h4>
            <p>Customer flow, merchandising and brand-aligned interiors</p>
        </div>

        <div class="svc-card">
            <img src="{{ asset('images/logo/i4.png') }}" alt="" style="height:120px;object-fit:contain">
            <h4>Restaurant & Hospitality</h4>
            <p>Ambience design, seating planning and service-friendly layouts</p>
        </div>
    </div>
</section>

<section class="ci-section">
    <h2 class="ci-title">Types of Commercial Projects</h2>
    <div class="ci-line"></div>
    <div class="types-grid">
        <div class="type-card"><img src="{{ asset('images/services/type-office.jpg') }}" alt=""><h5>Office Interior Design</h5></div>
        <div class="type-card"><img src="{{ asset('images/services/type-retail.jpg') }}" alt=""><h5>Retail & Showroom</h5></div>
        <div class="type-card"><img src="{{ asset('images/services/type-hospitality.jpg') }}" alt=""><h5>Restaurant & Hospitality</h5></div>
        <div class="type-card"><img src="{{ asset('images/services/type-complex.jpg') }}" alt=""><h5>Commercial Complexes</h5></div>
    </div>
</section>

<section class="ci-section white">
    <h2 class="ci-title">Why Commercial Interior Design Matters</h2>
    <div class="ci-line"></div>
    <div class="why-list">
        <h3>Increase Productivity & Brand Experience</h3>
        <p>Well-designed commercial spaces improve staff productivity, enhance customer engagement and support operational efficiency.</p>
    </div>

    <div class="process">
        <h3 style="font-size:22px;font-weight:900">Our Process</h3>
        <ol>
            <li>Requirement & site assessment</li>
            <li>Concept design & space planning</li>
            <li>3D visualization & material selection</li>
            <li>BOQ, tendering & vendor selection</li>
            <li>Execution supervision & handover</li>
        </ol>
    </div>
</section>

<section class="ci-section">
    <h2 class="ci-title">Frequently Asked Questions</h2>
    <div class="ci-line"></div>

    <div class="faq-wrap">
        <div class="faq-item">
            <div class="faq-q">What types of commercial spaces do you design?<span>+</span></div>
            <div class="faq-a">We design offices, retail showrooms, restaurants, hospitality spaces and multi-use commercial complexes.</div>
        </div>

        <div class="faq-item">
            <div class="faq-q">Do you provide turnkey commercial interior solutions?<span>+</span></div>
            <div class="faq-a">Yes — from design to procurement and execution with supervision and quality checks.</div>
        </div>

        <div class="faq-item">
            <div class="faq-q">Can you provide 3D visualizations before execution?<span>+</span></div>
            <div class="faq-a">We provide 3D renders and walkthroughs to help you visualize the final outcome.</div>
        </div>
    </div>
</section>

<script>
    document.querySelectorAll('.faq-q').forEach(function(q){
        q.addEventListener('click', function(){
            const a = this.nextElementSibling;
            const open = a.style.display === 'block';
            document.querySelectorAll('.faq-a').forEach(function(el){el.style.display='none';});
            document.querySelectorAll('.faq-q span').forEach(function(s){s.innerText='+'});
            a.style.display = open ? 'none' : 'block';
            this.querySelector('span').innerText = open ? '+' : '-';
        });
    });
</script>

@endsection
