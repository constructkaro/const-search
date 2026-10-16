@extends('vendor.layouts.app')

@section('title', 'Vendor | ConstructKaro')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --primary: #111633;
    --primary-2: #1a1f47;
    --accent: #f5a623;
    --accent-dark: #e59200;
    --text: #101828;
    --muted: #667085;
    --light-bg: #f7f8fa;
    --white: #ffffff;
    --border: #e9edf3;
    --shadow: 0 10px 30px rgba(16, 24, 40, 0.08);
    --container: 1280px;
}

a {
    text-decoration: none;
    color: inherit;
}

.container {
    width: min(92%, var(--container));
    margin: 0 auto;
}

.hero {
    position: relative;
    overflow: hidden;
    background:
        radial-gradient(circle at 12% 30%, rgba(245,166,35,0.10), transparent 18%),
        radial-gradient(circle at 88% 55%, rgba(220,65,120,0.10), transparent 22%),
        linear-gradient(135deg, var(--primary) 0%, var(--primary-2) 100%);
    color: var(--white);
}

.hero-inner {
    min-height: 760px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 90px 0 100px;
}

.hero-content {
    max-width: 1120px;
}

.eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    border: 1px solid rgba(255,255,255,0.14);
    border-radius: 999px;
    font-size: 14px;
    color: rgba(255,255,255,0.82);
    margin-bottom: 26px;
    background: rgba(255,255,255,0.04);
}

.hero h1 {
    font-size: 76px;
    line-height: 1.05;
    font-weight: 800;
    letter-spacing: -1.2px;
    margin-bottom: 24px;
}

.hero p {
    max-width: 880px;
    margin: 0 auto 36px;
    font-size: 23px;
    color: rgba(255,255,255,0.82);
    line-height: 1.6;
}

.hero-actions {
    display: flex;
    justify-content: center;
    gap: 18px;
    flex-wrap: wrap;
    margin-bottom: 42px;
}

.btn-primary,
.btn-outline {
    min-width: 250px;
    padding: 18px 30px;
    border-radius: 18px;
    font-size: 18px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    transition: 0.25s ease;
}

.btn-primary {
    background: var(--accent);
    color: var(--primary);
    box-shadow: 0 16px 30px rgba(245,166,35,0.18);
}

.btn-primary:hover {
    background: var(--accent-dark);
    transform: translateY(-2px);
}

.btn-outline {
    border: 1px solid rgba(255,255,255,0.18);
    color: var(--white);
    background: rgba(255,255,255,0.03);
}

.btn-outline:hover {
    background: rgba(255,255,255,0.08);
    transform: translateY(-2px);
}

.hero-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
    max-width: 850px;
    margin: 0 auto;
}

.stat-card {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 18px;
    padding: 18px;
}

.stat-card h3 {
    font-size: 28px;
    margin-bottom: 6px;
}

.stat-card p {
    margin: 0;
    font-size: 15px;
    color: rgba(255,255,255,0.72);
}

.section {
    padding: 110px 0;
}

.section-light {
    background: var(--light-bg);
}

.section-dark {
    background: linear-gradient(135deg, #131835 0%, #1a1f47 100%);
    color: var(--white);
}

.section-head {
    text-align: center;
    max-width: 860px;
    margin: 0 auto 54px;
}

.section-head span {
    display: inline-block;
    color: var(--accent);
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 1.3px;
    text-transform: uppercase;
    margin-bottom: 10px;
}

.section-head h2 {
    font-size: 50px;
    font-weight: 800;
    letter-spacing: -0.8px;
    margin-bottom: 14px;
}

.section-head p {
    font-size: 20px;
    color: var(--muted);
}

.section-dark .section-head p {
    color: rgba(255,255,255,0.72);
}

.grid-4 {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 22px;
}

.grid-3 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}

.category-card,
.benefit-card {
    background: var(--white);
    border-radius: 22px;
    padding: 26px;
    box-shadow: var(--shadow);
    border: 1px solid #f0f2f5;
    transition: 0.25s ease;
}

.category-card {
    min-height: 165px;
}

.step-card {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 24px;
    padding: 30px;
    transition: 0.25s ease;
}

.category-card:hover,
.benefit-card:hover,
.step-card:hover {
    transform: translateY(-4px);
}

.icon-box {
    width: 58px;
    height: 58px;
    border-radius: 16px;
    background: #fbf4e6;
    color: #d98300;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin-bottom: 22px;
}

.category-card h3,
.benefit-card h3 {
    font-size: 22px;
    line-height: 1.4;
    font-weight: 700;
}

.category-card p,
.benefit-card p {
    color: var(--muted);
    font-size: 15px;
    margin-top: 10px;
}

.step-top {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 20px;
}

.step-number {
    width: 54px;
    height: 54px;
    border-radius: 50%;
    background: var(--accent);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
}

.step-top i {
    color: var(--accent);
    font-size: 22px;
}

.step-card h3 {
    font-size: 26px;
    margin-bottom: 10px;
    font-weight: 700;
}

.step-card p {
    font-size: 17px;
    color: rgba(255,255,255,0.70);
}

.benefit-card i {
    font-size: 28px;
    color: #d98300;
    margin-bottom: 18px;
}

.cta-box {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-2) 100%);
    border-radius: 30px;
    padding: 60px 40px;
    text-align: center;
    color: var(--white);
    box-shadow: 0 20px 50px rgba(17,22,51,0.18);
}

.cta-box h2 {
    font-size: 46px;
    margin-bottom: 14px;
    font-weight: 800;
}

