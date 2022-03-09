<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ComputerType;

class RentalPrice extends Model {
    use HasFactory;

    public $timestamps = false;

    public function type() {
        return $this->belongsTo(ComputerType::class);
    }
}
