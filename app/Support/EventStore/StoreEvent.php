<?php


namespace App\Support\EventStore;


use App\Support\Module\Contracts\ModuleInstance;

interface StoreEvent
{

    /**
     * Gets the current module instance
     *
     * @return ModuleInstance
     */
    public function moduleInstance(): ModuleInstance;

    public function keywords(): array;

    public function userId(): int;

    public function groupId(): ?int;

    public function roleId(): ?int;

}