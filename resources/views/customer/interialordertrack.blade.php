@extends('layouts.app')

@section('title', 'Interior Order Tracking')

@section('content')

<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background: #f3f3f3;
        color: #222;
    }

    .tracking-page {
        padding: 24px 16px 50px;
        background: #f3f3f3;
        min-height: 100vh;
    }

    .tracking-container {
        max-width: 1120px;
        margin: 0 auto;
    }

    .tracking-topbar {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .back-btn {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #2f7ec6;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(47, 126, 198, 0.22);
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .back-btn:hover {
        transform: translateY(-1px);
    }

    .back-btn svg {
        width: 16px;
        height: 16px;
        fill: #fff;
    }

    .tracking-tabs {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .tracking-tab {
        min-width: 210px;
        height: 44px;
        padding: 0 22px;
        border: none;
        border-radius: 999px;
        background: #fff;
        color: #111;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        transition: all 0.3s ease;
    }

    .tracking-tab.active-orange {
        background: linear-gradient(180deg, #f3902f 0%, #e9781b 100%);
        color: #fff;
    }

    .tracking-tab.active-blue {
        background: linear-gradient(180deg, #2f7ec6 0%, #2a6cac 100%);
        color: #fff;
    }

    .tracking-panel {
        display: none;
    }

    .tracking-panel.active {
        display: block;
    }

    .tracking-box {
        border-radius: 18px;
        padding: 16px;
    }

    .tracking-box.orange-theme {
        background: #efe2d5;
        border: 2px solid #ef7f2d;
    }

    .tracking-box.blue-theme {
        background: #e7f1fb;
        border: 2px solid #7fb0e2;
    }

    .tracking-steps {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .tracking-step-row {
        display: grid;
        grid-template-columns: 72px 1fr;
        gap: 14px;
        align-items: stretch;
    }

    .step-left {
        position: relative;
        display: flex;
        justify-content: center;
    }

    .step-icon-wrap {
        position: relative;
        width: 72px;
        display: flex;
        justify-content: center;
    }

    .step-line {
        position: absolute;
        top: 38px;
        bottom: -22px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        background: #bdbdbd;
        z-index: 0;
    }

    .tracking-step-row:last-child .step-line {
        display: none;
    }

    .step-icon {
        position: relative;
        z-index: 2;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #fff;
        border: 2px solid #c7c7c7;
        box-shadow: 0 2px 7px rgba(0,0,0,0.10);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #8f8f8f;
        font-size: 18px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .step-icon svg {
        width: 17px;
        height: 17px;
        fill: currentColor;
    }

    .tracking-step-row.completed .step-icon {
        background: #12b24a;
        border-color: #12b24a;
        color: #fff;
    }

    .tracking-step-row.completed .step-line {
        background: #12b24a;
    }

    .tracking-step-row.pending-orange .step-icon {
        background: #fff;
        border-color: #ef7f2d;
        color: #ef7f2d;
    }

    .tracking-step-row.pending-orange .step-line {
        background: #ef7f2d;
    }

    .tracking-step-row.pending-blue .step-icon {
        background: #fff;
        border-color: #2f7ec6;
        color: #2f7ec6;
    }

    .tracking-step-row.pending-blue .step-line {
        background: #2f7ec6;
    }

    .tracking-step-row.locked .step-icon {
        background: #f5f5f5;
        border-color: #bdbdbd;
        color: #9b9b9b;
    }

    .tracking-step-row.locked .step-line {
        background: #bdbdbd;
    }

    .track-card {
        background: #fff;
        border: 1px solid #e9e9e9;
        border-radius: 10px;
        padding: 12px 14px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        min-height: 70px;
    }

    .track-card h4 {
        margin: 0 0 5px;
        font-size: 15px;
        font-weight: 800;
        color: #111;
        line-height: 1.3;
    }

    .track-card p {
        margin: 0 0 7px;
        font-size: 12px;
        color: #666;
        line-height: 1.45;
    }

    .track-status {
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .track-status.completed {
        color: #12b24a;
    }

    .track-status.pending {
        color: #ef7f2d;
    }

    .status-row {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        align-items: center;
    }

    .action-row {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 8px;
    }

    .mini-btn {
        min-width: 68px;
        min-height: 28px;
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
        line-height: 1.1;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .mini-btn:hover {
        transform: translateY(-1px);
        opacity: 0.94;
    }

    .mini-btn.orange {
        background: #ef7f2d;
        color: #fff;
    }

    .mini-btn.blue {
        background: #2f7ec6;
        color: #fff;
    }

    .mini-btn.light {
        background: #f0f0f0;
        color: #222;
    }

    .chip-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 8px;
        margin-top: 8px;
    }

    .option-chip {
        min-height: 30px;
        border-radius: 6px;
        border: none;
        font-size: 11px;
        font-weight: 700;
        padding: 7px 10px;
        cursor: pointer;
        background: #f3e5d9;
        color: #222;
        text-align: center;
    }

    .option-chip.active {
        background: #ef7f2d;
        color: #fff;
    }

    .text-input-box {
        margin-top: 8px;
    }

    .text-input-box textarea {
        width: 100%;
        min-height: 64px;
        border: none;
        outline: none;
        resize: vertical;
        border-radius: 6px;
        background: #efefef;
        padding: 10px 12px;
        font-size: 12px;
        color: #333;
        font-family: 'Poppins', sans-serif;
    }

    .submit-small-btn {
        height: 24px;
        padding: 0 10px;
        border: none;
        border-radius: 5px;
        background: #2f7ec6;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .final-orange {
        background: linear-gradient(180deg, #f18624 0%, #e97316 100%);
        border: none;
    }

    .final-orange h4,
    .final-orange p {
        color: #fff;
    }

    .final-blue {
        background: linear-gradient(180deg, #2f7ec6 0%, #2a6cac 100%);
        border: none;
    }

    .final-blue h4,
    .final-blue p,
    .final-blue .progress-head {
        color: #fff;
    }

    .progress-wrap {
        margin-top: 10px;
    }

    .progress-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .progress-bar {
        width: 100%;
        height: 7px;
        border-radius: 999px;
        background: rgba(255,255,255,0.30);
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: #fff;
        border-radius: 999px;
    }

    @media (max-width: 991px) {
        .tracking-tab {
            min-width: 180px;
        }
    }

    @media (max-width: 767px) {
        .tracking-page {
            padding: 18px 12px 40px;
        }

        .tracking-step-row {
            grid-template-columns: 1fr;
        }

        .step-left {
            display: none;
        }

        .tracking-tab {
            min-width: 100%;
        }

        .track-card h4 {
            font-size: 14px;
        }

        .mini-btn,
        .option-chip {
            width: 100%;
        }

        .chip-grid {
            grid-template-columns: 1fr;
        }

        .status-row {
            gap: 8px;
            flex-direction: column;
            align-items: flex-start;
        }

        .action-row[style*="space-between"] {
            justify-content: flex-start !important;
        }
    }
</style>

<div class="tracking-page">
    <div class="tracking-container">

        <div class="tracking-topbar">
            <a href="{{ url()->previous() }}" class="back-btn">
                <svg viewBox="0 0 24 24">
                    <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"></path>
                </svg>
            </a>

            <div class="tracking-tabs">
                <button type="button" class="tracking-tab" data-tab="executionTrackingPanel">
                    Project Execution Progress
                </button>
                <button type="button" class="tracking-tab active-orange" data-tab="orderTrackingPanel">
                    Order Tracking
                </button>
            </div>
        </div>

        <!-- ORDER TRACKING -->
        <div class="tracking-panel active" id="orderTrackingPanel">
            <div class="tracking-box orange-theme">
                <div class="tracking-steps">

                    <div class="tracking-step-row completed">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8zm0 2.5L18.5 9H14zM8 13h8v1.5H8zm0 3h8v1.5H8zm0-6h5v1.5H8z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>Requirement Submitted</h4>
                            <p>Your requirement has been submitted successfully.</p>
                            <div class="track-status completed">◦ Completed</div>
                        </div>
                    </div>

                    <div class="tracking-step-row completed">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M10 2a8 8 0 105.293 14.293l4.707 4.707 1.414-1.414-4.707-4.707A8 8 0 0010 2z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>Under Review</h4>
                            <p>Our team is reviewing your requirement.</p>
                            <div class="track-status completed">◦ Completed</div>
                        </div>
                    </div>

                    <div class="tracking-step-row completed">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M6.62 10.79a15.53 15.53 0 006.59 6.59l2.2-2.2a1 1 0 011.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 011 1V20a1 1 0 01-1 1C10.85 21 3 13.15 3 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.25.2 2.46.57 3.58a1 1 0 01-.25 1.01z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>Call Scheduled / Team Contacted You</h4>
                            <p>Our representative has reached out to you within 24 working hours.</p>
                            <div class="track-status completed">◦ Completed</div>
                        </div>
                    </div>

                    <div class="tracking-step-row pending-orange">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">?</div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>Do you want ConstructKaro to execute your project?</h4>
                            <div class="action-row">
                                <button type="button" class="mini-btn orange">Yes</button>
                                <button type="button" class="mini-btn light">No</button>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row pending-orange">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M4 4h16v16H4zm2 2v12h12V6zm2 2h8v2H8zm0 4h8v2H8zm0 4h6v2H8z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>What type of interior work do you need?</h4>
                            <div class="chip-grid">
                                <button type="button" class="option-chip active">Full Home Interior</button>
                                <button type="button" class="option-chip">Modular Kitchen</button>
                                <button type="button" class="option-chip">Wardrobe</button>
                                <button type="button" class="option-chip">Living Room Design</button>
                                <button type="button" class="option-chip">Bedroom Interior</button>
                                <button type="button" class="option-chip">Office Interior</button>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row locked">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M3 5h18v14H3zm2 2v10h14V7zm2 2h10v2H7zm0 4h6v2H7z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>Do you need 3D Design / Visualization?</h4>
                            <div class="action-row">
                                <button type="button" class="mini-btn orange">Yes</button>
                                <button type="button" class="mini-btn light">No</button>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row locked">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M4 3h16v18H4zm2 2v14h12V5zm2 3h8v2H8zm0 4h8v2H8z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>Do you need BOQ / Cost Estimation?</h4>
                            <div class="action-row">
                                <button type="button" class="mini-btn orange">Yes</button>
                                <button type="button" class="mini-btn light">No</button>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row completed">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M9 16.2l-3.5-3.5L4 14.2l5 5 11-11-1.5-1.5z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>Your service preferences have been submitted</h4>
                        </div>
                    </div>

                    <div class="tracking-step-row pending-orange">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">₹</div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>Rate Discussion</h4>
                            <p>We have completed the rate discussion over the call. Are you satisfied with and agree to the discussed pricing and services?</p>
                            <div class="action-row">
                                <button type="button" class="mini-btn orange">Yes</button>
                                <button type="button" class="mini-btn light">No</button>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row locked">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M4 5h16v14H4zm2 2v10h12V7zm2 1h8v2H8zm0 4h6v2H8z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>Agreement Sent to Email</h4>
                            <div class="action-row">
                                <a href="#" class="mini-btn orange">Download Agreement</a>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row locked">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M7 4h10l3 4v8h-3v4H4V4zm2 2v4h6V6zm-3 10h8v2H6z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>Payment Stage</h4>
                            <p>Please complete 10% Advance payment to proceed</p>
                            <div class="action-row">
                                <a href="#" class="mini-btn orange">Payment</a>
                                <a href="#" class="mini-btn orange">Download Tax Invoice</a>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row pending-orange">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M12 2L5 14h4v8l7-12h-4z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="track-card final-orange">
                            <h4>Work Will Start Within 7 Days</h4>
                            <p>Our team will begin work at your site shortly.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- PROJECT EXECUTION PROGRESS -->
        <div class="tracking-panel" id="executionTrackingPanel">
            <div class="tracking-box blue-theme">
                <div class="tracking-steps">

                    <div class="tracking-step-row completed">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5A2.5 2.5 0 1112 6a2.5 2.5 0 010 5.5z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>Site visit will be scheduled</h4>
                            <p>Architect visited site, checks actual dimensions, understands entry, road side, slope, sunlight, surrounding condition discusses exact room placement and planning on site</p>
                            <div class="track-status completed">◦ Completed</div>
                        </div>
                    </div>

                    <div class="tracking-step-row completed">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-4.42 0-8 2.24-8 5v1h16v-1c0-2.76-3.58-5-8-5z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>Site Visit Completed</h4>
                            <div class="track-status completed">◦ Completed</div>
                        </div>
                    </div>

                    <div class="tracking-step-row completed">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8zm0 2.5L18.5 9H14zM8 13h8v1.5H8zm0 3h8v1.5H8zm0-6h5v1.5H8z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>Planning Discussion</h4>
                            <p>where bedroom should come, hall position, kitchen location, staircase, toilet positions, parking, balcony, vastu needs, number of floors</p>
                            <div class="track-status completed">◦ Completed</div>
                        </div>
                    </div>

                    <div class="tracking-step-row pending-blue">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">₹</div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>Payment Stage</h4>
                            <p>Please complete 50% payment to proceed</p>
                            <div class="action-row">
                                <a href="#" class="mini-btn blue">Payment</a>
                                <a href="#" class="mini-btn blue">Download Tax Invoice</a>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row locked">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M12 21l-7-7 1.4-1.4 4.6 4.6 7.6-7.6L20 11z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>Your project is now approved for architectural design development.</h4>
                        </div>
                    </div>

                    <div class="tracking-step-row locked">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M4 3h16v18H4zm2 2v14h12V5zm2 3h8v2H8zm0 4h8v2H8z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>Preliminary Drawing Ready</h4>
                            <div class="action-row">
                                <a href="#" class="mini-btn blue">View Drawing</a>
                                <a href="#" class="mini-btn blue">Download Draft</a>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row locked">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M3 4h18v16H3zm2 2v12h14V6zm2 2h10v2H7zm0 4h10v2H7z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>Drawing Review</h4>
                            <p>Do you want any changes if yes?</p>
                            <div class="text-input-box">
                                <textarea placeholder="Describe your changes"></textarea>
                            </div>
                            <div class="action-row" style="justify-content: space-between; align-items: center;">
                                <a href="#" class="mini-btn blue">Approve Design</a>
                                <button type="button" class="submit-small-btn">Submit Changes</button>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row locked">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">₹</div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>Final Payment Stage</h4>
                            <p>Please complete 40% payment to proceed</p>
                            <div class="action-row">
                                <a href="#" class="mini-btn blue">Payment</a>
                                <a href="#" class="mini-btn blue">Download Tax Invoice</a>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row locked">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M4 4h16v14H4zm2 2v10h12V6zm2 12h8v2H8z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>Final Drawing Delivered</h4>
                            <div class="action-row">
                                <a href="#" class="mini-btn blue">Download final drawing</a>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row locked">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M12 2a10 10 0 100 20 10 10 0 000-20zm-1 14l-4-4 1.4-1.4 2.6 2.6 5.6-5.6L18 9z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div class="track-card">
                            <h4>Would you also like ConstructKaro to help you with contractor/execution services?</h4>
                            <div class="action-row">
                                <button type="button" class="mini-btn blue">Yes</button>
                                <button type="button" class="mini-btn light">No</button>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row locked">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M12 21l-7-7 1.4-1.4 4.6 4.6 7.6-7.6L20 11z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="track-card final-blue">
                            <h4>Project Completed</h4>
                            <p>Your architectural design is ready!</p>

                            <div class="progress-wrap">
                                <div class="progress-head">
                                    <span>Completed</span>
                                    <span>100%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 100%;"></div>
                                </div>
                            </div>

                            <div class="action-row" style="margin-top: 12px;">
                                <a href="#" class="mini-btn light">View Final Photos</a>
                                <a href="#" class="mini-btn light">Give feedback</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('.tracking-tab');
        const panels = document.querySelectorAll('.tracking-panel');

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                tabs.forEach(function (item) {
                    item.classList.remove('active-orange', 'active-blue');
                });

                panels.forEach(function (panel) {
                    panel.classList.remove('active');
                });

                const targetId = this.getAttribute('data-tab');
                document.getElementById(targetId).classList.add('active');

                if (targetId === 'orderTrackingPanel') {
                    this.classList.add('active-orange');
                } else {
                    this.classList.add('active-blue');
                }
            });
        });
    });
</script>

@endsection