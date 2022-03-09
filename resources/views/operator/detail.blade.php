@extends('layouts.main')
@section('content')

<h1 class="pb-3">Detail Operator - {{ $operator->fullname }}</h1>
<div class="row">
    <div class="col-lg-4 col-md-8">
        <table class="table">
            <tbody>
                <tr>
                    <th scope="row" class="col-2">Fullname</th>
                    <td>{{ $operator->fullname }}</td>
                </tr>
                <tr>
                    <th scope="row" class="col-2">Username</th>
                    <td>{{ $operator->username }}</td>
                </tr>
                <tr>
                    <th scope="row" class="col-2">Role</th>
                    <td>{{ $operator->role->name }}</td>
                </tr>
            </tbody>
        </table>
        <div class="pt-2">
            <a href="/operator/{{ $operator->username }}/edit" class="btn btn-primary">Edit</a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete">Delete</button>

            <div class="modal fade" id="modalDelete" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                        </div>
                        <div class="modal-body">
                            Are you sure to delete {{ $operator->fullname }}?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form action="/operator/{{ $operator->username }}" method="post">
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