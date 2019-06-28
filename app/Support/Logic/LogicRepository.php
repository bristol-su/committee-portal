<?php


namespace App\Support\Logic;


use App\Support\Logic\Contracts\LogicRepository as LogicRepositoryContract;

class LogicRepository implements LogicRepositoryContract
{

    public function create(array $attributes)
    {
        return Logic::create($attributes);
    }

}