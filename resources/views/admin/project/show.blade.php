@extends('layouts.admin')

@section('content')
<style>
    .lead-show-page {
        background: #f4f7fb;
        min-height: 100vh;
        padding: 24px;
    }

    .lead-show-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        margin-bottom: 22px;
    }

    .lead-show-header h2 {
        margin: 0;
        color: #1c2c3e;
        font-weight: 700;
        font-size: 28px;
    }

    .back-btn {
        background: #1c2c3e;
        color: #fff;
        padding: 10px 18px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        display: inline-block;
    }

    .back-btn:hover {
        color: #fff;
        background: #162433;
    }

    .show-card {
        background: #fff;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        border: 1px solid #ebeff5;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: #1c2c3e;
        margin-bottom: 18px;
        padding-bottom: 10px;
        border-bottom: 1px solid #edf1f5;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 24px;
    }

    .detail-box {
        background: #f8fafc;
        border: 1px solid #e8edf4;
        border-radius: 16px;
        padding: 16px;
    }

    .detail-box label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 8px;
    }

    .detail-box .value {
        font-size: 15px;
        font-weight: 700;
        color: #1c2c3e;
        word-break: break-word;
    }

    .full-box {
        background: #f8fafc;
        border: 1px solid #e8edf4;
        border-radius: 16px;
        padding: 18px;
        margin-bottom: 18px;
    }

    .full-box label {
        display: block;
        font-size: 14px;
        font-weight: 700;
        color: #1c2c3e;
        margin-bottom: 10px;
    }

    .full-box .value {
        font-size: 14px;
        color: #475569;
        line-height: 1.8;
        white-space: pre-line;
    }

    .action-row {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 24px;
    }

    .edit-btn {
        background: #f59e0b;
        color: #fff;
        padding: 10px 18px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
    }

    .edit-btn:hover {
        color: #fff;
        background: #d97706;
    }

    .delete-btn {
        background: #dc2626;
        color: #fff;
        border: none;
        padding: 10px 18px;
        border-radius: 12px;
        font-weight: 600;
    }

    .delete-btn:hover {
        background: #b91c1c;
    }

    .file-link {
        display: inline-block;
        background: #eff6ff;
        color: #1d4ed8;
        padding: 8px 14px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
    }

    .file-link:hover {
        color: #1e40af;
        background: #dbeafe;
    }

    @media (max-width: 991px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }
    }
    .form-control {
    border-radius: 12px !important;
    border: 1px solid #dbe3ec !important;
    padding: 12px 14px !important;
    box-shadow: none !important;
    font-size: 14px;
}

.form-control:focus {
    border-color: #f25c05 !important;
    box-shadow: 0 0 0 0.15rem rgba(242, 92, 5, 0.15) !important;
}

#updateDescriptionBtn {
    background: #f25c05;
    border: none;
    color: #fff;
    padding: 10px 18px;
    border-radius: 12px;
    font-weight: 600;
}

#updateDescriptionBtn:hover {
    background: #d94f03;
}

#descMessage.success {
    color: #15803d;
    font-weight: 600;
}

#descMessage.error {
    color: #dc2626;
    font-weight: 600;
}
</style>

<div class="lead-show-page">
    <div class="lead-show-header">
        <h2>Lead Details</h2>
        <a href="{{ route('admin.allprojects') }}" class="back-btn">Back</a>
    </div>

    <div class="show-card">
        <div class="section-title">Basic Information</div>

        <div class="detail-grid">
            <div class="detail-box">
                <label>ID</label>
                <div class="value">{{ $post->id ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <label>Title</label>
                <div class="value">{{ $post->title ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <label>Contact Name</label>
                <div class="value">{{ $post->contact_name ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <label>Mobile</label>
                <div class="value">{{ $post->mobile ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <label>Email</label>
                <div class="value">{{ $post->email ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <label>Area</label>
                <div class="value">{{ $post->area ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <label>Work Type ID</label>
                <div class="value">{{ $post->work_type_id ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <label>Work Subtype ID</label>
                <div class="value">{{ $post->work_subtype_id ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <label>Budget ID</label>
                <div class="value">{{ $post->budget_id ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <label>Unit ID</label>
                <div class="value">{{ $post->unit_id ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <label>Contact Time</label>
                <div class="value">{{ $post->contact_time ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <label>Pincode</label>
                <div class="value">{{ $post->pincode ?? '-' }}</div>
            </div>
        </div>

        <div class="section-title">Location Information</div>

        <div class="detail-grid">
            <div class="detail-box">
                <label>State</label>
                <div class="value">{{ $post->state ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <label>Region</label>
                <div class="value">{{ $post->region ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <label>City</label>
                <div class="value">{{ $post->city ?? '-' }}</div>
            </div>
        </div>

        <div class="section-title">Requirement Details</div>

        <div class="full-box">
            <label>Description</label>
            <div class="value">{{ $post->description ?? '-' }}</div>
        </div>

        <div class="full-box">
            <label>Uploaded File</label>
            <div class="value">
                @if(!empty($post->files))
                    <a href="{{ asset('storage/' . $post->files) }}" target="_blank" class="file-link">View File</a>
                @else
                    -
                @endif
            </div>
        </div>

        <div class="section-title">System Information</div>

        <div class="detail-grid">
            <div class="detail-box">
                <label>User ID</label>
                <div class="value">{{ $post->user_id ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <label>Post Verify</label>
                <div class="value">{{ $post->post_verify ?? 0 }}</div>
            </div>

            <div class="detail-box">
                <label>Get Vendor</label>
                <div class="value">{{ $post->get_vendor ?? 0 }}</div>
            </div>

            <div class="detail-box">
                <label>Created At</label>
                <div class="value">{{ $post->created_at ?? '-' }}</div>
            </div>

            <div class="detail-box">
                <label>Updated At</label>
                <div class="value">{{ $post->updated_at ?? '-' }}</div>
            </div>
        </div>
        <div class="full-box">
            <label>Update Description</label>

            <textarea id="description" class="form-control" rows="6" placeholder="Enter updated description...">{{ $post->description ?? '' }}</textarea>

            <div class="mt-3">
                <button type="button" class="btn btn-primary" id="updateDescriptionBtn" data-id="{{ $post->id }}">
                    Update Description
                </button>
                <span id="descMessage" class="ms-2"></span>
            </div>
        </div>
        <div class="action-row">
            <a href="{{ route('admin.post-leads.edit', $post->id) }}" class="edit-btn">Edit</a>

            <form action="{{ route('admin.post-leads.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this lead?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">Delete</button>
            </form>
        </div>
            
        </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).on('click', '#updateDescriptionBtn', function () {
        let id = $(this).data('id');
        let description = $('#description').val();
        let msgBox = $('#descMessage');
        let btn = $(this);

        msgBox.removeClass('success error').text('');
        btn.prop('disabled', true).text('Updating...');

        $.ajax({
            url: '/admin/post-leads/' + id + '/update-description',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                description: description
            },
            success: function (response) {
                msgBox.addClass('success').text(response.message);
            },
            error: function (xhr) {
                let errorMsg = 'Update failed.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                msgBox.addClass('error').text(errorMsg);
            },
            complete: function () {
                btn.prop('disabled', false).text('Update Description');
            }
        });
    });
</script>
@endsection