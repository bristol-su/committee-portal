<?php

namespace App\Rules;

use App\Packages\ControlDB\Models\Student;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;

class IsValidControlID implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return Student::find($value) !== false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Student not found.';
    }
}
