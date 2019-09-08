<?php


namespace App\Support\Permissions\Contracts\Testers;


abstract class Tester
{

    /**
     * @var Tester
     */
    private $successor = null;

    public function setNext(?Tester $tester = null)
    {
        $this->successor = $tester;
    }

    public function next(string $ability)
    {
        if($this->successor === null) {
            return false;
        }
        return $this->successor->can($ability);
    }

    abstract public function can(string $ability): ?bool;
}
