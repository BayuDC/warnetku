@extends('layouts.main')
@section('content')

<h1 class="pb-3">Update My Password</h1>

<div class="row">
    <div class="col-lg-4 col-md-8">
        <form action="{{ route('me.update-password') }}" method="post">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="password_old" class="form-label">Current Password</label>
                <input type="password" name="password_old" id="password_old" class="form-control @error('password_old') is-invalid @enderror" required>
                @error('password_old')
                <small class="text-danger text-end d-block mt-2">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                <small class="text-danger text-end d-block mt-2">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>
                @error('password_confirmation')
                <small class="text-danger text-end d-block mt-2">{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-success d-block" type="submit">Save</button>
        </form>
    </div>
</div>

@endsection