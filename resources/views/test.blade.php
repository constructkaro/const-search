<!DOCTYPE html>
<html>
<head>
<title>LocationIQ Map (Final Working)</title>
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

.address-box { font-size: 14px; margin-bottom: 10px; }

.suggestions {
    max-height: 200px;
    overflow-y: auto;
}

.suggestion {
    padding: 10px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
}

.suggestion:hover { background: #f1f5f9; }
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
const API_KEY = "pk.6197f43f0d700a7a395b3f88f31537d3"; // 🔴 PUT YOUR KEY HERE

let map = L.map('map').setView([20, 78], 5);
let marker;

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap'
}).addTo(map);

// 📍 GET LOCATION
function getLocation() {
    navigator.geolocation.getCurrentPosition(async (pos) => {

        const lat = pos.coords.latitude;
        const lon = pos.coords.longitude;

        map.setView([lat, lon], 17);

        if (marker) map.removeLayer(marker);
        marker = L.marker([lat, lon]).addTo(map);

        try {
            // 🔥 CORRECT API URL
            const res = await fetch(
                `https://api.locationiq.com/v1/reverse?key=${API_KEY}&lat=${lat}&lon=${lon}&format=json`
            );

            if (!res.ok) {
                throw new Error("API Error: " + res.status);
            }

            const data = await res.json();

            const address = formatAddress(data.address, data.display_name);

            // popup
            marker.bindPopup(`
                <b>${address}</b><br>
                Lat: ${lat}<br>
                Lng: ${lon}
            `).openPopup();

            document.getElementById("mainAddress").innerHTML =
                `<b>Main Address:</b><br>${address}`;

            // 🔥 SEARCH OPTIONS
            loadSuggestions(lat, lon);

        } catch (error) {
            console.error(error);

            // fallback
            marker.bindPopup("Address not found").openPopup();
            document.getElementById("mainAddress").innerHTML =
                "<b>Error:</b> Failed to fetch address";
        }

    });
}

// 🔥 FORMAT ADDRESS SAFELY
function formatAddress(a, fallback) {

    if (!a) return fallback || "Address not available";

    const area =
        a.suburb ||
        a.neighbourhood ||
        a.residential ||
        "";

    const city =
        a.city ||
        a.town ||
        a.village ||
        "";

    const state = a.state || "";
    const country = a.country || "India";

    return (
        [area, city, state, country].filter(Boolean).join(", ") ||
        fallback
    );
}

// 🔥 LOAD SUGGESTIONS
async function loadSuggestions(lat, lon) {
    try {
        const res = await fetch(
            `https://api.locationiq.com/v1/search?key=${API_KEY}&q=${lat},${lon}&format=json`
        );

        if (!res.ok) return;

        const list = await res.json();

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

    } catch (e) {
        console.log("Suggestion error");
    }
}
</script>

</body>
</html>