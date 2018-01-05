<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\HomeworkDialog as HomeworkDialog;
use App\Lesson as Lesson;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }


    public function products(){
        return $this->hasMany('App\UserPurchase');
    }

    public function isAdmin(){
        return (\Auth::check() && \Auth::user()->role_id == 1);
    }

    public function isPremium(){
        return (\Auth::check() && \Auth::user()->role_id == 1 || \Auth::user()->role_id == 4 || \Auth::user()->role_id == 5 || \Auth::user()->role_id == 6);
    }

    public function isVip(){
        return (\Auth::check() && \Auth::user()->role_id == 1 || \Auth::user()->role_id == 5 || \Auth::user()->role_id == 6);
    }

    public function isBase(){
        return (\Auth::check() && \Auth::user()->role_id == 3 || \Auth::user()->role_id == 1 || \Auth::user()->role_id == 4 || \Auth::user()->role_id == 5 || \Auth::user()->role_id == 6);
    }

}
