<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 23/03/19
 * Time: 15:10
 */

namespace App\Modules\GroupInfo\Questions\Question;


use App\Modules\GroupInfo\Questions\Question\Base\BaseQuestion;

class ExternalAccount extends BaseQuestion
{

    public $name = 'External Account';

    public $identity = 'external_account';

    public $helpText = 'Does your society own an external (non-SU) bank account?';

    public $type = 'radio';

    public $required = true;

    public $configuration = [
        'yes' => [
            'text' => 'Yes',
        ],
        'no' => [
            'text' => 'No',
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