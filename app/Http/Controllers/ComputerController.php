<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComputerFormRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Computer;
use App\Models\ComputerType;
use Exception;

class ComputerController extends Controller
{
    public function index()
    {
        return view('computer.index', [
            'computers' => Computer::customAll()
        ]);
    }

    public function show(Computer $computer)
    {
        if (!Gate::check('is-owner')) abort(403);

        return view('computer.show', [
            'computer' => $computer->customLoad()
        ]);
    }

    public function create()
    {
        if (!Gate::check('is-owner')) abort(403);

        return view('computer.create', [
            'types' => ComputerType::all()
        ]);
    }

    public function edit(Computer $computer)
    {
        if (!Gate::check('is-owner')) abort(403);

        return view('computer.edit', [
            'computer' => $computer,
            'types' => ComputerType::all()
        ]);
    }

    public function store(ComputerFormRequest $request)
    {
        if (!Gate::check('is-owner')) abort(403);

        $validated = $request->validated();

        try {
            $computer = Computer::create([
                'name' => $validated['name'],
                'type_id' => $validated['type']
            ]);

            return redirect()
                ->route('computer.show', $computer->id)
                ->with('success', 'Successfully created computer');
        } catch (Exception $e) {
            return redirect()
                ->route('computer.index')
                ->with('error', 'Failed to create computer');
        }
    }

    public function update(ComputerFormRequest $request, Computer $computer)
    {
        if (!Gate::check('is-owner')) abort(403);

        $validated = $request->validated();

        try {
            $computer->updateOrFail([
                'name' => $validated['name'],
                'type_id' => $validated['type']
            ]);

            return redirect()
                ->route('computer.show', $computer->id)
                ->with('success', 'Successfully updated computer');
        } catch (Exception $e) {
            return redirect()
                ->route('computer.show', $computer->id)
                ->with('error', 'Failed to update computer');
        }
    }

    public function destroy(Computer $computer)
    {
        if (!Gate::check('is-owner')) abort(403);

        try {
            $computer->deleteOrFail();

            return redirect()
                ->route('computer.index')
                ->with('success', 'Successfully deleted computer');
        } catch (Exception $e) {
            return redirect()
                ->route('computer.index')
                ->with('error', 'Could not delete computer');
        }
    }
}
