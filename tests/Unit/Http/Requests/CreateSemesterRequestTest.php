<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\CreateSemesterRequest;
use Illuminate\Validation\Rule;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\TestCase;

class CreateSemesterRequestTest extends TestCase
{
    use AdditionalAssertions;

    /** @test */
    public function rules_returns_validation_requirements()
    {
        $subject = $this->createFormRequest(CreateSemesterRequest::class);
        $rules = $subject->rules();

        $this->assertValidationRules(
            [
                'term' => ['required', 'string', Rule::in(['Spring', 'Summer', 'Fall'])],
                'year' => ['required', 'numeric', 'digits:4'],
                'start_date' => ['required', 'date', 'before:end_date'],
                'end_date' => ['required', 'date'],
            ],
            $rules
        );
    }
}
