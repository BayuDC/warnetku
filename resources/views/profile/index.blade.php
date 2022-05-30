@extends('layouts.main')
@section('content')

<h1 class="pb-3">My Profile</h1>

@include('components.notif')

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
            <a href="/me/edit" class="btn btn-primary">Edit</a>
            <a href="/me/change-password" class="btn btn-primary">Change Password</a>
        </div>
    </div>
</div>

@endsection