<?php

namespace App\Mail;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeStudent extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The student instance.
     *
     * @var App\Models\Student
     */
    public $student;

    /**
     * Create a new message instance.
     *
     * @param  App\Models\Student  $student
     * @return void
     */
    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('school.email'), config('school.name'))
                    ->subject('Welcome '.$this->student->name.' to '.config('school.name'))
                    ->view('emails.welcome-student');
    }
}
