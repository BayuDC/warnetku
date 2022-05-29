<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentalPrice;
use App\Models\ComputerType;

class PriceController extends Controller {
    private $validationRules = [
        'price' => 'required|integer|gt:0',
        'duration' => 'required|integer|gt:0',
        'type' => 'required|exists:App\Models\ComputerType,id'
    ];

    public function index() {
        return view('price.index', [
            'gaming_prices' =>  RentalPrice::where('type_id', 1)->get(),
            'office_prices' =>  RentalPrice::where('type_id', 2)->get()
        ]);
    }
    public function show(RentalPrice $rental) {
        return view('price.show', [
            'rental' => $rental->load('type')
        ]);
    }
    public function create() {
        return view('price.create', [
            'types' => ComputerType::all()
        ]);
    }
    public function edit(RentalPrice $rental) {
        return view('price.edit', [
            'rental' => $rental,
            'types' => ComputerType::all()
        ]);
    }

    public function store(Request $request) {
        try {
            $validated = $request->validate($this->validationRules);

            $rental = RentalPrice::query()->create([
                'price' => $validated['price'],
                'duration' => $validated['duration'],
                'type_id' => $validated['type']
            ]);

            return redirect('/price/' . $rental->id)->with('success', 'Successfully created rentar price');
        } catch (\Exception $e) {
            return redirect('/price')->with('error', 'Failed to create rentar price');
        }
    }
    public function update(RentalPrice $rental, Request $request) {
        try {
            $request->validate($this->validationRules);

            $rental->updateOrFail([
                'price' => $request->price,
                'duration' => $request->duration,
                'type_id' => $request->type
            ]);

            return redirect('/price/' . $rental->id)->with('success', 'Successfully updated rentar price');
        } catch (\Exception $e) {
            return redirect('/price/' . $rental->id)->with('error', 'Failed to update rentar price');
        }
    }
    public function destroy(RentalPrice $rental) {
        try {
            $rental->deleteOrFail();

            return redirect('/price')->with('success', 'Successfully deleted rentar price');
        } catch (\Exception $e) {
            return redirect('/price')->with('error', 'Failed to delete rentar price');
        }
    }
}
