<?php

namespace App\Modules\MainContacts;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\MainContacts\Entities\Submission;
use Illuminate\Support\Facades\Auth;

use App\Packages\ControlDB\Models\Group;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function alias()
    {
        return 'maincontacts';
    }

    public function getButtonTitle()
    {
        return 'Notification';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/maincontacts';
    }

    public function isMandatoryForGroup(Group $group)
    {
        return true;
    }

    public function getAdminURL()
    {
        return '/admin/maincontacts';
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
        return 'This is the main contacts module';
    }

    public function getAdminHeaderKey()
    {
        return 'committee-details';
    }
}