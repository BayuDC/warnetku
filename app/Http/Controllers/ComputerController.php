<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Computer;
use App\Models\ComputerType;
use Carbon\Carbon;

class ComputerController extends Controller {
    private $validationRules = [
        'name' => 'required|regex:/^[0-9a-zA-Z\s\-]+$/',
        'type' => 'required|exists:App\Models\ComputerType,id'
    ];

    public function index() {
        return view('computer.index', [
            'computers' => Computer::customAll()
        ]);
    }
    public function show(Computer $computer) {
        if (!Gate::check('is-owner')) abort(403);

        return view('computer.show', [
            'computer' => $computer->customLoad()
        ]);
    }
    public function create() {
        if (!Gate::check('is-owner')) abort(403);

        return view('computer.create', [
            'types' => ComputerType::all()
        ]);
    }
    public function edit(Computer $computer) {
        if (!Gate::check('is-owner')) abort(403);

        return view('computer.edit', [
            'computer' => $computer,
            'types' => ComputerType::all()
        ]);
    }
    public function store(Request $request) {
        if (!Gate::check('is-owner')) abort(403);

        $validated = $request->validate($this->validationRules);

        try {
            $computer = Computer::query()->create([
                'name' => $validated['name'],
                'type_id' => $validated['type']
            ]);

            return redirect('/computer/' .  $computer->id)->with('success', 'Successfully created computer');
        } catch (\Exception $e) {
            return redirect('/computer')->with('error', 'Failed to create computer');
        }
    }
    public function update(Computer $computer, Request $request) {
        if (!Gate::check('is-owner')) abort(403);

        $validated = $request->validate($this->validationRules);

        try {
            $computer->updateOrFail([
                'name' => $validated['name'],
                'type_id' => $validated['type']
            ]);

            return redirect('/computer/' . $computer->id)->with('success', 'Successfully updated computer');
        } catch (\Exception $e) {
            return redirect('/computer/' . $computer->id)->with('error', 'Failed to update computer');
        }
    }
    public function destroy(Computer $computer) {
        if (!Gate::check('is-owner')) abort(403);

        try {
            $computer->deleteOrFail();

            return redirect('/computer')->with('success', 'Successfully deleted computer');
        } catch (\Exception $e) {
            return redirect('/computer')->with('error', 'Could not delete computer');
        }
    }
}
