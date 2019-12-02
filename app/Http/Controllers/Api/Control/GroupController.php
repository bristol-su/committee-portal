<?php

namespace App\Http\Controllers\Api\Control;

use App\Http\Controllers\Controller;
use BristolSU\Support\Control\Contracts\Repositories\Group as GroupRepository;

class GroupController extends Controller
{

    public function show($groupId, GroupRepository $groupRepository)
    {
        return $groupRepository->getById($groupId);
    }

}
