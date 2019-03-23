<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 23/03/19
 * Time: 15:10
 */

namespace App\Modules\GroupInfo\Questions\Question;


use App\Modules\GroupInfo\Questions\Question\Base\BaseQuestion;

class IntramuralInterest extends BaseQuestion
{

    public $name = 'Intramural Interest';

    public $identity = 'intramural_interest';

    public $helpText = 'Would you considering entering team(s) into the Bristol SU Intramural Sport League in 2019/20?';

    public $type = 'radio';

    public $required = true;

    public $configuration = [
        'yes' => [
            'text' => 'Yes',
        ],
        'no' => [
            'text' => 'No',
        ],
        'unsure' => [
            'text' => 'Unsure',
        ],
        'what_is_it' => [
            'text' => 'I don\'t know what intramural is',
        ],
    ];

    public function name()
    {
        return $this->name;
    }

    public function identity()
    {
        return $this->identity;
    }

    public function helpText()
    {
        return $this->helpText;
    }

    public function type()
    {
        return $this->type;
    }

    public function required()
    {
        return $this->required;
    }

    public function configuration()
    {
        return $this->configuration;
    }

}