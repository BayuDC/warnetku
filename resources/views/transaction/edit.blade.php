@extends('layouts.main')
@section('content')

<h1 class="pb-3">Edit Transaction</h1>

<div class="row">
    <div class="col-lg-4 col-md-8">
        <form action="/transaction/{{ $transaction->id }}" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="customer" class="form-label">Customer Name</label>
                <input type="text" value="{{ old('customer') ? old('customer') : $transaction->customer }}" name="customer" id="customer" class="form-control @error('customer') is-invalid @enderror" required>
                @error('customer')
                <small class="text-danger text-end d-block mt-2">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-4">
                <label for="computer" class="form-label">Computer</label>
                <select name="computer" id="computer" class="form-select @error('type') is-invalid @enderror">
                    <option selected value="{{ $transaction->computer?->id }}">{{ $transaction->computer?->name }}</option>
                    @foreach($computers as $computer)
                    @if($computer->transactions->count() == 0)
                    <option value="{{ $computer->id }}" @if($computer->id == old('computer')) selected @endif>
                        {{ $computer->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
                @error('computer')
                <small class="text-danger text-end d-block mt-2">{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-success d-block" type="submit">Save</button>
        </form>
    </div>
</div>

@endsection