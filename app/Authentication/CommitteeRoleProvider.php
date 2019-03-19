<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 12/02/19
 * Time: 18:32
 */

namespace App\Authentication;


use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Student;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Auth;

class CommitteeRoleProvider implements UserProvider
{

    protected $controlDB;

    public function __construct()
    {
        $this->controlDB = resolve('App\Packages\ControlDB\ControlDBInterface');
    }

    public function retrieveById($identifier)
    {
        return CommitteeRole::find($identifier);

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