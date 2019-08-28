<?php


namespace App\Support\Control\Contracts\Repositories;

use App\Support\Control\Contracts\Models\Group as GroupContract;

interface GroupTag
{

    public function all();

    public function allThroughGroup(GroupContract $group);

}
