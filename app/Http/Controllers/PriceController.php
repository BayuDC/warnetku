<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentalPrice;

class PriceController extends Controller {

    public function index() {
        return view('price.index', [
            'gaming_prices' =>  RentalPrice::where('type_id', 1)->get(),
            'office_prices' =>  RentalPrice::where('type_id', 2)->get()
        ]);
    }
}
