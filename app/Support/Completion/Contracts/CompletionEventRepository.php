<?php


namespace App\Support\Completion\Contracts;


interface CompletionEventRepository
{

    public function allForModule(string $alias);

}
