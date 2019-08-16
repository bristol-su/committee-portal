<?php


namespace App\Support\Control\Repositories;


use App\Support\Control\Models\Contracts\User as UserModelContract;
use App\Support\Control\Repositories\Contracts\User as UserContract;

class User implements UserContract
{
    public function findOrCreate($dataPlatformId): UserModelContract
    {
        // TODO: Implement create() method.
    }
}
