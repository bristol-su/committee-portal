<?php


namespace App\Support\EventStore\Contracts;


use App\Support\ModuleInstance\Contracts\ModuleInstance;

interface StorableEvent
{

    /**
     * Gets the current module instance id
     */
    public function moduleInstanceId(): int;

    public function keywords(): array;

    public function userId(): int;

    public function groupId(): ?int;

    public function roleId(): ?int;

}
