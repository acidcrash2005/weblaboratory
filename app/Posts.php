<?
namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Posts extends Model {
    public function getDates()
    {
        return ['published_at'];
    }

    public function getCreatedAtAttribute($date)
    {
        return new Date($date);
    }

    public function getUpdatedAtAttribute($date)
    {
        return new Date($date);
    }

    public function getPublishedAtAttribute($date)
    {
        return new Date($date);
    }


    public function category(){
        return $this->belongsTo('App\Categories');
    }
}
