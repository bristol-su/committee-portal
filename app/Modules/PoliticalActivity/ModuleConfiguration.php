<?php

namespace App\Modules\PoliticalActivity;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\PoliticalActivity\Entities\Submission;
use App\Modules\Presentation\Entities\File;
use Illuminate\Support\Facades\Auth;

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

    public function getAdminURL()
    {
        return '/admin/politicalactivity';
    }

    public function isComplete()
    {
if(!$this->actingAsStudent()) { return false; } ;
        return Submission::where([
            'year' => getReaffiliationYear(),
            'group_id' => Auth::user()->getCurrentRole()->group->id
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