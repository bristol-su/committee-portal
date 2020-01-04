<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use BristolSU\ControlDB\Contracts\Repositories\Group as GroupRepository;

class GroupController extends Controller
{

    public function show($group, GroupRepository $groupRepository)
    {
        return $groupRepository->getById($group);
    }
}
