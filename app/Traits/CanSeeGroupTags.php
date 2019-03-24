<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 24/03/19
 * Time: 13:12
 */

namespace App\Traits;


use App\Packages\ControlDB\Models\GroupTag;
use App\Packages\ControlDB\Models\GroupTagCategory;

trait CanSeeGroupTags
{
    public function groupHasTag($group, $categoryReference, $tagReference)
    {
        $groupTags = $this->getTagFromGroup($group, $categoryReference, $tagReference);
        return $groupTags !== null;
    }

    public function getGroupTag($categoryReference, $tagReference)
    {
        // TODO Optimize

        $groupTags = GroupTag::all();

        $groupTags = $groupTags->filter(function($groupTag) use ($categoryReference, $tagReference) {
            return $groupTag->reference === $tagReference && $groupTag->category->reference === $categoryReference;
        });

        if(count($groupTags) > 0) {
            return $groupTags->first();
        }

        throw new \Exception('Group Tag not found: '.$categoryReference.'.'.$tagReference, 500);
    }

    public function getTagFromGroup($group, $categoryReference, $tagReference)
    {
        $groupTags = GroupTag::allThrough($group);
        $groupTags = $groupTags->filter(function($groupTag) use ($categoryReference, $tagReference) {
            return $groupTag->reference === $tagReference && $groupTag->category->reference === $categoryReference;
        });

        return $groupTags->first();
    }
}