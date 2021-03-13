<?php

namespace App\Mail;

use App\Models\Teacher;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeTeacher extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The teacher instance.
     *
     * @var Teacher
     */
    public $teacher;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return void
     */
    public function __construct(Teacher $teacher)
    {
        $this->teacher = $teacher;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('school.email'), config('school.name'))
                    ->subject('Welcome '.$this->teacher->name.' to '.config('school.name'))
                    ->view('emails.welcome-teacher');
    }
}
