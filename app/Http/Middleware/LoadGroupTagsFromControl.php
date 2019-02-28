<?php

namespace App\Http\Middleware;

use App\Packages\ControlDB\Models\Group;
use App\Packages\ControlDB\Models\GroupTag;
use Closure;
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
        $groupId = Auth::guard('committee-role')->user()->group_id;
        $groupTags = Cache::remember('Middleware.LoadGroupTagsFromControl.'.$groupId, 200, function() use ($groupId){

            $group = Group::find($groupId);
            $groupTags = GroupTag::allThrough($group);

            return $groupTags;
        });

        $request->attributes->add(['auth_group_tags' => $groupTags]);
        return $next($request);
    }
}
