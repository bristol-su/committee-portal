<?php


namespace App\Support\Logic\Contracts;


interface AuthenticationModelFactory
{

    public function createFromString($string);

}