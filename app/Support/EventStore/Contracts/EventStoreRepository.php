<?php


namespace App\Support\EventStore\Contracts;


interface EventStoreRepository
{

    public function create(array $attributes);

    public function has(array $attributes): bool;
}
