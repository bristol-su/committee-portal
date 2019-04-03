<?php

namespace App\Modules\LibelDefamation;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\LibelDefamation\Entities\Submission;
use App\Modules\Presentation\Entities\File;
use Illuminate\Support\Facades\Auth;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Libel Awareness';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/libeldefamation';
    }

    public function getAdminURL()
    {
        return '/admin/libeldefamation';
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
        return 'This is the libel & defamation module';
    }

    public function getAdminHeaderKey()
    {
        return 'documents';
    }
}