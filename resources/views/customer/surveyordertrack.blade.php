@extends('layouts.app')

@section('title', 'Survey Order Tracking')

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
        background: linear-gradient(180deg, #2f7ec6 0%, #2a6dac 100%);
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
        gap: 12px;
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
        bottom: -24px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        background: #bcbcbc;
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
        padding: 14px 16px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        min-height: 72px;
    }

    .track-card h4 {
        margin: 0 0 6px;
        font-size: 16px;
        font-weight: 800;
        color: #111;
        line-height: 1.3;
    }

    .track-card p {
        margin: 0 0 8px;
        font-size: 12px;
        color: #666;
        line-height: 1.5;
    }

    .status-row {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        align-items: center;
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

    .track-status.blue {
        color: #2f7ec6;
    }

    .action-row {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 8px;
    }

    .mini-btn {
        min-width: 66px;
        height: 30px;
        padding: 0 14px;
        border: none;
        border-radius: 6px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
        line-height: 1;
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
    .final-blue p {
        color: #fff;
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
            font-size: 15px;
        }

        .mini-btn {
            width: 100%;
        }

        .status-row {
            gap: 8px;
            flex-direction: column;
            align-items: flex-start;
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
                <button type="button" class="tracking-tab active-orange" data-tab="orderTrackingPanel">
                    Order Tracking
                </button>
                <button type="button" class="tracking-tab" data-tab="executionTrackingPanel">
                    Project Execution Progress
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
                        <div>
                            <div class="track-card">
                                <h4>Requirement Submitted</h4>
                                <p>Your requirement has been submitted successfully.</p>
                                <div class="track-status completed">◦ Completed</div>
                            </div>
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
                        <div>
                            <div class="track-card">
                                <h4>Under Review</h4>
                                <p>Our team is reviewing your requirement.</p>
                                <div class="track-status completed">◦ Completed</div>
                            </div>
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
                        <div>
                            <div class="track-card">
                                <h4>Call Scheduled / Team Contacted You</h4>
                                <p>Our representative has reached out to you within 24 working hours.</p>
                                <div class="track-status completed">◦ Completed</div>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row pending-orange">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">?</div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div>
                            <div class="track-card">
                                <h4>Do you want ConstructKaro to execute your project?</h4>
                                <div class="action-row">
                                    <button type="button" class="mini-btn orange">Yes</button>
                                    <button type="button" class="mini-btn light">No</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row pending-orange">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M12 2l4 4-4 4V7H8V5h4V2zm0 20l-4-4 4-4v3h4v2h-4v3zM4 12l4-4v3h8v2H8v3l-4-4zm16 0l-4 4v-3H8v-2h8V8l4 4z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div>
                            <div class="track-card">
                                <h4>Please review your chosen survey package before proceeding.</h4>
                                <div class="action-row">
                                    <a href="#" class="mini-btn orange">View Option</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row locked">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">?</div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div>
                            <div class="track-card">
                                <h4>Would you like to proceed with this survey package?</h4>
                                <div class="action-row">
                                    <button type="button" class="mini-btn orange">Yes</button>
                                    <button type="button" class="mini-btn light">No</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row locked">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M4 4h16v16H4zm2 2v12h12V6zm1 2h10v2H7zm0 3h7v2H7z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div>
                            <div class="track-card">
                                <h4>Agreement Sent to Email</h4>
                                <div class="action-row">
                                    <a href="#" class="mini-btn orange">Download Agreement</a>
                                </div>
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
                        <div>
                            <div class="track-card">
                                <h4>Payment Stage</h4>
                                <p>Please complete 10% advance payment to proceed.</p>
                                <div class="action-row">
                                    <a href="#" class="mini-btn orange">Payment</a>
                                    <a href="#" class="mini-btn orange">Download Tax Invoice</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row completed">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M12 2L5 14h4v8l7-12h-4z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="track-card final-orange">
                                <h4>Work Will Start Within 7 Days</h4>
                                <p>Our team will begin work at your site shortly.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- PROJECT EXECUTION PROGRESS -->
        <div class="tracking-panel" id="executionTrackingPanel">
            <div class="tracking-box blue-theme">
                <div class="tracking-steps">

                    <div class="tracking-step-row pending-blue">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M3 5h18v14H3zm2 2v10h14V7zm2 2h3v3H7zm5 0h5v2h-5zm0 4h5v2h-5zM7 13h3v2H7z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div>
                            <div class="track-card">
                                <h4>Your survey visit is being scheduled. Our team will confirm the date and time shortly.</h4>
                                <div class="status-row">
                                    <div class="track-status completed">◦ Completed</div>
                                    <div class="track-status pending">◦ Pending</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row pending-blue">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M4 4h16v16H4zm2 2v12h12V6zm2 2h2v8H8zm4 0h2v8h-2zm4 0h2v8h-2z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div>
                            <div class="track-card">
                                <h4>Our survey team is conducting the site measurement and verification.</h4>
                                <div class="status-row">
                                    <div class="track-status completed">◦ Completed</div>
                                    <div class="track-status pending">◦ Pending</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row pending-blue">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M12 2a5 5 0 00-5 5c0 3.86 5 10 5 10s5-6.14 5-10a5 5 0 00-5-5zm0 7a2 2 0 110-4 2 2 0 010 4zM5 20h14v2H5z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div>
                            <div class="track-card">
                                <h4>Your site survey has been completed successfully.</h4>
                                <div class="status-row">
                                    <div class="track-status completed">◦ Completed</div>
                                    <div class="track-status pending">◦ Pending</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row locked">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M4 3h13l3 3v15H4zm2 2v13h12V7h-4V5zm2 5h8v2H8zm0 4h6v2H8z"></path>
                                    </svg>
                                </div>
                                <div class="step-line"></div>
                            </div>
                        </div>
                        <div>
                            <div class="track-card">
                                <h4>Your survey drawings and report are being prepared.</h4>
                                <div class="status-row">
                                    <div class="track-status completed">◦ Completed</div>
                                    <div class="track-status pending">◦ Pending</div>
                                </div>
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
                        <div>
                            <div class="track-card">
                                <h4>Final Payment Stage</h4>
                                <p>Please complete final payment to proceed.</p>
                                <div class="action-row">
                                    <a href="#" class="mini-btn blue">Payment</a>
                                    <a href="#" class="mini-btn blue">Download Tax Invoice</a>
                                </div>
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
                        <div>
                            <div class="track-card">
                                <h4>Your survey report is ready to download.</h4>
                                <div class="status-row">
                                    <div class="track-status completed">◦ Completed</div>
                                    <div class="track-status pending">◦ Pending</div>
                                </div>
                                <div class="action-row">
                                    <a href="#" class="mini-btn blue">Download Report</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tracking-step-row completed">
                        <div class="step-left">
                            <div class="step-icon-wrap">
                                <div class="step-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M12 21a9 9 0 119-9 9 9 0 01-9 9zm-1-5l6-6-1.4-1.4-4.6 4.6-2.6-2.6L7 12z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="track-card final-blue">
                                <h4>Would you like help with planning or construction for your project?</h4>
                                <div class="action-row">
                                    <a href="#" class="mini-btn light">Get Architect Services</a>
                                    <a href="#" class="mini-btn light">Get Contractor Services</a>
                                    <a href="#" class="mini-btn light">Not Now</a>
                                </div>
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