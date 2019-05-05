<?php

namespace App\Modules\PoliticalActivity;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\PoliticalActivity\Entities\Submission;
use App\Modules\Presentation\Entities\File;
use Illuminate\Support\Facades\Auth;
use App\Packages\ControlDB\Models\Group;

class ModuleConfiguration extends BaseModuleConfiguration
{

public function alias()
{
    return 'politicalactivity';
}

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Political Activity';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/politicalactivity';
    }

    public function isMandatoryForGroup(Group $group)
    {
        return $this->groupHasTag($group, 'reaffiliation_tasks', 'political_activity_awareness');
    }

    public function getAdminURL()
    {
        return '/admin/politicalactivity';
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
        return 'This is the political activity module';
    }

    public function getAdminHeaderKey()
    {
        return 'documents';
    }
}