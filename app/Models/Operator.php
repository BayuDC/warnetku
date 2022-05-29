<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;
use App\Models\Role;

class Operator extends Model {
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];

    public function role() {
        return $this->belongsTo(Role::class);
    }
}
