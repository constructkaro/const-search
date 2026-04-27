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

    .table-card {
        background: #fff;
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        border: 1px solid #ebeff5;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 1100px;
    }

    .custom-table thead th {
        background: #1c2c3e;
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        padding: 14px 12px;
        white-space: nowrap;
        border: none;
        text-align: left;
    }

    .custom-table thead th:first-child {
        border-top-left-radius: 12px;
    }

    .custom-table thead th:last-child {
        border-top-right-radius: 12px;
    }

    .custom-table tbody td {
        background: #fff;
        padding: 14px 12px;
        font-size: 14px;
        color: #334155;
        border-bottom: 1px solid #eef2f7;
        vertical-align: middle;
    }

    .custom-table tbody tr:hover td {
        background: #f8fafc;
    }

    .project-title-cell {
        font-weight: 700;
        color: #1c2c3e;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 12px;
        border-radius: 999px;
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

    .btn-view {
        border: none;
        background: linear-gradient(135deg, #ff9a3c, #f25c05);
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        padding: 10px 16px;
        border-radius: 10px;
        transition: 0.25s ease;
        cursor: pointer;
    }

    .btn-view:hover {
        transform: translateY(-1px);
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

    .custom-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.60);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 24px;
        z-index: 99999;
    }

    .custom-modal-overlay.active {
        display: flex;
    }

    .custom-modal {
        width: 100%;
        max-width: 1100px;
        max-height: 92vh;
        overflow: hidden;
        border-radius: 24px;
        background: #fff;
        box-shadow: 0 25px 80px rgba(15, 23, 42, 0.35);
        animation: modalPop .2s ease;
    }

    @keyframes modalPop {
        from {
            opacity: 0;
            transform: translateY(10px) scale(.98);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .modal-header-custom {
        background: linear-gradient(135deg, #1c2c3e, #22384f);
        color: #fff;
        padding: 20px 24px;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
    }

    .modal-header-left h3 {
        margin: 0;
        font-size: 28px;
        font-weight: 800;
        line-height: 1.2;
    }

    .modal-subtext {
        font-size: 13px;
        color: rgba(255,255,255,0.80);
        margin-top: 6px;
    }

    .modal-close-btn {
        width: 42px;
        height: 42px;
        border: none;
        border-radius: 50%;
        background: rgba(255,255,255,0.14);
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        flex-shrink: 0;
    }

    .modal-close-btn:hover {
        background: rgba(255,255,255,0.22);
    }

    .modal-body-custom {
        padding: 22px;
        background: #f8fafc;
        max-height: calc(92vh - 95px);
        overflow-y: auto;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .detail-box {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 14px;
        padding: 14px;
    }

    .detail-label {
        font-size: 12px;
        color: #64748b;
        font-weight: 700;
        margin-bottom: 6px;
        text-transform: uppercase;
        letter-spacing: .3px;
    }

    .detail-value {
        font-size: 14px;
        color: #1e293b;
        font-weight: 600;
        line-height: 1.6;
        word-break: break-word;
    }

    .full-width {
        grid-column: 1 / -1;
    }

    .message-box {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 14px;
        padding: 16px;
    }

    .message-title {
        font-size: 16px;
        font-weight: 800;
        color: #1c2c3e;
        margin-bottom: 8px;
    }

    .message-text {
        font-size: 14px;
        color: #475569;
        line-height: 1.8;
        margin: 0;
        white-space: pre-line;
        word-break: break-word;
    }

    .file-btn {
        display: inline-block;
        background: #eff6ff;
        color: #1d4ed8;
        padding: 10px 14px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
    }

    .file-btn:hover {
        background: #dbeafe;
        color: #1e40af;
    }

    .response-actions {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .interest-btn {
        border: none;
        background: linear-gradient(135deg, #16a34a, #15803d);
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        padding: 11px 18px;
        border-radius: 10px;
        cursor: pointer;
        transition: .25s ease;
    }

    .interest-btn:hover {
        transform: translateY(-1px);
    }

    .interest-btn.active {
        background: linear-gradient(135deg, #1c2c3e, #22384f);
    }

    .interest-note {
        font-size: 13px;
        color: #64748b;
        font-weight: 600;
    }

    .boq-upload-wrap {
        margin-top: 10px;
    }

    .upload-label {
        display: block;
        font-size: 14px;
        font-weight: 700;
        color: #1c2c3e;
        margin-bottom: 8px;
    }

    .upload-input {
        width: 100%;
        min-height: 52px;
        border: 1px solid #dbe3ef;
        border-radius: 12px;
        padding: 12px 14px;
        background: #fff;
        font-size: 14px;
    }

    .upload-hint {
        display: block;
        margin-top: 7px;
        font-size: 12px;
        color: #64748b;
    }

    .submit-wrap {
        margin-top: 18px;
    }

    .submit-response-btn {
        border: none;
        background: linear-gradient(135deg, #ff9a3c, #f25c05);
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        padding: 12px 20px;
        border-radius: 10px;
        cursor: pointer;
        transition: .25s ease;
    }

    .submit-response-btn:hover {
        transform: translateY(-1px);
    }

    @media(max-width: 768px) {
        .notification-page {
            padding: 16px;
        }

        .detail-grid {
            grid-template-columns: 1fr;
        }

        .modal-header-left h3 {
            font-size: 22px;
        }

        .custom-modal-overlay {
            padding: 12px;
        }
    }
</style>

<div class="notification-page">
    <div class="notification-header">
        <h2>Notifications</h2>
        <p>Assigned projects and project notifications for your dashboard.</p>
    </div>

    @if(isset($notifications) && count($notifications) > 0)
        <div class="table-card">
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Customer Name</th>
                           
                            <th>Service Type</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Assigned At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notifications as $key => $item)
                            @php
                                $notificationData = [
                                    'id' => $item->id ?? '',
                                    'post_id' => $item->post_id ?? '',
                                    'title' => $item->title ?? '',
                                    'contact_name' => $item->contact_name ?? '',
                                   
                                    'service_type' => $item->service_type ?? '',
                                    'city' => $item->city_id ?? '',
                                    'pincode' => $item->pincode ?? '',
                                    'area' => $item->area ?? '',
                                    'budget_id' => $item->budget_id ?? '',
                                    'work_type_id' => $item->work_type_id ?? '',
                                    'work_subtype_id' => $item->work_subtype_id ?? '',
                                    'unit_id' => $item->unit_id ?? '',
                                    'description' => $item->description ?? '',
                                    'message' => $item->message ?? '',
                                    'status' => $item->status ?? '',
                                    'file' => !empty($item->files) ? asset('storage/' . $item->files) : '',
                                    'created_at' => !empty($item->created_at)
                                        ? \Carbon\Carbon::parse($item->created_at)->format('d M Y, h:i A')
                                        : '-',
                                    'is_interested' => $item->is_interested ?? 0,
                                    'boq_file' => !empty($item->boq_file) ? asset('storage/' . $item->boq_file) : ''
                                ];
                            @endphp

                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td class="project-title-cell">{{ $item->title ?? '-' }}</td>
                                <td>{{ $item->contact_name ?? '-' }}</td>
                                
                                <td>{{ $item->service_type ?? '-' }}</td>
                                <td>{{ $item->city_id ?? '-' }}</td>
                                <td>
                                    @if(($item->status ?? '') == 'unread')
                                        <span class="status-badge status-unread">Unread</span>
                                    @else
                                        <span class="status-badge status-read">Read</span>
                                    @endif
                                </td>
                                <td>{{ !empty($item->created_at) ? \Carbon\Carbon::parse($item->created_at)->format('d M Y, h:i A') : '-' }}</td>
                                <td>
                                    <button type="button"
                                            class="btn-view viewNotificationBtn"
                                            data-notification='@json($notificationData)'>
                                        View Details
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="empty-box">
            No notifications found.
        </div>
    @endif
</div>

<div class="custom-modal-overlay" id="notificationModalOverlay">
    <div class="custom-modal">
        <div class="modal-header-custom">
            <div class="modal-header-left">
                <h3 id="modalProjectTitle">Project Details</h3>
                <div class="modal-subtext" id="modalAssignedAt">Assigned At: -</div>
            </div>
            <button type="button" class="modal-close-btn" id="closeNotificationModal">&times;</button>
        </div>

        <div class="modal-body-custom">
            <div class="detail-grid">
                <div class="detail-box">
                    <div class="detail-label">Customer Name</div>
                    <div class="detail-value" id="modalContactName">-</div>
                </div>

               

                <div class="detail-box">
                    <div class="detail-label">Service Type</div>
                    <div class="detail-value" id="modalServiceType">-</div>
                </div>

                <div class="detail-box">
                    <div class="detail-label">City</div>
                    <div class="detail-value" id="modalCity">-</div>
                </div>

                <div class="detail-box">
                    <div class="detail-label">Pincode</div>
                    <div class="detail-value" id="modalPincode">-</div>
                </div>

                <div class="detail-box">
                    <div class="detail-label">Area</div>
                    <div class="detail-value" id="modalArea">-</div>
                </div>

                <div class="detail-box">
                    <div class="detail-label">Status</div>
                    <div class="detail-value" id="modalStatus">-</div>
                </div>

                <div class="detail-box">
                    <div class="detail-label">Budget ID</div>
                    <div class="detail-value" id="modalBudgetId">-</div>
                </div>

                <div class="detail-box">
                    <div class="detail-label">Work Type ID</div>
                    <div class="detail-value" id="modalWorkTypeId">-</div>
                </div>

                <div class="detail-box">
                    <div class="detail-label">Work Subtype ID</div>
                    <div class="detail-value" id="modalWorkSubtypeId">-</div>
                </div>

                <div class="detail-box">
                    <div class="detail-label">Unit ID</div>
                    <div class="detail-value" id="modalUnitId">-</div>
                </div>

                <div class="detail-box full-width">
                    <div class="message-box">
                        <div class="message-title">Notification Message</div>
                        <p class="message-text" id="modalMessage">-</p>
                    </div>
                </div>

                <div class="detail-box full-width">
                    <div class="message-box">
                        <div class="message-title">Project Description</div>
                        <p class="message-text" id="modalDescription">-</p>
                    </div>
                </div>

                <div class="detail-box full-width" id="modalFileBox" style="display:none;">
                    <div class="message-box">
                        <div class="message-title">Project File</div>
                        <a href="#" target="_blank" id="modalFileLink" class="file-btn">View File</a>
                    </div>
                </div>

                <div class="detail-box full-width">
                    <div class="message-box">
                        <div class="message-title">Vendor Response</div>

                        <form id="interestBoqForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="notification_id" id="modalNotificationId">
                            <input type="hidden" name="post_id" id="modalPostId">

                            <div class="response-actions">
                                <button type="button" class="interest-btn" id="interestedBtn">
                                    I’m Interested
                                </button>

                                <span class="interest-note" id="interestStatusText">
                                    Click to mark your interest in this project.
                                </span>
                            </div>

                            <div class="boq-upload-wrap">
                                <label class="upload-label">Upload BOQ File</label>
                                <input type="file" name="boq_file" id="boq_file" class="upload-input">
                                <small class="upload-hint">Allowed: PDF, XLS, XLSX, JPG, PNG</small>
                                <div id="existingBoqWrapper"></div>
                            </div>

                            <div class="submit-wrap">
                                <button type="submit" class="submit-response-btn">
                                    Submit Response
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalOverlay = document.getElementById('notificationModalOverlay');
    const closeBtn = document.getElementById('closeNotificationModal');
    const viewButtons = document.querySelectorAll('.viewNotificationBtn');
    const interestedBtn = document.getElementById('interestedBtn');
    const interestStatusText = document.getElementById('interestStatusText');
    const interestBoqForm = document.getElementById('interestBoqForm');
    const boqFileInput = document.getElementById('boq_file');
    const existingBoqWrapper = document.getElementById('existingBoqWrapper');

    let isInterested = 0;

    function openModal() {
        modalOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modalOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    viewButtons.forEach(button => {
        button.addEventListener('click', function () {
            const rawData = this.getAttribute('data-notification');
            if (!rawData) return;

            let data = {};
            try {
                data = JSON.parse(rawData);
            } catch (e) {
                console.log('JSON parse error:', e);
                return;
            }

            document.getElementById('modalNotificationId').value = data.id || '';
            document.getElementById('modalPostId').value = data.post_id || '';

            document.getElementById('modalProjectTitle').innerText = data.title || 'Project Details';
            document.getElementById('modalAssignedAt').innerText = 'Assigned At: ' + (data.created_at || '-');
            document.getElementById('modalContactName').innerText = data.contact_name || '-';
         
            document.getElementById('modalServiceType').innerText = data.service_type || '-';
            document.getElementById('modalCity').innerText = data.city || '-';
            document.getElementById('modalPincode').innerText = data.pincode || '-';
            document.getElementById('modalArea').innerText = data.area || '-';
            document.getElementById('modalStatus').innerText = data.status || '-';
            document.getElementById('modalBudgetId').innerText = data.budget_id || '-';
            document.getElementById('modalWorkTypeId').innerText = data.work_type_id || '-';
            document.getElementById('modalWorkSubtypeId').innerText = data.work_subtype_id || '-';
            document.getElementById('modalUnitId').innerText = data.unit_id || '-';
            document.getElementById('modalMessage').innerText = data.message || '-';
            document.getElementById('modalDescription').innerText = data.description || '-';

            if (data.file) {
                document.getElementById('modalFileBox').style.display = 'block';
                document.getElementById('modalFileLink').href = data.file;
            } else {
                document.getElementById('modalFileBox').style.display = 'none';
                document.getElementById('modalFileLink').href = '#';
            }

            // reset existing boq display every time
            existingBoqWrapper.innerHTML = '';
            boqFileInput.value = '';
            boqFileInput.style.display = 'block';

            // interest status
            if (parseInt(data.is_interested) === 1) {
                isInterested = 1;
                interestedBtn.classList.add('active');
                interestedBtn.innerText = 'Interested';
                interestStatusText.innerText = 'You already marked interest.';
            } else {
                isInterested = 0;
                interestedBtn.classList.remove('active');
                interestedBtn.innerText = "I’m Interested";
                interestStatusText.innerText = 'Click to mark your interest in this project.';
            }

            // existing boq file
            if (data.boq_file) {
                existingBoqWrapper.innerHTML = `
                    <div style="margin-top:10px;">
                        <a href="${data.boq_file}" target="_blank" class="file-btn">
                            View Uploaded BOQ
                        </a>
                    </div>
                `;
            }

            openModal();
        });
    });

    interestedBtn.addEventListener('click', function () {
        isInterested = isInterested ? 0 : 1;

        if (isInterested) {
            interestedBtn.classList.add('active');
            interestedBtn.innerText = 'Interested';
            interestStatusText.innerText = 'You marked yourself as interested for this project.';
        } else {
            interestedBtn.classList.remove('active');
            interestedBtn.innerText = "I’m Interested";
            interestStatusText.innerText = 'Click to mark your interest in this project.';
        }
    });

    interestBoqForm.addEventListener('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append('is_interested', isInterested);

        fetch("{{ route('vendor.notification.response') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: formData
        })
        .then(response => response.json())
        .then(res => {
            if (res.status) {
                alert(res.message || 'Response submitted successfully.');
                closeModal();
                location.reload();
            } else {
                alert(res.message || 'Something went wrong.');
            }
        })
        .catch(error => {
            console.log(error);
            alert('Something went wrong.');
        });
    });

    closeBtn.addEventListener('click', closeModal);

    modalOverlay.addEventListener('click', function (e) {
        if (e.target === modalOverlay) {
            closeModal();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modalOverlay.classList.contains('active')) {
            closeModal();
        }
    });
});
</script>

@endsection