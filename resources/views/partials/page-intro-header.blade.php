@once
    <style>
        .ck-page-intro {
            --ck-intro-blue: #1f67ab;
            --ck-intro-orange: #e87526;
            position: relative;
            padding: 56px 0 58px;
            overflow: hidden;
            background:
                linear-gradient(112deg, rgba(16,42,67,.98) 0%, rgba(19,58,91,.98) 55%, rgba(31,103,171,.9) 100%);
            border-bottom: 5px solid var(--ck-intro-orange);
        }

        .ck-page-intro::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,.055) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.055) 1px, transparent 1px);
            background-size: 44px 44px;
            opacity: .5;
            pointer-events: none;
        }

        .ck-page-intro::after {
            content: "";
            position: absolute;
            right: -155px;
            top: -118px;
            width: 560px;
            height: 360px;
            background: rgba(232,117,38,.16);
            transform: rotate(-18deg);
            pointer-events: none;
        }

        .ck-page-intro-wrap {
            position: relative;
            z-index: 1;
            width: min(1180px, calc(100% - 36px));
            margin: 0 auto;
        }

        .ck-page-intro-kicker {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
            color: #f68a2e;
            font-size: 14px;
            font-weight: 900;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .ck-page-intro-kicker::before {
            content: "";
            width: 38px;
            height: 3px;
            border-radius: 999px;
            background: #f68a2e;
        }

        .ck-page-intro h1 {
            max-width: 880px;
            margin: 0;
            color: #fff;
            font-size: clamp(36px, 4.1vw, 58px);
            font-weight: 900;
            line-height: 1.08;
            letter-spacing: 0;
            text-shadow: 0 4px 14px rgba(0,0,0,.2);
        }

        .ck-page-intro p {
            max-width: 760px;
            margin: 16px 0 0;
            color: rgba(255,255,255,.84);
            font-size: 16px;
            line-height: 1.7;
        }

        .ck-page-intro-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 24px;
        }

        .ck-page-intro-tags span {
            display: inline-flex;
            align-items: center;
            min-height: 34px;
            padding: 0 13px;
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 999px;
            background: rgba(255,255,255,.1);
            color: #fff;
            font-size: 13px;
            font-weight: 800;
        }

        @media (max-width: 767px) {
            .ck-page-intro {
                padding: 38px 0 42px;
            }

            .ck-page-intro h1 {
                font-size: 34px;
            }

            .ck-page-intro p {
                font-size: 15px;
                line-height: 1.62;
            }
        }
    </style>
@endonce

<header class="ck-page-intro">
    <div class="ck-page-intro-wrap">
        @isset($kicker)
            <span class="ck-page-intro-kicker">{{ $kicker }}</span>
        @endisset
        <h1>{{ $title }}</h1>
        @isset($subtitle)
            <p>{{ $subtitle }}</p>
        @endisset
        @if(!empty($tags ?? []))
            <div class="ck-page-intro-tags">
                @foreach($tags as $tag)
                    <span>{{ $tag }}</span>
                @endforeach
            </div>
        @endif
    </div>
</header>
