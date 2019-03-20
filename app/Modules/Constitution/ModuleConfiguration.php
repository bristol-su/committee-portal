<?php

namespace App\Modules\Constitution;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Modules\Constitution\Entities\File;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Constitution';
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

    public function reaffiliationStatus()
    {
        if (!$this->actingAsStudent()) { return 'admin'; }
        if (File::where([
                'year' => getReaffiliationYear(),
                'status' => 'approved',
                'group_id' => getGroupID()
            ])->count() === 0) {

            return 'incomplete';
        }
        return 'complete';
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