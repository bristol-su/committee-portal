<?php


namespace App\Support\Logic;


use App\Support\Authentication\Contracts\Authentication as AuthenticationContract;
use App\Support\Logic\Contracts\AuthenticationModelFactory as AuthenticationModelFactoryContract;

class AuthenticationModelFactory implements AuthenticationModelFactoryContract
{

    /**
     * @var AuthenticationContract
     */
    private $authentication;

    public function __construct(AuthenticationContract $authentication)
    {

        $this->authentication = $authentication;
    }

    public function createFromString($model)
    {
            if($model === 'group') {
                return $this->authentication->getGroup();
            }

            if($model === 'user') {
                return $this->authentication->getUser();
            }

            if($model === 'role') {
                return $this->authentication->getRole();
            }

            throw new \Exception('Filter model not found');
    }

}