.cta-box p {
    max-width: 760px;
    margin: 0 auto 28px;
    font-size: 19px;
    color: rgba(255,255,255,0.76);
}

/* Modal */
.vendor-modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(10, 15, 35, 0.65);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    padding: 20px;
    overflow-y: auto;
}

.vendor-modal.show {
    display: flex;
}

.vendor-modal-box {
    position: relative;
    width: 100%;
    animation: modalFade 0.25s ease;
}

.vendor-register-modal-box {
    max-width: 980px;
}

@keyframes modalFade {
    from { opacity: 0; transform: translateY(15px); }
    to   { opacity: 1; transform: translateY(0); }
}

.vendor-modal-close {
    position: absolute;
    top: 14px;
    right: 18px;
    border: 0;
    background: transparent;
    font-size: 32px;
    line-height: 1;
    cursor: pointer;
    color: #111633;
    z-index: 5;
}

.register-card {
    background: #fbfbfa;
    border-radius: 24px;
    padding: 30px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.18);
}

.register-head {
    margin-bottom: 24px;
}

.register-head h2 {
    font-size: 40px;
    line-height: 1.1;
    font-weight: 800;
    color: #111633;
    margin-bottom: 8px;
}

.register-head p {
    font-size: 16px;
    color: #667085;
}

.register-form-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-size: 15px;
    font-weight: 600;
    color: #111633;
    margin-bottom: 8px;
}

.form-group label span {
    color: #ef4444;
}

.form-group input,
.form-group select,
.form-select,
.form-textarea {
    width: 100%;
    border: 1px solid #d5d9e2;
    border-radius: 14px;
    padding: 0 16px;
    font-size: 15px;
    color: #111633;
    background: #fff;
    outline: none;
    transition: 0.2s ease;
}

.form-group input,
.form-group select,
.form-select {
    height: 52px;
}

.form-textarea {
    min-height: 52px;
    padding: 14px 16px;
    resize: vertical;
    line-height: 1.5;
}

.form-group input:focus,
.form-group select:focus,
.form-select:focus,
.form-textarea:focus {
    border-color: #f5a623;
    box-shadow: 0 0 0 3px rgba(245,166,35,0.12);
}

.form-group input::placeholder {
    color: #98a2b3;
}

.full-row {
    grid-column: 1 / -1;
}

.form-submit {
    display: flex;
    justify-content: flex-end;
    margin-top: 4px;
}

.continue-btn {
    min-width: 180px;
    height: 52px;
    border: none;
    border-radius: 14px;
    background: #f5a623;
    color: #111633;
    font-size: 17px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    cursor: pointer;
    transition: 0.25s ease;
}

.continue-btn:hover {
    background: #e59200;
    transform: translateY(-1px);
}

.alert {
    padding: 12px 16px;
    border-radius: 10px;
    margin-bottom: 18px;
    font-size: 14px;
    font-weight: 500;
}

.alert-success {
    background: #ecfdf3;
    color: #027a48;
    border: 1px solid #abefc6;
}

.alert-error {
    background: #fef3f2;
    color: #b42318;
    border: 1px solid #fecdca;
}

.text-danger {
    color: #dc2626;
    font-size: 13px;
    margin-top: 6px;
    display: block;
}

/* Select2 overrides */
.select2-container {
    width: 100% !important;
}

.select2-container--default .select2-selection--single {
    height: 52px !important;
    border: 1px solid #d5d9e2 !important;
    border-radius: 14px !important;
    display: flex !important;
    align-items: center !important;
    padding: 0 12px !important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 50px !important;
    color: #111633 !important;
    font-size: 15px !important;
    padding-left: 0 !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 50px !important;
    right: 10px !important;
}

.select2-container--default .select2-selection--multiple {
    min-height: 52px !important;
    border: 1px solid #d5d9e2 !important;
    border-radius: 14px !important;
    padding: 7px 10px !important;
    background: #fff !important;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background: #fff4df !important;
    border: 1px solid #f5a623 !important;
    color: #111633 !important;
    border-radius: 20px !important;
    padding: 4px 10px !important;
    font-size: 13px !important;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #d98300 !important;
    margin-right: 5px !important;
}

.select2-dropdown {
    border: 1px solid #d5d9e2 !important;
    border-radius: 14px !important;
    overflow: hidden;
}

.select2-results__option--highlighted {
    background-color: #fff4df !important;
    color: #111633 !important;
}

.select2-results__option[aria-selected="true"] {
    background-color: #fbf4e6 !important;
    color: #d98300 !important;
}

/* Loading state for areas */
.area-loading {
    display: none;
    font-size: 13px;
    color: #667085;
    margin-top: 6px;
}
.area-loading.visible {
    display: block;
}

/* Responsive */
@media (max-width: 1200px) {
    .grid-4 { grid-template-columns: repeat(2, 1fr); }
    .grid-3 { grid-template-columns: repeat(2, 1fr); }
    .hero h1 { font-size: 60px; }
}

@media (max-width: 992px) {
    .hero-inner { min-height: auto; }
    .hero h1 { font-size: 46px; }
    .hero p { font-size: 19px; }
    .hero-stats, .grid-3 { grid-template-columns: 1fr; }
    .section-head h2 { font-size: 40px; }
    .register-form-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 768px) {
    .grid-4, .register-form-grid { grid-template-columns: 1fr; }
    .hero h1 { font-size: 36px; }
    .btn-primary, .btn-outline { width: 100%; min-width: auto; }
    .section { padding: 80px 0; }
    .cta-box { padding: 42px 24px; }
    .cta-box h2 { font-size: 34px; }
    .form-submit { justify-content: stretch; }
    .continue-btn { width: 100%; }
    .register-card { padding: 24px 18px; }
}

