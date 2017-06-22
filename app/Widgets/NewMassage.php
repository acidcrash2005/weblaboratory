<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

use App\Homework as Homework;
use App\HomeworkAnswer as HomeworkAnswer;
use App\HomeworkDialog as HomeworkDialog;

class NewMassage extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'db' => 'Homework',
        'dialog' => ''
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        if ($this->config['db'] == 'Homework'){
            if (!empty($this->config['dialog'])){
                $Homework = Homework::
                where([
                        ['new','=',1],
                        ['dialog_id','=',$this->config['dialog']]

                    ]
                )->get();


            }else{
                $Homework = Homework::
                join('users', 'homeworks.user_id', '=', 'users.id')->
                where([
                    ['user_moderator','=',\Auth::user()->email]
                ])->
                where([
                        ['new','=',1]
                    ]
                )->get();

            }


            $count = count($Homework);
        }elseif ($this->config['db'] == 'HomeworkAnswer'){
            if (!empty($this->config['dialog'])){
                $Homework = HomeworkAnswer::where([
                        ['new','=',1],
                        ['dialog_id','=',$this->config['dialog']]
                    ]
                )->get();

            }else{
                $HomeworkDialog = HomeworkDialog::where('user_id','=',\Auth::user()->id)->get();

                $dialogs = [];
                foreach ($HomeworkDialog as $dialog){
                    $dialogs[] = $dialog->id;
                }


                $Homework = HomeworkAnswer::where([
                        ['new','=',1],
                    ]
                )->whereIn('dialog_id',$dialogs)
                    ->get();


            }
            $count = count($Homework);
        }

        return $count;
    }
}