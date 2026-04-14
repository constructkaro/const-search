@extends('layouts.admin')

@section('title', $pageTitle)
@section('page_title', $pageTitle)

@section('content')
<div class="row g-4">

    <div class="col-md-6 col-xl-4">
        <div class="stat-card">
            <h5>Contractor Orders</h5>
            <h2>{{ $contractorOrders->count() }}</h2>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="stat-card">
            <h5>Interior Orders</h5>
            <h2>{{ $interiorOrders->count() }}</h2>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="stat-card">
            <h5>Survey Orders</h5>
            <h2>{{ $surveyOrders->count() }}</h2>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="stat-card">
            <h5>Testing Orders</h5>
            <h2>{{ $testingOrders->count() }}</h2>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="stat-card">
            <h5>BOQ Orders</h5>
            <h2>{{ $boqOrders->count() }}</h2>
        </div>
    </div>

</div>
@endsection