<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --ink: #112032;
            --muted: #62748a;
            --brand: #004487;
            --accent: #ff7a1a;
            --panel: #ffffff;
            --line: #d9e5f2;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', Inter, Arial, sans-serif;
            background:
                radial-gradient(circle at 18% 18%, rgba(255, 122, 26, 0.14), transparent 28%),
                linear-gradient(135deg, #edf6ff 0%, #f8fbff 48%, #eef3f8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--ink);
            padding: 24px;
            overflow-x: hidden;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1080px;
            display: grid;
            grid-template-columns: 0.95fr 1.05fr;
            background: rgba(255, 255, 255, 0.78);
            border: 1px solid rgba(174, 199, 224, 0.7);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 26px 70px rgba(23, 44, 67, 0.16);
            backdrop-filter: blur(16px);
        }

        .login-left {
            position: relative;
            background:
                linear-gradient(rgba(10, 30, 52, 0.82), rgba(10, 30, 52, 0.88)),
                url("{{ asset('images/banner.jpg') }}") center/cover;
            color: #fff;
            padding: 52px 44px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 620px;
            isolation: isolate;
        }

        .login-left::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(145deg, rgba(0, 68, 135, 0.55), rgba(255, 122, 26, 0.16));
            z-index: -1;
        }

        .brand-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-logo {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.92);
            padding: 8px;
            object-fit: contain;
        }

        .brand-name {
            margin: 0;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 0;
        }

        .brand-role {
            margin: 2px 0 0;
            color: rgba(255, 255, 255, 0.74);
            font-size: 13px;
        }

        .login-left h1 {
            font-size: clamp(34px, 4vw, 52px);
            line-height: 1.05;
            font-weight: 800;
            margin-bottom: 16px;
            letter-spacing: 0;
        }

        .login-left p {
            font-size: 16px;
            line-height: 1.75;
            color: rgba(255,255,255,0.86);
            margin-bottom: 0;
            max-width: 430px;
        }

        .brand-badge {
            display: inline-block;
            background: rgba(255, 122, 26, 0.92);
            color: #fff;
            padding: 9px 14px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 20px;
            width: fit-content;
        }

        .feature-list {
            display: grid;
            gap: 12px;
            margin-top: 28px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 11px;
            color: rgba(255, 255, 255, 0.88);
            font-size: 14px;
            font-weight: 600;
        }

        .feature-item i {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.16);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffd7bc;
        }

        .login-right {
            padding: 56px 52px;
            background:
                linear-gradient(180deg, rgba(255, 255, 255, 0.96), rgba(249, 252, 255, 0.96));
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
        }

        .login-kicker {
            color: var(--accent);
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 1.6px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .login-card h2 {
            font-size: 34px;
            font-weight: 800;
            color: var(--ink);
            margin-bottom: 8px;
            letter-spacing: 0;
        }

        .login-card .subtitle {
            color: var(--muted);
            font-size: 15px;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 8px;
        }

        .input-field {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #7b8ea5;
            font-size: 18px;
            pointer-events: none;
        }

        .form-control {
            height: 54px;
            border-radius: 12px;
            border: 1px solid var(--line);
            box-shadow: none;
            padding: 0 15px 0 46px;
            color: var(--ink);
            background: #f7fbff;
            font-size: 15px;
        }

        .form-control:focus {
            border-color: var(--accent);
            background: #fff;
            box-shadow: 0 0 0 0.18rem rgba(255, 122, 26, 0.16);
        }

        .password-field {
            position: relative;
        }

        .password-field .form-control {
            padding-right: 58px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 12px;
            width: 38px;
            height: 38px;
            border: 1px solid transparent;
            border-radius: 8px;
            background: #fff;
            color: #5f7287;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transform: translateY(-50%);
            cursor: pointer;
            transition: color 0.2s ease, background 0.2s ease;
        }

        .toggle-password:hover,
        .toggle-password:focus {
            color: var(--accent);
            border-color: rgba(255, 122, 26, 0.3);
            background: rgba(255, 122, 26, 0.08);
            outline: none;
        }

        .toggle-password svg {
            width: 20px;
            height: 20px;
        }

        .toggle-password .eye-off-icon {
            display: none;
        }

        .toggle-password.is-visible .eye-icon {
            display: none;
        }

        .toggle-password.is-visible .eye-off-icon {
            display: block;
        }

        .login-btn {
            width: 100%;
            height: 54px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(90deg, var(--brand) 0%, #0b61b0 48%, var(--accent) 100%);
            color: #fff;
            font-size: 16px;
            font-weight: 800;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 14px 28px rgba(0, 68, 135, 0.22);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 34px rgba(0, 68, 135, 0.26);
        }

        .form-check-label {
            color: #536579;
            font-size: 14px;
        }

        .form-check-input:checked {
            background-color: var(--accent);
            border-color: var(--accent);
        }

        .alert {
            border-radius: 12px;
            font-size: 14px;
            border: none;
        }

        .small-note {
            margin-top: 22px;
            text-align: center;
            color: var(--muted);
            font-size: 13px;
        }

        @media (max-width: 991px) {
            body {
                padding: 14px;
                align-items: flex-start;
            }

            .login-wrapper {
                grid-template-columns: 1fr;
                max-width: 500px;
                border-radius: 18px;
            }

            .login-left {
                min-height: auto;
                padding: 28px 24px;
            }

            .login-right {
                padding: 32px 22px;
            }

            .feature-list {
                display: none;
            }

            .login-left h1 {
                font-size: 32px;
            }
        }

        @media (max-width: 575px) {
            .brand-logo {
                width: 46px;
                height: 46px;
            }

            .login-card h2 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>

    <div class="container py-4">
        <div class="login-wrapper mx-auto">

            <div class="login-left">
                <div class="brand-row">
                    <img src="{{ asset('images/logo.png') }}" alt="ConstructKaro" class="brand-logo">
                    <div>
                        <p class="brand-name">ConstructKaro</p>
                        <p class="brand-role">Admin Control Center</p>
                    </div>
                </div>

                <div>
                    <span class="brand-badge">Shreeyash Group ERP</span>
                    <h1>Manage every site update from one place.</h1>
                    <p>
                        Track leads, vendors, orders, templates, and project progress with a secure admin workspace.
                    </p>

                    <div class="feature-list">
                        <div class="feature-item">
                            <i class="bi bi-kanban"></i>
                            <span>Project and lead management</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-box-seam"></i>
                            <span>Orders, vendors, and tracking templates</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-shield-check"></i>
                            <span>Role based admin access</span>
                        </div>
                    </div>
                </div>

                <div class="brand-role">adminerp.shreeyashgroup.com</div>
            </div>

            <div class="login-right">
                <div class="login-card">
                    <div class="login-kicker">Secure Login</div>
                    <h2>Admin Login</h2>
                    <div class="subtitle">Enter your credentials to continue to the dashboard.</div>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <div class="input-field">
                                <i class="bi bi-envelope input-icon"></i>
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ old('email') }}"
                                    placeholder="Enter your email"
                                    required
                                >
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="password-field">
                                <i class="bi bi-lock input-icon"></i>
                                <input
                                    type="password"
                                    name="password"
                                    id="adminPassword"
                                    class="form-control"
                                    placeholder="Enter your password"
                                    required
                                >
                                <button
                                    type="button"
                                    class="toggle-password"
                                    id="togglePassword"
                                    aria-label="Show password"
                                    aria-pressed="false"
                                >
                                    <svg class="eye-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                    <svg class="eye-off-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M3 3l18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M10.6 10.6A2 2 0 0 0 13.4 13.4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M9.9 5.3A10.5 10.5 0 0 1 12 5c6.5 0 10 7 10 7a18.6 18.6 0 0 1-3.2 4.1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M6.6 6.7C3.6 8.7 2 12 2 12s3.5 7 10 7c1.8 0 3.4-.5 4.7-1.2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="login-btn">
                            Login <i class="bi bi-arrow-right ms-1"></i>
                        </button>
                    </form>

                    <div class="small-note">
                        Admin and Super Admin only
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('adminPassword');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', () => {
            const isPasswordVisible = passwordInput.type === 'text';

            passwordInput.type = isPasswordVisible ? 'password' : 'text';
            togglePassword.classList.toggle('is-visible', !isPasswordVisible);
            togglePassword.setAttribute('aria-label', isPasswordVisible ? 'Show password' : 'Hide password');
            togglePassword.setAttribute('aria-pressed', String(!isPasswordVisible));
        });
    </script>

</body>
</html>
