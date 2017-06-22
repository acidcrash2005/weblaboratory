<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Lesson extends Model
{


    public function coursId(){
        return $this->belongsTo('App\Course');
    }

    public function cours(){
        return $this->belongsTo('App\Course');
    }


}
