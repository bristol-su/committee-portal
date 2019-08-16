<?php


namespace App\Support\Control\Repositories\Contracts;


use App\Support\Control\Models\Contracts\User as UserModelContract;

interface User
{

    public function findOrCreate($dataPlatformId) : UserModelContract;

}
