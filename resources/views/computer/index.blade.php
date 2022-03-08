@extends('layouts.main')
@section('content')

<h1 class="pb-3">Manage Computers</h1>

<div class="row g-3">
    @foreach($computers as $computer)
    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
        <a href="/computer/{{ $computer->id }}" class="p-4 bg-light border d-block text-dark text-decoration-none">
            <h3>{{ $computer->name }}</h3>
            <div class="">{{ $computer->type->name }}</div>
            <div class="text-muted">
                Idle
            </div>
        </a>
    </div>
    @endforeach
    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
        <a href="/computer/add" class="p-4 bg-light border border-success d-block text-success h-100">
            <h3>Add Computer +</h3>
        </a>
    </div>
</div>

@endsection