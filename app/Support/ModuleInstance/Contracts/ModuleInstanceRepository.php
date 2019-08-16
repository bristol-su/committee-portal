<?php

namespace App\Support\ModuleInstance\Contracts;

interface ModuleInstanceRepository
{
    public function getById(int $id) : ModuleInstance;

    public function create(array $attributes) : ModuleInstance;

}
