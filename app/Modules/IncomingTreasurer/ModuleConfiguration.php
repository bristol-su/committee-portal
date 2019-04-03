<?php

namespace App\Modules\IncomingTreasurer;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\IncomingTreasurer\Entities\Submission;
use App\Packages\ControlDB\Models\Group;
use Illuminate\Support\Facades\Auth;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Incoming Treasurer';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/incomingtreasurer';
    }

    public function getAdminURL()
    {
        return '/admin/incomingtreasurer';
    }

    public function isComplete()
    {
        return Submission::where([
            'year' => getReaffiliationYear(),
            'group_id' => Auth::user()->getCurrentRole()->group->id
        ])->count() > 0;
    }

    public function getDescription()
    {
        return 'This is the incoming treasurer module';
    }

    public function getAdminHeaderKey()
    {
        return 'financial';
    }
}