/* Reference-style vendor landing page */
body {
    background: #ededed;
    color: #141414;
}

.vendor-page {
    background: #ededed;
}

.vendor-hero {
    padding: 28px 0 18px;
}

.vendor-hero-card {
    min-height: 500px;
    position: relative;
    overflow: hidden;
    display: block;
    border-radius: 10px;
    background:
        linear-gradient(90deg, #fff 0%, #fff 35%, rgba(255,255,255,.90) 47%, rgba(255,255,255,.28) 63%, rgba(255,255,255,0) 100%),
        url("{{ asset('images/bannerold.png') }}") center / cover no-repeat;
    box-shadow: 0 7px 13px rgba(0,0,0,.24);
}

.vendor-hero-copy {
    position: relative;
    z-index: 3;
    width: min(58%, 900px);
    min-height: 500px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 52px 42px 38px;
}

.vendor-hero-copy h1 {
    margin: 0 0 16px;
    font-family: 'Inter', Arial, sans-serif;
    font-size: clamp(44px, 5.8vw, 86px);
    line-height: .9;
    font-weight: 900;
    letter-spacing: -2px;
    text-transform: uppercase;
    color: #135d96;
}

.vendor-hero-copy h1 .hero-as {
    color: #5d565d;
}

.vendor-hero-copy h1 .hero-vendor {
    color: #8c5129;
}

.vendor-hero-copy h2 {
    margin: 0 0 24px;
    font-size: clamp(28px, 3.4vw, 50px);
    line-height: 1.02;
    font-weight: 900;
    color: #111;
}

.vendor-hero-copy p {
    max-width: 780px;
    margin: 0 0 28px;
    font-size: clamp(18px, 2vw, 30px);
    line-height: 1.25;
    color: #282828;
    font-weight: 700;
}

.vendor-hero-copy p strong {
    font-weight: 900;
}

.vendor-hero-actions {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
    margin-bottom: 22px;
}

.vendor-btn {
    min-width: 170px;
    min-height: 42px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    border-radius: 5px;
    padding: 10px 16px;
    border: 0;
    font-size: 14px;
    font-weight: 900;
    transition: .2s ease;
}

.vendor-btn.primary {
    background: #1474bb;
    color: #fff;
    box-shadow: 0 4px 10px rgba(20,116,187,.28);
}

.vendor-btn.dark {
    background: #2a2a2a;
    color: #fff;
}

.vendor-btn:hover {
    transform: translateY(-1px);
}

.hero-feature-row {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 22px;
    max-width: 880px;
    margin-top: auto;
}

.hero-feature {
    display: flex;
    align-items: center;
    gap: 14px;
    min-height: 78px;
    padding: 10px 0;
    border: 0;
    background: transparent;
    border-radius: 0;
    font-size: clamp(16px, 1.45vw, 28px);
    line-height: 1.15;
    font-weight: 900;
    color: #202020;
}

.hero-feature i {
    width: 66px;
    height: 66px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 66px;
    border: 1px solid #ffb27b;
    border-radius: 8px;
    background: #fff1e8;
    color: #f26722;
    font-size: 30px;
}

.vendor-hero-media {
    position: absolute;
    inset: 0;
    z-index: 2;
    pointer-events: none;
}

.vendor-hero-media::before {
    display: none;
}

.hero-service-pill {
    position: absolute;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    min-height: 31px;
    padding: 6px 12px;
    border-radius: 999px;
    background: #fff;
    color: #27415f;
    border: 1px solid rgba(20,116,187,.18);
    box-shadow: 0 7px 14px rgba(0,0,0,.15);
    font-size: 12px;
    font-weight: 900;
    white-space: nowrap;
}

.hero-service-pill i {
    color: #f26722;
    font-size: 14px;
}

.hero-service-pill.architect { top: 23%; left: 62%; }
.hero-service-pill.contractor { top: 18%; right: 20%; }
.hero-service-pill.facade { top: 10%; right: 4%; }
.hero-service-pill.audit { top: 33%; right: 10%; }
.hero-service-pill.boq { top: 45%; right: 3%; }
.hero-service-pill.survey { top: 56%; left: 57%; }
.hero-service-pill.fabrication { top: 61%; right: 2%; }
.hero-service-pill.testing { bottom: 18%; right: 9%; }

.vendor-hero-image-link {
    display: block;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 7px 13px rgba(0,0,0,.24);
    background: #fff;
}

.vendor-hero-image {
    width: 100%;
    display: block;
    height: auto;
}

.vendor-section {
    padding: 38px 0;
}

.vendor-section.white {
    background: #fff;
}

.vendor-section.grey {
    background: #ededed;
}

.vendor-section-title {
    text-align: center;
    margin-bottom: 22px;
}

.vendor-section-title h2 {
    display: inline-block;
    margin: 0 0 8px;
    border-bottom: 4px solid #f7941d;
    font-size: clamp(22px, 2.5vw, 32px);
    line-height: 1.1;
    font-weight: 900;
    text-transform: uppercase;
    color: #202020;
}

.vendor-section-title p {
    margin: 0;
    color: #5f6b76;
    font-size: 14px;
    font-weight: 700;
}

.join-grid {
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 14px;
}

.join-card {
    overflow: hidden;
    min-height: 128px;
    border: 3px solid #1f75bc;
    border-radius: 6px;
    background: #fff;
    box-shadow: 0 4px 10px rgba(0,0,0,.16);
}

.join-card img {
    width: 100%;
    height: 88px;
    display: block;
    object-fit: cover;
}

.join-card h3 {
    min-height: 40px;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 6px;
    background: #f8fbff;
    color: #123b5f;
    font-size: 12px;
    line-height: 1.12;
    font-weight: 900;
    text-align: center;
    text-transform: uppercase;
}

.steps-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 28px 42px;
    margin-top: 28px;
}

