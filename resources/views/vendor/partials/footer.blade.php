<style>
.vendor-footer {
    background: #0f1430;
    padding: 32px 0;
}

.vendor-footer,
.vendor-footer * {
    box-sizing: border-box;
}

.vendor-footer-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 30px;
    width: 92%;
    max-width: 1180px;
    margin: 0 auto;
}

.vendor-footer-left h3 {
    color: #ffffff;
    font-size: 24px;
    font-weight: 700;
    margin: 0 0 8px;
}

.vendor-footer-left p {
    color: rgba(255, 255, 255, 0.72);
    font-size: 16px;
    line-height: 1.6;
    max-width: 500px;
    margin: 0;
}

.vendor-footer-right {
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}

.vendor-footer-right a {
    color: rgba(255, 255, 255, 0.80);
    font-size: 15px;
    line-height: 1.4;
    text-decoration: none;
    transition: 0.25s ease;
}

.vendor-footer-right a:hover {
    color: #f5a623;
}

@media (max-width: 768px) {
    .vendor-footer-container {
        flex-direction: column;
        text-align: center;
    }

    .vendor-footer-right {
        justify-content: center;
        gap: 12px 18px;
    }
}
</style>
<footer class="vendor-footer">
    <div class="vendor-footer-container">
        <div class="vendor-footer-left">
            <h3>ConstructKaro</h3>
            <p>Connecting verified construction professionals with genuine project opportunities.</p>
        </div>

        <div class="vendor-footer-right">
            <a href="{{ route('aboutus') }}">About</a>
            <a href="{{ route('helpcenter') }}">Contact</a>
            <a href="{{ route('privacy.policy') }}">Privacy Policy</a>
            <a href="#">Terms</a>
        </div>
    </div>
</footer>
