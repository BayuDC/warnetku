@extends('layouts.main')
@section('content')

<h1 class="pb-3">Computers</h1>

@include('components.notif')

<div class="row g-3">
    @foreach($computers as $computer)
    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
        <a @can('is-owner') href="/computer/{{ $computer->id }}" @endcan class="p-4 bg-light border d-block text-dark text-decoration-none">
            <h3>{{ $computer->name }}</h3>
            <p class="">{{ $computer->type->name }}</p>
            <div class="text-muted"><i class="bi bi-dot"></i>
                @if($transaction = $computer->transactions->first())
                <small class="me-1">🔵</small>
                Used by {{ $transaction->customer }}
                @else
                <small class="me-1">🟡</small>
                Idle
                @endif
            </div>
        </a>
    </div>
    @endforeach
    @can('is-owner')
    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
        <a href="/computer/create" class="p-4 bg-light border border-success d-block text-success h-100">
            <h3>Add Computer +</h3>
        </a>
    </div>
    @endcan
</div>

@endsection