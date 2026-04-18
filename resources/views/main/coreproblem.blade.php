@extends('layouts.app')

@section('title', 'The Core Problem | ConstructKaro')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

<style>
    .core-problem-page {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to bottom, #f7f8fb 0%, #f2f4f8 100%);
        padding: 55px 0 80px;
    }

    .core-container {
        max-width: 1220px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .core-topbar {
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
        width: 150px;
        height: 5px;
        border-radius: 50px;
        margin: 0 auto 20px;
        background: linear-gradient(to right, #2b6cb0, #f25c05);
    }

    .section-subtitle {
        max-width: 860px;
        margin: 0 auto;
        font-size: 18px;
        line-height: 1.9;
        color: #667085;
    }

    .core-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 28px;
        align-items: start;
    }

    .problem-card {
        background: #fff;
        border-radius: 24px;
        padding: 34px 32px;
        box-shadow: 0 16px 40px rgba(28, 44, 62, 0.08);
        border: 1px solid rgba(28, 44, 62, 0.05);
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .problem-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(to right, #2b6cb0, #f25c05);
    }

    .problem-card h3 {
        font-size: 28px;
        font-weight: 750;
        color: #1c2c3e;
        margin-bottom: 18px;
    }

    .problem-card p {
        font-size: 17px;
        line-height: 1.9;
        color: #5b6470;
        margin-bottom: 18px;
    }

    .problem-card p:last-child {
        margin-bottom: 0;
    }

    .problem-card strong {
        color: #3b4350;
        font-weight: 700;
    }

    .highlight-line {
        font-size: 22px !important;
        font-weight: 600;
        color: #1c2c3e !important;
        line-height: 1.7 !important;
        margin-bottom: 18px !important;
    }

    .highlight-line .accent {
        color: #f25c05;
        font-weight: 700;
    }

    .list-box {
        margin: 24px 0;
        padding: 24px 24px 18px;
        border-radius: 18px;
        background: linear-gradient(135deg, rgba(43,108,176,0.05), rgba(242,92,5,0.05));
        border: 1px solid rgba(43, 108, 176, 0.10);
    }

    .list-box h4 {
        font-size: 20px;
        font-weight: 700;
        color: #1c2c3e;
        margin-bottom: 14px;
    }

    .problem-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .problem-list li {
        position: relative;
        padding-left: 32px;
        margin-bottom: 14px;
        font-size: 16px;
        line-height: 1.8;
        color: #4b5563;
    }

    .problem-list li:last-child {
        margin-bottom: 0;
    }

    .problem-list li::before {
        content: "\f105";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        left: 0;
        top: 2px;
        color: #f25c05;
        font-size: 16px;
    }

    .impact-card {
        background: linear-gradient(135deg, #1c2c3e 0%, #223d59 100%);
        color: #fff;
    }

    .impact-card::before {
        background: linear-gradient(to right, #f25c05, #ffb067);
    }

    .impact-card h3,
    .impact-card p,
    .impact-card strong {
        color: #fff;
    }

    .impact-card .list-box {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.10);
    }

    .impact-card .list-box h4 {
        color: #fff;
    }

    .impact-card .problem-list li {
        color: rgba(255,255,255,0.88);
    }

    .impact-card .problem-list li::before {
        color: #ffb067;
    }

    .closing-note {
        margin-top: 22px;
        padding: 18px 20px;
        border-radius: 16px;
        background: rgba(242, 92, 5, 0.08);
        color: #1c2c3e;
        font-size: 17px;
        line-height: 1.8;
        font-weight: 500;
    }

    @media (max-width: 991px) {
        .section-title {
            font-size: 40px;
        }

        .core-layout {
            grid-template-columns: 1fr;
        }

        .problem-card {
            padding: 28px 22px;
        }
    }

    @media (max-width: 767px) {
        .core-problem-page {
            padding: 35px 0 50px;
        }

        .core-container {
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

        .problem-card h3 {
            font-size: 23px;
        }

        .problem-card p,
        .problem-list li,
        .closing-note {
            font-size: 15px;
        }

        .highlight-line {
            font-size: 18px !important;
        }

        .list-box {
            padding: 20px 18px 16px;
        }
    }
</style>

<section class="core-problem-page">
    <div class="core-container">

        <div class="core-topbar">
            <a href="{{ url()->previous() }}" class="back-btn" aria-label="Go Back">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>

        <div class="section-header">
            <h1 class="section-title">The Core Problem</h1>
            <div class="title-line"></div>
            <p class="section-subtitle">
                The real issue is not construction itself. The real issue is the lack of a clear,
                structured, and guided way to begin and manage construction projects.
            </p>
        </div>

        <div class="core-layout">

            <!-- Left Card -->
            <div class="problem-card">
                <h3>Where the Problem Begins</h3>

                <p class="highlight-line">
                    The real problem is the lack of a <span class="accent">clear and structured way</span>
                    to start construction projects.
                </p>

                <div class="list-box">
                    <h4>This Usually Affects</h4>
                    <ul class="problem-list">
                        <li>Private property owners building their first home</li>
                        <li>SME businesses setting up factories or warehouses</li>
                        <li>Small builders and developers starting new projects</li>
                    </ul>
                </div>

                <p>
                    For these users, construction often begins with <strong>confusion instead of clarity.</strong>
                </p>

                <div class="list-box">
                    <h4>They Often Don’t Know</h4>
                    <ul class="problem-list">
                        <li>Which professional to approach first — architect, contractor, or consultant</li>
                        <li>How to define project scope, budget, or requirements properly</li>
                        <li>How to compare vendors or evaluate pricing in a structured way</li>
                        <li>Who is responsible for what during execution</li>
                    </ul>
                </div>
            </div>

            <!-- Right Card -->
            <div class="problem-card impact-card">
                <h3>Why It Becomes a Bigger Issue</h3>

                <p class="highlight-line" style="color:#fff !important;">
                    There is <span class="accent" style="color:#ffb067;">no standard path</span>
                    from idea to execution.
                </p>

                <p>
                    In most cases, everything depends on informal coordination rather than a defined system.
                </p>

                <div class="list-box">
                    <h4>Decision-Making Depends On</h4>
                    <ul class="problem-list">
                        <li>References</li>
                        <li>Phone calls</li>
                        <li>Trial-and-error decisions</li>
                    </ul>
                </div>

                <div class="list-box">
                    <h4>What This Leads To</h4>
                    <ul class="problem-list">
                        <li>Delays in project start and execution</li>
                        <li>Cost overruns due to unclear planning</li>
                        <li>Poor decision-making without proper guidance</li>
                        <li>Lack of accountability across multiple vendors</li>
                    </ul>
                </div>

                <div class="closing-note">
                    In short, the system is fragmented and the customer is left to manage everything.
                </div>
            </div>

        </div>
    </div>
</section>
@endsection