@extends('layouts.admin')

@section('title', 'Vendor Management')
@section('page_title', 'Vendor Management')

@section('content')

<div class="page-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">All Vendors</h5>

        <span class="text-muted small">
            @if($allvendors->total() > 0)
                Showing {{ $allvendors->firstItem() }}–{{ $allvendors->lastItem() }} of {{ $allvendors->total() }}
            @else
                Showing 0 vendors
            @endif
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

            <select name="city" class="form-select form-select-sm" style="min-width:170px;">
                <option value="">All Cities</option>

                @foreach($cities as $city)
                    <option value="{{ $city->id }}" {{ request('city') == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-auto">
            <label class="form-label small text-muted mb-1">Work Type</label>

            <select name="work_type" class="form-select form-select-sm" style="min-width:170px;">
                <option value="">All Work Types</option>
                <option value="Architect" {{ request('work_type') == 'Architect' ? 'selected' : '' }}>Architect</option>
                <option value="Contractor" {{ request('work_type') == 'Contractor' ? 'selected' : '' }}>Contractor</option>
                <option value="Interior" {{ request('work_type') == 'Interior' ? 'selected' : '' }}>Interior</option>
                <option value="Surveyor" {{ request('work_type') == 'Surveyor' ? 'selected' : '' }}>Surveyor</option>
                <option value="BOQ" {{ request('work_type') == 'BOQ' ? 'selected' : '' }}>BOQ</option>
            </select>
        </div>

        <div class="col-auto">
            <label class="form-label small text-muted mb-1">Search</label>

            <input type="text"
                   name="search"
                   class="form-control form-control-sm"
                   placeholder="Name, company, mobile..."
                   value="{{ request('search') }}"
                   style="min-width:220px;">
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
                    <th style="min-width:260px;">Remark</th>
                    <th style="width:170px;">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($allvendors as $key => $vendor)
                    <tr>
                        <td class="text-muted">
                            {{ $allvendors->firstItem() + $key }}
                        </td>

                        <td class="fw-medium">
                            {{ $vendor->full_name ?? '-' }}
                        </td>

                        <td>
                            {{ $vendor->mobile ?? '-' }}
                        </td>

                        <td class="text-muted">
                            {{ $vendor->email ?? '-' }}
                        </td>

                        <td>
                            {{ $vendor->company_name ?? '-' }}
                        </td>

                        <td>
                            @if(!empty($vendor->city) && $vendor->city != '-')
                                @foreach(explode(',', $vendor->city) as $cityName)
                                    <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary mb-1">
                                        {{ trim($cityName) }}
                                    </span>
                                @endforeach
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            @if(!empty($vendor->work_type) && $vendor->work_type != '-')
                                @foreach(explode(',', $vendor->work_type) as $workType)
                                    <span class="badge bg-success mb-1">
                                        {{ trim($workType) }}
                                    </span>
                                @endforeach
                            @else
                                <span class="badge bg-danger">
                                    No Service Provider Registered
                                </span>
                            @endif
                        </td>

                        <td>
                            {{ $vendor->business_address ?? '-' }}
                        </td>

                        <td>
                            {{ $vendor->business_entity ?? '-' }}
                        </td>

                        <td class="text-muted">
                            {{ $vendor->pincode ?? '-' }}
                        </td>

                        <td>
                            @if(!empty($vendor->area) && $vendor->area != '-')
                                @foreach(explode(',', $vendor->area) as $areaName)
                                    <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary mb-1">
                                        {{ trim($areaName) }}
                                    </span>
                                @endforeach
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            <form method="POST" action="{{ route('admin.vendors.remark.update', $vendor->id) }}">
                                @csrf

                                <textarea name="remark"
                                          class="form-control form-control-sm mb-2"
                                          rows="2"
                                          placeholder="Add remark...">{{ $vendor->remark ?? '' }}</textarea>

                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                    Update
                                </button>
                            </form>
                        </td>

                        <td>
                            <a href="{{ route('admin.vendors.forms', $vendor->id) }}"
                               class="btn btn-sm btn-primary">
                                Check Inserted Forms
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13" class="text-center py-4 text-muted">
                            No vendors found.
                        </td>
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