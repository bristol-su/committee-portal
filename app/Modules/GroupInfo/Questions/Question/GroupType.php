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

class GroupType extends BaseQuestion
{
    use CanSeeGroupTags;
    public $name = 'Group Type';

    public $identity = 'group_type';

    public $helpText = 'Which of these best describes your group?';

    public $type = 'select';

    public $job = \App\Modules\GroupInfo\Questions\Jobs\GroupType::class;

    public $required = true;

    public $configuration = [
        'society' => [
            'text' => 'Society',
        ],
        'sport' => [
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

    public function job()
    {
        return $this->job;
    }

    public function getAnswer(Group $group)
    {
        if($this->groupHasTag($group, 'group_information', 'group_type_society')) {
            return ['group_type' => 'society'];
        } elseif($this->groupHasTag($group, 'group_information', 'group_type_sport')) {
            return ['group_type' => 'sport'];
        } elseif($this->groupHasTag($group, 'group_information', 'group_type_volunteering')) {
            return ['group_type' => 'volunteering'];
        }

        return [];

    }

}