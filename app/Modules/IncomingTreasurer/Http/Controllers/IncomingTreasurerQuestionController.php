<?php

namespace App\Modules\IncomingTreasurer\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\IncomingTreasurer\Entities\Question;
use App\Modules\IncomingTreasurer\Entities\Submission;
use App\Modules\IncomingTreasurer\Rules\AnswerIsCorrect;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class IncomingTreasurerQuestionController extends Controller
{
    public function get()
    {
        $this->authorize('incomingtreasurer.view');

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

        // All the questions are right, so save a submission

        $user = Auth::user();
        // TODO Change all user IDs to be like this p urgently!!!
        $submission = Submission::create([
            'group_id' => $user->getCurrentRole()->group->id,
            'user_id' => $user->id,
            'position_id' => $user->getCurrentRole()->position->id,
            'year' => getReaffiliationYear()
        ]);

        Event::dispatch('incomingtreasurer.training_completed', $submission);
    }
}
