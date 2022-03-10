<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller {
    public function index() {
        return view('transaction.index', [
            'transactions' => Transaction::with('computer')->get()
        ]);
    }
    public function show(Transaction $transaction) {
        return view('transaction.show', [
            'transaction' => $transaction->load(['operator', 'computer'])
        ]);
    }
}