.process-step {
    display: grid;
    grid-template-columns: 42px 1fr;
    gap: 12px;
    align-items: start;
}

.process-step .num {
    width: 34px;
    height: 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: #f7941d;
    color: #fff;
    font-weight: 900;
    font-size: 13px;
}

.process-step h3 {
    margin: 0 0 4px;
    color: #1a1a1a;
    font-size: 18px;
    font-weight: 900;
}

.process-step p {
    margin: 0;
    color: #667085;
    font-size: 13px;
    font-weight: 700;
}

.why-band {
    display: grid;
    grid-template-columns: .9fr 1.1fr;
    min-height: 300px;
    background: #fff;
    border-top: 1px solid #d2d2d2;
    border-bottom: 1px solid #d2d2d2;
}

.why-image {
    background: url("{{ asset('images/logo/c1.png') }}") center / cover no-repeat;
}

.why-copy {
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 40px 52px;
}

.why-copy .small-tag {
    align-self: flex-start;
    margin-bottom: 8px;
    padding: 5px 10px;
    border-radius: 999px;
    background: #e6f2fb;
    color: #1f75bc;
    font-size: 11px;
    font-weight: 900;
    text-transform: uppercase;
}

.why-copy h2 {
    margin: 0 0 10px;
    font-size: clamp(28px, 3.5vw, 46px);
    line-height: .98;
    font-weight: 900;
    color: #111;
}

.why-copy h2 span {
    color: #1f75bc;
}

.why-copy p {
    margin: 0 0 20px;
    max-width: 680px;
    color: #5f6b76;
    font-size: 14px;
    font-weight: 700;
}

.why-mini-grid,
.need-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 14px;
}

.why-mini,
.need-item {
    display: flex;
    gap: 10px;
    align-items: flex-start;
}

.why-mini i,
.need-item i {
    color: #1f75bc;
    font-size: 22px;
}

.why-mini strong,
.need-item strong {
    display: block;
    color: #1b2937;
    font-size: 14px;
    font-weight: 900;
}

.why-mini span,
.need-item span {
    display: block;
    margin-top: 3px;
    color: #667085;
    font-size: 12px;
    line-height: 1.25;
    font-weight: 700;
}

.need-grid {
    grid-template-columns: repeat(5, minmax(0, 1fr));
}

.faq-list {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    gap: 14px;
}

.faq-item {
    border: 1px solid #d6d6d6;
    border-radius: 6px;
    background: #fff;
    box-shadow: 0 3px 8px rgba(0,0,0,.12);
}

.faq-item summary {
    cursor: pointer;
    padding: 18px 22px;
    color: #111;
    font-size: 15px;
    font-weight: 900;
}

.faq-item p {
    margin: 0;
    padding: 0 22px 18px;
    color: #667085;
    font-weight: 700;
}

.vendor-page .section {
    padding: 42px 0;
}

.vendor-page .section-light,
.vendor-page .section-dark {
    background: #ededed;
    color: #151515;
}

.vendor-page .section-head {
    margin-bottom: 24px;
}

.vendor-page .section-head span {
    display: none;
}

.vendor-page .section-head h2 {
    display: inline-block;
    margin: 0 0 8px;
    border-bottom: 4px solid #f7941d;
    color: #202020;
    font-size: clamp(22px, 2.5vw, 32px);
    line-height: 1.1;
    font-weight: 900;
    text-transform: uppercase;
}

.vendor-page .section-head p,
.vendor-page .section-dark .section-head p {
    color: #5f6b76;
    font-size: 14px;
    font-weight: 700;
}

.vendor-page .category-card {
    position: relative;
    overflow: hidden;
    min-height: 135px;
    border: 3px solid #1f75bc;
    border-radius: 6px;
    padding: 96px 8px 8px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0,0,0,.16);
}

.vendor-page .category-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 86px;
    background: var(--category-image, url("{{ asset('images/logo/c1.png') }}")) center / cover no-repeat;
}

.vendor-page .category-card .icon-box {
    display: none;
}

.vendor-page .category-card:nth-child(1) { --category-image: url("{{ asset('images/logo/c1.png') }}"); }
.vendor-page .category-card:nth-child(2) { --category-image: url("{{ asset('images/logo/a1.jpg') }}"); }
.vendor-page .category-card:nth-child(3) { --category-image: url("{{ asset('images/logo/i1.png') }}"); }
.vendor-page .category-card:nth-child(4) { --category-image: url("{{ asset('images/logo/ts1.png') }}"); }
.vendor-page .category-card:nth-child(5) { --category-image: url("{{ asset('images/logo/bdc1.png') }}"); }
.vendor-page .category-card:nth-child(6) { --category-image: url("{{ asset('images/logo/tss1.png') }}"); }
.vendor-page .category-card:nth-child(7) { --category-image: url("{{ asset('images/logo/st1.png') }}"); }
.vendor-page .category-card:nth-child(8) { --category-image: url("{{ asset('images/logo/coc1.png') }}"); }
.vendor-page .category-card:nth-child(9) { --category-image: url("{{ asset('images/logo/fp1.png') }}"); }
.vendor-page .category-card:nth-child(10) { --category-image: url("{{ asset('images/logo/wc1.png') }}"); }
.vendor-page .category-card:nth-child(11) { --category-image: url("{{ asset('images/logo/lps1.png') }}"); }

