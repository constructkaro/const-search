@extends('layouts.app')

@section('title', 'Customer Login')

@section('content')
<style>
    .customer-login-page { min-height: 65vh; display: grid; place-items: center; padding: 40px 18px; background: #f3f7fa; }
    .customer-login-box { width: min(100%, 440px); padding: 30px; background: #fff; border: 1px solid #dce6ed; border-radius: 12px; box-shadow: 0 12px 34px #1c2c3e12; }
    .customer-login-box h1 { margin: 0 0 8px; color: #1c2c3e; font-size: 26px; font-weight: 750; }
    .customer-login-box p { color: #64748b; margin-bottom: 24px; }
    .customer-login-box label { display: block; margin: 14px 0 6px; font-weight: 650; color: #34445a; }
    .customer-login-box input { width: 100%; height: 46px; border: 1px solid #d3dee8; border-radius: 8px; padding: 10px 12px; }
    .customer-login-box input:focus { outline: 2px solid #f25c0530; border-color: #f25c05; }
    .customer-login-button { width: 100%; margin-top: 20px; border: 0; border-radius: 8px; padding: 12px; background: #f25c05; color: #fff; font-weight: 700; }
</style>

<main class="customer-login-page">
    <section class="customer-login-box">
        <h1>Customer login</h1>
        <p>Sign in with the mobile number and password provided by the admin.</p>
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('customer.login.submit') }}">
            @csrf
            <label for="login-mobile">Mobile number</label>
            <input id="login-mobile" name="mobile" value="{{ old('mobile') }}" inputmode="numeric" autocomplete="tel" required>
            <label for="login-password">Password</label>
            <input id="login-password" name="password" type="password" autocomplete="current-password" required>
            <button class="customer-login-button" type="submit">Login</button>
        </form>
    </section>
</main>
@endsection