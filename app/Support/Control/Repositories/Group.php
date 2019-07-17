<?php


namespace App\Support\Control\Repositories;


use App\Support\Control\Repositories\Contracts\Group as GroupContract;

class Group implements GroupContract
{

    public function getById($id)
    {
        $group = \App\Packages\ControlDB\Models\Group::find($id);
        return new \App\Support\Control\Models\Group($group->toArray());
    }

}