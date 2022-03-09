<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operator;

class OperatorController extends Controller {
    public function index() {
        return view('operator.index', [
            'operators' => Operator::with('role')->get()
        ]);
    }
    public function show(Operator $operator) {
        return view('operator.show', [
            'operator' => $operator->load('role')
        ]);
    }
}
