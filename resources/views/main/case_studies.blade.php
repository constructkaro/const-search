@extends('layouts.app')

@section('title', 'Case Studies')

@section('content')
<style>
    body {
        background: #eeeeee;
        color: #222;
        font-family: "Poppins", Arial, sans-serif;
    }

    .case-studies-section {
        min-height: 640px;
        background: #eeeeee;
        padding: 34px 54px 80px;
    }

    .case-studies-search {
        max-width: 1020px;
        margin: 0 auto 18px;
    }

    .case-studies-search form {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
        height: 42px;
        background: #fff;
        border-radius: 16px;
        padding: 0 8px 0 16px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .case-search-icon {
        width: 22px;
        height: 22px;
        color: #9b9b9b;
        flex-shrink: 0;
    }

    .case-studies-search input {
        flex: 1;
        min-width: 0;
        height: 100%;
        border: 0;
        outline: 0;
        background: transparent;
        color: #333;
        font-size: 13px;
    }

    .case-studies-search input::placeholder {
        color: #a0a0a0;
    }

    .case-studies-search button {
        width: 104px;
        height: 32px;
        border: 0;
        border-radius: 9px;
        background: linear-gradient(180deg, #6b6b6b 0%, #4a4a4a 100%);
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        text-transform: lowercase;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(0,0,0,0.24);
    }

    .case-studies-title {
        margin: 0;
        text-align: center;
        font-size: 28px;
        line-height: 1.15;
        font-weight: 800;
        color: #202020;
    }

    .case-title-line {
        width: 146px;
        height: 3px;
        margin: 10px auto 72px;
        display: flex;
        border-radius: 999px;
        overflow: hidden;
    }

    .case-title-line .blue {
        flex: 1;
        background: #1d6fb8;
    }

    .case-title-line .orange {
        flex: 1;
        background: #f37021;
    }

    .case-card-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 320px));
        gap: 28px;
        align-items: start;
    }

    .case-card {
        display: block;
        max-width: 320px;
        overflow: hidden;
        border: 4px solid #f37021;
        border-radius: 16px;
        background: #fdebdc;
        color: #202020;
        text-decoration: none;
        box-shadow: 0 3px 6px rgba(0,0,0,0.24);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .case-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 18px rgba(0,0,0,0.18);
    }

    .case-card img {
        display: block;
        width: 100%;
        height: 140px;
        object-fit: cover;
    }

    .case-card-body {
        padding: 16px 14px 10px;
        text-align: center;
    }

    .case-card h3 {
        margin: 0 0 8px;
        font-size: 15px;
        line-height: 1.14;
        font-weight: 800;
    }

    .case-card p {
        margin: 0 auto 12px;
        max-width: 265px;
        color: #4c4c4c;
        font-size: 11px;
        line-height: 1.35;
    }

    .case-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 0 4px;
    }

    .case-date {
        color: #3d3d3d;
        font-size: 11px;
        font-weight: 500;
        white-space: nowrap;
    }

    .case-read-more {
        min-width: 98px;
        height: 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: linear-gradient(180deg, #f58a39 0%, #d96016 100%);
        color: #fff;
        font-size: 11px;
        font-weight: 800;
        box-shadow: inset 0 1px 1px rgba(255,255,255,0.35);
    }

    @media (max-width: 1100px) {
        .case-card-grid {
            grid-template-columns: repeat(2, minmax(0, 320px));
        }
    }

    @media (max-width: 767px) {
        .case-studies-section {
            padding: 24px 16px 56px;
        }

        .case-studies-search form {
            height: auto;
            flex-wrap: wrap;
            padding: 10px;
            border-radius: 14px;
        }

        .case-studies-search input {
            height: 34px;
            font-size: 12px;
        }

        .case-studies-search button {
            width: 100%;
        }

        .case-studies-title {
            font-size: 26px;
        }

        .case-title-line {
            margin-bottom: 34px;
        }

        .case-card-grid {
            grid-template-columns: 1fr;
            justify-items: center;
        }

        .case-card {
            width: 100%;
        }
    }
</style>

<section class="case-studies-section">
    <div class="case-studies-search">
        <form action="#" method="GET">
            <svg class="case-search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" name="search" placeholder="Search for How to Choose the Right Contractor in India?">
            <button type="submit">search</button>
        </form>
    </div>

    <h1 class="case-studies-title">Case Studies</h1>
    <div class="case-title-line">
        <span class="blue"></span>
        <span class="orange"></span>
    </div>

    <div class="case-card-grid">
        <a href="{{ route('case-study.house-construction-plot') }}" class="case-card">
            <img src="{{ asset('images/topics/cs1.png') }}" alt="How to Start House Construction on Your Plot">
            <div class="case-card-body">
                <h3>How to Start House<br>Construction on Your Plot</h3>
                <p>Many people buy a plot with a dream of building their own home... but then they get stuck.</p>
                <div class="case-card-footer">
                    <span class="case-date">17 Apr 2026</span>
                    <span class="case-read-more">Read More</span>
                </div>
            </div>
        </a>
    </div>
</section>
@endsection
