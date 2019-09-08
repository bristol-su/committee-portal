<?php

namespace App\Support\Permissions\Testers;

use App\Support\Authentication\Contracts\Authentication;
use App\Support\Permissions\Contracts\Testers\Tester;
use App\Support\Permissions\Models\ModelPermission;

class SystemUserPermission extends Tester
{
    /**
     * @var Authentication
     */
    private $authentication;

    public function __construct(Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    public function can(string $ability): ?bool
    {
        $user = $this->authentication->getUser();
        if($user === null) {
            return parent::next($ability);
        }
        $permissions = ModelPermission::user($user->id, $ability);
        if($permissions->count() === 0) {
            return parent::next($ability);
        }
        return $permissions->first()->result;
    }
}
