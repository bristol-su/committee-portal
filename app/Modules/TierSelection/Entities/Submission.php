<?php

namespace App\Modules\TierSelection\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

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
}

