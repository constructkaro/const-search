@extends('layouts.admin')

@section('title', 'Add Tracking Step')
@section('page_title', 'Add Tracking Step')

@section('content')
<div class="page-card">
    <h5 class="mb-4">Add New Tracking Step</h5>

    <form action="{{ route('admin.tracking_templates.store') }}" method="POST">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Service Key</label>
                <input type="text" name="service_key" class="form-control" placeholder="contractor / interior / survey" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Tab Type</label>
                <select name="tab_type" class="form-control" required>
                    <option value="">Select Tab</option>
                    <option value="order">Order</option>
                    <option value="execution">Execution</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Step Title</label>
                <input type="text" name="step_title" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Step Order</label>
                <input type="number" name="step_order" class="form-control" min="1" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Step Type</label>
                <select name="step_type" class="form-control">
                    <option value="">Normal</option>
                    <option value="normal">Normal</option>
                    <option value="choice">Choice</option>
                    <option value="download">Download</option>
                    <option value="payment">Payment</option>
                    <option value="textarea">Textarea</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Default Status</label>
                <select name="status_default" class="form-control" required>
                    <option value="completed">Completed</option>
                    <option value="pending">Pending</option>
                    <option value="locked">Locked</option>
                </select>
            </div>

            <div class="col-md-12">
                <label class="form-label">Step Description</label>
                <textarea name="step_description" class="form-control" rows="4"></textarea>
            </div>

            <div class="col-md-12">
                <label class="form-label">Button Text</label>
                <input type="text" name="button_text" class="form-control" placeholder="Download Agreement / Payment">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save Step</button>
                <a href="{{ route('admin.tracking_templates.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </form>
</div>
@endsection