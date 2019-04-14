<?php

namespace App\Modules\MainContacts\Entities;

use App\Packages\ControlDB\Models\Group;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'maincontacts_submissions';

    protected $fillable = [
        'user_id',
        'group_id',
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
            throw new \Exception('Group not found', 500);
        }
        return $group;
    }
}
