@extends('layouts.app')

@section('title', 'Structural Audit Services')

@section('content')

<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  /* ═══════════════════════════════════════════════════
     HERO — full viewport width, image background with text overlay
  ═══════════════════════════════════════════════════ */
  .sa-hero-wrap {
    position: relative;
    width: 100vw;
    left: 50%;
    transform: translateX(-50%);
    overflow: hidden;
    min-height: 380px;
  }

  .sa-hero {
    position: relative;
    width: 100%;
    min-height: 380px;
    display: flex;
    align-items: center;
  }

  /* Full background image */
  .sa-hero-bg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center center;
    display: block;
    z-index: 0;
  }

  /* Dark gradient overlay only on the LEFT side so text is readable */
  .sa-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
      to right,
      rgba(0, 0, 0, 0.82) 0%,
      rgba(0, 0, 0, 0.60) 35%,
      rgba(0, 0, 0, 0.10) 65%,
      rgba(0, 0, 0, 0.00) 100%
    );
    z-index: 1;
  }

  /* Text sits above overlay */
 .sa-hero-text {
    position: relative;
    z-index: 2;
    padding: 65px 12px 46px 77px;
    max-width: 560px;
}

  .sa-hero-text h1 {
    font-size: 40px;
    font-weight: 900;
    color: #ffffff;
    line-height: 1.16;
    letter-spacing: -0.5px;
    font-family: 'Segoe UI', Arial, sans-serif;
    text-shadow: 0 2px 12px rgba(0,0,0,0.4);
  }

  /* ═══════════════════════════════
     COMMON SECTION WRAPPER
  ═══════════════════════════════ */
  .sa-section {
    background: #f0f0f0;
    padding: 48px 80px;
  }

  .sa-inner {
    max-width: 1320px;
    margin: 0 auto;
  }

  /* ═══════════════════════════════
     HEADINGS & DOUBLE UNDERLINE
  ═══════════════════════════════ */
  .sa-title {
    font-size: 28px;
    font-weight: 900;
    color: #111;
    margin-bottom: 10px;
    line-height: 1.2;
    font-family: 'Segoe UI', Arial, sans-serif;
  }
  .sa-title.center { text-align: center; }

  .sa-underline {
    display: flex;
    margin-bottom: 26px;
  }
  .sa-underline.center { justify-content: center; }
  .sa-underline span   { height: 3px; display: block; border-radius: 2px; }
  .ul-orange           { background: #e87c2f; width: 80px; }
  .ul-blue             { background: #1a3a6b; width: 80px; }

  .sa-subtitle {
    font-size: 15px;
    color: #444;
    text-align: center;
    margin-bottom: 32px;
    font-weight: 400;
  }
  .sa-subtitle.bold { font-weight: 700; color: #111; }

  /* ═══════════════════════════════
     INTRO
  ═══════════════════════════════ */
  .sa-intro-title {
    font-size: 20px;
    font-weight: 900;
    color: #111;
    text-align: center;
    margin-bottom: 8px;
    font-family: 'Segoe UI', Arial, sans-serif;
  }
  .sa-intro-text {
    font-size: 15px;
    color: #333;
    line-height: 1.78;
    margin-bottom: 14px;
  }

  /* ═══════════════════════════════
     WHAT IS
  ═══════════════════════════════ */
  .sa-what-title {
    font-size: 30px;
    font-weight: 900;
    color: #111;
    text-align: center;
    margin-bottom: 10px;
    font-family: 'Segoe UI', Arial, sans-serif;
  }
  .sa-what-text {
    font-size: 15px;
    color: #333;
    line-height: 1.78;
    margin-bottom: 14px;
  }

  /* ═══════════════════════════════
     SERVICE CARDS
  ═══════════════════════════════ */
  .sa-cards-top {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 22px;
    margin-bottom: 22px;
  }

  .sa-cards-bottom {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 22px;
    max-width: 66.5%;
    margin: 0 auto;
  }

  .sa-card {
    border-radius: 16px;
    overflow: hidden;
    background: #fff;
    border: 2px solid transparent;
    box-shadow: 0 2px 14px rgba(0,0,0,0.07);
    transition: transform .22s ease, box-shadow .22s ease;
  }
  .sa-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.13);
  }
  .sa-card.blue   { border-color: #4a90c4; }
  .sa-card.orange { border-color: #e87c2f; }

  .sa-card img {
    width: 100%;
    height: 215px;
    object-fit: cover;
    display: block;
  }

  .sa-card-label {
    padding: 15px 14px;
    font-size: 31px;
    font-weight: 800;
    color: #111;
    text-align: center;
    line-height: 1.35;
    background: #fff;
    font-family: 'Segoe UI', Arial, sans-serif;
  }
  .sa-card.orange .sa-card-label { background: #fff5ee; }

  /* ═══════════════════════════════
     TESTING METHODS
  ═══════════════════════════════ */
  .sa-test-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 14px;
    margin-bottom: 18px;
  }

  .sa-test-card {
    background: #fff;
    border-radius: 14px;
    padding: 18px 14px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.06);
  }

  .sa-test-title {
    font-size: 14px;
    font-weight: 800;
    color: #111;
    margin-bottom: 10px;
    line-height: 1.3;
    font-family: 'Segoe UI', Arial, sans-serif;
  }

  .sa-test-card ul { list-style: none; padding: 0; }
  .sa-test-card ul li {
    font-size: 13px;
    color: #444;
    padding-left: 14px;
    position: relative;
    line-height: 1.5;
  }
  .sa-test-card ul li::before {
    content: '·';
    position: absolute;
    left: 0;
    font-size: 20px;
    color: #555;
    top: -4px;
  }

  .sa-test-note {
    text-align: center;
    font-size: 14px;
    font-weight: 700;
    color: #111;
    margin-top: 6px;
  }

  /* ═══════════════════════════════
     WHY IMPORTANT
  ═══════════════════════════════ */
  .sa-why-title {
    font-size: 34px;
    font-weight: 900;
    font-style: italic;
    color: #111;
    text-align: center;
    margin-bottom: 10px;
    font-family: 'Segoe UI', Arial, sans-serif;
  }

  .sa-why-list { list-style: none; padding: 0; }
  .sa-why-list li {
    font-size: 15px;
    color: #111;
    padding: 5px 0 5px 18px;
    position: relative;
  }
  .sa-why-list li::before {
    content: '·';
    position: absolute;
    left: 0;
    font-size: 22px;
    color: #333;
    line-height: 1.4;
  }

  /* ═══════════════════════════════
     LOCATIONS
  ═══════════════════════════════ */
  .sa-loc-text  { font-size: 15px; color: #111; line-height: 1.75; margin-bottom: 12px; }
  .sa-loc-title { font-size: 16px; font-weight: 900; color: #111; margin-bottom: 6px; font-family: 'Segoe UI', Arial, sans-serif; }
  .sa-loc-links { font-size: 15px; color: #111; line-height: 1.8; }

  /* ═══════════════════════════════
     RESPONSIVE
  ═══════════════════════════════ */
  @media (max-width: 1100px) {
    .sa-test-grid { grid-template-columns: repeat(3, 1fr); }
  }

  @media (max-width: 860px) {
    .sa-hero-text { padding: 40px 28px; }
    .sa-hero-text h1 { font-size: 28px; }
    .sa-section { padding: 32px 24px; }
    .sa-cards-top { grid-template-columns: 1fr 1fr; }
    .sa-cards-bottom { max-width: 100%; grid-template-columns: 1fr 1fr; }
    .sa-test-grid { grid-template-columns: repeat(2, 1fr); }
  }

  @media (max-width: 560px) {
    .sa-hero-wrap { min-height: 260px; }
    .sa-hero { min-height: 260px; }
    .sa-hero-text h1 { font-size: 22px; }
    .sa-hero-text { padding: 28px 20px; }
    .sa-section { padding: 24px 16px; }
    .sa-cards-top,
    .sa-cards-bottom { grid-template-columns: 1fr; max-width: 100%; }
    .sa-test-grid { grid-template-columns: 1fr; }
    .sa-why-title { font-size: 26px; }
  }
</style>

{{-- ═══════════════════════════════════════════════════
     HERO — full width image with text overlay
═══════════════════════════════════════════════════ --}}
<div class="sa-hero-wrap">
  <div class="sa-hero">
    {{-- Background image --}}
    <img
      class="sa-hero-bg"
      src="{{ asset('images/logo/st1.png') }}"
      onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=1600&q=85'"
      alt="Structural Audit Engineer at Construction Site"
    >
    {{-- Text overlay --}}
    <div class="sa-hero-text">
      <h1>Structural Audit Services in<br>Navi Mumbai, Mumbai,<br>Thane, Pune &amp; Raigad</h1>
    </div>
  </div>
</div>

{{-- ═══════════════════════════════
     INTRO
═══════════════════════════════ --}}
<div class="sa-section" style="padding-bottom: 0;">
  <div class="sa-inner">
    <h2 class="sa-intro-title">Civil Contractor Services in Navi Mumbai, Mumbai, Raigad, Thane &amp; Pune</h2>
    <div class="sa-underline center" style="margin-top:10px;">
      <span class="ul-orange"></span><span class="ul-blue"></span>
    </div>
    <p class="sa-intro-text">
      Ensuring the safety and longevity of your building is not just a requirement — it's a responsibility.
      At ConstructKaro, we provide reliable and professional Structural Audit Services to help property
      owners, housing societies, and businesses understand the real condition of their structures.
    </p>
    <p class="sa-intro-text">
      With increasing age, environmental exposure, and usage load, every building undergoes wear and tear.
      Cracks, corrosion, leakage, and material degradation can gradually weaken the structure. A proper
      structural audit helps detect these issues early and provides a clear roadmap for repair,
      strengthening, and maintenance.
    </p>
    <p class="sa-intro-text">
      Whether you own a residential building, commercial property, or industrial facility, our structural
      audit services are designed to ensure safety, compliance, and long-term durability.
    </p>
  </div>
</div>

{{-- ═══════════════════════════════
     WHAT IS STRUCTURAL AUDIT
═══════════════════════════════ --}}
<div class="sa-section">
  <div class="sa-inner">
    <h2 class="sa-what-title">What is Structural Audit?</h2>
    <div class="sa-underline center">
      <span class="ul-orange"></span><span class="ul-blue"></span>
    </div>
    <p class="sa-what-text">
      A structural audit is a systematic evaluation of a building's condition to assess its strength,
      stability, and safety. It involves detailed inspection, testing, and analysis of structural
      elements such as columns, beams, slabs, foundations, and load-bearing components.
    </p>
    <p class="sa-what-text">
      The objective of a structural audit is not just to identify visible defects but also to detect
      hidden structural weaknesses that may lead to serious problems in the future.
    </p>
    <p class="sa-what-text">
      At ConstructKaro, our approach is practical and execution-focused. We don't just provide
      reports — we help you understand the problem and guide you toward the right solution.
    </p>
  </div>
</div>

{{-- ═══════════════════════════════
     OUR STRUCTURAL AUDIT SERVICES
═══════════════════════════════ --}}
<div class="sa-section" style="padding-top: 0;">
  <div class="sa-inner">
    <h2 class="sa-title center">Our Structural Audit Services</h2>
    <div class="sa-underline center">
      <span class="ul-orange"></span><span class="ul-blue"></span>
    </div>
    <p class="sa-subtitle">We offer complete civil works services across residential, commercial, and infrastructure projects.</p>

    <div class="sa-cards-top">
      <div class="sa-card blue">
        <img src="{{ asset('images/logo/st2.png') }}"
             onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=600&q=80'"
             alt="Residential Structural Audit">
        <div class="sa-card-label">Residential Structural<br>Audit</div>
      </div>
      <div class="sa-card orange">
        <img src="{{ asset('images/logo/st3.png') }}"
             onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=600&q=80'"
             alt="Commercial Structural Audit">
        <div class="sa-card-label">Commercial<br>Structural Audit</div>
      </div>
      <div class="sa-card blue">
        <img src="{{ asset('images/logo/st4.png') }}"
             onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1581094480313-b95a8aeaa13f?w=600&q=80'"
             alt="Industrial Structural Audit">
        <div class="sa-card-label">Industrial Structural<br>Audit</div>
      </div>
    </div>

    <div class="sa-cards-bottom">
      <div class="sa-card orange">
        <img src="{{ asset('images/logo/st5.png') }}"
             onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=600&q=80'"
             alt="Pre-Purchase Structural Audit">
        <div class="sa-card-label">Pre-Purchase Structural<br>Audit</div>
      </div>
      <div class="sa-card blue">
        <img src="{{ asset('images/logo/st6.png') }}"
             onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80'"
             alt="Renovation Structural Audit">
        <div class="sa-card-label">Renovation &amp; Repair<br>Structural Audit</div>
      </div>
    </div>
  </div>
</div>

{{-- ═══════════════════════════════
     TESTING & INSPECTION METHODS
═══════════════════════════════ --}}
<div class="sa-section" style="padding-top: 0;">
  <div class="sa-inner">
    <h2 class="sa-title center">Testing &amp; Inspection Methods</h2>
    <div class="sa-underline center">
      <span class="ul-orange"></span><span class="ul-blue"></span>
    </div>
    <p class="sa-subtitle">
      To ensure accuracy and reliability, we use a combination of visual inspection and advanced testing techniques:
    </p>

    <div class="sa-test-grid">
      <div class="sa-test-card">
        <div class="sa-test-title">Visual Inspection &amp; Crack Mapping</div>
        <ul><li>Identifying surface defects and structural distress</li></ul>
      </div>
      <div class="sa-test-card">
        <div class="sa-test-title">Rebound Hammer Test</div>
        <ul><li>Evaluating concrete strength</li></ul>
      </div>
      <div class="sa-test-card">
        <div class="sa-test-title">Ultrasonic Pulse Velocity (UPV) Test</div>
        <ul><li>Detecting internal flaws and cracks</li></ul>
      </div>
      <div class="sa-test-card">
        <div class="sa-test-title">Core Cutting Test</div>
        <ul><li>Checking actual concrete quality</li></ul>
      </div>
      <div class="sa-test-card">
        <div class="sa-test-title">Half Cell Potential Test</div>
        <ul><li>Identifying corrosion in reinforcement</li></ul>
      </div>
    </div>

    <p class="sa-test-note">These tests help in creating a detailed and accurate assessment of the structure's health</p>
  </div>
</div>

{{-- ═══════════════════════════════
     WHY STRUCTURAL AUDIT IS IMPORTANT
═══════════════════════════════ --}}
<div class="sa-section">
  <div class="sa-inner">
    <h2 class="sa-why-title">Why Structural Audit is Important</h2>
    <div class="sa-underline center">
      <span class="ul-orange"></span><span class="ul-blue"></span>
    </div>
    <p class="sa-subtitle bold">
      Structural audit is not just a technical process it is a preventive measure that can save lives and reduce major repair costs.
    </p>
    <ul class="sa-why-list">
      <li>Identifies hidden structural damage before it becomes critical</li>
      <li>Ensures safety of residents, employees, and users</li>
      <li>Helps comply with municipal regulations and safety norms</li>
      <li>Prevents unexpected structural failures</li>
      <li>Extends the life of the building</li>
      <li>Improves property value and reliability</li>
    </ul>
  </div>
</div>

{{-- ═══════════════════════════════
     SERVICE LOCATIONS
═══════════════════════════════ --}}
<div class="sa-section" style="padding-top: 0;">
  <div class="sa-inner">
    <p class="sa-loc-text">
      In cities like Mumbai and surrounding regions, structural audits are often mandatory for older
      buildings, making it an essential part of property management.
    </p>
    <p class="sa-loc-title">Service Locations:</p>
    <p class="sa-loc-text">ConstructKaro provides structural audit services across:</p>
    <p class="sa-loc-links">
      structural audit services Navi Mumbai | structural audit services &nbsp;Mumbai |
      structural audit services &nbsp;Raigad | structural audit services &nbsp;Thane |
      structural audit services Pune
    </p>
  </div>
</div>

@endsection
