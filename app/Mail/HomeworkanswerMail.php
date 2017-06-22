<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class HomeworkanswerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $answer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($answer)
    {
        $this->answer = $answer;
    }



    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this
            ->subject('Ответ по '.$this->answer->dialog->lesson->title)
            ->from('weblaboratory@no-replay.com')
            ->view('email.homework_answer');
    }
}
