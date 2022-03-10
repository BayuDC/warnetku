<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Computer;
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
        $transaction->bill = 0; // ! temp
        $transaction->computer_id = $request->computer;
        $transaction->operator_id = Auth::user()->id;

        $transaction->save();

        return redirect('/transaction');
    }
    public function update(Transaction $transaction, Request $request) {
        $request->validate([
            'customer' => 'required|regex:/^[a-zA-Z\s0-9]+$/',
            'computer' => 'required',
            'duration' => 'required|integer'
        ]);
    }
}
