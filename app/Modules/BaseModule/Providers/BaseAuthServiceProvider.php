<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 13/03/19
 * Time: 03:52
 */

namespace App\Modules\BaseModule\Providers;


use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\GroupTag;
use App\Traits\CanSeeGroupTags;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class BaseAuthServiceProvider extends ServiceProvider
{
    use CanSeeGroupTags;

    public function usersCurrentGroupHasTag($user, $categoryReference, $tagReference)
    {
        $group = Group::find($user->getCurrentRole()->group->id);

        return $this->groupHasTag($group, $categoryReference, $tagReference);
    }
}