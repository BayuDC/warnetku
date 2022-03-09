<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
    public function create() {
        if (Gate::denies('manage-operator')) {
            abort(403);
        }

        return ('hello world');
    }
}
