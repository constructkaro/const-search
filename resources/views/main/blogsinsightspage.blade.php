@extends('layouts.app')

@section('title', 'Importance of Soil Testing Before Construction')

@section('content')
<style>
    .soil-guide-page {
        padding: 0 0 70px;
        background: #ffffff;
    }

    .guide-back-wrap {
        max-width: 1150px;
        margin: 0 auto;
        padding: 25px 20px 18px;
    }

    .guide-back-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #2b78d0;
        color: #fff;
        text-decoration: none;
        font-size: 22px;
        line-height: 1;
        transition: all 0.3s ease;
    }

    .guide-back-btn:hover {
        background: #1659a6;
        color: #fff;
        transform: translateY(-2px);
    }

    .guide-banner-full {
        width: 100%;
        margin: 0 0 35px;
        overflow: hidden;
    }

    .guide-banner-full img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }

    .soil-guide-container {
        max-width: 1150px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .guide-content {
        width: 100%;
    }

    .guide-main-title {
        font-size: 44px;
        line-height: 1.2;
        font-weight: 800;
        color: #1f6fd1;
        margin-bottom: 22px;
        max-width: 1050px;
    }

    .guide-content p {
        font-size: 17px;
        line-height: 1.7;
        color: #222;
        margin-bottom: 18px;
    }

    .guide-section {
        margin-top: 40px;
    }

    .guide-section h2 {
        font-size: 34px;
        line-height: 1.25;
        font-weight: 800;
        margin-bottom: 14px;
    }

    .guide-section.orange h2,
    .guide-section.orange .guide-sub-title,
    .guide-conclusion h2 {
        color: #f25c05;
    }

    .guide-section.blue h2,
    .guide-section.blue .guide-sub-title {
        color: #1f6fd1;
    }

    .guide-sub-title {
        font-size: 24px;
        line-height: 1.3;
        font-weight: 800;
        margin-top: 24px;
        margin-bottom: 12px;
        color: #111;
    }

    .guide-normal-title {
        font-size: 24px;
        line-height: 1.3;
        font-weight: 800;
        margin-top: 24px;
        margin-bottom: 12px;
        color: #111;
    }

    .guide-list {
        list-style: none;
        padding: 0;
        margin: 18px 0;
    }

    .guide-list li {
        position: relative;
        padding-left: 22px;
        margin-bottom: 12px;
        font-size: 17px;
        line-height: 1.7;
        color: #222;
    }

    .guide-list li::before {
        content: "";
        position: absolute;
        left: 0;
        top: 11px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #f25c05;
    }

    .guide-section.blue .guide-list li::before,
    .guide-blue-list li::before {
        background: #1f6fd1;
    }

    .guide-note-box {
        margin-top: 24px;
        padding: 22px 24px;
        background: #f8fbff;
        border-left: 5px solid #1f6fd1;
        border-radius: 14px;
    }

    .guide-note-box p:last-child {
        margin-bottom: 0;
    }

    .guide-conclusion {
        margin-top: 48px;
    }

    .guide-conclusion h2 {
        font-size: 34px;
        font-weight: 800;
        margin-bottom: 14px;
    }

    .guide-strong-line {
        font-size: 20px;
        line-height: 1.6;
        font-weight: 800;
        color: #111;
        margin-top: 18px;
        margin-bottom: 0;
    }

    @media (max-width: 991px) {
        .guide-main-title {
            font-size: 36px;
        }

        .guide-section h2,
        .guide-conclusion h2 {
            font-size: 28px;
        }

        .guide-sub-title,
        .guide-normal-title {
            font-size: 22px;
        }

        .guide-content p,
        .guide-list li,
        .guide-strong-line {
            font-size: 16px;
        }
    }

    @media (max-width: 767px) {
        .soil-guide-page {
            padding: 0 0 50px;
        }

        .guide-back-wrap {
            padding: 18px 15px 14px;
        }

        .soil-guide-container {
            padding: 0 15px;
        }

        .guide-back-btn {
            width: 36px;
            height: 36px;
            font-size: 18px;
        }

        .guide-banner-full {
            margin-bottom: 25px;
        }

        .guide-main-title {
            font-size: 28px;
            margin-bottom: 18px;
        }

        .guide-section {
            margin-top: 30px;
        }

        .guide-section h2,
        .guide-conclusion h2 {
            font-size: 24px;
        }

        .guide-sub-title,
        .guide-normal-title {
            font-size: 20px;
        }

        .guide-content p,
        .guide-list li,
        .guide-strong-line {
            font-size: 15px;
            line-height: 1.65;
        }

        .guide-note-box {
            padding: 18px;
        }
    }
</style>

<section class="soil-guide-page">

    <div class="guide-back-wrap">
        <a href="{{ url()->previous() }}" class="guide-back-btn" aria-label="Go Back">
            &#8592;
        </a>
    </div>

    <!-- Full Width Banner -->
    <div class="guide-banner-full">
        <img src="{{ asset('images/knowlege/10.png') }}" alt="Importance of Soil Testing Before Construction">
    </div>

    <div class="soil-guide-container">
        <div class="guide-content">

            <h1 class="guide-main-title">Importance of Soil Testing Before Construction</h1>

            <p>
                Soil testing is one of the most important steps before starting any construction project.
                Many people focus on design, budget, and material, but ignore the condition of the soil.
                The strength of any building depends not only on cement and steel, but also on the ground below it.
                If soil is not tested properly, it can lead to cracks, settlement, water problems, weak foundation,
                and extra construction cost later.
            </p>

            <div class="guide-section orange">
                <h2>Step-by-Step: Importance of Soil Testing Before Construction</h2>

                <h3 class="guide-sub-title">Step 1: Understand the land condition</h3>
                <p>
                    Before starting construction, first check the site condition.
                    Every plot does not have the same soil type.
                </p>

                <div class="guide-normal-title">Some land may have:</div>
                <ul class="guide-list">
                    <li>Hard soil</li>
                    <li>Soft soil</li>
                    <li>Black cotton soil</li>
                    <li>Sandy soil</li>
                    <li>Filled-up land</li>
                    <li>Water-affected soil</li>
                </ul>

                <p>
                    This is why soil testing is important before foundation work starts.
                </p>
            </div>

            <div class="guide-section blue">
                <h2>Why Soil Testing Is Important</h2>

                <h3 class="guide-sub-title">1. It helps to decide the right foundation</h3>
                <p>
                    Different soil types need different foundation designs.
                </p>

                <div class="guide-normal-title">For example:</div>
                <ul class="guide-list guide-blue-list">
                    <li>Strong soil may support normal foundation</li>
                    <li>Weak soil may need deeper or stronger foundation</li>
                    <li>Water-affected soil may need special treatment</li>
                </ul>

                <p>
                    Without soil testing, foundation design may be risky.
                </p>

                <h3 class="guide-sub-title">2. It prevents future cracks and settlement</h3>
                <p>
                    If the soil is weak or loose, the building may settle unevenly.
                    This can cause:
                </p>

                <ul class="guide-list guide-blue-list">
                    <li>Wall cracks</li>
                    <li>Floor settlement</li>
                    <li>Foundation movement</li>
                    <li>Structural problems</li>
                </ul>

                <p>
                    Soil testing helps reduce these risks.
                </p>

                <h3 class="guide-sub-title">3. It improves building safety</h3>
                <p>
                    A building is only as strong as its foundation.
                    If the soil cannot bear the building load properly, safety becomes a major issue.
                </p>

                <p>
                    Soil testing helps ensure that the structure is built on safe ground.
                </p>

                <h3 class="guide-sub-title">4. It helps estimate bearing capacity</h3>
                <p>
                    One major purpose of soil testing is to know the safe bearing capacity of the land.
                </p>

                <div class="guide-normal-title">This tells engineers:</div>
                <ul class="guide-list guide-blue-list">
                    <li>How much load the soil can carry</li>
                    <li>What type of footing is suitable</li>
                    <li>How deep the foundation should go</li>
                </ul>

                <p>
                    This is very important for safe structural design.
                </p>

                <h3 class="guide-sub-title">5. It helps identify groundwater level</h3>
                <p>Soil testing also helps understand:</p>
                <ul class="guide-list guide-blue-list">
                    <li>Water level below the ground</li>
                    <li>Moisture condition</li>
                    <li>Water-related construction challenges</li>
                </ul>

                <p>
                    If groundwater is high, construction planning must change accordingly.
                </p>
            </div>

            <div class="guide-section orange">
                <h2>6. It avoids extra cost later</h2>
                <p>
                    Many people skip soil testing to save money in the beginning.
                    But later they may face:
                </p>

                <ul class="guide-list">
                    <li>Foundation failure</li>
                    <li>Repair cost</li>
                    <li>Redesign cost</li>
                    <li>Extra excavation</li>
                    <li>Waterproofing issues</li>
                </ul>

                <p>
                    Soil testing actually helps save money by avoiding future mistakes.
                </p>

                <h2>7. It helps in proper material planning</h2>
                <p>When soil condition is known, engineers can plan:</p>
                <ul class="guide-list">
                    <li>Foundation type</li>
                    <li>Concrete grade</li>
                    <li>Steel requirement</li>
                    <li>Depth of excavation</li>
                    <li>Soil treatment if needed</li>
                </ul>

                <p>
                    This makes the construction process more accurate and efficient.
                </p>

                <h2>8. It is important for all types of projects</h2>
                <p>Soil testing is useful for:</p>
                <ul class="guide-list">
                    <li>House construction</li>
                    <li>Commercial buildings</li>
                    <li>Industrial sheds</li>
                    <li>Warehouses</li>
                    <li>Boundary walls</li>
                    <li>Large renovation projects</li>
                </ul>

                <p>
                    It is not only for big buildings. Even small construction projects can face problems if soil condition is poor.
                </p>

                <h2>9. It helps in black cotton soil or filled land areas</h2>
                <p>Some plots have problematic soil like:</p>
                <ul class="guide-list">
                    <li>Black cotton soil</li>
                    <li>Loose filled soil</li>
                    <li>Wet land</li>
                    <li>Low-lying land</li>
                </ul>

                <p>
                    Such plots need extra attention. Soil testing helps identify whether the land is safe for normal construction
                    or special care is needed.
                </p>

                <h2>10. It gives confidence before starting work</h2>
                <p>When soil is tested properly:</p>
                <ul class="guide-list">
                    <li>Planning becomes better</li>
                    <li>Design becomes safer</li>
                    <li>Budget becomes more accurate</li>
                    <li>Construction becomes more reliable</li>
                </ul>

                <p>
                    It gives peace of mind to both customer and engineer.
                </p>
            </div>

            <div class="guide-section blue">
                <h2>What Happens If Soil Testing Is Not Done?</h2>
                <p>If soil testing is ignored, problems may happen like:</p>
                <ul class="guide-list guide-blue-list">
                    <li>Weak foundation</li>
                    <li>Structural cracks</li>
                    <li>Uneven settlement</li>
                    <li>Water seepage issues</li>
                    <li>Wrong foundation design</li>
                    <li>Increased repair cost</li>
                    <li>Unsafe construction</li>
                </ul>

                <p>
                    That is why soil testing should never be treated as an optional step.
                </p>
            </div>

            <div class="guide-note-box">
                <p class="guide-strong-line">How ConstructKaro Helps</p>
                <p>
                    ConstructKaro helps customers connect with the right construction professionals for every stage of the project.
                </p>
                <p>
                    For soil testing and safe construction planning, ConstructKaro can help customers by:
                </p>
                <ul class="guide-list guide-blue-list">
                    <li>Connecting them with relevant experts</li>
                    <li>Helping them find the right consultants, surveyors, and construction professionals</li>
                    <li>Supporting better project planning before actual work starts</li>
                    <li>Helping avoid random decision-making in construction</li>
                </ul>
                <p>
                    This makes the project process more organized and professional.
                </p>
            </div>

            <div class="guide-conclusion">
                <h2>Final Conclusion</h2>
                <p>
                    Soil testing is an important step before starting construction because it helps understand the strength
                    and condition of the ground. It supports safe foundation design, prevents future structural problems,
                    and saves unnecessary cost later.
                </p>
                <p>
                    Before building on any plot, it is always better to test the soil first and then move forward with design and construction.
                </p>
            </div>

        </div>
    </div>
</section>
@endsection