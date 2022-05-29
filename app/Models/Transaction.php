<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Models\Operator;
use App\Models\Computer;
use Carbon\Carbon;

class Transaction extends Model {
    use HasFactory;

    public $timestamps = false;

    protected $with = [
        'computer'
    ];

    protected static function booted() {
        static::addGlobalScope('time', function (Builder $builder) {
            $builder->select($builder->getQuery()->from . '.*');
            $builder->addSelect(DB::raw('TIMESTAMPDIFF(hour, time_start, time_end) as duration'));
            $builder->addSelect(DB::raw("IF('" . Carbon::now()->toDateTimeString() . "' BETWEEN time_start AND time_end, 'Ongoing', 'Done') as status"));
        });
    }

    public function operator() {
        return $this->belongsTo(Operator::class);
    }
    public function computer() {
        return $this->belongsTo(Computer::class);
    }

    public static function getOngoing() {
        $now = Carbon::now()->toDateTimeString();

        return static::whereRaw("'{$now}' BETWEEN time_start AND time_end")->orderBy('time_start', 'desc')->get();
    }
}
