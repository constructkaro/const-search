@extends('layouts.admin')

@section('title', 'Customers')

@section('content')
<style>
    .customer-page { padding: 24px; background: #f4f7fb; min-height: 100vh; }
    .customer-heading { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 20px; }
    .customer-heading h2 { margin: 0; color: #1c2c3e; font-size: 28px; font-weight: 700; }
    .customer-panel { background: #fff; border: 1px solid #e5ebf2; border-radius: 12px; padding: 22px; margin-bottom: 20px; }
    .customer-panel h3 { margin: 0 0 18px; font-size: 18px; color: #1c2c3e; font-weight: 700; }
    .customer-form { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; }
    .customer-form label { display: block; margin-bottom: 6px; font-size: 13px; font-weight: 600; color: #34445a; }
    .customer-form input { width: 100%; min-height: 42px; border: 1px solid #dbe3ec; border-radius: 8px; padding: 9px 11px; }
    .customer-form input:focus { outline: 2px solid #f25c0530; border-color: #f25c05; }
    .customer-form .wide { grid-column: 1 / -1; }
    .customer-submit { border: 0; border-radius: 8px; background: #f25c05; color: #fff; padding: 10px 16px; font-weight: 700; }
    .customer-tools { display: flex; gap: 8px; margin-bottom: 14px; }
    .customer-tools input { flex: 1; min-width: 150px; border: 1px solid #dbe3ec; border-radius: 8px; padding: 9px 12px; }
    .customer-table { width: 100%; border-collapse: collapse; }
    .customer-table th, .customer-table td { text-align: left; padding: 12px; border-bottom: 1px solid #edf1f5; }
    .customer-table th { background: #f8fafc; color: #34445a; font-size: 13px; }
    .customer-table td { color: #425166; font-size: 14px; }
    .login-state { display: inline-block; border-radius: 20px; padding: 4px 9px; font-size: 12px; background: #e7f8ef; color: #087443; }
    .login-state.pending { background: #fff3d6; color: #8a5b00; }
    @media (max-width: 700px) {
        .customer-page { padding: 16px; }
        .customer-form { grid-template-columns: 1fr; }
        .customer-form .wide { grid-column: auto; }
        .customer-table { min-width: 650px; }
        .table-scroll { overflow-x: auto; }
    }
</style>

<main class="customer-page">
    <div class="customer-heading">
        <h2>Customers</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <section class="customer-panel">
        <h3>Create customer login</h3>
        <p class="text-muted">Set a mobile number and password for the customer. Saving an existing mobile updates that customer’s login.</p>
        <form method="POST" action="{{ route('admin.customers.store') }}" class="customer-form">
            @csrf
            <div>
                <label for="customer-name">Customer name</label>
                <input id="customer-name" name="name" value="{{ old('name') }}" required maxlength="255">
                @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label for="customer-mobile">Mobile number</label>
                <input id="customer-mobile" name="mobile" value="{{ old('mobile') }}" required inputmode="numeric" pattern="[0-9]{10}" maxlength="10">
                @error('mobile')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label for="customer-email">Email (optional)</label>
                <input id="customer-email" name="email" type="email" value="{{ old('email') }}" maxlength="255">
                @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label for="customer-password">Password</label>
                <input id="customer-password" name="password" type="password" required minlength="8" autocomplete="new-password">
                @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label for="customer-password-confirmation">Confirm password</label>
                <input id="customer-password-confirmation" name="password_confirmation" type="password" required minlength="8" autocomplete="new-password">
            </div>
            <div class="wide">
                <button class="customer-submit" type="submit">Save customer login</button>
            </div>
        </form>
    </section>

    <section class="customer-panel">
        <h3>Customer accounts</h3>
        <form method="GET" action="{{ route('admin.customers.index') }}" class="customer-tools">
            <input name="search" value="{{ request('search') }}" placeholder="Search name, mobile, or email">
            <button class="btn btn-dark" type="submit">Search</button>
            <a class="btn btn-outline-secondary" href="{{ route('admin.customers.index') }}">Reset</a>
        </form>
        <div class="table-scroll">
            <table class="customer-table">
                <thead>
                    <tr><th>Name</th><th>Mobile</th><th>Email</th><th>Login</th><th>Projects</th></tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td>{{ $customer->name ?: 'Customer' }}</td>
                            <td>{{ $customer->mobile }}</td>
                            <td>{{ $customer->email ?: '—' }}</td>
                            <td><span class="login-state {{ $customer->has_password ? '' : 'pending' }}">{{ $customer->has_password ? 'Enabled' : 'Password needed' }}</span></td>
                            <td>{{ $customer->projects_count }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No customers found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $customers->links() }}</div>
    </section>
</main>
@endsection