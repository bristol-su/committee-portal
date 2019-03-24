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

class AssociateMembers extends BaseQuestion
{

    use CanSeeGroupTags;

    public $name = 'Associate Members';

    public $identity = 'associate_members';

    public $helpText = 'Do you currently have, or is your society interested in attracting non-student (associate) members to your group?';

    public $type = 'radio';

    public $job = \App\Modules\GroupInfo\Jobs\Job\AssociateMembers::class;

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

    public function job()
    {
        return $this->job;
    }

    public function getAnswer(Group $group)
    {
        if($this->groupHasTag($group, 'group_information', 'associate_members_yes')) {
            return ['associate_members' => 'yes'];
        } elseif($this->groupHasTag($group, 'group_information', 'associate_members_no')) {
            return ['associate_members' => 'no'];
        } elseif($this->groupHasTag($group, 'group_information', 'associate_members_unsure')) {
            return ['associate_members' => 'unsure'];
        }

        return [];
    }

}