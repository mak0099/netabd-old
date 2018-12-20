<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {

    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }

    public function branch() {
        return $this->belongsToMany('App\Unit', 'user_has_branch', 'user_id', 'branch_id');
    }

    public function setUnit($branch_id) {
        $branch = Unit::find($branch_id);
        $this->branch()->save($branch);
        return $this;
    }

    public function updateUnit($branch_id) {
        $this->branch()->detach();
        return $this->setUnit($branch_id);
    }

    public function unit_id() {
        return $this->branch()->first()->id;
    }

    public function unit_name() {
        return $this->branch()->first()->unit_name;
    }

    public function unit_type() {
        return $this->branch()->first()->unit_type;
    }

    public function in_main_unit() {
        if ($this->unit_id() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function in_sub_unit() {
        if ($this->unit_id() != 1) {
            return true;
        } else {
            return false;
        }
    }

    public function unread_message() {
        return Message::where('to', $this->unit_id())->whereNull('seen_by')->count();
    }

    public function unread_messages() {
        return Message::where('deletation_status', FALSE)
                        ->where('publication_status', true)
                        ->where('to', $this->unit_id())
                        ->orderBy('id', 'desc')
                        ->take(25)
                        ->get();
    }
    public function notification_count(){
        return Notification::where('target_unit_id', $this->unit_id())
                        ->whereNull('seen_by')
                        ->count();
    }
    public function notifications() {
        return Notification::where('target_unit_id', $this->unit_id())
                        ->orderBy('id', 'desc')
                        ->take(25)
                        ->get();
    }

}