.vendor-page .category-card h3,
.vendor-page .benefit-card h3 {
    color: #123b5f;
    font-size: 14px;
    line-height: 1.15;
    font-weight: 900;
    text-transform: uppercase;
}

.vendor-page .grid-4 {
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 14px;
}

.vendor-page .category-card p {
    display: none;
}

.vendor-page .benefit-card p {
    display: block;
    margin-top: 8px;
    color: #667085;
    font-size: 13px;
    line-height: 1.35;
    font-weight: 700;
}

.vendor-page .step-card {
    min-height: 150px;
    border: 0;
    border-radius: 0;
    background: transparent;
    padding: 8px 0;
}

.vendor-page .step-top {
    gap: 12px;
    margin-bottom: 8px;
}

.vendor-page .step-number {
    width: 34px;
    height: 34px;
    background: #f7941d;
    color: #fff;
    font-size: 13px;
}

.vendor-page .step-top i {
    color: #1f75bc;
}

.vendor-page .step-card h3 {
    margin-bottom: 4px;
    color: #1a1a1a;
    font-size: 18px;
    font-weight: 900;
}

.vendor-page .step-card p {
    color: #667085;
    font-size: 13px;
    font-weight: 700;
}

.vendor-page #why-join {
    background: #fff;
    border-top: 1px solid #d2d2d2;
    border-bottom: 1px solid #d2d2d2;
}

.vendor-page #why-join .container {
    position: relative;
}

.vendor-page #why-join .section-head h2 {
    border-bottom: 0;
    font-size: clamp(30px, 3.2vw, 46px);
    text-transform: none;
}

.vendor-page .benefit-card {
    border-radius: 6px;
    padding: 18px;
    box-shadow: none;
    border: 1px solid #dbe6ef;
}

.vendor-page .benefit-card i {
    color: #1f75bc;
}

.vendor-page #register,
.vendor-page .cta-box {
    display: none;
}

@media (max-width: 1200px) {
    .vendor-page .grid-4,
    .join-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    .need-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
}

@media (max-width: 900px) {
    .vendor-hero-card,
    .why-band {
        grid-template-columns: 1fr;
    }

    .vendor-hero-card {
        min-height: auto;
        background:
            linear-gradient(180deg, rgba(255,255,255,.94) 0%, rgba(255,255,255,.92) 62%, rgba(255,255,255,.72) 100%),
            url("{{ asset('images/bannerold.png') }}") center / cover no-repeat;
    }

    .vendor-hero-copy {
        width: 100%;
        min-height: auto;
    }

    .vendor-hero-media {
        display: none;
    }

    .vendor-hero-media::before {
        background: linear-gradient(180deg, rgba(255,255,255,0) 0%, #fff 100%);
    }

    .steps-grid,
    .why-mini-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 640px) {
    .vendor-hero-copy {
        padding: 24px 18px;
    }

    .vendor-hero-copy h1 {
        letter-spacing: -1px;
    }

    .hero-feature-row,
    .vendor-page .grid-4,
    .join-grid,
    .need-grid {
        grid-template-columns: 1fr;
    }

    .vendor-btn {
        width: 100%;
    }

    .why-copy {
        padding: 30px 20px;
    }
}

/* Final alignment pass */
.vendor-page {
    font-family: 'Inter', Arial, sans-serif;
}

.vendor-page .container {
    width: min(88%, 1600px);
}

.vendor-hero {
    padding: 0 0 54px;
}

.vendor-hero .container {
    width: 100%;
    max-width: none;
}

.vendor-hero-image-link {
    border-radius: 0;
    box-shadow: none;
}

.vendor-hero-banner {
    position: relative;
    background: #fff;
}

.vendor-page #who-can-join.vendor-join-image-section {
    padding: 0 0 40px;
    background: #fff;
}

.vendor-join-image {
    display: block;
    width: 100%;
    height: auto;
}

.vendor-hero-banner .vendor-hero-actions {
    position: absolute;
    top: 57%;
    left: 3.4%;
    width: 46%;
    display: flex;
    flex-wrap: nowrap;
    gap: clamp(12px, 2.5vw, 48px);
    margin: 0;
}

.vendor-hero-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: clamp(8px, .7vw, 14px);
    flex: 1 1 auto;
    min-width: 0;
    padding: clamp(12px, 1vw, 20px) clamp(12px, 1.4vw, 28px);
    border: 1px solid rgba(255, 255, 255, .25);
    border-radius: clamp(8px, .8vw, 15px);
    background: linear-gradient(180deg, #05345b 0%, #1262a7 88%, #438ac1 100%);
    box-shadow: inset 0 3px 5px rgba(0, 0, 0, .4), inset 0 -2px 3px rgba(255, 255, 255, .2);
    color: #fff;
    font-family: inherit;
    font-size: clamp(12px, 1.65vw, 32px);
    font-weight: 700;
    line-height: 1.3;
    white-space: nowrap;
    text-decoration: none;
    cursor: pointer;
}

.vendor-hero-action--team {
    background: linear-gradient(180deg, #191919 0%, #393939 88%, #686868 100%);
}

.vendor-hero-action i {
    font-size: 1.3em;
}

.vendor-hero-action:hover {
    color: #fff;
    filter: brightness(1.12);
}

.vendor-hero-action:focus-visible {
    outline: 3px solid #2176bb;
    outline-offset: 4px;
}

@media (max-width: 760px) {
    .vendor-hero-banner .vendor-hero-actions {
        position: static;
        width: 100%;
        flex-wrap: wrap;
        gap: 12px;
        padding: 18px 4%;
    }

    .vendor-hero-action {
        flex: 1 1 220px;
        min-height: 50px;
        font-size: 16px;
    }
}

.vendor-section,
.vendor-page .section {
    padding: 58px 0;
}

.vendor-page #who-can-join {
    padding-top: 52px;
}

