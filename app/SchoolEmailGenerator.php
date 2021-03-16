<?php

namespace App;

use Illuminate\Support\Str;

class SchoolEmailGenerator
{
    /**
     * Generates a school email for the model.
     *
     * @param  string $firstName
     * @param  string $lastName
     * @return string
     */
    public function generate($firstName, $lastName)
    {
        return Str::lower($firstName.'.'.$lastName.'@'.config('school.domain'));
    }
}
