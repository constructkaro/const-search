@extends('layouts.app')

@section('title', 'House Construction Cost Breakdown in India')

@section('content')
<style>
    .cost-guide-page {
        padding: 0 0 70px;
        background: #ffffff;
    }

    .guide-back-wrap {
        max-width: 1100px;
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

    /* Full Width Banner */
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

    .cost-guide-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .guide-content {
        width: 100%;
    }

    .guide-main-title {
        font-size: 42px;
        line-height: 1.2;
        font-weight: 800;
        color: #1f6fd1;
        margin-bottom: 22px;
        max-width: 980px;
    }

    .guide-content p {
        font-size: 17px;
        line-height: 1.7;
        color: #222;
        margin-bottom: 18px;
    }

    .guide-section {
        margin-top: 42px;
    }

    .guide-section h2 {
        font-size: 34px;
        line-height: 1.25;
        font-weight: 800;
        margin-bottom: 14px;
    }

    .guide-section.orange h2,
    .guide-conclusion h2 {
        color: #f25c05;
    }

    .guide-section.blue h2 {
        color: #1f6fd1;
    }

    .guide-sub-title {
        font-size: 28px;
        line-height: 1.3;
        font-weight: 800;
        color: #1f1f1f;
        margin-top: 40px;
        margin-bottom: 14px;
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
    .guide-tips li::before {
        background: #1f6fd1;
    }

    .guide-conclusion {
        margin-top: 48px;
    }

    .guide-conclusion h2 {
        font-size: 34px;
        font-weight: 800;
        margin-bottom: 14px;
    }

    .guide-conclusion p {
        margin-bottom: 0;
    }

    @media (max-width: 991px) {
        .guide-main-title {
            font-size: 34px;
        }

        .guide-section h2,
        .guide-conclusion h2,
        .guide-sub-title {
            font-size: 28px;
        }

        .guide-content p,
        .guide-list li {
            font-size: 16px;
        }
    }

    @media (max-width: 767px) {
        .cost-guide-page {
            padding: 0 0 50px;
        }

        .guide-back-wrap {
            padding: 18px 15px 14px;
        }

        .cost-guide-container {
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
        .guide-conclusion h2,
        .guide-sub-title {
            font-size: 24px;
        }

        .guide-content p,
        .guide-list li {
            font-size: 15px;
            line-height: 1.65;
        }
    }
</style>

<section class="cost-guide-page">

    <div class="guide-back-wrap">
        <a href="{{ url()->previous() }}" class="guide-back-btn" aria-label="Go Back">
            &#8592;
        </a>
    </div>

    <!-- Full Width Banner -->
    <div class="guide-banner-full">
        <img src="{{ asset('images/knowlege/8.png') }}" alt="House Construction Cost Breakdown in India">
    </div>

    <div class="cost-guide-container">
        <div class="guide-content">
            <h1 class="guide-main-title">House Construction Cost Breakdown in India: A Simple Guide for Homeowners</h1>

            <p>
                Planning a house is exciting, but understanding the cost is very important before starting.
                Many homeowners think only about cement, bricks, and labour, but actual construction cost includes many more parts.
            </p>

            <p>
                A complete house construction budget usually includes structure work, material cost, labour cost,
                finishing work, electrical and plumbing, doors and windows, and some hidden or extra expenses.
                If you do not plan these properly, your budget can increase later.
            </p>

            <div class="guide-section orange">
                <h2>1. Structure Cost</h2>
                <p>This is the main skeleton of the house. It includes:</p>
                <ul class="guide-list">
                    <li>Foundation</li>
                    <li>Columns</li>
                    <li>Beams</li>
                    <li>Slab</li>
                    <li>Brickwork</li>
                </ul>
                <p>This is usually one of the biggest parts of the construction budget.</p>
            </div>

            <div class="guide-section blue">
                <h2>2. Material Cost</h2>
                <p>Material cost includes all the main construction materials used on site. For example:</p>
                <ul class="guide-list">
                    <li>Cement</li>
                    <li>Steel</li>
                    <li>Sand</li>
                    <li>Bricks or blocks</li>
                    <li>Aggregates</li>
                </ul>
                <p>Material quality and market rates can affect your final budget a lot.</p>
            </div>

            <div class="guide-section orange">
                <h2>3. Labour Cost</h2>
                <p>Labour cost depends on the type of work, city, and project size. It may include:</p>
                <ul class="guide-list">
                    <li>Masons</li>
                    <li>Helpers</li>
                    <li>Carpenters</li>
                    <li>Bar benders</li>
                    <li>Tile workers</li>
                    <li>Painters</li>
                    <li>Plumbers</li>
                    <li>Electricians</li>
                </ul>
            </div>

            <div class="guide-section blue">
                <h2>4. Finishing Cost</h2>
                <p>This is the stage that makes the house look complete. It includes:</p>
                <ul class="guide-list">
                    <li>Flooring</li>
                    <li>Plaster</li>
                    <li>Paint</li>
                    <li>Bathroom fittings</li>
                    <li>Kitchen work</li>
                    <li>Doors and windows</li>
                </ul>
                <p>Finishing cost can increase quickly if you choose premium materials.</p>
            </div>

            <div class="guide-section orange">
                <h2>5. Electrical and Plumbing Cost</h2>
                <p>This includes:</p>
                <ul class="guide-list">
                    <li>Wiring</li>
                    <li>Switches</li>
                    <li>Lights</li>
                    <li>Water lines</li>
                    <li>Drainage lines</li>
                    <li>Sanitary fittings</li>
                </ul>
                <p>These are essential parts of every house project and should never be ignored in the budget.</p>
            </div>

            <div class="guide-section blue">
                <h2>6. Hidden Costs</h2>
                <p>Many homeowners forget extra costs like:</p>
                <ul class="guide-list">
                    <li>Design changes</li>
                    <li>Transportation</li>
                    <li>Material wastage</li>
                    <li>Rework</li>
                    <li>External work</li>
                    <li>Contractor delays</li>
                </ul>
                <p>These hidden costs are one of the main reasons why budgets go over plan.</p>
            </div>

            <h3 class="guide-sub-title">How to Control House Construction Cost</h3>
            <p>You can manage your budget better by:</p>
            <ul class="guide-list guide-tips">
                <li>Planning your scope clearly</li>
                <li>Setting your budget early</li>
                <li>Comparing multiple contractors</li>
                <li>Comparing material prices</li>
                <li>Avoiding frequent design changes</li>
            </ul>

            <div class="guide-conclusion">
                <h2>Conclusion:</h2>
                <p>
                    House construction cost is not just about bricks and cement. It is a combination of structure,
                    materials, labour, finishing, electrical, plumbing, and hidden costs. If you understand these parts early,
                    you can plan your budget better and make a smarter project decision.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection