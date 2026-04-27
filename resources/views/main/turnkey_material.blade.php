@extends('layouts.app')

@section('title', 'tuncky Material Specification')

@section('content')

<style>
.material-section {
    padding: 20px 30px 50px;
    background: #fff;
    font-family: 'Poppins', sans-serif;
    text-align: center;
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
    background: #f37021;
    color: #fff;
    border-color: #f37021;
}

.material-section h2 {
    font-size: 30px;
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
    width: 1000px;
    max-width: 100%;
    margin: auto;
    border-collapse: separate;
    border-spacing: 0;
}

.material-table th,
.material-table td {
    border: 2px solid #fff;
    padding: 13px 12px;
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
    width: 230px;
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
    width: 250px;
}

.premium-col {
    background: #ffc49d;
    width: 250px;
}

.luxury-col {
    background: #c9c9c9;
    width: 250px;
}

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

@media(max-width: 992px) {
    .material-table {
        min-width: 1000px;
    }
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
    margin: 0 auto 10px;
}

.flow-subtitle {
    font-size: 15px;
    font-weight: 700;
    color: #555;
    margin-bottom: 35px;
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
}

.step-icon {
    width: 55px;
    background: #1f73b7;
    display: flex;
    align-items: center;
    justify-content: center;
}

.step-icon img {
    width: 53px;
    height: 56px;
    object-fit: contain;
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
        <button type="button" onclick="goCoreShell()">CORE & SHELL</button>
        <button type="button" class="active">tuncky</button>
    </div>
</div>

<section class="material-section">

    <h2>tuncky MATERIAL SPECIFICATION</h2>
    <div class="title-line"></div>
    <h5>(Finishing + Interior + Services Work)</h5>

    <div class="table-wrap">
        <table class="material-table active-{{ $package }}">

            <tr class="check-row">
                <th class="blank"></th>
                <th class="standard-col"><span class="check-circle">✓</span></th>
                <th class="premium-col"><span class="check-circle">✓</span></th>
                <th class="luxury-col"><span class="check-circle">✓</span></th>
            </tr>

            <tr>
                <th class="material-head">Material</th>
                <th class="standard-col">Standard</th>
                <th class="premium-col">Premium</th>
                <th class="luxury-col">Luxury</th>
            </tr>

            <tr>
                <td class="material-name"><span><img src="{{ asset('images/tuncky/1.png') }}" alt="">Tiles (Flooring)</span></td>
                <td class="standard-col">Alfanso, Allencera*</td>
                <td class="premium-col">Kajaria Tiles, Somany Tiles*</td>
                <td class="luxury-col">Nitco Tiles, Johnson Tiles*</td>
            </tr>

            <tr>
                <td class="material-name"><span><img src="{{ asset('images/tuncky/2.png') }}" alt="">Sanitary Ware</span></td>
                <td class="standard-col">Cera, Hindware*</td>
                <td class="premium-col">Parryware*</td>
                <td class="luxury-col">Jaquar, Kohler, TOTO*</td>
            </tr>

            <tr>
                <td class="material-name"><span><img src="{{ asset('images/tuncky/3.png') }}" alt="">CP Fittings</span></td>
                <td class="standard-col">Cera Sanitaryware / Parryware*</td>
                <td class="premium-col">Ess Ess, Hindware*</td>
                <td class="luxury-col">Jaquar, Grohe*</td>
            </tr>

            <tr>
                <td class="material-name"><span><img src="{{ asset('images/tuncky/4.png') }}" alt="">Electrical Wires</span></td>
                <td class="standard-col">Local Brands (ISI Marked)</td>
                <td class="premium-col">Finolex, Polycab</td>
                <td class="luxury-col">Havells, RR Kabel</td>
            </tr>

            <tr>
                <td class="material-name"><span><img src="{{ asset('images/tuncky/switch.png') }}" alt="">Switches</span></td>
                <td class="standard-col">Local Brands</td>
                <td class="premium-col">Anchor (Panasonic), GM</td>
                <td class="luxury-col">Legrand, Schneider Electric</td>
            </tr>

            <tr>
                <td class="material-name"><span><img src="{{ asset('images/tuncky/5.png') }}" alt="">Paints</span></td>
                <td class="standard-col">Snowcem Paints</td>
                <td class="premium-col">Adani paints, Birla Opus</td>
                <td class="luxury-col">Asian Paints, Nerolac, Berger Paints, Dulux</td>
            </tr>

            <tr>
                <td class="material-name"><span><img src="{{ asset('images/tuncky/6.png') }}" alt="">Wooden Main Door + Plywood</span></td>
                <td class="standard-col">ISI Approved Flush Door, Local Solid Wood Door + Local ISI Plywood</td>
                <td class="premium-col">Veneer Finish Door + Century, Greenply Plywood</td>
                <td class="luxury-col">Premium Laminated, Veneer Finish Doors + royal touche plywood</td>
            </tr>

            <tr>
                <td class="material-name"><span><img src="{{ asset('images/tuncky/7.png') }}" alt="">Wooden Internal Doors + Plywood</span></td>
                <td class="standard-col">ISI Approved Flush Doors + Local ISI Plywood</td>
                <td class="premium-col">Laminated Flush Doors + Century, Greenply Plywood</td>
                <td class="luxury-col">Premium Laminated, Veneer Finish Doors + royal touche plywood</td>
            </tr>

            <tr>
                <td class="material-name"><span><img src="{{ asset('images/tuncky/8.png') }}" alt="">Windows</span></td>
                <td class="standard-col">Jindal</td>
                <td class="premium-col">Fenesta, NCL Veka, SASHY WINDOOR, Yashpoly</td>
                <td class="luxury-col">Schüco, Reynaers</td>
            </tr>

            <tr>
                <td class="material-name"><span><img src="{{ asset('images/tuncky/9.png') }}" alt="">Kitchen Platform</span></td>
                <td class="standard-col">RCC/brick support structure, Kadappa base slab, Granite countertop top finish, Stainless steel sink provision/cutout</td>
                <td class="premium-col">RCC/brick support structure, Kadappa base slab, Granite countertop top finish, Stainless steel sink provision/cutout</td>
                <td class="luxury-col">Granite/quartz countertop, Sink & faucet, Overhead cabinets, Chimney provision, Hob provision, RCC/brick support structure, Kadappa base slab, Stainless steel sink provision/cutout</td>
            </tr>

        </table>
    </div>

</section>
<section class="flow-section">
    <h2>TURNKEY CONSTRUCTION FLOW CHART</h2>
    <div class="flow-line"></div>
    <p class="flow-subtitle">
        Step-by-step execution of complete Turnkey Project<br>
        (Design to Handover)
    </p>

    <div class="flow-wrapper">

        @php
            $steps = [
                ['01','10.png','PROJECT INITIATION','Requirement discussion, budget finalization, agreement signing, and 2D/3D design.'],
                ['02','11.png','DESIGN & PLANNING','Detailed architectural & structural design, electrical/plumbing layouts, and required approvals.'],
                ['03','12.png','MOBILIZATION','Site setup & fencing, labour and contractor arrangement, temporary utilities, and material planning.'],
                ['04','13.png','EXCAVATION','Site Clearing, Layout Marking, Excavation Work'],
                ['05','14.png','FOUNDATION STAGE','Foundation, Footing, PCC, Plinth Beam, Filling Completed'],
                ['06','15.png','STRUCTURE WORK','Columns & slabs, beam work, and floor-wise structural completion.'],
                ['07','16.png','BRICKWORK & PLASTERING','Internal & external walls, lintel/block work, and internal & external plaster.'],
                ['08','0.png','MEP WORKS (SERVICES)','Electrical wiring, plumbing lines, drainage system, and HVAC provision.'],
                ['09','17.png','WATERPROOFING','Bathroom & terrace waterproofing with external protection.'],
                ['10','18.png','FLOORING & TILING','Flooring tiles/marble/granite, bathroom & kitchen tiling, and skirting work.'],
                ['11','0.png','DOORS, WINDOWS & CARPENTRY','Door frames & shutters, window installation, and basic carpentry work.'],
                ['12','19.png','PAINTING & FINISHING','Putty, primer & paint, internal/external, plus polish & coating.'],
                ['13','20.png','FIXTURES & INSTALLATIONS','Electrical, sanitary & CP fittings with lighting fixtures.'],
                ['14','21.png','FINAL FINISHING & CLEANING','Touch-ups, deep cleaning, and snag clearance.'],
                ['15','0.png','HANDOVER','Final inspection, client walkthrough, and project handover.'],
            ];
        @endphp

        @foreach($steps as $step)
            <div class="flow-item">
                <div class="step-no">{{ $step[0] }}</div>

                <div class="step-icon">
                    <img src="{{ asset('images/tuncky/'.$step[1]) }}" alt="{{ $step[2] }}">
                </div>

                <div class="step-content">
                    <h4>{{ $step[2] }}</h4>
                    <p>{{ $step[3] }}</p>
                </div>
            </div>

            @if(!$loop->last)
                <div class="arrow">↓</div>
            @endif
        @endforeach

    </div>

    <div class="contact-box">
        <p>If you want to make customization, then you can click this contact form.</p>
        <a href="#" class="contact-btn">Contact Form</a>
    </div>
</section>
<script>
function goCoreShell() {
    let city = document.getElementById('citySelect').value;
    window.location.href = "{{ url('/package-material') }}/" + city + "/{{ $package }}";
}

document.getElementById('citySelect').addEventListener('change', function () {
    let city = this.value;
    window.location.href = "{{ url('/tuncky-material') }}/" + city + "/{{ $package }}";
});
</script>

@endsection