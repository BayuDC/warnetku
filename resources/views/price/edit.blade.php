@extends('layouts.main')
@section('content')

<h1 class="pb-3">Edit Rental Price</h1>

<div class="row">
    <div class="col-lg-4 col-md-8">
        <form action="/price/{{ $rental->id }}" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" value="{{ old('price') ? old('price') : $rental->price }}" name="price" id="price" class="form-control @error('price') is-invalid @enderror" required>
                @error('price')
                <small class="text-danger text-end d-block mt-2">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Duration</label>
                <input type="text" value="{{ old('duration') ? old('duration') : $rental->duration }}" name="duration" id="duration" class="form-control @error('duration') is-invalid @enderror" required>
                @error('duration')
                <small class="text-danger text-end d-block mt-2">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-4">
                <label for="type" class="form-label">Type</label>
                <select name="type" id="type" class="form-select @error('type') is-invalid @enderror">
                    <option selected></option>
                    @foreach($types as $type)
                    <option value="{{ $type->id }}" @if((old('type') ? old('type') : $rental->type_id)==$type->id) selected @endif>
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