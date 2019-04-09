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


    public $name = 'Generic Email';

    public $identity = 'email';

    public $helpText = 'Does your group have a generic committee email that you can all check? For example, '.
                        'bristol-su@bristol.ac.uk. Bristol SU will not share this information without permission unless '.
                        'you have already made it publicly available via our website.';

    public $type = 'text';

    public $job = \App\Modules\GroupInfo\Questions\Jobs\Email::class;

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