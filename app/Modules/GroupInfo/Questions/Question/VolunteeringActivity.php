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

class VolunteeringActivity extends BaseQuestion
{

    use CanSeeGroupTags;

    public $name = 'Volunteering Activity';

    public $identity = 'volunteering_activity';

    public $helpText = 'Are you planning to take part in any volunteering activities next year (e.g. supporting charities '.
                        'such as Bristol Hub/Mind, schools and community groups with your time and skills)';

    public $type = 'radio';

    public $job = \App\Modules\GroupInfo\Questions\Jobs\VolunteeringActivity::class;
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

    public function job()
    {
        return $this->job;
    }

    public function getAnswer(Group $group)
    {
        if($this->groupHasTag($group, 'group_information', 'volunteering_activity_yes')) {
            return ['volunteering_activity' => 'yes'];
        } elseif($this->groupHasTag($group, 'group_information', 'volunteering_activity_no')) {
            return ['volunteering_activity' => 'no'];
        }

        return [];

    }

}