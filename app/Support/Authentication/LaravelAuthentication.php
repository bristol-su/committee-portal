<?php


namespace App\Support\Authentication;


use App\Support\Authentication\Contracts\Authentication as AuthenticationContract;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Support\Facades\Auth;

class LaravelAuthentication implements AuthenticationContract
{

    /**
     * @var AuthFactory
     */
    private $auth;

    public function __construct(AuthFactory $auth)
    {
        $this->auth = $auth;
    }

    public function getGroup()
    {
        if($this->auth->guard('role')->check()) {
            return $this->auth->guard('role')->user()->group;
        }

        if($this->auth->guard('group')->check()) {
            return $this->auth->guard('group')->user();
        }

        return null;
    }

    public function getRole()
    {
        if($this->auth->guard('role')->check()) {
            return $this->auth->guard('role')->user();
        }

        return null;
    }

    public function getUser()
    {
        if($this->auth->guard('web')->check()) {
            return $this->auth->guard('web')->user();
        }
    }

}
