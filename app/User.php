<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'is_active', 'photo_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    public function isAdmin() {
        if ($this->role_id == 1 and $this->is_active) {
            return true;
        } else {
            return false;
        }
    }

    public function posts() {
        return $this->hasMany('App\Post');
    }

    // Creating gravatar virtual field
    // Could use it as a normal field e.g. $user->gravatar or Auth::user()->gravatar
    public function getGravatarAttribute() {
        $hash = md5(strtolower(trim($this->attributes['email']))) . '?d=mm';

        return "http://www.gravatar.com/avatar/$hash";
    }
}
