@extends('vendor.layouts.vapp')

@section('title', 'Vendor Dashboard')
@section('page_title', 'Dashboard')

@section('content')

<div class="grid-3" style="margin-bottom: 24px;">
    <div class="stat-card">
        <h3>Total Projects</h3>
        <h2>12</h2>
    </div>

    <div class="stat-card">
        <h3>Pending Leads</h3>
        <h2>5</h2>
    </div>

    <div class="stat-card">
        <h3>Profile Status</h3>
        <h2>Active</h2>
    </div>
</div>

<div class="card">
    <h2 style="margin-bottom: 10px; color:#111633;">Welcome, {{ session('vendor_name') }}</h2>
    <p style="color:#667085;">
        This is your vendor dashboard. Here you can manage your profile, projects, documents, and account settings.
    </p>
</div>

@endsection