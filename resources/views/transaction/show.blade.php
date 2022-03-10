@extends('layouts.main')
@section('content')

<h1 class="pb-3">Detail Transaction</h1>
<div class="row">
    <div class="col-lg-4 col-md-8">
        <table class="table">
            <tbody>
                <tr>
                    <th scope="row" class="col-3">Customer</th>
                    <td>{{ $transaction->customer }}</td>
                </tr>
                <tr>
                    <th scope="row" class="col-3">Duration</th>
                    <td>{{ $transaction->duration }} Hour{{ $transaction->duration > 1 ? 's' : '' }}</td>
                </tr>
                <tr>
                    <th scope="row" class="col-3">Time Start</th>
                    <td>{{ $transaction['time_start'] }}</td>
                </tr>
                <tr>
                    <th scope="row" class="col-3">Time End</th>
                    <td>{{ $transaction['time_end'] }}</td>
                </tr>
                <tr>
                    <th>Total Bill</th>
                    <td>Rp. {{ $transaction->bill }}</td>
                </tr>
                <tr>
                    <th>Computer</th>
                    <td>{{ $transaction->computer->name }}</td>
                </tr>
                <tr>
                    <th>Added By</th>
                    <td>{{ $transaction->operator->fullname }}</td>
                </tr>
            </tbody>
        </table>
        <div class="pt-2">
            <!-- Button Edit -->
            <!-- Button Delete -->
        </div>
    </div>
</div>

@endsection