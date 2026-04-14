@extends('layouts.admin')

@section('title', 'Edit Tracking Step')
@section('page_title', 'Edit Tracking Step')

@section('content')
<div class="page-card">
    <h5 class="mb-4">Edit Tracking Step</h5>

    <form action="{{ route('admin.tracking_templates.update', $template->id) }}" method="POST">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Service Key</label>
                <input type="text" name="service_key" class="form-control" value="{{ old('service_key', $template->service_key) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Tab Type</label>
                <select name="tab_type" class="form-control" required>
                    <option value="order" {{ $template->tab_type == 'order' ? 'selected' : '' }}>Order</option>
                    <option value="execution" {{ $template->tab_type == 'execution' ? 'selected' : '' }}>Execution</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Step Title</label>
                <input type="text" name="step_title" class="form-control" value="{{ old('step_title', $template->step_title) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Step Order</label>
                <input type="number" name="step_order" class="form-control" min="1" value="{{ old('step_order', $template->step_order) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Step Type</label>
                <select name="step_type" class="form-control">
                    <option value="">Normal</option>
                    <option value="normal" {{ $template->step_type == 'normal' ? 'selected' : '' }}>Normal</option>
                    <option value="choice" {{ $template->step_type == 'choice' ? 'selected' : '' }}>Choice</option>
                    <option value="download" {{ $template->step_type == 'download' ? 'selected' : '' }}>Download</option>
                    <option value="payment" {{ $template->step_type == 'payment' ? 'selected' : '' }}>Payment</option>
                    <option value="textarea" {{ $template->step_type == 'textarea' ? 'selected' : '' }}>Textarea</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Default Status</label>
                <select name="status_default" class="form-control" required>
                    <option value="completed" {{ $template->status_default == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="pending" {{ $template->status_default == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="locked" {{ $template->status_default == 'locked' ? 'selected' : '' }}>Locked</option>
                </select>
            </div>

            <div class="col-md-12">
                <label class="form-label">Step Description</label>
                <textarea name="step_description" class="form-control" rows="4">{{ old('step_description', $template->step_description) }}</textarea>
            </div>

            <div class="col-md-12">
                <label class="form-label">Button Text</label>
                <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $template->button_text) }}">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Update Step</button>
                <a href="{{ route('admin.tracking_templates.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </form>
</div>
@endsection