<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Computer;
use App\Models\ComputerType;

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
        return view('computer.show', [
            'computer' => $computer->customLoad()
        ]);
    }
    public function create() {
        return view('computer.create', [
            'types' => ComputerType::all()
        ]);
    }
    public function edit(Computer $computer) {
        return view('computer.edit', [
            'computer' => $computer,
            'types' => ComputerType::all()
        ]);
    }
    public function store(Request $request) {
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
        try {
            $computer->deleteOrFail();

            return redirect('/computer')->with('success', 'Successfully deleted computer');
        } catch (\Exception $e) {
            return redirect('/computer')->with('error', 'Could not delete computer');
        }
    }
}
