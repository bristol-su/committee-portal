<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 23/03/19
 * Time: 15:10
 */

namespace App\Modules\GroupInfo\Questions\Question;


use App\Modules\GroupInfo\Questions\Question\Base\BaseQuestion;
use App\Packages\ControlDB\Models\Group;

class Email extends BaseQuestion
{


    public $name = 'Email';

    public $identity = 'email';

    public $helpText = 'Does your sociey have a general or public facing email address?';

    public $type = 'text';

    public $job = \App\Modules\GroupInfo\Jobs\Job\Email::class;

    public $required = false;

    public $configuration = [];

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

    public function job()
    {
        return $this->job;
    }

    public function getAnswer(Group $group)
    {
        return [
            'email' => $group->email
        ];
    }


}