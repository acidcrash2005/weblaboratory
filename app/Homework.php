<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Homework extends Model
{

    public function userId(){
        return $this->belongsTo('App\User');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function lessonId(){
        return $this->belongsTo('App\Lesson');
    }
    public function lesson(){
        return $this->belongsTo('App\Lesson');
    }


}
