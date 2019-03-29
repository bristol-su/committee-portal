<?php

namespace App\Modules\Safeguarding\Rules;

use App\Modules\Safeguarding\Entities\Answer;
use App\Modules\Safeguarding\Entities\Question;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Monolog\Logger;

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

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        // Get the ID from the attribute
        $id = (int) substr($attribute, 3);

        // Get the question
        try {
            $answer = Answer::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return false;
        }

        if($answer === null) {
            return false;
        }

        // Ensure $value corresponds to the answer
        return $this->checkAnswer($answer, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Incorrect Answer.';
    }

    public function checkAnswer($answer, $value)
    {
        return $value === $answer->correct;
    }
}
