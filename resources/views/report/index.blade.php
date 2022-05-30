@extends('layouts.main')
@section('content')

<h1 class="mb-4">Report</h1>

<div class="row">
    <div class="col-md-6 text-light mb-4">
        <div class="container-fluid py-4 bg-primary bg-gradient">
            <h1 class="fs-2">Today's Income</h1>
            <p class="display-5 fw-bold">
                Rp. {{ $daily['income'] }}
            </p>
            <div class="fs-5">
                Total Transaction: <span class="fw-bold">{{ $daily['count'] }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 text-light mb-4">
        <div class="container-fluid py-4 bg-danger bg-gradient">
            <h1 class="fs-2">This Month's Income</h1>
            <p class="display-5 fw-bold">
                Rp. {{ $monthly['income'] }}
            </p>
            <div class="fs-5">
                Total Transaction: <span class="fw-bold">{{ $monthly['count'] }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 text-light mb-4">
        <div class="container-fluid py-4 bg-success bg-gradient">
            <h1 class="fs-2">This Year's Income</h1>
            <p class="display-5 fw-bold">
                Rp. {{ $yearly['income'] }}
            </p>
            <div class="fs-5">
                Total Transaction: <span class="fw-bold">{{ $yearly['count'] }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 text-light mb-4">
        <div class="container-fluid py-4 bg-dark bg-gradient">
            <h1 class="fs-2">Life Time Income</h1>
            <p class="display-5 fw-bold">
                Rp. {{ $lifetime['income'] }}
            </p>
            <div class="fs-5">
                Total Transaction: <span class="fw-bold">{{ $lifetime['count'] }}</span>
            </div>
        </div>
    </div>

</div>

@endsection