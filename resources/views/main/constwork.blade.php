@extends('layouts.app')

@section('title', 'Knowledge Hub')

@section('content')
<style>
    .knowledge-section {
        padding: 50px 0 70px;
        background: #efefef;
    }

    .knowledge-wrapper {
        width: 100%;
        max-width: 1800px;
        margin: 0 auto;
        padding: 0 40px;
    }

    .knowledge-search-wrap {
        display: flex;
        justify-content: center;
        margin-bottom: 34px;
    }

    .knowledge-search {
        width: 100%;
        max-width: 1550px;
        display: flex;
        align-items: center;
        background: #ffffff;
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .knowledge-search-icon {
        width: 70px;
        min-width: 70px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #8e8e8e;
        font-size: 28px;
    }

    .knowledge-search input {
        flex: 1;
        border: none;
        outline: none;
        height: 60px;
        font-size: 16px;
        color: #444;
        background: transparent;
        padding-right: 20px;
    }

    .knowledge-search input::placeholder {
        color: #9c9c9c;
    }

    .knowledge-search button {
        border: none;
        outline: none;
        background: #474747;
        color: #fff;
        font-size: 18px;
        font-weight: 600;
        padding: 0 42px;
        height: 50px;
        margin-right: 10px;
        border-radius: 18px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        transition: 0.3s ease;
    }

    .knowledge-search button:hover {
        background: #2f2f2f;
    }

    .knowledge-title {
        text-align: center;
        font-size: 64px;
        line-height: 1.1;
        font-weight: 800;
        color: #1f1f1f;
        margin-bottom: 18px;
    }

    .knowledge-line {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0;
        margin-bottom: 56px;
    }

    .knowledge-line .blue-line,
    .knowledge-line .orange-line {
        height: 5px;
        width: 160px;
        border-radius: 20px;
    }

    .knowledge-line .blue-line {
        background: #2f78c4;
    }

    .knowledge-line .orange-line {
        background: #ef7d22;
    }

    .knowledge-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }

    .knowledge-image-box {
        border-radius: 30px;
        overflow: hidden;
        transition: all 0.35s ease;
    }

    .knowledge-image-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 35px rgba(0,0,0,0.14);
    }

    .knowledge-image-box img {
        width: 100%;
        display: block;
        object-fit: cover;
        border-radius: 30px;
    }

    @media (max-width: 1400px) {
        .knowledge-title {
            font-size: 48px;
        }

        .knowledge-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .knowledge-section {
            padding: 35px 0 50px;
        }

        .knowledge-wrapper {
            padding: 0 16px;
        }

        .knowledge-search {
            border-radius: 18px;
        }

        .knowledge-search-icon {
            width: 52px;
            min-width: 52px;
            height: 50px;
            font-size: 22px;
        }

        .knowledge-search input {
            height: 50px;
            font-size: 13px;
        }

        .knowledge-search button {
            font-size: 14px;
            padding: 0 18px;
            height: 40px;
            border-radius: 12px;
            margin-right: 6px;
        }

        .knowledge-title {
            font-size: 30px;
            margin-bottom: 12px;
        }

        .knowledge-line {
            margin-bottom: 28px;
        }

        .knowledge-line .blue-line,
        .knowledge-line .orange-line {
            width: 70px;
            height: 4px;
        }

        .knowledge-grid {
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .knowledge-image-box,
        .knowledge-image-box img {
            border-radius: 20px;
        }
    }
</style>

<section class="knowledge-section">
    <div class="knowledge-wrapper">

        <div class="knowledge-search-wrap">
            <form class="knowledge-search" action="#" method="GET">
                <div class="knowledge-search-icon">
                    <i class="fas fa-search"></i>
                </div>
                <input type="text" name="search" placeholder="Search for How to Choose the Right Contractor in India?">
                <button type="submit">search</button>
            </form>
        </div>

        <h2 class="knowledge-title">How do all the services work?</h2>

        <div class="knowledge-line">
            <span class="blue-line"></span>
            <span class="orange-line"></span>
        </div>

        <div class="knowledge-grid">
         
            <a href="{{ route('surveyservicesstep') }}" class="knowledge-image-box">
                <img src="{{ asset('images/constwork/a1.png') }}" alt="Survey Services">
            </a>

            <a href="{{ route('testingservicessteps') }}" class="knowledge-image-box">
                <img src="{{ asset('images/constwork/a2.png') }}" alt="Survey Services">
            </a>

             <a href="{{ route('boqservicessteps') }}" class="knowledge-image-box">
                <img src="{{ asset('images/constwork/a3.png') }}" alt="Survey Services">
            </a>
           
            <a href="{{ route('facadeservicesteps') }}" class="knowledge-image-box">
                <img src="{{ asset('images/constwork/a4.png') }}" alt="Survey Services">
            </a>

            <a href="{{ route('interiordesignersteps') }}" class="knowledge-image-box">
                <img src="{{ asset('images/constwork/a5.png') }}" alt="Survey Services">
            </a>
           

            <a href="{{ route('structuralauditsteps') }}" class="knowledge-image-box">
                <img src="{{ asset('images/constwork/a6.png') }}" alt="Survey Services">
            </a>
           

            <a href="{{ route('nasupportsteps') }}" class="knowledge-image-box">
                <img src="{{ asset('images/constwork/a7.png') }}" alt="Survey Services">
            </a>

             <a href="{{ route('weldingandfabricationsteps') }}" class="knowledge-image-box">
                <img src="{{ asset('images/constwork/a8.png') }}" alt="Survey Services">
            </a>

         
             <a href="{{ route('architectsteps') }}" class="knowledge-image-box">
                <img src="{{ asset('images/constwork/a9.png') }}" alt="Survey Services">
            </a>

             <a href="{{ route('contractorsteps') }}" class="knowledge-image-box">
                <img src="{{ asset('images/constwork/a10.png') }}" alt="Survey Services">
            </a>

           
        </div>

    </div>
</section>
@endsection