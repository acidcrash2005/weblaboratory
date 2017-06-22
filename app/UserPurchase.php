<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UserPurchase extends Model
{
    public function courseId(){
        return $this->belongsTo('App\Course');
    }

    public function course(){
        return $this->belongsTo('App\Course');
    }

    public function userId(){
        return $this->belongsTo('App\User');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
