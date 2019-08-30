<?php


namespace App\Support\Filters\Contracts\Filters;

use App\Support\Authentication\Contracts\Authentication;

abstract class GroupFilter extends Filter
{


    /**
     * @var Authentication
     */
    private $authentication;

    public function __construct(Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    public function hasModel(): bool
    {
        return $this->authentication->getGroup() !== null;
    }

    public function model()
    {
        return $this->authentication->getGroup();
    }

    public function for()
    {
        return 'group';
    }



}