.vendor-page .section-head,
.vendor-section-title {
    max-width: 900px;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 30px;
    text-align: center;
}

.vendor-page .grid-4 {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: stretch;
    gap: 18px;
}

.vendor-page .category-card {
    flex: 0 1 calc((100% - 72px) / 5);
    max-width: 275px;
    min-width: 210px;
}

.vendor-page .grid-3 {
    max-width: 1360px;
    margin-left: auto;
    margin-right: auto;
    gap: 28px;
}

.vendor-page .step-card {
    min-height: 118px;
}

.vendor-page #why-join {
    padding: 0;
}

.vendor-page .benefit-card {
    min-height: 145px;
}

.need-grid {
    max-width: 1360px;
    margin-left: auto;
    margin-right: auto;
    gap: 22px;
}

.faq-list {
    max-width: 1220px;
}

@media (max-width: 1200px) {
    .vendor-page .category-card {
        flex-basis: calc((100% - 36px) / 3);
    }
}

@media (max-width: 760px) {
    .vendor-page .container {
        width: min(92%, 1600px);
    }

    .vendor-hero {
        padding: 0 0 34px;
    }

    .vendor-page .category-card {
        flex-basis: 100%;
        max-width: 420px;
    }

    .vendor-section,
    .vendor-page .section {
        padding: 42px 0;
    }
}
</style>

<div class="vendor-page">
    {{-- ===================== HERO ===================== --}}
    <section class="vendor-hero" id="top">
        <div class="container">
            <div class="vendor-hero-banner">
            <a href="javascript:void(0)" class="vendor-hero-image-link openVendorModalBtn" aria-label="Register as a vendor">
                <img
                    src="{{ asset('images/vendor-hero-register.png') }}"
                    alt="Register as a vendor and get construction projects in your area"
                    class="vendor-hero-image"
                    loading="eager"
                    decoding="async">
            </a>
                <div class="vendor-hero-actions">
                    <button type="button" class="vendor-hero-action openVendorModalBtn" aria-haspopup="dialog" aria-controls="vendorRegisterModal">
                        <i class="fa-solid fa-user" aria-hidden="true"></i> Register as a Vendor
                    </button>
                    <a href="tel:+917385882657" class="vendor-hero-action vendor-hero-action--team">
                        <i class="fa-solid fa-phone" aria-hidden="true"></i> Talk to Team
                    </a>
                </div>
            </div>
        </div>
    </section>

{{-- ===================== WHO CAN JOIN ===================== --}}

<section class="vendor-join-image-section" id="who-can-join" aria-label="Who can join ConstructKaro">
    <img
        src="{{ asset('images/vendor-who-can-join.png') }}"
        alt="Who can join: Architect, Contractor, Feasibility Report, Survey Services, Facade Services, Structural Audit, BOQ / Estimation, Welding and Fabrication, and Testing Services. Choose the services you provide and build a professional profile around your expertise."
        class="vendor-join-image"
        width="7208"
        height="2433"
        loading="lazy"
        decoding="async">
</section>


{{-- ===================== HOW IT WORKS ===================== --}}

<section id="how-it-works" aria-label="How it works">
    <img
        src="{{ asset('images/howitswork.png') }}"
        alt="How it works: 1. Register and login. 2. Select category. 3. Add details and documents. 4. Read and accept agreement. 5. Submit your profile for verification. 6. Receive project opportunities in your preferred area."
        class="vendor-join-image"
        width="7784"
        height="1884"
        loading="lazy"
        decoding="async">
</section>

{{-- ===================== WHY JOIN ===================== --}}
<section id="why-join" aria-label="Why professionals join ConstructKaro">
    <img
        src="{{ asset('images/Group1693.png') }}"
        alt="Why professionals join ConstructKaro: Build a verified presence, choose your services and preferred work locations, and get onboarding support with profile setup and verification."
        class="vendor-join-image"
        width="7784"
        height="1876"
        loading="lazy"
        decoding="async">
</section>

{{-- ===================== WHAT YOU NEED ===================== --}}
<section id="what-you-need" aria-label="What you will need to register">
    <img
        src="{{ asset('images/Group1706.png') }}"
        alt="Keep these ready: Business details including firm or company name and business type; service expertise and experience; preferred cities or districts; business and professional verification documents; and portfolio of completed work or project details, if applicable."
        class="vendor-join-image"
        width="7210"
        height="841"
        loading="lazy"
        decoding="async">
</section>
{{-- ===================== CTA ===================== --}}
<section class="section section-light" id="register" style="padding-top: 0;">
    <div class="container">
        <div class="cta-box">
            <h2>Ready to Join ConstructKaro?</h2>
            <p>
                Register your business, complete your vendor profile, and start receiving
                project opportunities suited to your category and location.
            </p>
            <a href="javascript:void(0)" class="btn-primary openVendorModalBtn">
                <i class="fa-regular fa-user"></i>
                Start Vendor Registration
            </a>
        </div>
    </div>
</section>



