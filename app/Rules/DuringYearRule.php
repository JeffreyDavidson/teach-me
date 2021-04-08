<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class DuringYearRule implements Rule
{
    /**
     * The year to compare the validation rule to.
     *
     * @var  string
     */
    protected $year;

    /**
     * The attribute used.
     *
     * @var  string
     */
    protected $attribute;

    /**
     * Create a new rule instance.
     *
     * @param  string $year
     * @return void
     */
    public function __construct(string $year)
    {
        $this->year = $year;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Carbon::parse($value)->year == $this->year;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute field must be during the year '.$this->year;
    }
}
