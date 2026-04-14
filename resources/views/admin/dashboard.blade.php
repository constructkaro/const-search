@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card bg-white">
            <h5>Total Users</h5>
            <h2>{{ $totalUsers }}</h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card bg-white">
            <h5>Total Admins</h5>
            <h2>{{ $totalAdmins }}</h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card bg-white">
            <h5>Total Super Admins</h5>
            <h2>{{ $totalSuperAdmins }}</h2>
        </div>
    </div>
</div>

<div class="page-card">
    <h5 class="mb-3">Quick Access</h5>
    <div class="row g-3">
        <div class="col-md-3">
            <a href="#" class="btn btn-primary w-100">Manage Projects</a>
        </div>
        <div class="col-md-3">
            <a href="#" class="btn btn-warning w-100 text-white">Manage Orders</a>
        </div>

        @if(auth()->user()->role === 'super_admin')
            <div class="col-md-3">
                <a href="{{ route('admin.users.index') }}" class="btn btn-dark w-100">Manage Users</a>
            </div>
        @endif
    </div>
</div>
@endsection