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

class IntramuralInterest extends BaseQuestion
{

    use CanSeeGroupTags;
    public $name = 'Intramural Interest';

    public $identity = 'intramural_interest';

    public $helpText = 'Would you considering entering team(s) into the Bristol SU Intramural Sport League in 2019/20?';

    public $type = 'radio';

    public $job = \App\Modules\GroupInfo\Jobs\Job\IntramuralInterest::class;

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

    public function job()
    {
        return $this->job;
    }

    public function getAnswer(Group $group)
    {
        if($this->groupHasTag($group, 'group_information', 'intramural_interest_yes')) {
            return ['intramural_interest' => 'yes'];
        } elseif($this->groupHasTag($group, 'group_information', 'intramural_interest_no')) {
            return ['intramural_interest' => 'no'];
        } elseif($this->groupHasTag($group, 'group_information', 'intramural_interest_unsure')) {
            return ['intramural_interest' => 'unsure'];
        } elseif($this->groupHasTag($group, 'group_information', 'intramural_interest_what_is_it')) {
            return ['intramural_interest' => 'what_is_it'];
        }

        return [];
    }

}