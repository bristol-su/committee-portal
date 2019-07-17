<?php


namespace App\Support\Control\Repositories;


use App\Support\Control\Models\Contracts\Group as GroupContract;
use App\Support\Control\Models\GroupTag as GroupTagModel;
use App\Support\Control\Repositories\Contracts\GroupTag as GroupTagContract;
use Illuminate\Support\Collection;

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
        $group = \App\Packages\ControlDB\Models\Group::find($group->id);
        $tags = \App\Packages\ControlDB\Models\GroupTag::allThrough($group);
        $customTags = new Collection;
        foreach($tags as $tag) {
            $customTags->push(new GroupTagModel($tag->toArray()));
        }
        return $customTags;
    }
}