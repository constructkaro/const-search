@extends('layouts.app')

@section('title', 'Who We Are | ConstructKaro')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    .who-we-are-page {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to bottom, #f7f8fb 0%, #f3f5f9 100%);
        padding: 50px 0 70px;
    }

    .who-container {
        max-width: 1180px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .who-topbar {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-bottom: 20px;
    }

    .back-btn {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #ff7a1a, #f25c05);
        color: #fff;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        box-shadow: 0 10px 22px rgba(242, 92, 5, 0.22);
        transition: all 0.3s ease;
        font-size: 20px;
        font-weight: 600;
    }

    .back-btn:hover {
        transform: translateY(-3px);
        color: #fff;
        box-shadow: 0 14px 26px rgba(242, 92, 5, 0.28);
    }

    .who-hero {
        text-align: center;
        margin-bottom: 35px;
    }

    .who-badge {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 50px;
        background: rgba(242, 92, 5, 0.08);
        color: #f25c05;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 0.3px;
        margin-bottom: 14px;
    }

    .section-title {
        font-size: 48px;
        line-height: 1.2;
        font-weight: 800;
        color: #1c2c3e;
        margin-bottom: 14px;
    }

    .section-subtitle {
        max-width: 760px;
        margin: 0 auto;
        font-size: 16px;
        line-height: 1.9;
        color: #667085;
    }

    .title-line {
        width: 130px;
        height: 4px;
        margin: 18px auto 0;
        border-radius: 50px;
        background: linear-gradient(to right, #1c2c3e 0%, #f25c05 100%);
    }

    .about-card {
        position: relative;
        background: #fff;
        border-radius: 24px;
        padding: 38px 38px 30px;
        box-shadow: 0 18px 50px rgba(28, 44, 62, 0.08);
        border: 1px solid rgba(28, 44, 62, 0.05);
        overflow: hidden;
    }

    .about-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(to right, #1c2c3e, #f25c05);
    }

    .about-card p {
        font-size: 17px;
        line-height: 1.95;
        color: #4f5d6b;
        margin-bottom: 18px;
    }

    .about-card p:last-child {
        margin-bottom: 0;
    }

    .highlight {
        font-weight: 700;
        color: #1c2c3e;
    }

    .highlight-orange {
        font-weight: 700;
        color: #f25c05;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
        margin-top: 30px;
    }

    .info-box {
        background: #fff;
        border-radius: 18px;
        padding: 24px 22px;
        box-shadow: 0 10px 28px rgba(28, 44, 62, 0.06);
        border: 1px solid rgba(28, 44, 62, 0.05);
        position: relative;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .info-box::before {
        content: "";
        position: absolute;
        left: 0;
        top: 18px;
        bottom: 18px;
        width: 4px;
        border-radius: 20px;
        background: linear-gradient(to bottom, #f25c05, #ff9d57);
    }

    .info-box:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 32px rgba(28, 44, 62, 0.10);
    }

    .info-box h4 {
        font-size: 20px;
        font-weight: 700;
        color: #1c2c3e;
        margin: 0 0 10px 0;
        padding-left: 12px;
    }

    .info-box p {
        margin: 0;
        padding-left: 12px;
        font-size: 15px;
        line-height: 1.8;
        color: #667085;
    }

    @media (max-width: 991px) {
        .section-title {
            font-size: 38px;
        }

        .about-card {
            padding: 30px 24px 24px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767px) {
        .who-we-are-page {
            padding: 35px 0 50px;
        }

        .who-container {
            padding: 0 15px;
        }

        .who-topbar {
            margin-bottom: 14px;
        }

        .back-btn {
            width: 42px;
            height: 42px;
            font-size: 18px;
        }

        .section-title {
            font-size: 30px;
        }

        .section-subtitle {
            font-size: 14px;
            line-height: 1.8;
        }

        .about-card p {
            font-size: 15px;
            line-height: 1.9;
        }

        .info-box h4 {
            font-size: 18px;
        }

        .info-box p {
            font-size: 14px;
        }
    }
</style>

<section class="who-we-are-page">
    <div class="who-container">

        <div class="who-topbar">
            <a href="{{ url()->previous() }}" class="back-btn" aria-label="Go Back">←</a>
        </div>

        <div class="who-hero">
            <span class="who-badge">About ConstructKaro</span>
            <h1 class="section-title">Who We Are</h1>
            <p class="section-subtitle">
                A structured construction services and execution platform built to simplify how projects begin, move, and get delivered with clarity.
            </p>
            <div class="title-line"></div>
        </div>

        <div class="about-card">
            <p>
                ConstructKaro is a <span class="highlight">construction services and execution platform in India</span>
                that provides a <span class="highlight-orange">structured and guided way</span> to start and complete construction projects.
            </p>

            <p>
                Built from real on-ground experience across residential, commercial, and industrial construction,
                ConstructKaro solves one of the biggest industry challenges —
                <span class="highlight">lack of a clear and reliable system</span> to begin and manage construction work.
            </p>

            <p>
                Today, most projects depend on
                <span class="highlight">phone calls, references, and unstructured coordination</span>,
                leading to confusion and delays. ConstructKaro changes this by creating a
                <span class="highlight-orange">single, organized, execution-driven system</span>.
            </p>

            <p>
                Customers simply select services like
                <span class="highlight">contractor, architect, interior, survey, testing, or BOQ/estimation</span>
                and submit their requirements through a structured process.
            </p>

            <p>
                Our team evaluates each project, defines the right approach, and assigns
                <span class="highlight">verified professionals</span>,
                removing the need for guesswork.
            </p>

            <p>
                From planning to execution, we ensure
                <span class="highlight-orange">clarity, control, and accountability</span>
                at every step.
            </p>

            <p>
                Unlike traditional platforms, we focus on
                <span class="highlight">real project execution</span> — not just listings.
            </p>

            <p>
                Currently operating across
                <span class="highlight">Navi Mumbai, Mumbai, Thane, Raigad, and Pune</span>,
                ConstructKaro is building India’s construction execution layer.
            </p>
        </div>

        <div class="info-grid">
            <div class="info-box">
                <h4>Structured Process</h4>
                <p>Step-by-step guided system for every project from requirement to execution.</p>
            </div>

            <div class="info-box">
                <h4>Verified Experts</h4>
                <p>Right professionals are assigned based on service suitability and project needs.</p>
            </div>

            <div class="info-box">
                <h4>Execution Focus</h4>
                <p>We help ensure projects are planned properly and delivered with accountability.</p>
            </div>
        </div>

    </div>
</section>
@endsection