<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vendor Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #111633 0%, #1a1f47 100%);
        }

        .auth-wrap {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-card {
            width: 100%;
            max-width: 440px;
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.18);
        }

        .auth-card h2 {
            font-size: 34px;
            margin-bottom: 10px;
            color: #111633;
        }

        .auth-card p {
            color: #667085;
            margin-bottom: 22px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #111633;
        }

        .form-group input {
            width: 100%;
            height: 52px;
            border: 1px solid #d5d9e2;
            border-radius: 14px;
            padding: 0 16px;
            font-size: 15px;
        }

        .auth-btn {
            width: 100%;
            height: 52px;
            border: none;
            border-radius: 14px;
            background: #f5a623;
            color: #111633;
            font-size: 17px;
            font-weight: 700;
            cursor: pointer;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .alert-error {
            background: #fef3f2;
            color: #b42318;
        }

        .alert-success {
            background: #ecfdf3;
            color: #027a48;
        }

        .text-danger {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
            display: block;
        }
    </style>
</head>
<body>

<div class="auth-wrap">
    <div class="auth-card">
        <h2>Vendor Login</h2>
        <p>Login with your mobile number and password</p>

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Mobile Number</label>
                <input type="text" name="mobile" value="{{ old('mobile') }}" maxlength="10" placeholder="Enter mobile number">
                @error('mobile')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter password">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="auth-btn">Login</button>
        </form>
    </div>
</div>

</body>
</html>