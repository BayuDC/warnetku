@extends('layouts.main')
@section('content')

<h1 class="pb-3">Edit Computer</h1>

<div class="row">
    <div class="col-lg-4 col-md-8">
        <form action="{{ route('computer.update', $computer->id) }}" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" value="{{ old('name') ? old('name') : $computer->name }}" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required>
                @error('name')
                <small class="text-danger text-end d-block mt-2">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-4">
                <label for="type" class="form-label">Type</label>
                <select name="type" id="type" class="form-select @error('type') is-invalid @enderror">
                    <option selected></option>
                    @foreach($types as $type)
                    <option value="{{ $type->id }}" @if($type->id == (old('type') ? old('type') : $computer->type_id)) selected @endif>
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