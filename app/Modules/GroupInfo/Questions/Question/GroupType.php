<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 23/03/19
 * Time: 15:10
 */

namespace App\Modules\GroupInfo\Questions\Question;


use App\Modules\GroupInfo\Questions\Question\Base\BaseQuestion;

class GroupType extends BaseQuestion
{

    public $name = 'Group Type';

    public $identity = 'group_type';

    public $helpText = 'Which of these best describes your society?';

    public $type = 'select';

    public $required = true;

    public $configuration = [
        'society' => [
            'text' => 'Society',
        ],
        'sport'  => [
            'text' => 'Sport Club',
        ],
        'volunteering' => [
            'text' => 'Volunteer Project',
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