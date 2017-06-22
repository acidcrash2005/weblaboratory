<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class HomeworkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $dialog;
    public $homework;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dialog, $homework)
    {
        $this->dialog = $dialog;
        $this->homework = $homework;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this
            ->subject('Вопрос по уроку от '.$this->dialog->user->name)
            ->from('weblaboratory@no-replay.com')
            ->view('email.homework');
    }
}
