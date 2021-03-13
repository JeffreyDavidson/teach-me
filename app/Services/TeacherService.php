<?php

namespace App\Services;

use App\Enums\UserRoleEnum;
use App\Events\TeacherCreated;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherService
{
    /**
     * Create a new teacher.
     *
     * @param  array $data
     * @return \App\Models\Teacher
     */
    public function create($data)
    {
        $teacher = Teacher::create([
            'title' => $data['title'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'suffix' => $data['suffix'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make(Str::random(8)),
            'role' => UserRoleEnum::TEACHER,
            'street' => $data['street'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip' => $data['zip'],
        ]);

        TeacherCreated::dispatch($teacher);

        return $teacher;
    }
}
