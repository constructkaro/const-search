@extends('layouts.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<style>
    :root{
        --navy:#1c2c3e;
        --navy-soft:#2f4a66;
        --orange:#f25c05;
        --orange-dark:#d94f03;
        --bg:#f4f7fb;
        --card:#ffffff;
        --muted:#6b7280;
        --border:#e7edf4;
        --blue:#2563eb;
        --green:#16a34a;
        --yellow:#d97706;
        --shadow:0 10px 28px rgba(15,23,42,0.06);
    }

    .vendor-page{
        background: var(--bg);
        min-height: 100vh;
        padding: 24px;
    }

    .vendor-header{
        background: linear-gradient(135deg, var(--navy), var(--navy-soft));
        color:#fff;
        border-radius: 24px;
        padding: 28px;
        margin-bottom: 24px;
        box-shadow: 0 12px 28px rgba(28,44,62,0.16);
    }

    .vendor-header-top{
        display:flex;
        justify-content:space-between;
        align-items:flex-start;
        gap:16px;
        flex-wrap:wrap;
    }

    .vendor-header h2{
        margin:0;
        font-size:30px;
        font-weight:800;
    }

    .vendor-header p{
        margin:8px 0 0;
        color:#dbe5ef;
        font-size:14px;
        max-width:900px;
    }

    .table-card{
        background:#fff;
        border:1px solid var(--border);
        border-radius:22px;
        padding:20px;
        box-shadow:var(--shadow);
    }

    .custom-table{
        margin-bottom:0;
        vertical-align:top;
    }

    .custom-table thead th{
        background:#f8fafc;
        color:var(--navy);
        font-size:13px;
        font-weight:800;
        border-bottom:1px solid #e5e7eb;
        padding:14px 12px;
        white-space:nowrap;
    }

    .custom-table tbody td{
        padding:16px 12px;
        font-size:13px;
        color:#475569;
        border-bottom:1px solid #eef2f7;
        vertical-align:top;
    }

    .custom-table tbody tr:hover{
        background:#fbfdff;
    }

    .lead-title{
        font-size:15px;
        font-weight:800;
        color:var(--navy);
        margin-bottom:6px;
    }

    .mini-line{
        font-size:12px;
        color:#64748b;
        line-height:1.7;
    }

    .content-box{
        background:#fbfcff;
        border:1px solid #e8edf4;
        border-radius:16px;
        padding:14px;
        min-width:240px;
    }

    .content-box h6{
        margin:0 0 8px;
        font-size:12px;
        color:#94a3b8;
        text-transform:uppercase;
        letter-spacing:.5px;
        font-weight:800;
    }

    .content-box p{
        margin:0;
        font-size:13px;
        color:#475569;
        line-height:1.7;
        white-space:pre-line;
    }

    .service-chip{
        display:inline-flex;
        align-items:center;
        gap:6px;
        padding:8px 12px;
        border-radius:999px;
        font-size:12px;
        font-weight:800;
        background:#eef4ff;
        color:#1d4ed8;
    }

    .file-link{
        display:inline-flex;
        align-items:center;
        gap:8px;
        background:#eff6ff;
        color:#1d4ed8;
        padding:9px 13px;
        border-radius:12px;
        text-decoration:none;
        font-weight:700;
        font-size:12px;
    }

    .file-link:hover{
        background:#dbeafe;
        color:#1d4ed8;
    }

    .action-btn{
        border:none;
        border-radius:12px;
        padding:10px 14px;
        font-size:12px;
        font-weight:800;
        text-decoration:none;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap:8px;
        transition:.25s ease;
        background:#fff7ed;
        color:#c2410c;
        cursor:pointer;
    }

    .action-btn:hover{
        background:#ffedd5;
        color:#9a3412;
    }

    .empty-row{
        text-align:center;
        padding:36px !important;
        color:#94a3b8 !important;
        font-weight:600;
    }

    .pagination-wrapper{
        display:flex;
        justify-content:end;
        margin-top:20px;
    }

    .pagination{
        margin-bottom:0;
        gap:6px;
    }

    .page-item .page-link{
        border:none;
        border-radius:10px !important;
        padding:10px 14px;
        color:var(--navy);
        font-weight:700;
        background:#f8fafc;
        box-shadow:0 2px 8px rgba(15,23,42,0.04);
    }

    .page-item .page-link:hover{
        background:var(--orange);
        color:#fff;
    }

    .page-item.active .page-link{
        background:var(--orange) !important;
        color:#fff !important;
    }

    .page-item.disabled .page-link{
        background:#eef2f7;
        color:#94a3b8;
    }

    .vendor-modal .modal-content{
        border:none;
        border-radius:24px;
        overflow:hidden;
        box-shadow:0 20px 50px rgba(15,23,42,0.18);
    }

    .vendor-modal .modal-header{
        background:linear-gradient(135deg, #1c2c3e, #2f4a66);
        color:#fff;
        padding:18px 22px;
        border-bottom:none;
    }

    .vendor-modal .modal-title{
        font-size:20px;
        font-weight:800;
    }

    .vendor-modal .modal-body{
        background:#f8fbff;
        padding:22px;
    }

    .vendor-loading{
        text-align:center;
        padding:40px 20px;
        color:#64748b;
        font-weight:600;
    }

    @media (max-width: 768px){
        .vendor-page{
            padding:14px;
        }

        .vendor-header h2{
            font-size:24px;
        }
    }
</style>

<div class="vendor-page">
    <div class="vendor-header">
        <div class="vendor-header-top">
            <div>
                <h2>Vendor Strategy</h2>
                <p>Engineer Desk structured data ready for vendor selection and allocation.</p>
            </div>
        </div>
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Lead / Project</th>
                        <th>Customer Requirement</th>
                        <th>Service Type</th>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vendorStrategies as $item)
                        <tr>
                            <td>{{ $item->id }}</td>

                            <td>
                                <div class="lead-title">{{ $item->title ?? '-' }}</div>
                                <div class="mini-line">
                                    <strong>Name:</strong> {{ $item->contact_name ?? '-' }}<br>
                                    <strong>Mobile:</strong> {{ $item->mobile ?? '-' }}<br>
                                    <strong>City:</strong> {{ $item->city ?? '-' }}
                                </div>
                            </td>

                            <td>
                                <div class="content-box">
                                    <h6>Customer Requirement</h6>
                                    <p>{{ $item->customer_requirement ?? '-' }}</p>
                                </div>
                            </td>

                            <td>
                                @if(!empty($item->service_type))
                                    <span class="service-chip">{{ $item->service_type }}</span>
                                @else
                                    <span class="service-chip" style="background:#f3f4f6;color:#4b5563;">Not Decided</span>
                                @endif
                            </td>

                            <td>
                                @if(!empty($item->files))
                                    <a href="{{ asset('storage/' . $item->files) }}" target="_blank" class="file-link">
                                        <i class="bi bi-paperclip"></i> View File
                                    </a>
                                @else
                                    <span class="mini-line">No file</span>
                                @endif
                            </td>

                            <td>
                                <a href="javascript:void(0)"
                                   class="action-btn open-vendors-btn"
                                   data-post-id="{{ $item->post_id }}">
                                    <i class="bi bi-people"></i> Open
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-row">No vendor strategy data found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($vendorStrategies->hasPages())
            <div class="pagination-wrapper">
                {{ $vendorStrategies->links() }}
            </div>
        @endif
    </div>
</div>

<div class="modal fade vendor-modal" id="vendorsModal" tabindex="-1" aria-labelledby="vendorsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vendorsModalLabel">Vendor List</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="vendorModalContent">
                    <div class="vendor-loading">Loading vendors...</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
<script>
    $(document).on('click', '.open-vendors-btn', function () {
        let postId = $(this).data('post-id');

        $('#vendorModalContent').html('<div class="vendor-loading">Loading vendors...</div>');

        let modal = new bootstrap.Modal(document.getElementById('vendorsModal'));
        modal.show();

        $.ajax({
            url: '/admin/vendor-strategy/' + postId + '/vendors',
            type: 'GET',
            success: function (response) {
                $('#vendorModalContent').html(response.html);
            },
            error: function () {
                $('#vendorModalContent').html('<div class="alert alert-danger mb-0">Failed to load vendors.</div>');
            }
        });
    });
</script>


