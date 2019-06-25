<?php


namespace App\Support\Logic;


use App\Support\Logic\Contracts\LogicRepository as LogicRepositoryContract;

class LogicRepository implements LogicRepositoryContract
{

    public function create($name, $description, $allTrue = [], $anyTrue = [], $allFalse = [], $anyFalse = [])
    {
        return Logic::create([
            'name' => $name,
            'description' => $description,
            'all_true' => $allTrue,
            'any_true' => $anyTrue,
            'all_false' => $allFalse,
            'any_false' => $anyFalse
        ]);
    }

}