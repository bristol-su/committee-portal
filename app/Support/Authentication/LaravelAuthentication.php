<?php


namespace App\Support\Authentication;


use App\Support\Authentication\Contracts\Authentication as AuthenticationContract;
use App\Support\Control\Models\Group;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Auth;

class LaravelAuthentication implements AuthenticationContract
{

    /**
     * @var AuthManager
     */
    private $auth;

    public function __construct()
    {
        $this->auth = resolve('auth');
    }

    public function getGroup()
    {
        if(Auth::guard('role')->check()) {
            return new Group(Auth::guard('role')->user()->group);
        }

        if(Auth::guard('group')->check()) {
            return Auth::guard('group')->user();
        }

        return null;
    }

    public function getRole()
    {
        if(Auth::guard('role')->check()) {
            return Auth::guard('role')->user();
        }

        return null;
    }

    public function getUser()
    {
        if(Auth::guard('web')->check()) {
            return Auth::guard('web')->user();
        }
    }

}