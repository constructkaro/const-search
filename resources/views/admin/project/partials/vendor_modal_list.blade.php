<style>
    .vendor-table-card{
        background:#fff;
        border:1px solid #e8edf4;
        border-radius:18px;
        padding:18px;
    }

    .vendor-custom-table{
        margin-bottom:0;
        vertical-align:middle;
    }

    .vendor-custom-table thead th{
        background:#f8fafc;
        color:#1c2c3e;
        font-size:13px;
        font-weight:800;
        border-bottom:1px solid #e5e7eb;
        padding:14px 12px;
        white-space:nowrap;
    }

    .vendor-custom-table tbody td{
        padding:14px 12px;
        font-size:13px;
        color:#475569;
        border-bottom:1px solid #eef2f7;
        vertical-align:middle;
    }

    .vendor-name{
        font-weight:700;
        color:#1c2c3e;
    }

    .vendor-chip{
        display:inline-flex;
        align-items:center;
        gap:6px;
        background:#eef4ff;
        color:#1d4ed8;
        padding:7px 12px;
        border-radius:999px;
        font-size:12px;
        font-weight:700;
    }

    .select-vendor-btn{
        border:none;
        border-radius:10px;
        padding:8px 14px;
        font-size:12px;
        font-weight:800;
        background:#fff7ed;
        color:#c2410c;
        transition:0.3s ease;
    }

    .select-vendor-btn:hover{
        background:#ffedd5;
    }

    .select-vendor-btn.assigned-btn{
        background:#dcfce7 !important;
        color:#15803d !important;
        cursor:not-allowed;
    }
</style>

@if($vendors->count())
    <div class="vendor-table-card">
        <div class="table-responsive">
            <table class="table vendor-custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Vendor</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>Project Types</th>
                        <th>Experience</th>
                        <th>Team Size</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vendors as $vendor)
                        @php
                            $types = json_decode($vendor->project_types, true);
                            $alreadyNotified = !empty($vendor->notification_id);
                        @endphp

                        <tr>
                            <td>{{ $vendor->id }}</td>

                            <td>
                                <span class="vendor-name">
                                    {{ $vendor->company_name ?? $vendor->full_name ?? '-' }}
                                </span>
                            </td>

                            <td>{{ $vendor->mobile ?? '-' }}</td>
                            <td>{{ $vendor->email ?? '-' }}</td>
                            <td>{{ $vendor->city ?? '-' }}</td>

                            <td>
                                @if(is_array($types) && count($types))
                                    {{ implode(', ', $types) }}
                                @else
                                    {{ $vendor->project_types ?? '-' }}
                                @endif
                            </td>

                            <td>{{ $vendor->experience_years ?? '-' }}</td>
                            <td>{{ $vendor->team_size ?? '-' }}</td>

                            <td>
                                @if($alreadyNotified)
                                    <button
                                        type="button"
                                        class="select-vendor-btn assigned-btn"
                                        disabled>
                                        Already Notified
                                    </button>
                                @else
                                    <button
                                        type="button"
                                        class="select-vendor-btn assign-vendor-btn"
                                        data-post-id="{{ $post->id }}"
                                        data-vendor-id="{{ $vendor->id }}"
                                        data-service-type="{{ $serviceType ?? '' }}">
                                        Select Vendor
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <div class="alert alert-warning mb-0">No matching vendors found.</div>
@endif

<script>
    $(document).off('click', '.assign-vendor-btn').on('click', '.assign-vendor-btn', function () {
        let postId = $(this).data('post-id');
        let vendorId = $(this).data('vendor-id');
        let serviceType = $(this).data('service-type');
        let button = $(this);

        button.prop('disabled', true).text('Assigning...');

        $.ajax({
            url: "{{ route('admin.assign.vendor') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                post_id: postId,
                vendor_id: vendorId,
                service_type: serviceType
            },
            success: function (response) {
                if (response.status) {
                    button
                        .text('Already Notified')
                        .addClass('assigned-btn')
                        .prop('disabled', true);
                } else {
                    alert(response.message);
                    button.prop('disabled', false).text('Select Vendor');
                }
            },
            error: function (xhr) {
                let message = 'Something went wrong while assigning vendor.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                alert(message);
                button.prop('disabled', false).text('Select Vendor');
            }
        });
    });
</script>