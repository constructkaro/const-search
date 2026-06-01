@extends('layouts.admin')

@section('title', 'Project Tracking')
@section('page_title', 'Project Tracking')

@section('content')
<style>
    .tracking-page {
        display: grid;
        gap: 18px;
    }

    .tracking-hero {
        background: linear-gradient(135deg, #1c2c3e 0%, #2f4a66 100%);
        color: #fff;
        border-radius: 22px;
        padding: 24px;
        box-shadow: 0 14px 34px rgba(28, 44, 62, 0.16);
        display: flex;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
        align-items: center;
    }

    .tracking-hero h4 {
        margin: 0 0 6px;
        font-size: 28px;
        font-weight: 800;
    }

    .tracking-hero p {
        margin: 0;
        color: #dbe5ef;
        max-width: 760px;
        font-size: 14px;
        line-height: 1.7;
    }

    .tracking-hero-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .hero-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 12px;
        padding: 11px 14px;
        color: #fff;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.18);
        font-weight: 800;
        text-decoration: none;
        font-size: 13px;
    }

    .hero-btn:hover {
        color: #fff;
        background: #f25c05;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
    }

    .summary-card {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 18px;
        padding: 18px;
        box-shadow: 0 8px 24px rgba(15,23,42,0.05);
    }

    .summary-label {
        color: #64748b;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .4px;
        margin-bottom: 8px;
    }

    .summary-value {
        color: #1c2c3e;
        font-size: 30px;
        font-weight: 900;
    }

    .table-card {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 22px;
        padding: 18px;
        box-shadow: 0 8px 24px rgba(15,23,42,0.05);
    }

    .tracking-table {
        margin-bottom: 0;
        min-width: 1120px;
    }

    .tracking-table thead th {
        background: #f8fafc;
        color: #1c2c3e;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .35px;
        border-bottom: 1px solid #e5e7eb;
        padding: 14px 12px;
        white-space: nowrap;
    }

    .tracking-table tbody td {
        padding: 16px 12px;
        vertical-align: middle;
        color: #475569;
        font-size: 13px;
        border-bottom: 1px solid #eef2f7;
    }

    .project-title {
        color: #1c2c3e;
        font-size: 15px;
        font-weight: 900;
        margin-bottom: 5px;
    }

    .muted-line {
        color: #64748b;
        font-size: 12px;
        line-height: 1.6;
    }

    .service-chip,
    .status-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 999px;
        padding: 8px 11px;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    .service-chip {
        background: #eff6ff;
        color: #1d4ed8;
    }

    .status-chip.active {
        background: #dcfce7;
        color: #15803d;
    }

    .status-chip.pending {
        background: #fff7ed;
        color: #c2410c;
    }

    .template-form {
        display: grid;
        grid-template-columns: minmax(220px, 1fr) auto;
        gap: 8px;
        align-items: center;
    }

    .action-stack {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .soft-btn {
        border: none;
        border-radius: 11px;
        padding: 10px 13px;
        font-size: 12px;
        font-weight: 800;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }

    .soft-btn.save {
        background: #f25c05;
        color: #fff;
    }

    .soft-btn.manage {
        background: #eef4ff;
        color: #1d4ed8;
    }

    .soft-btn.manage:hover {
        background: #dbeafe;
        color: #1e40af;
    }

    .empty-row {
        text-align: center;
        padding: 34px !important;
        color: #94a3b8 !important;
        font-weight: 700;
    }

    @media (max-width: 991px) {
        .summary-grid {
            grid-template-columns: 1fr;
        }

        .template-form {
            grid-template-columns: 1fr;
        }
    }
</style>

@php
    $totalOrders = $allOrders->count();
    $assignedCount = $assignedTrackings->count();
    $manualCount = $assignedTrackings->where('template_code', 'manual')->count();
@endphp

<div class="tracking-page">
    <div class="tracking-hero">
        <div>
            <h4>Project Tracking Center</h4>
            <p>Assign a tracking flow to any customer project, then open Manage Milestones to add project-wise updates. These milestones are visible to the customer and to the assigned vendor.</p>
        </div>
        <div class="tracking-hero-actions">
            <a href="{{ route('admin.tracking_templates.index') }}" class="hero-btn">
                <i class="bi bi-layout-text-window-reverse"></i> Templates
            </a>
            <a href="{{ route('admin.allprojects') }}" class="hero-btn">
                <i class="bi bi-kanban"></i> Projects
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-0">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mb-0">{{ session('error') }}</div>
    @endif

    <div class="summary-grid">
        <div class="summary-card">
            <div class="summary-label">Total Items</div>
            <div class="summary-value">{{ $totalOrders }}</div>
        </div>
        <div class="summary-card">
            <div class="summary-label">Tracking Assigned</div>
            <div class="summary-value">{{ $assignedCount }}</div>
        </div>
        <div class="summary-card">
            <div class="summary-label">Manual Flows</div>
            <div class="summary-value">{{ $manualCount }}</div>
        </div>
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="table tracking-table align-middle">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Service</th>
                        <th>Type</th>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Tracking Flow</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allOrders as $order)
                        @php
                            $trackingKey = $order->service_key . '_' . $order->id;
                            $assigned = $assignedTrackings[$trackingKey] ?? null;
                            $serviceTemplates = $templateOptions[$order->service_key] ?? collect();
                        @endphp

                        <tr>
                            <td>
                                <div class="project-title">{{ $order->title }}</div>
                                <div class="muted-line">ID #{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}</div>
                            </td>
                            <td>
                                <span class="service-chip">{{ ucfirst($order->service_key) }}</span>
                            </td>
                            <td>{{ $order->type }}</td>
                            <td>{{ $order->location }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</td>
                            <td>
                                <form action="{{ route('admin.order_tracking.assign') }}" method="POST" class="template-form">
                                    @csrf
                                    <input type="hidden" name="service_key" value="{{ $order->service_key }}">
                                    <input type="hidden" name="source_id" value="{{ $order->id }}">
                                    <input type="hidden" name="source_table" value="{{ $order->source_table }}">
                                    <input type="hidden" name="customer_id" value="{{ $order->customer_id }}">

                                    <select name="template_code" class="form-select form-select-sm">
                                        <option value="manual" {{ $assigned && $assigned->template_code === 'manual' ? 'selected' : '' }}>Manual Milestones</option>
                                        @foreach($serviceTemplates as $template)
                                            <option value="{{ $template->template_code }}"
                                                {{ $assigned && $assigned->template_code == $template->template_code ? 'selected' : '' }}>
                                                {{ $template->template_name }} ({{ $template->template_code }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="soft-btn save">
                                        <i class="bi bi-check2"></i> Save
                                    </button>
                                </form>
                            </td>
                            <td>
                                @if($assigned)
                                    <span class="status-chip active">
                                        <i class="bi bi-check-circle-fill"></i>
                                        Assigned
                                    </span>
                                @else
                                    <span class="status-chip pending">
                                        <i class="bi bi-clock-history"></i>
                                        Not Started
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="action-stack">
                                    @if($assigned)
                                        <a href="{{ route('admin.order_tracking.steps', [$order->service_key, $order->id]) }}"
                                           class="soft-btn manage">
                                            <i class="bi bi-list-check"></i> Manage Milestones
                                        </a>
                                    @else
                                        <span class="muted-line">Save a flow first</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty-row">No projects or orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
