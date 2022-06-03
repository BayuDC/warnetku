<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceStoreRequest;
use App\Http\Requests\PriceUpdateRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\RentalPrice;
use App\Models\ComputerType;
use Exception;

class PriceController extends Controller
{

    public function index()
    {
        $price = RentalPrice::all();

        return view('price.index', [
            'gaming_prices' =>  $price->where('type_id', 1),
            'office_prices' =>  $price->where('type_id', 2)
        ]);
    }

    public function show(RentalPrice $rental)
    {
        if (!Gate::check('is-owner')) abort(403);

        return view('price.show', [
            'rental' => $rental->load('type')
        ]);
    }

    public function create()
    {
        if (!Gate::check('is-owner')) abort(403);

        return view('price.create', [
            'types' => ComputerType::all()
        ]);
    }

    public function edit(RentalPrice $rental)
    {
        if (!Gate::check('is-owner')) abort(403);

        return view('price.edit', [
            'rental' => $rental,
            'types' => ComputerType::all()
        ]);
    }

    public function store(PriceStoreRequest $request)
    {
        if (!Gate::check('is-owner')) abort(403);

        $validated = $request->validated();

        try {
            $rental = RentalPrice::create([
                'name' => $validated['name'],
                'price' => $validated['price'],
                'duration' => $validated['duration'],
                'type_id' => $validated['type']
            ]);

            return redirect()
                ->route('price.show', $rental->id)
                ->with('success', 'Successfully created rentar price');
        } catch (Exception $e) {
            return redirect()
                ->route('price.index')
                ->with('error', 'Failed to create rentar price');
        }
    }

    public function update(PriceUpdateRequest $request, RentalPrice $rental)
    {
        if (!Gate::check('is-owner')) abort(403);

        $validated =  $request->validated();

        try {
            $rental->updateOrFail([
                'name' => $validated['name'],
                'price' => $validated['price'],
                'duration' => $validated['duration'],
                'type_id' => $validated['type']
            ]);

            return redirect()
                ->route('price.show', $rental->id)
                ->with('success', 'Successfully updated rentar price');
        } catch (Exception $e) {
            return redirect()
                ->route('price.show', $rental->id)
                ->with('error', 'Failed to update rentar price');
        }
    }

    public function destroy(RentalPrice $rental)
    {
        if (!Gate::check('is-owner')) abort(403);

        try {
            $rental->deleteOrFail();

            return redirect()
                ->route('price.index')
                ->with('success', 'Successfully deleted rentar price');
        } catch (Exception $e) {
            return redirect()
                ->route('price.index')
                ->with('error', 'Failed to delete rentar price');
        }
    }
}
