<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 23/03/19
 * Time: 14:37
 */

namespace App\Modules\GroupInfo\Questions;


use App\Modules\GroupInfo\Questions\Question\GroupType;
use App\Packages\ControlDB\Models\Group;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

class QuestionService implements Arrayable
{

    /**
     * @var Collection
     */
    protected $questions;

    public function __construct($questions)
    {
        $this->loadQuestions($questions);
    }

    protected function loadQuestions($questionClasses)
    {
        $this->questions = new Collection();
        foreach($questionClasses as $class) {
            $this->questions->push(new $class());
        }
    }

    public function getQuestions()
    {
        return $this->questions;
    }

    public function toArray()
    {
        return $this->questions->map(function($question){
            return $question->toArray();
        });
    }

    public function getAnswers(Group $group)
    {
        $answers = [];
        $this->questions->each(function($question) use ($group, &$answers) {
            $answers = array_merge($answers, $question->getAnswer($group));
        });
        return $answers;
    }

}