@extends('layouts.blank')
@section('content')

<div class="row px-3 d-flex justify-content-center align-items-center vh-100">
    <div class="col-sm-4 p-4 bg-light border">
        <form action="">
            <div class="mb-4">
                <h2>Warnetku - Login</h2>
            </div>
            <div class="mb-3">
                <label for="email" id="email" name="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control">
            </div>
            <div class="mb-4">
                <label for=" password" id="password" name="password" class="form-label">Password</label>
                <input type="password" name="email" id="password" class="form-control">
            </div>
            <div>
                <button class="btn btn-success ms-auto d-block" type="submit">Login</button>
            </div>
        </form>
    </div>
</div>

@endsection