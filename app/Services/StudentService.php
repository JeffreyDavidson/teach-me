<?php

namespace App\Services;

use App\Enums\UserRoleEnum;
use App\Events\StudentCreated;
use App\Models\Student;
use App\SchoolEmailGenerator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentService
{
    /**
     * The school email generator instance.
     *
     * @var App\SchoolEmailGenerator
     */
    public $schoolEmail;

    /**
     * Create a new student service instance.
     *
     * @param  App\SchoolEmailGenerator $schoolEmail
     * @return void
     */
    public function __construct(SchoolEmailGenerator $schoolEmail)
    {
        $this->schoolEmail = $schoolEmail;
    }

    /**
     * Create a new student.
     *
     * @param  array $data
     * @return App\Models\Student
     */
    public function create($data)
    {
        $student = Student::create([
            'title' => $data['title'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'suffix' => $data['suffix'],
            'email' => $data['email'],
            'school_email' => $this->schoolEmail->generate($data['first_name'], $data['last_name']),
            'phone' => $data['phone'],
            'password' => Hash::make(Str::random(8)),
            'role' => UserRoleEnum::STUDENT,
            'street' => $data['street'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip' => $data['zip'],
        ]);

        StudentCreated::dispatch($student);

        return $student;
    }
}
