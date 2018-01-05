<?
namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model {

    public function roleId(){
        return $this->belongsTo('App\Role');
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }





}
