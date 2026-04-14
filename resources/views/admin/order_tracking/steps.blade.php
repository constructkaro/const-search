@extends('layouts.admin')

@section('title', 'Manage Tracking Steps')
@section('page_title', 'Manage Tracking Steps')

@section('content')
<div class="card p-4 rounded-4 shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1">Manage Steps</h4>
            <p class="mb-0 text-muted">
                Service: <strong>{{ ucfirst($tracking->service_key) }}</strong> |
                Order ID: <strong>#{{ str_pad($tracking->source_id, 3, '0', STR_PAD_LEFT) }}</strong> |
                Template: <strong>{{ $tracking->template_code }}</strong>
            </p>
        </div>
        <a href="{{ route('admin.order_tracking.index') }}" class="btn btn-secondary btn-sm">Back</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Tab</th>
                    <th>Step Order</th>
                    <th>Step Title</th>
                    <th>Description</th>
                    <th>Step Type</th>
                    <th>Status</th>
                    <th>Input Value</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($steps as $step)
                    <tr>
                        <form action="{{ route('admin.order_tracking.step_update', $step->id) }}" method="POST">
                            @csrf
                            <td>{{ ucfirst($step->tab_type) }}</td>
                            <td>{{ $step->step_order }}</td>
                            <td>{{ $step->step_title }}</td>
                            <td>{{ $step->step_description ?: '-' }}</td>
                            <td>{{ ucfirst($step->step_type) }}</td>
                            <td>
                                <select name="status" class="form-select" required>
                                    <option value="completed" {{ $step->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="pending" {{ $step->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="locked" {{ $step->status == 'locked' ? 'selected' : '' }}>Locked</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="input_value" value="{{ $step->input_value }}" class="form-control" placeholder="Enter remarks">
                            </td>
                            <td>
                                <button type="submit" class="btn btn-success btn-sm">Update</button>
                            </td>
                        </form>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No tracking steps found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection