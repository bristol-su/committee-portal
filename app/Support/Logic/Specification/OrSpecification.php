<?php


namespace App\Support\Logic\Specification;


use App\Support\Logic\Contracts\Specification;

class OrSpecification implements Specification
{

    /**
     * @var array
     */
    private $specifications;

    public function __construct(...$specifications)
    {
        $this->specifications = $specifications;
    }

    public function isSatisfied() : bool
    {
        if(count($this->specifications) === 0) {
            return true;
        }
        foreach($this->specifications as $specification) {
            if($specification->isSatisfied()) {
                return true;
            }
        }

        return false;
    }

}