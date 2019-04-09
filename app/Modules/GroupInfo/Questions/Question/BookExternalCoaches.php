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

class BookExternalCoaches extends BaseQuestion
{

    use CanSeeGroupTags;

    public $name = 'Non-Student Coaches/Instructors';

    public $identity = 'external_coaches';

    public $helpText = 'Does your group book non-student coaches or instructors for your regular activity?';

    public $type = 'radio';

    public $job = \App\Modules\GroupInfo\Questions\Jobs\BookExternalCoaches::class;

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
        if($this->groupHasTag($group, 'group_information', 'external_coaches_yes')) {
            return ['external_coaches' => 'yes'];
        } elseif($this->groupHasTag($group, 'group_information', 'external_coaches_no')) {
            return ['external_coaches' => 'no'];
        }

        return [];
    }

}