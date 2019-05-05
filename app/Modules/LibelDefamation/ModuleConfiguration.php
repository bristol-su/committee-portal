<?php

namespace App\Modules\LibelDefamation;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\LibelDefamation\Entities\Submission;
use App\Modules\Presentation\Entities\File;
use Illuminate\Support\Facades\Auth;

use App\Packages\ControlDB\Models\Group;

class ModuleConfiguration extends BaseModuleConfiguration
{

public function alias()
{
    return 'libeldefamation';
}

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Libel Awareness';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function isMandatoryForGroup(Group $group)
    {
        return $this->groupHasTag($group, 'reaffiliation_tasks', 'libel_defamation_awareness');
    }

    public function getUserURL()
    {
        return '/libeldefamation';
    }

    public function getAdminURL()
    {
        return '/admin/libeldefamation';
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
        return 'This is the libel & defamation module';
    }

    public function getAdminHeaderKey()
    {
        return 'documents';
    }
}