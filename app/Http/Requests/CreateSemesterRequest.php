<?php

namespace App\Http\Requests;

use App\Models\Semester;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateSemesterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create', Semester::class);
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
            // 'regex:/[a-zA-Z*]+[0-9{4}]/
        ];
    }
}
