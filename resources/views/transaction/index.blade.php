@extends('layouts.main')
@section('content')

<div class="mb-3 d-sm-flex d-block align-items-center justify-content-between">
    <h1>Transactions</h1>
    <div>
        <a href="{{ route('transaction.all') }}" class="btn btn-lg btn-outline-primary">Transaction History</a>
        <a href="{{ route('transaction.create') }}" class="btn btn-lg btn-outline-success">Add Transaction</a>
    </div>
</div>

@include('components.notif')

<div class="row">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Computer</th>
                    <th>Duration</th>
                    <th>Remaining time</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $i => $transaction)
                <tr>
                    <th class="col-1">{{ $i + 1 }}</th>
                    <td>{{ $transaction->customer }}</td>
                    <td>{!! $transaction->computer?->name ??'<i>Deleted</i>' !!}</td>
                    <td>{{ $transaction->duration_pretty  }}</td>
                    <td>{{ $transaction['remaining_time'] }}</td>
                    <td class="col-1">
                        <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-sm btn-primary">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection