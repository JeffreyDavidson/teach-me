<?php

namespace App\Http\Requests;

use App\Models\Semester;
use App\Rules\DuringYearRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSemesterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('update', $this->semester);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'term' => ['required', 'string', Rule::in(['Spring', 'Summer', 'Fall'])],
            'year' => ['required', 'numeric', 'digits:4'],
            'start_date' => ['required', 'date', 'before:end_date', new DuringYearRule($this->input('year'))],
            'end_date' => ['required', 'date'],
            'courses' => ['required', 'array', 'min:1'],
            'courses.*' => ['integer', 'min:1', 'distinct'],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $concatenatedName = $this->input('term').' '.$this->input('year');

            if (Semester::where('name', $concatenatedName)->where('id', $this->semester)->exists()) {
                $validator->errors()->add('term', 'There is already a '.$concatenatedName.' semester.');
            }
        });
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'start_date' => 'start date',
        ];
    }
}
