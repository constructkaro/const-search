<style>
.vendor-footer,
.vendor-footer * {
    box-sizing: border-box;
}

.vendor-footer {
    margin-top: 26px;
    background: linear-gradient(110deg, #101829, #1c2d3b);
    color: #f5f5f5;
    font-family: 'Inter', Arial, sans-serif;
}

.vendor-footer-container {
    position: relative;
    width: 92%;
    max-width: 1600px;
    margin: 0 auto;
    padding: 52px 0 20px;
}

.vendor-footer-social {
    position: absolute;
    top: -26px;
    left: 0;
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 7px 12px;
    border: 1px solid #668299;
    border-radius: 14px;
    background: linear-gradient(100deg, #2176bb, #f47721);
}

.vendor-footer-social > * {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #fff;
    color: #243544;
    font-size: 25px;
    text-decoration: none;
}

.vendor-footer-grid {
    display: grid;
    grid-template-columns: 280px minmax(0, 1fr) 165px;
    align-items: start;
    gap: 40px;
}

.vendor-footer-brand > a {
    display: block;
    width: 280px;
    max-width: 100%;
}

.vendor-footer-brand img {
    display: block;
    width: 280px;
    max-width: 100%;
    height: 100px;
    object-fit: cover;
    margin-left: -28px;
}

.vendor-footer-brand p {
    margin: 0;
    color: #e1e4e8;
    font-size: 16px;
    line-height: 1.4;
}

.vendor-footer-nav {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 18px 30px;
    padding-top: 29px;
}

.vendor-footer-nav > a,
.vendor-footer-contact h3 {
    margin: 0;
    color: #fff;
    font-size: clamp(18px, 1.45vw, 24px);
    font-weight: 700;
    line-height: 1.4;
    text-decoration: none;
}

.vendor-footer-legal {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 5px;
    font-size: clamp(14px, 1.15vw, 20px);
    line-height: 1.5;
}

.vendor-footer-legal a {
    color: inherit;
    text-decoration: none;
}

.vendor-footer-contact {
    padding-top: 29px;
}

.vendor-footer-contact a {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 4px;
    color: #d0d6dd;
    font-size: 14px;
    line-height: 1.6;
    text-decoration: none;
    white-space: nowrap;
}

.vendor-footer a:hover {
    color: #f7941d;
}

.vendor-footer a:focus-visible {
    outline: 2px solid #f7941d;
    outline-offset: 4px;
}

.vendor-footer-copyright {
    margin: 24px 0 0;
    padding-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, .45);
    text-align: center;
    color: #e1e4e8;
    font-size: 18px;
    line-height: 1.5;
}

@media (max-width: 1100px) {
    .vendor-footer-grid {
        grid-template-columns: 240px minmax(0, 1fr);
        gap: 24px;
    }

    .vendor-footer-contact {
        grid-column: 2;
        padding-top: 0;
    }
}

@media (max-width: 640px) {
    .vendor-footer-container {
        padding-top: 48px;
    }

    .vendor-footer-grid {
        grid-template-columns: minmax(0, 1fr);
        gap: 24px;
    }

    .vendor-footer-nav,
    .vendor-footer-contact {
        padding-top: 0;
    }

    .vendor-footer-contact {
        grid-column: auto;
    }

    .vendor-footer-nav {
        gap: 16px 24px;
    }

    .vendor-footer-legal {
        width: 100%;
    }

    .vendor-footer-copyright {
        font-size: 14px;
    }
}
</style>

<footer class="vendor-footer">
    <div class="vendor-footer-container">
        <div class="vendor-footer-social" aria-label="Social media">
            <span role="img" aria-label="Facebook"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></span>
            <span role="img" aria-label="Instagram"><i class="fa-brands fa-instagram" aria-hidden="true"></i></span>
            <span role="img" aria-label="LinkedIn"><i class="fa-brands fa-linkedin" aria-hidden="true"></i></span>
            <a href="https://wa.me/917385882657" aria-label="Chat with ConstructKaro on WhatsApp"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i></a>
        </div>

        <div class="vendor-footer-grid">
            <div class="vendor-footer-brand">
                <a href="{{ route('vendor') }}" aria-label="ConstructKaro vendor home">
                    <img src="{{ asset('images/logo.png') }}" alt="ConstructKaro" width="280" height="100" loading="lazy" decoding="async">
                </a>
                <p>Connecting Construction<br>Professionals with Real Opportunities.</p>
            </div>

            <nav class="vendor-footer-nav" aria-label="Footer navigation">
                <a href="{{ route('aboutus') }}">About</a>
                <a href="{{ route('vendor') }}#who-can-join">Who Can Join</a>
                <a href="{{ route('vendor') }}#how-it-works">How It Works</a>
                <a href="{{ route('vendor') }}#faq">FAQ</a>
                <div class="vendor-footer-legal">
                    <a href="{{ route('privacy.policy') }}">Privacy Policy</a>
                    <span aria-hidden="true">|</span>
                    <span>Terms &amp; Conditions</span>
                </div>
            </nav>

            <div class="vendor-footer-contact">
                <h3>Contact</h3>
                <a href="tel:+917385882657"><i class="fa-solid fa-phone" aria-hidden="true"></i> +91 73858 82657</a>
            </div>
        </div>

        <p class="vendor-footer-copyright">&copy; {{ date('Y') }} ConstructKaro. All rights reserved.</p>
    </div>
</footer>
