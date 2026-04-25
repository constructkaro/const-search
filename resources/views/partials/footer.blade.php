<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

<style>
.footer-section {
    position: relative;
    background: linear-gradient(90deg, #071226 0%, #0d1e39 35%, #21364d 100%);
    padding: 56px 0 18px;
    color: #ffffff;
    font-family: 'Poppins', sans-serif;
    overflow: hidden;
}

.footer-container {
    width: 92%;
    max-width: 1280px;
    margin: 0 auto;
}

/* social bar */
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

.footer-social-bar a {
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

.footer-social-bar a:hover {
    transform: translateY(-2px);
    color: #f0822f;
}

/* grid */
.footer-grid {
    display: grid;
    grid-template-columns: 1.8fr 1fr 1fr 1.2fr;
    gap: 46px;
    align-items: start;
    padding-top: 6px;
}

.footer-brand img {
    max-width: 285px;
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
    transition: 0.3s ease;
}

.footer-col ul li a:hover {
    color: #f0822f;
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
}

.footer-contact-item i {
    width: 16px;
    margin-top: 3px;
    color: rgba(255,255,255,0.8);
    font-size: 14px;
}

/* bottom */
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

/* responsive */
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
        padding: 74px 0 18px;
    }

    .footer-social-bar {
        top: 14px;
        left: 10px;
    }

    .footer-grid {
        grid-template-columns: 1fr;
        gap: 24px;
    }

    .footer-brand img {
        max-width: 220px;
    }

    .footer-brand p,
    .footer-col ul li a,
    .footer-contact-item,
    .footer-bottom p {
        font-size: 14px;
    }
}
</style>

<footer class="footer-section">
    <div class="footer-social-bar">
        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
        <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
    </div>

    <div class="footer-container">
        <div class="footer-grid">

            <div class="footer-brand">
                <img src="{{ asset('images/logo.png') }}" alt="ConstructKaro Logo">
                <p>
                    Constructkaro is a construction services platform that helps homeowners, businesses, and landowners plan, design, and execute residential, commercial, industrial, and infrastructure projects through verified Constructkaro experts across Mumbai, Navi Mumbai, Pune, Thane, and Raigad.
                </p>
            </div>

            <div class="footer-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Knowledge Hub</a></li>
                    <li><a href="#">Services</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Support</h4>
                <ul>
                    <li><a href="{{route('helpcenter')}}">Help Center</a></li>
                    <li><a href="#">Terms &amp; Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contact</h4>
                <div class="footer-contact-list">
                    <div class="footer-contact-item">
                        <i class="far fa-envelope"></i>
                        <span>connect@constructkaro.com</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="fas fa-phone-alt"></i>
                        <span>+91 73858 82657</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Maharashtra, India</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            <p>© 2026 ConstructKaro. All rights reserved.</p>
        </div>
    </div>
</footer>