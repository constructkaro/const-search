@extends('layouts.admin')

@section('title', 'Order Tracking Assignment')
@section('page_title', 'Order Tracking Assignment')

@section('content')
<div class="card p-4 rounded-4 shadow-sm">
    <h4 class="mb-3">All Orders - Assign Tracking Template</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Order ID</th>
                    <th>Service</th>
                    <th>Type</th>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Template</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($allOrders as $order)
                    @php
                        $trackingKey = $order->service_key . '_' . $order->id;
                        $assigned = $assignedTrackings[$trackingKey] ?? null;
                        $serviceTemplates = $templateOptions[$order->service_key] ?? collect();
                    @endphp

                    <tr>
                        <td>#{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ ucfirst($order->service_key) }}</td>
                        <td>{{ $order->type }}</td>
                        <td>{{ $order->title }}</td>
                        <td>{{ $order->location }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</td>
                        <td>
                            <form action="{{ route('admin.order_tracking.assign') }}" method="POST" class="d-flex gap-2 align-items-center">
                                @csrf
                                <input type="hidden" name="service_key" value="{{ $order->service_key }}">
                                <input type="hidden" name="source_id" value="{{ $order->id }}">
                                <input type="hidden" name="source_table" value="{{ $order->source_table }}">
                                <input type="hidden" name="customer_id" value="{{ $order->customer_id }}">

                                <select name="template_code" class="form-select" required>
                                    <option value="">Select Template</option>
                                    @foreach($serviceTemplates as $template)
                                        <option value="{{ $template->template_code }}"
                                            {{ $assigned && $assigned->template_code == $template->template_code ? 'selected' : '' }}>
                                            {{ $template->template_name }} ({{ $template->template_code }})
                                        </option>
                                    @endforeach
                                </select>
                        </td>
                        <td class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            </form>

                            @if($assigned)
                                <a href="{{ route('admin.order_tracking.steps', [$order->service_key, $order->id]) }}"
                                   class="btn btn-warning btn-sm">
                                    Manage Steps
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection