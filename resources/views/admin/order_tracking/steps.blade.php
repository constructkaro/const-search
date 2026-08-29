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
        grid-template-columns: 1fr;
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

    .sub-points-box {
        border: 1px dashed #cbd5e1;
        border-radius: 14px;
        background: #f8fafc;
        padding: 12px;
        display: grid;
        gap: 10px;
        overflow-x: auto;
    }

    .sub-point-header,
    .sub-point-row {
        min-width: 720px;
        display: grid;
        grid-template-columns: 82px minmax(160px, 1.2fr) minmax(180px, 1.5fr) 128px 110px 40px;
        gap: 8px;
        align-items: center;
    }

    .sub-point-header {
        color: #334155;
        font-size: 12px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .35px;
        padding: 0 4px;
    }

    .sub-point-row {
        border: 1px solid #e8edf4;
        border-radius: 12px;
        background: #fff;
        padding: 8px;
    }

    .sub-point-row .form-label {
        display: none;
    }

    .sub-point-number {
        min-height: 36px;
        border-radius: 10px;
        background: #1c2c3e;
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        font-size: 13px;
        width: 100%;
    }

    .sub-point-remove {
        width: 38px;
        height: 38px;
        border: none;
        border-radius: 10px;
        background: #fee2e2;
        color: #b91c1c;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .sub-point-add {
        border: 1px solid #fed7aa;
        background: #fff7ed;
        color: #c2410c;
        border-radius: 10px;
        padding: 9px 12px;
        font-size: 12px;
        font-weight: 900;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        justify-content: center;
        width: fit-content;
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
    $nextOrder = max(($steps->max('step_order') ?? 3) + 1, 4);
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
            <div class="col-md-2">
                <label class="form-label">Progress %</label>
                <input type="number" name="progress_percent" class="form-control" min="0" max="100" placeholder="0-100">
            </div>
            <div class="col-md-3">
                <label class="form-label">Button Text</label>
                <input type="text" name="button_text" class="form-control" placeholder="Optional">
            </div>
            <div class="col-md-5">
                <label class="form-label">Current Update</label>
                <input type="text" name="input_value" class="form-control" placeholder="Optional update or remark">
            </div>
            <div class="col-12">
                <label class="form-label">Sub Points</label>
                <div class="sub-points-box js-sub-points" data-step-input="input[name='step_order']">
                    <div class="sub-point-header">
                        <span>No.</span>
                        <span>Title</span>
                        <span>Details</span>
                        <span>Status</span>
                        <span>Progress %</span>
                        <span></span>
                    </div>
                    <div class="sub-point-row js-sub-point-row">
                        <div>
                            <label class="form-label">No.</label>
                            <span class="sub-point-number js-sub-point-number">1.1</span>
                        </div>
                        <div>
                            <label class="form-label">Title</label>
                            <input type="text" name="sub_points[0][title]" class="form-control" placeholder="Section A">
                        </div>
                        <div>
                            <label class="form-label">Details</label>
                            <input type="text" name="sub_points[0][description]" class="form-control" placeholder="Optional details">
                        </div>
                        <div>
                            <label class="form-label">Status</label>
                            <select name="sub_points[0][status]" class="form-select">
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                                <option value="locked">Locked</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label">Progress %</label>
                            <input type="number" name="sub_points[0][progress_percent]" class="form-control" min="0" max="100" placeholder="0-100">
                        </div>
                        <button type="button" class="sub-point-remove js-remove-sub-point" title="Remove sub point">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                    <button type="button" class="sub-point-add js-add-sub-point">
                        <i class="bi bi-plus-lg"></i> Add Sub Point
                    </button>
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label">Attachments</label>
                <input type="file" name="attachments[]" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.zip" multiple>
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
                    @php
                        $status = $step->status ?: 'pending';
                        $progressPercent = $step->extra_data['progress_percent'] ?? null;
                        $subPoints = collect($step->extra_data['sub_points'] ?? [])->values();
                    @endphp
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
                                    <label class="form-label">Progress %</label>
                                    <input type="number" name="progress_percent" value="{{ $progressPercent }}" class="form-control" min="0" max="100" placeholder="0-100">
                                </div>
                                <div>
                                    <label class="form-label">Button Text</label>
                                    <input type="text" name="button_text" value="{{ $step->button_text }}" class="form-control">
                                </div>
                                <div>
                                    <label class="form-label">Current Update</label>
                                    <input type="text" name="input_value" value="{{ $step->input_value }}" class="form-control">
                                </div>
                                <div class="span-2">
                                    <label class="form-label">Sub Points</label>
                                    <div class="sub-points-box js-sub-points" data-step-input="input[name='step_order']">
                                        <div class="sub-point-header">
                                            <span>No.</span>
                                            <span>Title</span>
                                            <span>Details</span>
                                            <span>Status</span>
                                            <span>Progress %</span>
                                            <span></span>
                                        </div>
                                        @forelse($subPoints as $subIndex => $subPoint)
                                            <div class="sub-point-row js-sub-point-row">
                                                <div>
                                                    <label class="form-label">No.</label>
                                                    <span class="sub-point-number js-sub-point-number">{{ $step->step_order }}.{{ $subIndex + 1 }}</span>
                                                </div>
                                                <div>
                                                    <label class="form-label">Title</label>
                                                    <input type="text" name="sub_points[{{ $subIndex }}][title]" value="{{ $subPoint['title'] ?? '' }}" class="form-control" placeholder="Section A">
                                                </div>
                                                <div>
                                                    <label class="form-label">Details</label>
                                                    <input type="text" name="sub_points[{{ $subIndex }}][description]" value="{{ $subPoint['description'] ?? '' }}" class="form-control" placeholder="Optional details">
                                                </div>
                                                <div>
                                                    <label class="form-label">Status</label>
                                                    <select name="sub_points[{{ $subIndex }}][status]" class="form-select">
                                                        <option value="pending" {{ ($subPoint['status'] ?? 'pending') === 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="completed" {{ ($subPoint['status'] ?? '') === 'completed' ? 'selected' : '' }}>Completed</option>
                                                        <option value="locked" {{ ($subPoint['status'] ?? '') === 'locked' ? 'selected' : '' }}>Locked</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="form-label">Progress %</label>
                                                    <input type="number" name="sub_points[{{ $subIndex }}][progress_percent]" value="{{ $subPoint['progress_percent'] ?? '' }}" class="form-control" min="0" max="100" placeholder="0-100">
                                                </div>
                                                <button type="button" class="sub-point-remove js-remove-sub-point" title="Remove sub point">
                                                    <i class="bi bi-x-lg"></i>
                                                </button>
                                            </div>
                                        @empty
                                            <div class="sub-point-row js-sub-point-row">
                                                <div>
                                                    <label class="form-label">No.</label>
                                                    <span class="sub-point-number js-sub-point-number">{{ $step->step_order }}.1</span>
                                                </div>
                                                <div>
                                                    <label class="form-label">Title</label>
                                                    <input type="text" name="sub_points[0][title]" class="form-control" placeholder="Section A">
                                                </div>
                                                <div>
                                                    <label class="form-label">Details</label>
                                                    <input type="text" name="sub_points[0][description]" class="form-control" placeholder="Optional details">
                                                </div>
                                                <div>
                                                    <label class="form-label">Status</label>
                                                    <select name="sub_points[0][status]" class="form-select">
                                                        <option value="pending">Pending</option>
                                                        <option value="completed">Completed</option>
                                                        <option value="locked">Locked</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="form-label">Progress %</label>
                                                    <input type="number" name="sub_points[0][progress_percent]" class="form-control" min="0" max="100" placeholder="0-100">
                                                </div>
                                                <button type="button" class="sub-point-remove js-remove-sub-point" title="Remove sub point">
                                                    <i class="bi bi-x-lg"></i>
                                                </button>
                                            </div>
                                        @endforelse
                                        <button type="button" class="sub-point-add js-add-sub-point">
                                            <i class="bi bi-plus-lg"></i> Add Sub Point
                                        </button>
                                    </div>
                                </div>
                                <div class="span-2">
                                    <label class="form-label">Attachments</label>
                                    <input type="file" name="attachments[]" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.zip" multiple>
                                    @php
                                        $attachments = $step->extra_data['attachments'] ?? [];
                                        if (!empty($step->extra_data['download_file'])) {
                                            $attachments[] = [
                                                'path' => $step->extra_data['download_file'],
                                                'name' => $step->extra_data['download_file_name'] ?? basename($step->extra_data['download_file']),
                                            ];
                                        }
                                    @endphp
                                    @if(!empty($attachments))
                                        <small class="text-muted d-block mt-1">
                                            Current files:
                                            @foreach($attachments as $attachment)
                                                <span class="d-block">{{ $attachment['name'] ?? basename($attachment['path'] ?? '') }}</span>
                                            @endforeach
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
        const renumberSubPoints = (box) => {
            const form = box.closest('form');
            const stepInput = form ? form.querySelector(box.dataset.stepInput || "input[name='step_order']") : null;
            const stepNumber = stepInput && stepInput.value ? stepInput.value : '1';
            const rows = box.querySelectorAll('.js-sub-point-row');

            rows.forEach((row, index) => {
                const number = row.querySelector('.js-sub-point-number');
                if (number) {
                    number.textContent = `${stepNumber}.${index + 1}`;
                }

                row.querySelectorAll('input, select').forEach((field) => {
                    field.name = field.name.replace(/sub_points\[\d+\]/, `sub_points[${index}]`);
                });
            });
        };

        const createSubPointRow = (box) => {
            const sourceRow = box.querySelector('.js-sub-point-row');
            const row = sourceRow.cloneNode(true);

            row.querySelectorAll('input').forEach((input) => {
                input.value = '';
            });

            row.querySelectorAll('select').forEach((select) => {
                select.value = 'pending';
            });

            return row;
        };

        document.querySelectorAll('.js-sub-points').forEach((box) => {
            const form = box.closest('form');
            const stepInput = form ? form.querySelector(box.dataset.stepInput || "input[name='step_order']") : null;

            renumberSubPoints(box);

            if (stepInput) {
                stepInput.addEventListener('input', () => renumberSubPoints(box));
            }
        });

        document.addEventListener('click', function (event) {
            const addButton = event.target.closest('.js-add-sub-point');
            if (addButton) {
                const box = addButton.closest('.js-sub-points');
                const row = createSubPointRow(box);
                box.insertBefore(row, addButton);
                renumberSubPoints(box);
                row.querySelector("input[name*='[title]']")?.focus();
                return;
            }

            const removeButton = event.target.closest('.js-remove-sub-point');
            if (removeButton) {
                const box = removeButton.closest('.js-sub-points');
                const rows = box.querySelectorAll('.js-sub-point-row');

                if (rows.length === 1) {
                    rows[0].querySelectorAll('input').forEach((input) => {
                        input.value = '';
                    });
                    rows[0].querySelectorAll('select').forEach((select) => {
                        select.value = 'pending';
                    });
                } else {
                    removeButton.closest('.js-sub-point-row').remove();
                }

                renumberSubPoints(box);
            }
        });
    });
</script>

@endsection
