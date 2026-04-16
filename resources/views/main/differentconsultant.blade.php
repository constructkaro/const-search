@extends('layouts.app')

@section('title', 'Difference Between Contractor, Architect, Interior Designer, Surveyor, and Consultant')

@section('content')
<style>
    .role-guide-page {
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

    .role-guide-container {
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
        color: #f25c05;
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

    .guide-section.blue h2,
    .guide-highlight-title {
        color: #1f6fd1;
    }

    .guide-highlight-title {
        font-size: 34px;
        line-height: 1.25;
        font-weight: 800;
        margin-top: 42px;
        margin-bottom: 14px;
    }

    .guide-sub-heading {
        font-size: 20px;
        font-weight: 800;
        color: #111;
        margin-top: 18px;
        margin-bottom: 10px;
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
        margin-top: 22px;
        padding: 22px 24px;
        background: #fff7f2;
        border-left: 5px solid #f25c05;
        border-radius: 14px;
    }

    .guide-note-box h3 {
        font-size: 24px;
        font-weight: 800;
        color: #f25c05;
        margin-bottom: 10px;
    }

    .guide-note-box p {
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
        .guide-highlight-title,
        .guide-conclusion h2 {
            font-size: 28px;
        }

        .guide-note-box h3 {
            font-size: 22px;
        }

        .guide-content p,
        .guide-list li,
        .guide-strong-line {
            font-size: 16px;
        }
    }

    @media (max-width: 767px) {
        .role-guide-page {
            padding: 0 0 50px;
        }

        .guide-back-wrap {
            padding: 18px 15px 14px;
        }

        .role-guide-container {
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

        .guide-section,
        .guide-highlight-title {
            margin-top: 30px;
        }

        .guide-section h2,
        .guide-highlight-title,
        .guide-conclusion h2 {
            font-size: 24px;
        }

        .guide-sub-heading {
            font-size: 18px;
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

        .guide-note-box h3 {
            font-size: 20px;
        }
    }
</style>

<section class="role-guide-page">

    <div class="guide-back-wrap">
        <a href="{{ url()->previous() }}" class="guide-back-btn" aria-label="Go Back">
            &#8592;
        </a>
    </div>

    <!-- Full Width Banner -->
    <div class="guide-banner-full">
        <img src="{{ asset('images/knowlege/9.png') }}" alt="Difference Between Contractor, Architect, Interior Designer, Surveyor, and Consultant">
    </div>

    <div class="role-guide-container">
        <div class="guide-content">

            <h1 class="guide-main-title">Difference Between Contractor, Architect, Interior Designer, Surveyor, and Consultant</h1>

            <p>
                When people start planning a home, bungalow, villa, shop, office, or any other construction project,
                they often get confused between different professionals involved in the process.
            </p>

            <h2 class="guide-highlight-title">Common questions people ask are:</h2>

            <ul class="guide-list guide-blue-list">
                <li>Who should I contact first?</li>
                <li>What is the role of an architect?</li>
                <li>Is a contractor enough?</li>
                <li>When do I need an interior designer?</li>
                <li>What does a surveyor do?</li>
                <li>Who is called a consultant?</li>
            </ul>

            <p>
                At ConstructKaro, many customers come with the same confusion. They know they want to build something,
                but they are not always sure which professional is needed at which stage. This article will help you understand
                the difference between a Contractor, Architect, Interior Designer, Surveyor, and Consultant, and also explain
                the correct order in which these roles usually come into a project.
            </p>

            <div class="guide-section orange">
                <h2>Why Understanding These Roles Is Important</h2>
                <p>If you involve the wrong person at the wrong stage, it can create:</p>
                <ul class="guide-list">
                    <li>Design confusion</li>
                    <li>Budget mismatch</li>
                    <li>Site planning mistakes</li>
                    <li>Execution delays</li>
                    <li>Unnecessary extra cost</li>
                </ul>
                <p>
                    That is why understanding each role properly is important before starting any project.
                </p>
            </div>

            <div class="guide-section blue">
                <h2>How ConstructKaro Helps:</h2>
                <p>
                    ConstructKaro helps customers connect with the right construction professional for the right stage
                    of the project, whether it is planning, design, surveying, execution, or interior work.
                </p>
            </div>

            <div class="guide-section orange">
                <h2>1. Surveyor</h2>

                <div class="guide-sub-heading">What Does a Surveyor Do?</div>
                <p>
                    A Surveyor is usually one of the earliest professionals needed in many construction projects,
                    especially when land measurement, level checking, or plotting is important.
                </p>

                <div class="guide-sub-heading">A surveyor helps with:</div>
                <ul class="guide-list">
                    <li>Land measurement</li>
                    <li>Boundary identification</li>
                    <li>Contour survey</li>
                    <li>Site level checking</li>
                    <li>Marking the plot</li>
                    <li>Checking slope and drainage levels</li>
                </ul>

                <p>
                    If the land is uneven, on slope, agricultural converted land, or a large size land parcel,
                    the surveyor becomes very important.
                </p>

                <div class="guide-sub-heading">Why This Role Matters</div>
                <p>
                    Before design starts, the actual site dimensions and levels should be known properly.
                    If the architect works on wrong site dimensions, the whole planning can get affected.
                </p>

                <div class="guide-sub-heading">How ConstructKaro Helps:</div>
                <p>
                    On ConstructKaro, customers can find surveyors for land measurement, contour mapping,
                    and site marking, helping them begin the project on the right base.
                </p>
            </div>

            <div class="guide-section blue">
                <h2>2. Architect</h2>

                <div class="guide-sub-heading">What Does an Architect Do?</div>
                <p>
                    An Architect is the professional who plans the building layout, space design, look, function,
                    and overall building concept.
                </p>

                <div class="guide-sub-heading">An architect helps with:</div>
                <ul class="guide-list">
                    <li>Floor plan design</li>
                    <li>Space planning</li>
                    <li>Elevation design</li>
                    <li>Ventilation and light planning</li>
                    <li>Room arrangement</li>
                    <li>Building approval drawings</li>
                    <li>Future expansion planning</li>
                </ul>

                <p>
                    The architect converts your requirement into a practical building plan.
                </p>

                <div class="guide-sub-heading">For example, if a customer wants:</div>
                <ul class="guide-list guide-blue-list">
                    <li>3BHK house</li>
                    <li>Parking</li>
                    <li>Pooja room</li>
                    <li>Future first-floor expansion</li>
                    <li>Proper ventilation</li>
                    <li>Modern front elevation</li>
                </ul>

                <p>
                    Then the architect plans all this in a proper and usable design.
                </p>

                <div class="guide-sub-heading">Why This Role Matters</div>
                <p>
                    Without proper design, construction may start in a random way and later create issues
                    in comfort, appearance, and functionality.
                </p>

                <div class="guide-sub-heading">How ConstructKaro Helps:</div>
                <p>
                    ConstructKaro helps customers connect with architects who can plan homes, villas, buildings,
                    shops, offices, and industrial layouts based on customer requirements.
                </p>
            </div>

            <div class="guide-section orange">
                <h2>3. Consultant</h2>

                <div class="guide-sub-heading">What Does a Consultant Do?</div>
                <p>
                    A Consultant is a broad professional role. In construction, a consultant can be someone who gives
                    technical, planning, legal, cost, structural, project, or approval guidance.
                </p>

                <div class="guide-sub-heading">A consultant may help with:</div>
                <ul class="guide-list">
                    <li>Project planning</li>
                    <li>Technical feasibility</li>
                    <li>Approval guidance</li>
                    <li>Construction strategy</li>
                    <li>Structural advice</li>
                    <li>Budgeting support</li>
                    <li>Material recommendations</li>
                    <li>Project coordination</li>
                </ul>

                <p>
                    In simple terms, a consultant supports better decision-making before or during execution.
                </p>
            </div>

            <div class="guide-section blue">
                <h2>4. Contractor</h2>

                <div class="guide-sub-heading">What Does a Contractor Do?</div>
                <p>
                    A Contractor is the professional or company responsible for actually executing the construction work on site.
                </p>

                <div class="guide-sub-heading">A contractor handles:</div>
                <ul class="guide-list">
                    <li>Labour arrangement</li>
                    <li>Material coordination</li>
                    <li>Site execution</li>
                    <li>Foundation work</li>
                    <li>RCC work</li>
                    <li>Brickwork</li>
                    <li>Plaster</li>
                    <li>Finishing work</li>
                    <li>Daily construction management</li>
                </ul>

                <p>
                    In simple words, the contractor is the one who builds the project physically as per drawing,
                    design, and scope.
                </p>

                <div class="guide-sub-heading">Why This Role Matters</div>
                <p>
                    Even the best design can fail if execution quality is poor.
                    A contractor plays a major role in turning paper drawings into actual construction.
                </p>

                <div class="guide-note-box">
                    <h3>Important Note</h3>
                    <p>
                        A contractor is usually not the first role in most projects. If you hire a contractor before proper planning,
                        you may face wrong budgeting, design confusion, scope mismatch, rework, and execution disputes.
                    </p>
                </div>

                <div class="guide-sub-heading">How ConstructKaro Helps:</div>
                <p>
                    ConstructKaro connects customers with verified contractors for residential, commercial, renovation,
                    industrial, and specialized construction work.
                </p>
            </div>

            <div class="guide-section orange">
                <h2>5. Interior Designer</h2>

                <div class="guide-sub-heading">What Does an Interior Designer Do?</div>
                <p>
                    An Interior Designer works on the internal look, feel, functionality, and finishing of the built space.
                </p>

                <div class="guide-sub-heading">An interior designer helps with:</div>
                <ul class="guide-list">
                    <li>Furniture layout</li>
                    <li>Modular kitchen planning</li>
                    <li>Wardrobe design</li>
                    <li>False ceiling design</li>
                    <li>Wall finishes</li>
                    <li>Lighting concept</li>
                    <li>Space aesthetics</li>
                    <li>Storage optimization</li>
                    <li>Color and material selection</li>
                </ul>

                <p>
                    This role usually becomes more active after the architectural planning stage and closer to finishing stage,
                    though early involvement can improve results.
                </p>

                <div class="guide-sub-heading">Why This Role Matters</div>
                <p>
                    A building may be structurally complete, but without proper interior planning,
                    the inside may not feel comfortable, efficient, or visually appealing.
                </p>

                <div class="guide-sub-heading">How ConstructKaro Helps:</div>
                <p>
                    ConstructKaro helps customers find interior designers for homes, offices, shops, showrooms,
                    and renovation projects, making the final space more useful and attractive.
                </p>
            </div>

            <div class="guide-conclusion">
                <h2>Conclusion</h2>
                <p>
                    Every professional in construction has a different role, and each one becomes important at a different stage.
                </p>

                <div class="guide-sub-heading">To simplify:</div>
                <ul class="guide-list guide-blue-list">
                    <li>Surveyor checks the land</li>
                    <li>Architect plans the building</li>
                    <li>Consultant gives expert guidance</li>
                    <li>Contractor builds the project</li>
                    <li>Interior Designer improves the inside space</li>
                </ul>

                <div class="guide-sub-heading">The right order usually is:</div>
                <p class="guide-strong-line">
                    Surveyor → Architect → Consultant → Contractor → Interior Designer
                </p>

                <p>
                    When customers understand this flow, they make better decisions, reduce mistakes,
                    and save both time and money.
                </p>

                <p class="guide-strong-line">
                    With ConstructKaro, you can find the right professional for every stage of your construction journey.
                </p>
            </div>

        </div>
    </div>
</section>
@endsection