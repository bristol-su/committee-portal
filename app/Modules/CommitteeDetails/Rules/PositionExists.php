<?php

namespace App\Modules\CommitteeDetails\Rules;

use Illuminate\Contracts\Validation\Rule;

class PositionExists implements Rule
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
        return in_array($value, config('committeedetails.all_positions'));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The position wasn\'t found.';
    }
}
