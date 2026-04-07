<style>
    .vendor-footer {
    background: #0f1430;
    padding: 32px 0;
}

.footer-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 30px;
}

.footer-left h3 {
    color: #ffffff;
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 8px;
}

.footer-left p {
    color: rgba(255, 255, 255, 0.72);
    font-size: 16px;
    line-height: 1.6;
    max-width: 500px;
}

.footer-right {
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}

.footer-right a {
    color: rgba(255, 255, 255, 0.80);
    font-size: 15px;
    text-decoration: none;
    transition: 0.25s ease;
}

.footer-right a:hover {
    color: #f5a623;
}

@media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
        text-align: center;
    }

    .footer-right {
        justify-content: center;
    }
}
</style>
<footer class="vendor-footer">
    <div class="container footer-container">
        <div class="footer-left">
            <h3>ConstructKaro</h3>
            <p>Connecting verified construction professionals with genuine project opportunities.</p>
        </div>

        <div class="footer-right">
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms</a>
        </div>
    </div>
</footer>