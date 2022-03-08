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
    public function detail(Computer $computer) {
        return view('computer.detail', [
            'computer' => $computer->load('type')
        ]);
    }
    public function add() {
        return view('computer.add', [
            'types' => ComputerType::all()
        ]);
    }
}
