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
        return $audience->userAudience($logic);
    }

    public function group(Logic $logic, LogicAudience $audience)
    {
        return $audience->groupAudience($logic);
    }

    public function role(Logic $logic, LogicAudience $audience)
    {
        return $audience->roleAudience($logic);
    }

}
