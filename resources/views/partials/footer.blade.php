<style>
.footer-section {
    position: relative;
    background: linear-gradient(90deg, #071226 0%, #0d1e39 35%, #21364d 100%);
    padding: 56px 0 18px;
    color: #ffffff;
    font-family: 'Poppins', sans-serif;
    overflow: hidden;
}

.footer-section,
.footer-section * {
    box-sizing: border-box;
}

.footer-container {
    width: 92%;
    max-width: 1280px;
    margin: 0 auto;
}

.footer-social-bar {
    position: absolute;
    top: 16px;
    left: 14px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 7px 12px;
    border-radius: 0 12px 12px 0;
    background: linear-gradient(90deg, #1f6fb7 0 76%, #f0822f 76% 100%);
    box-shadow: 0 6px 16px rgba(0,0,0,0.18);
}

.footer-social-bar a,
.footer-social-bar span {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #ffffff;
    color: #445066;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.footer-social-bar svg {
    width: 15px;
    height: 15px;
    display: block;
    fill: currentColor;
}

.footer-social-bar a:hover {
    transform: translateY(-2px);
    color: #f0822f;
}

.footer-social-bar span {
    cursor: default;
}

.footer-grid {
    display: grid;
    grid-template-columns: minmax(280px, 1.7fr) minmax(150px, .8fr) minmax(150px, .9fr) minmax(230px, 1fr);
    gap: 36px;
    align-items: start;
    padding-top: 6px;
}

.footer-brand img {
    width: 190px;
    max-width: 100%;
    height: auto;
    display: block;
    margin-bottom: 18px;
}

.footer-brand p {
    max-width: 470px;
    margin: 0;
    color: rgba(255,255,255,0.88);
    font-size: 15px;
    line-height: 1.35;
}

.footer-col h4 {
    margin: 8px 0 18px;
    font-size: 16px;
    font-weight: 700;
    color: #ffffff;
}

.footer-col ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.footer-col ul li {
    margin-bottom: 16px;
}

.footer-col ul li a {
    color: rgba(255,255,255,0.82);
    text-decoration: none;
    font-size: 15px;
    line-height: 1.4;
    transition: 0.3s ease;
}

.footer-col ul li a:hover {
    color: #f0822f;
    padding-left: 3px;
}

.footer-disabled-link {
    color: rgba(255,255,255,0.58);
    font-size: 15px;
    line-height: 1.4;
}

.footer-contact-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.footer-contact-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    color: rgba(255,255,255,0.82);
    font-size: 15px;
    line-height: 1.5;
    word-break: break-word;
}

.footer-contact-item i {
    width: 16px;
    margin-top: 3px;
    color: rgba(255,255,255,0.8);
    font-size: 14px;
}

.footer-contact-icon {
    width: 16px;
    height: 16px;
    margin-top: 4px;
    color: rgba(255,255,255,0.8);
    flex: 0 0 16px;
}

.footer-contact-icon svg {
    width: 16px;
    height: 16px;
    display: block;
    fill: none;
    stroke: currentColor;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.footer-bottom {
    margin-top: 28px;
    padding-top: 14px;
    border-top: 1px solid rgba(255,255,255,0.35);
    text-align: center;
}

.footer-bottom p {
    margin: 0;
    color: rgba(255,255,255,0.92);
    font-size: 15px;
    font-weight: 500;
}

@media (max-width: 1100px) {
    .footer-grid {
        grid-template-columns: 1fr 1fr;
        gap: 34px 28px;
    }

    .footer-brand p {
        max-width: 100%;
    }
}

@media (max-width: 767px) {
    .footer-section {
        padding: 78px 0 18px;
    }

    .footer-social-bar {
        top: 14px;
        left: 10px;
    }

    .footer-grid {
        grid-template-columns: 1fr;
        gap: 26px;
    }

    .footer-brand img {
        width: 165px;
    }

    .footer-brand p,
    .footer-col ul li a,
    .footer-contact-item,
    .footer-bottom p {
        font-size: 14px;
    }

    .footer-col ul li {
        margin-bottom: 10px;
    }
}
</style>

<footer class="footer-section">
    <div class="footer-social-bar">
        <span aria-label="Facebook">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M14 8.5h3V5h-3.3C10.9 5 9 6.9 9 9.8V12H6v3.6h3V22h4v-6.4h3.1L16.7 12H13V9.9c0-.9.4-1.4 1-1.4Z"/>
            </svg>
        </span>
        <span aria-label="Instagram">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M7.6 2h8.8A5.6 5.6 0 0 1 22 7.6v8.8a5.6 5.6 0 0 1-5.6 5.6H7.6A5.6 5.6 0 0 1 2 16.4V7.6A5.6 5.6 0 0 1 7.6 2Zm4.4 5.3a4.7 4.7 0 1 0 0 9.4 4.7 4.7 0 0 0 0-9.4Zm0 2.5a2.2 2.2 0 1 1 0 4.4 2.2 2.2 0 0 1 0-4.4Zm5-2.6a1.1 1.1 0 1 0 0-2.2 1.1 1.1 0 0 0 0 2.2Z"/>
            </svg>
        </span>
        <span aria-label="LinkedIn">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M4.8 8.8H9V22H4.8V8.8ZM6.9 2A2.4 2.4 0 1 1 7 6.8 2.4 2.4 0 0 1 6.9 2Zm5.4 6.8h4v1.8h.1c.6-1.1 2-2.2 4.1-2.2 4.4 0 5.2 2.9 5.2 6.7V22h-4.2v-6.1c0-1.5 0-3.4-2.1-3.4s-2.4 1.6-2.4 3.3V22h-4.2V8.8Z"/>
            </svg>
        </span>
        <a href="https://wa.me/917385882657" aria-label="WhatsApp">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 2a9.7 9.7 0 0 0-8.3 14.7L2.5 22l5.4-1.4A9.8 9.8 0 1 0 12 2Zm5.4 14.1c-.2.6-1.2 1.1-1.7 1.2-.5.1-1.2.2-3.6-.8-3-1.3-5-4.4-5.2-4.6-.1-.2-1.2-1.6-1.2-3s.8-2.2 1.1-2.5c.2-.3.6-.4.8-.4h.6c.2 0 .5 0 .7.5l.9 2.1c.1.3.1.5 0 .7l-.5.7c-.2.2-.3.4-.1.7.2.3.8 1.3 1.7 2.1 1.2 1.1 2.1 1.4 2.4 1.6.3.1.5.1.7-.1l.9-1.1c.2-.3.5-.2.8-.1l2 .9c.4.2.6.3.7.5 0 .1 0 .6-.2 1.1Z"/>
            </svg>
        </a>
    </div>

    <div class="footer-container">
        <div class="footer-grid">
            <div class="footer-brand">
                <img src="{{ asset('images/logo.png') }}" alt="ConstructKaro Logo" width="190" height="90" loading="lazy" decoding="async">
                <p>
                    Constructkaro is a construction services platform that helps homeowners, businesses, and landowners plan, design, and execute residential, commercial, industrial, and infrastructure projects through verified Constructkaro experts across Mumbai, Navi Mumbai, Pune, Thane, and Raigad.
                </p>
            </div>

            <div class="footer-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="{{ route('aboutus') }}">About Us</a></li>
                    <li><span class="footer-disabled-link">Careers</span></li>
                    <li><a href="{{ route('knowledgehub') }}">Constructshala</a></li>
                    <li><a href="{{ route('welcome') }}#mainServicesSection">Services</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Support</h4>
                <ul>
                    <li><a href="{{ route('helpcenter') }}">Help Center</a></li>
                    <li><span class="footer-disabled-link">Terms &amp; Conditions</span></li>
                    <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contact</h4>
                <div class="footer-contact-list">
                    <div class="footer-contact-item">
                        <span class="footer-contact-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24">
                                <path d="M4 6h16v12H4z"/>
                                <path d="m4 7 8 6 8-6"/>
                            </svg>
                        </span>
                        <span>connect@constructkaro.com</span>
                    </div>
                    <div class="footer-contact-item">
                        <span class="footer-contact-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24">
                                <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1A19.4 19.4 0 0 1 5.2 13 19.8 19.8 0 0 1 2 4.2 2 2 0 0 1 4 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.4 2.1L8.1 9.9a16 16 0 0 0 6 6l1.2-1.2a2 2 0 0 1 2.1-.4c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.7 1.9Z"/>
                            </svg>
                        </span>
                        <span>+91 73858 82657</span>
                    </div>
                    <div class="footer-contact-item">
                        <span class="footer-contact-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24">
                                <path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                        </span>
                        <span>Maharashtra, India</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2026 ConstructKaro. All rights reserved.</p>
        </div>
    </div>
</footer>
