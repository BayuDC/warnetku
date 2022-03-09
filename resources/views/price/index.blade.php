@extends('layouts.main')
@section('content')

<h1 class="pb-3">Manage Rental Prices</h1>

<div class="row">
    <div class="col">
        <h3>Gaming</h3>
        <div class="table-responsive">

            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Price</th>
                        <th scope="col">Duration</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" class="col-1">1</th>
                        <td>Rp. 5000</td>
                        <td>1 Hours</td>
                        <td class="col-1">
                            <a href="" class="btn btn-sm btn-primary">
                                Detail
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-1">2</th>
                        <td>Rp. 8000</td>
                        <td>2 Hours</td>
                        <td class="col-1">
                            <a href="" class="btn btn-sm btn-primary">
                                Detail
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <h3>Office</h3>
</div>

@endsection