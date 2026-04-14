@extends('layouts.admin')

@section('title', $pageTitle)
@section('page_title', $pageTitle)

@section('content')
<div class="page-card">
    <h5 class="mb-3">{{ $pageTitle }}</h5>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Project Name</th>
                    <th>Customer Name</th>
                    <th>Location</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $key => $order)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->project_name ?? '-' }}</td>
                        <td>{{ $order->name ?? $order->customer_name ?? '-' }}</td>
                        <td>{{ $order->city ?? $order->location ?? '-' }}</td>
                        <td>{{ $order->created_at ? $order->created_at->format('d M Y') : '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No contractor orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection