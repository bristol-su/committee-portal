<?php


namespace App\Http\Controllers\Api\Relationships;


use BristolSU\Support\Logic\Logic;

class LogicFiltersController
{

    public function index(Logic $logic)
    {
        return $logic->filters;
    }

}
