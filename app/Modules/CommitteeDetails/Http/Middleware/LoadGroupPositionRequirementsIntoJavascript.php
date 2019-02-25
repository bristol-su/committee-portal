<?php

namespace App\Modules\CommitteeDetails\Http\Middleware;

use App\Modules\CommitteeDetails\Entities\PositionSetting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class LoadGroupPositionRequirementsIntoJavascript
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var Collection $groupTags */
        $groupTags = request()->get('auth_group_tags');
        $groupTags->filter(function ($groupTag) {
            return $groupTag->category->reference === config('committeedetails.group_type_tag_category_reference');
        });

        abort_if(count($groupTags) === 0, 403, 'We couldn\'t find your group type.');

        $tagReference = $groupTags->first()->reference;

        $positionSetting = PositionSetting::where('tag_reference', $tagReference)->get()->first();

        abort_if($positionSetting === null, 403, 'We couldn\'t find your group type on our system');

        JavaScriptFacade::put([
            'group_type' => $tagReference,
            'group_settings' => $positionSetting->only([
                'allowed_positions',
                'required_positions',
                'position_only_has_single_committee_member',
                'committee_member_only_has_single_position'
            ])
        ]);
        return $next($request);
    }
}
