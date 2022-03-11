@extends('layouts.main')
@section('content')

<h1 class="mb-3">Daily Report</h1>

<div class="row">
    <div class="col-lg-4 col-md-8">
        <table class="table">
            <tbody>
                <tr>
                    <th scope="row" class="col-6">Transactions</th>
                    <td>{{ $transactionCount }} Hour{{ $transactionCount > 1 ? 's' : '' }}</td>
                </tr>
                <tr>
                    <th>Total Income</th>
                    <td>Rp. {{ $totalIncome }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection