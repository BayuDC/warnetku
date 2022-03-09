<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Computer;
use App\Models\ComputerType;

class ComputerController extends Controller {
    public function index() {
        return view('computer.index', [
            'computers' => Computer::with('type')->get()
        ]);
    }
    public function show(Computer $computer) {
        return view('computer.show', [
            'computer' => $computer->load('type')
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
        $request->validate([
            'name' => 'required|regex:/^[0-9a-zA-Z\s\-]+$/',
            'type' => 'required'
        ]);

        $computer = new Computer;

        $computer->name = $request->name;
        $computer->type_id = $request->type;

        $computer->save();

        return redirect('/computer');
    }
    public function update(Computer $computer, Request $request) {
        $request->validate([
            'name' => 'required|regex:/^[0-9a-zA-Z\s\-]+$/',
            'type' => 'required'
        ]);

        $computer->name = $request->name;
        $computer->type_id = $request->type;

        $computer->save();

        return redirect('/computer');
    }
    public function destroy(Computer $computer) {
        $computer->delete();

        return redirect('/computer');
    }
}
