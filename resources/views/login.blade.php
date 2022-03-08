@extends('layouts.blank')
@section('content')

<div class="row px-3 d-flex justify-content-center align-items-center vh-100">
    <div class="col p-4 bg-light border" style="max-width: 400px;">
        <form action="/login" method="post">
            @csrf
            <div class="mb-4">
                <h2>Warnetku - Login</h2>
            </div>
            <div class="mb-2">
                <label for="username" class="form-label">Username</label>
                <input type="text" value="{{ old('username') }}" name="username" id="username" class="form-control @error('username') is-invalid @enderror">
                @error('username')
                <small class="text-danger text-end d-block mt-2">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                <small class="text-danger text-end d-block mt-2">{{ $message }}</small>
                @enderror
            </div>
            @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <div>
                <button class="btn btn-success ms-auto d-block" type="submit">Login</button>
            </div>
        </form>
    </div>
</div>

@endsection