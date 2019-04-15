<?php

namespace App\Modules\TierSelection\Entities;

use App\Packages\ControlDB\Models\Group;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Submission extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'group_id',
        'tier_id',
        'user_id'
    ];

    protected $table = 'tierselection_submissions';

    /**
     * Get the number of submissions from a group
     * in a year
     *
     * @param $groupId
     * @return int
     */
    public static function countSubmissions($groupId)
    {
        return self::where([
            'group_id' => $groupId,
            'year' => config('portal.reaffiliation_year')
        ])->count();
    }

    /**
     * Get the submissions from a certain group in a year
     * @param $groupId
     * @return Collection
     */
    public static function getSubmissions($groupId)
    {
        return self::where([
            'group_id' => $groupId,
            'year' => config('portal.reaffiliation_year')
        ])->get();
    }

    public function tier()
    {
        return $this->belongsTo('App\Modules\TierSelection\Entities\Tier');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function group()
    {
        $group = Group::find($this->group_id);
        if ($group === false) {
            throw new Exception('Group not found', 500);
        }
        return $group;
    }
}

