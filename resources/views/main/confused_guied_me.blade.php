@extends('layouts.app')

@section('title', 'Confused Guide Me')

@section('content')

<style>
.package-section {
    padding: 20px 35px 45px;
    background: #fff;
    font-family: 'Poppins', sans-serif;
}

.top-area {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 70px;
}

.city-box small {
    display: block;
    text-align: center;
    font-size: 11px;
    color: #111;
    margin-bottom: 2px;
}

.city-dropdown {
    background: #555;
    color: #fff;
    border: 0;
    border-radius: 8px;
    padding: 4px 18px;
    font-size: 24px;
    font-weight: 800;
    box-shadow: 0 2px 4px rgba(0,0,0,.25);
    outline: none;
    cursor: pointer;
}

.toggle-box {
    display: flex;
    gap: 14px;
}

.toggle-box button {
    width: 155px;
    height: 30px;
    border-radius: 7px;
    border: 1px solid #c9c9c9;
    background: #fff;
    font-weight: 800;
    font-size: 13px;
    cursor: pointer;
}

#coreShellBtn.active {
    background: #1f73b7;
    color: #fff;
    border-color: #1f73b7;
}

#turnkeyBtn.active {
    background: #f37021;
    color: #fff;
    border-color: #f37021;
}

.packages {
    display: flex;
    justify-content: center;
    gap: 58px;
}

.package-card {
    width: 305px;
    min-height: 315px;
    border-radius: 12px;
    padding: 42px 25px 18px;
    text-align: center;
    position: relative;
    box-shadow: 0 3px 5px rgba(0,0,0,.35);
}

.package-card.orange {
    background: #fde8d8;
    border: 1.8px solid #f37021;
    border-left: 7px solid #f37021;
}

.package-card.blue {
    background: #e8f3ff;
    border: 1.8px solid #1f73b7;
    border-left: 7px solid #1f73b7;
}

.package-title {
    position: absolute;
    top: -18px;
    left: 50%;
    transform: translateX(-50%);
    color: #fff;
    padding: 10px 18px;
    border-radius: 6px;
    font-size: 15px;
    font-weight: 800;
    white-space: nowrap;
    box-shadow: 0 3px 5px rgba(0,0,0,.25);
}

.orange .package-title,
.orange .know-btn {
    background: #f37021;
}

.blue .package-title,
.blue .know-btn {
    background: #1f73b7;
}

.starting {
    color: #777;
    font-size: 11px;
    margin-bottom: 4px;
}

.package-card h3 {
    font-size: 15px;
    font-weight: 800;
    color: #111;
    margin-bottom: 22px;
}

.package-card h4 {
    font-size: 17px;
    font-weight: 800;
    margin: 21px 0 8px;
}

.orange h4 {
    color: #f37021;
}

.blue h4 {
    color: #1f73b7;
}

.package-card p {
    font-size: 11px;
    color: #555;
    margin-bottom: 8px;
}

.know-btn {
    display: inline-block;
    margin-top: 10px;
    color: #fff;
    padding: 9px 45px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 800;
    text-decoration: none;
}

@media(max-width: 992px) {
    .packages {
        flex-direction: column;
        align-items: center;
        gap: 58px;
    }

    .top-area {
        flex-direction: column;
        gap: 25px;
        margin-bottom: 50px;
    }
}
</style>

