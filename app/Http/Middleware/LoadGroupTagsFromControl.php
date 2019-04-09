<?php

namespace App\Http\Middleware;

use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\GroupTag;
use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class LoadGroupTagsFromControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::user()->isAdmin()) {
            $groupId = getGroupID();

            $groupTags = Cache::remember('Middleware.LoadGroupTagsFromControl.'.$groupId, 200, function() use ($groupId){

                $group = Group::find($groupId);
                $groupTags = GroupTag::allThrough($group);
                if($groupTags === false) {
                    return Collection::make([]);
                }
                return $groupTags;
            });
        } else {
            $groupTags = new Collection();
        }


        $request->attributes->add(['auth_group_tags' => $groupTags]);
        return $next($request);
    }
}
