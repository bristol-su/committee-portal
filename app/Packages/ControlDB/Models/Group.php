<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 12/02/19
 * Time: 22:02
 */

namespace App\Packages\ControlDB\Models;

use App\Packages\ControlDB\Models\BaseControlActiveRecordModel as Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class Group extends Model
{

    protected $resourceName = 'groups';

    public function getGroupType()
    {
        $group = $this;

        return Cache::remember('control.group.tag.grouptype.'.$group->id, 18000, function() use ($group) {
            $groupTags = GroupTag::allThrough($group);
            $groupTags->filter(function ($groupTag) {
                return $groupTag->category->reference === config('control.group_type_tag_category_reference');
            });
            return ($groupTags->first() !== null ? $groupTags->first()->reference : false);
        });

    }

}