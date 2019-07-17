<?php

namespace App\Support\Control\Models;

use App\Support\Control\Models\Contracts\Group as GroupContract;
use App\Support\Control\Models\Contracts\Role as RoleContract;

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