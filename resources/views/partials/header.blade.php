<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Segoe UI", sans-serif;
}

.header {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 9998;
    width: 100%;
    height: 76px;
    background: #f5f5f5;
    padding: 0 20px;
    display: flex;
    align-items: center;
    box-shadow: 0 4px 14px rgba(0,0,0,0.08);
}

body {
    padding-top: 76px;
}

.container {
    width: 100%;
    max-width: 1320px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    gap: 24px;
}

.logo img {
    width: 200px;
    max-height: 90px;
    object-fit: contain;
    display: block;
}

.location {
    display: flex;
    align-items: center;
    background: #e9e9e9;
    padding: 6px 12px;
    border-radius: 20px;
    gap: 6px;
    flex-shrink: 0;
    margin-left: auto;
    cursor: pointer;
}

.location svg {
    width: 28px;
    height: 28px;
}

#selectedLocationText {
    font-size: 14px;
    color: #333;
    max-width: 190px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.nav {
    display: flex;
    align-items: center;
    gap: 25px;
    margin-left: 0;
}

.nav a {
    text-decoration: none;
    color: #555;
    font-size: 15px;
    position: relative;
    white-space: nowrap;
}

.nav a.active {
    color: #007bff;
    font-weight: 600;
}

.nav a.active::after {
    content: "";
    position: absolute;
    width: 100%;
    height: 2px;
    background: orange;
    bottom: -6px;
    left: 0;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-shrink: 0;
}

.header-login-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 150px;
    height: 44px;
    padding: 0 20px;
    border-radius: 999px;
    text-decoration: none;
    color: #fff;
    font-size: 14px;
    font-weight: 700;
    background: linear-gradient(180deg, #f08b39 0%, #df7122 100%);
    box-shadow: 0 6px 14px rgba(223, 113, 34, 0.22);
    white-space: nowrap;
}

.customer-dropdown-wrap {
    position: relative;
}

.customer-profile-btn {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    border: none;
    background: #1c2c3e;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.customer-profile-btn svg {
    width: 22px;
    height: 22px;
}

.customer-dropdown-menu {
    position: absolute;
    right: 0;
    top: 52px;
    width: 170px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 12px 35px rgba(0,0,0,0.15);
    padding: 8px;
    display: none;
    z-index: 9999;
}

.customer-dropdown-menu.show {
    display: block;
}

.customer-dropdown-menu a,
.customer-dropdown-menu button {
    width: 100%;
    display: block;
    padding: 10px 12px;
    border: none;
    background: transparent;
    text-align: left;
    text-decoration: none;
    color: #333;
    font-size: 14px;
    cursor: pointer;
    border-radius: 8px;
}

.customer-dropdown-menu a:hover,
.customer-dropdown-menu button:hover {
    background: #f5f5f5;
}

.menu-toggle {
    width: 42px;
    height: 42px;
    border: none;
    background: #fff;
    color: #1c2c3e;
    border-radius: 50%;
    display: none;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.menu-toggle svg {
    width: 24px;
    height: 24px;
}

/* Location Modal */
.location-modal {
    display: none;
    position: fixed;
    z-index: 10000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100vh;
    background: rgba(0,0,0,0.55);
}

.location-modal-content {
    background: #fff;
    width: 460px;
    max-width: 92%;
    margin: 110px auto;
    padding: 25px;
    border-radius: 16px;
    position: relative;
    box-shadow: 0 20px 50px rgba(0,0,0,0.25);
}

.location-modal-content h3 {
    font-size: 22px;
    color: #1c2c3e;
    margin-bottom: 8px;
}

.location-modal-content small {
    color: #666;
}

.close-location-modal {
    position: absolute;
    right: 18px;
    top: 12px;
    font-size: 30px;
    cursor: pointer;
    color: #333;
}

.location-input {
    width: 100%;
    padding: 13px 15px;
    border: 1px solid #ddd;
    border-radius: 10px;
    margin-top: 18px;
    font-size: 15px;
    outline: none;
}

.location-input:focus {
    border-color: #E87124;
}

.location-suggestions {
    margin-top: 10px;
    max-height: 260px;
    overflow-y: auto;
    border-radius: 10px;
    border: 1px solid #eee;
    display: none;
}

.location-suggestion-item {
    padding: 12px 14px;
    cursor: pointer;
    border-bottom: 1px solid #f1f1f1;
    font-size: 14px;
    color: #333;
}

.location-suggestion-item:hover {
    background: #fff4ec;
}

.location-suggestion-item:last-child {
    border-bottom: none;
}

#locationMessage {
    margin-top: 15px;
    font-weight: 600;
    font-size: 14px;
}

