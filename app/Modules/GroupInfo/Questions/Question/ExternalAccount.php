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

class ExternalAccount extends BaseQuestion
{

    use CanSeeGroupTags;

    public $name = 'External Account';

    public $identity = 'external_account';

    public $helpText = 'Does your society own an external (non-SU) bank account?';

    public $type = 'radio';

    public $job = \App\Modules\GroupInfo\Jobs\Job\ExternalAccount::class;

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
        if($this->groupHasTag($group, 'group_information', 'external_account_yes')) {
            return ['external_account' => 'yes'];
        } elseif($this->groupHasTag($group, 'group_information', 'external_account_no')) {
            return ['external_account' => 'no'];
        }

        return [];
    }

}