@extends('layouts.app')

@section('title', 'Order Tracking')

@section('content')
<style>
    .track-page {
        background: #f4f4f4;
        padding: 40px 15px 60px;
    }
    .track-wrap {
        max-width: 1000px;
        margin: 0 auto;
    }
    .track-card {
        background: #fff;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }
    .track-header {
        margin-bottom: 24px;
    }
    .track-header h2 {
        margin: 0 0 8px;
        font-size: 32px;
        font-weight: 800;
    }
    .track-header p {
        margin: 0;
        color: #666;
        font-size: 15px;
    }
    .step-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .step-item {
        border: 1px solid #ececec;
        border-radius: 16px;
        padding: 18px;
        display: flex;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
    }
    .step-left {
        flex: 1;
        min-width: 260px;
    }
    .step-right {
        min-width: 150px;
        text-align: right;
    }
    .step-title {
        margin: 0 0 6px;
        font-size: 20px;
        font-weight: 700;
        color: #111;
    }
    .step-desc {
        margin: 0;
        color: #666;
        font-size: 14px;
        line-height: 1.6;
    }
    .step-meta {
        margin-top: 10px;
        font-size: 13px;
        color: #888;
    }
    .status-badge {
        display: inline-block;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
    }
    .status-completed {
        background: #dcfce7;
        color: #15803d;
    }
    .status-pending {
        background: #ffedd5;
        color: #ea580c;
    }
    .status-locked {
        background: #f3f4f6;
        color: #6b7280;
    }
    .input-value-box {
        margin-top: 12px;
        font-size: 14px;
        color: #222;
        background: #f9fafb;
        border: 1px dashed #d1d5db;
        border-radius: 10px;
        padding: 10px 12px;
    }
</style>

<section class="track-page">
    <div class="track-wrap">
        <div class="track-card">
            <div class="track-header">
                <h2>Order Tracking</h2>
                <p>
                    Service: <strong>{{ ucfirst($tracking->service_key) }}</strong> |
                    Order ID: <strong>#{{ str_pad($tracking->source_id, 3, '0', STR_PAD_LEFT) }}</strong>
                </p>
            </div>

            <div class="step-list">
                @forelse($trackingSteps as $step)
                    <div class="step-item">
                        <div class="step-left">
                            <h4 class="step-title">{{ $step->step_title }}</h4>
                            <p class="step-desc">{{ $step->step_description ?: '-' }}</p>
                            <div class="step-meta">
                                Tab: {{ ucfirst($step->tab_type) }} |
                                Step Order: {{ $step->step_order }} |
                                Type: {{ ucfirst($step->step_type) }}
                            </div>

                            @if($step->input_value)
                                <div class="input-value-box">
                                    <strong>Update:</strong> {{ $step->input_value }}
                                </div>
                            @endif
                        </div>

                        <div class="step-right">
                            @if($step->status == 'completed')
                                <span class="status-badge status-completed">Completed</span>
                            @elseif($step->status == 'pending')
                                <span class="status-badge status-pending">Pending</span>
                            @else
                                <span class="status-badge status-locked">Locked</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center">No tracking steps found.</div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection