<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

use App\Lesson as Lesson;
use App\HomeworkDialog as HomeworkDialog;
use Illuminate\Support\Facades\Auth;

class Progress extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'course_id' => null,
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $html = 'test';



        $lesons = Lesson::
        where([
            ['cours_id','=', $this->config['course_id']]
        ])
        ->get();

        foreach ($lesons as $leson){
            $course[] = $leson->id;
        }

        $Homework = HomeworkDialog::
        whereIn('id',$course)
        ->count();

        print_r($Homework);

        return $html;
    }
}