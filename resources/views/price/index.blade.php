@extends('layouts.main')
@section('content')

<div class="mb-3 d-sm-flex d-block align-items-center">
    <h1 class="">Manage Rental Prices</h1>
    <a href="/price/create" class="btn btn-outline-success ms-auto btn-lg">Add Rental Price</a>
</div>

<div class="row">
    <h3>Gaming</h3>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Price</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gaming_prices as $i => $rental)
                <tr>
                    <th scope="row" class="col-1">{{ $i + 1 }}</th>
                    <td>Rp. {{ $rental->price }}</td>
                    <td>{{ $rental->duration }} Hour{{ $rental->duration > 1 ? 's' : '' }}</td>
                    <td class="col-1">
                        <a href="/price/{{ $rental->id }}" class="btn btn-sm btn-primary">
                            Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <h3>Office</h3>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Price</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach($office_prices as $i => $rental)
                <tr>
                    <th scope="row" class="col-1">{{ $i + 1 }}</th>
                    <td>Rp. {{ $rental->price }}</td>
                    <td>{{ $rental->duration }} Hours</td>
                    <td class="col-1">
                        <a href="/price/{{ $rental->id }}" class="btn btn-sm btn-primary">
                            Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection