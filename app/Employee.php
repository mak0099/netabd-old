<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_name',
        'employee_id',
        'designation',
        'phone',
        'email',
        'address',
        'unit_id',
    ];
    
    public function unit(){
        return Unit::find($this->unit_id);
    }
}
