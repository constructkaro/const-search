<style>
    .vendor-header {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: #d9d9d9;
        border-bottom: 1px solid #cecece;
    }

    .vendor-header .header-container {
        width: 92%;
        max-width: 1600px;
        min-height: 87px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
    }

    .vendor-header .logo {
        display: flex;
        flex-shrink: 0;
    }

    .vendor-header .logo a {
        display: inline-flex;
        align-items: center;
    }

    .vendor-header .logo img {
        display: block;
        width: 220px;
        height: 88px;
        object-fit: contain;
    }

    .vendor-header .nav-menu {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 24px;
        padding: 12px 0;
    }

    .vendor-header .nav-menu a {
        color: #242424;
        font-size: 17px;
        font-weight: 500;
        line-height: 1.4;
        white-space: nowrap;
        text-decoration: none;
    }

    .vendor-header .nav-menu a:hover {
        color: #f37021;
    }

    .vendor-header .nav-menu a:focus-visible {
        outline: 2px solid #2176bb;
        outline-offset: 5px;
    }

    .vendor-header .nav-menu .is-active {
        font-weight: 700;
        background: linear-gradient(90deg, #2176bb, #f37021);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        border-bottom: 2px solid #97acc1;
    }

    .vendor-header .nav-menu .register-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 140px;
        min-height: 50px;
        padding: 8px 28px;
        background: #f37021;
        color: #fff;
        border: 1px solid #ca824b;
        border-radius: 14px;
        font-weight: 700;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, .26), inset 0 -3px 7px rgba(255, 255, 255, .2);
    }

    .vendor-header .nav-menu .register-btn:hover {
        background: #df6018;
    }

    #top, #who-can-join, #how-it-works, #why-join, #faq {
        scroll-margin-top: 125px;
    }

    @media (max-width: 1100px) {
        .vendor-header .header-container {
            gap: 12px;
        }

        .vendor-header .nav-menu {
            gap: 16px;
        }

        .vendor-header .nav-menu a {
            font-size: 16px;
        }

        .vendor-header .logo img {
            width: 200px;
        }
    }

    @media (max-width: 800px) {
        .vendor-header .header-container {
            flex-direction: column;
            gap: 0;
            padding: 0 0 14px;
        }

        .vendor-header .logo img {
            height: 82px;
            margin-left: 0;
        }

        .vendor-header .nav-menu {
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px 18px;
        }

        .vendor-header .nav-menu a {
            font-size: 14px;
        }

        .vendor-header .nav-menu .register-btn {
            min-width: 90px;
            min-height: 40px;
            padding: 6px 18px;
            border-radius: 10px;
        }

        #top, #who-can-join, #how-it-works, #why-join, #faq {
            scroll-margin-top: 210px;
        }
    }
</style>

<header class="vendor-header">
    <div class="header-container">
        <div class="logo">
            <a href="{{ route('vendor') }}" aria-label="ConstructKaro vendor home">
                <img src="{{ asset('images/logo.png') }}" alt="ConstructKaro" width="220" height="88">
            </a>
        </div>

        <nav class="nav-menu" aria-label="Vendor navigation">
            <a href="{{ route('vendor') }}#top" @class(['is-active' => request()->routeIs('vendor')]) @if(request()->routeIs('vendor')) aria-current="page" @endif>Home</a>
            <a href="{{ route('vendor') }}#who-can-join">Who Can Join</a>
            <a href="{{ route('vendor') }}#how-it-works">How It Works</a>
            <a href="{{ route('vendor') }}#why-join">Why Join</a>
            <a href="{{ route('vendor') }}#faq">FAQ</a>
            <a href="{{ route('login') }}" class="register-btn">Login</a>

        </nav>
    </div>
</header>