<section class="package-section">
    <div class="top-area">

        <div class="city-box">
            <small>(Select Your City)</small>

            <select id="citySelect" class="city-dropdown">
                @foreach($cities as $city)
                    @php
                        $cityValue = strtolower(str_replace(' ', '-', $city->name));
                    @endphp

                    <option value="{{ $cityValue }}" {{ ($selectedCity ?? 'pune') == $cityValue ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="toggle-box">
            <button type="button" class="active" id="coreShellBtn">CORE & SHELL</button>
            <button type="button" id="turnkeyBtn">TURNKEY</button>
        </div>

    </div>

    <div class="packages">

        <div class="package-card orange">
            <div class="package-title">STANDARD PACKAGE</div>

            <p class="starting">Starting Price</p>
            <h3 id="standardPrice">₹1800/sq.ft</h3>

            <h4 id="standardSupportTitle">Site Supervision</h4>
            <p id="standardSupport">⦿ Weekly Site Monitoring</p>

            <h4>Customisation</h4>
            <p id="standardCustomisation">⦿ No Customisation</p>

            <h4>Best For</h4>
            <p id="standardBestFor">⦿ Budget homes, rental homes, simple first homes</p>

            <a href="javascript:void(0)" class="know-btn package-link" data-package="standard">
                Know More
            </a>
        </div>

        <div class="package-card blue">
            <div class="package-title">PREMIUM PACKAGE</div>

            <p class="starting">Starting Price</p>
            <h3 id="premiumPrice">₹2200/sq.ft</h3>

            <h4 id="premiumSupportTitle">Site Supervision</h4>
            <p id="premiumSupport">⦿ Site Monitoring Twice a Week</p>

            <h4>Customisation</h4>
            <p id="premiumCustomisation">⦿ Limited Customisation</p>

            <h4>Best For</h4>
            <p id="premiumBestFor">⦿ Budget homes, first-time builders</p>

            <a href="javascript:void(0)" class="know-btn package-link" data-package="premium">
                Know More
            </a>
        </div>

        <div class="package-card orange">
            <div class="package-title">LUXURY PACKAGE</div>

            <p class="starting">Starting Price</p>
            <h3 id="luxuryPrice">₹2500/sq.ft</h3>

            <h4 id="luxurySupportTitle">Site Supervision</h4>
            <p id="luxurySupport">⦿ Dedicated Project Manager</p>

            <h4>Customisation</h4>
            <p id="luxuryCustomisation">⦿ High Customisation</p>

            <h4>Best For</h4>
            <p id="luxuryBestFor">⦿ Villas, luxury homes, NRIs</p>

            <a href="javascript:void(0)" class="know-btn package-link" data-package="luxury">
                Know More
            </a>
        </div>

    </div>
</section>

<script>
const coreShellData = {
    "pune": {
        standard: "₹1800/sq.ft",
        premium: "₹2200/sq.ft",
        luxury: "₹2500/sq.ft"
    },
    "pimpri-chinchwad": {
        standard: "₹1800/sq.ft",
        premium: "₹2200/sq.ft",
        luxury: "₹2500/sq.ft"
    },
    "mumbai": {
        standard: "₹2100/sq.ft",
        premium: "₹2400/sq.ft",
        luxury: "₹2800/sq.ft"
    },
    "navi-mumbai": {
        standard: "₹2000/sq.ft",
        premium: "₹2300/sq.ft",
        luxury: "₹2550/sq.ft"
    },
    "raigad": {
        standard: "₹1700/sq.ft",
        premium: "₹2100/sq.ft",
        luxury: "₹2400/sq.ft"
    },
    "thane": {
        standard: "₹1900/sq.ft",
        premium: "₹2300/sq.ft",
        luxury: "₹2700/sq.ft"
    }
};

const turnkeyData = {
    "pune": {
        standard: "₹2800/sq.ft",
        premium: "Rs.3000/sq.ft to Rs.3400/sq.ft",
        luxury: "Rs.3500/sq.ft to Rs.4500/sq.ft"
    },
    "pimpri-chinchwad": {
        standard: "₹2800/sq.ft",
        premium: "Rs.3000/sq.ft to Rs.3400/sq.ft",
        luxury: "Rs.3500/sq.ft to Rs.4500/sq.ft"
    },
    "mumbai": {
        standard: "₹3100/sq.ft",
        premium: "Rs.3500/sq.ft to Rs.4000/sq.ft",
        luxury: "Rs.4100/sq.ft to Rs.4600/sq.ft"
    },
    "navi-mumbai": {
        standard: "₹3000/sq.ft",
        premium: "Rs.3500/sq.ft to Rs.3800/sq.ft",
        luxury: "Rs.4000/sq.ft to Rs.4500/sq.ft"
    },
    "raigad": {
        standard: "₹2800/sq.ft",
        premium: "Rs.3000/sq.ft to Rs.3400/sq.ft",
        luxury: "Rs.3500/sq.ft to Rs.4200/sq.ft"
    },
    "thane": {
        standard: "₹3000/sq.ft",
        premium: "Rs.3400/sq.ft to Rs.3900/sq.ft",
        luxury: "Rs.4000/sq.ft to Rs.4500/sq.ft"
    }
};

let currentType = 'core';

function updatePackageData() {
    let city = document.getElementById('citySelect').value;
    let data = currentType === 'core' ? coreShellData[city] : turnkeyData[city];

    if (!data) return;

    document.getElementById('standardPrice').innerText = data.standard;
    document.getElementById('premiumPrice').innerText = data.premium;
    document.getElementById('luxuryPrice').innerText = data.luxury;

    if (currentType === 'turnkey') {
        document.getElementById('standardSupportTitle').innerText = 'Design Support';
        document.getElementById('standardSupport').innerText = '⦿ Basic 2D Planning + Elevation (single iteration)';
        document.getElementById('standardCustomisation').innerText = '⦿ No Customisation';

        document.getElementById('premiumSupportTitle').innerText = 'Design Support';
        document.getElementById('premiumSupport').innerText = '⦿ Basic 2D Planning + Elevation (twice iteration)';
        document.getElementById('premiumCustomisation').innerText = '⦿ Limited Customisation';

        document.getElementById('luxurySupportTitle').innerText = 'Design Support';
        document.getElementById('luxurySupport').innerText = '⦿ 2D + 3D + Premium Elevation (3 times iteration)';
        document.getElementById('luxuryCustomisation').innerText = '⦿ High Customisation';
    } else {
        document.getElementById('standardSupportTitle').innerText = 'Site Supervision';
        document.getElementById('standardSupport').innerText = '⦿ Weekly Site Monitoring';
        document.getElementById('standardCustomisation').innerText = '⦿ No Customisation';

        document.getElementById('premiumSupportTitle').innerText = 'Site Supervision';
        document.getElementById('premiumSupport').innerText = '⦿ Site Monitoring Twice a Week';
        document.getElementById('premiumCustomisation').innerText = '⦿ Limited Customisation';

        document.getElementById('luxurySupportTitle').innerText = 'Site Supervision';
        document.getElementById('luxurySupport').innerText = '⦿ Dedicated Project Manager';
        document.getElementById('luxuryCustomisation').innerText = '⦿ High Customisation';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    updatePackageData();

    document.getElementById('citySelect').addEventListener('change', function () {
        updatePackageData();
    });

    document.getElementById('coreShellBtn').addEventListener('click', function () {
        currentType = 'core';

        this.classList.add('active');
        document.getElementById('turnkeyBtn').classList.remove('active');

        updatePackageData();
    });

    document.getElementById('turnkeyBtn').addEventListener('click', function () {
        currentType = 'turnkey';

        this.classList.add('active');
        document.getElementById('coreShellBtn').classList.remove('active');

        updatePackageData();
    });

    document.querySelectorAll('.package-link').forEach(function(btn) {
        btn.addEventListener('click', function () {
            let packageName = this.dataset.package;
            let city = document.getElementById('citySelect').value;

            if (currentType === 'turnkey') {
                window.location.href = "{{ url('/turnkey-material') }}/" + city + "/" + packageName;
            } else {
                window.location.href = "{{ url('/package-material') }}/" + city + "/" + packageName;
            }
        });
    });
});
</script>

@endsection