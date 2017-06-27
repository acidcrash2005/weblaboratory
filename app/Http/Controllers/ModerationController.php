<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

use App\Course as Cours;
use App\Lesson as Lesson;
use App\Homework as Homework;
use App\HomeworkAnswer as HomeworkAnswer;
use App\HomeworkDialog as HomeworkDialog;

class ModerationController extends Controller
{

    public function index(){
        if (Auth::user()->isAdmin()){
            $HomeworkDialog = HomeworkDialog::
            join('users', 'homework_dialogs.user_id', '=', 'users.id')->
            distinct()->
            select('user_id')->
            where('new_question','=',0)->
            groupBy('user_id')->get();

            $HomeworkNew = HomeworkDialog::
            join('users', 'homework_dialogs.user_id', '=', 'users.id')->
            where([
                ['user_moderator','=',Auth::user()->email]
            ])->
            where('new_question','=',1)->orderBy('lesson_id','desc')->select('homework_dialogs.*')->get();
        }else{
            $HomeworkDialog = HomeworkDialog::
            join('users', 'homework_dialogs.user_id', '=', 'users.id')->
            where([
                ['user_moderator','=',Auth::user()->email]
            ])->
            distinct()->
            select('user_id')->
            where('new_question','=',0)->
            groupBy('user_id')->get();


            $HomeworkNew = HomeworkDialog::
            join('users', 'homework_dialogs.user_id', '=', 'users.id')->
            where([
                ['user_moderator','=',Auth::user()->email]
            ])->
            where('new_question','=',1)->orderBy('lesson_id','desc')->select('homework_dialogs.*')->get();
        }



        $data = [
            'HomeworkDialog' => $HomeworkDialog,
            'HomeworkDialogNew' => $HomeworkNew
        ];

        return view('moderation', $data);
    }

    public function dialog($id){

        $HomeworkDialog = HomeworkDialog::find($id);

        $Homework = Homework::where('dialog_id','=',$id);

        $homework_answers = HomeworkAnswer::where('dialog_id','=',$id)
            ->union($Homework)
            ->orderBy('created_at','desc')
            ->get();


        $data = [
            'dialog'=> $homework_answers,
            'HomeworkDialog' => $HomeworkDialog
        ];

        return view('moderation_dialog', $data);
    }

    public function user_dialogs($id){

        $HomeworkDialog = HomeworkDialog::where([['new_question','=',0],['user_id','=',$id]])->orderBy('lesson_id','desc')->get();
        $HomeworkNew = HomeworkDialog::where([['new_question','=',1],['user_id','=',$id]])->orderBy('lesson_id','desc')->get();


        $data = [
            'HomeworkDialog' => $HomeworkDialog,
            'HomeworkDialogNew' => $HomeworkNew
        ];

        return view('moderation_user_dialogs', $data);
    }


    public function status(Request $request){
        $HomeworkDialog = HomeworkDialog::where('id','=',$request->dialog_id)->first();

        $HomeworkDialog->status = $request->status;
        if ($HomeworkDialog->save()){
            return redirect($request->redirect);
        }

    }
}
