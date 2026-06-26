<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1c2c3e 0%, #0f1722 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1050px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.25);
        }

        .login-left {
            background: linear-gradient(180deg, #1c2c3e 0%, #24384f 100%);
            color: #fff;
            padding: 60px 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-left h1 {
            font-size: 40px;
            font-weight: 800;
            margin-bottom: 16px;
        }

        .login-left p {
            font-size: 16px;
            line-height: 1.8;
            color: rgba(255,255,255,0.88);
            margin-bottom: 0;
        }

        .brand-badge {
            display: inline-block;
            background: #f25c05;
            color: #fff;
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 18px;
            width: fit-content;
        }

        .login-right {
            padding: 50px 40px;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 380px;
        }

        .login-card h2 {
            font-size: 30px;
            font-weight: 800;
            color: #1c2c3e;
            margin-bottom: 8px;
        }

        .login-card .subtitle {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 28px;
        }

        .form-label {
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .form-control {
            height: 48px;
            border-radius: 12px;
            border: 1px solid #d1d5db;
            box-shadow: none;
            padding: 0 14px;
        }

        .form-control:focus {
            border-color: #f25c05;
            box-shadow: 0 0 0 0.15rem rgba(242, 92, 5, 0.15);
        }

        .password-field {
            position: relative;
        }

        .password-field .form-control {
            padding-right: 52px;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 12px;
            width: 34px;
            height: 34px;
            border: 0;
            border-radius: 8px;
            background: transparent;
            color: #6b7280;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transform: translateY(-50%);
            cursor: pointer;
            transition: color 0.2s ease, background 0.2s ease;
        }

        .toggle-password:hover,
        .toggle-password:focus {
            color: #f25c05;
            background: rgba(242, 92, 5, 0.08);
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
            height: 50px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(90deg, #1c2c3e 0%, #f25c05 100%);
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            transition: 0.3s ease;
        }

        .login-btn:hover {
            opacity: 0.95;
            transform: translateY(-1px);
        }

        .form-check-label {
            color: #4b5563;
            font-size: 14px;
        }

        .alert {
            border-radius: 12px;
            font-size: 14px;
        }

        .small-note {
            margin-top: 20px;
            text-align: center;
            color: #6b7280;
            font-size: 13px;
        }

        @media (max-width: 991px) {
            .login-wrapper {
                grid-template-columns: 1fr;
                max-width: 500px;
            }

            .login-left {
                display: none;
            }

            .login-right {
                padding: 35px 22px;
            }
        }
    </style>
</head>
<body>

    <div class="container py-4">
        <div class="login-wrapper mx-auto">

            <div class="login-left">
                <span class="brand-badge">ConstructKaro Admin Panel</span>
                <h1>Welcome Back</h1>
                <p>
                    Login to manage admins, projects, orders, users, and platform operations from one central dashboard.
                </p>
            </div>

            <div class="login-right">
                <div class="login-card">
                    <h2>Admin Login</h2>
                    <div class="subtitle">Sign in to continue to your dashboard</div>

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
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="password-field">
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
                            Login
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
