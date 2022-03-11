<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class ReportController extends Controller {
    public function index() {
        return view('report.index', [
            'transactionCount' => Transaction::whereDay('time_start', Carbon::now()->day)->count(),
            'totalIncome' => Transaction::whereDay('time_start', Carbon::now()->day)->sum('bill')
        ]);
    }
}
