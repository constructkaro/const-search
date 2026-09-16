@extends('vendor.layouts.vapp')

@section('title', 'Vendor Dashboard')
@section('page_title', 'Dashboard')

@section('content')

@php
    $profileCount = $completedProfiles->count();
    $profilePercent = min(100, round(($profileCount / 6) * 100));
@endphp

<style>
    .vendor-dashboard {
        display: grid;
        gap: 22px;
    }

    .dashboard-hero {
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto;
        gap: 22px;
        align-items: center;
        background: linear-gradient(135deg, #111633 0%, #1e3766 100%);
        border-radius: 22px;
        padding: 28px;
        color: #fff;
        box-shadow: 0 18px 42px rgba(17, 22, 51, 0.16);
        overflow: hidden;
        position: relative;
    }

    .dashboard-hero::after {
        content: "";
        position: absolute;
        right: -70px;
        top: -80px;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(245, 166, 35, 0.18);
    }

    .dashboard-hero h1 {
        margin: 0;
        font-size: 30px;
        line-height: 1.2;
        font-weight: 900;
    }

    .dashboard-hero p {
        margin: 10px 0 0;
        max-width: 680px;
        color: rgba(255, 255, 255, 0.78);
        line-height: 1.6;
    }

    .hero-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        justify-content: flex-end;
        position: relative;
        z-index: 1;
    }

    .hero-btn {
        min-height: 46px;
        padding: 0 18px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        font-weight: 800;
        color: #111633;
        background: #f5a623;
        border: 1px solid #f5a623;
    }

    .hero-btn.secondary {
        color: #fff;
        background: rgba(255, 255, 255, 0.10);
        border-color: rgba(255, 255, 255, 0.22);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
    }

    .metric-card {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 10px 26px rgba(15, 23, 42, 0.05);
    }

    .metric-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #fff4eb;
        color: #eb7a2f;
        margin-bottom: 16px;
    }

    .metric-card strong {
        display: block;
        color: #111633;
        font-size: 30px;
        line-height: 1;
        margin-bottom: 8px;
    }

    .metric-card span {
        color: #667085;
        font-weight: 700;
        font-size: 14px;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: minmax(0, 0.9fr) minmax(0, 1.1fr);
        gap: 18px;
    }

    .dashboard-panel {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 18px;
        padding: 22px;
        box-shadow: 0 10px 26px rgba(15, 23, 42, 0.05);
    }

    .panel-title {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        align-items: center;
        margin-bottom: 18px;
    }

    .panel-title h2 {
        margin: 0;
        color: #111633;
        font-size: 20px;
    }

    .panel-title a {
        color: #1d4ed8;
        font-weight: 800;
        font-size: 14px;
    }

    .progress-track {
        height: 12px;
        border-radius: 999px;
        background: #eef2f7;
        overflow: hidden;
        margin: 16px 0;
    }

    .progress-fill {
        height: 100%;
        width: var(--progress);
        border-radius: inherit;
        background: linear-gradient(90deg, #f5a623, #eb7a2f);
    }

    .profile-list,
    .lead-list {
        display: grid;
        gap: 12px;
    }

    .profile-chip {
        display: flex;
        align-items: center;
        gap: 10px;
        min-height: 42px;
        padding: 0 12px;
        border-radius: 12px;
        background: #ecfdf3;
        color: #027a48;
        font-weight: 800;
    }

    .empty-state {
        border: 1px dashed #cbd5e1;
        border-radius: 14px;
        padding: 22px;
        color: #64748b;
        background: #f8fafc;
        line-height: 1.6;
    }

    .lead-item {
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto;
        gap: 14px;
        align-items: center;
        padding: 14px;
        border: 1px solid #edf1f6;
        border-radius: 14px;
        background: #fff;
    }

    .lead-item strong {
        display: block;
        color: #111633;
        margin-bottom: 5px;
    }

    .lead-item span {
        color: #667085;
        font-size: 13px;
        font-weight: 700;
    }

    .lead-status {
        display: inline-flex;
        align-items: center;
        min-height: 30px;
        padding: 0 10px;
        border-radius: 999px;
        background: #fff7ed;
        color: #c2410c;
        font-size: 12px;
        font-weight: 900;
        white-space: nowrap;
    }

    .lead-status.read {
        background: #ecfdf3;
        color: #027a48;
    }

    @media (max-width: 1100px) {
        .stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .dashboard-grid,
        .dashboard-hero {
            grid-template-columns: 1fr;
        }

        .hero-actions {
            justify-content: flex-start;
        }
    }

    @media (max-width: 640px) {
        .dashboard-hero,
        .dashboard-panel,
        .metric-card {
            padding: 18px;
            border-radius: 16px;
        }

        .dashboard-hero h1 {
            font-size: 24px;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .lead-item {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="vendor-dashboard">
    <section class="dashboard-hero">
        <div>
            <h1>Welcome, {{ session('vendor_name') ?? 'Vendor' }}</h1>
            <p>Manage your service profile, review assigned projects, submit BOQ responses, and track execution progress from one clean workspace.</p>
        </div>

        <div class="hero-actions">
            <a href="{{ route('vendor.categories') }}" class="hero-btn">
                <i class="fa-solid fa-user-gear"></i>
                Complete Profile
            </a>
            <a href="{{ route('vendor.notifications') }}" class="hero-btn secondary">
                <i class="fa-solid fa-bell"></i>
                View Leads
            </a>
        </div>
    </section>

    <section class="stats-grid">
        <div class="metric-card">
            <span class="metric-icon"><i class="fa-solid fa-briefcase"></i></span>
            <strong>{{ $notificationCount }}</strong>
            <span>Total Assigned Projects</span>
        </div>

        <div class="metric-card">
            <span class="metric-icon"><i class="fa-solid fa-envelope-open-text"></i></span>
            <strong>{{ $unreadCount }}</strong>
            <span>Unread Notifications</span>
        </div>

        <div class="metric-card">
            <span class="metric-icon"><i class="fa-solid fa-handshake"></i></span>
            <strong>{{ $interestedCount }}</strong>
            <span>Interested Responses</span>
        </div>

        <div class="metric-card">
            <span class="metric-icon"><i class="fa-solid fa-circle-check"></i></span>
            <strong>{{ $profilePercent }}%</strong>
            <span>Profile Completion</span>
        </div>
    </section>

    <section class="dashboard-grid">
        <div class="dashboard-panel">
            <div class="panel-title">
                <h2>Profile Setup</h2>
                <a href="{{ route('vendor.categories') }}">Update</a>
            </div>

            <p style="color:#667085;line-height:1.6;margin:0;">Complete the service profiles that match your business so ConstructKaro can assign relevant project leads.</p>

            <div class="progress-track" aria-label="Profile completion">
                <div class="progress-fill" style="--progress: {{ $profilePercent }}%;"></div>
            </div>

            @if($completedProfiles->isNotEmpty())
                <div class="profile-list">
                    @foreach($completedProfiles as $profile)
                        <div class="profile-chip">
                            <i class="fa-solid fa-check"></i>
                            {{ $profile }}
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    No vendor category profile is completed yet. Start by selecting your service category.
                </div>
            @endif
        </div>

        <div class="dashboard-panel">
            <div class="panel-title">
                <h2>Recent Project Leads</h2>
                <a href="{{ route('vendor.notifications') }}">View all</a>
            </div>

            @if($latestNotifications->isNotEmpty())
                <div class="lead-list">
                    @foreach($latestNotifications as $item)
                        <a href="{{ route('vendor.notifications') }}" class="lead-item">
                            <span>
                                <strong>{{ $item->title ?? 'Project Lead' }}</strong>
                                <span>{{ $item->service_type ?? 'Service' }} @if(!empty($item->city_id)) - {{ $item->city_id }} @endif</span>
                            </span>
                            <span class="lead-status {{ ($item->status ?? '') === 'unread' ? '' : 'read' }}">
                                {{ ucfirst($item->status ?? 'read') }}
                            </span>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    No project leads assigned yet. Keep your profile complete so the team can match you with the right work.
                </div>
            @endif
        </div>
    </section>
</div>

@endsection
