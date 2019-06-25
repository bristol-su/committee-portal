<?php


namespace App\Support\Control\Repositories\Contracts;

use App\Support\Control\Models\Contracts\Group as GroupContract;

interface GroupTag
{

    public function all();

    public function allThroughGroup(GroupContract $group);

}