<?php

namespace App\Modules\GDPR;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\GDPR\Entities\Submission;
use Illuminate\Support\Facades\Auth;

use App\Packages\ControlDB\Models\Group;

class ModuleConfiguration extends BaseModuleConfiguration
{

public function alias()
{
    return 'gdpr';
}

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'GDPR';
    }

    public function isMandatoryForGroup(Group $group)
    {
        return true;
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/gdpr';
    }

    public function getAdminURL()
    {
        return '/admin/gdpr';
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
        return 'This page helps you understand your responsibilities in complying with Data Protection and GDPR regulations.';
    }

    public function getAdminHeaderKey()
    {
        return 'financial';
    }

}