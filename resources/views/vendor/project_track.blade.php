@extends('vendor.layouts.vapp')

@section('title', 'Project Tracking')

@section('content')
<style>
    .track-page {
        background: #f4f7fb;
        min-height: 100vh;
        padding: 24px;
    }

    .track-shell {
        background: #fff;
        border: 1px solid #ebeff5;
        border-radius: 18px;
        padding: 22px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
    }

    .track-header {
        display: flex;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 22px;
    }

    .track-header h2 {
        margin: 0 0 6px;
        color: #1c2c3e;
        font-size: 28px;
        font-weight: 800;
    }

    .track-header p {
        margin: 0;
        color: #64748b;
        font-size: 14px;
    }

    .track-tabs {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .track-tab {
        border: none;
        border-radius: 999px;
        background: #eef2f7;
        color: #1c2c3e;
        padding: 11px 18px;
        font-weight: 800;
        cursor: pointer;
    }

    .track-tab.active {
        background: #1c2c3e;
        color: #fff;
    }

    .btn-track {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #eff6ff;
        color: #1d4ed8;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
    }

    .btn-track:hover {
        background: #dbeafe;
        color: #1e40af;
    }

    .track-panel {
        display: none;
    }

    .track-panel.active {
        display: block;
    }

    .step-list {
        display: grid;
        gap: 14px;
    }

    .step-card {
        border: 1px solid #e8edf4;
        border-radius: 14px;
        padding: 16px;
        display: flex;
        justify-content: space-between;
        gap: 16px;
        background: #fff;
    }

    .step-title {
        margin: 0 0 6px;
        color: #111827;
        font-size: 18px;
        font-weight: 800;
    }

    .step-desc {
        margin: 0;
        color: #64748b;
        line-height: 1.6;
        font-size: 14px;
    }

    .step-meta {
        margin-top: 10px;
        color: #94a3b8;
        font-size: 13px;
        font-weight: 700;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        border-radius: 999px;
        padding: 8px 13px;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    .status-completed {
        background: #dcfce7;
        color: #15803d;
    }

    .status-pending {
        background: #fff7ed;
        color: #c2410c;
    }

    .status-locked {
        background: #f1f5f9;
        color: #64748b;
    }

    .update-box {
        margin-top: 10px;
        border: 1px dashed #cbd5e1;
        border-radius: 10px;
        padding: 10px 12px;
        color: #334155;
        background: #f8fafc;
        font-size: 14px;
        line-height: 1.6;
    }

    .empty-box {
        border: 1px dashed #cbd5e1;
        border-radius: 14px;
        padding: 28px;
        text-align: center;
        color: #64748b;
        font-weight: 700;
        background: #f8fafc;
    }

    @media (max-width: 768px) {
        .track-page {
            padding: 14px;
        }

        .step-card {
            flex-direction: column;
        }
    }
</style>

@php
    $orderSteps = $trackingSteps->where('tab_type', 'order')->values();
    $executionSteps = $trackingSteps->where('tab_type', 'execution')->values();
@endphp

<div class="track-page">
    <div class="track-shell">
        <div class="track-header">
            <div>
                <h2>Project Tracking</h2>
                <p>
                    Project: <strong>{{ $post->title ?? 'Project' }}</strong> |
                    Project ID: <strong>#{{ str_pad($post->id, 3, '0', STR_PAD_LEFT) }}</strong>
                </p>
            </div>
            <a href="{{ route('vendor.notifications') }}" class="btn-track">Back to Notifications</a>
        </div>

        @if(!$tracking)
            <div class="empty-box">Tracking is not assigned for this project yet.</div>
        @else
            <div class="track-tabs">
                <button type="button" class="track-tab active" data-tab="orderTrackPanel">Order Tracking</button>
                <button type="button" class="track-tab" data-tab="executionTrackPanel">Project Execution Progress</button>
            </div>

            <div class="track-panel active" id="orderTrackPanel">
                @include('vendor.partials.project-tracking-steps', ['steps' => $orderSteps])
            </div>

            <div class="track-panel" id="executionTrackPanel">
                @include('vendor.partials.project-tracking-steps', ['steps' => $executionSteps])
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.track-tab').forEach(function (tab) {
            tab.addEventListener('click', function () {
                document.querySelectorAll('.track-tab').forEach(function (item) {
                    item.classList.remove('active');
                });
                document.querySelectorAll('.track-panel').forEach(function (panel) {
                    panel.classList.remove('active');
                });

                tab.classList.add('active');
                document.getElementById(tab.dataset.tab).classList.add('active');
            });
        });
    });
</script>
@endsection
