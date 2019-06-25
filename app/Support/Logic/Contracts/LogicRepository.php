<?php


namespace App\Support\Logic\Contracts;


interface LogicRepository
{

    public function create($name, $description, $allTrue = [], $anyTrue = [], $allFalse = [], $anyFalse = []);

}