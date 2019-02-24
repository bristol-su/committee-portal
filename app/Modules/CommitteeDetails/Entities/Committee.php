<?php

namespace App\Modules\CommitteeDetails\Entities;

use App\Packages\ControlDB\Models\Position;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    protected $fillable = [
        'unioncloud_id',
        'position_control_id',
        'group_control_id',
        'year'
    ];

    protected $table = 'committeedetails_committee';

    public static function getGroupCommittee($groupID) {
        // TODO This data should come from the control DB if the module has been completed
        $committee = static::getGroupCommitteeFromDB($groupID);

        $committee->sortBy(function($committee, $key) {
            $positionId = $committee->position_control_id;

            $configKey = array_search($positionId, config('committeedetails.all_positions'));

            return ($configKey === false?$key+1000:$configKey);
        });

        return $committee;
    }

    public static function getGroupCommitteeFromDB($groupID)
    {

        $committee = Committee::where([
            'year' => getReaffiliationYear(),
            'group_control_id' => $groupID
        ])->get();

//
        return $committee;

    }

}
