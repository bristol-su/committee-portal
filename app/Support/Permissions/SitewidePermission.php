<?php

namespace App\Support\Permissions;

use App\Support\Logic\Facade\LogicTester;
use App\Support\Logic\Logic;
use App\User;
use Illuminate\Database\Eloquent\Model;

class SitewidePermission extends Model
{
    protected $fillable = [
        'user_id',
        'permission',
        'logic_id'
    ];

    protected $casts = [
        'result' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function logic()
    {
        return $this->belongsTo(Logic::class);
    }

    public static function passes(User $user, $permission)
    {
        $instance = new static;
        $override = $instance
            ->newQuery()
            ->where([
                'permission' => $permission,
                'user_id' => $user->id
            ])
            ->first();
        return ($override
            ?LogicTester::evaluate($override->logic)
            :null);
    }
}
