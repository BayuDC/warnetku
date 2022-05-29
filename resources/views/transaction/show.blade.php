@extends('layouts.main')
@section('content')

<h1 class="pb-3">Detail Transaction</h1>
<div class="row">
    <div class="col-lg-4 col-md-8">
        <table class="table">
            <tbody>
                <tr>
                    <th scope="row" class="col-4">Customer</th>
                    <td>{{ $transaction->customer }}</td>
                </tr>
                <tr>
                    <th>Computer</th>
                    <td>{{ $transaction->computer->name }}</td>
                </tr>
                <tr>
                    <th scope="row" class="">Duration</th>
                    <td>
                        {{ $transaction->duration }}
                        @if($transaction->status == 'Ongoing')
                        @can('manage-transaction', $transaction)
                        <button class="btn badge btn-success ms-2" type="button" data-bs-toggle="modal" data-bs-target="#modalAdd">Add</button>
                        <div class="modal fade" id="modalAdd" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add duration</h5>
                                    </div>
                                    <form action="/transaction/{{ $transaction->id }}/extend" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="modal-body">
                                            <input type="number" min="1" max="24" class="form-control" name="duration">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endcan
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="">Time Start</th>
                    <td>{{ $transaction['time_start'] }}</td>
                </tr>
                <tr>
                    <th scope="row" class="">Time End</th>
                    <td>{{ $transaction['time_end'] }}</td>
                </tr>
                <tr>
                    <th scope="row" class="">Remaining time</th>
                    <td>{{ $transaction['remaining_time'] }}</td>
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