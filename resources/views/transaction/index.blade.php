@extends('layouts.main')
@section('content')

<div class="mb-3 d-sm-flex d-block align-items-center justify-content-between">
    <h1>Manage Transactions</h1>
    <a href="" class="btn btn-lg btn-outline-success">Add Transaction</a>
</div>

<div class="row">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Duration</th>
                    <th>Bill</th>
                    <th>Computer</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $i => $transaction)
                <tr>
                    <th class="col-1">{{ $i + 1 }}</th>
                    <td>{{ $transaction->customer }}</td>
                    <td>{{ $transaction->duration }} Hour</td>
                    <td>Rp. {{ $transaction->bill }}</td>
                    <td>{{ $transaction->computer->name }}</td>
                    <td class="col-1">
                        <a href="/transaction/{{ $transaction->id }}" class="btn btn-sm btn-primary">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection