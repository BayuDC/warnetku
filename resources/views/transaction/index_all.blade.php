@extends('layouts.main')
@section('content')

<div class="mb-3 d-sm-flex d-block align-items-center justify-content-between">
    <h1>Transactions History</h1>
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
                    <th>Total Bill</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @php
                $start = ($transactions->currentPage() - 1) * 10 + 1
                @endphp

                @foreach($transactions as $i => $transaction)
                <tr>
                    <th class="col-1">{{ $i + $start }}</th>
                    <td>{{ $transaction->customer }}</td>
                    <td>{!! $transaction->computer?->name ??'<i>Deleted</i>' !!}</td>
                    <td>{{ $transaction->duration_pretty  }}</td>
                    <td>Rp. {{ $transaction['bill'] }}</td>
                    <td class="col-1">
                        <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-sm btn-primary">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $transactions->links() }}
</div>


@endsection