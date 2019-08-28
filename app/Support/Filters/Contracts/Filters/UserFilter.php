<?php


namespace App\Support\Filters\Contracts\Filters;

use App\Support\Authentication\Contracts\Authentication;

abstract class UserFilter extends Filter
{


    /**
     * @var Authentication
     */
    private $authentication;

    public function __construct(Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    public function model()
    {
        // TODO Test if null
        return $this->authentication->getUser();
    }

    public function for()
    {
        return 'user';
    }



}
