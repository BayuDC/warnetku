<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Transaction;
use App\Models\Computer;
use App\Models\RentalPrice;
use Carbon\Carbon;

class TransactionController extends Controller {
    private $validationRules = [
        'customer' => 'required|regex:/^[a-zA-Z\s0-9]+$/',
        'computer' => 'required|exists:App\Models\Computer,id',
    ];

    public function index() {
        return view('transaction.index', [
            'transactions' => Transaction::getOngoing()
        ]);
    }
    public function show(Transaction $transaction) {
        return view('transaction.show', [
            'transaction' => $transaction->load(['operator'])
        ]);
    }
    public function create() {
        return view('transaction.create', [
            'computers' => Computer::customAll()
        ]);
    }
    public function edit(Transaction $transaction) {
        if (Gate::denies('manage-transaction', $transaction)) abort(403);

        return view('transaction.edit', [
            'computers' => Computer::customAll(),
            'transaction' => $transaction
        ]);
    }
    public function store(Request $request) {
        $this->validationRules['duration'] = 'required|integer|min:1|max:24';
        $validated = $request->validate($this->validationRules);

        try {
            $transaction = Transaction::query()->create([
                'customer' => $validated['customer'],
                'time_start' => Carbon::now(),
                'time_end' => Carbon::now()->addHour($validated['duration']),
                'bill' => $this->calculateBill($validated['computer'], (int)$validated['duration']),
                'computer_id' => $validated['computer'],
                'operator_id' => Auth::id()
            ]);

            return redirect('/transaction')->with('success', 'Transaction created successfully');
        } catch (\Exception $e) {
            return redirect('/transaction')->with('error', 'Failed to create transaction');
        }
    }
    public function update(Transaction $transaction, Request $request) {
        if (Gate::denies('manage-transaction', $transaction)) abort(403);

        $validated = $request->validate($this->validationRules);

        try {
            $transaction->updateOrFail([
                'customer' => $validated['customer'],
                'computer_id' => $validated['computer'],
            ]);

            return redirect('/transaction/' . $transaction->id)->with('success', 'Transaction updated successfully');
        } catch (\Exception $e) {
            return redirect('/transaction/' . $transaction->id)->with('error', 'Failed to update transaction');
        }
    }
    public function extend(Transaction $transaction, Request $request) {
        if (Gate::denies('manage-transaction', $transaction)) abort(403);
        if ($transaction->status != "Ongoing") abort(404);

        $validated = $request->validate(['duration' => 'required|integer|min:1|max:24']);

        try {
            $transaction->updateOrFail([
                'time_end' => Carbon::create($transaction->time_end_raw)->add($validated['duration'], 'hour'),
                'bill' => $this->calculateBill($transaction->computer_id, $transaction->duration_int + $validated['duration'])
            ]);

            return redirect('/transaction/' . $transaction->id)->with('success', 'Successfully extended duration');
        } catch (\Exception $e) {
            return redirect('/transaction/' . $transaction->id)->with('error', 'Failed to extend duration');
        }
    }
    public function destroy(Transaction $transaction) {
        if (!Gate::allows('manage-transaction', $transaction)) abort(403);

        try {
            $transaction->deleteOrFail();

            return redirect('/transaction')->with('success', 'Transaction deleted successfully');
        } catch (\Exception $e) {
            return redirect('/transaction')->with('error', 'Failed to delete transaction');
        }
    }

    private function calculateBill($computer, int $duration) {
        $typeId = Computer::find($computer)->type_id;
        $prices = RentalPrice::where('type_id', $typeId)->orderBy('duration', 'desc')->get();

        $bill = 0;

        foreach ($prices as $price) {
            $count = (int)($duration / $price->duration_int);
            $duration -= $count * $price->duration_int;
            $bill += $price->price * $count;

            if ($duration == 0) break;
        }

        return $bill;
    }
}
