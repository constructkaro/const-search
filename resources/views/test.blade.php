<!DOCTYPE html>
<html>
<head>
<title>Advanced Location Finder (Final)</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<style>
body { margin:0; font-family: Arial; }

#map { height: 100vh; }

.panel {
    position: absolute;
    top: 20px;
    left: 20px;
    width: 320px;
    background: #fff;
    padding: 15px;
    border-radius: 12px;
    z-index: 1000;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

button {
    width: 100%;
    padding: 12px;
    background: #16a34a;
    color: #fff;
    border: none;
    border-radius: 8px;
    margin-bottom: 10px;
    cursor: pointer;
}

.address-box {
    font-size: 14px;
    margin-bottom: 10px;
}

.suggestions {
    max-height: 200px;
    overflow-y: auto;
}

.suggestion {
    padding: 10px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
}

.suggestion:hover {
    background: #f1f5f9;
}
</style>
</head>

<body>

<div class="panel">
    <button onclick="getLocation()">📍 Get My Location</button>

    <div class="address-box" id="mainAddress"></div>

    <div class="suggestions" id="suggestions"></div>
</div>

<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    let map = L.map('map').setView([20, 78], 5);
let marker;

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap'
}).addTo(map);

function getLocation() {
    navigator.geolocation.getCurrentPosition(async (pos) => {

        const lat = pos.coords.latitude;
        const lon = pos.coords.longitude;

        map.setView([lat, lon], 17);

        if (marker) map.removeLayer(marker);
        marker = L.marker([lat, lon]).addTo(map);

        // 🔥 MAIN REVERSE
        const mainRes = await fetch(
            `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}&addressdetails=1`
        );
        const mainData = await mainRes.json();

        // 🔥 NEARBY SEARCH (KEY FIX)
        const nearbyRes = await fetch(
            `https://nominatim.openstreetmap.org/search?format=json&limit=10&q=${lat},${lon}`
        );
        const nearbyData = await nearbyRes.json();

        const bestArea = findBestArea(mainData, nearbyData);

        const finalAddress = buildFinal(bestArea, mainData.address);

        marker.bindPopup(`
            <b>${finalAddress}</b><br>
            Lat: ${lat}<br>
            Lng: ${lon}
        `).openPopup();

        document.getElementById("mainAddress").innerHTML =
            `<b>Main Address:</b><br>${finalAddress}`;

        showSuggestions(nearbyData);

    });
}

// 🔥 FIND BEST AREA
function findBestArea(main, list) {

    // Try main API first
    let a = main.address;

    let area =
        a.suburb ||
        a.neighbourhood ||
        a.residential ||
        "";

    if (area) return area;

    // 🔥 fallback from nearby results
    for (let item of list) {
        let name = item.display_name.split(",")[0];

        if (
            name &&
            name.length > 4 &&
            !name.match(/road|street|india|maharashtra/i)
        ) {
            return name;
        }
    }

    return "";
}

// 🔥 BUILD FINAL ADDRESS
function buildFinal(area, a) {

    const city =
        a.city ||
        a.town ||
        a.village ||
        "";

    const state = a.state || "";
    const country = a.country || "India";

    return [area, city, state, country]
        .filter(Boolean)
        .join(", ");
}

// 🔥 SUGGESTIONS
function showSuggestions(list) {
    const box = document.getElementById("suggestions");
    box.innerHTML = "<b>Other Options:</b>";

    list.slice(0,5).forEach(item => {
        const div = document.createElement("div");
        div.className = "suggestion";
        div.innerText = item.display_name;

        div.onclick = () => {
            marker.bindPopup(`<b>${item.display_name}</b>`).openPopup();
            document.getElementById("mainAddress").innerHTML =
                "<b>Selected:</b><br>" + item.display_name;
        };

        box.appendChild(div);
    });
}
</script>

</body>
</html>