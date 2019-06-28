<?php

namespace App\Support\Module\Contracts;

interface ModuleInstanceRepository
{
    public function getById(int $id) : ModuleInstance;

    public function create(array $attributes) : ModuleInstance;

}