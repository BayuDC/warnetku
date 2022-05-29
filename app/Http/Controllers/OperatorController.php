<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Operator;

class OperatorController extends Controller {
    private $validationRules = [
        'fullname' => 'required|regex:/^[a-zA-Z\s]+$/',
        'username' => 'required|unique:operators|regex:/^[a-zA-Z0-9\_]+$/',
        'password' => 'required|confirmed|min:4'
    ];

    public function index() {
        return view('operator.index', [
            'operators' => Operator::with('role')->paginate(10)
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

        $validated = $request->validate($this->validationRules);

        try {
            $operator = Operator::query()->create([
                'fullname' => $validated['fullname'],
                'username' => $validated['username'],
                'password' => bcrypt($validated['password']),
                'role_id' => 2
            ]);

            return redirect('/operator/' . $operator->username)->with('success', 'Successfully created operator');
        } catch (\Exception $e) {
            return redirect('/operator')->with('error', 'Failed to create operator');
        }
    }
    public function update(Operator $operator, Request $request) {
        if (Gate::denies('manage-operator')) abort(403);

        $validated =  $request->validate($this->validationRules);

        try {
            $operator->updateOrFail([
                'fullname' => $validated['fullname'],
                'username' => $validated['username'],
                'password' => bcrypt($validated['password'])
            ]);

            return redirect('/operator/' . $operator->username)->with('success', 'Successfully updated operator');
        } catch (\Exception $e) {
            return redirect('/operator/' . $operator->username)->with('error', 'Failed to update operator');
        }
    }
    public function destroy(Operator $operator) {
        if (Gate::denies('manage-operator')) abort(403);
        if ($operator->role->name == 'Owner') abort(403);

        try {
            $operator->deleteOrFail();

            return redirect('/operator')->with('success', 'Successfully deleted operator');
        } catch (\Exception $e) {
            return redirect('/operator')->with('error', 'Failed to delete operator');
        }
    }
}
