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
                    <th>Computer</th>
                    <td>{{ $transaction->computer->name }}</td>
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
                    <th>Status</th>
                    <td>{{ $transaction->status }}</td>
                </tr>
                <tr>
                    <th>Added By</th>
                    <td>{{ $transaction->operator->fullname }}</td>
                </tr>
            </tbody>
        </table>
        @can('manage-transaction', $transaction)
        <div class="pt-2">
            <a href="/transaction/{{ $transaction->id }}/edit" class="btn btn-primary">Edit</a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete">Delete</button>

            <div class="modal fade" id="modalDelete" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                        </div>
                        <div class="modal-body">
                            Are you sure to delete this transaction?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form action="/transaction/{{ $transaction->id }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>
</div>

@endsection