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
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Enter your password"
                                required
                            >
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

</body>
</html>