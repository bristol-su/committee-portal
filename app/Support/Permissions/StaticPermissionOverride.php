<?php

namespace App\Support\Permissions;

use App\User;
use Illuminate\Database\Eloquent\Model;

class StaticPermissionOverride extends Model
{
    protected $fillable = [
        'user_id',
        'permission',
        'result'
    ];

    protected $casts = [
        'result' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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
        return ($override?$override->result:null);
    }
}
