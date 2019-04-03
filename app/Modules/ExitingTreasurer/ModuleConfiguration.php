<?php

namespace App\Modules\ExitingTreasurer;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\ExitingTreasurer\Entities\Submission;
use Illuminate\Support\Facades\Auth;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Exiting Treasurer';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/exitingtreasurer';
    }

    public function getAdminURL()
    {
        return '/admin/exitingtreasurer';
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
        return 'This is the exiting treasurer module';
    }

    public function getAdminHeaderKey()
    {
        return 'financial';
    }

}