{{-- ===================== FAQ ===================== --}}
<section class="vendor-section grey" id="faq">
    <div class="container">
        <div class="vendor-section-title">
            <h2>Frequently Asked Questions (FAQs)</h2>
        </div>

        <div class="faq-list">
            <details class="faq-item">
                <summary>1. Who can register as a vendor?</summary>
                <p>Contractors, architects, surveyors, testing agencies, BOQ experts, interior professionals, facade teams and other construction service providers can register.</p>
            </details>
            <details class="faq-item">
                <summary>2. What documents are required?</summary>
                <p>Basic business details, contact information, service category, location details and verification documents are required during onboarding.</p>
            </details>
            <details class="faq-item">
                <summary>3. Can I choose multiple service categories?</summary>
                <p>Yes, you can select categories that match the services your business provides.</p>
            </details>
            <details class="faq-item">
                <summary>4. Can I choose more than one city or service area?</summary>
                <p>Yes, you can select multiple cities and areas so project opportunities match your preferred working locations.</p>
            </details>
            <details class="faq-item">
                <summary>5. How does vendor verification work?</summary>
                <p>After you submit your profile, our team reviews your business details and supporting documents. Once verification is complete, your verified profile is activated.</p>
            </details>
        </div>
    </div>
</section>

</div>

{{-- ===================== OLD DATA ===================== --}}
@php
    // Support pre-filling from old() or existing record
    $selectedCityIds = old('city_ids', !empty($existingData->city_ids)
        ? json_decode($existingData->city_ids, true)
        : []);
    $selectedCityIds = is_array($selectedCityIds) ? array_map('strval', $selectedCityIds) : [];

    $selectedAreaIds = old('area_ids', !empty($existingData->area_ids)
        ? json_decode($existingData->area_ids, true)
        : []);
    $selectedAreaIds = is_array($selectedAreaIds) ? array_map('strval', $selectedAreaIds) : [];

    $savedPincodes = old('pincode', $existingData->pincode ?? '');
@endphp