/* Coming Soon Box */
#comingSoonLocationBox {
    display: none;
    max-width: 1100px;
    margin: 40px auto;
    padding: 35px 20px;
    background: #fff4ec;
    border: 1px solid #ffd6bd;
    border-radius: 18px;
    text-align: center;
}

#comingSoonLocationBox h2 {
    color: #1c2c3e;
    font-size: 28px;
    margin-bottom: 10px;
}

#comingSoonLocationBox p {
    color: #555;
    font-size: 16px;
}

@media (max-width: 991px) {
    .header {
        height: auto;
        min-height: 76px;
        padding: 10px 16px;
    }

    .container {
        flex-wrap: wrap;
    }

    .nav {
        width: 100%;
        order: 5;
        display: none;
        flex-direction: column;
        align-items: flex-start;
        gap: 14px;
        padding: 15px 0 5px;
        margin-left: 0;
    }

    .nav.show {
        display: flex;
    }

    .menu-toggle {
        display: flex;
    }

    .location {
        order: 4;
        width: 100%;
        margin-left: 0;
        justify-content: center;
    }

    .logo img {
        width: 140px;
        max-height: 54px;
    }
}

@media (max-width: 576px) {
    .header-login-btn {
        min-width: auto;
        height: 40px;
        padding: 0 14px;
        font-size: 13px;
    }

    .logo img {
        width: 125px;
        max-height: 50px;
    }

    .location-modal-content {
        margin: 90px auto;
    }
}
</style>

<header class="header">
    <div class="container">

        <div class="logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="ConstructKaro">
            </a>
        </div>

        <div class="location" id="openLocationModal">
            <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <path d="M9.19193 10.6396C9.43138 10.5147 9.7131 9.75879 9.87955 9.50504C10.0567 9.23492 10.2161 8.95172 10.4102 8.67731C10.4546 8.61449 10.6595 8.2018 10.7326 8.11485C10.9685 8.11844 10.8515 7.83301 10.9983 7.71606C11.1119 7.62563 11.2802 7.47727 11.4043 7.35512C12.4699 6.30629 13.6714 5.33907 15.0069 4.6575C15.471 4.425 16.3142 4.18047 16.8244 4.03203C17.0568 3.96446 17.3756 3.7153 17.5172 3.7099C18.4051 3.67605 19.463 3.56207 20.3435 3.6022C21.2852 3.64513 21.7369 3.70787 22.6754 3.63485C23.5683 3.81198 24.571 4.16383 25.3765 4.58457C26.7009 5.27637 28.6089 6.86114 29.4266 8.08957C31.2526 10.8327 32.041 13.911 31.3781 17.1736C30.6121 20.9433 28.772 24.2545 26.7491 27.4782C26.3429 28.1257 25.9728 28.7896 25.5428 29.4229C25.0572 30.1381 24.4962 30.8014 24.0059 31.517C23.4609 32.3125 21.5086 35.0912 20.7765 35.5673C20.4664 35.7689 20.0267 35.8008 19.6724 35.725C19.3763 35.6617 19.1104 35.4839 18.8924 35.2789C18.5848 34.9898 18.3241 34.6389 18.0569 34.3124C17.177 33.2374 16.4047 32.1077 15.6036 30.9755C15.0828 30.2397 14.5181 29.5582 14.0361 28.7924C11.4529 24.6875 8.26064 19.5643 8.40408 14.5613C8.42131 13.9592 8.45638 13.3565 8.59068 12.7676C8.7456 12.0882 8.8722 11.2598 9.19193 10.6396ZM15.9272 14.2896C15.6339 14.9098 15.5237 15.2597 15.8699 15.8888C15.9387 16.0138 15.8887 16.1545 16.0603 16.2542C16.6946 18.247 18.7172 19.4522 20.7717 19.0615C22.8261 18.6709 24.2653 16.8075 24.1238 14.7209C23.9824 12.6345 22.3051 10.9822 20.2167 10.8723C18.1283 10.7624 16.2868 12.2295 15.9272 14.2896Z" fill="#E87124"/>
                </svg>
            </span>

            <span id="selectedLocationText">Select Location</span>
        </div>

        <nav class="nav" id="mainNav">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="{{ route('aboutus') }}" class="{{ request()->routeIs('aboutus') ? 'active' : '' }}">About Us</a>
            <a href="{{ route('knowledgehub') }}" class="{{ request()->routeIs('knowledgehub') ? 'active' : '' }}">Knowledge Hub</a>
        </nav>

        <div class="header-right">
            @if(session('customer_logged_in'))

                <div class="customer-dropdown-wrap">
                    <button type="button" class="customer-profile-btn" id="customerProfileBtn">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5zm0 2c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z"/>
                        </svg>
                    </button>

                    <div class="customer-dropdown-menu" id="customerDropdownMenu">
                        <a href="{{ route('myorder') }}">My Orders</a>
                        <a href="#">My Profile</a>

                        <form method="GET" action="{{ route('customer.logout') }}">
                            <button type="submit">Log Out</button>
                        </form>
                    </div>
                </div>

            @else
                <a href="javascript:void(0)" class="header-login-btn open-customer-login-modal">
                    Login / Sign Up
                </a>
            @endif

            <button class="menu-toggle" id="menuToggleBtn" type="button">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                    <path d="M4 7H20"></path>
                    <path d="M4 12H20"></path>
                    <path d="M4 17H20"></path>
                </svg>
            </button>
        </div>

    </div>
