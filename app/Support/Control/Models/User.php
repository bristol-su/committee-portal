<?php


namespace App\Support\Control\Models;


use App\Support\Control\Contracts\Models\User as UserContract;

class User extends Model implements UserContract
{

    public function id()
    {
        return $this->id;
    }

    public function dataPlatformId()
    {
        return $this->uc_uid;
    }

}
