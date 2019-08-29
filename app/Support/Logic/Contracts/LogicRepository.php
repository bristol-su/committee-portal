<?php


namespace App\Support\Logic\Contracts;


interface LogicRepository
{

    public function create(array $attributes);

    public function all();
}
