<?php


namespace App\Support\Control\Contracts\Repositories;


use App\Support\Control\Contracts\Models\User as UserModelContract;

interface User
{

    public function findOrCreateByDataId($dataPlatformId) : UserModelContract;

}
