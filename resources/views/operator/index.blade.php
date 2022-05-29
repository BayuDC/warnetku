@extends('layouts.main')
@section('content')

<div class="mb-3 d-sm-flex d-block align-items-center">
    <h1 class="">Manage Operators</h1>
    @can('manage-operator')
    <a href="/operator/create" class="btn btn-outline-success ms-auto btn-lg">Add Operator</a>
    @endcan
</div>

@include('components.notif')

<div class="row">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Role</th>
                    <th scope="col">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach($operators as $i => $operator)
                <tr>
                    <th scope="row" class="col-1">{{ $i + 1 }}</th>
                    <td>{{ $operator->fullname }}</td>
                    <td>{{ $operator->username }}</td>
                    <td>{{ $operator->role->name }}</td>
                    <td class="col-1">
                        <a href="/operator/{{ $operator->username }}" class="btn btn-sm btn-primary">
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