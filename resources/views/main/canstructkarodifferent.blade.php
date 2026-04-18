@extends('layouts.app')

@section('title', 'How ConstructKaro is Different | ConstructKaro')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

<style>
    .different-page {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to bottom, #f7f8fb 0%, #f2f4f8 100%);
        padding: 55px 0 80px;
    }

    .different-container {
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .different-topbar {
        margin-bottom: 10px;
    }

    .back-btn {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ff8a2a, #f25c05);
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 22px;
        box-shadow: 0 12px 25px rgba(242, 92, 5, 0.22);
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        color: #fff;
        transform: translateY(-4px);
        box-shadow: 0 18px 30px rgba(242, 92, 5, 0.28);
    }

    .section-header {
        text-align: center;
        margin-bottom: 38px;
    }

    .section-title {
        font-size: 56px;
        font-weight: 800;
        line-height: 1.2;
        color: #101828;
        margin-bottom: 14px;
    }

    .title-line {
        width: 165px;
        height: 5px;
        border-radius: 50px;
        margin: 0 auto 20px;
        background: linear-gradient(to right, #2b6cb0, #f25c05);
    }

    .section-subtitle {
        max-width: 930px;
        margin: 0 auto;
        font-size: 18px;
        line-height: 1.9;
        color: #667085;
    }

    .different-layout {
        display: grid;
        grid-template-columns: 1.05fr 0.95fr;
        gap: 28px;
        align-items: start;
    }

    .content-card,
    .feature-panel {
        background: #fff;
        border-radius: 24px;
        padding: 34px 32px;
        box-shadow: 0 16px 40px rgba(28, 44, 62, 0.08);
        border: 1px solid rgba(28, 44, 62, 0.05);
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .content-card::before,
    .feature-panel::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(to right, #2b6cb0, #f25c05);
    }

    .content-card h3,
    .feature-panel h3 {
        font-size: 28px;
        font-weight: 750;
        color: #1c2c3e;
        margin-bottom: 18px;
    }

    .content-card p {
        font-size: 17px;
        line-height: 1.9;
        color: #5b6470;
        margin-bottom: 18px;
    }

    .content-card p:last-child {
        margin-bottom: 0;
    }

    .content-card strong {
        color: #3b4350;
        font-weight: 700;
    }

    .highlight-box {
        margin-top: 22px;
        padding: 24px 24px 20px;
        border-radius: 18px;
        background: linear-gradient(135deg, rgba(43,108,176,0.05), rgba(242,92,5,0.05));
        border: 1px solid rgba(43, 108, 176, 0.10);
    }

    .highlight-box h4 {
        font-size: 20px;
        font-weight: 700;
        color: #1c2c3e;
        margin-bottom: 12px;
    }

    .highlight-box p {
        margin: 0;
        font-size: 16px;
        line-height: 1.85;
        color: #4b5563;
    }

    .feature-panel {
        background: linear-gradient(135deg, #1c2c3e 0%, #24415f 100%);
        color: #fff;
    }

    .feature-panel::before {
        background: linear-gradient(to right, #f25c05, #ffb067);
    }

    .feature-panel h3 {
        color: #fff;
    }

    .feature-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
        margin-top: 10px;
    }

    .feature-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 18px 18px;
        border-radius: 18px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.10);
        transition: all 0.3s ease;
    }

    .feature-item:hover {
        transform: translateY(-4px);
        background: rgba(255,255,255,0.11);
    }

    .feature-icon {
        min-width: 48px;
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: rgba(255, 176, 103, 0.15);
        color: #ffb067;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-top: 2px;
    }

    .feature-text h4 {
        font-size: 18px;
        font-weight: 700;
        color: #fff;
        margin: 0 0 6px;
        line-height: 1.5;
    }

    .feature-text p {
        margin: 0;
        font-size: 15px;
        line-height: 1.75;
        color: rgba(255,255,255,0.85);
    }

    .closing-note {
        margin-top: 22px;
        padding: 18px 20px;
        border-radius: 16px;
        background: rgba(242, 92, 5, 0.10);
        color: #1c2c3e;
        font-size: 17px;
        line-height: 1.8;
        font-weight: 500;
    }

    .closing-note strong {
        color: #f25c05;
    }

    @media (max-width: 991px) {
        .section-title {
            font-size: 40px;
        }

        .different-layout {
            grid-template-columns: 1fr;
        }

        .content-card,
        .feature-panel {
            padding: 28px 22px;
        }
    }

    @media (max-width: 767px) {
        .different-page {
            padding: 35px 0 50px;
        }

        .different-container {
            padding: 0 15px;
        }

        .back-btn {
            width: 44px;
            height: 44px;
            font-size: 18px;
        }

        .section-title {
            font-size: 30px;
        }

        .title-line {
            width: 120px;
            height: 4px;
        }

        .section-subtitle {
            font-size: 15px;
            line-height: 1.8;
        }

        .content-card h3,
        .feature-panel h3 {
            font-size: 23px;
        }

        .content-card p,
        .highlight-box p,
        .feature-text p,
        .closing-note {
            font-size: 15px;
        }

        .feature-item {
            padding: 16px 14px;
            gap: 12px;
        }

        .feature-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
            font-size: 18px;
        }

        .feature-text h4 {
            font-size: 16px;
        }
    }
</style>

<section class="different-page">
    <div class="different-container">

        <div class="different-topbar">
            <a href="{{ url()->previous() }}" class="back-btn" aria-label="Go Back">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>

        <div class="section-header">
            <h1 class="section-title">How ConstructKaro is Different</h1>
            <div class="title-line"></div>
            <p class="section-subtitle">
                ConstructKaro does not stop at discovery. We help customers move from requirement
                to execution through a structured system built for real construction projects.
            </p>
        </div>

        <div class="different-layout">

            <!-- Left Content -->
            <div class="content-card">
                <h3>More Than Lead Generation</h3>

                <p>
                    Most construction platforms in India focus only on
                    <strong>lead generation, listings, or vendor directories.</strong>
                    ConstructKaro is different.
                </p>

                <p>
                    We are not just helping customers
                    <strong>find contractors or service providers</strong> —
                    we help them <strong>plan, manage, and execute construction projects</strong>
                    through a structured system.
                </p>

                <p>
                    Unlike traditional platforms, where users have to search, compare, and decide on
                    their own, ConstructKaro takes responsibility for
                    <strong>understanding the requirement, assigning the right experts, and managing the execution process.</strong>
                </p>

                <div class="highlight-box">
                    <h4>What Makes This Different?</h4>
                    <p>
                        Instead of leaving the customer to manage multiple vendors alone,
                        ConstructKaro creates a clearer path with requirement capture,
                        expert assignment, pricing clarity, and execution coordination.
                    </p>
                </div>

                <div class="closing-note">
                    <strong>In short:</strong> ConstructKaro is built for execution, not just discovery.
                </div>
            </div>

            <!-- Right Feature Panel -->
            <div class="feature-panel">
                <h3>What Sets ConstructKaro Apart</h3>

                <div class="feature-grid">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fa-solid fa-clipboard-list"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Structured Requirement Capture</h4>
                            <p>Accurate understanding of project needs before work begins.</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Service-Wise Execution Approach</h4>
                            <p>Separate and defined execution logic for contracting, design, survey, testing, and BOQ.</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fa-solid fa-user-check"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Assigned Contractors & Experts</h4>
                            <p>Professionals are selected based on project suitability, not random listing exposure.</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Pricing Clarity & Defined Scope</h4>
                            <p>Better visibility on deliverables, scope, and commercial understanding before execution.</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fa-solid fa-bullseye"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Single Point of Responsibility</h4>
                            <p>A more accountable structure for the entire customer journey.</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fa-solid fa-diagram-project"></i>
                        </div>
                        <div class="feature-text">
                            <h4>End-to-End Project Coordination</h4>
                            <p>From planning to execution support, the process stays more organized and controlled.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection