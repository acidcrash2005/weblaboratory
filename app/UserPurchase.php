<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UserPurchase extends Model
{
    public function courseId(){
        return $this->belongsTo('App\Course', 'course_id','id');
    }

    public function course(){
        return $this->belongsTo('App\Course', 'course_id','id');
    }


    public function productId(){
        return $this->belongsTo('App\Product', 'product_id','id');
    }

    public function product(){
        return $this->belongsTo('App\Product', 'product_id','id');
    }

    public function userId(){
        return $this->belongsTo('App\User', 'user_id','id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id','id');
    }
}
