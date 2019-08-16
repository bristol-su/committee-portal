<?php


namespace App\Support\DataPlatform\Repositories;


use App\Support\DataPlatform\Contracts\Models\User as UserModelContract;
use App\Support\DataPlatform\Contracts\Repositories\User as UserRepositoryContract;

class User implements UserRepositoryContract
{

    public function getByIdentity($identity) : UserModelContract
    {

    }

}
