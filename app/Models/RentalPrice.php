<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ComputerType;

class RentalPrice extends Model {
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [
        'id'
    ];

    public function type() {
        return $this->belongsTo(ComputerType::class);
    }

    public function getDurationPrettyAttribute() {
        return $this->attributes['duration'] . ' Hour' . ($this->attributes['duration'] > 1 ? 's' : '');
    }
}
