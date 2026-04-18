@extends('layouts.app')

@section('title', 'Our Background | ConstructKaro')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

<style>
    .background-page {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to bottom, #f7f8fb 0%, #f2f4f8 100%);
        padding: 55px 0 80px;
    }

    .background-container {
        max-width: 1220px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .background-topbar {
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
        margin-bottom: 28px;
    }

    .section-title {
        font-size: 52px;
        font-weight: 800;
        line-height: 1.2;
        color: #101828;
        margin-bottom: 14px;
    }

    .title-line {
        width: 150px;
        height: 5px;
        border-radius: 50px;
        margin: 0 auto 24px;
        background: linear-gradient(to right, #2b6cb0, #f25c05);
    }

    .section-subtitle {
        max-width: 1180px;
        margin: 0 auto;
        font-size: 18px;
        line-height: 1.9;
        color: #5f6673;
    }

    .section-subtitle strong {
        color: #3f4652;
        font-weight: 700;
    }

    .project-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
        margin: 50px 0 55px;
    }

    .project-card {
        background: #fff;
        border-radius: 24px;
        padding: 34px 24px 28px;
        text-align: center;
        box-shadow: 0 16px 40px rgba(28, 44, 62, 0.08);
        border: 1px solid rgba(28, 44, 62, 0.06);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .project-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(to right, #2b6cb0, #f25c05);
    }

    .project-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 48px rgba(28, 44, 62, 0.12);
    }

    .project-icon {
        width: 92px;
        height: 92px;
        margin: 0 auto 20px;
        border-radius: 50%;
        background: rgba(43, 108, 176, 0.09);
        color: #2b6cb0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 42px;
    }

    .project-card h3 {
        font-size: 24px;
        line-height: 1.35;
        font-weight: 700;
        color: #111827;
        margin-bottom: 8px;
    }

    .project-card p {
        font-size: 17px;
        line-height: 1.7;
        color: #6b7280;
        margin: 0;
    }

    .content-card {
        background: #fff;
        border-radius: 26px;
        padding: 38px 38px 34px;
        box-shadow: 0 16px 40px rgba(28, 44, 62, 0.08);
        border: 1px solid rgba(28, 44, 62, 0.05);
    }

    .content-card p {
        font-size: 18px;
        line-height: 1.95;
        color: #5b6470;
        margin-bottom: 22px;
    }

    .content-card p:last-child {
        margin-bottom: 0;
    }

    .content-card strong {
        color: #3b4350;
        font-weight: 700;
    }

    .problem-box {
        margin: 28px 0 30px;
        padding: 28px 28px 22px;
        background: linear-gradient(135deg, rgba(43,108,176,0.05), rgba(242,92,5,0.05));
        border: 1px solid rgba(43, 108, 176, 0.10);
        border-radius: 20px;
    }

    .problem-box h4 {
        font-size: 24px;
        font-weight: 700;
        color: #1c2c3e;
        margin-bottom: 18px;
    }

    .problem-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .problem-list li {
        position: relative;
        padding-left: 34px;
        margin-bottom: 16px;
        font-size: 17px;
        line-height: 1.8;
        color: #4b5563;
    }

    .problem-list li:last-child {
        margin-bottom: 0;
    }

    .problem-list li::before {
        content: "\f058";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        left: 0;
        top: 2px;
        color: #f25c05;
        font-size: 18px;
    }

    .closing-line {
        font-size: 20px !important;
        line-height: 1.9 !important;
        color: #384250 !important;
        font-weight: 500;
    }

    .closing-line strong {
        color: #1c2c3e !important;
    }

    @media (max-width: 991px) {
        .section-title {
            font-size: 40px;
        }

        .section-subtitle,
        .content-card p {
            font-size: 16px;
        }

        .project-grid {
            grid-template-columns: 1fr;
        }

        .content-card {
            padding: 30px 22px 26px;
        }
    }

    @media (max-width: 767px) {
        .background-page {
            padding: 35px 0 50px;
        }

        .background-container {
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

        .project-card {
            padding: 28px 18px 24px;
        }

        .project-icon {
            width: 78px;
            height: 78px;
            font-size: 34px;
        }

        .project-card h3 {
            font-size: 22px;
        }

        .project-card p,
        .content-card p,
        .problem-list li {
            font-size: 15px;
        }

        .problem-box {
            padding: 22px 18px 18px;
        }

        .problem-box h4 {
            font-size: 20px;
        }

        .closing-line {
            font-size: 17px !important;
        }
    }
</style>

<section class="background-page">
    <div class="background-container">

        <div class="background-topbar">
            <a href="{{ url()->previous() }}" class="back-btn" aria-label="Go Back">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>

        <div class="section-header">
            <h1 class="section-title">Our Background</h1>
            <div class="title-line"></div>
            <p class="section-subtitle">
                We come from years of hands-on experience in the <strong>construction industry in India</strong>,
                working across a wide range of projects including:
            </p>
        </div>

        <div class="project-grid">
            <div class="project-card">
                <div class="project-icon">
                    <i class="fa-solid fa-house-chimney"></i>
                </div>
                <h3>Residential Construction</h3>
                <p>Bungalows, villas, apartments, and housing-focused developments.</p>
            </div>

            <div class="project-card">
                <div class="project-icon">
                    <i class="fa-solid fa-building"></i>
                </div>
                <h3>Commercial Developments</h3>
                <p>Offices, retail spaces, business properties, and commercial projects.</p>
            </div>

            <div class="project-card">
                <div class="project-icon">
                    <i class="fa-solid fa-industry"></i>
                </div>
                <h3>Industrial & Infrastructure Projects</h3>
                <p>Factories, warehouses, industrial facilities, and large-scale infrastructure works.</p>
            </div>
        </div>

        <div class="content-card">
            <p>
                Through direct involvement in these construction works — from planning to execution —
                we gained a deep understanding of how <strong>construction services, contractors, and project workflows operate on the ground.</strong>
            </p>

            <p>
                During this journey, we consistently observed a common problem across projects of all sizes:
            </p>

            <div class="problem-box">
                <h4>Common Problems We Observed</h4>
                <ul class="problem-list">
                    <li>People do not know how to properly start a construction project.</li>
                    <li>Different contractors and professionals give different directions.</li>
                    <li>There is no single point of responsibility or structured coordination.</li>
                    <li>Decision-making depends heavily on calls, references, and guesswork.</li>
                </ul>
            </div>

            <p class="closing-line">
                Despite being one of the largest industries in India, construction still lacks a
                <strong>structured system, clear process, and standardized approach to project initiation and execution.</strong>
            </p>
        </div>

    </div>
</section>
@endsection