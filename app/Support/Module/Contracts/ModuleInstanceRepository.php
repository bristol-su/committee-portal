<?php

namespace App\Support\Module\Contracts;

interface ModuleInstanceRepository
{
    public function getById(int $id) : ModuleInstance;

    public function create($alias, $eventId, $name, $description, $active, $visible, $mandatory, $complete) : ModuleInstance;

}