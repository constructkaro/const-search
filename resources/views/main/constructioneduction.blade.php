@extends('layouts.app')

@section('title', 'Knowledge Hub')

@section('content')
<style>
    .education-section {
        padding: 55px 0 70px;
        background: #f3f3f3;
    }

    .education-wrapper {
        max-width: 1500px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .search-bar-wrap {
        display: flex;
        justify-content: center;
        margin-bottom: 28px;
    }

    .search-bar {
        width: 100%;
        max-width: 760px;
        display: flex;
        align-items: center;
        overflow: hidden;
        border-radius: 30px;
        background: #e9e9e9;
    }

    .search-bar input {
        flex: 1;
        height: 46px;
        border: none;
        outline: none;
        background: transparent;
        padding: 0 18px;
        font-size: 14px;
        color: #333;
    }

    .search-bar input::placeholder {
        color: #8a8a8a;
    }

    .search-bar button {
        border: none;
        background: #4a4a4a;
        color: #fff;
        padding: 0 28px;
        height: 46px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
    }

    .section-title {
        text-align: center;
        font-size: 34px;
        font-weight: 800;
        color: #1c2c3e;
        margin-bottom: 8px;
        line-height: 1.2;
    }

    .title-line {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-bottom: 38px;
    }

    .title-line span {
        height: 4px;
        border-radius: 50px;
        display: inline-block;
    }

    .title-line .blue {
        width: 55px;
        background: #1c2c3e;
    }

    .title-line .orange {
        width: 55px;
        background: #f25c05;
    }

    .education-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }

    .edu-image-box {
        border-radius: 22px;
        overflow: hidden;
        transition: all 0.35s ease;
        cursor: pointer;
        background: #fff;
    }

    .edu-image-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 36px rgba(0, 0, 0, 0.12);
    }

    .edu-image-box img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
    }

    .edu-image-box.large {
        grid-column: span 2;
    }

    .edu-image-box.tall img {
        height: 100%;
        min-height: 520px;
    }

    .edu-image-box.normal img {
        min-height: 250px;
    }

    .image-modal .modal-content {
        background: transparent;
        border: 0;
        box-shadow: none;
    }

    .image-modal .modal-body {
        padding: 0;
        text-align: center;
    }

    .image-modal img {
        max-width: 100%;
        max-height: 88vh;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    }

    .image-modal .btn-close {
        position: absolute;
        top: -10px;
        right: -10px;
        background-color: #fff;
        border-radius: 50%;
        opacity: 1;
        z-index: 99;
        padding: 10px;
    }

    @media (max-width: 1199px) {
        .education-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .edu-image-box.large {
            grid-column: span 1;
        }

        .edu-image-box.tall img {
            min-height: 420px;
        }
    }

    @media (max-width: 767px) {
        .education-section {
            padding: 40px 0 55px;
        }

        .education-wrapper {
            padding: 0 15px;
        }

        .section-title {
            font-size: 28px;
        }

        .education-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .edu-image-box.large {
            grid-column: span 1;
        }

        .edu-image-box.tall img,
        .edu-image-box.normal img {
            min-height: auto;
        }

        .search-bar {
            max-width: 100%;
        }

        .search-bar input {
            font-size: 13px;
            padding: 0 14px;
        }

        .search-bar button {
            padding: 0 18px;
            font-size: 13px;
        }
    }
</style>

<section class="education-section">
    <div class="education-wrapper">

        <div class="search-bar-wrap">
            <form class="search-bar" action="#" method="GET">
                <input type="text" name="search" placeholder="Search for How to Choose the Right Contractor in India?">
                <button type="submit">Search</button>
            </form>
        </div>

        <h2 class="section-title">Construction Education</h2>
        <div class="title-line">
            <span class="blue"></span>
            <span class="orange"></span>
        </div>

        <div class="education-grid">
            <div class="edu-image-box normal" onclick="openImageModal('{{ asset('images/knowlege/1.png') }}')">
                <img src="{{ asset('images/knowlege/1.png') }}" alt="Knowledge Image 1">
            </div>

            <div class="edu-image-box normal" onclick="openImageModal('{{ asset('images/knowlege/2.png') }}')">
                <img src="{{ asset('images/knowlege/2.png') }}" alt="Knowledge Image 2">
            </div>

            <div class="edu-image-box normal" onclick="openImageModal('{{ asset('images/knowlege/3.png') }}')">
                <img src="{{ asset('images/knowlege/3.png') }}" alt="Knowledge Image 3">
            </div>

            <div class="edu-image-box normal" onclick="openImageModal('{{ asset('images/knowlege/4.png') }}')">
                <img src="{{ asset('images/knowlege/4.png') }}" alt="Knowledge Image 4">
            </div>

            <div class="edu-image-box normal" onclick="openImageModal('{{ asset('images/knowlege/5.png') }}')">
                <img src="{{ asset('images/knowlege/5.png') }}" alt="Knowledge Image 5">
            </div>

            <div class="edu-image-box normal" onclick="openImageModal('{{ asset('images/knowlege/6.png') }}')">
                <img src="{{ asset('images/knowlege/6.png') }}" alt="Knowledge Image 6">
            </div>
        </div>

    </div>
</section>

<!-- Modal -->
<div class="modal fade image-modal" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content position-relative">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <img id="previewImage" src="" alt="Preview Image">
            </div>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function openImageModal(imageSrc) {
        document.getElementById('previewImage').src = imageSrc;
        let imageModal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
        imageModal.show();
    }
</script>
@endsection