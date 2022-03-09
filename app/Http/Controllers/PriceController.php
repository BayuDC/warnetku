<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentalPrice;
use App\Models\ComputerType;

class PriceController extends Controller {

    public function index() {
        return view('price.index', [
            'gaming_prices' =>  RentalPrice::where('type_id', 1)->get(),
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
    public function edit(RentalPrice $rental) {
        return view('price.edit', [
            'rental' => $rental,
            'types' => ComputerType::all()
        ]);
    }
    public function create(Request $request) {
        $request->validate([
            'price' => 'required|integer',
            'duration' => 'required|integer',
            'type' => 'required'
        ]);

        $rental = new RentalPrice();

        $rental->price = $request->price;
        $rental->duration = $request->duration;
        $rental->type_id = $request->type;

        $rental->save();

        return redirect('/price');
    }
    public function update(RentalPrice $rental, Request $request) {
        $request->validate([
            'price' => 'required|integer',
            'duration' => 'required|integer',
            'type' => 'required'
        ]);

        $rental->price = $request->price;
        $rental->duration = $request->duration;
        $rental->type_id = $request->type;

        $rental->save();

        return redirect('/price');
    }
    public function delete(RentalPrice $rental) {
        $rental->delete();

        return redirect('/price');
    }
}
