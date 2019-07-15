<?php


namespace App\Support\Control\Repositories;


use App\Support\Control\Models\Contracts\Group as GroupContract;
use App\Support\Control\Models\GroupTag as GroupTagModel;
use App\Support\Control\Repositories\Contracts\GroupTag as GroupTagContract;

class GroupTag implements GroupTagContract
{
    public function all()
    {
        $realGroupTag = [];
        $groupTags = \App\Packages\ControlDB\Models\GroupTag::all();
        foreach($groupTags as $groupTag){
            $realGroupTag[] = new GroupTagModel($groupTag->toArray());
        }
        return $realGroupTag;
    }

    public function allThroughGroup(GroupContract $group)
    {
        // TODO: Implement allThroughGroup() method.
    }
}