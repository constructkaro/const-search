@extends('layouts.admin')

@section('title', 'Vendor Management')
@section('page_title', 'Vendor Management')

@section('content')
<div class="page-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">All Vendors</h5>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th style="width:70px;">#</th>
                    <th>Full Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Company Name</th>
                    <th>City</th>
                    <th>Business Address</th>
                    <th>Business Entity</th>
                    <th>Pincode</th>
                    <th>Area</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($allvendors as $key => $vendor)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $vendor->full_name ?? '-' }}</td>
                        <td>{{ $vendor->mobile ?? '-' }}</td>
                        <td>{{ $vendor->email ?? '-' }}</td>
                        <td>{{ $vendor->company_name ?? '-' }}</td>
                        <td>{{ $vendor->city ?? '-' }}</td>
                        <td>{{ $vendor->business_address ?? '-' }}</td>
                        <td>{{ $vendor->business_entity ?? '-' }}</td>
                        <td>{{ $vendor->pincode ?? '-' }}</td>
                        <td>{{ $vendor->Area ?? '-' }}</td>
                        <td>
                            {{ !empty($vendor->created_at) ? \Carbon\Carbon::parse($vendor->created_at)->format('d M Y') : '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center">No vendors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection