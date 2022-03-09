<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentalPrice;
use App\Models\ComputerType;

class PriceController extends Controller {

    public function index() {
        return view('price.index', [
            'gaming_prices' =>  ComputerType::where('type_id', 1)->get(),
            'office_prices' =>  RentalPrice::where('type_id', 2)->get()
        ]);
    }
    public function detail(RentalPrice $rental) {
        return view('price.detail', [
            'rental' => $rental->load('type')
        ]);
    }
    public function add() {
        return view('price.add', [
            'types' => ComputerType::all()
        ]);
    }
}
