<!DOCTYPE html>
<html>
<head>
    <title>Create Password</title>
</head>
<body>
    <h2>Create Password</h2>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('vendor.password.setup.save') }}" method="POST">
        @csrf
        <input type="hidden" name="mobile" value="{{ $mobile }}">

        <div>
            <label>Mobile</label>
            <input type="text" value="{{ $mobile }}" readonly>
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <button type="submit">Create Password</button>
    </form>
</body>
</html>