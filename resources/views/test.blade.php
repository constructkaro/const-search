<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proper Current Location</title>
    <style>
        *{
            box-sizing:border-box;
        }
        body{
            margin:0;
            font-family:Arial, sans-serif;
            background:#f5f7fb;
            color:#1c2c3e;
            padding:30px 15px;
        }
        .container{
            max-width:900px;
            margin:0 auto;
        }
        .card{
            background:#fff;
            border-radius:18px;
            padding:30px;
            box-shadow:0 12px 30px rgba(0,0,0,0.08);
        }
        h1{
            margin:0 0 10px;
            font-size:28px;
        }
        p{
            margin:0 0 20px;
            color:#667085;
            line-height:1.6;
        }
        .btn{
            background:#f25c05;
            color:#fff;
            border:none;
            border-radius:10px;
            padding:14px 24px;
            font-size:16px;
            font-weight:600;
            cursor:pointer;
        }
        .btn:hover{
            background:#d94f04;
        }
        .status, .result{
            margin-top:20px;
            padding:16px;
            border-radius:12px;
        }
        .status{
            background:#fff7ed;
            border:1px solid #fed7aa;
            color:#9a3412;
        }
        .result{
            background:#f8fafc;
            border:1px solid #e2e8f0;
            display:none;
        }
        .row{
            margin-bottom:12px;
            line-height:1.7;
        }
        .row strong{
            display:inline-block;
            min-width:180px;
        }
        .field{
            margin-top:20px;
        }
        .field label{
            display:block;
            margin-bottom:8px;
            font-weight:600;
        }
        .field input, .field textarea{
            width:100%;
            border:1px solid #d0d5dd;
            border-radius:10px;
            padding:12px 14px;
            font-size:15px;
            outline:none;
        }
        .field textarea{
            min-height:120px;
            resize:vertical;
        }
        .json-box{
            margin-top:20px;
            background:#111827;
            color:#e5e7eb;
            padding:18px;
            border-radius:12px;
            font-size:14px;
            line-height:1.6;
            white-space:pre-wrap;
            word-break:break-word;
            display:none;
        }
        .actions{
            margin-top:16px;
            display:flex;
            gap:12px;
            flex-wrap:wrap;
        }
        .btn-secondary{
            background:#1c2c3e;
        }
        .btn-secondary:hover{
            background:#162332;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Get Proper Current Location</h1>
            <p>
                Best result comes on mobile with GPS turned on. This will fetch your best current coordinates,
                full location details, and a proper address you can edit before saving.
            </p>

            <button type="button" class="btn" onclick="getProperLocation()">Use Current Location</button>

            <div class="status" id="statusBox">Waiting for location...</div>

            <div class="result" id="resultBox">
                <div class="row"><strong>Latitude:</strong> <span id="showLat">-</span></div>
                <div class="row"><strong>Longitude:</strong> <span id="showLong">-</span></div>
                <div class="row"><strong>Accuracy:</strong> <span id="showAccuracy">-</span></div>
                <div class="row"><strong>Proper Address:</strong> <span id="showAddress">-</span></div>
                <div class="row"><strong>Raw Address:</strong> <span id="showRawAddress">-</span></div>
            </div>

            <div class="field">
                <label for="finalAddress">Editable Final Address</label>
                <input type="text" id="finalAddress" placeholder="Final address will come here">
            </div>

            <div class="field">
                <label for="jsonOutput">Final JSON Object</label>
                <textarea id="jsonOutput" readonly></textarea>
            </div>

            <div class="actions">
                <button type="button" class="btn btn-secondary" onclick="copyAddress()">Copy Address</button>
                <button type="button" class="btn btn-secondary" onclick="copyJson()">Copy JSON</button>
            </div>

            <div class="json-box" id="prettyJsonBox"></div>
        </div>
    </div>

    <script>
        let watchId = null;
        let bestPosition = null;
        let finalLocationObject = null;

        function getProperLocation() {
            const statusBox = document.getElementById("statusBox");
            const resultBox = document.getElementById("resultBox");
            const prettyJsonBox = document.getElementById("prettyJsonBox");
            const jsonOutput = document.getElementById("jsonOutput");

            resultBox.style.display = "none";
            prettyJsonBox.style.display = "none";
            jsonOutput.value = "";
            document.getElementById("finalAddress").value = "";
            finalLocationObject = null;

            if (!navigator.geolocation) {
                statusBox.innerHTML = "Geolocation is not supported by this browser.";
                return;
            }

            statusBox.innerHTML = "Getting accurate current location... please wait 8 to 12 seconds.";
            bestPosition = null;

            watchId = navigator.geolocation.watchPosition(
                function(position) {
                    const accuracy = position.coords.accuracy;

                    if (!bestPosition || accuracy < bestPosition.coords.accuracy) {
                        bestPosition = position;
                    }

                    statusBox.innerHTML = `
                        Improving accuracy...<br>
                        Latitude: ${position.coords.latitude}<br>
                        Longitude: ${position.coords.longitude}<br>
                        Accuracy: ${Math.round(accuracy)} meters
                    `;
                },
                function(error) {
                    let msg = "Location error.";
                    if (error.code === 1) msg = "Location permission denied.";
                    if (error.code === 2) msg = "Location unavailable.";
                    if (error.code === 3) msg = "Location request timed out.";
                    statusBox.innerHTML = msg;
                },
                {
                    enableHighAccuracy: true,
                    timeout: 20000,
                    maximumAge: 0
                }
            );

            setTimeout(async function() {
                if (watchId !== null) {
                    navigator.geolocation.clearWatch(watchId);
                }

                if (!bestPosition) {
                    statusBox.innerHTML = "Unable to get current location.";
                    return;
                }

                await fetchFullLocation(bestPosition);
            }, 10000);
        }

        async function fetchFullLocation(position) {
            const statusBox = document.getElementById("statusBox");
            const resultBox = document.getElementById("resultBox");
            const prettyJsonBox = document.getElementById("prettyJsonBox");
            const jsonOutput = document.getElementById("jsonOutput");

            const lat = position.coords.latitude;
            const long = position.coords.longitude;
            const accuracy = position.coords.accuracy;

            try {
                const response = await fetch(
                    `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${long}&addressdetails=1&zoom=18`
                );

                const osmData = await response.json();
                const a = osmData.address || {};

                const properAddress = buildProperAddress(a, osmData.display_name);
                const cityName = a.city || a.town || a.village || "";
                const stateName = a.state || "";

                finalLocationObject = {
                    city_key: null,
                    cityKey: generateCityKey(cityName, stateName),
                    customerId: "",
                    countryKey: (a.country_code || "in").toUpperCase() === "IN" ? "IND" : (a.country_code || "").toUpperCase(),
                    address: properAddress,
                    homescreenAddress: {
                        ucAddress: {},
                        placeId: "",
                        address: properAddress,
                        formattedAddress: properAddress
                    },
                    locationDetails: {
                        lat: lat,
                        long: long
                    },
                    lat: lat,
                    long: long,
                    placeId: "",
                    visibleBottomTabs: [],
                    pincode: a.postcode || "",
                    accuracy: accuracy,
                    rawDisplayName: osmData.display_name || "",
                    reverseGeocodeData: osmData
                };

                document.getElementById("showLat").innerText = lat;
                document.getElementById("showLong").innerText = long;
                document.getElementById("showAccuracy").innerText = Math.round(accuracy) + " meters";
                document.getElementById("showAddress").innerText = properAddress;
                document.getElementById("showRawAddress").innerText = osmData.display_name || "-";
                document.getElementById("finalAddress").value = properAddress;

                jsonOutput.value = JSON.stringify(finalLocationObject);
                prettyJsonBox.innerText = JSON.stringify(finalLocationObject, null, 4);

                resultBox.style.display = "block";
                prettyJsonBox.style.display = "block";
                statusBox.innerHTML = "Proper location fetched successfully.";
            } catch (error) {
                statusBox.innerHTML = "Failed to fetch full location details.";
                console.error(error);
            }
        }

        function buildProperAddress(addressParts, fallbackDisplayName) {
            const locality =
                addressParts.suburb ||
                addressParts.neighbourhood ||
                addressParts.hamlet ||
                addressParts.quarter ||
                addressParts.residential ||
                addressParts.city_district ||
                "";

            const road = addressParts.road || "";
            const city =
                addressParts.city ||
                addressParts.town ||
                addressParts.village ||
                "";

            const state = addressParts.state || "";
            const postcode = addressParts.postcode || "";
            const country = addressParts.country || "India";

            const parts = [];

            if (road && road !== locality && road !== city) parts.push(road);
            if (locality && locality !== city) parts.push(locality);
            if (city) parts.push(city);
            if (state) parts.push(state);

            let address = parts.join(", ");

            if (postcode) {
                address += (address ? " " : "") + postcode;
            }

            if (country) {
                address += (address ? ", " : "") + country;
            }

            return address || fallbackDisplayName || "";
        }

        function generateCityKey(city, state) {
            const citySlug = slugify(city || "unknown");
            const stateSlug = slugify(state || "unknown");
            return `city_${citySlug}_(${stateSlug})_v2`;
        }

        function slugify(text) {
            return String(text)
                .toLowerCase()
                .trim()
                .replace(/\s+/g, "_")
                .replace(/[^\w_()]/g, "");
        }

        function copyAddress() {
            const value = document.getElementById("finalAddress").value;
            if (!value) return;
            navigator.clipboard.writeText(value);
            alert("Address copied");
        }

        function copyJson() {
            const value = document.getElementById("jsonOutput").value;
            if (!value) return;
            navigator.clipboard.writeText(value);
            alert("JSON copied");
        }
    </script>
</body>
</html>