<?php

namespace App\Http\Controllers\Voyager;

use TCG\Voyager\Http\Controllers\VoyagerController as BaseVoyagerController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;

class VoyagerController extends BaseVoyagerController
{
    use BreadRelationshipParser;

    public function filter(Request $request){

        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $request->slug;

        if ($slug == 'lessons' || $slug == 'user-purchase'){
            $filter_items = \App\Course::get();
        }


        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('browse_'.$dataType->name);

        $getter = $dataType->server_side ? 'paginate' : 'get';



        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            $relationships = $this->getRelationships($dataType);

            if ($model->timestamps) {


                if ($request->filter){
                    if ($request->filter != 'user_id'){
                        $dataTypeContent = call_user_func([$model->with($relationships)->where($request->filter,'=',$request->filter_data)->latest(), 'get']);
                    }else{
                        $dataTypeContent = call_user_func([$model->with($relationships)->where('email','=',$request->user_id)->latest(), 'get']);
                    }

                }else{
                    $dataTypeContent = call_user_func([$model->with($relationships)->latest(), $getter]);
                }
            } else {

                $dataTypeContent = call_user_func([
                    $model->with($relationships)->orderBy($model->getKeyName(), 'DESC'),
                    $getter,
                ]);
            }

            //Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model = false;
        }

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($model);

        $view = 'voyager::bread.browse';

        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }

        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'filter_items'));
    }
}
