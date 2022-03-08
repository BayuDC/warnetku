@extends('layouts.main')
@section('content')

<h1 class="pb-3">Detail Computer - {{ $computer->name }}</h1>
<div class="row">
    <div class="col-6">
        <table class="table">
            <tbody>
                <tr>
                    <th scope="row" class="col-2">Type</th>
                    <td>{{ $computer->type->name }}</td>
                </tr>
                <tr>
                    <th scope="row" class="col-2">Status</th>
                    <td>Idle</td>
                </tr>
            </tbody>
        </table>
        <div class="pt-2">
            <a href="#" class="btn btn-primary btn-sm">Update</a>
            <a href="#" class="btn btn-danger btn-sm">Delete</a>
        </div>
    </div>
</div>

@endsection