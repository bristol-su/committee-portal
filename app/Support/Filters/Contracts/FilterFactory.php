<?php


namespace App\Support\Filters\Contracts;


interface FilterFactory
{

    public function createFilterFromClassName($className);

}
