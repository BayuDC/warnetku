<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class ReportController extends Controller {

    public function index() {
        $today = Carbon::today();

        return view('report.index', [
            'daily' => [
                'count' => Transaction::whereDate('time_start', $today)->count(),
                'income' => Transaction::whereDate('time_start', $today)->sum('bill')
            ],
            'monthly' => [
                'count' => Transaction
                    ::whereYear('time_start', $today->year)
                    ->whereMonth('time_start', $today->month)
                    ->count(),
                'income' => Transaction
                    ::whereYear('time_start', $today->year)
                    ->whereMonth('time_start', $today->month)
                    ->sum('bill')
            ],
            'yearly' => [
                'count' => Transaction
                    ::whereYear('time_start', $today->year)
                    ->count(),
                'income' => Transaction
                    ::whereYear('time_start', $today->year)
                    ->sum('bill')
            ],
            'lifetime' => [
                'count' => Transaction::count(),
                'income' => Transaction::sum('bill')
            ]
        ]);
    }
}
