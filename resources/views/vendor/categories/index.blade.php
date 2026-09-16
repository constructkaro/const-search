@extends('vendor.layouts.vapp')

@section('title', 'Vendor Categories')
@section('page_title', 'Categories')

@section('content')

<style>
    .category-page-card {
        background: #fff;
        border: 1px solid #e7edf5;
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.05);
    }

    .category-page-head h2 {
        font-size: 28px;
        line-height: 1.2;
        color: var(--vendor-text, #071832);
        margin-bottom: 8px;
    }

    .category-page-head p {
        color: #667085;
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 0;
        max-width: 720px;
    }

    .category-progress {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #667085;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 18px;
    }

    .category-progress span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: var(--vendor-orange, #f47b20);
        color: var(--vendor-navy, #071832);
        font-weight: 800;
    }

    .category-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-top: 30px;
    }

    .category-item {
        border: 1px solid #d8dde6;
        border-radius: 14px;
        min-height: 86px;
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 18px;
        background: #fff;
        color: inherit;
        cursor: pointer;
        position: relative;
        text-align: left;
        width: 100%;
        transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease, background 0.2s ease;
    }

    .category-item:hover,
    .category-item:focus-visible {
        border-color: var(--vendor-orange, #f47b20);
        box-shadow: 0 8px 20px rgba(244,123,32,0.12);
        transform: translateY(-2px);
        outline: none;
    }

    .category-item > i {
        font-size: 24px;
        color: #7c8798;
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: #f5f7fb;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        flex: 0 0 48px;
    }

    .category-copy {
        display: flex;
        flex-direction: column;
        gap: 5px;
        min-width: 0;
    }

    .category-copy strong {
        font-size: 16px;
        font-weight: 800;
        color: var(--vendor-text, #071832);
    }

    .category-copy span {
        color: #667085;
        font-size: 13px;
        line-height: 1.4;
    }

    .category-check {
        margin-left: auto;
        width: 26px;
        height: 26px;
        border: 1px solid #d8dde6;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: transparent;
        flex: 0 0 26px;
        transition: 0.2s ease;
    }

    .category-item.is-selected {
        border-color: var(--vendor-orange, #f47b20);
        background: #fff6ef;
        box-shadow: 0 10px 24px rgba(244,123,32,0.15);
    }

    .category-item.is-selected i {
        background: var(--vendor-orange, #f47b20);
        color: var(--vendor-navy, #071832);
    }

    .category-check i,
    .category-item.is-selected .category-check i {
        font-size: 12px;
        width: auto;
        height: auto;
        background: transparent;
        color: inherit;
    }

    .category-item.is-selected .category-check {
        background: var(--vendor-blue, #075c9f);
        border-color: var(--vendor-blue, #075c9f);
        color: #fff;
    }

    .category-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        margin-top: 34px;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        height: 54px;
        padding: 0 22px;
        border: 1px solid #d8dde6;
        border-radius: 12px;
        background: #fff;
        color: var(--vendor-text, #071832);
        font-weight: 700;
        transition: 0.2s ease;
    }

    .btn-back:hover {
        border-color: var(--vendor-blue, #075c9f);
    }

    .btn-continue {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        height: 54px;
        padding: 0 28px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--vendor-orange, #f47b20) 0%, #ffa726 100%);
        color: var(--vendor-navy, #071832);
        font-weight: 700;
        border: none;
        min-width: 188px;
        justify-content: center;
        transition: 0.2s ease;
    }

    .btn-continue.is-disabled {
        background: #e4e7ec;
        color: #98a2b3;
        pointer-events: none;
        cursor: not-allowed;
    }

    .category-help {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #667085;
        font-size: 14px;
        margin-top: 18px;
    }

    .category-help i {
        color: var(--vendor-orange, #f47b20);
    }

    @media (max-width: 768px) {
        .category-page-card {
            padding: 20px;
            border-radius: 14px;
        }

        .category-page-head h2 {
            font-size: 24px;
        }

        .category-grid {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .category-actions {
            flex-direction: column;
            gap: 14px;
        }

        .btn-back,
        .btn-continue {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="category-page-card">
    <div class="category-page-head">
        <div class="category-progress">
            <span>1</span>
            <small>Vendor profile setup</small>
        </div>
        <h2>Select Vendor Category</h2>
        <p>Choose the service category that best matches your business. After continuing, you can complete the details required for that category.</p>
    </div>

    <div class="category-grid">
        @foreach($categories as $category)
            <button type="button"
                class="category-item"
                data-category-url="{{ route('vendor.category.form', $category['slug']) }}"
                aria-pressed="false">
                <i class="{{ $category['icon'] }}"></i>
                <span class="category-copy">
                    <strong>{{ $category['name'] }}</strong>
                    <span>Continue with {{ strtolower($category['name']) }} profile</span>
                </span>
                <span class="category-check" aria-hidden="true">
                    <i class="fa-solid fa-check"></i>
                </span>
            </button>
        @endforeach
    </div>

    <div class="category-help">
        <i class="fa-solid fa-circle-info"></i>
        <span>Select one category now. You can return later if you need to update your service profile.</span>
    </div>

    <div class="category-actions">
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>

        <a href="#" class="btn-continue is-disabled" id="categoryContinue" aria-disabled="true">
            Continue <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoryButtons = document.querySelectorAll('.category-item');
        const continueButton = document.getElementById('categoryContinue');
        let selectedUrl = '';

        categoryButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                categoryButtons.forEach(function (item) {
                    item.classList.remove('is-selected');
                    item.setAttribute('aria-pressed', 'false');
                });

                selectedUrl = button.dataset.categoryUrl;
                button.classList.add('is-selected');
                button.setAttribute('aria-pressed', 'true');
                continueButton.href = selectedUrl;
                continueButton.classList.remove('is-disabled');
                continueButton.removeAttribute('aria-disabled');
            });
        });

        continueButton.addEventListener('click', function (event) {
            if (!selectedUrl) {
                event.preventDefault();
            }
        });
    });
</script>
@endpush

@endsection
