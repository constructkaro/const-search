@extends('layouts.app')

@section('title', 'My Profile')

@push('styles')
<style>
    :root {
        --profile-blue: #2169a9;
        --profile-blue-dark: #154b7d;
        --profile-orange: #ef7b22;
        --profile-ink: #172033;
        --profile-muted: #667085;
        --profile-line: #e6ebf2;
        --profile-soft: #f6f8fb;
        --profile-shadow: 0 18px 45px rgba(22, 32, 51, 0.1);
    }

    body {
        background: var(--profile-soft);
        color: var(--profile-ink);
        font-family: 'Poppins', Arial, sans-serif;
    }

    .profile-page {
        min-height: 70vh;
        padding: 36px 18px 70px;
        background:
            radial-gradient(circle at 6% 0%, rgba(33, 105, 169, 0.13), transparent 28%),
            radial-gradient(circle at 94% 8%, rgba(239, 123, 34, 0.13), transparent 32%),
            var(--profile-soft);
    }

    .profile-shell {
        width: min(1120px, 100%);
        margin: 0 auto;
    }

    .profile-hero {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 320px;
        gap: 22px;
        margin-bottom: 22px;
    }

    .profile-card,
    .profile-side-card,
    .profile-section {
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(230, 235, 242, 0.92);
        border-radius: 8px;
        box-shadow: var(--profile-shadow);
    }

    .profile-card {
        padding: 28px;
        position: relative;
        overflow: hidden;
    }

    .profile-card::after {
        content: "";
        position: absolute;
        right: 0;
        bottom: 0;
        width: 190px;
        height: 6px;
        background: linear-gradient(90deg, var(--profile-blue), var(--profile-orange));
    }

    .profile-top {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .profile-avatar {
        width: 82px;
        height: 82px;
        display: grid;
        place-items: center;
        border-radius: 50%;
        color: #fff;
        background: linear-gradient(145deg, var(--profile-blue-dark), var(--profile-blue));
        font-size: 30px;
        font-weight: 900;
        flex: 0 0 auto;
    }

    .profile-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
        color: var(--profile-blue);
        font-size: 13px;
        font-weight: 900;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .profile-eyebrow::before {
        content: "";
        width: 24px;
        height: 3px;
        border-radius: 999px;
        background: var(--profile-orange);
    }

    .profile-title {
        margin: 0;
        color: var(--profile-ink);
        font-size: clamp(28px, 4vw, 44px);
        line-height: 1.1;
        font-weight: 900;
    }

    .profile-subtitle {
        margin: 10px 0 0;
        color: var(--profile-muted);
        font-size: 15px;
        line-height: 1.65;
    }

    .profile-side-card {
        padding: 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background: linear-gradient(145deg, #173f69 0%, #2169a9 62%, #ef7b22 142%);
        color: #fff;
    }

    .profile-status {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        width: fit-content;
        min-height: 32px;
        padding: 0 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.15);
        font-size: 13px;
        font-weight: 900;
    }

    .profile-status-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: #12b76a;
    }

    .profile-side-card h2 {
        margin: 18px 0 8px;
        font-size: 24px;
        font-weight: 900;
    }

    .profile-side-card p {
        margin: 0;
        color: rgba(255, 255, 255, 0.86);
        font-size: 14px;
        line-height: 1.7;
    }

    .profile-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 22px;
    }

    .profile-btn {
        min-height: 42px;
        padding: 0 15px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: #fff;
        background: var(--profile-orange);
        font-size: 14px;
        font-weight: 900;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .profile-btn:hover {
        color: #fff;
        text-decoration: none;
        transform: translateY(-1px);
    }

    .profile-section {
        padding: 24px;
        margin-bottom: 22px;
    }

    .section-title {
        margin: 0 0 18px;
        font-size: 22px;
        font-weight: 900;
    }

    .profile-info-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .profile-info-item,
    .profile-summary-item {
        border: 1px solid var(--profile-line);
        border-radius: 8px;
        padding: 16px;
        background: #fbfcfe;
    }

    .profile-label {
        margin-bottom: 8px;
        color: var(--profile-muted);
        font-size: 12px;
        font-weight: 900;
        letter-spacing: 0.06em;
        text-transform: uppercase;
    }

    .profile-value {
        color: var(--profile-ink);
        font-size: 16px;
        font-weight: 800;
        line-height: 1.45;
        overflow-wrap: anywhere;
    }

    .profile-summary-grid {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 12px;
    }

    .summary-number {
        display: block;
        color: var(--profile-ink);
        font-size: 28px;
        line-height: 1;
        font-weight: 900;
    }

    .summary-text {
        display: block;
        margin-top: 8px;
        color: var(--profile-muted);
        font-size: 13px;
        font-weight: 800;
    }

    @media (max-width: 980px) {
        .profile-hero {
            grid-template-columns: 1fr;
        }

        .profile-info-grid {
            grid-template-columns: 1fr;
        }

        .profile-summary-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 560px) {
        .profile-page {
            padding: 24px 12px 48px;
        }

        .profile-card,
        .profile-side-card,
        .profile-section {
            padding: 18px;
        }

        .profile-top {
            align-items: flex-start;
            flex-direction: column;
        }

        .profile-summary-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
@php
    $displayName = $customer->name ?: session('customer_name', 'Customer');
    $initial = strtoupper(substr($displayName ?: 'C', 0, 1));
@endphp

<section class="profile-page">
    <div class="profile-shell">
        <div class="profile-hero">
            <div class="profile-card">
                <div class="profile-top">
                    <div class="profile-avatar" aria-hidden="true">{{ $initial }}</div>
                    <div>
                        <div class="profile-eyebrow">Customer Account</div>
                        <h1 class="profile-title">{{ $displayName }}</h1>
                        <p class="profile-subtitle">
                            Manage your ConstructKaro account details and quickly review your service request activity.
                        </p>
                    </div>
                </div>
            </div>

            <aside class="profile-side-card">
                <div>
                    <div class="profile-status">
                        <span class="profile-status-dot"></span>
                        Logged In
                    </div>
                    <h2>Profile Overview</h2>
                    <p>Your mobile number is used for login and order communication.</p>
                </div>

                <div class="profile-actions">
                    <a href="{{ route('myorder') }}" class="profile-btn">View Orders</a>
                    <a href="{{ route('customer.logout') }}" class="profile-btn">Log Out</a>
                </div>
            </aside>
        </div>

        <div class="profile-section">
            <h2 class="section-title">Personal Details</h2>

            <div class="profile-info-grid">
                <div class="profile-info-item">
                    <div class="profile-label">Full Name</div>
                    <div class="profile-value">{{ $customer->name ?: 'Not added yet' }}</div>
                </div>

                <div class="profile-info-item">
                    <div class="profile-label">Mobile Number</div>
                    <div class="profile-value">{{ $customer->mobile ?: session('customer_mobile', '-') }}</div>
                </div>

                <div class="profile-info-item">
                    <div class="profile-label">Email Address</div>
                    <div class="profile-value">{{ $customer->email ?: 'Not added yet' }}</div>
                </div>

                <div class="profile-info-item">
                    <div class="profile-label">Customer ID</div>
                    <div class="profile-value">#{{ str_pad($customer->id, 3, '0', STR_PAD_LEFT) }}</div>
                </div>

                <div class="profile-info-item">
                    <div class="profile-label">Joined On</div>
                    <div class="profile-value">
                        {{ $customer->created_at ? \Carbon\Carbon::parse($customer->created_at)->format('d M Y') : '-' }}
                    </div>
                </div>

                <div class="profile-info-item">
                    <div class="profile-label">Account Status</div>
                    <div class="profile-value">Active</div>
                </div>
            </div>
        </div>

        <div class="profile-section">
            <h2 class="section-title">Order Summary</h2>

            <div class="profile-summary-grid">
                <div class="profile-summary-item">
                    <span class="summary-number">{{ $totalOrders }}</span>
                    <span class="summary-text">Total Orders</span>
                </div>

                <div class="profile-summary-item">
                    <span class="summary-number">{{ $orderCounts['survey'] }}</span>
                    <span class="summary-text">Survey</span>
                </div>

                <div class="profile-summary-item">
                    <span class="summary-number">{{ $orderCounts['testing'] }}</span>
                    <span class="summary-text">Testing</span>
                </div>

                <div class="profile-summary-item">
                    <span class="summary-number">{{ $orderCounts['boq'] }}</span>
                    <span class="summary-text">BOQ</span>
                </div>

                <div class="profile-summary-item">
                    <span class="summary-number">{{ $orderCounts['contractor'] }}</span>
                    <span class="summary-text">Contractor</span>
                </div>

                <div class="profile-summary-item">
                    <span class="summary-number">{{ $orderCounts['interior'] }}</span>
                    <span class="summary-text">Interior</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
