@extends('layouts.main')
@section('content')

<div class="mb-3 d-sm-flex d-block align-items-center">
    <h1 class="">Rental Prices</h1>
    @can('is-owner')
    <a href="{{ route('price.create') }}" class="btn btn-outline-success ms-auto btn-lg">Add Rental Price</a>
    @endcan
</div>

@include('components.notif')

<div class="row g-3">
    @foreach($gaming_prices as $rental)
    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
        <a @can('is-owner') href="{{ route('price.show'. $rental->id) }}" @endcan class="p-4 bg-light border d-block text-dark text-decoration-none">
            <h4>{{ $rental->name }}</h4>
            <h5 class="fw-normal">Rp. {{ $rental->price }}</h5>
            <div class="text-muted d-flex justify-content-between pt-3">
                <div>
                    {{ $rental->type->name }}
                </div>
                <div class="fw-bold">
                    {{ $rental->duration }}
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
<div class="row g-3 mt-1">
    @foreach($office_prices as $rental)
    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
        <a @can('is-owner') href="{{ route('price.show'. $rental->id) }}" @endcan class="p-4 bg-light border d-block text-dark text-decoration-none">
            <h4>{{ $rental->name }}</h4>
            <h5 class="fw-normal">Rp. {{ $rental->price }}</h5>
            <div class="text-muted d-flex justify-content-between pt-3">
                <div>
                    {{ $rental->type->name }}
                </div>
                <div class="fw-bold">
                    {{ $rental->duration }}
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

@endsection