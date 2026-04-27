@extends('layouts.admin')

@section('title', 'Vendor Management')
@section('page_title', 'Vendor Management')

@section('content')
<div class="page-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">All Vendors</h5>
        <span class="text-muted small">
            Showing {{ $allvendors->firstItem() }}–{{ $allvendors->lastItem() }} of {{ $allvendors->total() }}
        </span>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Filters --}}
    <form method="GET" action="{{ route('admin.allvendors') }}" class="row g-2 mb-3 align-items-end">
        <div class="col-auto">
            <label class="form-label small text-muted mb-1">City</label>
            <select name="city" class="form-select form-select-sm" style="min-width:150px;">
                <option value="">All Cities</option>
                @foreach($cities as $city)
                    <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                        {{ $city }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <label class="form-label small text-muted mb-1">Work Type</label>
            
           <select name="work_type" class="form-select form-select-sm" style="min-width:160px;">
            <option value="">All Work Types</option>
            <option value="Architect"   {{ request('work_type') == 'Architect'   ? 'selected' : '' }}>Architect</option>
            <option value="Contractor"  {{ request('work_type') == 'Contractor'  ? 'selected' : '' }}>Contractor</option>
        </select>
        </div>
        <div class="col-auto">
            <label class="form-label small text-muted mb-1">Search</label>
            <input type="text" name="search" class="form-control form-control-sm"
                   placeholder="Name or company..." value="{{ request('search') }}" style="min-width:200px;">
        </div>
        <div class="col-auto d-flex gap-2">
            <button type="submit" class="btn btn-sm btn-primary">Apply</button>
            <a href="{{ route('admin.allvendors') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
        </div>
    </form>

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-bordered align-middle table-hover">
            <thead class="table-light">
                <tr>
                    <th style="width:55px;">#</th>
                    <th>Full Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Company Name</th>
                    <th>City</th>
                    <th>Work Type</th>
                    <th>Business Address</th>
                    <th>Business Entity</th>
                    <th>Pincode</th>
                    <th>Area</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($allvendors as $key => $vendor)
                    <tr>
                        <td class="text-muted">{{ $allvendors->firstItem() + $key }}</td>
                        <td class="fw-medium">{{ $vendor->full_name ?? '-' }}</td>
                        <td>{{ $vendor->mobile ?? '-' }}</td>
                        <td class="text-muted">{{ $vendor->email ?? '-' }}</td>
                        <td>{{ $vendor->company_name ?? '-' }}</td>
                        <td>
                            @if($vendor->city)
                                <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary">
                                    {{ $vendor->city }}
                                </span>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($vendor->work_type)
                                <span class="badge bg-success">{{ $vendor->work_type }}</span>
                            @else
                                <span class="badge bg-danger">No Service Provider Registered</span>
                            @endif
                        </td>
                        <td>{{ $vendor->business_address ?? '-' }}</td>
                        <td>{{ $vendor->business_entity ?? '-' }}</td>
                        <td class="text-muted">{{ $vendor->pincode ?? '-' }}</td>
                        <td>{{ $vendor->area ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.vendors.forms', $vendor->id) }}" 
                            class="btn btn-sm btn-primary">
                                Check Inserted Forms
                            </a>
                        </td>
                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center py-4 text-muted">No vendors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-between align-items-center mt-3">
        <p class="text-muted small mb-0">
            Page {{ $allvendors->currentPage() }} of {{ $allvendors->lastPage() }}
        </p>
        {{ $allvendors->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection