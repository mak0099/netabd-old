<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function from_unit() {
        return Unit::find($this->from_unit_id);
    }
}
