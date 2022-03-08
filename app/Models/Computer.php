<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ComputerType;

class Computer extends Model {
    use HasFactory;

    public $timestamps = false;

    public function type() {
        return $this->belongsTo(ComputerType::class);
    }
}
