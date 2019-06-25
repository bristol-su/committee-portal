<?php


namespace App\Support\Module\Contracts;


interface OverrideAttributeRepository
{

    public function getByModuleInstanceId(int $id) : OverrideAttribute;

}