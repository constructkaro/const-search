@extends('layouts.app')

@section('title', 'How Survey Services Work')

@section('content')
<style>
    .survey-workflow-section {
        padding: 30px 0 60px;
    }

    .survey-workflow-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
    }

    .survey-header {
        position: relative;
        margin-bottom: 30px;
        text-align: center;
    }

    .survey-back-btn {
        position: absolute;
        left: 0;
        top: 0;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #2d77c7;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 20px;
        transition: 0.3s;
    }

    .survey-back-btn:hover {
        background: #1d5ea3;
        color: #fff;
    }

    .survey-title {
        font-size: 32px;
        font-weight: 800;
        color: #1f1f1f;
        margin-bottom: 10px;
    }

    .survey-title-line {
        display: flex;
        justify-content: center;
    }

    .survey-title-line span {
        height: 4px;
        width: 100px;
    }

    .survey-title-line .blue {
        background: #2d77c7;
        border-radius: 20px 0 0 20px;
    }

    .survey-title-line .orange {
        background: #ef7d22;
        border-radius: 0 20px 20px 0;
    }

    /* IMAGE */
    .survey-image-box {
        text-align: center;
        margin-top: 30px;
    }

    .survey-image-box img {
        width: 100%;
        max-width: 1000px;
        height: auto;
        display: inline-block;
    }

    @media (max-width: 768px) {
        .survey-title {
            font-size: 24px;
        }

        .survey-back-btn {
            width: 35px;
            height: 35px;
            font-size: 16px;
        }

        .survey-title-line span {
            width: 60px;
            height: 3px;
        }
    }
</style>

<section class="survey-workflow-section">
    <div class="survey-workflow-wrapper">

        <div class="survey-header">
            <a href="{{ url()->previous() }}" class="survey-back-btn">
                &#8592;
            </a>

            <h1 class="survey-title">How Interior Designer Service Work</h1>

            <div class="survey-title-line">
                <span class="blue"></span>
                <span class="orange"></span>
            </div>
        </div>

        <div class="survey-image-box">
            <img src="{{ asset('images/constwork/interiorsteps.png') }}" alt="Survey Process">
        </div>

    </div>
</section>
@endsection