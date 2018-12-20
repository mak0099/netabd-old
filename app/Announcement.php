<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'description',
        'publication_status',
    ];
    
    public function user(){
        return  User::find($this->created_by);
    }
    public function seen_notification() {
        $notification = Notification::where('type', 'announcement')->where('target_id', $this->id)->first();
        if (!$notification->seen_by) {
            $notification->seen_by = Auth::id();
            $notification->update();
        }
    }
    public function set_notification(){
        $units = Unit::where('deletation_status', false)->where('id', '!=', Auth::user()->unit_id())->get();
        foreach ($units as $unit) {
            $notification = new Notification;
            $notification->type = 'announcement';
            $notification->target_id = $this->id;
            $notification->from_unit_id = Auth::user()->unit_id();
            $notification->target_unit_id = $unit->id;
            $notification->save();
        }
    }
    public function remove_notification(){
        Notification::where('type', 'announcement')->where('target_id', $this->id)->delete();
    }
}
