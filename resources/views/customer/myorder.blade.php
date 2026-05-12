@extends('layouts.app')

@section('title', 'My Orders')

@push('styles')
<style>
    :root {
        --orders-blue: #2169a9;
        --orders-blue-dark: #154b7d;
        --orders-orange: #ef7b22;
        --orders-ink: #172033;
        --orders-muted: #667085;
        --orders-line: #e6ebf2;
        --orders-soft: #f6f8fb;
        --orders-card: #ffffff;
        --orders-shadow: 0 18px 45px rgba(22, 32, 51, 0.1);
    }

    body {
        font-family: 'Poppins', Arial, sans-serif;
        background: var(--orders-soft);
        color: var(--orders-ink);
    }

    .orders-page {
        background:
            radial-gradient(circle at 8% 0%, rgba(33, 105, 169, 0.12), transparent 28%),
            radial-gradient(circle at 94% 6%, rgba(239, 123, 34, 0.12), transparent 30%),
            var(--orders-soft);
        padding: 34px 18px 70px;
    }

    .orders-shell {
        max-width: 1180px;
        margin: 0 auto;
    }

    .orders-hero {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 360px;
        gap: 24px;
        align-items: stretch;
        margin-bottom: 24px;
    }

    .orders-hero-main,
    .orders-help-card,
    .order-card,
    .empty-orders {
        background: rgba(255, 255, 255, 0.94);
        border: 1px solid rgba(230, 235, 242, 0.9);
        box-shadow: var(--orders-shadow);
    }

    .orders-hero-main {
        border-radius: 8px;
        padding: 28px;
        position: relative;
        overflow: hidden;
    }

    .orders-hero-main::after {
        content: "";
        position: absolute;
        right: 0;
        bottom: 0;
        width: 190px;
        height: 6px;
        background: linear-gradient(90deg, var(--orders-blue), var(--orders-orange));
    }

    .orders-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--orders-blue);
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .orders-eyebrow::before {
        content: "";
        width: 26px;
        height: 3px;
        border-radius: 999px;
        background: var(--orders-orange);
    }

    .orders-title {
        margin: 0;
        font-size: clamp(30px, 4vw, 48px);
        line-height: 1.08;
        color: var(--orders-ink);
        font-weight: 900;
    }

    .orders-subtitle {
        max-width: 650px;
        margin: 12px 0 0;
        color: var(--orders-muted);
        font-size: 15px;
        line-height: 1.75;
    }

    .orders-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
        margin-top: 24px;
    }

    .orders-stat {
        border: 1px solid var(--orders-line);
        border-radius: 8px;
        padding: 15px;
        background: #fbfcfe;
    }

    .orders-stat-value {
        display: block;
        color: var(--orders-ink);
        font-size: 26px;
        line-height: 1;
        font-weight: 900;
    }

    .orders-stat-label {
        display: block;
        margin-top: 7px;
        color: var(--orders-muted);
        font-size: 13px;
        font-weight: 700;
    }

    .orders-help-card {
        border-radius: 8px;
        padding: 24px;
        background: linear-gradient(145deg, #173f69 0%, #2169a9 58%, #ef7b22 140%);
        color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 100%;
    }

    .orders-help-icon {
        width: 46px;
        height: 46px;
        display: grid;
        place-items: center;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.14);
        margin-bottom: 18px;
    }

    .orders-help-icon svg,
    .order-icon svg,
    .order-action svg,
    .modal-close svg,
    .empty-icon svg {
        width: 20px;
        height: 20px;
        display: block;
    }

    .orders-help-title {
        margin: 0;
        font-size: 22px;
        font-weight: 900;
    }

    .orders-help-copy {
        margin: 10px 0 22px;
        font-size: 14px;
        line-height: 1.75;
        color: rgba(255, 255, 255, 0.86);
    }

    .orders-help-steps {
        display: grid;
        gap: 10px;
        margin-top: auto;
    }

    .orders-help-step {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        font-weight: 800;
    }

    .orders-help-step span {
        width: 24px;
        height: 24px;
        display: grid;
        place-items: center;
        border-radius: 50%;
        color: var(--orders-blue-dark);
        background: #fff;
        font-size: 12px;
        flex: 0 0 auto;
    }

    .orders-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 18px;
    }

    .orders-filter-title {
        margin: 0;
        font-size: 20px;
        font-weight: 900;
    }

    .orders-tabs {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        flex-wrap: wrap;
    }

    .orders-tab {
        min-height: 40px;
        padding: 0 16px;
        border: 1px solid var(--orders-line);
        border-radius: 8px;
        background: #fff;
        color: var(--orders-muted);
        cursor: pointer;
        font-size: 14px;
        font-weight: 800;
        transition: 0.2s ease;
    }

    .orders-tab:hover,
    .orders-tab.active {
        border-color: transparent;
        background: var(--orders-blue);
        color: #fff;
        box-shadow: 0 10px 22px rgba(33, 105, 169, 0.18);
    }

    .orders-list {
        display: grid;
        gap: 16px;
    }

    .order-card {
        border-radius: 8px;
        padding: 20px;
        display: grid;
        grid-template-columns: auto minmax(0, 1fr);
        gap: 18px;
        align-items: start;
        position: relative;
    }

    .order-card::before {
        content: "";
        position: absolute;
        inset: 0 auto 0 0;
        width: 4px;
        border-radius: 8px 0 0 8px;
        background: linear-gradient(180deg, var(--orders-blue), var(--orders-orange));
    }

    .order-icon {
        width: 48px;
        height: 48px;
        display: grid;
        place-items: center;
        border-radius: 8px;
        color: var(--orders-blue);
        background: #eaf3fb;
    }

    .order-main {
        min-width: 0;
    }

    .order-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 10px;
    }

    .service-badge {
        display: inline-flex;
        align-items: center;
        min-height: 26px;
        padding: 0 10px;
        border-radius: 999px;
        background: #fff4eb;
        color: #b85308;
        font-size: 12px;
        font-weight: 900;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        min-height: 28px;
        padding: 0 11px;
        border-radius: 999px;
        background: #ecfdf3;
        color: #087443;
        font-size: 12px;
        font-weight: 900;
        white-space: nowrap;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #12b76a;
    }

    .order-title {
        margin: 0 0 8px;
        color: var(--orders-ink);
        font-size: 20px;
        line-height: 1.35;
        font-weight: 900;
        overflow-wrap: anywhere;
    }

    .order-location {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        color: var(--orders-muted);
        font-size: 14px;
        line-height: 1.55;
    }

    .order-location svg {
        width: 16px;
        height: 16px;
        margin-top: 2px;
        color: var(--orders-orange);
        flex: 0 0 auto;
    }

    .order-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 16px;
    }

    .order-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        min-height: 32px;
        padding: 0 10px;
        border: 1px solid var(--orders-line);
        border-radius: 8px;
        color: var(--orders-muted);
        background: #fbfcfe;
        font-size: 13px;
        font-weight: 800;
    }

    .order-meta-item strong {
        color: var(--orders-ink);
        font-weight: 900;
    }

    .order-actions {
        display: flex;
        align-items: stretch;
        gap: 10px;
        grid-column: 2;
        min-width: 0;
        flex-wrap: wrap;
    }

    .order-action {
        min-height: 42px;
        padding: 0 14px;
        border: 0;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: #fff;
        cursor: pointer;
        font-size: 14px;
        font-weight: 900;
        line-height: 1;
        text-decoration: none;
        transition: 0.2s ease;
        white-space: nowrap;
        flex: 0 1 auto;
    }

    .order-action:hover {
        color: #fff;
        text-decoration: none;
        transform: translateY(-1px);
    }

    .details-btn {
        background: var(--orders-blue);
    }

    .track-btn {
        background: var(--orders-orange);
    }

    .project-modal {
        position: fixed;
        inset: 0;
        z-index: 99999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(15, 23, 42, 0.58);
    }

    .project-modal.show {
        display: flex;
    }

    .project-modal-box {
        width: min(780px, 100%);
        max-height: calc(100vh - 40px);
        overflow: auto;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 24px 80px rgba(15, 23, 42, 0.26);
        animation: modalFade 0.22s ease;
    }

    @keyframes modalFade {
        from {
            opacity: 0;
            transform: translateY(12px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .project-modal-header {
        padding: 22px 24px;
        color: #fff;
        background: linear-gradient(120deg, var(--orders-blue-dark), var(--orders-blue));
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .project-modal-header h3 {
        margin: 0;
        font-size: 24px;
        font-weight: 900;
    }

    .modal-close {
        width: 40px;
        height: 40px;
        border: 0;
        border-radius: 8px;
        display: grid;
        place-items: center;
        color: #fff;
        background: rgba(255, 255, 255, 0.14);
        cursor: pointer;
    }

    .project-modal-body {
        padding: 24px;
    }

    .project-detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .project-detail-item {
        border: 1px solid var(--orders-line);
        border-radius: 8px;
        padding: 14px;
        background: #fbfcfe;
    }

    .project-detail-item.full-width {
        grid-column: 1 / -1;
    }

    .project-detail-label {
        margin-bottom: 7px;
        color: var(--orders-muted);
        font-size: 12px;
        font-weight: 900;
        letter-spacing: 0.06em;
        text-transform: uppercase;
    }

    .project-detail-value {
        color: var(--orders-ink);
        font-size: 15px;
        font-weight: 700;
        line-height: 1.55;
        overflow-wrap: anywhere;
    }

    .empty-orders {
        border-radius: 8px;
        padding: 54px 22px;
        text-align: center;
    }

    .empty-icon {
        width: 54px;
        height: 54px;
        margin: 0 auto 16px;
        display: grid;
        place-items: center;
        border-radius: 8px;
        color: var(--orders-blue);
        background: #eaf3fb;
    }

    .empty-orders h3 {
        margin: 0 0 8px;
        font-size: 24px;
        font-weight: 900;
    }

    .empty-orders p {
        margin: 0;
        color: var(--orders-muted);
        font-size: 15px;
    }

    .orders-hidden {
        display: none;
    }

    @media (max-width: 1050px) {
        .orders-hero {
            grid-template-columns: 1fr;
        }

        .order-actions {
            width: 100%;
        }
    }

    @media (max-width: 760px) {
        .orders-page {
            padding: 24px 12px 48px;
        }

        .orders-hero-main,
        .orders-help-card,
        .order-card {
            padding: 18px;
        }

        .orders-stats {
            grid-template-columns: 1fr;
        }

        .orders-toolbar {
            align-items: flex-start;
            flex-direction: column;
        }

        .orders-tabs {
            justify-content: flex-start;
            width: 100%;
        }

        .orders-tab {
            flex: 1 1 auto;
        }

        .order-card {
            grid-template-columns: 1fr;
        }

        .order-icon {
            width: 42px;
            height: 42px;
        }

        .order-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .order-actions {
            grid-column: auto;
            width: 100%;
        }

        .order-action {
            flex: 1 1 160px;
        }

        .project-detail-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 460px) {
        .order-actions {
            flex-direction: column;
        }

        .order-action {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
@php
    $orders = isset($allOrders) ? $allOrders : collect();
    $totalOrders = $orders->count();
    $serviceTypes = $orders->pluck('type')->filter()->unique()->values();
    $latestOrder = $orders->first();
    $latestDate = $latestOrder && $latestOrder->created_at
        ? \Carbon\Carbon::parse($latestOrder->created_at)->format('d M Y')
        : '-';
@endphp

<section class="orders-page">
    <div class="orders-shell">
        <div class="orders-hero">
            <div class="orders-hero-main">
                <div class="orders-eyebrow">Customer Dashboard</div>
                <h1 class="orders-title">My Orders</h1>
                <p class="orders-subtitle">
                    Track every service request from one place, review the project details, and follow the latest progress assigned by the ConstructKaro team.
                </p>

                <div class="orders-stats">
                    <div class="orders-stat">
                        <span class="orders-stat-value">{{ $totalOrders }}</span>
                        <span class="orders-stat-label">Total Orders</span>
                    </div>

                    <div class="orders-stat">
                        <span class="orders-stat-value">{{ $serviceTypes->count() }}</span>
                        <span class="orders-stat-label">Service Types</span>
                    </div>

                    <div class="orders-stat">
                        <span class="orders-stat-value">{{ $latestDate }}</span>
                        <span class="orders-stat-label">Latest Request</span>
                    </div>
                </div>
            </div>

            <aside class="orders-help-card">
                <div>
                    <div class="orders-help-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.8 19.8 0 0 1 3.08 5.18 2 2 0 0 1 5.06 3h3a2 2 0 0 1 2 1.72c.12.9.32 1.77.6 2.61a2 2 0 0 1-.45 2.11L9 10.65a16 16 0 0 0 4.35 4.35l1.21-1.21a2 2 0 0 1 2.11-.45c.84.28 1.71.48 2.61.6A2 2 0 0 1 22 16.92Z"/>
                        </svg>
                    </div>
                    <h2 class="orders-help-title">Need an update?</h2>
                    <p class="orders-help-copy">
                        Our team usually contacts you within 24 working hours after a new request is submitted.
                    </p>
                </div>

                <div class="orders-help-steps">
                    <div class="orders-help-step"><span>1</span> Request received</div>
                    <div class="orders-help-step"><span>2</span> Team review</div>
                    <div class="orders-help-step"><span>3</span> Progress tracking</div>
                </div>
            </aside>
        </div>

        @if($totalOrders)
            <div class="orders-toolbar">
                <h2 class="orders-filter-title">Recent Requests</h2>

                <div class="orders-tabs" aria-label="Filter orders by service type">
                    <button type="button" class="orders-tab active" data-filter="all">All</button>
                    @foreach($serviceTypes as $type)
                        <button type="button" class="orders-tab" data-filter="{{ \Illuminate\Support\Str::slug($type) }}">
                            {{ $type }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="orders-list" id="ordersList">
                @foreach($orders as $order)
                    @php
                        $title = $order->title ?? $order->service_name ?? 'Service Request';
                        $location = $order->location ?? '-';
                        $scope = $order->scope ?? '-';
                        $description = $order->description ?? '-';
                        $badge = $order->type ?? 'Order';
                        $orderId = str_pad($order->id, 3, '0', STR_PAD_LEFT);
                        $posted = $order->created_at ? \Carbon\Carbon::parse($order->created_at)->format('d M Y') : '-';
                        $filterKey = \Illuminate\Support\Str::slug($badge);
                    @endphp

                    <article class="order-card" data-order-type="{{ $filterKey }}">
                        <div class="order-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z"/>
                                <path d="M14 2v6h6"/>
                                <path d="M8 13h8"/>
                                <path d="M8 17h5"/>
                            </svg>
                        </div>

                        <div class="order-main">
                            <div class="order-header">
                                <span class="service-badge">{{ $badge }}</span>
                                <span class="status-pill">
                                    <span class="status-dot"></span>
                                    In Progress
                                </span>
                            </div>

                            <h3 class="order-title">{{ $title }}</h3>

                            <div class="order-location">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                <span>{{ $location ?: '-' }}</span>
                            </div>

                            <div class="order-meta">
                                <span class="order-meta-item">Order ID <strong>#{{ $orderId }}</strong></span>
                                <span class="order-meta-item">Posted <strong>{{ $posted }}</strong></span>
                                <span class="order-meta-item">Scope <strong>{{ $scope ?: '-' }}</strong></span>
                            </div>
                        </div>

                        <div class="order-actions">
                            <button
                                type="button"
                                class="order-action details-btn open-project-modal"
                                data-service="{{ $order->service_name ?? '-' }}"
                                data-title="{{ $title }}"
                                data-location="{{ $location ?: '-' }}"
                                data-orderid="#{{ $orderId }}"
                                data-posted="{{ $posted }}"
                                data-status="In Progress"
                                data-area="{{ $scope ?: '-' }}"
                                data-description="{{ $description ?: '-' }}"
                            >
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/>
                                    <path d="M14 2v6h6"/>
                                    <path d="M8 13h8"/>
                                    <path d="M8 17h5"/>
                                </svg>
                                Details
                            </button>

                            <a href="{{ route('myorder.track', ['service_key' => $order->service_key, 'source_id' => $order->id]) }}" class="order-action track-btn">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M3 12h4l3 8 4-16 3 8h4"/>
                                </svg>
                                Order Track
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="empty-orders">
                <div class="empty-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                        <path d="m3.3 7 8.7 5 8.7-5"/>
                        <path d="M12 22V12"/>
                    </svg>
                </div>
                <h3>No orders found</h3>
                <p>Your submitted service requests will appear here.</p>
            </div>
        @endif
    </div>
</section>

<div class="project-modal" id="projectDetailsModal" aria-hidden="true">
    <div class="project-modal-box" role="dialog" aria-modal="true" aria-labelledby="projectModalTitle">
        <div class="project-modal-header">
            <h3 id="projectModalTitle">Project Details</h3>
            <button type="button" class="modal-close" id="closeProjectModal" aria-label="Close project details">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 6 6 18"/>
                    <path d="m6 6 12 12"/>
                </svg>
            </button>
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

                <div class="project-detail-item full-width">
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

                <div class="project-detail-item full-width">
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
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('projectDetailsModal');
        const closeBtn = document.getElementById('closeProjectModal');
        const detailButtons = document.querySelectorAll('.open-project-modal');
        const filterButtons = document.querySelectorAll('.orders-tab');
        const orderCards = document.querySelectorAll('.order-card');

        const fields = {
            service: document.getElementById('modalService'),
            status: document.getElementById('modalStatus'),
            title: document.getElementById('modalTitle'),
            location: document.getElementById('modalLocation'),
            orderid: document.getElementById('modalOrderId'),
            posted: document.getElementById('modalPosted'),
            area: document.getElementById('modalArea'),
            description: document.getElementById('modalDescription'),
        };

        function openModal(button) {
            Object.keys(fields).forEach(function (key) {
                fields[key].textContent = button.dataset[key] || '-';
            });

            modal.classList.add('show');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.remove('show');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        detailButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                openModal(button);
            });
        });

        filterButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const filter = button.dataset.filter;

                filterButtons.forEach(function (tab) {
                    tab.classList.remove('active');
                });

                button.classList.add('active');

                orderCards.forEach(function (card) {
                    const shouldShow = filter === 'all' || card.dataset.orderType === filter;
                    card.classList.toggle('orders-hidden', !shouldShow);
                });
            });
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', closeModal);
        }

        if (modal) {
            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    closeModal();
                }
            });
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && modal.classList.contains('show')) {
                closeModal();
            }
        });
    });
</script>
@endpush
