<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Status extends Model {

    protected $fillable = [
        'title',
        'description',
        'publication_status',
    ];

    public function user() {
        return User::find($this->created_by);
    }

    public function unit() {
        return Unit::find($this->user()->unit_id());
    }

    public function seen_notification() {
        $notification = Notification::where('type', 'status')->where('target_id', $this->id)->first();
        if (!$notification->seen_by) {
            $notification->seen_by = Auth::id();
            $notification->update();
        }
    }

    public function set_notification() {
        $notification = new Notification;
        $notification->type = 'status';
        $notification->target_id = $this->id;
        $notification->target_unit_id = 1;
        $notification->from_unit_id = Auth::user()->unit_id();
        $notification->save();
    }

    public function remove_notification() {
        Notification::where('type', 'status')->where('target_id', $this->id)->delete();
    }

}
