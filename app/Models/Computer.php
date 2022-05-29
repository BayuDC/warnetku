<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Models\ComputerType;
use App\Models\Transaction;

class Computer extends Model {
    use HasFactory;

    public $timestamps = false;

    protected $with = [
        'type'
    ];

    public function type() {
        return $this->belongsTo(ComputerType::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class)->withOutGlobalScope('time');
    }

    public function customLoad() {
        $this->load([
            'transactions' => function ($query) {
                $now = Carbon::now()->toDateTimeString();
                $query->whereRaw("'{$now}' BETWEEN time_start AND time_end");
            },
        ]);

        return $this;
    }

    public static function customAll() {
        return self::with([
            'transactions' => function ($query) {
                $now = Carbon::now()->toDateTimeString();
                $query->whereRaw("'{$now}' BETWEEN time_start AND time_end");
            },
        ])->get();
    }
}
