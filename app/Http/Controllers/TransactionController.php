<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
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
}
