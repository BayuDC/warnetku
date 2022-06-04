<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\TransactionExtendRequest;
use App\Http\Requests\TransactionStoreRequest;
use App\Http\Requests\TransactionUpdateRequest;
use App\Models\Transaction;
use App\Models\Computer;
use App\Models\RentalPrice;
use Carbon\Carbon;

class TransactionController extends Controller {
    public function index() {
        return view('transaction.index', [
            'transactions' => Transaction::getOngoing()
        ]);
    }

    public function indexAll() {
        return view('transaction.index_all', [
            'transactions' => Transaction::getDone()
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

    public function store(TransactionStoreRequest $request) {
        $validated = $request->validated();

        try {
            auth()->user()->transactions()->create([
                'customer' => $validated['customer'],
                'time_start' => Carbon::now(),
                'time_end' => Carbon::now()->addHour($validated['duration']),
                'bill' => $this->calculateBill($validated['computer'], (int)$validated['duration']),
                'computer_id' => $validated['computer'],
            ]);

            return redirect()
                ->route('transaction.index')
                ->with('success', 'Transaction created successfully');
        } catch (\Exception $e) {
            return redirect()
                ->route('transaction.index')
                ->with('error', 'Failed to create transaction');
        }
    }

    public function update(TransactionUpdateRequest $request, Transaction $transaction) {
        if (Gate::denies('manage-transaction', $transaction)) abort(403);

        $validated = $request->validated();

        try {
            $transaction->updateOrFail([
                'customer' => $validated['customer'],
                'computer_id' => $validated['computer'],
            ]);

            return redirect()
                ->route('transaction.show', $transaction->id)
                ->with('success', 'Transaction updated successfully');
        } catch (\Exception $e) {
            return redirect()
                ->route('transaction.show', $transaction->id)
                ->with('error', 'Failed to update transaction');
        }
    }

    public function extend(TransactionExtendRequest $request, Transaction $transaction) {
        if (Gate::denies('manage-transaction', $transaction)) abort(403);
        if ($transaction->status != "Ongoing") abort(404);

        $validated = $request->validated();

        try {
            $transaction->updateOrFail([
                'time_end' => Carbon::create($transaction->time_end)
                    ->add($validated['duration'], 'hour'),
                'bill' => $this->calculateBill(
                    $transaction->computer_id,
                    $transaction->duration + $validated['duration']
                )
            ]);

            return redirect()
                ->route('transaction.show', $transaction->id)
                ->with('success', 'Successfully extended duration');
        } catch (\Exception $e) {
            return redirect()
                ->route('transaction.show', $transaction->id)
                ->with('error', 'Failed to extend duration');
        }
    }

    public function destroy(Transaction $transaction) {
        if (!Gate::allows('manage-transaction', $transaction)) abort(403);

        try {
            $transaction->deleteOrFail();

            return redirect()
                ->route('transaction.index')
                ->with('success', 'Transaction deleted successfully');
        } catch (\Exception $e) {
            return redirect()
                ->route('transaction.index')
                ->with('error', 'Failed to delete transaction');
        }
    }

    private function calculateBill($computer, int $duration) {
        $typeId = Computer::find($computer)->type_id;
        $prices = RentalPrice::where('type_id', $typeId)->orderBy('duration', 'desc')->get();

        $bill = 0;

        foreach ($prices as $price) {
            $count = (int)($duration / $price->duration);
            $duration -= $count * $price->duration;
            $bill += $price->price * $count;

            if ($duration == 0) break;
        }

        return $bill;
    }
}
