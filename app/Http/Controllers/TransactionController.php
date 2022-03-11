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
    public function index() {
        return view('transaction.index', [
            'transactions' => Transaction::with('computer')->get()
        ]);
    }
    public function show(Transaction $transaction) {
        $transaction['time_start'] = Carbon::createFromFormat('Y-m-d H:i:s', $transaction['time_start'])->setTimezone('Asia/Jakarta');
        $transaction['time_end'] = Carbon::createFromFormat('Y-m-d H:i:s', $transaction['time_end'])->setTimezone('Asia/Jakarta');

        return view('transaction.show', [
            'transaction' => $transaction->load(['operator', 'computer'])
        ]);
    }
    public function create() {
        return view('transaction.create', [
            'computers' => Computer::with([
                'transactions' => function ($query) {
                    $now = Carbon::now()->toDateTimeString();
                    $query->whereRaw("'{$now}' BETWEEN time_start AND time_end");
                },
            ])->with('type')->get()
        ]);
    }
    public function edit(Transaction $transaction) {
        if (Gate::denies('manage-transaction', $transaction)) abort(403);

        return view('transaction.edit', [
            'computers' => Computer::with([
                'transactions' => function ($query) {
                    $now = Carbon::now()->toDateTimeString();
                    $query->whereRaw("'{$now}' BETWEEN time_start AND time_end");
                },
            ])->with('type')->get(),
            'transaction' => $transaction->load('computer')
        ]);
    }
    public function store(Request $request) {
        $request->validate([
            'customer' => 'required|regex:/^[a-zA-Z\s0-9]+$/',
            'computer' => 'required',
            'duration' => 'required|integer'
        ]);

        $transaction = new Transaction;

        $transaction->customer = $request->customer;
        $transaction->time_start = Carbon::now();
        $transaction->time_end = Carbon::now()->addHour($request->duration);
        $transaction->bill = $this->calcBill((int)$request->duration, $request->computer);
        $transaction->computer_id = $request->computer;
        $transaction->operator_id = Auth::user()->id;

        $transaction->save();

        return redirect('/transaction');
    }
    public function update(Transaction $transaction, Request $request) {
        if (Gate::denies('manage-transaction', $transaction)) abort(403);

        $request->validate([
            'customer' => 'required|regex:/^[a-zA-Z\s0-9]+$/',
            'computer' => 'required',
        ]);

        $transaction->customer = $request->customer;
        $transaction->computer_id = $request->computer;

        $transaction->save();

        return redirect('/transaction');
    }
    public function extend(Transaction $transaction, Request $request) {
        if (Gate::denies('manage-transaction', $transaction)) abort(403);

        $request->validate([
            'duration' => 'required|integer|min:1|max:24'
        ]);

        $duration = $transaction->duration + $request->duration;

        $transaction->time_end = Carbon::create($transaction->time_end)->add($request->duration, 'hour');
        $transaction->bill = $this->calcBill($duration, $transaction->computer_id);

        $transaction->save();

        return redirect('/transaction/' . $transaction->id);
    }
    private function calcBill(int $duration, $computer) {
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
    public function destroy(Transaction $transaction) {
        $transaction->delete();

        return redirect('/transaction');
    }
}
