@extends('layouts.admin')

@section('content')
<style>
    .lead-edit-page {
        background: #f4f7fb;
        min-height: 100vh;
        padding: 24px;
    }

    .lead-edit-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        margin-bottom: 22px;
    }

    .lead-edit-header h2 {
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

    .edit-card {
        background: #fff;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        border: 1px solid #ebeff5;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: #1c2c3e;
        margin-bottom: 16px;
        padding-bottom: 10px;
        border-bottom: 1px solid #edf1f5;
    }

    .form-label {
        font-weight: 600;
        color: #344054;
        margin-bottom: 8px;
    }

    .form-control,
    .form-select,
    textarea {
        border-radius: 12px !important;
        border: 1px solid #dbe3ec !important;
        padding: 12px 14px !important;
        box-shadow: none !important;
        font-size: 14px;
    }

    .form-control:focus,
    .form-select:focus,
    textarea:focus {
        border-color: #f25c05 !important;
        box-shadow: 0 0 0 0.15rem rgba(242, 92, 5, 0.15) !important;
    }

    .btn-update {
        background: #f25c05;
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 12px 26px;
        font-weight: 600;
    }

    .btn-update:hover {
        background: #d94f03;
        color: #fff;
    }

    .current-file {
        background: #f8fafc;
        border: 1px solid #e8edf4;
        border-radius: 12px;
        padding: 12px 14px;
        margin-top: 6px;
    }

    .current-file a {
        color: #1d4ed8;
        font-weight: 600;
        text-decoration: none;
    }

    .current-file a:hover {
        color: #1e40af;
    }
</style>

<div class="lead-edit-page">
    <div class="lead-edit-header">
        <h2>Edit Lead</h2>
        <a href="{{ route('admin.allprojects') }}" class="back-btn">Back</a>
    </div>

    <div class="edit-card">
        <form action="{{ route('admin.post-leads.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="section-title">Project Information</div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}">
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Work Type ID</label>
                    <input type="number" name="work_type_id" class="form-control" value="{{ old('work_type_id', $post->work_type_id) }}">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Work Subtype ID</label>
                    <input type="number" name="work_subtype_id" class="form-control" value="{{ old('work_subtype_id', $post->work_subtype_id) }}">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Budget ID</label>
                    <input type="number" name="budget_id" class="form-control" value="{{ old('budget_id', $post->budget_id) }}">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Area</label>
                    <input type="text" name="area" class="form-control" value="{{ old('area', $post->area) }}">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Unit ID</label>
                    <input type="number" name="unit_id" class="form-control" value="{{ old('unit_id', $post->unit_id) }}">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Contact Time</label>
                    <input type="text" name="contact_time" class="form-control" value="{{ old('contact_time', $post->contact_time) }}">
                </div>
            </div>

            <div class="section-title mt-4">Location Information</div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">State</label>
                    <input type="text" name="state" class="form-control" value="{{ old('state', $post->state) }}">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Region</label>
                    <input type="text" name="region" class="form-control" value="{{ old('region', $post->region) }}">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">City</label>
                    <input type="text" name="city" class="form-control" value="{{ old('city', $post->city) }}">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Pincode</label>
                    <input type="text" name="pincode" class="form-control" value="{{ old('pincode', $post->pincode) }}">
                </div>
            </div>

            <div class="section-title mt-4">Contact Information</div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Contact Name <span class="text-danger">*</span></label>
                    <input type="text" name="contact_name" class="form-control" value="{{ old('contact_name', $post->contact_name) }}">
                    @error('contact_name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Mobile <span class="text-danger">*</span></label>
                    <input type="text" name="mobile" class="form-control" value="{{ old('mobile', $post->mobile) }}">
                    @error('mobile') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $post->email) }}">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="section-title mt-4">Requirement Details</div>

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="5" class="form-control">{{ old('description', $post->description) }}</textarea>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Upload New File</label>
                    <input type="file" name="files" class="form-control">

                    @if(!empty($post->files))
                        <div class="current-file">
                            Current File:
                            <a href="{{ asset('storage/' . $post->files) }}" target="_blank">View File</a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-update">Update Lead</button>
            </div>
        </form>
    </div>
</div>
@endsection