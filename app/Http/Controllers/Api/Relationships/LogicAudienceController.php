<?php


namespace App\Http\Controllers\Api\Relationships;


use App\Http\Controllers\Controller;
use BristolSU\Support\Logic\Contracts\LogicAudience;
use BristolSU\Support\Logic\Logic;

class LogicAudienceController extends Controller
{

    public function index(Logic $logic, LogicAudience $audience)
    {
        return $audience->audience($logic);
    }

}
