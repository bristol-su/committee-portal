<?php

namespace App\Support\Control\Models;

use App\Support\Control\Contracts\Models\Group as GroupContract;
use App\Support\Control\Contracts\Models\Role as RoleContract;

class Role extends Model implements RoleContract
{

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthPassword()
    {
    }

    public function getRememberToken()
    {
    }

    public function getRememberTokenName()
    {
    }

    public function setRememberToken($value)
    {
        //
    }

}
