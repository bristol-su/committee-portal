<?php

namespace App\Modules\Constitution;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\Constitution\Entities\File;

use App\Packages\ControlDB\Models\Group;

class ModuleConfiguration extends BaseModuleConfiguration
{

    public function alias()
    {
        return 'constitution';
    }

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Constitution';
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
        return '/constitution';
    }

    public function getAdminURL()
    {
        return '/admin/constitution';
    }

    public function isComplete(Group $group)
    {
        return File::where([
            'year' => getReaffiliationYear(),
            'status' => 'approved',
            'group_id' => $group->id
        ])->count() > 0;

    }

    public function getDescription()
    {
        return 'This is the constitution module';
    }

    public function getAdminHeaderKey()
    {
        return 'documents';
    }

}