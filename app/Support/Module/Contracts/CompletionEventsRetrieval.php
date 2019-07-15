<?php


namespace App\Support\Module\Contracts;


interface CompletionEventsRetrieval
{

    public function exists($event): bool;

    public function all();

}