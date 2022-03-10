<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Operator;
use App\Models\Computer;

class Transaction extends Model {
    use HasFactory;

    public $timestamps = false;

    protected static function booted() {
        static::addGlobalScope(function (Builder $builder) {
            $builder->select($builder->getQuery()->from . '.*');
            $builder->addSelect(\DB::raw('TIMESTAMPDIFF(hour, time_start, time_end) as duration'));
        });
    }

    public function operator() {
        return $this->belongsTo(Operator::class);
    }
    public function computer() {
        return $this->belongsTo(Computer::class);
    }
}
