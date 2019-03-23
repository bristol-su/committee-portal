<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 23/03/19
 * Time: 15:10
 */

namespace App\Modules\GroupInfo\Questions\Question;


use App\Modules\GroupInfo\Questions\Question\Base\BaseQuestion;

class Affiliations extends BaseQuestion
{

    public $name = 'Affiliations';

    public $identity = 'affiliations';

    public $helpText = 'Does your society have affiliations to other organisations (e.g. governing bodies, another SU)?';

    public $type = 'radio';

    public $required = true;

    public $configuration = [
        'yes' => [
            'text' => 'Yes',
            'textbox' => [ // When this option is selected, show a text box called identity_data
                'placeholder' => 'Name of the affiliations'
            ]
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