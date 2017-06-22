<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class HomeworkAnswer extends Model
{

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function dialog(){
        return $this->belongsTo('App\HomeworkDialog', 'dialog_id');
    }


}
