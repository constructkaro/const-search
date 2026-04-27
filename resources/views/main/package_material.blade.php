@extends('layouts.app')

@section('title', 'Package Material Specification')

@section('content')

<style>
.material-section {
    padding: 20px 30px 50px;
    background: #fff;
    font-family: 'Poppins', sans-serif;
    text-align: center;
}

.material-section h2 {
    font-size: 28px;
    font-weight: 900;
    color: #222;
    margin-bottom: 6px;
}

.title-line {
    width: 350px;
    height: 2px;
    background: linear-gradient(to right, #f37021 50%, #1f73b7 50%);
    margin: 0 auto 12px;
}

.material-section h5 {
    font-size: 15px;
    font-weight: 700;
    color: #555;
    margin-bottom: 45px;
}

.table-wrap {
    width: 100%;
    overflow-x: auto;
}

.material-table {
    width: 900px;
    max-width: 100%;
    margin: auto;
    border-collapse: separate;
    border-spacing: 0;
}

.material-table th,
.material-table td {
    border: 2px solid #fff;
    padding: 14px 12px;
    text-align: center;
    vertical-align: middle;
    font-size: 12px;
    font-weight: 700;
}

.material-table th {
    font-size: 24px;
    font-weight: 900;
}

.blank {
    background: transparent !important;
    border: none !important;
}

.check-row th {
    background: #e5e5e5;
    height: 42px;
    padding: 8px;
}

.check-circle {
    display: inline-flex;
    width: 26px;
    height: 26px;
    border: 2px solid #111;
    border-radius: 50%;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    line-height: 1;
}

.material-head,
.material-name {
    background: #e5e5e5;
    color: #222;
}

.material-head {
    font-size: 22px !important;
}

.material-name {
    text-align: left !important;
    font-size: 15px !important;
    font-weight: 900 !important;
    width: 210px;
}

.material-name span {
    display: flex;
    align-items: center;
    gap: 10px;
}

.material-name img {
    width: 38px;
    height: 38px;
    object-fit: contain;
}

.standard-col {
    background: #acd4fa;
    width: 230px;
}

.premium-col {
    background: #ffc49d;
    width: 230px;
}

.luxury-col {
    background: #c9c9c9;
    width: 230px;
}

/* Rounded corners same like image */
.check-row th:nth-child(2) {
    border-top-left-radius: 8px;
}

.check-row th:last-child {
    border-top-right-radius: 8px;
}

.material-table tr:last-child td:last-child {
    border-bottom-right-radius: 8px;
}

/* Blur only, no zoom */
.material-table.active-standard .premium-col,
.material-table.active-standard .luxury-col {
    filter: blur(5px);
    opacity: 0.55;
}

.material-table.active-premium .standard-col,
.material-table.active-premium .luxury-col {
    filter: blur(5px);
    opacity: 0.55;
}

.material-table.active-luxury .standard-col,
.material-table.active-luxury .premium-col {
    filter: blur(5px);
    opacity: 0.55;
}

.material-table.active-standard .standard-col,
.material-table.active-premium .premium-col,
.material-table.active-luxury .luxury-col {
    filter: none;
    opacity: 1;
    transform: none;
    box-shadow: none;
    border-radius: 0;
}

@media(max-width: 992px) {
    .material-table {
        min-width: 900px;
    }
}

.top-area {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 35px;
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

.toggle-box .active {
    background: #1f73b7;
    color: #fff;
    border-color: #1f73b7;
}

.flow-section {
    padding: 35px 20px 60px;
    background: #fff;
    font-family: 'Poppins', sans-serif;
    text-align: center;
}

.flow-section h2 {
    font-size: 30px;
    font-weight: 900;
    color: #222;
    margin-bottom: 6px;
}

.flow-line {
    width: 280px;
    height: 3px;
    background: linear-gradient(to right, #f37021 50%, #1f73b7 50%);
    margin: 0 auto 14px;
}

.flow-subtitle {
    font-size: 15px;
    font-weight: 700;
    color: #555;
    margin-bottom: 45px;
}

.flow-wrapper {
    max-width: 720px;
    margin: 0 auto;
}

.flow-item {
    display: flex;
    align-items: stretch;
    width: 100%;
}

.step-no {
    width: 55px;
    background: #f37021;
    color: #fff;
    font-size: 18px;
    font-weight: 900;
    display: flex;
    align-items: center;
    justify-content: center;
    clip-path: polygon(0 0, 82% 0, 100% 50%, 82% 100%, 0 100%);
    border-radius: 3px 0 0 3px;
}

.step-icon {
    width: 55px;
    background: #1f73b7;
    color: #fff;
    font-size: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.step-content {
    flex: 1;
    background: #fff;
    border: 1px solid #cfcfcf;
    border-left: 0;
    text-align: left;
    padding: 10px 15px;
    box-shadow: 0 3px 4px rgba(0,0,0,0.2);
}

.step-content h4 {
    margin: 0 0 3px;
    font-size: 20px;
    font-weight: 900;
    color: #222;
}

.step-content p {
    margin: 0;
    font-size: 12px;
    font-weight: 500;
    color: #555;
}

.arrow {
    font-size: 42px;
    line-height: 36px;
    color: #f37021;
    font-weight: 900;
    margin: 3px 0;
}

.contact-box {
    margin-top: 45px;
}

.contact-box p {
    font-size: 18px;
    font-weight: 900;
    color: #222;
    margin-bottom: 15px;
}

.contact-btn {
    display: inline-block;
    background: #555;
    color: #fff;
    padding: 10px 45px;
    border-radius: 8px 8px 0 0;
    font-size: 20px;
    font-weight: 900;
    text-decoration: none;
}

@media(max-width: 768px) {
    .flow-section h2 {
        font-size: 22px;
    }

    .flow-wrapper {
        max-width: 100%;
    }

    .step-no,
    .step-icon {
        width: 45px;
        font-size: 14px;
    }

    .step-icon {
        font-size: 20px;
    }

    .step-content h4 {
        font-size: 15px;
    }

    .step-content p {
        font-size: 11px;
    }
}

.step-icon img {
    width: 53px;
    height: 56px;
    object-fit: contain;
}
.package-click {
    cursor: pointer;
}

.material-table.active-standard .standard-col,
.material-table.active-premium .premium-col,
.material-table.active-luxury .luxury-col {
    background: #1f73b7 !important;
    color: #fff !important;
    filter: none;
    opacity: 1;
}

.material-table.active-standard .check-row .standard-col,
.material-table.active-premium .check-row .premium-col,
.material-table.active-luxury .check-row .luxury-col {
    background: #555 !important;
}

.material-table.active-standard .check-row .standard-col .check-circle,
.material-table.active-premium .check-row .premium-col .check-circle,
.material-table.active-luxury .check-row .luxury-col .check-circle {
    background: #05b857;
    color: #fff;
    border-color: #fff;
}
</style>
<div class="top-area">
    <div class="city-box">
        <small>(Select Your City)</small>

        <select id="citySelect" class="city-dropdown">
            @foreach($cities as $city)
                @php
                    $cityValue = strtolower(str_replace(' ', '-', $city->name));
                @endphp

                <option value="{{ $cityValue }}" {{ $selectedCity == $cityValue ? 'selected' : '' }}>
                    {{ $city->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="toggle-box">
        <button type="button" class="active">CORE & SHELL</button>
        <button type="button">TURNKEY</button>
    </div>
</div>
<section class="material-section">

    <h2>CORE & SHELL MATERIAL SPECIFICATION</h2>
    <div class="title-line"></div>
    <h5>(Structure Work – Foundation to Plaster Level)</h5>

    <div class="table-wrap">
        <table class="material-table active-{{ $package }}" id="materialTable">

            <tr class="check-row">
                <th class="blank"></th>
                <!-- <th class="standard-col"><span class="check-circle">✓</span></th>
                <th class="premium-col"><span class="check-circle">✓</span></th>
                <th class="luxury-col"><span class="check-circle">✓</span></th> -->
                <th class="standard-col package-click" data-package="standard"><span class="check-circle">✓</span></th>
                <th class="premium-col package-click" data-package="premium"><span class="check-circle">✓</span></th>
                <th class="luxury-col package-click" data-package="luxury"><span class="check-circle">✓</span></th>
            </tr>

            <tr>
                <th class="material-head">Material</th>
                <th class="standard-col">Standard</th>
                <th class="premium-col">Premium</th>
                <th class="luxury-col">Luxury</th>
            </tr>

            <tr>
                <td class="material-name">
                    <span>
                        <img src="{{ asset('images/coreandshell/1.png') }}" alt="Cement">
                        Cement
                    </span>
                </td>

                <td class="standard-col">Shree Cement</td>
                <td class="premium-col">ACC Cement, Ambuja Cement, JK Super Cement</td>
                <td class="luxury-col">UltraTech Cement</td>
            </tr>

            <tr>
                <td class="material-name"><span> 
                    <img src="{{ asset('images/coreandshell/7.png') }}" alt="Steel">
                 Steel (TMT Bars)</span></td>
                <td class="standard-col">
                    Kamdhenu Steel, Pushpa steel, Samruddhi Composites (IS Certified)
                </td>
                <td class="premium-col">Tata Steel, JSW Steel</td>
                <td class="luxury-col">Tata Steel, JSW Steel</td>
            </tr>

            <tr>
                <td class="material-name"><span><img src="{{ asset('images/coreandshell/6.png') }}" alt="Steel">Bricks / Blocks</span></td>
                <td class="standard-col">Local Clay Bricks (Quality Tested Bricks)</td>
                <td class="premium-col">Fly Ash Bricks</td>
                <td class="luxury-col">
                    AAC Blocks (Siporex, Magicrete, Bigbloc Construction Ltd-NXT)
                </td>
            </tr>

            <tr>
                <td class="material-name"><span><img src="{{ asset('images/coreandshell/5.png') }}" alt="Steel"> Sand</span></td>
                <td class="standard-col">As Standard</td>
                <td class="premium-col">As Standard</td>
                <td class="luxury-col">As Standard</td>
            </tr>

            <tr>
                <td class="material-name"><span><img src="{{ asset('images/coreandshell/4.png') }}" alt="Steel"> Aggregate (Metal)</span></td>
                <td class="standard-col">As Standard</td>
                <td class="premium-col">As Standard</td>
                <td class="luxury-col">As Standard</td>
            </tr>

            <tr>
                <td class="material-name"><span><img src="{{ asset('images/coreandshell/3.png') }}" alt="Steel"> Waterproofing</span></td>
                <td class="standard-col">
                    Paintopaints, Sakshichem, Urja polymers, Highbond coatings
                </td>
                <td class="premium-col">Dr. Fixit, Fosroc</td>
                <td class="luxury-col">
                    BASF/Sikatop 551 seal, Dr Fixit Fastflex, Fosroc brushbond Fx
                </td>
            </tr>

            <tr>
                <td class="material-name"><span><img src="{{ asset('images/coreandshell/2.png') }}" alt="Steel"> Anti Termite Chemical</span></td>
                <td class="standard-col">Pidilite, Dr.Fixit</td>
                <td class="premium-col">Pidilite, Dr.Fixit</td>
                <td class="luxury-col">Bayer Premise SC 200</td>
            </tr>

        </table>
    </div>

</section>

<section class="flow-section">
    <h2>CORE & SHELL WORK FLOW CHART</h2>
    <div class="flow-line"></div>
    <p class="flow-subtitle">Step-by-step execution of Core & Shell Construction</p>

    <div class="flow-wrapper">

        <div class="flow-item">
            <div class="step-no">01</div>

            <div class="step-icon">
                <img src="{{ asset('images/coreandshell/8.png') }}" alt="Project Initiation">
            </div>

            <div class="step-content">
                <h4>PROJECT INITIATION</h4>
                <p>Signing of Agreement, Architectural Drawings: 2D Design, 3D Design</p>
            </div>
        </div>

        <div class="arrow">↓</div>

        <div class="flow-item">
            <div class="step-no">02</div>
            <div class="step-icon"> <img src="{{ asset('images/coreandshell/9.png') }}" alt="Project Initiation"></div>
            <div class="step-content">
                <h4>MOBILIZATION</h4>
                <p>Site Settlement, Labour Setup, Site Office (if any), Material Procured</p>
            </div>
        </div>

        <div class="arrow">↓</div>

        <div class="flow-item">
            <div class="step-no">03</div>
            <div class="step-icon"> <img src="{{ asset('images/coreandshell/10.png') }}" alt="Project Initiation"></div>
            <div class="step-content">
                <h4>EXCAVATION</h4>
                <p>Site Clearing, Layout Marking, Excavation Work</p>
            </div>
        </div>

        <div class="arrow">↓</div>

        <div class="flow-item">
            <div class="step-no">04</div>
            <div class="step-icon"> <img src="{{ asset('images/coreandshell/11.png') }}" alt="Project Initiation"></div>
            <div class="step-content">
                <h4>FOUNDATION STAGE</h4>
                <p>Foundation, Footing, PCC, Plinth Beam, Filling Completed</p>
            </div>
        </div>

        <div class="arrow">↓</div>

        <div class="flow-item">
            <div class="step-no">05</div>
            <div class="step-icon"> <img src="{{ asset('images/coreandshell/12.png') }}" alt="Project Initiation"></div>
            <div class="step-content">
                <h4>GROUND FLOOR STRUCTURE</h4>
                <p>Columns, Slab Shuttering, Concreting of Ground Floor</p>
            </div>
        </div>

        <div class="arrow">↓</div>

        <div class="flow-item">
            <div class="step-no">06</div>
            <div class="step-icon"> <img src="{{ asset('images/coreandshell/13.png') }}" alt="Project Initiation"></div>
            <div class="step-content">
                <h4>1ST FLOOR STRUCTURE</h4>
                <p>Columns, Slab Shuttering, Concreting of 1st Floor</p>
            </div>
        </div>

        <div class="arrow">↓</div>

        <div class="flow-item">
            <div class="step-no">07</div>
            <div class="step-icon"> <img src="{{ asset('images/coreandshell/14.png') }}" alt="Project Initiation"></div>
            <div class="step-content">
                <h4>ADDITIONAL FLOORS AS PER DESIGN</h4>
            </div>
        </div>

        <div class="arrow">↓</div>

        <div class="flow-item">
            <div class="step-no">08</div>
            <div class="step-icon"> <img src="{{ asset('images/coreandshell/15.png') }}" alt="Project Initiation"></div>
            <div class="step-content">
                <h4>BRICKWORK & PLASTERING</h4>
                <p>Masonry Walls, Internal & External Plaster, Lintel Works</p>
            </div>
        </div>

        <div class="arrow">↓</div>

        <div class="flow-item">
            <div class="step-no">09</div>
            <div class="step-icon"> <img src="{{ asset('images/coreandshell/16.png') }}" alt="Project Initiation"></div>
            <div class="step-content">
                <h4>WATERPROOFING & FLOORING</h4>
                <p>Roof Waterproofing, Floor Tiling, Skirting</p>
            </div>
        </div>

    </div>

    <div class="contact-box">
        <p>If you want to make customization, then you can click this contact form.</p>
        <a href="#" class="contact-btn">Contact Form</a>
    </div>
</section>
<script>
document.querySelectorAll('.package-click').forEach(function(item) {
    item.addEventListener('click', function() {
        let packageName = this.dataset.package;
        let table = document.getElementById('materialTable');

        table.classList.remove('active-standard', 'active-premium', 'active-luxury');
        table.classList.add('active-' + packageName);
    });
});


</script>
<script>
document.getElementById('citySelect').addEventListener('change', function () {
    let city = this.value;
    let currentPackage = "{{ $package }}";

    window.location.href = "{{ url('/package-material') }}/" + city + "/" + currentPackage;
});
</script>
@endsection