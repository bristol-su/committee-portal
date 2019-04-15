<?php

namespace App\Modules\Safeguarding\Entities;

use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\Position;
use App\User;
use Exception;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'group_id',
        'position_id',
        'user_id',
        'year'
    ];

    protected $table = 'safeguarding_submissions';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        $group = Group::find($this->group_id);
        if ($group === false) {
            throw new Exception('Could not find a group (id ' . $this->id . ')');
        }
        return $group;
    }

    public function position()
    {
        if ($this->position_id === 'admin') {
            return (object)['name' => 'Administrator'];
        }
        $position = Position::find($this->position_id);
        if ($position === false) {
            throw new Exception('Could not find a position (id ' . $this->id . ')');
        }
        return $position;
    }
}