@extends('layouts.admin')

@section('title', 'Manage Milestones')
@section('page_title', 'Manage Milestones')

@section('content')
<style>
    .milestone-page {
        display: grid;
        gap: 18px;
    }

    .milestone-hero {
        background: linear-gradient(135deg, #1c2c3e 0%, #2f4a66 100%);
        color: #fff;
        border-radius: 22px;
        padding: 24px;
        box-shadow: 0 14px 34px rgba(28, 44, 62, 0.16);
        display: flex;
        justify-content: space-between;
        gap: 18px;
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .milestone-hero h4 {
        margin: 0 0 7px;
        font-size: 28px;
        font-weight: 900;
    }

    .milestone-hero p {
        margin: 0;
        color: #dbe5ef;
        font-size: 14px;
        line-height: 1.7;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.18);
        border-radius: 999px;
        padding: 10px 13px;
        color: #fff;
        font-size: 13px;
        font-weight: 800;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #fff7ed;
        color: #c2410c;
        border-radius: 12px;
        padding: 11px 14px;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
    }

    .back-btn:hover {
        color: #9a3412;
        background: #ffedd5;
    }

    .form-panel,
    .milestone-panel {
        background: #fff;
        border: 1px solid #e8edf4;
        border-radius: 22px;
        padding: 20px;
        box-shadow: 0 8px 24px rgba(15,23,42,0.05);
    }

    .panel-title {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #1c2c3e;
        font-size: 18px;
        font-weight: 900;
        margin-bottom: 16px;
    }

    .panel-title i {
        color: #f25c05;
    }

    .form-label {
        color: #334155;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .35px;
    }

    .save-btn {
        border: none;
        background: #f25c05;
        color: #fff;
        border-radius: 12px;
        padding: 11px 16px;
        font-size: 13px;
        font-weight: 900;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .milestone-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .milestone-card {
        border: 1px solid #e8edf4;
        border-radius: 18px;
        background: #fbfdff;
        padding: 16px;
    }

    .milestone-top {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 12px;
        align-items: center;
    }

    .step-number {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #1c2c3e;
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        flex: 0 0 auto;
    }

    .tab-chip,
    .status-chip {
        display: inline-flex;
        align-items: center;
        border-radius: 999px;
        padding: 7px 10px;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    .tab-chip {
        background: #eef4ff;
        color: #1d4ed8;
    }

    .status-chip.completed {
        background: #dcfce7;
        color: #15803d;
    }

    .status-chip.pending {
        background: #fff7ed;
        color: #c2410c;
    }

    .status-chip.locked {
        background: #f1f5f9;
        color: #64748b;
    }

    .edit-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .span-2 {
        grid-column: 1 / -1;
    }

    .delete-btn {
        border: none;
        background: #fee2e2;
        color: #b91c1c;
        border-radius: 12px;
        padding: 10px 13px;
        font-size: 12px;
        font-weight: 900;
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }

    .card-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: 12px;
    }

    .empty-box {
        border: 1px dashed #cbd5e1;
        border-radius: 18px;
        background: #f8fafc;
        padding: 34px;
        color: #64748b;
        text-align: center;
        font-weight: 800;
    }

    @media (max-width: 991px) {
        .milestone-grid,
        .edit-grid {
            grid-template-columns: 1fr;
        }

        .span-2 {
            grid-column: auto;
        }
    }
</style>

@php
    $nextOrder = ($steps->max('step_order') ?? 0) + 1;
@endphp

<div class="milestone-page">
    <div class="milestone-hero">
        <div>
            <h4>Project Milestones</h4>
            <p>
                Service: <strong>{{ ucfirst($tracking->service_key) }}</strong> |
                Order ID: <strong>#{{ str_pad($tracking->source_id, 3, '0', STR_PAD_LEFT) }}</strong> |
                Flow: <strong>{{ $tracking->template_code }}</strong>
            </p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <span class="hero-badge"><i class="bi bi-list-check"></i>{{ $steps->count() }} Milestones</span>
            <a href="{{ route('admin.order_tracking.index') }}" class="back-btn">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-0">{{ session('success') }}</div>
    @endif

    <div class="form-panel">
        <div class="panel-title"><i class="bi bi-plus-circle-fill"></i> Add New Milestone</div>
        <form action="{{ route('admin.order_tracking.step_store', $tracking->id) }}" method="POST" enctype="multipart/form-data" class="row g-3 align-items-end">
            @csrf
            <div class="col-md-2">
                <label class="form-label">Visible Under</label>
                <select name="tab_type" class="form-select" required>
                    <option value="order">Order Tracking</option>
                    <option value="execution">Execution Progress</option>
                </select>
            </div>
            <div class="col-md-1">
                <label class="form-label">Step</label>
                <input type="number" name="step_order" class="form-control" min="1" value="{{ $nextOrder }}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Title</label>
                <input type="text" name="step_title" class="form-control" placeholder="Site visit scheduled" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Short Details</label>
                <input type="text" name="step_description" class="form-control" placeholder="What customer and vendor should see">
            </div>
            <div class="col-md-1">
                <label class="form-label">Type</label>
                <select name="step_type" class="form-select js-step-type">
                    <option value="normal">Normal</option>
                    <option value="choice">Choice</option>
                    <option value="download">Download</option>
                    <option value="payment">Payment</option>
                    <option value="textarea">Textarea</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="locked">Locked</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Button Text</label>
                <input type="text" name="button_text" class="form-control" placeholder="Optional">
            </div>
            <div class="col-md-6">
                <label class="form-label">Current Update</label>
                <input type="text" name="input_value" class="form-control" placeholder="Optional update or remark">
            </div>
            <div class="col-md-4 js-download-file">
                <label class="form-label">Download File</label>
                <input type="file" name="download_file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.zip">
            </div>
            <div class="col-md-2">
                <button type="submit" class="save-btn w-100 justify-content-center">
                    <i class="bi bi-plus-lg"></i> Add
                </button>
            </div>
        </form>
    </div>

    <div class="milestone-panel">
        <div class="panel-title"><i class="bi bi-kanban-fill"></i> Existing Milestones</div>

        @if($steps->count())
            <div class="milestone-grid">
                @foreach($steps as $step)
                    @php $status = $step->status ?: 'pending'; @endphp
                    <div class="milestone-card">
                        <div class="milestone-top">
                            <div class="d-flex align-items-center gap-2">
                                <span class="step-number">{{ $step->step_order }}</span>
                                <span class="tab-chip">{{ ucfirst($step->tab_type) }}</span>
                            </div>
                            <span class="status-chip {{ $status }}">{{ ucfirst($status) }}</span>
                        </div>

                        <form id="stepEditForm{{ $step->id }}" action="{{ route('admin.order_tracking.step_update', $step->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="edit-grid">
                                <div>
                                    <label class="form-label">Visible Under</label>
                                    <select name="tab_type" class="form-select">
                                        <option value="order" {{ $step->tab_type == 'order' ? 'selected' : '' }}>Order Tracking</option>
                                        <option value="execution" {{ $step->tab_type == 'execution' ? 'selected' : '' }}>Execution Progress</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Step</label>
                                    <input type="number" name="step_order" value="{{ $step->step_order }}" class="form-control" min="1">
                                </div>
                                <div class="span-2">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="step_title" value="{{ $step->step_title }}" class="form-control">
                                </div>
                                <div class="span-2">
                                    <label class="form-label">Description</label>
                                    <textarea name="step_description" class="form-control" rows="2">{{ $step->step_description }}</textarea>
                                </div>
                                <div>
                                    <label class="form-label">Type</label>
                                    <select name="step_type" class="form-select js-step-type">
                                        <option value="normal" {{ $step->step_type == 'normal' ? 'selected' : '' }}>Normal</option>
                                        <option value="choice" {{ $step->step_type == 'choice' ? 'selected' : '' }}>Choice</option>
                                        <option value="download" {{ $step->step_type == 'download' ? 'selected' : '' }}>Download</option>
                                        <option value="payment" {{ $step->step_type == 'payment' ? 'selected' : '' }}>Payment</option>
                                        <option value="textarea" {{ $step->step_type == 'textarea' ? 'selected' : '' }}>Textarea</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="completed" {{ $step->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="pending" {{ $step->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="locked" {{ $step->status == 'locked' ? 'selected' : '' }}>Locked</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Button Text</label>
                                    <input type="text" name="button_text" value="{{ $step->button_text }}" class="form-control">
                                </div>
                                <div>
                                    <label class="form-label">Current Update</label>
                                    <input type="text" name="input_value" value="{{ $step->input_value }}" class="form-control">
                                </div>
                                <div class="span-2 js-download-file">
                                    <label class="form-label">Download File</label>
                                    <input type="file" name="download_file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.zip">
                                    @if(!empty($step->extra_data['download_file']))
                                        <small class="text-muted d-block mt-1">
                                            Current file: {{ $step->extra_data['download_file_name'] ?? basename($step->extra_data['download_file']) }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </form>

                        <div class="card-actions">
                            <button type="submit" form="stepEditForm{{ $step->id }}" class="save-btn">
                                <i class="bi bi-check2"></i> Update Milestone
                            </button>
                            <form action="{{ route('admin.order_tracking.step_delete', $step->id) }}" method="POST" onsubmit="return confirm('Delete this milestone?')">
                                @csrf
                                <button type="submit" class="delete-btn">
                                    <i class="bi bi-trash3"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-box">No milestones added yet. Add the first milestone above.</div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('form').forEach(function (form) {
            const typeSelect = form.querySelector('.js-step-type');
            const fileField = form.querySelector('.js-download-file');

            if (!typeSelect || !fileField) {
                return;
            }

            const toggleFileField = function () {
                fileField.style.display = typeSelect.value === 'download' ? '' : 'none';
            };

            typeSelect.addEventListener('change', toggleFileField);
            toggleFileField();
        });
    });
</script>
@endsection
