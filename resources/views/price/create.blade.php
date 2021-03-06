@extends('layouts.main')
@section('content')

<h1 class="pb-3">Add Rental Price</h1>

<div class="row">
    <div class="col-lg-4 col-md-8">
        <form action="{{ route('price.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" value="{{ old('name') }}" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required>
                @error('name')
                <small class="text-danger text-end d-block mt-2">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" value="{{ old('price') }}" name="price" id="price" min="1000" step="500" class="form-control @error('price') is-invalid @enderror" required>
                @error('price')
                <small class="text-danger text-end d-block mt-2">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Duration</label>
                <input type="number" value="{{ old('duration') }}" name="duration" id="duration" min="1" max="24" class="form-control @error('duration') is-invalid @enderror" required>
                @error('duration')
                <small class="text-danger text-end d-block mt-2">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-4">
                <label for="type" class="form-label">Computer Type</label>
                <select name="type" id="type" class="form-select @error('type') is-invalid @enderror">
                    <option selected></option>
                    @foreach($types as $type)
                    <option value="{{ $type->id }}" @if($type->id == old('type')) selected @endif>
                        {{ $type->name }}
                    </option>
                    @endforeach
                </select>
                @error('type')
                <small class="text-danger text-end d-block mt-2">{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-success d-block" type="submit">Save</button>
        </form>
    </div>
</div>

@endsection