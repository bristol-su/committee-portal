<?php

namespace App\Modules\EquipmentList\Entities;

use App\Packages\ControlDB\Models\Group;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{

    protected $table = 'equipmentlist_submissions';

    protected $fillable = [
        'group_id',
        'user_id',
        'position_id',
        'year'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        $group = Group::find($this->group_id);
        if($group === false) {
            throw new \Exception('Group for equipment list submission not found', 500);
        }
        return $group;
    }
}