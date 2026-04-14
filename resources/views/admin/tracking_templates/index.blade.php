@extends('layouts.admin')

@section('title', 'Tracking Templates')
@section('page_title', 'Tracking Templates')

@section('content')
<style>
    .template-card {
        background: #fff;
        border-radius: 18px;
        padding: 22px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    }
    .filter-box {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 16px;
        margin-bottom: 18px;
    }
    .table thead th {
        font-size: 13px;
        font-weight: 700;
        vertical-align: middle;
        white-space: nowrap;
    }
    .table tbody td {
        vertical-align: middle;
        font-size: 14px;
    }
    .inline-input,
    .inline-select,
    .inline-textarea {
        width: 100%;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 8px 10px;
        font-size: 13px;
        background: #fff;
    }
    .inline-textarea {
        min-height: 70px;
        resize: vertical;
    }
    .add-row {
        background: #fff7ed;
    }
</style>

<div class="template-card">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <div>
            <h5 class="mb-1">Tracking Template Management</h5>
            <small class="text-muted">Manage service-wise tracking steps from one table.</small>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="filter-box">
        <form method="GET" action="{{ route('admin.tracking_templates.index') }}" class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Service</label>
                <select name="service_key" class="form-control">
                    <option value="">All Services</option>
                    @foreach($serviceOptions as $key => $label)
                        <option value="{{ $key }}" {{ request('service_key') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Template Code</label>
                <select name="template_code" class="form-control">
                    <option value="">All Templates</option>
                    @foreach($templateCodes as $templateCode)
                        <option value="{{ $templateCode }}" {{ request('template_code') == $templateCode ? 'selected' : '' }}>
                            {{ $templateCode }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Tab Type</label>
                <select name="tab_type" class="form-control">
                    <option value="">All Tabs</option>
                    <option value="order" {{ request('tab_type') == 'order' ? 'selected' : '' }}>Order</option>
                    <option value="execution" {{ request('tab_type') == 'execution' ? 'selected' : '' }}>Execution</option>
                </select>
            </div>

            <div class="col-md-3 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-dark">Filter</button>
                <a href="{{ route('admin.tracking_templates.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Service</th>
                    <th>Template Code</th>
                    <th>Template Name</th>
                    <th>Tab</th>
                    <th>Step Order</th>
                    <th>Step Title</th>
                    <th>Description</th>
                    <th>Step Type</th>
                    <th>Default Status</th>
                    <th>Button Text</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="add-row">
                    <form action="{{ route('admin.tracking_templates.store') }}" method="POST">
                        @csrf
                        <td>
                            <select name="service_key" class="inline-select" required>
                                <option value="">Select Service</option>
                                @foreach($serviceOptions as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="template_code" class="inline-input" placeholder="testing_basic" required>
                        </td>
                        <td>
                            <input type="text" name="template_name" class="inline-input" placeholder="Testing Basic Flow" required>
                        </td>
                        <td>
                            <select name="tab_type" class="inline-select" required>
                                <option value="">Select</option>
                                <option value="order">Order</option>
                                <option value="execution">Execution</option>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="step_order" class="inline-input" min="1" required>
                        </td>
                        <td>
                            <input type="text" name="step_title" class="inline-input" placeholder="Requirement Submitted" required>
                        </td>
                        <td>
                            <textarea name="step_description" class="inline-textarea" placeholder="Enter step description"></textarea>
                        </td>
                        <td>
                            <select name="step_type" class="inline-select">
                                <option value="normal">Normal</option>
                                <option value="choice">Choice</option>
                                <option value="download">Download</option>
                                <option value="payment">Payment</option>
                                <option value="textarea">Textarea</option>
                            </select>
                        </td>
                        <td>
                            <select name="status_default" class="inline-select" required>
                                <option value="completed">Completed</option>
                                <option value="pending">Pending</option>
                                <option value="locked">Locked</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" name="button_text" class="inline-input" placeholder="Download / Payment">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary btn-sm">Add Step</button>
                        </td>
                    </form>
                </tr>

                @forelse($templates as $template)
                    <tr>
                        <form action="{{ route('admin.tracking_templates.update', $template->id) }}" method="POST">
                            @csrf
                            <td>
                                <select name="service_key" class="inline-select" required>
                                    @foreach($serviceOptions as $key => $label)
                                        <option value="{{ $key }}" {{ $template->service_key == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" name="template_code" value="{{ $template->template_code }}" class="inline-input" required>
                            </td>
                            <td>
                                <input type="text" name="template_name" value="{{ $template->template_name }}" class="inline-input" required>
                            </td>
                            <td>
                                <select name="tab_type" class="inline-select" required>
                                    <option value="order" {{ $template->tab_type == 'order' ? 'selected' : '' }}>Order</option>
                                    <option value="execution" {{ $template->tab_type == 'execution' ? 'selected' : '' }}>Execution</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" name="step_order" value="{{ $template->step_order }}" class="inline-input" required>
                            </td>
                            <td>
                                <input type="text" name="step_title" value="{{ $template->step_title }}" class="inline-input" required>
                            </td>
                            <td>
                                <textarea name="step_description" class="inline-textarea">{{ $template->step_description }}</textarea>
                            </td>
                            <td>
                                <select name="step_type" class="inline-select">
                                    <option value="normal" {{ $template->step_type == 'normal' ? 'selected' : '' }}>Normal</option>
                                    <option value="choice" {{ $template->step_type == 'choice' ? 'selected' : '' }}>Choice</option>
                                    <option value="download" {{ $template->step_type == 'download' ? 'selected' : '' }}>Download</option>
                                    <option value="payment" {{ $template->step_type == 'payment' ? 'selected' : '' }}>Payment</option>
                                    <option value="textarea" {{ $template->step_type == 'textarea' ? 'selected' : '' }}>Textarea</option>
                                </select>
                            </td>
                            <td>
                                <select name="status_default" class="inline-select" required>
                                    <option value="completed" {{ $template->status_default == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="pending" {{ $template->status_default == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="locked" {{ $template->status_default == 'locked' ? 'selected' : '' }}>Locked</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="button_text" value="{{ $template->button_text }}" class="inline-input">
                            </td>
                            <td class="d-flex gap-2">
                                <button type="submit" class="btn btn-success btn-sm">Update</button>
                        </form>

                        <form action="{{ route('admin.tracking_templates.delete', $template->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this row?')">Delete</button>
                        </form>
                            </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center">No tracking steps found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection