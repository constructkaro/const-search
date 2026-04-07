@extends('vendor.layouts.vapp')

@section('title', 'Vendor Categories')
@section('page_title', 'Categories')

@section('content')

<style>
    .category-page-card {
        background: #fff;
        border-radius: 24px;
        padding: 34px;
        box-shadow: 0 8px 28px rgba(0,0,0,0.05);
    }

    .category-page-head h2 {
        font-size: 28px;
        color: #111633;
        margin-bottom: 8px;
    }

    .category-page-head p {
        color: #667085;
        margin-bottom: 28px;
    }

    .category-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .category-item {
        border: 1px solid #d8dde6;
        border-radius: 18px;
        min-height: 78px;
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 0 22px;
        background: #fff;
        transition: 0.25s ease;
    }

    .category-item:hover {
        border-color: #f5a623;
        box-shadow: 0 8px 20px rgba(245,166,35,0.10);
        transform: translateY(-2px);
    }

    .category-item i {
        font-size: 24px;
        color: #98a2b3;
        width: 28px;
        text-align: center;
    }

    .category-item span {
        font-size: 16px;
        font-weight: 600;
        color: #24324a;
    }

    .category-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 34px;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        height: 54px;
        padding: 0 22px;
        border: 1px solid #d8dde6;
        border-radius: 14px;
        background: #fff;
        color: #111633;
        font-weight: 700;
    }

    .btn-continue {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        height: 54px;
        padding: 0 28px;
        border-radius: 14px;
        background: #f5a623;
        color: #111633;
        font-weight: 700;
        border: none;
    }

    @media (max-width: 768px) {
        .category-grid {
            grid-template-columns: 1fr;
        }

        .category-actions {
            flex-direction: column;
            gap: 14px;
        }
    }
</style>

<div class="category-page-card">
    <div class="category-page-head">
        <h2>Select Vendor Category</h2>
        <p>Choose one or more categories that match your services</p>
    </div>

    <div class="category-grid">
        @foreach($categories as $category)
            <a href="{{ route('vendor.category.form', $category['slug']) }}" class="category-item">
                <i class="{{ $category['icon'] }}"></i>
                <span>{{ $category['name'] }}</span>
            </a>
        @endforeach
    </div>

    <div class="category-actions">
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>

        <a href="{{ route('dashboard') }}" class="btn-continue">
            Continue <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</div>

@endsection