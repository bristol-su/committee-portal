<?php

namespace App\Modules\CommitteeDetails\Rules;

use App\Modules\CommitteeDetails\Entities\PositionSetting;
use Illuminate\Contracts\Validation\Rule;

class PositionIsAllowed implements Rule
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
        $positionIDs = PositionSetting::where('tag_reference', getTagReference())->get()->first();
        return in_array($value, $positionIDs->allowed_positions);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Position does not exist.';
    }
}
