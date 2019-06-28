<?php

namespace App\Modules\ExternalAccounts;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;

use App\Modules\ExternalAccounts\Entities\Submission;
use App\Packages\ControlDB\Models\Group;

class ModuleConfiguration extends BaseModuleConfiguration
{

public function alias()
{
    return 'externalaccounts';
}

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'External Accounts';
    }

    public function isMandatoryForGroup(Group $group)
    {
        return $this->groupHasTag($group, 'bank', 'external_account');
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/externalaccounts';
    }

    public function getAdminURL()
    {
        return '/admin/externalaccounts';
    }

    public function isComplete(Group $group)
    {
        return Submission::where([
                'year' => getReaffiliationYear(),
                'group_id' => $group->id
            ])->count() > 0;
    }

    public function getDescription()
    {
        return 'This page captures details about your external bank account. This is where you will submit details of your externally audited accounts.';
    }

    public function getAdminHeaderKey()
    {
        return 'financial';
    }

}