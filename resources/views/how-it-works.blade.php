<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConstructKaro Process Flow</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f6f8fb;
            color: #1c2c3e;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
        }

        .container {
            width: 100%;
            max-width: 1320px;
            margin: auto;
            padding: 0 20px;
        }

        .section-space {
            padding: 70px 0;
        }

        .main-title {
            text-align: center;
            margin-bottom: 15px;
            font-size: 38px;
            font-weight: 800;
            color: #1c2c3e;
        }

        .main-subtitle {
            text-align: center;
            max-width: 850px;
            margin: 0 auto 50px;
            font-size: 16px;
            color: #5f6b7a;
        }

        .title-line {
            width: 120px;
            height: 5px;
            background: linear-gradient(to right, #1c2c3e 50%, #f25c05 50%);
            margin: 0 auto 25px;
            border-radius: 50px;
        }

        /* HERO */
        .hero-section {
            background: linear-gradient(135deg, #1c2c3e 0%, #243b55 100%);
            color: #fff;
            padding: 90px 0 80px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: -120px;
            right: -120px;
            width: 320px;
            height: 320px;
            background: rgba(242, 92, 5, 0.12);
            border-radius: 50%;
        }

        .hero-section::after {
            content: "";
            position: absolute;
            bottom: -130px;
            left: -130px;
            width: 340px;
            height: 340px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(242, 92, 5, 0.15);
            color: #ffb07d;
            border: 1px solid rgba(242, 92, 5, 0.25);
            padding: 10px 18px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .hero-title {
            font-size: 48px;
            line-height: 1.2;
            font-weight: 800;
            margin-bottom: 18px;
        }

        .hero-title span {
            color: #f25c05;
        }

        .hero-text {
            max-width: 900px;
            margin: 0 auto 35px;
            color: #d8e0ea;
            font-size: 17px;
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 40px;
        }

        .hero-stat-card {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(8px);
            border-radius: 18px;
            padding: 24px;
        }

        .hero-stat-card h3 {
            font-size: 34px;
            color: #fff;
            margin-bottom: 8px;
            font-weight: 800;
        }

        .hero-stat-card p {
            color: #dce5ef;
            font-size: 14px;
        }

        /* DESK SECTION */
        .desk-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 28px;
        }

        .desk-card {
            background: #fff;
            border-radius: 22px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(28, 44, 62, 0.08);
            border: 1px solid #edf1f6;
            transition: 0.3s ease;
        }

        .desk-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(28, 44, 62, 0.12);
        }

        .desk-label {
            display: inline-block;
            background: #fff4ee;
            color: #f25c05;
            font-weight: 700;
            font-size: 13px;
            padding: 7px 14px;
            border-radius: 30px;
            margin-bottom: 14px;
        }

        .desk-card h3 {
            font-size: 25px;
            margin-bottom: 10px;
            color: #1c2c3e;
            font-weight: 800;
        }

        .desk-owner {
            font-size: 14px;
            font-weight: 600;
            color: #6f7b8a;
            margin-bottom: 18px;
        }

        .desk-card p {
            font-size: 15px;
            color: #5b6572;
            margin-bottom: 18px;
        }

        .desk-subtitle {
            font-size: 16px;
            font-weight: 700;
            color: #1c2c3e;
            margin: 16px 0 12px;
        }

        .desk-list {
            list-style: none;
            padding-left: 0;
            margin-bottom: 18px;
        }

        .desk-list li {
            position: relative;
            padding-left: 24px;
            margin-bottom: 10px;
            color: #51606f;
            font-size: 15px;
        }

        .desk-list li::before {
            content: "•";
            position: absolute;
            left: 0;
            top: -1px;
            color: #f25c05;
            font-size: 20px;
            line-height: 1;
        }

        .desk-output {
            background: #f8fbff;
            border-left: 4px solid #f25c05;
            padding: 14px 16px;
            border-radius: 12px;
            font-size: 14px;
            color: #1c2c3e;
            font-weight: 600;
        }

        /* PIPELINE */
        .pipeline-wrapper {
            position: relative;
            max-width: 950px;
            margin: 0 auto;
        }

        .pipeline-wrapper::before {
            content: "";
            position: absolute;
            top: 0;
            left: 34px;
            width: 3px;
            height: 100%;
            background: linear-gradient(to bottom, #1c2c3e, #f25c05);
            border-radius: 10px;
        }

        .pipeline-step {
            position: relative;
            display: flex;
            gap: 25px;
            margin-bottom: 28px;
            align-items: flex-start;
        }

        .pipeline-number {
            min-width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1c2c3e, #2f4866);
            color: #fff;
            font-size: 24px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            box-shadow: 0 8px 25px rgba(28, 44, 62, 0.25);
        }

        .pipeline-content {
            flex: 1;
            background: #fff;
            padding: 22px 24px;
            border-radius: 18px;
            box-shadow: 0 8px 28px rgba(28, 44, 62, 0.08);
            border: 1px solid #edf1f6;
        }

        .pipeline-content h4 {
            font-size: 20px;
            font-weight: 800;
            color: #1c2c3e;
            margin-bottom: 8px;
        }

        .pipeline-content p {
            font-size: 15px;
            color: #5e6978;
            margin: 0;
        }

        /* RESPONSIBILITY BLOCKS */
        .responsibility-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        .responsibility-card {
            background: #fff;
            border-radius: 18px;
            padding: 26px;
            border: 1px solid #ebeff4;
            box-shadow: 0 8px 25px rgba(28, 44, 62, 0.06);
        }

        .responsibility-card h3 {
            font-size: 22px;
            margin-bottom: 14px;
            color: #1c2c3e;
            font-weight: 800;
        }

        /* CTA */
        .cta-section {
            background: linear-gradient(135deg, #f25c05 0%, #ff7a2f 100%);
            color: #fff;
            border-radius: 28px;
            padding: 50px 40px;
            text-align: center;
        }

        .cta-section h2 {
            font-size: 34px;
            margin-bottom: 14px;
            font-weight: 800;
        }

        .cta-section p {
            max-width: 780px;
            margin: 0 auto 22px;
            font-size: 16px;
            color: #fff6f2;
        }

        .cta-btn {
            display: inline-block;
            background: #fff;
            color: #f25c05;
            padding: 14px 28px;
            font-weight: 700;
            border-radius: 50px;
            transition: 0.3s ease;
        }

        .cta-btn:hover {
            background: #1c2c3e;
            color: #fff;
        }

        /* RESPONSIVE */
        @media (max-width: 1100px) {
            .hero-stats,
            .desk-grid,
            .responsibility-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 34px;
            }

            .hero-stats,
            .desk-grid,
            .responsibility-grid {
                grid-template-columns: 1fr;
            }

            .pipeline-wrapper::before {
                left: 24px;
            }

            .pipeline-number {
                min-width: 50px;
                height: 50px;
                font-size: 18px;
            }

            .pipeline-step {
                gap: 16px;
            }

            .main-title {
                font-size: 28px;
            }

            .cta-section h2 {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>

    <!-- HERO SECTION -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">ConstructKaro Internal Workflow</div>
                <h1 class="hero-title">How We <span>Develop, Structure & Execute</span> Every Project</h1>
                <p class="hero-text">
                    From first inquiry to final execution, our process is built to bring clarity, accountability,
                    technical understanding, partner allocation, and project monitoring into one structured system.
                </p>

                <div class="hero-stats">
                    <div class="hero-stat-card">
                        <h3>4</h3>
                        <p>Core operational desks</p>
                    </div>
                    <div class="hero-stat-card">
                        <h3>12</h3>
                        <p>Pipeline stages from lead to completion</p>
                    </div>
                    <div class="hero-stat-card">
                        <h3>1</h3>
                        <p>Structured execution-driven workflow</p>
                    </div>
                    <div class="hero-stat-card">
                        <h3>360°</h3>
                        <p>Customer, vendor and project coordination</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- DESKS -->
    <section class="section-space">
        <div class="container">
            <h2 class="main-title">Our Core Desk Structure</h2>
            <div class="title-line"></div>
            <p class="main-subtitle">
                Each desk has a defined role so that raw inquiries get converted into structured and executable projects.
            </p>

            <div class="desk-grid">

                <div class="desk-card">
                    <div class="desk-label">01. Lead Desk</div>
                    <h3>Lead Desk (Frontline)</h3>
                    <div class="desk-owner">Owner: Telecallers / Initial Team</div>
                    <p>
                        This is the first contact point where incoming requirements from web, WhatsApp, calls, or referrals
                        are received and qualified.
                    </p>

                    <div class="desk-subtitle">Responsibilities</div>
                    <ul class="desk-list">
                        <li>Receive customer requirements from multiple channels</li>
                        <li>Call customer immediately for first-level understanding</li>
                        <li>Understand project type, budget, location, and urgency</li>
                        <li>Collect basic documents, site photos, and drawings if available</li>
                        <li>Classify lead as Timepass, Exploring, or Serious</li>
                        <li>Arrange initial discussion or technical review if required</li>
                    </ul>

                    <div class="desk-output">
                        Output: Qualified case is transferred to Engineer Desk
                    </div>
                </div>

                <div class="desk-card">
                    <div class="desk-label">02. Engineer Desk</div>
                    <h3>Engineer Desk (Core Engine)</h3>
                    <div class="desk-owner">Owner: Manali | Very Critical Role</div>
                    <p>
                        This is the technical, commercial, and documentation powerhouse desk where requirements are converted
                        into a structured project plan.
                    </p>

                    <div class="desk-subtitle">Technical Understanding</div>
                    <ul class="desk-list">
                        <li>Understand exactly what customer wants</li>
                        <li>Ask for drawings, BOQ, plot size, area, and site condition</li>
                        <li>Decide required service type: contractor, architect, consultant, testing, or survey</li>
                    </ul>

                    <div class="desk-subtitle">Lead Structuring</div>
                    <ul class="desk-list">
                        <li>Convert raw inquiry into structured project summary</li>
                        <li>Define project type, location, budget, requirement, timeline, and priority</li>
                    </ul>

                    <div class="desk-subtitle">Commercial & Documentation</div>
                    <ul class="desk-list">
                        <li>Finalize pricing, margin, working terms, and payment structure</li>
                        <li>Prepare proposal, quotation, agreement, work order, and legal process where required</li>
                        <li>Create project file and internal tracking sheet</li>
                    </ul>

                    <div class="desk-output">
                        Output: Structured project is sent forward for partner allocation and execution planning
                    </div>
                </div>

                <div class="desk-card">
                    <div class="desk-label">03. Partner Allocation Desk</div>
                    <h3>Partner Allocation Desk</h3>
                    <div class="desk-owner">Owners: Darshana + Sakshi</div>
                    <p>
                        This is the supply engine that connects the structured project with the right contractor, architect,
                        consultant, or specialist vendor.
                    </p>

                    <div class="desk-subtitle">Responsibilities</div>
                    <ul class="desk-list">
                        <li>Select 3 to 5 relevant partners based on location, category, and performance</li>
                        <li>Share requirement summary, drawings, and project details properly</li>
                        <li>Collect vendor response, availability, quote, and site visit confirmation</li>
                        <li>Compare price, capability, and timeline in a structured way</li>
                        <li>Support onboarding and communication between teams</li>
                    </ul>

                    <div class="desk-output">
                        Output: Final partner recommendation is prepared for execution
                    </div>
                </div>

                <div class="desk-card">
                    <div class="desk-label">04. Project Monitoring</div>
                    <h3>Project Monitoring / Coordination</h3>
                    <div class="desk-owner">Initially handled by Manali | Later separate hire</div>
                    <p>
                        Once the project starts, this desk focuses on progress coordination, partner follow-up,
                        customer communication, timeline checks, and issue escalation.
                    </p>

                    <div class="desk-subtitle">Responsibilities</div>
                    <ul class="desk-list">
                        <li>Project start confirmation and milestone tracking</li>
                        <li>Client and partner follow-up</li>
                        <li>Basic quality coordination and timeline monitoring</li>
                        <li>Issue handling and escalation support</li>
                        <li>Billing and payment follow-up support</li>
                        <li>Project closure and completion tracking</li>
                    </ul>

                    <div class="desk-output">
                        Output: Controlled execution with visibility on progress, payment, and completion
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- RESPONSIBILITY OVERVIEW -->
    <section class="section-space" style="background:#eef3f8;">
        <div class="container">
            <h2 class="main-title">Responsibility Overview</h2>
            <div class="title-line"></div>
            <p class="main-subtitle">
                A simplified view of what each desk handles inside the complete project development cycle.
            </p>

            <div class="responsibility-grid">
                <div class="responsibility-card">
                    <h3>1. Lead Desk</h3>
                    <ul class="desk-list">
                        <li>Receive inquiry from website, WhatsApp, calls, or referrals</li>
                        <li>Respond immediately and collect basic details</li>
                        <li>Qualify seriousness of inquiry</li>
                        <li>Arrange first discussion, site visit, or review</li>
                        <li>Send qualified case to Engineer Desk</li>
                    </ul>
                </div>

                <div class="responsibility-card">
                    <h3>2. Engineer Desk</h3>
                    <ul class="desk-list">
                        <li>Understand requirement technically</li>
                        <li>Structure project internally</li>
                        <li>Decide execution model</li>
                        <li>Map right service partners</li>
                        <li>Finalize commercial approach and documents</li>
                    </ul>
                </div>

                <div class="responsibility-card">
                    <h3>3. Execution Partner Desk</h3>
                    <ul class="desk-list">
                        <li>Coordinate with contractor, architect, consultant, or vendor</li>
                        <li>Share requirement and project documents</li>
                        <li>Confirm readiness, capability, and availability</li>
                        <li>Arrange site visit and technical discussions</li>
                        <li>Support onboarding and communication</li>
                    </ul>
                </div>

                <div class="responsibility-card">
                    <h3>4. Project Monitoring</h3>
                    <ul class="desk-list">
                        <li>Track milestones and timelines</li>
                        <li>Follow up with customer and partner</li>
                        <li>Check basic execution progress</li>
                        <li>Handle issues, escalation, and support billing coordination</li>
                        <li>Monitor completion and closure</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- PIPELINE -->
    <section class="section-space">
        <div class="container">
            <h2 class="main-title">Complete Project Pipeline</h2>
            <div class="title-line"></div>
            <p class="main-subtitle">
                This is the full project movement from customer inquiry to execution and tracking.
            </p>

            <div class="pipeline-wrapper">

                <div class="pipeline-step">
                    <div class="pipeline-number">1</div>
                    <div class="pipeline-content">
                        <h4>Website / Lead Form</h4>
                        <p>Customer submits inquiry through website, WhatsApp, call, or referral source.</p>
                    </div>
                </div>

                <div class="pipeline-step">
                    <div class="pipeline-number">2</div>
                    <div class="pipeline-content">
                        <h4>Telecaller Dashboard</h4>
                        <p>Lead is logged into the system and made ready for qualification call.</p>
                    </div>
                </div>

                <div class="pipeline-step">
                    <div class="pipeline-number">3</div>
                    <div class="pipeline-content">
                        <h4>Call & Qualification</h4>
                        <p>Requirement, budget, seriousness, timeline, and location are validated.</p>
                    </div>
                </div>

                <div class="pipeline-step">
                    <div class="pipeline-number">4</div>
                    <div class="pipeline-content">
                        <h4>Mark Qualified</h4>
                        <p>Lead is marked qualified and approved for technical engineer review.</p>
                    </div>
                </div>

                <div class="pipeline-step">
                    <div class="pipeline-number">5</div>
                    <div class="pipeline-content">
                        <h4>Engineer Desk Review</h4>
                        <p>Project is transferred for internal technical assessment and requirement structuring.</p>
                    </div>
                </div>

                <div class="pipeline-step">
                    <div class="pipeline-number">6</div>
                    <div class="pipeline-content">
                        <h4>Technical Review</h4>
                        <p>Drawings, site photos, BOQ inputs, area details, and site condition are reviewed.</p>
                    </div>
                </div>

                <div class="pipeline-step">
                    <div class="pipeline-number">7</div>
                    <div class="pipeline-content">
                        <h4>Assign Partner / Contractor</h4>
                        <p>The most suitable service provider is selected based on category, capability, and location.</p>
                    </div>
                </div>

                <div class="pipeline-step">
                    <div class="pipeline-number">8</div>
                    <div class="pipeline-content">
                        <h4>Create Proposal</h4>
                        <p>A structured quote is created with scope, timeline, commercials, and payment schedule.</p>
                    </div>
                </div>

                <div class="pipeline-step">
                    <div class="pipeline-number">9</div>
                    <div class="pipeline-content">
                        <h4>Customer Approval</h4>
                        <p>Customer reviews the proposal and confirms the next step for execution.</p>
                    </div>
                </div>

                <div class="pipeline-step">
                    <div class="pipeline-number">10</div>
                    <div class="pipeline-content">
                        <h4>Work Order Created</h4>
                        <p>Agreement is locked, work order is created, and advance payment is collected.</p>
                    </div>
                </div>

                <div class="pipeline-step">
                    <div class="pipeline-number">11</div>
                    <div class="pipeline-content">
                        <h4>Execution Started</h4>
                        <p>Project begins with proper coordination, assigned partner, and milestone-level visibility.</p>
                    </div>
                </div>

                <div class="pipeline-step">
                    <div class="pipeline-number">12</div>
                    <div class="pipeline-content">
                        <h4>Project Tracking</h4>
                        <p>Track progress, timelines, follow-ups, quality coordination, payments, and closure.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section-space">
        <div class="container">
            <div class="cta-section">
                <h2>One Structured System. From Lead to Execution.</h2>
                <p>
                    This process helps us avoid confusion, improve coordination, structure customer requirements properly,
                    assign the right partner, and monitor execution with better control.
                </p>
                <a href="#" class="cta-btn">Start Building Your Process</a>
            </div>
        </div>
    </section>

</body>
</html>