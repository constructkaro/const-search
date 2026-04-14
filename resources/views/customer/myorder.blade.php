@extends('layouts.app')

@section('title', 'My Orders')

@section('content')

<style>
    body{
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background: #f3f3f3;
        color: #222;
    }

    .my-orders-section{
        padding: 30px 20px 60px;
        background: #f3f3f3;
    }

    .my-orders-container{
        max-width: 1180px;
        margin: 0 auto;
    }

    .my-orders-heading{
        text-align: center;
        margin-bottom: 28px;
    }

    .my-orders-heading h2{
        margin: 0;
        font-size: 42px;
        font-weight: 800;
        color: #222;
        line-height: 1.2;
    }

    .my-orders-line{
        width: 130px;
        height: 4px;
        margin: 10px auto 0;
        border-radius: 20px;
        background: linear-gradient(90deg, #2d7cc5 0%, #f18a2a 100%);
    }

    .orders-tabs{
        display: flex;
        justify-content: center;
        gap: 34px;
        flex-wrap: wrap;
        margin-bottom: 40px;
    }

    .orders-tab{
        min-width: 170px;
        height: 48px;
        padding: 0 24px;
        border: none;
        border-radius: 999px;
        font-size: 20px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fff;
        color: #222;
        box-shadow: 0 4px 10px rgba(0,0,0,0.12);
    }

    .orders-tab.active{
        background: linear-gradient(90deg, #2f7ec6 0%, #f0842a 100%);
        color: #fff;
        box-shadow: 0 8px 18px rgba(0,0,0,0.18);
    }

    .orders-list{
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .order-row{
        display: grid;
        grid-template-columns: 1fr 260px;
        gap: 18px;
        align-items: stretch;
    }

    .order-card{
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.10);
        padding: 20px 18px 18px;
        border-left: 4px solid #2f7ec6;
        position: relative;
    }

    .service-badge{
        position: absolute;
        top: -10px;
        left: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 120px;
        height: 30px;
        padding: 0 14px;
        background: #ef7f2d;
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        border-radius: 8px;
        box-shadow: 0 6px 14px rgba(239,127,45,0.22);
    }

    .order-top{
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
        margin-top: 8px;
    }

    .order-title-wrap h3{
        margin: 0 0 8px;
        font-size: 20px;
        font-weight: 800;
        color: #111;
        line-height: 1.3;
    }

    .order-location{
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        color: #666;
        margin-bottom: 14px;
    }

    .order-location svg{
        width: 14px;
        height: 14px;
        flex-shrink: 0;
    }

    .status-pill{
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 999px;
        background: #f5e5d8;
        color: #222;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-dot{
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #f08a2b;
        display: inline-block;
    }

    .order-bottom{
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }

    .order-meta{
        display: flex;
        align-items: center;
        gap: 34px;
        flex-wrap: wrap;
        font-size: 16px;
        color: #555;
    }

    .order-meta strong{
        color: #111;
        font-weight: 800;
    }

    .order-actions{
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
    }

    .order-btn{
        min-width: 150px;
        height: 42px;
        border: none;
        border-radius: 999px;
        padding: 0 20px;
        font-size: 16px;
        font-weight: 700;
        color: #fff;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 6px 14px rgba(0,0,0,0.14);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        line-height: 1;
    }

    .details-btn{
        background: linear-gradient(180deg, #2f7ec6 0%, #2b6fb0 100%);
    }

    .track-btn{
        background: linear-gradient(180deg, #f18a2a 0%, #e17118 100%);
    }

    .order-btn:hover{
        transform: translateY(-2px);
        color: #fff;
        text-decoration: none;
    }

    .followup-card{
        background: linear-gradient(180deg, #f3902f 0%, #e9771d 100%);
        border-radius: 18px;
        padding: 18px 18px 16px;
        color: #fff;
        box-shadow: 0 8px 18px rgba(225,113,24,0.22);
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-height: 138px;
    }

    .followup-icon{
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: rgba(255,255,255,0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 14px;
    }

    .followup-icon svg{
        width: 18px;
        height: 18px;
    }

    .followup-text{
        font-size: 15px;
        font-weight: 700;
        line-height: 1.5;
        margin-bottom: 14px;
    }

    .followup-line{
        width: 100px;
        height: 2px;
        border-radius: 10px;
        background: rgba(255,255,255,0.75);
    }

    .project-modal{
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.55);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 99999;
        padding: 20px;
    }

    .project-modal.show{
        display: flex;
    }

    .project-modal-box{
        width: 100%;
        max-width: 700px;
        background: #fff;
        border-radius: 22px;
        box-shadow: 0 18px 50px rgba(0,0,0,0.22);
        overflow: hidden;
        animation: modalFade 0.25s ease;
    }

    @keyframes modalFade{
        from{
            opacity: 0;
            transform: translateY(20px) scale(0.98);
        }
        to{
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .project-modal-header{
        padding: 22px 24px;
        background: linear-gradient(90deg, #2f7ec6 0%, #f0842a 100%);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .project-modal-header h3{
        margin: 0;
        font-size: 26px;
        font-weight: 800;
    }

    .project-modal-close{
        width: 38px;
        height: 38px;
        border: none;
        border-radius: 50%;
        background: rgba(255,255,255,0.18);
        color: #fff;
        font-size: 24px;
        cursor: pointer;
        line-height: 1;
    }

    .project-modal-body{
        padding: 24px;
    }

    .project-detail-grid{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .project-detail-item{
        background: #f8f8f8;
        border: 1px solid #e6e6e6;
        border-radius: 14px;
        padding: 14px 16px;
    }

    .project-detail-label{
        font-size: 13px;
        font-weight: 700;
        color: #777;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    .project-detail-value{
        font-size: 16px;
        font-weight: 600;
        color: #111;
        line-height: 1.5;
        word-break: break-word;
    }

    .project-detail-item.full-width{
        grid-column: 1 / -1;
    }

    .empty-orders{
        text-align: center;
        padding: 60px 20px;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.08);
        font-size: 18px;
        font-weight: 600;
        color: #666;
    }

    @media (max-width: 991px){
        .order-row{
            grid-template-columns: 1fr;
        }

        .followup-card{
            min-height: auto;
        }

        .my-orders-heading h2{
            font-size: 34px;
        }

        .orders-tab{
            font-size: 17px;
            min-width: 150px;
            height: 44px;
        }
    }

    @media (max-width: 767px){
        .my-orders-section{
            padding: 24px 14px 40px;
        }

        .my-orders-heading h2{
            font-size: 28px;
        }

        .orders-tabs{
            gap: 12px;
        }

        .orders-tab{
            min-width: 100%;
            font-size: 15px;
        }

        .order-card{
            padding: 18px 14px 16px;
        }

        .service-badge{
            position: static;
            margin-bottom: 12px;
        }

        .order-top{
            flex-direction: column;
            align-items: flex-start;
        }

        .order-title-wrap h3{
            font-size: 18px;
        }

        .order-meta{
            gap: 14px;
            font-size: 14px;
        }

        .order-actions{
            width: 100%;
        }

        .order-btn{
            min-width: calc(50% - 7px);
            flex: 1;
            font-size: 14px;
        }

        .project-modal-body{
            padding: 18px;
        }

        .project-detail-grid{
            grid-template-columns: 1fr;
        }

        .project-modal-header h3{
            font-size: 22px;
        }
    }

    @media (max-width: 480px){
        .order-btn{
            min-width: 100%;
        }
    }
</style>

<section class="my-orders-section">
    <div class="my-orders-container">

        <div class="my-orders-heading">
            <h2>My Orders</h2>
            <div class="my-orders-line"></div>
        </div>

        <div class="orders-tabs">
            <button type="button" class="orders-tab active">Current Orders</button>
            <button type="button" class="orders-tab">Cancelled Orders</button>
            <button type="button" class="orders-tab">Completed Orders</button>
        </div>

      @if(isset($allOrders) && $allOrders->count())

    <div class="order-row">

        <!-- LEFT SIDE: ALL ORDERS -->
        <div>
            <div class="orders-list">

                @foreach($allOrders as $order)
                   @php
    $isSurvey = $order->type === 'Survey Booking';
    $title = $isSurvey
        ? ($order->service_name ?? 'Survey Service')
        : ($order->project_name ?? $order->service_name ?? 'Testing Service');

    $location = $isSurvey
        ? ($order->full_address ?? '-')
        : collect([
            $order->house_building_name ?? null,
            $order->road_area_colony ?? null,
            $order->city ?? null,
            $order->pincode ?? null
        ])->filter()->implode(', ');

    $scope = $isSurvey
        ? (($order->land_area ?? '-') . ' ' . ($order->area_unit ?? ''))
        : ($order->required_testing_type ?? '-');

    $description = $isSurvey
        ? ($order->description ?? '-')
        : ($order->additional_details ?? '-');

    $badge = $order->type;
@endphp

                    <div class="order-card" style="margin-bottom: 24px;">
                        <div class="service-badge">{{ $badge }}</div>

                        <div class="order-top">
                            <div class="order-title-wrap">
                                <h3>{{ $title }}</h3>

                                <div class="order-location">
                                    <svg viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2C8.14 2 5 5.14 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.86-3.14-7-7-7zm0 9.5A2.5 2.5 0 1112 6a2.5 2.5 0 010 5.5z"/>
                                    </svg>
                                    <span>{{ $location ?: '-' }}</span>
                                </div>
                            </div>

                            <div class="status-pill">
                                <span class="status-dot"></span>
                                <span>In Progress</span>
                            </div>
                        </div>

                        <div class="order-bottom">
                            <div class="order-meta">
                                <span>#Order ID: <strong>{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}</strong></span>
                                <span>Posted: <strong>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</strong></span>
                            </div>

                            <div class="order-actions">
                                <button
                                    type="button"
                                    class="order-btn details-btn open-project-modal"
                                    data-service="{{ $order->service_name ?? '-' }}"
                                    data-title="{{ $title }}"
                                    data-location="{{ $location ?: '-' }}"
                                    data-orderid="{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}"
                                    data-posted="{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}"
                                    data-status="In Progress"
                                    data-budget="-"
                                    data-area="{{ $scope }}"
                                    data-description="{{ $description }}"
                                >
                                    Project Details
                                </button>

                               @php
                                    $trackType = match(strtolower(trim($order->type))) {
                                        'testing enquiry' => 'testing',
                                        'survey booking' => 'survey',
                                        'contractor booking' => 'contractor',
                                        'interior booking' => 'interior',
                                        'boq enquiry' => 'boq',
                                        'boq booking' => 'boq',
                                        'boq / estimation booking' => 'boq',
                                        default => 'testing',
                                    };
                                @endphp
                               
                            <a href="{{ route('myorder.track', ['service_key' => $order->service_key, 'source_id' => $order->id]) }}"
                            class="order-btn track-btn">
                            Order Track
                            </a>
                                
                              
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>

        <!-- RIGHT SIDE: ONLY ONE FOLLOWUP BOX -->
        <div class="followup-card">
            <div class="followup-icon">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M6.62 10.79a15.534 15.534 0 006.59 6.59l2.2-2.2a1 1 0 011.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 011 1V20a1 1 0 01-1 1C10.85 21 3 13.15 3 3a1 1 0 011-1h3.5a1 1 0 011 1c0 1.25.2 2.46.57 3.58a1 1 0 01-.25 1.01l-2.2 2.2z"/>
                </svg>
            </div>

            <div class="followup-text">
                Within 24 working hours,<br>
                our team will contact you.
            </div>

            <div class="followup-line"></div>
        </div>

    </div>

@else
    <div class="empty-orders">
        No orders found.
    </div>
@endif

    </div>
</section>

<div class="project-modal" id="projectDetailsModal">
    <div class="project-modal-box">
        <div class="project-modal-header">
            <h3>Project Details</h3>
            <button type="button" class="project-modal-close" id="closeProjectModal">&times;</button>
        </div>

        <div class="project-modal-body">
            <div class="project-detail-grid">
                <div class="project-detail-item">
                    <div class="project-detail-label">Service</div>
                    <div class="project-detail-value" id="modalService">-</div>
                </div>

                <div class="project-detail-item">
                    <div class="project-detail-label">Status</div>
                    <div class="project-detail-value" id="modalStatus">-</div>
                </div>

                <div class="project-detail-item full-width">
                    <div class="project-detail-label">Project Title</div>
                    <div class="project-detail-value" id="modalTitle">-</div>
                </div>

                <div class="project-detail-item">
                    <div class="project-detail-label">Location</div>
                    <div class="project-detail-value" id="modalLocation">-</div>
                </div>

                <div class="project-detail-item">
                    <div class="project-detail-label">Order ID</div>
                    <div class="project-detail-value" id="modalOrderId">-</div>
                </div>

                <div class="project-detail-item">
                    <div class="project-detail-label">Posted Date</div>
                    <div class="project-detail-value" id="modalPosted">-</div>
                </div>

                <div class="project-detail-item">
                    <div class="project-detail-label">Budget</div>
                    <div class="project-detail-value" id="modalBudget">-</div>
                </div>

                <div class="project-detail-item">
                    <div class="project-detail-label">Area / Scope</div>
                    <div class="project-detail-value" id="modalArea">-</div>
                </div>

                <div class="project-detail-item full-width">
                    <div class="project-detail-label">Description</div>
                    <div class="project-detail-value" id="modalDescription">-</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('projectDetailsModal');
        const closeBtn = document.getElementById('closeProjectModal');
        const detailButtons = document.querySelectorAll('.open-project-modal');

        const modalService = document.getElementById('modalService');
        const modalStatus = document.getElementById('modalStatus');
        const modalTitle = document.getElementById('modalTitle');
        const modalLocation = document.getElementById('modalLocation');
        const modalOrderId = document.getElementById('modalOrderId');
        const modalPosted = document.getElementById('modalPosted');
        const modalBudget = document.getElementById('modalBudget');
        const modalArea = document.getElementById('modalArea');
        const modalDescription = document.getElementById('modalDescription');

        detailButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                modalService.textContent = this.dataset.service || '-';
                modalStatus.textContent = this.dataset.status || '-';
                modalTitle.textContent = this.dataset.title || '-';
                modalLocation.textContent = this.dataset.location || '-';
                modalOrderId.textContent = this.dataset.orderid || '-';
                modalPosted.textContent = this.dataset.posted || '-';
                modalBudget.textContent = this.dataset.budget || '-';
                modalArea.textContent = this.dataset.area || '-';
                modalDescription.textContent = this.dataset.description || '-';

                modal.classList.add('show');
                document.body.style.overflow = 'hidden';
            });
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                modal.classList.remove('show');
                document.body.style.overflow = '';
            });
        }

        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.remove('show');
                    document.body.style.overflow = '';
                }
            });
        }
    });
</script>

@endsection