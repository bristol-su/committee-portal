<?php


namespace App\Support\Module\Contracts;


interface CompletionEvents
{

    public function exists($event): bool;

    public function all();

}