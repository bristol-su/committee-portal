<?php

namespace App\Modules\Safeguarding\Rules;

use App\Modules\Safeguarding\Entities\Question;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;

class AnswerIsCorrect implements Rule
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

    /**settings.update-admin-permissions
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        Log::info('sdflkjsf');
        // Get the ID from the attribute
        $id = substr($attribute, 2);
        Log::info($id);
        // Get the question
        $question = Question::findOrFail($id);

        // Ensure $value corresponds to the question answer
        return $this->checkQuestion($question, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }

    public function checkQuestion($question, $value)
    {
        if($question->correct === 0) {
            return $value === false;
        } else {
            return $value === true;
        }
    }
}
