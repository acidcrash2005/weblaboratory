<?
namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model {

    public function cours(){
        return $this->belongsTo('App\Course', 'course_id','id');
    }

    public function courseId(){
        return $this->belongsTo('App\Course', 'course_id','id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id','id');
    }

    public function userId(){
        return $this->belongsTo('App\User', 'user_id','id');
    }

    public function productId(){
        return $this->belongsTo('App\Product', 'product_id','id');
    }

    public function product(){
        return $this->belongsTo('App\Product', 'product_id','id');
    }

}
