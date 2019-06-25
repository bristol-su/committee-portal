<?php


namespace App\Support\Logic\Contracts;


interface Specification
{

    public function isSatisfied() : bool;

}