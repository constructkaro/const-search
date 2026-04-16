@extends('layouts.app')

@section('title', 'How to Choose the Right Contractor in India?')

@section('content')
<style>
    .contractor-guide-page {
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

    /* Content Area */
    .contractor-guide-container {
        max-width: 1150px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .guide-content {
        width: 100%;
    }

    .guide-main-title {
        font-size: 40px;
        line-height: 1.25;
        font-weight: 800;
        color: #f25c05;
        margin-bottom: 20px;
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
        font-size: 32px;
        line-height: 1.3;
        font-weight: 800;
        margin-bottom: 14px;
    }

    .guide-section.orange h2 {
        color: #f25c05;
    }

    .guide-section.blue h2 {
        color: #1f6fd1;
    }

    .guide-list,
    .guide-question-list {
        list-style: none;
        padding: 0;
        margin: 18px 0;
    }

    .guide-list li,
    .guide-question-list li {
        position: relative;
        padding-left: 22px;
        margin-bottom: 12px;
        font-size: 17px;
        line-height: 1.7;
        color: #222;
    }

    .guide-list li::before,
    .guide-question-list li::before {
        content: "";
        position: absolute;
        left: 0;
        top: 10px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #f25c05;
    }

    .guide-section.blue .guide-list li::before,
    .guide-section.blue .guide-question-list li::before {
        background: #1f6fd1;
    }

    .guide-conclusion {
        margin-top: 45px;
    }

    .guide-conclusion h2 {
        color: #1f6fd1;
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 14px;
    }

    .guide-cta {
        margin-top: 45px;
        background: #fff7f2;
        border-left: 5px solid #f25c05;
        padding: 24px 26px;
        border-radius: 14px;
    }

    .guide-cta h2 {
        color: #f25c05;
        font-size: 30px;
        font-weight: 800;
        margin-bottom: 12px;
    }

    .guide-cta p {
        margin-bottom: 0;
    }

    @media (max-width: 991px) {
        .guide-main-title {
            font-size: 32px;
        }

        .guide-section h2,
        .guide-conclusion h2,
        .guide-cta h2 {
            font-size: 26px;
        }

        .guide-content p,
        .guide-list li,
        .guide-question-list li {
            font-size: 16px;
        }
    }

    @media (max-width: 767px) {
        .contractor-guide-page {
            padding: 0 0 50px;
        }

        .guide-back-wrap {
            padding: 18px 15px 14px;
        }

        .contractor-guide-container {
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
            font-size: 24px;
            margin-bottom: 16px;
        }

        .guide-section {
            margin-top: 30px;
        }

        .guide-section h2,
        .guide-conclusion h2,
        .guide-cta h2 {
            font-size: 22px;
        }

        .guide-content p,
        .guide-list li,
        .guide-question-list li {
            font-size: 15px;
            line-height: 1.65;
        }

        .guide-cta {
            padding: 18px;
        }
    }
</style>

<section class="contractor-guide-page">

    <div class="guide-back-wrap">
        <a href="{{ url()->previous() }}" class="guide-back-btn" aria-label="Go Back">
            &#8592;
        </a>
    </div>

    <!-- Full Width Banner -->
    <div class="guide-banner-full">
        <img src="{{ asset('images/knowlege/7.png') }}" alt="How to Choose the Right Contractor in India">
    </div>

    <div class="contractor-guide-container">
        <div class="guide-content">
            <h1 class="guide-main-title">How to Choose the Right Contractor in India?</h1>

            <p>
                Choosing the right contractor is one of the most important decisions in any construction project.
                Whether you are building a house, renovating a bungalow, doing interior work, or planning a commercial space,
                the wrong contractor can lead to delays, extra costs, poor quality work, and stress.
            </p>

            <p>
                Many people in India still depend only on local references, random contacts, or incomplete information while selecting a contractor.
                Today, the smarter way is to compare verified contractors, check their work category, understand their experience,
                and match them according to your project location and budget.
            </p>

            <p>
                In this guide, let us understand how to choose the right contractor in a simple and practical way.
            </p>

            <div class="guide-section blue">
                <h2>1. Understand Your Project Requirement First</h2>
                <p>Before choosing any contractor, first be clear about your own project. Ask yourself:</p>
                <ul class="guide-question-list">
                    <li>What type of work do I need?</li>
                    <li>Is it new construction, renovation, interior work, waterproofing, plumbing, electrical, or industrial work?</li>
                    <li>What is my estimated budget?</li>
                    <li>What is my location?</li>
                    <li>What is my expected timeline?</li>
                </ul>
                <p>
                    If your own requirement is not clear, even a good contractor will not be able to give you the right quote or plan.
                    Project clarity is always the first step.
                </p>
            </div>

            <div class="guide-section orange">
                <h2>2. Choose a Contractor According to Work Category</h2>
                <p>
                    One of the biggest mistakes people make is hiring a contractor who is not specialized in their type of work.
                </p>
                <ul class="guide-list">
                    <li>A residential contractor is best for house and bungalow construction.</li>
                    <li>An industrial contractor is better for factories, warehouses, and PEB sheds.</li>
                    <li>A plumbing contractor should handle plumbing-specific work.</li>
                    <li>A waterproofing contractor should handle leakage and waterproofing issues.</li>
                    <li>An electrical contractor should handle electrical installations.</li>
                </ul>
            </div>

            <div class="guide-section blue">
                <h2>3. Check Whether the Contractor Is Verified</h2>
                <p>Trust is very important in construction. You should always check:</p>
                <ul class="guide-question-list">
                    <li>Is the contractor verified?</li>
                    <li>Do they have proper profile details?</li>
                    <li>Are they active in your location?</li>
                    <li>Is their category relevant to your project?</li>
                </ul>
            </div>

            <div class="guide-section orange">
                <h2>4. Review Their Previous Work</h2>
                <p>Never hire a contractor only by listening to promises. Always ask for:</p>
                <ul class="guide-list">
                    <li>Photos of completed projects</li>
                    <li>Videos of site work</li>
                    <li>Similar project experience</li>
                    <li>Type of projects handled before</li>
                    <li>Quality of finishing</li>
                </ul>
            </div>

            <div class="guide-section blue">
                <h2>5. Compare More Than One Contractor</h2>
                <p>It is always better to compare at least 3 contractors on:</p>
                <ul class="guide-list">
                    <li>Price</li>
                    <li>Experience</li>
                    <li>Work quality</li>
                    <li>Communication</li>
                    <li>Timeline</li>
                    <li>Material understanding</li>
                    <li>Supervision capability</li>
                </ul>
            </div>

            <div class="guide-section orange">
                <h2>6. Do Not Choose Only on Lowest Price</h2>
                <p>A very low quote may mean:</p>
                <ul class="guide-list">
                    <li>Poor quality materials</li>
                    <li>Incomplete scope</li>
                    <li>Unskilled labour</li>
                    <li>Delays later</li>
                    <li>Extra hidden costs</li>
                </ul>
            </div>

            <div class="guide-section blue">
                <h2>7. Ask the Right Questions</h2>
                <p>Before finalizing any contractor, ask these questions:</p>
                <ul class="guide-question-list">
                    <li>How many similar projects have you completed?</li>
                    <li>Can you show previous site work?</li>
                    <li>What is included in your quotation?</li>
                    <li>What materials will be used?</li>
                    <li>What is the estimated completion timeline?</li>
                    <li>Who will supervise the site?</li>
                    <li>How will progress be tracked?</li>
                    <li>What happens if there is a delay?</li>
                </ul>
            </div>

            <div class="guide-section orange">
                <h2>8. Check Location Advantage</h2>
                <ul class="guide-list">
                    <li>Faster site visits</li>
                    <li>Better coordination</li>
                    <li>Easier labour and material movement</li>
                    <li>Better response in emergencies</li>
                    <li>Lower follow-up problems</li>
                </ul>
            </div>

            <div class="guide-section blue">
                <h2>9. Share Proper Project Details</h2>
                <ul class="guide-list">
                    <li>Project type</li>
                    <li>Budget range</li>
                    <li>Area size</li>
                    <li>Site location</li>
                    <li>Drawings if available</li>
                    <li>BOQ if available</li>
                    <li>Work description</li>
                </ul>
            </div>

            <div class="guide-section orange">
                <h2>10. Finalize Only After Proper Comparison</h2>
                <ul class="guide-list">
                    <li>Trust</li>
                    <li>Relevant experience</li>
                    <li>Work category match</li>
                    <li>Transparency</li>
                    <li>Communication</li>
                    <li>Location support</li>
                    <li>Quote clarity</li>
                    <li>Execution confidence</li>
                </ul>
            </div>

            <div class="guide-conclusion">
                <h2>Conclusion:</h2>
                <p>
                    Choosing the right contractor in India does not have to be confusing.
                    If you first understand your requirement, shortlist by category, compare verified options,
                    review previous work, and avoid selecting only by lowest price, you can make a much smarter decision.
                </p>
            </div>

            <div class="guide-cta">
                <h2>Final CTA Section:</h2>
                <p>
                    Need help finding the right contractor for your project?
                    Explore verified contractors by category and location, or post your project requirement to receive relevant responses.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection