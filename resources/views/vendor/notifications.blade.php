@extends('vendor.layouts.vapp')

@section('content')
<style>
    .notification-page {
        background: #f4f7fb;
        min-height: 100vh;
        padding: 24px;
    }

    .notification-header {
        margin-bottom: 22px;
    }

    .notification-header h2 {
        margin: 0;
        color: #1c2c3e;
        font-size: 28px;
        font-weight: 800;
    }

    .notification-header p {
        margin: 6px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    .notification-card {
        background: #fff;
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        border: 1px solid #ebeff5;
        margin-bottom: 18px;
    }

    .notification-title {
        font-size: 18px;
        font-weight: 700;
        color: #1c2c3e;
        margin-bottom: 10px;
    }

    .notification-meta {
        font-size: 13px;
        color: #6b7280;
        line-height: 1.8;
        margin-bottom: 12px;
    }

    .notification-message {
        background: #f8fafc;
        border: 1px solid #e8edf4;
        border-radius: 14px;
        padding: 14px;
        font-size: 14px;
        color: #475569;
        line-height: 1.7;
        margin-bottom: 14px;
    }

    .status-badge {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
    }

    .status-unread {
        background: #fff7ed;
        color: #c2410c;
    }

    .status-read {
        background: #dcfce7;
        color: #15803d;
    }

    .file-btn {
        display: inline-block;
        background: #eff6ff;
        color: #1d4ed8;
        padding: 8px 14px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
    }

    .file-btn:hover {
        background: #dbeafe;
        color: #1e40af;
    }

    .empty-box {
        background: #fff;
        border-radius: 18px;
        padding: 30px;
        text-align: center;
        color: #94a3b8;
        font-weight: 600;
        border: 1px solid #ebeff5;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
    }
</style>

<div class="notification-page">
    <div class="notification-header">
        <h2>Notifications</h2>
        <p>Assigned projects and project notifications for your dashboard.</p>
    </div>

    @forelse($notifications as $item)
        <div class="notification-card">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                <div class="notification-title">{{ $item->title ?? 'Project' }}</div>

                @if($item->status == 'unread')
                    <span class="status-badge status-unread">Unread</span>
                @else
                    <span class="status-badge status-read">Read</span>
                @endif
            </div>

            <div class="notification-meta">
                <strong>Customer:</strong> {{ $item->contact_name ?? '-' }}<br>
               
                <strong>City:</strong> {{ $item->city ?? '-' }}<br>
                <strong>Assigned At:</strong> {{ $item->assigned_at ?? '-' }}
            </div>

            <div class="notification-message">
                {{ $item->message ?? '-' }}
            </div>

            <div class="notification-message">
                <strong>Description:</strong><br>
                {{ $item->description ?? '-' }}
            </div>

            @if(!empty($item->files))
                <a href="{{ asset('storage/' . $item->files) }}" target="_blank" class="file-btn">
                    View File
                </a>
            @endif
        </div>
    @empty
        <div class="empty-box">
            No notifications found.
        </div>
    @endforelse
</div>
@endsection