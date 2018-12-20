<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'unit_name',
        'area_code',
        'phone',
        'email',
        'address',
    ];
}
