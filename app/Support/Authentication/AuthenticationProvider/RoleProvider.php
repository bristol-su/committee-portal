<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 12/02/19
 * Time: 18:32
 */

namespace App\Support\Authentication\AuthenticationProvider;

use App\Support\Control\Contracts\Repositories\Role as RoleContract;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class RoleProvider implements UserProvider
{

    /**
     * @var RoleContract
     */
    private $role;

    public function __construct(RoleContract $role)
    {
        $this->role = $role;
    }

    public function retrieveById($identifier)
    {
        return $this->role->getById($identifier);

    }

    public function retrieveByToken($identifier, $token)
    {

    }

    public function updateRememberToken(Authenticatable $user, $token)
    {

    }

    public function retrieveByCredentials(array $credentials)
    {
        if (isset($credentials['committee_role_id'])) {
            return $this->retrieveById($credentials['committee_role_id']);
        }
        return false;
    }

    /**
     * Ensure the user owns the committee role
     *
     * @param Authenticatable $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        if (isset($credentials['student_control_id']) && isset($credentials['committee_role_id'])) {
            // Ensure the user owns the position
            $role = $this->retrieveById($credentials['committee_role_id']);
            if ($role !== false && $role->student_id === (int) $credentials['student_control_id']) {
                return true;
            }
        }
        return false;
    }
}
