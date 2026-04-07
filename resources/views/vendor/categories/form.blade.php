@extends('vendor.layouts.vapp')

@section('title', 'Category Form')
@section('page_title', 'Category Form')

@section('content')

<style>
    .form-card {
        background: #fff;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 8px 28px rgba(0,0,0,0.05);
    }

    .form-card h2 {
        font-size: 28px;
        color: #111633;
        margin-bottom: 8px;
    }

    .form-card p {
        color: #667085;
        margin-bottom: 24px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 8px;
        color: #111633;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        border: 1px solid #d8dde6;
        border-radius: 14px;
        padding: 14px 16px;
        font-size: 15px;
        outline: none;
    }

    .form-group textarea {
        min-height: 120px;
        resize: vertical;
    }

    .full-width {
        grid-column: 1 / -1;
    }

    .submit-btn {
        margin-top: 18px;
        height: 52px;
        padding: 0 24px;
        border: none;
        border-radius: 14px;
        background: #f5a623;
        color: #111633;
        font-weight: 700;
        cursor: pointer;
    }

    .alert-success {
        background: #ecfdf3;
        color: #027a48;
        padding: 12px 16px;
        border-radius: 10px;
        margin-bottom: 18px;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="form-card">
    <h2>{{ ucwords(str_replace('-', ' ', $slug)) }} Form</h2>
    <p>Fill the details for this category.</p>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('vendor.category.save', $slug) }}" method="POST">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label>Service Name</label>
                <input type="text" name="service_name" placeholder="Enter service name">
            </div>

            <div class="form-group">
                <label>Experience (Years)</label>
                <input type="text" name="experience" placeholder="Enter years of experience">
            </div>

            <div class="form-group">
                <label>City</label>
                <input type="text" name="city" placeholder="Enter city">
            </div>

            <div class="form-group">
                <label>Contact Number</label>
                <input type="text" name="contact_number" placeholder="Enter contact number">
            </div>

            <div class="form-group full-width">
                <label>Description</label>
                <textarea name="description" placeholder="Write your service details"></textarea>
            </div>
        </div>

        <button type="submit" class="submit-btn">Submit</button>
    </form>
</div>

@endsection