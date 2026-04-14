@extends('layouts.app')

@section('title', 'Order Tracking')

@section('content')

<style>
    body{
        margin:0;
        font-family:'Poppins',sans-serif;
        background:#f3f4f6;
    }

    .tracking-page{
        padding:30px 20px 60px;
        background:#f3f4f6;
        min-height:100vh;
    }

    .tracking-container{
        max-width:1100px;
        margin:0 auto;
    }

    .tracking-tabs{
        display:flex;
        gap:14px;
        margin-bottom:24px;
        flex-wrap:wrap;
    }

    .tracking-tab{
        min-width:220px;
        height:48px;
        border:none;
        border-radius:999px;
        background:#fff;
        box-shadow:0 4px 14px rgba(0,0,0,0.08);
        font-size:16px;
        font-weight:700;
        cursor:pointer;
        transition:0.3s ease;
    }

    .tracking-tab.active{
        background:linear-gradient(90deg,#2f7ec6 0%,#f18a2a 100%);
        color:#fff;
    }

    .tracking-panel{
        display:none;
    }

    .tracking-panel.active{
        display:block;
    }

    .tracking-box{
        background:#fff;
        border-radius:22px;
        padding:20px;
        box-shadow:0 8px 26px rgba(0,0,0,0.08);
    }

    .tracking-step-row{
        display:grid;
        grid-template-columns:70px 1fr;
        gap:14px;
        margin-bottom:14px;
        align-items:stretch;
    }

    .step-left{
        display:flex;
        justify-content:center;
        position:relative;
    }

    .step-icon-wrap{
        width:70px;
        position:relative;
        display:flex;
        justify-content:center;
    }

    .step-line{
        position:absolute;
        top:38px;
        bottom:-20px;
        left:50%;
        transform:translateX(-50%);
        width:2px;
        background:#cfcfcf;
    }

    .tracking-step-row:last-child .step-line{
        display:none;
    }

    .step-icon{
        width:40px;
        height:40px;
        border-radius:50%;
        display:flex;
        align-items:center;
        justify-content:center;
        background:#fff;
        border:2px solid #cfcfcf;
        font-size:16px;
        font-weight:700;
        color:#666;
        position:relative;
        z-index:2;
    }

    .tracking-step-row.completed .step-icon{
        background:#16a34a;
        color:#fff;
        border-color:#16a34a;
    }

    .tracking-step-row.pending .step-icon{
        border-color:#f18a2a;
        color:#f18a2a;
    }

    .tracking-step-row.locked .step-icon{
        background:#f3f4f6;
        color:#999;
        border-color:#d1d5db;
    }

    .track-card{
        background:#fff;
        border:1px solid #e5e7eb;
        border-radius:14px;
        padding:16px;
        box-shadow:0 4px 12px rgba(0,0,0,0.05);
    }

    .track-card h4{
        margin:0 0 6px;
        font-size:18px;
        font-weight:800;
        color:#111827;
    }

    .track-card p{
        margin:0 0 10px;
        color:#6b7280;
        font-size:14px;
        line-height:1.6;
    }

    .step-status{
        font-size:13px;
        font-weight:700;
        margin-bottom:10px;
    }

    .step-status.completed{
        color:#16a34a;
    }

    .step-status.pending{
        color:#f18a2a;
    }

    .step-status.locked{
        color:#9ca3af;
    }

    .action-row{
        display:flex;
        gap:8px;
        flex-wrap:wrap;
    }

    .mini-btn{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        min-width:90px;
        height:34px;
        padding:0 14px;
        border:none;
        border-radius:8px;
        font-size:13px;
        font-weight:700;
        text-decoration:none;
        cursor:pointer;
    }

    .mini-btn.orange{
        background:#f18a2a;
        color:#fff;
    }

    .mini-btn.light{
        background:#f3f4f6;
        color:#222;
    }

    .mini-btn.blue{
        background:#2f7ec6;
        color:#fff;
    }

    .empty-box{
        background:#fff;
        border-radius:16px;
        padding:30px;
        text-align:center;
        color:#6b7280;
        font-weight:600;
        box-shadow:0 8px 24px rgba(0,0,0,0.08);
    }

    .text-input-box textarea{
        width:100%;
        min-height:80px;
        border:1px solid #d1d5db;
        border-radius:10px;
        padding:10px 12px;
        resize:vertical;
        font-size:14px;
    }

    @media(max-width:767px){
        .tracking-step-row{
            grid-template-columns:1fr;
        }

        .step-left{
            display:none;
        }

        .tracking-tab{
            min-width:100%;
        }
    }
</style>

<div class="tracking-page">
    <div class="tracking-container">

        <div class="tracking-tabs">
            <button class="tracking-tab active" data-tab="orderTab">Order Tracking</button>
            <button class="tracking-tab" data-tab="executionTab">Project Execution Progress</button>
        </div>

        <div class="tracking-panel active" id="orderTab">
            @if($orderSteps->count())
                <div class="tracking-box">
                    @foreach($orderSteps as $step)
                        <div class="tracking-step-row {{ $step->status_default }}">
                            <div class="step-left">
                                <div class="step-icon-wrap">
                                    <div class="step-icon">{{ $step->step_order }}</div>
                                    <div class="step-line"></div>
                                </div>
                            </div>

                            <div class="track-card">
                                <h4>{{ $step->step_title }}</h4>

                                @if(!empty($step->step_description))
                                    <p>{{ $step->step_description }}</p>
                                @endif

                                <div class="step-status {{ $step->status_default }}">
                                    {{ ucfirst($step->status_default) }}
                                </div>

                                @if($step->step_type === 'choice')
                                    <div class="action-row">
                                        <button class="mini-btn orange">Yes</button>
                                        <button class="mini-btn light">No</button>
                                    </div>
                                @elseif($step->step_type === 'download')
                                    <div class="action-row">
                                        <a href="#" class="mini-btn orange">{{ $step->button_text ?: 'Download' }}</a>
                                    </div>
                                @elseif($step->step_type === 'payment')
                                    <div class="action-row">
                                        <a href="#" class="mini-btn orange">{{ $step->button_text ?: 'Payment' }}</a>
                                    </div>
                                @elseif($step->step_type === 'textarea')
                                    <div class="text-input-box">
                                        <textarea placeholder="Write your response here"></textarea>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-box">
                    No order tracking steps found for <strong>{{ ucfirst($service) }}</strong>.
                </div>
            @endif
        </div>

        <div class="tracking-panel" id="executionTab">
            @if($executionSteps->count())
                <div class="tracking-box">
                    @foreach($executionSteps as $step)
                        <div class="tracking-step-row {{ $step->status_default }}">
                            <div class="step-left">
                                <div class="step-icon-wrap">
                                    <div class="step-icon">{{ $step->step_order }}</div>
                                    <div class="step-line"></div>
                                </div>
                            </div>

                            <div class="track-card">
                                <h4>{{ $step->step_title }}</h4>

                                @if(!empty($step->step_description))
                                    <p>{{ $step->step_description }}</p>
                                @endif

                                <div class="step-status {{ $step->status_default }}">
                                    {{ ucfirst($step->status_default) }}
                                </div>

                                @if($step->step_type === 'choice')
                                    <div class="action-row">
                                        <button class="mini-btn blue">Yes</button>
                                        <button class="mini-btn light">No</button>
                                    </div>
                                @elseif($step->step_type === 'download')
                                    <div class="action-row">
                                        <a href="#" class="mini-btn blue">{{ $step->button_text ?: 'Download' }}</a>
                                    </div>
                                @elseif($step->step_type === 'payment')
                                    <div class="action-row">
                                        <a href="#" class="mini-btn blue">{{ $step->button_text ?: 'Payment' }}</a>
                                    </div>
                                @elseif($step->step_type === 'textarea')
                                    <div class="text-input-box">
                                        <textarea placeholder="Write your response here"></textarea>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-box">
                    No execution steps found for <strong>{{ ucfirst($service) }}</strong>.
                </div>
            @endif
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('.tracking-tab');
        const panels = document.querySelectorAll('.tracking-panel');

        tabs.forEach(tab => {
            tab.addEventListener('click', function () {
                tabs.forEach(t => t.classList.remove('active'));
                panels.forEach(p => p.classList.remove('active'));

                this.classList.add('active');
                document.getElementById(this.dataset.tab).classList.add('active');
            });
        });
    });
</script>

@endsection