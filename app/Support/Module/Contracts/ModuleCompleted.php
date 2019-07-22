<?php


namespace App\Support\Module\Contracts;


interface ModuleCompleted
{

    public function complete(ModuleInstance $moduleInstance): bool;

}