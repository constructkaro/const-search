@extends('layouts.app')

@section('title', 'Order Track')

@section('content')

<style>
    body{
        margin:0;
        font-family:'Poppins',sans-serif;
        background:#f4f4f4;
        color:#222;
    }

    .track-page{
        padding:20px 16px 60px;
        background:#f4f4f4;
    }

    .track-container{
        max-width:1200px;
        margin:0 auto;
    }

    .top-track-buttons{
        display:flex;
        gap:12px;
        flex-wrap:wrap;
        margin:0 auto 20px;
        max-width:1200px;
    }

    .track-switch-btn{
        border:none;
        height:40px;
        padding:0 20px;
        border-radius:999px;
        font-size:14px;
        font-weight:700;
        cursor:pointer;
        background:#fff;
        color:#222;
        box-shadow:0 3px 8px rgba(0,0,0,0.12);
        transition:all 0.25s ease;
    }

    .track-switch-btn:hover{
        transform:translateY(-1px);
    }

    .track-switch-btn.active-orange{
        background:linear-gradient(180deg,#f08b39 0%, #df7122 100%);
        color:#fff;
    }

    .track-switch-btn.active-blue{
        background:linear-gradient(180deg,#2f7ec6 0%, #2a6fb0 100%);
        color:#fff;
    }

    .track-panel{
        display:none;
    }

    .track-panel.active{
        display:block;
    }

    .timeline-board{
        border-radius:18px;
        padding:24px 18px;
        position:relative;
        overflow:hidden;
    }

    .timeline-board.orange-board{
        border:2px solid #ef7f2d;
        background:#f4e4d7;
    }

    .timeline-board.blue-board{
        border:3px solid #2f7ec6;
        background:#dfeaf6;
        box-shadow:0 8px 22px rgba(47,126,198,0.10);
    }

    .timeline-list{
        position:relative;
    }

    .timeline-line{
        position:absolute;
        left:65px;
        top:10px;
        bottom:10px;
        width:2px;
        background:#8d8d8d;
    }

    .timeline-line.orange-line{
        background:linear-gradient(to bottom,#14b447 0%,#14b447 38%,#ef7f2d 38%,#ef7f2d 76%,#8d8d8d 76%,#8d8d8d 100%);
    }

    .timeline-line.blue-line{
        background:linear-gradient(to bottom,#14b447 0%,#14b447 32%,#2f7ec6 32%,#2f7ec6 56%,#8d8d8d 56%,#8d8d8d 100%);
    }

    .timeline-step{
        display:grid;
        grid-template-columns:80px 1fr;
        gap:18px;
        align-items:start;
        margin-bottom:16px;
        position:relative;
        z-index:2;
    }

    .timeline-step:last-child{
        margin-bottom:0;
    }

    .timeline-icon-wrap{
        display:flex;
        justify-content:center;
        align-items:flex-start;
        padding-top:2px;
    }

    .timeline-icon{
        width:40px;
        height:40px;
        border-radius:50%;
        display:flex;
        align-items:center;
        justify-content:center;
        background:#fff;
        border:2px solid #bdbdbd;
        box-shadow:0 2px 6px rgba(0,0,0,0.08);
        font-size:16px;
        font-weight:700;
        color:#666;
    }

    .timeline-icon svg{
        width:20px;
        height:20px;
    }

    .timeline-icon.green{
        background:#11b44a;
        border-color:#11b44a;
        color:#fff;
    }

    .timeline-icon.orange{
        background:#fff7f1;
        border-color:#ef7f2d;
        color:#ef7f2d;
    }

    .timeline-icon.blue{
        background:#f4f9ff;
        border-color:#2f7ec6;
        color:#2f7ec6;
    }

    .timeline-card{
        background:#f8f8f8;
        border-radius:12px;
        padding:16px 18px;
        box-shadow:0 2px 6px rgba(0,0,0,0.06);
        border:1px solid rgba(0,0,0,0.05);
    }

    .timeline-card.highlight-orange{
        background:linear-gradient(180deg,#f38e31 0%,#eb7a1c 100%);
        color:#fff;
    }

    .timeline-card.highlight-blue{
        background:linear-gradient(180deg,#2f7ec6 0%,#2a6fb0 100%);
        color:#fff;
    }

    .timeline-card h4{
        margin:0 0 6px;
        font-size:18px;
        font-weight:800;
        line-height:1.35;
        color:inherit;
    }

    .timeline-card p{
        margin:0;
        font-size:13px;
        line-height:1.5;
        color:inherit;
    }

    .timeline-status{
        margin-top:6px;
        font-size:12px;
        font-weight:700;
        color:#16a34a;
    }

    .timeline-status.pending{
        color:#555;
    }

    .timeline-status.progress{
        color:#2f7ec6;
    }

    .inline-actions{
        display:flex;
        gap:8px;
        flex-wrap:wrap;
        margin-top:10px;
    }

    .small-btn{
        border:none;
        min-width:62px;
        height:24px;
        padding:0 12px;
        border-radius:6px;
        font-size:11px;
        font-weight:700;
        cursor:pointer;
        transition:0.25s ease;
    }

    .small-btn:hover{
        transform:translateY(-1px);
    }

    .small-btn.orange{
        background:#ef7f2d;
        color:#fff;
    }

    .small-btn.gray{
        background:#d9c5b6;
        color:#222;
    }

    .small-btn.blue{
        background:#2f7ec6;
        color:#fff;
    }

    .progress-box{
        margin-top:10px;
    }

    .progress-top{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:12px;
        font-size:12px;
        font-weight:700;
        margin-bottom:6px;
    }

    .progress-bar{
        width:100%;
        height:4px;
        background:#d7d7d7;
        border-radius:999px;
        overflow:hidden;
    }

    .progress-fill{
        height:100%;
        background:#2f7ec6;
        border-radius:999px;
    }

    @media (max-width: 767px){
        .track-page{
            padding:16px 12px 40px;
        }

        .timeline-board{
            padding:18px 12px;
        }

        .timeline-step{
            grid-template-columns:58px 1fr;
            gap:12px;
        }

        .timeline-line{
            left:28px;
        }

        .timeline-card h4{
            font-size:15px;
        }

        .timeline-card p{
            font-size:12px;
        }

        .top-track-buttons{
            gap:10px;
        }

        .track-switch-btn{
            width:100%;
        }
    }
</style>

<section class="track-page">
    <div class="track-container">

        <div class="top-track-buttons">
            <button type="button" class="track-switch-btn active-orange" id="showOrderTrackingBtn">
                Order Tracking
            </button>

            <button type="button" class="track-switch-btn" id="showExecutionProgressBtn">
                Project Execution Progress
            </button>
        </div>

        <!-- ORDER TRACKING PANEL -->
        <div class="track-panel active" id="orderTrackingPanel">
            <div class="timeline-board orange-board">
                <div class="timeline-list">
                    <div class="timeline-line orange-line"></div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon green">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M14 2H6a2 2 0 0 0-2 2v16l4-3 4 3 4-3 4 3V8zM8 9h8v2H8zm0 4h5v2H8z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card">
                            <h4>Requirement Submitted</h4>
                            <p>Your requirement has been submitted successfully.</p>
                            <div class="timeline-status">◉ Completed</div>
                        </div>
                    </div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon green">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zm1 5v5.59l3.7 3.7-1.4 1.41L11 13V7h2z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card">
                            <h4>Under Review</h4>
                            <p>Our team is reviewing your requirement.</p>
                            <div class="timeline-status">◉ Completed</div>
                        </div>
                    </div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon green">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M6.62 10.79a15.53 15.53 0 006.59 6.59l2.2-2.2a1 1 0 011.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 011 1V20a1 1 0 01-1 1C10.85 21 3 13.15 3 3a1 1 0 011-1h3.5a1 1 0 011 1c0 1.25.2 2.46.57 3.58a1 1 0 01-.25 1.01l-2.2 2.2z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card">
                            <h4>Call Scheduled / Team Contacted You</h4>
                            <p>Our representative has reached out to you within 24 working hours.</p>
                            <div class="timeline-status">◉ Completed</div>
                        </div>
                    </div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon orange">?</div>
                        </div>
                        <div class="timeline-card">
                            <h4>Do you want ConstructKaro to execute your project?</h4>
                            <div class="inline-actions">
                                <button class="small-btn orange" type="button" id="yesExecutionBtn">Yes</button>
                                <button class="small-btn gray" type="button">No</button>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon orange">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M7 2h10v2h-1v2.07A7 7 0 0119 12a7 7 0 11-14 0 7 7 0 013-5.93V4H7zm5 5a5 5 0 00-3.54 8.54A5 5 0 1012 7zm-1 2h2v4h-2zm0 5h2v2h-2z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card">
                            <h4>Do you need Survey?</h4>
                            <div class="inline-actions">
                                <button class="small-btn orange" type="button">Yes</button>
                                <button class="small-btn gray" type="button">No</button>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon orange">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M3 19h18v2H3zm2-2l3-8 4 4 3-6 4 10z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card">
                            <h4>Do you require Architect Services?</h4>
                            <div class="inline-actions">
                                <button class="small-btn orange" type="button">Yes</button>
                                <button class="small-btn gray" type="button">No</button>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon orange">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M6 2h9l5 5v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm8 1.5V8h4.5"/><path d="M8 12h8v2H8zm0 4h8v2H8z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card">
                            <h4>Do you need BOQ / Estimation?</h4>
                            <div class="inline-actions">
                                <button class="small-btn orange" type="button">Yes</button>
                                <button class="small-btn gray" type="button">No</button>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12 3.41 13.41 9 19l12-12-1.41-1.41z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card">
                            <h4>Your service preferences have been submitted</h4>
                        </div>
                    </div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M11 2v2.07A8 8 0 104 12H2A10 10 0 1112 22v-2a8 8 0 000-16zm1 5a3 3 0 100 6 3 3 0 000-6zm-1 7h2v5h-2z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card">
                            <h4>Rate Discussion</h4>
                            <p>We have completed the rate discussion over the call. Are you satisfied with and agree to the discussed pricing and services?</p>
                            <div class="inline-actions">
                                <button class="small-btn orange" type="button">Yes</button>
                                <button class="small-btn gray" type="button">No</button>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4a2 2 0 00-2 2v12l4-4h14a2 2 0 002-2V6a2 2 0 00-2-2z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card">
                            <h4>Agreement Sent to Email</h4>
                            <p>Please visit the email and complete the agreement signing.</p>
                            <div class="inline-actions">
                                <button class="small-btn orange" type="button">Download Agreement</button>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M2 6h20v12H2zm2 2v8h16V8zm2 6h4v2H6z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card">
                            <h4>Payment Stage</h4>
                            <p>Please complete payment to proceed.</p>
                            <div class="inline-actions">
                                <button class="small-btn orange" type="button">Payment</button>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon orange">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l4 7h-3v5h-2V9H8l4-7zm-7 14h14v6H5z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card highlight-orange">
                            <h4>Work Will Start Within 7 Days</h4>
                            <p>Our team will begin work at your site shortly.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- EXECUTION PROGRESS PANEL -->
        <div class="track-panel" id="executionProgressPanel">
            <div class="timeline-board blue-board">
                <div class="timeline-list">
                    <div class="timeline-line blue-line"></div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon green">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.1 2 5 5.1 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.9-3.1-7-7-7zm0 9.5A2.5 2.5 0 1112 6a2.5 2.5 0 010 5.5z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card">
                            <h4>Site Visit Completed</h4>
                            <p>Engineer visited site, measurements verified, site condition checked.</p>
                            <div class="timeline-status">◉ Completed</div>
                        </div>
                    </div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon green">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 3l4 7h-3v4h-2v-4H8l4-7zm-7 14h14v4H5z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card">
                            <h4>Final Design & Planning Approved</h4>
                            <p>G+2 bungalow design approved, terrace layout finalized, garden planning completed.</p>
                            <div class="timeline-status">◉ Completed</div>
                            <div class="inline-actions">
                                <button class="small-btn blue" type="button">View Floor Plan</button>
                                <button class="small-btn blue" type="button">View Design</button>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon green">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M7 2h10v20H7zm2 2v16h6V4zM4 6h2v12H4zm14 0h2v12h-2z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card">
                            <h4>BOQ & Budget Finalized</h4>
                            <p>Material list finalized, cost estimate approved, project scope confirmed.</p>
                            <div class="timeline-status">◉ Completed</div>
                            <div class="inline-actions">
                                <button class="small-btn blue" type="button">View Floor Plan</button>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon blue">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M3 21h18v-2H3m2-3h3l2-6 4 1 2-7 3 1v11H5z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card">
                            <h4>Foundation Work Started</h4>
                            <p>Excavation completed, foundation layout marked, structural base work started.</p>
                            <div class="progress-box">
                                <div class="progress-top">
                                    <span class="timeline-status progress">In Progress</span>
                                    <span>10%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width:10%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M3 21h18v-2H3zm2-4h14V9H5zm2-6h2v4H7zm4 0h2v4h-2zm4 0h2v4h-2z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card">
                            <h4>Ground Floor Structure Work</h4>
                            <p>Columns, beams, slab work in progress</p>
                            <div class="progress-box">
                                <div class="progress-top">
                                    <span class="timeline-status pending">Pending</span>
                                    <span>0%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width:0%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M4 20h16v-2H4zm2-4h12V8H6zm2-6h2v4H8zm4 0h2v4h-2z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card">
                            <h4>First Floor Construction</h4>
                            <p>Slab work, wall construction, structural frame</p>
                            <div class="progress-box">
                                <div class="progress-top">
                                    <span class="timeline-status pending">Pending</span>
                                    <span>0%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width:0%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M3 21h18v-2H3zm3-4h12V7H6zm3-6h2v4H9zm4 0h2v4h-2z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card">
                            <h4>Second Floor & Open Terrace Work</h4>
                            <p>Second floor structure and open terrace development</p>
                            <div class="progress-box">
                                <div class="progress-top">
                                    <span class="timeline-status pending">Pending</span>
                                    <span>0%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width:0%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M7 2l10 10-6 6-4-4 6-6-4-4z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card">
                            <h4>Finishing Work</h4>
                            <p>Plastering, flooring, painting, plumbing, electrical work</p>
                            <div class="progress-box">
                                <div class="progress-top">
                                    <span class="timeline-status pending">Pending</span>
                                    <span>0%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width:0%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zm-1 5h2v6l4 2-1 1.73L11 14V7z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card">
                            <h4>Final Quality Check</h4>
                            <p>Quality inspection, safety verification, final review</p>
                            <div class="timeline-status pending">Pending</div>
                        </div>
                    </div>

                    <div class="timeline-step">
                        <div class="timeline-icon-wrap">
                            <div class="timeline-icon">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12 3.41 13.58 9 19l12-12-1.41-1.41z"/></svg>
                            </div>
                        </div>
                        <div class="timeline-card highlight-blue">
                            <h4>Project Completed</h4>
                            <p>Your dream bungalow is ready!</p>
                            <div class="progress-box">
                                <div class="progress-top">
                                    <span class="timeline-status" style="color:#fff;">Completed</span>
                                    <span>100%</span>
                                </div>
                                <div class="progress-bar" style="background:rgba(255,255,255,0.35);">
                                    <div class="progress-fill" style="width:100%; background:#fff;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const orderBtn = document.getElementById('showOrderTrackingBtn');
        const executionBtn = document.getElementById('showExecutionProgressBtn');
        const yesExecutionBtn = document.getElementById('yesExecutionBtn');

        const orderPanel = document.getElementById('orderTrackingPanel');
        const executionPanel = document.getElementById('executionProgressPanel');

        function showOrderPanel() {
            orderPanel.classList.add('active');
            executionPanel.classList.remove('active');

            orderBtn.classList.add('active-orange');
            executionBtn.classList.remove('active-blue');
        }

        function showExecutionPanel() {
            executionPanel.classList.add('active');
            orderPanel.classList.remove('active');

            executionBtn.classList.add('active-blue');
            orderBtn.classList.remove('active-orange');
        }

        if (orderBtn) {
            orderBtn.addEventListener('click', showOrderPanel);
        }

        if (executionBtn) {
            executionBtn.addEventListener('click', showExecutionPanel);
        }

        if (yesExecutionBtn) {
            yesExecutionBtn.addEventListener('click', showExecutionPanel);
        }
    });
</script>

@endsection