{{-- ===================== MODAL ===================== --}}
<div id="vendorRegisterModal" class="vendor-modal {{ $errors->any() ? 'show' : '' }}">
    <div class="vendor-modal-box vendor-register-modal-box">
        <button type="button" class="vendor-modal-close" id="closeVendorModal">&times;</button>

        <div class="register-card">
            <div class="register-head">
                <h2>Basic Details</h2>
                <p>Tell us about yourself and your business</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            <form action="{{ route('vendor.register.submit') }}" method="POST" class="register-form-grid">
                @csrf

                {{-- Full Name --}}
                <div class="form-group">
                    <label>Full Name <span>*</span></label>
                    <input type="text" name="full_name" placeholder="Enter your full name"
                           value="{{ old('full_name') }}" required>
                    @error('full_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Mobile --}}
                <div class="form-group">
                    <label>Mobile Number <span>*</span></label>
                    <input type="text" name="mobile" id="registerMobile" placeholder="10-digit mobile"
                           maxlength="10" value="{{ old('mobile') }}" required>
                    @error('mobile')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label>Email <span>*</span></label>
                    <input type="email" name="email" placeholder="you@example.com"
                           value="{{ old('email') }}" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Company Name --}}
                <div class="form-group">
                    <label>Company / Firm Name <span>*</span></label>
                    <input type="text" name="company_name" placeholder="Your business name"
                           value="{{ old('company_name') }}" required>
                    @error('company_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- City — multiple --}}
                <div class="form-group">
                    <label>City <span>*</span></label>
                    <select class="form-select" name="city_ids[]" id="city_ids" multiple required>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}"
                                {{ in_array((string)$city->id, $selectedCityIds) ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('city_ids')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Area — multiple, loaded via AJAX --}}
                <div class="form-group">
                    <label>Area <span>*</span></label>
                    <select class="form-select" name="area_ids[]" id="area_ids" multiple required>
                        {{--
                            On validation failure, we need to re-populate areas.
                            We output the previously-selected areas as hidden options;
                            JS will replace them with a fresh AJAX load.
                        --}}
                        @foreach($selectedAreaIds as $areaId)
                            <option value="{{ $areaId }}" selected>{{ $areaId }}</option>
                        @endforeach
                    </select>
                    <small class="area-loading" id="areaLoading">
                        <i class="fa-solid fa-spinner fa-spin"></i> Loading areas…
                    </small>
                    @error('area_ids')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Pincode (auto-filled, read-only) --}}
                <div class="form-group">
                    <label>Pincode <span>*</span></label>
                    <textarea class="form-textarea" id="pincode_id" name="pincode" readonly
                        placeholder="Pincodes auto-fill from selected areas">{{ $savedPincodes }}</textarea>
                    @error('pincode')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Business Address --}}
                <div class="form-group full-row">
                    <label>Business Address <span>*</span></label>
                    <input type="text" name="business_address" placeholder="Full address"
                           value="{{ old('business_address') }}" required>
                    @error('business_address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Business Entity --}}
                <div class="form-group">
                    <label>Type of Business Entity <span>*</span></label>
                    <select name="business_entity" required>
                        <option value="">Select</option>
                        @foreach(['Individual','Proprietorship','Partnership','Pvt Ltd','LLP','Other'] as $entity)
                            <option value="{{ $entity }}"
                                {{ old('business_entity') == $entity ? 'selected' : '' }}>
                                {{ $entity }}
                            </option>
                        @endforeach
                    </select>
                    @error('business_entity')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label>Password <span>*</span></label>
                    <input type="password" name="password" placeholder="Enter password" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="form-group">
                    <label>Confirm Password <span>*</span></label>
                    <input type="password" name="password_confirmation" placeholder="Confirm password" required>
                </div>

                <div class="form-submit full-row">
                    <button type="submit" class="continue-btn">
                        Continue <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
/* ── Modal open / close ── */
document.addEventListener('DOMContentLoaded', function () {
    const openButtons   = document.querySelectorAll('.openVendorModalBtn');
    const closeBtn      = document.getElementById('closeVendorModal');
    const modal         = document.getElementById('vendorRegisterModal');

    if (modal && modal.classList.contains('show')) {
        document.body.style.overflow = 'hidden';
    }

    openButtons.forEach(btn => btn.addEventListener('click', () => {
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }));

    closeBtn && closeBtn.addEventListener('click', () => {
        modal.classList.remove('show');
        document.body.style.overflow = '';
    });

    window.addEventListener('click', e => {
        if (e.target === modal) {
            modal.classList.remove('show');
            document.body.style.overflow = '';
        }
    });
});
</script>

<script>
$(document).ready(function () {

    /* ── PHP → JS: previously selected IDs ── */
    const preSelectedCityIds = @json($selectedCityIds);   // e.g. ["2","5"]
    const preSelectedAreaIds = @json($selectedAreaIds);   // e.g. ["12","15","20"]

    /* ── Route templates ── */
    const areasRouteTemplate = "{{ route('get.areas', ':city_id') }}";
    const pincodesRoute      = "{{ route('get.pincodes') }}";

    /* ── Init Select2 for City (multiple) ── */
    $('#city_ids').select2({
        placeholder     : 'Select one or more cities',
        width           : '100%',
        closeOnSelect   : false,
        dropdownParent  : $('#vendorRegisterModal')
    });

    /* ── Init Select2 for Area (multiple) ── */
    $('#area_ids').select2({
        placeholder     : 'Select areas',
        width           : '100%',
        closeOnSelect   : false,
        dropdownParent  : $('#vendorRegisterModal')
    });

    /* ────────────────────────────────────────────────
       loadAreasForCities(cityIds, preselectAreaIds)
       Fetches areas for ALL selected cities in parallel,
       merges results, and rebuilds the area <select>.
    ──────────────────────────────────────────────── */
    function loadAreasForCities(cityIds, preselectAreaIds) {
        if (!cityIds || cityIds.length === 0) {
            $('#area_ids').html('').trigger('change');
            $('#pincode_id').val('');
            return;
        }

        /* Show loader */
        $('#areaLoading').addClass('visible');
        $('#area_ids').prop('disabled', true);

        /* Fire one AJAX call per city simultaneously */
        const requests = cityIds.map(cityId =>
            $.ajax({
                url      : areasRouteTemplate.replace(':city_id', cityId),
                type     : 'GET',
                dataType : 'json'
            })
        );

        $.when(...requests).then(function (...responses) {
            /*
             * $.when with multiple deferreds returns each result as
             * [data, status, jqXHR]. Normalise both single and multi-call.
             */
            let allAreas = [];

            if (cityIds.length === 1) {
                /* Single request — response is the data directly */
                const data = Array.isArray(responses[0]) ? responses[0] : responses;
                allAreas = data.flat ? data : [].concat(...responses);
                /* Actually $.when with 1 deferred resolves as (data, status, jqXHR) */
                allAreas = responses[0];
            } else {
                responses.forEach(res => {
                    /* Each res = [data, status, jqXHR] */
                    const data = Array.isArray(res[0]) ? res[0] : res;
                    allAreas = allAreas.concat(data);
                });
            }

            /* Deduplicate by id */
            const seen = new Set();
            const unique = allAreas.filter(area => {
                if (seen.has(area.id)) return false;
                seen.add(area.id);
                return true;
            });

            /* Sort alphabetically for better UX */
            unique.sort((a, b) => a.name.localeCompare(b.name));

            /* Build options */
            let html = '';
            unique.forEach(area => {
                const isSelected = preselectAreaIds.includes(area.id.toString())
                                || preselectAreaIds.includes(area.id);
                html += `<option value="${area.id}" ${isSelected ? 'selected' : ''}>${area.name}</option>`;
            });

            $('#area_ids').html(html).trigger('change');
            $('#area_ids').prop('disabled', false);
            $('#areaLoading').removeClass('visible');

            /* Auto-load pincodes for pre-selected areas */
            if (preselectAreaIds.length > 0) {
                loadPincodes(preselectAreaIds);
            }

        }).fail(function () {
            $('#area_ids').prop('disabled', false);
            $('#areaLoading').removeClass('visible');
            console.error('Failed to load areas.');
        });
    }

    /* ────────────────────────────────────────────────
       loadPincodes(areaIds)
    ──────────────────────────────────────────────── */
    function loadPincodes(areaIds) {
        if (!areaIds || areaIds.length === 0) {
            $('#pincode_id').val('');
            return;
        }

        $.ajax({
            url      : pincodesRoute,
            type     : 'GET',
            dataType : 'json',
            data     : { area_ids: areaIds },
            success  : function (data) {
                const unique = [...new Set(data)];
                $('#pincode_id').val(unique.join(', '));
            }
        });
    }

    /* ── City change → reload areas ── */
    $('#city_ids').on('change', function () {
        const selectedCities = $(this).val() || [];
        loadAreasForCities(selectedCities, []);
        $('#pincode_id').val('');
    });

    /* ── Area change → reload pincodes ── */
    $('#area_ids').on('change', function () {
        const selectedAreas = $(this).val() || [];
        loadPincodes(selectedAreas);
    });

    /* ── On page load: restore previous state after validation failure ── */
    if (preSelectedCityIds.length > 0) {
        /* Select2 needs values set before trigger */
        $('#city_ids').val(preSelectedCityIds).trigger('change.select2');
        /* Load areas and pre-select the previously chosen ones */
        loadAreasForCities(preSelectedCityIds, preSelectedAreaIds);
    }

});
</script>

@endsection
