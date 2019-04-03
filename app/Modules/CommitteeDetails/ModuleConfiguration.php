<?php

namespace App\Modules\CommitteeDetails;

use App\Modules\BaseModule\ModuleConfiguration as BaseModuleConfiguration;
use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Group;
use App\PositionSetting;
use Illuminate\Support\Facades\Auth;

class ModuleConfiguration extends BaseModuleConfiguration
{

    protected $mandatoryForReaffiliation = true;

    public function getButtonTitle()
    {
        return 'Committee Details';
    }

    public function getHeaderKey()
    {
        return 'reaffiliation-mandatory';
    }

    public function getUserURL()
    {
        return '/committeedetails';
    }

    public function getAdminURL()
    {
        return '/admin/committeedetails';
    }

    public function isComplete()
    {
if(!$this->actingAsStudent()) { return false; } ;
        $group = Auth::user()->getCurrentRole()->group;
        $positionSetting = PositionSetting::where('tag_reference', $group->getGroupType())->get()->first();
        $positions = CommitteeRole::allThrough($group)->filter(function($role) {
            return $role->committee_year === getReaffiliationYear();
        });
        $positions = $positions->map(function($role) {
            return $role->position->id;
        });
        foreach($positionSetting->required_positions as $position) {
            if(!in_array($position, $positions->toArray())) {
                return false;
            }
        }

        return true;
    }

    public function getDescription()
    {
        return 'This is the committee details module';
    }

    public function getAdminHeaderKey()
    {
        return 'committee-details';
    }

}