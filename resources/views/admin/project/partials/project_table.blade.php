@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">

    <style>
        .table-card {
            background: #fff;
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
            border: 1px solid #ebeff5;
        }

        .custom-table {
            margin-bottom: 0;
            vertical-align: middle;
        }

        .custom-table thead th {
            background: #f8fafc;
            color: #1c2c3e;
            font-size: 14px;
            font-weight: 700;
            border-bottom: 1px solid #e5e7eb;
            padding: 14px 12px;
            white-space: nowrap;
        }

        .custom-table tbody td {
            padding: 14px 12px;
            font-size: 14px;
            color: #475569;
            border-bottom: 1px solid #eef2f7;
            vertical-align: middle;
        }

        .custom-table tbody tr:hover {
            background: #f9fbfd;
        }

        .title-text {
            font-weight: 600;
            color: #1c2c3e;
        }

        .badge-city {
            display: inline-block;
            background: #eff6ff;
            color: #1d4ed8;
            padding: 6px 12px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-action {
            border: none;
            padding: 8px 14px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s ease;
            cursor: pointer;
        }

        .btn-view   { background: #e0f2fe; color: #0369a1; }
        .btn-edit   { background: #fef3c7; color: #b45309; }
        .btn-delete { background: #fee2e2; color: #dc2626; }

        .empty-row {
            text-align: center;
            padding: 30px !important;
            color: #94a3b8 !important;
            font-weight: 500;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: end;
            margin-top: 20px;
        }

        .pagination { margin-bottom: 0; gap: 6px; }

        .page-item .page-link {
            border: none;
            border-radius: 10px !important;
            padding: 10px 14px;
            color: #1c2c3e;
            font-weight: 600;
            background: #f8fafc;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
        }

        .page-item .page-link:hover        { background: #f25c05; color: #fff; }
        .page-item.active .page-link       { background: #f25c05 !important; color: #fff !important; }
        .page-item.disabled .page-link     { background: #eef2f7; color: #94a3b8; }

        .status-select {
            min-width: 150px;
            border-radius: 10px;
            border: 1px solid #dbe3ec;
            padding: 8px 10px;
            font-size: 13px;
            font-weight: 600;
            outline: none;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .status-timepass  { background: #fef2f2; color: #b91c1c; }
        .status-exploring { background: #fffbeb; color: #b45309; }
        .status-serious   { background: #f0fdf4; color: #15803d; }

        /* Toast */
        .toast-msg {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 9999;
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
            transition: opacity 0.4s ease;
        }
        .toast-success { background: #dcfce7; color: #15803d; }
        .toast-error   { background: #fee2e2; color: #dc2626; }
    </style>

    <div class="table-card">
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Contact Name</th>
                        <th>Mobile</th>
                        <th>City</th>
                        <th>Lead Status</th>
                        <th width="220">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td><span class="title-text">{{ $post->title ?? '-' }}</span></td>
                            <td>{{ $post->contact_name ?? '-' }}</td>
                            <td>{{ $post->mobile ?? '-' }}</td>
                            <td><span class="badge-city">{{ $post->city ?? '-' }}</span></td>
                            <td>
                                <select
                                    class="status-select lead-status-dropdown
                                        {{ $post->lead_status == 'timepass'  ? 'status-timepass'  : '' }}
                                        {{ $post->lead_status == 'exploring' ? 'status-exploring' : '' }}
                                        {{ $post->lead_status == 'serious'   ? 'status-serious'   : '' }}"
                                    data-id="{{ $post->id }}">
                                    <option value="">Select</option>
                                    <option value="timepass"  {{ $post->lead_status == 'timepass'  ? 'selected' : '' }}>🔴 Timepass</option>
                                    <option value="exploring" {{ $post->lead_status == 'exploring' ? 'selected' : '' }}>🟡 Exploring</option>
                                    <option value="serious"   {{ $post->lead_status == 'serious'   ? 'selected' : '' }}>🟢 Serious</option>
                                </select>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.post-leads.show', $post->id) }}" class="btn-action btn-view">View</a>
                                    <a href="{{ route('admin.post-leads.edit', $post->id) }}" class="btn-action btn-edit">Edit</a>
                                    <form action="{{ route('admin.post-leads.destroy', $post->id) }}" method="POST"
                                          style="display:inline-block;"
                                          onsubmit="return confirm('Are you sure you want to delete this lead?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty-row">No leads found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($posts->hasPages())
            <div class="pagination-wrapper">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

</div>

<script>
    {{-- ✅ Fix: inject CSRF token directly from Laravel — no meta tag needed --}}
    const CSRF_TOKEN = '{{ csrf_token() }}';

    document.querySelectorAll('.lead-status-dropdown').forEach(function (select) {
        select.addEventListener('change', function () {
            const id     = this.dataset.id;
            const status = this.value;
            const el     = this;

            if (!status) return; // ignore "Select" option

            fetch(`/admin/post-leads/${id}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                },
                body: JSON.stringify({ lead_status: status }),
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Update dropdown colour class
                    el.className = 'status-select lead-status-dropdown';
                    if (status === 'timepass')  el.classList.add('status-timepass');
                    if (status === 'exploring') el.classList.add('status-exploring');
                    if (status === 'serious')   el.classList.add('status-serious');
                    showToast('Status updated successfully!', 'success');
                } else {
                    showToast('Update failed. Try again.', 'error');
                }
            })
            .catch(() => showToast('Something went wrong.', 'error'));
        });
    });

    function showToast(message, type) {
        const toast = document.createElement('div');
        toast.textContent = message;
        toast.className = `toast-msg toast-${type}`;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 400);
        }, 2500);
    }
</script>

@endsection