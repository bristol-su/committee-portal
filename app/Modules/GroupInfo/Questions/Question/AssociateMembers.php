<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 23/03/19
 * Time: 15:10
 */

namespace App\Modules\GroupInfo\Questions\Question;


use App\Modules\GroupInfo\Questions\Question\Base\BaseQuestion;

class AssociateMembers extends BaseQuestion
{

    public $name = 'Associate Members';

    public $identity = 'associate_members';

    public $helpText = 'Do you currently have, or is your society interested in attracting non-student (associate) members to your group?';

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
        ]
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