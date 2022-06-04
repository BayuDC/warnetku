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

    protected $guarded = [
        'id'
    ];

    protected $with = [
        'computer'
    ];

    protected $appends = [
        'remaining_time'
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

    public function getTimeStartPrettyAttribute() {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['time_start'])->setTimezone('Asia/Jakarta');
    }
    public function getTimeEndPrettyAttribute() {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['time_end'])->setTimezone('Asia/Jakarta');
    }
    public function getRemainingTimeAttribute() {
        $diff = $this->status == 'Done' ? 0 : Carbon::now()->diffInMinutes($this->time_end);

        return $diff . ' Minute' . ($diff > 1 ? 's' : '');
    }
    public function getDurationPrettyAttribute() {
        return $this->attributes['duration'] . ' Hour' . ($this->attributes['duration'] > 1 ? 's' : '');
    }

    public static function getOngoing() {
        $now = Carbon::now()->toDateTimeString();

        return static::whereRaw("'{$now}' BETWEEN time_start AND time_end")->orderBy('time_start', 'desc')->get();
    }
    public static function getDone() {
        $now = Carbon::now()->toDateTimeString();

        return static::query()->whereRaw("'{$now}' NOT BETWEEN time_start AND time_end")->orderBy('time_start', 'desc')->paginate(10);
    }
}