</header>

<div id="locationModal" class="location-modal">
    <div class="location-modal-content">
        <span class="close-location-modal" id="closeLocationModal">&times;</span>

        <h3>Select Your Location</h3>
        <small>Search your area, city or pincode</small>

        <input
            type="text"
            id="locationInput"
            placeholder="Example: Kharghar, Navi Mumbai or 410210"
            class="location-input"
            autocomplete="off"
        >

        <div id="locationSuggestions" class="location-suggestions"></div>

        <p id="locationMessage"></p>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const GEOAPIFY_KEY = "1481c05ac010419380c8f5d347103d42";

    const openLocationModal = document.getElementById("openLocationModal");
    const locationModal = document.getElementById("locationModal");
    const closeLocationModal = document.getElementById("closeLocationModal");
    const locationInput = document.getElementById("locationInput");
    const locationSuggestions = document.getElementById("locationSuggestions");
    const locationMessage = document.getElementById("locationMessage");
    const selectedLocationText = document.getElementById("selectedLocationText");

    const mainServicesSection = document.getElementById("mainServicesSection");
    const exploreServicesSection = document.getElementById("exploreServicesSection");
    const comingSoonLocationBox = document.getElementById("comingSoonLocationBox");

    function showServices() {
        if (mainServicesSection) mainServicesSection.style.display = "block";
        if (exploreServicesSection) exploreServicesSection.style.display = "block";
        if (comingSoonLocationBox) comingSoonLocationBox.style.display = "none";
    }

    function showComingSoon() {
        if (mainServicesSection) mainServicesSection.style.display = "none";
        if (exploreServicesSection) exploreServicesSection.style.display = "none";
        if (comingSoonLocationBox) comingSoonLocationBox.style.display = "block";
    }

    function hideBothSections() {
        if (mainServicesSection) mainServicesSection.style.display = "none";
        if (exploreServicesSection) exploreServicesSection.style.display = "none";
        if (comingSoonLocationBox) comingSoonLocationBox.style.display = "none";
    }

    hideBothSections();

    const savedLocation = localStorage.getItem("selected_location_text");
    const savedLocationAllowed = localStorage.getItem("location_allowed");

    if (savedLocation) {
        selectedLocationText.innerText = savedLocation;

        if (savedLocationAllowed === "yes") {
            showServices();
        } else if (savedLocationAllowed === "no") {
            showComingSoon();
        }
    } else {
        showServices();
    }

    openLocationModal.addEventListener("click", function () {
        locationModal.style.display = "block";
        locationInput.focus();
    });

    closeLocationModal.addEventListener("click", function () {
        locationModal.style.display = "none";
    });

    window.addEventListener("click", function (e) {
        if (e.target === locationModal) {
            locationModal.style.display = "none";
        }
    });

    let typingTimer = null;

    locationInput.addEventListener("input", function () {
        const search = this.value.trim();

        locationMessage.innerHTML = "";
        locationSuggestions.innerHTML = "";
        locationSuggestions.style.display = "none";

        clearTimeout(typingTimer);

        if (search.length < 3) {
            return;
        }

        typingTimer = setTimeout(function () {
            fetchGeoapifySuggestions(search);
        }, 450);
    });

    function fetchGeoapifySuggestions(search) {
        locationMessage.style.color = "#555";
        locationMessage.innerHTML = "Searching location...";

        const url = `https://api.geoapify.com/v1/geocode/autocomplete?text=${encodeURIComponent(search)}&filter=countrycode:in&limit=8&apiKey=${GEOAPIFY_KEY}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                locationMessage.innerHTML = "";

                if (!data.features || data.features.length === 0) {
                    locationMessage.style.color = "red";
                    locationMessage.innerHTML = "No location found.";
                    return;
                }

                locationSuggestions.innerHTML = "";
                locationSuggestions.style.display = "block";

                data.features.forEach(function (feature) {
                    const props = feature.properties;

                    const displayAddress = props.formatted || props.address_line1 || "Location";
                    const area = props.suburb || props.district || props.city || props.county || "";
                    const city = props.city || props.county || props.state_district || "";
                    const pincode = props.postcode || "";

                    const item = document.createElement("div");
                    item.className = "location-suggestion-item";

                    item.innerHTML = `
                        <strong>${displayAddress}</strong><br>
                        <small>${pincode ? "Pincode: " + pincode : ""}</small>
                    `;

                    item.addEventListener("click", function () {
                        locationInput.value = displayAddress;
                        locationSuggestions.style.display = "none";

                        checkLocationInDatabase(area, city, pincode, displayAddress);
                    });

                    locationSuggestions.appendChild(item);
                });
            })
            .catch(error => {
                console.error(error);
                locationMessage.style.color = "red";
                locationMessage.innerHTML = "Location search failed. Please try again.";
            });
    }

    function checkLocationInDatabase(area, city, pincode, fullAddress) {
        locationMessage.style.color = "#555";
        locationMessage.innerHTML = "Checking service availability...";

        fetch("{{ route('check.service.location') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                area: area,
                city: city,
                pincode: pincode
            })
        })
        .then(response => response.json())
        .then(data => {

            if (data.status === true) {
                const finalText = data.location.area_name + ", " + data.location.city_name;

                locationMessage.style.color = "green";
                locationMessage.innerHTML = "Service available in your location.";

                selectedLocationText.innerText = finalText;

                localStorage.setItem("selected_location_text", finalText);
                localStorage.setItem("location_allowed", "yes");

                showServices();

                setTimeout(function () {
                    locationModal.style.display = "none";
                }, 700);

            } else {
                selectedLocationText.innerText = fullAddress;

                locationMessage.style.color = "red";
                locationMessage.innerHTML = "Sorry, service is not available in this location.";

                localStorage.setItem("selected_location_text", fullAddress);
                localStorage.setItem("location_allowed", "no");

                showComingSoon();

                setTimeout(function () {
                    locationModal.style.display = "none";
                }, 1000);
            }
        })
        .catch(error => {
            console.error(error);
            locationMessage.style.color = "red";
            locationMessage.innerHTML = "Something went wrong. Please try again.";
        });
    }

    const profileBtn = document.getElementById("customerProfileBtn");
    const dropdownMenu = document.getElementById("customerDropdownMenu");
    const menuToggleBtn = document.getElementById("menuToggleBtn");
    const mainNav = document.getElementById("mainNav");

    if (profileBtn && dropdownMenu) {
        profileBtn.addEventListener("click", function (e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle("show");
        });

        document.addEventListener("click", function () {
            dropdownMenu.classList.remove("show");
        });
    }

    if (menuToggleBtn && mainNav) {
        menuToggleBtn.addEventListener("click", function () {
            mainNav.classList.toggle("show");
        });
    }
});
</script>
