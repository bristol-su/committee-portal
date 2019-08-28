<?php

namespace App\Support\Control\Models;

use App\Support\Control\Contracts\Models\Group as GroupContract;

class Group extends Model implements GroupContract
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
