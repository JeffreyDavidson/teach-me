<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\CreateStudentRequest;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\TestCase;

class CreateStudentRequestTest extends TestCase
{
    use AdditionalAssertions;

    /** @test */
    public function rules_returns_validation_requirements()
    {
        $subject = $this->createFormRequest(CreateStudentRequest::class);
        $rules = $subject->rules();

        $this->assertValidationRules(
            [
                'title' => ['nullable', 'string', 'max:10'],
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'suffix' => ['nullable', 'string', 'max:10'],
                'email' => ['required', 'string', 'email', 'unique:users'],
                'phone' => ['required', 'string', 'size:10', 'unique:users'],
                'street' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'state' => ['required', 'string', 'size:2'],
                'zip' => ['required', 'string', 'size:5'],
            ],
            $rules
        );
    }
}
