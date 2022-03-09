@extends('layouts.main')
@section('content')

<h1 class="pb-3">Detail Computer - {{ $computer->name }}</h1>
<div class="row">
    <div class="col-lg-4 col-md-8">
        <table class="table">
            <tbody>
                <tr>
                    <th scope="row" class="col-2">Type</th>
                    <td>{{ $computer->type->name }}</td>
                </tr>
                <tr>
                    <th scope="row" class="col-2">Status</th>
                    <td>Idle</td>
                </tr>
            </tbody>
        </table>
        <div class="pt-2">
            <a href="/computer/{{ $computer->id }}/edit" class="btn btn-primary">Edit</a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete">Delete</button>

            <div class="modal fade" id="modalDelete" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                        </div>
                        <div class="modal-body">
                            Are you sure to delete {{ $computer->name }}?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form action="/computer/{{ $computer->id }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection