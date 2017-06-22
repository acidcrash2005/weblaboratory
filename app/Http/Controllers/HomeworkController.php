<?php

namespace App\Http\Controllers;

use App\Mail\HomeworkMail;
use App\Mail\HomeworkanswerMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;

use App\Homework as Homework;
use App\HomeworkAnswer as HomeworkAnswer;
use App\HomeworkDialog as HomeworkDialog;
use Carbon\Carbon as Carbon;

class HomeworkController extends Controller
{


    public function add(Request $request){

        $this->validate($request, [
            'text' => 'required'
        ]);

        $HomeworkDialog = HomeworkDialog::where([
            ['lesson_id','=',$request->lesson_id],
            ['user_id','=',$request->user_id]
            ])->first();


        if ($HomeworkDialog !== null){
            $dialog_id = $HomeworkDialog->id;
            $dialog = $HomeworkDialog;
        }else{
            $dialog = new HomeworkDialog;
            $dialog->lesson_id = $request->lesson_id;
            $dialog->user_id = $request->user_id;
            $dialog->new_question = 1;

            if ($dialog->save()){
                $homeworksend = $dialog;
                $dialog_id = $dialog->id;
            }
        }

        $homework = new Homework;
        $homework->user_id = $request->user_id;
        $homework->text	= $request->text;
        $homework->link	= $request->link;
        $homework->new = $request->new;
        $homework->dialog_id = $dialog_id;
        $homework->answer = 0;

        if ($homework->save()){
            HomeworkAnswer::where('dialog_id','=',$dialog_id)->update(['new' => 0]);
            HomeworkDialog::where('id','=',$dialog_id)->update(['new_question' => 1, 'new_answer' => 0]);
            \Mail::to($homework->user->user_moderator)->send(new HomeworkMail($dialog, $homework));
        }


        return redirect()->back()->with([
            'flash_message' => 'Ваше сообщение успешно отправленно!'
        ]);
    }

    public function addAnaswer(Request $request){

        $this->validate($request, [
            'text' => 'required'
        ]);

        $answer = new HomeworkAnswer;

        $answer->user_id = $request->user_id;
        $answer->text	= $request->text;
        $answer->link	= $request->link;
        $answer->new = $request->new;
        $answer->dialog_id = $request->dialog_id;
        $answer->answer = 1;

        if ($answer->save()){
            Homework::where('dialog_id','=',$request->dialog_id)->update(['new' => 0]);
            HomeworkDialog::where('id','=',$request->dialog_id)->update(['new_answer' => 1, 'new_question' => 0]);

            \Mail::to($answer->dialog->user->email)->send(new HomeworkanswerMail($answer));
        }

        return redirect('moderation/dialog/'.$request->dialog_id)->with([
            'flash_message' => 'Ваше сообщение успешно отправленно!'
        ]);
    }

    public function readmessage($id, $dialog){

        Homework::where('id', $id)->update(['new' => 0]);
        HomeworkDialog::where('id','=',$dialog)->update(['new_answer' => 0, 'new_question' => 0]);

        return redirect()->back();
    }

    public function readanswer($id, $dialog){

        HomeworkAnswer::where('id',$id)->update(['new' => 0]);
        HomeworkDialog::where('id','=',$dialog)->update(['new_question' => 0, 'new_answer' => 0]);

        return redirect()->back();
    }


}
