@extends('layouts.main')
@section('content')

<h1 class="pb-3">Manage Rental Prices</h1>

<div class="row">
    <h3>Gaming</h3>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Price</th>
                    <th scope="col">Duration</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gaming_prices as $i => $rental)
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
<div class="row">
    <h3>Office</h3>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Price</th>
                    <th scope="col">Duration</th>
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