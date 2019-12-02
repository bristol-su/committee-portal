<?php


namespace App\Http\Controllers\Api\Relationships;


use App\Http\Controllers\Controller;
use BristolSU\Support\Control\Contracts\Models\Group;
use BristolSU\Support\Control\Contracts\Models\Role;
use BristolSU\Support\Control\Contracts\Models\User;
use BristolSU\Support\Logic\Audience\AudienceMember;
use BristolSU\Support\Logic\Contracts\Audience\LogicAudience;
use BristolSU\Support\Logic\Logic;

class LogicAudienceController extends Controller
{

    public function index(Logic $logic, LogicAudience $audience)
    {
        return collect($audience->audience($logic));
    }

    public function user(Logic $logic, LogicAudience $audience)
    {
        return collect($audience->audience($logic))->filter(function (AudienceMember $audienceMember) {
            return $audienceMember->canBeUser();
        })->map(function (AudienceMember $audienceMember) {
            return $audienceMember->user();
        })->flatten(1)->unique(function (User $user) {
            return $user->id();
        })->values();
    }

    public function group(Logic $logic, LogicAudience $audience)
    {
        return collect($audience->audience($logic))->filter(function (AudienceMember $audienceMember) {
            return $audienceMember->groups()->count() > 0;
        })->map(function (AudienceMember $audienceMember) {
            return $audienceMember->groups();
        })->flatten(1)->unique(function (Group $group) {
            return $group->id();
        })->values();
    }

    public function role(Logic $logic, LogicAudience $audience)
    {
        return collect($audience->audience($logic))->filter(function (AudienceMember $audienceMember) {
            return $audienceMember->roles()->count();
        })->map(function (AudienceMember $audienceMember) {
            return $audienceMember->roles();
        })->flatten(1)->unique(function (Role $role) {
            return $role->id();
        })->values();
    }

}
