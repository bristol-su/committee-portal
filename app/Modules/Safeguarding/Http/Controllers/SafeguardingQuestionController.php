<?php

namespace App\Modules\Safeguarding\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Safeguarding\Entities\Question;
use App\Modules\Safeguarding\Rules\AnswerIsCorrect;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SafeguardingQuestionController extends Controller
{
    public function get()
    {
        $this->authorize('safeguarding.view');

        return Question::with('answers')->get();
    }

    public function verify(Request $request)
    {
        $questions = $this->get();
        $answers = $questions->map(function($question) {
            return $question->answers;
        })->flatten(1);

        $validationRules = [];
        $answers->each(function($answer) use (&$validationRules) {
            $validationRules['id_'.$answer->id] = [new AnswerIsCorrect()];
        });

        $request->validate($validationRules);
    }
}
