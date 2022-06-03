<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperatorStoreRequest;
use App\Http\Requests\OperatorUpdateRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Operator;

class OperatorController extends Controller
{
    public function index()
    {
        if (!Gate::check('is-owner')) abort(403);

        return view('operator.index', [
            'operators' => Operator::with('role')->paginate(10)
        ]);
    }

    public function show(Operator $operator)
    {
        if (!Gate::check('is-owner')) abort(403);

        return view('operator.show', [
            'operator' => $operator->load('role')
        ]);
    }

    public function create()
    {
        if (!Gate::check('is-owner')) abort(403);

        return view('operator.create');
    }

    public function edit(Operator $operator)
    {
        if (!Gate::check('is-owner')) abort(403);

        return view('operator.edit', [
            'operator' => $operator
        ]);
    }

    public function store(OperatorStoreRequest $request)
    {
        if (!Gate::check('is-owner')) abort(403);

        $validated = $request->validated();

        try {
            $operator = Operator::create([
                'fullname' => $validated['fullname'],
                'username' => $validated['username'],
                'password' => bcrypt($validated['password']),
                'role_id' => 2
            ]);

            return redirect()
                ->route('operator.show', $operator->username)
                ->with('success', 'Successfully created operator');
        } catch (\Exception $e) {
            return redirect()
                ->route('operator.index')
                ->with('error', 'Failed to create operator');
        }
    }

    public function update(OperatorUpdateRequest $request, Operator $operator)
    {
        if (!Gate::check('is-owner')) abort(403);

        $validated = $request->validated();

        try {
            $operator->updateOrFail($validated);

            return redirect()
                ->route('operator.show', $operator->username)
                ->with('success', 'Successfully updated operator');
        } catch (\Exception $e) {
            return redirect()
                ->route('operator.show', $operator->username)
                ->with('error', 'Failed to update operator');
        }
    }

    public function destroy(Operator $operator)
    {
        if (!Gate::check('is-owner')) abort(403);
        if ($operator->role->name == 'Owner') abort(403);

        try {
            $operator->deleteOrFail();

            return redirect()
                ->route('operator.index')
                ->with('success', 'Successfully deleted operator');
        } catch (\Exception $e) {
            return redirect()
                ->route('operator.index')
                ->with('error', 'Failed to delete operator');
        }
    }
}
