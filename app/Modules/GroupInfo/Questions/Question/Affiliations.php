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
use App\Traits\CanSeeGroupTags;

class Affiliations extends BaseQuestion
{

    use CanSeeGroupTags;

    public $name = 'Affiliations';

    public $identity = 'affiliations';

    public $helpText = 'Does your group have affiliations to other organisations (e.g. governing bodies, another SU)?';

    public $type = 'radio';

    public $required = true;

    public $job = \App\Modules\GroupInfo\Jobs\Job\Affiliations::class;

    public $configuration = [
        'yes' => [
            'text' => 'Yes',
            'textbox' => [ // When this option is selected, show a text box called identity_data
                'placeholder' => 'Full name of organisation'
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

    public function job()
    {
        return $this->job;
    }

    public function getAnswer(Group $group)
    {
        if($this->groupHasTag($group, 'group_information', 'affiliations_yes')) {

            return [
                'affiliations' => 'yes',
                'affiliations_yes_data' => $this->getTagFromGroup($group,'group_information', 'affiliations_yes')->pivot->data
            ];
        } elseif($this->groupHasTag($group, 'group_information', 'affiliations_no')) {
            return [
                'affiliations' => 'no'
            ];
        }

        return [];
    }

}