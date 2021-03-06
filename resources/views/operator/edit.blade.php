@extends('layouts.main')
@section('content')

<h1 class="pb-3">Edit Operator</h1>

<div class="row">
    <div class="col-lg-4 col-md-8">
        <form action="{{ route('operator.update', $operator->id) }}" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="fullname" class="form-label">Full Name</label>
                <input type="text" value="{{ old('fullname') ?  old('fullname') : $operator->fullname }}" name="fullname" id="fullname" class="form-control @error('fullname') is-invalid @enderror" required>
                @error('fullname')
                <small class="text-danger text-end d-block mt-2">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" value="{{ old('username') ? old('username') : $operator->username }}" name="username" id="username" class="form-control @error('username') is-invalid @enderror" required>
                @error('username')
                <small class="text-danger text-end d-block mt-2">{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-success d-block" type="submit">Save</button>
        </form>
    </div>
</div>

@endsection