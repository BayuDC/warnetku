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
        if (Gate::denies('manage-operator')) abort(403);

        return view('operator.create');
    }
    public function edit(Operator $operator) {
        if (Gate::denies('manage-operator')) abort(403);

        return view('operator.edit', [
            'operator' => $operator
        ]);
    }
    public function store(Request $request) {
        if (Gate::denies('manage-operator')) abort(403);

        $request->validate([
            'fullname' => 'required|regex:/^[a-zA-Z\s]+$/',
            'username' => 'required|unique:operators|regex:/^[a-zA-Z0-9\_]+$/',
            'password' => 'required|confirmed|min:4'
        ]);

        $operator = new Operator;

        $operator->fullname = $request->fullname;
        $operator->username = $request->username;
        $operator->password = bcrypt($request->password);
        $operator->role_id = 2;

        $operator->save();

        return redirect('/operator');
    }
}
