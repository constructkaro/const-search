@extends('layouts.app')

@section('title', 'Construction Requirement')

@section('content')

<style>
    * {
        box-sizing: border-box;
    }

    body {
        background: #e9e9e9;
        color: #222;
        font-family: "Poppins", "Segoe UI", sans-serif;
    }

    .page-wrapper {
        width: 100%;
        min-height: 100vh;
        padding: 24px 15px 45px;
    }

    .back-btn {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #1e73be;
        color: #fff;
        border: none;
        font-size: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin-left: 45px;
        margin-bottom: 5px;
    }

    .top-content {
        text-align: center;
        max-width: 850px;
        margin: 0 auto 35px;
    }

    .top-content h1 {
        font-size: 26px;
        line-height: 1.25;
        font-weight: 800;
        color: #222;
        margin-bottom: 14px;
    }

    .top-content p {
        font-size: 16px;
        line-height: 1.4;
        color: #5f5f5f;
        font-weight: 400;
    }

    .form-card {
        max-width: 980px;
        margin: 0 auto;
        background: #fff;
        border-radius: 24px;
        padding: 35px 38px 40px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-label {
        display: block;
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 7px;
        color: #222;
    }

    .form-control {
        width: 100%;
        height: 42px;
        border: 1.3px solid #222;
        background: #eaf4ff;
        border-radius: 5px;
        padding: 9px 12px;
        font-size: 14px;
        color: #222;
        outline: none;
    }

    .form-control:focus {
        border-color: #1e73be;
        box-shadow: 0 0 0 2px rgba(30, 115, 190, 0.12);
    }

    textarea.form-control {
        height: auto;
        min-height: 130px;
        resize: vertical;
    }

    .form-control::placeholder {
        color: #aaa;
    }

    .grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px 55px;
    }

    .section-title {
        color: #1e73be;
        font-size: 20px;
        font-weight: 800;
        margin: 30px 0 18px;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px 40px;
        margin-bottom: 32px;
    }

    .service-box {
        min-height: 58px;
        background: #eaf4ff;
        border: 1.3px solid #222;
        border-radius: 6px;
        display: flex;
        align-items: center;
        padding: 10px 12px;
        cursor: pointer;
        user-select: none;
    }

    .service-box input {
        display: none;
    }

    .custom-check {
        width: 30px;
        height: 30px;
        border: 1.3px solid #aaa;
        background: #fff;
        border-radius: 4px;
        margin-right: 11px;
        flex-shrink: 0;
        position: relative;
    }

    .service-box input:checked + .custom-check {
        background: #1e73be;
        border-color: #1e73be;
    }

    .service-box input:checked + .custom-check::after {
        content: "✓";
        position: absolute;
        color: #fff;
        font-size: 22px;
        font-weight: 800;
        left: 5px;
        top: -3px;
    }

    .service-text {
        font-size: 16px;
        font-weight: 800;
        color: #050505;
        line-height: 1.2;
    }

    .submit-area {
        text-align: center;
        margin-top: 30px;
    }

    .submit-btn {
        width: 430px;
        max-width: 100%;
        border: none;
        border-radius: 10px;
        background: #287fc4;
        color: #fff;
        font-size: 20px;
        font-weight: 800;
        padding: 13px 18px;
        cursor: pointer;
        box-shadow: inset 0 4px 8px rgba(0,0,0,0.22);
    }

    .submit-btn:hover {
        background: #1e73be;
    }

    .note {
        margin-top: 16px;
        color: #777;
        font-size: 14px;
        font-weight: 600;
    }

    .alert-success {
        max-width: 980px;
        margin: 0 auto 18px;
        background: #e8f8ee;
        color: #0f7a35;
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
    }

    .error-text {
        color: #dc3545;
        font-size: 13px;
        margin-top: 4px;
        display: block;
    }

    @media (max-width: 992px) {
        .back-btn {
            margin-left: 10px;
        }

        .form-card {
            padding: 28px 24px;
        }

        .services-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
    }

    @media (max-width: 768px) {
        .top-content h1 {
            font-size: 22px;
        }

        .top-content p {
            font-size: 14px;
        }

        .grid-2 {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .services-grid {
            grid-template-columns: 1fr;
        }

        .section-title {
            font-size: 18px;
        }
    }

    @media (max-width: 576px) {
        .page-wrapper {
            padding: 18px 12px 35px;
        }

        .form-card {
            border-radius: 18px;
            padding: 24px 18px;
        }

        .top-content {
            margin-bottom: 25px;
        }

        .top-content h1 {
            font-size: 20px;
        }

        .submit-btn {
            font-size: 17px;
        }
    }
</style>

<div class="page-wrapper">

    <button type="button" class="back-btn" onclick="history.back()">←</button>

    <div class="top-content">
        <h1>
            Confused About Which Construction Service or Package to
            Choose for Your Project?
        </h1>

        <p>
            From initial planning to complete project execution, ConstructKaro guides you
            with the right services at every stage.
        </p>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form class="form-card" method="POST" action="{{ route('construction.requirement.store') }}">
        @csrf

        <div class="form-group">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control"
                   value="{{ old('full_name') }}"
                   placeholder="Enter your full name">
            @error('full_name')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="grid-2">
            <div class="form-group">
                <label class="form-label">Mobile Number</label>
                <input type="text" name="mobile" class="form-control"
                       value="{{ old('mobile') }}"
                       placeholder="+91 00000 00000">
                @error('mobile')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email ID</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}"
                       placeholder="you@email.com">
                @error('email')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <h2 class="section-title">Location Details:</h2>

        <div class="grid-2">
            <div class="form-group">
                <label class="form-label">House no./ Building/Company Name</label>
                <input type="text" name="house_name" class="form-control"
                       value="{{ old('house_name') }}"
                       placeholder="Crescent Pearl B">
            </div>

            <div class="form-group">
                <label class="form-label">Road Name / Area / Colony</label>
                <input type="text" name="area" class="form-control"
                       value="{{ old('area') }}"
                       placeholder="Veena Nagar, Katrang Road, Khalapur">
            </div>

            <div class="form-group">
                <label class="form-label">City</label>
                <input type="text" name="city" class="form-control"
                       value="{{ old('city') }}"
                       placeholder="Khopoli">
            </div>

            <div class="form-group">
                <label class="form-label">Pincode</label>
                <input type="text" name="pincode" class="form-control"
                       value="{{ old('pincode') }}"
                       placeholder="410203">
            </div>
        </div>

        <h2 class="section-title">Select Services You May Need</h2>

        <div class="services-grid">
            @php
                $services = [
                    'Contractor',
                    'Architect',
                    'Interiors',
                    'BOQ & Estimation',
                    'Survey Services',
                    'Testing Services'
                ];

                $oldServices = old('services', []);
            @endphp

            @foreach($services as $service)
                <label class="service-box">
                    <input type="checkbox"
                           name="services[]"
                           value="{{ $service }}"
                           {{ in_array($service, $oldServices) ? 'checked' : '' }}>
                    <span class="custom-check"></span>
                    <span class="service-text">{{ $service }}</span>
                </label>
            @endforeach
        </div>

        <h2 class="section-title">Project Description</h2>

        <div class="form-group">
            <textarea name="project_description"
                      class="form-control"
                      placeholder="Briefly explain your requirement, project type, or what you're confused about...">{{ old('project_description') }}</textarea>
            @error('project_description')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <div class="submit-area">
            <button type="submit" class="submit-btn">
                Submit Requirement →
            </button>

            <p class="note">
                Our team will review your requirement and contact you within 24 working hours.
            </p>
        </div>

    </form>

</div>

@endsection